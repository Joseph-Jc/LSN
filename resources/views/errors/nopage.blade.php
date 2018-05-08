@extends('home/common/layout')
@section('title')
没有内容
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('public/home/styles/error_all.css')}}">
@endsection
@section('content')
<div class="error-404">
	<div id="doc_main">
		<section class="bd clearfix">
			<div class="module-error">
				<div class="error-main clearfix">
					<div class="label"></div>
					<div class="info">
						<h3 class="title">啊哦，你所访问的页面不存在了。</h3>
						<div class="reason">
							<p>可能的原因：</p>
							<p>1.在地址栏中输入了错误的地址。</p>
							<p>2.你点击的某个链接已过期。</p>
						</div>
						<div class="oper">
							<p><a href="javascript:history.go(-1);">返回上一级页面&gt;</a></p>
							<p><a href="{{url('')}}">回到网站首页&gt;</a></p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
@endsection
