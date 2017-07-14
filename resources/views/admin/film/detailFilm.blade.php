@extends('admin.layout.index')
@section('content')
	<style>
		#filmDetailPIC{
			width: 300px;
			height: 300px;
			border: 1px solid #000;
			margin-left: 50px;
			float:left;
		}
		.filmDetailGrid{
			margin-left: 50px;
			width: 40%;
			float:left;
		}
		#filmDetailBUN{ float:left; }
		.filmDetailModuel{height:300px;}
		.filmDetailH2{margin-bottom:5px;}
	</style>
	<div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 电影管理 <small>江洋八子</small></div>
                <p class="page-header-description">简单组合。。。干不简单的事情。。。</p>
            </div>
        </div>
    </div>

    <div class="row-content am-cf">
    {{--显示表格--}}
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">{{$title}}</div>
                </div>
                <div class="widget-body  widget-body-lg am-fr">
                <div>
                <img src="{{$data['film_pic']}}" id="filmDetailPIC" />
				<section class="features filmDetailModuel">
				<div class="grid filmDetailGrid">
					<div class="unit one-third">
						<h2 class="filmDetailH2">{{$data['name']}}</h2>
						<span>票价 :</span>  $ {{$data['price']}} <br>
						<span>导演 :</span> {{ $data['director'] }} &nbsp; <span>演员 :</span> @foreach($data['actor'] as $k => $v)  
																									{!! '<a href='.url("admin/cast").'?search='.$v->name.'>'.$v->name.'</a>,&nbsp;'!!}  
																								@endforeach<br>
						<span>上映时间 :</span>	{{ $data['uptime'] }}	<br>
						<span>类型 :</span>	{{$data['_type']}}	<br>
						<span>地区 :</span>	{{$data['area_type']}}	<br>
						<span>年份 :</span>	{{$data['year']}}	<br>
						<span>点击量 :</span>	{{$data['click']}}	<br>
						<span>播放次数 :</span>	{{$data['play']}}	<br>
						<span>片长 :</span>	{{ $data['time'] }}	<br>
						<span>预告片 :</span>	-- --	<br>
					</div>
				</div>
				<div class="am-u-lg-3 tpl-index-settings-button">
                <button id="filmDetailBUN" type="button" class="page-header-button" onclick="location.href='{{url('admin/film/'.$data['id'].'/edit')}}';"><span class="am-icon-paint-brush"></span> 编辑电影</button>
            	</div>
				</section>
				<div style="clear:both"></div>
				<p>简介: {{ $data['film_detail'] }}</p>
				</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection