@extends('admin.layout.index')
@section('style')
<link href="{{asset('/admin/assets/css/k.css')}}" type="text/css" rel="stylesheet" />
@endsection
@section('content')
	<div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><a href="{{url('admin/user')}}">电影管理 </a> > 修改电影</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('/admin/film/update')}}?id={{$data->id}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">电影名称 <span class="tpl-form-line-small-title">FilmName</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name" name="name" placeholder="请输入电影名" value="{{$data->name}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="age" class="am-u-sm-3 am-form-label">票价 <span class="tpl-form-line-small-title">Price</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="age" name="price" placeholder="请输入售价" value="{{$data->price}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">类型 <span class="tpl-form-line-small-title">Type</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="phone" name="_type" placeholder="请输入电影类型" value="{{$data->_type}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="email" class="am-u-sm-3 am-form-label">地区 <span class="tpl-form-line-small-title">Rigion</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="email" name="area_type" placeholder="请输入所属地区" value="{{$data->area_type}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">年份 <span class="tpl-form-line-small-title">Year</span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="" style="display: none;" name="year">
                                        <option value="">--选择年份--</option>
                                        @for($i=$year;$i>=1960;$i--)
                                        	<option value="{{$i}}" @if($i == $data->year) selected @endif>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="password" class="am-u-sm-3 am-form-label">电影缩略图 <span class="tpl-form-line-small-title">filmImage</span></label>
                                <div class="am-u-sm-9">
                                    <a href="javascript:;" class="a-upload">
                                        <input type="file" name="film_pic" id="file0">点击这里上传电影封面
                                    </a>
                                </div>
                                <img src="" style="width:300px;height:300px;border:1px solid #000;margin-left:300px;" id="img0" />
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
@section('script')
<script src="{{asset('admin/assets/js/k.js')}}"></script>
@endsection