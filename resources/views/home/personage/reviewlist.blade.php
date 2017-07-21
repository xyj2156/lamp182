@extends('home.layout.index')
@section('style')
	<link href="{{url('home/css/k.css')}}" type="text/css" rel="stylesheet">
@endsection
@section('content')
<!-- start Content Middle -->
<div class="OrderList">
	<div class="content_top">
		<div class="back-links" style="width:300px">
			<p class="">
				<a href="{{url('/')}}">首页</a> &gt;&gt;&gt;&gt; <a>{{$title}}</a>
			</p>
		</div>
		<div class="clear"></div>
	</div>
	

<div class="section group">
	@foreach($data as $k=>$v)
			@if( !in_array($v->fid,$fid) )
				<?php $fid[] = $v->fid ?>
			@else
				 <?php continue; ?>
			@endif
	<div class="GRfilm">
		<div>
			<img class="filmTOP" src="{{$v->film_pic}}">
		</div>
		<div class="filmBOTTOM">
			<span>电影名称: {{$v->name}}</span> <span>导演: {{$v->director}} </span>  <span>演员: {{$v->actor}}</span><br>
			<span>票价: ${{$v->price}} </span> <span>片长: {{$v->ftime}}</span> <span>类型: {{$v->_type}} </span> <span>地区: {{$v->area_type}} </span>  <span>年份: {{$v->year}} </span><br>
			{!! $str0[$v->fid] !!}
		</div>
	</div>
	<div style="clear:both"></div>
	@endforeach
</div>
<!-- end Content Middle -->
@endsection