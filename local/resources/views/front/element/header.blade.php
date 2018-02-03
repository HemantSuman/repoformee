<?php
//$cartItems = json_decode($_COOKIE['cartCookie']);
//dd($cartItems);
?>
<div id="header-main">  <!--class="header-new"-->
    <div class="container-fluid">
        <div class="row header-new-row">
            <div  class="col-md-2 col-sm-4 col-xs-4">
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="{{ URL:: asset('/plugins/front/img/logo.png')}}" alt="logo"></a>
                </div>
            </div>

            @if(!(Auth::guard('web')->user()))
            <div class="col-md-3 col-sm-8 f_right col-xs-8">
                <ul class="navigate-links clearfix">
                    <li class="">
                        <a href="javascript:void(0)" id="signup">Sign Up</a>
                    </li>
                    <li class="">
                        <a href="javascript:void(0)" id="signin">Login</a>
                    </li>                   
                </ul>
                <ul class="navigate-links clearfix">                   
                    <li class="postadd-link">
                        <a href="javascript:void(0)" class="signinPostAdd"><span>Post an ad</span></a>
                    </li>                   
                </ul>

            </div>
            @else
            <div class="col-md-3 col-sm-8 f_right col-xs-8">
                <ul class="navigate-links clearfix">
                    <input type="hidden" name="loginUserId" id="loginUserId" value="{{Auth::guard('web')->user()->id}}">
                    <?php /* ?> <li class="lamp">
                      <a href="{{ url('user/wishlist')}}"><img src="{{ URL:: asset('plugins/front/img/lamp-icon.png')}}"></a>
                      </li>
                      <li class="cart">
                      <a href="{{ url('messages/allnotifications')}}"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
                      <!--                            <span class="cart-value">5</span>-->
                      </li><?php */ ?>
                    <li class="user-profile">
                        <?php /* ?><span class="profile-img">

                          @if((Auth::guard('web')->user()->image))
                          <img src="{{ URL::asset('upload_images/users/30x30/'.Auth::guard('web')->user()->id.'/'.Auth::guard('web')->user()->image) }}" alt="">
                          @elseif((Auth::guard('web')->user()->avatar))
                          <img src="{{ Auth::guard('web')->user()->avatar }}" alt="">
                          @else
                          <img src="{{ URL::asset('plugins/front/img/no_avatar.gif') }}" alt="">
                          @endif

                          </span><?php */ ?>
                        <span class="profileName">
                            <a href="javascript:void(0)" class="" data-toggle="dropdown">
                                <span class="user-name" title="{{ Auth::guard('web')->user()->name }}">Welcome {{ Auth::guard('web')->user()->name }}</span>
                                <span class="user-arrow"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/user/profile') }}">Profile</a></li>
                                <li><a href="{{ url('/user/messages') }}">Message </a></li>
                                <li><a href="{{ url('/user/classifieds') }}">Manage Ads </a></li>
                                <li><a href="{{ url('/user/saved-searches') }}">saved searches</a></li>
                                <li><a href="{{ url('/user/logout') }}">log out</a></li>
                            </ul>
                        </span>
                    </li>
                    <li class="cart">
                        <a href="{{ url('cart/')}}"><img src="{{ URL:: asset('/plugins/front/img/login-cart.png') }}" alt=""></a>
                        <span class="cart-value"><?php echo Session::get('cartItems') ?></span>
                    </li>

                    <li class="postadd-link">
                        @if(Auth::guard('web')->user()->seller_type == 'business')
                        <a href="{{ url('user/business_post_ad')}}" class=""></a>
                        @else
                        <a href="{{ url('/user/post-classified') }}"></a>
                        @endif
                    </li>
                </ul>
            </div>
            @endif

            @if(!(Auth::guard('web')->user()))
            <div class="col-md-7 col-sm-12 col-xs-12">
                @else
                <div class="col-md-7 col-sm-12 col-xs-12">
                    @endif
                    <!-- style in main-search-form.scss -->
                    <?php
//                    dd($request_form_data['itemname']);
                    //$data=$data2;
