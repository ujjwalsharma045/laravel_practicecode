@extends('layouts.adminapp')
@section('content')
<div>
  <?php
   if(Session::has('flashmessage')){
	 echo Session::get('flashmessage');  
   }  
  ?>
</div>

<?php 
   echo Form::model($settings , [
    'method' => 'PATCH',
    'route' => ['admin.settings.index'],
	]);	
?>

<table style="border:1px solid #000000;" border="1" width="100%">    
    <?php
	foreach($settings as $key=>$setting){
		?>
		<tr>
		   <td>
		     <?php echo Form::label($setting['title'], ucwords($setting['title']), ['class' => 'awesome']); ?>
		   </td>
		   <td>
			  <?php echo Form::text('settings[]['.$setting['title'].']'); ?>
		   </td>
	    </tr>	   		   
		<tr>
		   <td colspan="2">
		    <?php echo $errors->first($setting['title']); ?>
		   </td>
		</tr>
		<?php 
	}
    ?>   
</table>
<?php 
 echo Form::close();
?>
@stop