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
        <form action="{{url('admin/article/'.$art->art_id)}}" method="post">
        	{{csrf_field()}}
        	<input type="hidden" name="_method" value="put" >
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>文章分类：</th>
                        <td>
                            <select name="cate_id">
                                <option value="0">==顶级分类==</option>
								@foreach($data as $val)
								@if($val['cate_id']==$art->cate_id)
								<option selected value="{{$val['cate_id']}}">{{$val['seperator']}}{{$val['cate_name']}}</option>
								@else
								<option value="{{$val['cate_id']}}">{{$val['seperator']}}{{$val['cate_name']}}</option>
								@endif
								@endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>文章标题：</th>
                        <td>
                            <input type="text" class="lg" name="art_title" value="{{$art->art_title}}">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th>文章作者：</th>
                        <td>
                            <input type="text" name="art_author" value="{{$art->art_author}}">
                        </td>
                    </tr>


                    <tr>
                        <th>关键字：</th>
                        <td>
                            <input type="text" class="sm" name="art_keywords" value="{{$art->art_keywords}}">
                        </td>
                    </tr>
                    
                    <tr>
                        <th>缩略图：</th>
                        <td>
                            <input type="text" name="art_photo">
                            <input id="file_upload" name="file_upload" type="file" multiple="true">
                            <style>
                                .uploadify{display:inline-block;}
                                .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                                table.add_tab tr td span.uploadify-button-text{color:#FFF; margin:0;}
                            </style>
                            <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                            <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
                            <script type="text/javascript">
                             <?php $timestamp = time();?>
                             $(function() {
                              $('#file_upload').uploadify({
                                        'buttonText' : '上传图片',
                               'formData'     : {
                                'timestamp' : '<?php echo $timestamp;?>',
                                '_token'    : "{{csrf_token()}}"
                               },
                               'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                               'uploader' : "{{url('admin/upload')}}",
                                        'onUploadSuccess' : function(file,data,response){
                                            $("input[name='art_photo']").val(data);
                                            $("#small_img").attr("src",'/blog/app/storage/'+data);
                                             //alert(data);
                                        }
                                       
                              });
                             });
                            </script>
                        </td>
                    </tr> 
                    <th></th>
                        <td>
                           <img src="\blog\app\storage\{{$art->art_photo}} " id="small_img" style="max-width: 200px;max-height: 100px;" />
                        </td>
                    <tr>
                    	<th>文章描述：</th>
                        <td>
                            <textarea name="art_desceiption" >{{$art->art_desceiption}}</textarea>
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
