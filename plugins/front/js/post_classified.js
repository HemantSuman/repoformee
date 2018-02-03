$(function () {
    var groupedCat;
    var finalAttrObj = {};
});
$('#rootwizard').bootstrapWizard(
        {
            onShow: function (activeTab, navigation, currentIndex, clickedIndex) {
//                $('.navbar').show(1000);
            },
            onTabClick: function (activeTab, navigation, currentIndex, clickedIndex) {
            },
            onNext: function (tab, navigation, index) {
            },
            onTabShow: function (tab, navigation, index) {

            }
        });

$(document).on('click', 'a.parent_cat', function () {
//alert('here');
    var categoryId = $(this).attr('categoryId');
    $('.parent_categoryid').val(categoryId);
    $('.category_id').val('');
    $('.pCatName').text($(this).find('.cat-name').text());
    $('.cCatName').text('');

    $('.parent_cat').each(function (index, value) {
        $(this).removeClass('selected');
    });
    $(this).addClass('selected');

    $('.emptySubCat').hide();
    $('.filledSubCat').show();
    $('#sub-categories').html('');

    $.each(groupedCat[categoryId][0]['children'], function (index, val) {

        var li = "<li><a class='child_cat' categoryId='" + val.id + "' href='javascript:void(0);'><span class='cat-img'><img src='" + root_url + "/upload_images/categories/icon/" + val.id + "/" + val.icon + "' ></span><span class='cat-name'>" + val.text + "</span></a></li>";
        $('#sub-categories').append(li);
    });
    $.each(showStaticAttributes[0], function (index, val) {
        if (index == categoryId) {

            if (val) {
                $('.sttcAttrbts').removeClass("hide");
                //staticattribute
                $('.staticattribute').addClass("staticattributevalidation");
            } else {
                $('.sttcAttrbts').addClass("hide");
                $('.staticattribute').removeClass("staticattributevalidation");
            }
        }
    });
});

$(document).on('click', '.child_cat', function () {

    var categoryId = $(this).attr('categoryId');
    $('.category_id').val(categoryId);

    $('#sub-categories li .child_cat').each(function (index, value) {
        $(this).removeClass('selected');
    });
    $(this).addClass('selected');

    $('.cCatName').text($(this).find('.cat-name').text());

    attributeListing(categoryId, true);
//    

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
                finalAttrObj = response.attributes;
                $('.tab2').click();
                $('.backbtn').removeClass('backchange');
                $('.backbtn').addClass('backbtn1');
                $(this).addClass('current');
                console.log(finalAttrObj);
                placeAllAtter();

            }
        }

    });

}

$(document).on('click', '.backchange', function () {
    $('.tab1').click();
});
$(document).on('click', '.backbtn1', function () {
    // alert('n1');
    $('.tab1').click();
    $('.backbtn').removeClass('backbtn1');
    $('.backbtn').addClass('backbtn2');
});

$(document).on('click', '.backbtn2', function () {
    //alert('2');
    $('.backbtn').removeClass('backbtn2');
    $('.backbtn').addClass('backbtn1');
    $('.tab2').click();
    
});

