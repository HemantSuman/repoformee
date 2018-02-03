@extends('admin/layout/login')
@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="{!! url('admin/login'); !!}"><b>For</b>Mee</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Please Enter Your Email</p>
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
        array('url' => '/admin/forgotcheck',
        'class' => 'form',
        'files' => true,
        'id'=>'forgotcheck',
        ));
        !!}
        <div class="form-group has-feedback">
            {!!   Form::text('email', '', $attributes = ['class' => 'form-control', 'placeholder' => 'Email']); !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="row">

            <!-- /.col -->
            <div class="col-xs-4">
                {!! Form::submit('Submit', ['class' => "btn btn-primary btn-block btn-flat",'id' =>"mailsend"]); !!}
            </div>
            <!-- /.col -->
        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.login-box-body -->
</div>

@stop
