$('#mailsend').click(function () {
    $(this).hide();
});

var showMessageOnField = function (text, selector) {
    $('#' + selector + '_error').text(text);
//    $('.error_mgs_lable').show();
};

$(function () {
    var allAttrsParent = [];
//    var allAttrsParent = new Object();
    var allAttrsChild = [];
    var finalAttrObj = {};
    var BelongsToCommunities;
    var showStaticAttributes;

    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    });
});

$(document).on("submit", "#formSubmit", function (e) {
    e.preventDefault();
    var thisObj = $(this);

//    $('input[type=text]').each(function(i,v){
//        $(this).val(v.value.trim());
//    });

    var form = $(thisObj)[0];
    var formData = new FormData(form);
    $('.error-message').html('');
    console.log(formData);
    $.ajax({
        url: $(thisObj).attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {
                window.location.href = root_url + response.url;
            } else {
//                window.location.href = root_url + response.url;
                Notify.showMessage('save failed!','warning');
            }
        }, error: function (resData) {
            $.each(resData.responseJSON, function (key, val) {
                showMessageOnField(val[0], key);
            });
            $('.error-message').each(function (i, v) {
                if ($(this).text() != '') {

                    $('html, body').animate({
                        scrollTop: $(this).parent('div').find("label").offset().top
                    }, 1000);

                    return false;
                }
            });
        }
    });
});

function deleteRecord(id, viewName, actionName, thisObj, pid) {

    if (!confirm("Are you sure?")) {
        return false;
    }

    if (pid == 0 || pid == 'undefined' || typeof pid == 'undefined') {
        var pid_set = '';
    } else {
        var pid_set = '/' + pid;
    }




    $.ajax({
        url: root_url + '/admin/' + viewName + '/' + actionName,
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": id
        },
        //dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            if (response.status) {
                $(thisObj).parent('td').parent('tr').remove();
                window.location.href = root_url + '/admin' + '/' + response.url + pid_set;
            } else {
                return alert(response.message);

            }
        },
        error: function (response) {
            Notify.showMessage('You Have Not Permission To Perform This Action', 'warning');
            // return alert("You Have Not Permission")
        }

    });
}


$(document).on('change', '#parent_categoryid_group', function () {

    var p_category_id = $(this).val();
    categoryListingforGroup(p_category_id);

});

$(document).on('change', '#parent_categoryid', function () {

    // console.log(communities_informationarr[0]);
    //  console.log(BelongsToCommunities[0]);
    // if($(this).hasClass("addClassified")) {
    //     console.log("Yes");
    // } else {
    //     console.log("No");
    // }
    //errorMsg
    //alert("hii"); halal products
    $('#withCommunty').val(0);
    $('#withinformation').val(0);
    $('#editproductcode').addClass('hide');
    var p_category_id = $(this).val();
    var p_category_name = $("option:selected", this).text();
//    console.log(typeof halalname);
//    console.log(typeof p_category_name);
    p_category_name = p_category_name.trim();
    halalname = halalname.trim();
    if (p_category_name == halalname)
    {
        //alert("hii");
        $('#editproductcode').removeClass('hide');
    }
    // console.log(p_category_id,p_category_name);
    $('.contact_email').val('');
    $('.contact_mobile').val('');
    // $('.subcategoryerror').prev('p').text('');
    $('.errorMsg').text('');
    categoryListing(p_category_id);
    $.each(BelongsToCommunities[0], function (index, val) {
        if (index == p_category_id) {

            if (val) {
//                console.log("Yes");
//                $('.classified-s-e-date').addClass('hide');
                $('.classifiedIsFeatured').hide();
                $('.priceClassDiv').hide();
                $('#end_date1').hide();
                $('.featured_classified').attr('disabled', true);
                $('#withCommunty').val(1);

            } else {
//                $('.classified-s-e-date').removeClass('hide');
                $('.classifiedIsFeatured').show();
                $('#end_date1').show();
                $('#end_date1').parent().removeClass('hide');
                $('.priceClassDiv').show();
                $('#end_date').val('');
                $('#withCommunty').val(0);
                $('.featured_classified').attr('disabled', false);

//                console.log("No");
            }
        }
    });

    $.each(showStaticAttributes[0], function (index, val) {
        if (index == p_category_id) {

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

    $.each(communities_informationarr[0], function (index, val) {
        if (val['id'] == p_category_id) {

            if (val['belong_to_community'] == 1 || val['show_on_info_area'] == 1) {
                $('#sub_categories').attr("is_required", "0");
                $('#withinformation').val(1);
                $('.isFeaturedCheckboxDiv').hide()
                $(".featured_classified").attr("checked", false)
            } else {
                $('#sub_categories').attr("is_required", "1");
                $('.isFeaturedCheckboxDiv').show()
            }
        }
    });


});

//$(document).on('change', '.showvalue', function () {
//
//    var attrid = $(this).val();
//   $.ajax({
//        url: root_url + '/admin/attributes/showvalue',
//        data: {
//            "_token": $('meta[name="csrf-token"]').attr('content'),
//            "id": attrid
//        },
//        //dataType: "html",
//        method: "GET",
//        cache: false,
//        success: function (response) {
//            if (response.status) {
//                $(thisObj).parent('td').parent('tr').remove();
//                window.location.href = root_url + '/admin' + '/' + response.url + pid_set;
//            } else {
//                return alert(response.message);
//
//            }
//        }
//
//    });
//});


function categoryListingforGroup(pcat_id) {

    //Ajax for sub category list
    $.ajax({
        url: root_url + '/admin/categories/allcategories',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": pcat_id
        },
        //dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            if (response.status) {

                $("#sub_categories_group").html('');
                $("#sub_categories_group").append($('<option></option>').val('').html('Select Subcategory'));

                $.each(response.categories, function (key, value) {

                    $("#sub_categories_group").append($('<option></option>').val(key).html(value));
                });

//                if (response.categories == '') {
//                    var forShowAttr = true;
//                } else {
                    var forShowAttr = false;
//                }

                attributeListingForGroup(pcat_id, 'forCat', forShowAttr);
            }
        }

    });

//    if (forAttr != 'no_attr') {
////        console.log(forAttr);
//        //ajax for attribute list
//        //attributeListing(pcat_id, 'forCat');
//    }
}


