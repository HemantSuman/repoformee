
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Faq List Page
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Add Faq List Page</li>
        <li class="active"></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>

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

                {!! Form::open(array("url" => "admin/createfaqlist", "role" => "form", 'class' => 'form-horizontal')) !!} 
                <div class="box-body">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Select Faq Category</label>

                        <div class="col-sm-10">
                            {!! Form::select('faq_category_id', $faq_categoryid, '',['placeholder' => 'Select Faq Category', 'class' => 'form-control']) !!}
                            <div class="error-message">{{$errors->first('faq_category_id')}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Question</label>
                        <div class="col-sm-10">
                            {!! Form::textarea('question', null, ['class' => 'form-control','placeholder'=>'Question','rows'=>5]) !!}
                            <div class="error-message">{{$errors->first('question')}}</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Answer</label>

                        <div class="col-sm-10">
                            {!! Form::textarea('answer', null, ['id' => 'editor1','class' => 'form-control','placeholder'=>'Answer','rows'=>7]) !!}
                            <div class="error-message">{{$errors->first('answer')}}</div>

                        </div> 


                    </div>

                    <div class="box-footer col-sm-offset-2"> 
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-default btn-close" href="{!! url('admin/faqlist'); !!}">Cancel</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
</section>

@stop