//                    $itemname = isset($data['itemname']) ? $data['itemname'] : '';
                    $city = isset($data['city']) ? $data['city'] : '';
                    $lat = isset($data['lat']) ? $data['lat'] : 0;
                    $lng = isset($data['lng']) ? $data['lng'] : 0;
                    $km = isset($data['km']) ? $data['km'] : '';
                    $cat_id = isset($data['cat_id']) ? $data['cat_id'] : '';
                    $state = isset($data['usr_state']) ? $data['usr_state'] : '';
                    //$city = isset($data['usr_city']) ? $data['usr_city'] : '';
                    ?>

                    {!! Form::open(array('url' => '/classified-list', 'class' => 'form', 'files' => true, 'id'=>'searchFrom', 'method'=>'GET' )); !!}
                    <!--{!! Form::open(array('url' => '/search_classifieds', 'class' => 'form', 'files' => true, 'id'=>'searchFrom', 'method'=>'GET' )); !!}-->
                    <div id="main-search-form">
                        <div class="row">
                            <div class="all-category-search">
                                <div class="col-lg-3 col-md-3 col-sm-3">

                                    <?php
                                    // dd($allSubCategoriesForMenu->toarray());
                                    foreach ($allSubCategoriesForMenu as $key => $value) {
                                        if (count($value['children']) == 0) {
                                            unset($allSubCategoriesForMenu[$key]);
                                        }
                                    }
