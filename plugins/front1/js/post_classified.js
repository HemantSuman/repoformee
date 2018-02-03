$(function () {
    var allAttrsParent = [];
    var allAttrsChild = [];
    var finalAttrObj = {};
});

$('#rootwizard').bootstrapWizard(
        {
            onShow: function (activeTab, navigation, currentIndex, clickedIndex) {
                $('.navbar').show(1000);
            },
            onTabClick: function (activeTab, navigation, currentIndex, clickedIndex) {
            },
            onNext: function (tab, navigation, index) {
            },
            onTabShow: function (tab, navigation, index) {
                if ((index == 1) && $('.parent_categoryid').val() == '') {
                    $('.tab1').click();
                    return false;
                } else if ((index == 2) && $('.category_id').val() == '') {
                    $('.tab2').click();
                    return false;
                } else {
                    var $total = navigation.find('li').length - 1;
                    var $current = index;
                    var $percent = ($current / $total) * 100;
                    $('#rootwizard .progress-bar').css({width: $percent + '%'});
                }
            }
        });

$(document).on('click', '.parent_cat', function () {

    var categoryId = $(this).attr('categoryId');
    $('.parent_categoryid').val(categoryId);
    $('.category_id').val('');
    $('.pCatName').text($(this).find('.name').text());
    $('.cCatName').text('');

    $('.parentCatSelected').each(function (index, value) {
        $(this).removeClass('parentCatSelected');
    });
    $(this).parent().parent().addClass('parentCatSelected');
    $('.childCatSelected').each(function (index, value) {
        $(this).removeClass('childCatSelected');
    });

    //Ajax for sub category list
    $.ajax({
        url: root_url + '/user/categories/allcategoriesfront',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": categoryId,
        },
        //dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            if (response.status) {

                if (response.categories != '') {
                    $("#sub-categories").html('');
                    $.each(response.categories, function (index, value) {
                        var html_subCat = "<div class='col-md-3 col-sm-4'><div class='categories-inner'><div class='detail'><a categoryid='" + value.id + "' class='child_cat' href='javascript:void(0)'><span class='icon'><img src='" + root_url + "/upload_images/categories/icon/" + value.id + "/" + value.icon + "' alt='category-icon'></span><span class='name'>" + value.name + "</span></a></div><div class='overlay overlay-green'><img src='" + root_url + "/upload_images/categories/backgroundimage/" + value.id + "/" + value.image + "' alt='overlay-img'></div></div></div>";
                        $("#sub-categories").append(html_subCat);
                    });
                } else {
                    $('.category_id').val(0);
                    $("#sub-categories").html('<strong class="text-center" style="display: block;">Sub categories not listed.</strong>');
                    $('.tab3').click();
                }

                if (response.categories == '') {
                    var forShowAttr = true;
                } else {
                    var forShowAttr = false;
                }

                attributeListing(categoryId, 'forCat', forShowAttr);

            }
        }

    });

//    attributeListing(categoryId, 'forCat');
    $('.tab2').click();

    $.each(showStaticAttributes[0], function (index, val) {
        console.log(categoryId);
        if (index == categoryId) {

            if (val) {
                $('.sttcAttrbts').removeClass("hide");
            } else {
                $('.sttcAttrbts').addClass("hide");
            }
        }
    });
});


$(document).on('click', '.child_cat', function () {

    var categoryId = $(this).attr('categoryId');
    $('.category_id').val(categoryId);
    $('.childCatSelected').each(function (index, value) {
        $(this).removeClass('childCatSelected');
    });
    $(this).parent().parent().addClass('childCatSelected');

    $('.cCatName').text('/' + $(this).find('.name').text());

    attributeListing(categoryId, 'forSubCat', true);
    $('.tab3').click();

    $.each(showStaticAttributes[0], function (index, val) {
        //alert('here');
        console.log(categoryId);
        if (index == categoryId) {

            if (val) {
                $('.sttcAttrbts').removeClass("hide");
            } else {
                $('.sttcAttrbts').addClass("hide");
            }
        }
    });
});

