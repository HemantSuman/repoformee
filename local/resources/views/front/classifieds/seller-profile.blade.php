@extends('front/layout/layout')
@section('content')

<div id="middle" class="no-banner">
    <div class="dashboard-banner">
        <div class="userImg">
            
            @if(!empty($userExistingAdds['data'][0]['classified_users']['image']))
                <img src="{{ URL::asset('upload_images/users/'.$userExistingAdds['data'][0]['classified_users']['id'].'/'.$userExistingAdds['data'][0]['classified_users']['image']) }}" alt="profile-img-new">
            @else
                <img src="{{ URL::asset('plugins/front/img/profile-img-new.jpg') }}" alt="profile-img">
            @endif
                
        </div>
        
    </div>
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                   
                    <li class="active">User profile</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="mine-profileWrap">
        
            
                <div class="userName">
                   
                   {{$userExistingAdds['data'][0]['classified_users']['name']}}
                </div>
            
        
        <div id="main-inner-section">

            <div class="container">
                <div class="col-sm-10 col-sm-offset-1">

                        
                    <div id="list-view" class="listing-block mine-profile">
                        

                            <div class="search-listing search-result-list list-view">
                                <div class="car-search-listing">

                                    @if(count($userExistingAdds) != 0)

                                  
                                        @foreach($userExistingAdds['data'] as $key1 => $val)

                                        <div class="row list-row">
                                            <div  class="clearfix">
                                                <div class="col-md-3 col-sm-6 col-xs-6">
                                                    <div class="list-img">
                                                        <a href="{{ Request::root().'/classifieds/'.$val['id']}}">
                                                        <img src="{!! asset('/upload_images/classified/'.$val['id'].'/'.$val['classified_image'][0]['name']) !!}" alt="listing-img">
                                                        <span class="tab-badge">{!! Helper::time_since_for_classified(time() - strtotime($val['created_at'])) !!}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="list-data">
                                                            <h3><a href="{{ Request::root().'/classifieds/'.$val['id']}}">{{$val['title']}}</a></h3>
                                                            <p>{{strip_tags(str_limit($val['description'], 150))}}</p>
                                                            
                                                            <?php
                                                            if (isset($val['classified_attribute']) && !empty($val['classified_attribute'])) {
                                                                ?>

                                                                <div class="specification-table">
                                                                    <ul>
                                                                        <?php
                                                                        foreach ($val['classified_attribute'] as $i => $v) {

                                                                            if (in_array($v['attr_type_name'], ['Multi-Select', 'Radio-button'])) {
                                                                                ?>
                                                                                <li>
                                                                                    <label><img src="{{ url("upload_images/attributes/30px/$v[attribute_id]/$v[icon]") }}" alt="specification-icon"></label>
                                                                                    <?php /*<label><img src="{{url('plugins/front/img/icons/share.png')}}" alt="icon"></label>*/ ?>
                                                                                    <span>{{ str_limit($v['attribute_value'][$v['attr_value']], 15) }}</span>
                                                                                </li>


                                                                            <?php } else if (in_array($v['attr_type_name'], ['Drop-Down'])) {
                                                                                ?>
                                                                                <li>
                                                                                    <label><img src="{{ url("upload_images/attributes/30px/$v[attribute_id]/$v[icon]") }}" alt="specification-icon"></label>
                                                                                    <?php /*<label><img src="{{url('plugins/front/img/icons/share.png')}}" alt="icon"></label>*/ ?>
                                                                                    <span>{{ str_limit($v['attr_AllValues'][$v['attr_value']], 10) }}</span>
                                                                                </li>


                                                                            <?php } else {
                                                                                ?>
                                                                                <li>
                                                                                    <label><img src="{{ url("upload_images/attributes/30px/$v[attribute_id]/$v[icon]") }}" alt="specification-icon"></label>
                                                                                    <?php /*<label><img src="{{url('plugins/front/img/icons/share.png')}}" alt="icon"></label> */ ?>
                                                                                    <span>{{ str_limit($v['attr_value'], 10) }}</span>
                                                                                </li>


                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>

                                                            @if($val['price']> 0)
                                                            <span class="price">${{$val['price']}}</span>
                                                            @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="list-right">
                                                        @if(in_array($val['id'], $wishlistItems))
                                                            <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $val['id'] }}">
                                                                <div class="heart"><i class="fa fa-heart"></i></div>
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $val['id'] }}">
                                                                <div class="heart">
                                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                                </div>
                                                            </a>
                                                        @endif
                                                        
                                                       <div class="location">
                                                            @if(!empty($val['location']))
                                                                <?php $expSimLoc = explode(',',trim($val['location'])); ?>
                                                                <span class="classfd-location">{{ $expSimLoc[0] }}</span>
                                                            @endif
                                                       </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    
                                    @else
                                    No Records Found.
                                    @endif  
                                    <div class="pagination-wrapper">
                                        <div class="pagination-wrapper-inner">

                                            {!!$userlist->render()!!}

                                        </div>
                                    </div>

                                </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<!--<div id="middle" class="no-banner">
     categories section 
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="col-md-10 col-md-offset-1">
                     style in wishlist.scss file 
                    <div class="mine-profile">
                        <div class="mine-image">
                            <span>
                                <img src="assets/img/profile-img.jpg" alt="profile-img-new">
                            </span>
                        </div>
                        <div class="mine-details">
                            <div class="title">Jasmin Leo</div>
                            <div class="address">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;:&nbsp;
                                Sitapura Industrial Area, Sitapura, Jaipur, Rajasthan, India 
                            </div>
                        </div>
                    </div>
                    <div id="left-section" class="Wishlist">
                        <div id="result-view" class="search-result">
                             style in mosque-listing.scss 
                            <div class="car-search-listing">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <div class="col-md-3 col-sm-4">
                                                <div class="img-sec">
                                                    <img src="assets/img/car-listing-1.jpg" alt="listing-img">
                                                    <span class="star-icon active">
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-8">
                                                <div class="description-sec">
                                                    <div class="head">
                                                        <div class="title">Hinchinbrook Mosque</div>
                                                        <div class="locate">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            Brsbane South West, Yeerongpilly
                                                        </div>
                                                        <span class="price-tag">$8,900.00</span>
                                                    </div>
                                                    <p>It is in mint condition. Looking for a clean car you can drive to work & get dirty on the weekend? This 2012 Great wall V240 is the 4WD for you.It is in mint condition. </p>
                                                    <div class="specification-table">
                                                        <ul>
                                                            <li>
                                                                <img src="assets/img/specification-icon-1.png"  alt="specification-icon">Convertible
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-2.png"  alt="specification-icon">2015
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-3.png"  alt="specification-icon">
                                                                Auto
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-4.png"  alt="specification-icon">6 cyl 3.0L
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-5.png"  alt="specification-icon">150000 km
                                                            </li>
                                                            <li>
                                                                10/10/2016
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <div class="col-md-3 col-sm-4">
                                                <div class="img-sec">
                                                    <img src="assets/img/car-listing-1.jpg" alt="listing-img">
                                                    <span class="star-icon active">
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-8">
                                                <div class="description-sec">
                                                    <div class="head">
                                                        <div class="title">Hinchinbrook Mosque</div>
                                                        <div class="locate">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            Brsbane South West, Yeerongpilly
                                                        </div>
                                                        <span class="price-tag">$8,900.00</span>
                                                    </div>
                                                    <p>It is in mint condition. Looking for a clean car you can drive to work & get dirty on the weekend? This 2012 Great wall V240 is the 4WD for you.It is in mint condition. </p>
                                                    <div class="specification-table">
                                                        <ul>
                                                            <li>
                                                                <img src="assets/img/specification-icon-1.png"  alt="specification-icon">Convertible
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-2.png"  alt="specification-icon">2015
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-3.png"  alt="specification-icon">
                                                                Auto
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-4.png"  alt="specification-icon">6 cyl 3.0L
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-5.png"  alt="specification-icon">150000 km
                                                            </li>
                                                            <li>
                                                                10/10/2016
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <div class="col-md-3 col-sm-4">
                                                <div class="img-sec">
                                                    <img src="assets/img/car-listing-1.jpg" alt="listing-img">
                                                    <span class="star-icon active">
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-8">
                                                <div class="description-sec">
                                                    <div class="head">
                                                        <div class="title">Hinchinbrook Mosque</div>
                                                        <div class="locate">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            Brsbane South West, Yeerongpilly
                                                        </div>
                                                        <span class="price-tag">$8,900.00</span>
                                                    </div>
                                                    <p>It is in mint condition. Looking for a clean car you can drive to work & get dirty on the weekend? This 2012 Great wall V240 is the 4WD for you.It is in mint condition. </p>
                                                    <div class="specification-table">
                                                        <ul>
                                                            <li>
                                                                <img src="assets/img/specification-icon-1.png"  alt="specification-icon">Convertible
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-2.png"  alt="specification-icon">2015
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-3.png"  alt="specification-icon">
                                                                Auto
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-4.png"  alt="specification-icon">6 cyl 3.0L
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-5.png"  alt="specification-icon">150000 km
                                                            </li>
                                                            <li>
                                                                10/10/2016
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <div class="col-md-3 col-sm-4">
                                                <div class="img-sec">
                                                    <img src="assets/img/car-listing-1.jpg" alt="listing-img">
                                                    <span class="star-icon active">
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-8">
                                                <div class="description-sec">
                                                    <div class="head">
                                                        <div class="title">Hinchinbrook Mosque</div>
                                                        <div class="locate">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            Brsbane South West, Yeerongpilly
                                                        </div>
                                                        <span class="price-tag">$8,900.00</span>
                                                    </div>
                                                    <p>It is in mint condition. Looking for a clean car you can drive to work & get dirty on the weekend? This 2012 Great wall V240 is the 4WD for you.It is in mint condition. </p>
                                                    <div class="specification-table">
                                                        <ul>
                                                            <li>
                                                                <img src="assets/img/specification-icon-1.png"  alt="specification-icon">Convertible
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-2.png"  alt="specification-icon">2015
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-3.png"  alt="specification-icon">
                                                                Auto
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-4.png"  alt="specification-icon">6 cyl 3.0L
                                                            </li>
                                                            <li>
                                                                <img src="assets/img/specification-icon-5.png"  alt="specification-icon">150000 km
                                                            </li>
                                                            <li>
                                                                10/10/2016
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li>
                                            <a href="javascript:void(0)" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                Previous
                                            </a>
                                        </li>
                                        <li><a href="javascript:void(0)">1</a></li>
                                        <li><a href="javascript:void(0)">2</a></li>
                                        <li><a href="javascript:void(0)">3</a></li>
                                        <li><a href="javascript:void(0)">4</a></li>
                                        <li><a href="javascript:void(0)">5</a></li>
                                        <li>
                                            <a href="#" aria-label="Next">
                                                Next
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>-->
@stop

