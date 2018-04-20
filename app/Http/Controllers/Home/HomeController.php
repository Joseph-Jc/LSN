<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Imgcar;
use App\Http\Model\Admin\Video;
use App\Http\Model\Admin\Ebook;
use App\Http\Model\Admin\Exam;
use App\Http\Model\Admin\Leave;
use App\Http\Model\Admin\About;
use App\Http\Model\Admin\News;

class HomeController extends Controller
{
    public function home(){
        $new_imgcar=Imgcar::where('img_cate','新闻')->get();
        $teache_imgcar=Imgcar::where('img_cate','教师团队')->get();
        $video=Video::orderBy('video_id','desc')->take(5)->get();
        $examlist=Exam::orderBy('exam_id','desc')->get();
        return view('home.home',compact('new_imgcar','teache_imgcar','video','examlist'));
    }

    public function video($video_id){
        $videolist=Video::orderBy('video_id','desc')->get();
        $videoplay=Video::where('video_id',$video_id)->first();
        return view('home.video',compact('videolist','videoplay'));
    }

    public function ebook($ebook_id){
        $ebooklist=Ebook::orderBy('ebook_id','desc')->get();
        $ebookplay=Ebook::where('ebook_id',$ebook_id)->first();
        return view('home.ebook',compact('ebooklist','ebookplay','ebooklist'));
    }

    public function exam($exam_id){
        $examlist=Exam::orderBy('exam_id','desc')->get();
        $examplay=Exam::where('exam_id',$exam_id)->first();
        return view('home.exam',compact('examlist','examplay'));
    }

    public function exam_answer($exam_id){
        $exam_answer=Exam::where('exam_id',$exam_id)->pluck('exam_answer')->first();
        return view('home.answer',compact('exam_answer'));
    }

    public function leave(){
        $count=Leave::where('leave_check',1)->count();
        return view('home.message',compact('count'));
    }

    public function upload_leave(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $data=[
                'leave_time'=>$res['data']['leave_time'],
                'leave_person'=>$res['data']['leave_person'],
                'leave_email'=>$res['data']['leave_email'],
                'leave_content'=>$res['leave_content']
            ];
            $result=Leave::create($data);
            if($result){
                $data=[
                    'status'=>1,
                    'msg'=>'留言成功!等待管理员的审核!'
                ];
            }else{
                $data=[
                    'status'=>0,
                    'msg'=>'留言失败!'
                ];
            }
            return $data;
        }
    }

    public function leave_list(Request $request){
        if($request->isMethod('get')){
            $res=$request->input();
            $data=Leave::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->where('leave_check',1)->orderBy('leave_time', 'desc')->get();
            return response()->json([
                'code' => 0,
                'msg' => '',
                'data'=>$data
            ]);
        }
    }

    public function about($about_id){
        $data=About::where('about_id',$about_id)->first();
        return view('home.about',compact('data'));
    }

    public function new_list(Request $request){
        if($request->isMethod('get')){
            $res=$request->input();
            $data=News::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->orderBy('new_time', 'desc')->get();
            return response()->json([
                'code' => 0,
                'msg' => '',
                'data'=>$data
            ]);
        }
    }

    public function news($new_id){
        $news=News::where('new_id',$new_id)->first();
        $newlist=News::orderBy('new_time','desc')->take(6)->get();
        return view('home.news',compact('news','newlist'));
    }
}
