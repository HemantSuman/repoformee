@extends('front/layout/layout')
@section('content')

<input type="hidden" name="loginUserId" id="loginUserId" value="{{ Auth::guard('web')->user() ? Auth::guard('web')->user()->id : null }}">
<div id="middle" class="no-banner">  
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">{{ $result->title }}</li>
                </ol>
            </div>
        </div>
    </section>

    <div class="real-estate-main-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="backtosearch-bar">
                       <a class="backtosearch-btn" href="#"><i class="fa fa-caret-left"></i> Back to Search</a>
                       <div class="details-save-socail-sec">
                         <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i><span>Save this Job</span></a>
                         
                         <ul class="details-social-btn">
                           <li><a href="#" class='st_facebook_large' displayText='Facebook' ><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon"></a></li>
               <li><a href="#" class='st_twitter_large' displayText='Tweet'><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>
               <li><a href="#"  class='st_googleplus_large' displayText='Google +'><img src="{{ URL:: asset('/plugins/front/img/insta-icon.png')}}" alt="insta-icon"></a></li>
                         </ul>
                       </div>
                    </div>
                    <?php //dd($result);
					$companyname = '';
					$Aboutthejobrole='';
					$Aboutthecompany='';
					$Tobecomesuccessfulcandidate ='';
					$Thebenefityouwillget='';
					$HowtoApply ='';
					?>
                     @foreach($result->classified_attribute as $key => $value)
                        @if($value->show_list == 1)
                            @if($value->name == "company_name")
                                <?php $companyname = $value->attr_value;?>
                            @endif
                        @endif
                         @if($value->name == "About the job role")
                                <?php $Aboutthejobrole = $value->attr_value;?>
                         @endif
                         @if($value->name == "About the company")
                                <?php $Aboutthecompany = $value->attr_value;?>
                         @endif
                         @if($value->name == "Tobecomesuccessfulcandidate")
                                <?php $Tobecomesuccessfulcandidate = $value->attr_value;?>
                         @endif
                         @if($value->name == "The benefit you will get")
                                <?php $Thebenefityouwillget = $value->attr_value;?>
                         @endif
                         @if($value->name == "HowtoApply")
                                <?php $HowtoApply = $value->attr_value;?>
                         @endif
                         @if($value['name'] == "salary_range")
                               <?php $salary_range = explode(";", $value['attr_value']);?>
                         @endif
                     
                     @endforeach
                     
                    <div class="job-detail-main-title">
                     <h2 class="product-side-title">{{ $result->title }} <span>{{ $companyname }} | <a href="#">More jobs from this advertiser</a> </span>  </h2>
                    </div>
                </div>
            </div>  
            <div class="row">  
                <div class="col-sm-12 col-md-8 col-lg-7">
                   <div class="job-main-details">
                       <div class="job-detail-main-title">
                         <h2 class="product-side-title">{{ $result->title }} <span>{{ $companyname }}</span>  </h2>
                         <ul class="real-view-icon-list">
                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/view-icon.png')}}" alt="img"> <span>{{$result->count}}</span> </a></li>      
                        </ul>
                       </div>
                       <div class="job-main-des">
                        <?php if(isset($salary_range) and $salary_range != NULL){ ?>
                         <h3><?php echo '$'.$salary_range[0].' - $'.$salary_range[1];?> + Super</h3>
                         <?php } ?>
                         <?php if($Aboutthejobrole != ""){?>
                         <h4>About the job role:</h4>
                         <p><?php echo $Aboutthejobrole; ?></p>
                         <?php } ?>
                          <?php if($Aboutthecompany != ""){?>
                         <h4>About the company:</h4>
                         <p><?php echo $Aboutthecompany; ?></p>
                         <?php } ?>
                         <?php if($Tobecomesuccessfulcandidate != ''){?>
                         <h4>To become a successful candidate:</h4>
                         <p><?php echo $Tobecomesuccessfulcandidate; ?></p>
                         <?php } ?>
                         <?php if($Thebenefityouwillget != ''){?>
                         <h4>The benefit you will get:</h4>
                         <p><?php echo $Thebenefityouwillget; ?></p>
                         <?php }?>
                         <?php if($HowtoApply != ''){ ?>
                         <h4>How to Apply:</h4>
                         <p><?php echo $HowtoApply; ?></p>  
                         <?php } ?>                        
                       </div>
                   </div>
                </div> 
                <div class="col-sm-12 col-md-4 col-lg-4">
                   <div class="existing-user-side">
                        <div class="existing-user-box">
                         <div class="existing-user-drop dropdown">
                          <button class="btn btn-default dropdown-toggle" type="button" id="existing-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                             <img src="{{ URL:: asset('/plugins/front/img/exist-user.png')}}" alt="user-icon">  Existing User
                            <span class="caret"></span>
                          </button>
                          <?php /*?><ul class="dropdown-menu" aria-labelledby="existing-user">
                            <li><a href="#">User 1</a></li>
                            <li><a href="#">User 2</a></li>
                            <li><a href="#">User 3</a></li>
                          </ul><?php */?>
                        </div>
                        <div class="dont-user-account">Don’t have an account? <a href="#">Create now</a></div>
                        {!! Form::open(array('url' => '/user/loginforjob', 'class' => 'form', 'novalidate' => false)); !!}
                         <input type="hidden" value="private" name="seller_type" > 
                        <ul class="exist-user-form">
                          <li class="bottom-border"><input type="email" name="email" placeholder="Email" class="email">
                        <label class="error"></label></li>
                          <li><input type="password" name="password" placeholder="Password" class="password">
                        <label class="error"></label></li>
                          <li><input class="login" type="submit" value="Login">
                          <input type="hidden" name="jobid" value="<?php echo $result->id; ?>" />
                          </li>
                          <li class="pws-checkbox">  
                             <p>
                              <input type="checkbox" id="rmemberme" checked="checked" />
                              <label for="rmemberme">Remember Me</label>
                            </p>
                            <p>
                              <input type="checkbox" id="forgot-pass" />
                               
                             <a href="javascript:void(0)" id="forgotpassword"> <label for="forgot-pass">Forgot Password</label></a>
                            </p>
                          </li>

                        </ul>
                         {!! Form::close() !!}
                      </div>
                   </div>                  
                </div>        
            </div>    
        </div>
    </div>

</div>

@stop

@section('scripts')
<style>
</style>
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU"></script>
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">-->
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.skinNice.css') }}">
<!--<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<script src="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('plugins/front/js/post_classified.js') }}"></script>-->
<script src="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>


@stop


