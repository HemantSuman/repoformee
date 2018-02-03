<div class="col-sm-9 col-md-6">
    <div id="list-view" class="listing-block job-listing">

        <div class="top-section">
            <div class="top-titile">
                <div class="title">
                    <h1 class="top-titile"><?php
                        if (!empty($cat_id)) {
                            echo $result[0]['catname'];
                        } else {
                            if (isset($request_category_data)) {
                                echo $request_category_data['name'];
                            } else {
                                echo 'All category';
                            }
                        }
                        ?></h1>
                </div>
                <?php
                //&& !empty($lat) && !empty($lng)
                if (!empty($cat_id) && !empty($itemname)) {
                    ?>
                    <span class="savesearch-link"><a href="javascript:void(0)" class="svd-srch-btn">Save this Search</a></span>
                <?php } ?>
            </div>

            <div class="top-filter">

                @include('/front/search/filter_middle_listing')

            </div>
            <!-- Premium Ads 22-->       

            @if(count($cond_premium_result) != 0)
            <div class="ad-panel">
                <div class="owl-carousel owl-theme">
                    @foreach($cond_premium_result as $key => $val) 

                    <?php
                    $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);

                    $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['classified_id'];
                    ?>

                    <div class="item">
                        <div class="ad-block"> <img src="{!! asset('/upload_images/classified/'.$val['classified_id'].'/'.$val['name']) !!}" alt="">
                            <div class="ad-block-info">
                                <div class="ad-block-row">
                                    <span class="ad-block-span ad-block-span1">
                                        <img src="{{ URL::asset('plugins/front/img/icon-1.png') }}" />
                                        <span>
                                            @if($val['price'] > 0) {{ "$".$val['price']}} @endif
                                        </span>
                                </div>
                                <div class="ad-block-row">
                                    <span class="ad-block-span ad-block-span2">
                                        {{str_limit($val['title'],20)}}
                                    </span>
                                </div>
                                <a class="pinkButton" href="{{ $url }}">Find Out More</a>
                            </div>
                            <div class="ad-block-star"> 
                                <span class="star-label">Premium  Advert</span> 
                                <span><i class="fa fa-star" aria-hidden="true"></i> </span> 
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            @endif



        </div>


        @if(isset($cond_featured_result) && (count($cond_featured_result) != 0))
        <!-- Add Featured listing-->
        <?php
        $view_type = (isset($request_data_arr['view_type'])) ? $request_data_arr['view_type'] : 'list-view';
        ?>
        <div class="car-search-listing search-result-list search-listing {{$view_type}}">
            <div class="clearfix new-view-design">


                @foreach($cond_featured_result as $key => $val)
                <?php
                $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);
                /* if ($val->btc == 1 || $val->sia == 1) {
                  $url = Request::root() . '/classified-detail/' . $encodetitle . '/' . $val->classified_id;
                  } else {
                  $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val->classified_id;
                  } */
                $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['classified_id'];
                ?>
                <div class="list-row">
                    <div class="clearfix">
                        <div class="col-md-3 col-sm-6 col-xs-6"> <a href="{{ $url }}" class="clearfix">
                                <div class="list-img">
                                    <div class="ad-block-star"> 
                                        <span class="star-label">Featured Advert</span> 
                                        <span><i class="fa fa-star" aria-hidden="true"></i> </span> 
                                    </div>
                                    <img src="{!! asset('/upload_images/classified/'.$val['classified_id'].'/'.$val['name']) !!}" alt="">
                                    <span class="tab-badge" title="{!! Helper::time_since(time() - strtotime($val['classified_created'])).' ago' !!}">
                                        {!! Helper::time_since_for_classified(time() - strtotime($val['classified_created'])) !!}
                                    </span> 
                                </div>
                            </a> </div>
                        <?php $wishlistItems = []; ?>
                        <div class="list-rowContent">
                            <div class="wishlist-wrap"> 
                                @if(in_array($val['classified_id'], $wishlistItems)) 
                                <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $val['classified_id'] }}">
                                    <div class="heart">
                                        <i class="fa fa-heart"></i> 
                                    </div>
                                </a> 
                                @else 
                                <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $val['classified_id'] }}">
                                    <div class="heart"> 
                                      <i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" />--> </div>
                                </a>
                                @endif
                            </div> 
                            <div class="col-md-6 col-sm-6 col-xs-6 list-dataWrap"> 
                                <a href="{{ $url }}" class="clearfix">
                                    <div class="list-data">

                                        <span class="price">
                                            @if($val['price'] > 0) {{ "$".$val['price']}} @endif
                                        </span>
                                        <h3>{{str_limit($val['title'],20)}}</h3>
                                        <p>
                                            {{strip_tags(str_limit($val['description'], 100))}}
                                        </p>

                                    </div>
                                </a> 
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="list-right">

                                    <div class="location">
                                        @if(!empty($val['location']))
                                        <?php $expSimLoc = explode(',', trim($val['location'])); ?>
                                        <span class="classfd-location"></span>
                                        @endif

                                        <span class="classfd-timeago">{!! Helper::time_since(time() - strtotime($val['classified_created'])) !!} ago</span>
                                    </div>
                                </div>
                            </div></div>
                    </div>
                </div>

                @endforeach


            </div>
        </div>
        @endif


        @if(isset($result_with_sort) && count($result_with_sort) != 0)
        <!-- Add normal listing-->
        <?php
        $view_type = (isset($request_data_arr['view_type'])) ? $request_data_arr['view_type'] : 'list-view';
        ?>
        <div class="car-search-listing search-result-list search-listing {{$view_type}}">
            <div class="clearfix new-view-design">


                @foreach($result_with_sort as $key => $val)
                <?php
                $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);
                /* if ($val->btc == 1 || $val->sia == 1) {
                  $url = Request::root() . '/classified-detail/' . $encodetitle . '/' . $val->classified_id;
                  } else {
                  $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val->classified_id;
                  } */
                $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['classified_id'];
                ?>
                <div class="list-row">
                    <div class="clearfix">
                        <div class="col-md-3 col-sm-6 col-xs-6"> <a href="{{ $url }}" class="clearfix">
                                <div class="list-img">
                                    @if( ($is_search_filter) && ($val['featured_classified'] == 1))
                                    <div class="ad-block-star"> 
                                        <span class="star-label">Featured Advert</span> 
                                        <span><i class="fa fa-star" aria-hidden="true"></i> </span> 
                                    </div>
                                    @endif
                                    <?php /* <img src="{!! asset('/plugins/front/img/listing-img.jpg') !!}"> */ ?>
                                    <img src="{!! asset('/upload_images/classified/'.$val['classified_id'].'/'.$val['name']) !!}" alt="">
                                    <span class="tab-badge" title="{!! Helper::time_since(time() - strtotime($val['classified_created'])).' ago' !!}">{!! Helper::time_since_for_classified(time() - strtotime($val['classified_created'])) !!}</span> </div>
                            </a> </div>
                        <?php $wishlistItems = []; ?>
                        <div class="list-rowContent"> <div class="wishlist-wrap"> @if(in_array($val['classified_id'], $wishlistItems)) <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $val['classified_id'] }}">
                                <div class="heart"><i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" />--></div>
                                </a> @else <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $val['classified_id'] }}">
                                    <div class="heart"> 
                                      <i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" />--> </div>
                                </a> @endif</div> <div class="col-md-6 col-sm-6 col-xs-6 list-dataWrap"> <a href="{{ $url }}" class="clearfix">
                                    <div class="list-data">

                                        <span class="price">
                                            @if($val['price'] > 0) {{ "$".$val['price']}} @endif
                                        </span>
                                        <h3>{{str_limit($val['title'],20)}}</h3>
                                        <p>
                                            {{strip_tags(str_limit($val['description'], 100))}}
                                        </p>

                                    </div>
                                </a> </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="list-right">

                                    <div class="location">
                                        @if(!empty($val['location']))
                                        <?php $expSimLoc = explode(',', trim($val['location'])); ?>
                                        <span class="classfd-location"></span>
                                        @endif

                                        <span class="classfd-timeago">{!! Helper::time_since(time() - strtotime($val['classified_created'])) !!} ago</span>
                                    </div>
                                </div>
                            </div></div>
                    </div>
                </div>

                @endforeach


            </div>
        </div>
        @endif

    </div>

</div>
<div class="col-sm-3">

    @include("/front/search/right_side_information_listing")
    @include("/front/search/right_sidebar_listing")
</div>



