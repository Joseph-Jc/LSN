<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Footnav;

class FootnavController extends Controller
{
    public function footnav(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $data=[
                'footnav_name'=>$res['footnav_name'],
                'footnav_link'=>$res['footnav_link']
            ];
            $result=Footnav::create($data);
        }
        return view('admin.footnav');
    }

    public function footnav_list(Request $request){
        $res=$request->input();
        $footnav=Footnav::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->orderBy('footnav_id', 'desc')->get();
        $count=Footnav::count();
        return response()->json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data'=>$footnav
        ]);
    }

    public function footnav_del(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=Footnav::where('footnav_id',$res['footnav_id'])->delete();
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
    public function del_many_footnav(Request $request){
        if($request->isMethod('post')){
            $res=$request->input('footnav_id');
            $result=Footnav::whereIn('footnav_id',$res)->delete();
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
    public function del_all_footnav(Request $request){
        if($request->isMethod('post')){
            $result=Footnav::truncate();
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
