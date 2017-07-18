<?php
/**
 * Created by PhpStorm.
 * User: JiefKing
 * Date: 2017/7/17
 * Time: 23:32
 */

namespace App\Http\Model\Admin;


use Illuminate\Database\Eloquent\Model;

class Consume extends Model
{
    protected $table = 'consumes';
    protected $promaryKey = 'id';

    protected $guarded = [];

    public $timestamps = false;
}