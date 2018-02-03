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
                    <span class="savesearch-link">
                        <a href="javascript:void(0)" class="svd-srch-btn">Save this Search</a>
                    </span>
                <?php } ?>
            </div>
            <!-- Premium Ads 22-->       
            <?php //dd($cond_premium_result) ?>    
            @if(count($cond_premium_result) != '0')

            <div class="ad-panel"><div class="owl-carousel owl-theme">
                    @foreach($cond_premium_result as $key => $val) 

                    <?php
                    $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);

                    $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['classified_id'];
                    ?>

                    <div class="item"><div class="ad-block"> <img width="650" height="375" src="{!! asset('/upload_images/classified/'.$val['classified_id'].'/'.$val['name']) !!}" alt="">
                            <div class="ad-block-info">
                                <div class="ad-block-row"><span class="ad-block-span ad-block-span1"><img src="{{ URL::asset('plugins/front/img/icon-1.png') }}" /><span>
                                            @if($val['price'] > 0) {{ "$".$val['price']}} @endif</span></span></div>
                                <div class="ad-block-row"><span class="ad-block-span ad-block-span2">{{str_limit($val['title'],20)}}</span></div>
                                <a class="pinkButton" href="{{ $url }}">Find Out More</a> </div>
                            <div class="ad-block-star"> <span class="star-label">Premium  Advert</span> <span><i class="fa fa-star" aria-hidden="true"></i> </span> </div>
                        </div></div>
                    @endforeach

                </div></div>
            @endif


            <!--                                <div class="top-filter">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <ul class="view-type">
                                                            <li class="grid_view ">
                                                                <a href="javascript:void(0)"></a>
                                                            </li>
                                                            <li class="list_view active ">
                                                                <a href="javascript:void(0)"></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="filters">
                                                            <span class="sortby">Sort by:</span>
                                                            <div class="sorting-options">
            
                                                                <select id="select-options-1" class="sort-classified-listing">
                                                                    <option value="most_recent">Most Recent</option>
                                                                    <option value="title_asc">Name A to Z</option>
                                                                    <option value="title_desc">Name Z to A</option>
                                                                    <option value="price_htl">Price High to Low</option>
                                                                    <option value="price_lth">Price Low to High</option>
                                                                </select>
                                                            </div>
                                                            <span class="decending-img"><img src="{{ URL::asset('plugins/front/img/descending.png') }}" alt=""></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
        </div>


        <!-- Add Featured listing-->
        <div class="car-search-listing search-result-list search-listing list-view">
            <div class="clearfix new-view-design">

                <?php //dd($accordian_collection_array); ?>
                @if(!empty($accordian_collection_array))
                @if(count($accordian_collection_array)>0)



                <div class="accordion-wrapper">

                    @foreach($accordian_collection_array as $key => $catval)

                    <?php  $num = 0; ?>
                    <div class="accordion-row">
                        <div class="accordionButton">{{ $catval->name }}</div>
                        <div class="accordionContent">
                            @if(count($catval->classifieds_sort_by)>0)
                            
                            @foreach($catval->classifieds_sort_by as $val)
                            <?php
                            if ($num > 2)
                                continue;
//                             dd($accordian_collection_array);
                            $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);
                            $url1 = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['id'];
                            ?>

                            <div class="list-row">
                                <div class="clearfix">
                                    <div class="col-md-3 col-sm-6 col-xs-6"> <a href="{{ $url1 }}" class="clearfix">
                                            <div class="list-img">
                                                @if($val['featured_classified'])
                                                <div class="ad-block-star"> <span class="star-label">Featured Advert</span> <span><i class="fa fa-star" aria-hidden="true"></i> </span> </div>
                                                @endif

                                                <?php if(!empty($val['classified_image'])){?>
                                                    <img src="{!! asset('/upload_images/classified/'.$val['id'].'/'.$val['classified_image'][0]['name']) !!}" alt="">
                                                <?php } ?>
                                                <span class="tab-badge" title="{!! Helper::time_since(time() - strtotime($val['created_at'])).' ago' !!}">{!! Helper::time_since_for_classified(time() - strtotime($val['created_at'])) !!}</span> </div>
                                        </a> </div>
                                    <?php $wishlistItems = []; ?>
                                    <div class="list-rowContent"> 
                                        <div class="wishlist-wrap"> 
                                            @if(in_array($val['id'], $wishlistItems)) 
                                            <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $val['id'] }}">
                                                <div class="heart">
                                                    <i class="fa fa-heart"></i> 
                                                </div>
                                            </a> 
                                            @else 
                                            <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $val['id'] }}">
                                                <div class="heart"> 
                                                  <i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" />--> </div>
                                            </a> 
                                            @endif
                                        </div> 
                                        <div class="col-md-6 col-sm-6 col-xs-6 list-dataWrap"> 
                                            <a href="{{ $url1 }}" class="clearfix">
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
                                                    <?php /* ?> @if(!empty($val->location))
                                                      <?php $expSimLoc = explode(',', trim($val->location)); ?>
                                                      <span class="classfd-location">{{ $val->city }}</span>
                                                      @endif<?php */ ?>

                                                    <span class="classfd-timeago">{!! Helper::time_since(time() - strtotime($val['created_at'])) !!} ago</span>
                                                </div>
                                            </div>
                                        </div></div>
                                </div>
                            </div>
                            <?php $num++; ?>
                            @endforeach
                            
                            @else
                                no products found!
                            @endif
                            
                        </div>
                    </div>

                    @endforeach

                </div>
                @endif
                @endif

                <?php /* ?><div class="topListing">
                  <!--Featured listing add here-->

                  </div> <?php */ ?> 

            </div>
        </div>

    </div>

</div>
<div class="col-sm-3">
    @include("/front/search/right_side_information_listing")
    @include("/front/search/right_sidebar_listing")
</div>

