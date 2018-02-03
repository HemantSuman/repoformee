@extends('front/layout/layout')
@section('content')
<?php
$path = storage_path() . "/countries.json";
$json = json_decode(file_get_contents($path), true); 
//dd($json['country_Data']);
foreach($json['country_Data'] as $key=>$value)
{
   // dd($value);
  //  $country_code[]=$value['Code'];
//    $country_code[]= array(
//        $value['Code']=>$value['Code'],
//    );
    
     $country_code[$value['Code']]=$value['Code'];
}

?>
<div id="middle" class="no-banner">
    <div class="dashboard-banner">
        <div class="userImg">
            
            @if(!empty($user_details['image']))
            <img src="{{ URL::asset('upload_images/users/'.$user_details['id'].'/'.$user_details['image']) }}" alt="profile-img-new">
            
            @elseif(($user_details['avatar']))
            <img src="{{ $user_details['avatar'] }}" alt="profile-img-new">	
            @else
            <img src="{{ URL::asset('plugins/front/img/no_avatar.gif') }}" alt="profile-img-new">	
            @endif


        </div>
        <div class="userStates">
            <select class="" name="">
                <option value="">Online</option>
                <option value="">Offline</option>
                <option value="">Away</option>Away
            </select>
        </div>
        <div class="Changepic">
            {!! Form::open(array("role" => "form", 'id' => 'update-profile-img-form', 'files' => true, 'method' => 'POST')) !!}
            <input type="file" name="image" id="file2" class="filetype chng-prfl-pic-btn">
            <label for="file2">Change Photo</label>
            <p>Image must be in JPG or PNG format and under 5 mb.</p>
            {!! Form::close() !!}
        </div>
    </div>
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li><a href="javascript:void(0)">Profile</a></li>
                    <li class="active">Edit profile</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="dashboard-content">
        <div class="dashboarduserDetail">
            <div class="container">
                <div class="userName">
                    {{ Auth::guard('web')->user()->name }}
                </div>
                   
                <ul class="aboutUser">
                                @if(empty($total_viewer->total_views))
                    <li> 0 views</li>
                                @else
                    <li>{{ $total_viewer->total_views }} views</li>
                                @endif
                                 @if(!empty($user_total_classifieds))
                    <li>{{ $user_total_classifieds }} Ads foud</li> 
                                @else
                    <li> 0 Ads foud</li>
                     @endif
                    @if(!empty($user_details['city']))
                        <li> <span><img src="{{ URL:: asset('/plugins/front/img/locate-icon.png') }}" alt=""></span>{!! $user_details['city'] !!}</li>
                        @else
                                        <li> <span><img src="{{ URL:: asset('/plugins/front/img/locate-icon.png') }}" alt=""></span>N/A</li>
                    @endif
                                @if(!empty($user_details['created_at']))
                    <li><span><img src="{{ URL:: asset('/plugins/front/img/icons/calander-icon.png') }}" alt=""></span> {!! date("d-m-y",strtotime($user_details['created_at'])) !!}</li>
                                @endif
                </ul>
            </div>
        </div>
        <div class="container private-user-dashboard">
            <div class="row">
                <div class="col-sm-12">
                    @include('front/element/user_dashboard_menubar_private') 
                </div>

                <div class="col-sm-12">
                   <div class="dashboardData">
                     <h2>Edit Profile</h2>
           
                        <!-- <form class="" action="index.html" method="post"> -->
                        <div class="profileData">
                        <div class="profileblock">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="proicon">
                                            <a href="javascript:void(0)">
                                                <span><img src="{{ URL:: asset('/plugins/front/img/icons/red-user.png') }}" alt=""></span>
                                                <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="proData">
                                            <h3>Update Name</h3>
                                            <div class="proDatainner">
                                                {!! Form::open(array("url" => "user/update-profile", "role" => "form", 'id' => 'update-name-form', 'novalidate')) !!}
                                                
                                                
                                                
                                                <div class="row profileRow">
                                                    <div class="col-md-6 col-sm-6">
                                                        <input type="text" name="fname" placeholder="First Name" class="form-control user-fname" value="{!! $user_details['fname'] !!}">
                                                        <label class="error"></label>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <input type="text" name="lname" placeholder="Last Name" class="form-control user-lname" value="{!! $user_details['lname'] !!}">
                                                        <label class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-2 loading-div hide">
                                                        <img src="{{ URL:: asset('/plugins/front/img/icons/p2.gif') }}" alt="">
                                                    </div>
                                                    <div class="col-md-2 col-sm-3 col-xs-6 pull-right">
                                                        <input type="hidden" name="latitude" value="{!! $user_details['latitude'] !!}" class="user-latitude"/>
                                                        <input type="hidden" name="longitude" value="{!! $user_details['longitude'] !!}" class="user-longitude"/>
                                                        <button type="submit" name="button" class="btn update-name-submit-btn">Save</button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profileblock">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="proicon">
                                            <a href="javascript:void(0)">
                                                <span><img src="{{ URL:: asset('/plugins/front/img/icons/home-icon.png') }}" alt=""></span>
                                                <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="proData">
                                            <h3>Update Address</h3>
                                            <div class="proDatainner">
                                                {!! Form::open(array("url" => "user/update-profile", "role" => "form", 'id' => 'update-address-form', 'novalidate')) !!}
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <input type="text" name="location" placeholder="Street No. & Street Name" class="form-control user-current-location" value="{!! $user_details['location'] !!}">
                                                        <label class="error"></label>
                                                    </div>                                                    
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <input type="text" name="city" placeholder="City" class="form-control user-city city" value="{!! $user_details['city'] !!}">
                                                        <label class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <input type="text" name="state" placeholder="State " class="form-control user-state state" value="{!! $user_details['state'] !!}">
                                                        <label class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-6 col-sm-6">
                                                        <input type="text" name="country" placeholder="Country" class="form-control user-country country" value="{!! $user_details['country'] !!}">
                                                        <label class="error"></label>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <input type="text" name="pincode" placeholder="Zip Code" class="form-control user-pincode pincode" value="{!! $user_details['pincode'] !!}">
                                                        <label class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-2 loading-div hide">
                                                        <img src="{{ URL:: asset('/plugins/front/img/icons/p2.gif') }}" alt="">
                                                    </div>
                                                    <div class="col-md-2 col-sm-3 col-xs-6 pull-right">
                                                        <input type="hidden" name="latitude" value="{!! $user_details['latitude'] !!}" class="user-latitude"/>
                                                        <input type="hidden" name="longitude" value="{!! $user_details['longitude'] !!}" class="user-longitude"/>
                                                        <button type="button" name="button" class="btn update-address-submit-btn">Save</button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profileblock">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="proicon">
                                            <a href="javascript:void(0)">
                                                <span><img src="{{ URL:: asset('/plugins/front/img/icons/email-icon.png') }}" alt=""></span>
                                                <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="proData">
                                            <h3>Email Address</h3>
                                            <div class="proDatainner">
                                                {!! Form::open(array("url" => "user/update-profile", "role" => "form", 'id' => 'update-email-form', 'novalidate')) !!}
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <input type="email" name="current_email" value="{!! $user_details->email !!}" placeholder="Your current email address" class="form-control current_email" readonly>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <input type="email" name="new_email" value="" placeholder="New Email Address" class="form-control new_email">
                                                        <label class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <input type="email" name="confirm_new_email" value="" placeholder="Re-Enter Email address" class="form-control confirm_new_email">
                                                        <label class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-2 loading-div hide">
                                                        <img src="{{ URL:: asset('/plugins/front/img/icons/p2.gif') }}" alt="">
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-6 pull-right">
                                                        <button type="submit" name="button" class="btn">Save</button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profileblock">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="proicon">
                                            <a href="javascript:void(0)">
                                                <span><img src="{{ URL:: asset('/plugins/front/img/icons/lock-icon.png') }}" alt=""></span>
                                                <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="proData">
                                            <h3>Change Password</h3>
                                            <div class="proDatainner">
                                                {!! Form::open(array("url" => "user/update-profile", "role" => "form", 'id' => 'update-password-form', 'novalidate')) !!}

                                                <?php $isAbleToChngPswrd = ($user_details['login_type']) ? "disabled" : null; ?>
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <input type="password" name="current_password" placeholder="Enter Current Password" class="form-control current_password" <?php echo $isAbleToChngPswrd ?>>
                                                        <label class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <input type="password" name="new_password" placeholder="Enter new Password" class="form-control new_password" <?php echo $isAbleToChngPswrd ?>>
                                                        <label class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <input type="password" name="confirm_new_password" placeholder="Re-Enter new password" class="form-control confirm_new_password" <?php echo $isAbleToChngPswrd ?>>
                                                        <label class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-2 loading-div hide">
                                                        <img src="{{ URL:: asset('/plugins/front/img/icons/p2.gif') }}" alt="">
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-6 pull-right">
                                                        <button type="submit" name="button" class="btn">Save</button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profileblock">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="proicon">
                                            <a href="javascript:void(0)">
                                                <span><img src="{{ URL:: asset('/plugins/front/img/icons/phone.png') }}" alt=""></span>
                                                <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="proData">
                                            <h3>Mobile Number</h3>
                                            <div class="proDatainner">
                                                {!! Form::open(array("url" => "user/update_uniquemobile", "role" => "form", 'id' => 'send-otp-form', 'novalidate')) !!}
                                                <div class="row profileRow">
                                                    <div class="col-sm-4">
                                                        
                                                        {!! Form::select('country_code', $country_code, ($user_details['phonecode'])?$user_details['phonecode']:'',['id' => 'country_code','class' => 'country_code  form-control']) !!}
                                                        <label class="error"></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="mobile_no" placeholder="Enter Your Mobile Number" class="form-control" id="mobileno" value="{!! $user_details['mobile_no'] !!}">
                                                        <input type="hidden" name="user_id"  class="form-control" value="<?php echo $user_details['id'] ?>">
                                                        <label class="error"></label>
                                                    </div>

                                                </div>
                                                <!--                                                                                        <div data-widget data-app="6y2u8uzy4uzu2ufu6u5y"></div>-->
                                                <!--                                                                                        <div class="row profileRow">                                                                                                                                        <div class="col-md-12">                                                                                                                                                      <input type="text" name="verify_mobile" placeholder="Enter Verification code" class="form-control">                                                                                                                                                        <label class="error"></label>                                                                                                                                               </div>                                                                                                                                        </div>-->

                                                <div class="row profileRow">
                                                    <div class="col-md-2 loading-div hide">
                                                        <img src="{{ URL:: asset('/plugins/front/img/icons/p2.gif') }}" alt="">
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-6 pull-right">

                                                        <button type="submit" name="button" class="btn">verfiycode</button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profileblock">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="proicon">
                                            <a href="javascript:void(0)">
                                                <span><img src="{{ URL:: asset('/plugins/front/img/icons/email-icon1.png') }}" alt=""></span>
                                                <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="proData">
                                            <h3>Email Subscription</h3>
                                            <div class="proDatainner">
                                                <p>if u want to stap up to date with  the latest formee news you can manage your subscription here select the eamils you would like to receive.</p>

                                                {!! Form::open(array("url" => "user/update-subscription", "role" => "form", 'id' => 'update-subscription-form', 'novalidate')) !!}
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <div class="checkbox">
                                                            {!! Form::checkbox('is_notification_active', '1', $user_details->is_notification_active ? true : false, array('class' => 'm-checkbox subscription-checkbox', 'id' => 'subscription1')) !!}
                                                            <label for="subscription1">Add notifiction</label>
                                                            <p>(Receive updates on how ypur ads are performing and tips on how to help increase your chances of success)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <div class="checkbox">
                                                            {!! Form::checkbox('is_newsletter_active', '1', $user_details->is_newsletter_active ? true : false, array('class' => 'm-checkbox subscription-checkbox', 'id' => 'subscription2')) !!}
                                                            <label for="subscription2"> Marketing Newsletters</label>
                                                            <p>(keep up to date with latest news recommendation and competitons from formee)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <div class="checkbox">
                                                            {!! Form::checkbox('is_survey_active', '1', $user_details->is_survey_active ? true : false, array('class' => 'm-checkbox subscription-checkbox', 'id' => 'subscription3')) !!}
                                                            <label for="subscription3">Surveys</label>
                                                            <p>(Let us know what you think of formee)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row profileRow">
                                                    <div class="col-md-12">
                                                        <div class="checkbox">
                                                            {!! Form::checkbox('is_invites_active', '1', $user_details->is_invites_active ? true : false, array('class' => 'm-checkbox subscription-checkbox', 'id' => 'subscription4')) !!}
                                                            <label for="subscription4">Invites</label>
                                                            <p>(you may be invited to join us at formee event or focus group)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <!--  <div class="row">
                                    <div class="col-sm-12">
                                        <a href="#" class="profile-btn">Update Profile</a>
                                    </div>
                                </div> -->
                            </div>
                            
                            <div class="profileblock">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="proicon">
                                            <a href="javascript:void(0)">
                                                <span><img src="{{ URL:: asset('/plugins/front/img/icons/red-user.png') }}" alt=""></span>
                                                <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="proData">
                                            <h3>PayPal Profile</h3>
                                            <div class="proDatainner">
                                                {!! Form::open(array("url" => "user/update-pp-email", "role" => "form", 'id' => 'update-pp-email', 'novalidate')) !!}
                                                 <div class="row profileRow">
                                                    <div class="col-md-6 col-sm-6">
                                                      <input type="text" name="paypal_email" placeholder="Enter Your PayPal Email" class="form-control" id="paypal_email" value="{!! $user_details['paypal_email'] !!}">
                                                      
                                                      
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-6 pull-right">

                                                        <button type="submit" name="pp_email_submit" class="btn">Save</button>
                                                    </div>
                                                  </div>  
                                                
                                                 {!! Form::close() !!}
                                                
                                                
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <!-- </form> -->
          
                  </div>
                </div>
            </div>
        </div>
       
      
        
    </section>
