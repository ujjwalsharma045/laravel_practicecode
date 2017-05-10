<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\User;
use App\UserProfile;
use Session;
use Mail;
use Auth;
class AdminController extends BaseController
{	
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
	
	function login(Request $request){
		if(Auth::check() && Auth::user()->isAdmin()){
		   return redirect('admin/user/index');
		}
		
		if(isset($request['username']) && isset($request['password'])){
			if(Auth::attempt(['username' => $request['username'], 'password' => $request['password'] , 'admin'=>'1'])){
				// Authentication passed...
				return redirect()->intended('admin/user/index');
			}		
		}
		return view('admin.auth.login');
	}
	
	function logout(){
		 Auth::logout();
		 return redirect('admin/login');
	}
}
