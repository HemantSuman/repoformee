$(document).ready(function () {

    var projects = [];

//*************Accordion Start*************//
    //ACCORDION BUTTON ACTION (ON CLICK DO THE FOLLOWING)
    $('.accordionButton').click(function () {
        //REMOVE THE ON CLASS FROM ALL BUTTONS
        $('.accordionButton').removeClass('on');

        //NO MATTER WHAT WE CLOSE ALL OPEN SLIDES
        $('.accordionContent').slideUp('normal');

        //IF THE NEXT SLIDE WASN'T OPEN THEN OPEN IT
        if ($(this).next().is(':hidden') == true) {

            //ADD THE ON CLASS TO THE BUTTON
            $(this).addClass('on');

            //OPEN THE SLIDE
            $(this).next().slideDown('normal');
        }

    });


    /*** REMOVE IF MOUSEOVER IS NOT REQUIRED ***/

    //ADDS THE .OVER CLASS FROM THE STYLESHEET ON MOUSEOVER 
    $('.accordionButton').mouseover(function () {
        $(this).addClass('over');

        //ON MOUSEOUT REMOVE THE OVER CLASS
    }).mouseout(function () {
        $(this).removeClass('over');
    });

    /*** END REMOVE IF MOUSEOVER IS NOT REQUIRED ***/


    /********************************************************************************************************************
     CLOSES ALL S ON PAGE LOAD
     ********************************************************************************************************************/
    $('.accordionContent').hide();

    /** open first child **/
    $('.accordion-row:first-child .accordionContent').show('normal').prev('.accordionButton').addClass('on');

//*************Accordion end*************//

    /*Ad slider*/
    premium_sliderforlisting();
    /*/Ad slider*/

});


function premium_sliderforlisting() {

    $('.ad-panel .owl-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        smartSpeed: 1000,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {

            0: {
                items: 1
            }
        }
    });

    /*Real Estate listing Slider*/
    $('.real-list').slick({
        dots: false,
        infinite: false,
    });

}

//on click category label - show all main category in sidebar filter
$(document).on('click', '.cat_label_li', function () {

//    if ($(this).hasClass('open')) {
    $('.child_cat_ul li').show();
//    }

});

//on change drop down in filter
$(document).on('change', '.onchange_dropdown', function () {

    get_classified_and_attribute_on_filter_cahnge();
});

//on click go button with min max in filter
$(document).on('click', '.go_button_numeric', function () {
    get_classified_and_attribute_on_filter_cahnge();
});

//on change drop down sort classified listing
$(document).on('change', '.sort-classified-listing', function () {

    $('.order_by').val($(this).val());

    get_classified_and_attribute_on_filter_cahnge();
});

function get_classified_and_attribute_on_filter_cahnge() {

    var form = $('#filter_sidebar_formid')[0];
    var formData = new FormData(form);

    $.ajax({
        type: "GET",
        url: $(form).attr('action'),
        data: $("#filter_sidebar_formid").serialize(),
        dataType: "html",
        processData: false,
        contentType: false,
        //json: true,
        cache: false,
        success: function (response) {
            $('.middle_and_right_section_listing').html(response);
//            $('.middle_section_listing').html(response);

            /*Ad slider*/
            premium_sliderforlisting();
            /*/Ad slider*/
//            console.log(response);
        }
    });
}

$(document).on('click', '.child_cat_li', function () {

    $('.cat_id').val($(this).attr('cat_id'));

    $('.child_cat_ul li').removeClass('subcat-active');
    $(this).parent('li').addClass('subcat-active');

    get_classified_and_attribute_on_cat_change($(this).attr('cat_id'));
    get_banner_on_cat_change($(this).attr('cat_id'));

});

function get_classified_and_attribute_on_cat_change(cat_id) {

    // get all classified, middle part of page
    $.ajax({
        url: root_url + '/search_classifieds_filter_category',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            cat_id: cat_id,
        },
        //dataType: "html",
        method: "GET",
        cache: true,
        success: function (response) {
            $('.middle_and_right_section_listing').html(response);

            /*Ad slider*/
            premium_sliderforlisting();
            /*/Ad slider*/
        }
    });


    // get all dynamic attributes, left side bar bottpm part of page
    $.ajax({
        url: root_url + '/search_classifieds_filter_dynamic_attributes',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            cat_id: cat_id,
        },
        //dataType: "html",
        method: "GET",
        cache: true,
        success: function (response) {
            $('.dynamic_attr_sidebar').html(response);

            $('#multiple [data-accordion]').accordion({
                singleOpen: false
            });
        }
    });

}

