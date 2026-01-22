<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\District;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlockController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Block::with('district')->select('blocks.*');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('district_name', fn($row) => $row->district->name)
                ->addColumn('action', function($row){
                    return '
                        <div class="d-flex gap-2">
                            <a href="'.route('admin.blocks.edit', $row->id).'" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="'.route('admin.blocks.destroy', $row->id).'" method="POST" onsubmit="return confirm(\'Are you sure?\')">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>';
                })
                ->make(true);
        }
        return view('admin.blocks.index');
    }

    public function create()
    {
        $districts = District::active()->get();
        return view('admin.blocks.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
            'block_code' => 'required|unique:blocks,block_code',
        ]);

        Block::create($request->all());
        return redirect()->route('admin.blocks.index')->with('success', 'Block added.');
    }
}