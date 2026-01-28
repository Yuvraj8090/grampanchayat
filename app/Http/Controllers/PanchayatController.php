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
            // Eager load relationships and count all related entities in one go
            $data = Panchayat::with(['block.district'])
                ->withCount(['places', 'businesses', 'members'])
                ->select('panchayats.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('location', function ($row) {
                    $district = $row->block->district->name ?? 'N/A';
                    $block = $row->block->name ?? 'N/A';
                    return "<strong>$district</strong> <i class='fas fa-angle-double-right mx-1 text-muted'></i> $block";
                })
                ->editColumn('status', function ($row) {
                    $statusMap = [
                        'active'    => 'bg-success',
                        'suspended' => 'bg-danger',
                        'pending'   => 'bg-warning text-dark',
                    ];
                    $class = $statusMap[$row->status] ?? 'bg-secondary';
                    return '<span class="badge ' . $class . ' shadow-sm px-2">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('stats', function ($row) {
                    // Combined stats column for a cleaner table look
                    return '
                    <small class="d-block"><i class="fas fa-users text-primary me-1"></i> Members: ' . $row->members_count . '</small>
                    <small class="d-block"><i class="fas fa-map-marked-alt text-info me-1"></i> Places: ' . $row->places_count . '</small>
                    <small class="d-block"><i class="fas fa-store text-success me-1"></i> Business: ' . $row->businesses_count . '</small>
                ';
                })
                ->addColumn('action', function ($row) {
                    // Define routes clearly
                    $routes = [
                        'members'  => route('admin.panchayats.members.index', $row->id),
                        'places'   => route('admin.panchayats.places.index', $row->id),
                        'business' => route('admin.panchayats.businesses.index', $row->id),
                        'gallery'  => route('admin.panchayats.gallery.index', $row->id),
                        'details'  => route('admin.panchayat.details.edit', $row->id),
                        'edit'     => route('admin.panchayats.edit', $row->id),
                        'view'     => route('public.panchayat.show', $row->id),
                    ];

                    return '
                <div class="btn-group btn-group-sm shadow-sm" role="group">
                    <a href="' . $routes['members'] . '" class="btn btn-outline-dark" title="Manage Members">
                        <i class="fas fa-users-cog"></i>
                    </a>
                    <a href="' . $routes['places'] . '" class="btn btn-outline-dark" title="Tourist Places">
                        <i class="fas fa-map-signs"></i>
                    </a>
                    <a href="' . $routes['business'] . '" class="btn btn-outline-dark" title="Local Businesses">
                        <i class="fas fa-shuttle-van"></i>
                    </a>
                    <a href="' . $routes['gallery'] . '" class="btn btn-outline-dark" title="Photo Gallery">
                        <i class="fas fa-camera-retro"></i>
                    </a>
                    <a href="' . $routes['details'] . '" class="btn btn-outline-success" title="Website/Pradhan Details">
                        <i class="fas fa-file-invoice"></i>
                    </a>
                    <a href="' . $routes['edit'] . '" class="btn btn-outline-primary" title="General Settings">
                        <i class="fas fa-cog"></i>
                    </a>
                    <a href="' . $routes['view'] . '" target="_blank" class="btn btn-outline-info" title="View Public Profile">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger" onclick="deletePanchayat(' . $row->id . ')" title="Delete Panchayat">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>';
                })
                ->rawColumns(['location', 'status', 'stats', 'action'])
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
