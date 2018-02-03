<div class="top-section">
    <div class="top-titile">
        <div class="title">
            <h1><?php
                if (!empty($cat_id)) {
                    echo $result[0]['catname'];
                } else {
                    echo "All Categories";
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
    <?php /* @if(count($cond_premium_result) != '0') */ ?>

    <div class="ad-panel"><div class="owl-carousel owl-theme">
            @foreach($result as $key => $val) 

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
    <?php /* @endif */ ?>

    <div class="top-filter">
        <div class="row">
            <div class="col-md-5">
                <ul class="view-type">
                    <li class="grid_view ">
                        <a href="javascript:void(0)">
                        </a>
                    </li>
                    <li class="list_view active ">
                        <a href="javascript:void(0)">
                        </a>
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
                    <span class="decending-img"><img src="{{ URL:: asset('/plugins/front/img/descending.png')}}" alt="img"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
//dd($cond_featured_result
$company_name = '';
$job_type = '';
$salary_range = '';
?>
@if(count($result) != 0 )
<!-- Add Featured listing-->
<!-- style in class-fied grid.scss -->
<div class="search-listing list-view">
    <div class="clearfix">
        @foreach($result as $key => $val)
        <?php
        $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val->title);
        if ($val->btc == 1 || $val->sia == 1) {
            $url = Request::root() . '/classified-detail/' . $encodetitle . '/' . $val->classified_id;
        } else {
            $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val->classified_id;
        }
        //dd($val->classified_attribute);
        ?>
        @foreach($val->classified_attribute as $key => $value)
        <?php //dd($value) ?>
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
        <div class="list-row">
            <div class="job-list-box">
                <div class="sidebar-products-list">
                    <div class="job-detail-box">                    
                        <a href="{{$url}}" class="product-title">{{str_limit($val->title,20)}}</a>
                        <h3 class="job-salary">$<?php //echo $salary_range[0] ?> - $<?php //echo $salary_range[1] ?></h3>
                        <ul class="product-years-model">
                            <li><a href="{{$url}}"><?php echo $company_name; ?> </a></li>
                            <li><a href="{{$url}}"><?php echo $job_type ?> Position</a></li>
                        </ul>
                        <?php /* ?> <ul class="job-right-list">
                          <li>Challenging, creative and dynamic.</li>
                          <li>28+ year history of excellence in Payroll.</li>
                          </ul><?php */ ?>
                        <p class="job-right-list">
                            {{strip_tags(str_limit($val->description, 100))}}
                        </p>
                        <?php
                        $parent_catarr = DB::table('categories')->where('id', $val->parentcatid)->pluck('name', 'id');
                        $parent_catname = $parent_catarr[$val->parentcatid];
                        $parent_catname = preg_replace('/[^A-Za-z0-9-]+/', '-', $parent_catname);
                        $parent_caturl = Request::root() . '/classified-list/' . $parent_catname . '/' . $val->parentcatid;
                        $catname = preg_replace('/[^A-Za-z0-9-]+/', '-', $val->catname);
                        $caturl = Request::root() . '/classified-list/' . $catname . '/' . $val->id;
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
                            <h4>@if(!empty($val->location))
                                <?php $expSimLoc = explode(',', trim($val->location)); ?>
                                {{ $val->city }}
                                @endif <br>{!! Helper::time_since(time() - strtotime($val->classified_created)) !!} ago</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


<div class="pagination-wrapper">
    <div class="pagination-wrapper-inner searchlist">
        {!!$result->render()!!}
    </div>
</div>


@else
<div>No Record Found.</div>
@endif  