@extends('home.layout.index')

@section('content')
    <div class="main">
        <div class="wrap">
            <div class="content_top">
                <div class="back-links">
                    <p><a href="{{url('/')}}">首页</a> &gt;&gt;&gt;&gt; <a href="#" class="active">电影详情</a></p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">
                <div class="cont-desc span_1_of_2">
                    <div class="product-details">
                        <div class="grid images_3_of_2">
                            <img src="{{$film -> film_pic}}" alt="">
                        </div>
                        <div class="desc span_3_of_2">
                            <h2 style="font-size:30px">{{$film -> name}}</h2>
                            <p></p>
                            <p><span></span> &nbsp; {{$filmdetail -> film_detail}}</p>
                            <div class="price">
                                <p style="font-size:16px;color: #333;font-family: 'ambleregular';">价格: <span>{{$film -> price}}</span></p>
                            </div>
                            <div class="available">
                                <ul>
                                    <li><span>导演:</span> &nbsp; {{$filmdetail -> director}}</li>
                                    <b style="font-size:16px;color: #333;font-family: 'ambleregular';">演员:</b> &nbsp;<span style="color: #707070;">@foreach($cast as $k => $v){{$v -> name}} &nbsp;  &nbsp; @endforeach</span>
                                    {{-- 项英杰 修复电影类型 --}}
                                    <li><span>类型:</span>&nbsp; {{$type[$film->_type]}} / {{$type[$film->area_type]}} / {{$type[$film->year]}}</li>
                                    <p></p>
                                    <li><span>上映时间:</span>&nbsp; {{$filmdetail -> uptime}}</li>
                                    <li><span>片长:</span>&nbsp; {{$filmdetail -> time}}</li>
                                </ul>
                            </div>
                            <div class="wish-list" style="margin-bottom: -10px;">
                                <ul>
                                    <li><div class="button"><a href="javascript:;" onclick="buy_movie()">购票</a></div></li>
                                    <li class="wish" ><span style="color:red;">{{$film -> play}}</span>播放量</li>
                                    <li class="wish" ><span style="color:red;">{{$film -> click}}</span>点击量</li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    {{--剧情简介--}}
                    <div class="product_desc">
                        <p style="font-size:20px;color: #333;font-family: 'ambleregular';">剧情简介:</p>
                        <span>{!! $filmdetail -> film_detail_full !!}<span/>
                    </div>
                    {{--评论--}}
                    <div class="product_desc">
                        <p style="font-size:20px;color: #333;font-family: 'ambleregular';border-bottom: 2px solid #707070; margin-bottom:20px">热门短评:</p>
                            @foreach($reciew as $kk=>$vv)
                            <div class="review_cnt" id="longcomment">
                                <ul class="clear">
                                    <li class="bdb_f2">
                                        <div class="fl pr">
                                            <div class="bjj"></div>
                                            <img src="{{url($vv['uface'])}}" onerror="javascript:this.src='http://film.spider.com.cn/img/common/images/boy.jpg'" width="80" height="80">
                                            <div class="tc fs0">{{$vv['name']}}</div>
                                        </div>
                                        <div class="fl w730 ml20 mt10">
                                            <div class="fs0 f14">{{$vv['content']}}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                        {{--分页--}}
                        <div class="am-u-lg-12 am-cf">
                            <div class="am-fr">
                                {!! $reciew -> render() !!}
                            </div>
                        </div>
                        {{--发表评论--}}
                        <form action="{{url('comment')}}" method="post">
                            {{csrf_field()}}
                            <div class="published pr" id="datecontent2">
                                <textarea class="published_text fl" cols="" rows="" name='filmcontent2' id="filmcontent2" value='' style="color: rgb(145, 145, 145);" ></textarea>
                                <input type="button" value="发表" id="tjdd" class="published_btn fr fw" onclick="fun()">
                            </div>
                        </form>
                    </div>
                </div>
                {{--右侧--}}
                <div class="rightsidebar span_3_of_1 sidebar">
                    <h2>点击榜</h2>
                    @foreach($click as $k => $v)
                    <div class="special_movies">
                        <div class="movie_poster">
                            <a href="preview.html"><img src="{{$v -> film_pic}}" alt=""></a>
                        </div>
                        <div class="movie_desc">
                            <h3><a href="preview.html">{{$v -> name}}</a></h3>
                            <p><span>$620.87</span> &nbsp; {{$v -> price}}</p>
                            <span><a href="#">购票</a></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    @endforeach
                </div>
                <div class="rightsidebar span_3_of_1 sidebar">
                    <h2>热播榜</h2>
                    @foreach($play as $kk => $vv)
                        <div class="special_movies">
                            <div class="movie_poster">
                                <a href="preview.html"><img src="{{$vv -> film_pic}}" alt=""></a>
                            </div>
                            <div class="movie_desc">
                                <h3><a href="preview.html">{{$vv -> name}}</a></h3>
                                <p><span>$620.87</span> &nbsp; {{$vv -> price}}</p>
                                <span><a href="#">购票</a></span>
                            </div>
                            <div class="clear"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        // 评论
        function fun(){
            $.ajax({
                type : 'post',
                url:'{{url('comment')}}',
                data:{
                    content :$('#filmcontent2').val(),
                    _token:'{{csrf_token()}}',
                    fid: '{{$film -> id}}'
                },
                success:function(data){
                    if(data.status !== 0){
                        layer.alert(data.data);
                    } else {
                        layer.alert(data.data);
                        setTimeout(function(){
                            location.href = '{{url('filmdetails')}}/{{$film -> id}}';
                        },500);
                    }
                },
            });
        }
        // 购票
        function buy_movie(){
            $.ajax({
                type : 'post',
                url:'{{url('movie')}}',
                data:{
                    _token:'{{csrf_token()}}',
                    id:'{{$film -> id}}'
                },
                success:function(data){
                    console.log(data);
                    var arr = data.data;
                    var str = '';
                    for (var i = 0; i < arr.length; i++){
                        str += "<ul class='movie_box'>"+
                                    "<a href='{{url('order')}}?id="+arr[i][1]+"'>"+"<li>"+ arr[i][0] +"</li>"+"</a>"+
                                "</ul>";
                    }

                    layer.open({
                        type: 1,
                        title:'影厅',
                        skin: 'layui-layer-demo', //样式类名
                        closeBtn: 0, //不显示关闭按钮
                        anim: 2,
                        shadeClose: true, //开启遮罩关闭
                        content:str
                    });
                }

            });


        }


    </script>


