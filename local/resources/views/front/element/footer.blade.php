<!-- footer -->

<div id="footer-top">
    <div class="container">
        <div class="social-media">
            <ul>
                <li class="connecttxt"><h3>Connect with</h3><img src="{{ URL::asset('/plugins/front/img/footer-logo.png') }}"></li>
                <li class="facebook"><a href="{{ Redis::get('social-facebook-page-url') }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li class="googleplus"><a href="{{ Redis::get('social-google-plus-page-url') }}" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                <li class="twitter"><a href="{{ Redis::get('social-twitter-page-url') }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li class="youTube"><a href="javascript:void(0)"><i class="fa fa-youtube"></i></a></li>
            </ul>
        </div>

    </div>
</div>
<div id="footer-middle">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="foo-inner-col">
                    <h4>Categories </h4>
                    <?php
                    //dd(count($footerCategories->toarray()));
                    if (count($footerCategories->toarray()) > 2) {


                        list($firstColCat, $secondColCat) = array_chunk($footerCategories->toarray(), ceil(count($footerCategories) / 2));
                        ?>
                        <div class="col-xs-6">
                            @if(!empty($firstColCat))
                            <ul>
                                @foreach($firstColCat as $firstColCatKey => $firstColCatVal)
                                <li class="child-care">
                                    <?php
                                    $communitiesInfoRedirectUrl = ($firstColCatVal['belong_to_community'] == 0 && $firstColCatVal['show_on_info_area'] == 0) ? "classified-list" : "classified_list";
                                    $encodetitlef = preg_replace('/[^A-Za-z0-9-]+/', '-', $firstColCatVal['name']);
                                    ?>
                                    <a href='{{ url("/$communitiesInfoRedirectUrl/$encodetitlef/$firstColCatVal[id]") }}'>{{ $firstColCatVal['name'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <div class="col-xs-6">
                            @if(!empty($firstColCat))
                            <ul>
                                @foreach($secondColCat as $secondColCatKey => $secondColCatVal)
                                <li class="child-care">
                                    <?php
                                    $encodetitles = preg_replace('/[^A-Za-z0-9-]+/', '-', $secondColCatVal['name']);
                                    $communitiesInfoRedirectUrl = ($secondColCatVal['belong_to_community'] == 0 && $secondColCatVal['show_on_info_area'] == 0) ? "classified-list" : "classified_list";
                                    ?>
                                    <a href='{{ url("/$communitiesInfoRedirectUrl/$encodetitles/$secondColCatVal[id]") }}'>{{ $secondColCatVal['name'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
<?php } ?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="foo-inner-col">
                    <div class="col-sm-6">
                        <h4>Help Center </h4>
                        <ul>
                            <li class="about-us"><a href="{{url('pages/About-Us')}}">About US</a></li>
                            <li class="safety-tips"><a href="{{url('pages/Safety-Tips')}}">Safety Tips</a></li>
                            <li class="contact-us"><a href="{{url('pages/Contact-Us')}}">Contact Us</a></li>
                            <li class="faq"><a href="{{url('/faq')}}">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <h4>Legal information</h4>
                        <ul>
                            <li class="terms-of-use"><a href="{{url('pages/Terms-of-Use')}}">Terms of Use</a></li>
                            <li class="privacy-policy"><a href="{{url('pages/Privacy-Policy')}}">Privacy Policy</a></li>
                            <li class="legal-notice"><a href="{{url('pages/T&C-and-Legal-Notices')}}">T&C and Legal Notices</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="foo-inner-col">
                    <h4>Newsletter</h4>
                    <div class="newsletter">
                        Stay up to date with our latest news releases by signing up to our newsletter.
                        {!! Form::open(array("url" => "subscribe", "role" => "form", 'class' => '', 'id' => 'ns-sb-frm', 'novalidate')) !!}
                        <button type="submit" class="sendmailer"></button>
                        <input type="email" placeholder="Your Email" id="newsletter_mail">
                        {!! Form::close() !!}
                    </div>
                    <div class="text-center ns-processing-block hide">
                        <span><i class="fa fa-refresh fa-spin"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="footer-bottom">
    <div class="container">
        Copyright 2016 © <a href="javscript:void(0)">Formee.com.</a>
    </div>
</div>






<!-- login popup -->
<div class="modal fade" tabindex="-1" role="dialog" id="login-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{  URL::asset('/plugins/front/img/icons/close-btn.png') }}" >
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
                    {!! Form::open(array('url' => '/user/login', 'class' => 'form','id' => 'login-form', 'novalidate' => false)); !!}
                    <div class="form-group">
                        <input type="radio" value="private" name="seller_type" > Private
                        <input type="radio" value="business" class="seller_type" name="seller_type" > Business
                        <label class="error"></label>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="email">
                        <label class="error"></label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="password">
                        <label class="error"></label>
                    </div>
                    <div class="text-center user-login-prcs-dv hide">
                        <span class="text-center"><i class="fa fa-refresh fa-spin"></i></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Sign In" class="submit-btn">
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <a href="javascript:void(0)" id="forgotpassword">Forgot Password?</a>
                            <p>
                                By clicking on "Sign In", you agree to
                                the Formee <a href="{{url('pages/Terms-of-Use')}}">Terms & Conditions</a> and <a href="{{url('pages/Privacy-Policy')}}">Privacy Policy."</a>
                            </p>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</div>
<!-- login popup -->

<!-- register popup -->
<div class="modal fade" tabindex="-1" role="dialog" id="register-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{  URL::asset('/plugins/front/img/icons/close-btn.png') }}" alt="close-buton">
            </button>
            <div class="modal-body">
                <div class="sign-in-sec">
                    <a class="facebook" href="<?php echo Request::root(); ?>/auth/facebook">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        Sign Up With Facebook
                    </a>
                    <a class="google" href="<?php echo Request::root(); ?>/auth/google">
                        <i class="fa fa-google" aria-hidden="true"></i>
                        Sign Up With Google+
                    </a>
                </div>
                <div class="or">
                    <span>or</span>
                </div>
                <div class="signin-form">
                    {!! Form::open(array("url" => "user-register", "role" => "form", 'id' => 'registration-form', 'novalidate' => false)) !!}

                    <div class="form-group">
                        <input type="radio" value="private" name="seller_type" > Private
                        <input type="radio" value="business" class="seller_type" name="seller_type" > Business
                        <label class="error"></label>
                    </div>
<!--                    <div class="form-group">
                        <input type="text" name="fname" placeholder="First name" class="fname">
                        <label class="error"></label>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lname" placeholder="Last name" class="lname">
                        <label class="error"></label>
                    </div>-->
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="email">
                        <label class="error"></label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="password">
                        <label class="error"></label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="cpassword" placeholder="Confirm Password" class="cpassword">
                        <label class="error"></label>
                    </div>
                    <div class="text-center user-reg-prcs-dv hide">
                        <span class="text-center"><i class="fa fa-refresh fa-spin"></i></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Sign UP" class="submit-btn">
                    </div>
                    <div class="form-group">
                        <p>
                            By clicking on "Sign Up", you agree to
                            the Formee <a href="{{url('pages/Terms-of-Use')}}">Terms & Conditions</a> and <a href="{{url('pages/Privacy-Policy')}}">Privacy Policy."</a>
                        </p>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login popup -->


<!-- register popup -->
<div class="modal fade" tabindex="-1" role="dialog" id="query-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{  URL::asset('/plugins/front/img/icons/close-btn.png') }}" alt="close-buton">
            </button>
            <div class="modal-header text-center"> <h4 class="modal-title">Send Message</h4> </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <textarea class="form-control" rows="10" placeholder="Send us a message..."></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="" value="Send Message" class="btn btn-green">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- login popup -->

@section('scripts')

<script type="text/javascript">



</script>