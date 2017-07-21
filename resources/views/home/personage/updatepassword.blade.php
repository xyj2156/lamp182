@extends('home.layout.index')
@section('style')
	<link href="{{url('home/css/k.css')}}" type="text/css" rel="stylesheet">
@endsection
@section('content')
<!-- start Content Middle -->
@if(session('success') || session('error'))
        <script>
            $(function (){
                layer.msg('{{session('success')?session('success'):session('error')}}',{icon:'{{session('success')?6:5}}'});
            });
        </script>
@endif
<div class="OrderList">
	<div class="content_top">
		<div class="back-links" style="width:300px">
			<p class="">
				<a href="{{url('/')}}">首页</a> &gt;&gt;&gt;&gt; <a>{{$title}}</a>
			</p>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="section group">
		<div class="password" style="width:600px;height:300px;border:1px solid yellow;margin: 0 auto;margin-top:20px;background-image:linear-gradient(67deg,#fff,#f1f1f1,#fff,#F1F1F1,#fff);">
			<form action="{{url('updateValidate')}}" method="post" onsubmit="return sub()" class="updateFORM">
			{{csrf_field()}}
			<div class="updateONE">
				旧密码: <input type="text" name="opassword" id="opassword"><span id="SPANerror" style="color:red"></span><span style="color:greenyellow" id="SPANsuccess"></span><br>
			</div>

			<div class="updateONE">
				新密码: <input type="text" name="npassword" id="npassword"> <br>
			</div>

			<div class="updateONE">	
				<input type="button" value="手机发送验证码" id="buttonAjax">
				<input type="text" name="phoneCODE" id="validate" class="VALIDATEone"><br>
			</div>

			<div class="">
				<input type="submit" value="提交">
			</div>
			</form>
		</div>
	</div>
	<script>
	
			var okone = false;
			var oktwo = false;
			var okthree = false;
			var okfour = false;
			$('#opassword').blur(function(){
				var password = $(this).val();
				$.ajax({
					"url":"{{url('ajaxPWD')}}",
					"type":"POST",
					"data":{"password":password,"_token":"{{csrf_token()}}"},
					"datatype":"json",
					"async":true,
					"success":function(data){
						str = "";
						if(data.status==500){
							$('#SPANsuccess').text('');
							$('#SPANerror').text(data.response);
							okone = false;
						}else{
							$('#SPANerror').text('');
							$('#SPANsuccess').text(data.response);
							okone = true;
						}
					},
					"error":function(){
						layer.msg('网络错误');
					}
				});
			});
			
			$('#buttonAjax').click(function(){

				$.ajax({
					"url":"{{url('phoneAjax')}}",
					"type":"GET",
					"data":{"_token":"{{csrf_token()}}"},
					"datatype":"json",
					"async":true,
					"success":function(data){
						layer.msg(data.response);
						okthree = true;
					},
					"error":function(){
						layer.msg('网络错误');
						okthree = false;
					}
				});
			});
		function sub(){
			var validate = $('#validate').val();
				if( validate.length<4 || validate.length>4 ){
					layer.msg('验证码错误');
					okfour = false;
				}else{
					okfour = true;
				}

				var npassword = $('#npassword').val()
				if(!npassword){
					layer.msg('请输入新密码');
					oktwo = false;
				}else if( npassword.length<6 ){
					layer.msg('新密码长度过短');
					oktwo = false;
				}else{
					oktwo = true;
				}

			if( okone && oktwo && okthree && okfour){
				return true;
			}else{
				return false;
			}
		}
	</script>
<!-- end Content Middle -->
@endsection