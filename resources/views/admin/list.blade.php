@extends('layouts.home')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
    </div>
    <!--面包屑导航 结束-->

<div>

    </div>


    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>新增分类</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>
        <!-- 选择分类获取caergorty数据 -->
        <div class="result_wrap">
            <div class="result_content">

                <table class="list_tab"style="text-align: center;">
                    <tr>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th class="tc">分类名称</th>
                        <th class="tc">标题</th>
                        <th class="tc">点击</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($cates as $cate)
                    <tr>
                        <td class="tc">
                            <!-- <input type="text" value="{{$cate['cate_order']}}"> -->
                            <input type="text" onchange="changeOrder(this,{{$cate['cate_id']}})" value="{{$cate['cate_order']}}">
                        </td>
                        <td class="tc">{{$cate['cate_id']}}</td>
                        <td>
                            <a href="#">{{$cate['seperator']}}{{$cate['cate_name']}}</a>
                        </td>
                        <td>{{$cate['cate_title']}}</td>
                        <td>{{$cate['cate_view']}}</td>
                        <td>
                            <a href="{{url('admin/category/'.$cate['cate_id'].'/edit')}}">修改</a>
                            <a href="javascript::" onclick="delCate({{$cate['cate_id']}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>



<div class="page_nav">
{!!$cates->appends(request()->input())->render()!!}
</div>

            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->



</body>
 <script>
        function changeOrder(obj,id){
            var order = $(obj).val();
            $.ajax({
                type:"post",
                url:"{{url('/admin/category/changeOrder')}}",
                data:{_token:'{{csrf_token()}}',id:id,order:order},
                success:function(data){
                    if(data.status==0){
                        layer.msg(data.msg,{icon:6});
                    }else{
                        layer.msg(data.msg,{icon:5});
                    }
                }
            });
        };
        function delCate(cate_id){
        layer.confirm('您确定要删除分类及其下所有子类吗？',{
            btn:['确定','取消']
        },function(){
            $.ajax({
            	type:"post",
            	url:"{{url('/admin/category/"+cate_id+"')}}",
            	data:{_token:'{{csrf_token()}}',_method:'delete',cate_id:cate_id},
            	success:function(data){
            		if(data.status==0){
                        location.href=location.href;
            			layer.msg(data.msg,{icon:6});
            		}else{
            			layer.msg(data.msg,{icon:5});
            		}
            	}
            });
            //layer.msg('的确很重要',{icon:1});
        },function(){

        });
        }
    </script>
</html>
