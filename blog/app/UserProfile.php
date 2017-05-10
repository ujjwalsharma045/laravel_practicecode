<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserProfile extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'user_profiles'; 
    protected $fillable = [
        'first_name', 'contact' , 'last_name' , 'address', 'user_id'
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
