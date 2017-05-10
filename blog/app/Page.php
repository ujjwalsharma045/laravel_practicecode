<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Page extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'pages'; 
    protected $fillable = [
        'title', 'content',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
	 
    protected $hidden = [
        'password', 'remember_token',
    ];

}
