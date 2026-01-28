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
            $data = $panchayat->members()->orderBy('order_by', 'asc')->getQuery();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('photo_display', function ($row) {
                    if ($row->image) {
                        $url = asset('storage/' . $row->image);
                        return '<img src="' . $url . '" class="rounded shadow-sm border" width="45" height="45" style="object-fit:cover;">';
                    }
                    return '<div class="bg-light rounded d-inline-block border text-center text-muted" style="width:45px; height:45px; line-height:45px;"><i class="fas fa-user"></i></div>';
                })
                ->addColumn('status_badge', function ($row) {
                    $class = $row->status === 'active' ? 'bg-success' : 'bg-secondary';
                    return '<span class="badge ' . $class . ' px-2">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('action', function ($row) use ($panchayat) {
                    $editUrl = route('admin.panchayats.members.edit', [$panchayat->id, $row->id]);
                    $deleteUrl = route('admin.panchayats.members.destroy', [$panchayat->id, $row->id]);

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

        return view('admin.panchayat_members.index', compact('panchayat'));
    }

    public function create(Panchayat $panchayat)
    {
        return view('admin.panchayat_members.create', compact('panchayat'));
    }

    public function store(Request $request, Panchayat $panchayat)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'ward_no'     => 'nullable|string|max:100',
            'phone'       => 'nullable|string|max:20',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order_by'    => 'nullable|integer',
            'status'      => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('photo')) {
            $validated['image'] = $request->file('photo')->store('panchayat_members', 'public');
        }

        $panchayat->members()->create($validated);

        return redirect()->route('admin.panchayats.members.index', $panchayat->id)
            ->with('success', 'Member added successfully!');
    }

    public function edit(Panchayat $panchayat, PanchayatMember $member)
    {
        abort_if($member->panchayat_id !== $panchayat->id, 403);

        // We pass it as 'business' only if your edit blade specifically uses $business
        // But the correct way is to use $member. I am using $business below to match your blade.
        return view('admin.panchayat_members.edit', [
            'panchayat' => $panchayat,
            'business' => $member 
        ]);
    }

    public function update(Request $request, Panchayat $panchayat, PanchayatMember $member)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'ward_no'     => 'nullable|string|max:100',
            'phone'       => 'nullable|string|max:20',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order_by'    => 'nullable|integer',
            'status'      => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('photo')) {
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
            }
            $validated['image'] = $request->file('photo')->store('panchayat_members', 'public');
        }

        $member->update($validated);

        return redirect()->route('admin.panchayats.members.index', $panchayat->id)
            ->with('success', 'Member updated successfully!');
    }

    public function destroy(Panchayat $panchayat, PanchayatMember $member)
    {
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }

        $member->delete();

        return back()->with('success', 'Member removed successfully!');
    }
}