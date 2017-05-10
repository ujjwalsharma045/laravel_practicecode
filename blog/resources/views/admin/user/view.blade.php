@extends('layouts.adminapp')
@section('content')
<table border="1">
	<tr>
	   <td>
	      Username
	   </td>
	   <td>
	      <?php echo $user->username; ?>
	   </td>
	</tr>
	
    <tr>
       <td>
	     Email
	   </td>	
	   <td>
	      <?php echo $user->email; ?>
	   </td>
	</tr>
	
    <tr> 
       <td>
	      Created
	   </td>	
	   <td>
	      <?php echo $user->created_at; ?>
	   </td>
	</tr>
	
    <tr>   
	   <td>
	      Status
	   </td>
	   <td>
	      <?php echo $user->status; ?>
	   </td>
	</tr>
	
	<tr>
	   <td>
	      Name
	   </td>
	   <td>
	      <?php echo @$user->user_profiles[0]->first_name." ".@$user->user_profiles[0]->last_name; ?>
	   </td>
	</tr>
	
    <tr>
       <td>
	     Address
	   </td>	
	   <td>
	      <?php echo @$user->user_profiles[0]->address; ?>
	   </td>
	</tr>
	
    <tr> 
       <td>
	      Contact
	   </td>	
	   <td>
          <?php 
		    echo @$user->user_profiles[0]->contact; 
		  ?>	    
       </td>
	</tr>
</table>
@stop