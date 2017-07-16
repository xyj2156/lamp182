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
                            <input type="hidden" name="logo" id="uface" value="{{$data -> logo}}">
                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">网站logo <span class="tpl-form-line-small-title">LOGO</span></label>
                                <div class="am-u-sm-9">
                                    <div class="am-form-group am-form-file">
                                        <div class="tpl-form-file-img">
                                            <img src="{{asset($data -> logo)}}" alt="" id="pic" style="max-height:200px;">
                                        </div>
                                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 添加图片</button>
                                        <input id="doc-form-file" type="file" name="myfile" multiple="">
                                    </div>
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
                                <label for="copyright" class="am-u-sm-3 am-form-label">版权信息 <span class="tpl-form-line-small-title">CopyRight</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="copyright" name="copyright" value="{{$data -> copyright}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="icp" class="am-u-sm-3 am-form-label">备案信息 <span class="tpl-form-line-small-title">ICP</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="icp" name="icp" value="{{$data -> icp}}">
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
            if (strExtension != 'jpg' && strExtension != 'gif'
                && strExtension != 'png' && strExtension != 'bmp') {
                layer.msg("请选择图片文件");
                return;
            }

            var formData = new FormData(document.forms[0]);

            $.ajax({
                type: "POST",
                url: "{{url('admin/upload')}}?path=logo_path",
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