@endsection

@section('style')
    <style>
        {{--电影购票--}}
        .movie_box li{
            float:left;
            margin:10px;
            width:100px;
            height:100px;
            background:#FC7D01;
            text-align: center;
            line-height:100px;
            cursor:pointer;
        }
        .movie_box a{
            color:#fff;
        }


        .published {
            height: 78px;
            padding: 0;
            border: solid 2px #6e7aa0;
        }
        .published_text {
            font-size: 14px;
            line-height: 24px;
            width: 82.1%;
            height: 58px;
            padding: 10px;
            border: 0px;
            vertical-align: top;
            resize: none;
        }
        .published_btn {
            font-size: 18px;
            width: 14.8%;
            height: 100%;
            line-height: 78px;
            cursor: pointer;
            border: 1px;
            background: #6e7aa0;
            color: #fff;
            float: right;
        }
        .bdb_f2 .mt10{
            width: 688px;
            margin-left: 120px;
            margin-top: -105px;
        }
        .bdb_f2 .mt7{
            font-size:14px;
            color:  #707070;
        }
        #longcomment{
            margin-bottom: 50px;
        }
        .bdb_f2{
            margin-bottom: 50px;
        }
        .pr {
            border-bottom: 1px solid #ccc;
            margin-bottom: 50px;
            width:97%;
        }
        .tc{
            margin-bottom: 10px;
        }

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








