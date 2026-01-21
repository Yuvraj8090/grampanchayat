<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{GovtFacility,User};
use Exception;
use Illuminate\Support\Facades\DB;

class GovtController extends Controller
{
    public function index(Request $request)
    {
        $data = GovtFacility::query();
        $data->where('user_id',auth()->user()->id);
        $data->with('user');
        
        if($request->search){
            $data->where('user_id',$request->search);
        }
        $data->orderBy('id', 'DESC');
        $data = $data->paginate('50');
        
        return view('admin.GovtFacility.index', compact('data'));
    }

    public function create()
    {   
        return view('admin.GovtFacility.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|min:10|max:500'
        ]);
        
        $data = $request->only(['name','description']);
        $data['title'] = $request->name;
        $data['user_id'] = auth()->user()->id;
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move('govt', $imageName);
            $data['image'] = $imageName;
        }
    
        $res = GovtFacility::create($data);

        if ($res) {
            return redirect()->route('govtfacility.index')->with('insert', 'Success! Added Successfully.');
        }
        return back()->with('insert', 'Error! Please try Again after sometime.');
    }




    public function edit($id)
    {
        $data = GovtFacility::where('user_id',auth()->user()->id)->find($id);
        return view('admin.GovtFacility.edit', compact('data'));
    }

    public function update1(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|min:10|max:500'
        ]);
        
        $data = $request->only(['name','description']);
          $data['title'] = $request->name;
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move('govt', $imageName);
            $data['image'] = $imageName;
        }
        
        $res = GovtFacility::where('user_id',auth()->user()->id)->find($id)->update($data);

        if ($res) {
            return redirect()->route('govtfacility.index')->with('insert', 'Success! Updated Successfully.');
        }

        return back()->with('insert', 'Error! Please try Again after sometime.');
    }

    public function delete($id)
    {

        $res = GovtFacility::where('user_id',auth()->user()->id)->find($id)->delete();

        if ($res) {
            return back()->with('insert', 'Success! Deleted Successfully.');
        }

        return back()->with('insert', 'Error! Please try Again after sometime.');
    }

   
    public function show()
    {
    }
}
