@extends('layouts.home')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>添加链接</h3>
       @if(count($errors)>0)
       	<div class="mark">
       		@foreach($errors->all() as $error)
       		<p>{{$error}}</p>
       		@endforeach
       	</div>
       	@endif
        	@if(session('msg'))
        	<div class="mark">{{session('msg')}}</div>
        @endif

    </div>
</div>
<!--结果集标题与导航组件 结束-->


    <div class="result_wrap">
        <form action="{{url('admin/links')}}" method="post">
        	{{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th><i class="require">*</i>链接名称：</th>
                        <td>
                            <input type="text" class="sm" name="link_name">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>链接标题：</th>
                        <td>
                            <input type="text" class="lg" name="link_title">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>链接网址：</th>
                        <td>
                            <input type="text" class="lg" name="link_url">
                        </td>
                    </tr>
					
                    <tr>
                    	<th>链接排序：</th>
                        <td>
                           <input type="text" class="sm" name="link_order">
                        </td>
                    </tr>       

              
                     <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

</body>
@endsection
