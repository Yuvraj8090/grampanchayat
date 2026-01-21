<?php

namespace App\Http\Controllers;
use App\Video;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserVideo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $video = Video::where('user_id', '=', $user->id)->get();

        return view('user.admin.video.index', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.video.create');
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
            'title' => 'required',
            'url' => 'required',
            'about' => 'required',
        ]);

        $input = $request->all();

        $user = Auth::user();

        Video::create(['user_id'=>$user->id,'title'=>$input['title'],'url'=>$input['url'],'about'=>$input['about']]);

        Session::flash('insert', 'Successfully Uploaded');

        return redirect()->route('user-video.index');
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
        $video = Video::findOrFail($id);

        return view('user.admin.video.edit', compact('video'));
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
            'title' => 'required',
            'url' => 'required',
            'about' => 'required',
        ]);

        $input = $request->all();

        Video::findOrFail($id)->update(['title'=>$input['title'],'url'=>$input['url'],'about'=>$input['about']]);

        return redirect()->route('user-video.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::findOrFail($id)->delete();

        return redirect()->route('user-video.index');
    }
}
