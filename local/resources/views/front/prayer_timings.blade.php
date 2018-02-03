@extends('front/layout/layout')
@section('content')
<div id="middle">

    <!-- main banner section -->
    <section>
        <div id="main-banner">
            <div class="banner-carousel">
                @if(sizeof($top_positions_ads) == 0)
                    @if(!empty($default_top_position_ad))
                    <a href="{!! Helper::show_url($default_top_position_ad->image_url) !!}" target="_blank">
                        <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_top_position_ad->image) !!}" alt="banner-img">
                    </a>
                    @endif
                @else
                    @foreach($top_positions_ads as $top_ad_key => $top_single_ad)
                    <a href="{!! Helper::show_url($top_single_ad->image_url) !!}" target="_blank">
                        <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$top_single_ad->image) !!}" alt="banner-img">
                    </a>
                    @endforeach
                @endif
            </div>

            @include('front/element/searchbar-item')
        </div>
    </section>

    <!-- breadcrumb section -->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                  <li><a href="javascript:void(0)">Home</a></li>              
                  <li class="active">Mosques</li>
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
                                <div class="col-md-3">
                                    <aside class="search-section" >
                                        <div class="title">Refine Search</div>
                                        {!! Form::open(array("url" => "prayer-timings", "role" => "form", 'class' => 'search-form', 'id' => 'GetPrayerTimingForm')) !!}
                                            <ul>
                                                <li><label>Select Country :</label> <?php
                                                    // $countries = array(
                                                    //     '14' => 'Australia'
                                                    // ); ?>
                                                    {!! Form::select('country', $countryArray, isset($inputs['country']) ? $inputs['country'] : null, array('placeholder' => 'Select Country', 'class' => 'pt-ct', 'id' => 'pt-country')) !!}
                                                </li>
                                                <li><label>Select State :</label>
                                                    {!! Form::select('state', $states, isset($inputs['state']) ? $inputs['state'] : null, array('placeholder' => 'Select State', 'class' => 'pt-st', 'id' => 'pt-state')) !!}
                                                </li>
                                                <li><label>Suburb :</label>
                                                    {!! Form::select('subregion', $cities, isset($inputs['subregion']) ? $inputs['subregion'] : null, array('placeholder' => 'Select Suburb', 'class' => 'pt-sr', 'id' => 'pt-suburb')) !!}
                                                </li>
                                                <li><label>Method :</label>
                                                    {!! Form::select('method', $prayer_timings, isset($inputs['method']) ? $inputs['method'] : null, array('placeholder' => 'Select Method', 'class' => '', 'id' => 'pt-method-sbox')) !!}
                                                </li>
                                                <li><label>Start Date :</label>
                                                    {!! Form::text("start_date", isset($inputs['start_date']) ? $inputs['start_date'] : null, array('placeholder' => 'Select Start Date', 'class' => 'datepicker pt-st-date', 'id' => 'pt-sdate')) !!}
                                                </li>
                                                <li><label>End Date :</label>
                                                    {!! Form::text("end_date", isset($inputs['end_date']) ? $inputs['end_date'] : null, array('placeholder' => 'Select Start Date', 'class' => 'datepicker pt-ed-date', 'id' => 'pt-edate')) !!}
                                                </li>
                                                <li>
                                                    <input type="hidden" class="pt-latitude" name="latitude" value="">
                                                    <input type="hidden" class="pt-longitude" name="longitude" value="">
                                                    <input type="submit" value="Search" class="search-btn">
                                                </li>
                                            </ul>
                                        {!! Form::close() !!}
                                    </aside>
                                </div>
                                <div class="col-md-9 pad-0">
                                    <div class="row">
                                        <div id="prayer-timing" class="prayer-time-list">
                                            <div class="top-section">
                                                <div class="col-md-2 pull-right" style="margin-bottom: 6px;">
                                                    <div class="filters">
                                                        <ul class="share-print"> 
                                                            <li class="social-share">
                                                                <a href="javascript:void(0)">
                                                                    <img src="{{ URL::asset('plugins/front/img/share-icon.png') }}" alt="grid-view">
                                                                </a>
                                                                <div class="pt-share-icons">
                                                                    <span class='st_facebook_large' displayText='Facebook'></span>
                                                                    <span class='st_googleplus_large' displayText='Google +' st_url='Prayer Timings | Formee'></span>
                                                                    <span class='st_twitter_large' displayText='Tweet'></span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)" onclick="PrintDiv();">
                                                                    <img src="{{ URL::asset('plugins/front/img/print-icon.png') }}" alt="list-view">
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> 
                                                <div class="col-md-10">
                                                    <div class="title">
                                                        @if(!empty($headData))
                                                        <h2>{{ $headData['country'] ? $headData['city'].", ".$headData['state'].",".$headData['country'] : null }}</h2>
                                                        <p class="subtitle">({{ $headData['method'] }})</p>
                                                        <p class="start-time">
                                                            {{ $headData['sdate'] ?  date("l", strtotime($headData['sdate'])).",".date("F d,Y", strtotime($headData['sdate'])) : null }}  {{ $headData['edate'] ? " - ".date("l", strtotime($headData['edate'])).",".date("F d,Y", strtotime($headData['edate'])) : null }}</p>
                                                        @endif
                                                        <p class="end-time"><?php echo date("l")."|".date("F d,Y"); ?>. <span class="cr-islamic-time">Zul Hijjah 18, 1437</span></p>  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="prayer-timing-list" id="prayer-timing-list">
                                                    <div class="title">
                                                        <h3>Prayer Timing</h3>
                                                    </div>
                                                    <div class="upcoming-prayer">
                                                        Upcoming Prayer: <span class="upcoming-pt"></span>
                                                    </div>
                                                    <div class="responsive-table">                           
                                                        <table class="table table-bordered timing-table" id="pr-timings-table">
                                                            <tr>
                                                                <th class="date">
                                                                    <img src="{{ URL::asset('plugins/front/img/calander-icon.png') }}" alt="h-icons">Date</th>
                                                                </th>
                                                                <th class="fajr">
                                                                    <img src="{{ URL::asset('plugins/front/img/fajr-icon.png') }}" alt="h-icons">Fajr
                                                                </th>
                                                                <th class="sunrise">
                                                                    <img src="{{ URL::asset('plugins/front/img/sunrise-icon.png') }}" alt="h-icons">Sunrise
                                                                </th>
                                                                <th class="dhuhr">
                                                                    <img src="{{ URL::asset('plugins/front/img/dhuhr-icon.png') }}" alt="h-icons">Dhuhr
                                                                </th>
                                                                <th class="asr">
                                                                    <img src="{{ URL::asset('plugins/front/img/assr-icon.png') }}" alt="h-icons">Asr
                                                                </th>
                                                                <th class="sunset">
                                                                    <img src="{{ URL::asset('plugins/front/img/sunset-icon.png') }}" alt="h-icons">Sunset
                                                                </th>
                                                                <th class="date">
                                                                    <img src="{{ URL::asset('plugins/front/img/maghrib-icon.png') }}" alt="h-icons">Maghrib
                                                                </th>
                                                                <th class="date">
                                                                    <img src="{{ URL::asset('plugins/front/img/isha-icon.png') }}" alt="h-icons">Isha
                                                                </th>
                                                            </tr>

                                                            @if(!empty($times))
                                                                @foreach($times as $pt_date => $pt_single )
                                                                <tr>
                                                                    <td>{{ $pt_date }}</td>
                                                                    <td>{{ $pt_single[0] }}</td>
                                                                    <td>{{ $pt_single[1] }}</td>
                                                                    <td>{{ $pt_single[2] }}</td>
                                                                    <td>{{ $pt_single[3] }}</td>
                                                                    <td>{{ $pt_single[4] }}</td>
                                                                    <td>{{ $pt_single[5] }}</td>
                                                                    <td>{{ $pt_single[6] }}</td> 
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
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <!-- style in sidebar.scss file -->
                        @include('front/element/sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop

@section('scripts')
<script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=af574cb1-c8d1-456e-983c-4fcac8797a90"></script>
<script type="text/javascript">stLight.options({publisher: "af574cb1-c8d1-456e-983c-4fcac8797a90", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<script src="{{ URL::asset('plugins/front/plugins/prayer-timings/PrayTimes.js') }}"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU"></script>
<script src="{{ URL::asset('plugins/front/plugins/prayer-timings/praytime.js') }}"></script>
<!-- <script src="{{ URL::asset('plugins/front/js/praytime.js') }}"></script> -->
<script type="text/javascript">
    var d = new Date();
    var day = d.getDate();
    var month = d.getMonth();
    var year = d.getFullYear();
    var objDate = new Date().toLocaleString("en-us", { month: "short" });
    var pt_methods = ['Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Sunset', 'Maghrib', 'Isha']

    var currentTime = new Date();
    console.log(d.getTime())
    var latitute1;
    var longitude1;
    getLocation();

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, err);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }
    function err(position) {
        latitute1 = 0;
        longitude1 = 0;
            console.log("err");
            $.ajax({
                url: root_url + '/prayer-timing/get-monthly-timing',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "latitude": 0,
                    "longitude": 0,
                    "timezone": 0
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    if($('#pt-method-sbox').val() == '') {
                        $("#pr-timings-table").find("tr:gt(0)").remove();
                        $('#pr-timings-table').append(response);
                    }
                }
            });

            $.ajax({
                url: root_url + '/prayer-timing/get-timing',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "latitude": 0,
                    "longitude": 0,
                    "timezone": 0,
                    "current_time": currentTime
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    if (response.status) {
                        var stt = new Date();
                        stt = stt.getTime();

                        var upcomingPtIndex;
                        
                        if(response.isNextDayPrayer) {
                            upcomingPtIndex = 0
                            $('.upcoming-pt').text(pt_methods[0]+" - "+response.times[0][0]);
                            $('.pt-upcmng-mthd').text(pt_methods[0]);
                            $('.pt-upcmng-tm').text(response.times[0][0]);
                        } else {
                            $(response.times[0]).each(function (index, value) {
                                var endt = new Date(objDate+" "+day+", "+year+" "+value);
                                endt = endt.getTime();
                                if(index != 1 && index != 4)
                                if(stt < endt) {
                                    upcomingPtIndex = index
                                    $('.upcoming-pt').text(pt_methods[index]+" - "+value);
                                    $('.pt-upcmng-mthd').text(pt_methods[index]);
                                    $('.pt-upcmng-tm').text(value);
                                    return false;
                                }
                            });    
                        }
                        
                        console.log("upcomingPtIndex : "+upcomingPtIndex)
                        if(upcomingPtIndex == 0) {
                            $('.fajr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                            $('.asr-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                            $('.maghrib-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                            $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                        }
                        if(upcomingPtIndex == 2) {
                            $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                            $('.asr-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                            $('.maghrib-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                            $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                        }
                        if(upcomingPtIndex == 3) {
                            $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                            $('.asr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                            $('.maghrib-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                            $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                        }
                        if(upcomingPtIndex == 5) {
                            $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                            $('.asr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                            $('.maghrib-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                            $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                        }
                        if(upcomingPtIndex == 6) {
                            $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                            $('.asr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                            $('.maghrib-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                            $('.isha-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                        }
                    }
                }
            });

            $.ajax({
                url: root_url + '/get-near-mosque',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "latitude": 0,
                    "longitude": 0
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    if (response.status) {
                        var locations = [];
                        $.each(response.near_mosques, function (key, value) {
                            locations[key] = [value.title, value.lat, value.lng, key+1
                            ];
                        });
                        console.log(locations);
                        var map = new google.maps.Map(document.getElementById('msq-near-map'), {
                            zoom: 5,
                            center: new google.maps.LatLng(response.user_lat, response.user_lng),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        });
                        var infowindow = new google.maps.InfoWindow();
                        var marker, i;
                        for (i = 0; i < locations.length; i++) { 
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                map: map
                            });

                            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                return function() {
                                    infowindow.setContent(locations[i][0]);
                                    infowindow.open(map, marker);
                                }
                            })(marker, i));
                        }
                    }
                }
            });
        
    }
    function showPosition(position) {
        var geocoder;
        geocoder = new google.maps.Geocoder();
        latitute1 = position.coords.latitude;
        longitude1 = position.coords.longitude;
        var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    
        $.ajax({
            url: root_url + '/prayer-timing/get-monthly-timing',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "latitude": latitute1,
                "longitude": longitude1
            },
            method: "POST",
            cache: false,
            success: function (response) {
                if($('#pt-method-sbox').val() == '') {
                    //$('#pr-timings-table').html("");
                    //$('#pr-timings-table').find('tr:gt(0):last').remove();
                    $("#pr-timings-table").find("tr:gt(0)").remove();
                    $('#pr-timings-table').append(response);
                }
            }
        });

        $.ajax({
            url: root_url + '/prayer-timing/get-timing',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "latitude": latitute1,
                "longitude": longitude1,
                "current_time": currentTime
            },
            method: "POST",
            cache: false,
            success: function (response) {
                if (response.status) {
                    var stt = new Date();
                    stt = stt.getTime();
                    var upcomingPtIndex;
                    
                    if(response.isNextDayPrayer) {
                        upcomingPtIndex = 0
                        $('.upcoming-pt').text(pt_methods[0]+" - "+response.times[0][0]);
                        $('.pt-upcmng-mthd').text(pt_methods[0]);
                        $('.pt-upcmng-tm').text(response.times[0][0]);
                    } else {
                        $(response.times[0]).each(function (index, value) {
                            var endt = new Date(objDate+" "+day+", "+year+" "+value);
                            endt = endt.getTime();
                            if(index != 1 && index != 4)
                            if(stt < endt) {
                                upcomingPtIndex = index
                                $('.upcoming-pt').text(pt_methods[index]+" - "+value);
                                $('.pt-upcmng-mthd').text(pt_methods[index]);
                                $('.pt-upcmng-tm').text(value);
                                return false;
                            }
                        });
                    }

                    console.log("upcomingPtIndex : "+upcomingPtIndex)
                    if(upcomingPtIndex == 0) {
                        $('.fajr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                        $('.asr-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                        $('.maghrib-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                        $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                    }
                    if(upcomingPtIndex == 2) {
                        $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                        $('.asr-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                        $('.maghrib-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                        $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                    }
                    if(upcomingPtIndex == 3) {
                        $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                        $('.asr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                        $('.maghrib-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                        $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                    }
                    if(upcomingPtIndex == 5) {
                        $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                        $('.asr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                        $('.maghrib-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                        $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                    }
                    if(upcomingPtIndex == 6) {
                        $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                        $('.asr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                        $('.maghrib-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                        $('.isha-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                    }
                }
            }
        });

        $.ajax({
            url: root_url + '/get-near-mosque',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "latitude": latitute1,
                "longitude": longitude1
            },
            method: "POST",
            cache: false,
            success: function (response) {
                if (response.status) {
                    var locations = [];
                    $.each(response.near_mosques, function (key, value) {
                        locations[key] = [value.title, value.lat, value.lng, key+1
                        ];
                    });
                    console.log(locations);
                    
                    var map = new google.maps.Map(document.getElementById('msq-near-map'), {
                        zoom: 5,
                        center: new google.maps.LatLng(latitute1, longitude1),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    var infowindow = new google.maps.InfoWindow();
                    var marker, i;
                    for (i = 0; i < locations.length; i++) { 
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            map: map
                        });

                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                infowindow.setContent(locations[i][0]);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }
                }
            }
        });
    }

    
    $('.cr-islamic-time').text(writeIslamicDate());
    // get states of the selected country
    $(document).on('change', '.pt-ct', function() {
        var ct_val = $(this).val();
        if(ct_val != '') {
            $.ajax({
                url: root_url + '/prayer-timing/get-states',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": ct_val
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    if (response.status) {
                        $(".pt-st").html('');
                        $(".pt-st").append($('<option></option>').val('').html('Select State'));
                        $.each(response.states, function (key, value) {
                            $(".pt-st").append($('<option></option>').val(value.id).html(value.name));
                        });
                    }
                }
            }); 
        }
    })

    // get subregions of the selected state
    $(document).on('change', '.pt-st', function() {
        var st_val = $(this).val();
        if(st_val != '') {
            $.ajax({
                url: root_url + '/prayer-timing/get-cities',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": st_val
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    if (response.status) {
                        $(".pt-sr").html('');
                        $(".pt-sr").append($('<option></option>').val('').html('Select Suburb'));
                        $.each(response.cities, function (key, value) {
                            $(".pt-sr").append($('<option data-lat='+value.Latitude+' data-lont='+value.Longitude+'></option>').val(value.CityId).html(value.City));
                        });
                    }
                }
            }); 
        }
    })

    $.ajax({
        url: root_url + '/prayer-timing/get-monthly-timing',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "latitude": 0,
            "longitude": 0,
            "timezone": 0
        },
        method: "POST",
        cache: false,
        success: function (response) {
            if($('#pt-method-sbox').val() == '') {
                //$('#pr-timings-table').html("");
                //$('#pr-timings-table').find('tr:gt(0):last').remove();
                $("#pr-timings-table").find("tr:gt(0)").remove();
                $('#pr-timings-table').append(response);
            }
        }
    });

    $.ajax({
        url: root_url + '/prayer-timing/get-timing',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "latitude": 0,
            "longitude": 0,
            "timezone": 0,
            "current_time": currentTime
        },
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {
                var stt = new Date();
                stt = stt.getTime();
                var upcomingPtIndex;
                
                if(response.isNextDayPrayer) {
                    upcomingPtIndex = 0
                    $('.upcoming-pt').text(pt_methods[0]+" - "+response.times[0][0]);
                    $('.pt-upcmng-mthd').text(pt_methods[0]);
                    $('.pt-upcmng-tm').text(response.times[0][0]);
                } else {
                    $(response.times[0]).each(function (index, value) {
                        var endt = new Date(objDate+" "+day+", "+year+" "+value);
                        endt = endt.getTime();
                        if(index != 1 && index != 4)
                        if(stt < endt) {
                            upcomingPtIndex = index
                            $('.upcoming-pt').text(pt_methods[index]+" - "+value);
                            $('.pt-upcmng-mthd').text(pt_methods[index]);
                            $('.pt-upcmng-tm').text(value);
                            return false;
                        }
                    });
                }

                console.log("upcomingPtIndex : "+upcomingPtIndex)
                if(upcomingPtIndex == 0) {
                    $('.fajr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                    $('.asr-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                    $('.maghrib-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                    $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                }
                if(upcomingPtIndex == 2) {
                    $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                    $('.asr-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                    $('.maghrib-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                    $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                }
                if(upcomingPtIndex == 3) {
                    $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                    $('.asr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                    $('.maghrib-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                    $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                }
                if(upcomingPtIndex == 5) {
                    $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                    $('.asr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                    $('.maghrib-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                    $('.isha-pt').html(response.times[0][6]+" <span>"+pt_methods[6]+"</span>");
                }
                if(upcomingPtIndex == 6) {
                    $('.fajr-pt').html(response.times[0][0]+" <span>"+pt_methods[0]+"</span>");
                    $('.asr-pt').html(response.times[0][2]+" <span>"+pt_methods[2]+"</span>");
                    $('.maghrib-pt').html(response.times[0][3]+" <span>"+pt_methods[3]+"</span>");
                    $('.isha-pt').html(response.times[0][5]+" <span>"+pt_methods[5]+"</span>");
                }
            }
        }
    });

    $.ajax({
        url: root_url + '/get-near-mosque',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "latitude": 0,
            "longitude": 0
        },
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {
                var locations = [];
                $.each(response.near_mosques, function (key, value) {
                    locations[key] = [value.title, value.lat, value.lng, key+1
                    ];
                });
                console.log(locations);
                var map = new google.maps.Map(document.getElementById('msq-near-map'), {
                    zoom: 5,
                    center: new google.maps.LatLng(response.user_lat, response.user_lng),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                var infowindow = new google.maps.InfoWindow();
                var marker, i;
                for (i = 0; i < locations.length; i++) { 
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map
                    });

                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(locations[i][0]);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }
            }
        }
    });

    // get latitude, longitude of the selected city using data-attr 
    $(document).on('change', '.pt-sr', function() {
        var selected = $(this).find('option:selected');
        $('.pt-latitude').val(selected.data('lat'));
        $('.pt-longitude').val(selected.data('lont'))
    })

    if($('.dd-selected-value').val() == "") {
        error += "You must select a Backing\n";       
    }

    function PrintDiv() {
        console.log("Latitude : "+latitute1);  
        var divToPrint = document.getElementById('prayer-timing-list');
        var popupWin = window.open('', '_blank', 'width=300,height=300');
        popupWin.document.open();
        popupWin.document.write('<html><style type="text/css">table th, table td{border: 1px solid black}</style><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }

</script>
@stop