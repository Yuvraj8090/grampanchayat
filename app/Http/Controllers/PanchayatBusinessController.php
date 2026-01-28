<?php

namespace App\Http\Controllers;

use App\Models\Panchayat;
use App\Models\PanchayatBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PanchayatBusinessController extends Controller
{
    public function index(Request $request, $panchayatId)
    {
        $panchayat = Panchayat::findOrFail($panchayatId);

        if ($request->ajax()) {
            $data = $panchayat->businesses()->latest(); 

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
                    $editUrl = route('admin.panchayats.businesses.edit', [$panchayatId, $row->id]);
                    $deleteUrl = route('admin.panchayats.businesses.destroy', [$panchayatId, $row->id]);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');

                    return '
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="' . $editUrl . '" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this business?\')">
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

        return view('admin.panchayat_businesses.index', compact('panchayat'));
    }

    public function create($panchayatId)
    {
        $panchayat = Panchayat::findOrFail($panchayatId);
        return view('admin.panchayat_businesses.create', compact('panchayat'));
    }

    public function store(Request $request, $panchayatId)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'nullable|string|max:255',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        $data = $request->except(['photo']);
        $data['panchayat_id'] = $panchayatId;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('panchayat_businesses', 'public');
        }

        PanchayatBusiness::create($data);

        return redirect()->route('admin.panchayats.businesses.index', $panchayatId)
                         ->with('success', 'New business added successfully!');
    }

    public function edit($panchayatId, $id)
    {
        $panchayat = Panchayat::findOrFail($panchayatId);
        $business = PanchayatBusiness::where('panchayat_id', $panchayatId)->findOrFail($id);

        return view('admin.panchayat_businesses.edit', compact('panchayat', 'business'));
    }

    public function update(Request $request, $panchayatId, $id)
    {
        $business = PanchayatBusiness::where('panchayat_id', $panchayatId)->findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'nullable|string|max:255',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        $data = $request->except(['photo']);

        if ($request->hasFile('photo')) {
            if ($business->photo) {
                Storage::disk('public')->delete($business->photo);
            }
            $data['photo'] = $request->file('photo')->store('panchayat_businesses', 'public');
        }

        $business->update($data);

        return redirect()->route('admin.panchayats.businesses.index', $panchayatId)
                         ->with('success', 'Business updated successfully!');
    }

    public function destroy($panchayatId, $id)
    {
        $business = PanchayatBusiness::where('panchayat_id', $panchayatId)->findOrFail($id);

        if ($business->photo) {
            Storage::disk('public')->delete($business->photo);
        }
        
        $business->delete();

        return back()->with('success', 'Business deleted successfully!');
    }
}