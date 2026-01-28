<?php

namespace App\Http\Controllers;

use App\Models\Panchayat;
use App\Models\PanchayatPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PanchayatPlaceController extends Controller
{
    // List Places (Handles both View and Yajra JSON)
    public function index(Request $request, $panchayatId)
    {
        $panchayat = Panchayat::findOrFail($panchayatId);

        if ($request->ajax()) {
            $data = $panchayat->places()->latest(); // Get places specific to this Panchayat

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('photo_display', function ($row) {
                    if ($row->photo) {
                        $url = asset('storage/' . $row->photo);
                        return '<img src="' . $url . '" class="rounded border" width="50" height="50" style="object-fit:cover;">';
                    }
                    return '<span class="text-muted small">No Image</span>';
                })
                ->addColumn('status_badge', function ($row) {
                    $badgeClass = $row->status === 'active' ? 'bg-success' : 'bg-secondary';
                    return '<span class="badge ' . $badgeClass . '">' . ucfirst($row->status) . '</span>';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d M, Y');
                })
                ->addColumn('action', function ($row) use ($panchayatId) {
                    $editUrl = route('admin.panchayats.places.edit', [$panchayatId, $row->id]);
                    $deleteUrl = route('admin.panchayats.places.destroy', [$panchayatId, $row->id]);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');

                    return '
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="' . $editUrl . '" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this place?\')">
                                ' . $csrf . '
                                ' . $method . '
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>';
                })
                ->rawColumns(['photo_display', 'status_badge', 'action'])
                ->make(true);
        }

        return view('admin.panchayat_places.index', compact('panchayat'));
    }

    // Show Create Form
    public function create($panchayatId)
    {
        $panchayat = Panchayat::findOrFail($panchayatId);
        return view('admin.panchayat_places.create', compact('panchayat'));
    }

    // Store New Place
    public function store(Request $request, $panchayatId)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'nullable|string|max:255',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Max 2MB
            'status'      => 'required|in:active,inactive',
        ]);

        $data = $request->except(['photo']);
        $data['panchayat_id'] = $panchayatId;

        // Handle File Upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('panchayat_places', 'public');
        }

        PanchayatPlace::create($data);

        return redirect()->route('admin.panchayats.places.index', $panchayatId)
                         ->with('success', 'New place added successfully!');
    }

    // Show Edit Form
    public function edit($panchayatId, $id)
    {
        $panchayat = Panchayat::findOrFail($panchayatId);
        // Ensure the place belongs to this panchayat
        $place = PanchayatPlace::where('panchayat_id', $panchayatId)->findOrFail($id);

        return view('admin.panchayat_places.edit', compact('panchayat', 'place'));
    }

    // Update Place
    public function update(Request $request, $panchayatId, $id)
    {
        $place = PanchayatPlace::where('panchayat_id', $panchayatId)->findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'nullable|string|max:255',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        $data = $request->except(['photo']);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($place->photo) {
                Storage::disk('public')->delete($place->photo);
            }
            $data['photo'] = $request->file('photo')->store('panchayat_places', 'public');
        }

        $place->update($data);

        return redirect()->route('admin.panchayats.places.index', $panchayatId)
                         ->with('success', 'Place updated successfully!');
    }

    // Delete Place
    public function destroy($panchayatId, $id)
    {
        $place = PanchayatPlace::where('panchayat_id', $panchayatId)->findOrFail($id);

        if ($place->photo) {
            Storage::disk('public')->delete($place->photo);
        }
        
        $place->delete();

        return back()->with('success', 'Place deleted successfully!');
    }
}