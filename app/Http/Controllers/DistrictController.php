<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\State; // Import State Model
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Eager load 'state' to get the state name efficiently
            $data = District::with('state')->select('districts.*');

            return DataTables::of($data)
                ->addIndexColumn()
                // Add State Name Column
                ->addColumn('state_name', function ($row) {
                    return $row->state->name ?? 'N/A';
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-outline-primary editDistrict">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-outline-danger deleteDistrict">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }

        // Fetch active states for the modal dropdown
        $states = State::active()->get();
        return view('admin.districts.index', compact('states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'state_id'      => 'required|exists:states,id',
            'name'          => 'required|string|max:255|unique:districts,name,' . $request->district_id,
            'district_code' => 'required|string|unique:districts,district_code,' . $request->district_id,
        ]);

        District::updateOrCreate(
            ['id' => $request->district_id],
            [
                'state_id'      => $request->state_id,
                'name'          => $request->name,
                'district_code' => $request->district_code,
                'is_active'     => true,
            ]
        );

        return response()->json(['success' => 'District saved successfully.']);
    }

    public function edit($id)
    {
        $district = District::findOrFail($id);
        return response()->json($district);
    }

    public function destroy($id)
    {
        District::findOrFail($id)->delete();
        return response()->json(['success' => 'District deleted successfully.']);
    }
}