@extends('front/layout/layout')
@section('content')
<!-- include header -->
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
                        <div id="detail-page" class="inner-page-section">
                            <div class="top-section">
                                <div class="col-md-2 pull-right">
                                    <div class="filters">
                                        <ul class="share-print"> 
                                            <li class="social-share">
                                                <a href="javascript:void(0)">
                                                    <img src="{{ URL::asset('plugins/front/img/share-icon.png') }}" alt="grid-view">
                                                </a>
                                                <div class="pt-share-icons">
                                                    <span class='st_facebook_large' displayText='Facebook'></span>
                                                    <span class='st_googleplus_large' displayText='Google +'></span>
                                                    <span class='st_twitter_large' displayText='Tweet'></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                                <div class="col-md-10">
                                    <div class="title">
                                        <h2>{{ $data->title }}</h2>
                                    </div>
                                </div>
                            </div>
                            @if(!empty($data->classified_image))
                                <div class="detail-banner">
                                    <ul class="bxslider">
                                        @foreach($data->classified_image as $classfdImgKey => $classfdImgVal)
                                            <li>
                                                <img src="{!! asset('/upload_images/classified/'.$classfdImgVal->classified_id.'/'.$classfdImgVal->name) !!}" />
                                            </li>
                                        @endforeach
                                    </ul>
                                    
                                    <div id="bx-pager" style="margin-top: 6px;">
                                        @foreach($data->classified_image as $classfdImgKey => $classfdImgVal)
                                        <a data-slide-index="{{ $classfdImgKey }}" href="">
                                            <img src="{!! asset('/upload_images/classified/'.$classfdImgVal->classified_id.'/'.$classfdImgVal->name) !!}" width="100" height="100" />
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(!empty(strip_tags($data->description)))
                                <div class="information-section car-infromation">
                                    <div class="title">
                                        Description :
                                    </div>
                                    <div class="description">
                                        <!--<strong>Spring stock clearance on now !!!!!</strong>-->
                                        {{strip_tags($data->description)}}

                                    </div>
                                </div>
                            @endif

                            @if(sizeof($data->classified_attribute) > 0)
                                <div class="information-section car-infromation">
                                    <div class="title">
                                        Specifications :
                                    </div>
                                    <div class="description">
                                        <ul class="list-features">
                                            @foreach($data->classified_attribute as $key => $value)
                                            @if(in_array($value->attr_type_name,['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))
                                            @if(in_array($value->attr_type_name, ["Drop-Down"]))
                                            <li>
                                                <label>{{$value->name}}</label> : 
                                                <span>{{$value->attr_AllValues[$value->attr_value]}}</span>
                                            </li>
                                            @elseif(in_array($value->attr_type_name, ["Radio-button"]))
                                            <li>
                                                <label>{{$value->name}}</label> : 
                                                <span>{{ $data->multi_select[$value['attribute_id']]['attribute_value'][$data->multi_select[$value['attribute_id']]['selected'][0]] }}</span>
                                            </li>
                                            @elseif(in_array($value->attr_type_name, ["calendar", "Date", "Time"]))
                                            <li>
                                                <label>{{$value->name}}</label> : 
                                                <span>{{ str_replace(';',' - ',$value->attr_value ) }}</span>
                                            </li>
                                            @else
                                            <li>
                                                <label>{{$value->name}}</label> : 
                                                <span>{{$value->attr_value}}</span>
                                            </li>
                                            @endif
                                            @endif
                                            @endforeach

                                            @if(isset($data->multi_select))
                                            @foreach($data->multi_select as $key => $value)
                                            @if(in_array($value['attr_type_name_multi'],['Multi-Select']))
                                            <li>
                                                <label>{{$value['name']}}</label> : 
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
                            @endif
                            
                            
                            @if($data->categoriesname['show_static_attributes'] == 1)
                            <div class="location">
                                <h3>Location :</h3>
                                <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $data->location }}</p>
                                <div class="map-iframe">
                                    <!-- replace this banner img with location iframe -->
                                    <!-- <img src="{{ URL::asset('plugins/front/img/map.jpg') }}" alt="map.jpg"> -->
                                    <div id="map" style="width:865px; height:305px"></div>
                                </div>
                            </div>
                            @endif
                            @if($data->categoriesname['name'] == "Mosque")
                            <div class="prayer-timing">
                                <h3>Prayer Timing :</h3>
                                <table class="table table-bordered timing-table blue">
                                    <tbody><tr>
                                        <th class="fajr">
                                            <img src="{{ URL::asset('plugins/front/img/fajr-icon-light.png') }}" alt="h-icons">Fajr
                                        </th>
                                        <th class="dhuhr">
                                            <img src="{{ URL::asset('plugins/front/img/dhuhr-icon-light.png') }}" alt="h-icons">Dhuhr
                                        </th>
                                        <th class="asr">
                                            <img src="{{ URL::asset('plugins/front/img/assr-icon-light.png') }}" alt="h-icons">Asr
                                        </th>                                   
                                        <th class="date">
                                            <img src="{{ URL::asset('plugins/front/img/maghrib-icon-light.png') }}" alt="h-icons">Maghrib
                                        </th>
                                        <th class="date">
                                            <img src="{{ URL::asset('plugins/front/img/isha-icon-light.png') }}" alt="h-icons">Isha
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>{{ $times[0][0] }}</td>                                  
                                        <td>{{ $times[0][2] }}</td>
                                        <td>{{ $times[0][3] }}</td>
                                        <td>{{ $times[0][5] }}</td>
                                        <td>{{ $times[0][6] }}</td> 
                                    </tr>
                                    
                                </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <!-- style in sidebar.scss file -->
                        @include('front/element/detail_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section>
        <div id="feature-category">
            <div class="container">         
                <div class="adv-banner">
                    <!-- advertisement iframe appears here in replacement of this banner -->
                    @if(sizeof($bottom_positions_ads) == 0)
                        @if(!empty($default_bottom_position_ad))
                            <a href="{!! Helper::show_url($default_bottom_position_ad->image_url) !!}" target="_blank">
                                <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_bottom_position_ad->image) !!}" alt="adv-banner.jpg">
                            </a>
                        @endif
                    @else
                        @foreach($bottom_positions_ads as $bot_ad_key => $bot_single_ad)
                            <a href="{!! Helper::show_url($bot_single_ad->image_url) !!}" target="_blank">
                                <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$bot_single_ad->image) !!}" alt="adv-banner.jpg">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@stop

@section('scripts')
<script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=af574cb1-c8d1-456e-983c-4fcac8797a90"></script>
<script type="text/javascript">stLight.options({publisher: "af574cb1-c8d1-456e-983c-4fcac8797a90", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script type="text/javascript">
    function myMap() {
        var msq_latitude = "<?php echo $data->lat; ?>";
        var msq_logtitude = "<?php echo $data->lng; ?>";
        var myCenter = new google.maps.LatLng(msq_latitude, msq_logtitude);
        var mapCanvas = document.getElementById("map");
        var mapOptions = {center: myCenter, zoom: 5};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position:myCenter});
        marker.setMap(map);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
@stop