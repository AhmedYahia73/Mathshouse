<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Notification;
use App\Models\User;
use App\Models\SupParent;

class NotificationController extends Controller
{
    public function __construct(private Notification $notifications,
    private SupParent $parent, private User $users){}

    public function view(){
        $notifications = $this->notifications
        ->with('parent', 'user')
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'parent' => $item?->parent?->select('id', 'name'),
                'teachers' => $item?->user?->where('position', 'teacher')?->values()?->select('id', 'name'),
                'students' => $item?->user?->where('position', 'student')?->values()?->select('id', 'nick_name'),
                'material_link' => $item->material_link,
                'material_file' => $item->material_file_link,
                'text' => $item->text,
                'date' => Carbon::parse($item->date)->format('Y-m-d'),
                'time' => Carbon::parse($item->date)->format('H:i:s'),
            ];
        });

        $students = $this->users
        ->select('id', 'nick_name')
        ->where('position', 'student')
        ->get();
        $teachers = $this->users
        ->select('id', 'nick_name')
        ->where('position', 'teacher')
        ->get();
        $parents = $this->parent
        ->select('id', 'name')
        ->get();

        return view('Admin.Notifications.Notifications',
        compact('notifications', 'students', 'teachers', 'parents'));
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'parents.*' => ['required', 'exists:sup_parents,id'],
            'students.*' => ['required', 'exists:users,id'],
            'teachers.*' => ['required', 'exists:users,id'],
            'material_link' => ['sometimes'],
            'material_file' => ['sometimes'],
            'text' => ['sometimes'],
            'date' => ['required']
        ]);
        if ($validator->fails()) {
            session()->flash('faild', $validator->errors()->first());
            return redirect()->back();
        }
        // material_link, material_file, text,
        $material_file = null; 
        if($request->hasFile('material_file')){ 
            extract($_FILES['material_file']);
            if( !empty($name) ){ 
                $extension = explode('.', $name);
                $extension = end($extension);
                $extension = strtolower($extension); 
                $file_name = rand(0, 1000) . now() . $name;
                $file_name = 'files/notification/' . str_replace([' ', ':', '-'], 'X', $file_name);
                $path = public_path('files/notification'); 
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                move_uploaded_file($tmp_name, $file_name); 
            }
        }
        $notifications = $this->notifications
        ->create([
            'material_link' => $request->material_link ?? null,
            'text' => $request->text ?? null,
            'material_file' => $file_name ?? null,
            'date' => $request->date
        ]); 
        if($request->parents){
            $notifications->parent()->attach($request->parents);
        }
        if($request->students){
            $notifications->user()->attach($request->students);
        }
        if($request->teachers){
            $notifications->user()->attach($request->teachers);
        }

        return redirect()->back();
    }

    public function delete(Request $request, $id){
        $this->notifications
        ->where('id', $id)
        ->delete();

        return redirect()->back();
    }
}
