<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
    <meta charset="utf-8">
    <title>后台管理-课程相关</title>
    <link rel="stylesheet" href="{{asset('public/plugins/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('public/admin/build/css/aboutedit.css')}}" media="all">
</head>
<body>
    <div class="site-text site-block">
        <form class="layui-form">
            <input type="hidden" name="about_time" value="<?php echo date('Y-m-d H:i:s');?>">
            <input type="hidden" name="about_id" value="@if(isset($data)){{$data->about_id}}@endif">
            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                    <input style="width:70%" type="text" name="about_title" lay-verify="required|title" placeholder="请输入标题" autocomplete="off" class="layui-input" value="@if(isset($data)){{$data->about_title}}@endif">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发布人</label>
                    <div class="layui-input-block">
                    <input style="width:30%" type="text" name="about_author" lay-verify="required|name" placeholder="请输入发布人" autocomplete="off" class="layui-input" value="@if(isset($data)){{$data->about_author}}@else{{$nickname}}@endif">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">概述</label>
                <div class="layui-input-block">
                    <textarea style="width:60%" name="about_summary" lay-verify="summary" placeholder="请输入内容" class="layui-textarea">@if(isset($data)){!!$data->about_summary!!}@endif</textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">内容</label>
                <div class="layui-input-block">
                    <div id="editortoolbar" style="width:90%;border: 1px solid #ccc;"></div>
                    <div id="editorcontent" style="width:90%;height:500px;border: 1px solid #ccc;">
                        @if(isset($data))
                            {!!$data->about_content!!}
                        @endif
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="{{asset('public/plugins/wangeditor/wangEditor.min.js')}}"></script>
    <script src="{{asset('public/plugins/layui/layui.js')}}"></script>
    <script type="text/javascript">
    layui.use(['table','upload','jquery','form'], function(){
        var form = layui.form
        var $ = layui.jquery
        var E = window.wangEditor
        var editor = new E('#editortoolbar','#editorcontent')
        editor.customConfig.uploadImgServer = '{{url('admin/upload_img')}}'
        editor.customConfig.uploadImgParams = {
            _token: "{{csrf_token()}}"
        }
        editor.customConfig.uploadFileName = 'img'
        editor.customConfig.uploadImgMaxLength = 1
        editor.create()

        form.on('submit(formDemo)', function(data){
            var data=data.field
            if(data.about_summary==""){
                data.about_summary=editor.txt.text().substr(0,250)+"...";
            }
            $.ajax({
                url: "{{url('admin/aboutedit')}}",
                type: "post",
                data:{'data':data,'about_content':editor.txt.html(),'_token':"{{csrf_token()}}"},
                dataType: "json",
                success:function(data){
                    if(data.status==1){
                        layer.msg(data.msg, {icon: 6});
                        @if(isset($data))
                            location.href="{{url('admin/aboutlist')}}"
                        @else
                            location=location;
                        @endif
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                }
            });
            return false;
        });

        form.verify({
  		  title: function(value, item){ //value：表单的值、item：表单的DOM对象
  			  if(value.length>50){
  				  return '标题不能大于50个字!';
  			  }
  		  }

          ,name: function(value, item){ //value：表单的值、item：表单的DOM对象
  			  if(value.length>20){
  				  return '名字不能大于20个字!';
  			  }
  		  }

  		  ,summary: function(value, item){ //value：表单的值、item：表单的DOM对象
              if(value.length>256){
  				  return '概述不能大于256个字!';
  			  }
  		  }
  	  });
    });
    </script>
</body>
</html>
