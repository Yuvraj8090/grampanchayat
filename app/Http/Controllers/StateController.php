<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = State::select(['id', 'name', 'state_code', 'is_active']);
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('is_active', function ($row) {
                    return $row->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-outline-primary editState">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-outline-danger deleteState">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }
        return view('admin.states.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:states,name,' . $request->state_id,
            'state_code' => 'required|string|max:10|unique:states,state_code,' . $request->state_id,
        ]);

        State::updateOrCreate(
            ['id' => $request->state_id],
            [
                'name' => $request->name,
                'state_code' => $request->state_code,
                'is_active' => true,
            ]
        );

        // ✅ Returns JSON: { "success": "State saved successfully." }
        return response()->json(['success' => 'State saved successfully.']);
    }

    public function edit($id)
    {
        $state = State::findOrFail($id);
        return response()->json($state);
    }

    public function destroy($id)
    {
        $state = State::findOrFail($id);
        
        // Check relationships
        if($state->districts()->count() > 0){
            // ✅ Returns JSON Error: { "error": "Cannot delete state..." }
            return response()->json(['error' => 'Cannot delete state. It has associated districts.'], 422);
        }

        $state->delete();
        // ✅ Returns JSON Success: { "success": "State deleted successfully." }
        return response()->json(['success' => 'State deleted successfully.']);
    }
}