function attributeListing(cat_id, catType, forShowAttr) {

    $.ajax({
        url: root_url + '/user/attributes/allattributes',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": cat_id,
        },
        method: "GET",
        cache: false,
        success: function (response) {

            if (response.status) {
                if (catType == 'forCat') {
                    finalAttrObj = allAttrsParent = response.attributes;
                } else if (catType == 'forSubCat') {

                    if ($.isEmptyObject(response.attributes)) {
                        allAttrsChild = {};
                    } else {
                        allAttrsChild = response.attributes;
                    }

                    if (typeof allAttrsParent != 'undefined') {
                        finalAttrObj = $.extend(allAttrsChild, allAttrsParent);

                    } else {
                        finalAttrObj = allAttrsChild;
                    }
//                    placeAllAtter();
                }
                $("#attrName").html('');
                if (forShowAttr) {
                    placeAllAtter();
                }

            }
        }

    });

}

function placeAllAtter() {

//    strAttrIds = [];
    $("#attrName").html('');
//    console.log(finalAttrObj, typeof finalAttrObj);
    $.each(finalAttrObj, function (i, v) {

        var is_required = v.required;

        if (v.attribute_type.name == 'text') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="attr_value form-control textRequired" is_required="' + is_required + '" name="attr_value[]" /></div></div></div>');
            }
        }

        if (v.attribute_type.name == 'Email') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="attr_value form-control textRequired emailValidation" is_required="' + is_required + '" name="attr_value[]" /></div></div></div>');
            }
        }

        if (v.attribute_type.name == 'Url') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="attr_value form-control textRequired urlValidation" is_required="' + is_required + '" placeholder="http://www.example.com" name="attr_value[]" /></div></div></div>');
            }
        }

        if (v.attribute_type.name == 'Number') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="number"  value="" class="attr_value form-control textRequired" is_required="' + is_required + '" name="attr_value[]" /></div></div></div>');
            }
        }


        if (v.attribute_type.name == 'Drop-Down') {

            if (typeof v.attribute_name != 'undefined') {
                var options = '';

                $.each(v.attribute_value_multi, function (i, opt) {
                    options += '<option value="' + i + '">' + opt + '</option>';
                });

                if (parseInt(v.p_attr_id) == 0) {
                    var classForOnChange = 'classForOnChange';
                } else {
                    var classForOnChange = '';
                }

                $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><select attributeId="' + i + '" class="attr_value textRequired ' + classForOnChange + '" is_required="' + is_required + '" name="attr_value[]" ><option value="">Select One</option>' + options + '</select></div></div></div>');
            }
        }

        if (v.attribute_type.name == 'Numeric') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input class="range_1" type="text" name="attr_value[]" value=""></div></div></div>');
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
                    $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="number"    value="" class="attr_value form-control singleNumber" is_required="' + is_required + '" name="attr_value[]" /></div></div></div>');
                }
            }
        }

        if (v.attribute_type.name == 'calendar') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input class="range_1" type="text" is_required="' + is_required + '" name="attr_value[]" value=""></div></div></div>');
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
                    $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="number" onkeypress="return isNumberKey(event)" value="" class="attr_value form-control singlecalendar" is_required="' + is_required + '" name="attr_value[]" /></div></div></div>');
                }
            }
        }

        if (v.attribute_type.name == 'Date') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input placeholder="From Date" attribute_id="' + i + '" class="datepicker from_date rangeDate fromDate_' + i + '" is_required="' + is_required + '" type="text" value="" style="margin-right:8px;"><input placeholder="To Date" attribute_id="' + i + '" class="datepicker to_date toDate_' + i + '" is_required="' + is_required + '" type="text" value=""><input type="hidden" name="attr_value[]" class="fronAndToDate_' + i + '"></div></div></div>');
                } else {
                    $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="datepicker textRequired attr_value form-control singleDate_' + i + '" is_required="' + is_required + '" name="attr_value[]" /></div></div></div>');
                }

            }
        }

        if (v.attribute_type.name == 'Time') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group bootstrap-timepicker" style="width: 24%;"><input placeholder="From Time" attribute_id="' + i + '" class="timepicker timeRange form-control from_time_' + i + '" is_required="' + is_required + '" textRequired" type="text" value="" style=""><div class="input-group-addon" style="width: 21%;"><i class="fa fa-clock-o"></i></div></div></br><div class="input-group bootstrap-timepicker" style="width: 24%;"><input placeholder="To Time" attribute_id="' + i + '" class="timepicker form-control to_time_' + i + '" is_required="' + is_required + '" type="text" value=""><div class="input-group-addon" style="width: 21%;"><i class="fa fa-clock-o"></i></div></div><input type="hidden" name="attr_value[]" class="fromAndToTime_' + i + '"></div></div></div>');
                } else {
                    $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group bootstrap-timepicker" style="width: 24%;"><input type="text" name="attr_value[]" class="timepicker attr_value form-control textRequired" is_required="' + is_required + '" ><div class="input-group-addon" style="width: 21%;"><i class="fa fa-clock-o"></i></div></div></div></div></div>');
                    //$('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="datepicker attr_value form-control" name="attr_value[]" /></div></div>');
                }
                $(".timepicker").timepicker({
                    showInputs: false,
                    showSeconds: true,
                    maxHours: 24,
                    showMeridian: false,
                    defaultTime: false,
                });
            }

        }

        if (v.attribute_type.name == 'Radio-button') {

            if (typeof v.attribute_name != 'undefined') {
                var options = '';
                $.each(v.attribute_value_multi, function (index, opt) {
                    options += '<input name="attr_value_radio[' + i + '][]" class="inputCheckBox custom-radio" type="radio" is_required="' + is_required + '" value="' + index + '"><label>' + opt + '</label>';
                });
                $('#attrName').append('<div  class="divAttrValue  form-row divCheckBox"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field no-input-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_radio" /><input type="hidden" value="0" name="parent_value_id_radio[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_radio" /><input type="hidden" value="' + i + '" name="attr_ids_radio[]" />' + options + '</div></div></div>');
            }
        }

        if (v.attribute_type.name == 'Multi-Select') {

            if (typeof v.attribute_name != 'undefined') {
                var options = '';
                $.each(v.attribute_value_multi, function (index, opt) {
                    options += '<input class="inputCheckBox custom-checkbox" is_required="' + is_required + '" name="attr_value_multi[' + i + '][]" type="checkbox" value="' + index + '"><label>' + opt + '</label>';
                });

                $('#attrName').append('<div class="divAttrValue  form-row divCheckBox"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field no-input-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_multi" /><input type="hidden" value="0" name="parent_value_id_multi[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_multi" /><input type="hidden" value="' + i + '" name="attr_ids_multi[]" />' + options + '</div></div></div>');
            }
        }



        if (v.attribute_type.name == 'textarea') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><textarea class="attr_value form-control textRequired" is_required="' + is_required + '" name="attr_value[]" ></textarea></div></div></div>');
            }
        }


        if (v.attribute_type.name == 'Color') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group my-colorpicker2 colorpicker-element textRequired" is_required="' + is_required + '" style="width: 24%;"><input type="text" name="attr_value[]" placeholder="Select Colour" class="attr_value form-control" ><div class="input-group-addon" style="width: 21%;"><i></i></div></div></div></div></div>');
                $('.my-colorpicker2').colorpicker().on('changeColor', function (ev) {
                    $(this).val(ev.color.toHex());
                });
            }
        }


        if (v.attribute_type.name == 'File') {

            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_file[]" /><input type="hidden" value="0" name="parent_value_id_file[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_file[]" /><input type="hidden" value="' + i + '" name="attr_ids_file[]" /><input type="file" value="" class="attr_value textRequired" style="" name="attr_value_file[]" /></div></div></div>');
            }
        }

        if (v.attribute_type.name == 'Video') {

            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_video[]" /><input type="hidden" value="0" name="parent_value_id_video[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_video[]" /><input type="hidden" value="' + i + '" name="attr_ids_video[]" /><input type="file" value="" class="attr_value textRequired videotypetxt attr_value_video" style="" name="attr_value_video[]" /></div></div></div>');
            }
        }

        if (v.attribute_type.name == 'Image-Gallery') {

            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_image" /><input type="hidden" value="0" name="parent_value_id_image[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_image" /><input type="hidden" value="' + i + '" name="attr_ids_image[]" /><div class="input_repeat" style="margin-top: 5px;"><div class="file-input"><input type="file" value="" class="attr_value textRequired image_field cloneId_' + i + '" is_required="' + is_required + '" style="margin-bottom:5px;" name="attr_value_image[' + i + '][]" /><span class="custom-label">Browse..</span></div></div><span class="btn btn-default"><a forCloneLink="' + i + '" href="javascript:void(0)" onclick="add_imageGallery(this)">Add more image</a></span></div></div></div>');
            }
        }


    });

}

