@extends('home.layout.index')

@section('style')
    <link href="{{asset('home/css/login.css')}}" rel="stylesheet" type="text/css" media="all"/>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('home/js/reg.js')}}"></script>
    <script>
        $('img[alt]').click(function () {
            this.src = '{{url('code')}}/' + Math.random().toString().replace('.', '') + '.jpg';
        });
    </script>
@endsection

@section('content')


        <div class="content_top">
            <div class="back-links" style="min-width: 300px;">
                <p><a href="{{url('/')}}">主页</a> &gt;&gt;&gt;&gt; <a  class="active">注册</a></p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <div class="col span_1_of_3" style="border-right: 1px solid #ccc;">
                <div class="reg">
                    <p>已有账号？<br>赶快登陆吧！</p>
                    <a class="reg-btn" href="{{url('login')}}">立即登陆</a>
                </div>
            </div>
            <div class="col span_2_of_3">
                <ul id="reg_choose">
                    <li></li><li class="">邮箱注册</li><li class="active">手机注册</li><li></li>
                </ul>
                <div id="reg_all" style="transform: rotateY(180deg);">
                    <div class="tab-con" id="reg_mail" style="padding-top: 0">
                        <form id="form-login" method="post" action="reg?type=mail">
                            <div id="login-error" class="error-tip"></div>
                            <table border="0" cellspacing="0" cellpadding="0" style="margin:0 auto">
                                <tbody>
                                <tr>
                                    <th>邮箱</th>
                                    <td width="245">
                                        <input id="email" type="text" name="email" placeholder="邮箱" autocomplete="off" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th>密码</th>
                                    <td width="245">
                                        <input id="password" type="password" name="password" placeholder="请输入密码" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <th>确认密码</th>
                                    <td width="245">
                                        <input id="repassword" type="password" name="repassword" placeholder="请输入确认密码" autocomplete="off">
                                    </td>
                                </tr>
                                <tr id="tr-vcode">
                                    <th>验证码</th>
                                    <td width="245">
                                        <input type="text" name="vcode">
                                        <img style="position: absolute;z-index: 999" class="vcode" src="passport/vcode?_=1411476793" alt="验证码">
                                    </td>
                                </tr>
                                <tr class="find">
                                    <th></th>
                                    <td>
                                        <div>
                                            <label class="checkbox" for="chk11"><input style="height: auto;width: auto" id="chk11" type="checkbox" name="remember_me">记住我</label>
                                            <a href="passport/forget-pwd" style="float: right;">忘记密码？</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td width="245"><input class="confirm" type="submit" value="注 册"></td>
                                </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="refer" value="site/">
                        </form>
                    </div>
                    <div class="tab-con" id="reg_phone" style="padding-top: 0">
                        <form id="form-login" method="post" action="reg?type=phone">
                            <div id="login-error" class="error-tip"></div>
                            <table border="0" cellspacing="0" cellpadding="0" style="margin:0 auto">
                                <tbody>
                                <tr>
                                    <th>手机</th>
                                    <td width="245">
                                        <input id="email" type="text" name="phone" placeholder="手机" autocomplete="off" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th>密码</th>
                                    <td width="245">
                                        <input id="password" type="password" name="password" placeholder="请输入密码" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <th>手机验证码</th>
                                    <td width="245">
                                        <input id="repassword" type="password" name="phone_code" placeholder="手机验证码" autocomplete="off">
                                    </td>
                                </tr>
                                <tr class="find">
                                    <th></th>
                                    <td>
                                        <div>
                                            <label class="checkbox"><input style="height: auto;width: auto" type="checkbox" name="remember_me">记住我</label>
                                            <a href="passport/forget-pwd" style="float: right;">忘记密码？</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td width="245"><input class="confirm" type="submit" value="注 册"></td>
                                </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="refer" value="site/">
                        </form>
                    </div>
                </div>
            </div>
        </div>


@endsection

