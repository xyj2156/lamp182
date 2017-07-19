<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Consume extends Model
{
    //    关联的表
    protected $table = 'consume';
	//    主键字段
    protected $primaryKey = 'id';
	//    黑名单
    protected $guarded = [];
	//    是否自动维护 create_at 和 update_at
    public $timestamps = false;
}
