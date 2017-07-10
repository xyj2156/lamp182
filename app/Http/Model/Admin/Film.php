<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
	//关联的表
    protected $table = 'films';
    //主键
    protected $primaryKey = 'id';
    //黑名单
    protected $guarded = [];

    //是否自动维护 create_at 和 update_at
    public $timestamps = false;

    //关联外表
    public function detail()
    {
    	return $this -> hasOne('App\Http\Model\Admin\FilmDetail','id','id');
    }
}
