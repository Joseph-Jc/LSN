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
					<a href=""><i class="layui-icon" style="font-size: 30px; line-height: 40px;">&#xe65f;</i></a>
				</div>
			</div>
			<div>
				<img class="intro_img" src="{{asset('public/home/images/lessonbook.png')}}" alt="">
				<div class="intro_content">
					C 语言是国内外应用最为广泛的一种计算机语言。C语言功能丰富，表达力强，使用方便灵活，生成的目标程序质量高，应用面广，可移植性好，既具有高级语言的特 点，又具有低级语言的绝大部分功能；几乎任何一种机型（大型机、小型机）、任何一种操作系统（Windows、Linux、Unix）都支持 C 语言开发。C 语言在巩固其原有应用领域的同时，又在拓展新的应用领域，支持大型数据库开发和 Internet 应用。在国内外的计算机及其相关专业的本科和专科中也都普遍安排了C语言程序设计的课程。本课程是计算机及其...
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
					<a href=""><i class="layui-icon" style="font-size: 30px; line-height: 40px;">&#xe65f;</i></a>
				</div>
			</div>
			<div class="principal_content" style="width:350px;height:400px">
				<div style="float:left; clear: both;" align="center">
					<img src="{{asset('public/home/images/lessonperson.png')}}" width="150" height="200" alt="">
				</div>
				<p style="padding:10px;height:340px;font-size:15px;">
					戴经国，男，1962年出生，硕士，教授，硕士生导师。 现任韶关学院信息科学与工程学院、软件学院（广东省示范性软件学院）和ICT学院（韶关学院—中兴通讯ICT学院）院长，韶关市计算机学会理事长、广东省 计算机学会常务理事、广东省计算机类专业教学指导委员会委员。从教34年来，主讲《C语言程序设计》、《计算机网络》、《数据结构》、《C++程序设计》 等专业基础课和专业课。2012年获南粤优秀教师、韶关市专业技术拔尖人才，2014年获韶关学院教学名师、韶关学院优秀教学团...
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
					<a href="{{url('video')}}/{{$value->video_id}}" title="{{$value->video_title}}"><h1 class="video_title">{{$value->video_title}}</h1>
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
