<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class FilmRoom extends Model
{
    //关联的表
    protected $table = 'film_rooms';
    //主键
    protected $primaryKey = 'id';
    //黑名单
    protected $guarded = [];

}
