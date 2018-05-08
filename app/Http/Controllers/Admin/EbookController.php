<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Ebook;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    //分配页面
    public function ebooklist(){
        return view('admin.ebooklist');
    }

    //列表
    public function ebook_list(Request $request){
        $res=$request->input();
        $data=Ebook::offset(($res['page']-1)*$res['limit'])->limit($res['limit'])->orderBy('ebook_id', 'desc')->get();
        $count=Ebook::count();
        return response()->json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data'=>$data
        ]);
    }

    //前端异步上传过来的书籍，进行处理
    public function upload_ebook(Request $request){
        $file=$request->file('file');
        $clientName = $file -> getClientOriginalName(); //获取文件名称
        $realPath = $file -> getRealPath();  //这个表示的缓存在tmp文件夹下的文件的绝对路径
        $entension = $file -> getClientOriginalExtension();  //上传文件的后缀
        $ebookName=date('YmdHis').mt_rand(100,999).'.'.$entension;
        $movepath = $file -> move(base_path().'/uploads/temp',$ebookName);
        return response()->json([
            'code' => 0,
            'msg' => '',
            'ebookName'=>"$ebookName",
            'clientName' => "$clientName"
        ]);
    }

    //同上，处理书籍封面
    public function upload_thum(Request $request){
        $file=$request->file('file');
        $clientName = $file -> getClientOriginalName(); //获取文件名称
        $realPath = $file -> getRealPath();  //这个表示的缓存在tmp文件夹下的文件的绝对路径
        $entension = $file -> getClientOriginalExtension();  //上传文件的后缀
        $thumName=date('YmdHis').mt_rand(100,999).'.'.$entension;
        $movepath = $file -> move(base_path().'/uploads/temp',$thumName);
        return response()->json([
            'code' => 0,
            'msg' => '',
            'thumName'=>"$thumName",
            'clientName' => "$clientName"
        ]);
    }

    //填好表单后的点击上传过来的数据
    public function uploadebook(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $data=[
                'ebook_name'=>$res['ebook_name'],
                'ebook_path'=>'uploads/ebook/'.$res['ebookName'],
                'ebook_thum'=>'uploads/ebook/'.$res['thumName'],
            ];
            Storage::disk('upload')->move('/uploads/temp/'.$res['ebookName'],'/uploads/ebook/'.$res['ebookName']);
            if($res['thumName']!=""){
                Storage::disk('upload')->move('/uploads/temp/'.$res['thumName'],'/uploads/ebook/'.$res['thumName']);
            }
            Ebook::create($data);
            return redirect('admin/ebooklist')->with('msg_success','电子书上传成功!');
        }
    }

    //删除
    public function ebook_del(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=Ebook::where('ebook_id',$res['ebook_id'])->delete();
            Storage::disk('upload')->delete($res['ebook_path']);
            if($res['ebook_thum']!='uploads/ebook/'){
                Storage::disk('upload')->delete($res['ebook_thum']);
            }
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

    //修改
    public function ebook_edit(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $result=Ebook::where('ebook_id',$res['ebook_id'])->update(['ebook_name'=>$res['ebook_name']]);
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

    //查看
    public function pdf($ebook_id){
        $path=Ebook::where('ebook_id',$ebook_id)->pluck('ebook_path')->first();
        return view('admin.pdf',compact('path'));
    }

    //批量删除
    public function del_many_ebook(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            foreach ($res['ebook_id'] as $key => $value) {
                $ebook_path=Ebook::where('ebook_id',$value)->pluck('ebook_path')->first();
                $ebook_thum=Ebook::where('ebook_id',$value)->pluck('ebook_thum')->first();
                Storage::disk('upload')->delete($ebook_path);
                if($ebook_thum!='uploads/ebook/'){
                    Storage::disk('upload')->delete($ebook_thum);
                }
            }
            $result=Ebook::whereIn('ebook_id',$res['ebook_id'])->delete();
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

    //全部删除
    public function del_all_ebook(Request $request){
        if($request->isMethod('post')){
            $result=Ebook::truncate();
            Storage::disk('upload')->deleteDirectory('uploads/ebook');
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