function get_banner_on_cat_change(cat_id) {

    // get all classified, middle part of page
    $.ajax({
        url: root_url + '/get_banner_on_cat_change',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            cat_id: cat_id,
        },
        //dataType: "html",
        method: "POST",
        cache: true,
        success: function (response) {
            if (response.top_positions_ads.length != 0) {
                var html_top = "";
                html_top += "<div class='banner-carousel'>";
                $.each(response.top_positions_ads, function (index, value) {

                    html_top += "<a href='" + value.image_url + "' target='_blank'>";
                    html_top += "<img class='owl-lazy' data-src='" + root_url + "/upload_images/advertisements/image/" + value.image + "' alt='banner-img'></a>";

                });
                html_top += "</div>";
            }
            $('.top_slider_banner').html(html_top);
            
            var items = $('.banner-carousel img');
            if (items.length > 1) {
                $('.banner-carousel').owlCarousel({
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                    lazyLoad: true,
                    loop: true,
                    margin: 0,
                    items: 1,
                    autoplay: true,
                    smartSpeed: 1000,
                    dots: true,
                    nav: false,
                    mouseDrag: false,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            dots: false,
                        },
                        767: {
                            dots: false,
                        }
                    }
                });
            } else {
                $('.banner-carousel').owlCarousel({
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                    lazyLoad: true,
                    loop: false,
                    margin: 0,
                    items: 1,
                    autoplay: true,
                    smartSpeed: 1000,
                    dots: false,
                    nav: false,
                    mouseDrag: false
                });
            }


            /*Ad slider*/
//            premium_sliderforlisting();
            /*/Ad slider*/
        }
    });
}
$(document).on('keyup blur', '#suburbs_text', function () {

    var thisObj = $(this);
    if ($(thisObj).val().length == 0) {
        $("#suburbs_id").val('');
    }

    if ($(thisObj).val().length <= 0) {
        get_classified_and_attribute_on_filter_cahnge();
    }
});


$(function () {
    $("#suburbs_text")
            // don't navigate away from the field on tab when selecting an item
            .on("keydown", function (event) {
                if (event.keyCode === $.ui.keyCode.TAB &&
                        $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                source: function (request, response) {

                    $.ajax({
                        url: root_url + '/get_suburbs_for_filter',
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                            text_data: $('#suburbs_text').val(),
                        },
                        dataType: "json",
                        method: "POST",
                        cache: true,
                        success: function (response1) {
                            response(response1.results);
                        }
                    });
//                    $.getJSON("search.php", {term: extractLast(request.term)}, response);
                },
                search: function () {
                    // custom minLength
//                    var term = extractLast(this.value);
//                    if (term.length < 2) {
//                        return false;
//                    }
                },
                focus: function () {
                    // prevent value inserted on focus
                    return false;
                },
                select: function (event, ui) {
                    this.value = ui.item.value;
                    $("#suburbs_id").val(ui.item.id);

//                    get classified and attributes
                    get_classified_and_attribute_on_filter_cahnge();
                    return false;
                }
            });
});


$(document).on("click", ".view-type li", function () {

    $(this).parent().children("li").removeClass("active");
    $(this).addClass("active");

    $('.search-listing.grid-view>ul>li').unSyncHeight();

    if ($(this).hasClass("list_view")) {
        //alert("list_view");
        $('#view_type').val('list-view');
        $(".search-listing").addClass("list-view").removeClass("grid-view");
        $('.search-listing.grid-view .list-row').unSyncHeight();
    } else {
        $('#view_type').val('grid-view');
        $(".search-listing").addClass("grid-view").removeClass("list-view");
        $('.search-listing.grid-view .list-row').syncHeight({updateOnResize: true});
    }

})

