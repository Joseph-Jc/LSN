<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>后台管理-登录</title>
	<link rel="stylesheet" href="{{asset('public/plugins/layui/css/layui.css')}}" media="all" />
	<link rel="stylesheet" href="{{asset('public/admin/build/css/login.css')}}" />
</head>
<body class="beg-login-bg">
	<div class="beg-login-box">
		<header>
			<h1>后台登录</h1>
		</header>
		@if (session('msg'))
			<p style="color:red;text-align:center;line-height:30px;font-size:17px;">{{session('msg')}}</p>
		@endif
		<div class="beg-login-main">
			<form action="" class="layui-form" method="post">
				{{csrf_field()}}
				<div class="layui-form-item">
					<label class="beg-login-icon">
            			<i class="layui-icon">&#xe612;</i>
        			</label>
					<input type="text" name="username" lay-verify="username|required" autocomplete="off" placeholder="这里输入登录名" class="layui-input">
				</div>
				<div class="layui-form-item">
					<label class="beg-login-icon">
            			<i class="layui-icon">&#xe642;</i>
        			</label>
					<input type="password" name="password" lay-verify="password|required" autocomplete="off" placeholder="这里输入密码" class="layui-input">
				</div>
				<div class="layui-form-item">
					<div class="beg-pull-left beg-login-remember">
						<label>记住帐号？</label>
						<input type="checkbox" lay-skin="switch" checked title="记住帐号">
					</div>
					<div class="beg-pull-right">
						<button class="layui-btn layui-btn-primary" lay-submit lay-filter="login">
                			<i class="layui-icon">&#xe650;</i> 登录
          				</button>
					</div>
					<div class="beg-clear"></div>
				</div>
			</form>
			<footer>
				<p>Beginner © C++课程资源网</p>
			</footer>
		</div>
	</div>
	<script type="text/javascript" src="{{asset('public/plugins/layui/layui.js')}}"></script>
	<script>
		layui.use(['layer', 'form'], function() {
			var layer = layui.layer,
				$ = layui.jquery,
				form = layui.form;
		});
	</script>
</body>
</html>
