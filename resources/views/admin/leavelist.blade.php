<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>后台管理-教学留言</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/plugins/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/build/css/leavelist.css')}}" media="all">
</head>
<body>
    <fieldset class="layui-elem-field">
        <legend>待审核的留言</legend>
        <div class="layui-field-box">
            <div class="operate">
                <button class="layui-btn check_many">
                    <i class="layui-icon">&#xe640;</i><span>批量审核</span>
                </button>
                <button class="layui-btn del_many layui-btn-danger">
                    <i class="layui-icon">&#xe640;</i><span>批量删除</span>
                </button>
                <button class="layui-btn del_all layui-btn-danger">
                    <i class="layui-icon">&#xe640;</i><span>全部清除</span>
                </button>
            </div>
            <table id="leavelist_check" lay-filter="leavelist_check"></table>
            <script type="text/html" id="barleavelist_check">
        		<a class="layui-btn layui-btn-xs" lay-event="check">审核</a>
        		<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        	</script>
        </div>
    </fieldset>


    <fieldset class="layui-elem-field">
        <legend>已审核通过的留言</legend>
        <div class="layui-field-box">
            <div class="operate">
                <button class="layui-btn del_many_checked layui-btn-danger">
                    <i class="layui-icon">&#xe640;</i><span>批量删除</span>
                </button>
                <button class="layui-btn del_all_checked layui-btn-danger">
                    <i class="layui-icon">&#xe640;</i><span>全部清除</span>
                </button>
            </div>
            <table id="leavelist" lay-filter="leavelist"></table>
            <script type="text/html" id="barleavelist">
        		<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        	</script>
        </div>
    </fieldset>

    <script src="{{asset('public/plugins/layui/layui.js')}}"></script>
    <script>
        layui.use(['table','upload','jquery'], function(){
            var table = layui.table,
                $ = layui.jquery,
                upload = layui.upload;

            //创建表格，待审核留言列表
            var tableIns1=table.render({
                elem: '#leavelist_check'
                ,even: true
                ,height: 400
                ,width: 900
                ,url: '{{url('admin/leavelist_check')}}' //数据接口
                ,page: true
                ,cols: [[ //表头
                    {type:'checkbox',fixed: 'left'}
                    ,{field: 'leave_id', title: 'ID', width:100, sort: true, fixed: 'left', align: 'center'}
                    ,{field: 'leave_person', title: '留言人', width:150, align: 'center'}
                    ,{field: 'leave_email', title: '邮箱', width:200, align: 'center'}
                    ,{field: 'leave_time', title: '留言日期', width:200, sort: true, align: 'center'}
                    ,{field: 'leave_content', title: '内容', width:250, align: 'center'}
                    ,{fixed: 'right', title: '操作', width:150, align:'center', toolbar: '#barleavelist_check'}
                ]]
            });

            //创建表格，已审核留言列表
            var tableIns2=table.render({
                elem: '#leavelist'
                ,even: true
                ,height: 400
                ,width: 900
                ,url: '{{url('admin/leave_list')}}' //数据接口
                ,page: true
                ,cols: [[ //表头
                    {type:'checkbox',fixed: 'left'}
                    ,{field: 'leave_id', title: 'ID', width:100, sort: true, fixed: 'left', align: 'center'}
                    ,{field: 'leave_person', title: '留言人', width:150, align: 'center'}
                    ,{field: 'leave_email', title: '邮箱', width:200, align: 'center'}
                    ,{field: 'leave_time', title: '留言日期', width:200, sort: true, align: 'center'}
                    ,{field: 'leave_content', title: '内容', width:250, align: 'center'}
                    ,{fixed: 'right', title: '操作', width:150, align:'center', toolbar: '#barleavelist'}
                ]]
            });

            //待审核留言操作列表
            table.on('tool(leavelist_check)', function(obj){
                var data = obj.data;
                var tr=obj.tr;
                if(obj.event === 'check'){
                    layer.msg('确定要通过吗?', {
                        btn: ['确定','取消'] //按钮
                        ,yes:function(index){
                        console.log(data);
                        $.ajax({
                            url: "{{url('admin/leave_check')}}",
                            type: "POST",
                            data:{'leave_id':data.leave_id,'_token':"{{csrf_token()}}"},
                            dataType: "json",
                            success: function(data){
                                if(data.status==1){
                                    tableIns1.reload();
                                    tableIns2.reload();
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
                }else if(obj.event === 'del'){
                    layer.msg('真的删除吗?', {
                        btn: ['确定','取消'] //按钮
                        ,yes:function(index){
                        console.log(data);
                        $.ajax({
                            url: "{{url('admin/leave_del')}}",
                            type: "POST",
                            data:{'leave_id':data.leave_id,'_token':"{{csrf_token()}}"},
                            dataType: "json",
                            success: function(data){
                                if(data.status==1){
                                    tableIns1.reload();
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

            //已审核留言操作列表
            table.on('tool(leavelist)', function(obj){
                var data = obj.data;
                var tr=obj.tr;
                if(obj.event === 'del'){
                    layer.msg('真的删除吗?', {
                        btn: ['确定','取消'] //按钮
                        ,yes:function(index){
                        console.log(data);
                        $.ajax({
                            url: "{{url('admin/leave_del')}}",
                            type: "POST",
                            data:{'leave_id':data.leave_id,'_token':"{{csrf_token()}}"},
                            dataType: "json",
                            success: function(data){
                                if(data.status==1){
                                    tableIns2.reload();
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

            $(".check_many").click(function(){
                var checkStatus = table.checkStatus('leavelist_check'),
                    data = checkStatus.data,
                    leave_id = [];
                    if(data.length > 0) {
                        for (var i in data) {
                            leave_id.push(data[i].leave_id);
                        }
                        layer.confirm('确定审核通过选中的留言？', {icon: 3, title: '提示信息'}, function (index) {
                            $.ajax({
                                url:'{{url('admin/check_many')}}',
                                type:'post',
                                data:{'leave_id':leave_id,'_token':"{{csrf_token()}}"},
                                dataType:'json',
                                success:function(data){
                                    if(data.status==1){
                                        tableIns1.reload();
                                        tableIns2.reload();
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
                        layer.msg("请选择需要审核的留言");
                    }
            })

            $(".del_many").click(function(){
                var checkStatus = table.checkStatus('leavelist_check'),
                    data = checkStatus.data,
                    leave_id = [];
                    if(data.length > 0) {
                        for (var i in data) {
                            leave_id.push(data[i].leave_id);
                        }
                        layer.confirm('确定删除选中的留言？', {icon: 3, title: '提示信息'}, function (index) {
                            $.ajax({
                                url:'{{url('admin/del_many')}}',
                                type:'post',
                                data:{'leave_id':leave_id,'_token':"{{csrf_token()}}"},
                                dataType:'json',
                                success:function(data){
                                    if(data.status==1){
                                        tableIns1.reload();
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
                        layer.msg("请选择需要删除的留言");
                    }
            })

            $(".del_all").click(function(){
                layer.confirm('确定删除表中所有数据？', {icon: 3, title: '危险操作'}, function (index) {
                    $.ajax({
                        url:'{{url('admin/del_all')}}',
                        type:'post',
                        data:{'_token':"{{csrf_token()}}"},
                        dataType:'json',
                        success:function(data){
                            if(data.status==1){
                                tableIns1.reload();
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

            $(".del_many_checked").click(function(){
                var checkStatus = table.checkStatus('leavelist'),
                    data = checkStatus.data,
                    leave_id = [];
                    if(data.length > 0) {
                        for (var i in data) {
                            leave_id.push(data[i].leave_id);
                        }
                        layer.confirm('确定删除选中的留言？', {icon: 3, title: '提示信息'}, function (index) {
                            $.ajax({
                                url:'{{url('admin/del_many_checked')}}',
                                type:'post',
                                data:{'leave_id':leave_id,'_token':"{{csrf_token()}}"},
                                dataType:'json',
                                success:function(data){
                                    if(data.status==1){
                                        tableIns2.reload();
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
                        layer.msg("请选择需要删除的留言");
                    }
            })

            $(".del_all_checked").click(function(){
                layer.confirm('确定删除表中所有数据？', {icon: 3, title: '危险操作'}, function (index) {
                    $.ajax({
                        url:'{{url('admin/del_all_checked')}}',
                        type:'post',
                        data:{'_token':"{{csrf_token()}}"},
                        dataType:'json',
                        success:function(data){
                            if(data.status==1){
                                tableIns2.reload();
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
