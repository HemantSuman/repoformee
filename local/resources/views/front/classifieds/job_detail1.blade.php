@extends('front/layout/layout')
@section('content')

<div id="middle" class="no-banner">  
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">Post an Ad</li>
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
                           <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon"></a></li>
                           <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>
                           <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/insta-icon.png')}}" alt="insta-icon"></a></li>
                         </ul>
                       </div>
                    </div>
                    <div class="job-detail-main-title">
                     <h2 class="product-side-title">Assistant Accountant <span>Hays Accountancy & Finance | <a href="#">More jobs from this advertiser</a> </span>  </h2>
                    </div>
                </div>
            </div>  
            <div class="row">  
                <div class="col-sm-12 col-md-8 col-lg-7">
                   <div class="job-main-details">
                       <div class="job-detail-main-title">
                         <h2 class="product-side-title">Assistant Accountant <span>Hays Accountancy & Finance</span>  </h2>
                         <ul class="real-view-icon-list">
                               <li><a href="#"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/view-icon.png" alt="img"> <span>20</span> </a></li>      
                        </ul>
                       </div>
                       <div class="job-main-des">
                         <h3>$40,000 - $50,000 + Super</h3>
                         <h4>About the job role:</h4>
                         <p>You will join a medium sized team and carry out a wide range of accounting and administration duties that include accounts payable, accounts receivable, payroll, data entry and general administrative tasks for the branch.</p>
                         <h4>About the company:</h4>
                         <p>Our client is an established construction group build on hard work, quality products and service. They are a true leader and have proven significant market share within the South East Queensland region, hence their need for additional support.</p>
                         <h4>To become a successful candidate:</h4>
                         <p>As this role is varied and supports a number of departments you possess a can do attitude and helpful positive demeanour. Your previous experience in a similar and recent role will be advantageous and you must be immediately available to commence a temporary assignment.</p>
                         <p>You will be extremely organised, detail orientated and have working knowledge of Excel.</p>
                         <h4>The benefit you will get:</h4>
                         <p>You will get the opportunity to join and work within a friendly and busy team environment whilst getting paid an attractive hourly rate by Hays Recruitment.</p>
                         <h4>How to Apply:</h4>
                         <p>If you are interested in this role, click ‘apply’ to forward an up-to-date copy of your CV, or call Alannah Kubacki - Accountancy and Finance Division on 07 5571 0751</p>                        
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
                          <ul class="dropdown-menu" aria-labelledby="existing-user">
                            <li><a href="#">User 1</a></li>
                            <li><a href="#">User 2</a></li>
                            <li><a href="#">User 3</a></li>
                          </ul>
                        </div>
                        <div class="dont-user-account">Don’t have an account? <a href="#">Create now</a></div>
                        <ul class="exist-user-form">
                          <li class="bottom-border"><input type="text" placeholder="Email"></li>
                          <li><input type="password" placeholder="Password"></li>
                          <li><input class="login" type="submit" value="Login"></li>
                          <li class="pws-checkbox">  
                             <p>
                              <input type="checkbox" id="rmemberme" checked="checked" />
                              <label for="rmemberme">Remember Me</label>
                            </p>
                            <p>
                              <input type="checkbox" id="forgot-pass" />
                              <label for="forgot-pass">Forgot Password</label>
                            </p>
                          </li>

                        </ul>
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


