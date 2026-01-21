<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{ListName, User,States,Positions};
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class AdminJanController extends Controller
{
    public function index(Request $request)
    {
        $data = ListName::query();
        $data->with('user:id,name,hindi');
        
        if($request->search){
            $data->where('user_id',$request->search);
        }else{
            $data->orderBy('id', 'DESC');
        }
        
        $data = $data->paginate('50');
          $users = User::where('role_id', '2')->get();
          
        return view('admin.listname.index', compact('data','users'));
    }

    public function create()
    {    $states = States::all();
        $users = User::where('role_id', '2')->get();
        $positions = Positions::get();
        return view('admin.listname.create',compact('users','states','positions'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'user' => 'required',
            'name' => 'required',
            'position' => 'required',
            'block' => 'required',
            'phone' => 'required|digits:10'
        ]);

        $request['user_id'] = $request->user;
        $request['image'] = 'sadsad';
        $res = ListName::create($request->all());

        if ($res) {
            return redirect()->route('jan-partinidhi.index')->with('insert', 'Success! Added Successfully.');
        }
        return back()->with('insert', 'Error! Please try Again after sometime.');
    }


    public function store1(Request $request)
    {
        // dd($request->file);
        
        $file = $request->file('file');

    // Get the file extension
    $extension = $file->getClientMimeType();
    
        $this->validate($request, [
            'file' => 'required',
        ]);

       return  DB::transaction(function ()  use ($request){

            try {

                $file = $request->file('file');
                $spreadsheet = IOFactory::load($file);
                $sheet = $spreadsheet->getActiveSheet();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                // Process and save data to the database
                for ($row = 2; $row <= $highestRow; ++$row) {
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false)[0];
                    $data = [
                        'user_id' => $rowData['0'],
                        'name' => $rowData['1'],
                        'position' => $rowData['2'],
                        'image' => '816094546.png',
                        'block' => $rowData['4'],
                        'phone' => $rowData['3'],
                    ];
                    
                    $data = ListName::create($data);
                }

                DB::commit();
                return back()->with('insert', 'Success! Excel Uploaded Successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                dd($e->getMessage());
                return back()->with('insert', "Error! Excel can't Because excel have an error.");
            }
        });
    }

    public function edit($id)
    {
        $data = ListName::find($id);
        $users = User::where('role_id', '2')->get();
        $positions = Positions::get();

        return view('admin.listname.edit', compact('data','users','positions'));
    }

    public function update1(Request $request, $id)
    {

        $this->validate($request, [
            'user' => 'required',
            'name' => 'required',
            'position' => 'required',
            'block' => 'required',
            'phone' => 'required|digits:10'
        ]);


        $res = ListName::find($id)->update($request->all());

        if ($res) {
            return redirect()->route('jan-partinidhi.index')->with('insert', 'Success! Updated Successfully.');
        }

        return back()->with('insert', 'Error! Please try Again after sometime.');
    }

    public function delete($id)
    {

        $res = ListName::find($id)->delete();

        if ($res) {
            return back()->with('insert', 'Title deleted Successfully.');
        }

        return back()->with('insert', 'Error! Please try Again after sometime.');
    }

    public function excelupload()
    {
        $users = User::where('role_id', '2')->get();
        return view('admin.listname.excel', compact('users'));
    }

    public function show()
    {
    }
}
