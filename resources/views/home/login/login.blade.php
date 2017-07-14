@extends('home.layout.index')

@section('style')
    <link href="{{asset('home/css/login.css')}}" rel="stylesheet" type="text/css" media="all"/>
@endsection

@section('content')

                <div class="content_top">
                    <div class="back-links">
                        <p><a href="index.html">Home</a> &gt;&gt;&gt;&gt; <a href="#" class="active">Contact</a></p>
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
                                            <input id="email" type="text" name="email" placeholder="电子邮箱/手机号" autocomplete="off" value=""></td>
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
                                    <tr id="tr-vcode" style="display:none;">
                                        <th>验证码</th>
                                        <td width="245">
                                            <div class="valid">
                                                <input type="text" name="vcode"><img class="vcode" src="passport/vcode?_=1411476793" width="85" height="35" alt="">
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
                                <input type="hidden" name="refer" value="site/">
                            </form>
                        </div>
                    </div>
                    <div class="col span_1_of_3">
                        <div class="reg">
                            <p>还没有账号？<br>赶快免费注册一个吧！</p>
                            <a class="reg-btn" href="#">立即免费注册</a>
                        </div>
                    </div>
                </div>

@endsection