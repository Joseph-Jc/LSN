@extends('home/common/layout')
@section('title')
课程相关
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('public/home/styles/about.css')}}">
@endsection
@section('content')
<!-- 内容开始 -->
<div class="content">
	<div class="content_l">
		<div class="current_nav">
			<span class="layui-breadcrumb">
				<a href="{{url('')}}">首页</a>
				<a href="javascript:;">课程相关</a>
				<a><cite>{{$data->about_title}}</cite></a>
			</span>
		</div>
		<div class="article_title">
			<h1>{{$data->about_title}}</h1>
			<span class="author">发布人： {{$data->about_author}}</span>
			<span class="time">发布时间：{{$data->about_time}}</span>
		</div>
		<div class="article_content">
			{!!$data->about_content!!}
		</div>
	</div>
	<div class="content_r">
		<div class="top_title">
			<div class="square "></div>
			<h1>课程相关<span> ABOUT</span></h1>
		</div>
		<ul>
			@foreach($nav_id['about'] as $about_id => $about_title)
				<li><a href="{{url('about')}}/{{$about_id}}"><button class="layui-btn {{Request::getPathInfo()=='/about/'.$about_id?'active':'unactive'}}">{{$about_title}}</button></a></li>
			@endforeach
		</ul>
	</div>
</div>
<!-- 内容结束 -->
@endsection
