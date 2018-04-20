<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<title>后台管理-页脚导航</title>
	<link rel="stylesheet" type="text/css" href="{{asset('public/plugins/layui/css/layui.css')}}">
	<link rel="stylesheet" href="{{asset('public/admin/build/css/footnav.css')}}" media="all">
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
    <table id="footnavlist" lay-filter="footnavlist"></table>
	<script type="text/html" id="barTool">
		<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
	</script>

	<fieldset class="layui-elem-field">
		<br>
		<form class="layui-form" action="{{url('admin/footnav')}}" method="post">
			{{csrf_field()}}
			<div class="layui-input-block">
				<input name="footnav_name" required lay-verify="required|name" autocomplete="off" placeholder="请输入导航名称" class="layui-input" type="text">
			</div>
			<div class="layui-input-block">
				<input name="footnav_link" required lay-verify="required|url" autocomplete="off" placeholder="请输入导航链接" class="layui-input" type="text">
			</div>
			<button lay-submit lay-filter="submit" class="layui-btn">确认添加</button>
		</form>
		<legend style="color:#565656;">添加页脚导航</legend>
	</fieldset>

	<script src="{{asset('public/plugins/layui/layui.js')}}"></script>

	<script>
	layui.use(['table','jquery','form'], function(){
	  var table = layui.table;
	  var $ = layui.jquery;
	  var form=layui.form;

      var tableIns=table.render({
	    elem: '#footnavlist'
		,even: true
	    ,height: 500
	    ,width: 700
        ,page:true
	    ,url: '{{url('admin/footnav_list')}}' //数据接口
	    ,cols: [[
				{type:'checkbox',fixed: 'left'}
				,{field: 'footnav_id', title: 'ID', width:100, sort: true,align: 'center',fixed: 'left',}
                ,{field: 'footnav_name', title: '导航名称', width:200, align: 'center'}
                ,{field: 'footnav_link', title: '导航链接', width:300, sort: true,align: 'center'}
                ,{fixed: 'right',title: '操作', width:100, align:'center',toolbar: '#barTool'}
            ]]
	  });

	  table.on('tool(footnavlist)', function(obj){
		var data = obj.data;
		var tr=obj.tr;
		if(obj.event === 'del'){
			layer.msg('真的删除吗?', {
				btn: ['确定','取消'] //按钮
				,yes:function(index){
				  console.log(data);
				  $.ajax({
					  url: "{{url('admin/footnav_del')}}",
					  type: "POST",
					  data:{'footnav_id':data.footnav_id,'_token':"{{csrf_token()}}"},
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
		}
	});

		$(".del_many").click(function(){
			var checkStatus = table.checkStatus('footnavlist'),
				data = checkStatus.data,
				footnav_id = [];
				if(data.length > 0) {
					for (var i in data) {
						footnav_id.push(data[i].footnav_id);
					}
					layer.confirm('确定删除选中的导航？', {icon: 3, title: '提示信息'}, function (index) {
						$.ajax({
							url:'{{url('admin/del_many_footnav')}}',
							type:'post',
							data:{'footnav_id':footnav_id,'_token':"{{csrf_token()}}"},
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
					layer.msg("请选择需要删除的导航");
				}
		})

		$(".del_all").click(function(){
			layer.confirm('确定删除表中所有数据？', {icon: 3, title: '危险操作'}, function (index) {
				$.ajax({
					url:'{{url('admin/del_all_footnav')}}',
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
  		  name: function(value, item){ //value：表单的值、item：表单的DOM对象
  			  if(value.length>10){
  				  return '名称不能大于10个字!';
  			  }
  		  }
  	  });
	});
	</script>
</body>
</html>
