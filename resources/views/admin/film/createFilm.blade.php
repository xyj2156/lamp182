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
                        <div class="widget-title am-fl"><a href="{{url('admin/user')}}">电影管理 </a> > 添加电影</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('/admin/film/store')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">电影名称 <span class="tpl-form-line-small-title">FilmName</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name" name="name" placeholder="请输入电影名" value="{{old('name')}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="age" class="am-u-sm-3 am-form-label">票价 <span class="tpl-form-line-small-title">Price</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="age" name="price" placeholder="请输入售价" value="{{old('price')}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">导演 <span class="tpl-form-line-small-title">director</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="phone" name="director" placeholder="请输入电影类型" value="{{old('director')}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">演员 <span class="tpl-form-line-small-title">actor</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="phone" name="actor" placeholder="请输入电影类型" value="{{old('actor')}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">上映时间 <span class="tpl-form-line-small-title">uptime</span></label>
                                <div class="am-u-sm-9">
                                    <input type="date" class="tpl-form-input" id="phone" name="uptime" placeholder="请输入电影类型" value="{{old('uptime')}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">类型 <span class="tpl-form-line-small-title">Type</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="phone" name="_type" placeholder="请输入电影类型" value="{{old('_type')}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="email" class="am-u-sm-3 am-form-label">地区 <span class="tpl-form-line-small-title">Rigion</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="email" name="area_type" placeholder="请输入所属地区" value="{{old('area_type')}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">年份 <span class="tpl-form-line-small-title">Year</span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 1}" style="display: none;" name="year">
                                        <option value="">--选择年份--</option>
                                        @for($i=$year;$i>1970;$i--)
                                        	<option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">电影简介 <span class="tpl-form-line-small-title">detail</span></label>
                                <div class="am-u-sm-9">
                                    <textarea name="film_detail" rows="5" clos=""></textarea>
                                    <small></small>
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
                                <label for="password" class="am-u-sm-3 am-form-label">预告片 <span class="tpl-form-line-small-title">prevue</span></label>
                                <div class="am-u-sm-9">
                                    <a href="javascript:;" class="a-upload">
                                        <input type="file" name="prevue" id="videofile">点击这里上传预告片
                                    </a>
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
<script src="{{asset('admin/assets/js/k.js')}}"></script>
@endsection