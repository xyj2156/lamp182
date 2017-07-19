$(function(){

	$('#GRmenu').click(function(){
		$('#GRleftNAV').slideToggle();
	});

	$('#GRleftNAV').children().mouseover(function(){
		$(this).css('background','#ED3931');
	}).mouseout(function(){
		$(this).css('background','');
	});

	$('#GRleftNAV').children().click(function(){
		$('#GRleftNAV').css('display','none');
	});
});

	//发送Ajax
	var local = 'basic';
	var requestURL = ''; 

	//Ajax POST
	$('#GRleftNAV').children().click(function(){
		//判断请求什么数据
		var request = $(this).attr('id');
		//根据请求的数据设置路由
		if(request == 'basic' ){
			//判断当前此路由,是就不发送Ajax
			if(local == 'basic') return;
			requestURL = '/personage/basic';
		}else if(request == 'secure'){
			//判断当前此路由,是就不发送Ajax
			if(local == 'secure') return;
			requestURL = '/personage/secure';
		}else if(request == 'money'){
			//判断当前此路由,是就不发送Ajax
			if(local == 'money') return;
			requestURL = '/personage/money';
		}else if(request == 'film'){
			//判断当前此路由,是就不发送Ajax
			if(local == 'film') return;
			requestURL = '/personage/film';
		}else if(request == 'consume'){
			//判断当前此路由,是就不发送Ajax
			if(local == 'consume') return;
			requestURL = '/personage/consume';
		}else if(request == 'collect'){
			//判断当前此路由,是就不发送Ajax
			if(local == 'collect') return;
			requestURL = '/personage/collect';
		}else{
			//判断当前此路由,是就不发送Ajax
			if(local == 'review') return; 
			requestURL = '/personage/review'; 
		}
		//获取token
		var token = $('#GRTOKEN').val();
		//发送Ajax
		$.ajax({
					"url":requestURL,
					"type":"POST",
					"data":{"basic":"basic","_token":token },
					"datatype":"json",
					"async":true,
					"success":function(data){
							$('#GRcontent').html(data.str);
							local = request;
						},
					"error":function(){
							layer.msg('请求失败');
					}
		});
	});

$("#GRsave").click(function(){
			var name = $("#GRINPUTname").val();
			var age = $("#GRINPUTage").val();
			var sex = $("input:checked").val();
			//获取token
			var token = $('#GRTOKEN').val();
			$.ajax({
				"url":"/personage/save",
				"type":"post",
				"data":{"_token":token,"name":name,"age":age,"sex":sex},
				"datatype":"json",
				"async":true,
				"success":function(data){
					var str = "";
					if(data.status == 500){
						str += "保存失败.";
					}else{
						str += "保存成功.";
					}
					str = str+=data.response;
					layer.msg(str);
				},
				"error":function(){
					layer.msg("网络出错");
				}
		});
});

	
	