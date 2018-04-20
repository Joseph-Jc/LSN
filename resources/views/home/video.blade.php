@extends('home/common/layout')
@section('title')
教学视频
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('public/home/styles/video.css')}}">
@endsection
@section('content')
<div class="content">
	<div class="content_title">
		<span class="layui-breadcrumb">
			<a href="{{url('')}}">首页</a>
			<a href="javascript:;">教学视频</a>
			<a><cite>{{$videoplay->video_title}}</cite></a>
		</span>
	</div>
	<div class="video_box">
		<video width="100%" height="100%" controls="controls" src="{{url('')}}/{{$videoplay->video_path}}"></video>
	</div>
</div>
<div class="content_b">
	<hr class="layui-bg-black">
	<fieldset class="layui-elem-field layui-field-title">
		<legend>视频列表</legend>
	</fieldset>
	<div class="video_list">
		<ul>
			@foreach($videolist as $key => $value)
			<li>
				<div class="video_img @if($videoplay->video_id==$value->video_id) active_img @endif">
					<div class="mask" id="mask-1"></div>
					<div class="mask" id="mask-2"></div>
					<a href="{{url('video')}}/{{$value->video_id}}"><i class="layui-icon">&#xe652;</i></a>
					<img src="{{url('')}}/{{$value->thum_path}}">
				</div>
				<a title="{{$value->video_title}}" href="{{url('video')}}/{{$value->video_id}}" class="video_title @if($videoplay->video_id==$value->video_id) active_text @endif"> {{$value->video_title}}</a>
				<h2 class="@if($videoplay->video_id==$value->video_id) active_text @endif">{{$value->video_time}}</h2>
			</li>
			@endforeach
		</ul>
	</div>
</div>

@endsection
