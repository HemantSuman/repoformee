<div id="header-main">  <!--class="header-new"-->
    <div class="container">
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
                        <a href="javascript:void(0)" id="signin">Sign In</a>
                    </li>
                    <li class="postadd-link">
                        <a href="javascript:void(0)" class="signinPostAdd">Post an ad</a>
                    </li>
                </ul>
            </div>
            @else
            <div class="col-md-5 col-sm-8 f_right col-xs-8">
                <ul class="navigate-links clearfix">
                    <li class="lamp">
                        <a href="{{ url('user/wishlist')}}"><img src="{{ URL:: asset('plugins/front/img/lamp-icon.png')}}"></a>
                    </li>
                    <li class="cart">
                        <a href="{{ url('messages/allnotifications')}}"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
<!--                            <span class="cart-value">5</span>-->
                    </li>
                    <li class="user-profile">
                        <span class="profile-img">

                            @if((Auth::guard('web')->user()->image))
                            <img src="{{ URL::asset('upload_images/users/30x30/'.Auth::guard('web')->user()->id.'/'.Auth::guard('web')->user()->image) }}" alt="">
                            @elseif((Auth::guard('web')->user()->avatar))
                            <img src="{{ Auth::guard('web')->user()->avatar }}" alt="">
                            @else
                            <img src="{{ URL::asset('plugins/front/img/no_avatar.gif') }}" alt="">
                            @endif

                        </span>
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


                    <li class="postadd-link">
                        @if(Auth::guard('web')->user()->seller_type == 'business')
                        <a href="{{ url('user/business_post_ad')}}" class="">Post an ad</a>
                        @else
                        <a href="{{ url('/user/post-classified') }}">Post an ad</a>
                        @endif
                    </li>
                </ul>
            </div>
            @endif

            @if(!(Auth::guard('web')->user()))
            <div class="col-md-7 col-sm-12 col-xs-12 header-rt-wrap">
                @else
                <div class="col-md-5 col-sm-12 col-xs-12">
                    @endif
                    <!-- style in main-search-form.scss -->
                    <?php
                    //dd("here");
                    //$data=$data2;
                    $itemname = isset($data['itemname']) ? $data['itemname'] : '';
                    $city = isset($data['city']) ? $data['city'] : '';
                    $lat = isset($data['lat']) ? $data['lat'] : 0;
                    $lng = isset($data['lng']) ? $data['lng'] : 0;
                    $km = isset($data['km']) ? $data['km'] : '';
                    $cat_id = isset($data['cat_id']) ? $data['cat_id'] : '';
                    $state = isset($data['usr_state']) ? $data['usr_state'] : '';
                    //$city = isset($data['usr_city']) ? $data['usr_city'] : '';
                    ?>

                    {!! Form::open(array('url' => '/search_classifieds', 'class' => 'form', 'files' => true, 'id'=>'searchFrom', 'method'=>'GET' )); !!}
                    <div id="main-search-form">
                        <div class="row">
                            <div class="all-category-search">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <!--                                    <div id="myselect" class="custom-selectbox">
                                                                            <div id="selectval" class="selected">All Categories</div>
                                                                            <ul class="select-options">
                                                                                @if(!empty($allSubCategories))
                                                                                <li class="all"> <a href="#">All Categories</a></li>
                                                                                @foreach($allSubCategories as $key => $value)
                                                                                @if(sizeof($value->children) != 0)
                                                                                <li>
                                                                                    <a class="" data-id="{{$value->id}}" dataSelectionId="{{$value->id}}">{{$value->text}}</a>

                                    <?php /* @if(sizeof($value->children) != 0) */ ?>
                                                                                    <ul>
                                                                                        @foreach($value->children as $key1 => $data)
                                                                                        <li><a href="javascript:void(0)" class="search-category-selection" data-id="{{$data->id}}" dataSelectionId="{{$data->id}}">{{$data->text}}</a></li>
                                                                                        @endforeach
                                                                                    </ul>
                                    <?php /* @endif */ ?>
                                                                                </li>
                                                                                @endif
                                                                                @endforeach

                                                                                @if(!empty($allComCategories) && count($allComCategories) > 0)
                                                                                <li><a href="javascript:void(0)">Communities</a>
                                                                                    <ul>
                                                                                        @foreach($allComCategories as $otherComCatKey => $OtherComCatValue)
                                                                                        <li><a href="javascript:void(0)" class="search-category-selection" data-id="{{$OtherComCatValue['id']}}" dataSelectionId="{{$OtherComCatValue['id']}}">{{$OtherComCatValue['text']}}</a></li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </li>
                                                                                @endif

                                                                                @if(!empty($informationAreaCategories) && count($informationAreaCategories) > 0)
                                                                                <li><a href="javascript:void(0)">Information</a>
                                                                                    <ul>
                                                                                        @foreach($informationAreaCategories as $otherComCatKey => $OtherComCatValue)
                                                                                        <li><a href="javascript:void(0)" class="search-category-selection" data-id="{{$OtherComCatValue['id']}}" dataSelectionId="{{$OtherComCatValue['id']}}">{{$OtherComCatValue['text']}}</a></li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </li>
                                                                                @endif
                                                                                @endif
                                                                            </ul>
                                                                        </div>-->
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
                                            <img src="{{ URL:: asset('/plugins/front/img/all-category-icon.png') }}" alt="" class="selected-img">
                                            <span class="selected-text">All Category</span>
                                        </div>
                                    </div>
                                    <div class="category-dropdown"><div class="category-dropdown-content"><ul class="select-options header-search-category">
                             <!--           <li>
                                            <a href="javascript:void(0)">
                                              <img src="{{ URL:: asset('/plugins/front/img/all-category-icon.png') }}" alt="" class="selected-img">
                                            <span class="selected-text">All Category</span>
                                            </a>
                                        </li>-->
                                        @foreach($sliced_front_header_array as $key => $value)
                                        @if(sizeof($value['children']) != 0)
                                        <?php $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $value['text']); ?>
                                        <li data-id="{{$value['id']}}" class="item has-dropdown">

                                            <a href="javascript:void(0)">
                                               <span class="icon-span"> <img data-id="{{$value['id']}}" src="{{ URL::asset('/upload_images/categories/icon/'.$value['id'].'/'.$value['icon']) }}"></span>
                                                <span class="text-span">{{$value['text']}}</span></a>
                                            <span id="dropdown-icon" class="dropdown-icon"><i class="fa fa-angle-down"></i></span>
                                            <ul class="dropdown" style="display: none;">

                                                @foreach($value['children'] as $key1 => $data)
                                                @if(!empty($data['text']))
                                                <?php $encodetitles = preg_replace('/[^A-Za-z0-9-]+/', '-', $data['text']); ?>
                                                <li data-id="{{$data['id']}}">
                                                    <a href="javascript:void(0)">
                                                        <img data-id="{{$data['id']}}" src="{{ URL::asset('/upload_images/categories/icon/'.$data['id'].'/'.$data['icon']) }}">

                                                        {{$data['text']}}</a>
                                                </li>

                                                @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                        @else
                                        <li class="active"><a href="javascript:void(0)">{{$value['text']}}</a> </li>
                                        @endif
                                        @endforeach

