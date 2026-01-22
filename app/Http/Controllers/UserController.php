<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables; // ✅ Import Yajra

class UserController extends Controller
{
    /**
     * Display a listing of users with Yajra DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('role')->select('users.*');
            
            return DataTables::of($data)
                ->addIndexColumn() // Adds {DT_RowIndex} for numbering
                ->addColumn('role_name', function($row){
                    // Display Badge based on role
                    $badgeClass = match($row->role?->name) {
                        'Admin' => 'badge bg-danger',
                        'Manager' => 'badge bg-warning text-dark',
                        default => 'badge bg-secondary'
                    };
                    $roleName = $row->role ? $row->role->name : 'No Role';
                    return '<span class="'.$badgeClass.'">'.$roleName.'</span>';
                })
                ->addColumn('created_at_formatted', function($row){
                    return $row->created_at->format('d M, Y');
                })
                ->addColumn('action', function($row){
                    // Create Edit and Delete buttons
                    $editUrl = route('admin.users.edit', $row->id);
                    $deleteUrl = route('admin.users.destroy', $row->id);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');

                    return '
                        <div class="d-flex gap-2">
                            <a href="'.$editUrl.'" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="'.$deleteUrl.'" method="POST" onsubmit="return confirm(\'Are you sure?\')">
                                '.$csrf.'
                                '.$method.'
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['role_name', 'action']) // Tell Yajra to render HTML for these columns
                ->make(true);
        }

        return view('admin.users.index');
    }

    // ... Rest of your methods (create, store, edit, update, destroy) remain the same ...
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
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

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}