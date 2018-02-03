@extends('front/layout/layout')

@section('content')
<style>
    .msqlist{ height: 202px !important;}
</style>
<div id="middle">
    <!-- style in main-banner.scss -->
    <section>
        <div id="main-banner">
            <div class="banner-carousel">
                <a href="javascript:void(0)">
                    <img class="owl-lazy" data-src="{!! asset('plugins/front/img/banner1.jpg') !!}" alt="banner-img">
                </a>
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
                                <div class="col-sm-4 mobile-padd-0">
                                    <div class="refine-searchWrap">
                                        <h2>Refine Search</h2>
                                        {!! Form::open(array("url" => "news-feeds", "role" => "form", 'class' => 'search-form nws-feed-srch-frm refineForm ', 'novalidate')) !!}
                                        <ul class="filter-togleWrap">
                                            <!-- <li class="filter-togle"><h3>Select Date :</h3>
                                                    {!! Form::text('date', null, array('placeholder' => 'Select Date', 'class' => 'datepicker nws-feed-date form-control')) !!}
                                            </li> -->
                                            <li class="filter-togle">
                                                <h3>keyword</h3>
                                                <div class="keywordDiv">
                                                    <input placeholder="Keyword" class="form-control nws-feed-keyword" type="text" name="keyword">

                                                </div>
                                            </li>		
                                            <div class="btnWrap">
                                                <button type="submit" name="button" class="btn">search</button>
                                            </div>
                                        </ul>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div class="col-sm-8">

                                    <div id="result-view" class="search-result">

                                        <div class="top-section">
                                            <div class="top-titile">
                                                <div class="title">
                                                    <h1>News Feed</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="news-feed nws-feeds">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs nws-feeds-ul" role="tablist">
                                                @if(!empty($feed_categories))
                                                @foreach($feed_categories as $fcId => $fcTitle)
                                                <li role="presentation"><a href="javascript:void(0)" aria-controls="home" role="tab" data-toggle="tab" data-title={{$fcTitle}} data-id="{{$fcId}}" class="fd-ns-ctgry">{{$fcTitle}}</a></li>
                                                @endforeach
                                                @endif
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active feeds-content" id="general">

                                                </div>
                                                <img src="{{ URL::asset('plugins/front/img/animation_processing.gif') }}" alt="processing-image" class="nws-feed-proc-img">
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
                        <!-- detail page sidebar -->
                        <aside id="home-sidebar">
                            <!-- widgets -->
                            <div class="widgets widget-information">
                                <h4>Information</h4>
                                <ul>
                                    {{--<li class="news-feed"><a href="javascript:void(0)">News Feeds</a></li>--}}
                                    @if(!empty($informationAreaCategories))
                                    <?php $i = 1; ?>
                                    @foreach($informationAreaCategories as $infocategories)
                                    <?php
