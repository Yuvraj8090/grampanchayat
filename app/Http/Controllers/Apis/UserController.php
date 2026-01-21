<?php



namespace App\Http\Controllers\Apis;



use App\{User,Media,Fact,ListName,Pmsg,Work,Address,Register,Business,Video,Intro,Place,States,Districts,Blocks,ImporantTitle,Feedback,Brave,GovtFacility,Complain};



use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;







class UserController extends Controller

{

    public function index($slug){

        

        $user = User::select('name','email','id')->whereSlug($slug)->firstOrFail();



        // $data = cache()->remember('home6', 1, function () use ($user) {

                

            $photo = Media::where('user_id', '=', $user->id)->get();

            $photo = $this->mediaPath($photo,['image']);

            

            $intro = Intro::where('user_id', '=', $user->id)->first();

            $intro = $this->removeHtml($intro,['intro'],FALSE);

    

            $fact = Fact::where('user_id', '=', $user->id)->get();

            

    

            $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

            $name = $this->mediaPath($name ,['image'],FALSE);

            

            $data = [

                        'user' => $user,

                        'photo' => $photo,

                        'intro' => $intro,

                        'fact' => $fact,

                        'listName' => $name

                ];

            // });

        

            return response()->json([

                'statue' => 'true',

                'data' => $data,

                'message' => 'Success'

            ],200);

        

    }

    

