<?php
namespace App\Helpers; 
use Input;
use Route;

class CustomHelper{	
	public function formatDate($date){
		return date("D M,Y" ,strtotime($date));
	}

    public static function link_to_sorting_action($col, $title = null) {
        if (is_null($title)) {
            $title = str_replace('_', ' ', $col);
            $title = ucfirst($title);
        }
 
        $indicator = (Input::get('s') == $col ? (Input::get('o') === 'asc' ? '&uarr;' : '&darr;') : null);
        $parameters = array_merge(Input::get(), array('s' => $col, 'o' => (Input::get('o') === 'asc' ? 'desc' : 'asc')));
 
        return link_to_route(str_replace("/", ".", Route::getFacadeRoot()->current()->uri()), "$title $indicator", $parameters);
    }	
}
?>