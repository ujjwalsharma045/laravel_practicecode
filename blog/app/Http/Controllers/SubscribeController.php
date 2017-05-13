<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Jobs\SendSubscriptionEmail;
use App\Events\Useradded;
use App\User;
use App\UserProfile;
use Session;
use Mail;
use Event;
use Input;
class SubscribeController extends BaseController
{
	
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
	
    function admin_index(Request $request){
		
		$users = User::lists('email' , 'email');		
		
		if($_POST){ 
		   $this->validate($request, [
             'username' => 'required',
             'content' => 'required',			 
           ]);		   
		               		
		   $mailrequest = [
			'email'=>$request['username'],
			'content' => $request['content'],
		   ];
		   
		   $this->dispatch(new SendSubscriptionEmail($mailrequest));
		  
		   Session::flash('flashmessage' , 'Subscribed successfully');
			  
		   return redirect('admin/user/index');
		}
				
        return view('admin.subscribe.index')->withUsers($users);		
	}    
}
