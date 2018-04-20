<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
	<meta charset="utf-8">
	<title>后台管理-轮播图</title>
	<link rel="stylesheet" type="text/css" href="{{asset('public/plugins/layui/css/layui.css')}}">
	<link rel="stylesheet" href="{{asset('public/admin/build/css/imgcarlist.css')}}" media="all">
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
    <table id="imgcarlist" lay-filter="imgcarlist"></table>
	<script type="text/html" id="barTool">
		<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="play">查看</a>
        <a class="layui-btn layui-btn-xs" lay-event="edit">链接</a>
		<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
	</script>

	<fieldset class="layui-elem-field">
		<div class="layui-upload-drag" id="upload">
			<i class="layui-icon"></i>
			<p>点击上传，或将文件拖拽到此处</p>
		</div>
		<form class="layui-form" action="{{url('admin/uploadimg')}}" method="post">
			{{csrf_field()}}
			<div class="layui-input-block">
				<input name="imgName" lay-verify="img" autocomplete="off" class="layui-input" type="hidden">
				<input name="img_link" autocomplete="off" placeholder="请输入图片跳转链接" class="layui-input" type="text">
                <select name="img_cate" lay-verify="cate" class="img_cate">
                    <option value="">请选择轮播分类</option>
                    <option value="新闻">新闻</option>
                    <option value="教师团队">教师团队</option>
                </select>
			</div>

			<button class="layui-btn" lay-submit lay-filter="formDemo">确认上传</button>
		</form>
		<div style="margin:0 auto;width:258px;"><img style="width:100%;max-height:137px;" id="img_thum"></img></div>
		<legend style="color:#565656;">上传图片</legend>
	</fieldset>

	<script src="{{asset('public/plugins/layui/layui.js')}}"></script>

	<script>
	layui.use(['table','upload','jquery','form'], function(){
	  var table = layui.table;
	  var form=layui.form;
	  var $ = layui.jquery
	  ,upload = layui.upload;

	  table.on('tool(imgcarlist)', function(obj){
	    var data = obj.data;
		var tr=obj.tr;
	    if(obj.event === 'play'){
			var loadstr='<img style="width:100%;height:100%" src="{{url('')}}/'+data.img_path+'"></img>'
				layer.open({
				  type:1,
				  area: ['480px', '320px'],
				  shade: 0,
				  anim: 4,
				  title: false,
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
		              url: "{{url('admin/img_del')}}",
		              type: "POST",
		              data:{'img_id':data.img_id,'img_path':data.img_path,'_token':"{{csrf_token()}}"},
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
			layer.prompt({title: '请输入链接(URL)', formType: 0}, function(img_link, index){
			  layer.close(index);
			  $.ajax({
				  url: "{{url('admin/img_edit')}}",
				  type: "POST",
				  data:{'img_id':data.img_id,'img_link':img_link,'_token':"{{csrf_token()}}"},
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

      //轮播图列表
      var tableIns=table.render({
	    elem: '#imgcarlist'
		,even: true
	    ,height: 500
	    ,width: 750
        ,page:true
	    ,url: '{{url('admin/img_list')}}' //数据接口
	    ,cols: [[
				{type:'checkbox',fixed: 'left'}
		  		,{field: 'img_id', title: 'ID', width:100, sort: true,fixed: 'left',align: 'center'}
                ,{field: 'img_link', title: '跳转链接(URL)', width:225, align: 'center'}
                ,{field: 'img_cate', title: '分类', width:200, sort: true,align: 'center'}
                ,{title: '操作', width:200, align:'center',fixed: 'right',toolbar: '#barTool'}
            ]]
	  });
      //图片上传
	  upload.render({
	    elem: '#upload'
	    ,url: '{{url('admin/upload_imgcar')}}'
		,accept: 'images'
		// ,auto: false
	    // ,bindAction: '#start'
		,data: {'_token':"{{csrf_token()}}"}
		,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
		  	layer.load(); //上传loading
			obj.preview(function(index, file, result){
	          $('#img_thum').attr('src', result); //图片链接（base64）
	        });
		}
	    ,done: function(res){
			if(res.code == 0){
				$('input[name=imgName]').val(res.imgName);
	  		}
			layer.closeAll('loading'); //关闭loading
	    }
		,error: function(index, upload){
		  	layer.closeAll('loading'); //关闭loading
		}
	  });

	  $(".del_many").click(function(){
		  var checkStatus = table.checkStatus('imgcarlist'),
			  data = checkStatus.data,
			  img_id = [];
			  if(data.length > 0) {
				  for (var i in data) {
					  img_id.push(data[i].img_id);
				  }
				  layer.confirm('确定删除选中的图片？', {icon: 3, title: '提示信息'}, function (index) {
					  $.ajax({
						  url:'{{url('admin/del_many_img')}}',
						  type:'post',
						  data:{'img_id':img_id,'_token':"{{csrf_token()}}"},
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
				  layer.msg("请选择需要删除的图片");
			  }
	  })

	  $(".del_all").click(function(){
		  layer.confirm('确定删除表中所有图片？', {icon: 3, title: '危险操作'}, function (index) {
			  $.ajax({
				  url:'{{url('admin/del_all_img')}}',
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
		img: function(value, item){ //value：表单的值、item：表单的DOM对象
			if(value==""){
				return '请选择要上传的图片!';
			}
		}

		,cate: function(value, item){ //value：表单的值、item：表单的DOM对象
			if(value==""){
				return '请选择分类!';
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
