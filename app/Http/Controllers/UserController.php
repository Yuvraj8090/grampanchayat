<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\State; // Ensure these models exist
use App\Models\District;
use App\Models\Block;
use App\Models\Panchayat;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of users with Yajra DataTables.
     */
    public function index(Request $request)
{
    if ($request->ajax()) {
        // 1. Eager Load Relations
        // We load 'role' and the nested 'locations' relationships to avoid N+1 queries.
        $data = User::with([
            'role', 
            'locations.state', 
            'locations.district', 
            'locations.block', 
            'locations.panchayat'
        ])->select('users.*');

        return DataTables::of($data)
            ->addIndexColumn() // Adds {DT_RowIndex}
            
            // --- Role Column ---
            ->addColumn('role_name', function ($row) {
                $badgeClass = match ($row->role?->name) {
                    'Admin'   => 'badge bg-danger',
                    'Manager' => 'badge bg-warning text-dark',
                    default   => 'badge bg-secondary',
                };
                $roleName = $row->role ? $row->role->name : 'No Role';
                return '<span class="' . $badgeClass . '">' . $roleName . '</span>';
            })

            // --- Locations Column (The Dropdown) ---
            ->addColumn('locations', function ($row) {
                // Render the partial view we created earlier
                return view('admin.users.partials.location-column', ['user' => $row])->render();
            })

            // --- Created At ---
            ->addColumn('created_at_formatted', function ($row) {
                return $row->created_at->format('d M, Y');
            })

            // --- Action Buttons ---
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.users.edit', $row->id);
                $deleteUrl = route('admin.users.destroy', $row->id);
                $csrf = csrf_field();
                $method = method_field('DELETE');

                return '
                <div class="d-flex gap-2 justify-content-end">
                    <a href="' . $editUrl . '" class="btn btn-sm btn-outline-primary" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this user?\')">
                        ' . $csrf . $method . '
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>';
            })

            // --- Raw Columns Declaration ---
            // This tells DataTables NOT to escape HTML in these specific columns
            ->rawColumns(['role_name', 'locations', 'action'])
            
            ->make(true);
    }

    return view('admin.users.index');
}

    public function create()
    {
        $roles = Role::all();
        $states = State::all(); // Load States
        return view('admin.users.create', compact('roles', 'states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'role_id' => 'required|exists:roles,id',
            // Location Validations
            'state_id' => 'required|exists:states,id',
            'district_id' => 'nullable|exists:districts,id',
            'block_id' => 'nullable|exists:blocks,id',
            'panchayat_id' => 'nullable|exists:panchayats,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        // Assign Location
        UserLocation::create([
            'user_id' => $user->id,
            'state_id' => $request->state_id,
            'district_id' => $request->district_id,
            'block_id' => $request->block_id,
            'panchayat_id' => $request->panchayat_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $states = State::all();

        // Fetch current location assignment (Assuming 1 primary location for this form)
        $location = $user->locations()->first();

        return view('admin.users.edit', compact('user', 'roles', 'states', 'location'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'state_id' => 'required|exists:states,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Update Location (Using updateOrCreate to handle "Null Void" logic per user)
        UserLocation::updateOrCreate(
            ['user_id' => $user->id], // Search by User ID
            [
                'state_id' => $request->state_id,
                'district_id' => $request->district_id,
                'block_id' => $request->block_id,
                'panchayat_id' => $request->panchayat_id,
            ],
        );

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * AJAX Handler for Dynamic Dropdowns
     */
    public function getLocations(Request $request)
    {
        // Return empty if no parent ID (security check)
        if (!$request->parent_id) {
            return response()->json([]);
        }

        $data = [];

        switch ($request->type) {
            case 'district':
                // Get districts belonging to the State
                $data = District::where('state_id', $request->parent_id)
                    ->where('is_active', 1) // Optional: check active status
                    ->orderBy('name')
                    ->get(['id', 'name']);
                break;

            case 'block':
                // Get blocks belonging to the District
                $data = Block::where('district_id', $request->parent_id)
                    ->where('is_active', 1)
                    ->orderBy('name')
                    ->get(['id', 'name']);
                break;

            case 'panchayat':
                // Get panchayats belonging to the Block
                $data = Panchayat::where('block_id', $request->parent_id)
                    ->orderBy('name') // Panchayats might not have 'is_active'
                    ->get(['id', 'name']);
                break;
        }

        return response()->json($data);
    }
}
