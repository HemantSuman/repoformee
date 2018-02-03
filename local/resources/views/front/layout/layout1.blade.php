<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="{{ URL::asset('plugins/front/img/favicon.ico') }}" type="image/x-icon"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE"> 
        <meta charset="UTF-8">

        @include('front/element/head')
        <script>
            var root_url = "<?php echo Request::root(); ?>"
        </script>   
        <meta name="csrf-token" content="<?= csrf_token() ?>">
        
    </head>
    

<!--    @if(!(Auth::guard('web')->user())) 
    $class='logged-in';
    @else
    $class='';
    @endif-->
    <body class="@if(Auth::guard('web')->user())logged-in @else  @endif">  
   <header class="load_header">
            @include('front/element/header')    
        </header>

        @yield('content')    

        <footer>
            @include('front/element/footer')   
        </footer>


        <!--Script -->
        
    <!--Script -->
    <!-- jquery library -->
    <script src="{{ URL::asset('plugins/front/js/jquery.min.js') }}"></script>
    <!--<script src="http://192.168.100.242/suman/formee/plugins/admin/plugins/jQuery/jQuery-2.2.0.min.js"></script>-->
    <script src="{{ URL::asset('plugins/front/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/admin/plugins/jquery-validator/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/bootstrap/js/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/plugins/flexmenu/flexmenu.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/plugins/syncheight/syncHeight.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/plugins/ddslick/jquery.ddslick.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/plugins/masonry/masonry.pkgd.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/plugins/bxslider/jquery.bxslider.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/plugins/data-tables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/plugins/lightSlider/js/lightslider.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/plugins/multi-level-selectbox/js/jquery.dropdown.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/admin/js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/admin/js/notific8_custom.js') }}"></script>
    <script src="{{ URL::asset('plugins/front/js/functions.js') }}"></script>
<!--    <script src="{{ URL::asset('plugins/front/js/front-main-functions.js') }}"></script>-->
    <script src="{{ URL::asset('plugins/front/js/front-main-functions.js') }}"></script>
   
    <script type="text/javascript" src="{{  URL::asset('/plugins/front/js/custom.js') }}"></script>

<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
    
    

    </body>
</html>




<!-- login popup -->

{!! Form::open(
array('url' => '/user/login',
'class' => 'form',
'files' => true,
'id'=>'loginFrom',
)

);
!!}

<div class="modal fade" tabindex="-1" role="dialog" id="login-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ URL::asset('plugins/front/img/close-button.png') }}" class="" alt="close-buton">
            </button>
            <div class="modal-body">
                <div class="sign-in-sec">
                    <a class="facebook" href="<?php echo Request::root(); ?>/auth/facebook">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        Sign In With Facebook   
                    </a>
                    <a class="google" href="<?php echo Request::root(); ?>/auth/google">
                        <i class="fa fa-google" aria-hidden="true"></i>
                        Sign In With Google+
                    </a>
                </div>
                <div class="or">
                    <span>or</span>
                </div>
                <div class="signin-form">

                    <div class="form-group">
                        <?php
                        
                        if(!empty($frontcookie))
                        {
                            
                         $email=  $frontcookie['email']; 
                         $password=  $frontcookie['password']; 
                        }
                        else
                           $email=null; 
                           $password=null; 
                        ?>
                        {!!   Form::text('email', $email, $attributes = ['class' => 'form-control', 'placeholder' => 'Email']); !!}
                        
                    </div>
                    <div class="form-group">
                       
                        {!! Form::input('password', 'password',$password,$attributes = ['class' => 'form-control', 'placeholder' => 'Password']);!!}
           
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            {!! Form::checkbox('remember_token','',null, ['class' => 'm-checkbox']); !!} <label>Remember Me</label>
                            
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="javascript:void(0)" id="forgotpassword">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Sign In" class="submit-btn">
                    </div>
                    <em class="terms-condition">
                        By clicking on "Sign In", you agree to<br/>
                        the Formee Terms & Conditions and Privacy Policy.
                    </em>

                </div>
            </div>
            <div class="not-a-member">
                not a member? <a href="javascript:void(0)" id="signup">Register Now</a>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!} 
<!-- login popup -->

