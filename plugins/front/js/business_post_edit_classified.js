$(document).on('click', '.add_more_features', function () {
    var thisObj = $(this);
    var count_no = $('#is_features_div > ul').length;
    var count_no_plus = parseInt(count_no) + 1;

    if (count_no != 0 && count_no < 10) {

        $('.close_features_' + count_no).remove();

        var html_content_features = "";
        html_content_features = "<ul class='edit_featured_div' >";

        html_content_features += "<li class='no-ad-padding'><a class='que-close-btn close_features close_features_" + count_no_plus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        html_content_features += "<label>Title</label>";
        html_content_features += "<input is_required='0' idErr='title_" + count_no_plus + "' name='other_value[is_features][" + count_no_plus + "][title]' class='form-control features_title_input textRequired_static' type='text' placeholder='Please type your title here' >";
        html_content_features += "<p class='ad-error' id='title_" + count_no_plus + "_error'></p>";
        html_content_features += "</li>";

        html_content_features += "<li class='no-ad-padding'>";
        html_content_features += "<label>Feature Image</label>";
        html_content_features += "<input is_required='0' idErr='is_feature_img_" + count_no_plus + "' name='other_value[is_features][" + count_no_plus + "][image]' class='form-control is_feature_img textRequired_static' type='file' >";
        html_content_features += "<p class='ad-error' id='is_feature_img_" + count_no_plus + "_error'></p>";
        html_content_features += "</li>";

        html_content_features += "<li class='no-ad-padding'>";
        html_content_features += "<label>Description</label>";
        html_content_features += "<textarea is_required='0' idErr='is_feature_desc_" + count_no_plus + "' cols='68' rows='5' name='other_value[is_features][" + count_no_plus + "][desc]' class='form-control is_feature_desc textRequired_static' ></textarea>";
        html_content_features += "<p class='ad-error' id='is_feature_desc_" + count_no_plus + "_error'></p>";
        html_content_features += "</li></ul>";

        $('#is_features_div').fadeOut(500, function () {
            $(this).append(html_content_features).fadeIn(500);
        });
    }

});

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