$('body').on('focus', ".datepicker", function () {
    $(this).datepicker();
});


$("#submitFrm").submit(function (event) {

    event.preventDefault();
    var stepFirstRequired = true;

    $('.errorMsg').each(function () {
        $(this).remove();
    });


    $('.textRequired').each(function (index, value) {

        if ((parseInt($(this).attr('is_required')) == 1) && ($(this).val() == '')) {
            stepFirstRequired = false;
            $($(this)).after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
//                                                Notify.showMessageForClass(index, 'value');
        }
    });
    $('.timeRange').each(function (index, value) {
        var thisObj = $(this);
        var attrId = thisObj.attr('attribute_id');

        var fromTime = thisObj.val().replace(':', '').replace(':', '');
        var toTime = $('.to_time_' + attrId).val().replace(':', '').replace(':', '');

        if ((thisObj.val() == '') && (parseInt($(thisObj).attr('is_required')) == 1)) {
            stepFirstRequired = false;
            $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
        } else if (($('.to_time_' + attrId).val() == '') && (parseInt($(thisObj).attr('is_required')) == 1)) {
            stepFirstRequired = false;
            $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
        } else if ((thisObj.val() != '') && ($('.to_time_' + attrId).val() == '')) {
            stepFirstRequired = false;
            $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
        } else if ((thisObj.val() == '') && ($('.to_time_' + attrId).val() != '')) {
            stepFirstRequired = false;
            $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
        } else if (parseInt(fromTime) >= parseInt(toTime)) {
            stepFirstRequired = false;
            $($(this)).parent().after("<p class='error-message errorMsg '>" + 'From value should not be greater or equal to To value' + "</p>");
        }
    });
    $('.rangeDate').each(function (index, value) {

        var thisObj = $(this);
        var attrId = thisObj.attr('attribute_id');

        var fromDate = new Date($(thisObj).val());
        var toDate = new Date($('.toDate_' + attrId).val());

        if ((fromDate == 'Invalid Date') && (parseInt($(thisObj).attr('is_required')) == 1)) {

            stepFirstRequired = false;
            $(thisObj).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
        } else if ((toDate == 'Invalid Date') && (parseInt($(thisObj).attr('is_required')) == 1)) {

            stepFirstRequired = false;
            $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
        } else if ((fromDate != 'Invalid Date') && (toDate == 'Invalid Date')) {

            stepFirstRequired = false;
            $(thisObj).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
        } else if ((toDate != 'Invalid Date') && (fromDate == 'Invalid Date')) {

            stepFirstRequired = false;
            $(thisObj).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
        } else if ((fromDate != 'Invalid Date') && (toDate != 'Invalid Date') && (fromDate > toDate)) {

            stepFirstRequired = false;
            $(thisObj).parent().after("<p class='error-message errorMsg '>" + 'From value should not be greater or equal to To value' + "</p>");
        }
    });
    $('.singleNumber').each(function (index, value) {
        if ((parseInt($(this).attr('is_required')) == 1) && ($(this).val() == '') || ($(this).val() < 0)) {
            $($(this)).after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
            stepFirstRequired = false;
            return false;
        }

    });

//    $('.singleNumbernumeric').each(function (index, value) {
//        if (($(this).val() < 0) || ($(this).val().length < 10)) {
//            $($(this)).after("<p class='error-message errorMsg '>" + 'The mobile no must be at least 10 characters.' + "</p>");
//            stepFirstRequired = false;
//            return false;
//        }
//
//    });
    $('.singleNumbernumeric').each(function (index, value) {

        if (($(this).val() != '') && (($(this).val() < 0) || ($(this).val().length < 10))) {
            $($(this)).after("<p class='error-message errorMsg '>" + 'The mobile no must be at least 10 characters.' + "</p>");
            stepFirstRequired = false;
            return false;
        }

    });
    if ((typeof $('.singlecalendar').val() != 'undefined') && (parseInt($('.singlecalendar').attr('is_required')) == 1) && ($('.singlecalendar').val() == '')) {
        $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
        return false;
    } else if ((typeof $('.singlecalendar').val() != 'undefined') && ($('.singlecalendar').val() != '') && (parseInt($('.singlecalendar').val().length) != 4)) {
        //($('.singlecalendar').val() != '')
        $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'Invalid year' + "</p>");
        return false;
    }
//    if ((parseInt($('.singlecalendar').attr('is_required')) == 1) && ($('.singlecalendar').val() == '')) {
//        $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
//        return false;
//    } else if (($('.singlecalendar').val().length != 0) && (parseInt($('.singlecalendar').val().length) != 4)) {
//
//        $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'Invalid year' + "</p>");
//        return false;
//    }

    if (stepFirstRequired) {
        var stepSecondRequired = true;
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
                stepSecondRequired = false;
                $(parentEach).find('.value-field').append("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
            }

        });

    } else {
        stepSecondRequired = false;
    }

    if (stepSecondRequired) {
        stepthirdRequired = true;

        if ($('.emailValidation').length) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            $('.emailValidation').each(function (index, value) {
                if ($(this).val() != '') {
                    if (!regex.test($(this).val())) {
                        stepthirdRequired = false;
                        $($(this)).after("<p class='error-message errorMsg '>" + 'Invalid Email!' + "</p>");
                    }
                }
            });
        }
        if ($('.urlValidation').length) {
            var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
            $('.urlValidation').each(function (index, value) {
                if (!urlregex.test($(this).val())) {
                    stepthirdRequired = false;
                    $($(this)).after("<p class='error-message errorMsg '>" + 'Invalid Url!' + "</p>");
                }
            });
        }
    } else {
        stepthirdRequired = false;
    }

    if (stepthirdRequired) {
        $.ajax({
            url: root_url + '/user/classifieds/create',
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {

                if (data.status) {
                    window.location.href = root_url + '/user/' + data.url;
                } else {
                    $.each(data.data, function (index, value) {
                        if (value.fields == 'attr_value_video') {

                            $('.attr_value_video').each(function (i, v) {
                                if (i == value.keys) {
                                    var videoClassInput = $(this);
                                    $(videoClassInput).after("<p class='error-message errorMsg '>" + value.message + "</p>");
                                }
                            });
                        }
                    });
                }
            },
            error: function (data) {

                var dataObj = JSON.parse(data.responseText);
                $('.errorMsg').each(function () {
                    $(this).remove();
                });
                $.each(dataObj, function (index, value) {

                    var res = index.split(".");
                    if (res[0] == 'attr_value_video') {
                        $('.attr_value_video').each(function (i, v) {
                            var videoClassInput = $(this);
                            if (i == res[1]) {
                                var msgEdited = value[0].replace('attr_value_video.', 'attribute video ').replace(/\d+/g, '');
                                var msgEdited = value[0].replace('validation.uploaded', 'Invalid video type').replace(/\d+/g, '');
                                $(videoClassInput).after("<p class='error-message errorMsg '>" + msgEdited + "</p>");
                            }

                        });
                    }

                });
                $.each(dataObj, function (index, value) {

                    if (index == 'image.0') {
                        index = 'classifiedInputFile'
                        value = "Image is required"
                    }
                    Notify.showMessageOld(index, value);

                });
            }
        });
    }

});
var count = 1;
function add_more(str) {
    var html = '<div style="margin: 5px 0 5px 0;" id="image_' + count + '"><div class="img_id_' + count + '"></div><div class="file-label"><input type="file" onchange="" id="img_id_' + count + '" value="" class="addedInput blue image_field textRequired" name="image[' + count + ']"></div><a href="javascript:void(0)" onclick="remove_image(' + count + ')" class="remove-img">X</a></div>';
    jQuery('#more_images').append(html);
    count++;
}
function remove_image(strrm) {
    if (count > 1) {
        jQuery('#image_' + strrm + '').remove();
        count--;
    }
}

