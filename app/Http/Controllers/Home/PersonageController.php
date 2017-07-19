<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Member;
use App\Http\Model\Admin\Member_detail;
use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\Consume;
use App\Http\Model\Admin\Review;
use App\Http\Model\Admin\FilmDetail;
use App\Http\Model\Admin\Film_type;
use App\Http\Model\Admin\Cast;
use App\Http\Model\Admin\Orders;
use App\Http\Model\Admin\FilmRoom;
use App\Http\Model\Admin\FilmPlay;

class PersonageController extends Controller
{
	//显示基本设置页面
    public function getIndex(Request $request)
    {
    	$data = Member_detail::find(session('home_user') -> id);
    	$data['username'] = session('home_user') -> username;

    	//给予会员等级
    	if( $data['auth'] == 0 ){
    		$data['auth'] = '普通会员';
    	}else if( $data['auth'] == 1 ){
    		$data['auth'] = 'VIP会员';
    	}else{
    		$data['auth'] = '钻石会员';
    	}

    	//非Ajax显示到页面 
    	if(!$request->ajax())
    	    return view('home.personage.personage',['data'=>$data, 'title' => $data['name'].'的个人中心']);

    	$w = $data['sex'] == 'w' ? 'checked':'';
    	$m = $data['sex'] == 'm' ? 'checked':'';
    	$x = $data['sex'] == 'x' ? 'checked':'';

    	$str = '<div class="GRpersonage1">
			<img src="'.$data['uface'].'" class="GRIMG">
		<form class="GRform1" method="post">
			<input type="hidden" name="_token"  value="'. csrf_token().'" id="GRTOKEN"/>
			<div>
				<span>用户名: '.$data['username'].'</span>        <br>
			</div>

			<div>
				呢称: <input type="text" name="name" value="'.$data['name'].'" id="GRINPUTname">  <br>
			</div>

			<div>	
				年龄: <input type="text" name="age" value="'.$data['age'].'" id="GRINPUTage">  <br>
			</div>

			<div id="GRINPUTsex">
				性别: 女: <input type="radio" name="sex"  value="w" '.$w. '  />
				 	  男: <input type="radio" name="sex" value="m"   '.$m. ' />
				  	  保密: <input type="radio" name="sex" value="x"   '.$x. ' /><br>
			</div>

			<span style="margin-top:15px">会员等级: '.$data['auth'].'</span>

			<div>
				<input type="button" value="保存" id="GRsave">  <br>
			</div>

			<div>
				<a href="javascript:;" class="a-upload">
					<input type="file" name="" id="">上传头像
				</a>
			</div>
		</form>
		</div>
		<script>
			$("#GRsave").click(function(){
				var name = $("#GRINPUTname").val();
				var age = $("#GRINPUTage").val();
				var sex = $("input:checked").val();
				
				$.ajax({
					"url":"'.url("personage/save").'",
					"type":"post",
					"data":{"_token":"'.csrf_token().'","name":name,"age":age,"sex":sex},
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
		</script>
		';

		$arr = ['str'=>$str];

		return $arr;
    	
    }

    //显示安全设置页面
    public function postSecure()
    {
    	$member = session('home_user');

    	$str = '<div class="GRsecure">
			<div>
				<span class="GRsecuretext">用户名: '.$member['username'].'</span>   
			</div>
			<div>
				<span class="GRsecuretext">密　码: ****************</span> <a class="GRlinkONE" href="">修改密码</a>
			</div>
			<div>
				<span class="GRsecuretext">手　机: '.$member['phone'].'</span> <a class="GRlinkONE" href="">更换手机号</a>
			</div>
			<div>
				<span class="GRsecuretext">邮　箱: '.$member['email'].'</span> <a class="GRlinkONE" href="">更换邮箱</a>
			</div>

			<input type="hidden" name="_token"  value="'. csrf_token() .'" id="GRTOKEN"/>
		</div>';

		$arr = ['str'=>$str];

		return $arr;
    }

    //显示余额页面
    public function postMoney()
    {
    	$member = session('home_user');
    	$mid = $member['id'];
    	$money = Member::find($mid)->detail['money'];
    	$str='<div class="GRmoney">
			余额:  '.$money.'  <br>
			<a class="GRlinkONE" href="">充值</a>
		</div>

		<input type="hidden" name="_token"  value="'. csrf_token() .'" id="GRTOKEN"/>';

		$arr = ['str'=>$str];
		return $arr;
    }

    //显示我评论过的电影页面
    public function postReview(Request $request)
    {
    	//取出用户信息
    	$member = session('home_user');
    	$mid = $member['id'];

    	//取出用户评论
    	$review = Review::where('mid',$mid)->orderBy('time','desc')->paginate(10);
    	$fids = [];
    	foreach($review as $k => $v)
    	{
    		$fids[] = $v -> fid;
    	}
    	$fids = array_unique($fids);

    	//取出评论过电影
    	$film = Film::whereIn('id',$fids)->get();
    	$did = [];
    	foreach($film as $k => $v){
    		$did[] = $v -> id;
    	}
    	//取出详情电影表
    	$film_detail = FilmDetail::whereIn('id',$did)->get();

    	//为电影匹配对应类型
    	$types = [];
    	foreach($film as $k=>$v){
    		$types[] = $v -> _type;
    		$types[] = $v -> area_type;
    		$types[] = $v -> year; 
    	}
    	$types = array_unique($types);
    	$type = Film_type::select('id','name')->whereIn('id',$types)->get();
    	foreach($film as $k => $v){
    		foreach($type as $kk => $vv){
    			if($v->_type == $vv->id ){
    				$film[$k]->_type = $vv -> name; 
    			}else if($v -> area_type == $vv->id){
    				$film[$k]-> area_type = $vv -> name;
    			}else if($v -> year == $vv ->id){
    				$film[$k]-> year = $vv -> name;
    			}
    		}
    	}
    	//将电影表与详情表整合
    	foreach($film as $k => $v){
    		foreach($film_detail as $kk => $vv){
    			if($v -> id ==  $vv -> id){
    				$film[$k]->director = $vv -> director;
    				$film[$k]->actor =	$vv -> actor;
    				$film[$k]->time =  $vv -> time;
    			}
    		}
    	}

    	//将电影表与评论整合
    	foreach($film as $k => $v){
    		foreach($review as $kk => $vv){
    			if( $v->id == $vv->fid ){
    				$review[$kk] -> director = $v-> director;
    				$review[$kk] -> name = $v-> name;
    				$review[$kk] -> film_pic = $v-> film_pic;
    				$review[$kk] -> price = $v-> price;
    				$review[$kk] -> _type = $v-> _type;
    				$review[$kk] -> area_type = $v -> area_type;
    				$review[$kk] -> year = $v -> year;
    				$review[$kk] -> actor = $v -> actor;
    				$review[$kk] -> ftime = $v -> time;
    			}
    		}
    	}

    	$fid = [];
    	$str0 = [];
    	foreach($review as $k => $v){
    		if( !in_array($v->fid,$fid) ){
    			$fid[] = $v->fid;
    			$str0[$v->fid] = '<div>我的评论('.date('Y-m-d H:i:s',($v->time)).')：'.$v->content.'</div>';
    		}else{
    			$str0[$v->fid] .= '<div>我的评论('.date('Y-m-d H:i:s',($v->time)).')：'.$v->content.'</div>';
    		}
    	}


    	//显示到页面
    	$str1 = '<div class="GRfilm">';
    	$fid = [];
		$str2 = '';
		foreach($review as $k => $v){
			if( !in_array($v->fid,$fid) ){
				$fid[] = $v->fid;
			}else{ break; }
			$str2 .=	'<div>
							<img class="filmTOP" src="'.$v->film_pic.'">
					 	</div>
					 	<div class="filmBOTTOM">
							<span>电影名称: '.$v->name.'</span> <span>导演: '.$v->director.' </span>  <span>演员: '.$v->actor.'</span><br>
							<span>票价: $'.$v->price.' </span> <span>片长: '.$v->ftime.'</span> <span>类型: '.$v->_type.' </span> <span>地区: '.$v->area_type.' </span>  <span>年份: '.$v->year.' </span><br>
							'.$str0[$v->fid].'
						</div>
						<div style="clear:both">';
		}

		$str3 = 	'<div style="clear:both"></div>
					<div class="GRpagin">
						<a href="javascript:;">点击查看更多评论过的电影</a>	
					</div>
				</div>
		<input type="hidden" name="_token"  value="'. csrf_token() .'" id="GRTOKEN"/>';

		$str = $str1.$str2.$str3;

		$arr = ['str'=>$str];

		return $arr;

    }
    //基础信息保存
    public function postSave(Request $request)
    {
    	$request = $request -> except('_token');

    	if( empty($request['name']) )  return $data = ['status'=>'500','response'=>'请填写昵称'];

    	if( empty($request['age']) )  return $data = ['status'=>'500','response'=>'请填写正确年龄'];

    	if( empty($request['sex']) )  return $data = ['status'=>'500','response'=>'请选择性别'];

    	if( ($request['sex'] != 'w') && ($request['sex'] != 'm') && ($request['sex'] != 'x') ) return  $data = ['status'=>'500','response'=>'请选择正确的性别'];
  
    	$id = session('home_user')['id'];

    	//进行修改
    	$res = Member_detail::where('id',$id)->update(['name'=>$request['name'],'sex'=>$request['sex'],'age'=>$request['age']]);

    	if(!$res) return $data = ['status'=>'500','response'=>'数据并未更改'];

		return $data = ['status'=>'200','response'=>''];
    	
    }

    //显示订单页面
    public function postConsume()
    {
    	$member = session('home_user');

    	//找到对应的订单
    	$order = Orders::where('mid',$member['id'])->orderBy('ctime','desc')->paginate(10);

    	//找到订单所在影厅
    	$rids = [];
    	foreach($order as $k => $v){
    		$rids[] = $v -> rid;
    	}
    	$rids = array_unique($rids);
    	$room = FilmRoom::select(['id','name'])->whereIn('id',$rids)->get();
    	foreach($order as $k => $v){
    		foreach($room as $kk => $vv){
    			if($v->rid == $vv->id){
    				$order[$k]->room = $vv -> name; 
    			}
    		}
    	}

    	//找到开播时间
    	$pids = [];
    	foreach($order as $k => $v){
    		$pids[] = $v -> pid;
    	}
    	$pids = array_unique($pids);
    	$play = FilmPlay::select(['id','start_time'])->whereIn('id',$pids)->get();
    	foreach($order as $k => $v){
    		foreach($play as $kk => $vv){
    			if($v->pid == $vv->id){
    				$order[$k]->start_time = $vv->start_time;
    			}
    		}
    	}

    	//找到影片名
    	$fids = [];
    	foreach($order as $k => $v){
    		$fids[] = $v->fid;
    	}
    	$film = Film::select(['id','name'])->whereIn('id',$fids)->get();
    	foreach($order as $k => $v){
    		foreach($film as $kk => $vv){
    			if( $v->fid == $vv->id ){
    				$order[$k]->fname = $vv->name;
    			}
    		}
    	}

    	//显示订单状态
    	foreach($order as $k => $v){
    		switch ($v->status){
    			case 1: $v->status='未付款';break;
    			case 2: $v->status='已付款';break;
    			case 3: $v->status='已发货';break;
    			case 4: $v->status='订单完成';break;
    			case 5: $v->status='订单废除';break;
    		}
    	}

    	//显示座位
    	foreach($order as $k => $v){
    		$order[$k]->seat = explode(',',$v->seat);
    		$str='';
    		for($i=0;$i<count($order[$k]->seat);$i++){
    			$str .= str_replace('_','行',$order[$k]->seat[$i]).'列,';
    		}
    		$order[$k]->seat = $str;
    	}

    $str0 = '<div class="GRorderCT">';
	$str1 = '';
    foreach($order as $k => $v){
    $str1 .= 	'
    			<div class="GRorder">
				<i>'.date('Y-m-d H:i:s',$v->ctime).'</i>   <br>
				<div class="GRordertop">
					<span>影厅: '.$v->room.'字号房 </span> <span>开播时间: '.date('H:i:s',$v->start_time).' </span> <span>影片: '.$v->fname.' </span> <span style="width:300px">座位: '.$v->seat.' </span> <span>单座票价: '.$v->price.' </span>  <br>
				</div>
				<div class="GRorderbottom">
					<span>座位数:'.$v->num.'</span>  <span> 总价: '.$v->price*$v->num.' </span>  <span>订单状态: '.$v->status.'</span>
					<b>单号: '.$v->name.'</b>
				</div>       
				</div><br>';
	}
			
	$str2 =	'<a href="#">查看更多消费记录</a><input type="hidden" name="_token"  value="'. csrf_token() .'" id="GRTOKEN"/>
			</div>';

		$str = $str0.$str1.$str2;	

		$arr = ['str'=>$str];

		return $arr;

    	
    }

    public function getTest()
    {	

    	$member = session('home_user');

    	//找到对应的订单
    	$order = Orders::where('mid',$member['id'])->orderBy('ctime','desc')->paginate(10);

    	//找到订单所在影厅
    	$rids = [];
    	foreach($order as $k => $v){
    		$rids[] = $v -> rid;
    	}
    	$rids = array_unique($rids);
    	$room = FilmRoom::select(['id','name'])->whereIn('id',$rids)->get();
    	foreach($order as $k => $v){
    		foreach($room as $kk => $vv){
    			if($v->rid == $vv->id){
    				$order[$k]->room = $vv -> name; 
    			}
    		}
    	}

    	//找到开播时间
    	$pids = [];
    	foreach($order as $k => $v){
    		$pids[] = $v -> pid;
    	}
    	$pids = array_unique($pids);
    	$play = FilmPlay::select(['id','start_time'])->whereIn('id',$pids)->get();
    	foreach($order as $k => $v){
    		foreach($play as $kk => $vv){
    			if($v->pid == $vv->id){
    				$order[$k]->start_time = $vv->start_time;
    			}
    		}
    	}

    	//找到影片名
    	$fids = [];
    	foreach($order as $k => $v){
    		$fids[] = $v->fid;
    	}
    	$film = Film::select(['id','name'])->whereIn('id',$fids)->get();
    	foreach($order as $k => $v){
    		foreach($film as $kk => $vv){
    			if( $v->fid == $vv->id ){
    				$order[$k]->fname = $vv->name;
    			}
    		}
    	}
    	die;
    	//显示订单状态
    	foreach($order as $k => $v){
    		switch ($v->status){
    			case 1: $v->status='未付款';break;
    			case 2: $v->status='已付款';break;
    			case 3: $v->status='已发货';break;
    			case 4: $v->status='订单完成';break;
    			case 5: $v->status='订单废除';break;
    		}
    	}

    	//显示座位
    	foreach($order as $k => $v){
    		$order[$k]->seat = explode(',',$v->seat);
    		$str='';
    		for($i=0;$i<count($order[$k]->seat);$i++){
    			$str .= str_replace('_','行',$order[$k]->seat[$i]).'列,';
    		}
    		$order[$k]->seat = $str;
    	}

    $str1 = '';
    foreach($order as $k => $v){
    $str1 .= '<div class="GRorder">
				<i>'.date('Y-m-d H:i:s',$v->ctime).'</i>   <br>
				<div class="GRordertop">
					<span>影厅: '.$v->room.' </span> <span>开播时间: '.date('H:i:s',$v->start_time).' </span> <span>影片: '.$v->fname.' </span> <spa n>座位: '.$v->seat.' </span> <span>票价: '.$v->price.' </span>  <br>
				</div>
				<div class="GRorderbottom">
					<span>座位数:'.$v->num.'</span>  <span> 总价: '.$v->price*$v->num.' </span>  <span>订单状态: '.$v->status.'</span>
					<b>单号: '.$v->name.'</b>
				</div>       
			</div><br><br>';
	}
			
	$str2 =	'<a href="#">查看更多消费</a>';

		$str = $str1.$str2;	

		return $str;

    }
}
