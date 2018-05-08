<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
    <meta charset="utf-8">
    <title>C++课程资源网-后台管理</title>
    <link rel="stylesheet" href="{{asset('public/plugins/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('public/admin/build/css/app.css')}}" media="all">
</head>
<body>
    <div class="layui-layout layui-layout-admin kit-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">后台管理</div>
            <ul class="layui-nav layui-layout-left kit-nav" kit-navbar>
                <li class="layui-nav-item">
                    <a href="javascript:;" data-url="{{url('admin/newedit')}}" data-icon="&#xe642;" data-title="发布公告" kit-target data-id='9'>
                        <span>发布公告</span>
                    </a>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;" data-url="{{url('admin/examedit')}}" data-icon="&#xe642;" data-title="发布试题" kit-target data-id='10'>
                        <span>发布试题</span>
                    </a>
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right kit-nav">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="{{asset('public/admin/build/images/header.jpg')}}" class="layui-nav-img">{{$nickname}}
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" onclick="edit_nickname()">修改名称</a></dd>
                        <dd><a href="javascript:;" onclick="edit_password()">修改密码</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="{{url('admin/logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a></li>
            </ul>
        </div>

        <div class="layui-side layui-bg-black kit-side">
            <div class="layui-side-scroll">
                <div class="kit-side-fold"><i class="layui-icon" style="font-size:30px;">&#xe65f;</i><span></div>
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <ul class="layui-nav layui-nav-tree" lay-filter="kitNavbar" kit-navbar>
                    <li class="layui-nav-item layui-nav-itemed">
                        <a class="" href="javascript:;"><i class="layui-icon">&#xe609;</i><span> 内容管理</span></a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="javascript:;" data-url="{{url('admin/videolist')}}" data-icon="&#xe6ed;" data-title="教学视频" kit-target data-id='1'>
                                <i class="layui-icon">&#xe6ed;</i><span> 教学视频</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" data-url="{{url('admin/ebooklist')}}" data-icon="&#xe705;" data-title="电子教材" kit-target data-id='2'>
                                <i class="layui-icon">&#xe705;</i><span> 电子教材</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" data-url="{{url('admin/examlist')}}" data-icon="&#xe63c;" data-title="模拟试题" kit-target data-id='3'>
                                <i class="layui-icon">&#xe63c;</i><span> 模拟试题</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" data-url="{{url('admin/leavelist')}}" data-icon="&#xe62a;" data-title="教学留言" kit-target data-id='4'>
                                <i class="layui-icon">&#xe62a;</i><span> 教学留言</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" data-url="{{url('admin/newlist')}}" data-icon="&#xe645;" data-title="校内公告" kit-target data-id='5'>
                                <i class="layui-icon">&#xe645;</i><span> 校内公告</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" data-url="{{url('admin/aboutlist')}}" data-icon="&#xe60b;" data-title="课程相关" kit-target data-id='6'>
                                <i class="layui-icon">&#xe60b;</i><span> 课程相关</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" data-url="{{url('admin/imgcarlist')}}" data-icon="&#xe634;" data-title="轮播图" kit-target data-id='7'>
                                <i class="layui-icon">&#xe634;</i><span> 轮播图</span></a>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item layui-nav-itemed">
                        <a href="javascript:;"><i class="layui-icon">&#xe614;</i><span> 设置</span></a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="javascript:;" data-url="{{url('admin/footnav')}}" data-icon="&#xe64c;" data-title="页脚导航" kit-target data-id='8'>
                                <i class="layui-icon">&#xe64c;</i><span> 页脚导航</span></a>
                            </dd>
                        </dl>
                    </li>

                </ul>
            </div>
        </div>

        <div class="layui-body" id="container">
            <script>
                var mainUrl="{{url('admin/info')}}"
            </script>
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">主体内容加载中,请稍等...</div>
        </div>

        <div class="layui-footer">
            <!-- 底部固定区域 -->
            2018 &copy;
            <a href="">hellojiang.xyz</a> MIT license
        </div>
    </div>

    <script src="{{asset('public/plugins/layui/layui.js')}}"></script>
    <script src="{{asset('public/plugins/jquery/jquery.js')}}"></script>
    <script>
        var message;
        layui.config({
            base: '{{asset('public/admin/build/js/')}}/'
        }).use(['app', 'message'], function() {
            var app = layui.app,
                $ = layui.jquery,
                layer = layui.layer;
            //将message设置为全局以便子页面调用
            message = layui.message;
            //主入口
            app.set({
                type: 'iframe'
            }).init();
            $('#pay').on('click', function() {
                layer.open({
                    title: false,
                    type: 1,
                    content: '<img src="/build/images/pay.png" />',
                    area: ['500px', '250px'],
                    shadeClose: true
                });
            });
        });

        function edit_nickname(){
            layer.prompt({title: '请输入名称', formType: 0}, function(nickname, index){
                if(nickname.length>20){
                    layer.msg('不能大于20个字!');
                }else{
                    layer.close(index);
                    $.ajax({
                        url: "{{url('admin/edit_nickname')}}",
                        type: "POST",
                        data:{'nickname':nickname,'_token':"{{csrf_token()}}"},
                        dataType: "json",
                        success: function(data){
                            if(data.status==1){
                                layer.msg(data.msg, {icon: 6});
                            }else{
                                layer.msg(data.msg, {icon: 5});
                            }
                        }
                    });
                }
            });
        }

        function edit_password(){
            layer.prompt({title: '请输入密码', formType: 1}, function(password, index){
                if(password.length<6){
                    layer.msg('不能小于6位!');
                }else{
                    layer.close(index);
                    $.ajax({
                        url: "{{url('admin/edit_password')}}",
                        type: "POST",
                        data:{'password':password,'_token':"{{csrf_token()}}"},
                        dataType: "json",
                        success: function(data){
                            if(data.status==1){
                                layer.msg(data.msg, {icon: 6});
                            }else{
                                layer.msg(data.msg, {icon: 5});
                            }
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>
