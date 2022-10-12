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
        <form action="{{url('admin/category/'.$cate->cate_id)}}" method="post">
        	{{csrf_field()}}
        	<input type="hidden" name="_method" value="put" >
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>父级分类：</th>
                        <td>
                            <select name="cate_pid">
                                <option value="0">==顶级分类==</option>
								@foreach($data as $val)
								@if($val['cate_id']==$cate->cate_pid)
								<option selected value="{{$val['cate_id']}}">{{$val['seperator']}}{{$val['cate_name']}}</option>
								@else
								<option value="{{$val['cate_id']}}">{{$val['seperator']}}{{$val['cate_name']}}</option>
								@endif
								@endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>分类名称：</th>
                        <td>
                            <input type="text" name="cate_name" value="{{$cate->cate_name}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>分类标题：</th>
                        <td>
                            <input type="text" class="lg" name="cate_title" value="{{$cate->cate_title}}">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>

                    <tr>
                        <th>关键字：</th>
                        <td>
                            <input type="text" class="sm" name="cate_keywords" value="{{$cate->cate_keywords}}">
                        </td>
                    </tr>
                    <tr>
                    	<th>分类描述：</th>
                        <td>
                            <textarea name="cate_description" >{{$cate->cate_description}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>分类排序：</th>
                        <td>
                            <input type="text" class="lg" name="cate_order" value="{{$cate->cate_order}}">
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
