<?php

namespace App\Http\Controllers;

use App\Models\Panchayat;
use App\Models\PanchayatMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PanchayatMemberController extends Controller
{
    public function index(Request $request, Panchayat $panchayat)
    {
        if ($request->ajax()) {
            $data = $panchayat->members()->latest()->getQuery();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('photo_display', function ($row) {
                    if ($row->image) {
                        $url = asset('storage/' . $row->image);
                        return '<img src="' . $url . '" class="rounded shadow-sm border" width="45" height="45" style="object-fit:cover;">';
                    }
                    return '<div class="bg-light rounded d-inline-block border text-center text-muted" style="width:45px; height:45px; line-height:45px;"><i class="fas fa-image"></i></div>';
                })
                ->addColumn('status_badge', function ($row) {
                    $class = $row->status === 'active' ? 'bg-success' : 'bg-secondary';
                    return '<span class="badge ' . $class . ' px-2">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('action', function ($row) use ($panchayat) {
                    $editUrl = route('admin.panchayats.businesses.edit', [$panchayat->id, $row->id]);
                    $deleteUrl = route('admin.panchayats.businesses.destroy', [$panchayat->id, $row->id]);

                    return '
                    <div class="btn-group btn-group-sm">
                        <a href="' . $editUrl . '" class="btn btn-outline-primary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-outline-danger" onclick="handleDelete(\'' . $deleteUrl . '\')" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['photo_display', 'status_badge', 'action'])
                ->make(true);
        }

        return view('admin.panchayat_businesses.index', compact('panchayat'));
    }
}
