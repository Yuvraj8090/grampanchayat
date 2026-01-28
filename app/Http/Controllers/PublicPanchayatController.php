<?php

namespace App\Http\Controllers;

use App\Models\Panchayat;
use App\Models\PanchayatDetail;
use Illuminate\Http\Request;

class PublicPanchayatController extends Controller
{
    public function show($id)
    {
        $panchayat = Panchayat::with(['block.district.state'])->findOrFail($id);
        $details = PanchayatDetail::where('panchayat_id', $id)->firstOrNew();
        return view('public.panchayat_home', compact('panchayat', 'details'));
    }

    public function pradhanMessage($panchayatid)
    {
        $panchayat = Panchayat::with(['block.district.state'])->findOrFail($panchayatid);
        $details = PanchayatDetail::where('panchayat_id', $panchayatid)->firstOrNew();
        return view('public.panchayat_home_pradhan_message', compact('panchayat', 'details'));
    }

    public function touristPlaces($panchayatid)
    {
        $panchayat = Panchayat::with(['block.district.state'])->findOrFail($panchayatid);
        $details = PanchayatDetail::where('panchayat_id', $panchayatid)->firstOrNew();
        $places = $panchayat->places()->latest()->get(); // Changed to get() if you aren't paginating places

        return view('public.panchayat_tourist_places', compact('panchayat', 'details', 'places'));
    }
    public function business($panchayatid)
    {
        $panchayat = Panchayat::with(['block.district.state'])->findOrFail($panchayatid);
        $details = PanchayatDetail::where('panchayat_id', $panchayatid)->firstOrNew();
       $business = $panchayat->businesses()->latest()->get(); // Changed to get() if you aren't paginating places

        return view('public.panchayat_business', compact('panchayat', 'details', 'business'));
    }

    // 1. PHOTO GALLERY ROUTE
    public function gallery($panchayatid)
    {
        $panchayat = Panchayat::with(['block.district.state'])->findOrFail($panchayatid);
        $details = PanchayatDetail::where('panchayat_id', $panchayatid)->firstOrNew();

        // Fetch IMAGES only
        $galleries = $panchayat->galleries()
            ->where('type', 'image')
            ->latest()
            ->paginate(24); 

        // Dynamic Title for Photos
        $pageTitle = 'चित्र दीर्घा';
        $pageDesc = 'ग्राम पंचायत के विकास कार्यों और प्राकृतिक सुंदरता की तस्वीरें।';

        return view('public.panchayat_gallery', compact('panchayat', 'details', 'galleries', 'pageTitle', 'pageDesc'));
    }

    // 2. VIDEO GALLERY ROUTE
    public function video($panchayatid)
    {
        $panchayat = Panchayat::with(['block.district.state'])->findOrFail($panchayatid);
        $details = PanchayatDetail::where('panchayat_id', $panchayatid)->firstOrNew();

        // Fetch VIDEOS only
        $galleries = $panchayat->galleries()
            ->where('type', 'video')
            ->latest()
            ->paginate(24); 

        // Dynamic Title for Videos
        $pageTitle = 'वीडियो गैलरी';
        $pageDesc = 'ग्राम पंचायत के प्रमुख कार्यक्रमों और आयोजनों के वीडियो।';

        return view('public.panchayat_gallery', compact('panchayat', 'details', 'galleries', 'pageTitle', 'pageDesc'));
    }
}