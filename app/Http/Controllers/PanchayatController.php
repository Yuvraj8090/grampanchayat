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
        // Eager load everything needed for the table
        $data = Panchayat::with(['block.district'])->select('panchayats.*');
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('location', function($row){
                $district = $row->block->district->name ?? 'N/A';
                $block = $row->block->name ?? 'N/A';
                return "<strong>$district</strong> <i class='fas fa-angle-right mx-1'></i> $block";
            })
            ->editColumn('status', function($row){
                $class = match($row->status) {
                    'active' => 'bg-success',
                    'suspended' => 'bg-danger',
                    default => 'bg-warning text-dark'
                };
                return '<span class="badge '.$class.'">'.ucfirst($row->status).'</span>';
            })
            ->addColumn('action', function($row){
                // Route for basic panchayat info (ID, Block, etc)
                $editUrl = route('admin.panchayats.edit', $row->id);
                // Route for the Website/Pradhan Message details
                $sitedetailsUrl = route('admin.panchayat.details.edit', $row->id);
                // Public View URL
                $viewUrl = route('public.panchayat.show', $row->id);
                
                return '
                    <div class="d-flex gap-2">
                        <a href="'.$editUrl.'" class="btn btn-sm btn-outline-primary" title="Edit Panchayat Settings">
                            <i class="fas fa-cog"></i>
                        </a>
                        
                        <a href="'.$sitedetailsUrl.'" class="btn btn-sm btn-outline-success" title="Edit Website Details">
                            <i class="fas fa-laptop-house"></i>
                        </a>

                        <a href="'.$viewUrl.'" target="_blank" class="btn btn-sm btn-outline-info" title="View Public Website">
                            <i class="fas fa-external-link-alt"></i>
                        </a>

                        <button class="btn btn-sm btn-outline-danger" onclick="deletePanchayat('.$row->id.')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
            })
            ->rawColumns(['location', 'status', 'action']) // 'location' now has HTML (icon)
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

        return redirect()
            ->route('admin.panchayats.index')
            ->with('success', 'Panchayat Created Successfully.');
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

        return redirect()
            ->route('admin.panchayats.index')
            ->with('success', 'Panchayat Updated Successfully.');
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

        return redirect()
            ->route('admin.panchayats.index')
            ->with('success', 'Panchayat Deleted Successfully.');
    }
}