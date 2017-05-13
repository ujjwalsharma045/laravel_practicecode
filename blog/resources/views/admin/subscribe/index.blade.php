@extends('layouts.adminapp')
@section('content')
<?php 
if($errors->any()){
	?>
    <div class="alert alert-danger">
        <?php 
		foreach($errors->all() as $error){
			?>
            <p><?php echo $error; ?></p>
			<?php
        }
		?>
    </div>
	<?php 
}
?>

<?php
	echo Form::open(array('url' => 'admin/subscribe/index'));
	
	echo Form::label('username', 'Username', ['class' => 'awesome']);
	echo Form::select('username[]' , $users , '' , ['multiple'=>true , 'placeholder'=>'Choose Users']);
    echo $errors->first('username');
	echo '<br/>';
	
	echo Form::label('content', 'Content', ['class' => 'awesome']);
	echo Form::textarea('content');
	echo $errors->first('content');
	echo '<br/>';
	
	echo Form::submit('Submit');
	
	echo Form::submit('Submit');
	
	echo Form::close();
?>
<script src="<?php echo URL::to('vendor/unisharp/laravel-ckeditor/ckeditor.js'); ?>"></script>
<script>
   CKEDITOR.replace('content');
</script>
@stop   