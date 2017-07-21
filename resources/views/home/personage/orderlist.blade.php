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
		<form action="{{url('orderlist')}}" method="get">
			<span class="orderyear">年</span><input type="text" name="year" size="2"> 
			<span>月</span><input type="text" name="month" size="2"> 
			<span>日</span><input type="text" name="day" size="2" class="orderday">
			<input type="text" name="orderSearch" value="{{ $search["orderSearch"] or '搜索订单号' }}" onfocus="this.value = '';" class="ordersearch"/>
			<input type="submit" value="搜索">
		</form>
		<div class="clear"></div>
	</div>

	<div class="section group">
	@foreach($data as $k => $v)
		<div class="GRorderCT">
			<div class="GRorder">
				<i>{{date('Y-m-d H:i:s',$v->ctime)}}</i>   <br>
				<div class="GRordertop">
					<span>影厅: {{$v->room}}字号房 </span> <span>开播时间: {{date('H:i:s',$v->start_time)}} </span> <span>影片: {{$v->fname}} </span> <span style="width:300px">座位: {{$v->seat}} </span> <span>单座票价: {{$v->price}} </span>  <br>
				</div>
				<div class="GRorderbottom">
					<span>座位数:{{$v->num}}</span>  <span> 总价: {{$v->price*$v->num}} </span>  <span>订单状态: {{$v->status}}</span>
					<b>单号: {{$v->name}}</b>
				</div>       
			</div><br>
		</div>
	@endforeach
		{!! $data -> appends($search) -> render() !!}
	</div>
</div>
<!-- end Content Middle -->
@endsection
