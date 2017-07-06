@extends('admin.layout.index')

@section('content')

    <div class="widget-body am-fr">
        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/pass')}}">
            {{csrf_field()}}
            <div class="am-form-group">
                <label for="password" class="am-u-sm-3 am-form-label">原密码 <span class="tpl-form-line-small-title"></span></label>
                <div class="am-u-sm-9">
                    <input style='width:50%' type="password" class="tpl-form-input"  name="password_o" placeholder="请输入原密码" >
                    <small></small>
                </div>
            </div>
            <div class="am-form-group">
                <label for="repassword" class="am-u-sm-3 am-form-label">新密码 <span class="tpl-form-line-small-title"></span></label>
                <div class="am-u-sm-9">
                    <input style='width:50%' type="password" class="tpl-form-input"  name="password" placeholder="请输入新密码" >
                    <small></small>
                </div>
            </div>
            <div class="am-form-group">
                <label for="repassword" class="am-u-sm-3 am-form-label">确认密码 <span class="tpl-form-line-small-title"></span></label>
                <div class="am-u-sm-9">
                    <input style='width:50%' type="password" class="tpl-form-input"  name="password_c" placeholder="请再次输入密码" >
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

@endsection