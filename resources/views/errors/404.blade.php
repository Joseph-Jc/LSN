@extends('home/common/layout')
@section('title')
没有内容
@endsection
@section('styles')
<style>
	.content{
		margin: 0 auto;
	}
</style>
@endsection
@section('content')
	<div class="content">
		<img style="width:1100px;height:619px;" src="{{asset('public/home/images/404.png')}}">
	</div>
@endsection
