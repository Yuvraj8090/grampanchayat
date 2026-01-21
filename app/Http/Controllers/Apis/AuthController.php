<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    
    public function login(Request $request){

        $validator = Validator::make($request->all(),[
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()],422);
        }

        try{

            $credentials = $request->only(['phone','password']);
            
            if (Auth::attempt($credentials)) {
                
                $user = Auth::user(); // Get the authenticated user
                
                if ($user && $user->status == 1 && $user->role_id == 3  || $user->role_id == 2) {
                    
                    $token = Str::random(60); // Generate a random token
                    $user->update(['api_token' => $token]);
                
                    unset($user['password'],$user['created_at'],$user['updated_at'],$user['deleted_at'],$user['role']);
    
                    $data = [
                        'token' => $token,
                        'user' => $user,
                        'role' => $user->role->id
                    ];
                    
                    return response()->json($data, 200);
                }
                
                return response()->json(['errors' => [ 'error' => [ 'Your Account is blocked.Please contact admin or support.' ] ] ],422);
            }
            return response()->json(['errors' => [ 'error' => [ 'Authentication failed!' ] ] ],422);
            
        }catch(Exception $e){
             return response()->json(['errors' => [ 'error' => [ 'Error! Please Try Again After Sometime' ] ] ],500);
        }
    }

    public function logout(Request $request){
        
        try{
            
            $token = User::where('api_token',$request->bearerToken())->update(['api_token' => NULL]); 
            
            if($token){
                 return response()->json(['message' => 'Logged out successfully'],200);
            }
            
            return response()->json(['errors' =>'Authentication failed!'],422);
            
        }catch(Exception $e ){
            return response()->json(['errors' => 'Server Error' ],500);
        }
    
    }
    
    public function register(Request $request){
            
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|digits:10|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'state' => 'required|exists:states,id',
            'password' => 'required|min:8|max:20',
            'district' => 'required|exists:districts,id',
            'dob' => 'required|date'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
         
        $input = $request->all();
        
        $res = User::create([
            'role_id' => '3',
            'slug' =>  $input['name'],
            'name' => $input['name'],
            'dob' => $input['dob'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => bcrypt($request->password),
            'state' => $input['state'],
            'district' => $input['district']
        ]);
        
        if($res){
            return response()->json(['msg' => 'Successfully registered.']);
        }
        return response()->json(['msg' => 'Error! Please try again after sometime.'],500);

    }
    
    public function profileEdit(Request $request){
        
        $userDeatils = $this->getUserDatilsByToken($request->bearerToken());
        
        if(!$userDeatils){
             return response()->json(['msg' => 'Error! Token not valid.'],401);
        }
        
        $validator = Validator::make($request->all(),[
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|unique:users,name,'.$userDeatils->id,
            'state' => 'required|exists:states,id',
            'district' => 'required|exists:districts,id',
            'block' => 'required|exists:blocks,id',
            'dob' => 'nullable|date',
            'password' => 'nullable|min:8|max:20'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()],422);
        }
        
        if($request->password){
            $data['password'] =  bcrypt($request->password);
        }
        
        if($request->name){
            $data['name'] =  $request->name;
            $data['slug'] = str_replace(' ', '-', $request->name);
        }
        
        if($request->hindi){
            $data['hindi'] =  $request->hindi;
        }
        
        if($request->dob){
            $data['dob'] = $request->dob;
        }
        
        if($request->occupation){
            $data['occupation'] = $request->occupation;
        }
        
        if($request->stream){
            $data['occupation'] = $request->stream;
        }
        
        if($request->qualification){
            $data['qualification'] = $request->qualification;
        }
        
        if($request->state){
            $data['state_id'] = $request->state;
            $data['district_id'] = $request->district;
            $data['block_id'] = $request->block;
        }
        
        if($request->image){
            $file = $request->file('image');
            $name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move('profile', $name);
            $data['pic'] = $name;
        }
        

        $res = User::whereIn('role_id',[2,3])->find($userDeatils->id)->update($data);
        
        if($res){
            return response()->json(['msg' => 'Successfully edited Profile.'],200);
        }
        
        return response()->json(['msg' => 'Error! Please try again after sometime.'],500);
    
    }
    
     public function changePassword(Request $request){
         
        $validator = Validator::make($request->all(),[
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()],422);
        }
        
        $user = $this->getUserDatilsByToken($request->bearerToken());
       
        if(!$user){
            return response()->json(['msg' => 'User not Found!']);
        }
        
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' =>'Current password is incorrect']);
        }

        $user->update([
            'password' => bcrypt($request->new_password)
        ]);
        
        return response()->json(['msg' => 'Successfully chnaged password.']);

    }
    

}