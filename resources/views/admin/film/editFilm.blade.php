@extends('admin.layout.index')

@section('content')
	<div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">

                        <div class="widget-title am-fl"><a href="{{url('admin/film')}}">电影管理 </a> > 修改电影</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('/admin/film/')}}/{{$data->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="put">

                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">电影名称 <span class="tpl-form-line-small-title">FilmName</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name" name="name" placeholder="请输入电影名" value="{{$data->name}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="director" class="am-u-sm-3 am-form-label">导演 <span class="tpl-form-line-small-title">Director</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="director" name="director" placeholder="请输入导演" value="{{$data2->director}}">
                                    <small></small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="actor" class="am-u-sm-3 am-form-label">演员 <span class="tpl-form-line-small-title">Price</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="actor" name="actor" placeholder="请输入演员" value="{{$data2->actor}}">
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

                                    <select data-am-selected="" name="_type" value="{{$_type[0] -> id}}">
                                        @foreach($_type as $v)
                                            <option value="{{$v -> id}}" {{$data -> _type == $v -> id?'selected':''}} >{{$v -> name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="email" class="am-u-sm-3 am-form-label">地区 <span class="tpl-form-line-small-title">Rigion</span></label>
                                <div class="am-u-sm-9">

                                    <select data-am-selected="" name="area_type" value="{{$area_type[0] -> id}}">
                                        @foreach($area_type as $v)
                                            <option value="{{$v -> id}}" {{$data -> area_type == $v -> id ? 'selected' : ''}}>{{$v -> name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">年份 <span class="tpl-form-line-small-title">Year</span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="" style="display: none;" name="year" value="{{$year[0] -> id}}">

                                        @foreach($year as $v)
                                            <option value="{{$v -> id}}" {{$data -> year == $v -> id ? 'selected' : ''}}>{{$v -> name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">

                                <label for="phone" class="am-u-sm-3 am-form-label">电影简介 <span class="tpl-form-line-small-title">detail</span></label>
                                <div class="am-u-sm-9">
                                    <textarea name="film_detail" rows="5">{{$data2 -> film_detail}}</textarea>
                                </div>
                            </div>
                            <input type="hidden" class="tpl-form-input" id="uface" name="film_pic"  value="{{$data -> film_pic}}" >
                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">电影缩略图 <span class="tpl-form-line-small-title">FilmImage</span></label>
                                <div class="am-u-sm-9">
                                    <div class="am-form-group am-form-file">
                                        <div class="tpl-form-file-img">
                                            <img src="{{asset($data -> film_pic)}}" alt="" id="pic" style="max-height:200px;">
                                        </div>
                                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 点击这里上传电影封面</button>
                                        <input id="doc-form-file" type="file" name="myfile" multiple="">
                                    </div>
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
@section('script')

<script>
    $(function () {
        $("#doc-form-file").change(function () {
            uploadImage();
        });
    });
    function uploadImage() {
        // 判断是否有选择上传文件
        var imgPath = $("#doc-form-file").val();
        if (imgPath == "") {
            layer.msg("请选择上传图片！");
            return;
        }
        //判断上传文件的后缀名
        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
        if (!/^png|jpg|gif$/i.test(strExtension)) {
            layer.msg("请选择图片文件");
            return;
        }

        var formData = new FormData(document.forms[0]);

        $.ajax({
            type: "POST",
            url: "{{url('admin/upload')}}?path=film_path",
            _method:'post',
            _token:'{{csrf_token()}}',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,

            success: function(data) {

//                                    console.log(data);
//                                    alert("上传成功");
                $('#pic').attr('src', data).hide(200).show(600);
                $('#uface').val(data);

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                layer.msg("上传失败，请检查网络后重试");
            }
        });
    }
</script>

@endsection