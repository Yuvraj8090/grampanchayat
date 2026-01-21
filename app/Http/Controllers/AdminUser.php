<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\{States,Feedback,User};


class AdminUser extends Controller
{
    /**
     * @return \Illuminate\Http\Response
    */
    public function index(request $request){
        $user = User::query();
        
        if($request->search){
            $user->where('name','LIKE','%'.$request->search.'%');
        }
        
        $user= $user->where('role_id', '!=', 1)->where('role_id', '!=', 3)->orderBy('id', 'DESC')->paginate('50');
        return view('admin.user.index', compact('user'));
    }

    public function excel(){
        $states = States::all();
        $users = User::where('role_id', '2')->get();
        return view('admin.user.excel',compact('states','users'));
    }

    public function excelUpload(Request $request){
        
        $this->validate($request, [
            'state' => 'required',
            'district' => 'required',
            'block' => 'required',
            'file' => 'required|mimes:xlsx,xls'
        ]);

        return  DB::transaction(function ()  use ($request){
            try {
                $file = $request->file('file');
                $spreadsheet = IOFactory::load($file);
                $sheet = $spreadsheet->getActiveSheet();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                // Process and save data to the database
                for ($row = 1; $row <= $highestRow; ++$row) {
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false)[0];
                    $data[] = [
                        'role_id' => '2',
                        'state_id' => $request->state,
                        'district_id' => $request->district,
                        'block_id' => $request->block,
                        'name' => $rowData['1'],
                        'slug' => str_replace(' ','-',$rowData['1']),
                        'hindi' => $rowData['2'],
                        'email' => $rowData['3'],
                        'phone' => $rowData['5'],
                        'dob' => $rowData['6'],
                    ];
                }
                User::insert($data);
                DB::commit();
                return back()->with('insert', 'Success! Excel Uploaded Successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('insert', "Error! Excel can't Because excel have an error.");
            }
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $states = States::all();
        return view('admin.user.create',compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){   
        
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:users',
            'hindi_name' => 'required',
            'phone' => 'required|min:10|max:10',
            'state' => 'required',
            'district' => 'required',
            'block' => 'required'
        ]);

        $data = $request->all();
        
        $email = strtolower($data['name']).'@grampanchayat.org';

        User::create([
            'role_id' => '2',
            'name' => $data['name'],
            'hindi' => $data['hindi_name'],
            'email' => $email,
            'phone' => $data['phone'],
            'occupation' => $data['occupation'],
            'qualification' => $data['qualification'],
            'stream' =>  $data['stream'],
            'password' => bcrypt($request->password),
            'd_password' => $request->password,
            'slug' => str_slug($data['name'], '-'),
            'state_id' => $request->state,
            'district_id' => $request->district,
            'block_id' => $request->block
        ]); 

        // your cPanel username
        $cpanel_user = 'grampanc';

        // your cPanel password
        // $cpanel_pass = 'GBFG-#JoTdJo?9TH@;';
        
        $cpanel_pass = '.vA6jNUcq..\1!N0&4';

        // your cPanel skin
        $cpanel_skin = 'paper_lantern';

        // your cPanel domain
        $cpanel_host = 'grampanchayat.org';

        // subdomain name
        $subdomain = $data['name'].'.grampanchayat.org';

        // directory - defaults to public_html/subdomain_name
        $dir = 'public_html/';

        // create the subdomain

        $sock = fsockopen($cpanel_host,2082);
        if(!$sock) {
            print('Socket error');
            exit();
        }

        $pass = base64_encode("$cpanel_user:$cpanel_pass");
        $in = "GET /frontend/$cpanel_skin/subdomain/doadddomain.html?rootdomain=$cpanel_host&domain=$subdomain&dir=$dir\r\n";
        $in .= "HTTP/1.0\r\n";
        $in .= "Host:$cpanel_host\r\n";
        $in .= "Authorization: Basic $pass\r\n";
        $in .= "\r\n";

        fputs($sock, $in);
            while (!feof($sock)) {
            $result = fgets ($sock,128);
        }
        fclose($sock);

        $to = 'suyalvikas@gmail.com';
        $subject = "New Panchayat Registered";
        $htmlContent = "
            <h3>Details</h3>
              <p><b>Username:</b> ".$email."</p>
              <p><b>Password:</b> ".$request->password."</b>
              ";
        $headers = 'MIME-Version: 1.0' . "\r\n" .
        'Content-type:text/html;charset=UTF-8' . "\r\n" .
        'From: '.$data['name'].' <contact@grampanchayat.org>' . "\r\n" .
          'Reply-To: '.$data['name'].' <contact@grampanchayat.org>' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
        $mail = mail($to, $subject, $htmlContent, $headers);

        Session::flash('insert', 'Successfully Created');

        return redirect()->route('admin-user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        Auth::login($user);

        return redirect('/dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $states = States::all();
        return view('admin.user.edit', compact('user','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'hindi_name' => 'required',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|min:10|max:10',
            'google' => 'required',
            'state' => 'required',
            'district' => 'required',
            'block' => 'required'
        ]);

        $input = $request->all();
        
        if($request->occupation){
            $input['occupation'] = $request->occupation;  
        }
        
        if($request->qualification){
            $input['qualification'] = $request->qualification;  
        }
        
           
        if($request->stream){
            $input['stream'] = $request->stream;  
        }
        
        if($request->password){
            $input['password'] =  bcrypt($request->password);
            $input['d_password'] =  $request->password;
        }
        
        $input['hindi'] = $request->hindi_name;
        

        User::findOrFail($id)->update($input);

        Session::flash('insert', 'Successfully Updated');
        return redirect()->route('admin-user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        User::findOrFail($id)->delete();
        return redirect()->back();
    }
    
    public function settingView(){
        return view('admin.user.setting');
    }
    
    public function changePassword(Request $request){
        
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Check if the current password matches the authenticated user's password
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        // Update the user's password
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();
    
        return redirect()->back()->with('success', 'Password changed successfully');
         
    }
    
    public function feeback(){
        
        $data = Feedback::orderBy('id','desc')->paginate('50');
        
        return view('admin.Feedback.index',compact('data'));
        
    }
    
    public function deletefeedback($id){
        
        Feedback::find($id)->delete();
        return back()->with('success','Success! Deleted successfully.');
        
    }

    public function upload(Request $request){   

        $this->validate($request,[
            'file' => 'required|mimes:xlsx,xls',
        ]);
        
        $file = $request->file('file');

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($file);
        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Get the highest row number and column letter
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $response = [];
         // Process and save data to the database
        for ($row = 2; $row <= $highestRow; ++$row) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false)[0];

            $password = $this->GeneratePassword();

            $data = [
                'role_id' => '2',
                'name' => $rowData['0'],
                'hindi' => $rowData['1'],
                'email' => $rowData['2'],
                'phone' => $rowData['3'],
                'password' => bcrypt(Str::random(10)),
                'slug' => str_slug($rowData['0'], '-'),
                'state_id' => $rowData['4'],
                'district_id' => $rowData['5'],
                'block_id' => $rowData['6'],
                'password' => $password
            ];

            $data = User::create($data);
            if(!$data){
                $response = $rowData['0']. ' Cant be created Because of Unknown Issue.';
            }

        }
        return 'File uploaded successfully!';
    }

    public function GeneratePassword(){

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890*#@!%&()_+|~:?><.,;';
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return $password = implode($pass);
    }
    

 
    
    
}