function categoryListing(pcat_id) {

    //Ajax for sub category list
    $.ajax({
        url: root_url + '/admin/categories/allcategories',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": pcat_id
        },
        //dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            if (response.status) {

                $("#sub_categories").html('');
                $("#sub_categories").append($('<option></option>').val('').html('Select Subcategory'));

                $.each(response.categories, function (key, value) {

                    $("#sub_categories").append($('<option></option>').val(key).html(value));
                });

                if (response.categories == '') {
                    var forShowAttr = true;
                } else {
                    var forShowAttr = false;
                }

                attributeListing(pcat_id, 'forCat', forShowAttr);
            }
        }

    });

//    if (forAttr != 'no_attr') {
////        console.log(forAttr);
//        //ajax for attribute list
//        //attributeListing(pcat_id, 'forCat');
//    }
}

$(document).on('change', '#sub_categories_group', function () {

    var sub_category_id = $(this).val();
    if (sub_category_id != '') {
        
        attributeListingForGroup(sub_category_id, 'forSubCat', true);
    } else {
        $("#attrName").html('');
    }
});

function attributeListingForGroup(cat_id, catType, forShowAttr) {

    if(catType ==  'forSubCat'){
        
    }
    $.ajax({
        url: root_url + '/admin/attributes/allattributes',
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


                }
                var other_saved_attr_ids = response.other_saved_attr_ids
                $("#attrName").html('');
                if (forShowAttr) {
                    placeAllAtterForGroup(other_saved_attr_ids);
                }

            }
        }

    });

}

function in_array(needle, haystack) {
    for (var i in haystack) {
        if (haystack[i] == needle)
            return true;
    }
    return false;
}

