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
                    <p><br></p>
                    
                </div>
            </div>
            <div class="col span_2_of_3">
                <ul id="reg_choose">
                    </li><li class="active">忘记密码</li><li>
                </ul>
                <div id="reg_all" style="transform: rotateY(180deg);">
                    

                    <!-- 手机注册 -->
                    <div class="tab-con" id="reg_phone" style="padding-top: 0">
                        <form id="form-login" method="post" action="{{url('/doforget')}}">
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
                                    <th>手机验证码</th>
                                    <td width="205px">
                                        <input id="repassword" type="text" name="phone_code" placeholder="手机验证码" autocomplete="off">
                                    </td>
                                    <td width="40px">
                                        <!-- <button id="but_but">获取</button> -->
                                        <input id="but_but" style="width:50px" type="button" value="获取">
                                    </td>
                                </tr>
                               
                                <tr>
                                    <th></th>
                                    <td width="245"><input class="confirm" type="submit" value="提交"></td>
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
        $.get('forget/phone_code',{phone:phone},function(msg){
           if(msg.code==2){
                alert(msg.msg);
           }else{
                alert(msg.msg);
           }
        },'json')
    })
</script>

@endsection

