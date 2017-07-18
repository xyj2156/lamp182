<!DOCTYPE HTML>
<html>
    <head>
        <title>{{$title}} -- {{config('webconf.title')}}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        @section('meta')
        <meta name="keywords" content="{{config('webconf.keywords')}}" />
        <meta name="description" content="{{config('webconf.description')}}"/>
        @show
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="{{asset('home/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
        <link href="{{asset('home/css/slider.css')}}" rel="stylesheet" type="text/css" media="all"/>
        <script type="text/javascript" src="{{asset('home/js/jquery-1.9.0.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('home/js/move-top.js')}}"></script>
        <script type="text/javascript" src="{{asset('home/js/easing.js')}}"></script>
        <script type="text/javascript" src="{{asset('home/js/jquery.nivo.slider.js')}}"></script>
        <script src="{{asset('layer/layer.js')}}"></script>
        @section('style')@show
        <script type="text/javascript">
            $(function() {
                $('#slider').nivoSlider();
            });
        </script>
    </head>
    <body>
        {{--提示失败或者成功--}}
        @if(session('success') || session('error'))
            <script>
                $(function (){
                    layer.msg('{{session('success')?session('success'):session('error')}}',{icon:'{{session('success')?6:5}}'});
                });
            </script>
        @endif

        {{--提示表单验证错误--}}
        @if (count($errors) > 0)
            <script>
                $(function () {
                    layer.alert(
                        '@foreach($errors -> all() as $err){{$err.'\n'}}@endforeach',
                        {
                            time:3000,
                            icon:5
                        }
                    );
                });
            </script>
        @endif
        <div class="header">
            <div class="headertop_desc">
                <div class="wrap">
                    <div class="nav_list">
                         <ul>
                             <li><a href="{{url('/')}}">主页</a></li>
                             <li><a href="index.html">地区</a></li>
                             <li><a href="index.html">年份</a></li>
                             <li><a href="index.html">类型</a></li>
                         </ul>
                    </div>
                    <div class="account_desc">
                        <ul>
                            <li><a href="{{url('reg')}}">注册</a></li>
                            <li><a href="{{url('login')}}">登录</a></li>
                            <li><a href="preview.html">支付</a></li>
                            <li><a href="#">订单</a></li>
                            <li><a href="#">个人中心</a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="wrap">
                <div class="header_top">
                     <div class="logo" style="width:187px;height:87px;overflow: hidden;">
                         <a href="{{url('/')}}"><img src="{{asset(config('webconf.logo'))}}" alt="" /></a>
                     </div>
                     <div class="header_top_right">
                          <div class="search_box">
                              <form method="post" action="/search">
                                  <input type="text" value="搜索电影" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '搜索电影';}"><input type="submit" value="">
                              </form>
                          </div>
                          <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                @section('banner')@show
            </div>
        </div>
       <!------------End Header ------------>
        <div class="main">
            <div class="wrap">
                <div class="content">
                    {{--填充内容--}}
                    @section('content')@show
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="wrap">
                <div class="section group">
                    <div class="social-icons">
                        <h4 style="font-weight: bold;">友情链接：</h4>
                        <ul>
                            @foreach(config('link') as $v)
                            <li title="{{$v['linktitle']}}"><a href="{{$v['linkurl']}}" target="_blank"><img src="{{asset($v['linkthumb'])}}" alt=""></a><p>{{$v['linkname']}}</p></li>
                            @endforeach
                            <div class="clear"></div>
                        </ul>
                    </div>
                </div>
                <div class="copy_right">
                    <p>{{str_replace('xxxx',date('Y'),config('webconf.copyright'))}} <a>{{config('webconf.icp')}}</a> <a href="mailto://{{config('webconf.email')}}">{{config('webconf.email')}}</a> <a target="_blank" href="https://github.com/xyj2156/lamp182">技术支持</a></p>
                </div>
            </div>
        </div>
        {{--下面是回到顶部--}}
        <script type="text/javascript">
            $(document).ready(function() {
                $().UItoTop({ easingType: 'easeOutQuart' });
            });
        </script>
        <a href="#" id="toTop"><span id="toTopHover"></span></a>
        @section('script')@show
    </body>
</html>

