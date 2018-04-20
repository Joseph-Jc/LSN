@extends('home/common/layout')
@section('title')
电子教材
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('public/home/styles/ebook.css')}}">
@endsection
@section('content')
<!-- 内容开始 -->
<div class="content">
	<div class="content_l">
		<div class="current_nav">
			<span class="layui-breadcrumb">
				<a href="{{url('')}}">首页</a>
				<a href="javascript:;">电子教材</a>
				<a><cite>{{$ebookplay->ebook_name}}</cite></a>
			</span>
		</div>
		<embed src="{{url('')}}/{{$ebookplay->ebook_path}}" style="width: 850px;height: 1000px;" type="application/pdf">
	</div>
	<div class="content_r">
		<div class="top_title">
			<div class="square "></div>
			<h1>电子教材<span> EBOOK</span></h1>
		</div>
		<ul class="ebook_list">
			@foreach($ebooklist as $key => $value)
			<li>
				<a href="{{url('ebook')}}/{{$value->ebook_id}}">
					<img class="{{Request::getPathInfo()=='/ebook/'.$value->ebook_id?'active':'unactive'}}" @if($value->ebook_thum!="uploads/ebook/")src="{{url('')}}/{{$value->ebook_thum}}"@endif>
					<p style="text-align:center">{{$value->ebook_name}}</p>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
</div>
<!-- 内容结束 -->
@endsection
@section('javascript')

@endsection
