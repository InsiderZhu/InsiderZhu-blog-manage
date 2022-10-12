<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Session\Middleware\AuthenticateSession::class,

class IndexController extends CommController
{
    //
    public function index(){
    	return view("admin.index");
    }
    public function info(){
    	return view("admin.info");
    }

    public function logout(){
    	session(['username'=>null]);
    	return redirect("/admin/login");
    }
    public function pass(Request $request){
    	//request收集如果input输入框
    	if($input=$request->all()){
    		//检查password_o输入框内输入的内容与自己的原密码是否一致
    		if(Crypt::decrypt(session('password'))==$input['password_o']){
    			//如果一致的话那么将session中保存的密码进行解密然后在进行比对
    			$rules = [
                    //定义Validator自带的方法
    				'password'=>'required|between:6,20|confirmed',
    			];
                //定义自己想要输出的内容
    			$message = [
    				'password.required'=>"新密码不能为空",
    				'password.between'=>"新密码必须在6-20位之间",
    				'password.confirmed'=>"两次输入密码不一致",
    			];
                //储存到$validator中去
    			$validator = Validator::make($input,$rules,$message);
    			if($validator->passes()){
                    //将username使用first变为一维数组给$user
                    $user = User::where("username",session('username'))->first();
                    //加密密码处理
    				$user->password = Crypt::encrypt($input['password']);
                    //保存
    				$user->save();
                    //修改密码成功时显示
    				return back()->with('msg',"密码修改成功！");
    			}else{
                    //否侧显示
    				return back()->withErrors($validator);
    			}
    		}else{
    				//否则通过展示信息在pass页面中输出
    		return back()->with('msg',"原密码输入错误了！");
    		}
    	//如果密码正确则返回pass页面
    	}else{
    		return view("admin.pass");
    	}


    }

}
