<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
	<meta charset="utf-8">
	<title>后台管理-电子教材</title>
	<link rel="stylesheet" type="text/css" href="{{asset('public/plugins/layui/css/layui.css')}}">
	<link rel="stylesheet" href="{{asset('public/admin/build/css/ebooklist.css')}}" media="all">
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
	<table id="ebooklist" lay-filter="ebooklist"></table>
	<script type="text/html" id="barEbook">
		<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="play">查看</a>
		<a class="layui-btn layui-btn-xs" lay-event="edit">书名</a>
		<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
	</script>

	<fieldset class="layui-elem-field">
		<div class="layui-upload-drag" id="upload_ebook">
			<i class="layui-icon"></i>
			<p>点击上传电子书(pdf格式)，或将文件拖拽到此处</p>
		</div>
		<p id="video_name"></p>

		<form class="layui-form" action="{{url('admin/uploadebook')}}" method="post">
			{{csrf_field()}}
			<div class="layui-input-block">
				<input name="ebookName" lay-verify="book" autocomplete="off" class="layui-input" type="hidden">
				<input name="thumName" autocomplete="off" class="layui-input" type="hidden">
				<input name="ebook_name" lay-verify="required|title" autocomplete="off" placeholder="请输入书名" class="layui-input" type="text">
			</div>
			<div class="layui-upload">
				<button type="button" class="layui-btn" id="upload_thum">点击上传封面</button>
			</div>
			<div style="margin:0 auto;width:180px;max-height:200px;"><img style="width:180px;max-height:200px;" id="img_thum"></img></div>
			<button lay-submit lay-filter="submit" class="layui-btn" style="width:184px;">确认上传</button>
		</form>
		<legend style="color:#565656;">上传电子书</legend>
	</fieldset>

	<script src="{{asset('public/plugins/layui/layui.js')}}"></script>
	<script type="text/html" id="imgthum">
			@{{#  if(d.ebook_thum == 'uploads/ebook/'){ }}
			无封面
			@{{#  } else { }}
			<img style="width:100px;height:150px;" src="{{url('')}}/@{{d.ebook_thum}}"></img>
			@{{#  } }}
	</script>
	<script>
	layui.use(['table','upload','jquery','form'], function(){
	  var table = layui.table;
	  var form=layui.form;
	  var $ = layui.jquery
	  ,upload = layui.upload;

	  table.on('tool(ebooklist)', function(obj){
	    var data = obj.data;
		var tr=obj.tr;
	    if(obj.event === 'play'){
				layer.open({
				  type:2,
				  area: ['1050px', '500px'],
				  shade: 0,
				  anim: 4,
				  title: [data.ebook_name,'text-align:center;font-size:16px;'],
				  moveOut: true,
				  closeBtn: 2,
				  content: ['{{url('admin/pdf')}}/'+data.ebook_id,'no']
				});

	    } else if(obj.event === 'del'){
	    	layer.msg('真的删除吗?', {
	  			btn: ['确定','取消'] //按钮
				,yes:function(index){
				  console.log(data);
		          $.ajax({
		              url: "{{url('admin/ebook_del')}}",
		              type: "POST",
		              data:{'ebook_id':data.ebook_id,'ebook_path':data.ebook_path,'ebook_thum':data.ebook_thum,'_token':"{{csrf_token()}}"},
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
			layer.prompt({title: '请输入书名', formType: 0}, function(ebook_name, index){
			  layer.close(index);
			  $.ajax({
				  url: "{{url('admin/ebook_edit')}}",
				  type: "POST",
				  data:{'ebook_id':data.ebook_id,'ebook_name':ebook_name,'_token':"{{csrf_token()}}"},
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
	    elem: '#ebooklist'
		,even: true
	    ,height: 500
	    ,width: 750
	    ,url: '{{url('admin/ebook_list')}}' //数据接口
	    ,page: true
	    ,cols: [[ //表头
			{type:'checkbox'}
		  ,{field: 'ebook_id', title: 'ID', width:100, sort: true, align: 'center',style:'min-height:100px'}
	      ,{field: 'ebook_name', title: '书名', width:200, align: 'center'}
	      ,{field: 'ebook_thum', title: '封面', width:200,align: 'center',templet: '#imgthum'}
	      ,{title: '操作', width:200, align:'center', toolbar: '#barEbook'}
	    ]]
	  });

	  upload.render({
	    elem: '#upload_ebook'
	    ,url: '{{url('admin/upload_ebook')}}'
		,accept: 'file'
		,exts: 'pdf'
		// ,auto: false
	    // ,bindAction: '#start'
		,data: {'_token':"{{csrf_token()}}"}
		,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
		  	layer.load(); //上传loading
		}
	    ,done: function(res){
			if(res.code == 0){
				$('input[name=ebookName]').val(res.ebookName);
				$('#video_name').html(res.clientName);
	  		}
			layer.closeAll('loading'); //关闭loading
	    }
		,error: function(index, upload){
		  	layer.closeAll('loading'); //关闭loading
		}
	  });

	  upload.render({
			elem: '#upload_thum'
			,url: '{{url('admin/upload_thum')}}'
			,accept: 'images'
			,data: {'_token':"{{csrf_token()}}"}
			,before: function(obj){
				layer.load(); //上传loading
			//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result){
					$('#img_thum').attr('src', result); //图片链接（base64）
				});
			}
			,done: function(res){
				if(res.code == 0){
					$('input[name=thumName]').val(res.thumName);
		  		}
				layer.closeAll('loading'); //关闭loading
			}
			,error: function(){
				layer.closeAll('loading'); //关闭loading
			}
	  });

	  $(".del_many").click(function(){
		  var checkStatus = table.checkStatus('ebooklist'),
			  data = checkStatus.data,
			  ebook_id = [];
			  if(data.length > 0) {
				  for (var i in data) {
					  ebook_id.push(data[i].ebook_id);
				  }
				  layer.confirm('确定删除选中的书籍？', {icon: 3, title: '提示信息'}, function (index) {
					  $.ajax({
						  url:'{{url('admin/del_many_ebook')}}',
						  type:'post',
						  data:{'ebook_id':ebook_id,'_token':"{{csrf_token()}}"},
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
				  layer.msg("请选择需要删除的书籍");
			  }
	  })

	  $(".del_all").click(function(){
		  layer.confirm('确定删除表中所有书籍？', {icon: 3, title: '危险操作'}, function (index) {
			  $.ajax({
				  url:'{{url('admin/del_all_ebook')}}',
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
				  return '书名不能大于50个字!';
			  }
		  }

		  ,book: function(value, item){ //value：表单的值、item：表单的DOM对象
			  if(value==""){
				  return '请选择要上传的书籍!';
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
