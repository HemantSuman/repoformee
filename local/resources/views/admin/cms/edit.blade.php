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
        <li>Cms Page Managment</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>
               {!! Form::model($data, array('action' => ["admin\\CmsController@admin_update", $data->id],'class' => 'form-horizontal')) !!}
            
                    <div class="box-body">
                       
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                
                                {!! Form::text('title', $data->title ? str_replace("-"," ",$data->title) : null, array('class' => 'form-control', 'placeholder' => ' title')) !!}
                               <?php
                                $pagearray=array(
                                    'About-Us'=>'About US',
                                    'Safety-Tips'=>'Safety Tips',
                                    'Contact-Us'=>'Contact Us',
                                    'Terms-of-Use'=>'Terms of Use',
                                    'Privacy-Policy'=>'Privacy Policy',
                                    'T&C-and-Legal-Notices'=>'T&C and Legal Notices',
                                    );
                                ?>
                                
<!--                                {!! Form::select('title', $pagearray,($data->title)?$data->title:'',['placeholder' => 'Select Page', 'class' => 'form-control']) !!}-->
                                <div class="error-message">{{$errors->first('title')}}</div>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-10">
                                {!! Form::text('title', $data->slug ? $data->slug : null, array('class' => 'form-control', 'placeholder' => ' slug')) !!}
                               
                                <div class="error-message">{{$errors->first('slug')}}</div>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                {!! Form::textarea('description',  $data->description ? $data->description : null, ['id' => 'editor1','class' => 'editor11 form-control','placeholder'=>'Description','rows'=>7]) !!}
                               
                                <div class="error-message">{{$errors->first('description')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Meta Title</label>
                            <div class="col-sm-10">
                                {!! Form::text('metatitle', $data->metatitle ? $data->metatitle : null, array('class' => 'form-control', 'placeholder' => ' metatitle')) !!}
                               
                                <div class="error-message">{{$errors->first('metatitle')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Meta Keyword</label>
                            <div class="col-sm-10">
                                {!! Form::text('metakeyword', $data->metakeyword ? $data->metakeyword : null, array('class' => 'form-control', 'placeholder' => ' metakeyword')) !!}
                               
                                <div class="error-message">{{$errors->first('metakeyword')}}</div>
                            </div>
                        </div>
                    </div>
                
                    <div class="box-footer col-sm-offset-2"> 
                        <button type="submit" class="btn btn-primary">Save</button>
                       <a class="btn btn-default btn-close" href="{!! url('admin/cms'); !!}">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

@stop

