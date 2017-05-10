@extends('layouts.adminapp')
@section('content')
<div>
  <?php
   if(Session::has('flashmessage')){
	 echo Session::get('flashmessage');  
   }  
  ?>
</div>

<style type="text/css">
 .pagination{
	list-style:none
 }
 .pagination ul li {
	 float:left;
	 width:40px;
 }
</style>

<?php 
   echo Form::open(array('url' => 'admin/user/index'));	
    ?>
	<div>
	  <?php 
	    echo Form::label('username', 'Username', ['class' => 'awesome']);
        echo Form::text('username' , Input::get('username'));
        echo $errors->first('username');
        echo '<br/>';
	  ?>
	</div>

	<div>
	  <?php
	    echo Form::label('email', 'Email', ['class' => 'awesome']);
        echo Form::text('email' , Input::get('email'));
        echo $errors->first('email');
        echo '<br/>';
	  ?>  	  
	</div>  
	
	<div>
	  <?php 
	    echo Form::label('name', 'Name', ['class' => 'awesome']);
        echo Form::text('name' , Input::get('name'));
        echo $errors->first('name');
        echo '<br/>';
	  ?>
    </div>	 
    <?php 
    echo Form::submit('Search' , ['value'=>'Search']);
	
   echo Form::close();	
?>
</br>
<?php 
   echo Form::open(array('url' => 'admin/user/index' , 'id'=>'listing'));	
?>
<table style="border:1px solid #000000;" border="1" width="100%">
    <tr>
	   <th><a href="javascript:void(0)" onclick="removeall()">Remove</a><?php echo Form::checkbox('checkall' , '1'); ?></th>
	   <th><?php echo CustomHelper::link_to_sorting_action('username' , 'Username'); ?></th>
	   <th><?php echo CustomHelper::link_to_sorting_action('email' , 'Email'); ?></th>
	   <th><?php echo CustomHelper::link_to_sorting_action('status' , 'Status'); ?></th>
	   <th><?php echo CustomHelper::link_to_sorting_action('created_at' , 'Created'); ?></th>
	   <th><?php echo CustomHelper::link_to_sorting_action('first_name' , 'Name'); ?></th>
	   <th><?php echo CustomHelper::link_to_sorting_action('address' , 'Address'); ?></th>
	   <th><?php echo CustomHelper::link_to_sorting_action('contact' , 'Contact'); ?></th>
	   <th>Action</th>
	</tr> 
    <?php
	foreach($users as $user){
		?>
		<tr>
		   <td>
		     <?php echo Form::checkbox('deletemultiple[]' , $user->id); ?>
		   </td>
		   <td>
			  <?php echo $user->username; ?>
		   </td>
		   <td>
			  <?php echo $user->email; ?>
		   </td>
		   <td>
			  <?php echo $user->created_at; ?>
		   </td>
		   <td>
			  <?php echo $user->status; ?>
		   </td>		   
		   <td>
			  <?php echo @$user->first_name." ".@$user->last_name; ?>
		   </td>		   
		   <td>
			  <?php echo @$user->address; ?>
		   </td>		   
		   <td>
			  <?php echo @$user->contact; ?>
		   </td>		   
		   <td>
			  <a href="<?php echo URL::to('admin/user/view/'.$user->id); ?>">
			    View
			  </a>
			  
			  <a href="<?php echo URL::to('admin/user/edit/'.$user->id); ?>">
			    Edit
			  </a>
			  
			  <a href="<?php echo URL::to('admin/user/remove/'.$user->id);?>">
			    Delete
			  </a>
		   </td>
		</tr>
		<?php 
	}
    ?> 
	<tr>
	  <td colspan="9">
		 <div class="pagination">
		   <?php echo $users->appends(Input::except('page'))->links(); ?>
		 </div>
	  </td>
	</tr>  
</table>
<?php 
 echo Form::hidden('operationtype' , Input::get('operationtype'));
 echo Form::close();
?>
<script type="text/javascript">
$(document).ready(function(){ //alert("D");
	$("input[name='checkall']").click(function(){ 	   
  	    checkall();
	});
});

function removeall(){
	$("input[name='operationtype']").val('removeall');	
	$("form#listing").submit()
}
function checkall(){
	if($("input[name='checkall']").is(":checked")){
	    $("input[name^='deletemultiple']").attr('checked' , 'checked');
	}
	else {
		$("input[name^='deletemultiple']").attr('checked' , false);
	}
}
</script>
@stop