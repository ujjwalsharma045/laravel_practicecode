<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Jobs\NewsletterEmail;
use App\Events\Useradded;
use App\User;
use App\UserProfile;
use Session;
use Mail;
use Event;
use Input;
class UserController extends BaseController
{
	
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
	
	function index(Request $request){
		
		$users = User::select('users.*', 'user_profiles.first_name' , 'user_profiles.last_name', 'user_profiles.address', 'user_profiles.contact');
		$users = $users->join("user_profiles","user_profiles.user_id","=","users.id");
		if($_REQUEST){
 
           if(isset($_REQUEST['operationtype']) && $_REQUEST['operationtype']=="removeall"){
			   if(isset($_REQUEST['deletemultiple']) && count($_REQUEST['deletemultiple'])>0){
				   $this->deletemultiple($_REQUEST['deletemultiple']);
				   return redirect('user/index');
			   }			   
		   }
		   
           if($request['s'] && $request['o']){
             $users->orderBy($request['s'], $request['o']);
		   }
		
		   if(trim($request['username'])!=""){			  
			  $users = $users->where('username' , 'LIKE' , '%'.trim($request['username']).'%');
		   }
		   
		   if(trim($request['email'])!=""){			  
			  $users = $users->where('email' , 'LIKE' , '%'.trim($request['email']).'%');
		   }		   		
		   
		   if(trim($request['name'])!=""){
			  $users = $users->where('user_profiles.first_name' , 'LIKE' , '%'.trim($request['name']).'%')->where(
			 'user_profiles.last_name' , 'LIKE' , '%'.trim($request['name']).'%', 'OR');
		   }
		}
		
		$users = $users->paginate(5);	
		
		return view('user.list')->withUsers($users);
	}
	
	function remove($id){
		$user = User::findOrFail($id);
		if($user->delete())
         Session::flash('flashmessage' , 'User deleted successfully.');
        else 
         Session::flash('flashmessage' , 'User could not be deleted.');			
		return redirect('user/index');
	}
	
	function edit($id , Request $request){
		$user = User::with('user_profiles')->findOrFail($id);
        if($_POST){
			 
			 $this->validate($request, [
               'username' => 'required|unique:users,username,'.$id,
               'email' => 'required|unique:users,email,'.$id,
			   'first_name' => 'required',
			   'last_name' => 'required'
             ]);
			 
			 if($request->hasFile('image')){ 
				  $imagefile = $request->file('image'); 
				  $destinationPath = public_path()."/uploads/";
				  $filename = $imagefile->getClientOriginalName();			 
				  if($imagefile->move($destinationPath , $filename)){
					 $request['profile_pic'] = $filename; 
				  }
		     }
		   
		     $input = $request->all();
			 if($user->fill($input)->save()){
				 if(isset($user->user_profiles[0]) && isset($user->user_profiles[0]->user_id) && $user->user_profiles[0]->user_id==$id){
			        $userprofile = $user->user_profiles[0];	
			     }
                 else {
					$userprofile = new UserProfile;
                    $request['user_id'] = $id;	
                     $input = $request->all(); 					
				 }				 
			     $userprofile->fill($input)->save();
			     Session::flash('flashmessage' , 'User detail updated successfully.');
			 }
			 else {
				 Session::flash('flashmessage' , 'User detail could not be updated.');
			 }
			 
			 return redirect('user/index');
		}
		
		return view('user.edit', [])->withUser($user);
	}
	
	function view($id){ 
		$user = User::with('user_profiles')->findOrFail($id);		
		return view('user.view')->withUser($user);
	}
	
	function add(Request $request){	
        ini_set('xdebug.max_nesting_level', 120);	
		if($_POST){			
		   $this->validate($request, [
             'username' => 'required|unique:users',
             'email' => 'required|unique:users',
			 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
           ]);		   
		   
		   $model = new User;
		   		   
           if($request->hasFile('image')){ 
			  $imagefile = $request->file('image'); 
			  $destinationPath = public_path()."/uploads/";
			  $filename = $imagefile->getClientOriginalName();			 
			  if($imagefile->move($destinationPath , $filename)){
				 $request['profile_pic'] = $filename; 
			  }
		   }
		
           $input = $request->all();			
		   if($lastid = $model->create($input)){
                     			  			  
              $request['user_id'] = $lastid->id;		

              			 
		      $userprofilemodel = new UserProfile;
			  $userprofilemodel->create($request->all());
			  
			  Event::fire(new Useradded($request));
			  /*Mail::send('emails.user' , [
			     'email'=>$request['email'],
			     'name'=>$request['first_name'],
			     'address'=>$request['address'],
			     'contact'=>$request['contact']
		      ] , function($message)use($request){
				    $message->from('hello@app.com', 'Your Application');
					$message->to($request['email'], @$request['first_name'])->subject('Thanks For Registration');
			  });*/
			  
		      Session::flash('flashmessage' , 'User added successfully');
			  
		   }
		   else {
			  Session::flash('flashmessage' , 'User could not be added.'); 
		   }
		   
		   return redirect('user/index');
		}
		
		return view('user.adduser', []);
	}

