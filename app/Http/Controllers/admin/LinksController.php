<?php

namespace App\Http\Controllers\admin;
use App\Model\Links;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    //
        public function index(Request $request){
    	$data = Links::orderBy('link_id',"desc")->paginate(1);
    	return view('admin.links.index',compact('data',$data));
		}
		
		public function create(){
			return view("admin.links.add");
		}
		
		public function changerOrder(Request $request){
           $input = $request->all();
           $link = Links::find($input['link_id']);
           $link->link_order = $input['link_order'];
           $result = $link->update();
           if($result){
           $data = [
               'status' => 0,
               'msg' => '排序更新成功！'
           ];
           }else{
               $data = [
                   'status' => 1,
                   'msg' => '排序更新失败！'
               ];
           };
           return $data;
       }
       
       
       public function store(Request $request){
		$input=$request->except('_token');
		$rules = [
					'link_name'=>'required',
					'link_title'=>'required',
					'link_url'=>'required'
			];  //建立验证规则
			$message = [
					'link_name.required'=>'链接名称不能为空',
					'link_title.required'=>'链接标题不能为空',
					'link_url.required'=>'链接网址不能为空'
			]; //输入错误时提示信息
			$validator = Validator::make($input,$rules,$message); //Validator服务进行验证
			if($validator->passes()){   //如果验证通过,在分类数据表Category中插入一条新分类记录
				$result = Links::create($input);
				if($result){
					return redirect('admin/links');
				}else{
					return back()->with('msg','添加链接失败!');
				}
			}else{    //验证不通过返回出错提示

				return back()->withErrors($validator);
			}
    }
    public function destroy(Request $request){
    	$input = $request ->all();
    	$result=Links::where('link_id',$input['link_id'])->delete();
        if($result){
        	$data=[
        		'status'=>0,
        		'msg'=>"分类删除成功"
        	];
        }else{
        	$data=[
        		'status'=>1,
        		'msg'=>"分类删除失败"
        	];
        }
        return $data;
    }
    
    
	public function edit($link_id){
		$link = Links::find($link_id);
    	return view('admin.links.edit',compact('link',$link));
	}
	
	//跟新文章
    public function update(Request $request,$link_id){
    	$input=$request->except('_token','_method');
    	$result = Links::where('link_id',$link_id)->update($input);
		if($result){
				return redirect('admin/links');
		}else{
				return back()->with('msg','编辑链接失败!');
		}
    }
}
