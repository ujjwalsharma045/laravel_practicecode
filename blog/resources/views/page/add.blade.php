@extends('layouts.app')
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
	echo Form::open(array('url' => 'page/add'));
	
	echo Form::label('title', 'Title', ['class' => 'awesome']);
	echo Form::text('title');
    echo $errors->first('title');
	echo '<br/>';
	
	echo Form::label('content', 'Content', ['class' => 'awesome']);
	echo Form::textarea('content');
	echo $errors->first('content');
	echo '<br/>';
	
	echo Form::submit('Submit');
	
	echo Form::close();
?>
<script src="<?php echo URL::to('vendor/unisharp/laravel-ckeditor/ckeditor.js'); ?>"></script>
<script>
   CKEDITOR.replace('content');
</script>
@stop