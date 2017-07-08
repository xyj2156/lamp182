@extends('admin.layout.index')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><a href="{{url('admin/config')}}">网站管理 </a> > 网站配置</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/config')}}">
                            {{csrf_field()}}
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">网站标题 <span class="tpl-form-line-small-title">WebName</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name" name="title" placeholder="请输入网站标题" value="{{ $data -> title}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="age" class="am-u-sm-3 am-form-label">网站logo <span class="tpl-form-line-small-title">Logo</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="age" name="age" placeholder="请输入年龄" value="{{$data -> logo}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">关键字 <span class="tpl-form-line-small-title">KeyWords</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="phone" name="keywords" placeholder="请输入关键字，用英文逗号隔开。" value="{{$data -> keywords}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="email" class="am-u-sm-3 am-form-label">邮箱 <span class="tpl-form-line-small-title">E-mail</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="email" name="email" placeholder="请输入电子邮箱" value="{{$data -> email}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">网站描述 <span class="tpl-form-line-small-title">Description</span></label>
                                <div class="am-u-sm-9">
                                    <textarea class="" rows="10" id="user-intro" name="description" placeholder="请输入描述内容">{{$data -> description}}</textarea>
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