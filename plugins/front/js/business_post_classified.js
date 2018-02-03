$(document).on('click', 'a.parent_cat', function () {
//alert('here');
    var categoryId = $(this).attr('categoryId');
    $('.parent_categoryid').val(categoryId);
    $('.category_id').val('');
    $('.pCatName').text($(this).find('.cat-name').text());
    $('.pCatIcon').attr('src', $(this).find('.cat-icon').attr('src'));
    $('.cCatName').text('');

//    $('.parent_cat').each(function (index, value) {
    $('.parent_cat').removeClass('active');
//    });
    $(this).addClass('active');

//    $('.emptySubCat').hide();
//    $('.filledSubCat').show();
    $('#sub-categories').html('');
    var categoryJson = JSON.parse($('.categoryJson').text());
    console.log(categoryJson[categoryId]);
    $.each(categoryJson[categoryId]['category_childs'], function (index, val) {
        console.log(val);
        var liForSub = "<li><a categoryId='" + val.id + "' href='javascript:void(0);' p_id='" + val.pid + "' class='child_cat'>";
        liForSub += "<span class='ad-cat-icon'><img class='cat-icon' src='" + root_url + "/upload_images/categories/icon/" + val.id + "/" + val.icon + "' ></span>";
        liForSub += "<span class='ad-cat-text cat-name'>" + val.name + "</span></a></li>";
        $('#sub-categories').append(liForSub);
    });
//    $.each(showStaticAttributes[0], function (index, val) {
//        if (index == categoryId) {
//
//            if (val) {
//                $('.sttcAttrbts').removeClass("hide");
//                //staticattribute
//                $('.staticattribute').addClass("staticattributevalidation");
//            } else {
//                $('.sttcAttrbts').addClass("hide");
//                $('.staticattribute').removeClass("staticattributevalidation");
//            }
//        }
//    });
});

$(document).on('click', '.child_cat', function () {

    var categoryId = $(this).attr('categoryId');
    $('.category_id').val(categoryId);

    var p_id = $(this).attr('p_id');
    $('.parent_categoryid').val(p_id);

    $('.child_cat').removeClass('active');
    $(this).addClass('active');

    $('.cCatName').text($(this).find('.cat-name').text());
    $('.cCatIcon').attr('src', $(this).find('.cat-icon').attr('src'));

    attributeListing(categoryId);
//    

});