function placeAllAtterForGroup(other_saved_attr_ids) {

    var attributes_groups_saved = $("#attributes_groups_saved").val();
    if (typeof attributes_groups_saved != 'undefined') {
        var attributes_groups_saved_array = attributes_groups_saved.split(",");

    } else {
        var attributes_groups_saved_array = '';
    }

//    var other_saved_attr_ids = $("#other_saved_attr_ids").val();
    if (typeof other_saved_attr_ids != 'undefined') {
        var other_saved_attr_ids_array = other_saved_attr_ids;
//        var other_saved_attr_ids_array = other_saved_attr_ids.split(",");

    } else {
        var other_saved_attr_ids_array = '';
    }

    var parent_cat_id = $("#parent_cat_id").val();
    var child_cat_id = $("#child_cat_id").val();

    var parent_categoryid_group = $("#parent_categoryid_group").val();
    var sub_categories_group = $("#sub_categories_group").val();

    $.each(finalAttrObj, function (i, v) {

        if (typeof v.attribute_name != 'undefined') {

            if ((parent_categoryid_group == parent_cat_id) && (sub_categories_group == child_cat_id) && (in_array(i, attributes_groups_saved_array))) {
                var chk = "checked=checked";
            } else {
                var other_saved_attr_ids_array1 = other_saved_attr_ids_array;
//                var other_saved_attr_ids_array1 = other_saved_attr_ids_array.concat(attributes_groups_saved_array);
                var chk = "";
            }
            
            if (in_array(i, other_saved_attr_ids_array1)) {
                var disabled = "disabled=disabled";
                var disabledLabel = "style='color:#a79e9e;'";
            } else {
                var disabled = "";
                var disabledLabel = "";
            }
            $('#attrName').append('<div class=""><input ' + disabled + ' ' + chk + ' type="checkbox" value="' + i + '" name="attr_ids[]" /> <label ' + disabledLabel + '> ' + v.attribute_name + '</label></div>');
        }
    });
}

$(document).on('change', '#sub_categories', function () {

    var sub_category_id = $(this).val();
    if (sub_category_id != '') {
        //ajax for attribute list
        attributeListing(sub_category_id, 'forSubCat', true);
    } else {
        $("#attrName").html('');
    }
});

function attributeListing(cat_id, catType, forShowAttr) {

    $.ajax({
        url: root_url + '/admin/attributes/allattributes',
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


    $.each(finalAttrObj, function (i, v) {

        var is_required = v.required;
        var is_numberlength = v.size;

        if (v.attribute_type.name == 'text') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="attr_value form-control textRequired textsize" is_required="' + is_required + '" is_numlength="' + is_numberlength + '" name="attr_value[]" /></div>');
            }
        }

        if (v.attribute_type.name == 'Email') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="attr_value form-control textRequired  emailValidation" is_required="' + is_required + '" name="attr_value[]" /></div>');
            }
        }

        if (v.attribute_type.name == 'Url') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="attr_value form-control textRequired urlValidation" is_required="' + is_required + '" placeholder="http://www.example.com" name="attr_value[]" /></div>');
            }
        }

        if (v.attribute_type.name == 'Number') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="number" value="" class="attr_value form-control textRequired" is_required="' + is_required + '" name="attr_value[]" /></div>');
            }
        }

