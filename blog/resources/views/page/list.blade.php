@extends('layouts.app')
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

<table style="border:1px solid #000000;" border="1">
    <tr>
	   <th>Title</th>
	   <th>Created</th>
	   <th>Status</th>
	</tr> 
    <?php
	foreach($pages as $page){
		?>
		<tr>
		   <td>
			  <?php echo $page->title; ?>
		   </td>
		   <td>
			  <?php echo $page->content; ?>
		   </td>
		   <td>
			  <?php echo $page->created_at; ?>
		   </td>
		   
		   
		   <td>
			  <a href="<?php echo URL::to('page/view/'.$page->id); ?>">
			    View
			  </a>
			  
			  <a href="<?php echo URL::to('page/edit/'.$page->id); ?>">
			    Edit
			  </a>
			  
			  <a href="<?php echo URL::to('page/remove/'.$page->id);?>">
			    Delete
			  </a>
		   </td>
		</tr>
		<?php 
	}
    ?> 
	<tr>
	  <td colspan="5">
		 <div class="pagination"><?php echo $pages->links(); ?></div>
	  </td>
	</tr>  
</table>
@stop