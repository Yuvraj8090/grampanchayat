<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\User;
use App\Media;
use App\Fact;
use App\ListName;
use App\Pmsg;
use App\Work;
use App\Address;
use App\Register;
use App\Business;
use App\Video;
use App\Intro;
use App\Place;
use App\States;
use App\Districts;
use App\Blocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MainIndex extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.login');
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
            'age' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'pin' => 'required',
            'occupation' => 'required',
            'qualification' => 'required',
            'stream' => 'required',
            'state' => 'required|exists:states,id',
            'district' => 'required|exists:districts,id',
            'block' => 'required|exists:blocks,id',
            'dob' => 'required|date'
        ]);

        $input = $request->all();
        
        Register::create([

            'user_id' => $input['user_id'],
            'name' => $input['name'],
            'age' => $input['age'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'pin' => $input['pin'],
            'occupation' => $input['occupation'],
            'qualification' => $input['qualification'],
            'stream' => $input['stream'],
            'state' => $input['state'],
            'district' => $input['district'],
            'block' => $input['block'],
             'dob' => $input['dob']
        ]);

        Session::flash('insert', 'Successfully Uploaded');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {   
        
        $user = User::whereSlug($slug)->firstOrFail();

        $photo = Media::where('user_id', '=', $user->id)->get();

        $intro = Intro::where('user_id', '=', $user->id)->first(); 

        $fact = Fact::where('user_id', '=', $user->id)->get();

        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();
        
        return view('user.index', compact('photo', 'intro', 'fact', 'user', 'name'));
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
        
    }

    public function message($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();

        $msg = Pmsg::where('user_id', '=', $user->id)->first();

        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

        return view('user.pradhanmessage', compact('user', 'msg', 'name'));
    }

    public function place($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();

        $intro = Place::where('user_id', '=', $user->id)->where('intro', '!=', null)->first();

        $place = Place::where('user_id', '=', $user->id)->where('intro', '=', null)->get();

        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();
        
        return view('user.touristplace', compact('user', 'intro', 'place', 'name'));
    }

    public function gallery($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();

        $photo = Media::where('user_id', '=', $user->id)->where('gallery', '=', 1)->get();

        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();
        
        return view('user.gallery', compact('user', 'photo', 'name'));
    }

    public function video($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();

        $video = video::where('user_id', '=', $user->id)->get();

        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();
        
         return view('user.video', compact('user', 'video', 'name'));
    }

    public function business($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();

        $intro = Business::where('user_id', '=', $user->id)->where('intro', '!=', null)->first();

        $business = Business::where('user_id', '=', $user->id)->where('intro', '=', null)->get();

        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

        return view('user.panchyatbusiness', compact('user', 'intro', 'business', 'name'));
    }

    public function lead($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();

        $list = ListName::with('positions')
        ->where('user_id', $user->id)
        ->get();
        
        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

        return view('user.grampanchayatleaders', compact('user', 'list', 'name'));
    }

    public function contact($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();

        $add = Address::where('user_id', '=', $user->id)->where('address', '!=', null)->first();

        $lo = Address::where('user_id', '=', $user->id)->where('address', '=', null)->get();

        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

        return view('user.contact', compact('user', 'add', 'lo', 'name'));
    }

    public function work($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();

        $work = Work::where('user_id', '=', $user->id)->get();

        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

        return view('user.grampanchayatdevelopmentworks', compact('user', 'work', 'name'));
    }

    public function re($slug)
    {
        
        $user = User::whereSlug($slug)->firstOrFail();
        
        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();
        
        $states = States::where('id','34')->get();
        
        return view('user.register', compact('user', 'name','states'));
    }
    
    public function getDistrictByState(Request $request){
        
        if($request->ajax()){
            
            $data = Districts::where('state_id',$request->id)->get();
            return response()->json(['data' => $data]);
        }
        
        return response()->json(['error' => 'Unauthorized Request!'],422);
        
    }
    
     public function getBlockByDistrict(Request $request){
        
        if($request->ajax()){
            $data = Blocks::where('district_id',$request->id)->get();
            return response()->json(['data' => $data]);
        }
        
        return response()->json(['error' => 'Unauthorized Request!'],422);
        
    }
}
