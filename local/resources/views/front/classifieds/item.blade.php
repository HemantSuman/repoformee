@extends('front/layout/layout')
@section('content')



<div id="middle" class="detail-middle">
    <!-- breadcrumb section -->
    <input type="hidden" name="loginUserId" id="loginUserId" value="{{ Auth::guard('web')->user() ? Auth::guard('web')->user()->id : null }}">
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

    <!-- categories section -->
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-8 ">
                        <!-- style in mosque-detail.scss file -->
                        <div id="detail-page" class="inner-page-section">
                            <div class="top-section">
                                <div class="row">
                                    <div class="col-md-9 col-sm-8 col-xs-7">
                                        <div class="title">
                                            <h1>{{ $result->title }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-5">
                                        <div class="heart-right">
                                            @if($result->price > 0)    
                                            <span class="amount">${{ $result->price }}</span>
                                            @endif
                                            @if(in_array($result->id, $wishlistItems))
                                            <span class="heart-icon wishlist-icon active" data-id="{{ $result->id }}">
                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                            </span>
                                            @else
                                            <span class="heart-icon wishlist-icon" data-id="{{ $result->id }}">
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="similar-add row">
                                    <div class="col-sm-7">
                                        <ul class="locate">
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> {{ $result->count }}
                                                </a>
                                            </li>
                                            <li>

                                                @if(!empty($result->location))
                                                @if(!empty($result->city))
                                                <?php
                                                //$expLoc = explode(',',trim($result->location));
                                                //dd($expLoc);
                                                ?>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ URL::asset('/plugins/front/img/locate-icon.png') }}" alt=""> {{ $result->city->City }}
                                                </a>
                                                @endif
                                                @endif
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ URL::asset('/plugins/front/img/icons/calander-icon.png') }}" alt="">{{@date('d M, Y',strtotime($result->created_at))}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-5">
                                        <ul class="post-share">
                                            <li class="dropdown">
                                                <a href="javascript:void(0)"  data-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ URL::asset('/plugins/front/img/icons/share.png') }}" alt="">
                                                    Share
                                                </a>
                                                <div class="dropdown-menu pt-share-icons" role="menu">
                                                    <ul>
                                                        <li>
                                                            <span class='st_facebook_large' displayText='Facebook' st_title='{{ $result->title }}'></span>
                                                        </li>
                                                        <li>
                                                            <span class='st_twitter_large' displayText='Tweet'></span>
                                                        </li>
                                                        <li>
                                                            <span class='st_googleplus_large' displayText='Google +'></span>
                                                        </li>



                                                    </ul>
                                                </div>
                                            </li> 
                                            
                                            <li class="dropdown report-li-drpdwn">
                                                <a href="javascript:void(0)"  data-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ URL::asset('/plugins/front/img/icons/flag.png') }}" alt="">
                                                    Report
                                                </a>
                                                <div class="dropdown-menu report-popup" role="menu">
                                                    {!! Form::open(array("url" => "report", "role" => "form", 'class' => 'form-horizontal report-classified-form', 'novalidate')) !!}
                                                    <div class="title">Please select a reason for reporting this ad</div>
                                                    <div class="radio">
                                                        {{ Form::radio('report_type', 'duplicate', true) }}
                                                        <label for="duplicate"> Duplicate </label>
                                                    </div>
                                                    <div class="radio">
                                                        {{ Form::radio('report_type', 'scam') }}
                                                        <label for="scam">Scam</label>
                                                    </div>
                                                    <div class="radio">
                                                        {{ Form::radio('report_type', 'mis categorized') }}
                                                        <label for="Mis"> Mis-categorised</label>
                                                    </div>
                                                    <div class="radio">
                                                        {{ Form::radio('report_type', 'no longer available') }}
                                                        <label for="no-avail">No-longer Available</label>
                                                    </div>
                                                    <div class="radio">
                                                        {{ Form::radio('report_type', 'unresponsive poster') }}
                                                        <label for="unresponsive"> Unresponsive Poster </label>
                                                    </div>
                                                    <div class="radio">
                                                        {{ Form::radio('report_type', 'other') }}
                                                        <label for="Other">Other</label>
                                                    </div>
                                                    <div class="input-field">
                                                        <textarea class="form-control report-reason" cols="5" placeholder="Please provide more information (Maximum 100 characters)" name="comment" maxlength="100"></textarea>
                                                    </div>
                                                    <div class="input-field">
                                                        <input type="hidden" name="classified_id" value="{{ $result->id }}">
                                                        <input type="hidden" class="classified_id_new" name="" value="<?php echo $result->id; ?>" > 
                                                        <input type="submit" class="btn" name="" value="Report">
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="detail-banner">
                                <ul id="image-gallery" class="gallery">
                                    @foreach($result->classified_image as $key => $value)
                                    <li data-thumb='{{ url("/upload_images/classified/$result->id/$value->name") }}'>
                                        <img src='{{ url("/upload_images/classified/$result->id/$value->name") }}' />
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="information-section car-infromation">
                                <div class="description">

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
                                            <label>{{$value->display_name}}</label>
                                            <span>{{$value->attr_AllValues[$value->attr_value]}}</span>
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["Radio-button"]))
                                        <li>
                                            <label>{{$value->display_name}}</label>
                                            <span>{{ $result->multi_select[$value['attribute_id']]['attribute_value'][$result->multi_select[$value['attribute_id']]['selected'][0]] }}</span>
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["calendar", "Date", "Time"]))
                                        <li>
                                            <label>{{$value->display_name}}</label>
                                            <span>{{ str_replace(';',' - ',$value->attr_value ) }}</span>
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["Color"]))
                                        <li>
                                            <label>{{$value->display_name}}</label>
                                            <span style=" display: inline-block; margin: 10px; background-color:{{$value->attr_value}}"></span>
                                        </li>
                                        @else
                                        <li>
                                            <label>{{$value->display_name}}</label>
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
                            <div class="list-view-listing">
                                @if(isset($similarAdds) && !empty($similarAdds))
                                <div class="withtitlebg">
                                    Other Listing you might be intersted in....
                                </div>
                                <div class="interested-list">
                                    @foreach ($similarAdds as $key => $value)
                                    <?Php $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $value['title']); ?>
                                    <div class="row list-row">
                                        <div class="clearfix">
                                            <div class="col-md-3 col-sm-6 col-xs-6">
                                                <a href='{{ url("/classifieds/$encodetitle/$value[id]") }}' class="clearfix">
                                                    <div class="list-img">
                                                        <?php
                                                        if (!empty($value['classified_image'])) {
                                                            $src = $value['id'] . '/' . $value['classified_image'][0]['name'];
                                                        } else {
                                                            $src = '';
                                                        }
                                                        ?>
                                                        <img src='{{ url("/upload_images/classified/$src") }}' alt="Classified image">
                                                        <span class="tab-badge" title="{!! Helper::time_since(time() - strtotime($value['created_at'])).' ago' !!}">{!! Helper::time_since_for_classified(time() - strtotime($value['created_at'])) !!}</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                
                                                <a href='{{ url("/classifieds/$encodetitle/$value[id]") }}' class="clearfix">
                                                    <div class="list-data">
                                                        <h3>{!! str_limit($value['title'],20) !!}</h3>
                                                        <p>{!! strip_tags(str_limit($value['description'],100)) !!}</p>
                                                        @if($value['price'] > 0)
                                                            <span class="price">
                                                                ${{ $value['price'] }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <div class="list-right">
                                                    @if(in_array($value['id'], $wishlistItems))
                                                    <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $value['id'] }}">
                                                        <div class="heart" data-id="{{ $value['id'] }}">
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                        </div>
                                                    </a>
                                                    @else
                                                    <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $value['id'] }}">
                                                        <div class="heart">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                        </div>
                                                    </a>
                                                    @endif

                                                    <div class="location">
                                                        @if(!empty($value['location']))
                                                        @if(!empty($value['city']))
                                                        <?php //$expSimLoc = explode(',', trim($value['location']));
                                                        //dd($expSimLoc);
                                                        ?>
                                                        <span>{{ $value['city']['City'] }}</span>
                                                        @endif
                                                        @endif
                                                        <span>{!! Helper::time_since(time() - strtotime($value['created_at'])) !!} ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <!-- style in sidebar.scss file -->
                        @include('front/element/detail_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- categories section -->
    @if(sizeof($bottom_positions_ads) > 0)
        <section id="add-space">
            <div class="adv-banner">
                @foreach($bottom_positions_ads as $bottom_ad_key => $bottom_single_ad)
                    <a href="{!! Helper::show_url($bottom_single_ad->image_url) !!}" target="_blank">
                        <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$bottom_single_ad->image) !!}" alt="banner-img">
                    </a>
                @endforeach
            </div>
        </section>
    @elseif(!empty($default_bottom_position_ad))
        <section id="add-space">
            <div class="adv-banner">
                <a href="{!! Helper::show_url($default_bottom_position_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_bottom_position_ad->image) !!}" alt="banner-img">
                </a>
            </div>
        </section>
    @endif
</div>
@stop

@section('scripts')
<script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=af574cb1-c8d1-456e-983c-4fcac8797a90"></script>
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