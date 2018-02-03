@extends('front/layout/layout')
@section('content')
<div id="middle" class="no-banner">
	<div class="container">
	<div class="user-forgot-password-form" style="margin: 30px 15px">
		<h3 class="text-center"><strong>Reset Password</strong></h3>
		<br/>
		@if( Session::has( 'success' ))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ Session::get( 'success' ) }}
        </div>
        @elseif( Session::has( 'danger' ))
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Oops!</strong> {{ Session::get( 'danger' ) }}
        </div>
        @endif
		{!! Form::open(array('url' => '/reset-password', 'class' => 'form-horizontal')); !!}
		<form class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-3 text-right">New Password</label>
				<div class="col-sm-6">
					{!! Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) !!}
				</div>
				<label id="password-error" class="error" for="password">{{$errors->first('password')}}</label>
			</div>
			<div class="form-group">
				<label class="col-sm-3 text-right">Confirm Password</label>
				<div class="col-sm-6">
					{!! Form::password('password_confirmation', array('placeholder' => 'Password', 'class' => 'form-control')) !!}
				</div>
				<label id="password_confirmation-error" class="error" for="password_confirmation">{{$errors->first('password_confirmation')}}</label>
			</div>
			<div class="form-group">	
				<div class="col-sm-6 col-sm-offset-3">
					<input type="hidden" name="token" value="<?php echo isset($usetoken) ? $usetoken : null; ?>">
					<input type="submit" name="submit" value="Update Password" class="btn btn-custom-primary">
				</div>
			</div>
		{!! Form::close() !!}
	</div>
	</div>
</div>
@stop