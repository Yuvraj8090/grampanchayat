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
            // High speed eager loading: Panchayat -> Block -> District
            $data = Panchayat::with('block.district')->select('panchayats.*');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('location', function($row){
                    // Ensure relations exist to avoid errors
                    $district = $row->block->district->name ?? 'N/A';
                    $block = $row->block->name ?? 'N/A';
                    return $district . ' > ' . $block;
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
                    // Added Delete button to the actions
                    $editUrl = route('admin.panchayats.edit', $row->id);
                    // Use a form or dedicated JS for delete to prevent CSRF issues, 
                    // here is a simple button setup for your existing JS structure.
                    return '
                        <div class="d-flex gap-2">
                            <a href="'.$editUrl.'" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-outline-info" onclick="viewPanchayatDetails('.$row->id.')"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deletePanchayat('.$row->id.')"><i class="fas fa-trash"></i></button>
                        </div>';
                })
                ->rawColumns(['status', 'action'])
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