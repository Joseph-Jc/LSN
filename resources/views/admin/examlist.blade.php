<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
    <meta charset="utf-8">
    <title>后台管理-模拟试题</title>
    <!-- <link rel="stylesheet" href="build/css/editor.css" media="all"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/plugins/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/build/css/examlist.css')}}" media="all">
</head>
<body>
    <div class="operate">
        <button class="layui-btn" onclick="window.location.href='{{url('admin/examedit')}}'">
            <i class="layui-icon">&#xe642;</i><span>发布试题</span>
        </button>
        <button class="layui-btn del_many layui-btn-danger">
            <i class="layui-icon">&#xe640;</i><span>批量删除</span>
        </button>
        <button class="layui-btn del_all layui-btn-danger">
            <i class="layui-icon">&#xe640;</i><span>全部删除</span>
        </button>
    </div>
    <table id="examlist" lay-filter="examlist"></table>
    <script type="text/html" id="barNew">
		<a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
		<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
	</script>
    <script src="{{asset('public/plugins/layui/layui.js')}}"></script>
    <script>
        layui.use(['table','upload','jquery'], function(){
            var table = layui.table,
                $ = layui.jquery,
                upload = layui.upload;

            //创建表格
            var tableIns=table.render({
                elem: '#examlist'
                ,even: true
                ,height: 500
                ,width: 1050
                ,url: '{{url('admin/exam_list')}}' //数据接口
                ,page: true
                ,cols: [[ //表头
                    {type:'checkbox',fixed: 'left'}
                    ,{field: 'exam_id', title: 'ID', width:100, sort: true, fixed: 'left', align: 'center'}
                    ,{field: 'exam_title', title: '试题标题', width:200, align: 'center'}
                    ,{field: 'exam_author', title: '发布人', width:150, align: 'center'}
                    ,{field: 'exam_time', title: '发布日期', width:200, sort: true, align: 'center'}
                    ,{field: 'exam_summary', title: '试题描述', width:250, align: 'center'}
                    ,{field: 'exam_content', title: '内容', width:250, align: 'center'}
                    ,{fixed: 'right', title: '操作', width:150, align:'center', toolbar: '#barNew'}
                ]]
            });

            table.on('tool(examlist)', function(obj){
                var data = obj.data;
                var tr=obj.tr;
                if(obj.event === 'edit'){
                    location.href="{{url('admin/exam_edit')}}/"+data.exam_id;
                }else if(obj.event === 'del'){
                    layer.msg('真的删除吗?', {
                        btn: ['确定','取消'] //按钮
                        ,yes:function(index){
                        console.log(data);
                        $.ajax({
                            url: "{{url('admin/exam_del')}}",
                            type: "POST",
                            data:{'exam_id':data.exam_id,'_token':"{{csrf_token()}}"},
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
                var checkStatus = table.checkStatus('examlist'),
                    data = checkStatus.data,
                    exam_id = [];
                    if(data.length > 0) {
                        for (var i in data) {
                            exam_id.push(data[i].exam_id);
                        }
                        layer.confirm('确定删除选中的文章？', {icon: 3, title: '提示信息'}, function (index) {
                            $.ajax({
                                url:'{{url('admin/del_many_exam')}}',
                                type:'post',
                                data:{'exam_id':exam_id,'_token':"{{csrf_token()}}"},
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
                        url:'{{url('admin/del_all_exam')}}',
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
