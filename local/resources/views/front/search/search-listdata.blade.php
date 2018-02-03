
<?php /* ?><div class="ad-panel"><div class="owl-carousel owl-theme">
  <div class="item"><div class="ad-block"> <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-banner.jpg" />
  <div class="ad-block-info">
  <div class="ad-block-row"><span class="ad-block-span ad-block-span1"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/icon-1.png" /><span>$460</span></span></div>
  <div class="ad-block-row"><span class="ad-block-span ad-block-span2">Kyak Dragon 2.5 Seater</span></div>
  <a class="pinkButton" href="javascript:void(0)">Find Out More</a> </div>
  <div class="ad-block-star"> <span class="star-label">Premium  Advert</span> <span><i class="fa fa-star" aria-hidden="true"></i> </span> </div>
  </div></div>
  <div class="item"><div class="ad-block"> <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-banner.jpg" />
  <div class="ad-block-info">
  <div class="ad-block-row"><span class="ad-block-span ad-block-span1"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/icon-1.png" /><span>$460</span></span></div>
  <div class="ad-block-row"><span class="ad-block-span ad-block-span2">Kyak Dragon 2.5 Seater</span></div>
  <a class="pinkButton" href="javascript:void(0)">Find Out More</a> </div>
  <div class="ad-block-star"> <span class="star-label">Premium  Advert</span> <span><i class="fa fa-star" aria-hidden="true"></i> </span> </div>
  </div></div>

  </div></div><?php */ ?>






<?php //dd($accordian_collection_array)?>


<div class="clearfix new-view-design">


    @if(!empty($accordian_collection_array))
    @if(count($accordian_collection_array)>0)

    <!--dd($accordian_collection_array)-->

    <div class="accordion-wrapper">

        @foreach($accordian_collection_array as $key => $catval)
        @if(!empty($catval[0]['cat_name']))
        <?php $num = 0; ?>
        <div class="accordion-row">
            <div class="accordionButton">{{ $catval[0]['cat_name'] }}</div>
            <div class="accordionContent">
                @foreach($catval as $val)
                <?php
                if ($num > 2)
                    continue;
                // dd($val);
                $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);
                $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['class_id'];
                ?>

                <div class="list-row">
                    <div class="clearfix">
                        <div class="col-md-3 col-sm-6 col-xs-6"> <a href="{{ $url }}" class="clearfix">
                                <div class="list-img">
                                    @if($val['featured_classified'])
                                    <div class="ad-block-star"> <span class="star-label">Featured Advert</span> <span><i class="fa fa-star" aria-hidden="true"></i> </span> </div>
                                    @endif

                                    <?php /* <img src="{!! asset('/plugins/front/img/listing-img.jpg') !!}"> */ ?>
                                    <img src="{!! asset('/upload_images/classified/'.$val['class_id'].'/'.$val['classifiedimage_name']) !!}" alt="">
                                    <span class="tab-badge" title="{!! Helper::time_since(time() - strtotime($val['classified_created'])).' ago' !!}">{!! Helper::time_since_for_classified(time() - strtotime($val['classified_created'])) !!}</span> </div>
                            </a> </div>
                        <div class="list-rowContent"> <div class="wishlist-wrap"> @if(in_array($val['class_id'], $wishlistItems)) <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $val['class_id'] }}">
                                <div class="heart"><i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" />--></div>
                                </a> @else <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $val['class_id'] }}">
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
                                        <?php /* ?> @if(!empty($val->location))
                                          <?php $expSimLoc = explode(',', trim($val->location)); ?>
                                          <span class="classfd-location">{{ $val->city }}</span>
                                          @endif<?php */ ?>

                                        <span class="classfd-timeago">{!! Helper::time_since(time() - strtotime($val['classified_created'])) !!} ago</span>
                                    </div>
                                </div>
                            </div></div>
                    </div>
                </div>
                <?php $num++; ?>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach

    </div>
    @endif
    @endif

    <?php /* ?><div class="topListing">
      <!--Featured listing add here-->

      </div> <?php */ ?> 

</div>
<?php //echo count($result); ?>
@if(!empty($accordian_collection_array))

<div class="dynamicplaces" style="display: none">
    <div class="dynamicplacesdata"> @if(!empty($staterestult))
        <li class="place">
            <label>Places</label>
            @foreach($staterestult as $key => $value)
            <ul>
                <li class="filterstate" value="{{$value->satet_id}}">
                    <label>{{$value->state_name}} ({{$value->state_count}})</label>
                    @if(!empty($value->city))

                    @foreach($value->city as $key1 => $data)
                    <ul>
                        <li class="filtercity" value="{{$data['city_ids']}}">
                            <label>{{$data['name']}} ({{$data['city_counts']}})</label>
                        </li>
                    </ul>
                    @endforeach
                    @endif </li>
            </ul>
            @endforeach </li>
        @endif </div>
</div>
<?php /* ?><input type="hidden" name="categoryheading" id="categoryheading" value="{{$result[0]['catname']}}">
  <div class="pagination-wrapper">
  <div class="pagination-wrapper-inner searchlist"> {!!$result->render()!!} </div>
  </div><?php */ ?>
@else
<h2> No Record Found</h2>
@endif