//        if (v.attribute_type.name == 'Range') {
//
//
//            if (typeof v.attribute_name != 'undefined') {
//
//                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input class="range_1" type="text" name="attr_value[]" value=""></div>');
//                $(".range_1").ionRangeSlider({
//                    min: 0,
//                    max: 5000,
//                    from: 1000,
//                    to: 4000,
//                    type: 'double',
//                    step: 1,
//                    prefix: "",
//                    prettify: false,
//                    hasGrid: true
//                });
//            }
//        }

        if (v.attribute_type.name == 'Drop-Down') {

            if (typeof v.attribute_name != 'undefined') {
                var options = '';
//                var obj = v.attribute_value_multi.split(",");

                $.each(v.attribute_value_multi, function (i, opt) {
                    options += '<option value="' + i + '">' + opt + '</option>';
                });

                if (parseInt(v.p_attr_id) == 0) {
                    var classForOnChange = 'classForOnChange';
                } else {
                    var classForOnChange = '';
                }

                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><select attributeId="' + i + '" class="attr_value form-control textRequired ' + classForOnChange + '" is_required="' + is_required + '" name="attr_value[]" ><option value="">Select One</option>' + options + '</select></div>');
            }
        }

        if (v.attribute_type.name == 'Numeric') {

            if (typeof v.attribute_name != 'undefined') {

//                console.log(v.attribute_value_multi[Object.keys(v.attribute_value_multi)[1]]);
                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input class="range_1" type="text"  name="attr_value[]" value=""></div>');
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
                    $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="number" value="" class="attr_value form-control singleNumber" is_required="' + is_required + '" is_numlength="' + is_numberlength + '" name="attr_value[]" /></div>');
                }
            }
        }

        if (v.attribute_type.name == 'calendar') {

            if (typeof v.attribute_name != 'undefined') {

//                console.log(v.attribute_value_multi[Object.keys(v.attribute_value_multi)[1]]);
                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input class="range_1" type="text" is_required="' + is_required + '" name="attr_value[]" value=""></div>');
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
                    $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="number" value="" class="attr_value form-control singlecalendar" is_required="' + is_required + '" name="attr_value[]" /></div>');
                }
            }
        }

        if (v.attribute_type.name == 'Date') {

            if (typeof v.attribute_name != 'undefined') {

//                console.log(v.attribute_value_multi[Object.keys(v.attribute_value_multi)[1]]);
                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /></br><input placeholder="From Date" attribute_id="' + i + '" class="datepicker from_date rangeDate fromDate_' + i + '" is_required="' + is_required + '" type="text" value="" style="margin-right:8px;"><input placeholder="To Date" attribute_id="' + i + '" class="datepicker to_date toDate_' + i + '" is_required="' + is_required + '" type="text" value=""><input type="hidden" name="attr_value[]" class="fronAndToDate_' + i + '"></div>');
                } else {
                    $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="datepicker textRequired attr_value form-control singleDate_' + i + '" is_required="' + is_required + '" name="attr_value[]" /></div>');
                }

            }
        }

        if (v.attribute_type.name == 'Time') {

            if (typeof v.attribute_name != 'undefined') {

                if (v.attribute_value_multi != '') {
                    $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group bootstrap-timepicker" style="width: 24%;"><input placeholder="From Time" attribute_id="' + i + '" class="timepicker timeRange form-control from_time_' + i + '" textRequired" is_required="' + is_required + '" type="text" value="" style="margin-right:8px;"><div class="input-group-addon" style="width: 21%;"><i class="fa fa-clock-o"></i></div></div></br><div class="input-group bootstrap-timepicker" style="width: 24%;"><input placeholder="To Time" attribute_id="' + i + '" class="timepicker form-control to_time_' + i + '" type="text" is_required="' + is_required + '" value=""><div class="input-group-addon" style="width: 21%;"><i class="fa fa-clock-o"></i></div></div><input type="hidden" name="attr_value[]" class="fromAndToTime_' + i + '"></div>');
                } else {
                    $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group bootstrap-timepicker" style="width: 24%;"><input type="text" name="attr_value[]" class="timepicker attr_value form-control textRequired" is_required="' + is_required + '" ><div class="input-group-addon" style="width: 21%;"><i class="fa fa-clock-o"></i></div></div></div>');
                    //$('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" value="" class="datepicker attr_value form-control" name="attr_value[]" /></div>');
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
//                var obj = v.attribute_value_multi.split(",");
                $.each(v.attribute_value_multi, function (index, opt) {
                    options += '<input name="attr_value_radio[' + i + '][]" class="inputCheckBox" type="radio" is_required="' + is_required + '" value="' + index + '"> ' + opt + ' ';
                });
                $('#attrName').append('<div  class="divAttrValue divCheckBox"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_radio" /><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_radio" /><input type="hidden" value="' + i + '" name="attr_ids_radio[]" />' + options + '</div>');
            }
        }

        if (v.attribute_type.name == 'Multi-Select') {

            if (typeof v.attribute_name != 'undefined') {
                var options = '';
//                var obj = v.attribute_value_multi.split(",");
                $.each(v.attribute_value_multi, function (index, opt) {
                    options += '<input class="inputCheckBox" is_required="' + is_required + '" name="attr_value_multi[' + i + '][]" type="checkbox" value="' + index + '"> ' + opt + ' ';
                });

                $('#attrName').append('<div class="divAttrValue divCheckBox"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_multi" /><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_multi" /><input type="hidden" value="' + i + '" name="attr_ids_multi[]" />' + options + '</div>');
            }
        }



        if (v.attribute_type.name == 'textarea') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><textarea class="attr_value form-control textRequired textsize" is_required="' + is_required + '" is_numlength="' + is_numberlength + '" name="attr_value[]" ></textarea></div>');
            }
        }

//        if (v.attribute_type.name == 'calendar') {
//
//
//            if (typeof v.attribute_name != 'undefined') {
//
//                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><input type="text" name="attr_value[]" class="attr_value form-control datepicker textRequired" style="width: 24%;" id="datepicker"  placeholder="Click here to select"></div>');
//            }
//        }

        if (v.attribute_type.name == 'Color') {


            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group my-colorpicker2 colorpicker-element textRequired" is_required="' + is_required + '" style="width: 24%;"><input type="text" name="attr_value[]" placeholder="Select Colour" class="attr_value form-control" ><div class="input-group-addon" style="width: 21%;"><i></i></div></div></div>');
                $('.my-colorpicker2').colorpicker().on('changeColor', function (ev) {
                    $(this).val(ev.color.toHex());
                });
            }
        }

