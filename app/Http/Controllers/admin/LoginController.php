<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Model\User;
require_once "resources/views/org/code/Code.class.php";
class LoginController extends CommController
{
    //
    public function login(Request $request){
    	if($input = $request->all()){
    		$code = new \Code();
    		$_code = $code->get();

    		if(strtoupper($input['code'])!=$_code){
    			return back()->with('msg',"验证码错误");
    		}else{
    			$isAuth = false;
    			$users = User::where("username",$input['username'])->get();
    			//dd(Crypt::decrypt($user['password']));

    			//dd($user);
    			foreach($users as $user){
    				if(Crypt::decrypt($user->password)==$input['password']){
    					$isAuth = true;
    					session(['username'=>$input['username']]);
    					session(['password'=>$user->password]);
    					break;
    				}
    			}
    			if($isAuth){
    				return view("/admin/index");
    			}else{
    				return back()->with('msg',"用户名或者密码错误");
    			}
    		}

    	}else{
    		return view("admin.login");
    	}

    }

    public function code(){
    	$code = new \Code();
    	$code->make();
    }

    public function test(){
    	echo Crypt::encrypt("123456");
    	//123456
    }

}
