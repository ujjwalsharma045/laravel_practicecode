<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	//protected $table = 'users'; 
    protected $fillable = [
        'username', 'email', 'password', 'profile_pic'
    ];
	

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
	 
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function user_profiles(){
		return $this->hasMany('App\UserProfile' , 'user_id' , 'id');
	}
	
	public function isAdmin(){
      return $this->admin; // this looks for an admin column in your users table
    }
}
