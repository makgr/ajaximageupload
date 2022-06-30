<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\File;


class EmpController extends Controller
{
    

    public function viewImage(){

    	// $emp_data=DB::select('select * from emp_history');
    	$emp_data = Employee::where('emp_id', 199)->first();
        // dd($emp_data);
    	return view('welcome',compact('emp_data'));
    }

    public function imguploadpost(Request $request){
    	if($request->ajax()){
    		$data = $request->file('file');
           $extension = $data->getClientOriginalExtension();
        //    $filename = time().'usermina'.'_profilepic'.'.'.$extension; // renameing image
           $filename = 'up'.'.'.$extension; // renameing image
           $path =public_path('emp_profile/');

           $emp_data = Employee::where('emp_id', 199)->first();
            
           $usersImage = public_path("emp_profile/".$filename); // get previous image from folder

            if (file_exists($usersImage)) { // unlink or remove previous image from folder
               unlink($usersImage);

               Employee::where('emp_id', 199)->update(['emp_img' =>$filename]);
           }else{
//                dd('File is not exists.');
               $pp='nofileexist';

            //    DB::table('emp_history')->insert(['emp_id' => '199', 'emp_img' => $filename]);
            Employee::create(['emp_id' => '199', 'emp_img' => $filename]);
           }

           $upload_success = $data->move($path, $filename);

           return response()->json([
               'success' => 'done',
               'valueimg'=>$data
           ]);




    	}
    }

   


}