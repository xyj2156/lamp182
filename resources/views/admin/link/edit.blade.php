@extends('admin.layout.index')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><a href="">友情链接 </a> > 修改链接</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/link')}}/{{$data -> id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="put">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">链接名 <span class="tpl-form-line-small-title">LinkName</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="linkname" name="linkname" value="{{ $data -> linkname}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="age" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Title</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="linktitle" name="linktitle" placeholder="请输入链接标题" value="{{ $data -> linktitle}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">地址 <span class="tpl-form-line-small-title">Url</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="linkurl" name="linkurl" placeholder="请输入链接地址" value="{{ $data -> linkurl}}">
                                </div>
                            </div>
                            <input type="hidden" name="linkthumb" value="" id="uface">
                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">缩略图 <span class="tpl-form-line-small-title">Thumbnail</span></label>
                                <div class="am-u-sm-9">
                                    <div class="am-form-group am-form-file">
                                        <div class="tpl-form-file-img">
                                            <img src="{{ $data -> linkthumb}}" alt="" id="pic" style="max-height:200px;">
                                        </div>
                                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 请修改缩略图</button>
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
                url: "{{url('admin/upload')}}?path=admin_thumb_path",
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