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
use App\Http\Model\Admin\Aboutcate;
use App\Http\Model\Admin\News;

class HomeController extends Controller
{
    //分配首页数据
    public function home(){
        $new_imgcar=Imgcar::where('img_cate','新闻')->get();
        $teache_imgcar=Imgcar::where('img_cate','教师团队')->get();
        $video=Video::orderBy('video_id','desc')->take(5)->get();
        $examlist=Exam::orderBy('exam_id','desc')->take(7)->get();
        $lesson_intro=About::where('about_title','课程简介')->first();
        $prinpical=About::where('about_title','课程负责人')->first();
        return view('home.home',compact('new_imgcar','teache_imgcar','video','examlist','lesson_intro','prinpical'));
    }

    //分配视频页数据
    public function video($video_id){
        $videolist=Video::orderBy('video_id','desc')->get();
        $videoplay=Video::where('video_id',$video_id)->first();
        if($videoplay==null){
            return redirect('nopage');
        }else{
            return view('home.video',compact('videolist','videoplay'));
        }
    }

    //分配书籍页数据
    public function ebook($ebook_id){
        $ebooklist=Ebook::orderBy('ebook_id','desc')->get();
        $ebookplay=Ebook::where('ebook_id',$ebook_id)->first();
        if($ebookplay==null){
            return redirect('nopage');
        }else{
            return view('home.ebook',compact('ebooklist','ebookplay'));
        }
    }

    //分配试题页数据
    public function exam($exam_id){
        $examlist=Exam::orderBy('exam_id','desc')->get();
        $examplay=Exam::where('exam_id',$exam_id)->first();
        if($examplay==null){
            return redirect('nopage');
        }else{
            return view('home.exam',compact('examlist','examplay'));
        }
    }

    //试题答案
    public function exam_answer($exam_id){
        $exam_answer=Exam::where('exam_id',$exam_id)->pluck('exam_answer')->first();
        return view('home.answer',compact('exam_answer'));
    }

    //获取留言数目
    public function leave(){
        $count=Leave::where('leave_check',1)->count();
        return view('home.message',compact('count'));
    }

    //提交留言
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

    //留言列表数据
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

    //课程相关页面
    public function about($about_cate_id,$about_id){
        $data=About::where('about_id',$about_id)->first();
        $aboutlist=About::where('about_cate_id',$about_cate_id)->get();
        $aboutcatename=Aboutcate::where('about_cate_id',$about_cate_id)->pluck('about_cate_name')->first();
        if($data==null){
            return redirect('nopage');
        }else{
            return view('home.about',compact('data','aboutlist','aboutcatename'));
        }
    }

    //使用重定向打开默认的
    public function aboutdefault($about_cate_id){
        $about_id=About::where('about_cate_id',$about_cate_id)->pluck('about_id')->first();
        if($about_id==null){
            return redirect('nopage');
        }else{
            return redirect('about/'.$about_cate_id.'/'.$about_id);
        }
    }

    //首页的公告异步分页列表
    public function new_list(Request $request){
        if($request->isMethod('get')){
            $res=$request->input();
            $data=News::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->orderBy('new_id', 'desc')->get();
            return response()->json([
                'code' => 0,
                'msg' => '',
                'data'=>$data
            ]);
        }
    }

    //公告页列表
    public function news($new_id){
        $news=News::where('new_id',$new_id)->first();
        $newlist=News::orderBy('new_id','desc')->take(6)->get();
        return view('home.news',compact('news','newlist'));
    }
}
