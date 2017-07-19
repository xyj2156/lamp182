@extends('home.layout.detail')

@section('style')
    <link href="{{asset('home/css/login.css')}}" rel="stylesheet" type="text/css" media="all"/>
@endsection
@section('script')
    <script>
        $('img[alt]').click(function () {
            this.src = '{{url('code')}}/' + Math.random().toString().replace('.', '') + '.jpg';
        });
    </script>
@endsection

@section('content')

                <div class="content_top">
                    <div class="back-links">
                        <p><a href="{{url('/')}}">主页</a> &gt;&gt;&gt;&gt; <a href="#" class="active">登录</a></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="section group">
                    <div class="col span_2_of_3">
                        <div class="tab-con" style="border-right: 1px solid #ccc;">
                            <form id="form-login" method="post" action="{{url('dologin')}}">
                                {{csrf_field()}}
                                <div id="login-error" class="error-tip"></div>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <th>账户</th>
                                        <td width="245">
                                            <input id="email" type="text" name="email" placeholder="电子邮箱/手机号" autocomplete="off" value="{{old('email')}}"></td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>密码</th>
                                        <td width="245">
                                            <input id="password" type="password" name="password" placeholder="请输入密码" autocomplete="off">
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr id="tr-vcode" >
                                        <th>验证码</th>
                                        <td width="245">
                                            <div class="valid">
                                                <input type="text" style='width:190px' class="tpl-form-input" required id="user-name" placeholder="请输入验证码" name="code">
                                                <div>
                                                    <img src="{{ url('code') }}/{{rand(10000, 99999)}}.jpg" alt="验证码" style='margin-left: 200px;margin-top:-35px;'>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
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
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td width="245"><input class="confirm" type="submit" value="登  录"></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="col span_1_of_3">
                        <div class="reg">
                            <p>还没有账号？<br>赶快免费注册一个吧！</p>
                            <a class="reg-btn" href="{{url('/reg')}}">立即免费注册</a>
                        </div>
                    </div>
                </div>

@endsection


<script>
    $('img[alt]').click(function () {
        this.src = '{{url('code')}}/' + Math.random().toString().replace('.', '') + '.jpg';
    });
</script>