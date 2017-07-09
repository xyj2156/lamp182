<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class FilmDetail extends Model
{
	//关联表
    protected $table = "film_details";
    //主键
    protected $primaryKey = "id";
    //黑名单
    protected $guarded = [];
    //是否自动维护 create_at 和 update_at
    public $timestamps = false;
}
