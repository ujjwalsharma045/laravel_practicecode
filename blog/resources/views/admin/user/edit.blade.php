@extends('layouts.adminapp')
@section('content')
<?php
	echo Form::model($user, [
    'method' => 'PATCH',
    'route' => ['admin.user.update', $user->id],
	'files'=>'true'
    ]); 
	
	echo Form::label('username', 'Username', ['class' => 'awesome']);
	echo Form::text('username');
	echo $errors->first('username');
	echo '<br/>';
	
	echo Form::label('email', 'E-Mail', ['class' => 'awesome']);
	echo Form::text('email');
	echo $errors->first('email');
	echo '<br/>';

	echo Form::label('first_name', 'First Name', ['class' => 'awesome']);
	echo Form::text('first_name' , @$user->user_profiles[0]->first_name);
	echo $errors->first('first_name');
	echo '<br/>';

	echo Form::label('last_name', 'Last Name', ['class' => 'awesome']);
	echo Form::text('last_name' , @$user->user_profiles[0]->last_name);
	echo $errors->first('last_name');
	echo '<br/>';
	
	echo Form::label('image', 'Profile Pic', ['class' => 'awesome']);
	echo Form::file('image');
	echo $errors->first('image');
	echo '<br/>';
	
	echo Form::label('address', 'Address', ['class' => 'awesome']);
	echo Form::text('address' , @$user->user_profiles[0]->address);
	echo $errors->first('address');
	echo '<br/>';
	
	echo Form::label('contact', 'Contact', ['class' => 'awesome']);
	echo Form::text('contact' , @$user->user_profiles[0]->contact);
	echo $errors->first('contact');
	echo '<br/>';
	
	echo Form::submit('Submit');
	
	echo Form::close();
?>
@stop
   