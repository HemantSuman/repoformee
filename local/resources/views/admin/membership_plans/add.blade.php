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
        Add {{ $modelTitle}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/membership_plans') }}">{{$modelTitle}}</a></li>
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

                {!! Form::open(array("url" => "admin/$viewName/create", "role" => "form", 'files' => true, "id"=>"formSubmit")) !!}	
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Plan Name</label>                  
                        {!! Form::input('text', 'plan_name', null, ['class' => 'form-control','placeholder'=>'Plan Name']) !!}
                        <div id="plan_name_error" class="error-message">{{$errors->first('plan_name')}}</div>
                    </div> 
                    <?php
                    $plan_type = array(
                        'Monthly' => 'Monthly',
                        'Yearly' => 'Yearly',
                    );
                    ?>
                    <div class="form-group com_info">
                        <label>Plan Type </label>         
                        {!! Form::select('plan_type', $plan_type, null, ['placeholder' => '-Select-','class' => 'form-control comm_details']) !!}
                        <div id="plan_type_error" class="error-message">{{$errors->first('plan_type')}}</div>
                    </div>
                    <div class="form-group com_info">
                        <label>Corporate User </label>         
                        {!! Form::select('role_id', $roles, null, ['placeholder' => '-Select-','class' => 'form-control comm_details']) !!}
                        <div id="role_id_error" class="error-message">{{$errors->first('role_id')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Plan Price($)</label>                  
                        {!! Form::input('text', 'plan_price', null, ['class' => 'form-control','placeholder'=>'Plan Price']) !!}
                        <div id="plan_price_error" class="error-message">{{$errors->first('plan_price')}}</div>
                    </div> 

                    <?php
                    $discount_type = array(
                        'Fix' => 'Fix',
                        'Percentage' => 'Percentage',
                    );
                    ?>
                    <div class="form-group com_info">
                        <label>Discount Type </label>         
                        {!! Form::select('discount_type', $discount_type, null, ['placeholder' => '-Select-','class' => 'form-control']) !!}
                        <div id="discount_type_error" class="error-message">{{$errors->first('discount_type')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Discount Value</label>                  
                        {!! Form::input('text', 'discount_value', null, ['class' => 'form-control','placeholder'=>'Discount Value']) !!}
                        <div id="discount_value_error" class="error-message">{{$errors->first('discount_value')}}</div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Discount Start Date</label>                  
                            {!! Form::input('text', 'start_date', null, ['class' => 'form-control datepicker','placeholder'=>'Select Date']) !!}
                            <div id="start_date_error" class="error-message">{{$errors->first('start_date')}}</div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Discount End Date</label>                  
                            {!! Form::input('text', 'end_date', null, ['class' => 'form-control datepicker','placeholder'=>'Select Date']) !!}
                            <div id="end_date_error" class="error-message">{{$errors->first('end_date')}}</div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Display order on front</label>                  
                            {!! Form::input('text', 'display_order', null, ['class' => 'form-control']) !!}
                            <div id="display_order_error" class="error-message">{{$errors->first('display_order')}}</div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">No. of Image Upload Per Post (Minimum 5)</label>                  
                            {!! Form::input('text', 'number_image_upload', null, ['class' => 'form-control']) !!}
                            <div id="number_image_upload_error" class="error-message">{{$errors->first('number_image_upload')}}</div>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Features</label>                  
                    </div> 

                    <div class="row">
                        <div class="col-md-3">
                            <div class=" checkbox bike-category">
                                <label>
                                    {!! Form::checkbox('is_job_post', '1', null, ['id'=>'is_job_post']) !!} No. of Job Posts

                                </label>
                            </div>
                        </div> 
                        <div class="col-md-6 noOfJobsDiv">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3">
                            <div class=" checkbox bike-category">
                                <label>
                                    {!! Form::checkbox('is_featured_ads', '1', null, ['id'=>'is_featured_ads']) !!} Featured Ads

                                </label>
                            </div>
                        </div> 
                        <div class="col-md-6 isFeaturedAdsTypeDiv">

                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3">
                            <div class=" checkbox bike-category">
                                <label>
                                    {!! Form::checkbox('is_video', '1', null, ['id'=>'is_video']) !!} Video Upload

                                </label>
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-3">
                            <div class=" checkbox bike-category">
                                <label>
                                    {!! Form::checkbox('is_youtube', '1', null, ['id'=>'is_youtube']) !!} Youtube URL

                                </label>
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-3">
                            <div class=" checkbox bike-category">
                                <label>
                                    {!! Form::checkbox('is_premium_parent_cat', '1', null, ['id'=>'is_premium_parent_cat']) !!} Is Premium for parent category

                                </label>
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-3">
                            <div class=" checkbox bike-category">
                                <label>
                                    {!! Form::checkbox('is_premium_sub_cat', '1', null, ['id'=>'is_premium_sub_cat']) !!} Is Premium for sub category

                                </label>
                            </div>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <div class=" checkbox bike-category">
                            <label>
                                {!! Form::checkbox('status', '1', null) !!} Active
                            </label>
                        </div>


                    </div>
                    <!-- /.box-body -->


                    <div class="box-footer">

                        <button type="submit" class="btn btn-primary">Submit</button> 
                        <a style="margin-left: 5px;" class="btn btn-default btn-close" href='{!! url("admin/$viewName"); !!}'>Cancel</a>
                    </div>
                </div>
                {!! Form::close() !!}
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

    $(document).on('change', '#is_job_post', function () {
        if ($(this).is(':checked')) {
            $('.noOfJobsDiv').html("<div class='col-md-12'><input class='form-control' placeholder='No. of Job Posts (minimum 5)' type='text' name='job_post_count'><div id='job_post_count_error' class='error-message'></div></div>");
        } else {
            $('.noOfJobsDiv').html("");
        }

    });

    $(document).on('blur', 'input[name=job_post_count]', function () {
        if (parseInt($('input[name=job_post_count]').val()) < 5) {
            $('#job_post_count_error').text('Should be minimum 5');
            $('input[name=job_post_count]').val('');
        } else {
            $('#job_post_count_error').text('');
        }
        
        if (parseInt($('input[name=job_post_count]').val()) < parseInt($('input[name=featured_ads_count]').val())) {
            $('input[name=featured_ads_count]').val('');
        } 

    });

    $(document).on('blur', 'input[name=featured_ads_count]', function () {
        
        if(parseInt($('input[name=job_post_count]').val()) < parseInt($('input[name=featured_ads_count]').val())){
            $('#featured_ads_count_error').text('Should be less than or equal to No. of Job Posts');
            $('input[name=featured_ads_count]').val('');
        } else {
            $('#featured_ads_count_error').text('');
        }
    });
    $(document).on('change', '#is_featured_ads', function () {
        if ($(this).is(':checked')) {
            var featuredAdHtml = "<div class='col-md-6'>";
            featuredAdHtml += "<select class='form-control' name='featured_ads_type'><option value='Daily'>Daily</option>";
            featuredAdHtml += "<option value='Weekly'>Weekly</option>";
            //<option value='Monthly'>Monthly</option>
            featuredAdHtml += "</select><div id='featured_ads_type_error' class='error-message'></div>";
            featuredAdHtml += "</div><div class='col-md-6'>";
            featuredAdHtml += "<input class='form-control' placeholder = 'Featured Ads' type = 'text' name = 'featured_ads_count' ><div id='featured_ads_count_error' class='error-message'></div></div>";
            featuredAdHtml += "</div>";
            $('.isFeaturedAdsTypeDiv').html(featuredAdHtml);
        } else {
            $('.isFeaturedAdsTypeDiv').html("");
        }

    });

    $('body').on('focus', ".datepicker", function () {
        $(this).datepicker();
    });

</script>
@stop
