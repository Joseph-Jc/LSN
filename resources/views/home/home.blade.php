@extends('home/common/layout')
@section('title')
首页
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('public/home/styles/home.css')}}">
@endsection
@section('content')
<!-- 网页内容开始 -->
<div class="content">
	<div class="index_a">
		<div class="img_car">
			<div class="layui-carousel" id="img_car">
				<div carousel-item>
					@foreach ($new_imgcar as $key => $value)
						<div>
							<a href="{{$value->img_link}}"><img style="width:500px;height:300px;" src="{{$value->img_path}}"></a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="lesson_intro">
			<div class="top_a">
				<i class="layui-icon" style="font-size: 15px; color: #5fb878;">&#xe617;</i>
				<h1>课程简介 <span>LESSON INTRO<span></h1>
				<div class="more">
					<a href="http://localhost/lsn/about/4/4"><i class="layui-icon" style="font-size: 30px; line-height: 40px;">&#xe65f;</i></a>
				</div>
			</div>
			<div>
				<img class="intro_img" src="http://localhost/lsn/uploads/images/20180502002259175.PNG" alt="">
				<div class="intro_content">
					{{$lesson_intro->about_summary}}
				</div>
			</div>
		</div>
	</div>
	<div class="index_b">
		<div class="campus_news">
			<div class="top_a">
				<i class="layui-icon" style="font-size: 15px; color: #5fb878;">&#xe617;</i>
				<h1>校内公告 <span>CAMPUS NEWS</span></h1>
				<div class="page">
					<div id="layui_page"></div>
				</div>
			</div>
			<div class="new_list">
				<ul class="new_listul">

				</ul>
			</div>
		</div>
		<div class="principal">
			<div class="top_a">
				<i class="layui-icon" style="font-size: 15px; color: #5fb878;">&#xe617;</i>
				<h1>课程负责人 <span>PRINCIPAL</span></h1>
				<div class="more">
					<a href="http://localhost/lsn/about/1/1"><i class="layui-icon" style="font-size: 30px; line-height: 40px;">&#xe65f;</i></a>
				</div>
			</div>
			<div class="principal_content" style="width:350px;height:400px">
				<div style="float:left; clear: both;" align="center">
					<img src="http://localhost/lsn/uploads/images/20180502002809293.png" width="150" height="200" alt="">
				</div>
				<p style="padding:10px;height:340px;">
					{{$prinpical->about_summary}}
				</p>
			</div>
		</div>
		<div class="courseware">
			<div class="top_a">
				<i class="layui-icon" style="font-size: 15px; color: #5fb878;">&#xe617;</i>
				<h1>模拟试题 <span>EXAM</span></h1>
				<div class="more">
					<a href="{{url('exam')}}/{{$nav_id['exam']}}"><i class="layui-icon" style="font-size: 30px; line-height: 40px;">&#xe65f;</i></a>
				</div>
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
	<div class="index_c">
		<div class="teach_video">
			<div class="top_a">
				<i class="layui-icon" style="font-size: 15px; color: #5fb878;">&#xe617;</i>
				<h1>教学视频 <span>TEACH VIDEOS</span></h1>
				<div class="more">
					<a href="{{url('video')}}/{{$nav_id['video']}}"><i class="layui-icon" style="font-size: 30px; line-height: 40px;">&#xe65f;</i></a>
				</div>
			</div>
			<ul>
				@foreach($video as $key => $value)
				<li>
					<div class="video_img">
						<div class="mask" id="mask-1"></div>
						<div class="mask" id="mask-2"></div>
						<a href="{{url('video')}}/{{$value->video_id}}"><i class="layui-icon">&#xe652;</i></a>
						<img src="{{url('')}}/{{$value->thum_path}}"></a>
					</div>
					<a href="{{url('video')}}/{{$value->video_id}}" title="{{$value->video_title}}"><h1 class="video_title">{{$value->video_title}}</h1></a>
					<h2 class="video_time">{{$value->video_time}}</h2>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="index_d">
		<div id="teacher-team">
			<h1>
				<span>教师团队</span>
			</h1>
			<div class="friend">
				<img class="mr_frBtnL prev" src="{{asset('public/home/images/mfrl.png')}}">
					<div class="mr_frUl">
						<ul id="mr_fu">
							@foreach ($teache_imgcar as $key => $value)
								<li>
									<a href="{{$value->img_link}}"><img style="width:142px;height:107px;" src="{{$value->img_path}}"></a>
								</li>
							@endforeach
						</ul>
					</div>
				<img class="mr_frBtnR next" src="{{asset('public/home/images/mfrr.png')}}">
			</div>
		</div>
	</div>
</div>
<!-- 网页内容结束 -->
@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('public/plugins/jquery/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/jquery/jquery.SuperSlide2.js')}}"></script>
<script type="text/javascript" src="{{asset('public/home/js/style.js')}}"></script>
<script>
	layui.use('carousel', function(){
	  var carousel = layui.carousel;
	  //建造实例
	  carousel.render({
		elem: '#img_car'
		,width: '500px' //设置容器宽度
		,height: '300px'
		,arrow: 'hover' //始终显示箭头
		//,anim: 'updown' //切换动画方式
	  });
	});

</script>
<script>
	layui.use(['laypage','jquery'], function(){
	  var laypage = layui.laypage;
	  var $ = layui.jquery;
	  //执行一个laypage实例
	  laypage.render({
	    elem: 'layui_page' //注意，这里的 test1 是 ID，不用加 # 号
		,layout:['page']
		,count:30
	    ,jump: function(obj){
	      var page=obj.curr;
		  var limit=obj.limit;
		  $.ajax({
			  url:"{{url('new_list')}}?page="+page+"&limit="+limit,
			  type:"get",
			  dataType: "json",
			  success:function(data){
				  $('.new_listul').html("");
				  for(i=0;i<data.data.length;i++){
					  var html="<li><span class=\"time\">"+data.data[i].new_time+"</span><span class=\"title\"><a target=\"_blank\" href=\"{{url('news')}}/"+data.data[i].new_id+"\" title=\""+data.data[i].new_title+"\">"+data.data[i].new_title+"</a></span></li>";
					  $(".new_listul").append(html);
				  }
			  }
		  });
	    }
	  });
	});
</script>
@endsection
