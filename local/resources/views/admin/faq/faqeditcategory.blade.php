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
        Edit Admin User
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Edit Cms Page</li>
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
               {!! Form::model($data, array('action' => ["admin\FaqcategoryController@updatefaqcategory", $data->id],'class' => 'form-horizontal')) !!}
            
                    <div class="box-body">
    
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                {!! Form::text('name', $data->name ? $data->name : null, array('class' => 'form-control', 'placeholder' => ' name')) !!}
                               
                                <div class="error-message">{{$errors->first('name')}}</div>
                            </div>
                        </div>
                    </div>
                
                     <div class="box-footer col-sm-offset-2"> 
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-default btn-close" href="{!! url('admin/faqcategorylist'); !!}">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

@stop

