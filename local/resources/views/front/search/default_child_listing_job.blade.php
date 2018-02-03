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
        <!-- Premium Ads 22-->       
        <?php //dd($cond_premium_result) ?>    
        @if(count($cond_premium_result) != '0')

        <div class="ad-panel"><div class="owl-carousel owl-theme">
                @foreach($cond_premium_result as $key => $val) 

                <?php
                $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);

                $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['classified_id'];
                ?>

                <div class="item"><div class="ad-block"> <img src="{!! asset('/upload_images/classified/'.$val['classified_id'].'/'.$val['name']) !!}" alt=""><?php /* ?><img src="{{ URL::asset('plugins/front/img/ad-banner.jpg') }}" /><?php */ ?>
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

        <div class="top-filter">
            
            @include('/front/search/filter_middle_listing')
            
        </div>
    </div>

    
    <?php
    $company_name = '';
    $job_type = '';
    $salary_range = '';
    ?>
    @if(isset($cond_featured_result) && (count($cond_featured_result) != 0))
    <!-- Add Featured listing-->
    <!-- style in class-fied grid.scss -->
    <div class="search-listing list-view">
        <div class="clearfix">
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
            @foreach($val['classified_attribute'] as $key => $value)

            @if($value['show_list'] == '1')

            @if(in_array($value['attr_type_name'],['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))

            @if($value['name'] == "job_type")
            <?php
            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
            //dd($attr_AllValues);
            ?>
            <?php $job_type = $attr_AllValues[$value['attr_value']]; ?>
            @endif
            @if($value['name'] == "company_name")
            <?php
            //$attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
            //dd($attr_AllValues);
            ?>
            <?php $company_name = $value['attr_value']; ?>
            @endif
            @if($value['name'] == "salary_range")
            <?php $salary_range = explode(";", $value['attr_value']); ?>
            @endif

            @endif

            @endif
            @endforeach
            <div class="list-row list-row-featured">
                <div class="job-list-box">
                    <div class="sidebar-products-list">
                        <div class="job-detail-box">                    
                            <a href="{{$url}}" class="product-title">{{str_limit($val['title'],20)}}</a>
                            <h3 class="job-salary">$<?php //echo $salary_range[0]  ?> - $<?php //echo $salary_range[1]  ?></h3>
                            <ul class="product-years-model">
                                <li><a href="{{$url}}"><?php echo $company_name; ?> </a></li>
                                <li><a href="{{$url}}"><?php echo $job_type ?> Position</a></li>
                            </ul>
                            <?php /* ?> <ul class="job-right-list">
                              <li>Challenging, creative and dynamic.</li>
                              <li>28+ year history of excellence in Payroll.</li>
                              </ul><?php */ ?>
                            <p class="job-right-list">
                                {{strip_tags(str_limit($val['description'], 100))}}
                            </p>
                            <?php
                            $parent_catname = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['p_cat_name']);
                            $parent_caturl = Request::root() . '/classified-list/' . $parent_catname . '/' . $val['p_cat_id'];
                            $catname = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['catname']);
                            $caturl = Request::root() . '/classified-list/' . $catname . '/' . $val['id'];
                            ?>
                            <ul class="breadcrumb">                      
                                <li><a href="{{ url('/') }}">Home</a> </li>
                                <li><a href="{{$parent_caturl}}">Jobs</a> </li>
                                <li><a href="{{$caturl}}">Accounting</a> </li>
                                <li><a href="javascript:void(0)">Specific Job Roles</a> </li>
                            </ul>
                        </div>
                        <div class="job-detail-right">
                            <div class="job-featured">
                                <i class="fa fa-star"></i> Featured Advert
                            </div>
                            <div class="sidebar-product-save">
                                <a class="wishlist-icon" href="javascript:void(0)"><span>Save this job</span><i class="fa fa-heart-o"></i></a>
                                <div class="job-company-logo">
                                    <img src="{{ URL:: asset('/plugins/front/img/company-logos.png')}}" alt="img" class="img-responsive">
                                </div>
                                <h4>@if(!empty($val['location']))
                                    <?php $expSimLoc = explode(',', trim($val['location'])); ?>
                                    <?php /* {{ $val['city'] }} */ ?>
                                    @endif <br>{!! Helper::time_since(time() - strtotime($val['classified_created'])) !!} ago</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>    
    @endif  


    <?php
    $company_name = '';
    $job_type = '';
    $salary_range = '';
    ?>
    @if(count($result_with_sort) != 0 )
    <!-- Add normal listing-->
    <!-- style in class-fied grid.scss -->
    <div class="search-listing list-view">
        <div class="clearfix">
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
            @foreach($val['classified_attribute'] as $key => $value)

            @if($value['show_list'] == '1')

            @if(in_array($value['attr_type_name'],['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))

            @if($value['name'] == "job_type")
            <?php
            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
            //dd($attr_AllValues);
            ?>
            <?php $job_type = $attr_AllValues[$value['attr_value']]; ?>
            @endif
            @if($value['name'] == "company_name")
            <?php
            //$attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
            //dd($attr_AllValues);
            ?>
            <?php $company_name = $value['attr_value']; ?>
            @endif
            @if($value['name'] == "salary_range")
            <?php $salary_range = explode(";", $value['attr_value']); ?>
            @endif

            @endif

            @endif
            @endforeach
            <div class="list-row {{ (($is_search_filter) && ($val['featured_classified'] == 1))? 'list-row-featured':'' }} ">
                <div class="job-list-box">
                    <div class="sidebar-products-list">
                        <div class="job-detail-box">                    
                            <a href="{{$url}}" class="product-title">{{str_limit($val['title'],20)}}</a>
                            <h3 class="job-salary">$<?php //echo $salary_range[0]  ?> - $<?php //echo $salary_range[1]  ?></h3>
                            <ul class="product-years-model">
                                <li><a href="{{$url}}"><?php echo $company_name; ?> </a></li>
                                <li><a href="{{$url}}"><?php echo $job_type ?> Position</a></li>
                            </ul>
                            <?php /* ?> <ul class="job-right-list">
                              <li>Challenging, creative and dynamic.</li>
                              <li>28+ year history of excellence in Payroll.</li>
                              </ul><?php */ ?>
                            <p class="job-right-list">
                                {{strip_tags(str_limit($val['description'], 100))}}
                            </p>
                            <?php
                            $parent_catname = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['p_cat_name']);
                            $parent_caturl = Request::root() . '/classified-list/' . $parent_catname . '/' . $val['p_cat_id'];
                            $catname = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['catname']);
                            $caturl = Request::root() . '/classified-list/' . $catname . '/' . $val['id'];
                            ?>
                            <ul class="breadcrumb">                      
                                <li><a href="{{ url('/') }}">Home</a> </li>
                                <li><a href="{{$parent_caturl}}">Jobs</a> </li>
                                <li><a href="{{$caturl}}">Accounting</a> </li>
                                <li><a href="javascript:void(0)">Specific Job Roles</a> </li>
                            </ul>
                        </div>
                        <div class="job-detail-right">
                            @if( ($is_search_filter) && ($val['featured_classified'] == 1))
                            <div class="job-featured">
                                <i class="fa fa-star"></i> Featured Advert
                            </div>
                            @endif
                            <div class="sidebar-product-save">
                                <a class="wishlist-icon" href="javascript:void(0)"><span>Save this job</span><i class="fa fa-heart-o"></i></a>
                                <div class="job-company-logo">
                                    <img src="{{ URL:: asset('/plugins/front/img/company-logos.png')}}" alt="img" class="img-responsive">
                                </div>
                                <h4>@if(!empty($val['location']))
                                    <?php $expSimLoc = explode(',', trim($val['location'])); ?>
                                    <?php /* {{ $val['city'] }} */ ?>
                                    @endif <br>{!! Helper::time_since(time() - strtotime($val['classified_created'])) !!} ago</h4>
                            </div>
                        </div>
                    </div>
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
