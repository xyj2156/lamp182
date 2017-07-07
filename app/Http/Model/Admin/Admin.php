<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $promaryKey = 'id';

    protected $guarded = [];

    public $timestamps = false;


}
