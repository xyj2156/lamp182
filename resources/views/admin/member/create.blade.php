@extends('admin.layout.index')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><a href="{{url('admin/user')}}">用户管理 </a> > 添加用户</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/user')}}">
                            {{csrf_field()}}
                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">会员权限 <span class="tpl-form-line-small-title">Auth</span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 1}" style="display: none;" name="auth">
                                        <option value="0">普通会员</option>
                                        <option value="1">黄金会员</option>
                                        <option value="2">钻石会员</option>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">用户名 <span class="tpl-form-line-small-title">UserName</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name" name="username" placeholder="请输入用户名" value="{{old('username')}}">
                                    <small>不能以数字开头，字数6-18位的数组字母下划线。</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="password" class="am-u-sm-3 am-form-label">密码 <span class="tpl-form-line-small-title">PassWord</span></label>
                                <div class="am-u-sm-9">
                                    <input type="password" class="tpl-form-input" id="password" name="password" placeholder="请输入密码" value="{{old('password')}}">
                                    <small>字数6-18位。</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="age" class="am-u-sm-3 am-form-label">年龄 <span class="tpl-form-line-small-title">Age</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="age" name="age" placeholder="请输入年龄" value="{{old('age')}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">性别 <span class="tpl-form-line-small-title">Sex</span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 1}" style="display: none;" name="sex">
                                        <option value="m">男</option>
                                        <option value="w">女</option>
                                        <option value="x" selected>保密</option>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">手机 <span class="tpl-form-line-small-title">Phone</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="phone" name="phone" placeholder="请输入手机号码" value="{{old('phone')}}">
                                    <small>请输入11位手机号码。</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="email" class="am-u-sm-3 am-form-label">邮箱 <span class="tpl-form-line-small-title">E-mail</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="email" name="email" placeholder="请输入电子邮箱" value="{{old('email')}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection