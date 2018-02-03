@extends('admin/layout/login')
@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="{!! url('admin/login'); !!}">
            <img src="{{ URL::asset('plugins/front/img/logo.png') }}" class="" alt="logo">
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
         
        @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
              
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        
        @endif
        @if (Session::has('message')) 
            <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        
        @endif
       
        {!! Form::open(
        array('url' => '/admin/logincheck',
        'class' => 'form',
        'files' => true,
        'id'=>'logincheck',
        ));
        !!}
        <div class="form-group has-feedback">
         
            {!!   Form::text('email', $cookie['email'], $attributes = ['class' => 'form-control', 'placeholder' => 'Email']); !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
           {!! Form::input('password', 'password', $cookie['password'],$attributes = ['class' => 'form-control', 'placeholder' => 'Password']);!!}
           
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        {!! Form::checkbox('remember_token'); !!} Remember Me
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                {!! Form::submit('Sign In', ['class' => "btn btn-primary btn-block btn-flat"]); !!}
            </div>
            <!-- /.col -->
        </div>
        {!! Form::close() !!}

        <!--    <div class="social-auth-links text-center">
              <p>- OR -</p>
              <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
              <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
            </div>-->
        <!-- /.social-auth-links -->

        <a href="{!! url('admin/forgotmail'); !!}">I forgot my password</a><br>
        <!--<a href="register.html" class="text-center">Register a new membership</a>-->

    </div>
    <!-- /.login-box-body -->
</div>

@stop
