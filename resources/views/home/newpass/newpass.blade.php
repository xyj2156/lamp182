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
                    </li><li class="active">设置新密码</li><li>
                </ul>
                <div id="reg_all" style="transform: rotateY(180deg);">
                    

                    <!-- 手机注册 -->
                    <div class="tab-con" id="reg_phone" style="padding-top: 0">
                        <form id="form-login" method="post" action="{{url('/donewpass')}}">
                        {{csrf_field()}}
                            <div id="login-error" class="error-tip"></div>
                            <table border="0" cellspacing="0" cellpadding="0" style="margin:0 auto">
                                <tbody>
                                <tr>
                                    <th>手机</th>
                                    <td width="245">
                                        <input id="phone" type="text" name="phone" placeholder="手机"  autocomplete="off" value="{{$phone}}">
                                    </td>
                                </tr>
                            
                                <tr>
                                    <th>新密码</th>
                                    <td width="205px">
                                        <input id="repassword" type="text" name="password" placeholder="" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <th>确认新密码</th>
                                    <td width="205px">
                                        <input id="repassword" type="text" name="repassword" placeholder="" autocomplete="off">
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


@endsection