@section('scripts')

<script type="text/javascript">
    $.fn.extend({
        treed: function (o) {

            var openedClass = 'glyphicon-minus-sign';
            var closedClass = 'glyphicon-plus-sign';

            if (typeof o != 'undefined') {
                if (typeof o.openedClass != 'undefined') {
                    openedClass = o.openedClass;
                }
                if (typeof o.closedClass != 'undefined') {
                    closedClass = o.closedClass;
                }
            }
            ;

            //initialize each of the top levels
            var tree = $(this);
            tree.addClass("tree");
            tree.find('li').has("ul").each(function () {
                var branch = $(this); //li with children ul
                branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                branch.addClass('branch');
                branch.on('click', function (e) {
                    if (this == e.target) {
                        var icon = $(this).children('i:first');
                        icon.toggleClass(openedClass + " " + closedClass);
                        $(this).children().children().toggle();
                    }
                })
                branch.children().children().toggle();
            });
            //fire event from the dynamically added icon
            tree.find('.branch .indicator').each(function () {
                $(this).on('click', function () {
                    $(this).closest('li').click();
                });
            });
            //fire event to open branch if the li contains an anchor instead of text
            tree.find('.branch>a').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
            //fire event to open branch if the li contains a button instead of text
            tree.find('.branch>button').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
        }
    });

//Initialization of treeviews

    $('#tree1').treed({openedClass: 'fa fa-caret-right', closedClass: 'fa fa-caret-down'});

</script>
@stop