function placeAllAtter() {

//    strAttrIds = [];
    $("#attrName").html('');
//    console.log(finalAttrObj, typeof finalAttrObj);
    $.each(finalAttrObj, function (i, v) {

        var is_required = v.required;

        if (v.attribute_type.name == 'text') {


            if (typeof v.attribute_name != 'undefined') {
                $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><span>' + v.attribute_name + '</span><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" name="attr_value[]" is_required="' + is_required + '" class="form-control textRequired inputForValidate preshow" dataname="' + v.attribute_name + '"></div></div>');
            }
        } else if (v.attribute_type.name == 'Email') {

            if (typeof v.attribute_name != 'undefined') {
                $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><span>' + v.attribute_name + '</span><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" name="attr_value[]" is_required="' + is_required + '" class="form-control inputForValidate emailCheck emailValidation textRequired preshow" dataname="' + v.attribute_name + '"></div></div>');
            }

        } else if (v.attribute_type.name == 'Url') {

            if (typeof v.attribute_name != 'undefined') {
                $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><span>' + v.attribute_name + '</span><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" name="attr_value[]" is_required="' + is_required + '" class="form-control inputForValidate urlCheck urlValidation textRequired preshow" dataname="' + v.attribute_name + '"></div></div>');
            }

        } else if (v.attribute_type.name == 'Number') {

            if (typeof v.attribute_name != 'undefined') {
                $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><span>' + v.attribute_name + '</span><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="number" name="attr_value[]" is_required="' + is_required + '" class="form-control inputForValidate numberCheck textRequired preshow" dataname="' + v.attribute_name + '"></div></div>');
            }

        } else if (v.attribute_type.name == 'textarea') {

            if (typeof v.attribute_name != 'undefined') {
                $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><span>' + v.attribute_name + '</span><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><textarea name="attr_value[]" is_required="' + is_required + '" class="form-control inputForValidate textRequired" dataname="' + v.attribute_name + '"></textarea></div></div>');
            }

        } else if (v.attribute_type.name == 'Color') {
            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue step3row  row"><div class="col-sm-8"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group my-colorpicker2 colorpicker-element textRequired preshow" is_required="' + is_required + '" dataname="' + v.attribute_name + '" ><input type="text" name="attr_value[]" placeholder="Select Colour" class="attr_value form-control" style="border-right: 0;border-top-right-radius: 0;border-bottom-right-radius: 0;"><div class="input-group-addon" ><i style="background-color: rgb(33, 78, 82);"></i></div></div></div></div></div>');
                $('.my-colorpicker2').colorpicker().on('changeColor', function (ev) {
                    $(this).val(ev.color.toHex());
                });
            }

//            if (typeof v.attribute_name != 'undefined') {
//                $('#attrName').append('<div class="row step3row"><div class="col-sm-8 color"><span>' + v.attribute_name + '</span><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" nam="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group colorpicker-component colorPickerPost"><input type="text" name="attr_value[]" is_required="' + is_required + '" value="#00AABB" class="form-control inputForValidate textRequired preshow" dataname="' + v.attribute_name + '"><span class="input-group-addon"><i style="background-color: rgb(33, 78, 82);"></i></span></div></div></div>');
//                $(".colorPickerPost").colorpicker();
//            }

        } else if (v.attribute_type.name == 'Radio-button') {

            if (typeof v.attribute_name != 'undefined') {
                var options = '';
                $.each(v.attribute_value_multi, function (index, opt) {
                    options += '<input name="attr_value_radio[' + i + '][]" class="inputCheckBox custom-radio" type="radio" is_required="' + is_required + '" dataname="' + v.attribute_name + '" value="' + index + '"><label>' + opt + '</label>';
                });
                $('#attrName').append('<div  class="row step3row  divCheckBox preradio"><div class="col-sm-12"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field no-input-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_radio" /><input type="hidden" value="0" name="parent_value_id_radio[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_radio" /><input type="hidden" value="' + i + '" name="attr_ids_radio[]" />' + options + '</div></div></div>');
            }
//             if (typeof v.attribute_name != 'undefined') {
//                var options = '';
//                $.each(v.attribute_value_multi, function (index, opt) {
//                    options += '<input name="attr_value_radio[' + i + '][]" class="inputCheckBox custom-radio" type="radio" is_required="' + is_required + '" value="' + index + '"><label>' + opt + '</label>';
//                });
//                $('#attrName').append('<div  class="row step3row  divCheckBox"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field no-input-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_radio" /><input type="hidden" value="0" name="parent_value_id_radio[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_radio" /><input type="hidden" value="' + i + '" name="attr_ids_radio[]" />' + options + '</div></div></div>');
//            }

//            if (typeof v.attribute_name != 'undefined') {
//                var options = '';
//                $.each(v.attribute_value_multi, function (index, opt) {
//                    options += '<li><input name="attr_value_radio[' + i + '][]" class="inputCheckBox custom-radio" dataname="' + v.attribute_name + '" type="radio" is_required="' + is_required + '" value="' + index + '"><label>' + opt + '</label>';
//                });
//                $('#attrName').append('<div class="row step3row"><div class="col-sm-12"><span>' + v.attribute_name + '</span><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><ul class="contact-surname">' + options + '</ul><span class="error"></span></div></div>');
//            }

        } else if (v.attribute_type.name == 'Drop-Down') {

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

                $('#attrName').append('<div class="divAttrValue row step3row"><div class="col-sm-8" ><span>' + v.attribute_name + '</span></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><select attributeId="' + i + '" class=" form-control attr_value textRequired preselect ' + classForOnChange + '" is_required="' + is_required + '" dataname="' + v.attribute_name + '" name="attr_value[]" ><option value="">Select One</option>' + options + '</select></div></div></div>');
            }
        } else if (v.attribute_type.name == 'Multi-Select') {

            if (typeof v.attribute_name != 'undefined') {
                var options = '';
                $.each(v.attribute_value_multi, function (index, opt) {
                    options += '<input class="inputCheckBox  offerchk custom-checkbox" label_name ="' + opt + '"  is_required="' + is_required + '" name="attr_value_multi[' + i + '][]" dataname="' + v.attribute_name + '" type="checkbox" value="' + index + '"><label class="offerchk">' + opt + '</label>';
                });

                $('#attrName').append('<div class="row step3row divCheckBox precheckbox"><div class="col-sm-8"><span>' + v.attribute_name + '</span></div><div class="col-sm-8 "><div class="value-field no-input-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_multi" /><input type="hidden" value="0" name="parent_value_id_multi[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_multi"  /><input type="hidden" value="' + i + '" name="attr_ids_multi[]" />' + options + '</div></div></div>');
            }
        } else if (v.attribute_type.name == 'Date') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input placeholder="From Date" attribute_id="' + i + '" class="datepicker from_date rangeDate form-control fromDate_' + i + '" dataname="' + v.attribute_name + '" is_required="' + is_required + '" type="text" value="" style="margin-bottom:8px;"><input placeholder="To Date" attribute_id="' + i + '" class="datepicker form-control  to_date toDate_' + i + '" is_required="' + is_required + '" type="text" value=""><input type="hidden" name="attr_value[]" class="fronAndToDate_' + i + '"></div></div></div>');
                } else {
                    $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="datepicker  textRequired preshow attr_value form-control singleDate_' + i + '" dataname="' + v.attribute_name + '" is_required="' + is_required + '" name="attr_value[]" /></div></div></div>');
                }
                $(".datepicker").datepicker();

            }
        } else if (v.attribute_type.name == 'Time') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group bootstrap-timepicker"><input placeholder="From Time" attribute_id="' + i + '" class="timepicker timeRange from_time form-control from_time_' + i + '" dataname="' + v.attribute_name + '" is_required="' + is_required + '" textRequired" type="text" value="" style=""></div></br><div class="input-group bootstrap-timepicker"><input placeholder="To Time" attribute_id="' + i + '" class="timepicker to_time form-control to_time_' + i + '" is_required="' + is_required + '" type="text" value=""></div><input type="hidden" name="attr_value[]" class="fromAndToTime_' + i + '"></div></div>');
                } else {
                    $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group bootstrap-timepicker"><input type="text" name="attr_value[]" class="timepicker attr_value form-control textRequired preshow " dataname="' + v.attribute_name + '" is_required="' + is_required + '" ></div></div></div></div>');
                    //$('#attrName').append('<div class="divAttrValue  form-row"><div class="col-sm-4"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="datepicker attr_value form-control" name="attr_value[]" /></div></div>');
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
                    $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input class="range_1" type="text" dataname="' + v.attribute_name + '" is_required="' + is_required + '" name="attr_value[]" value=""></div></div></div>');
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
                    $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="number" onkeypress="return isNumberKey(event)" value="" class="attr_value form-control singlecalendar preshow" dataname="' + v.attribute_name + '"  is_required="' + is_required + '" name="attr_value[]" /></div></div></div>');
                }
            }
        } else if (v.attribute_type.name == 'Numeric') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input class="range_1" dataname="' + v.attribute_name + '" type="text" name="attr_value[]" value=""></div></div></div>');
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
                    $('#attrName').append('<div class="row step3row"><div class="col-sm-8"><label>' + v.attribute_name + '</label></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="number"    value="" class="attr_value form-control singleNumber preshow"  dataname="' + v.attribute_name + '" is_required="' + is_required + '" name="attr_value[]" /></div></div></div>');
                }
            }
        }
    });

}

