@extends('layouts.app')
@section('content')
<table border="1">
	<tr>
	   <td>
	      Title
	   </td>
	   <td>
	      <?php echo $page->title; ?>
	   </td>
	</tr>
	
    <tr>
       <td>
	     Content
	   </td>	
	   <td>
	      <?php echo $page->content; ?>
	   </td>
	</tr>
	
    <tr> 
       <td>
	      Created
	   </td>	
	   <td>
	      <?php echo $page->created_at; ?>
	   </td>
	</tr>
	
    <tr>   
	   <td>
	      Status
	   </td>
	   <td>
	      <?php echo $page->status; ?>
	   </td>
	</tr>
</table>
@stop