<!-- register popup -->
<div class="modal fade" tabindex="-1" role="dialog" id="register-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ URL::asset('plugins/front/img/close-button.png') }}" class="" alt="close-buton">
            </button>
            <div class="modal-body">
                <div class="sign-in-sec">
                    <a class="facebook" href="auth/facebook">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        Sign Up With Facebook   
                    </a>
                    <a class="google" href="auth/google">
                        <i class="fa fa-google" aria-hidden="true"></i>
                        Sign Up With Google+
                    </a>
                </div>
                <div class="or">
                    <span>or</span>
                </div>
                <div class="signin-form">
                    {!! Form::open(array("url" => "user-register", "role" => "form", 'class' => '', 'id' => 'registration-form')) !!}
                    <div class="form-group">
                        {!! Form::text('fname', null, array('placeholder' => 'First name', 'id' => 'u-rg-fn')) !!}
                        <label id="fname-error" class="error" for="fname"></label>
                    </div>
                    <div class="form-group">
                        {!! Form::text('lname', null, array('placeholder' => 'Last name', 'id' => 'u-rg-ln')) !!}
                        <label id="lname-error" class="error" for="lname"></label>
                    </div>
                    <div class="form-group">
                        {!! Form::email('email', null, array('placeholder' => 'Email', 'id' => 'u-rg-em')) !!}
                        <label id="email-error" class="error" for="email"></label>
                    </div>
                    <div class="form-group">
                        {!! Form::password('password', array('placeholder' => 'Password', 'id' => 'u-rg-ps')) !!}
                        <label id="password-error" class="error" for="password"></label>
                    </div>   
                    <div class="form-group">
                        {!! Form::password('password_confirmation', array('placeholder' => 'Confirm Password', 'id' => 'u-rg-cps')) !!}
                        <label id="cpassword-error" class="error" for="cpassword"></label>
                    </div>              
                    <div class="form-group hidesubmit">
                        <input type="submit" value="Register Now" class="submit-btn">
                    </div>
                    <em class="terms-condition">
                        By clicking on "Sign Up", you agree to<br/>
                        the Formee Terms & Conditions and Privacy Policy.
                    </em>
                    <div class="text-center">
                        <span><i class="fa fa-refresh fa-spin load-icon hide"></i></span>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login popup -->

<!-- Forget Password Popup -->
<div class="modal fade" tabindex="-1" role="dialog" id="forget-password-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ URL::asset('plugins/front/img/close-button.png') }}" class="" alt="close-buton">
            </button>
            <div class="modal-body">
                <div class="sign-in-sec text-center">
                    <h3>FORGOT PASSWORD</h3>
                </div>
                <br/>
                <div class="signin-form">
                {!! Form::open(array("url" => "forgot-password", "role" => "form", 'class' => '', 'id' => 'user-forgot-password-form')) !!}
                    <div class="form-group">
                        {!! Form::email('email', null, array('placeholder' => 'Enter your registered email', 'id' => 'u-fp-em')) !!}
                        <input type="submit" value="Submit" class="submit-btn">
                        <label id="fp-email-error" class="error" for="email"></label>
                    </div>
                    <div class="text-center">
                        <span><i class="fa fa-refresh fa-spin u-fp-load-icon hide"></i></span>
                    </div>
                {!! Form::close() !!}
                </div>
            </div>
            <div class="not-a-member">
                not a member? <a href="javascript:void(0)" id="signup">Register Now</a>
            </div>
        </div>
    </div>
</div>
<!-- Forget Password Popup -->
@yield('google_map_script')
 <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU?sensor=false"></script> 
<!-- popup script only -->
<script type="text/javascript">
    $("a.signinPostAdd").click(function () {
        //alert("call login popup");
        $('#login-modal').modal('show');
        $('#forget-password-modal').modal('hide');
    });
    $("#query-button1, .post-a-similar .post-a-similar_new").click(function () {
        //alert("call login popup");
        $('#login-modal').modal('show');
        $('#forget-password-modal').modal('hide');
    });
    $("a#signin").click(function () {
        //alert("call login popup");
        $('#login-modal').modal('show');
        $('#forget-password-modal').modal('hide');
    });
    $("a#signup").click(function () {
        $('#login-modal').modal('hide');
        $('#forget-password-modal').modal('hide');
        //alert("call login popup");
        setTimeout(function(){
            $('#register-modal').modal('show');
        }, 500);
    });
    $("a#forgotpassword").click(function () {
        $('#login-modal').modal('hide');
        //alert("call login popup");
        setTimeout(function(){
            $('#forget-password-modal').modal('show');
        }, 500);
    });

    //ajax for increase site visiter count[Unique]
    $.ajax({
        url: root_url + "/upd-vstr-cnt",
        data: {"_token": $('meta[name="csrf-token"]').attr('content')},
        method: "POST",
        cache: false,
        success: function (response) {
        }
    });
    
    //ajax for message Count
    $.ajax({
        url: root_url + "/user/messages/count_for_tabs",
        data: {"_token": $('meta[name="csrf-token"]').attr('content')},
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {
                console.log(response);
                $('.frontMsgCnt').text(response.totalRecordInbox);
                $('.unreadCount1').text(response.totalRecordInbox);
                //var total = parseInt(response.totalRecordInbox) + parseInt(response.totalRecordSent) + parseInt(response.totalRecordArchive);
                //$('.totalMsgCnt1').text(total);
            }
        }
    });
</script>

@yield('scripts')
@yield('scripts1')

</body>
</html>