function attributeListing(cat_id) {

    var price_ul = "";
    price_ul += "<li class='no-ad-padding'>";
    price_ul += "<label>Price</label>";
    price_ul += "<input is_required='0' iderr='price' class='textRequired price' type='number' name='price' >";
    price_ul += "<p class='ad-error' id='price_error'></p></li>";
    price_ul += "<li class='no-ad-padding price_to'></li>";


    $.ajax({
        url: root_url + '/user/attributes/allattributes',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": cat_id,
            "user_type": 'business',
            "membership_plan_user_id": $('.membership_plan_user_id').val(),
        },
        method: "GET",
        cache: false,
        success: function (response) {

            if (response.status) {
//                console.log(response.childCatDetail.is_sellable)
                if (response.childCatDetail.is_sellable == 0 && !response.template_arr) {
                    Notify.showNotification('Default template not set, please select another category');
                } else {
                    finalAttrObj = response.attributes;

                    $('.price_ul').html(price_ul);

                    $('#template_arr').val(JSON.stringify(response.template_arr));


                    //Inspection dates fields for real estate category
                    if (response.template_arr != null && response.template_arr.is_inspection_date == 1) {
                        var html_content = "";
                        html_content += "<li class='no-ad-padding'><label>Inspections Dates(Select 1 or more inspection dates)</label></li>";
                        html_content += "<input value='is_inspection_date' type='hidden' name='other_value[is_inspection_date][1][title]' >";
                        html_content += "<input value='is_inspection_date' type='hidden' name='other_value[is_inspection_date][2][title]' >";
                        html_content += "<input value='is_inspection_date' type='hidden' name='other_value[is_inspection_date][3][title]' >";
                        html_content += "<li class='no-ad-padding'><input is_required='0' iderr='inspection_date' inspection_date='1' class='datepicker inspection_date inspection_date_1 textRequired' type='text' name='other_value[is_inspection_date][1][desc]'></li>";
                        html_content += "<li class='no-ad-padding'><input is_required='0' iderr='inspection_date' inspection_date='2' class='datepicker inspection_date inspection_date_2 textRequired' type='text' name='other_value[is_inspection_date][2][desc]'></li>";
                        html_content += "<li class='no-ad-padding'><input is_required='0' iderr='inspection_date' inspection_date='3' class='datepicker inspection_date inspection_date_3 textRequired' type='text' name='other_value[is_inspection_date][3][desc]'></li>";
                        html_content += "<p class='ad-error' id='inspection_date_error'></p>";
                        $('#inspection_date_div').html(html_content);
                        $(".datepicker").datepicker({
                            minDate: new Date()
                        }).on('change', function (selected) {

//                        var thisObj = $(this);
//                        var inspection_date = parseInt($(thisObj).attr('inspection_date'));
//                        
//                        if (inspection_date == 1) {
//                            console.log();
//                            $('.inspection_date_' + 2).datepicker("option", "minDate", $(this).val());
//                        } else {
//
//                        }
                        });
                        ;
                    } else {
                        $('#inspection_date_div').html('');
                    }

                    //questions answer fields for job category
                    if (response.template_arr != null && response.template_arr.questions_answer == 1) {
                        $('#questions_answer_parent_div').show();


                        var html_content = "";
                        html_content = "<ul class='ad-detail-form-sec' >";

                        html_content += "<li class='no-ad-padding'>";
                        html_content += "<label>Question 1</label>";
                        html_content += "<input is_required='1' iderr='question_1' name='questions[1][question]' class='questions_input textRequired' type='text' placeholder='Please type your question here' >";
                        html_content += "<p class='ad-error' id='question_1_error'></p>";
                        html_content += "</li>";

                        html_content += "<li class='no-ad-padding'>";
                        html_content += "";

                        html_content += "<div class='row step3row'><div class='col-sm-12'><label class='ans_style11'>Answer Style:</label>";
                        html_content += "<ul class='contact-surname ul_ans_style' iderr='ans_style_1'>";
                        html_content += "<li><input is_required='1'  ques_no=1 id='ans_type_dropdown_1' value='dropdown' class='ans_type' radio_lable='dropdown' name='questions[1][ans_type]' type='radio' ><label for='ans_type_dropdown_1'>Dropdown</label></li>";
                        html_content += "<li><input is_required='1'  ques_no=1 id='ans_type_radio_1' value='radio' class='ans_type' radio_lable='radio'  name='questions[1][ans_type]' type='radio' ><label for='ans_type_radio_1'>Radio Button</label></li>";
                        html_content += "<li><input is_required='1'  ques_no=1 id='ans_type_text_1' value='text' class='ans_type' radio_lable='text'  name='questions[1][ans_type]' type='radio' ><label for='ans_type_text_1'>Textbox</label></li>";
                        html_content += "</ul></div></div>";

                        html_content += "<p class='ad-error' id='ans_style_1_error'></p>";
                        html_content += "</li>";

                        html_content += "<li class='no-ad-padding'>";
                        html_content += "<ul class='ad-detail-form-sec answer_input answer_input_1' >";
                        html_content += "</ul>";
                        html_content += "</li>";
                        html_content += "<li class='no-ad-padding'><a style='display:none;' ques_no=1 class='add_more_ans add_more_ans_1' href='javascript:void(0);' ><i class='fa fa-plus'></i>Add Option</a></li></ul>";

//                    $('#questions_answer_div').html(html_content);
                        $('#questions_answer_div').fadeOut(500, function () {
                            $(this).html(html_content).fadeIn(500);
                        });

                    } else {
                        $('#questions_answer_parent_div').hide();
                        $('#questions_answer_div').html('');
                    }

                    //is sellable category
                    if (response.childCatDetail != null && response.childCatDetail.is_sellable == 1) {
                        $('#is_sellable_attrs_ul').show();
                        $('#is_features_parent_div').show();
                        $('#demo_guides_parent_div').show();
                        $('.product_description_ul').show();
                        $('.price_ul').html('');

                        var html_content = "";
                        html_content += "<li class='no-ad-padding'>";
                        html_content += "<label>Price</label>";
                        html_content += "<div class='price-half'>";
                        html_content += "<input is_required='1' iderr='price' class='textRequired price' type='number' name='price' placeholder='Price' >";
                        html_content += "<p class='ad-error' id='price_error'></p>";
                        html_content += "<span class='ad-form-price'>AUD</span>";
                        html_content += "</div>";
                        html_content += "<div class='price-half-2'>";
                        html_content += "<div class='row step3row'>";
                        html_content += "<div class='col-sm-12'>";
                        html_content += "<ul class='contact-surname'>";
                        html_content += "<li><input label_name='amount' name='price_type' class='' type='radio' is_required='' checked='checked' value='amount'><label for='amount'>Amount</label></li>";
                        html_content += "<li><input label_name='negotiable' name='price_type' class='' type='radio' is_required='' value='negotiable'><label for='negotiable'>Negotiable</label></li>";
                        html_content += "</ul></div></div></div></li>";

                        html_content += "<li class='no-ad-padding'>";
                        html_content += "<label>Quantity</label>";
                        html_content += "<div class='price-half'>";
                        html_content += "<input is_required='1' iderr='quantity' class='textRequired quantity' type='number' name='quantity' placeholder='quantity' >";
                        html_content += "<p class='ad-error' id='quantity_error'></p>";
                        html_content += "</div></li>";

                        html_content += "<li class='no-ad-padding'>";
                        html_content += "<input type='checkbox' name='min_offer_check' class='custom-checkbox min_price_check' ><label>Would you like to set a minimum offer amount?</label>";
                        html_content += "</li>";

                        html_content += "<li class='no-ad-padding min_price_li'>";
                        html_content += "</li>";

                        html_content += "<li class='no-ad-padding'><label>Condition</label>";
                        html_content += "<div class='row step3row'>";
                        html_content += "<ul class='contact-surname'>";
                        html_content += "<li><input label_name='used' name='condition' type='radio' is_required='' checked='checked' value='used'><label for='used'>Used</label></li>";
                        html_content += "<li><input label_name='new' name='condition' type='radio' is_required='' value='new'><label for='new'>New</label></li>";
                        html_content += "</ul></div>";


                        html_content += "<li><input type='checkbox' name='pay_pal' class='custom-checkbox paypal_check'>";
                        html_content += "<label><img src='" + root_url + "/plugins/front/img/pp.png' alt='Paypal'></label>";
                        html_content += "</li>";

                        html_content += "<li><div class='pickup-check'>";
                        html_content += "<input type='checkbox' name='pic_n_pay' class='custom-checkbox pic_n_pay_check'>";
                        html_content += "<label for='pick'>PICK UP N’ PAY</label>";
                        html_content += "</div>";

                        html_content += "<div class='pickup-check-inputs pic_n_pay_div'></div></li>";
                        html_content += "<li><label>Shipping</label><div class='row step3row'><ul class='contact-surname'><li>";
                        html_content += "<input class='shipping_check' id='free' name='shipping' value='0' checked='checked' type='radio'>";
                        html_content += "<label for='free'>Free</label><div class='check'></div></li>";

                        html_content += "<li><input class='shipping_check' id='ship_value' name='shipping' value='1' type='radio'>";
                        html_content += "<label for='ship_value'>Enter Shipping Amount</label>";
                        html_content += "<div class='check'></div></li></ul>";
                        html_content += "<div class='free-ship-cal shipping_amount_div'>";
                        html_content += "</div></div></li>";



                        var html_content_features = "";
                        html_content_features = "<ul class='ad-detail-form-sec border-seprator' >";

                        html_content_features += "<li class='no-ad-padding'>";
                        html_content_features += "<label>Title</label>";
                        html_content_features += "<input is_required='0' idErr='title_1' name='other_value[is_features][1][title]' class='features_title_input textRequired_static' type='text' placeholder='Please type your title here' >";
                        html_content_features += "<p class='ad-error' id='title_1_error'></p>";
                        html_content_features += "</li>";

                        html_content_features += "<li class='no-ad-padding'>";
                        html_content_features += "<label>Feature Image</label>";
                        html_content_features += "<input is_required='0' idErr='is_feature_img_1' name='other_value[is_features][1][image]' class='is_feature_img textRequired_static' type='file' >";
                        html_content_features += "<p class='ad-error' id='is_feature_img_1_error'></p>";
                        html_content_features += "</li>";

                        html_content_features += "<li class='no-ad-padding'>";
                        html_content_features += "<label>Description</label>";
                        html_content_features += "<textarea is_required='0' idErr='is_feature_desc_1' cols='68' rows='5' name='other_value[is_features][1][desc]' class='is_feature_desc textRequired_static' ></textarea>";
                        html_content_features += "<p class='ad-error' id='is_feature_desc_1_error'></p>";
                        html_content_features += "</li></ul>";

                        var html_content_demo_guides = "";
                        html_content_demo_guides = "<ul class='ad-detail-form-sec border-seprator' >";

                        html_content_demo_guides += "<li class='no-ad-padding'>";
                        html_content_demo_guides += "<label>Title</label>";
                        html_content_demo_guides += "<input is_required='0' idErr='demo_guides_title_1' name='other_value[demo_guides][1][title]' class='demo_guides_title_input textRequired_static' type='text' placeholder='Please type your title here' >";
                        html_content_demo_guides += "<p class='ad-error' id='demo_guides_title_1_error'></p>";
                        html_content_demo_guides += "</li>";

                        html_content_demo_guides += "<li class='no-ad-padding'>";
                        html_content_demo_guides += "<label>Content Type</label>";
                        html_content_demo_guides += "<select is_required='0' idErr='demo_guides_content_type_1' name='other_value[demo_guides][1][content_type]' class='demo_guides_content_type textRequired_static' >";
                        html_content_demo_guides += "<option value=''>--Select--</option>";
                        html_content_demo_guides += "<option value='image'>Image</option>";
                        html_content_demo_guides += "<option value='url'>Url</option>";
                        html_content_demo_guides += "</select>";
                        html_content_demo_guides += "<p class='ad-error' id='demo_guides_content_type_1_error'></p>";
                        html_content_demo_guides += "</li>";

                        html_content_demo_guides += "<li class='no-ad-padding demo_guides_image_li' style='display:none;'>";
                        html_content_demo_guides += "<label>Image</label>";
                        html_content_demo_guides += "<input is_required='0' idErr='demo_guides_img_1' name='other_value[demo_guides][1][image]' class='demo_guides_img textRequired_static' type='file' >";
                        html_content_demo_guides += "<p class='ad-error' id='demo_guides_img_1_error'></p>";
                        html_content_demo_guides += "</li>";

                        html_content_demo_guides += "<li class='no-ad-padding demo_guides_url_li' style='display:none;'>";
                        html_content_demo_guides += "<label>Url</label>";
                        html_content_demo_guides += "<input is_required='0' idErr='demo_guides_url_1' name='other_value[demo_guides][1][url]' class='demo_guides_url textRequired_static' type='text' >";
                        html_content_demo_guides += "<p class='ad-error' id='demo_guides_url_1_error'></p>";
                        html_content_demo_guides += "</li>";

                        html_content_demo_guides += "<li class='no-ad-padding'>";
                        html_content_demo_guides += "<label>Description</label>";
                        html_content_demo_guides += "<textarea is_required='0' idErr='demo_guides_desc_1' cols='68' rows='5' name='other_value[demo_guides][1][desc]' class='demo_guides_desc textRequired_static' ></textarea>";
                        html_content_demo_guides += "<p class='ad-error' id='demo_guides_desc_1_error'></p>";
                        html_content_demo_guides += "</li></ul>";



                        $('#is_sellable_attrs_ul').html(html_content);
                        $('#is_features_div').html(html_content_features);
                        $('#demo_guides_div').html(html_content_demo_guides);

                    } else {
                        $('#is_sellable_attrs_ul').html('');
                        $('.product_description_ul').hide();
                        $('#is_features_div').html('');
                        $('#demo_guides_div').html('');
                        $('#is_features_parent_div').hide();
                        $('#demo_guides_parent_div').hide();

                        // price range field for real estate category type
                        if (response.template_arr != null && response.template_arr.is_price_range == 1) {

                            var is_price_range_html = "";
                            is_price_range_html += "<label>Price To</label>";
                            is_price_range_html += "<input is_required='1' iderr='price_to' class='textRequired' type='number' name='price_to'>";
                            is_price_range_html += "<p class='ad-error' id='price_to_error'></p>";
                            $('.price_to').html(is_price_range_html);
                            $('.price').attr('is_required', 1);
                        } else {
                            $('.price_ul').html('');
                            $('.price_to').html('');
                            $('.price').attr('is_required', 0);
                        }
                    }

//                $('.tab2').click();
                    $('#select_category').fadeOut(500, function () {
                        $('.tab-content2').fadeIn(500);
                    });
                    placeAllAtter();
                }
            } else {
                Notify.showNotification(response.message);
            }
        }
    });
}

$(document).on('change', '.demo_guides_content_type', function () {

    var thisObj = $(this);
    var thisUlObj = $(this).parents('ul');

    if ($(thisObj).val() == 'image') {
        $('.demo_guides_url_li', thisUlObj).hide();
        $('.demo_guides_image_li', thisUlObj).show();
    } else if ($(thisObj).val() == 'url') {
        $('.demo_guides_image_li', thisUlObj).hide();
        $('.demo_guides_url_li', thisUlObj).show();
    } else {
        $('.demo_guides_image_li', thisUlObj).hide();
        $('.demo_guides_url_li', thisUlObj).hide();
    }

});

$(document).on('click', '.min_price_check', function () {

    var thisObj = $(this);
    if ($(thisObj).is(':checked')) {
        var html_content = "";
        html_content += "<label>Set Minimum Price</label>";
        html_content += "<div class='price-half'>";
        html_content += "<input is_required='1' iderr='minimum_price' class='textRequired' type='number' name='minimum_price' placeholder='Minimum Price' >";
        html_content += "<p class='ad-error' id='minimum_price_error'></p>";
        html_content += "<span class='ad-form-price'>AUD<span class='form-tag-line'>You will not receive offers/notifications below the minimum offer amount</span></span>";
        html_content += "</div>";

        $('.min_price_li').fadeOut(500, function () {
            $(this).html(html_content).fadeIn(500);
        });
//        $('.min_price_li').html(html_content).slideDown('slow');
    } else {
        $('.min_price_li').slideUp(600, function () {
            $(this).html('');
        });
//        $('.min_price_li').html('');
    }
});

