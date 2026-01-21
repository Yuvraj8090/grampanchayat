<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\ListName;
use Illuminate\Http\Request;

class UserList extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $list = ListName::where('user_id', '=', $user->id)->get();

        return view('user.admin.list.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.list.create');
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
            'position' => 'required',
            'block' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $user = Auth::user();

        $input = $request->all();

        if ($input['position'] == "प्रधान") 
        {
            $check = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->count();

            if ($check > 0) 
            {
                Session::flash('insert', "You Can't be प्रधान");

                return redirect()->back();
            }
            else
            {
                $file = $request->file('image');

                $name = rand() . '.' . $file->getClientOriginalExtension();

                $file->move('images', $name);

                ListName::create([

                    'user_id' => $user->id,
                    'name' => $input['name'],
                    'position' => $input['position'],
                    'block' => $input['block'],
                    'phone' => $input['phone'],
                    'image' => $name,

                ]);

                Session::flash('insert', 'Successfully Uploaded');

                return redirect()->route('user-list.index');
      
            }
        }
        else
        {
            $file = $request->file('image');

            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

            ListName::create([

                'user_id' => $user->id,
                'name' => $input['name'],
                'position' => $input['position'],
                'block' => $input['block'],
                'phone' => $input['phone'],
                'image' => $name,

            ]);

            Session::flash('insert', 'Successfully Uploaded');

            return redirect()->route('user-list.index');
        }

        

       
        
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
        $list = ListName::findOrFail($id);

        return view('user.admin.list.edit', compact('list'));
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
            'position' => 'required',
            'block' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $input = $request->all();

        if ($file = $request->file('image')) 
        {
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

            ListName::findOrFail($id)->update([

                'name' => $input['name'],
                'position' => $input['position'],
                'block' => $input['block'],
                'phone' => $input['phone'],
                'image' => $name,

            ]);
        }
        else
        {
            ListName::findOrFail($id)->update([

                'name' => $input['name'],
                'position' => $input['position'],
                'block' => $input['block'],
                'phone' => $input['phone'],
                
            ]);
        }

        Session::flash('insert', 'Successfully Updated');

        return redirect()->route('user-list.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ListName::findOrFail($id)->delete();

        return redirect()->back();
    }
}
