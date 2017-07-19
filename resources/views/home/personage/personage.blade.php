@extends('home.layout.index')
@section('style')
	<link href="{{url('home/css/k.css')}}" type="text/css" rel="stylesheet">
@endsection
@section('content')
<!-- start Content Middle -->
<div class="content_top">
	<div class="back-links">
		<p><a href="index.html">首页</a> &gt;&gt;&gt;&gt; <a>个人中心</a></p>
	</div>
	<div class="clear"></div>
</div>

<div class="section group" style="border:1px solid #E1E1E1;border-top:none;margin-top:20px;">

<div>

	<div class="GRtitle">
		<div class="GRtitleT GRtitleL">
			<button id="GRmenu">个人中心</button>
		</div>
		<div  class="GRtitleT ">
			<p class="GRtitleH3">基础设置</p>
		</div>
	</div>

	<div class="GRleftDIV" id="GRleftDIV">
		<ul class="GRleftNAV" id="GRleftNAV">
			<li class="" id="basic"><a href="javascript:;">基本设置</a></li>
			<li class="" id="secure"><a href="javascript:;">安全设置</a></li>
			<li class="" id="money"><a href="javascript:;">我的钱包</a></li>
			<li class="" id="review"><a href="javascript:;">我评论过的电影</a></li>
			<li class="" id="consume"><a href="javascript:;">我的消费记录</a></li>
		</ul>
	</div>

	<div class="GRcontent" id="GRcontent">
		<div class="GRpersonage1">
			<img src="{{ $data["uface"] }}" class="GRIMG">
		<form class="GRform1" action="" method="post">
			<div>
				<span>用户名: {{$data["username"]}}</span>        <br>
			</div>

			<div>
				呢称: <input type="text" name="name" value="{{$data -> name}}" id="GRINPUTname">  <br>
			</div>

			<div>	
				年龄: <input type="text" name="age" value="{{$data["age"]}}" id="GRINPUTage">  <br>
			</div>

			<div>
				性别: 女: <input type="radio" name="sex" value="w"  {{ $data["sex"]=="w"?"checked":"" }}  /> 
				 	  男: <input type="radio" name="sex" value="m"  {{ $data["sex"]=="m"?"checked":"" }} />
				  	  保密: <input type="radio" name="sex" value="x"  {{ $data["sex"]=="x"?"checked":"" }} /><br>
			</div>

			<span style="margin-top:15px">会员等级: {{ $data["auth"] }}</span>

			<div>
				<input type="button" value="保存" id="GRsave" /><br>
			</div>

			<div>
				<a href="javascript:;" class="a-upload">
					<input type="file" name="" id="">上传头像
				</a>
			</div>
		</form>
		</div>
		<input type="hidden" name="_token"  value="{{ csrf_token() }}" id="GRTOKEN"/>
	</div>

	</div>
</div>
<!-- end Content Middle -->
@endsection
@section('script')
	<script src="{{ url('home/js/k.js') }}" type="text/JavaScript"></script>
@endsection