$(document).on("change", ".image_field", function (event) {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("." + $(this).attr("id"));
        dvPreview.html("");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        $($(this)[0].files).each(function () {
            var file = $(this);
            if (regex.test(file[0].name.toLowerCase())) {
                dvPreview.css({
                    'height': '110px',
                    'width': '160px',
                    'border': '1px solid black',
                    'padding': '4px',
                    'margin-bottom': '3px'
                });
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = $("<img />");
                    img.attr("style", "height:100px;width: 150px");
                    img.attr("margin-bottom", "4px");
                    img.attr("src", e.target.result);
                    dvPreview.append(img);
                }
                reader.readAsDataURL(file[0]);
            } else {
                dvPreview.removeAttr("style");
                $(this).val('');
                Notify.showMessage("Image must have an extension of .jpeg, .jpg, or .png", 'warning');
                dvPreview.html("");
                return false;
            }
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});




$(document).on('click', '.choose-category', function () {
    $('.tab1').click();
});
$(document).on('change', '#stateid', function () {

    var stateid = $(this).val();

    //Ajax for subregions list
    $.ajax({
        url: root_url + '/user/classifieds/allstates',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": stateid
        },
        //dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            if (response.status) {

                $("#subregion_id").html('');
                $("#subregion_id").append($('<option></option>').val('').html('Select Suburb'));
                $.each(response.sub_regions, function (key, value) {

                    $("#subregion_id").append($('<option></option>').val(key).html(value));
                });
            }
        }

    });

});