//        if (v.attribute_type.name == 'Time') {
//
//
//            if (typeof v.attribute_name != 'undefined') {
//
//                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group bootstrap-timepicker" style="width: 24%;"><input type="text" name="attr_value[]" class="timepicker attr_value form-control textRequired" ><div class="input-group-addon" style="width: 21%;"><i class="fa fa-clock-o"></i></div></div></div>');
//                $(".timepicker").timepicker({
//                    showInputs: false
//                });
//            }
//        }

//        if (v.attribute_type.name == 'Date-Time') {
//
//            if (typeof v.attribute_name != 'undefined') {
//
//                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><div class="input-group DateTimeClass" style="width: 24%;"><input type="text" name="attr_value[]" class="datetimepicker2 attr_value form-control textRequired" ><div class="input-group-addon" style="width: 21%;"><i class="fa fa-clock-o"></i></div></div></div>');
//                $('.datetimepicker2').datetimepicker();
//            }
//        }

        if (v.attribute_type.name == 'File') {

            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_file[]" /><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_file[]" /><input type="hidden" value="' + i + '" name="attr_ids_file[]" /><input type="file" value="" class="attr_value textRequired" is_required="' + is_required + '" style="width: 24%;" name="attr_value_file[]" /></div>');
            }
        }

        if (v.attribute_type.name == 'Video') {

            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_video[]" /><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_video[]" /><input type="hidden" value="' + i + '" name="attr_ids_video[]" /><input type="file" value="" class="attr_value_video attr_value textRequired videotypetxt" is_required="' + is_required + '" style="width: 24%;" name="attr_value_video[]" /></div>');
            }
        }

        if (v.attribute_type.name == 'Image-Gallery') {

            if (typeof v.attribute_name != 'undefined') {

                $('#attrName').append('<div class="divAttrValue"><label>' + v.attribute_name + '</label><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name_image" /><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id_image" /><input type="hidden" value="' + i + '" name="attr_ids_image[]" /><div class="input_repeat"><input type="file" value="" class="attr_value textRequired image_field cloneId_' + i + '" is_required="' + is_required + '" style="width: 24%;margin-bottom:5px;" name="attr_value_image[' + i + '][]" /></div><span class="btn btn-default"><a forCloneLink="' + i + '" href="javascript:void(0)" onclick="add_imageGallery(this)">Add more image</a></span></div>');
            }
        }


//        if (v.attribute_type == 'text') {
//
//            if (typeof v.attribute_name != 'undefined' && i != 'attribute_type') {
//
//                $('#attrName').append('<div><input checked onclick="return false" type="checkbox" value="' + i + '" name="attr_ids[]" /> ' + v.attribute_name + '</div>');
//            }
//        }
    });
//    $('#attribute_id').val(strAttrIds);

}



$(document).on('change', '#stateid', function () {

    var stateid = $(this).val();

    //Ajax for subregions list
    $.ajax({
        url: root_url + '/admin/classifieds/allstates',
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

//                $('#sub_categories').val(response.categories);
            }
        }

    });

});


$("#ckbCheckAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});

$(document).on('change', '.checkBoxClass', function () {

    if ($(this).not(":checked")) {
        $('#ckbCheckAll').prop('checked', false);
    }
});

$(document).on('change', '#categoriesmulti', function (e) {

    var thisObj = $(this);
    var status = $(this).val();
    var parent_id = $('#parent_id').val();
    var viewname = $(this).attr('viewname');

    var checkedId = [];
    $('.checkBoxClass').each(function (index, data) {
        if ($(this).is(":checked")) {

            checkedId.push($(this).val());
        }
    });
    if (checkedId.length > 0) {

        if (!confirm("Are you sure change the status?")) {
            $(thisObj).val('');
            return false;
        } else {
            $.ajax({
                url: root_url + '/admin/' + viewname + '/multi_check_options',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "checkedId": checkedId,
                    "status": status,
                    "parent_id": parent_id
                },
                //dataType: "html",
                method: "GET",
                cache: false,
                success: function (response) {
                    if (response.status) {
                        window.location.href = root_url + '/admin/' + response.url;
                    }
                }
            });
        }
    } else {
        alert('Please select atleast one checkbox.');
        $(thisObj).val('');
    }
});


