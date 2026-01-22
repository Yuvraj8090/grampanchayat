<?php

namespace App\Http\Controllers;

use App\Models\Panchayat;
use App\Models\Block;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PanchayatController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // High speed eager loading: Panchayat -> Block -> District
            $data = Panchayat::with('block.district')->select('panchayats.*');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('location', function($row){
                    return $row->block->district->name . ' > ' . $row->block->name;
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
                    return '
                        <div class="d-flex gap-2">
                            <a href="'.route('admin.panchayats.edit', $row->id).'" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-outline-info" onclick="viewPanchayatDetails('.$row->id.')"><i class="fas fa-eye"></i></button>
                        </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.panchayats.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'block_id' => 'required|exists:blocks,id',
            'name' => 'required|string|max:255',
            'panchayat_id' => 'required|unique:panchayats,panchayat_id',
            'status' => 'required|in:pending,active,suspended',
        ]);

        Panchayat::create($request->all());
        return redirect()->route('admin.panchayats.index')->with('success', 'Panchayat ID Generated Successfully.');
    }
}