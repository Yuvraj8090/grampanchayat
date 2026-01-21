<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImporantTitle;

class AdminImportantController extends Controller
{

    public function index(Request $request)
    {   
        $data = ImporantTitle::orderBy('id','DESC')->paginate('20');
        
        $add = "";
        
        if($request->id){
             $add = ImporantTitle::where('id',$request->id)->first(); 
        }
        
        return view('admin.important.index',compact('data','add'));
    }
    
    public function create(){
        return view('admin.important.create');
    }
    
    public function store(Request $request){
    
        $this->validate($request,[
            'title' => 'required',
            'link_title' => 'required',
            'link' => 'required'
        ]);
        

        $data = $request->only(['title','link_title','link']);
        
        $res = ImporantTitle::create($data);
        
        if($res){
               return back()->with('insert','New Title Added Successfully.');
        }
        
        return back()->with('insert','Error! Please try Again after sometime.');
        
    }
    
    public function edit(){
        
    }
    
    public function update(Request $request,$id){
        
        $this->validate($request,[
            'title' => 'required',
            'link_title' => 'required',
            'link' => 'required'
        ]);
        
        
        $data = $request->only(['title','link_title','link']);
        

        $res = ImporantTitle::find($id)->update($data);
        
        if($res){
               return redirect()->route('important.index')->with('insert','Title updated Successfully.');
        }
        
        return back()->with('insert','Error! Please try Again after sometime.');
        
    }
    
    public function delete($id){
        
        $res = ImporantTitle::find($id)->delete();
        
        if($res){
               return redirect()->route('important.index')->with('insert','Title deleted Successfully.');
        }
        
        return back()->with('insert','Error! Please try Again after sometime.');
    }
    
    
}
