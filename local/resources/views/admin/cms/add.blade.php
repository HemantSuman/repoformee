
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Cms Page
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Add Cms Page</li>
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

                {!! Form::open(array("url" => "admin/createcms", "role" => "form", 'class' => 'form-horizontal')) !!} 
                    <div class="box-body">
                       
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
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
                                {!! Form::select('title', $pagearray,'',['placeholder' => 'Select Page', 'class' => 'form-control']) !!}
<!--                                {!! Form::input('text', 'title', null, ['class' => 'form-control','placeholder'=>'Title']) !!}-->
                                <div class="error-message">{{$errors->first('title')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-10">
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
                                {!! Form::select('slug', $pagearray,'',['placeholder' => 'Select Page', 'class' => 'form-control']) !!}

<!--                                 {!! Form::input('text', 'slug', null, ['class' => 'form-control','placeholder'=>'Slug']) !!}-->
                                <div class="error-message">{{$errors->first('slug')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                               {!! Form::textarea('description', null, ['id' => 'editor1','class' => 'form-control','placeholder'=>'Description','rows'=>7]) !!}
                                <div class="error-message">{{$errors->first('description')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Meta Title</label>
                            <div class="col-sm-10">
                                {!! Form::input('text', 'metatitle', null, ['class' => 'form-control','placeholder'=>'Meta Title','min'=>'0']) !!}
                                <div class="error-message">{{$errors->first('metatitle')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Meta Keywoard</label>
                            <div class="col-sm-10">
                                {!! Form::input('text', 'metakeyword', null, ['class' => 'form-control','placeholder'=>'Meta Keywoard','min'=>'0']) !!}
                                <div class="error-message">{{$errors->first('metakeywoard')}}</div>
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

