@extends('front/layout/layout')
@section('content')

<div id="middle">
    <!-- style in main-banner.scss -->
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

    <!-- style in main-categories.scss -->
    <section> 
        <?php
        $sucessmessage = Session::get('success');

        $dangermessage = Session::get('danger');
        ?>
        <input type="hidden" id="sucessmessage" value="<?php echo $sucessmessage ?>">
        <input type="hidden" id="dangermessage" value="<?php echo $dangermessage ?>">
        <div id="categoies-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-8">
                        <!-- style in product-listing.scss file -->
                        <div id="product-listing">
                            <!-- Nav tabs -->
                            <ul class="nav" role="tablist" id="myTabs">
                                <li role="presentation" class="active">
                                    {{--<a href="#category-1" role="tab" data-toggle="tab">Top Rated </a>--}}
                                </li>
                                <li role="presentation">
                                    {{--<a href="#category-2" role="tab" data-toggle="tab">Most Recent</a>--}}
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="category-1">
                                    <div class="row">
                                        <div class="p-listing grid" id="most-viewed-classified-list">

                                        </div>
                                        <div id="load-more">
                                            {{--<a href="javascript:void(0)" class="most_trending" offset_count="0">See More</a>--}}
                                        </div>
                                        <div class="col-md-12 text-center trend-clasf-loading hide">
                                            {{--<img src="{{ URL:: asset('/plugins/front/img/icons/p2.gif') }}">--}}
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="category-2">
                                    <div class="row">
                                        <div class="p-listing grid" id="most-recent-classified-list">

                                        </div>
                                        <div id="load-more">
                                            {{--<a href="javascript:void(0)" class="most_recent" offset_count="0">See More</a>--}}
                                        </div>
                                        <div class="col-md-12 text-center recent-clasf-loading hide">
                                            {{--<img src="{{ URL:: asset('/plugins/front/img/icons/p2.gif') }}">--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <!-- style in sidebar.scss file -->
                        @include('front/element/home_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- categories section -->
    @if(count($feactured_category) > 0)
    <section>
        <div id="feature-category">
            <div class="container">
                <h2>Featured Categories</h2>
                <div id="main-categories" class="categories featured-carousel">
                    @foreach($feactured_category as $fcFey => $fcData)
                    <?php
                    $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $fcData->name);
                    ?>
                    <div class="featuredcategories featuredcategories-new">
                        <a href='{{ url("/classified-list/$encodetitle/$fcData->id") }}'>
                            <div class="catergory-img">
                                <img src="{{ URL::asset('/upload_images/categories/backgroundimage/'.$fcData->id.'/'.$fcData->image) }}" class="img index_img" alt="category-img">

                                <!--<img src="{{ URL:: asset('/plugins/front/img/feature-img1.jpg') }}">-->
                            </div>
                            <div class="catergory-name"><div class="catergory-layer1"><div class="catergory-layer2">
                                        <h3>{{ @ucfirst($fcData->name) }}<br />
                                            @if(count($fcData->parentCategory_classifieds) > 0 )
                                            <span>{{count($fcData->parentCategory_classifieds)}} ads</span>
                                            @endif
                                        </h3></div></div></div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="app-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="app-img">
                        <img src="{{ URL:: asset('/plugins/front/img/app.png') }}" alt="formee-app">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="app-source">
                        <h3>Download the free app now !</h3>
                        <span class="slogan">insert formee slogan here !</span>
                        <ul>
                            <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/app1.png') }}"></a></li>
                            <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/app2.png') }}"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

<!--<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU?sensor=false"></script>-->

<script type="text/javascript">
    var wishlistItems = <?php echo json_encode(array_values($wishlistItems)) ?>;
    $("#query-button").click(function () {
        $('#query-modal').modal('show');
    });

//    var locations = [];
//    var msqData = <?php //echo json_encode($near_mosques)  ?>;
//
//
//    console.log(msqData.length)
//    if(msqData.length > 0) {
//        $.each(msqData, function (key, value) {
//            locations[key] = [value.title, value.lat, value.lng, key + 1
//            ];
//        });
//        var map = new google.maps.Map(document.getElementById('msq-near-map'), {
//            zoom: 5,
//            center: new google.maps.LatLng(<?php //echo $latitude;  ?>, <?php //echo $longitude;  ?>),
//            mapTypeId: google.maps.MapTypeId.ROADMAP
//
//        });
//        var infowindow = new google.maps.InfoWindow();
//        var marker, i;
//        for (i = 0; i < locations.length; i++) {
//            marker = new google.maps.Marker({
//                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
//                map: map
//            });
//
//            google.maps.event.addListener(marker, 'click', (function (marker, i) {
//                return function () {
//                    infowindow.setContent(locations[i][0]);
//                    infowindow.open(map, marker);
//                }
//            })(marker, i));
//        } 
//    }

    // var locations = [];
    // var msqData = <?php //echo json_encode($near_mosques)  ?>;
    // $.each(msqData, function (key, value) {
    //     locations[key] = [value.title, value.lat, value.lng, key + 1
    //     ];
    // });
    // var map = new google.maps.Map(document.getElementById('msq-near-map'), {
    //     zoom: 5,
    //     center: new google.maps.LatLng(<?php //echo $latitude;  ?>, <?php //echo $longitude;  ?>),
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


    var sucessmessage = $("#sucessmessage").val();

    var dangermessage = $("#dangermessage").val();

    if (sucessmessage != '')
    {
        Notify.showMessage(sucessmessage, 'done');
    }
    if (dangermessage != '')
    {
        Notify.showMessage(dangermessage, 'warning');
    }

</script>
<script type="text/javascript" src="{{  URL::asset('/plugins/front/js/home-page-script.js') }}"></script>
@stop
