@extends('front/layout/layout')
@section('content')
<style>.custom-text{
        border: 1px solid #5a4098;
        width: 100%;
        min-width: 130px;
        max-width: 100%;
        display: inline-block;
        padding: 6px 10px;}
    </style>
    <!-- include header -->
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
        </div>
    </section>
    

    <!-- breadcrumb section -->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>              
                    <li class="active">{{ $category_name }}</li>
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
                        <div id="left-section">
                            <div class="row">
                                <div class="col-sm-4 mobile-padd-0">
                                    <div class="refine-searchWrap mosqueSearch">
                                        <h2>Refine Searchabc</h2>
                                        
                                        <input type="hidden" class="gcategory_id" value="{{ $id }}">
                                        <input type="hidden" class="category_name" value="{{ $category_name }}">
                                        <input type="hidden" class="is_search_data" value="{{ !empty($inputs) ? 1 : 0 }}">
                                        {!! Form::open(array("role" => "form", 'class' => 'search-form refineForm', 'id' => 'MosqueSearchForm')) !!}
                                        <ul class="filter-togleWrap">
                                            <li class="filter-togle">
                                                <h3>keyword</h3>
                                                <div class="keywordDiv">
                                                    {!! Form::text("keyword", isset($inputs['keyword']) ? $inputs['keyword'] : null, array('class' => 'custom-text','placeholder'=>'Enter Keyword')) !!}

                                                </div>
                                            </li>
                                            <li class="filter-togle">
                                                @if($show_static_attributes->show_static_attributes == 1)
                                                <h3>Select State</h3>
                                                {!! Form::select('state', $states, isset($inputs['state']) ? $inputs['state'] : null, array('placeholder' => 'Select State', 'class' => ' custom-select msq-state')) !!}
                                            </li>
                                            <li class="filter-togle">
                                                <h3>Suburb</h3>
                                                {!! Form::select('suburb', $suburbs, isset($inputs['suburb']) ? $inputs['suburb'] : null, array('placeholder' => 'Suburb', 'class' => ' custom-select msq-suburb')) !!}
                                            </li>
                                            @endif
                                        </ul>
                                        <div class="btnWrap">
                                            <button type="submit" name="button" class="btn">search</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div class="col-sm-8">

                                    <div id="mosque-list-view" class="listing-block">
                                        <div class="top-section">
                                            <div class="top-titile">
                                                <div class="title">
                                                    <h1>{{ $category_name }}</h1>
                                                </div>
                                                <!--<span class="savesearch-link"><a href="#">Save the Search</a></span>-->
                                            </div>
                                            <div class="top-filter">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <ul class="view-type">
                                                            <li class="grid_view">
                                                                <a href="javascript:void(0)">

                                                                </a>
                                                            </li>
                                                            <li class="list_view active">
                                                                <a href="javascript:void(0)">

                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="filters">
                                                            <span class="sortby">Sort BY:</span>
                                                            <div class="sorting-options">
                                                                {!! Form::open(array("role" => "form", 'class' => 'search-form MosSort', 'method' => 'GET')) !!}
                                                                <?php
                                                                $sortOpt = array(
                                                                    'most_recent' => 'Most Recent',
                                                                    'title_asc' => 'Name A to Z',
                                                                    'title_desc' => 'Name Z to A'
                                                                );
                                                                ?>

                                                                {!! Form::select('sort', $sortOpt, $sortVar["val"], array('class' => 'mos_sort_drpdwn','id'=>'select-options-1')) !!}
                                                                {!! Form::close() !!}   

                                                            </div>
                                                            <span class="decending-img" style="cursor:pointer"><img src="{{url('plugins/front/img/descending.png')}}" alt=""></span>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <!-- style in class-fied grid.scss -->
                                        <div class="search-listing list-view">
                                            <div class="clearfix new-view-design">


                                                @if(count($data) > 0)
                                                @foreach($data as $dataKey => $dataVal)
                                                <?Php $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $dataVal['title']);
												 $url = Request::root() . '/food-detail/'. $encodetitle .'/'. $dataVal->food_products_id;
												 ?>
                                                
                                                <div class="list-row">
    <div class="clearfix">
      <div class="col-md-3 col-sm-6 col-xs-6"> <a href="{{ $url }}" class="clearfix">
        <div class="list-img">
        
        
        
          <?php /* <img src="{!! asset('/plugins/front/img/listing-img.jpg') !!}"> */ ?>
          <img src="{!! asset('/upload_images/food_products/backgroundimage/'.$dataVal->food_products_id.'/'.$dataVal->image) !!}" alt="">
          <span class="tab-badge" title="{!! Helper::time_since(time() - strtotime($dataVal->food_products_created)).' ago' !!}">{!! Helper::time_since_for_classified(time() - strtotime($dataVal->food_products_created)) !!}</span> </div>
        </a> </div>
    <div class="list-rowContent"> <div class="wishlist-wrap"> @if(in_array($dataVal->food_products_id, $wishlistItems)) <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $dataVal->food_products_id }}">
            <div class="heart"><i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" />--></div>
            </a> @else <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $dataVal->food_products_id }}">
            <div class="heart"> 
              <i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" />--> </div>
            </a> @endif</div> <div class="col-md-6 col-sm-6 col-xs-6 list-dataWrap"> <a href="{{ $url }}" class="clearfix">
        <div class="list-data">
          
          <span class="price">
          @if($dataVal->price > 0) {{ "$".$dataVal->price}} @endif
         </span>
          <h3>{{str_limit($dataVal->title,20)}}</h3>
          <p>
            {{strip_tags(str_limit($dataVal->description, 100))}}
            </p>
         
        </div>
        </a> </div>
      <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="list-right">
                                                               
                                                                <div class="location">
                                                                   

                                                                    <span class="classfd-timeago">{!! Helper::time_since(time() - strtotime($dataVal->food_products_created)) !!} ago</span>
                                                                </div>
                                                            </div>
      </div></div>
    </div>
  </div>
  
  
                                                @endforeach
                                                @else
                                                <li>No Record Found.</li>
                                                @endif
                                                <div class="pagination-wrapper">
                                                    <div class="pagination-wrapper-inner">
                                                        {!!$data->render()!!}
                                                    </div>
                                                </div>




                                                <!-- <nav aria-label="Page navigation">
                                                  <ul class="pagination">
                                                    <li>
                                                      <a href="javascript:void(0)" aria-label="Previous">
                                                        <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>

                                                      </a>
                                                    </li>
                                                    <li class="active"><a href="javascript:void(0)">1</a></li>
                                                    <li><a href="javascript:void(0)">2</a></li>
                                                    <li><a href="javascript:void(0)">3</a></li>
                                                    <li><a href="javascript:void(0)">4</a></li>
                                                    <li><a href="javascript:void(0)">5</a></li>
                                                    <li>
                                                      <a href="#" aria-label="Next">

                                                        <span aria-hidden="true"<i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                                      </a>
                                                    </li>
                                                  </ul>
                                                </nav> -->
                                            </div>
                                            <!-- End List View -->



                                            <!-- End style in class-fied grid.scss -->  

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <!-- style in sidebar.scss file -->
                        @include('front/element/home_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- categories section -->
    @if(sizeof($bottom_positions_ads) > 0)
    <section>
        <div id="feature-category">
            <div class="container">
                <div class="adv-banner">
                    @foreach($bottom_positions_ads as $bottom_ad_key => $bottom_single_ad)
                    <a href="{!! Helper::show_url($bottom_single_ad->image_url) !!}" target="_blank">
                        <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$bottom_single_ad->image) !!}" alt="banner-img">
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @elseif(!empty($default_bottom_position_ad))
    <section>
        <div id="feature-category">
            <div class="container">
                <div class="adv-banner">
                    <a href="{!! Helper::show_url($default_bottom_position_ad->image_url) !!}" target="_blank">
                        <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_bottom_position_ad->image) !!}" alt="banner-img">
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>

