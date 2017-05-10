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
	echo Form::open(array('url' => 'user/add' , 'files'=>'true'));
	
	echo Form::label('username', 'Username', ['class' => 'awesome']);
	echo Form::text('username');
    echo $errors->first('username');
	echo '<br/>';
	
	echo Form::label('email', 'E-Mail', ['class' => 'awesome']);
	echo Form::text('email');
	echo $errors->first('email');
	echo '<br/>';

	echo Form::label('password', 'Password', ['class' => 'awesome']);
	echo Form::password('password');
	echo $errors->first('password');
	echo '<br/>';
	
	echo Form::label('first_name', 'First Name', ['class' => 'awesome']);
	echo Form::text('first_name');
	echo $errors->first('first_name');
	echo '<br/>';

	echo Form::label('last_name', 'Last Name', ['class' => 'awesome']);
	echo Form::text('last_name');
	echo $errors->first('last_name');
	echo '<br/>';
	
	echo Form::label('image', 'Profile Pic', ['class' => 'awesome']);
	echo Form::file('image');
	echo $errors->first('image');
	echo '<br/>';
	
	echo Form::label('address', 'Address', ['class' => 'awesome']);
	echo Form::text('address');
	echo $errors->first('address');
	echo '<br/>';
	
	echo Form::label('contact', 'Contact', ['class' => 'awesome']);
	echo Form::text('contact');
	echo $errors->first('contact');
	echo '<br/>';
	
	echo Form::submit('Submit');
	
	echo Form::close();
?>
@stop   