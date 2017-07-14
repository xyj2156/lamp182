<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="{{asset('home/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
        <link href="{{asset('home/css/slider.css')}}" rel="stylesheet" type="text/css" media="all"/>
        <script type="text/javascript" src="{{asset('home/js/jquery-1.9.0.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('home/js/move-top.js')}}"></script>
        <script type="text/javascript" src="{{asset('home/js/easing.js')}}"></script>
        <script type="text/javascript" src="{{asset('home/js/jquery.nivo.slider.js')}}"></script>
        <script type="text/javascript" src="{{asset('home/js/reg.js')}}"></script>
        @section('style')@show
        @section('meta')@show
        <script type="text/javascript">
            $(function() {
                $('#slider').nivoSlider();
            });
        </script>
    </head>
    <body>
        <div class="header">
            <div class="headertop_desc">
                <div class="wrap">
                    <div class="nav_list">
                         <ul>
                             <li><a href="index.html">主页</a></li>
                             <li><a href="index.html">地区</a></li>
                             <li><a href="index.html">年份</a></li>
                             <li><a href="index.html">类型</a></li>
                         </ul>
                    </div>
                    <div class="account_desc">
                        <ul>
                            <li><a href="contact.html">注册</a></li>
                            <li><a href="contact.html">登录</a></li>
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
                     <div class="logo">
                         <a href="index.html"><img src="{{asset('home/images/logo.png')}}" alt="" /></a>
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
                    <div class="col_1_of_4 span_1_of_4">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Customer Service</a></li>
                            <li><a href="#">Advanced Search</a></li>
                            <li><a href="#">Orders and Returns</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col_1_of_4 span_1_of_4">
                        <h4>Why buy from us</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Customer Service</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="contact.html">Site Map</a></li>
                            <li><a href="#">Search Terms</a></li>
                        </ul>
                    </div>
                    <div class="col_1_of_4 span_1_of_4">
                        <h4>My account</h4>
                        <ul>
                            <li><a href="contact.html">Sign In</a></li>
                            <li><a href="index.html">View Cart</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="contact.html">Help</a></li>
                        </ul>
                    </div>
                    <div class="col_1_of_4 span_1_of_4">
                        <h4>Contact</h4>
                        <ul>
                            <li><span>+91-123-456789</span></li>
                            <li><span>地址:xxxxxxxxxxx</span></li>
                        </ul>
                    </div>
                </div>
                <div class="copy_right">
                    <p>Copyright &copy; 2014.Company name All rights reserved.<a target="_blank" href="http://www.777moban.com/">777模板</a></p>
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

