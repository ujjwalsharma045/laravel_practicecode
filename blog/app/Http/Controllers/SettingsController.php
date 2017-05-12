<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Events\Useradded;
use App\Setting;
use Session;
use Mail;
use Event;
use Input;
class SettingsController extends BaseController
{	    
	use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;	
    function admin_index(Request $request){
		
		if($_REQUEST){		
           foreach($request['settings'] as $key => $value){
			  Setting::where('id' , $key)->update(['content'=>$value]);
		   } 
		   Session::flash('flashmessage' , 'settings updated successfully.');
		   return redirect('admin/settings/index');
		}
		
		$settings = Setting::all();
        return view('admin.settings.index')->withSettings($settings);		
	}    	
}
