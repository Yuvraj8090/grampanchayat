<?php

namespace App\Http\Controllers;

use App\Models\Panchayat;
use App\Models\Block;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule; // Needed for update validation

class PanchayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    if ($request->ajax()) {
        // Eager load relationships and count related records efficiently
        $data = Panchayat::with(['block.district'])
            ->withCount(['places', 'businesses']) // Added business count for extra insight
            ->select('panchayats.*');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('location', function ($row) {
                $district = $row->block->district->name ?? 'N/A';
                $block = $row->block->name ?? 'N/A';
                return "<strong>$district</strong> <i class='fas fa-chevron-right mx-1 text-muted' style='font-size: 0.8rem;'></i> $block";
            })
            ->editColumn('status', function ($row) {
                $statusMap = [
                    'active'    => 'bg-success',
                    'suspended' => 'bg-danger',
                    'pending'   => 'bg-warning text-dark',
                ];
                $class = $statusMap[$row->status] ?? 'bg-secondary';
                return '<span class="badge ' . $class . ' shadow-sm">' . ucfirst($row->status) . '</span>';
            })
            ->addColumn('places_count', function ($row) {
                return '<span class="badge bg-info text-white"><i class="fas fa-map-marker-alt me-1"></i> ' . $row->places_count . '</span>';
            })
            ->addColumn('action', function ($row) {
                // URLs
                $businessUrl = route('admin.panchayats.businesses.index', $row->id);
                $galleryUrl  = route('admin.panchayats.gallery.index', $row->id);
                $placesUrl   = route('admin.panchayats.places.index', $row->id);
                $detailsUrl  = route('admin.panchayat.details.edit', $row->id);
                $editUrl     = route('admin.panchayats.edit', $row->id);
                $viewUrl     = route('public.panchayat.show', $row->id);

                return '
                <div class="btn-group btn-group-sm" role="group">
                    <a href="' . $placesUrl . '" class="btn btn-outline-primary" title="Tourist Places">
                        <i class="fas fa-mountain"></i>
                    </a>
                    <a href="' . $businessUrl . '" class="btn btn-outline-primary" title="Local Businesses">
                        <i class="fas fa-store"></i>
                    </a>
                    <a href="' . $galleryUrl . '" class="btn btn-outline-primary" title="Photo Gallery">
                        <i class="fas fa-images"></i>
                    </a>
                    <a href="' . $detailsUrl . '" class="btn btn-outline-success" title="Website Details">
                        <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="' . $editUrl . '" class="btn btn-outline-warning" title="Settings">
                        <i class="fas fa-user-cog"></i>
                    </a>
                    <a href="' . $viewUrl . '" target="_blank" class="btn btn-outline-info" title="Preview Public Site">
                        <i class="fas fa-eye"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger" onclick="deletePanchayat(' . $row->id . ')" title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['location', 'status', 'places_count', 'action'])
            ->make(true);
    }

    return view('admin.panchayats.index');
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get blocks to populate the select dropdown in the view
        $blocks = Block::all();
        return view('admin.panchayats.create', compact('blocks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'block_id' => 'required|exists:blocks,id',
            'name' => 'required|string|max:255',
            // Unique check for creation
            'panchayat_id' => 'required|unique:panchayats,panchayat_id',
            'status' => 'required|in:pending,active,suspended',
        ]);

        Panchayat::create($request->all());

        return redirect()->route('admin.panchayats.index')->with('success', 'Panchayat Created Successfully.');
    }

    /**
     * Display the specified resource.
     * Useful for your "viewPanchayatDetails" modal via AJAX
     */
    public function show($id)
    {
        $panchayat = Panchayat::with('block.district')->findOrFail($id);

        // If the request comes from AJAX (your view modal), return JSON
        if (request()->wantsJson()) {
            return response()->json($panchayat);
        }

        return view('admin.panchayats.show', compact('panchayat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $panchayat = Panchayat::findOrFail($id);
        $blocks = Block::all();

        return view('admin.panchayats.edit', compact('panchayat', 'blocks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $panchayat = Panchayat::findOrFail($id);

        $request->validate([
            'block_id' => 'required|exists:blocks,id',
            'name' => 'required|string|max:255',
            // Ignore the current ID during unique check
            'panchayat_id' => ['required', Rule::unique('panchayats')->ignore($panchayat->id)],
            'status' => 'required|in:pending,active,suspended',
        ]);

        $panchayat->update($request->all());

        return redirect()->route('admin.panchayats.index')->with('success', 'Panchayat Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $panchayat = Panchayat::findOrFail($id);
        $panchayat->delete();

        // If AJAX request (e.g., from SweetAlert or simple JS), return JSON
        if (request()->ajax()) {
            return response()->json(['success' => 'Panchayat deleted successfully.']);
        }

        return redirect()->route('admin.panchayats.index')->with('success', 'Panchayat Deleted Successfully.');
    }
}
