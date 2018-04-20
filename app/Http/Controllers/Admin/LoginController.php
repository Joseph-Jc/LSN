<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\User;

class LoginController extends Controller{
    public function login(Request $request){
        if($request->isMethod('post')){
            $res=$request->input();
            $user=User::where('username',$res['username'])->get()->first();
            if($user){
                if(Crypt::decrypt($user->password)!=$res['password']){
                    return back()->with('msg','密码错误!');
                }else{
                    $request->session()->put('admin',$user->username);
                    return redirect('admin/index');
                }
            }else{
                return back()->with('msg','用户不存在!');
            }
        }
        return view('admin.login');
    }
}
