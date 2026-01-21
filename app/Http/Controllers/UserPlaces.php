<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Place;
use Illuminate\Http\Request;

class UserPlaces extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $place = Place::where('user_id', '=', $user->id)->where('intro', '=', null)->get();

        return view('user.admin.place.index', compact('place'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.place.create');
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
            'name' => 'required',
            'about' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $user = Auth::user();

        $input = $request->all();

        $file = $request->file('image');

        $name = rand() . '.' . $file->getClientOriginalExtension();

        $file->move('images', $name);

        Place::create([

            'user_id' => $user->id,
            'name' => $input['name'],
            'about' => $input['about'],
            'image' => $name,

        ]);

        Session::flash('insert', 'Successfully Uploaded');

        return redirect()->route('user-places.index');
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
        $place = Place::findOrFail($id);

        return view('user.admin.place.edit', compact('place'));
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
        $this->validate($request, [
            'name' => 'required',
            'about' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $input = $request->all();

        if ($file = $request->file('image')) 
        {
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

            Place::findOrFail($id)->update([

                'name' => $input['name'],
                'about' => $input['about'],
                'image' => $name,

            ]);
        }
        else
        {
            Place::findOrFail($id)->update([

                'name' => $input['name'],
                'about' => $input['about'],
            ]);
        }
        

        Session::flash('insert', 'Successfully Updated');

        return redirect()->route('user-places.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Place::findOrFail($id)->delete();

        return redirect()->back();
    }
}
