@extends('home.layout.detail')

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
                        <form id="form-login" method="post" action="{{url('/reg/doemail')}}">
                            <div id="login-error" class="error-tip"></div>
                            <table border="0" cellspacing="0" cellpadding="0" style="margin:0 auto">
                                <tbody>
                            {{csrf_field()}}
                                <tr>
                                    <th>邮箱</th>
                                    <td width="245">
                                        <input id="email" type="text" name="email" placeholder="邮箱" autocomplete="off" value="{{old('email')}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>密码</th>
                                    <td width="245">
                                        <input id="password" type="password" name="password" placeholder="请输入密码" autocomplete="off" value="{{old('password')}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>确认密码</th>
                                    <td width="245">
                                        <input id="repassword" type="password" name="repassword" placeholder="请输入确认密码" autocomplete="off" value="{{old('repassword')}}">
                                    </td>
                                </tr>
                                <tr id="tr-vcode">
                                    <th>验证码</th>
                                    <td width="245">
                                        <input style="width:200px" type="text" name="vcode" value="{{old('vcode')}}">
                                        <img style="position: absolute;z-index: 999" class="vcode" src="passport/vcode?_=1411476793" alt="验证码">
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

                    <!-- 手机注册 -->
                    <div class="tab-con" id="reg_phone" style="padding-top: 0">
                        <form id="form-login" method="post" action="{{url('doreg')}}">
                        {{csrf_field()}}
                            <div id="login-error" class="error-tip"></div>
                            <table border="0" cellspacing="0" cellpadding="0" style="margin:0 auto">
                                <tbody>
                                <tr>
                                    <th>手机</th>
                                    <td width="245">
                                        <input id="phone" type="text" name="phone" placeholder="手机" autocomplete="off" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th>密码</th>
                                    <td width="245">
                                        <input id="password" type="password" name="password" placeholder="请输入密码" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td width="205px">
                                        <input style="width:240px" id="repassword" type="text" name="phone_code" placeholder="手机验证码" autocomplete="off">
                                        <input style="width:50px;float:right;text-align:center;" id="but_but" style="width:50px" type="button" value="获取">
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td width="245"><input class="confirm" type="submit" value="注 册"></td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
<script type="text/javascript">
    $('#but_but').click(function(){
        var phone = $('#phone').val();
        $.get('reg/phone_code',{phone:phone},function(msg){
           if(msg.code==2){
                alert(msg.msg);
           }else{
                alert(msg.msg);
           }
        },'json')
    })
</script>

@endsection

