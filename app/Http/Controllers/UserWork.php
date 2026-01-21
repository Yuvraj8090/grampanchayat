<?php

namespace App\Http\Controllers;
use App\Work;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserWork extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $work = Work::where('user_id', '=', $user->id)->get();

        return view('user.admin.work.index', compact('work'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.work.create');
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
            'y_name' => 'required',
            'year' => 'required',
            'price' => 'required',
            'place' => 'required',
            'oldimage' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            'newimage' => 'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $user = Auth::user();

        $input = $request->all();

        $file1 = $request->file('oldimage');

        $name1 = rand() . '.' . $file1->getClientOriginalExtension();

        $file1->move('images', $name1);

        $file2 = $request->file('newimage');

        $name2 = rand() . '.' . $file2->getClientOriginalExtension();

        $file2->move('images', $name2);

        Work::create([

            'user_id' => $user->id,
            'name' => $input['name'],
            'about' => $input['about'],
            'y_name' => $input['y_name'],
            'year' => $input['year'],
            'price' => $input['price'],
            'place' => $input['place'],
            'oldimage' => $name1,
            'newimage' => $name2,

        ]);

        Session::flash('insert', 'Successfully Uploaded');

        return redirect()->route('user-work.index');
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
        $work = Work::findOrFail($id);

        return view('user.admin.work.edit', compact('work'));
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
            'y_name' => 'required',
            'year' => 'required',
            'price' => 'required',
            'place' => 'required',
            'oldimage' => 'image|mimes:jpeg,png,jpg|max:2000',
            'newimage' => 'image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $user = Auth::user();

        $input = $request->all();

        if ($file1 = $request->file('oldimage')) 
        {
            $name1 = rand() . '.' . $file1->getClientOriginalExtension();

            $file1->move('images', $name1);

            Work::findOrFail($id)->update(['oldimage' => $name1]);
        }
        elseif ($file = $request->file('newimage')) 
        {
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

            Work::findOrFail($id)->update(['newimage' => $name]);
        }
          
            Work::findOrFail($id)->update([

                'name' => $input['name'],
                'about' => $input['about'],
                'y_name' => $input['y_name'],
                'year' => $input['year'],
                'price' => $input['price'],
                'place' => $input['place'],

            ]);
       

        

        Session::flash('insert', 'Successfully Updated');

        return redirect()->route('user-work.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Work::findOrFail($id)->delete();

        return redirect()->route('user-work.index');
    }
}
