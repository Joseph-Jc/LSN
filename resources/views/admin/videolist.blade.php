<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
	<meta charset="utf-8">
	<title>后台管理-教学视频</title>
	<link rel="stylesheet" type="text/css" href="{{asset('public/plugins/layui/css/layui.css')}}">
	<link rel="stylesheet" href="{{asset('public/admin/build/css/videolist.css')}}" media="all">
</head>
<body>
	<div class="operate">
        <button class="layui-btn del_many layui-btn-danger">
            <i class="layui-icon">&#xe640;</i><span>批量删除</span>
        </button>
        <button class="layui-btn del_all layui-btn-danger">
            <i class="layui-icon">&#xe640;</i><span>全部删除</span>
        </button>
    </div>
	<table id="videolist" lay-filter="videolist"></table>
	<script type="text/html" id="barVideo">
		<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="play">播放</a>
		<a class="layui-btn layui-btn-xs" lay-event="edit">标题</a>
		<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
	</script>

	<fieldset class="layui-elem-field">
		<div class="layui-upload-drag" id="upload">
			<i class="layui-icon"></i>
			<p>点击上传，或将文件拖拽到此处</p>
		</div>
		<p id="video_name"></p>
		<form class="layui-form" action="{{url('admin/upload')}}" method="post">
			{{csrf_field()}}
			<div class="layui-input-block">
				<input name="video_time" autocomplete="off" class="layui-input" type="hidden" value="<?php echo date('Y-m-d');?>">
				<input name="videoName" lay-verify="video" autocomplete="off" class="layui-input" type="hidden">
				<input name="thumName" autocomplete="off" class="layui-input" type="hidden">
				<input name="video_title" lay-verify="required|title" autocomplete="off" placeholder="请输入标题" class="layui-input video_title" type="text">
			</div>
			<button lay-submit lay-filter="submit" class="layui-btn">确认上传</button>
		</form>
		<legend style="color:#565656;">上传视频</legend>
	</fieldset>

	<script src="{{asset('public/plugins/layui/layui.js')}}"></script>

	<script>
	layui.use(['table','upload','jquery','form'], function(){
	  var table = layui.table;
	  var form=layui.form;
	  var $ = layui.jquery
	  ,upload = layui.upload;

	  table.on('tool(videolist)', function(obj){
	    var data = obj.data;
		var tr=obj.tr;
	    if(obj.event === 'play'){
			var loadstr='<video class="video" controls="controls" preload="auto" width="100%" height="99%"><source src="{{url('')}}/'+data.video_path+'"><video>'
				layer.open({
				  type:1,
				  area: ['60%', '80%'],
				  shade: 0,
				  anim: 4,
				  title: [data.video_title,'text-align:center;font-size:16px;'],
				  moveOut: true,
				  closeBtn: 2,
				  content: loadstr,
				});

	    } else if(obj.event === 'del'){
	    	layer.msg('真的删除吗?', {
	  			btn: ['确定','取消'] //按钮
				,yes:function(index){
				  console.log(data);
		          $.ajax({
		              url: "{{url('admin/video_del')}}",
		              type: "POST",
		              data:{'video_id':data.video_id,'video_path':data.video_path,'thum_path':data.thum_path,'_token':"{{csrf_token()}}"},
		              dataType: "json",
		              success: function(data){

		                  if(data.status==1){
		                     tableIns.reload();
		                     //关闭弹框
		                      layer.close(index);
		                      layer.msg(data.msg, {icon: 6});
		                  }else{
		                      layer.msg(data.msg, {icon: 5});
		                  }
						}
				  	});
			  	}
	      	});
		} else if(obj.event === 'edit'){
			layer.prompt({title: '请输入标题', formType: 0}, function(video_title, index){
			  layer.close(index);
			  $.ajax({
				  url: "{{url('admin/video_edit')}}",
				  type: "POST",
				  data:{'video_id':data.video_id,'video_title':video_title,'_token':"{{csrf_token()}}"},
				  dataType: "json",
				  success: function(data){

					  if(data.status==1){
						  tableIns.reload();
						  layer.msg(data.msg, {icon: 6});
					  }else{
						  layer.msg(data.msg, {icon: 5});
					  }
					}
			  });
			});
		}
	});


	  var tableIns=table.render({
	    elem: '#videolist'
		,even: true
	    ,height: 500
	    ,width: 750
	    ,url: '{{url('admin/video_list')}}' //数据接口
	    ,page: true
	    ,cols: [[ //表头
			{type:'checkbox',fixed: 'left'}
			,{field: 'video_id', title: 'ID', width:100, sort: true, fixed: 'left', align: 'center'}
			,{field: 'video_title', title: '视频标题', width:200, align: 'center'}
			,{field: 'video_time', title: '发布日期', width:250, sort: true, align: 'center'}
			,{fixed: 'right', title: '操作', width:200, align:'center', toolbar: '#barVideo'}
	    ]]
	  });

	  upload.render({
	    elem: '#upload'
	    ,url: '{{url('admin/upload_video')}}'
		,accept: 'video'
		// ,auto: false
	    // ,bindAction: '#start'
		,data: {'_token':"{{csrf_token()}}"}
		,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
		  	layer.load(); //上传loading
		}
	    ,done: function(res){
			if(res.code == 0){
				$('input[name=videoName]').val(res.videoName);
				$('input[name=thumName]').val(res.thumName);
				$('#video_name').html(res.clientName);
	  		}
			layer.closeAll('loading'); //关闭loading
	    }
		,error: function(index, upload){
		  	layer.closeAll('loading'); //关闭loading
		}
	  });

	  $(".del_many").click(function(){
		  var checkStatus = table.checkStatus('videolist'),
			  data = checkStatus.data,
			  video_id = [];
			  if(data.length > 0) {
				  for (var i in data) {
					  video_id.push(data[i].video_id);
				  }
				  layer.confirm('确定删除选中的视频？', {icon: 3, title: '提示信息'}, function (index) {
					  $.ajax({
						  url:'{{url('admin/del_many_video')}}',
						  type:'post',
						  data:{'video_id':video_id,'_token':"{{csrf_token()}}"},
						  dataType:'json',
						  success:function(data){
							  if(data.status==1){
								  tableIns.reload();
								  //关闭弹框
								  layer.close(index);
								  layer.msg(data.msg, {icon: 6});
							  }else{
								  layer.msg(data.msg, {icon: 5});
							  }
						  }
					  });
				  })
			  }else{
				  layer.msg("请选择需要删除的视频");
			  }
	  })

	  $(".del_all").click(function(){
		  layer.confirm('确定删除表中所有视频？', {icon: 3, title: '危险操作'}, function (index) {
			  $.ajax({
				  url:'{{url('admin/del_all_video')}}',
				  type:'post',
				  data:{'_token':"{{csrf_token()}}"},
				  dataType:'json',
				  success:function(data){
					  if(data.status==1){
						  tableIns.reload();
						  //关闭弹框
						  layer.close(index);
						  layer.msg(data.msg, {icon: 6});
					  }else{
						  layer.msg(data.msg, {icon: 5});
					  }
				  }
			  });
		  })
	  })

		form.verify({
			title: function(value, item){ //value：表单的值、item：表单的DOM对象
				if(value.length>50){
					return '标题不能大于50个字!';
				}
			}

			,video: function(value, item){ //value：表单的值、item：表单的DOM对象
				if(value==""){
					return '请选择要上传的视频!';
				}
			}
		});

		@if (session('msg_success'))
			layer.msg('{{session('msg_success')}}');
		@endif


	});

	</script>
</body>
</html>