$(document).on('click', '.pic_n_pay_check', function () {

    var thisObj = $(this);
    if ($(thisObj).is(':checked')) {

        var html_content = "";
        html_content += "<ul class = 'pickup-check-ul' >";
        html_content += "<input type='hidden' name='pick_lat' id='pick_lat'>";
        html_content += "<input type='hidden' name='pick_lng' id='pick_lng'>";
        html_content += "<li><input is_required='1' class='textRequired' type='text' iderr='pick_address' id='pick_address' name='pick_address' placeholder='Street No. & Street Name'><p class='ad-error' id='pick_address_error'></p></li>";
        html_content += "<li><input is_required='1' class='textRequired' type='text' iderr='pick_city' id='pick_city' name='pick_city' placeholder='City'><p class='ad-error' id='pick_city_error'></p></li>";
//        html_content += "<li><input is_required='1' class='textRequired' type='text' iderr='pick_country' id='pick_country' name='pick_country' placeholder='Country'><p class='ad-error' id='pick_country_error'></p></li>";
        html_content += "<li class='badge-series-row'>";
        html_content += "<input is_required='1' class='textRequired' type='text' iderr='pick_state' id='pick_state' name='pick_state' placeholder='State'><p class='ad-error' id='pick_state_error'></p>";
        html_content += "<input is_required='1' class='textRequired' type='text' iderr='pick_zip' id='pick_zip' name='pick_zip' placeholder='ZIP Code' class='pull-right'><p class='ad-error' id='pick_zip_error'></p>";
        html_content += "</li></ul>";
        console.log(stateCode);
        $('.pic_n_pay_div').fadeOut(500, function () {
            $(this).html(html_content).fadeIn(500);
            var autocomplete1 = new google.maps.places.Autocomplete($("#pick_address")[0], {
                componentRestrictions: {country: "au"},
                types: []
            });
            google.maps.event.addListener(autocomplete1, 'place_changed', function () {
                var place = autocomplete1.getPlace();

                document.getElementById('pick_lat').value = place.geometry.location.lat();
                document.getElementById('pick_lng').value = place.geometry.location.lng();

                var place = autocomplete1.getPlace();
                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    console.log(addressType);
                    if (addressType == 'administrative_area_level_1') {
                        var gStateId = place.address_components[i]['short_name'];
                        var state = place.address_components[i]['long_name'];
                        $('#pick_state').val(state);
                    }
                    if (addressType == 'locality') {
                        var gCityCode = place.address_components[i]['long_name'];
                        console.log(gCityCode);
                        $('#pick_city').val(gCityCode);
                    }
                    if (addressType == 'postal_code') {
                        var gPostalCode = place.address_components[i]['short_name'];
                        $('#pick_zip').val(gPostalCode);
                    }
                }
            });
        });


    } else {
        $('.pic_n_pay_div').slideUp(600, function () {
            $(this).html('');
        });
//        $('.min_price_li').html('');
    }
});

$(document).on('change', '.shipping_check', function () {

    var thisObj = $(this);
    if ($(thisObj).val() == 1) {
        var html_content = "";
        html_content += "<div style='margin-bottom:5px;width:45%;float: left;margin-right: 5px;'><input is_required='1' iderr='ship_name_1' class='textRequired' type='text' name='ship_name_1' placeholder='Shipping Name'>";
        html_content += "<p class='ad-error' id='ship_name_1_error'></p></div>";
        html_content += "<div style='margin-bottom:5px;width:45%;float: left;margin-right: 5px;'><input is_required='1' iderr='ship_amount_1' class='textRequired' type='text' name='ship_amount_1' placeholder='Price'>";
        html_content += "<p class='ad-error' id='ship_amount_1_error'></p>";
        html_content += "<span class='ad-form-price'>AUD</span></div>";

        html_content += "<div style='margin-bottom:5px;width:45%;float: left;margin-right: 5px;'><input is_required='0' iderr='ship_name_2' class='textRequired' type='text' name='ship_name_2' placeholder='Shipping Name'>";
        html_content += "<p class='ad-error' id='ship_name_2_error'></p></div>";
        html_content += "<div style='margin-bottom:5px;width:45%;float: left;margin-right: 5px;'><input is_required='0' iderr='ship_amount_2' class='textRequired' type='text' name='ship_amount_2' placeholder='Price'>";
        html_content += "<p class='ad-error' id='ship_amount_2_error'></p>";
        html_content += "<span class='ad-form-price'>AUD</span></div>";

        html_content += "<div style='margin-bottom:5px;width:45%;float: left;margin-right: 5px;'><input is_required='0' iderr='ship_name_3' class='textRequired' type='text' name='ship_name_3' placeholder='Shipping Name'>";
        html_content += "<p class='ad-error' id='ship_name_3_error'></p></div>";
        html_content += "<div style='margin-bottom:5px;width:45%;float: left;margin-right: 5px;'><input is_required='0' iderr='ship_amount_3' class='textRequired' type='text' name='ship_amount_3' placeholder='Price'>";
        html_content += "<p class='ad-error' id='ship_amount_3_error'></p>";
        html_content += "<span class='ad-form-price'>AUD</span></div>";

        html_content += "<a href='#'>Free Shiping Cal.</a>";

        $('.shipping_amount_div').fadeOut(500, function () {
            $(this).html(html_content).fadeIn(500);
        });
//        $('.min_price_li').html(html_content).slideDown('slow');
    } else {
        $('.shipping_amount_div').slideUp(600, function () {
            $(this).html('');
        });
//        $('.min_price_li').html('');
    }
});

$(document).on('click', '.ans_type', function () {
    var thisObj = $(this);
    var ques_no = $(thisObj).attr('ques_no');
    var ques_no_plus = parseInt(ques_no) + 1;

    if ($(thisObj).attr('radio_lable') == 'dropdown' || $(thisObj).attr('radio_lable') == 'radio') {
        var html_content = '';
        html_content += "<li class='no-ad-padding'>";
        html_content += "<input is_required='1' iderr='answer_" + ques_no + "_1' class='ans_class textRequired' name='questions[" + ques_no + "][options][]' type='text' placeholder='Answer Option 1' >";
        html_content += "<p class='ad-error' id='answer_" + ques_no + "_1_error'></p>";
        html_content += "</li>";

        html_content += "<li class='no-ad-padding'>";
        html_content += "<input is_required='1' iderr='answer_" + ques_no + "_2' class='ans_class textRequired' name='questions[" + ques_no + "][options][]' type='text' placeholder='Answer Option 2' >";
        html_content += "<p class='ad-error' id='answer_" + ques_no + "_2_error'></p>";
        html_content += "</li>";

        $('.add_more_ans_' + ques_no).show();

    } else if ($(thisObj).attr('radio_lable') == 'text') {
        var html_content = '';
        $('.add_more_ans_' + ques_no).hide();
    }
//    $('.answer_input_' + ques_no).html(html_content);
    $('.answer_input_' + ques_no).fadeOut(500, function () {
        $(this).html(html_content).fadeIn(500);
    });
});

$(document).on('click', '.add_more_ans', function () {
    var thisObj = $(this);
    var ques_no = $(thisObj).attr('ques_no');
    var ques_no_plus = parseInt(ques_no) + 1;

    var li_count = $('.answer_input_' + ques_no + ' li').length;
    var li_count_plus = parseInt(li_count) + 1;
    console.log(li_count);
    console.log(li_count_plus);

    if (li_count != 0 && li_count < 10) {
        var html_content = '';
        html_content += "<li class='no-ad-padding'><a ques_no='" + ques_no + "' option_no='" + li_count_plus + "' class='que-close-btn close_option close_option_" + ques_no + "_" + li_count_plus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        html_content += "<input is_required='1' iderr='answer_" + ques_no + "_" + li_count_plus + "' class='ans_class textRequired' name='questions[" + ques_no + "][options][]' type='text' placeholder='Answer Option " + li_count_plus + "' >";
        html_content += "<p class='ad-error' id='answer_" + ques_no + "_" + li_count_plus + "_error'></p>";
        html_content += "</li>";

        $('.close_option_' + ques_no + '_' + li_count).remove();

        $(html_content).hide();
        $('.answer_input_' + ques_no).append(html_content);
        $(html_content).slideDown("slow");
//        $('.answer_input_' + ques_no).fadeOut(500, function () {
//            $(this).append(html_content).fadeIn(500);
//        });
    }

});

$(document).on('click', '.close_option', function () {

    var thisObj = $(this);
    var ques_no = $(thisObj).attr('ques_no');
    var option_no = $(thisObj).attr('option_no');
    var option_no_minus = parseInt(option_no) - 1;
    $(thisObj).parent('li').remove();

    if (parseInt($(".answer_input_" + ques_no + " li").length) > 2) {

        var html_content = "";
        html_content += "<a ques_no='" + ques_no + "' option_no='" + option_no_minus + "' class='que-close-btn close_option close_option_" + ques_no + "_" + option_no_minus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        $(".answer_input_" + ques_no + " li:last").prepend(html_content);
    }

});

