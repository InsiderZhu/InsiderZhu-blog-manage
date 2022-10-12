<?php

namespace App\Http\Controllers\admin;
use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    //储存提交的分类
    public function store(Request $request){
	$input=$request->except('_token');
		$rules = [
					'cate_name'=>'required',
					'cate_title'=>'required',
			];  //建立验证规则
			$message = [
					'cate_name.required'=>'分类名称不能为空',
					'cate_title.required'=>'分类标题不能为空',
			]; //输入错误时提示信息
			$validator = Validator::make($input,$rules,$message); //Validator服务进行验证
			if($validator->passes()){   //如果验证通过,在分类数据表Category中插入一条新分类记录
				$result = Category::create($input);
				if($result){
					return redirect('admin/category');
				}else{
					return back()->with('msg','添加分类失败!');
				}
			}else{    //验证不通过返回出错提示

				return back()->withErrors($validator);
			}
    }
    
    
     //显示全部分类
    public function index(Request $request){
    	//读取当前的页数
    	if($request -> has('page')){
    		$curr_page = $request->input('page');
    		$curr_page = $curr_page<=0 ? 1:$curr_page;
    	}else{
    		$curr_page = 1;
    	}
    	//设置每页的记录数
    	$perPage = 5;
    	$offset = ($curr_page-1)*$perPage;
    	//获取总的分类数
    	$category = new Category();
    	$class_tree = $category->tree();
    	$total = count($class_tree);
    	$item = array_slice($class_tree,$offset,$perPage);
    	//手动创建分页类
    	$cates = new LengthAwarePaginator(
    		$item,$total,$perPage,$curr_page,[
    		'path'=>Paginator::resolveCurrentPath(),
    		'PageName'=>'page',
    		]
    	);
    	
//      $class_tree = (new Category())->tree();
//      //将classtree分类树数据传输到list页面
    	return view("admin.list")->with('cates',$cates);
	
    }
       public function changerOrder(Request $request){
           $input = $request->all();
           $cate_id = $input['id'];
           $order = $input['order'];
           $cate = Category::where('cate_id',$cate_id)->first();
           $cate->cate_order = $order;
           $res = $cate->update();
           if($res){
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
       
       
    //创建分类
    public function create(){
		$data = (new Category())->tree();
		return view('admin.category.add')->with('data',$data);
    }
    //显示单个分类
    public function show(){
		
    }
    
    //编辑分类
    public function edit($cate_id){
    	$cate = Category::find($cate_id);
    	$data = (new Category())->tree();
    	return view('admin.category.edit',compact('cate','data'));
    }
    //跟新分类
    public function update(Request $request,$cate_id){
    	//执行update操作之前，检查要修改的父级分类id是否存在于数组$class_set中，如果存在则显示“父级分类非法”并拒绝修改。
    	$class_set=(new Category())->class_set($cate_id);
    	$input=$request->except('_token','_method');
    	$flag=false;
    	foreach($class_set as $class_id){
    		if($class_id == $input['cate_pid']){
    			$flag = true;
    		}
    	}
    	if($flag){
    		return back()->with('msg',"父级非法分类");
    	}else{
    		$rules = [
					'cate_name'=>'required',
					'cate_title'=>'required',
					'cate_order'=>'required|numeric'
			];  //建立验证规则
			$message = [
					'cate_name.required'=>'分类名称不能为空',
					'cate_title.required'=>'分类标题不能为空',
					'cate_order.required'=>'分类排序不能为空',
					'cate_order.numeric'=>'分类排序必需为数字'
			]; //输入错误时提示信息
			$validator = Validator::make($input,$rules,$message); //Validator服务进行验证
    	}
    	
    	$result = Category::where('cate_id',$cate_id)->update($input);
		if($result){
				return redirect('admin/category');
		}else{
				return back()->with('msg','编辑分类失败!');
		}
    }
    
    public function destroy(Request $request){
    	$input=$request->all();
        $cate_set=array($input['cate_id']);
        $all_class=Category::orderBy('cate_order','asc')->get();
        (new Category())->get_cate_set($input['cate_id'],$all_class,$cate_set);
        $flag=true;
        foreach($cate_set as $cate){
            $result=Category::where('cate_id',$cate)->delete();
            if(!$result){
                $flag=false;
            }
        }

        if($flag){
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
		
		
	    
}
