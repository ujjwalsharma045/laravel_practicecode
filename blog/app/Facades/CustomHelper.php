<?php
namespace app\Facades; 
use Illuminate\Support\Facades\Facade;

class CustomHelper extends Facade{	
	public static function getFacadeAccessor(){
		return 'customhelper';
	}	
}
?>