$(document).on('click', '.close_ques', function () {

    var thisObj = $(this);
    var ques_no = $("#questions_answer_div > ul").length;
//    var option_no = $(thisObj).attr('option_no');
    var ques_no_minus = parseInt(ques_no) - 1;
    $(thisObj).parents('ul').remove();

    if (parseInt($("#questions_answer_div > ul").length) > 1) {

        var html_content = "";
        html_content += "<a class='que-close-btn close_ques close_ques_" + ques_no_minus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        $("#questions_answer_div > ul:last li:first").prepend(html_content);
    }

});

$(document).on('click', '.add_more_ques', function () {
    var thisObj = $(this);
//    var ques_no = $(thisObj).attr('ques_no');
    var ques_no = $('#questions_answer_div > ul').length;
    var ques_no_plus = parseInt(ques_no) + 1;
    console.log(ques_no);

    if (ques_no != 0 && ques_no < 5) {

        $('.close_ques_' + ques_no).remove();

        var html_content = "";
        html_content = "<ul class='ad-detail-form-sec' >";

        html_content += "<li class='no-ad-padding'><a class='que-close-btn close_ques close_ques_" + ques_no_plus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        html_content += "<label>Question " + ques_no_plus + "</label>";
        html_content += "<input is_required='1' iderr='question_" + ques_no_plus + "' name='questions[" + ques_no_plus + "][question]' class='questions_input textRequired' type='text' placeholder='Please type your question here' >";
        html_content += "<p class='ad-error' id='question_" + ques_no_plus + "_error'></p>";
        html_content += "</li>";

        html_content += "<li class='no-ad-padding'>";
        html_content += "";

        html_content += "<div class='row step3row'><div class='col-sm-12'><label class='ans_style11'>Answer Style:</label>";
        html_content += "<ul class='contact-surname ul_ans_style' iderr='ans_style_" + ques_no_plus + "'>";
        html_content += "<li><input is_required='1'  ques_no='" + ques_no_plus + "' id='ans_type_dropdown_" + ques_no_plus + "' class='ans_type' value='dropdown' radio_lable='dropdown' name='questions[" + ques_no_plus + "][ans_type]' type='radio' ><label for='ans_type_dropdown_" + ques_no_plus + "'>Dropdown</label></li>";
        html_content += "<li><input is_required='1'  ques_no='" + ques_no_plus + "' id='ans_type_radio_" + ques_no_plus + "' class='ans_type' value='radio' radio_lable='radio'  name='questions[" + ques_no_plus + "][ans_type]' type='radio' ><label for='ans_type_radio_" + ques_no_plus + "'>Radio Button</label></li>";
        html_content += "<li><input is_required='1'  ques_no='" + ques_no_plus + "' id='ans_type_text_" + ques_no_plus + "' class='ans_type' value='text' radio_lable='text'  name='questions[" + ques_no_plus + "][ans_type]' type='radio' ><label for='ans_type_text_" + ques_no_plus + "'>Textbox</label></li>";
        html_content += "</ul></div></div>";

        html_content += "<p class='ad-error' id='ans_style_" + ques_no_plus + "_error'></p>";
        html_content += "</li>";

        html_content += "<li class='no-ad-padding'>";
        html_content += "<ul class='ad-detail-form-sec answer_input answer_input_" + ques_no_plus + "' >";
        html_content += "</ul>";
        html_content += "</li>";
        html_content += "<li class='no-ad-padding'><a style='display: none;' ques_no=" + ques_no_plus + " class='add_more_ans add_more_ans_" + ques_no_plus + "' href='javascript:void(0);' ><i class='fa fa-plus'></i>Add Option</a></li></ul>";

        $('#questions_answer_div').fadeOut(500, function () {
            $(this).append(html_content).fadeIn(500);
        });
    }

});


$(document).on('click', '.add_more_features', function () {
    var thisObj = $(this);
    var count_no = $('#is_features_div > ul').length;
    var count_no_plus = parseInt(count_no) + 1;

    if (count_no != 0 && count_no < 10) {

        $('.close_features_' + count_no).remove();

        var html_content_features = "";
        html_content_features = "<ul class='ad-detail-form-sec border-seprator' >";

        html_content_features += "<li class='no-ad-padding'><a class='que-close-btn close_features close_features_" + count_no_plus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        html_content_features += "<label>Title</label>";
        html_content_features += "<input is_required='0' idErr='title_" + count_no_plus + "' name='other_value[is_features][" + count_no_plus + "][title]' class='features_title_input textRequired_static' type='text' placeholder='Please type your title here' >";
        html_content_features += "<p class='ad-error' id='title_" + count_no_plus + "_error'></p>";
        html_content_features += "</li>";

        html_content_features += "<li class='no-ad-padding'>";
        html_content_features += "<label>Feature Image</label>";
        html_content_features += "<input is_required='0' idErr='is_feature_img_" + count_no_plus + "' name='other_value[is_features][" + count_no_plus + "][image]' class='is_feature_img textRequired_static' type='file' >";
        html_content_features += "<p class='ad-error' id='is_feature_img_" + count_no_plus + "_error'></p>";
        html_content_features += "</li>";

        html_content_features += "<li class='no-ad-padding'>";
        html_content_features += "<label>Description</label>";
        html_content_features += "<textarea is_required='0' idErr='is_feature_desc_" + count_no_plus + "' cols='68' rows='5' name='other_value[is_features][" + count_no_plus + "][desc]' class='is_feature_desc textRequired_static' ></textarea>";
        html_content_features += "<p class='ad-error' id='is_feature_desc_" + count_no_plus + "_error'></p>";
        html_content_features += "</li></ul>";

        $('#is_features_div').fadeOut(500, function () {
            $(this).append(html_content_features).fadeIn(500);
        });
    }

});

$(document).on('click', '.add_more_demo_guides', function () {
    var thisObj = $(this);
    var count_no = $('#demo_guides_div > ul').length;
    var count_no_plus = parseInt(count_no) + 1;

    if (count_no != 0 && count_no < 10) {

        $('.demo_guides_' + count_no).remove();

        var html_content_demo_guides = "";
        html_content_demo_guides = "<ul class='ad-detail-form-sec border-seprator' >";

        html_content_demo_guides += "<li class='no-ad-padding'><a class='que-close-btn close_demo_guides demo_guides_" + count_no_plus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        html_content_demo_guides += "<label>Title</label>";
        html_content_demo_guides += "<input is_required='0' idErr='demo_guides_title_" + count_no_plus + "' name='other_value[demo_guides][" + count_no_plus + "][title]' class='demo_guides_title_input textRequired_static' type='text' placeholder='Please type your title here' >";
        html_content_demo_guides += "<p class='ad-error' id='demo_guides_title_" + count_no_plus + "_error'></p>";
        html_content_demo_guides += "</li>";

        html_content_demo_guides += "<li class='no-ad-padding'>";
        html_content_demo_guides += "<label>Content Type</label>";
        html_content_demo_guides += "<select is_required='0' idErr='demo_guides_content_type_" + count_no_plus + "' name='other_value[demo_guides][" + count_no_plus + "][content_type]' class='demo_guides_content_type textRequired_static' >";
        html_content_demo_guides += "<option value=''>--Select--</option>";
        html_content_demo_guides += "<option value='image'>Image</option>";
        html_content_demo_guides += "<option value='url'>Url</option>";
        html_content_demo_guides += "</select>";
        html_content_demo_guides += "<p class='ad-error' id='demo_guides_content_type_" + count_no_plus + "_error'></p>";
        html_content_demo_guides += "</li>";

        html_content_demo_guides += "<li class='no-ad-padding demo_guides_image_li' style='display:none;'>";
        html_content_demo_guides += "<label>Image</label>";
        html_content_demo_guides += "<input is_required='0' idErr='demo_guides_img_" + count_no_plus + "' name='other_value[demo_guides][" + count_no_plus + "][image]' class='demo_guides_img textRequired_static' type='file' >";
        html_content_demo_guides += "<p class='ad-error' id='demo_guides_img_" + count_no_plus + "_error'></p>";
        html_content_demo_guides += "</li>";

        html_content_demo_guides += "<li class='no-ad-padding demo_guides_url_li' style='display:none;'>";
        html_content_demo_guides += "<label>Url</label>";
        html_content_demo_guides += "<input is_required='0' idErr='demo_guides_url_" + count_no_plus + "' name='other_value[demo_guides][" + count_no_plus + "][url]' class='demo_guides_url textRequired_static' type='text' >";
        html_content_demo_guides += "<p class='ad-error' id='demo_guides_url_" + count_no_plus + "_error'></p>";
        html_content_demo_guides += "</li>";

        html_content_demo_guides += "<li class='no-ad-padding'>";
        html_content_demo_guides += "<label>Description</label>";
        html_content_demo_guides += "<textarea is_required='0' idErr='demo_guides_desc_" + count_no_plus + "' cols='68' rows='5' name='other_value[demo_guides][" + count_no_plus + "][desc]' class='demo_guides_desc textRequired_static' ></textarea>";
        html_content_demo_guides += "<p class='ad-error' id='demo_guides_desc_" + count_no_plus + "_error'></p>";
        html_content_demo_guides += "</li></ul>";

        $('#demo_guides_div').fadeOut(500, function () {
            $(this).append(html_content_demo_guides).fadeIn(500);
        });
    }

});

