@extends('home/common/layout')
@section('title')
模拟试题
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('public/home/styles/exam.css')}}">
@endsection
@section('content')
<!-- 内容开始 -->
<div class="content">
	<div class="content_l">
		<div class="current_nav">
			<span class="layui-breadcrumb">
				<a href="{{url('')}}">首页</a>
				<a href="javascript:;">模拟试题</a>
				<a><cite>{{$examplay->exam_title}}</cite></a>
			</span>
			<a style="float:right;" href="javascript:;" onclick="exam_answer()">查看答案</a>
		</div>
		<div class="article_title">
			<h1>{{$examplay->exam_title}}</h1>
			<span class="author">发布人: {{$examplay->exam_author}}</span>
			<span class="time">发布时间：{{$examplay->exam_time}}</span>
		</div>
		<div class="article_content">
			{!!$examplay->exam_content!!}
		</div>
	</div>
	<div class="content_r">
		<div class="top_title">
			<div class="square "></div>
			<h1>模拟试题<span> EXAM</span></h1>
		</div>
		<ul>
			@foreach($examlist as $key => $value)
			<li>
				<div class="exam_title">
					<i class="layui-icon" style="color: green;font-size: 17px;">&#xe623;</i>
					<a href="{{url('exam')}}/{{$value->exam_id}}" title="{{$value->exam_title}}">{{$value->exam_title}}</a>
				</div>
				<div class="exam_time">
					<span>{{$value->exam_time}}</span>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>
<!-- 内容结束 -->
@endsection
@section('javascript')
<script>
	function exam_answer(){
		layui.use('layer', function(){
			@if($examplay->exam_answer=="")
				layer.msg('很抱歉!该试题没有答案!');
			@else
				layer.open({
				  type:2,
				  area: ['400px', '600px'],
				  shade: 0,
				  scrollbar: true,
				  anim: 4,
				  title: ["答案:{{$examplay->exam_title}}",'text-align:center;font-size:16px;'],
				  moveOut: true,
				  closeBtn: 2,
				  content: ['{{url('exam_answer')}}/{{$examplay->exam_id}}','yes']
				});
			@endif
		});
	}
</script>
@endsection
