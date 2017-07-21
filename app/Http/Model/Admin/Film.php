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

    //关联详情表外表
    public function detail()
    {
    	return $this -> hasOne('App\Http\Model\Admin\FilmDetail','id','id');
    }

    /*
     * 关联 演员表
     */
    public function cast()
    {
        return $this -> belongsToMany('\App\Http\Model\Admin\Cast', 'film_casts','fid','cid');
    }

    /**
     *  一对多关联影厅表
     */
    public function room()
    {
        return $this -> belongsTo('\App\Http\Model\Admin\Filmroom','id','id');
    }
}
