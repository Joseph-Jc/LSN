@extends('home/common/layout')
@section('title')
教学留言
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('public/home/styles/message.css')}}">
@endsection
@section('content')
<div class="content">
	<div class="content_l">
		<div class="message_list">
			<fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
				<legend style="font-weight: 600;color: #999;">留言列表</legend>
			</fieldset>
			<ul class="leave_list">

			</ul>
			<div id="layui_page"></div>
		</div>

	</div>
	<div class="content_r">
		<div class="message_board">
			<fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
				<legend style="font-weight: 600;color: #999;">留言</legend>
			</fieldset>
			<div class="form_page">
				<form class="layui-form">
					<input type="hidden" name="leave_time" value="<?php echo date('Y-m-d H:i:s');?>">
					<div class="layui-form-item">
						<input type="text" name="leave_person" lay-verify="required|name" placeholder="请输入您的称呼" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-item">
						<input type="text" name="leave_email" lay-verify="required|email" placeholder="请输入您的联系邮箱" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-item">
						<div id="editortoolbar" style="width:280px;border: 1px solid #ccc;"></div>
						<div id="editorcontent" style="width:280px;height:300px;border: 1px solid #ccc;">

						</div>
					</div>
					<div class="layui-form-item">
						<button type="button" class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('public/plugins/wangeditor/wangEditor.min.js')}}"></script>
<script>
	layui.use(['laypage','jquery'], function(){
	  var laypage = layui.laypage;
	  var $ = layui.jquery;
	  //执行一个laypage实例
	  laypage.render({
	    elem: 'layui_page' //注意，这里的 test1 是 ID，不用加 # 号
		,layout:['limit','prev', 'next','page','count']
		,count:{{$count}}
	    ,jump: function(obj){
	      var page=obj.curr;
		  var limit=obj.limit;
		  $.ajax({
			  url:"{{url('leave/leave_list')}}?page="+page+"&limit="+limit,
			  type:"get",
			  dataType: "json",
			  success:function(data){
				  $('.leave_list').html("");
				  for(i=0;i<data.data.length;i++){
					  var html="<li><h1><span>"+data.data[i].leave_time+"</span>"+data.data[i].leave_person+"的留言：</h1><div class=\"leave_content\">"+data.data[i].leave_content+"</div></li>";
					  $(".leave_list").append(html);
				  }
			  }
		  });
	    }
	  });
	});
</script>
<script>
	//Demo
	layui.use(['form','jquery'], function(){
	  var form = layui.form;
	  var E = window.wangEditor;
	  var $ = layui.jquery;
	  var editor = new E('#editortoolbar','#editorcontent');
	  editor.customConfig.menus = [
			'underline',
			'foreColor',
			'backColor',
			'underline',
			'link',
			'list',
			'emoticon',
			'code',
		]
	  editor.create();
	  form.on('submit(formDemo)', function(data){
		  if(editor.txt.text().length>=15){
			  var data=data.field;
			  $.ajax({
				  url:"{{url('leave/upload_leave')}}",
				  type: "post",
				  data:{'data':data,'leave_content':editor.txt.html(),'_token':"{{csrf_token()}}"},
				  dataType: "json",
				  success:function(data){
					  if(data.status==1){
						  layer.alert(data.msg, {
							skin: 'layui-layer-molv' //样式类名
							,closeBtn: 0
							}, function(){
								location=location;
							});
					  }else{
						  layer.msg(data.msg,{icon: 5});
					  }
				  }
			  });
		  }else{
			  layer.msg('留言不能少于15个字');
		  }
	  });

	  form.verify({
		name: function(value, item){ //value：表单的值、item：表单的DOM对象
			if(value.length>20){
				return '名称不能大于20个字!';
			}
		}
	});
	});
</script>
@endsection
