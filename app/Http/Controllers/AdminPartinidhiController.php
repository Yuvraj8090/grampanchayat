<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImportantPosts;

class AdminPartinidhiController extends Controller
{

     public function index(Request $request,$id){   
        $data = ImportantPosts::where('ref_id',$id)->orderBy('id','DESC')->paginate('20');
        $add = "";
        if($request->idd){
             $add = ImportantPosts::where('id',$request->idd)->first(); 
        }
        return view('admin.partinidhi.index',compact('data','add','id'));
    }
    
    
    public function store(Request $request){
        
    
        $this->validate($request,[
            'content' => 'required',
            'content.*' => 'required',
        ]);
        
        // dd(count($request->content));
        
        foreach($request->content as $value){
             $res = ImportantPosts::create([
                 'content' => $value,
                 'ref_id' => $request->ref_id
            ]);
        }
        
        if($res){
               return back()->with('insert','New Title Added Successfully.');
        }
        
        return back()->with('insert','Error! Please try Again after sometime.');
        
    }
    
    public function edit($id){
        $add = ImportantPosts::find($id);
        return view('admin.partinidhi.edit',compact('add'));
    }
    
    public function update(Request $request,$id){
            
        $this->validate($request,[
            'content' => 'required',
        ]);
    
        $data = $request->only(['content','link']);
        
        $res = ImportantPosts::find($id)->update($data);
        
        if($res){
               return redirect()->to('points/index/'.$request->ref_id)->with('insert','Title updated Successfully.');
        }
        
        return back()->with('insert','Error! Please try Again after sometime.');
        
    }
    
    public function delete($id){
        
        $res = ImportantPosts::find($id)->delete();
        
        if($res){
               return back()->with('insert','Title deleted Successfully.');
        }
        
        return back()->with('insert','Error! Please try Again after sometime.');
    }
    
    
}
