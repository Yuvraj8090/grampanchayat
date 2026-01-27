<?php

namespace App\Http\Controllers;

use App\Models\Panchayat;
use App\Models\PanchayatDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanchayatDetailController extends Controller
{
    // Show the Form to Edit Details
    public function edit($panchayatId)
    {
        $panchayat = Panchayat::findOrFail($panchayatId);
        
        // Get existing details or create an empty instance
        $details = PanchayatDetail::firstOrNew(['panchayat_id' => $panchayatId]);

        return view('admin.panchayat_details.edit', compact('panchayat', 'details'));
    }

    // Save the Data
    public function update(Request $request, $panchayatId)
    {
        $request->validate([
            'pradhan_name' => 'required|string|max:255',
            'pradhan_image' => 'nullable|image|max:2048', // Max 2MB
            'total_population' => 'required|integer',
        ]);

        $data = $request->except(['_token', 'pradhan_image']);

        // Handle Image Upload
        if ($request->hasFile('pradhan_image')) {
            $path = $request->file('pradhan_image')->store('pradhans', 'public');
            $data['pradhan_image'] = $path;
        }

        // Save using updateOrCreate to ensure one record per Panchayat
        PanchayatDetail::updateOrCreate(
            ['panchayat_id' => $panchayatId],
            $data
        );

        return back()->with('success', 'Website details updated successfully!');
    }
}