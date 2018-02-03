@extends('front/layout/layout')
@section('content')

<?php //dd($result); ?>

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
                            <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i><span>Save this Car</span></a>

                            <ul class="details-social-btn">
                                <li><a href="#" class='st_facebook_large' displayText='Facebook' ><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon"></a></li>
                                <li><a href="#" class='st_twitter_large' displayText='Tweet'><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>
                                <li><a href="#"  class='st_googleplus_large' displayText='Google +'><img src="{{ URL:: asset('/plugins/front/img/insta-icon.png')}}" alt="insta-icon"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="preview-ad-left real-estate-detal-left">              
                        <div class="preview-ad-thumbs">
                            <div class="ad-large-thumb real-slick-lg-thumb">
                                <section class="real-slider-for slider">
                                    @foreach($result->classified_image as $key => $value)
                                    <div> 
                                        <img src='{{ url("/upload_images/classified/$result->id/$value->name") }}' />
                                    </div>
                                    @endforeach
                                </section>
                            </div>
                            <div class="ad-sm-thumb real-slick-sm-thumb">
                                <section class="real-slider-nav slider">
                                    @foreach($result->classified_image as $key => $value)              
                                    <div>
                                        <img src='{{ url("/upload_images/classified/$result->id/$value->name") }}' />
                                    </div>
                                    @endforeach
                                </section>  

                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="row">      
                <div class="col-sm-8">
                    <div class="preview-ad-left real-estate-detal-left real-page-left-sec">
                        <h2 class="preview-ad-title">{{ $result->title }} </h2>
                        <div class="real-bed-icons">
                            <ul class="real-bed-icon-list">
                                <?php $num = 0; ?>
                                @foreach($result->classified_attribute as $key => $value)
                                <?php if ($num > 4) continue; ?>
                                @if($value->show_list == 1)
                                @if(in_array($value->attr_type_name,['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))
                                @if(in_array($value->attr_type_name, ["Drop-Down"]))

                                <li><a href="javascript:void(0)"><span>{{$value->attr_AllValues[$value->attr_value]}}</span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="{{$value->display_name}}" title="{{$value->display_name}}"></a></li>


                                @elseif(in_array($value->attr_type_name, ["Radio-button"]))
                                <li><a href="javascript:void(0)"><span>{{ $result->multi_select[$value['attribute_id']]['attribute_value'][$result->multi_select[$value['attribute_id']]['selected'][0]] }}</span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="{{$value->display_name}}" title="{{$value->display_name}}"></a></li>

                                @else

                                <li><a href="javascript:void(0)"><span> {{$value->attr_value}}</span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="{{$value->display_name}}" title="{{$value->display_name}}"></a></li>


                                @endif
                                @endif
                                <?php $num++; ?>
                                @endif
                                @endforeach

                            </ul>

                            <ul class="real-view-icon-list">
                                <li><a href="javascript:void(0)"><img src="{{ URL:: asset('/plugins/front/img/view-icon.png')}}" alt="img"> <span>{{ $result->count }}</span> </a></li>
                                <li><a href="javascript:void(0)"><span class="location-hrs">5h</span><span>{!! Helper::time_since(time() - strtotime($result['created_at'])) !!}  ago</span></a></li>                  
                            </ul>
                        </div>           

                        <div class="ad-preview-tab-sec real-des-tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#summary" aria-controls="summary" role="tab" data-toggle="tab"><span>Summary</span> </a></li>
                                <li role="presentation"><a href="#map_id" aria-controls="map_id" role="tab" data-toggle="tab"><span>Map</span> </a></li>
                                <li role="presentation"><a href="#nearby_id" aria-controls="nearby_id" role="tab" data-toggle="tab"><span>Nearby</span> </a></li>
                                <li role="presentation"><a href="#local_school" aria-controls="local_school" role="tab" data-toggle="tab"><span>Local School Catchments</span> </a></li>

                            </ul>  
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="summary">
                                    <div class="ad-preview-tab-detail">
                                        <?php if (isset($result->description) && $result->description != '') { ?>
                                            <h4>Descriptions</h4>
                                            <p>{{ strip_tags($result->description) }}</p>
                                        <?php } ?>
                                        <br/>
                                        <h4>Ad Details</h4>

                                        <br/>
                                        <ul class="list-features">

                                            @foreach($result->classified_attribute as $key => $value)
                                            @if(in_array($value->attr_type_name,['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))
                                            @if(in_array($value->attr_type_name, ["Drop-Down"]))
                                            <li>
                                                {{$value->display_name}}:- 
                                                <span>{{$value->attr_AllValues[$value->attr_value]}}</span>
                                            </li>
                                            @elseif(in_array($value->attr_type_name, ["Radio-button"]))
                                            <li>
                                                {{$value->display_name}}:- 
                                                <span>{{ $result->multi_select[$value['attribute_id']]['attribute_value'][$result->multi_select[$value['attribute_id']]['selected'][0]] }}</span>
                                            </li>
                                            @elseif(in_array($value->attr_type_name, ["calendar", "Date", "Time"]))
                                            <li>
                                                {{$value->display_name}}:- 
                                                <span>{{ str_replace(';',' - ',$value->attr_value ) }}</span>
                                            </li>
                                            @elseif(in_array($value->attr_type_name, ["Color"]))
                                            <li>
                                                {{$value->display_name}}:- 
                                                <span style=" display: inline-block; margin: 10px; background-color:{{$value->attr_value}}"></span>
                                            </li>
                                            @else
                                            <li>
                                                {{$value->display_name}}:- 
                                                <span>{{$value->attr_value}}</span>
                                            </li>
                                            @endif
                                            @endif
                                            @endforeach

                                            @if(isset($result->multi_select))
                                            @foreach($result->multi_select as $key => $value)
                                            @if(in_array($value['attr_type_name_multi'],['Multi-Select']))
                                            <li>
                                                <label>{{$value['name']}}</label>
                                                <span>
                                                    @foreach($value['selected'] as $k => $v)
                                                    <?php if ($k != 0) echo ', '; ?>{{ $value['attribute_value'][$v] }}
                                                    @endforeach
                                                </span>
                                            </li>
                                            @endif
                                            @endforeach
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="map_id">
                                    <div class="ad-preview-tab-detail">
                                        <div class="real-es-detail-location">
                                            <?php /* ?><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50422.47322940408!2d144.93524652180866!3d-37.827413420253535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2sMelbourne+VIC+3004%2C+Australia!5e0!3m2!1sen!2sin!4v1509708517172" class="detail-map-area" allowfullscreen></iframe><?php */ ?>
                                            @if(!empty($result->location))
                                            <div class="widgets-map">
                                                <div class="mapadder">
                                                    <ul>
                                                        <li>
                                                            <img src="{{ URL:: asset('/plugins/front/img/locate-icon.png') }}" alt="">
                                                        </li>
                                                        <li>
                                                            {{ $result->location }}
                                                            <!-- <span>15 km away</span> -->
                                                        </li>
                                                    </ul>
                                                    <?php /* <img src="{{ URL:: asset('/plugins/front/img/map.png') }}" alt=""> */ ?>
                                                    <div id="detail-map" class="detail_sidebar"></div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="nearby_id">
                                    <div class="ad-preview-tab-detail">
                                        <?php
                                        //echo "<pre>";
                                        //print_r($sensis_results_restaurants['results'])
                                        ?>
                                        @if(isset($sensis_results_restaurants['results']) && count($sensis_results_restaurants['results']) >0)
                                        <h5>Restaurants</h5>
                                        <ul>
                                            <?php $snum = 0; ?>
                                            @foreach($sensis_results_restaurants['results'] as $senres)
                                            <?php if ($snum > 3) continue; ?>
                                            <li>
                                                <label><?php echo $senres['name'] ?><span><?php echo number_format($senres['distance'], 3) ?> km</span></label>
                                                <?php echo $senres['primaryAddress']['addressLine'] . ', ' . $senres['primaryAddress']['suburb'] . ' ' . $senres['primaryAddress']['postcode'] ?>
                                                <!--224 Glenferrie Rd Malvern, Malvern 3144 -->
                                            </li>
                                            <?php $snum++; ?>
                                            @endforeach 

                                        </ul>
                                        @endif 

                                        @if(isset($sensis_results_bars['results']) && count($sensis_results_bars['results']) >0)
                                        <h5>Bars</h5>
                                        <ul>
                                            <?php $snum1 = 0; ?>
                                            @foreach($sensis_results_bars['results'] as $senres)
                                            <?php if ($snum1 > 3) continue; ?>
                                            <li>
                                                <label><?php echo $senres['name'] ?><span><?php echo number_format($senres['distance'], 3) ?> km</span></label>
                                                <?php //echo $senres['primaryAddress']['addressLine'] .', '.$senres['primaryAddress']['suburb'] .' '.$senres['primaryAddress']['postcode'] ?>
                                                <!--224 Glenferrie Rd Malvern, Malvern 3144 -->
                                            </li>
                                            <?php $snum1++; ?>
                                            @endforeach 

                                        </ul>

                                        @endif
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="local_school">
                                    <div class="local-school-tab">
                                        <!-- Nav tabs -->
                                        <ul class="school-all-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#all" aria-controls="home" role="tab" data-toggle="tab">All <span></span></a></li>
                                            <li role="presentation"><a href="#primary" aria-controls="profile" role="tab" data-toggle="tab">Primary <span></span></a></li>
                                            <li role="presentation"><a href="#secondary" aria-controls="messages" role="tab" data-toggle="tab">Secondary <span></span></a></li>
                                            <li role="presentation"><a href="#others" aria-controls="settings" role="tab" data-toggle="tab">Others <span></span></a></li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="all">
                                                <div class="ad-preview-tab-detail">                      
                                                    @if(isset($sensis_results_allschool['results']) && count($sensis_results_allschool['results']) >0)
                                                    <ul>
                                                        <?php $snum2 = 0; ?>
                                                        @foreach($sensis_results_allschool['results'] as $senres)
                                                        <?php if ($snum2 > 3) continue; ?>
                                                        <li>
                                                            <label><?php echo $senres['name'] ?> <span><?php echo number_format($senres['distance'], 3) ?> km</span></label>
                                                            <?php
                                                            if (isset($senres['primaryAddress']['addressLine']))
                                                                echo $senres['primaryAddress']['addressLine'];
                                                            if (isset($senres['primaryAddress']['suburb']))
                                                                echo ', ' . $senres['primaryAddress']['suburb'];
                                                            if (isset($senres['primaryAddress']['postcode']))
                                                                echo ' ' . $senres['primaryAddress']['postcode'];
                                                            ?>
                                                            <?php /* ?><div class="school-location-tags">
                                                              <a href="javascript:void(0)">Girls</a>
                                                              <a href="javascript:void(0)">Government</a>
                                                              <a href="javascript:void(0)">Private</a>
                                                              </div><?php */ ?>
                                                        </li>
                                                        <?php $snum2++; ?>
                                                        @endforeach 
                                                    </ul>
                                                    @endif                      
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="primary">
                                                <div class="ad-preview-tab-detail">                      
                                                    @if(isset($sensis_results_preschool['results']) && count($sensis_results_preschool['results']) >0)
                                                    <ul>
                                                        <?php $snum2 = 0; ?>
                                                        @foreach($sensis_results_preschool['results'] as $senres)
                                                        <?php if ($snum2 > 3) continue; ?>
                                                        <li>
                                                            <label><?php echo $senres['name'] ?> <span><?php echo number_format($senres['distance'], 3) ?> km</span></label>
                                                            <?php
                                                            if (isset($senres['primaryAddress']['addressLine']))
                                                                echo $senres['primaryAddress']['addressLine'];
                                                            if (isset($senres['primaryAddress']['suburb']))
                                                                echo ', ' . $senres['primaryAddress']['suburb'];
                                                            if (isset($senres['primaryAddress']['postcode']))
                                                                echo ' ' . $senres['primaryAddress']['postcode'];
                                                            ?>
                                                            <?php /* ?><div class="school-location-tags">
                                                              <a href="javascript:void(0)">Girls</a>
                                                              <a href="javascript:void(0)">Government</a>
                                                              <a href="javascript:void(0)">Private</a>
                                                              </div><?php */ ?>
                                                        </li>
                                                        <?php $snum2++; ?>
                                                        @endforeach 
                                                    </ul>
                                                    @endif                      
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="secondary">
                                                <div class="ad-preview-tab-detail">                      
                                                    @if(isset($sensis_results_secschool['results']) && count($sensis_results_secschool['results']) >0)
                                                    <ul>
                                                        <?php $snum2 = 0; ?>
                                                        @foreach($sensis_results_secschool['results'] as $senres)
                                                        <?php if ($snum2 > 3) continue; ?>
                                                        <li>
                                                            <label><?php echo $senres['name'] ?> <span><?php echo number_format($senres['distance'], 3) ?> km</span></label>
                                                            <?php
                                                            if (isset($senres['primaryAddress']['addressLine']))
                                                                echo $senres['primaryAddress']['addressLine'];
                                                            if (isset($senres['primaryAddress']['suburb']))
                                                                echo ', ' . $senres['primaryAddress']['suburb'];
                                                            if (isset($senres['primaryAddress']['postcode']))
                                                                echo ' ' . $senres['primaryAddress']['postcode'];
                                                            ?>
                                                            <?php /* ?><div class="school-location-tags">
                                                              <a href="javascript:void(0)">Girls</a>
                                                              <a href="javascript:void(0)">Government</a>
                                                              <a href="javascript:void(0)">Private</a>
                                                              </div><?php */ ?>
                                                        </li>
                                                        <?php $snum2++; ?>
                                                        @endforeach 
                                                    </ul>
                                                    @endif                                  
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="others">
                                                <div class="ad-preview-tab-detail">                      
                                                    @if(isset($sensis_results_otherschool['results']) && count($sensis_results_otherschool['results']) >0)
                                                    <ul>
                                                        <?php $snum2 = 0; ?>
                                                        @foreach($sensis_results_otherschool['results'] as $senres)
                                                        <?php if ($snum2 > 3) continue; ?>
                                                        <li>
                                                            <label><?php echo $senres['name'] ?> <span><?php echo number_format($senres['distance'], 3) ?> km</span></label>
                                                            <?php
                                                            if (isset($senres['primaryAddress']['addressLine']))
                                                                echo $senres['primaryAddress']['addressLine'];
                                                            if (isset($senres['primaryAddress']['suburb']))
                                                                echo ', ' . $senres['primaryAddress']['suburb'];
                                                            if (isset($senres['primaryAddress']['postcode']))
                                                                echo ' ' . $senres['primaryAddress']['postcode'];
                                                            ?>
                                                            <?php /* ?><div class="school-location-tags">
                                                              <a href="javascript:void(0)">Girls</a>
                                                              <a href="javascript:void(0)">Government</a>
                                                              <a href="javascript:void(0)">Private</a>
                                                              </div><?php */ ?>
                                                        </li>
                                                        <?php $snum2++; ?>
                                                        @endforeach 
                                                    </ul>
                                                    @endif                                  
                                                </div>
                                            </div>
                                        </div>


                                        <?php
//echo "<pre>";
//print_r($sensis_results_school['results']);
//die();
                                        ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h2 class="real-budget"><img src="{{ URL:: asset('/plugins/front/img/icon-1.png')}}" alt="img">@if($result->price > 0)    
                        ${{ $result->price }}
                        @endif
                        @if($result->price_to > 0)    
                        - ${{ $result->price_to }}
                        @endif


                    </h2>
                    <?php
                    $currentdate = strtotime("now");
                    $show_ins_date = "";
                    ?>
                    @foreach($result->classified_hasmany_other as $key => $value)
                    @if($value->other_slug == 'is_inspection_date') 
                    <?php
                    $ins_date = strtotime($value->other_value);
                    if ($currentdate < $ins_date) {
                        $show_ins_date = date("d F Y", $ins_date);
                        break;
                    }
                    ?>
                    @endif
                    @endforeach
                    @if($show_ins_date != '')
                    <div class="next-inspection-box">
                        <h2>
                            Next Inspection
                            <strong><?php echo $show_ins_date ?></strong>
                        </h2>
                    </div>
                    @endif
                    <div class="real-enquire-box">
                        To enquire please contact:
                        <a href="#"><?php echo $result->contact_email; ?></a>
                        <a href="#"><?php echo $result->contact_mobile; ?></a>
                        <div class="real-enquire-box-brand">
                            @if($result->classified_users['role_id'] == 0)
                            {!! str_limit($result->classified_users->name, $limit = 14, $end = '...') !!}
                            @else
                            {!! str_limit($result->contact_name, $limit = 14, $end = '...') !!}
                            @endif
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>




</div>    




@stop

@section('scripts')
<script type="text/javascript" id="st_insights_js" src="//w.sharethis.com/button/buttons.js?publisher=af574cb1-c8d1-456e-983c-4fcac8797a90"></script>
<script type="text/javascript">stLight.options({publisher: "af574cb1-c8d1-456e-983c-4fcac8797a90", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU?sensor=false"></script>

<script type="text/javascript">

$.ajax({
    url: root_url + '/classifieds/increase_count',
    data: {
        "_token": $('meta[name="csrf-token"]').attr('content'),
        "classified_id": $('.classified_id_new').val(),
    },
//        dataType: "html",
    method: "POST",
    cache: false,
    success: function (response) {

    },
    error: function (data) {

    }
});

$("#makeAnOfferForm").validate({
    rules: {
        offer_price: {
            required: true,
            number: true,
            min: 1
        }
    },
    submitHandler: function (form) {
        makeOfferPrice();
    }
});

//ajax for make a offer 
function makeOfferPrice() {
    if ($("#loginUserId").val()) {
        $(".loadingMakeOfferDiv i").removeClass("hide")
        var offerprice = $('.offer_price').val();
        $(".loadingMakeOfferDiv i").addClass("hide")
        $('.offer_price').val("")
        //Notify.showNotification("Your offer has been sent to the seller.", "success")
        $.ajax({
            url: root_url + '/user/messages/create',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "offer_price": offerprice,
                "classified_id": $('.classified_id').val(),
                "receiver_id": $('.receiver_id').val(),
            },
            method: "POST",
            cache: false,
            success: function (response) {
                if (response.status) {
                    $(".loadingMakeOfferDiv i").addClass("hide")
                    //  $('.offer_price').val("")
                    Notify.showNotification("Your offer has been sent to the seller.", "success")
                } else {
                    $(".loadingMakeOfferDiv i").addClass("hide")
                    Notify.showNotification(response.message, "error")
                }
            },
            error: function (data) {

            }
        });
    } else {
        Notify.showNotification("You must be logged in to perform this action", "error")
    }
}


$(document).on("click", ".send-enq-msg", function (e) {
    //alert("hello");
    if ($('.e_name').val() == '') {
        Notify.showNotification('Please enter your name', 'error');
        return false;
    }
    if ($('.e_email').val() == '') {
        Notify.showNotification('Please enter your Email id', 'error');
        return false;
    }
    if ($('.e_phone').val() == '') {
        Notify.showNotification('Please enter your Phone No.', 'error');
        return false;
    }
    if ($('.e_msg').val() == '') {
        Notify.showNotification('Please enter Message', 'error');
        return false;
    }

    var e_name = $('.e_name').val();
    $('.e_name').val('');
    var e_email = $('.e_email').val();
    $('.e_email').val('');
    var e_phone = $('.e_phone').val();
    $('.e_phone').val('');
    var e_msg = $('.e_msg').val();
    $('.e_msg').val('');

    $.ajax({
        url: root_url + '/classifieds/send_enq_msg',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "classified_id": $('.classified_id').val(),
            "receiver_id": $('.receiver_id').val(),
            "e_name": e_name,
            "e_email": e_email,
            "e_phone": e_phone,
            "e_msg": e_msg,
        },
        method: "POST",
        cache: false,
        success: function (response) {
//                $('.msgTextBox').val('');
            Notify.showNotification('Your message has been sent successfully.', 'success');
        },
        error: function (data) {

        }
    });

});

$(document).on("click", ".sendMsgBtn", function (e) {

    if ($('.msgTextBox').val() == '') {
        Notify.showNotification('Please enter message', 'error');
        return false;
    }

    if (!$("#loginUserId").val()) {
        Notify.showNotification("You must be logged in to perform this action", "error")
        return false;
    }


    var msg_tx = $('.msgTextBox').val();
    $('.msgTextBox').val('')
    Notify.showNotification('Your message has been sent successfully.', 'success');
    $.ajax({
        url: root_url + '/user/classifieds/send_msg_popup',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "classified_id": $('.classified_id').val(),
            "receiver_id": $('.receiver_id').val(),
            "msgTeaxArea": msg_tx,
        },
        method: "POST",
        cache: false,
        success: function (response) {
//                $('.msgTextBox').val('');
//                Notify.showNotification('Your message has been sent successfully.', 'success');
        },
        error: function (data) {

        }
    });
});

$(document).on('click', '.show-number', function () {
    $('.mob_number').text($(this).attr("data-value"));
    $('.show-number').hide();
});



<?php if (!empty($result->lat) && !empty($result->lng)) { ?>
    function myMap() {
        var msq_latitude = <?php echo $result->lat; ?>;
        var msq_logtitude = <?php echo $result->lng; ?>;
        var myCenter = new google.maps.LatLng(msq_latitude, msq_logtitude);
        var mapCanvas = document.getElementById("detail-map");
        var mapOptions = {center: myCenter, zoom: 8};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position: myCenter});
        marker.setMap(map);
    }
    $(function () {
        myMap();
    });
<?php } ?>






</script>
<!-- Use for social share -->
@stop