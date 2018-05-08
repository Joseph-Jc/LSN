<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>C++课程资源网—@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/plugins/layui/css/layui.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/home/styles/base.css')}}">
	@section('styles')

	@show
</head>
<body>
    <!-- 头部导航栏开始 -->
	<div class="header">
		<div class="logo"></div>
		<div class="nav">
			<ul class="layui-nav">
		  		<li class="layui-nav-item {{Request::getPathInfo()=='/'?'layui-this':''}}">
		  			<a href="{{url('')}}">首页</a>
		  		</li>
				<li class="layui-nav-item {{Request::getPathInfo()=='/ebook/'.$nav_id['ebook']?'layui-this':''}}">
		    		<a href="{{url('ebook')}}/{{$nav_id['ebook']}}">电子教材</a>
		  		</li>
		  		<li class="layui-nav-item {{Request::getPathInfo()=='/video/'.$nav_id['video']?'layui-this':''}}">
		  			<a href="{{url('video')}}/{{$nav_id['video']}}">教学视频</a>
		  		</li>
		  		<li class="layui-nav-item {{Request::getPathInfo()=='/exam/'.$nav_id['exam']?'layui-this':''}}">
		    		<a href="{{url('exam')}}/{{$nav_id['exam']}}">模拟试题</a>
		  		</li>
		  		<li class="layui-nav-item {{Request::getPathInfo()=='/leave'?'layui-this':''}}">
					<a href="{{url('leave')}}">教学留言</a>
				</li>
			  	<li class="layui-nav-item {{strpos(Request::getPathInfo(),'about')?'layui-this':''}}">
		    		<a href="javascript:;">课程相关</a>
				    <dl class="layui-nav-child">
						@foreach($nav_id['aboutcate'] as $about_cate_id => $about_cate_name)
							<dd class="{{strpos(Request::getPathInfo(),'about/'.$about_cate_id)?'layui-this':''}}"><a href="{{url('aboutdefault')}}/{{$about_cate_id}}">{{$about_cate_name}}</a></dd>
						@endforeach
				    </dl>
		  		</li>
			</ul>
		</div>
	</div>
	<!-- 头部导航栏结束 -->
	@yield('content')
    <!-- 页脚开始 -->
	<div class="footer">
		<div class="footer_nav">
			<ul>
				@foreach($footnav as $key=>$value)
				<li><a href="{{$value->footnav_link}}">{{$value->footnav_name}}</a></li>
				@endforeach
			</ul>
		</div>
		<div class="footer_con">
			<p>C++课程资源网 - C++教育平台 - C++课程资源网</p>
			<p>Copyright © C++课程资源网 All rights reserved.</p>
			<p>毕业设计</p>
			<br>
		</div>
	</div>
	<!-- 页脚结束 -->
    <script type="text/javascript" src="{{asset('public/plugins/layui/layui.js')}}"></script>
	<script>
		layui.use('element', function(){
		  var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块

		  //监听导航点击
		  element.on('nav(demo)', function(elem){
		    //console.log(elem)
		    layer.msg(elem.text());
		  });
		});
	</script>
	@section('javascript')

	@show
</body>
</html>
