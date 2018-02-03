@extends('front/layout/layout')
@section('content')
<!-- include header -->


                                                                        
<div id="middle" class="detail-middle">
   <input type="hidden" name="loginUserId" id="loginUserId" value="{{ Auth::guard('web')->user() ? Auth::guard('web')->user()->id : null }}">
    <!-- breadcrumb section -->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>              
                    <li><a href="{{ url('/classified_list/'.$data->categoriesname['id']) }}">{{$data->categoriesname['name']}}</a></li>
                    <li class="active">{{ $data->title }}</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <!-- style in main-categories.scss file -->
                        <div id="left-section" class="mosqueDetailleft">
                            <div class="row">


                                <div class="top-section">

                                    <div class="col-sm-6 col-xs-7">
                                        <div class="title">
                                             <h1>{{ $data->title }}</h1>

                                        </div>

                                    </div>
                                    <div class="col-sm-6 col-xs-5">
                                        <div class="share pull-right post-share">
                                            <li class="dropdown">
                                                <a href="javascript:void(0)"  data-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ URL::asset('/plugins/front/img/icons/share.png') }}" alt="">
                                                    Share
                                                </a>
                                                <div class="dropdown-menu pt-share-icons" role="menu">
                                                    <ul>
                                                        <li>
                                                            <span class='st_facebook_large' displayText='Facebook' st_title='{{ $data->title }}'></span>
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

                                        </div>

                                    </div>
                                </div>

                                <div class="MosqueDetail">
                                    <div class="col-sm-4">
                                        
                                        @if(!empty($data->classified_image))
                                        @foreach($data->classified_image as $classfdImgKey => $classfdImgVal)
                                        @if($classfdImgKey<=2)
                                        <div class="mosque-img">

                                            <img src="{!! asset('/upload_images/classified/'.$classfdImgVal->classified_id.'/'.$classfdImgVal->name) !!}" />

                                        </div>
                                        @endif
                                        @endforeach
                                        
                                        
                                        <div class="mosque-img withthumb">
                                            <div class="mosqueImgThumbnil">
                                                @foreach($data->classified_image as $classfdImgKey => $classfdImgVal)
                                                <div class="item"><a href="{!! asset('/upload_images/classified/'.$classfdImgVal->classified_id.'/'.$classfdImgVal->name) !!}" class="html5lightbox" data-group="set1" title=""><img src="{!! asset('/upload_images/classified/'.$classfdImgVal->classified_id.'/'.$classfdImgVal->name) !!}" alt=""></a></div>
                                                @endforeach


                                            </div>

                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="withtitlebg">
                                            Information
                                        </div> 
                                        
                                        
                                        <div class="mosque-info"> 
                                            
                                            @if($data->categoriesname['show_static_attributes'] == 1)
                                           <ul>
                                                <li>
                                                    <a href="#">
                                                        <span class="icon"><img src="{{url('plugins/front/img/icons/blue-user.png')}}" alt=""></span>
                                                        <span class="txt">{{$data->contact_name}}</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="icon"><img src="{{url('plugins/front/img/icons/blue-phone.png')}}" alt=""></span>
                                                        <span class="txt">{{$data->contact_mobile}}</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <span class="icon"><img src="{{url('plugins/front/img/icons/www-icon.png')}}" alt=""></span>
                                                        <span class="txt">{{$data->website}}</span>
                                                    </a>
                                                </li>

                                            </ul> 
                                             @endif
                                             
                                            @if(!empty(strip_tags($data->description)))     
                                            <p>{{strip_tags($data->description)}}</p>
                                            @endif
                                          
                                            @if(sizeof($data->classified_attribute) > 0)
                                            <br/>
                                            <h4>Specifications</h4>

                                            <br/>
                                            
                                            <ul class="list-features">
                                              
                                                @foreach($data->classified_attribute as $key => $value)
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
                                                    <span style="display: inline-block; margin: 10px; background-color:{{$value->attr_value}}"></span>
                                                </li>
                                                @else
                                                <li>
                                                    <label>{{$value->display_name}}</label>
                                                    <span>{{$value->attr_value}}</span>
                                                </li>
                                                @endif
                                                @endif
                                                @endforeach
                                                
                                                @if(isset($data->multi_select))
                                               
                                                @foreach($data->multi_select as $key => $value)
                                                @if(in_array($value['attr_type_name_multi'],['Multi-Select']))
                                                <li>
                                                    <label>{{$value['display_name']}}</label>
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

                                            @endif

                                        </div> 
                                         @if($data->categoriesname['show_static_attributes'] == 1)
                                        <div class="widgets-map">
                                            <div class="mapadder">
                                               <ul>
                                                    <li>
                                                        <img src="{{ url('plugins/front/img/icons/blue-location.png')}}" alt="">
                                                    </li>
                                                    <li>
                                                        {{ $data->location }}

                                                    </li>
                                                </ul>
                                                <div id="map" class="detail_map"></div>
                                            </div>
                                        </div>
                                         @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mosquesidebar">
                        <!-- style in sidebar.scss file -->
                       @include('front/element/home_sidebar')
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
<script type="text/javascript">
    $(document).ready(function () {

        $('.filter-togle > ul > li:has( > ul)').addClass('inner-Catogory');
        $('.filter-togle > h3').next().css('display', 'none');
        $('.filter-togle > h3').click(function () {
            $(this).next().slideToggle();
            $(this).toggleClass("toggled");
        })
        $('.inner-Catogory > a').next().css('display', 'none');
        $('.inner-Catogory > a').click(function () {
            $(this).next().slideToggle();
            $(this).toggleClass("toggled");
        });

        $('.filter-togle > h3').click();

        $('.mosqueImgThumbnil').owlCarousel({
            center: true,
            items: 3,
            loop: true,
            margin: 8,
            nav: true,
            navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
            responsive: {
                600: {
                    items: 3
                }
            }
        });

        // var locations = [];
        // var msqData = <?php //echo json_encode($near_mosques) ?>;
        // $.each(msqData, function (key, value) {
        //     locations[key] = [value.title, value.lat, value.lng, key + 1
        //     ];
        // });
        // var map = new google.maps.Map(document.getElementById('msq-near-map'), {
        //     zoom: 10,
        //     center: new google.maps.LatLng(<?php //echo $latitude; ?>, <?php //echo $longitude; ?>),
        //     mapTypeId: google.maps.MapTypeId.ROADMAP
        // });
        // var infowindow = new google.maps.InfoWindow();
        // var marker, i;
        // for (i = 0; i < locations.length; i++) {
        //     marker = new google.maps.Marker({
        //         position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        //         map: map
        //     });

        //     google.maps.event.addListener(marker, 'click', (function (marker, i) {
        //         return function () {
        //             infowindow.setContent(locations[i][0]);
        //             infowindow.open(map, marker);
        //         }
        //     })(marker, i));
        // }



        //sidebar prayer timing script startsssssssssssssssssssssssssssssssssssssssssssssssssssssssssss
        var latitute1 = 0;
        var longitude1 = 0;
        getLocation();
        get_today_prayer_timing(0, 0)
        get_classified_map(-37.813628, 144.963058)

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, err);
            } else {
                //console.log("Geolocation is not supported by this browser.");
            }
        }
        function err(position) {
            get_today_prayer_timing(0, 0)
            get_classified_map(-37.813628, 144.963058)
            latitute1 = 0;
            longitude1 = 0;
        }
        function showPosition(position) {
            var geocoder;
            geocoder = new google.maps.Geocoder();
            latitute1 = position.coords.latitude;
            longitude1 = position.coords.longitude;
            var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            $('.trending_classi').html('');
            $('.recent_classi').html('');

            geocoder.geocode(
                    {'latLng': latlng},
                    function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                get_today_prayer_timing(position.coords.latitude, position.coords.longitude)
                                get_classified_map(position.coords.latitude, position.coords.longitude)
                            } else {
                                console.log("address not found");
                            }
                        } else {
                            console.log("Geocoder failed due to: " + status);
                        }
                    }
            );
        }
        function get_today_prayer_timing(lat, lng) {
            var cur_city = "";
            var current_date = new Date();
            var timezone = -(current_date.getTimezoneOffset())

            var c_timeStamp = new Date();
            var c_date = c_timeStamp.getDate();
            var c_month = c_timeStamp.getMonth();
            var c_year = c_timeStamp.getFullYear();
            var c_hour = c_timeStamp.getHours();
            var c_minute = c_timeStamp.getMinutes();

            var final_string = c_year+"-"+(c_month+1)+"-"+c_date+" "+c_hour+":"+c_minute;
            
            if(lat != 0 && lng != 0) {
                var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + '%2C' + lng + '&language=en';
                $.getJSON(GEOCODING).done(function(locationn) {

                    var lcnn = locationn.results[0].address_components
                
                    for (var i = 0; i < lcnn.length; i++) {
                        var addressType = lcnn[i].types[0];
                        if (addressType == 'locality') {
                            cur_city = lcnn[i]['long_name'];
                            console.log(cur_city)
                        }
                    }

                    $.ajax({
                        url: root_url + '/get_p_timing',
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                            "lat": lat,
                            "lng": lng,
                            "timezone": timezone,
                            "cur_city": cur_city,
                            "cur_time": final_string
                        },
                        dataType: "html",
                        method: "POST",
                        cache: true,
                        success: function (response) {
                            $(".p_timing_sidebar_blck").html(response);

                            var curr_time = new Date();
                            var get_curr_hour = curr_time.getHours();
                            var get_curr_minute = curr_time.getMinutes();
                            var exact_time_diff = '';
                            if($(".isTodayTiming").val() == 1) {
                                var fffff = get_curr_hour+":"+get_curr_minute;
                                var diff = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;

                                var get_minute = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
                                var get_hour = parseInt(get_minute / 60);
                                var get_remain_min = (get_minute % 60);
                                console.log(get_hour+" hour and "+get_remain_min+" minute left")

                                if(get_hour == 0) {
                                    exact_time_diff = get_remain_min+" minute left";
                                } else {
                                    exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
                                }
                                $(".pt_time_left").text(exact_time_diff)

                            } else {

                                var fffff = get_curr_hour+":"+get_curr_minute;
                                var diff = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;

                                var get_minute = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
                                var get_hour = parseInt(get_minute / 60);
                                var get_remain_min = (get_minute % 60);
                                console.log(get_hour+" hour and "+get_remain_min+" minute left")

                                if(get_hour == 0) {
                                    exact_time_diff = get_remain_min+" minute left";
                                } else {
                                    exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
                                }
                                $(".pt_time_left").text(exact_time_diff)

                            }
                        }
                    })
                })
            } else {
                $.ajax({
                    url: root_url + '/get_p_timing',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "lat": lat,
                        "lng": lng,
                        "timezone": timezone,
                        "cur_city": cur_city,
                        "cur_time": final_string
                    },
                    dataType: "html",
                    method: "POST",
                    cache: true,
                    success: function (response) {
                        $(".p_timing_sidebar_blck").html(response);

                        var curr_time = new Date();
                        var get_curr_hour = curr_time.getHours();
                        var get_curr_minute = curr_time.getMinutes();
                        var exact_time_diff = '';
                        if($(".isTodayTiming").val() == 1) {
                            var fffff = get_curr_hour+":"+get_curr_minute;
                            var diff = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;

                            var get_minute = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
                            var get_hour = parseInt(get_minute / 60);
                            var get_remain_min = (get_minute % 60);
                            console.log(get_hour+" hour and "+get_remain_min+" minute left")

                            if(get_hour == 0) {
                                exact_time_diff = get_remain_min+" minute left";
                            } else {
                                exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
                            }
                            $(".pt_time_left").text(exact_time_diff)

                        } else {

                            var fffff = get_curr_hour+":"+get_curr_minute;
                            var diff = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;

                            var get_minute = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
                            var get_hour = parseInt(get_minute / 60);
                            var get_remain_min = (get_minute % 60);
                            console.log(get_hour+" hour and "+get_remain_min+" minute left")

                            if(get_hour == 0) {
                                exact_time_diff = get_remain_min+" minute left";
                            } else {
                                exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
                            }
                            $(".pt_time_left").text(exact_time_diff)

                        }
                    }
                })
            }
        }
        //sidebar prayer timing script endsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss

        function get_classified_map(lat, lng) {
            $.ajax({
                url: root_url + '/get_c_map',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "lat": lat,
                    "lng": lng,
                },
                dataType: "json",
                method: "POST",
                cache: true,
                success: function (response) {
                    //console.log(response)

                    var locations = [];
                    // var msqData = <?php //echo json_encode($near_mosques) ?>;
                    $.each(response, function (key, value) {
                        locations[key] = [value.title, value.lat, value.lng, key + 1
                        ];
                    });
                    var map = new google.maps.Map(document.getElementById('msq-near-map'), {
                        zoom: 5,
                        center: new google.maps.LatLng(lat, lng),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    var infowindow = new google.maps.InfoWindow();
                    var marker, i;
                    for (i = 0; i < locations.length; i++) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            map: map
                        });

                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                            return function () {
                                infowindow.setContent(locations[i][0]);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }
                }
            })
        }

    })
</script>

<script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=af574cb1-c8d1-456e-983c-4fcac8797a90"></script>
<script type="text/javascript">stLight.options({publisher: "af574cb1-c8d1-456e-983c-4fcac8797a90", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script type="text/javascript">
    function myMap() {
        var msq_latitude = "<?php echo $data->lat; ?>";
        var msq_logtitude = "<?php echo $data->lng; ?>";
        var myCenter = new google.maps.LatLng(msq_latitude, msq_logtitude);
        var mapCanvas = document.getElementById("map");
        var mapOptions = {center: myCenter, zoom: 15};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position: myCenter});
        marker.setMap(map);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>

@stop