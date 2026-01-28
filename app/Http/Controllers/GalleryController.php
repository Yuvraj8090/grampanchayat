<?php

namespace App\Http\Controllers;

use App\Models\Panchayat;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    // List & DataTables JSON
    public function index(Request $request, $panchayatId)
    {
        $panchayat = Panchayat::findOrFail($panchayatId);

        if ($request->ajax()) {
            $data = $panchayat->galleries()->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('media_display', function ($row) {
                    $url = asset('storage/' . $row->path);
                    return '<img src="' . $url . '" class="rounded border shadow-sm" width="60" height="45" style="object-fit:cover;">';
                })
                ->addColumn('type_badge', function ($row) {
                    return '<span class="badge bg-info">Image</span>';
                })
                ->addColumn('featured_status', function ($row) {
                    return $row->is_featured 
                        ? '<span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i> Featured</span>' 
                        : '<span class="badge bg-light text-dark border">Standard</span>';
                })
                ->addColumn('action', function ($row) use ($panchayatId) {
                    // Update Route for the Form
                    $updateUrl = route('admin.panchayats.gallery.update', ['panchayat' => $panchayatId, 'id' => $row->id]);
                    $deleteUrl = route('admin.panchayats.gallery.destroy', ['panchayat' => $panchayatId, 'id' => $row->id]);
                    
                    // We pass data to the modal using data-attributes
                    return '
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" 
                                    class="btn btn-sm btn-outline-primary edit-btn"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editGalleryModal"
                                    data-url="' . $updateUrl . '"
                                    data-caption="' . htmlspecialchars($row->caption) . '"
                                    data-featured="' . $row->is_featured . '">
                                <i class="fas fa-edit"></i>
                            </button>

                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Delete this image?\')">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>';
                })
                ->rawColumns(['media_display', 'type_badge', 'featured_status', 'action'])
                ->make(true);
        }

        return view('admin.gallery.index', compact('panchayat'));
    }

    // Store (Bulk Upload)
    public function store(Request $request, $panchayatId)
    {
        $request->validate([
            'files.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'caption' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('panchayat_galleries/' . $panchayatId, 'public');
                
                Gallery::create([
                    'panchayat_id' => $panchayatId,
                    'path' => $path,
                    'caption' => $request->caption,
                    'type' => 'image',
                    'is_featured' => $request->has('is_featured')
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    // Update (Called via Modal)
    public function update(Request $request, $panchayatId, $id)
    {
        $galleryItem = Gallery::where('panchayat_id', $panchayatId)->findOrFail($id);

        $request->validate([
            'caption' => 'nullable|string|max:255',
            'status'  => 'required|in:standard,featured',
        ]);

        $galleryItem->update([
            'caption' => $request->caption,
            'is_featured' => $request->status === 'featured' ? 1 : 0,
        ]);

        return back()->with('success', 'Image details updated!');
    }

    // Destroy
    public function destroy($panchayatId, $id)
    {
        $item = Gallery::where('panchayat_id', $panchayatId)->findOrFail($id);
        
        if ($item->path) {
            Storage::disk('public')->delete($item->path);
        }
        
        $item->delete();

        return back()->with('success', 'Media removed from gallery.');
    }
}