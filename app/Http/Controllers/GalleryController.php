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
                    if ($row->type === 'video') {
                        // Show YouTube Thumbnail
                        $thumbUrl = "https://img.youtube.com/vi/{$row->path}/mqdefault.jpg";
                        return '<div class="position-relative" style="width:60px; height:45px;">
                                    <img src="' . $thumbUrl . '" class="rounded border shadow-sm w-100 h-100" style="object-fit:cover;">
                                    <div class="position-absolute top-50 start-50 translate-middle text-white" style="font-size:10px;">
                                        <i class="fas fa-play-circle fa-2x opacity-75"></i>
                                    </div>
                                </div>';
                    } else {
                        // Show Uploaded Image
                        $url = asset('storage/' . $row->path);
                        return '<img src="' . $url . '" class="rounded border shadow-sm" width="60" height="45" style="object-fit:cover;">';
                    }
                })
                ->addColumn('type_badge', function ($row) {
                    if ($row->type === 'video') {
                        return '<span class="badge bg-danger"><i class="fab fa-youtube me-1"></i> Video</span>';
                    }
                    return '<span class="badge bg-info">Image</span>';
                })
                ->addColumn('featured_status', function ($row) {
                    return $row->is_featured 
                        ? '<span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i> Featured</span>' 
                        : '<span class="badge bg-light text-dark border">Standard</span>';
                })
                ->addColumn('action', function ($row) use ($panchayatId) {
                    $updateUrl = route('admin.panchayats.gallery.update', ['panchayat' => $panchayatId, 'id' => $row->id]);
                    $deleteUrl = route('admin.panchayats.gallery.destroy', ['panchayat' => $panchayatId, 'id' => $row->id]);
                    
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

                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Delete this media?\')">
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

    // Store (Handle Both Images and YouTube Videos)
    public function store(Request $request, $panchayatId)
    {
        $request->validate([
            'media_type' => 'required|in:image,video',
            'caption'    => 'nullable|string|max:255',
            // Validate image OR video url conditionally
            'files.*'    => 'required_if:media_type,image|image|mimes:jpeg,png,jpg,webp|max:5120',
            'video_url'  => 'required_if:media_type,video|url',
        ]);

        // HANDLE VIDEO UPLOAD
        if ($request->media_type === 'video') {
            $youtubeId = $this->extractYoutubeId($request->video_url);

            if ($youtubeId) {
                Gallery::create([
                    'panchayat_id' => $panchayatId,
                    'path'         => $youtubeId, // Store only the ID (e.g., l8Jb5oHgDPg)
                    'caption'      => $request->caption,
                    'type'         => 'video',
                    'is_featured'  => $request->has('is_featured')
                ]);
            } else {
                return back()->withErrors(['video_url' => 'Invalid YouTube URL provided.']);
            }
        } 
        
        // HANDLE IMAGE UPLOAD
        elseif ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('panchayat_galleries/' . $panchayatId, 'public');
                
                Gallery::create([
                    'panchayat_id' => $panchayatId,
                    'path'         => $path, // Store full storage path
                    'caption'      => $request->caption,
                    'type'         => 'image',
                    'is_featured'  => $request->has('is_featured')
                ]);
            }
        }

        return back()->with('success', 'Gallery updated successfully!');
    }

    // Helper to extract ID from various YouTube URL formats
    private function extractYoutubeId($url)
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }

    // Update
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

        return back()->with('success', 'Media details updated!');
    }

    // Destroy
    public function destroy($panchayatId, $id)
    {
        $item = Gallery::where('panchayat_id', $panchayatId)->findOrFail($id);
        
        // Only delete file if it's an image
        if ($item->type === 'image' && $item->path) {
            Storage::disk('public')->delete($item->path);
        }
        
        $item->delete();

        return back()->with('success', 'Media removed from gallery.');
    }
}