    public function message($slug){

        

        $user = User::whereSlug($slug)->firstOrFail();

    

        // $data = cache()->remember('message2', 1000, function () use ($user) {

            

                $msg = Pmsg::where('user_id', '=', $user->id)->first();

                $msg = $this->removeHtml($msg,['msg'],FALSE);

                $msg = $this->mediaPath($msg,['image'],FALSE);

                

                $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

                $name = $this->mediaPath($name,['image'],FALSE);

                

                $data =  [

                    

                    'msg' => $msg,

                    'name' => $name

                ];



        // });

        

        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);

       

    }

    

    public function place($slug)

    {

        $user = User::whereSlug($slug)->firstOrFail();



        // $data = cache()->remember('place1', 1000, function () use ($user) {

            

            $intro = Place::where('user_id', '=', $user->id)->where('intro', '!=', null)->first();

            $intro = $this->removeHtml($intro,['intro'],FALSE);

            $intro = $this->mediaPath($intro,['image'],FALSE);



            $place = Place::where('user_id', '=', $user->id)->where('intro', '=', null)->paginate('6');

            $place = $this->mediaPath($place,['image']);

            

            $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

            $name = $this->mediaPath($name,['image'],FALSE);

        

            $data =  [

                    'intro' => $intro,

                    'place' => $place,

                    'name' => $name

            ];

       

        

        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);

    }

    

    public function gallery($slug){
        $user = User::whereSlug($slug)->firstOrFail();
    
        $perPage = 6;
        $page = request()->query('page', 1);
        $photoQuery = Media::where('user_id', '=', $user->id)
                           ->where('gallery', '=', 1);
        
        // Get the paginated data
        $photo = $photoQuery->paginate($perPage, ['*'], 'page', $page);
        
        // If the current page has no items, return a 'Data not present' message
        if ($photo->count() === 0 && $page > $photo->lastPage()) {
            return response()->json([
                'status' => 'true',
                'data' => [
                    'photo' => [],
                    'name' => []
                ],
                'message' => 'Data not present'
            ], 200);
        }
    
        $photo = $this->mediaPath($photo, ['image']);
        
        // Fetch name with specific position
        $name = ListName::where('user_id', '=', $user->id)
                        ->where('position', '=', 'प्रधान')
                        ->first();
        $name = $name ? $this->mediaPath($name, ['image'], false) : [];
    
        $data = [
            'photo' => $photo,
            'name' => $name
        ];
    
        return response()->json([
            'status' => 'true',
            'data' => $data,
            'message' => 'Success'
        ], 200);
    }
    
    

    

    public function video($slug)

    {

        $user = User::whereSlug($slug)->firstOrFail();



        // $data = cache()->remember('video', 1000, function () use ($user) {

            

            $video = video::where('user_id', '=', $user->id)->get();

            

            foreach($video as $v){

                $v['url'] = 'https://www.youtube.com/watch?v='.$v->url;

            }

            $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

                

            $data =  [

                    'video' => $video,

                    'name' => $name

            ];

        // });



        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);



    }



    public function business($slug)

    {

        $user = User::whereSlug($slug)->firstOrFail();

        

        // $data = cache()->remember('business1', 1000, function () use ($user) {

            

            $intro = Business::where('user_id', '=', $user->id)->where('intro', '!=', null)->first();

            $intro = $this->removeHtml($intro,['intro'],FALSE);

            $intro = $this->mediaPath($intro,['image'],FALSE);



            $business = Business::where('user_id', '=', $user->id)->where('intro', '=', null)->paginate('6');

            $business = $this->removeHtml($business,['about'],TRUE);

            $business = $this->mediaPath($business,['image'],TRUE);



            $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

            $name = $this->mediaPath($name,['image'],FALSE);

                

            $data =   [

                    'intro' => $intro,

                    'business' => $business,

                    'name' => $name

            ];

            

        // });



        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);



    }



    public function lead($slug)

    {

        $user = User::whereSlug($slug)->firstOrFail();

        

        // $data = cache()->remember('lead1', 1000, function () use ($user) {

            

            $list = ListName::where('user_id', '=', $user->id)->get();

            $list = $this->mediaPath($list,['image'],TRUE);

            

            $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

            $name = $this->mediaPath($name,['image'],FALSE);

            

            $data =  [

                    'list' => $list,

                    'name' => $name

            ];

        // });



        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);



    }

    

    public function contact($slug)

    {

        $user = User::whereSlug($slug)->firstOrFail();

        

        // $data = cache()->remember('contact1', 1000, function () use ($user) {

            

             $add = Address::where('user_id', '=', $user->id)->where('address', '!=', null)->first();

             $lo = Address::where('user_id', '=', $user->id)->where('address', '=', null)->get();

             $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

             $name = $this->mediaPath($name,['image'],FALSE);

                 

            $data = [

                        'add' => $add,

                        'lo' => $lo,

                        'name' => $name

            ];

        // });



        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);



    }

    

    public function getAllUserNames(Request $request){

        

        $data =  User::query();

        

        $data->select('id','role_id','name','hindi as hindi_name','state_id','district_id','block_id');

        $data->where('role_id','2');

        if($request->state_id){

            $data->where('state_id',$request->state_id);

        }

        

        if($request->district_id){

            $data->where('state_id',$request->district_id);

        }

        

        if($request->block_id){

            $data->where('block_id',$request->block_id);

        }

        

        $data = $data->get();

        

        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);

    }

    

    public function getAllStates(){

        

        $data =  States::where('status','1')->get();

        

        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);

    }

    

     public function getStateDistrict($id){

        

        $data =  Districts::where('state_id',$id)->where('status','1')->get();

        

        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);

        

        

    }

    

     public function getDistictBlock($id){

        

        $data =  Blocks::where('district_id',$id)->where('status','1')->get();

        

        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);

    }

    

    

    public function work($slug)

    {

        $user = User::whereSlug($slug)->firstOrFail();



        $data['work'] = Work::where('user_id', '=', $user->id)->get();



        $data['name'] = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

        

        

         return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);



    }

    

      public function importantInformation($slug){

        

        $user = User::whereSlug($slug)->firstOrFail();

        $data['name'] = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();

        

        $data['data'] = ImporantTitle::with('posts')->get();

        

        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);

        

        return response()->json([

            'statue' => 'true',

            'data' => $data,

            'message' => 'Success'

        ],200);

        

    }

    

    

    public function feeback(Request $request){

        

        $validator = Validator::make($request->all(),[

            'name' => 'required|max:30',

            'email' => 'required|email',

            'phone' => 'required|digits:10',

            'message' => 'required|max:400'

        ]);



        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()],422);

        }

        

        $data = $request->only(['name','email','phone','message']);

        

        $data = Feedback::create($data);

        

        if($data){

            return response()->json([

                'statue' => 'true',

                'message' => 'Success! Message sent successfully.'

            ],200);

        }

        

        return response()->json([

            'statue' => 'false',

            'message' => 'Error! Please try gain after sometime.'

        ],500);

        

    }

    

    public function brave($slug){

      

        $user = User::whereSlug($slug)->firstOrFail();

        

        $data = Brave::where('user_id',$user->id)->paginate('20');

        

        return response()->json([

                'statue' => 'true',

                'data' => $data,

                'message' => 'Success! Message sent successfully.'

        ],200);

        

    }

    

    public function govt($slug){

      

        $user = User::whereSlug($slug)->firstOrFail();

        

        $data = GovtFacility::where('user_id',$user->id)->paginate('20');

        

        return response()->json([

                'statue' => 'true',

                'data' => $data,

                'message' => 'Success! Message sent successfully.'

        ],200);

        

    }


    public function complaint(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|numeric',
        'gram_id' => 'required|numeric',
        'complaint' => 'required|string|max:1000',
        'complaint_emails' => 'required|string',
        'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->messages()], 401);
    }

    $input = $request->all();

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('complain'), $image_name);
        $imagePath = public_path('complain/' . $image_name);
    }

    // Convert comma-separated string to an array and validate each email
    $emails = explode(',', $request->complaint_emails);
    $emails = array_map('trim', $emails);
    $validator = Validator::make(['complaint_emails' => $emails], [
        'complaint_emails.*' => 'required|email',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->messages()], 401);
    }

    $input['complaint_emails'] = json_encode($emails);
    $input['user_id'] = $request->user_id;
    $input['complaint'] = $request->complaint;
    $user = User::findOrFail($request->user_id);
    $complaint = Complain::create($input);

    // Prepare the email
    $subject = 'Complaint Request';
    $message = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Reset</title>
    </head>
     
    <body style="font-family: Arial, sans-serif;padding: 20px;">
      <p>Hello,</p>
      <h2>'.$input['complaint'].'</h2>
        <table style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 10px;">
            <tr>
                <td style="text-align: center;">
                 <img src="https://grampanchayat.org/logo.jpg" alt="Your Logo" style="max-width: 150px;">
                <h5>United Human Foundation Trust</h5>
                   
                </td>
            </tr>';

    // Set the email headers
    $boundary = md5(uniqid(time()));
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";
    $headers .= "From: " . $user->email . "\r\n";
    $headers .= "Reply-To: " . $user->email . "\r\n";

    // Email Body
    $body = "--{$boundary}\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n";

    // Attach the image
    if ($imagePath) {
        $fileContent = file_get_contents($imagePath);
        $fileContentEncoded = chunk_split(base64_encode($fileContent));
        $fileName = basename($imagePath);

        $body .= "--{$boundary}\r\n";
        $body .= "Content-Type: image/" . pathinfo($imagePath, PATHINFO_EXTENSION) . "; name=\"{$fileName}\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-Disposition: attachment; filename=\"{$fileName}\"\r\n\r\n";
        $body .= $fileContentEncoded . "\r\n";
    }

    $body .= "--{$boundary}--";

    // Send emails
    foreach ($emails as $email) {
        mail($email, $subject, $body, $headers);
    }

    return response()->json([
        'status' => 'true',
        'message' => 'Complaint sent successfully'
    ], 200);
    }
    
    
}