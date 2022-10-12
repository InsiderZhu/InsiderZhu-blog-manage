@extends('layouts.home')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 添加文章
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
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>

                </div>
            </div>
            <!--快捷导航 结束-->
        </div>
        <!-- 选择分类获取caergorty数据 -->
        <div class="result_wrap">
            <div class="result_content">

                <table class="list_tab"style="text-align: center;">
                    <tr>
                        <th class="tc">ID</th>
                        <th class="tc">作者</th>
                        <th class="tc">文章标题</th>
                        <th class="tc">发布时间</th>
                        <th class="tc">点击数量</th>
                        <th class="tc">操作</th>
                    </tr>
					
					 @foreach($data as $art)
                    <tr>

                        <td class="art_id">{{$art['art_id']}}</td>
                        <td class="art_author">{{$art['art_author']}} </td>
                        <td class="art_title">{{$art['art_title']}}</td>
                        <td class="art_time">{{$art['art_time']}}</td>
                        <td class="art_views">{{$art['art_views']}}</td>
                        <td>
                            <a href="{{url('admin/article/'.$art['art_id'].'/edit')}}">修改</a>
                            <a href="javascript::" onclick="delArt({{$art['art_id']}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </table>



<div class="page_list">
	<ul>{{$data->links()}}</ul>
	
</div>

            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->



</body>
 <script>

        function delArt(art_id){
        layer.confirm('您确定要删除该文章吗？',{
            btn:['确定','取消']
        },function(){
            $.ajax({
            	type:"post",
            	url:"{{url('/admin/article/"+art_id+"')}}",
            	data:{_token:'{{csrf_token()}}',_method:'delete',art_id:art_id},
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
    <style>
    	.result_content ul li span{padding: 6px 12px;text-decoration: none;};
    </style>
</html>