//$('#start_date').datepicker().on("input change", function (e) {
//    if ($('.featured_classified').is(":checked"))
//    {
//
//        var day = parseInt(Feacture_Classified_Day);
//
//    } else
//    {
//        //var day = 60;
//        var day = parseInt(Unfeacture_Classified_Day);
//    }
//
//    var date2 = $('#start_date').datepicker('getDate');
//    var rMax = new Date(date2.getFullYear(), date2.getMonth(), date2.getDate() + day);
//    //alert(rMax);
////    $('#end_date').datepicker('setDate', rMax);
//    var strDateTime = (rMax.getMonth() + 1) + "/" + rMax.getDate() + "/" + rMax.getFullYear();
//    
//    if (strDateTime != 'NaN/NaN/NaN') {
//        $('#end_date').val(strDateTime);
//    } else {
//        $('#end_date').val('');
//    }
//
//});

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


$("#end_date").prop('readonly', true);
$(document).on('change', '.featured_classified', function () {


    $('#end_date').val('');
    $('#start_date').val('');

});

$(document).on('click', '.input_repeat i', function () {
    $(this).parent('.input_repeat').remove();
});

$(document).on('click', '.liImageGallery i', function () {

    var objThis = $(this);
    if (!confirm("Are you sure?")) {
        return false;
    } else {
        var classified_id = $(this).attr('classi_id');
        var file_name = $(this).attr('file_name');
        $.ajax({
            url: root_url + '/admin/classifieds/delete-image-gallery',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "classified_id": classified_id,
                "file_name": file_name,
            },
            //dataType: "html",
            method: "POST",
            cache: true,
            success: function (response) {
                if (response.status) {
                    objThis.parent('.liImageGallery').remove();
                }
            }
        });
    }
});


$(document).on('change', '.classForOnChange', function () {
    var thisObj = $(this);
    var attributeid = $(this).attr('attributeid');
    var attributeValueid = $(this).val();
    $('.childValueDiv_' + attributeid).remove();

    $.ajax({
        url: root_url + '/admin/attributes/allchildattributes',
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
                    var is_required = valueMain[0].required;
                    $.each(valueMain, function (index, value) {
                        options += "<option value='" + value.id + "'>" + value.attribute_value + "</option>";

                    });
                    var html = "<div class='divAttrValue childValueDiv_" + attributeid + "'><label>" + valueMain[0].display_name + "</label><input type='hidden' value='Drop-Down' name='attr_type_name[]'><input type='hidden' value='4' name='attr_type_id[]'><input type='hidden' value='" + valueMain[0].attribute_value_id + "' name='parent_value_id[]'><input type='hidden' value='" + attributeid + "' name='parent_attribute_id[]'><input type='hidden' value='" + valueMain[0].attribute_id + "' name='attr_ids[]'><select attributeid='56' class='attr_value form-control textRequired' is_required='" + is_required + "' name='attr_value[]'>" + options + "</select></div>";
                    $(thisObj).parent().after(html);

                });
            }
        }
    });
});


$(".getChildCat").on("change", function () {
    var p_categoryid = $(this).val();
    $.ajax({
        url: root_url + '/admin/categories/allcategories',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": p_categoryid,
            class_type: 'is_sellable',
        },
        //dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            if (response.status) {

                $(".getClassifiedList").html('');
                $(".getClassifiedList").append($('<option></option>').val('').html('Select Subcategory'));

                $(".classified_id").html('');
                $(".classified_id").append($('<option></option>').val('').html('Select Products'));

                $.each(response.categories, function (key, value) {
                    
                    $(".getClassifiedList").append($('<option></option>').val(key).html(value));
                });
            }
        }

    });

});

$(".getClassifiedList").on("change", function () {
    var categoryid = $(this).val();
    $.ajax({
        url: root_url + '/admin/classifieds/allclassified',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": categoryid
        },
        //dataType: "html",
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {

                $(".classified_id").html('');
                $(".classified_id").append($('<option></option>').val('').html('Select Product'));

                $.each(response.results, function (key, value) {

                    $(".classified_id").append($('<option></option>').val(key).html(value));
                });
            }
        }

    });

});


