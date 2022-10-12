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
        <h3>添加文章</h3>
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
        <form action="{{url('admin/article')}}" method="post">
        	{{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>父级分类：</th>
                        <td>
                            <select name="cate_id">
								@foreach($data as $val)
								<option value="{{$val['cate_id']}}">{{$val['seperator']}}{{$val['cate_name']}}</option>
								@endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>文章标题：</th>
                        <td>
                            <input type="text" class="lg" name="art_title">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th>文章作者：</th>
                        <td>
                            <input type="text" class="lg" name="art_author">
                        </td>
                    </tr>
                    <tr>
                        <th>关键字：</th>
                        <td>
                            <input type="text" class="sm" name="art_keywords">
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
                           <img src=" " id="small_img" style="max-width: 200px;max-height: 100px;" />
                        </td>
                    
                    <tr>
                    	<th>文章描述：</th>
                        <td>
                            <textarea name="art_desceiption"></textarea>
                        </td>
                    </tr>
                    


                    <tr>
                    	<th>文章内容：</th>
                        <td>
		                    <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
						    <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
						    <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
		  					<script name="art_content" id="editor" type="text/plain" style="width:1024px;height:500px;"></script>
		  					<script type="text/javascript">
		  						  var ue = UE.getEditor('editor');
		  					</script>
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