</div>
<div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Please Enter OTP</h4>
            </div>
            <div class="modal-body otp-form">

                <input type="text" name="mobileotp" maxlength="10" class="otpinputcss" id="mobileotp"/>
                <button type="button" class="btn btn-primary" id="otpsubmit">Submit</button>
                <span id="errorotpsignup"></span>

            </div>
            <div class="modal-footer">
                <div id="countdown" style="float:left; width:148px;"></div>
                <button type="button" class="btn btn-primary" id="otpresend" disabled="disabled">Resend OTP</button>
                <button type="button" class="btn btn-primary" id="otpCall"  disabled="disabled">Call for OTP</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<!-- include footer -->
<script type="text/javascript">
    var latitute = 0;
    var longitude = 0;

    $(document).ready(function () {
        $(".profileblock").each(function () {
            var $col = $(this);
            $col.find(".proicon a").click(function () {
                $col.find(".proDatainner").slideToggle();
            })
        });
        $(document).on('click', '#otpresend', function (e) {

          var val = $('#mobileno').val();
          var countrycode = $(".country_code option:selected").text();
          
          if (val) {
              $.ajax({
                  type: "POST",
                  dataType: 'json',
                  url: root_url + '/user/enterotp',
                  //data: {mobile: val, type: 'sms'},
                  data: {mobile: val, countrycode:countrycode,type: 'sms', "_token": $('meta[name="csrf-token"]').attr('content')},
                  success: function (result)
                  {
                      //console.log(result);
                      if (result.status == 'SUCCESS')
                      {
                          $('#otpresend').prop('disabled', true);
                          $('#otpCall').prop('disabled', true);


                          var waittime = parseInt(result.retry_in) * 1000;
                          timeopt(parseInt(result.retry_in));
                          setTimeout(function () {

                              $('#otpresend').prop('disabled', false);
                              $('#otpCall').prop('disabled', false);
                              $('#countdown').hide();

                          }, waittime);
                      }

                  }
              });
          }

      });

      $(document).on('click', '#otpCall', function (e) {


          var val = $('#mobileno').val();
           var countrycode = $(".country_code option:selected").text();
          if (val) {
              $.ajax({
                  type: "POST",
                  dataType: 'json',
                 url: root_url + '/user/enterotp',
                 data: {mobile: val,countrycode:countrycode,type: 'sms', "_token": $('meta[name="csrf-token"]').attr('content')},
                  success: function (result)
                  {
                      //console.log(result);
                      if (result.status == 'SUCCESS')
                      {
                          $('#otpresend').prop('disabled', true);
                          $('#otpCall').prop('disabled', true);


                          timeopt(parseInt(result.retry_in));
                          var waittime = parseInt(result.retry_in) * 1000;
                          setTimeout(function () {

                              $('#otpresend').prop('disabled', false);
                              $('#otpCall').prop('disabled', false);
                              $('#countdown').hide();
                          }, waittime);
                      }

                  }
              });
          }
      });

        $(document).on("click", ".use-current-location-btn", function () {
            getLocation();
        })

        var autocomplete = new google.maps.places.Autocomplete($(".user-current-location")[0], {
            types: [],
            componentRestrictions: {country: "au"}});
        var componentForm = {
            //street_number: 'short_name',
            //route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            //country: 'long_name',
            postal_code: 'short_name'
        };
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            var place = autocomplete.getPlace();

            // $(".user-state, .usr-city, .usr-pcode, #usr-lat, #usr-lng").val('');
            $('.user-latitude').val(place.geometry.location.lat());
            $('.user-longitude').val(place.geometry.location.lng());
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (addressType == 'country') {
                    var state = place.address_components[i]['long_name'];
                    $('.user-country').val(state);
                }
                if (addressType == 'administrative_area_level_1') {
                    var state = place.address_components[i]['long_name'];
                    $('.user-state').val(state);
                }
                if (addressType == 'locality') {
                    var city = place.address_components[i]['long_name'];
                    $('.user-city').val(city);
                }
                if (addressType == 'postal_code') {
                    var gPostalCode = place.address_components[i]['short_name'];
                    $('.user-pincode').val(gPostalCode);
                }
            }
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, err);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function timeopt(timeval) {

            var countdownElement = $('#countdown'),
                    seconds = timeval,
                    second = 0,
                    interval;
            countdownElement.show();

            interval = setInterval(function () {

                countdownElement.html('Please wait for ' + (seconds - second) + ' sec');
                if (second >= seconds) {
                    clearInterval(interval);
                }

                second++;
            }, 1000);

        }

        function err(position) {
            latitute = 0;
            longitude = 0;
        }

        function showPosition(position) {
            var geocoder;
            geocoder = new google.maps.Geocoder();
            latitute = position.coords.latitude;
            console.log(latitute);
            longitude = position.coords.longitude;
            var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            geocoder.geocode(
                    {'latLng': latlng},
                    function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                $('.user-current-location').val(results[0].formatted_address);
                                console.log(results[0])

                                for (var i = 0; i < results[0].address_components.length; i++) {
                                    var addressType = results[0].address_components[i].types[0];
                                    if (addressType == 'country') {
                                        var state = results[0].address_components[i]['long_name'];
                                        $('.user-country').val(state);
                                    }
                                    if (addressType == 'administrative_area_level_1') {
                                        var state = results[0].address_components[i]['long_name'];
                                        $('.user-state').val(state);
                                    }
                                    if (addressType == 'locality') {
                                        var city = results[0].address_components[i]['long_name'];
                                        $('.user-city').val(city);
                                    }
                                    if (addressType == 'postal_code') {
                                        var gPostalCode = results[0].address_components[i]['short_name'];
                                        $('.user-pincode').val(gPostalCode);
                                    }

                                    $(".user-latitude").val(latitute);
                                    $(".user-longitude").val(longitude);
                                }
                            } else {
                                console.log("address not found");
                            }
                        } else {
                            console.log("Geocoder failed due to: " + status);
                        }
                    }
            );
        }

        $(document).on('submit', '#send-otp-form', function (a) {

            var self = this;
            a.preventDefault();

            var mobile = $("#mobileno").val();
            var countrycode = $(".country_code option:selected").text();
            var mobwihcode = countrycode + mobile;
            //alert(mobwihcode);
            $.ajax({
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: "json",
                method: "POST",
                cache: false,
                success: function (data) {
                    if (data == 0) // error
                    {
                        Notify.showNotification('Mobile number already in use', "error");
                        //$('#UserMobile').after('<span class="ValidationErrors">Mobile number already in use.</span>');
                    } else
                    {
                        // call OTP Function then open model
                        //enterotp($("#mobileno").val());
                        enterotp(mobile,countrycode);
                        $('#otpModal').modal('show');

                        $(document).on('click', '#otpsubmit', function (e) {
                            e.preventDefault();

                            var mobile = $("#mobileno").val();
                            var mobileotp = $("#mobileotp").val();

                            if (mobileotp == '') {
                                $('#errorotpsignup').html('<br/><span class="ValidationErrors">Please enter valid OTP.</span>');
                                return false;
                            } else
                            {
                                $.ajax({
                                    type: "POST",
                                    dataType: 'json',
                                    url: root_url + '/user/checkotp',
                                    data: {mobile: mobile,countrycode:countrycode, mobileotp: mobileotp, "_token": $('meta[name="csrf-token"]').attr('content')},
                                    success: function (data) {
                                       
                                        // alert(data);
                                        console.log(data);
                                       // alert('hii'+data);
                                        if (data.status) // error
                                        {
                                            $('.close').click();
                                           Notify.showNotification('Mobile number update successfully', "success");
                                           // location.reload();
                                        } else
                                        {
                                             Notify.showNotification('Please enter valid OTP', "error");
   //alert("hello");
                                            //self.submit();

                                        }

                                    }
                                })

                            }
                        });

                    }

                }
            })

            return false;
        });

        function enterotp(val,countrycode) {

            if (val != '') {

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: root_url + '/user/enterotp',
                    //url: 'user/enterotp',

                    data: {mobile: val,countrycode:countrycode, type: 'sms', "_token": $('meta[name="csrf-token"]').attr('content')},
                    success: function (result)
                    {
                        //alert(result);
                        if (result.status == 'SUCCESS') {
                            var waittime = parseInt(result.retry_in) * 1000;
                            timeopt(parseInt(result.retry_in));
                            setTimeout(function () {

                                $('#otpresend').prop('disabled', false);
                                $('#otpCall').prop('disabled', false);
                                $('#countdown').hide();
                            }, waittime);
                        }
                    }
                });
            }

        }
    })
</script>
@stop