@extends('front/layout/layout')

@section('content')
<style>
    .msqlist{ height: 202px !important;}
</style>
<div id="middle">
    <!-- main banner section -->
    <section>
        <div id="main-banner">
            <div class="banner-carousel">
                @if(sizeof($top_positions_ads) > 0)
                @foreach($top_positions_ads as $top_ad_key => $top_single_ad)
                <a href="{!! Helper::show_url($top_single_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$top_single_ad->image) !!}" alt="banner-img">
                </a>
                @endforeach
                @elseif(!empty($default_top_position_ad))
                <a href="{!! Helper::show_url($default_top_position_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_top_position_ad->image) !!}" alt="banner-img">
                </a>
                @endif
            </div>
            <?php /* <img src="{{ URL:: asset('/plugins/front/img/banner3.jpg') }}" alt="banner-img" width="100%"> */ ?>
        </div>
    </section

    <!-- breadcrumb section -->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">Prayer Timing</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-8">
                        <!-- style in main-categories.scss file -->
                        <div id="left-section">
                            <div class="row">
                                <div class="col-md-4 col-sm-5">
                                    <div class="refine-searchWrap mosqueSearch">
                                        <h2>Refine Search</h2>

                                        {!! Form::open(array("url" => "prayer-timings", "role" => "form", 'class' => 'refineForm', 'id' => 'refine-pt-form')) !!}

                                        <ul class="filter-togleWrap">
                                            <li class="filter-togle">
                                                <h3>Select Country</h3>

                                                {!! Form::select('country', $all_countries, isset($inputs['country']) ? $inputs['country'] : null, array('placeholder' => 'Select Country', 'class' => 'custom-select pt-country')) !!}
                                            </li>
                                            <li class="filter-togle">
                                                <h3>Select State</h3>

                                                {!! Form::select('state', $states, isset($inputs['state']) ? $inputs['state'] : null, array('placeholder' => 'Select State', 'class' => 'custom-select pt-state')) !!}
                                            </li>
                                            <li class="filter-togle">
                                                <h3>Suburb</h3>

                                                {!! Form::select('subregion', $cities, isset($inputs['subregion']) ? $inputs['subregion'] : null, array('placeholder' => 'Select Suburb', 'class' => 'custom-select pt-subregion')) !!}
                                            </li >
                                            <li class="filter-togle">
                                                <h3>Method</h3>

                                                {!! Form::select('method', $prayer_timings, isset($inputs['method']) ? $inputs['method'] : null, array('placeholder' => 'Select Method', 'class' => 'custom-select pt-method')) !!}
                                            </li >
                                            <li  class="filter-togle">
                                                <h3> Select Start Date :</h3>
                                                {!! Form::text('start_date', isset($inputs['start_date']) ? $inputs['start_date'] : null, array('class' => 'datepicker form-control pt-start-date', 'placeholder' => 'Select Start Date')) !!}
                                            </li>
                                            <li class="filter-togle">
                                                <h3> Select End Date :</h3>
                                                {!! Form::text('end_date', isset($inputs['end_date']) ? $inputs['end_date'] : null, array('class' => 'datepicker form-control pt-end-date', 'placeholder' => 'Select End Date')) !!}
                                            </li>
                                        </ul>
                                        <div class="btnWrap">
                                            <button type="submit" class="btn">search</button>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7">

                                    <div id="prayer-timing" class="prayer-time-list">
                                        <div class="top-section">
                                            <div class="title">
                                                <h1>Prayer Timing</h1>
                                            </div>
                                            <ul class="prayDate">
                                                <li>
                                                    <img src="{{ URL:: asset('/plugins/front/img/icons/blue-calender.png') }}" alt="">
                                                </li>
                                                <li><strong>Today's Date</strong><span>({{ $start_date }}- {{ $end_date }})</span></li>
                                            </ul>
                                            <ul class="prayDate prayloc">
                                                <li>
                                                    <img src="{{ URL:: asset('/plugins/front/img/icons/blue-location.png') }}" alt="">
                                                </li>
                                                <li><strong class="mnth_lst_usr_crnt_city">{{ $user_city }}</strong></li>
                                            </ul>


                                        </div>

                                        <div class="prayer-timing-list">
                                            <input type="hidden" class="is_search_timings" value="{{ !empty($inputs) ? 1 : 0 }}">
                                            <div id="prayer-timing-table" class="table-responsive full_month_p_timing_list">
                                                <table class="table table-bordered timing-table"  id="fixTable">
                                                    <thead>
                                                        <tr>
                                                            <th class="date">
                                                                Date</th>
                                                            </th>
                                                            <th class="fajr">
                                                                <img src="{{ URL:: asset('/plugins/front/img/icons/maghrib-icon.png') }}" alt="h-icons">
                                                                <span>Fajr</span>
                                                            </th>
                                                            <th class="dhuhr">Dhuhr
                                                                <img src="{{ URL:: asset('/plugins/front/img/icons/dhuhr.png') }}" alt="h-icons">
                                                            </th>

                                                            <th class="asr">Asr
                                                                <img src="{{ URL:: asset('/plugins/front/img/icons/asr.png') }}" alt="h-icons">
                                                            </th>

                                                            <th class="maghrib">
                                                                <img src="{{ URL:: asset('/plugins/front/img/icons/maghrib-icon.png') }}" alt="h-icons"><span>Maghrib</span>
                                                            </th>
                                                            <th class="isha">Isha
                                                                <img src="{{ URL:: asset('/plugins/front/img/icons/isha.png') }}" alt="h-icons">
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    @if(!empty($timings_data))
                                                    @foreach($timings_data as $day => $timings)
                                                    <tr>
                                                        <td>{{ $day }}</td>
                                                        <td>{{ $timings[0] }}</td>
                                                        <td>{{ $timings[2] }}</td>
                                                        <td>{{ $timings[3] }}</td>
                                                        <td>{{ $timings[5] }}</td>
                                                        <td>{{ $timings[6] }}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <!-- style in sidebar.scss file -->
                        <?php /* @include('front/element/home_sidebar') */ ?>
                        <aside id="home-sidebar">
                            <!-- widgets -->
                            <div class="widgets widget-information">
                                <h4>Information</h4>
                                <ul>
                                    <li class="news-feed"><a href="javascript:void(0)">News Feeds</a></li>
                                    @if(!empty($informationAreaCategories))
                                    <?php $i = 1; ?>
                                    @foreach($informationAreaCategories as $infocategories)
                                    <?php
                                    $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $infocategories['text']);
                                    $url = Request::root() . '/classified_list/' . $encodetitle . '/' . $infocategories['id'];
                                    if ($i == 4) {
                                        break;
                                    } else {
                                        ?>
                                        <li class="halal"><a href="{{ $url }}">{{ $infocategories['text'] }}</a></li>
                                    <?php } $i++; ?>
                                    @endforeach

                                    <ul class="morechild">
                                        <?php $j = 1; ?>
                                        @foreach($informationAreaCategories as $infocategories1)
                                        <?php 
                                        $encodetitle1 = preg_replace('/[^A-Za-z0-9-]+/', '-', $infocategories1['text']); 
                  $url1 = Request::root().'/classified_list/'. $encodetitle1 .'/'. $infocategories['id']; 
                                        if ($j > 3) { ?>
                                            <li class="halal"><a href="{{ $url1 }}">{{ $infocategories1['text'] }}</a></li>
                                        <?php } $j++; ?>
                                        @endforeach
                                    </ul>
                                    <span class="more">More</span>

                                    @endif
                                </ul>
                            </div>

                            <div class="widgets widget-prayer-timing p_timing_sidebar_blck">

                            </div>

                            <div class="widgets widget-location">
                                <a href="{{ url('/classified_list/Mosques/33') }}"><h4>Mosques near you</h4></a>
                                <div id="msq-near-map" class="msqlist"></div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
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

            var final_string = c_year + "-" + (c_month + 1) + "-" + c_date + " " + c_hour + ":" + c_minute;

            if (lat != 0 && lng != 0) {
                var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + '%2C' + lng + '&language=en';
                $.getJSON(GEOCODING).done(function (locationn) {

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
                            if ($(".isTodayTiming").val() == 1) {
                                var fffff = get_curr_hour + ":" + get_curr_minute;
                                var diff = (new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60 / 60;

                                var get_minute = (new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60;
                                var get_hour = parseInt(get_minute / 60);
                                var get_remain_min = (get_minute % 60);
                                console.log(get_hour + " hour and " + get_remain_min + " minute left")

                                if (get_hour == 0) {
                                    exact_time_diff = get_remain_min + " minute left";
                                } else {
                                    exact_time_diff = get_hour + " hour and " + get_remain_min + " minute left";
                                }
                                $(".pt_time_left").text(exact_time_diff)

                            } else {

                                var fffff = get_curr_hour + ":" + get_curr_minute;
                                var diff = (new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60 / 60;

                                var get_minute = (new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60;
                                var get_hour = parseInt(get_minute / 60);
                                var get_remain_min = (get_minute % 60);
                                console.log(get_hour + " hour and " + get_remain_min + " minute left")

                                if (get_hour == 0) {
                                    exact_time_diff = get_remain_min + " minute left";
                                } else {
                                    exact_time_diff = get_hour + " hour and " + get_remain_min + " minute left";
                                }
                                $(".pt_time_left").text(exact_time_diff)

                            }
                        }
                    })

                    if ($(".is_search_timings").val() == 0) {
                        $.ajax({
                            url: root_url + '/get_monthly_p_timing',
                            data: {
                                "_token": $('meta[name="csrf-token"]').attr('content'),
                                "lat": lat,
                                "lng": lng,
                                "timezone": timezone,
                                "cur_city": cur_city
                            },
                            dataType: "html",
                            method: "POST",
                            cache: true,
                            success: function (response) {
                                $(".mnth_lst_usr_crnt_city").text($(".usr_crnt_city").text())
                                $(".full_month_p_timing_list").html(response);
                            }
                        })
                    }
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
                        if ($(".isTodayTiming").val() == 1) {
                            var fffff = get_curr_hour + ":" + get_curr_minute;
                            var diff = (new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60 / 60;

                            var get_minute = (new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60;
                            var get_hour = parseInt(get_minute / 60);
                            var get_remain_min = (get_minute % 60);
                            console.log(get_hour + " hour and " + get_remain_min + " minute left")

                            if (get_hour == 0) {
                                exact_time_diff = get_remain_min + " minute left";
                            } else {
                                exact_time_diff = get_hour + " hour and " + get_remain_min + " minute left";
                            }
                            $(".pt_time_left").text(exact_time_diff)

                        } else {

                            var fffff = get_curr_hour + ":" + get_curr_minute;
                            var diff = (new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60 / 60;

                            var get_minute = (new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60;
                            var get_hour = parseInt(get_minute / 60);
                            var get_remain_min = (get_minute % 60);
                            console.log(get_hour + " hour and " + get_remain_min + " minute left")

                            if (get_hour == 0) {
                                exact_time_diff = get_remain_min + " minute left";
                            } else {
                                exact_time_diff = get_hour + " hour and " + get_remain_min + " minute left";
                            }
                            $(".pt_time_left").text(exact_time_diff)

                        }
                    }
                })

                if ($(".is_search_timings").val() == 0) {
                    $.ajax({
                        url: root_url + '/get_monthly_p_timing',
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                            "lat": lat,
                            "lng": lng,
                            "timezone": timezone,
                            "cur_city": cur_city
                        },
                        dataType: "html",
                        method: "POST",
                        cache: true,
                        success: function (response) {
                            $(".mnth_lst_usr_crnt_city").text($(".usr_crnt_city").text())
                            $(".full_month_p_timing_list").html(response);
                        }
                    })
                }
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
                    //  console.log(response)

                    var locations = [];
                    // var msqData = <?php //echo json_encode($near_mosques)   ?>;
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
        if ($(window).width() < 767) {
            $(".refine-searchWrap h2").click(function () {
                $(this).next().slideToggle();
            });
        }
        //$("#fixTable").tableHeadFixer();

        $("#refine-pt-form").submit(function (e) {
            //e.preventDefault();
            var status = true;
            if (!$(".pt-method").val()) {
                Notify.showNotification("Please select method", "error")
                status = false;
            }
            if ($(".pt-start-date").val() && !$(".pt-end-date").val()) {
                Notify.showNotification("Please select end date", "error")
                status = false;
            }
            if (!$(".pt-start-date").val() && $(".pt-end-date").val()) {
                Notify.showNotification("Please select start date", "error")
                status = false;
            }
            if ($(".pt-country").val()) {
                if (!$(".pt-state").val()) {
                    Notify.showNotification("Please select state", "error")
                    status = false;
                }
                if (!$(".pt-subregion").val()) {
                    Notify.showNotification("Please select suburb", "error")
                    status = false;
                }
            }
            if (status) {
                return true;
            }
            return false;
        })

        $(document).on("change", ".pt-country", function (e) {
            if ($(this).val()) {
                $.ajax({
                    url: root_url + '/prayer-timing/get-states',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "id": $(this).val()
                    },
                    method: "POST",
                    cache: false,
                    success: function (response) {
                        if (response.status) {
                            $(".pt-state").html('');
                            $(".pt-state").append($('<option></option>').val('').html('Select State'));
                            $.each(response.states, function (key, value) {
                                $(".pt-state").append($('<option></option>').val(value.id).html(value.name));
                            });
                        }
                    }
                });
            }
        })

        $(document).on("change", ".pt-state", function (e) {
            if ($(this).val()) {
                $.ajax({
                    url: root_url + '/prayer-timing/get-cities',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "id": $(this).val()
                    },
                    method: "POST",
                    cache: false,
                    success: function (response) {
                        if (response.status) {
                            $(".pt-subregion").html('');
                            $(".pt-subregion").append($('<option></option>').val('').html('Select Suburb'));
                            $.each(response.cities, function (key, value) {
                                $(".pt-subregion").append($('<option data-lat=' + value.Latitude + ' data-lont=' + value.Longitude + '></option>').val(value.CityId).html(value.City));
                            });
                        }
                    }
                });
            }
        })

        // var locations = [];
        //    var msqData = <?php //echo json_encode($near_mosques)   ?>;
        //    $.each(msqData, function (key, value) {
        //        locations[key] = [value.title, value.lat, value.lng, key + 1
        //        ];
        //    });
        //    var map = new google.maps.Map(document.getElementById('msq-near-map'), {
        //        zoom: 5,
        //        center: new google.maps.LatLng(<?php //echo $latitude;   ?>, <?php //echo $longitude;   ?>),
        //        mapTypeId: google.maps.MapTypeId.ROADMAP
        //    });
        //    var infowindow = new google.maps.InfoWindow();
        //    var marker, i;
        //    for (i = 0; i < locations.length; i++) {
        //        marker = new google.maps.Marker({
        //            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        //            map: map
        //        });

        //        google.maps.event.addListener(marker, 'click', (function (marker, i) {
        //            return function () {
        //                infowindow.setContent(locations[i][0]);
        //                infowindow.open(map, marker);
        //            }
        //        })(marker, i));
        //   	}
    })
</script>
@stop