@stop

@section('scripts')

<script type="text/javascript">
    $(".savesearch-link a").click(function () {
        $('#SaveSearchModal').modal('show');
    });
    // get subregions of the selected state
    //$('#tree1').treed({openedClass: 'fa fa-caret-down', closedClass: 'fa fa-caret-right'});
    $(document).on('change', '.msq-state', function () {
        var st_val = $(this).val();
        if (st_val != '') {
            $.ajax({
                url: root_url + '/get-cities',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": st_val
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    if (response.status) {
                        $(".msq-suburb").html('');
                        $(".msq-suburb").append($('<option></option>').val('').html('Select Suburb'));
                        $.each(response.cities, function (key, value) {
                            $(".msq-suburb").append($('<option></option>').val(value.CityId).html(value.City));
                        });
                    }
                }
            });
        }
    })

    $(document).on('change', '.mos_sort_drpdwn', function () {
        $('.ms_srch_keyw').val($('.msq-keyword').val());
        $('.ms_srch_stat').val($('.msq-state').val());
        $('.ms_srch_suburb').val($('.msq-suburb').val());
        $('.MosSort').submit();
    });

    $(document).on('click', '.decending-img', function () {
        $('.ms_srch_keyw').val($('.msq-keyword').val());
        $('.ms_srch_stat').val($('.msq-state').val());
        $('.ms_srch_suburb').val($('.msq-suburb').val());
        $('.MosSort').submit();
    });
    
    var msqData, center_latitude, center_longitude;
    if($(".is_search_data").val() == 1) {
        msqData = <?php echo json_encode($data) ?>;
        msqData = msqData.data;
        $(".cat_near_you_txt h4").text($(".category_name").val()+" near you")
        $(".cat_near_you_txt").attr("href", root_url+"/classified_list/"+$(".gcategory_id").val())
        show_near_mosq(msqData, center_latitude, center_longitude);
    } else {
        // msqData = <?php //echo json_encode($near_mosques) ?>;
        // center_latitude = <?php //echo $latitude; ?>;
        // center_longitude = <?php //echo $longitude; ?>;
    }
    show_near_mosq(msqData, center_latitude, center_longitude);


    function show_near_mosq(msq_data, c_lat, c_lng) {
        var locations = [];
        
        $.each(msq_data, function (key, value) {
            locations[key] = [value.title, value.lat, value.lng, key + 1
            ];
        });

        if(!c_lat && !c_lng && locations.length > 0) {
            c_lat = locations[0][1];
            c_lng = locations[0][2];
        }

        var map = new google.maps.Map(document.getElementById('msq-near-map'), {
            zoom: 3,
            center: new google.maps.LatLng(c_lat, c_lng),
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

</script>

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
        $(".list_view").click(function () {
            $(".grid-view-listing").css({"display": "none"});
            $(".list-view-listing").css({"display": "block"});
            $(".grid_view").removeClass('active');
            $(".list_view").addClass('active');
        })
        $(".grid_view").click(function () {
            $(".list-view-listing").css({"display": "none"});
            $(".grid-view-listing").css({"display": "block"});
            $(".list_view").removeClass('active');
            $(".grid_view").addClass('active');
        })


        //sidebar prayer timing script startsssssssssssssssssssssssssssssssssssssssssssssssssssssssssss
        var latitute1 = 0;
        var longitude1 = 0;
        getLocation();
        get_today_prayer_timing(0, 0)
        if($(".is_search_data").val() == 0) {
            get_classified_map(-37.813628, 144.963058)
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, err);
            } else {
                //console.log("Geolocation is not supported by this browser.");
            }
        }
        function err(position) {
            get_today_prayer_timing(0, 0)
            if($(".is_search_data").val() == 0) {
                get_classified_map(-37.813628, 144.963058)
            }
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
                                if($(".is_search_data").val() == 0) {
                                    get_classified_map(position.coords.latitude, position.coords.longitude)
                                }
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
                    if($(".is_search_data").val() == 0) {
                        show_near_mosq(response, lat, lng);
                    }
                   // console.log(response)

                    // var locations = [];
                    // // var msqData = <?php //echo json_encode($near_mosques) ?>;
                    // $.each(response, function (key, value) {
                    //     locations[key] = [value.title, value.lat, value.lng, key + 1
                    //     ];
                    // });
                    // var map = new google.maps.Map(document.getElementById('msq-near-map'), {
                    //     zoom: 5,
                    //     center: new google.maps.LatLng(lat, lng),
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
                }
            })
        }
    })
</script>



@stop
