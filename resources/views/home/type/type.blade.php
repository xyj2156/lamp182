@extends('home.layout.index')

@section('content')

    <div class="tags-panel">
        <ul class="tags-lines">
            <li class="tags-line" data-val="{tagTypeName:'cat'}">
                <div class="tags-title">类型 :</div>
                <ul class="tags">
                    <li>
                        <a data-act="tag-click" data-val="{TagName:'全部'}" href="?yearId=12">全部</a>
                    </li>
                    <li>
                        <a data-act="tag-click" data-val="{TagName:'爱情'}" href="?yearId=12&amp;catId=3">爱情</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'喜剧'}" href="?yearId=12&amp;catId=2">喜剧</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'动画'}" href="?yearId=12&amp;catId=4">动画</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'剧情'}" href="?yearId=12&amp;catId=1">剧情</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'恐怖'}" href="?yearId=12&amp;catId=6">恐怖</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'惊悚'}" href="?yearId=12&amp;catId=7">惊悚</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'科幻'}" href="?yearId=12&amp;catId=10">科幻</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'动作'}" href="?yearId=12&amp;catId=5">动作</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'悬疑'}" href="?yearId=12&amp;catId=8">悬疑</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'犯罪'}" href="?yearId=12&amp;catId=11">犯罪</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'冒险'}" href="?yearId=12&amp;catId=9">冒险</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'战争'}" href="?yearId=12&amp;catId=12">战争</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'奇幻'}" href="?yearId=12&amp;catId=14">奇幻</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'运动'}" href="?yearId=12&amp;catId=15">运动</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'家庭'}" href="?yearId=12&amp;catId=16">家庭</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'古装'}" href="?yearId=12&amp;catId=17">古装</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'武侠'}" href="?yearId=12&amp;catId=18">武侠</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'西部'}" href="?yearId=12&amp;catId=19">西部</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'历史'}" href="?yearId=12&amp;catId=20">历史</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'传记'}" href="?yearId=12&amp;catId=21">传记</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'情色'}" href="?yearId=12&amp;catId=22">情色</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'歌舞'}" href="?yearId=12&amp;catId=23">歌舞</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'黑色电影'}" href="?yearId=12&amp;catId=24">黑色电影</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'短片'}" href="?yearId=12&amp;catId=25">短片</a>
                    </li><li class="active" data-state-val="{ catTagName:'纪录片'}">
                        <a data-act="tag-click" data-val="{TagName:'纪录片'}" href="javascript:void(0);" style="cursor: default">纪录片</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'其他'}" href="?yearId=12&amp;catId=100">其他</a>
                    </li>
                </ul>
            </li>
            <li class="tags-line tags-line-border" data-val="{tagTypeName:'source'}">
                <div class="tags-title">区域 :</div>
                <ul class="tags">
                    <li class="active" data-state-val="{ sourceTagName:'全部'}">
                        <a data-act="tag-click" data-val="{TagName:'全部'}" href="javascript:void(0);" style="cursor: default">全部</a>
                    </li>
                    <li>
                        <a data-act="tag-click" data-val="{TagName:'大陆'}" href="?yearId=12&amp;catId=13&amp;sourceId=2">大陆</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'美国'}" href="?yearId=12&amp;catId=13&amp;sourceId=3">美国</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'韩国'}" href="?yearId=12&amp;catId=13&amp;sourceId=7">韩国</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'日本'}" href="?yearId=12&amp;catId=13&amp;sourceId=6">日本</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'中国香港'}" href="?yearId=12&amp;catId=13&amp;sourceId=10">中国香港</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'中国台湾'}" href="?yearId=12&amp;catId=13&amp;sourceId=13">中国台湾</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'泰国'}" href="?yearId=12&amp;catId=13&amp;sourceId=9">泰国</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'印度'}" href="?yearId=12&amp;catId=13&amp;sourceId=8">印度</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'法国'}" href="?yearId=12&amp;catId=13&amp;sourceId=4">法国</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'英国'}" href="?yearId=12&amp;catId=13&amp;sourceId=5">英国</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'俄罗斯'}" href="?yearId=12&amp;catId=13&amp;sourceId=14">俄罗斯</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'意大利'}" href="?yearId=12&amp;catId=13&amp;sourceId=16">意大利</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'西班牙'}" href="?yearId=12&amp;catId=13&amp;sourceId=17">西班牙</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'德国'}" href="?yearId=12&amp;catId=13&amp;sourceId=11">德国</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'波兰'}" href="?yearId=12&amp;catId=13&amp;sourceId=19">波兰</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'澳大利亚'}" href="?yearId=12&amp;catId=13&amp;sourceId=20">澳大利亚</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'伊朗'}" href="?yearId=12&amp;catId=13&amp;sourceId=21">伊朗</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'其他'}" href="?yearId=12&amp;catId=13&amp;sourceId=100">其他</a>
                    </li>
                </ul>
            </li>
            <li class="tags-line tags-line-border" data-val="{tagTypeName:'year'}">
                <div class="tags-title">年代 :</div>
                <ul class="tags">
                    <li>
                        <a data-act="tag-click" data-val="{TagName:'全部'}" href="?catId=13">全部</a>
                    </li>
                    <li>
                        <a data-act="tag-click" data-val="{TagName:'2017以后'}" href="?yearId=13&amp;catId=13">2017以后</a>
                    </li><li class="active" data-state-val="{ yearTagName:'2017'}">
                        <a data-act="tag-click" data-val="{TagName:'2017'}" href="javascript:void(0);" style="cursor: default">2017</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'2016'}" href="?yearId=11&amp;catId=13">2016</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'2015'}" href="?yearId=10&amp;catId=13">2015</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'2014'}" href="?yearId=9&amp;catId=13">2014</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'2013'}" href="?yearId=8&amp;catId=13">2013</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'2012'}" href="?yearId=7&amp;catId=13">2012</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'2011'}" href="?yearId=6&amp;catId=13">2011</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'2000-2010'}" href="?yearId=5&amp;catId=13">2000-2010</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'90年代'}" href="?yearId=4&amp;catId=13">90年代</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'80年代'}" href="?yearId=3&amp;catId=13">80年代</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'70年代'}" href="?yearId=2&amp;catId=13">70年代</a>
                    </li><li>
                        <a data-act="tag-click" data-val="{TagName:'更早'}" href="?yearId=1&amp;catId=13">更早</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="content_bottom">
        <div class="heading">
            <h3>热播电影</h3>
        </div>
    </div>
    <div class="section group">
        @foreach($play as $k =>$v)
            <div class="grid_1_of_5 images_1_of_5">
                <a href="{{url('filmdetails/'.$v -> id)}}"><img src="{{asset($v -> film_pic)}}" alt="{{$v -> name}}" /></a>
                <h2><a href="{{url('filmdetails/'.$v -> id)}}">{{$v -> name}}</a></h2>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="rupees"><b color="red">RMB：</b>{{$v -> price}} 元</span></p>
                    </div>
                    <div class="add-cart">
                        <h4><a href="{{url('filmdetails/'.$v -> id)}}">买票</a></h4>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('style')
    <style>
        .tags-panel {
            border: 1px solid #e5e5e5;
            padding: 0 20px;
            margin-top: 40px;
        }
        .tags-panel {
            border: 1px solid #e5e5e5;
            padding: 0 20px;
            margin-top: 40px;
        }
        .tags-panel li, .tags-panel ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .tags-panel li, .tags-panel ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .tags-panel li, .tags-panel ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .tags-panel li, .tags-panel ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .tags-line {
            padding: 10px 0!important;
        }
        li {
            display: list-item;
            text-align: -webkit-match-parent;
        }
        .tags-title {
            height: 40px;
            line-height: 24px;
            float: left;
            color: #999;
            font-size: 14px;
            margin-top:10px;
        }

        .tags-panel li, .tags-panel ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .tags li.active {
            background: #f34d41;
            color: #fff;
        }
        .tags li.active {
            background: #f34d41;
            color: #fff;
        }
        .tags li {
            border-radius: 14px;
            padding: 3px 9px;
            display: inline-block;
            margin-left: 12px;
        }
        .tags-panel li, .tags-panel ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .tags li {
            border-radius: 14px;
            padding: 3px 9px;
            display: inline-block;
            margin-left: 12px;
        }
        .tags-panel li, .tags-panel ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        li {
            display: list-item;
            text-align: -webkit-match-parent;
        }
        .tags li.active a {
            color: #fff;
        }
        .tags li.active a {
            color: #fff;
        }
        .tags li a {
            color: #333;
            font-size: 14px;
        }
        .tags li a {
            color: #333;
            font-size: 16px;
            padding: 14px;
            display: inline-block;
        }
        a {
            text-decoration: none;
        }
        .tags-panel li, .tags-panel ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
       
        </style>

@endsection