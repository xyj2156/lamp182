<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $promaryKey = 'id';

    protected $fillable = [

    	'username',
    	'password',
    	'phone',
    	'email'

    ];
    public $timestamps = false;


}
