<?php

namespace App\Http\Controllers;
use App\Media;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserGallery extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $photo = Media::where('user_id', '=', $user->id)->where('gallery', '=', 1)->get();

        return view('user.admin.gallery.index', compact('photo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image_name' => 'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $user = Auth::user();

        $input = $request->all();

        $file = $request->file('image');

        $name = rand() . '.' . $file->getClientOriginalExtension();

        $file->move('images', $name);

        Media::create([

            'user_id' => $user->id,
            'image' => $name,
            'alt' => $input['image_name'],
            'gallery' => 1,

        ]);

        Session::flash('insert', 'Successfully Uploaded');

        return redirect()->route('user-gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Media::findOrFail($id)->delete();

        return redirect()->back();
    }
}