$(document).on('change', '.classForOnChange', function () {
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
                    var html = "<div class='divAttrValue childValueDiv_" + attributeid + " form-row'><div class='col-sm-4'><label>" + valueMain[0].name + "</label></div><div class='col-sm-8'><input type='hidden' value='Drop-Down' name='attr_type_name[]'><input type='hidden' value='4' name='attr_type_id[]'><input type='hidden' value='" + valueMain[0].attribute_value_id + "' name='parent_value_id[]'><input type='hidden' value='" + attributeid + "' name='parent_attribute_id[]'><input type='hidden' value='" + valueMain[0].attribute_id + "' name='attr_ids[]'><select attributeid='56' class='attr_value textRequired' name='attr_value[]'>" + options + "</select></div></div>";
                    $(thisObj).parent().parent().parent().after(html);

                });
            }
        }
    });
});

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
});

function add_imageGallery(thisObj) {
    var cloneId = $(thisObj).attr('forclonelink');
    var html = '<div class="input_repeat"><div class="file-input"><input type="file" value="" class="attr_value textRequired image_field cloneId_' + cloneId + '" style="margin-bottom:5px;" name="attr_value_image[' + cloneId + '][]"><span class="custom-label">Browse..</span><a href="javascript:void(0)" onclick="" class="remove-img"><i class="fa fa-close" aria-hidden="true"></i></a></div></div>';
    $(thisObj).parent().before(html);
}

