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
        Edit Registered User
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Add Admin User</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>
                {!! Form::model($user, array('action' => ["admin\UsersController@adminbusiness_update", $user->id],'class' => 'form-horizontal')) !!}

                <div class="box-body">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            {!! Form::text('name', $user->name ? $user->name : null, array('class' => 'form-control', 'placeholder' => 'name')) !!}

                            <div class="error-message">{{$errors->first('name')}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">

                            {!! Form::text('email', $user->email ? $user->email : null, array('class' => 'form-control', 'placeholder' => 'Email')) !!}
                            <div class="error-message">{{$errors->first('email')}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Mobile No.</label>
                        <div class="col-sm-10">

                            {!! Form::number('mobile_no', $user->mobile_no ? $user->mobile_no : null, array('class' => 'form-control', 'placeholder' => 'mobile_no','min'=>'0')) !!}
                            <div class="error-message">{{$errors->first('mobile_no')}}</div>
                        </div>
                    </div>
                    <?php
                    //dd(count($user->login_type));
                    ?>
                    @if(count($user->login_type)==0)
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                            <input type="password" name="password" value="<?php echo $user->password ? $user->password : null ?>" class="form-control" placeholder="password"/>
                            <div class="error-message">{{$errors->first('password')}}</div>
                        </div>
                    </div>
                    @endif

                    <!--                        <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                                <div class="col-sm-10">
                                                      {!! Form::checkbox('status', '1', $user->status ? true : false, array('class' => 'minimal')) !!}
                                                  
                                                </div>
                                            </div>-->

                </div>

                <div class="box-footer col-sm-offset-2"> 
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-default btn-close" href="{!! url('admin/business_user'); !!}">Cancel</a>
                </div>
                {!! Form::close() !!}

                <div class="box-body">



                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">PayPal Email</label>
                        <div class="col-sm-10">
                            {!! Form::text('paypal_email', $user->paypal_email ? $user->paypal_email : null, array('class' => 'form-control', 'placeholder' => 'paypal email' ,'disabled' => 'disabled')) !!}
                        </div>
                    </div>
                    <?php
                    $membership_plan = $user->membership_user->toArray();
                    if (isset($membership_plan) && count($membership_plan) > 0) {
                        $membership_plan_data = $membership_plan[0];
                        ?>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Membership Plan</label>
                            <div class="col-sm-10">
                                {!! Form::text('plan_name', $membership_plan_data['plan_name'] , array('class' => 'form-control', 'placeholder' => 'plan_name' ,'disabled' => 'disabled')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Membership Plan Type</label>
                            <div class="col-sm-10">
                                {!! Form::text('plan_type', $membership_plan_data['plan_type'] , array('class' => 'form-control', 'placeholder' => 'plan_type' ,'disabled' => 'disabled')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Membership Plan Price</label>
                            <div class="col-sm-10">
                                {!! Form::text('plan_price', $membership_plan_data['plan_price'] , array('class' => 'form-control', 'placeholder' => 'plan_price' ,'disabled' => 'disabled')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Plan Start Date</label>
                            <div class="col-sm-10">
                                {!! Form::text('start_date', $membership_plan_data['start_date'] , array('class' => 'form-control', 'placeholder' => 'start_date' ,'disabled' => 'disabled')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">PayPal Profile ID</label>
                            <div class="col-sm-10">
                                {!! Form::text('paypal_profile_id', $membership_plan_data['paypal_profile_id'] , array('class' => 'form-control', 'placeholder' => 'paypal_profile_id' ,'disabled' => 'disabled')) !!}
                            </div>
                        </div>


                        <?php
                    }
                    ?>
                    <?php if (isset($pp_profile_response['PROFILEID'])) { ?> 
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">PayPal Profile Status</label>
                            <div class="col-sm-10">
                                {!! Form::text('paypal_profile_status', $pp_profile_response['STATUS'] , array('class' => 'form-control', 'placeholder' => 'paypal_profile_status' ,'disabled' => 'disabled')) !!}
                            </div>
                        </div>
                        <?php if ($pp_profile_response['STATUS'] == 'ActiveProfile' || $pp_profile_response['STATUS'] == 'Active') { ?>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Profile Start Date</label>
                                <div class="col-sm-10">
                                    {!! Form::text('paypal_profile_start', $pp_profile_response['PROFILESTARTDATE'] , array('class' => 'form-control', 'placeholder' => 'paypal_profile_start' ,'disabled' => 'disabled')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Profile Next Billing Date</label>
                                <div class="col-sm-10">
                                    {!! Form::text('paypal_profile_next_bill', $pp_profile_response['NEXTBILLINGDATE'] , array('class' => 'form-control', 'placeholder' => 'paypal_profile_next_bill' ,'disabled' => 'disabled')) !!}
                                </div>
                            </div>

                            {!! Form::open(array("url" => "admin/cancel-pp-profile", "role" => "form", 'id' => 'update-pp-form', 'novalidate')) !!}
                            <p>If you want to cancel the subscription, click "cancel" button. </p>

                            <div class="box-footer col-sm-offset-2"> 

                                <input type="hidden" name="profileid" value="{{ $pp_profile_response['PROFILEID'] }}" class="user-latitude"/>

                                <input type="hidden" name="userid" value="{{ $user->id }}" class="user-latitude"/>

                                <button type="submit" name="cancel_pp" class="btn update-name-submit-btn" onclick="return confirm('Are you sure to Cancel the Subscription?')">Cancel</button>
                            </div>
                            {!! Form::close() !!}


                        <?php } ?>  
                    <?php } ?>  



                </div>


            </div>
        </div>
    </div>
</section>

@stop

