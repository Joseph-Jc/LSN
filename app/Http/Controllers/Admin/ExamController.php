<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Exam;

class ExamController extends Controller
{
    //分配模拟试题视图
    public function examlist(){
        return view('admin.examlist');
    }

    //table列表
    public function exam_list(Request $request){
        $res=$request->input();
        $exam=Exam::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->orderBy('exam_id', 'desc')->get();
        $count=Exam::count();
        return response()->json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data'=>$exam
        ]);
    }

    //提交编辑内容，判断文章是否存在，存在就修改，不存在就添加新文章
    public function examedit(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $data=[
                'exam_title'=>$res['data']['exam_title'],
                'exam_author'=>$res['data']['exam_author'],
                'exam_time'=>$res['data']['exam_time'],
                'exam_summary'=>$res['data']['exam_summary'],
                'exam_content'=>$res['exam_content'],
                'exam_answer'=>$res['exam_answer']
            ];
            if($res['data']['exam_id']!=""){
                $result=Exam::where('exam_id',$res['data']['exam_id'])->update($data);
                if($result){
                    $data=[
                        'status'=>1,
                        'msg'=>'提交成功!'
                    ];
                }else{
                    $data=[
                        'status'=>0,
                        'msg'=>'提交失败!'
                    ];
                }
                return $data;
            }else{
                $result=Exam::create($data);
                if($result){
                    $data=[
                        'status'=>1,
                        'msg'=>'提交成功!'
                    ];
                }else{
                    $data=[
                        'status'=>0,
                        'msg'=>'提交失败!'
                    ];
                }
                return $data;
            }
        }
        return view('admin.examedit');
    }

    //编辑文章，分配初始内容
    public function exam_edit(Request $request,$exam_id){
        $res=$request->input();
        $data=Exam::find($exam_id);
        return view('admin.examedit',compact('data'));
    }

    //工具条删除
    public function exam_del(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=Exam::where('exam_id',$res['exam_id'])->delete();
            if($result){
                $data=[
                    'status'=>1,
                    'msg'=>'删除成功!'
                ];
            }else{
                $data=[
                    'status'=>0,
                    'msg'=>'删除失败!'
                ];
            }
            return $data;
        }
    }

    //批量删除
    public function del_many_exam(Request $request){
        if($request->isMethod('post')){
            $res=$request->input('exam_id');
            $result=Exam::whereIn('exam_id',$res)->delete();
            if($result){
                $data=[
                    'status'=>1,
                    'msg'=>'删除成功!'
                ];
            }else{
                $data=[
                    'status'=>0,
                    'msg'=>'删除失败!'
                ];
            }
            return $data;
        }
    }

    //全部删除
    public function del_all_exam(Request $request){
        if($request->isMethod('post')){
            $result=Exam::truncate();
            if($result){
                $data=[
                    'status'=>1,
                    'msg'=>'删除成功!'
                ];
            }else{
                $data=[
                    'status'=>0,
                    'msg'=>'删除失败!'
                ];
            }
            return $data;
        }
    }
}