$(document).on('click', '.close_features', function () {

    var thisObj = $(this);
    var count_no = $('#is_features_div > ul').length;
    var count_no_plus = parseInt(count_no) + 1;

    var count_no_minus = parseInt(count_no) - 1;
    $(thisObj).parents('ul').remove();

    if (parseInt($("#is_features_div > ul").length) > 1) {

        var html_content = "";
        html_content += "<a class='que-close-btn close_features close_features_" + count_no_minus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        $("#is_features_div > ul:last li:first").prepend(html_content);
    }

});

$(document).on('click', '.close_demo_guides', function () {

    var thisObj = $(this);
    var count_no = $('#demo_guides_div > ul').length;
    var count_no_plus = parseInt(count_no) + 1;

    var count_no_minus = parseInt(count_no) - 1;
    $(thisObj).parents('ul').remove();

    if (parseInt($("#demo_guides_div > ul").length) > 1) {

        var html_content = "";
        html_content += "<a class='que-close-btn close_demo_guides close_demo_guides_" + count_no_minus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        $("#demo_guides_div > ul:last li:first").prepend(html_content);
    }

});

function placeAllAtter() {

//    strAttrIds = [];
    $("#attrName").html('');
//    console.log(finalAttrObj, typeof finalAttrObj);
    $.each(finalAttrObj, function (i, v) {

        var is_required = v.required;

        if (v.attribute_type.name == 'text') {

            if (typeof v.attribute_name != 'undefined') {
                var htmlContent = "";
                htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                htmlContent += "<input type='text' idErr='attr_id_" + i + "' is_required='" + is_required + "' name='attr_value[]' placeholder='" + v.attribute_name + "' class='textRequired'  >";

                htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                htmlContent += "<span class='form-tag-line'></span>";
                htmlContent += "</li>";

                $('#attrName').append(htmlContent);
            }
        } else if (v.attribute_type.name == 'Email') {

            if (typeof v.attribute_name != 'undefined') {

                var htmlContent = "";
                htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                htmlContent += "<input type='text' idErr='attr_id_" + i + "' name='attr_value[]' is_required='" + is_required + "' class='emailValidation textRequired'>";

                htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                htmlContent += "<span class='form-tag-line'></span>";
                htmlContent += "</li>";

                $('#attrName').append(htmlContent);
            }
        } else if (v.attribute_type.name == 'Url') {

            if (typeof v.attribute_name != 'undefined') {
                var htmlContent = "";
                htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";
                htmlContent += "<input type='text' idErr='attr_id_" + i + "' is_required='" + is_required + "' name='attr_value[]' placeholder='http://www.example.com' class='urlValidation textRequired' >";

                htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                htmlContent += "<span class='form-tag-line'></span>";
                htmlContent += "</li>";

                $('#attrName').append(htmlContent);
            }

        } else if (v.attribute_type.name == 'textarea') {

            if (typeof v.attribute_name != 'undefined') {

                var htmlContent = "";
                htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                htmlContent += "<textarea name='attr_value[]' idErr='attr_id_" + i + "' is_required='" + is_required + "' class='textRequired ad-descrip'></textarea>";

                htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                htmlContent += "<span class='form-tag-line'></span>";
                htmlContent += "</li>";

                $('#attrName').append(htmlContent);
            }

        } else if (v.attribute_type.name == 'Color') {
            if (typeof v.attribute_name != 'undefined') {

                var htmlContent = "";
                htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                htmlContent += "<div class='input-group my-colorpicker2 colorpicker-element'>";
                htmlContent += "<input type='text' idErr='attr_id_" + i + "' is_required='" + is_required + "' name='attr_value[]' placeholder='Select Colour' class='textRequired' style='border-right: 0;border-top-right-radius: 0;border-bottom-right-radius: 0;'>";
                htmlContent += "<div class='input-group-addon' ><i style='background-color: rgb(33, 78, 82);'></i></div></div>";

                htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                htmlContent += "<span class='form-tag-line'></span>";
                htmlContent += "</li>";

                $('#attrName').append(htmlContent);

                $('.my-colorpicker2').colorpicker().on('changeColor', function (ev) {
                    $(this).val(ev.color.toHex());
                });
            }
        } else if (v.attribute_type.name == 'Radio-button') {

            if (typeof v.attribute_name != 'undefined') {
                var options = '';
                $.each(v.attribute_value_multi, function (index, opt) {
                    options += '<li><input id="radio_' + opt + '" label_name ="' + opt + '" name="attr_value_radio[' + i + '][]" class="inputCheckBox" type="radio" is_required="' + is_required + '" value="' + index + '"><label for="radio_' + opt + '">' + opt + '</label></li>';
                });

                var htmlContent = "";
                htmlContent += "<li class='divCheckBox' idErr='attr_id_" + i + "'><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name_radio' />";
                htmlContent += "<input type='hidden' value='0' name='parent_value_id_radio[]'>";
                htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id_radio' />";
                htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids_radio[]' />";

                htmlContent += "<div class='row step3row'><div class='col-sm-12'>";
                htmlContent += "<ul class='contact-surname'>";
                htmlContent += " " + options + " ";
                htmlContent += "</ul></div></div>";

                htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                htmlContent += "<span class='form-tag-line'></span>";
                htmlContent += "</li>";

                $('#attrName').append(htmlContent);
            }
        } else if (v.attribute_type.name == 'Drop-Down') {

            if (typeof v.attribute_name != 'undefined') {
                var options = '';

                $.each(v.attribute_value_multi, function (i, opt) {
                    options += '<option value="' + i + '">' + opt + '</option>';
                });

                if (parseInt(v.p_attr_id) == 0) {
                    var classForOnChange_business = 'classForOnChange_business';
                } else {
                    var classForOnChange_business = '';
                }

                var htmlContent = "";
                htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                htmlContent += "<select idErr='attr_id_" + i + "' attributeId='" + i + "' class='textRequired " + classForOnChange_business + "' is_required='" + is_required + "' name='attr_value[]' >";
                htmlContent += "<option value=''>Select One</option>" + options + "</select>";

                htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                htmlContent += "<span class='form-tag-line'></span>";
                htmlContent += "</li>";

                $('#attrName').append(htmlContent);
            }
        } else if (v.attribute_type.name == 'Multi-Select') {

            if (typeof v.attribute_name != 'undefined') {
                var options = '';
                $.each(v.attribute_value_multi, function (index, opt) {
                    options += "<li><input class='inputCheckBox custom-checkbox' label_name ='" + opt + "'  is_required='" + is_required + "' name='attr_value_multi[" + i + "][]' type='checkbox' value='" + index + "'>";
                    options += "<label class='offerchk'>" + opt + "</label></li>";
                });

                var htmlContent = "";
                htmlContent += "<li class='divCheckBox' idErr='attr_id_" + i + "'><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name_multi' />";
                htmlContent += "<input type='hidden' value='0' name='parent_value_id_multi[]'>";
                htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id_multi'  />";
                htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids_multi[]' />";
                htmlContent += "<ul class='multi_check'>" + options + "</ul>";

                htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                htmlContent += "<span class='form-tag-line'></span>";
                htmlContent += "</li>";

                $('#attrName').append(htmlContent);
            }
        } else if (v.attribute_type.name == 'Date') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {
                    var htmlContent = "";
                    htmlContent += "<li class='badge-series-row'><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                    htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                    htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                    htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                    htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                    htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                    htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                    htmlContent += "<input placeholder='From Date' idErr='attr_id_" + i + "' attribute_id='" + i + "' class='textRequired datepicker from_date rangeDate fromDate_" + i + "' dataname='" + v.attribute_name + "' is_required='" + is_required + "' type='text' value=''>";
                    htmlContent += "<input placeholder='To Date' idErr='attr_id_" + i + "' attribute_id='" + i + "' class='textRequired pull-right datepicker to_date toDate_" + i + "' is_required='" + is_required + "' type='text'>";
                    htmlContent += "<input type='hidden' name='attr_value[]' class='fronAndToDate_" + i + "'>";

                    htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                    htmlContent += "<span class='form-tag-line'></span>";
                    htmlContent += "</li>";

                    $('#attrName').append(htmlContent);

                } else {

                    var htmlContent = "";
                    htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                    htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                    htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                    htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                    htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                    htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                    htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                    htmlContent += "<input type='text' value='' idErr='attr_id_" + i + "' class='datepicker textRequired singleDate_" + i + "' is_required='" + is_required + "' name='attr_value[]' />";

                    htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                    htmlContent += "<span class='form-tag-line'></span>";
                    htmlContent += "</li>";

                    $('#attrName').append(htmlContent);
                }

                $(".datepicker").datepicker();

            }
        } else if (v.attribute_type.name == 'Time') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {

                    var htmlContent = "";
                    htmlContent += "<li class='badge-series-row'><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                    htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                    htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                    htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                    htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                    htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                    htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                    htmlContent += "<div class='input-group bootstrap-timepicker'>";
                    htmlContent += "<input placeholder='From Time' idErr='attr_id_" + i + "' attribute_id='" + i + "' class='timepicker timeRange from_time from_time_" + i + "' is_required='" + is_required + "' type='text' value='' >";
                    htmlContent += "</div>";
                    htmlContent += "<div class='input-group bootstrap-timepicker pull-right'>";
                    htmlContent += "<input placeholder='To Time' idErr='attr_id_" + i + "' attribute_id='" + i + "' class='timepicker to_time to_time_" + i + "' is_required='" + is_required + "' type='text' value=''>";
                    htmlContent += "</div>";
                    htmlContent += "<input type='hidden' name='attr_value[]' class='fromAndToTime_" + i + "'>";

                    htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                    htmlContent += "<span class='form-tag-line'></span>";
                    htmlContent += "</li>";

                    $('#attrName').append(htmlContent);

                } else {

                    var htmlContent = "";
                    htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                    htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                    htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                    htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                    htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                    htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                    htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                    htmlContent += "<div class='input-group bootstrap-timepicker'>";
                    htmlContent += "<input type='text' name='attr_value[]' idErr='attr_id_" + i + "' class='timepicker textRequired' is_required='" + is_required + "' >";
                    htmlContent += "</div>";

                    htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                    htmlContent += "<span class='form-tag-line'></span>";
                    htmlContent += "</li>";

                    $('#attrName').append(htmlContent);
                }
                $(".timepicker").timepicker({
                    //showInputs: false,
                    showSeconds: true,
                    maxHours: 24,
                    showMeridian: false,
                    // defaultTime: false,
                });
            }

        } else if (v.attribute_type.name == 'calendar') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {

                    var htmlContent = "";
                    htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                    htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                    htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                    htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                    htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                    htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                    htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                    htmlContent += "<input class='range_1' idErr='attr_id_" + i + "' type='text' dataname='" + v.attribute_name + "' is_required='" + is_required + "' name='attr_value[]' value=''>";

                    htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                    htmlContent += "<span class='form-tag-line'></span>";
                    htmlContent += "</li>";

                    $('#attrName').append(htmlContent);

                    $(".range_1").ionRangeSlider({
                        min: v.attribute_value_multi[Object.keys(v.attribute_value_multi)[0]],
                        max: v.attribute_value_multi[Object.keys(v.attribute_value_multi)[1]],
                        from: v.attribute_value_multi[Object.keys(v.attribute_value_multi)[0]],
                        to: v.attribute_value_multi[Object.keys(v.attribute_value_multi)[1]],
                        type: 'double',
                        step: 1,
                        prefix: "",
                        prettify: false,
                        hasGrid: true
                    });
                } else {

                    var htmlContent = "";
                    htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                    htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                    htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                    htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                    htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                    htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                    htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                    htmlContent += "<input type='number' idErr='attr_id_" + i + "' value='' class='textRequired singlecalendar' dataname='" + v.attribute_name + "'  is_required='" + is_required + "' name='attr_value[]' />";

                    htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                    htmlContent += "<span class='form-tag-line'></span>";
                    htmlContent += "</li>";

                    $('#attrName').append(htmlContent);
                }
            }
        } else if (v.attribute_type.name == 'Numeric') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {

                    var htmlContent = "";
                    htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                    htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                    htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                    htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                    htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                    htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                    htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                    htmlContent += "<input class='range_1' idErr='attr_id_" + i + "' type='text' name='attr_value[]' value=''>";

                    htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                    htmlContent += "<span class='form-tag-line'></span>";
                    htmlContent += "</li>";

                    $('#attrName').append(htmlContent);

                    $(".range_1").ionRangeSlider({
                        min: v.attribute_value_multi[Object.keys(v.attribute_value_multi)[0]],
                        max: v.attribute_value_multi[Object.keys(v.attribute_value_multi)[1]],
                        from: v.attribute_value_multi[Object.keys(v.attribute_value_multi)[0]],
                        to: v.attribute_value_multi[Object.keys(v.attribute_value_multi)[1]],
                        type: 'double',
                        step: 1,
                        prefix: "",
                        prettify: false,
                        hasGrid: true
                    });
                } else {

                    var htmlContent = "";
                    htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                    htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                    htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name[]' />";
                    htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                    htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                    htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id[]' />";
                    htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids[]' />";

                    htmlContent += "<input type='number' idErr='attr_id_" + i + "' value='' class='singleNumber' is_required='" + is_required + "' name='attr_value[]' />";

                    htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                    htmlContent += "<span class='form-tag-line'></span>";
                    htmlContent += "</li>";

                    $('#attrName').append(htmlContent);
                }
            }
        } else if (v.attribute_type.name == 'Video') {

            if (typeof v.attribute_name != 'undefined') {
                
                var htmlContent = "";
                htmlContent += "<li><label>" + v.attribute_name + "</label><span class='ad-detial-field-icon'>";
                htmlContent += "<img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + v.icon + "' ></span>";

                htmlContent += "<input type='hidden' value='" + v.attribute_type.name + "' name='attr_type_name_video[]' />";
                htmlContent += "<input type='hidden' value='0' name='parent_value_id[]'>";
                htmlContent += "<input type='hidden' value='0' name='parent_attribute_id[]'>";
                htmlContent += "<input type='hidden' value='" + v.attribute_type.id + "' name='attr_type_id_video[]' />";
                htmlContent += "<input type='hidden' value='" + i + "' name='attr_ids_video[]' />";
                htmlContent += "<input type='file' class='attr_value_video attr_value textRequired videotypetxt' idErr='attr_id_" + i + "' is_required='" + is_required + "' name='attr_value_video[]' />";
                htmlContent += "<p class='ad-error' id='attr_id_" + i + "_error'></p>";
                htmlContent += "<span class='form-tag-line'></span>";
                htmlContent += "</li>";

                $('#attrName').append(htmlContent);
            }
        }
    });

}


