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
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/user')}}/{{$data1 -> id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="put">
                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">会员权限 <span class="tpl-form-line-small-title">Auth</span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 1}" style="display: none;" name="auth">
                                        @foreach(config('film.auth') as $k => $v)
                                            <option value="{{$k}}" {{$k == $data2['auth'] ? 'selected':''}}>{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">用户名 <span class="tpl-form-line-small-title">UserName</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name" name="username" placeholder="请输入用户名" value="{{ $data1 -> username}}">
                                    <small>@if(isset($errors -> all() ['username'])){{$errors -> all() ['username']}} @else字数6-18位。 @endif</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="age" class="am-u-sm-3 am-form-label">年龄 <span class="tpl-form-line-small-title">Age</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="age" name="age" placeholder="请输入年龄" value="{{$data2 -> age}}">
                                    <small>@if(isset($errors -> all() ['age'])){{$errors -> all() ['age']}}  @endif</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">性别 <span class="tpl-form-line-small-title">Sex</span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 1}" style="display: none;" name="sex">
                                        @foreach(config('film.sex') as $k => $v)
                                            <option value="{{$k}}" {{$k == $data2 -> sex ? 'selected' : ''}}>{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">手机 <span class="tpl-form-line-small-title">Phone</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="phone" name="phone" placeholder="请输入手机号码" value="{{$data1 -> phone}}">
                                    <small>@if(isset($errors -> all() ['phone'])){{$errors -> all() ['phone']}} @else请输入11位手机号码。 @endif</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="email" class="am-u-sm-3 am-form-label">邮箱 <span class="tpl-form-line-small-title">E-mail</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="email" name="email" placeholder="请输入电子邮箱" value="{{$data1 -> email}}">
                                    <small>@if(isset($errors -> all() ['email'])){{$errors -> all() ['email']}}  @endif</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">修改</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection