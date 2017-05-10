<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Page;
use Session;
class PageController extends BaseController
{
	
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
	
	function index(Request $request){
		$pages = Page::paginate(5);			
		return view('page.list')->withPages($pages);
	}
	
	function remove($id){
		$page = Page::findOrFail($id);
		if($page->delete())
         Session::flash('flashmessage' , 'Page deleted successfully.');
        else 
         Session::flash('flashmessage' , 'Page could not be deleted.');			
		return redirect('page/index');
	}
	
	function edit($id , Request $request){
		$page = Page::findOrFail($id);
        if($_POST){
			 
			 $this->validate($request, [               
			   'title' => 'required|unique:pages,title,'.$id,
			   'content' => 'required'
             ]);
		   
		     $input = $request->all();
			 if($page->fill($input)->save()){
				 
			     Session::flash('flashmessage' , 'Page detail updated successfully.');
			 }
			 else {
				 Session::flash('flashmessage' , 'Page detail could not be updated.');
			 }
			 
			 return redirect('page/index');
		}
		
		return view('page.edit', [])->withPage($page);
	}
	
	function view($id){
		$page = Page::findOrFail($id);		
		return view('page.view')->withPage($page);
	}
	
	function add(Request $request){	
        ini_set('xdebug.max_nesting_level', 120);	
		if($_POST){			
		   $this->validate($request, [
             'title' => 'required|unique:pages',
             'content' => 'required'
           ]);
		   
		   $model = new Page;
		   $input = $request->all();		   
		   if($lastid = $model->create($input)){			               		      
		      Session::flash('flashmessage' , 'Page added successfully');
		   }
		   else {
			  Session::flash('flashmessage' , 'Page could not be added.'); 
		   }
		   
		   return redirect('page/index');
		}
		
		return view('page.add', []);
	}
}
