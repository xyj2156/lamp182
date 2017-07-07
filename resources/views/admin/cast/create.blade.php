@extends('admin.layout.index')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><a href="{{url('admin/cast')}}">演员管理 </a> > 添加演员</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/cast')}}">
                            {{csrf_field()}}
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">演员名 <span class="tpl-form-line-small-title">Cast</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name" name="name" placeholder="请输入演员名" value="{{old('name')}}">
                                    <small>不能以数字开头，字数6-18位的数组字母下划线。</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">演员简介 <span class="tpl-form-line-small-title">Description</span></label>
                                <div class="am-u-sm-9">
                                    <textarea class="" rows="10" id="user-intro" name="description" placeholder="请输入文章内容">{{old('description')}}</textarea>
                                    <small style="display: block;clear: both">还可以输入<span id="str_num" style="font-size: 20px;font-style: italic"> 255 </span>字</small>
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

@section('script')
    <script>
        (function () {
            var num = $('#str_num');
            $('#user-intro').on('keyup',function(){
                var num = 255 - parseInt(this.value.length);
                num.html(' ' + num + ' ');
            });
        }());
    </script>
@endsection