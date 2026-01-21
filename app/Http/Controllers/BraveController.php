<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Brave,User};
use Exception;
use Illuminate\Support\Facades\DB;

class BraveController extends Controller
{
    public function index(Request $request)
    {
        $data = Brave::query();
        $data->with('user:id,name,hindi');
        
        if($request->search){
            $data->where('user_id',$request->search);
        }
        $data->orderBy('id', 'DESC');
        
        $data = $data->paginate('50');
        
        $users = User::get();
          
        return view('admin.brave.index', compact('data','users'));
    }

    public function create()
    {   
        $users = User::where('role_id', '2')->get();
        return view('admin.brave.create',compact('users'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'user' => 'required',
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'award' => 'required',
            'reason' => 'required',
            'about' => 'required'
        ]);
        
        $data = $request->only(['name','award','reason','about']);
        $data['user_id'] = $request->user;
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move('brave', $imageName);
            $data['image'] = $imageName;
        }
    
        $res = Brave::create($data);

        if ($res) {
            return redirect()->route('bravee.index')->with('insert', 'Success! Added Successfully.');
        }
        return back()->with('insert', 'Error! Please try Again after sometime.');
    }




    public function edit($id)
    {
        $data = Brave::find($id);
        $users = User::where('role_id', '2')->get();

        return view('admin.brave.edit', compact('data','users'));
    }

    public function update1(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'image' => 'required',
            'award' => 'required',
            'reason' => 'required',
            'about' => 'required'
        ]);
        
        $data = $request->only(['name','award','reason','about']);

        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move('brave', $imageName);
            $data['image'] = $imageName;
        }
        
        $res = Brave::find($id)->update($data);

        if ($res) {
            return redirect()->route('bravee.index')->with('insert', 'Success! Updated Successfully.');
        }

        return back()->with('insert', 'Error! Please try Again after sometime.');
    }

    public function delete($id)
    {

        $res = Brave::find($id)->delete();

        if ($res) {
            return back()->with('insert', 'Succes! Deleted Successfully.');
        }

        return back()->with('insert', 'Error! Please try Again after sometime.');
    }

   
    public function show()
    {
    }
}
