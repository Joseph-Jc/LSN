<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Leave;

class LeaveController extends Controller
{
    public function leavelist(){
        return view('admin.leavelist');
    }

    public function leavelist_check(Request $request){
        $res=$request->input();
        $leavelist_check=Leave::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->where('leave_check',0)->orderBy('leave_id', 'desc')->get();
        $count=Leave::count();
        return response()->json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data'=>$leavelist_check
        ]);
    }
    public function leave_list(Request $request){
        $res=$request->input();
        $leavelist=Leave::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->where('leave_check',1)->orderBy('leave_id', 'desc')->get();
        $count=Leave::count();
        return response()->json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data'=>$leavelist
        ]);
    }

    public function leave_del(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=Leave::where('leave_id',$res['leave_id'])->delete();
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

    public function leave_check(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=Leave::where('leave_id',$res['leave_id'])->update(['leave_check'=>1]);
            if($result){
                $data=[
                    'status'=>1,
                    'msg'=>'审核成功!'
                ];
            }else{
                $data=[
                    'status'=>0,
                    'msg'=>'审核失败!'
                ];
            }
            return $data;
        }
    }

    public function check_many(Request $request){
        if($request->isMethod('post')){
            $res=$request->input('leave_id');
            $result=Leave::whereIn('leave_id',$res)->update(['leave_check'=>1]);
            if($result){
                $data=[
                    'status'=>1,
                    'msg'=>'审核成功!'
                ];
            }else{
                $data=[
                    'status'=>0,
                    'msg'=>'审核失败!'
                ];
            }
            return $data;
        }
    }

    public function del_many(Request $request){
        if($request->isMethod('post')){
            $res=$request->input('leave_id');
            $result=Leave::whereIn('leave_id',$res)->delete();
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

    //全部删除未审核的留言
    public function del_all(Request $request){
        if($request->isMethod('post')){
            $result=Leave::where('leave_check',0)->delete();
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

    public function del_many_checked(Request $request){
        if($request->isMethod('post')){
            $res=$request->input('leave_id');
            $result=Leave::whereIn('leave_id',$res)->delete();
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

    //全部删除已审核的留言
    public function del_all_checked(Request $request){
        if($request->isMethod('post')){
            $result=Leave::where('leave_check',1)->delete();
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
