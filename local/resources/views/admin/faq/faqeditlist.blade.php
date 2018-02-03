<style>
    .error-message{color:#dd4b39;}
    #newsletterInputFile {
        margin-top: 6px;
    }
    .thumbnail{

        height: 100px;
        margin: 10px; 
        float: left;
    }
    #clear{
       display:none;
    }
    #result {
        border: 4px dotted #cccccc;
        display: none;
        float: left;
        margin:0 auto;
        margin-top: 5px;
        width: 100%;
    }
</style>
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Faq  List
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Edit Faq List</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>
               {!! Form::model($data, array('action' => ["admin\FaqController@updatefaqlist", $data->id],'class' => 'form-horizontal')) !!}
             <div class="box-body">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Select Faq Category</label>

                        <div class="col-sm-10">
                            {!! Form::select('faq_category_id', $faq_categoryid,  $data->faq_category_id ? $data->faq_category_id : '',['placeholder' => 'Select Faq Category', 'class' => 'form-control']) !!}
                            <div class="error-message">{{$errors->first('faq_category_id')}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Question</label>
                        <div class="col-sm-10">
                            {!! Form::textarea('question',  $data->question ? $data->question : null, ['class' => 'form-control','placeholder'=>'Question','rows'=>5]) !!}
                            <div class="error-message">{{$errors->first('question')}}</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Answer</label>

                        <div class="col-sm-10">
                            {!! Form::textarea('answer',  $data->answer ? $data->answer : null, ['id' => 'editor1','class' => 'form-control','placeholder'=>'Answer','rows'=>7]) !!}
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
    </div>
</section>

@stop

