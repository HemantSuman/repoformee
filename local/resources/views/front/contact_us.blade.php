@extends('front/layout/layout')
@section('content')
<div id="middle">

    <!-- main banner section -->
    <section>
        <div class="inner-page-banner">
            <img src="{!! asset('plugins/front/img/inner-page-banner.jpg') !!}" alt="banner-img" width="100%">
        </div>
    </section>

    <!-- breadcrumb section -->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                  <li><a href="javascript:void(0)">Home</a></li>              
                  <li class="active">{{$result->title}}</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- conatct page section -->
    {!! Form::open(array("role" => "form", 'files' => true, 'class' => 'contact-us-form', 'novalidate')) !!}
    <!-- <section class="contact-page">
        <div id="email-us-section" >
            <div class="container">
                <div class="email-us">
                    <div class="title">
                        To Email Us, Select a Topic
                    </div>
                    <div class="select-topic">
                        <label>Select a topic</label>
                        <select name="topic">
                            <option>Contact</option>
                            <option>Share your feedback</option>
                        </select> 
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="static-page-content">

        <div class="container">
            <div class="contactus">
                <div class="contactTop">
                            <h1 class="title">Contact Us</h1>
                            <!-- <div class="search pull-right">
                                <input name="" value="" placeholder="search here..." class="searchinput" type="search">
                                <input name="" value="" class="searchbt" type="submit">
                            </div> -->
                </div>
                <div class="contactForm">
                    <form class="" action="index.html" method="post">
                        <div class="row form-row">
                            <div class="col-sm-12">
                                    <div class="subheading">
                                        To Email Us, Select a topic
                                    </div>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-sm-2">
                                <label for="">Topic <span>*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <!-- <select class="form-control" name="">
                                    <option value="">Contact</option>
                                    <option value="">Contact</option>
                                    <option value="">Contact</option>
                                    <option value="">Contact</option>
                                </select> -->
                                <select name="topic">
                                    <option>Contact</option>
                                    <option>Share your feedback</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="row form-row">
                            <div class="col-sm-12">
                                    <div class="subheading">
                                        To Email Us, Select a topic
                                    </div>
                            </div>
                        </div> -->
                        <div class="row form-row">
                            <div class="col-sm-12">
                                    <p>{!!$result->description!!}</p>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-sm-2">
                                <label for="">Subject <span>*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" name="query_type">
                                    <option value="inbox">Inbox Query</option>
                                    <option value="support_query">Support Query</option>
                                </select>
                            </div>

                            
                        </div>
                        <div class="row form-row">
                            <div class="col-sm-2">
                                <label for="">Name <span>*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <!-- <input type="text" name="" value="" placeholder="Your Name" class="form-control"> -->
                                {!! Form::text('name', null, array('placeholder' => 'Your Name', 'class' => 'cntct-name form-control')) !!}
                                <span class="error-message cntct-name-error"></span>
                            </div>
                            
                        </div>
                        
                        <!-- <div class="form-group">
                                <label>Name <span class="mandantory">*</span></label>
                                <div class="input-field">
                                    {!! Form::text('name', null, array('placeholder' => 'Your name goes here', 'class' => 'cntct-name')) !!}
                                </div>
                                <span class="error-message cntct-name-error"></span>
                            </div> -->


                        <div class="row form-row">
                            <div class="col-sm-2">
                                <label for="">Email <span>*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <!-- <input type="email" name="" value="" placeholder="Enter your email address so we can contact you" class="form-control"> -->
                                {!! Form::email('email', null, array('placeholder' => 'Enter your email address so we can contact you', 'class' => 'cntct-email form-control')) !!}
                                <span class="error-message cntct-email-error"></span>
                            </div>
                            
                        </div>
                        <!-- <div class="form-group">
                                <label>Email <span class="mandantory">*</span></label>
                                <div class="input-field">
                                    {!! Form::email('email', null, array('placeholder' => 'Enter your email address so we can contact you.', 'class' => 'cntct-email')) !!}
                                </div>
                                <span class="error-message cntct-email-error"></span>
                            </div> -->

                        <div class="row form-row">
                            <div class="col-sm-2">
                                <label for="">Detailed Description <span>*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <textarea name="contact_query" rows="8" cols="80" placeholder="Please bs as detailed as possible " class="form-control cntct-query"  name="contact_query"></textarea>
                                <!-- <textarea placeholder="Please be as detailed as possible" name="contact_query" class="cntct-query"></textarea> -->
                                <span class="error-message cntct-query-error"></span>
                            </div>
                            
                        </div>
                        <!-- <div class="form-group">
                                <label>Detailed description <span class="mandantory">*</span></label>
                                <div class="input-field">
                                    <textarea placeholder="Please be as detailed as possible" name="contact_query" class="cntct-query"></textarea>
                                </div>
                                <span class="error-message cntct-query-error"></span>
                            </div> -->


                        <div class="row form-row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <div class="google-captcha">
                                    
                                        <!-- <img src="plugins/front/img/google-captcha.jpg" /> -->
                                        <div class="g-recaptcha" data-sitekey="{{Redis::get('google-recaptcha-api-key')}}"></div>
                                    </div>
                                    <span class="error-message google-cptcha-error"></span>
                            </div>
                        </div>
                        <!-- <div class="row form-row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <div class="inputFile">
                                    <input type="file" name="" value="" id="file1" class="filetype">
                                    <label for="file1">Add attachment</label>
                                </div>

                            </div>
                        </div> -->
                        <div class="row form-row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <!-- <button type="button" name="button" class="btn">Submit</button> -->
                                <input type="submit" class="btn btn-submit" value="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {!! Form::close() !!}
</div>


@stop

@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add-attachment input[type="file"]').on('change', function() {
            var file_name = $(this).val().replace(/\\/g, '/').replace(/.*\//,'');
            $('.custom-label').text(file_name).css('display', 'block');
        });

        $(".contact-us-form").submit(function(event) {
            var status = true;
            var email_regex = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            $(".error-message").text("");
            if($(".cntct-name").val() == '') {
                $(".cntct-name-error").text("This field is required.");
                status = false;
            }
            if($(".cntct-email").val() == '') {
                $(".cntct-email-error").text("This field is required.");
                status = false;
            } else if(!email_regex.test($(".cntct-email").val())) {
                $('.cntct-email-error').text('Invalid email address.');
                status = false;
            }
            if($(".cntct-query").val() == '') {
                $(".cntct-query-error").text("This field is required.");
                status = false;
            }
            if($("#g-recaptcha-response").val() == '') {
                $(".google-cptcha-error").text("Verify the captcha.");
                status = false;
            }

            if(status) {
                return true;
            } else {
                event.preventDefault();
            }
        })

        <?php
        if(Session::has('success')) {
            $showMessage = array('status' => 1, 'type' => 'done', 'message' => Session::get('success')); ?>
            Notify.showNotification("<?php echo $showMessage['message']; ?>", "<?php echo $showMessage['type']; ?>"); <?php
        }

        if(Session::has('danger')) {
            $showMessage = array('status' => 1, 'type' => 'warning', 'message' => Session::get('danger')); ?>
            Notify.showNotification("<?php echo $showMessage['message']; ?>", "<?php echo $showMessage['type']; ?>"); <?php
        }
        ?>
    });    
</script>

@stop