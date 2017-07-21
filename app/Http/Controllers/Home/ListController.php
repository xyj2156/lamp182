<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Orders;
use App\Http\Model\Admin\FilmRoom;
use App\Http\Model\Admin\FilmPlay;
use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\Review;
use App\Http\Model\Admin\FilmDetail;
use App\Http\Model\Admin\Film_type;

class ListController extends Controller
{
    public function Orderlist(Request $request)
    {
        //搜索单号条件
        $orderSearch = $request -> input('orderSearch','');

        $member = session('home_user');

        //找到对应的订单
        $order = Orders::where('mid',$member['id'])->where('name','like',"%{$orderSearch}%")->orderBy('ctime','desc')->paginate(5);

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

        return view('home.personage.orderlist',['title'=>$member->username.'消费记录','data'=>$order,'search'=>$request->all()]);
    }


    //显示用户评论列表
    public function Reviewlist()
    {   
        //获得当前用户信息
        $member = session('home_user');
        $mid = $member['id'];

        //取出用户评论
        $review = Review::where('mid',$mid)->orderBy('time','desc')->get();
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
                    $film[$k]->actor =  $vv -> actor;
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
        $fid = [];
        return view('home.personage.reviewlist',['title'=>$member->username.'评论','data'=>$review,'fid'=>$fid,'str0'=>$str0]);
    }
}
