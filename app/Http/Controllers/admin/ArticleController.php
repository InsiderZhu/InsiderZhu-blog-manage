<?php
namespace App\Http\Controllers\admin;
use App\Model\Article;
use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommController
{
    //
    //显示全部文章
    public function index(Request $request){
    	$data = Article::orderBy('art_id',"desc")->paginate(5);//Eloquento模型的paginate方法实现分页
    	return view('admin.article.index',compact('data',$data));
	
    }
	//创建文章
    public function create(){
    	$data = (new Category())->tree();
    	return view('admin.article.add')->with('data',$data);
    }
    
    //提交添加文章
    	public function store(Request $request){
		$input = $request ->except('_token');
		$input['art_time']=date('Y-m-d H:i:s');
		$rules = [
					'art_title'=>'required',
			];  //建立验证规则
			$message = [
					'art_title.required'=>'文章标题不能为空',
			]; //输入错误时提示信息
			$validator = Validator::make($input,$rules,$message); //Validator服务进行验证
			if($validator->passes()){   //如果验证通过,在分类数据表Category中插入一条新分类记录
				$result = Article::create($input);
				if($result){
					return redirect('admin/article');
				}else{
					return back()->with('msg','添加文章失败!');
				}
			}else{    //验证不通过返回出错提示

				return back()->withErrors($validator);
			}
		
	}
	
	public function edit($art_id){
		$art = Article::find($art_id);
    	$data = (new Category())->tree();
    	return view('admin.article.edit',compact('art','data'));
	}
	
	//跟新文章
    public function update(Request $request,$art_id){
    	$input=$request->except('_token','_method');
    	$result = Article::where('art_id',$art_id)->update($input);
		if($result){
				return redirect('admin/article');
		}else{
				return back()->with('msg','编辑文章失败!');
		}
    }
    
    	
	public function destroy(Request $request){
    	$input=$request->all();
        $result=Article::where('art_id',$input['art_id'])->delete();
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
}
