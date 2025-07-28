<?php

namespace App\Http\Controllers\Api\Admin\ReportIssue\Video;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ReportVideo;

class VReportAction extends Controller
{
    public function __construct(private ReportVideo $report_video){}

    public function view(){
        $report_videos = $this->report_video
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'date' => $item->date,
                'statues' => $item->statues,
                'student' => $item?->student?->nick_name,
                'video' => $item?->video,
                'error' => $item?->list?->list,
            ];
        });

        return response()->json([
            'report_videos' => $report_videos
        ]);
    }
    
    public function status(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pendding,inprogress,done',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $this->report_video
        ->where('id', $id)
        ->update(['statues' => $request->status]);

        return response()->json([
            'success' => $request->status
        ]);
    }
}