$(document).on('click', '.showfillvalue', function ()
//$("#submitFrm").submit(function (event)
{

    //event.preventDefault();
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
    var des = $('#message').val();
    if(des == '')
    {
      stepFirstRequired = false;
            $('#message').after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");  
    }
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
        $("#stateid").css("display", "none");
        $('.tab4').click();
        $('.backbtn').removeClass('backbtn1');
        $('.backbtn').addClass('backbtn2');
        $('.priceshow ').text($('#price').val());
        $('.titleshow').text($('#title1').val());
        $('.descshow').text($('#message').val());
        $(".dyanamicshow").html('');
        $('.preshow').each(function (index, value) {

            $('.dyanamicshow').append('<li> <span class="postat"> ' + $(this).attr("dataname") + ':</span> <span class=""> ' + $(this).val() + '</span></li>');
        });

        $('.rangeDate').each(function (index, value) {

            $('.dyanamicshow').append('<li> <span class="postat"> ' + $(this).attr("dataname") + ':</span> <span class=""> ' + $('.from_date').val() + ' - ' + $('.to_date').val() + '</span></li>');
        });

        $('.timeRange').each(function (index, value) {

            $('.dyanamicshow').append('<li> <span class="postat"> ' + $(this).attr("dataname") + ':</span> <span class=""> ' + $('.from_time').val() + ' - ' + $('.to_time').val() + '</span></li>');
        });

        $('.range_1').each(function (index, value) {

            $('.dyanamicshow').append('<li> <span class="postat"> ' + $(this).attr("dataname") + ':</span> <span class=""> ' + $(this).val() + '</span></li>');
        });
        $('.preselect').each(function (index, value) {

            $('.dyanamicshow').append('<li> <span class="postat"> ' + $(this).attr("dataname") + ':</span> <span class=""> ' + $(' option:selected', this).text() + '</span></li>');
        });

        $('.precheckbox').each(function (index, value) {
            var selectedArr = [];
            var name = ''
            $('.inputCheckBox:checked', value).each(function () {
                selectedArr.push($(this).attr('label_name'));
                name = $(this).attr("dataname");
            });

            $('.dyanamicshow').append('<li> <span class="postat"> ' + name + ':</span> <span class=""> ' + selectedArr.toString() + '</span></li>');
        });
        $('.preradio').each(function (index, value) {
            //alert(index);
            var radiovalue = $("input[type='radio']:checked").next().text();
            var radioname = $("input[type='radio']:checked").attr('dataname');
            // $('.dyanamicshow').append('<li> <span class="av"> ' + radiovalue + '</span></li>');
            $('.dyanamicshow').append('<li> <span class="postat"> ' + radioname + ':</span> <span class=""> ' + radiovalue + '</span></li>');
        });
        //$('.preradio').each(function (index, value) {
//            var selectedArr = [];
//            var name = ''
//            $('.radio:checked',value).each(function () {
//                selectedArr.push($(this).attr('label_name'));
//                name = $(this).attr("dataname");
//            });
//
//            $('.dyanamicshow').append('<li> <span class="postat"> ' + name + ':</span> <span class=""> '+ selectedArr.toString()+'</span></li>');
        //});


    }

});

