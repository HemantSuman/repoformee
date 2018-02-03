
<div id="middle" class="detail-middle subscription-middle"> 
    <!-- breadcrumb section -->
    <div class="subscription-banner"><img src="{{ URL::asset('/plugins/front/img/banner-2.jpg') }}" alt="logo"></div>
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="javascript:void(0);" class="memPlanBreadcrumb">Membership Plans</a></li>
                    <li class="active">Become a Member</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="pageHeading pageMain-Heading">Business Central</div>
                <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="selected-pkg">
                            <div class="selected-pkg-head">Your Selected Package</div>
                            <div class="selected-content">
                                <div class="pkg-categ-name">{{$membership_plan->membership_plan_roles->name}}</div>
                                <div class="pkg-categ-name"><div class="subscription-top">
                                        <div class="subscription-categ">{{$membership_plan->plan_name}}</div>
                                        <div class="subscription-cost">${{$membership_plan->plan_price}}/{{ ($membership_plan->plan_type == 'Yearly')? 'year' : 'month' }}</div>

                                        <div class="subscription-desc"> <div class="subscription-desc1">What you'll get with 
                                                your subscription</div> 
                                            {{$membership_plan['job_post_count']}} Job Posts<br />
                                            {{$membership_plan['featured_ads_count']}} Featured Ads<br />

                                            @if($membership_plan['is_video'])
                                            Video Upload<br />
                                            @endif

                                            @if($membership_plan['is_youtube'])
                                            Youtube URL<br />
                                            @endif
                                        </div>
                                    </div></div>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-5 col-sm-7 col-xs-12">
                        <div class="page-form">
                            <div class="pageHeading">Become a Member</div>
                            <p class="getmember-text">Get access to the best, most awesome things on the internet. Membership is FREE and we accept new members daily. </p>
                            <input type="hidden" id="stateCode" name="stateCode" value="{{json_encode($stateCode)}}">

                            {!! Form::open(array("url" => "/membership_plans/create", "role" => "form", 'files' => true, "id"=>"memberShipForm")) !!}
                            <input type="hidden" value="{{$membership_plan->id}}" name="plan_id" />  
                            <div class="form-group">
                                <label for="email">First Name</label>
                                <div class="field-col">
                                    {!! Form::text('fname', Auth::guard('web')->user()->fname, ['class' => 'form-control']) !!}
                                    <label class="errorMsg" id="fname_error"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Last Name</label>
                                <div class="field-col">
                                    {!! Form::text('lname', Auth::guard('web')->user()->lname, ['class' => 'form-control']) !!}
                                    <label class="errorMsg" id="lname_error"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Email Address</label>
                                <div class="field-col">
                                    {!! Form::text('email', Auth::guard('web')->user()->email, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                                    <label class="errorMsg" id="email_error"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Company Name</label>
                                <div class="field-col">
                                    {!! Form::text('business_name', Auth::guard('web')->user()->business_name, ['class' => 'form-control', 'id' => 'business_name']) !!}
                                    <label class="errorMsg" id="business_name_error"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Address</label>
                                <div class="field-col">
                                    {!! Form::text('location', Auth::guard('web')->user()->business_location, ['class' => 'form-control', 'id' => 'location']) !!}
                                    <label class="errorMsg" id="location_error"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Postcode</label>
                                <div class="field-col">
                                    {!! Form::text('city_postal', Auth::guard('web')->user()->business_pincode, ['class' => 'form-control', 'id' => 'city_postal', 'disabled' => 'disabled']) !!}
                                    <label class="errorMsg" id="city_postal_error"></label>
                                </div>
                            </div>

                            <div class="form-group email-safe">Your e-mail address is safe with us</div>
                            <input type="hidden" id="lat" name="lat" value="{{Auth::guard('web')->user()->business_lat}}">
                            <input type="hidden" id="lng" name="lng" value="{{Auth::guard('web')->user()->business_lng}}">
                            <input type="hidden" id="statevalue" name="statevalue" value="{{Auth::guard('web')->user()->business_state_id}}">
                            <input type="hidden" id="subregion_id" name="subregion_id" value="{{Auth::guard('web')->user()->business_city_id}}">
                            <input type="hidden" id="pincode" name="pincode" value="{{Auth::guard('web')->user()->business_pincode}}">
                            <button type="submit" class="pinkButton">Request Membership</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@section('scripts') 
<script type="text/javascript"></script> 
@stop