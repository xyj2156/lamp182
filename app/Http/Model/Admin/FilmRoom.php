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
<<<<<<< HEAD

    //是否自动维护 create_at 和 update_at
    public $timestamps = false;
=======
>>>>>>> 74f185799de8b728625677a7afa52306ddc82b72
}
