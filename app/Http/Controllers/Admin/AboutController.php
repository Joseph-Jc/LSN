<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\About;
use App\Http\Model\Admin\Aboutcate;

class AboutController extends Controller
{
    //分配页面
    public function aboutlist(){
        return view('admin.aboutlist');
    }

    //列表
    public function about_list(Request $request){
        $res=$request->input();
        $about=About::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->orderBy('about_id', 'desc')->get();
        $count=About::count();
        return response()->json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data'=>$about
        ]);
    }

    //编辑文章
    public function aboutedit(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $data=[
                'about_cate_id'=>$res['data']['about_cate_id'],
                'about_title'=>$res['data']['about_title'],
                'about_author'=>$res['data']['about_author'],
                'about_time'=>$res['data']['about_time'],
                'about_summary'=>$res['data']['about_summary'],
                'about_content'=>$res['about_content']
            ];
            $whether=About::where('about_id',$res['data']['about_id'])->get();
            if(!$whether->isEmpty()){
                $result=About::where('about_id',$res['data']['about_id'])->update($data);
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
                $result=About::create($data);
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
        $aboutcate=Aboutcate::get()->all();     //获取分类
        return view('admin.aboutedit',compact('aboutcate'));
    }

    //给编辑页面分配数据
    public function about_edit(Request $request,$about_id){
        $res=$request->input();
        $data=About::find($about_id);
        $aboutcate=Aboutcate::get()->all();     //获取分类
        return view('admin.aboutedit',compact('data','aboutcate'));
    }

    //删除
    public function about_del(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=About::where('about_id',$res['about_id'])->delete();
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
    public function del_many_about(Request $request){
        if($request->isMethod('post')){
            $res=$request->input('about_id');
            $result=About::whereIn('about_id',$res)->delete();
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
    public function del_all_about(Request $request){
        if($request->isMethod('post')){
            $result=About::truncate();
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