<!--                                        @if(!empty($allComCategories) && count($allComCategories) > 0)
                                        <li class="has-dropdown">
                                            <a href="javascript:void(0)">Communities</a>
                                            <span id="dropdown-icon" class="dropdown-icon"><i class="fa fa-angle-down"></i></span>
                                            <ul class="dropdown" style="display: none;">
                                                @foreach($allComCategories as $otherComCatKey => $OtherComCatValue)
                                                <?php $encodetitlcom = preg_replace('/[^A-Za-z0-9-]+/', '-', $OtherComCatValue['text']); ?>
                                                <li data-id="{{$OtherComCatValue['id']}}">
                                                    <a href="{!! url('/classified_list/'.$encodetitlcom.'/'.$OtherComCatValue['id']); !!}">
                                                        <img data-id="{{$data['id']}}" src="{{ URL::asset('/upload_images/categories/icon/'.$OtherComCatValue['id'].'/'.$OtherComCatValue['icon']) }}">
                                                        {{$OtherComCatValue['text']}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif
                                        @if(!empty($informationAreaCategories) && count($informationAreaCategories) > 0)
                                        <li class="has-dropdown">
                                            <a href="javascript:void(0)">Information</a>
                                            <span id="dropdown-icon" class="dropdown-icon"><i class="fa fa-angle-down"></i></span>
                                            <ul class="dropdown" style="display: none;">
                                                @foreach($informationAreaCategories as $otherComCatKey => $OtherComCatValue)
                                                <?php $encodetitleinfo = preg_replace('/[^A-Za-z0-9-]+/', '-', $OtherComCatValue['text']); ?>
                                                <li data-id="{{$OtherComCatValue['id']}}">
                                                    <a href="{!! url('/classified_list/'.$encodetitleinfo.'/'.$OtherComCatValue['id']); !!}">
                                                        <img data-id="{{$data['id']}}" src="{{ URL::asset('/upload_images/categories/icon/'.$OtherComCatValue['id'].'/'.$OtherComCatValue['icon']) }}">
                                                        {{$OtherComCatValue['text']}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif-->
                                    </ul></div></div>
                                    @endif



                                </div>
                                <div class="col-lg-4 col-md-3 col-sm-3">
                                    <div class="item-name">
                                        <input type="search" name="itemname" placeholder="Search here"  id="project" class="searchfield">
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-6">
                                    <div class="location">
                                        <div class="col-md-8 col-sm-8 pad-0">
                                            <input type="search" name="city" placeholder="Australia" class="locationfield" id="headerLocationSearchBox">
                                            <input type="hidden" id="headerLocationSearchLat" name="lat"  />
                                            <input type="hidden" id="headerLocationSearchLong" name="lng"  />
                                            <input type="hidden" class="usr-state" name="usr_state" />
                                            <input type="hidden" class="usr-city" name="usr_city" />
                                            <input type="hidden" class="usr-pcode" name="usr_pcode" />
                                        </div>
                                        <div class="col-md-4 col-sm-4 pad-0">
                                            <div class="km-dropdown">
                                                <select name="km" class="custom-select km-list" id="km">
                                                    <?php for ($kmi = 0; $kmi <= 100; $kmi += 10) { ?>
                                                        <option value="<?php echo $kmi; ?>"> <?php echo $kmi; ?> Km</option> <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="cat_id" id="cat_id">
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

        // var cat_id = "<?php //echo $cat_id;         ?>";
        $(function () {
            getallclassified()

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
            //    var dataVal = $(".select-options li[data-id= '<?php //echo $cat_id         ?>'] a").html();
            //    console.log(dataVal);
            //    selectVal.html(dataVal);
            //$('#amount').attr( 'datamin','1000');
        });


        //function initMap() {
        //    //var input = document.getElementById('searchInput');
        //    var autocomplete = new google.maps.places.Autocomplete('<?php //echo $city                    ?>');
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
                    //            console.log(typeof projects);

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
                            var selectVal = $(".custom-selectbox .selected");
                            var dataVal = $(".select-options li[data-id= " + ui.item.catid + "] a").html();
                            selectVal.html(dataVal);
                            $("#cat_id").val(ui.item.catid);
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

        var autocomplete = new google.maps.places.Autocomplete($(".locationfield")[0], {
            componentRestrictions: {country: "au"},
            types: ['(cities)']
        });
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
