<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
//    关联的表
    protected $table = 'banners';
//    主键字段
    protected $primaryKey = 'id';
//    黑名单
    protected $guarded = [];
}