$(document).on('change', '.classForOnChange_business', function () {
    var thisObj = $(this);
    var attributeid = $(this).attr('attributeid');
    var attributeValueid = $(this).val();
    $('.childValueDiv_' + attributeid).remove();

    $.ajax({
        url: root_url + '/user/attributes/allchildattributes',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "attribute_id": attributeid,
            "attributeValueid": attributeValueid,
        },
        //dataType: "html",
        method: "POST",
        cache: true,
        success: function (response) {
            if (response.status) {


                $.each(response.attributes, function (i, valueMain) {
                    var options = '';
                    console.log(valueMain);
                    $.each(valueMain, function (index, value) {
                        options += "<option value='" + value.id + "'>" + value.attribute_value + "</option>";

                    });

//                    var html = "<div class='divAttrValue row step3row childValueDiv_" + attributeid + " form-row1'><div class='col-sm-8'><label>" + valueMain[0].display_name + "</label></div><div class='col-sm-8 '><input type='hidden' value='Drop-Down' name='attr_type_name[]'><input type='hidden' value='4' name='attr_type_id[]'><input type='hidden' value='" + valueMain[0].attribute_value_id + "' name='parent_value_id[]'><input type='hidden' value='" + attributeid + "' name='parent_attribute_id[]'><input type='hidden' value='" + valueMain[0].attribute_id + "' name='attr_ids[]'><select attributeid='56' class='attr_value form-control textRequired preselect' dataname='" + valueMain[0].display_name + "' name='attr_value[]'>" + options + "</select></div></div>";
                    var html = "<li class='childValueDiv_" + attributeid + "'><label>" + valueMain[0].display_name + "</label>";
                    html += "<span class='ad-detial-field-icon'><img src='" + root_url + "/upload_images/attributes/30px/" + i + "/" + valueMain.icon + "' ></span>";
                    html += "<input type='hidden' value='Drop-Down' name='attr_type_name[]'>";
                    html += "<input type='hidden' value='4' name='attr_type_id[]'>";
                    html += "<input type='hidden' value='" + valueMain[0].attribute_value_id + "' name='parent_value_id[]'>";
                    html += "<input type='hidden' value='" + attributeid + "' name='parent_attribute_id[]'>";
                    html += "<input type='hidden' value='" + valueMain[0].attribute_id + "' name='attr_ids[]'>";
                    html += "<select attributeid='56' class='textRequired preselect' dataname='" + valueMain[0].display_name + "' name='attr_value[]'>" + options + "</select></li>";
                    $(thisObj).parent().after(html);

                });
            }
        }
    });
});

