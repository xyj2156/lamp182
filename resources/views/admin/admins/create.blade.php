@extends('admin.layout.index')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><a href="{{url('admin/admins')}}">管理员管理 </a> > 添加管理员</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/admins')}}">
                            {{csrf_field()}}
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">管理员 <span class="tpl-form-line-small-title">UserName</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name" name="username" placeholder="请输入管理员名" value="{{old('username')}}">
                                    <small>不能以数字开头，字数6-18位的数组字母下划线。</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="password" class="am-u-sm-3 am-form-label">密码 <span class="tpl-form-line-small-title">PassWord</span></label>
                                <div class="am-u-sm-9">
                                    <input type="password" class="tpl-form-input" id="password" name="password" placeholder="请输入密码" value="{{old('password')}}">
                                    <small>字数6-18位。</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">手机 <span class="tpl-form-line-small-title">Phone</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="phone" name="phone" placeholder="请输入手机号码" value="{{old('phone')}}">
                                    <small>请输入11位手机号码。</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="email" class="am-u-sm-3 am-form-label">邮箱 <span class="tpl-form-line-small-title">E-mail</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="email" name="email" placeholder="请输入电子邮箱" value="{{old('email')}}">
                                    <small></small>
                                </div>
                            </div>
                            <input type="hidden" name="uface" value="" id="uface">
                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">头像 <span class="tpl-form-line-small-title">Uface</span></label>
                                <div class="am-u-sm-9">
                                    <div class="am-form-group am-form-file">
                                        <div class="tpl-form-file-img">
                                            <img src="{{old('uface')}}" alt="" id="pic" style="max-height:200px;">
                                        </div>
                                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 添加头像</button>
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
                url: "{{url('admin/upload')}}?path=admin_face_path",
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