$(document).on('click', '.input_repeat .file-input a i', function () {
    $(this).parents('.input_repeat').remove();
});
$(document).on('click', '.input_repeat a.remove-img', function () {
    $(this).parent('.input_repeat').remove();
});
$(document).on("change", ".videotypetxt", function (event) {
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['mpeg', 'mp4', 'mov', 'wmv']) == -1) {
        Notify.showMessage("Please select a valid video type, mp4,mov,wmv", 'warning');
        $(this).val("");
        //return false;
    }
});

//var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
//
//google.maps.event.addListener(autocomplete, 'place_changed', function () {
//    var place = autocomplete.getPlace();
//    console.log(place);
//    document.getElementById('lat').value = place.geometry.location.lat();
//    document.getElementById('lng').value = place.geometry.location.lng();
//    //console.log(place.address_components);
//});

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
//var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
//
//google.maps.event.addListener(autocomplete, 'place_changed', function () {
//    var place = autocomplete.getPlace();
//    console.log(place);
//    document.getElementById('lat').value = place.geometry.location.lat();
//    document.getElementById('lng').value = place.geometry.location.lng();
//    //console.log(place.address_components);
//});   

/*input file upgrade
 ============================*/
$(document).ready(function () {
    $(document).on('change', '.file-input input[type="file"]', function () {
        var file_name = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
        $(this).next('.custom-label').text(file_name);
    });
});
