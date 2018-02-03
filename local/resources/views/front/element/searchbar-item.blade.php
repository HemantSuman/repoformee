{!! Form::open(
array('url' => '/search_classifieds',
'class' => 'form',
'files' => true,
'id'=>'searchFrom',
'method'=>'GET',
)

);
!!}

<div id="main-search-form">
    <div class="container">
        <div class="all-category-search">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div id="myselect" class="custom-selectbox">
                    <div id="selectval" class="selected">All Categories</div>
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
                <div class="item-name">
                    <input type="search" name="itemname" placeholder="Item Name"  id="project" class="searchfield">

                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-6">
                <div class="location">
                    <div class="col-md-9 col-sm-8 pad-0">
                        <input type="search" name="city" placeholder="Location/City" class="locationfield" id="headerLocationSearchBox">
                        <input type="hidden" id="headerLocationSearchLat" name="lat" />
                        <input type="hidden" id="headerLocationSearchLong" name="lng" />

                        <input type="hidden" class="usr-state" name="usr_state" />
                        <input type="hidden" class="usr-city" name="usr_city" />
                        <input type="hidden" class="usr-pcode" name="usr_pcode" />
                    </div>
                    <div class="col-md-3 col-sm-4 pad-0">
                        <div class="km-dropdown">
                            <select name="km" class="km-list" id="km">
                                <?php for ($kmi = 5; $kmi <= 100; $kmi += 5) { ?>
                                    <option value="<?php echo $kmi; ?>"> <?php echo $kmi; ?> Km</option> <?php
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                    <input type="hidden" name="cat_id" id="cat_id">
                    <input type="submit"  value="" class="search-button">
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!} 

@section('scripts1')
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

// var cat_id = "<?php //echo $cat_id; ?>";
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
//    var dataVal = $(".select-options li[data-id= '<?php //echo $cat_id ?>'] a").html();
//    console.log(dataVal);
//    selectVal.html(dataVal);
//$('#amount').attr( 'datamin','1000');   
});


//function initMap() {
//    //var input = document.getElementById('searchInput');
//    var autocomplete = new google.maps.places.Autocomplete('<?php //echo $city            ?>');
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