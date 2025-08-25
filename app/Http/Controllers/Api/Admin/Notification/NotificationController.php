<?php

namespace App\Http\Controllers\Api\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\trait\Image;

use App\Models\Notification;
use App\Models\User;
use App\Models\SupParent;

class NotificationController extends Controller
{
    public function __construct(private Notification $notifications,
    private SupParent $parent, private User $users){}
    use Image;

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

        return response()->json([
            'notifications' => $notifications, 
            'students' => $students, 
            'teachers' => $teachers, 
            'parents' => $parents,
        ]);
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
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        // material_link, material_file, text,
        $material_file = null; 
        if($request->material_file){  
            $file_path = $this->store_base64($request->material_file, 'files/notification');
            $studentRequest['material_file'] = $file_path; 
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

        return response()->json([
            'success' => 'You add data success'
        ]);
    }

    public function modify(Request $request, $id){
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
        $notificationRequest = [
            'material_link' => $request->material_link ?? null,
            'text' => $request->text ?? null, 
            'date' => $request->date
        ];
        $notifications = $this->notifications
        ->where('id', $id)
        ->first();
        if($request->material_file){  
            $file_path = $this->store_base64($request->material_file, 'files/notification');
            $notificationRequest['material_file'] = $file_path; 
            $this->delete_image_path($notifications->material_file);
        }
        $notifications->update($notificationRequest); 
        $notifications->user()->detach();
        if($request->parents){
            $notifications->parent()->sync($request->parents);
        }
        if($request->students){
            $notifications->user()->attach($request->students);
        }
        if($request->teachers){
            $notifications->user()->attach($request->teachers);
        }
 
        return response()->json([
            'success' => 'You update data success'
        ]);
    }

    public function delete(Request $request, $id){
        $notification = $this->notifications
        ->where('id', $id)
        ->first();
        if(empty($notification)){
            return response()->json([
                'errors' => 'id is wrong'
            ], 400);
        }
        $this->delete_image_path($notifications->material_file);
        $notification->delete();
        
        return response()->json([
            'success' => 'You delete data success'
        ]);
    }
}
