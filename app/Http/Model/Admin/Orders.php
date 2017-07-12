<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //订单模型
    //关联表
    protected $table='orders';
    //主键字段
    protected $primaryKey = 'id';
    //黑名单
    protected $guarded = [];
    //是否自动维护 create_at 和 update_at
    public $timestamps = false;

    public function member()
    {
        return $this->hasMany(\App\Http\Model\Admin\Member::class,'id', 'mid');
    }
}