//                $sliced_front_header_array = array_slice($allSubCategoriesForMenu->toarray(), 0, 5);
//
//                $others_categories = array_slice($allSubCategoriesForMenu->toarray(), 5);
                                    $sliced_front_header_array = $allSubCategoriesForMenu->toarray();
                                    //dd($sliced_front_header_array);
                                    ?>
                                    @if(!empty($sliced_front_header_array))
                                    <div class="custom-selectbox">
                                        <div class="selected">
                                            <?php if (isset($request_category_data)) { ?>
                                                <img src="{{ URL:: asset("/upload_images/categories/icon/$request_category_data->id/$request_category_data->icon")}}" alt="" class="selected-img selected_cat_icon_head">
                                            <?php } else { ?>
                                                <img src="{{ URL:: asset('/plugins/front/img/all-category-icon.png') }}" alt="" class="selected-img selected_cat_icon_head">
                                            <?php } ?>

                                            <span class="selected-text selected_cat_name_head">
                                                <?php
                                                if (isset($request_category_data)) {
                                                    echo $request_category_data->name;
                                                } else {
                                                    echo 'All Category';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>

                                    @endif





                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="item-name">
                                        <input type="search" name="itemname" placeholder="Search here" value="{{isset($request_form_data['itemname'])?$request_form_data['itemname']:''}}"  id="itemname" class="searchfield">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="location">
                                        <?php
                                        $getStateListTop = Session::get('getStateListTop');
                                        $stlist = $getStateListTop[0];
//                                        dd($request_form_data);
                                        ?>
                                        <div class="col-md-5 col-sm-5 pad-0">
                                            <div class="km-dropdown">
                                                <input type="hidden" id="state_id" name="state_id"  />
                                                <select name="usr-state" class="custom-select usr-state" id="usr-state">
                                                    <option value="">Select State</option> 
                                                    <?php for ($i = 0; $i < count($stlist); $i++) { ?>
                                                        <option {{(isset($request_form_data['state_id']) && $request_form_data['state_id'] == $stlist[$i]->id)?'selected=selected':''}} state_id="<?php echo $stlist[$i]->id; ?>" value="<?php echo $stlist[$i]->name; ?>"> <?php echo $stlist[$i]->name; ?></option> 
                                                    <?php } ?>
                                                </select><span class="caret"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-7 col-sm-7 pad-0">
                                            <input type="search" name="city" placeholder="Australia" class="locationfield" id="headerLocationSearchBox">
                                            <input type="hidden" id="headerLocationSearchLat" name="lat"  />
                                            <input type="hidden" id="headerLocationSearchLong" name="lng"  />
                                            <input type="hidden" class="usr-state" name="usr_state" />
                                            <input type="hidden" class="usr-city" name="usr_city" />
                                            <input type="hidden" class="usr-pcode" name="usr_pcode" />
                                            <input type="hidden" id="km" name="km" value="50" />
                                        </div>
                                        <?php /* ?> <div class="col-md-4 col-sm-4 pad-0">
                                          <div class="km-dropdown">
                                          <select name="km" class="custom-select km-list" id="km">
                                          <?php for ($kmi = 0; $kmi <= 100; $kmi += 10) { ?>
                                          <option value="<?php echo $kmi; ?>"> <?php echo $kmi; ?> Km</option> <?php }
                                          ?>
                                          </select>
                                          </div>
                                          </div><?php */ ?>
                                        <input type="hidden" name="cat_id" id="header_cat_id" value="{{isset($request_category_data)?$request_category_data->id:''}}">
                                        <input type="hidden" name="header_cat_name" id="header_cat_name" value="{{isset($request_category_data)?$request_category_data->name:''}}">
                                        <!-- <input type="button" class="search-button"> -->
                                        <button type="submit" class="search-button"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


        <!-- Header By Balveer -->
        <div class="main-cat-dropdown">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="category-slider-sec">
                            <ul class="category-slider slider header-search-category">
                                @foreach($sliced_front_header_array as $key => $value)
                                @if(sizeof($value['children']) != 0)
                                <?php $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $value['text']); ?>
                                <li data-id="{{$value['id']}}" cat_name="{{$value['text']}}"  cat_id=<?php echo $value['id']; ?> class="p_cat_li"> 
                                    <div class="cat-menu-link">
                                        <a href="javascript:void(0)"><span class="cat-menu-icon"><img data-id="{{$value['id']}}" src="{{ URL::asset('/upload_images/categories/icon/'.$value['id'].'/'.$value['icon']) }}"></span><span>{{$value['text']}}</span></a> 
                                    </div>                    
                                </li>
                                @else
                                <li class="active"><a href="javascript:void(0)">{{$value['text']}}</a> </li>
                                @endif
                                @endforeach 

                            </ul>
                        </div>

                        @foreach($sliced_front_header_array as $key => $value)
                        @if(sizeof($value['children']) != 0)

                        <div class="sub-category-slider-sec child_cat_div_<?php echo $value['id']; ?>">
                            <ul class="sub-category-slider slider header-search-category">
                                @foreach($value['children'] as $key1 => $data)
                                @if(!empty($data['text']))
                                <?php $encodetitles = preg_replace('/[^A-Za-z0-9-]+/', '-', $data['text']); ?>

                                <li data-id="{{$data['id']}}" cat_name="{{$data['text']}}"> 
                                    <div class="sub-cat-menu-link">
                                        <a href="javascript:void(0)"><span class="cat-menu-icon"><img data-id="{{$data['id']}}" src="{{ URL::asset('/upload_images/categories/icon/'.$data['id'].'/'.$data['icon']) }}"></span><span>{{$data['text']}}</span></a> 
                                    </div>                    
                                </li>

                                @endif
                                @endforeach   
                            </ul>
                        </div>
                        @endif
                        @endforeach          

                    </div>
                </div>
            </div>
        </div>
        <!--Close Header By Balveer -->

    </div>
    @if($controller != "MembershipPlansController")


    <div class="menuWrap">
        <div class="container">
            <div class="menu-icon"><span> Menu </span> </div>
            <nav>

                <?php
                //dd($allSubCategoriesForMenu->toarray());
                foreach ($allSubCategoriesForMenu as $key => $value) {
                    if (count($value['children']) == 0) {
                        unset($allSubCategoriesForMenu[$key]);
                    }
                }
                $sliced_front_header_array = array_slice($allSubCategoriesForMenu->toarray(), 0, 5);

                $others_categories = array_slice($allSubCategoriesForMenu->toarray(), 5);
                //dd($others_categories);
                ?>
                @if(!empty($sliced_front_header_array))
                <ul>
                    @foreach($sliced_front_header_array as $key => $value)
                    @if(sizeof($value['children']) != 0)
                    <?php $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $value['text']); ?>
                    <li class="active">
                        <a href="{{ url('/classified-list/'.$encodetitle.'/'.$value['id']) }}">{{$value['text']}}</a>
                        <ul>
                            @foreach($value['children'] as $key1 => $data)
                            @if(!empty($data['text']))
                            <?php $encodetitles = preg_replace('/[^A-Za-z0-9-]+/', '-', $data['text']); ?>
                            <li><a href="{{ url('/classified-list/'.$encodetitles.'/'.$data['id']) }}">{{$data['text']}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li class="active"><a href="javascript:void(0)">{{$value['text']}}</a> </li>
                    @endif
                    @endforeach

                    @if(!empty($allComCategories) && count($allComCategories) > 0)
                    <li><a href="javascript:void(0)">Communities</a>
                        <ul>
                            @foreach($allComCategories as $otherComCatKey => $OtherComCatValue)
                            <?php $encodetitlcom = preg_replace('/[^A-Za-z0-9-]+/', '-', $OtherComCatValue['text']); ?>
                            <li><a href="{!! url('/classified_list/'.$encodetitlcom.'/'.$OtherComCatValue['id']); !!}">{{$OtherComCatValue['text']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    @if(!empty($informationAreaCategories) && count($informationAreaCategories) > 0)
                    <li><a href="javascript:void(0)">Information</a>
                        <ul>
                            @foreach($informationAreaCategories as $otherComCatKey => $OtherComCatValue)
                            <?php $encodetitleinfo = preg_replace('/[^A-Za-z0-9-]+/', '-', $OtherComCatValue['text']); ?>
                            <li><a href="{!! url('/classified_list/'.$encodetitleinfo.'/'.$OtherComCatValue['id']); !!}">{{$OtherComCatValue['text']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    @if(!empty($others_categories))
                    <li><a href="javascript:void(0)">Others</a>
                        <ul>
                            @foreach($others_categories as $otherCatKey => $OtherCatValue)
                            <?php $encodetitleother = preg_replace('/[^A-Za-z0-9-]+/', '-', $OtherCatValue['text']); ?>
                            <li><a href="{{ url('/classified-list/'.$encodetitleother.'/'.$OtherCatValue['id']) }}">{{$OtherCatValue['text']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endif

                </ul>
                @endif

                <!--                <?php
//dd($allSubCategories);
//                $allSubCategoriesarr = array_slice($allSubCategories->toarray(), 0, 6);
//                // dd($allSubCategories);
//                $others_categories = array_slice($allSubCategories->toarray(), 6);
//
//                $sliced_front_header_array = array_slice($allSubCategoriesForMenu->toarray(), 0, 4);
//
//                        $others_categories = array_slice($allSubCategoriesForMenu->toarray(), 4);
                ?>
                                <ul>

                                    @if(!empty($allSubCategoriesarr))
                                    @foreach($allSubCategoriesarr as $key => $value)
                                    @if(sizeof($value['children']) != 0)
                                    <li class="submenu"><a href="#">{{$value['text']}}</a>
                                        <ul>
                                            @foreach($value['children'] as $key1 => $data)
                                            @if(!empty($data['text']))
                                            <li><a href="#">{{$data['text']}}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif
                                    @endforeach
                                    @endif
                                    @if(!empty($allComCategories) && count($allComCategories) > 0)
                                    <li><a href="javascript:void(0)">Communities</a>
                                        <ul>
                                            @foreach($allComCategories as $otherComCatKey => $OtherComCatValue)
                                            <li><a href="{!! url('/classified_list/'.$OtherComCatValue['id']); !!}">{{$OtherComCatValue['text']}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif
                                    @if(!empty($informationAreaCategories) && count($informationAreaCategories) > 0)
                                    <li><a href="javascript:void(0)">Information</a>
                                        <ul>
                                            @foreach($informationAreaCategories as $otherComCatKey => $OtherComCatValue)
                                            <li><a href="{!! url('/classified_list/'.$OtherComCatValue['id']); !!}">{{$OtherComCatValue['text']}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif
                                     @if(!empty($others_categories))
                                            <li><a href="javascript:void(0)">Others</a>
                                                <ul>
                                                    @foreach($others_categories as $otherCatKey => $OtherCatValue)
                                                    <li><a href="{{ url('/classified-list/'.$OtherCatValue['id']) }}">{{$OtherCatValue['text']}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endif-->
                <!--					<li><a href="#">Category1</a></li>
                                                        <li><a href="#">Category2</a></li>
                                                        <li class="submenu"><a href="#">Category3</a>
                                                                <ul>
                                                                        <li><a href="#">Category4</a></li>
                                                                        <li><a href="#">Category5</a></li>
                                                                        <li><a href="#">Category6</a></li>
                                                                        <li><a href="#">Category7</a></li>
                                                                                <li><a href="#">Category4</a></li>
                                                                                <li><a href="#">Category5</a></li>
                                                                                <li><a href="#">Category6</a></li>
                                                                                <li><a href="#">Category7</a></li>
                                                                </ul>
                                                        </li>
                                                        <li><a href="#">Category4</a></li>
                                                        <li><a href="#">Category5</a></li>
                                                        <li><a href="#">Category6</a></li>
                                                        <li><a href="#">Category7</a></li>
                                                        <li><a href="#">More Category</a></li>-->
                </ul>
            </nav>
        </div>
    </div>
    @endif
    @section('scripts')

    <script type="text/javascript">

        // var cat_id = "<?php //echo $cat_id;                ?>";
        $(function () {
//            getallclassified()

            $('.addcat').click();


            //sub cat click
            if ($(".addsub").length > 0) {
                $(".addsub").parents().closest("li").trigger("click").removeClass("active");
                $(".addsub").addClass("active");
                $('.category').trigger('click');
            }
            if ($(".addstate").length > 0) {
                $('.place').click();
            }
            if ($(".addcity").length > 0) {
                $(".addcity").parents().closest("li").trigger("click").removeClass("active");
                $(".addcity").addClass("active");
                $('.place').trigger('click');
            }

            $('.category').trigger('click');

            //    var selectVal = $(".custom-selectbox .selected");
            //    var dataVal = $(".select-options li[data-id= '<?php //echo $cat_id                ?>'] a").html();
            //    console.log(dataVal);
            //    selectVal.html(dataVal);
            //$('#amount').attr( 'datamin','1000');
        });


        //function initMap() {
        //    //var input = document.getElementById('searchInput');
        //    var autocomplete = new google.maps.places.Autocomplete('<?php //echo $city                           ?>');
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

        $('#tree1').treed({openedClass: 'fa fa-caret-down', closedClass: 'fa fa-caret-right'});
        function getallclassified()
        {
//            $.ajax({
//                url: root_url + '/get_all_classifieds',
//                data: {
//                    "_token": $('meta[name="csrf-token"]').attr('content'),
//                },
//                //dataType: "html",
//                method: "POST",
//                cache: true,
//                success: function (projects) {
//
//
//                    var projects = JSON.parse(projects);
//                    //            console.log(typeof projects);
//
//                    $("#project").autocomplete({
//                        minLength: 0,
//                        source: projects,
//                        focus: function (event, ui) {
//                            $("#project").val(ui.item.label);
//                            return false;
//                        },
//                        select: function (event, ui) {
//                            $("#project").val(ui.item.label);
//                            $("#project-id").val(ui.item.label);
//                            $("#project-description").html(ui.item.catname);
//                            var selectVal = $(".custom-selectbox .selected");
//                            var dataVal = $(".select-options li[data-id= " + ui.item.catid + "] a").html();
//                            selectVal.html(dataVal);
//                            $("#cat_id").val(ui.item.catid);
//                            //$("#project-icon").attr("src", "images/" + ui.item.icon);
//
//                            return false;
//                        }
//                    })
//                            .autocomplete("instance")._renderItem = function (ul, item) {
//                        if (item.sub_name == null)
//                        {
//                            item.sub_name = '';
//                        } else {
//                            item.sub_name = ', ' + item.sub_name;
//                        }
//                        return $("<li>")
//                                .append("<div><label>" + item.label + "</label><br><span class='values'>" + 'in ' + item.catname + item.sub_name + "</span></div>")
//                                .appendTo(ul);
//                    };
//
//
//
//
//
//                }
//            });
        }

//        var autocomplete = new google.maps.places.Autocomplete($(".locationfield")[0], {
//            componentRestrictions: {country: "au"},
//            types: ['(cities)']
//        });
//        google.maps.event.addListener(autocomplete, 'place_changed', function () {
//            var place = autocomplete.getPlace();
//            var place = autocomplete.getPlace();
//            console.log(place);
//
//            $(".usr-state, .usr-city, .usr-pcode").val('');
//
//            for (var i = 0; i < place.address_components.length; i++) {
//                var addressType = place.address_components[i].types[0];
//                if (addressType == 'administrative_area_level_1') {
//                    var state = place.address_components[i]['long_name'];
//                    $('.usr-state').val(state);
//                }
//                if (addressType == 'locality') {
//                    var city = place.address_components[i]['long_name'];
//                    $('.usr-city').val(city);
//                }
//                if (addressType == 'postal_code') {
//                    var gPostalCode = place.address_components[i]['short_name'];
//                    $('.usr-pcode').val(gPostalCode);
//                }
//            }
//        });

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

