<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function videolist(){
        return view('admin.videolist');
    }

    public function video_list(Request $request){
        $res=$request->input();
        $video=Video::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->orderBy('video_id', 'desc')->get();
        $count=Video::count();
        return response()->json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data'=>$video
        ]);
    }

    public function video_del(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=Video::where('video_id',$res['video_id'])->delete();
            Storage::disk('upload')->delete($res['video_path']);
            Storage::disk('upload')->delete($res['thum_path']);
            if($result){
                $data=[
                'status'=>'1',
                'msg'=>'删除成功!',
                ];
            }else{
                $data=[
                'status'=>'0',
                'msg'=>'删除失败!',
                ];
            }
            return $data;
        }
    }

    public function video_edit(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=Video::where('video_id',$res['video_id'])->update(['video_title'=>$res['video_title']]);
            if($result){
                $data=[
                'status'=>'1',
                'msg'=>'修改成功!',
                ];
            }else{
                $data=[
                'status'=>'0',
                'msg'=>'修改失败!',
                ];
            }
            return $data;
        }
    }

    public function upload_video(Request $request){
        $file=$request->file('file');
        $clientName = $file -> getClientOriginalName(); //获取文件名称
        $entension = $file -> getClientOriginalExtension();  //上传文件的后缀
        $name=date('YmdHis').mt_rand(100,999);
        $videoName=$name.'.'.$entension;
        $thumName=$name.'.jpg';
        $movepath = $file -> move(base_path().'/uploads/temp',$videoName);
        //ffmpeg -y -ss 2 -i ".base_path()."/uploads/videos/".$newName." -f image2 -s 250x140 ".base_path()."/uploads/videos/".$newName.".jpg
        $cmd="F:\\ffmpeg\\bin\\ffmpeg -y -ss 10 -i ".base_path()."/uploads/temp/".$videoName." -f image2 -s 720x480 ".base_path()."/uploads/temp/".$thumName;
        exec($cmd);
        return response()->json([
            'code' => 0,
            'msg' => '',
            'videoName'=>"$videoName",
            'thumName'=>"$thumName",
            'clientName' => "$clientName"
        ]);
    }

    public function upload(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $data=[
                'video_title'=>$res['video_title'],
                'video_time'=>$res['video_time'],
                'video_path'=>'uploads/videos/'.$res['videoName'],
                'thum_path'=>'uploads/videos/'.$res['thumName'],
            ];
            Storage::disk('upload')->move('/uploads/temp/'.$res['videoName'],'/uploads/videos/'.$res['videoName']);
            Storage::disk('upload')->move('/uploads/temp/'.$res['thumName'],'/uploads/videos/'.$res['thumName']);
            Video::create($data);
            return redirect('admin/videolist')->with('msg_success','视频上传成功!');
        }
    }

    public function del_many_video(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            foreach ($res['video_id'] as $key => $value) {
                $video_path=Video::where('video_id',$value)->pluck('video_path')->first();
                $thum_path=Video::where('video_id',$value)->pluck('thum_path')->first();
                Storage::disk('upload')->delete($video_path);
                Storage::disk('upload')->delete($thum_path);
            }
            $result=Video::whereIn('video_id',$res['video_id'])->delete();
            if($result){
                $data=[
                'status'=>'1',
                'msg'=>'删除成功!',
                ];
            }else{
                $data=[
                'status'=>'0',
                'msg'=>'删除失败!',
                ];
            }
            return $data;
        }
    }

    public function del_all_video(Request $request){
        if($request->isMethod('post')){
            $result=Video::truncate();
            Storage::disk('upload')->deleteDirectory('uploads/videos');
            if($result){
                $data=[
                'status'=>'1',
                'msg'=>'删除成功!',
                ];
            }else{
                $data=[
                'status'=>'0',
                'msg'=>'删除失败!',
                ];
            }
            return $data;
        }
    }
}
