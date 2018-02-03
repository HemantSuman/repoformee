<!-- include header -->
<?php include("includes/header.php"); ?>

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
                                        @if($data->categoriesname['show_static_attributes'] == 1)
                                        <div class="mosque-info">
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
                                                    <label>{{$value->name}}</label>
                                                    <span>{{$value->attr_AllValues[$value->attr_value]}}</span>
                                                </li>
                                                @elseif(in_array($value->attr_type_name, ["Radio-button"]))
                                                <li>
                                                    <label>{{$value->name}}</label>
                                                    <span>{{ $result->multi_select[$value['attribute_id']]['attribute_value'][$result->multi_select[$value['attribute_id']]['selected'][0]] }}</span>
                                                </li>
                                                @elseif(in_array($value->attr_type_name, ["calendar", "Date", "Time"]))
                                                <li>
                                                    <label>{{$value->name}}</label>
                                                    <span>{{ str_replace(';',' - ',$value->attr_value ) }}</span>
                                                </li>
                                                @elseif(in_array($value->attr_type_name, ["Color"]))
                                                <li>
                                                    <label>{{$value->name}}</label>
                                                    <span style="background-color:{{$value->attr_value}}"></span>
                                                </li>
                                                @else
                                                <li>
                                                    <label>{{$value->name}}</label>
                                                    <span>{{$value->attr_value}}</span>
                                                </li>
                                                @endif
                                                @endif
                                                @endforeach

                                                @if(isset($data->multi_select))
                                                @foreach($data->multi_select as $key => $value)
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

                                            @endif

                                        </div>
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
                                                <div id="map" style="width:100%; height:305px"></div>
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
    <section>
        <div id="feature-category">
            <div class="container">
                <div class="adv-banner">
                    <!-- advertisement iframe appears here in replacement of this banner -->
                    <img src="assets/img/adv-banner.jpg" alt="adv-banner.jpg">
                </div>
            </div>
        </div>
    </section>
</div>

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
    })
</script>

<!-- include footer -->
<?php include("includes/footer.php"); ?>
