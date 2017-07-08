@extends('admin.layout.index')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">轮播图 > 添加</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/config/banner')}}">
                            {{csrf_field()}}
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Title</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name" name="title" value="{{old('title')}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">链接地址 <span class="tpl-form-line-small-title">URL</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="phone" name="url" value="{{old('url') ? old('url') : 'http://'}}">
                                </div>
                            </div>
                            <input type="hidden" class="tpl-form-input" id="uface" name="pic"  value="{{old('pic')}}" >
                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">缩略图 <span class="tpl-form-line-small-title">Thumb</span></label>
                                <div class="am-u-sm-9">
                                    <div class="am-form-group am-form-file">
                                        <div class="tpl-form-file-img">
                                            <img src="{{old('pic')}}" alt="" id="pic" style="max-height:200px;">
                                        </div>
                                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 添加图片</button>
                                        <input id="doc-form-file" type="file" name="myfile" multiple="">
                                    </div>

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
        $(function () {
            $("#doc-form-file").change(function () {
                uploadImage();
            });
        });

        function uploadImage() {
            // 判断是否有选择上传文件
            var imgPath = $("#doc-form-file").val();
            if (imgPath == "") {
                alert("请选择上传图片！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'jpg' && strExtension != 'gif'
                && strExtension != 'png' && strExtension != 'bmp') {
                alert("请选择图片文件");
                return;
            }

            var formData = new FormData(document.forms[0]);

            $.ajax({
                type: "POST",
                url: "{{url('admin/upload')}}",
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
                    alert("上传失败，请检查网络后重试");
                }
            });
        }
    </script>
@endsection
