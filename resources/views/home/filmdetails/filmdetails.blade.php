@extends('home.layout.index')

@section('content')
    <div class="main">
        <div class="wrap">
            <div class="content_top">
                <div class="back-links">
                    <p><a href="index.html">首页</a> &gt;&gt;&gt;&gt; <a href="#" class="active">电影详情</a></p>
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
                                    <li><span>类型:</span>&nbsp; {{$type -> name}}</li>
                                    <p></p>
                                    <li><span>上映时间:</span>&nbsp; {{$filmdetail -> uptime}}</li>
                                    <li><span>片长:</span>&nbsp; {{$filmdetail -> time}}</li>
                                </ul>
                            </div>
                            <div class="wish-list" style="margin-bottom: -10px;">
                                <ul>
                                    <li><div class="button"><span><a href="">购票</a></span></div></li>
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
                        <p style="font-size:20px;color: #333;font-family: 'ambleregular';">热门短评:</p>

                        <div class="review_cnt" id="longcomment">
                            <ul class="clear">
                                <li class="bdb_f2">
                                    <div class="fl pr">
                                        <div class="bjj"></div>
                                        <img src="http://film.spider.com.cn/img/common/images/boy.jpg" onerror="javascript:this.src='http://film.spider.com.cn/img/common/images/boy.jpg'" width="80" height="80">
                                        <div class="tc fs0">灵魂的尾巴***</div>
                                    </div>
                                    <div class="fl w730 ml20 mt10">
                                        <div class="fs0 f14">戴美瞳的大圣，大战一半去换发型的天尊，好色的卷帘，古板的天蓬，有点儿像紫霞的阿紫，宛如智障的阿月以及永远都差不多的二郎。剪辑的真是乱七八糟，好在特效可以补救回来，反正金箍棒一扛，背景音乐一响，观众就燃了起来。这算是我看到第一次说起筋斗云来历的</div>
                                        <div class="fsc8 mt7">来自：蜘蛛电影票iphone版2017-07-14 13:51:55 </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <p></p>
                        <div class="published pr" id="datecontent2">
                            <textarea class="published_text fl" cols="" rows="" id="filmcontent2" style="color: rgb(145, 145, 145);" onkeyup="textareaMaxlength('2');" onfocus="if(this.value=='其实我是从很严谨的学术角度来评价这部电影的...'){this.value='';this.style.color='#333333'}" onblur="if(this.value==''){this.value='其实我是从很严谨的学术角度来评价这部电影的...';this.style.color='#919191'}">其实我是从很严谨的学术角度来评价这部电影的...</textarea>
                            <input type="button" value="发表" id="tjdd" class="published_btn fr fw" onclick="addfilmShortcomment('悟空传',3,'l','2')">
                        </div>
                    </div>

                </div>

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


@endsection

@section('style')
    <style>

        .published {
            height: 78px;
            padding: 0;
            border: solid 2px #6e7aa0;
            margin-top: 20px;
        }
        .published_text {
            font-size: 14px;
            line-height: 24px;
            width: 688px;
            height: 57px;
            padding: 10px;
            border: 0px;
            vertical-align: top;
            resize: none;
        }
        .published_btn {
            font-size: 18px;
            width: 100px;
            height: 78px;
            line-height: 78px;
            cursor: pointer;
            border: 1px;
            background: #6e7aa0;
            color: #fff;
        }
        .bdb_f2 .mt10{
            width: 688px;
            margin-left: 120px;
            margin-top: -105px;
        }

    </style>

    @endsection