$(document).on('click', '.showfillvalue', function ()
{


    $('.ad-error').each(function () {
        $(this).html('');
    });
    var errorStatus = false;
    var errorMessageObj = {};

    $('input[type=text]').each(function (i, v) {
        $(this).val(v.value.trim().replace(/\s\s+/g, ' '));
    });

    async.parallel([
        function (callback) {
            $('.textRequired').each(function (index, value) {
                var thisObj = $(this);
                if ((parseInt($(thisObj).attr('is_required')) == 1) && ($(thisObj).val() == '')) {
                    var idErr = $(thisObj).attr('idErr');
                    errorMessageObj[idErr] = 'This field is required.';
                    errorStatus = true;
                }
            });
            callback('', null);
        },
        function (callback) {
            if ($('.emailValidation').length) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                $('.emailValidation').each(function (index, value) {
                    var thisObj = $(this);
                    if ($(thisObj).val() != '') {
                        if (!regex.test($(thisObj).val())) {
                            var idErr = $(thisObj).attr('idErr');
                            errorMessageObj[idErr] = 'Invalid Email!';
                            errorStatus = true;
                        }
                    }
                });
            }
            callback('', null);
        },
        function (callback) {
            if ($('.urlValidation').length) {
                var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
                $('.urlValidation').each(function (index, value) {
                    var thisObj = $(this);
                    if ($(thisObj).val() != '' && !urlregex.test($(thisObj).val())) {
                        var idErr = $(thisObj).attr('idErr');
                        errorMessageObj[idErr] = 'Invalid Url!';
                        errorStatus = true;
                    }
                });
            }
            callback('', null);
        },
        function (callback) {
            if ($('.singlecalendar').length) {
                if ((typeof $('.singlecalendar').val() != 'undefined') && ($('.singlecalendar').val() != '') && (parseInt($('.singlecalendar').val().length) != 4)) {
                    var idErr = $(this).attr('idErr');
                    errorMessageObj[idErr] = 'Invalid year!';
                    errorStatus = true;
                }
            }
            callback('', null);
        },
        function (callback) {
            $('.timeRange').each(function (index, value) {
                var thisObj = $(this);
                var attrId = thisObj.attr('attribute_id');

                var fromTime = thisObj.val().replace(':', '').replace(':', '');
                var toTime = $('.to_time_' + attrId).val().replace(':', '').replace(':', '');

                if (parseInt(fromTime) >= parseInt(toTime)) {
                    var idErr = $(thisObj).attr('idErr');
                    errorMessageObj[idErr] = 'From value should not be greater or equal to To value!';
                    errorStatus = true;
                }
            });
            callback('', null);
        },
        function (callback) {
            $('.rangeDate').each(function (index, value) {

                var thisObj = $(this);
                var attrId = thisObj.attr('attribute_id');

                var fromDate = new Date($(thisObj).val());
                var toDate = new Date($('.toDate_' + attrId).val());

                if ((parseInt($(thisObj).attr('is_required')) == 1) && ((fromDate == 'Invalid Date') || (toDate == 'Invalid Date'))) {
                    var idErr = $(thisObj).attr('idErr');
                    errorMessageObj[idErr] = 'This Field is required';
                    errorStatus = true;

                } else if (fromDate > toDate) {
                    var idErr = $(thisObj).attr('idErr');
                    errorMessageObj[idErr] = 'From value should not be greater to To value';
                    errorStatus = true;
                }
            });
            callback('', null);
        },
        function (callback) {
//            if ($('.divCheckBox').length) {
            $('.divCheckBox').each(function (index, value) {

                var parentEach = $(this);
                var singleCheckBox = false;
                $('.inputCheckBox', value).each(function (i, v) {
                    var childEach = $(this);
                    if (parseInt($(childEach).attr('is_required')) == 1) {
                        if ($(this).is(':checked')) {
                            singleCheckBox = true;
                        }
                    } else {
                        singleCheckBox = true;
                    }
                });

                if (!singleCheckBox) {
                    var idErr = $(parentEach).attr('idErr');
                    errorMessageObj[idErr] = 'This field is required';
                    errorStatus = true;
                }

            });
//            }
            callback('', null);
        },
        function (callback) {
            if ($('#questions_answer_div ul').length != 0) {
                $('.ul_ans_style').each(function (index, value) {

                    var parentEach = $(this);
                    var singleCheckBox = false;
                    $('.ans_type', value).each(function (i, v) {
                        var childEach = $(this);
                        if (parseInt($(childEach).attr('is_required')) == 1) {
                            if ($(this).is(':checked')) {
                                singleCheckBox = true;
                            }
                        } else {
                            singleCheckBox = true;
                        }
                    });

                    if (!singleCheckBox) {
                        var idErr = $(parentEach).attr('idErr');
                        errorMessageObj[idErr] = 'This field is required';
                        errorStatus = true;
                    }

                });
            }
            callback('', null);
        },
    ], function (err) {
        console.log(errorMessageObj);
        if (errorStatus) {
            $.each(errorMessageObj, function (i, v) {
                $('#' + i + '_error').html(v);
            });

            $('.ad-error').each(function (i, v) {
                if ($(this).text() != '') {

                    $('html, body').animate({
                        scrollTop: $(this).parents('li:first').offset().top - 135
                    }, 1000);

                    return false;
                }
            });

        } else {

            //showing all filled dynamic attribute with values 
            showing_filed_attrValues();

//            $('.tab3').click();
            $('#select_sub_category').fadeOut(500, function () {
                $('.tab-content3').fadeIn(500);
            });
            console.log('else done')
        }

    });

});


function showing_filed_attrValues() {

    var liHtml = '';
    var liHtmlBefore = '';

    if ($('#is_sellable_attrs_ul > li').length != 0) {

        liHtmlBefore += "<li><label>Title</label>";
        liHtmlBefore += "<span>" + $('#title').val() + "</span></li>";

        if ($('.price').length != 0) {
            liHtmlBefore += "<li><label>Price</label>";
            if (typeof $('input[name=price_type]:checked').val() != 'undefined') {
                var amtHtml = $('input[name=price_type]:checked').val();
            }
            liHtmlBefore += "<span>" + $('.price').val() + "  AUD " + amtHtml + "</span></li>";
        }

        if ($('input[name=min_offer_check]').is(':checked') && $('input[name=minimum_price]').val() != '') {
            liHtmlBefore += "<li><label>Minimum Offer Price</label>";
            liHtmlBefore += "<span>" + $('input[name=minimum_price]').val() + "</span></li>";
        }

        liHtmlBefore += "<li><label>Condition</label>";
        liHtmlBefore += "<span>" + $('input[name=condition]:checked').val() + "</span></li>";

        if ($('input[name=pay_pal]').is(':checked')) {
            liHtmlBefore += "<li><label>Payment Method</label>";
            liHtmlBefore += "<span><img src='" + root_url + "/plugins/front/img/pp.png' alt='Paypal'></span></li>";
        }

        if ($('input[name=pic_n_pay]').is(':checked')) {
            liHtmlBefore += "<li class='pickup-check'><label>PICK UP N’ PAY</label>";
            liHtmlBefore += "<span>" + $('input[name=pick_address]').val() + "</span></li>";

            liHtmlBefore += "<li><label></label>";
            liHtmlBefore += "<span>" + $('input[name=pick_city]').val() + "</span></li>";

//        liHtmlBefore += "<li><label></label>";
//        liHtmlBefore += "<span>" + $('input[name=pick_country]').val() + "</span></li>";

            liHtmlBefore += "<li><label></label>";
            liHtmlBefore += "<span>" + $('input[name=pick_state]').val() + "</span></li>";

            liHtmlBefore += "<li><label></label>";
            liHtmlBefore += "<span>" + $('input[name=pick_zip]').val() + "</span></li>";
        }
        if ($('input[name=shipping]:checked').val() == 1) {
            liHtmlBefore += "<li><label>Shipping</label>";
            liHtmlBefore += "<span>" + $('input[name=ship_amount]').val() + "</span></li>";
        } else {
            liHtmlBefore += "<li><label>Shipping</label>";
            liHtmlBefore += "<span>Free</span></li>";
        }

        $('.show_before_attr_prev').html(liHtmlBefore);

    }
    $('.showDefaultDesc').html($('.default_desc').val());

    if ($('.display_images').length != 0) {
        var img_html = '';
        $('.fileuploader-item-image').each(function (index, value) {
            img_html += "<li><img src='" + $('img', value).attr('src') + "' ></li>";
        });
        $('.display_images').html(img_html.toString());
    }

    if ($('#questions_answer_div ul').length != 0) {
        var ques_html = "";
        ques_html += "<h3>Additional Questions from the Employer</h3>";
        $('#questions_answer_div > ul').each(function (index, value) {
            index++
            ques_html += "<li>";
            ques_html += "<label class='ques-lable-class'><span>Question " + index + "<span></label>";
            ques_html += "<span>" + $('.questions_input', value).val() + "</span>";

            ques_html += "<label class='ques-lable-class'><span>Answer Style</span>";
            ques_html += " " + $(".ans_type:checked", value).val() + "</label>";

            $('.answer_input li', value).each(function (i, v) {
                ques_html += "<span class='ans-span-class'>" + $('.ans_class', v).val() + "</span>";
            })
            ques_html += "</li>";
        });
        $('.job_display').html(ques_html);
    }

    $('#attrName li').each(function (index, value) {
        var thisObjLi = $(this);

        if ($("input[name='attr_type_name[]']", value).val() == 'textarea') {
            if ($("textarea[name='attr_value[]']", value).val() != '') {

                liHtml += "<li><label>" + $($(thisObjLi), value).find('label').first().text() + "</label>";
                liHtml += "<span>" + $("textarea[name='attr_value[]']", value).val() + "</span></li>";
            }

        } else if ($("input[name='attr_type_name[]']", value).val() == 'Drop-Down') {

            if ($("select[name='attr_value[]']", value).find(":selected").text() != '' && $("select[name='attr_value[]']", value).find(":selected").text() != 'Select One') {
                liHtml += "<li><label>" + $($(thisObjLi), value).find('label').first().text() + "</label>";
                liHtml += "<span>" + $("select[name='attr_value[]']", value).find(":selected").text() + "</span></li>";
            }

        } else {
            if (typeof $("input[name='attr_value[]']", value).val() != 'undefined') {
                liHtml += "<li><label>" + $($(thisObjLi), value).find('label').first().text() + "</label>";
                liHtml += "<span>" + $("input[name='attr_value[]']", value).val() + "</span></li>";
            }
        }



    });

    $('.divCheckBox').each(function (index, value) {
        if (typeof $('.inputCheckBox:checked', value).attr('label_name') != 'undefined') {
            liHtml += "<li><label>" + $($(this), value).find('label').first().text() + "</label>";
            liHtml += "<span>" + $('.inputCheckBox:checked', value).attr('label_name') + "</span></li>";
        }

    });
    $('.show_attr_prev').html(liHtml);


}

