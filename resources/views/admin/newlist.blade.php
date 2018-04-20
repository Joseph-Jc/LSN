<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
    <meta charset="utf-8">
    <title>后台管理-校内公告</title>
    <!-- <link rel="stylesheet" href="build/css/editor.css" media="all"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/plugins/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/build/css/newlist.css')}}" media="all">
</head>
<body>
    <input type="text" name="copy_link" value="" style="width:0px;height:0px;">
    <div class="operate">
        <button class="layui-btn" onclick="window.location.href='{{url('admin/newedit')}}'">
            <i class="layui-icon">&#xe642;</i><span>发布公告</span>
        </button>
        <button class="layui-btn del_many layui-btn-danger">
            <i class="layui-icon">&#xe640;</i><span>批量删除</span>
        </button>
        <button class="layui-btn del_all layui-btn-danger">
            <i class="layui-icon">&#xe640;</i><span>全部删除</span>
        </button>
    </div>
    <table id="newlist" lay-filter="newlist"></table>
    <script type="text/html" id="barNew">
		<a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
		<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        <a class="layui-btn layui-btn-xs" lay-event="copy">复制链接</a>
	</script>
    <script src="{{asset('public/plugins/layui/layui.js')}}"></script>
    <script>
        layui.use(['table','upload','jquery'], function(){
            var table = layui.table,
                $ = layui.jquery,
                upload = layui.upload;

            //创建表格
            var tableIns=table.render({
                elem: '#newlist'
                ,even: true
                ,height: 500
                ,width: 1050
                ,url: '{{url('admin/new_list')}}' //数据接口
                ,page: true
                ,cols: [[ //表头
                    {type:'checkbox',fixed: 'left'}
                    ,{field: 'new_id', title: 'ID', width:100, sort: true, fixed: 'left', align: 'center'}
                    ,{field: 'new_title', title: '公告标题', width:200, align: 'center'}
                    ,{field: 'new_author', title: '发布人', width:150, align: 'center'}
                    ,{field: 'new_time', title: '发布日期', width:200, sort: true, align: 'center'}
                    ,{field: 'new_summary', title: '摘要', width:250, align: 'center'}
                    ,{field: 'new_content', title: '内容', width:250, align: 'center'}
                    ,{fixed: 'right', title: '操作', width:200, align:'center', toolbar: '#barNew'}
                ]]
            });

            table.on('tool(newlist)', function(obj){
                var data = obj.data;
                var tr=obj.tr;
                if(obj.event === 'edit'){
                    location.href="{{url('admin/new_edit')}}/"+data.new_id;
                }else if(obj.event === 'del'){
                    layer.msg('真的删除吗?', {
                        btn: ['确定','取消'] //按钮
                        ,yes:function(index){
                        console.log(data);
                        $.ajax({
                            url: "{{url('admin/new_del')}}",
                            type: "POST",
                            data:{'new_id':data.new_id,'_token':"{{csrf_token()}}"},
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
                }else if(obj.event === 'copy'){
                    var link="{{url('news')}}/"+data.new_id;
                    var oInput = $("input[name=copy_link]");
                    oInput.val(link);
                    oInput.select(); // 选择对象
                    document.execCommand("Copy"); // 执行浏览器复制命令
                    layer.msg('复制成功!');
                }
            });

            $(".del_many").click(function(){
                var checkStatus = table.checkStatus('newlist'),
                    data = checkStatus.data,
                    new_id = [];
                    if(data.length > 0) {
                        for (var i in data) {
                            new_id.push(data[i].new_id);
                        }
                        layer.confirm('确定删除选中的文章？', {icon: 3, title: '提示信息'}, function (index) {
                            $.ajax({
                                url:'{{url('admin/del_many_new')}}',
                                type:'post',
                                data:{'new_id':new_id,'_token':"{{csrf_token()}}"},
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
                        layer.msg("请选择需要删除的文章");
                    }
            })

            $(".del_all").click(function(){
                layer.confirm('确定删除表中所有数据？', {icon: 3, title: '危险操作'}, function (index) {
                    $.ajax({
                        url:'{{url('admin/del_all_new')}}',
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

        });
    </script>
</body>
</html>
