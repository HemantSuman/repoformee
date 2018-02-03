<style>
    #classifiedInputFile {
        margin-top: 6px;
    }
    .thumbnail{

        height: 40px;
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
        View Review
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/reviews') }}">{{$modelTitle}}</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!--column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>

                <!-- /.box-header -->
                <!-- form start -->    

                {!! Form::model($result, array('action' => ["admin\\$controllerName@admin_update", $result->id], 'files' => true, 'id'=>'formSubmit')) !!}


                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Classified</label>                  
                        {!! Form::input('text', '', $result->reviews_bt_classified->title, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        {!! Form::input('text', '', $result->reviews_bt_users->name, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Review</label>                  
                        {!! Form::textarea('review', null, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Rating</label>                  
                        {!! Form::input('text', 'rating', null, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label><br>
                        <span class="label label-<?php if ($result->status == 0) { ?>danger<?php } else { ?>success<?php } ?>">
                            @if($result->status==0) Inactive @else Active @endif</span>
                    </div> 


                </div>
                <!-- /.box-body -->


                <div class="box-footer">
                    <input type="hidden" value="{{ $result->id }}" name="id">
                    <button type="submit" class="btn btn-primary">Approve</button> 
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href='{!! url("admin/$viewName"); !!}' >Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.box -->

    </div>
    <!--/.col -->        
    <!--</div>-->
    <!-- /.row -->
</section>
<!-- /.content -->	

@stop

@section('scripts')

@stop