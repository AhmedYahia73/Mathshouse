<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\trait\Image;

use App\Models\Session;

class TLiveController extends Controller
{
    use Image;

    public function index(){
        $sessions = Session::where('teacher_id', auth()->user()->id)
        ->get();

        return view('Teacher.Live.Live', compact('sessions'));
    }

    public function upload_teacher_material(Request $request){
        $file_name = null;
        extract($_FILES['ans_teacher_material']);
        if( !empty($name) ){
            $file_name = rand(0, 1000) . now() . $name;
            $file_name = str_replace([' ', ':', '-'], 'X', $file_name);
            $file_name = 'files/teacher_pdf/' . $file_name;
        }
        $session = Session::where('id', $request->session_id)
        ->first();
        $this->delete_image_path($session->ans_teacher_material ?? '');
        $session->update([
            'ans_teacher_material' => $file_name,
        ]);
        $folder = 'files/teacher_pdf/';

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }
        move_uploaded_file($tmp_name, $file_name);

        return redirect()->back();
    }

}
