@extends('home.layout.index')

@section('content')
    <div class="content_top">
        <div class="heading">
            <h3>{{$name}}</h3>
        </div>
    </div>
    <div class="section group">
        @foreach($film as $k =>$v)
            <div class="grid_1_of_5 images_1_of_5">
                <a href="{{url('filmdetails/'.$v -> id)}}"><img src="{{asset($v -> film_pic)}}" alt="{{$v -> name}}" /></a>
                <h2><a href="{{url('filmdetails/'.$v -> id)}}">{{$v -> name}}</a></h2>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="rupees"><b color="red" >RMB：</b>{{$v -> price}} 元</span></p>
                    </div>
                    <div class="add-cart">
                        <h4><a href="{{url('filmdetails/'.$v -> id)}}">买票</a></h4>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        @endforeach
    </div>
    {{--分页--}}
    <div class="am-u-lg-12 am-cf">
        <div class="am-fr">
            {!! $film -> render() !!}
        </div>
    </div>

@endsection

@section('style')
    <style>
        /*分页样式*/
        .pagination{
            margin: 0;
            padding: 0;
            padding-left: 0;
            margin: 1.5rem 0;
            list-style: none;
            color: #999;
            text-align: left;
            position: relative;
            font-family: "Segoe UI","Lucida Grande",Helvetica,Arial,"Microsoft YaHei",FreeSans,Arimo,"Droid Sans","wenquanyi micro hei","Hiragino Sans GB","Hiragino Sans GB W3",FontAwesome,sans-serif;
            font-weight: 400;
            line-height: 1.6;
            text-align: center;
        }
        .pagination>li{
            margin: 0 3px;
            display: inline-block;
        }
        .pagination>li span,.pagination>li a{
            color: #fff;
            padding: 6px 12px;
            background: #FC7D01;
            border: none;
            border-radius: 0;
            margin-bottom: 5px;
            margin-right: 5px;
            display: block;
        }
        .pagination>li.active span{
            background: #167fa1;
            color: #fff;
            border: 1px solid #167fa1;
            padding: 6px 12px;
        }
    </style>
@endsection