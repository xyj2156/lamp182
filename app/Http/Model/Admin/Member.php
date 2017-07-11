<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
//    关联的表
    protected $table = 'members';
//    主键字段
    protected $primaryKey = 'id';
//    黑名单
    protected $guarded = [];
//    是否自动维护 create_at 和 update_at
    public $timestamps = false;


    public function detail()
    {
        return $this -> hasOne('\App\Http\Model\Admin\Member_detail','id','id');
    }

}
