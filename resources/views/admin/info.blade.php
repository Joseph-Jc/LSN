<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>后台管理—网站信息</title>
	<link rel="stylesheet" href="{{asset('public/admin/build/css/ch-ui.admin.css')}}">
</head>
<body>
	<div class="result_wrap">
		<div class="result_title">
			<h3>系统基本信息</h3>
		</div>
		<div class="result_content">
			<ul>
				<li>
					<label>操作系统</label><span>{{PHP_OS}}</span>
				</li>
				<li>
					<label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
				</li>
				<li>
					<label>网站版本</label><span>V-1.1</span>
				</li>
				<li>
					<label>上传附件限制</label><span><?php echo ini_get('upload_max_filesize')?ini_get('upload_max_filesize'):"不允许上传附件";?></span>
				</li>
				<li>
					<label>当前时间</label><span><?php echo date('Y年m月d日 H时i分s秒');?></span>
				</li>
				<li>
					<label>服务器域名/IP</label><span>{{$_SERVER['SERVER_NAME']}} 【 {{$_SERVER['SERVER_ADDR']}} 】</span>
				</li>
				<li>
					<label>Host</label><span>{{$_SERVER['SERVER_ADDR']}}</span>
				</li>
			</ul>
		</div>
	</div>

	<div class="result_wrap">
		<div class="result_title">
			<h3>使用帮助</h3>
		</div>
		<div class="result_content">
			<ul>
				<li>
					<label>说明：</label><span>本网站由江同学毕业设计提供</span>
				</li>
				<li>
					<label>联系QQ：</label><span>541673630</span>
				</li>
				<li>
					<label>短号：</label><span>692991</span>
				</li>
			</ul>
		</div>
	</div>
</body>
</html>
