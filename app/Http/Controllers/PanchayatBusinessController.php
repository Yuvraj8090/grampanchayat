<?php

namespace App\Http\Controllers;

use App\Models\Panchayat;
use App\Models\PanchayatBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PanchayatBusinessController extends Controller
{
    /**
     * List all businesses for a specific Panchayat.
     */
    public function index(Request $request, Panchayat $panchayat)
    {
        if ($request->ajax()) {
            // Use relationship and getQuery() for DataTables efficiency
            $data = $panchayat->businesses()->latest()->getQuery();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('photo_display', function ($row) {
                    if ($row->image) {
                        return '<img src="' . asset('storage/' . $row->image) . '" class="rounded border" width="50" height="50" style="object-fit:cover;">';
                    }
                    return '<span class="text-muted small">No Image</span>';
                })
                ->addColumn('status_badge', function ($row) {
                    $badgeClass = $row->status === 'active' ? 'bg-success' : 'bg-secondary';
                    return '<span class="badge ' . $badgeClass . '">' . ucfirst($row->status) . '</span>';
                })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M, Y'))
                ->addColumn('action', function ($row) use ($panchayat) {
                    return '
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="' . route('admin.panchayats.businesses.edit', [$panchayat->id, $row->id]) . '" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="' . route('admin.panchayats.businesses.destroy', [$panchayat->id, $row->id]) . '" method="POST" onsubmit="return confirm(\'Delete this business?\')">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>';
                })
                ->rawColumns(['photo_display', 'status_badge', 'action'])
                ->make(true);
        }

        return view('admin.panchayat_businesses.index', compact('panchayat'));
    }

    public function create(Panchayat $panchayat)
    {
        return view('admin.panchayat_businesses.create', compact('panchayat'));
    }

    public function store(Request $request, Panchayat $panchayat)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('panchayat_businesses', 'public');
        }

        // Create through relationship to auto-fill panchayat_id
        $panchayat->businesses()->create($validated);

        return redirect()->route('admin.panchayats.businesses.index', $panchayat->id)
                         ->with('success', 'New business added successfully!');
    }

    public function edit(Panchayat $panchayat, PanchayatBusiness $business)
    {
        // Safety check: ensure business belongs to the panchayat
        abort_if($business->panchayat_id !== $panchayat->id, 404);

        return view('admin.panchayat_businesses.edit', compact('panchayat', 'business'));
    }

    public function update(Request $request, Panchayat $panchayat, PanchayatBusiness $business)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            // Delete old file if a new one is uploaded
            if ($business->image) {
                Storage::disk('public')->delete($business->image);
            }
            $validated['image'] = $request->file('image')->store('panchayat_businesses', 'public');
        }

        $business->update($validated);

        return redirect()->route('admin.panchayats.businesses.index', $panchayat->id)
                         ->with('success', 'Business updated successfully!');
    }

    public function destroy(Panchayat $panchayat, PanchayatBusiness $business)
    {
        // Delete image file before deleting the record
        if ($business->image) {
            Storage::disk('public')->delete($business->image);
        }
        
        $business->delete();

        return back()->with('success', 'Business deleted successfully!');
    }
}