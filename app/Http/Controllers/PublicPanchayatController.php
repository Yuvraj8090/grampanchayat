<?php

namespace App\Http\Controllers;

use App\Models\Panchayat;
use App\Models\PanchayatDetail;
use Illuminate\Http\Request;

class PublicPanchayatController extends Controller
{
    public function show($id)
{
    // 1. Fetch Panchayat with the full chain (Block -> District -> State)
    // We use "Dot Notation" to load nested relationships.
    $panchayat = Panchayat::with(['block.district.state'])->findOrFail($id);

    // 2. Fetch CMS Details
    $details = PanchayatDetail::where('panchayat_id', $id)->firstOrNew();

    return view('public.panchayat_home', compact('panchayat', 'details'));
}
    public function pradhanMessage($panchayatid)
{
    // 1. Fetch Panchayat with the full chain (Block -> District -> State)
    // We use "Dot Notation" to load nested relationships.
    $panchayat = Panchayat::with(['block.district.state'])->findOrFail($panchayatid);

    // 2. Fetch CMS Details
    $details = PanchayatDetail::where('panchayat_id', $panchayatid)->firstOrNew();

    return view('public.panchayat_home_pradhan_message', compact('panchayat', 'details'));
}
    public function touristPlaces($panchayatid)
{
    // 1. Fetch Panchayat with the full chain (Block -> District -> State)
    // We use "Dot Notation" to load nested relationships.
    $panchayat = Panchayat::with(['block.district.state'])->findOrFail($panchayatid);

    // 2. Fetch CMS Details
    $details = PanchayatDetail::where('panchayat_id', $panchayatid)->firstOrNew();
    $places = $panchayat->places()->latest();


    return view('public.panchayat_tourist_places', compact('panchayat', 'details','places'));
}
public function gallery($panchayatid)
{
    $panchayat = Panchayat::with(['block.district.state'])->findOrFail($panchayatid);
    $details = PanchayatDetail::where('panchayat_id', $panchayatid)->firstOrNew();

    // PERFORMANCE FIX: Use paginate(24) instead of get().
    // This loads only 24 images per page.
    $galleries = $panchayat->galleries()
        ->where('type', 'image')
        ->latest()
        ->paginate(24); 

    return view('public.panchayat_gallery', compact('panchayat', 'details', 'galleries'));
}
public function video($panchayatid)
{
    $panchayat = Panchayat::with(['block.district.state'])->findOrFail($panchayatid);
    $details = PanchayatDetail::where('panchayat_id', $panchayatid)->firstOrNew();

    // PERFORMANCE FIX: Use paginate(24) instead of get().
    // This loads only 24 images per page.
    $galleries = $panchayat->galleries()
        ->where('type', 'image')
        ->latest()
        ->paginate(24); 

    return view('public.panchayat_gallery', compact('panchayat', 'details', 'galleries'));
}

}