//$(document).on('click','.addpost',function()
$("#submitFrm").submit(function (event)
{
    event.preventDefault();
    var stepFourthRequired = true;
    $('.errorMsg').each(function () {
        $(this).remove();
    });

    $('.staticattributevalidation').each(function (index, value) {

        //if ((parseInt($(this).attr('is_required')) == 1) && ($(this).val() == '')) {
        if (($(this).val() == '')) {
            stepFourthRequired = false;
            $($(this)).after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
//                                                Notify.showMessageForClass(index, 'value');
        }
    });
    
    var img = $('.imagerequried').val();
    if(img == '')
    {
     stepFourthRequired = false;
            $('.imagerequried').after("<p class='error-message errorMsg '>" + 'Image Field required' + "</p>");  
    }
    if (stepFourthRequired)
    {
        $('.addpost').attr('disabled', 'disabled');


        $.ajax({
            url: root_url + '/user/classifieds/create',
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
                    // Notify.showNotification('Your Classified has been submitted Successfully.', 'done');
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
                $(".addpost").removeAttr('disabled');
                var dataObj = JSON.parse(data.responseText);
                $('.errorMsg').each(function () {
                    $(this).remove();
                });
//            $.each(dataObj, function (index, value) {
//
//                var res = index.split(".");
//                if (res[0] == 'attr_value_video') {
//                    $('.attr_value_video').each(function (i, v) {
//                        var videoClassInput = $(this);
//                        if (i == res[1]) {
//                            var msgEdited = value[0].replace('attr_value_video.', 'attribute video ').replace(/\d+/g, '');
//                            var msgEdited = value[0].replace('validation.uploaded', 'Invalid video type').replace(/\d+/g, '');
//                            $(videoClassInput).after("<p class='error-message errorMsg '>" + msgEdited + "</p>");
//                        }
//
//                    });
//                }
//
//            });
//            $.each(dataObj, function (index, value) {
//
//                if (index == 'image.0') {
//                    index = 'classifiedInputFile'
//                    value = "Image is required"
//                }
//                Notify.showMessageOld(index, value);
//
//            });
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
        
                    var html = "<div class='divAttrValue row step3row childValueDiv_" + attributeid + " form-row1'><div class='col-sm-8'><label>" + valueMain[0].display_name + "</label></div><div class='col-sm-8 '><input type='hidden' value='Drop-Down' name='attr_type_name[]'><input type='hidden' value='4' name='attr_type_id[]'><input type='hidden' value='" + valueMain[0].attribute_value_id + "' name='parent_value_id[]'><input type='hidden' value='" + attributeid + "' name='parent_attribute_id[]'><input type='hidden' value='" + valueMain[0].attribute_id + "' name='attr_ids[]'><select attributeid='56' class='attr_value form-control textRequired preselect' dataname='" + valueMain[0].display_name + "' name='attr_value[]'>" + options + "</select></div></div>";
                    $(thisObj).parent().parent().parent().after(html);

                });
            }
        }
    });
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