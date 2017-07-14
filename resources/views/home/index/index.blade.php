@extends('home.layout.index')
@section('banner')@include('home.layout.banner')@endsection
@section('content')
    {{--首页中心部分--}}
    <div class="content_top">
        <div class="heading">
            <h3>正在热映</h3>
        </div>
    </div>
    <div class="section group">
        @foreach($film as $k =>$v)
        <div class="grid_1_of_5 images_1_of_5">
            <a href="preview.html"><img src="{{asset($v -> film_pic)}}" alt="{{$v -> name}}" /></a>
            <h2><a href="preview.html">{{$v -> name}}</a></h2>
            <div class="price-details">
                <div class="price-number">
                    <p><span class="rupees"><b color="red" >RMB：</b>{{$v -> price}} 元</span></p>
                </div>
                <div class="add-cart">
                    <h4><a href="preview.html">买票</a></h4>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="content_bottom">
        <div class="heading">
            <h3>热播电影</h3>
        </div>
    </div>
    <div class="section group">
        @foreach($play as $k =>$v)
            <div class="grid_1_of_5 images_1_of_5">
                <a href="preview.html"><img src="{{asset($v -> film_pic)}}" alt="{{$v -> name}}" /></a>
                <h2><a href="preview.html">{{$v -> name}}</a></h2>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="rupees"><b color="red">RMB：</b>{{$v -> price}} 元</span></p>
                    </div>
                    <div class="add-cart">
                        <h4><a href="preview.html">买票</a></h4>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        @endforeach
    </div>
@endsection