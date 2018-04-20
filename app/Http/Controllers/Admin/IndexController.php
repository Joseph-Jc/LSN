<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\User;
use Illuminate\Support\Facades\Crypt;

class IndexController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function info(){
        return view('admin.info');
    }

    public function logout(Request $request){
        $request->session()->forget('admin');
        return redirect('adminer');
    }

    public function edit_nickname(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=User::where('username',session('admin'))->update(['nickname'=>$res['nickname']]);
            if($result){
                $data=[
                    'status'=>1,
                    'msg'=>'修改成功!'
                ];
            }else{
                $data=[
                    'status'=>0,
                    'msg'=>'修改失败!'
                ];
            }
            return $data;
        }
    }

    public function edit_password(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=User::where('username',session('username'))->update(['password'=>Crypt::encrypt($res['password'])]);
            if($result){
                $data=[
                    'status'=>1,
                    'msg'=>'修改成功!'
                ];
            }else{
                $data=[
                    'status'=>0,
                    'msg'=>'修改失败!'
                ];
            }
            return $data;
        }
    }

    public function upload_img(Request $request){
        $file=$request->file('img');
        $clientName = $file -> getClientOriginalName(); //获取文件名称
        $realPath = $file -> getRealPath();  //这个表示的缓存在tmp文件夹下的文件的绝对路径
        $entension = $file -> getClientOriginalExtension();  //上传文件的后缀
        $aboutName=date('YmdHis').mt_rand(100,999).'.'.$entension;
        $movepath = $file -> move(base_path().'/uploads/images',$aboutName);
        $path=url('uploads/images')."/".$aboutName;
        return response()->json([
            "errno" => 0,
            "data" => [
                $path
            ]
        ]);
    }
}
