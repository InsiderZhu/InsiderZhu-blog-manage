<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommController extends Controller
{
    //
	public function upload(Request $request){
		$file = $request->file('Filedata');
	     
	//   dd($file);
	     if($file -> isValid()){//检查上传文件是否有效
	      $clientName = $file->getClientOriginalName();//获取文件名称
	      $tmpName = $file -> getFileName();//缓存tmp文件夹中的临时文件名，例如php9372.tmp这种类型
	      $realPath = $file ->getRealPath();//这个表示的缓存在tmp文件夹下的文件绝对路径
	      $extension = $file ->getClientOriginalExtension();//上传文件的后坠
	      $mimeTye = $file ->getMimeType();
	      
	      $newName = md5(date('ymdhis').$clientName).'.'.$extension;
	      $path = $file ->move(app_path().'/storage/uploads',$newName);
	      return "uploads/".$newName;
	     }
	}

}
