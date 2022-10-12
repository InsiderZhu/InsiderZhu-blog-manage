@extends('layouts.home')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
    </div>
    <!--面包屑导航 结束-->




    <div class="result_wrap">
        <form action="{{url('admin/links/'.$link->link_id)}}" method="post">
        	{{csrf_field()}}
        	<input type="hidden" name="_method" value="put" >
            <table class="add_tab">
                <tbody>

                    <tr>
                        <th><i class="require">*</i>链接名称：</th>
                        <td>
                            <input type="text" class="sm" name="link_name" value="{{$link->link_name}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>链接标题：</th>
                        <td>
                            <input type="text" class="lg" name="link_title"value="{{$link->link_title}}">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>链接网址：</th>
                        <td>
                            <input type="text" class="lg" name="link_url"value="{{$link->link_url}}">
                        </td>
                    </tr>
					
                    <tr>
                    	<th>链接排序：</th>
                        <td>
                           <input type="text" class="sm" name="link_order"value="{{$link->link_order}}">
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