$(document).on('click', '.finalSubmitBtn', function () {

    $('.ad-error').each(function () {
        $(this).html('');
    });
    var errorStatus = false;
    var errorMessageObj = {};

//    $('input[type=text]').each(function (i, v) {
//        $(this).val(v.value.trim().replace(/\s\s+/g, ' '));
//    });
    async.parallel([
        function (callback) {
            $('.textRequired_static').each(function (index, value) {

                var thisObj = $(this);
                if ((parseInt($(thisObj).attr('is_required')) == 1) && ($(thisObj).val() == '')) {
                    var idErr = $(thisObj).attr('idErr');
                    if (['statevalue', 'subregion_id', 'pincode'].indexOf(idErr) > 0) {
                        idErr = 'location';
                        errorMessageObj[idErr] = 'Select full  address with state city and pincode.';
                    } else {
                        errorMessageObj[idErr] = 'This field is required.';
                    }
                    errorStatus = true;
                }
            });
            callback('', null);
        },
        function (callback) {
            $('.divCheckBox_static').each(function (index, value) {
                console.log(value, '1111');
                var parentEach = $(this);
                var singleCheckBox = false;
                $('.inputCheckBox_static', value).each(function (i, v) {
                    console.log(v, '222');
                    var childEach = $(this);
                    if (parseInt($(childEach).attr('is_required')) == 1) {
                        if ($(this).is(':checked')) {
                            singleCheckBox = true;
                        }
                    } else {
                        singleCheckBox = true;
                    }
                });
                if (!singleCheckBox) {
                    var idErr = $(parentEach).attr('idErr');
                    errorMessageObj[idErr] = 'This field is required';
                    errorStatus = true;
                }
            });
            callback('', null);
        },
    ], function (err) {
        console.log(errorMessageObj);
        if (errorStatus) {
            $.each(errorMessageObj, function (i, v) {
                $('#' + i + '_error').html(v);
            });

            $('.ad-error').each(function (i, v) {
                if ($(this).text() != '') {

                    $('html, body').animate({
                        scrollTop: $(this).parent('li').offset().top - 135
                    }, 1000);

                    return false;
                }
            });

        } else {
            $("#submitFrm").submit();
            console.log('else done')
        }
    });


});

function myMap() {
    if ($('#map').length != 0) {
        $('#map').css('height', '300px')
        var msq_latitude = $('#lat').val();
        var msq_logtitude = $('#lng').val();

        var latlng = new google.maps.LatLng(msq_latitude, msq_logtitude);
        var myOptions = {
            zoom: 15,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), myOptions);
        var marker = new google.maps.Marker({position: latlng});
        marker.setMap(map);
    }
}

$(document).on('click', '.inner_tab2', function () {
    myMap();
});

$("#submitFrm").submit(function (event) {
    event.preventDefault();
    var thisObj = $(this);

//    var body = $("html, body");
//    body.stop().animate({scrollTop: 0}, 500, 'swing', function () {
//        
//    });
//    $('.tab-content4').html("<div class='container'><div class='row'><div class='col-sm-12'><div class='ad-category-box'><div id='loading-overlay'><i class='fa fa-spinner fa-spin spin-big'></i></div></div></div></div></div>");

    $.ajax({
        url: $(thisObj).attr('action'),
        type: "POST", // Type of request to be send, called as method
        //data: formData,
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        //data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        success: function (data)   // A function to be called if request succeeds
        {

            if (data.status) {
                $.ajax({
                    url: root_url + '/user/classifieds/preview_detail_post',
                    method: "POST", // Type of request to be send, called as method
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        'id': data.id,
                    },
                    cache: false,
                    success: function (response)
                    {
//                        $('.tab4').click();
                        $('#post_classified').fadeOut(500, function () {
                            $('.tab-content4').fadeIn(500);
                        });
                        $('.detail_prev').html(response);


                        setTimeout(function () {
                            myMap();
                            intializeSlider();
                            console.log('after 3 second');
                        }, 3000);
                    }
                });

            } else {
                console.log('status false');
                console.log(data.data);
//                $.each(data.data, function (index, value) {
//                    if (value.fields == 'attr_value_video') {
//
//                        $('.attr_value_video').each(function (i, v) {
//                            if (i == value.keys) {
//                                var videoClassInput = $(this);
//                                $(videoClassInput).after("<p class='error-message errorMsg '>" + value.message + "</p>");
//                            }
//                        });
//                    }
//                });
            }
        },
        error: function (data) {
            var dataObj = JSON.parse(data.responseText);
            console.log('error ajax');
            $.each(dataObj, function (i, v) {
                $('#' + i + '_error').html(v);
            });

            $('.ad-error').each(function (i, v) {
                if ($(this).text() != '') {

                    $('html, body').animate({
                        scrollTop: $(this).parent('li').offset().top - 135
                    }, 1000);

                    return false;
                }
            });
        }
    });

});


$(document).on('click', '.finalSubmitAfterPrev', function () {
    $.ajax({
        url: root_url + '/user/classifieds/final_submit_post',
        method: "POST", // Type of request to be send, called as method
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            'id': $('.class_id').val(),
        },
        cache: false,
        success: function (response)
        {
            window.location.href = root_url + response.url;
        }
    });
});


function intializeSlider() {

    /*Slick Slider for Real Estate Detail page*/
    $('.real-slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.real-slider-nav'
    });
    $('.real-slider-nav').slick({
        slidesToShow: 8,
        vertical: true,
        slidesToScroll: 1,
        dots: false,
        focusOnSelect: true,

        responsive: [
            {
                breakpoint: 768,
                settings: {
                    vertical: false,
                    arrows: false,
                    slidesToShow: 3
                }
            }
        ]
    });

    /*Slick Slider for Automotive Detail page*/
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.slider-nav',
        infinite: false,
    });
    $('.slider-nav').slick({
        slidesToShow: 5,
        vertical: true,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        focusOnSelect: true,
        infinite: false,

        responsive: [
            {
                breakpoint: 768,
                settings: {
                    vertical: false,
                    arrows: false,
                    slidesToShow: 3
                }
            }
        ]
    });

    /*Slick Slider for Is sellable category Detail page*/
    $('.home-slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        arrows: false,
        asNavFor: '.home-slider-nav'
    });
    $('.home-slider-nav').slick({
        slidesToShow: 5,
        infinite: false,
        slidesToScroll: 1,
        asNavFor: '.home-slider-for',
        dots: false,
        arrows: false,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 3
                }
            }
        ]
    });

    $('.ad-sm-thumb .slick-list').css('height', '300px');
}

$(document).on('change', '.from_date', function () {
    var attrID = $(this).attr('attribute_id');

    var from_date_1 = $('.fromDate_' + attrID).val();
    var to_date_1 = $('.toDate_' + attrID).val();

    var dateCombine = from_date_1 + ';' + to_date_1;
    $('.fronAndToDate_' + attrID).val(dateCombine);
});

$(document).on('change', '.to_date', function () {
    var attrID = $(this).attr('attribute_id');

    var from_date_1 = $('.fromDate_' + attrID).val();
    var to_date_1 = $('.toDate_' + attrID).val();

    var dateCombine = from_date_1 + ';' + to_date_1;
    $('.fronAndToDate_' + attrID).val(dateCombine);
});

$(document).on('change', '.timepicker', function () {

    var attrID = $(this).attr('attribute_id');


    var from_time = $('.from_time_' + attrID).val();
    var to_time = $('.to_time_' + attrID).val();

    var timeCombine = from_time + ';' + to_time;

    $('.fromAndToTime_' + attrID).val(timeCombine);
}
);

$(document).on('click', '.back_content2', function () {

    $('#select_sub_category').fadeOut(500, function () {
        $('.tab-content1').fadeIn(500);
    });
});

$(document).on('click', '.back_content3', function () {

    $('#post_classified').fadeOut(500, function () {
        $('.tab-content2').fadeIn(500);
    });
});


$(document).on('click', '.paypal_check', function () {

    var thisObj = $(this);
    if ($(thisObj).is(':checked')) {

        $('.pic_n_pay_check').attr('checked', false);
        $('.pic_n_pay_div').hide();
    }
});

$(document).on('click', '.pic_n_pay_check', function () {

    var thisObj = $(this);
    if ($(thisObj).is(':checked')) {

        $('.paypal_check').attr('checked', false);
        $('.pic_n_pay_div').show();
    } else {
        $('.pic_n_pay_div').hide();
    }

});