$(document).on('change', '.edit_demo_guides_content_type', function () {

    var thisObj = $(this);
    var thisUlObj = $(this).parents('.edit_others_div_border');

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

$(document).on('click', '.add_more_demo_guides', function () {
    var thisObj = $(this);
    var count_no = $('#demo_guides_div > ul').length;
    var count_no_plus = parseInt(count_no) + 1;

    if (count_no != 0 && count_no < 10) {

        $('.demo_guides_' + count_no).remove();

        var html_content_demo_guides = "";
        html_content_demo_guides = "<ul class='edit_featured_div' >";

        html_content_demo_guides += "<li class='no-ad-padding'><a class='que-close-btn close_demo_guides demo_guides_" + count_no_plus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        html_content_demo_guides += "<label>Title</label>";
        html_content_demo_guides += "<input is_required='0' idErr='demo_guides_title_" + count_no_plus + "' name='other_value[demo_guides][" + count_no_plus + "][title]' class='form-control demo_guides_title_input textRequired_static' type='text' placeholder='Please type your title here' >";
        html_content_demo_guides += "<p class='ad-error' id='demo_guides_title_" + count_no_plus + "_error'></p>";
        html_content_demo_guides += "</li>";

        html_content_demo_guides += "<li class='no-ad-padding'>";
        html_content_demo_guides += "<label>Content Type</label>";
        html_content_demo_guides += "<select is_required='0' idErr='demo_guides_content_type_" + count_no_plus + "' name='other_value[demo_guides][" + count_no_plus + "][content_type]' class='form-control demo_guides_content_type textRequired_static' >";
        html_content_demo_guides += "<option value=''>--Select--</option>";
        html_content_demo_guides += "<option value='image'>Image</option>";
        html_content_demo_guides += "<option value='url'>Url</option>";
        html_content_demo_guides += "</select>";
        html_content_demo_guides += "<p class='ad-error' id='demo_guides_content_type_" + count_no_plus + "_error'></p>";
        html_content_demo_guides += "</li>";

        html_content_demo_guides += "<li class='no-ad-padding demo_guides_image_li' style='display:none;'>";
        html_content_demo_guides += "<label>Image</label>";
        html_content_demo_guides += "<input is_required='0' idErr='demo_guides_img_" + count_no_plus + "' name='other_value[demo_guides][" + count_no_plus + "][image]' class='form-control demo_guides_img textRequired_static' type='file' >";
        html_content_demo_guides += "<p class='ad-error' id='demo_guides_img_" + count_no_plus + "_error'></p>";
        html_content_demo_guides += "</li>";

        html_content_demo_guides += "<li class='no-ad-padding demo_guides_url_li' style='display:none;'>";
        html_content_demo_guides += "<label>Url</label>";
        html_content_demo_guides += "<input is_required='0' idErr='demo_guides_url_" + count_no_plus + "' name='other_value[demo_guides][" + count_no_plus + "][url]' class='form-control demo_guides_url textRequired_static' type='text' >";
        html_content_demo_guides += "<p class='ad-error' id='demo_guides_url_" + count_no_plus + "_error'></p>";
        html_content_demo_guides += "</li>";

        html_content_demo_guides += "<li class='no-ad-padding'>";
        html_content_demo_guides += "<label>Description</label>";
        html_content_demo_guides += "<textarea is_required='0' idErr='demo_guides_desc_" + count_no_plus + "' cols='68' rows='5' name='other_value[demo_guides][" + count_no_plus + "][desc]' class='form-control demo_guides_desc textRequired_static' ></textarea>";
        html_content_demo_guides += "<p class='ad-error' id='demo_guides_desc_" + count_no_plus + "_error'></p>";
        html_content_demo_guides += "</li></ul>";

        $('#demo_guides_div').fadeOut(500, function () {
            $(this).append(html_content_demo_guides).fadeIn(500);
        });
    }

});

$(document).on('click', '.min_price_check', function () {

    var thisObj = $(this);
    if ($(thisObj).is(':checked')) {

        $('.min_price_li').show();
    } else {
        $('.min_price_li').hide();
    }
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

$(document).on('change', '.shipping_check', function () {

    var thisObj = $(this);
    if ($(thisObj).val() == 1) {
        $('.shipping_amount_div').show();
    } else {
        $('.shipping_amount_div').hide();
    }
});


$("#submitFrmUpdate").submit(function (event) {

    event.preventDefault();
    var stepFirstRequired = true;
    $('.errorMsg').each(function () {
        $(this).remove();
    });

    $.ajax({
        url: root_url + '/user/classifieds/update_business_post',
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        success: function (data)   // A function to be called if request succeeds
        {

            if (data.status) {
                window.location.href = root_url + '/user/classifieds';
//                                                                    Notify.showNotification('submitted Successfully.', 'done');
            }
            console.log('Suc', data);
        },
        error: function (data) {

            var dataObj = JSON.parse(data.responseText);
            $('.errorMsg').each(function () {
                $(this).remove();
            });
//                                        dataObj["attrName"] = Array();

            $.each(dataObj, function (index, value) {

                var res = index.split(".");

            });
            $.each(dataObj, function (index, value) {

                if (index == 'image.0') {
                    index = 'classifiedInputFile'
                    value = "Image required minimum 3 MB."
                }
                if (index == 'description') {
                    index = 'editor1'
                }
                if (index == 'start_date') {
                    index = 'start_date1'
                }
                if (index == 'end_date') {
                    index = 'end_date1'
                }
                Notify.showMessageOld(index, value);
            });
        }
    });
});

var count = 1;
function add_more(str) {
    
    var uploaded_img = parseInt($('.more-images > div').length) + parseInt($('.advertisement_image img').length);
    var max_upload_img = parseInt($('.max_upload_img').val());
    if(uploaded_img >= max_upload_img){
        Notify.showNotification('You can only upload maximum '+max_upload_img+' images.');
        return false;
    }
    
    var html = '<div style="margin: 5px 0 5px 0;" id="image_' + count + '"><div class="img_id_' + count + '">';
    html += '<div class="file-label"><input type="file" onchange="" id="img_id_' + count + '" value="" class="addedInput blue image_field textRequired" name="image[' + count + ']"></div>';
    html += '<a href="javascript:void(0)" onclick="remove_image(' + count + ')" class="remove-img">X</a></div>';
    jQuery('#more_images').append(html);
    count++;
}
function remove_image(strrm) {
    if (count > 1) {
        jQuery('#image_' + strrm + '').remove();
        count--;
    }
}

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

$(document).on('click', '.add_more_ques', function () {
    var thisObj = $(this);
//    var ques_no = $(thisObj).attr('ques_no');
    var ques_no = $('#questions_answer_div > ul').length;
    var ques_no_plus = parseInt(ques_no) + 1;
    console.log(ques_no);

    if (ques_no != 0 && ques_no < 5) {

        $('.close_ques_' + ques_no).remove();

        var html_content = "";
        html_content = "<ul class='ad-detail-form-sec edit_featured_div' >";

        html_content += "<li class='no-ad-padding buss-no-padd'><a class='que-close-btn close_ques close_ques_" + ques_no_plus + "' href='javascript:void(0);'><i class='fa fa-close'></i></a>";
        html_content += "<div class='col-sm-4'><label>Question " + ques_no_plus + "</label></div>";
        html_content += "<div class='col-sm-8'><input is_required='1' iderr='question_" + ques_no_plus + "' name='questions[" + ques_no_plus + "][question]' class='questions_input textRequired' type='text' placeholder='Please type your question here' >";
        html_content += "<p class='ad-error' id='question_" + ques_no_plus + "_error'></p>";
        html_content += "</div></li>";

        html_content += "<li class='no-ad-padding buss-no-padd'>";
        html_content += "";

        html_content += "<div class='row step3row'><div class='col-sm-12'><div class='col-sm-4'><label class='ans_style11'>Answer Style:</label></div>";
        html_content += "<div class='col-sm-8'><ul class='contact-surname ul_ans_style' iderr='ans_style_" + ques_no_plus + "'>";
        html_content += "<li><input is_required='1'  ques_no='" + ques_no_plus + "' id='ans_type_dropdown_" + ques_no_plus + "' class='ans_type' value='dropdown' radio_lable='dropdown' name='questions[" + ques_no_plus + "][ans_type]' type='radio' ><label for='ans_type_dropdown_" + ques_no_plus + "'>Dropdown</label></li>";
        html_content += "<li><input is_required='1'  ques_no='" + ques_no_plus + "' id='ans_type_radio_" + ques_no_plus + "' class='ans_type' value='radio' radio_lable='radio'  name='questions[" + ques_no_plus + "][ans_type]' type='radio' ><label for='ans_type_radio_" + ques_no_plus + "'>Radio Button</label></li>";
        html_content += "<li><input is_required='1'  ques_no='" + ques_no_plus + "' id='ans_type_text_" + ques_no_plus + "' class='ans_type' value='text' radio_lable='text'  name='questions[" + ques_no_plus + "][ans_type]' type='radio' ><label for='ans_type_text_" + ques_no_plus + "'>Textbox</label></li>";
        html_content += "</ul></div></div></div>";

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

$(document).on('click', '.edit_qes_ans_close', function () {

    var result = confirm("Are you sure, you want to delete this?");
    if (!result) {
        return false;
    }

    var thisobj = $(this);
    var ques_id = $(thisobj).attr('ques_id');

    $(thisobj).parents('.edit_qes_ans_div_border').slideUp(600, function () {
        $(this).remove();
    });

    $.ajax({
        url: root_url + '/user/classifieds/delete_questions',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            ques_id: ques_id,
        },
        method: "POST",
        cache: false,
        success: function (response) {
            console.log(response);
        }
    });

});


$(document).on('click', '.edit_others_close', function () {

    var result = confirm("Are you sure, you want to delete this?");
    if (!result) {
        return false;
    }

    var thisobj = $(this);
    var others_id = $(thisobj).attr('others_id');

    $(thisobj).parents('.edit_others_div_border').slideUp(600, function () {
        $(this).remove();
    });

    $.ajax({
        url: root_url + '/user/classifieds/delete_others',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            others_id: others_id,
        },
        method: "POST",
        cache: false,
        success: function (response) {
            console.log(response);
        }
    });

});

