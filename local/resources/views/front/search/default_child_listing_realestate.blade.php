<div class="col-sm-9 col-md-6">
    <div id="list-view" class="listing-block job-listing">
        <div class="top-section">
            <div class="top-titile">
                <div class="title">
                    <h1><?php
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

                <!-- Premium Ads 22-->       
                <?php //dd($cond_premium_result) ?>    
                @if(count($cond_premium_result) != '0')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="real-slider-sec">
                            <div class="real-list slider">
                                @foreach($cond_premium_result as $key => $val) 

                                <?php
                                $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);

                                $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['classified_id'];
                                ?>

                                <div> 
                                    <div class="real-slider-thumb">
                                        <span class="featured-property"> <i class="fa fa-star"></i> Premium Property</span>
                                        <?php /* ?> <span class="property-brand"></i> Planet Web</span><?php */ ?>
                                        <img src="{!! asset('/upload_images/classified/'.$val['classified_id'].'/'.$val['name']) !!}" alt="">
                                    </div> 
                                    <div class="real-slider-detail">
                                        <ul class="real-bed-icon-list">
                                            <?php
                                            //dd($val['classified_attribute']);
                                            $num = 0;
                                            ?>
                                            @foreach($val['classified_attribute'] as $key => $value)
                                            <?php if ($num > 3) continue; ?>

                                            <?php //dd($value["attr_AllValues"][909]); ?>
                                            @if($value['show_list'] == 1)
                                            <?php //dd("ok"); ?>
                                            @if(in_array($value['attr_type_name'],['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))
                                            @if(in_array($value['attr_type_name'], ["Drop-Down"]))

                                            <?php $attvalue = $value['attr_value']; ?>

                                            <li><a href="javascript:void(0)"><span><?php echo $value["attribute_value"][$attvalue] ?></span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value[attribute_id]/$value[icon]")}}' alt="{{$value['name']}}" title="{{$value['name']}}"></a></li>


                                            @elseif(in_array($value['attr_type_name'], ["Radio-button"]))
                                            <li><a href="javascript:void(0)"><span>{{ $value[multi_select[$value['attribute_id']]]['attribute_value'][$value[multi_select[$value['attribute_id']]]['selected'][0]] }}</span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value[attribute_id]/$value[icon]")}}' alt="{{$value[name]}}" title="{{$value[name]}}"></a></li>

                                            @else

                                            <li><a href="javascript:void(0)"><span> {{$value['attr_value']}}</span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value[attribute_id]/$value[icon]")}}' alt="{{$value[name]}}" title="{{$value[name]}}"></a></li>

                                            @endif
                                            @endif
                                            @endif
                                            @endforeach                

                                        </ul>
                                        <ul class="real-bed-icon-list">
                                            <li><a href="javascript:void(0)"><span><i>{{str_limit($val['title'],20)}}</i></span></a></li>
                                        </ul>
                                        <h2 class="real-slide-budget">@if($val['price'] > 0) {{ "$".$val['price']}} @endif <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></h2>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <?php //dd($cond_featured_result) ?>      


                @if(isset($cond_featured_result) && (count($cond_featured_result) != 0))

                <div class="row">
                    <div class="col-sm-12">
                        <div class="real-listing-lists">

                            @foreach($cond_featured_result as $key => $val)
                            <?php
                            $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);

                            $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['classified_id'];
                            ?>

                            <div class="real-listing-box">
                                <div class="real-list-thumb">
                                    <div class="ad-block-star">
                                        <span class="star-label">Featured Advert</span> 
                                        <span><i class="fa fa-star" aria-hidden="true"></i> </span> 
                                    </div>

                                    <?php /* <img src="{!! asset('/plugins/front/img/listing-img.jpg') !!}"> */ ?>
                                    <a href="{{ $url}}">       <img src="{!! asset('/upload_images/classified/'.$val['classified_id'].'/'.$val['name']) !!}" alt="" class="img-responsive"></a>

                                </div>
                                <div class="real-list-detail">
                                    <h2 class="real-slide-budget">
                                        @if($val['price'] > 0) 
                                        ${{ $val['price'] }}
                                        @endif
                                        @if(isset($val['price_to']) && $val['price_to'] > 0)    
                                        - ${{ $val['price_to'] }}
                                        @endif <a class="wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="fa fa-heart-o"></i></a></h2>
                                    <ul class="real-bed-icon-list">
                                        <?php
                                        //dd($val['classified_attribute']);
                                        $num = 0;
                                        ?>
                                        @foreach($val['classified_attribute'] as $key => $value)
                                        <?php if ($num > 3) continue; ?>

                                        <?php //dd($value["attr_AllValues"][909]); ?>
                                        @if($value['show_list'] == 1)
                                        <?php //dd("ok"); ?>
                                        @if(in_array($value['attr_type_name'],['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))
                                        @if(in_array($value['attr_type_name'], ["Drop-Down"]))

                                        <?php $attvalue = $value['attr_value']; ?>

                                        <li><a href="javascript:void(0)"><span><?php echo $value['attribute_value'][$attvalue] ?></span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value[attribute_id]/$value[icon]")}}' alt="{{$value['name']}}" title="{{$value['name']}}"></a></li>


                                        <?php /* ?>@elseif(in_array($value['attr_type_name'], ["Radio-button"]))
                                          <li><a href="javascript:void(0)"><span>{{ $value[multi_select[$value['attribute_id']]]['attribute_value'][$value[multi_select[$value['attribute_id']]]['selected'][0]] }}</span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value[attribute_id]/$value[icon]")}}' alt="{{$value[name]}}" title="{{$value[name]}}"></a></li>

                                          @else

                                          <li><a href="javascript:void(0)"><span> {{$value['attr_value']}}</span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value[attribute_id]/$value[icon]")}}' alt="{{$value[name]}}" title="{{$value[name]}}"></a></li><?php */ ?>

                                        @endif
                                        @endif
                                        @endif
                                        @endforeach              
                                    </ul>
                                    <div class="real-list-detail-titles">
                                        <p><a href="{{ $url}}">{{str_limit($val['title'],20)}}</a></p>
                                        <?php
                                        $currentdate = strtotime("now");
                                        $show_ins_date = "";
                                        ?>
                                        @foreach($val['classified_hasmany_other'] as $key => $value)
                                        @if($value->other_slug == 'is_inspection_date') 
                                        <?php
                                        $ins_date = strtotime($value->other_value);
                                        if ($currentdate < $ins_date) {
                                            $show_ins_date = date("d F Y", $ins_date);
                                            break;
                                        }
                                        ?>
                                        @endif
                                        @endforeach
                                        @if($show_ins_date != '')

                                        <h3>Inspection <span><?php echo $show_ins_date ?></span></h3>

                                        @endif                 
                                        <span class="real-list-brand">


                                            @if($val['classified_users']['role_id'] == 0)
                                            {!! str_limit($val['classified_users']['name'], $limit = 14, $end = '...') !!}
                                            @else
                                            {!! str_limit($val['contact_name'], $limit = 14, $end = '...') !!}
                                            @endif

                                        </span>
                                    </div>
                                </div>
                            </div>                                

                            @endforeach

                        </div>
                    </div>
                </div>                                 

                @endif   


                @if(count($result_with_sort) != 0 )

                <div class="row">
                    <div class="col-sm-12">
                        <div class="real-listing-lists">

                            @foreach($result_with_sort as $key => $val)
                            <?php
                            $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);

                            $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['classified_id'];
                            ?>

                            <div class="real-listing-box">
                                <div class="real-list-thumb">

                                    @if( ($is_search_filter) && ($val['featured_classified'] == 1))
                                    <div class="ad-block-star">
                                        <span class="star-label">Featured Advert</span> 
                                        <span><i class="fa fa-star" aria-hidden="true"></i> </span>
                                    </div>
                                    @endif

                                    <?php /* <img src="{!! asset('/plugins/front/img/listing-img.jpg') !!}"> */ ?>
                                    <a href="{{ $url}}">       <img src="{!! asset('/upload_images/classified/'.$val['classified_id'].'/'.$val['name']) !!}" alt="" class="img-responsive"></a>

                                </div>
                                <div class="real-list-detail">
                                    <h2 class="real-slide-budget">
                                        @if($val['price'] > 0) 
                                        ${{ $val['price'] }}
                                        @endif
                                        @if(isset($val['price_to']) && $val['price_to'] > 0)    
                                        - ${{ $val['price_to'] }}
                                        @endif <a class="wishlist-icon" href="javascript:void(0)" tabindex="0"><i class="fa fa-heart-o"></i></a></h2>
                                    <ul class="real-bed-icon-list">
                                        <?php
                                        //dd($val['classified_attribute']);
                                        $num = 0;
                                        ?>
                                        @foreach($val['classified_attribute'] as $key => $value)
                                        <?php if ($num > 3) continue; ?>

                                        <?php //dd($value["attr_AllValues"][909]); ?>
                                        @if($value['show_list'] == 1)
                                        <?php //dd("ok"); ?>
                                        @if(in_array($value['attr_type_name'],['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))
                                        @if(in_array($value['attr_type_name'], ["Drop-Down"]))

                                        <?php $attvalue = $value['attr_value']; ?>

                                        <li><a href="javascript:void(0)"><span><?php echo $value['attribute_value'][$attvalue] ?></span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value[attribute_id]/$value[icon]")}}' alt="{{$value['name']}}" title="{{$value['name']}}"></a></li>


                                        <?php /* ?>@elseif(in_array($value['attr_type_name'], ["Radio-button"]))
                                          <li><a href="javascript:void(0)"><span>{{ $value[multi_select[$value['attribute_id']]]['attribute_value'][$value[multi_select[$value['attribute_id']]]['selected'][0]] }}</span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value[attribute_id]/$value[icon]")}}' alt="{{$value[name]}}" title="{{$value[name]}}"></a></li>

                                          @else

                                          <li><a href="javascript:void(0)"><span> {{$value['attr_value']}}</span> <img src='{{ URL:: asset("/upload_images/attributes/30px/$value[attribute_id]/$value[icon]")}}' alt="{{$value[name]}}" title="{{$value[name]}}"></a></li><?php */ ?>

                                        @endif
                                        @endif
                                        @endif
                                        @endforeach              
                                    </ul>
                                    <div class="real-list-detail-titles">
                                        <p><a href="{{ $url}}">{{str_limit($val['title'],20)}}</a></p>
                                        <?php
                                        $currentdate = strtotime("now");
                                        $show_ins_date = "";
                                        ?>
                                        @foreach($val['classified_hasmany_other'] as $key => $value)
                                        @if($value->other_slug == 'is_inspection_date') 
                                        <?php
                                        $ins_date = strtotime($value->other_value);
                                        if ($currentdate < $ins_date) {
                                            $show_ins_date = date("d F Y", $ins_date);
                                            break;
                                        }
                                        ?>
                                        @endif
                                        @endforeach
                                        @if($show_ins_date != '')

                                        <h3>Inspection <span><?php echo $show_ins_date ?></span></h3>

                                        @endif                 
                                        <span class="real-list-brand">


                                            @if($val['classified_users']['role_id'] == 0)
                                            {!! str_limit($val['classified_users']['name'], $limit = 14, $end = '...') !!}
                                            @else
                                            {!! str_limit($val['contact_name'], $limit = 14, $end = '...') !!}
                                            @endif

                                        </span>
                                    </div>
                                </div>
                            </div>                                

                            @endforeach

                        </div>
                    </div>
                </div>                                 

                @endif   

            </div>
        </div>
    </div>

</div>
<div class="col-sm-3">
    @include("/front/search/right_side_information_listing")
    @include("/front/search/right_sidebar_listing")
</div>