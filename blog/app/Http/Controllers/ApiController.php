<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\User;
use App\UserProfile;
use Auth;
class ApiController extends BaseController
{    		   
	function index(){
		$user = User::where('id',Auth::guard('api')->id())->get();
		if(!empty($user)){
		    return response(array(
                'error' => false,
                'user' =>$user,
               ), 200);
		}
		else {
			return response(array(
                'error' => '404 Not Found',
                ), 200); 
		}		
	}    
}
