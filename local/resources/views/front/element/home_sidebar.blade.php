<!-- detail page sidebar -->
<aside id="home-sidebar">
    <!-- widgets -->
    
      <div class="widgets widget-information">
      <h4>Information</h4>
      <ul>
      {{--<li class="news-feed"><a href="{{ url('/news-feeds') }}">News Feeds</a></li>--}}
      @if(!empty($informationAreaCategories))
      <?php $i = 1; ?>
      @foreach($informationAreaCategories as $infocategories)
      <?php
      $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $infocategories['text']);
      $url = Request::root() . '/classified_list/' . $encodetitle . '/' . $infocategories['id'];
      if ($i == 10) {
      break;
      } else {
      ?>
      <li class="halal"><img style="width:25px;float: left;margin-right: 5px;" src="{{ URL::asset("/upload_images/categories/icon/$infocategories[id]/$infocategories[icon]") }}" ><a href="{{ $url }}">{{ $infocategories['text'] }}</a></li>
      <?php } $i++; ?>
      @endforeach

      <ul class="morechild">
      <?php $j = 1; ?>
      @foreach($informationAreaCategories as $infocategories1)
      <?php
      $encodetitle1 = preg_replace('/[^A-Za-z0-9-]+/', '-', $infocategories1['text']);
      $url1 = Request::root() . '/classified_list/' . $encodetitle1 . '/' . $infocategories['id'];
      if ($j > 3) {
      ?>
      <!--				<li class="halal"><a href="{{ url('/classified_list',$encodetitle1,$infocategories1['id']) }}">{{ $infocategories1['text'] }}</a></li>-->
      <li class="halal">
          <img style="width:25px;float: left;margin-right: 5px;" src="{{ URL::asset("/upload_images/categories/icon/$infocategories1[id]/$infocategories1[icon]") }}" >
          <a href="{{ $url1 }}">{{ $infocategories1['text'] }}</a>
      </li>
      <?php } $j++; ?>
      @endforeach
      </ul>
      {{--<span class="more">More</span>--}}

      @endif




      </ul>
      </div> 

    <!--@include("/front/search/right_side_information_listing")-->

    <!--    <div class="widgets widget-prayer-timing p_timing_sidebar_blck">
        </div>-->

    <div class="sidebarBox">
        <h4>Food Scan Bar</h4>
        <div class="sidebarBox-content">

            <div class="food-form">


                {!! Form::open(array("url" => "food_products/food_scan_bar", "id"=>"foodScanForm")) !!}
                <div class="form-group">
                    <label><span class="img-icon"><img src="{{ URL::asset('/plugins/front/img/img-icon1.png') }}" alt=""></span><span>Product Name</span></label>
                    <div class="form-field">
                        {!! Form::text('name', null, ['class' => 'form-control', 'id'=>'foodProductName', 'autocomplete' => 'off', 'placeholder'=>'Type product name here']) !!}

                    </div>
                </div>
                <div class="form-group">
                    <label><span class="img-icon"><img src="{{ URL::asset('/plugins/front/img/img-icon2.png') }}" alt=""></span><span>Barcode No.</span></label>
                    <div class="form-field">
                        {!! Form::text('bar_code', null, ['class' => 'form-control','placeholder'=>'Type Barcode here']) !!}
                    </div>
                </div>

                <div class="form-group food-form-btn"> 
                    <button type="submit" class="pinkButton">SCAN</button>
                </div>
                {!! Form::close() !!}

            </div>    


        </div>
    </div>


    <div class="pro-sidebarBox foodScan_main_div" style="display: none;">
        <div class="pro-Topbar foodScan_loading" style="display: none;">
            <img src="{{ URL::asset('/plugins/front/img/bar.png') }}" alt="">
        </div>
        <div class="pro-sidebarBox-desc foodScan_div" style="display: none;">
            <div class="pro-Name foodScanTitle"></div>
            <div class="pro-Name-info ">(Halal/Haram/Kosher/Vegan)</div>

            <div class="prolabel-info nutrition_value">

            </div>

            <div class="ingredients-row">
                <div class="ingredients-title">INGREDIENTS</div>
                <div class="ingredients-desc foodScanTitle_ingredients"></div>
            </div>

            <div class="sidebar-share-block">
                <div class="sidebar-share-title">SHARE</div>

                <div class="sidebar-share-title">
                    <div class="sidebar-share-list"><ul>
                            <li><a href="javascript:void(0)"><img src="{{ URL::asset('/plugins/front/img/facebook-icon.png') }}" alt=""></a></li>
                            <li><a href="javascript:void(0)"> <img src="{{ URL::asset('/plugins/front/img/instagram-icon.png') }}" alt=""></a></li>
                            <li><a href="javascript:void(0)"> <img src="{{ URL::asset('/plugins/front/img/twitter-icon.png') }}" alt=""></a></li>
                        </ul></div>
                </div>

            </div>

        </div>
        <div class="pro-sidebarBox-desc foodScan_no_records" style="display: none;">
            <div class="pro-Name">No records found!</div>
        </div>
    </div>


    <?php /* @if(!empty($near_mosques)) */ ?>
    <div class="widgets widget-location">
        <a href="{{ url('/classified_list/Mosques/33') }}" class="cat_near_you_txt"><h4>Mosques near you</h4></a>
        <!-- location widget iframe appears here in replacement of this banner -->
        <!-- <img src="{{ URL:: asset('/plugins/front/img/location-banner.jpg') }}" alt="location-banner"> -->
        <div id="msq-near-map" class="home_sidebar"></div>
    </div>
    <?php /* @endif */ ?>
    <div class="widgets fashion-sale">
        <!-- fashion-sale widget iframe appears here in replacement of this banner -->
        @if(sizeof($right_positions_ads) > 0)
        @foreach($right_positions_ads as $right_ad_key => $right_single_ad)
        <a href="{!! Helper::show_url($right_single_ad->image_url) !!}" target="_blank">
            <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$right_single_ad->image) !!}" alt="banner-img">
        </a>
        @endforeach
        @elseif(!empty($default_right_position_ad))
        <a href="{!! Helper::show_url($default_right_position_ad->image_url) !!}" target="_blank">
            <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_right_position_ad->image) !!}" alt="banner-img">
        </a>
        @endif
    </div>
</aside>


<script>
// Make toggle on more button (home-sidebar)

    $(document).ready(function () {
        $(".morechild").css({"display": "none"});
        $(".widget-information .more").on("click", function () {

            $(this).parent().find('.morechild').slideToggle()
                    .parents('ul')
                    .toggleClass('thisOpened');

            var aa = $(this).parents('ul');

            if (aa.hasClass('thisOpened')) {
                aa.find('.more').text('Less');
            } else {
                aa.find('.more').text('More');
            }
        });
    });
</script>