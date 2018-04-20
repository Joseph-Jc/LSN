<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\News;

class NewsController extends Controller
{
    //学校公告视图
    public function newlist(){
        return view('admin.newlist');
    }

    //table列表
    public function new_list(Request $request){
        $res=$request->input();
        $new=News::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->orderBy('new_id', 'desc')->get();
        $count=News::count();
        return response()->json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data'=>$new
        ]);
    }

    //提交编辑内容，判断文章是否存在，存在就修改，不存在就添加新文章
    public function newedit(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $data=[
                'new_title'=>$res['data']['new_title'],
                'new_author'=>$res['data']['new_author'],
                'new_time'=>$res['data']['new_time'],
                'new_summary'=>$res['data']['new_summary'],
                'new_content'=>$res['new_content']
            ];
            $whether=News::where('new_id',$res['data']['new_id'])->get();
            if(!$whether->isEmpty()){
                $result=News::where('new_id',$res['data']['new_id'])->update($data);
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
                $result=News::create($data);
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
        return view('admin.newedit');
    }

    //编辑文章，分配初始内容
    public function new_edit(Request $request,$new_id){
        $res=$request->input();
        $data=News::find($new_id);
        return view('admin.newedit',compact('data'));
    }

    //工具条删除
    public function new_del(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=News::where('new_id',$res['new_id'])->delete();
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
    public function del_many_new(Request $request){
        if($request->isMethod('post')){
            $res=$request->input('new_id');
            $result=News::whereIn('new_id',$res)->delete();
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
    public function del_all_new(Request $request){
        if($request->isMethod('post')){
            $result=News::truncate();
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
