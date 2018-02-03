@extends('front/layout/layout')
<link rel="stylesheet" href="{{ URL::asset('plugins/front/css/front-style.css') }}">
@section('content')

<div id="middle">
    <!--mainbanner section-->
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
            <?php
            //dd($data);
            $itemname = isset($data['itemname'])?$data['itemname']:'';
            $city = isset($data['city'])?$data['city']:'';
            $lat = isset($data['lat'])?$data['lat']:0;
            $lng = isset($data['lng'])?$data['lng']:0;
            $km = isset($data['km'])?$data['km']:'';
            $cat_id =isset($data['cat_id'])?$data['cat_id']:'';
            $state = isset($data['usr_state'])?$data['usr_state']:'';
            $city = isset($data['usr_city'])?$data['usr_city']:'';
            ?>
            {!! Form::open(
            array('url' => '/search_classifieds',
            'class' => 'form',
            'files' => true,
            'id'=>'searchFrom',
            )

            );
            !!}

            <div id="main-search-form">
                <div class="container">
                    <div class="all-category-search">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div id="myselect" class="custom-selectbox">
                                <div id="selectval" class="selected"></div>
                                <ul class="select-options header-search-category">
                                    @if(!empty($allSubCategories))
                                    @foreach($allSubCategories as $key => $value)  
                                    <li data-id="{{$value->id}}">
                                        <a href="javascript:void(0)"><img data-id="{{$value->id}}" src="{{ URL::asset('plugins/front/img/all-category-icon.png') }}">{{$value->text}}</a>
                                        @if(sizeof($value->children) != 0)
                                        <ul>
                                            @foreach($value->children as $key1 => $data)
                                            <li data-id="{{$data->id}}">
                                                <a href="javascript:void(0)"><img src="{{ URL::asset('plugins/front/img/all-category-icon.png') }}">{{$data->text}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3 col-sm-3">
                            <div class="item-name dropdown">
                                <input type="text" name="itemname" placeholder="Item Name" value="{{$itemname}}" id="project" class="searchfield">
                                <a href="javascript:void(0)" class="saved-search" data-toggle="dropdown" aria-expanded="false">Saved Search</a>
                                <div class="dropdown-menu saved-search-popup svd-srchd-pp" role="menu" data-backdrop="static" data-keyboard="false">
                                    @if(!(Auth::guard('web')->user()))
                                        <h2>Please Login</h2>
                                        <a href="javascript:void(0)" class="btn btn-green savd-srch-sinup-btn">Sign In or Register</a>
                                    @else
                                        <form class="form-horizontal" role="form">
                                            <div class="title">Saved Search Name</div>
                                            <div class="input-field">
                                                <input type="text" name="" class="form-control" placeholder="Car in Wellengton Point">
                                            </div><br/>
                                            <div class="title">Email these search result</div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="o5" value="">
                                                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                                    Immediately
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="o5" value="">
                                                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                                    Daily
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="o5" value="">
                                                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                                    Weekly
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="o5" value="">
                                                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                                    Never
                                                </label>
                                            </div>
                                            
                                            <div class="input-field">
                                              <input type="submit" class="btn btn-green" name="" value="Save this Search">
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-6">
                            <div class="location">
                                <div class="col-md-9 col-sm-8 pad-0">
                                    <input type="search" name="city" placeholder="Location/City" class="locationfield" id="headerLocationSearchBox" value="{{$city}}">
                                    <input type="hidden" id="headerLocationSearchLat" name="lat" value="{{$lat}}" />
                                    <input type="hidden" id="headerLocationSearchLong" name="lng" value="{{$lng}}" />
                                </div>
                                <div class="col-md-3 col-sm-4 pad-0">
                                    <div class="km-dropdown">
                                        <select name="km" class="km-list custom-select" id="km">
                                            <?php for ($kmi = 5; $kmi <= 100; $kmi += 5) { ?>
                                                <option value="<?php echo $kmi; ?>"> <?php echo $kmi; ?> Km</option> <?php
                                        }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                                <input type="hidden" name="cat_id" id="cat_id" value="{{$cat_id}}">
                                <input type="submit"  value="" class="search-button">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!} 
        </div>
        {!! Form::open(
        array('url' => '/search_classifiedsdata',
        'class' => 'form',
        'files' => true,
        'id'=>'searchlistform',
        )

        );
        !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="cat_id" id="cat_ids" value="{{$cat_id}}">
        <input type="hidden" name="city" id="citys " value="{{$city}}" >
        <input type="hidden" name="itemname" id="itemnames" value="{{$itemname}}">
        <input type="hidden" name="km" id="kms" value="{{$km}}">
        <input type="hidden" name="lat" id="lats" value="{{$lat}}">
        <input type="hidden" name="lng" id="lngs" value="{{$lng}}">
        <input type="hidden" name="state_id" id="states" value="">
        <input type="hidden" name="city_id" id="cities" value="">
        <input type="hidden" name="cat_name" id="cat_name" value="">
        <input type="hidden" name="order" id="orders" value="asc">



        {!! Form::close() !!} 

    </section>

    <!--main bannersection-->
    <!-- categories section -->
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <!-- style in main-categories.scss file -->
                        <div id="left-section">
                            <div class="row">
                                <div class="col-md-3">
                                    <aside class="search-section">
                                        <div class="title">Refine Search</div>
                                        <form class="search-form">
                                            <ul id="tree1">
                                                <li><label>Keyword :</label>
                                                    <input type="text" placeholder="keyword" class="input-text">
                                                </li>

                                                <li class="category"><label>Category</label>
                                                    @foreach($allCategoriesWithClassifiedCount as $parCatKey => $parCatvalue)  
                                                    <ul>
                                                        <li class="filtercategory {{ $parCatvalue->id == $cat_id ? " addcat active" : "" }}" value="{{$parCatvalue->id}}" <?php echo $parCatvalue->id == $cat_id ? ' selected="selected"' : ''; ?> >
                                                            {{$parCatvalue->text}}({{$parCatvalue->parentCategory_classifieds->count()}})
                                                            @if(sizeof($parCatvalue->children) != 0)

                                                            @foreach($parCatvalue->children as $subCatKey => $subCatdata)
                                                            <ul >
                                                                <li class="filtercategory {{ $subCatdata->id == $cat_id ? "addsub active" : "" }}" value="{{$subCatdata->id}}" <?php echo $subCatdata->id == $cat_id ? ' selected="selected"' : ''; ?> >
                                                                    {{$subCatdata->text}} ({{$subCatdata->subCategory_classifieds->count()}})</li>

                                                            </ul>
                                                            @endforeach
                                                            @endif
                                                        </li>

                                                    </ul>
                                                    @endforeach
                                                </li>
                                                <li>
                                                    <label>Places</label>

                                                    @foreach($staterestult as $key => $value)  
                                                    <ul>
                                                        <li class="filterstate {{ $value->state_name == $state ? " addstate active" : "" }}" value="{{$value->satet_id}}">
                                                            <a href="javascript:void(0)">{{$value->state_name}} ({{$value->state_count}})</a>
                                                            @if(!empty($value->city))

                                                            @foreach($value->city as $key1 => $data)
                                                            <ul>
                                                                <li class="filtercity {{ $data['name'] == $city ? " addcity active" : "" }}" value="{{$data['city_ids']}}"><a href="javascript:void(0)">{{$data['name']}} ({{$data['city_counts']}})</a></li>

                                                            </ul>
                                                            @endforeach
                                                            @endif
                                                        </li>

                                                    </ul>
                                                    @endforeach
                                                </li>
                                                <!--       
                                                style="display:{{ $subCatdata->id == $cat_id ? "list-item" : "none" }}"
                                                 style="display:{{ $parCatvalue->id == $cat_id ? "item" : "none" }}"
                                                <li>
                                                                                                    <label>Seller Type</label>
                                                                                                    <ul>
                                                                                                        <li><a href="javascript:void(0)">Indivisual</a></li>
                                                                                                        <li><a href="javascript:void(0)">Broker</a></li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <label>Price</label>
                                                                                                    <ul>
                                                                                                        <li><a href="javascript:void(0)">$10,000-$20,000</a></li>
                                                                                                        <li><a href="javascript:void(0)">$20,000-$30,000</a></li>
                                                                                                        <li><a href="javascript:void(0)">$30,000-$40,000</a></li>
                                                                                                        <li><a href="javascript:void(0)">$40,000-$50,000</a></li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <label>Make</label>
                                                                                                    <ul>
                                                                                                        <li><a href="javascript:void(0)">Alfa Romeo(1)</a></li>
                                                                                                        <li><a href="javascript:void(0)">BMW(1)</a></li>
                                                                                                        <li><a href="javascript:void(0)">Volkswagen(1)</a></li>
                                                                                                    </ul>
                                                                                                </li>
                                                
                                                                                                <li>
                                                                                                    <label>Body Type</label>
                                                                                                    <ul>
                                                                                                        <li><a href="javascript:void(0)">Hatch back</a></li>
                                                                                                        <li><a href="javascript:void(0)">Sedan</a></li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <label>Year</label>
                                                                                                    <ul>
                                                                                                        <li>
                                                                                                            <select class="custom-select col-sm-5">
                                                                                                                <option>From</option>
                                                                                                                <option>2000</option>
                                                                                                                <option>2001</option>
                                                                                                                <option>2002</option>
                                                                                                            </select>
                                                                                                            <select class="custom-select col-sm-5">
                                                                                                                <option>to</option>
                                                                                                                <option>2005</option>
                                                                                                                <option>2010</option>
                                                                                                                <option>2016</option>
                                                                                                            </select>
                                                                                                            <input type="button" value="Go" class="go-btn">
                                                                                                        </li>													
                                                                                                    </ul>
                                                                                                </li>
                                                
                                                                                                <li>
                                                                                                    <label>Kilometres</label>
                                                                                                    <ul>
                                                                                                        <li><a href="javascript:void(0)">10,000-20,000</a></li>
                                                                                                        <li><a href="javascript:void(0)">20,000-30,000</a></li>
                                                                                                        <li><a href="javascript:void(0)">30,000-40,000</a></li>
                                                                                                        <li><a href="javascript:void(0)">40,000-50,000</a></li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <label>Cylinder Configuration</label>
                                                                                                    <ul>
                                                                                                        <li><a href="javascript:void(0)">2 Cylinder</a></li>
                                                                                                        <li><a href="javascript:void(0)">3 Cylinder</a></li>
                                                                                                        <li><a href="javascript:void(0)">4 Cylinder</a></li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <label>Transmission</label>
                                                                                                    <ul>
                                                                                                        <li><a href="javascript:void(0)">Automatic</a></li>
                                                                                                        <li><a href="javascript:void(0)">Manual</a></li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <label>Fuel Type</label>
                                                                                                    <ul>
                                                                                                        <li><a href="javascript:void(0)">Deisel</a></li>
                                                                                                        <li><a href="javascript:void(0)">Petrol</a></li>
                                                                                                        <li><a href="javascript:void(0)">CNG</a></li>
                                                                                                        <li><a href="javascript:void(0)">Hybrid</a></li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <label>Offer Type</label>
                                                                                                    <ul>
                                                                                                        <li><a href="javascript:void(0)">Offer 1</a></li>
                                                                                                        <li><a href="javascript:void(0)">Offer 2</a></li>
                                                                                                        <li><a href="javascript:void(0)">Offer 3</a></li>
                                                                                                        <li><a href="javascript:void(0)">Offer 4</a></li>
                                                                                                    </ul>
                                                                                                </li>-->
                                            </ul>
                                        </form>
                                        <!-- <img src="assets/img/sidebar-new.jpg" alt="sidebar-new"> -->
                                    </aside>
                                </div>

                                <div class="col-sm-9">
                                    <div class="row">
                                        <div id="result-view" class="search-result">
                                            <div class="top-section">
                                                <div class="col-md-7 pull-right">
                                                    <div class="filters">
                                                        <ul class="view-type">
                                                            <li class="grid_view">
                                                                <a href="javascript:void(0)">
                                                                    <img src="{{ URL::asset('plugins/front/img/grid-view.png') }}" alt="grid-view">
                                                                </a>
                                                            </li>
                                                            <li class="list_view active">
                                                                <a href="javascript:void(0)">
                                                                    <img src="{{ URL::asset('plugins/front/img/list-view.png') }}" alt="list-view">
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="select-options">
                                                            <select id="select-options-1">
                                                                <option>Updated Date</option>
<!--                                                                <option>my neighbour</option>
                                                                <option>court</option>
                                                                <option>dvara</option>
                                                                <option>shoudled</option>-->
                                                            </select>

                                                            <select id="select-options-23">
                                                                <option value="desc">Descending</option>
                                                                <option value="asc">Assending</option>
<!--                                                                <option>Pre </option>
                                                                <option>last</option>
                                                                <option>shoudled</option>-->
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="title">
                                                        <h2 class="categoryheading">{{$result[0]['catname']}}</h2>	
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- style in mosque-listing.scss -->
                                            <div class="searchlistdata">
                                                <div class="car-search-listing">

                                                    @if(count($result) != 0)
                                                 
                                                    <ul>
                                                        @foreach($result as $key=>$val)
                                                        <li>
                                                            <a href="{{ Request::root().'/classifieds/'.$val->classified_id}}">
                                                                <div class="col-sm-4">
                                                                    <div class="img-sec">
                                                                        <img src="{!! asset('/upload_images/classified/'.$val->classified_id.'/'.$val->name) !!}" alt="listing-img"> 
                                                                        <span class="star-icon">
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="description-sec">
                                                                        <div class="head">
                                                                            <div class="title">{{$val->title}}</div>
                                                                            <div class="locate">
                                                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                                Brsbane South West, Yeerongpilly
                                                                            </div>
                                                                            @if($val->price > 0)
                                                                            <span class="price-tag">${{$val->price}}</span>
                                                                            @endif
                                                                        </div>
                                                                        <p>{{strip_tags($val->description)}}</p>
                                                                        <?php if (isset($val['classified_attribute']) && !empty($val['classified_attribute'])) { ?>
                                                                            <div class="specification-table">
                                                                                <ul>
                                                                                    <?php
                                                                                    foreach ($val['classified_attribute'] as $i => $v) {

                                                                                        if (in_array($v['attr_type_name'], ['Multi-Select', 'Radio-button'])) {
                                                                                            ?>
                                                                                            <li>
                                                                                                <img src="{{ url("upload_images/attributes/30px/$v[attribute_id]/$v[icon]") }}" alt="specification-icon">{{ $v['attribute_value'][$v['attr_value']] }}
                                                                                            </li>
                                                                                        <?php } else {
                                                                                            ?>
                                                                                            <li>
                                                                                                <img src="{{ url("upload_images/attributes/30px/$v[attribute_id]/$v[icon]") }}" alt="specification-icon">{{ $v['attr_value'] }}
                                                                                            </li>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </ul>

                                                                            </div>
                                                                        <?php } ?>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    </ul>

                                                    @else
                                                    No Records Found.
                                                    @endif  
                                                    <div class="pagination-wrapper">
                                                        <div class="pagination-wrapper-inner searchlist">

                                                            {!!$result->render()!!}

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <!-- style in sidebar.scss file -->
                        <?php /* @include('front.element.sidebar') */ ?>
                        @include('front/element/sidebar')
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
                    <img src="{{ URL::asset('plugins/front/img/adv-banner.jpg') }}" alt="adv-banner.jpg">
                </div>
            </div>
        </div>
    </section>

</div>

@stop
@section('scripts')
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU?sensor=false"></script>
<script type="text/javascript">

// var cat_id = "<?php echo $cat_id; ?>";
$(function () {
    getallclassified()

    $('.addcat').click();


    //sub cat click
    if ($(".addsub").length > 0) {
        $(".addsub").parents().closest("li").trigger("click").removeClass("active");
        $(".addsub").addClass("active");
        $('.category').trigger('click');
    }

    $('.category').trigger('click');

    var selectVal = $(".custom-selectbox .selected");
    var dataVal = $(".select-options li[data-id= '<?php echo $cat_id ?>'] a").html();
    console.log(dataVal);
    selectVal.html(dataVal);
//$('#amount').attr( 'datamin','1000');   
});


//function initMap() {
//    //var input = document.getElementById('searchInput');
//    var autocomplete = new google.maps.places.Autocomplete('<?php //echo $city           ?>');
//}
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
function getallclassified()
{
    $.ajax({
        url: root_url + '/get_all_classifieds',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
        //dataType: "html",
        method: "POST",
        cache: true,
        success: function (projects) {


            var projects = JSON.parse(projects);
            console.log(typeof projects);

            $("#project").autocomplete({
                minLength: 0,
                source: projects,
                focus: function (event, ui) {
                    $("#project").val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#project").val(ui.item.label);
                    $("#project-id").val(ui.item.label);
                    $("#project-description").html(ui.item.catname);
                    //$("#project-icon").attr("src", "images/" + ui.item.icon);

                    return false;
                }
            })
                    .autocomplete("instance")._renderItem = function (ul, item) {
                if (item.sub_name == null)
                {
                    item.sub_name = '';
                } else {
                    item.sub_name = ', ' + item.sub_name;
                }
                return $("<li>")
                        .append("<div><label>" + item.label + "</label><br><span class='values'>" + 'in ' + item.catname + item.sub_name + "</span></div>")
                        .appendTo(ul);
            };





        }
    });
}

var autocomplete = new google.maps.places.Autocomplete($(".locationfield")[0], {componentRestrictions: {country: "au"}});
google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    var place = autocomplete.getPlace();
    console.log(place);

    $(".usr-state, .usr-city, .usr-pcode").val('');

    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (addressType == 'administrative_area_level_1') {
            var state = place.address_components[i]['long_name'];
            $('.usr-state').val(state);
        }
        if (addressType == 'locality') {
            var city = place.address_components[i]['long_name'];
            $('.usr-city').val(city);
        }
        if (addressType == 'postal_code') {
            var gPostalCode = place.address_components[i]['short_name'];
            $('.usr-pcode').val(gPostalCode);
        }
    }
});

$('div.svd-srchd-pp').on('click', function (event) {
    event.stopPropagation();
});


$("a.savd-srch-sinup-btn").click(function () {
    //alert("call login popup");
    $('#login-modal').modal('show');
    $("#is_login_for_saved_search").val(1);
});

</script>

@stop