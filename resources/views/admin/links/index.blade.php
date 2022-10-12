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
                    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>新增链接</a>

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
                        <th class="tc">友情链接名称</th>
                        <th class="tc">友情链接标题</th>
                        <th class="tc">链接网址</th>
                        <th class="tc">操作</th>
                    </tr>
					
					 @foreach($data as $link)
                    <tr>
                        <td class="tc">
                            <!-- <input type="text" value="{{$link['link_order']}}"> -->
                            <input type="text" onchange="changeOrder(this,{{$link['link_id']}})" value="{{$link['link_order']}}">
                        </td>
                        <td class="link_id">{{$link['link_id']}}</td>
                        <td class="link_name">{{$link['link_name']}} </td>
                        <td class="link_title">{{$link['link_title']}}</td>
                        <td class="link_url">{{$link['link_url']}}</td>
                        <td>
                            <a href="{{url('admin/links/'.$link['link_id'].'/edit')}}">修改</a>
                            <a href="javascript::" onclick="delLink({{$link['link_id']}})">删除</a>
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

	  function changeOrder(obj,link_id){
            var link_order = $(obj).val();
            $.ajax({
                type:"post",
                url:"{{url('/admin/links/changeOrder')}}",
                data:{_token:'{{csrf_token()}}',link_id:link_id,link_order:link_order},
                success:function(data){
                    if(data.status==0){
                        layer.msg(data.msg,{icon:6});
                    }else{
                        layer.msg(data.msg,{icon:5});
                    }
                }
            });
        };
		
        function delLink(link_id){
        layer.confirm('您确定要删除该链接吗？',{
            btn:['确定','取消']
        },function(){
            $.ajax({
            	type:"post",
            	url:"{{url('/admin/links/"+link_id+"')}}",
            	data:{_token:'{{csrf_token()}}',_method:'delete',link_id:link_id},
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