    function admin_index(Request $request){
		
		$users = User::select('users.*', 'user_profiles.first_name' , 'user_profiles.last_name', 'user_profiles.address', 'user_profiles.contact');
		$users = $users->join("user_profiles","user_profiles.user_id","=","users.id");
		
		if($_REQUEST){		
           if(isset($_REQUEST['operationtype']) && $_REQUEST['operationtype']=="removeall"){
			   if(isset($_REQUEST['deletemultiple']) && count($_REQUEST['deletemultiple'])>0){
				   $this->deletemultiple($_REQUEST['deletemultiple']);
				   return redirect('admin/user/index');
			   }			   
		   }
		   
           if($request['s'] && $request['o']){
               $users->orderBy($request['s'], $request['o']);
		   }
		   
		   if(trim($request['username'])!=""){			  
			   $users = $users->where('username' , 'LIKE' , '%'.trim($request['username']).'%');
		   }
		   
		   if(trim($request['email'])!=""){			  
			   $users = $users->where('email' , 'LIKE' , '%'.trim($request['email']).'%');
		   }		   		
		   
		   if(trim($request['name'])!=""){
			   $users = $users->where('user_profiles.first_name' , 'LIKE' , '%'.trim($request['name']).'%')->where(
			   'user_profiles.last_name' , 'LIKE' , '%'.trim($request['name']).'%', 'OR');
		   }
		}
		
		$users = $users->paginate(5);
        return view('admin.user.list')->withUsers($users);		
	}

    function admin_add(Request $request){	
        ini_set('xdebug.max_nesting_level', 120);	
		if($_POST){			
		   $this->validate($request, [
             'username' => 'required|unique:users',
             'email' => 'required|unique:users',
			 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
           ]);		   
		   
		   $model = new User;
		   		   
           if($request->hasFile('image')){ 
			  $imagefile = $request->file('image'); 
			  $destinationPath = public_path()."/uploads/";
			  $filename = $imagefile->getClientOriginalName();			 
			  if($imagefile->move($destinationPath , $filename)){
				 $request['profile_pic'] = $filename; 
			  }
		   }
		
           $input = $request->all();			
		   if($lastid = $model->create($input)){
                           			  			  
              $request['user_id'] = $lastid->id;		

              			 
		      $userprofilemodel = new UserProfile;
			  $userprofilemodel->create($request->all());
			  $mailrequest = [
			     'email'=>$request['email'],
				 'first_name'=>$request['first_name'],
				 'address'=>$request['address'],
				 'contact'=>$request['contact']
			  ];
			  $this->dispatch(new NewsletterEmail($mailrequest));
			  
			  /* Mail::send('emails.user' , [
			     'email'=>$request['email'],
			     'name'=>$request['first_name'],
			     'address'=>$request['address'],
			     'contact'=>$request['contact']
		      ] , function($message)use($request){
				    $message->from('hello@app.com', 'Your Application');
					$message->to($request['email'], @$request['first_name'])->subject('Thanks For Registration');
			  }); */
			  
		      Session::flash('flashmessage' , 'User added successfully');
			  
		   }
		   else {
			  Session::flash('flashmessage' , 'User could not be added.'); 
		   }
		   
		   return redirect('admin/user/index');
		}
		
		return view('admin.user.adduser', []);
	}

    function admin_view($id){
		$user = User::with('user_profiles')->find($id);
		if(empty($user)){ 
          abort(404);		
		}
		return view('admin.user.view')->withUser($user);
	}

    function admin_edit($id , Request $request){
		$user = User::with('user_profiles')->findOrFail($id);
        if($_POST){
			 
			 $this->validate($request, [
               'username' => 'required|unique:users,username,'.$id,
               'email' => 'required|unique:users,email,'.$id,
			   'first_name' => 'required',
			   'last_name' => 'required'
             ]);
			 
			 if($request->hasFile('image')){ 
				  $imagefile = $request->file('image'); 
				  $destinationPath = public_path()."/uploads/";
				  $filename = $imagefile->getClientOriginalName();			 
				  if($imagefile->move($destinationPath , $filename)){
					 $request['profile_pic'] = $filename; 
				  }
		     }
		   
		     $input = $request->all();
			 if($user->fill($input)->save()){
				 if(isset($user->user_profiles[0]) && isset($user->user_profiles[0]->user_id) && $user->user_profiles[0]->user_id==$id){
			        $userprofile = $user->user_profiles[0];	
			     }
                 else {
					$userprofile = new UserProfile;
                    $request['user_id'] = $id;	
                     $input = $request->all(); 					
				 }				 
			     $userprofile->fill($input)->save();
			     Session::flash('flashmessage' , 'User detail updated successfully.');
			 }
			 else {
				 Session::flash('flashmessage' , 'User detail could not be updated.');
			 }
			 
			 return redirect('admin/user/index');
		}
		
		return view('admin.user.edit', [])->withUser($user);
	}

    function admin_remove($id){
		$user = User::findOrFail($id);
		if($user->delete())
         Session::flash('flashmessage' , 'User deleted successfully.');
        else 
         Session::flash('flashmessage' , 'User could not be deleted.');			
		return redirect('admin/user/index');
	}	
 
    function deletemultiple($arr){
		$is_deleted = User::destroy($arr);
		if($is_deleted){
			Session::flash('flashmessage' , 'User/s deleted successfully.');
		}
		else {
			Session::flash('flashmessage'  , 'User/s could not be deleted.');
		}
	}	
}
