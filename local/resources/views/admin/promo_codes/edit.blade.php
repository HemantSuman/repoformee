<style>
    .error-message{color:#dd4b39;}
    .message{color:rgb(60, 141, 188);}
    .sel-box{
        position:relative;
    }

    #myselect{display:block; width:100%; /*height:20px;*/ border:1px solid #d2d6de; padding:5px; overflow: hidden; } .toc-odd{position:absolute; top:32px; background:#fff; width:100%; display:none; border:1px solid #999; z-index: 9; max-height: 187px; overflow: auto; } .toc-odd li{padding:5px 10px; border-bottom:1px solid #999; list-style: none; } .toc-odd li:hover{background: #f4f4f4; } .toc-odd li a{text-decoration:none; display: block; color: #181818; } .toc-odd li a span {display: inline-block; width: 15px; height: 15px; float: right; margin-top: 2px; }
</style>
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit {{ $modelTitle}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url("/admin/$viewName") }}">{{$modelTitle}}</a></li>
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

                {!! Form::model($result, ["action" => ["admin\\$controllerName@admin_update", $result->id], 'files' => true, "id"=>"formSubmit"]) !!}	
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label>    

                        {!! Form::select('parent_categoryid', $categories, $result->parent_categoryid, ['placeholder' => 'Select Category', 'class' => 'form-control parent_categoryid getChildCat']) !!}
                        <div id="parent_categoryid_error" class="error-message">{{$errors->first('parent_categoryid')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select SubCategory</label>
                        {!! Form::select('category_id', $sub_categories, $result->category_id, ['placeholder' => 'Select Sub Category', 'class' => 'form-control getClassifiedList', 'id' => 'sub_categories1']) !!}

                        <div id="category_id_error" class="error-message">{{$errors->first('category_id')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Products</label>
                        {!! Form::select('classified_id', $classifieds, $result->classified_id, ['placeholder' => 'Select Products', 'class' => 'form-control classified_id']) !!}

                        <div id="classified_id_error" class="error-message">{{$errors->first('classified_id')}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Start Date</label>                  
                            {!! Form::input('text', 'start_date', $result->start_date ? date('m/d/Y', strtotime($result->start_date)) : null, ['class' => 'form-control datepicker','placeholder'=>'Select Date']) !!}
                            <div id="start_date_error" class="error-message">{{$errors->first('start_date')}}</div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">End Date</label>                  
                            {!! Form::input('text', 'end_date', $result->end_date ? date('m/d/Y', strtotime($result->end_date)) : null, ['class' => 'form-control datepicker','placeholder'=>'Select Date']) !!}
                            <div id="end_date_error" class="error-message">{{$errors->first('end_date')}}</div>
                        </div> 
                    </div> 
                    <?php
                    $discount_type = array(
                        'Fix' => 'Fix',
                        'Percentage' => 'Percentage',
                    );
                    ?>
                    <div class="form-group com_info">
                        <label>Plan Type </label>         
                        {!! Form::select('discount_type', $discount_type, null, ['class' => 'form-control comm_details']) !!}
                        <div id="discount_type_error" class="error-message">{{$errors->first('discount_type')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Discount Value</label>                  
                        {!! Form::input('text', 'discount_value', null, ['class' => 'form-control','placeholder'=>'Discount Value']) !!}
                        <div id="discount_value_error" class="error-message">{{$errors->first('discount_value')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Promo Code</label>                  
                        {!! Form::input('text', 'promocode', null, ['class' => 'form-control','placeholder'=>'Promo Code']) !!}
                        <div id="promocode_error" class="error-message">{{$errors->first('promocode')}}</div>
                    </div> 

                    <div class="form-group">
                        <div class=" checkbox bike-category">
                            <label>
                                {!! Form::checkbox('status', '1', null) !!} Active
                            </label>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->


                <div class="box-footer">

                    <button type="submit" class="btn btn-primary">Submit</button> 
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href='{!! url("admin/$viewName"); !!}'>Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box -->

        </div>
        <!--/.col -->        
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->	

@stop

@section('scripts')
<script>
    $('body').on('focus', ".datepicker", function () {
        $(this).datepicker();
    });

</script>
@stop
