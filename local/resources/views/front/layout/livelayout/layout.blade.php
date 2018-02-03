<?php
$action = app('request')->route()->getAction();
$controller = class_basename($action['controller']);
list($controller, $action) = explode('@', $controller);
?>
<!doctype html>
<html>
    <head>
        <link rel="shortcut icon" href="{{ URL::asset('plugins/front/img/faviconnew.png') }}" type="image/x-icon"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
        <meta charset="UTF-8">
        <meta name="csrf-token" content="<?= csrf_token() ?>">
        <title>formee</title>
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        @include('front/element/head')
        <script>
            var root_url = "<?php echo Request::root(); ?>"
        </script>
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-99920681-1', 'auto');
  ga('send', 'pageview');

</script>
       <style>
           .alert-done{ background-color: #5cb85c !important} 
            .alert-minimalist {
                background-color: #dff0d8;
                border-color: #d6e9c6;
                border-radius: 3px;
                color: #3c763d;
                padding: 10px;
            } 
            .alert-minimalist > [data-notify="icon"] {
                height: 50px;
                margin-right: 12px;
            }
            .alert-minimalist > [data-notify="title"] {
                color: rgb(51, 51, 51);
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }
            .alert-minimalist > [data-notify="message"] {
                font-size: 80%;
            }
        </style>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/bootstrap-notify/js/bootstrap-notify.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/bootstrap-notify/js/bootstrap-notify-settings.js') }}"></script>
<!--        <script type="text/javascript" src="{{  URL::asset('/plugins/admin/js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>-->
<!--        <script type="text/javascript" src="{{  URL::asset('/plugins/admin/js/notific8_custom.js') }}"></script> -->
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/js/custom.js') }}"></script>

<!--         <script type="text/javascript" src="{{  URL::asset('/plugins/front/js/front-main-functions.js') }}"></script>-->
    </head>
    <body class="<?php
    if ((Auth::guard('web')->user())) {
        echo "logged-in";
    }
    ?>">
        <input type="hidden" name="notification-msg" class="noti-msg" value="<?php echo Session::get('message'); ?>" noti-type="<?php echo Session::get('type'); ?>">
        <header>
            @if($controller == "ClassifiedController" && $action == "get_searchresult")
            @include('front/element/listing_header',['abc' => $data2])
            @else
            @include('front/element/header')
            @endif
        </header>

        @yield('content')    

        <footer>
            <!-- include footer -->
            @include('/front/element/footer')
        </footer>


        <script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU?sensor=false"></script>
        <!--Script -->
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/bootstrap/js/bootstrap.min.js') }}"></script>

        <script src="{{ URL::asset('plugins/admin/plugins/jquery-validator/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/bootstrap/js/jquery.bootstrap.wizard.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/flexmenu/flexmenu.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/syncheight/syncHeight.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/ddslick/jquery.ddslick.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/masonry/masonry.pkgd.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/bxslider/jquery.bxslider.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/front/plugins/data-tables/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/lightSlider/js/lightslider.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/multi-level-selectbox/js/jquery.dropdown.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/CustomFile/jquery.filer.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/fileuploader/js/custom.js') }}"></script>
<!--        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/CustomFile/custom.js') }}"></script>-->
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/mCustomScrollbar/jquery.mCustomScrollbar.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/tableheaderFixed/tableHeadFixer.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/tableheaderFixed/tableHeadFixer.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/colorpicker/bootstrap-colorpicker.js') }}"></script>
        <script type="text/javascript" src="{{  URL::asset('/plugins/front/plugins/html5_lightbox/html5lightbox.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>


        <script type="text/javascript" src="{{  URL::asset('/plugins/front/js/functions.js') }}"></script>

        <script src="{{ URL::asset('plugins/admin/plugins/wickedpicker/dist/wickedpicker.min.js') }}"></script>

        <script src="//js.pusher.com/4.0/pusher.min.js"></script>

        <!-- Forget Password Popup -->
        <div class="modal fade" tabindex="-1" role="dialog" id="forget-password-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ URL::asset('plugins/front/img/icons/close-btn.png') }}" class="" alt="close-buton">
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

                                <label id="fp-email-error" class="error" for="email"></label>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Submit" class="submit-btn">
                            </div>
                            <div class="text-center">
                                <span><i class="fa fa-refresh fa-spin u-fp-load-icon hide"></i></span>
                            </div>
                            {!! Form::close() !!}
                            <div class="not-a-member text-center">
                                not a member? <a href="javascript:void(0)" id="signup">Register Now</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Forget Password Popup -->
        @yield('scripts')

        <script type="text/javascript">
            $(document).ready(function () {
            if ($(".noti-msg").val()) {
            setTimeout(function () {
            Notify.showNotification($(".noti-msg").val(), $(".noti-msg").attr('noti-type'))
            }, 2000);
            }
            $("a.signinPostAdd").click(function () {
            //alert("call login popup");
            $('#login-modal').modal('show');
            $('#forget-password-modal').modal('hide');
            });
            $("a#signin").click(function () {
            //alert("call login popup");
            $('#login-modal').modal('show');
            });
            $("a#signup").click(function () {
            $('#register-modal').modal('show');
            });
            $("#login-modal a#signup").click(function () {
            $('#login-modal').modal('hide');
            setTimeout(function () {
            $('#register-modal').modal('show');
            }, 500);
            });
            $("a#forgotpassword").click(function () {
            $('#login-modal').modal('hide');
            //alert("call login popup");
            setTimeout(function () {
            $('#forget-password-modal').modal('show');
            }, 500);
            });
            })
<?php
if (isset(Auth::guard("web")->user()->id)) {
    ?>
                var loginid = '{!! Auth::guard("web")->user()->id !!}';
                if (loginid)
                { 
                    
                var socket = io.connect('http://27.54.94.82:8089');
                //                    socket.on('connect', function () {
                //                        socket.emit('join', {id: 'user_id'+loginid});
                //                    });

                socket.emit('join', {id: 'user_' + loginid});
                socket.on('message', function (data) {
                
                console.log(data);
                
                if(data.s_id =='0')
                {
                 //Notify.showNotification(data.msg, "success")  
                 
                  $.notify({
                //icon: 'https://randomuser.me/api/portraits/med/men/77.jpg',
                //icon: data.image,
                    //    title: data.name,
                        message: data.msg
                }, { 
                    allow_dismiss: true,
                type: 'minimalist',
                        delay: 7000,
                        icon_type: 'image',
                        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                        //'<img data-notify="icon" class="img-circle pull-left">' +
                        //'<span data-notify="title">{1}</span>' +
                        '<span data-notify="message">{2}</span>' +
                        '</div>',
                        placement: {
                        from: "bottom",
                                align: "right"
                        },
                        animate: {
                        enter: 'animated bounceInRight',
                                exit: 'animated bounceOutRight'
                        }
                }); 
                } 
                else
                {
                 $.notify({
                //icon: 'https://randomuser.me/api/portraits/med/men/77.jpg',
                icon: data.image,
                        title: data.name,
                        message: data.msg
                }, {
                    allow_dismiss: true,
                type: 'minimalist',
                        delay: 7000,
                        icon_type: 'image',
                        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                        '<img data-notify="icon" class="img-circle pull-left">' +
                        '<span data-notify="title">{1}</span>' +
                        '<span data-notify="message">{2}</span>' +
                        '</div>',
                        placement: {
                        from: "bottom",
                                align: "right"
                        },
                        animate: {
                        enter: 'animated bounceInRight',
                                exit: 'animated bounceOutRight'
                        }
                });   
                }
                
                //  Notify.showNotification(data.msg, "error")

                });
                $(".send-msg").click(function (e) {
                e.preventDefault();
                var token = $('meta[name="csrf-token"]').attr('content');
                var s_id = loginid;
                var r_id = $('.receiver_id').val();
                var msg = $('.msgTextBox').val();
                var classified_id = $('.classified_id').val();
                if (msg != '') {
                $.ajax({
                type: "POST",
                        url: '{!! URL::to("chkchat") !!}',
                        dataType: "json",
                        data: {'_token': token, 'msg': msg, 'r_id': r_id, 's_id': s_id, classified_id: classified_id},
                        success: function (data) {
                        console.log(data);
                        $(".msg").val('');
                        }
                });
                } else {
                alert("Please Add Message.");
                }
                });
                }

<?php } ?>

        </script>

    </body>
</html>

