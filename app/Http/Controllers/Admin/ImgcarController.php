<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Imgcar;
use Illuminate\Support\Facades\Storage;

class ImgcarController extends Controller
{
    public function imgcarlist(){
        return view('admin.imgcarlist');
    }

    public function upload_imgcar(Request $request){
        $file=$request->file('file');
        $clientName = $file -> getClientOriginalName(); //获取文件名称
        $realPath = $file -> getRealPath();  //这个表示的缓存在tmp文件夹下的文件的绝对路径
        $entension = $file -> getClientOriginalExtension();  //上传文件的后缀
        $imgName=date('YmdHis').mt_rand(100,999).'.'.$entension;
        $movepath = $file -> move(base_path().'/uploads/temp',$imgName);
        return response()->json([
            'code' => 0,
            'msg' => '',
            'imgName'=>"$imgName",
            'clientName' => "$clientName"
        ]);
    }

    public function uploadimg(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $data=[
                'img_path'=>'uploads/imgcar/'.$res['imgName'],
                'img_cate'=>$res['img_cate'],
                'img_link'=>$res['img_link'],
            ];
            Storage::disk('upload')->move('/uploads/temp/'.$res['imgName'],'/uploads/imgcar/'.$res['imgName']);
            Imgcar::create($data);
            return redirect('admin/imgcarlist')->with('msg_success','图片上传成功!');
        }
    }

    public function img_list(Request $request){
        $res=$request->input();
        $data=Imgcar::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->orderBy('img_id', 'desc')->get();
        $count=Imgcar::count();
        return response()->json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data'=>$data
        ]);
    }

    public function img_del(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=Imgcar::where('img_id',$res['img_id'])->delete();
            Storage::disk('upload')->delete($res['img_path']);
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

    public function img_edit(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=Imgcar::where('img_id',$res['img_id'])->update(['img_link'=>$res['img_link']]);
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

    public function del_many_img(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            foreach ($res['img_id'] as $key => $value) {
                $img_path=Imgcar::where('img_id',$value)->pluck('img_path')->first();
                Storage::disk('upload')->delete($img_path);
            }
            $result=Imgcar::whereIn('img_id',$res['img_id'])->delete();
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

    public function del_all_img(Request $request){
        if($request->isMethod('post')){
            $result=Imgcar::truncate();
            Storage::disk('upload')->deleteDirectory('uploads/imgcar');
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
