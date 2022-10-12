<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    //访问数据表
    protected $table = 'blog_category';
//主键
    protected $primaryKey = 'cate_id';
//关闭自动维护时间
    public $timestamps = false;
    
    protected $guarded = [];
    //通过递归函数，查找cate_pid来进行递归，将递归的分类节点传到list
    public function get_class_tree($id,$all_class,&$class_tree,$seperator){
        //连接运算符
       $seperator .= '-';
       foreach($all_class as $class){
           if($class['cate_pid']==$id){
               //当cate_pi等同于id的时候就是他的子类
               $new_node = array("cate_id"=>$class['cate_id'],
               "cate_pid"=>$class['cate_pid'],
               "cate_order"=>$class['cate_order'],
               "cate_title"=>$class['cate_title'],
               "cate_view"=>$class['cate_view'],
               "cate_name"=>$class['cate_name'],
               'seperator' => $seperator);
               array_push($class_tree,$new_node);
               $this->get_class_tree($class['cate_id'],$all_class,$class_tree,$seperator);
           }
       }
       return;
   }
   //自定义函数，调用递归函数来获取分类树
   public function tree(){
       //正序排序
       $category = $this->orderBy('cate_order')->get();
       // $category = Category::all();
       //将分类树的数据放入array数组
       $class_tree = array();
       $this->get_class_tree('0',$category,$class_tree,'┡');
       return $class_tree;
   }
   //class_set()和get_class_set()使用递归获取要修改分类的自身cate_id及其下所有子类的cate_id，将它们放在数组$class_set中。
   public function class_set($id){
   	$all_class = Category::orderBy("cate_order","asc")->get();
   	$class_set = [$id];
   	$this->get_class_set($id,$all_class,$class_set);
   	return $class_set;
   }
    
   public function get_class_set($id,$all_class,$class_set){
	   	foreach($all_class as $class){
	   		if($class['cate_pid']==$id){
	   			array_push($class_set,$class['cate_id']);
	   			$this->get_class_set($class['cate_id'],$all_class,$class_set);
	   		}
	   	}
	   	return;
   }
   //获取分类及其子类集合
    public function get_cate_set($id,$all_class,&$cate_set){
        foreach($all_class as $class){
            if($class['cate_pid']==$id){
                array_push($cate_set,$class['cate_id']);
                $this->get_cate_set($class['cate_id'],$all_class,$cate_set);
            }
        }
        return;
    }

}