//                                    dd($informationAreaCategories);
                                    if ($i == 10) {
                                        break;
                                    } else {
                                        ?>
                                        <li class="halal"><a href="{{ url('/classified_list/'.$infocategories['text'],$infocategories['id']) }}">{{ $infocategories['text'] }}</a></li>
                                    <?php } $i++; ?>
                                    @endforeach

                                    <ul class="morechild">
                                        <?php $j = 1; ?>
                                        @foreach($informationAreaCategories as $infocategories1)
                                        <?php if ($j > 10) { ?>
                                            <li class="halal"><a href="{{ url('/classified_list/'.$infocategories['text'],$infocategories1['id']) }}">{{ $infocategories1['text'] }}</a></li>
                                        <?php } $j++; ?>
                                        @endforeach
                                    </ul>
                                    {{--<span class="more">More</span>--}}

                                    @endif




                                </ul>
                            </div>

                            <div class="widgets widget-prayer-timing p_timing_sidebar_blck">
                                <?php /*
                                  <h4>Upcoming prayer</h4>
                                  <div class="payer-mid">
                                  <span class="paryer-Date">{!! ($is_today_timing == 1) ? date("D d M, Y") : date('D d M, Y', strtotime('+1 day', strtotime(date("d M Y")))) !!}</span>

                                  @if(!empty($final_current_day_timings))
                                  <input type="hidden" class="isTodayTiming" value="{{ $is_today_timing }}">
                                  @foreach($final_current_day_timings as $pt_name => $pt_time)
                                  @if($is_today_timing == 0)
                                  <div class="current-prayer">
                                  <div class="prayer-name">{!! $pt_name !!}</div>
                                  <div class="timing">{!! $pt_time !!}</div>
                                  <div class="leftTime">
                                  <span>Time left</span>
                                  <span class="pt_time_left"></span>
                                  </div>
                                  <input type="hidden" class="upcmgTime" value="{{ $pt_time }}">
                                  </div>
                                  <?php $getUpperKey = $pt_name; ?>
                                  <?php unset($final_current_day_timings[$pt_name]); ?>
                                  <?php break; ?>
                                  @else
                                  @if(time() < strtotime($pt_time))
                                  <div class="current-prayer">
                                  <div class="prayer-name">{!! $pt_name !!}</div>
                                  <div class="timing">{!! $pt_time !!}</div>
                                  <div class="leftTime">
                                  <span>Time left</span>
                                  <span class="pt_time_left"></span>
                                  </div>
                                  <input type="hidden" class="upcmgTime" value="{{ $pt_time }}">
                                  </div>
                                  <?php $getUpperKey = $pt_name; ?>
                                  <?php unset($final_current_day_timings[$pt_name]); ?>
                                  <?php break; ?>
                                  @endif
                                  @endif
                                  @endforeach
                                  @endif

                                  <?php
                                  $orderOfTiming = array();
                                  switch ($getUpperKey) {
                                  case "Fajr":
                                  $orderOfTiming = array("Dhuhr", "Asr", "Maghrib", "Isha");
                                  break;
                                  case "Dhuhr":
                                  $orderOfTiming = array("Asr", "Maghrib", "Isha", "Fajr");
                                  break;
                                  case "Asr":
                                  $orderOfTiming = array("Maghrib", "Isha", "Fajr", "Dhuhr");
                                  break;
                                  case "Maghrib":
                                  $orderOfTiming = array("Isha", "Fajr", "Dhuhr", "Asr");
                                  break;
                                  case "Isha":
                                  $orderOfTiming = array("Fajr", "Dhuhr", "Asr", "Maghrib");
                                  break;
                                  }
                                  ?>
                                  <div class="upcoming-prayer">
                                  @foreach($orderOfTiming as $orderOfTiming_index => $orderOfTiming_value)
                                  <a href="javascript:void(0)" class="player-div"><span>{!! $orderOfTiming_value !!}</span> {!! $final_current_day_timings[$orderOfTiming_value] !!} </a>
                                  @endforeach
                                  </div>
                                  </div>
                                  <div class="prayer-location">
                                  <ul>
                                  <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/icons/pray-loc.png') }}" alt=""> {{ $user_city }}</a></li>
                                  <li>
                                  <a href="#"><img src="{{ URL:: asset('/plugins/front/img/icons/pray-cal.png') }}" alt="">
                                  {!! ($is_today_timing == 1) ? date("d M Y") : date('d M Y', strtotime('+1 day', strtotime(date("d M Y")))) !!}
                                  </a>
                                  </li>
                                  </ul>
                                  </div>
                                  <div class="prayer-link">
                                  <a href="{{ url('/prayer-timings') }}">view this month praying time</a>
                                  </div>
                                 */ ?>
                            </div>

                            <div class="widgets widget-location">
                                <h4>Mosques near you</h4>
                                <!-- location widget iframe appears here in replacement of this banner -->
                                <!-- <img src="{{ URL:: asset('/plugins/front/img/location-banner.jpg') }}" alt="location-banner"> -->
                                <div id="msq-near-map"  class="msqlist"></div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section>
        <div id="feature-category">

            <div class="adv-banner">
                <!-- advertisement iframe appears here in replacement of this banner -->
                <img src="{{ URL::asset('plugins/front/img/adv-banner.jpg') }}" alt="adv-banner.jpg">
            </div>

        </div>
    </section>
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
        if ($(window).width() < 767) {
            $(".refine-searchWrap h2").click(function () {
                $(this).next().slideToggle();
            });
        }

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
                    // var msqData = <?php //echo json_encode($near_mosques)     ?>;
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
<script type="text/javascript">
    $(function () {
        $.ajax({
            url: root_url + '/news-feeds',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            method: "POST",
            cache: false,
            success: function (response) {
                $('.feeds-content').append(response);
                $(".nws-feeds").find("ul li:first").addClass("active");
                $(".nws-feed-proc-img").addClass("hide");
                $('#nws-feed-table').DataTable({
                    paging: true,
                    searching: false,
                    lengthChange: false,
                    ordering: false,
                    bInfo: false

                });

                if (($("#nws-feed-table tbody").find("tr").attr("is_data")) != 1) {
                    $(".dataTables_paginate").hide()
                }
            }
        });

        $(document).on("click", ".fd-ns-ctgry", function (event) {
            $(".nws-feed-proc-img").removeClass("hide");
            var $container = $('.feeds-content'),
                    $noRemove = $container.find('.nws-feed-proc-img');
            $container.html($noRemove);

            event.preventDefault();
            $.ajax({
                url: root_url + '/news-feeds',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "fcid": $(this).attr("data-id")
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    $(".nws-feed-proc-img").addClass("hide");
                    $('.feeds-content').html(response);
                    $('#nws-feed-table').DataTable({
                        paging: true,
                        searching: false,
                        lengthChange: false,
                        ordering: false,
                        bInfo: false

                    });

                    if (($("#nws-feed-table tbody").find("tr").attr("is_data")) != 1) {
                        $(".dataTables_paginate").hide()
                    }
                }
            });
        })

        $(".nws-feed-srch-frm").submit(function (event) {
            event.preventDefault();
            $(".nws-feed-proc-img").removeClass("hide");
            var $container = $('.feeds-content'),
                    $noRemove = $container.find('.nws-feed-proc-img');
            $container.html($noRemove);
            var feed_category_id = $(".nws-feeds").find("ul li.active a").attr("data-id");
            $.ajax({
                url: root_url + '/news-feeds',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "date": $(".nws-feed-date").val(),
                    "keyword": $(".nws-feed-keyword").val(),
                    "fcid": feed_category_id
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    $(".nws-feed-proc-img").addClass("hide");
                    $('.feeds-content').html(response);
                    $('#nws-feed-table').DataTable({
                        paging: true,
                        searching: false,
                        lengthChange: false,
                        ordering: false,
                        bInfo: false

                    });

                    if (($("#nws-feed-table tbody").find("tr").attr("is_data")) != 1) {
                        $(".dataTables_paginate").hide()
                    }
                }
            });
        })

        // var locations = [];
        //       var msqData = <?php //echo json_encode($near_mosques)     ?>;
        //       $.each(msqData, function (key, value) {
        //           locations[key] = [value.title, value.lat, value.lng, key + 1
        //           ];
        //       });
        //       var map = new google.maps.Map(document.getElementById('msq-near-map'), {
        //           zoom: 5,
        //           center: new google.maps.LatLng(<?php //echo $latitude;     ?>, <?php //echo $longitude;     ?>),
        //           mapTypeId: google.maps.MapTypeId.ROADMAP
        //       });
        //       var infowindow = new google.maps.InfoWindow();
        //       var marker, i;
        //       for (i = 0; i < locations.length; i++) {
        //           marker = new google.maps.Marker({
        //               position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        //               map: map
        //           });

        //           google.maps.event.addListener(marker, 'click', (function (marker, i) {
        //               return function () {
        //                   infowindow.setContent(locations[i][0]);
        //                   infowindow.open(map, marker);
        //               }
        //           })(marker, i));
        //       }
    })
</script>
@stop