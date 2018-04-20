@extends('home/common/layout')
@section('title')
校内公告
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('public/home/styles/news.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/home/styles/editor.css')}}">
@endsection
@section('content')
<!-- 内容开始 -->
<div class="content">
	<div class="content_l">
		<div class="current_nav">
			<span class="layui-breadcrumb">
				<a href="{{url('')}}">首页</a>
				<a href="javascript:;">校内公告</a>
				<a><cite>{{$news->new_title}}</cite></a>
			</span>
		</div>
		<div class="article_title">
			<h1>{{$news->new_title}}</h1>
			<span class="author">发布人: {{$news->new_author}}</span>
			<span class="time">发布时间：{{$news->new_time}}</span>
		</div>
		<div class="article_content">
			{!!$news->new_content!!}
		</div>
	</div>
	<div class="content_r">
		<div class="top_title">
			<div class="square "></div>
			<h1>最新公告<span> NEWS</span></h1>
		</div>
		<ul>
			@foreach($newlist as $key => $value)
			<li>
				<div class="exam_title">
					<i class="layui-icon" style="color: green;font-size: 17px;">&#xe623;</i>
					<a href="{{url('news')}}/{{$value->new_id}}" title="{{$value->new_title}}">{{$value->new_title}}</a>
				</div>
				<div class="new_time">
					<span>{{$value->new_time}}</span>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>
<!-- 内容结束 -->
@endsection
@section('javascript')

@endsection
