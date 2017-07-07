@extends('admin.layout.index')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><a href="{{url('admin/type')}}">分类管理 </a> > 编辑分类</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/type')}}/{{$data -> id}}">
                            {{csrf_field()}}
                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">选择分类 <span class="tpl-form-line-small-title">SelectType</span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 1}" style="display: none;" name="pid">
                                        @foreach(config('film.type') as $k => $v)
                                            <option value="{{$k}}" {{$data -> pid == $k ? 'selected' : ''}}>{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">分类名 <span class="tpl-form-line-small-title">TypeName</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="name" value="{{$data -> name}}" placeholder="请填写分类名">
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