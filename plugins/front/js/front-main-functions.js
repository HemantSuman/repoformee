//Front End JS

// $.ajaxSetup({
//        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
//    });

//Registration Form Submit
$(document).on('submit', '#registration-form', function (event) {
    event.preventDefault();
    $('.load-icon').removeClass("hide");
    $(".hidesubmit").hide();

    $.ajax({
        url: $(this).attr("action"),
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "fname": $("#u-rg-fn").val(),
            "lname": $("#u-rg-ln").val(),
            "email": $("#u-rg-em").val(),
            "password": $("#u-rg-ps").val(),
            "cpassword": $("#u-rg-cps").val()
        },
        dataType: "json",
        method: "POST",
        cache: false,
        success: function (response) {
            $('.load-icon').addClass('hide');

            if (response.status) {
                $('#register-modal').modal('hide');
                Notify.showMessage(response.message, 'done');
                $("#registration-form")[0].reset();
                $("label.error").text("");
            } else {
                $(".hidesubmit").show();
                Notify.showMessage(response.message, 'warning');
            }
        },
        error: function (data) {
            $(".hidesubmit").show();
            $('.load-icon').addClass('hide');
            var jsonData = $.parseJSON(data.responseText);
            $("label.error").text("");
            if (jsonData.fname != '') {
                $('#fname-error').text(jsonData.fname);
                //Notify.showMessage(jsonData.fname, 'warning');
            }
            if (jsonData.lname != '') {
                $('#lname-error').text(jsonData.lname);
            }
            if (jsonData.email != '') {
                $('#email-error').text(jsonData.email);
            }
            if (jsonData.password != '') {
                $('#password-error').text(jsonData.password);
            }
            if (jsonData.cpassword != '') {
                $('#cpassword-error').text(jsonData.cpassword);
            }
        }

    });
});



//Forgot Password Form Submit Event
$(document).on('submit', '#user-forgot-password-form', function (event) {
    event.preventDefault();
    $('.u-fp-load-icon').removeClass("hide");
    $("label.error").text("");
    $.ajax({
        url: $(this).attr("action"),
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "email": $("#u-fp-em").val()
        },
        dataType: "json",
        method: "POST",
        cache: false,
        success: function (response) {
            $('.u-fp-load-icon').addClass('hide');
            if (response.status) {
                Notify.showMessage(response.message, 'done');
                $("#user-forgot-password-form")[0].reset();
                $("label.error").text("");
            } else {
                Notify.showMessage(response.message, 'warning');
            }
        },
        error: function (data) {
            $('.u-fp-load-icon').addClass('hide');
            var jsonData = $.parseJSON(data.responseText);
            if (jsonData.email != '') {
                $('#fp-email-error').text(jsonData.email);
            }
        }
    });
});


$("#GetPrayerTimingForm").validate({
    rules: {
        method: "required"
    },
    errorPlacement: function (error, element) {
        element.css("border", "1px solid red");
    },
    submitHandler: function (form) {
        return true;
    }
});
$(document).on('change', '#pt-country', function () {
    if ($(this).val() != '') {
        $("#pt-state").rules("add", "required");
        $("#pt-suburb").rules("add", "required");
    } else {
        console.log("pp");
        $("#pt-state").rules("remove", "required");
        $("#pt-suburb").rules("remove", "required");
        $('#pt-state, #pt-suburb').css("border", "1px solid #ccc");
    }
});
$("#pt-sdate").datepicker({
}).on('change', function (selected) {
    if ($(this).val() != '') {
        $("#pt-edate").rules("add", "required");
    } else {
        $("#pt-edate").rules("remove", "required");
        $('#pt-edate').css("border", "1px solid #ccc");
    }
});

$("#MosqueSearchForm").validate({
    rules: {
        //state: "required",
        //  suburb: "required"
    },
    errorPlacement: function (error, element) {
        //element.css("border", "1px solid red");
        error.insertAfter(element);
    },
    submitHandler: function (form) {
        return true;
    }
});

//ajax for newsletter subscription
$(document).on('submit', '#ns-sb-frm', function (event) {
    event.preventDefault();
    $('.ns-load-icon').removeClass("hide");
    $.ajax({
        url: $(this).attr("action"),
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "email": $("#ns-sb-em").val()
        },
        dataType: "json",
        method: "POST",
        cache: false,
        success: function (response) {
            $('.ns-load-icon').addClass('hide');
            if (response.status) {
                Notify.showMessage(response.message, 'done');
                $("#ns-sb-frm")[0].reset();
                $("label.error").text("");
            } else {
                Notify.showMessage(response.message, 'warning');
            }
        },
        error: function (data) {
            $('.ns-load-icon').addClass('hide');
            var jsonData = $.parseJSON(data.responseText);
            if (jsonData.email != '') {
                $('#ns-email-error').text(jsonData.email);
            }
        }
    });
});

//ajax for Login  
$(document).on('submit', '#loginFrom', function (event) {
    event.preventDefault();
    $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize(),
        dataType: "json",
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {
                location.reload();
            } else {
                Notify.showMessage(response.msg, 'warning');
            }
        },
        error: function (data) {
            $('.errorMsg').remove();
            $.each($.parseJSON(data.responseText), function (key, value) {
                Notify.showMessage(value, 'warning');
            });
        }
    });
});

$(document).on('click', '.header-search-category li', function (event) {
    $("#cat_id").val($(this).attr("data-id"));
    event.stopPropagation()
});
//for pagination
$(document).on('click', '.searchlist li a', function (event) {
    event.preventDefault();
    // console.log($(this).text())
    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);
    //console.log("hello1");

    $.ajax({
        url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);

            $('.car-search-listing').html(response);
            // alert("hello");
            // $('#headerLocationSearchLat').val('');

            //   $('.searchboxresult').html(response);
            // alert("hello");
            // $('#headerLocationSearchLat').val('');

            //$('#headerLocationSearchLong').val('');

        },
        error: function (data) {
            //            $('.errorMsg').remove();
            //            $.each($.parseJSON(data.responseText), function (key, value) {
            //                Notify.showMessage(key, 'Please enter ' + key);
            //            });
        }
    });
    event.stopPropagation()
});
//function dynamicattribusteslist(cat_id)
//{
////    var city = $('#headerLocationSearchBox').val();
////    var itemname = $('#project').val();
////    var km = $('#km').val();
////    var lat = $('#headerLocationSearchLat').val();
////    var lag = $('#headerLocationSearchLong').val();
////    var catname = $this.find("label span").first().text();
////    // alert(catname);
////    $('#cat_ids').val(cat_id);
////    $('#citys').val(city);
////    $('#itemnames').val(itemname);
////    $('#kms').val(km);
////    $('#lats').val(lat);
////    $('#lngs').val(lag);
////    //  $('#cat_name').val(catname);
////    $('.categoryheading').html(catname);
//     $.ajax({
//        url: root_url + "/classified-dynamicattribute",
//        //data: $(".usr-prfl-updt-adrs").serialize(),
//       dataType: "html",
//        method: "GET",
//        cache: false,
//        success: function (response) {
//            $('.dyanamicattr').html(response);
//        }
//    });
// 
//}
$(document).on('click', '.filtercategory', function (event) {

    event.preventDefault();
    //$(".load").removeClass("hide");
    // console.log($this.find("a").text();)
    var $this = $(this);
    $('#tree1 li').removeClass('active');
    $this.addClass('active');
    // alert($this.attr("value"));
    //var cat_id = $('#cat_id').val();
    var cat_id = $this.attr("value");
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();
    var catname = $this.find("label span").first().text();
    // alert(catname);
    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);
    //  $('#cat_name').val(catname);
    // $('.categoryheading').html(catname);
    //console.log("hello1");
    $('.categoryheading').html('');
    $('.car-search-listing').html('');
    $(".searchprocess").removeClass("hide");
//    var $container = $('.car-search-listing'),
//            $noRemove = $container.find('.searchprocess');
//    $container.html($noRemove);
    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        //dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //  console.log(response);
            $(".searchprocess").addClass("hide");
            $('.car-search-listing').html(response);
            $('.categoryheading').html(catname);
            // $('.categoryheading').html($('#categoryheading').val());
        },
        error: function (data) {

        }
    });

    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: root_url + "/classified-dynamicattribute",
        data: $("#searchlistform").serialize(),
        // dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            // console.log(response);
            //  $("#tree1 li:nth-child(2)").nextAll().remove();
            //  $(".load").addClass("hide");
            $('#tree2').html(response);
            //$('#tree1').removeClass("tree");

            $('#tree2').treed({openedClass: 'fa fa-caret-down', closedClass: 'fa fa-caret-right'});

            /*initialize wickedpicker*/
            $('.timepicker').wickedpicker({twentyFour: true});
            $(".datepicker").datepicker();
            // $('#tree1').removetreed() //remove
            // $('#tree1').removeClass("tree");



            // $('.categoryheading').html($('#categoryheading').val());
        },
        error: function (data) {

        }
    });
    event.stopPropagation()
});
$(document).on('click', '.filterstate', function (event) {
    event.preventDefault();

    // console.log($(this).text())
    var $this = $(this);
    $('.place li').removeClass('active');
    $this.addClass('active');
    // alert($this.attr("value"));
    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();
    var stateid = $this.attr("value");

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);
    $('#states').val(stateid);
    //console.log("hello1");

    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);

            $('.car-search-listing').html(response);

        },
        error: function (data) {

        }
    });
    event.stopPropagation()
});

$(document).on('click', '.filtercity', function (event) {
    event.preventDefault();

    // console.log($(this).text())
    var $this = $(this);
    $('.place li').removeClass('active');
    $this.addClass('active');
    // alert($this.attr("value"));
    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();
    var city_id = $this.attr("value");

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);
    $('#cities').val(city_id);
    //console.log("hello1");

    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);

            $('.car-search-listing').html(response);

        },
        error: function (data) {

        }
    });
    event.stopPropagation()
});
//$('select').trigger('change.select2')

//$('#select-options-2').select2().on('change', function() {
$(document).on('change', '#select-options-23', function () {
    var order = $(this).val();
    //alert(order);
    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);
    $('#orders').val(order);
    //console.log("hello1");

    $.ajax({
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);
            $('.car-search-listing').html(response);
            // alert("hello");
            // $('#headerLocationSearchLat').val('');
            //$('#headerLocationSearchLong').val('');

        },
        error: function (data) {
            //            $('.errorMsg').remove();
            //            $.each($.parseJSON(data.responseText), function (key, value) {
            //                Notify.showMessage(key, 'Please enter ' + key);
            //            });
        }
    });
    event.stopPropagation()
});

$(".textattr").keyup(function () {
    //alert($(this).val());
    var attr_filter_id = $(this).attr('attr_filter_id');

    var shoeArray = {}; // note this
    shoeArray[attr_filter_id] = [$(this).val()];

    console.log($(this).val());
    //alert("here");

    var myJsonString = JSON.stringify(shoeArray);
    var classified_filter_id = myJsonString;
    $('.attr_' + attr_filter_id).val(classified_filter_id);
})


$(document).on('change', '.filterdrop', function (event) {
    event.preventDefault();
    //var $this = $(this).attr("option:selected");
    var $selectedval = $(this).find('option:selected').val();
    var attr_filter_id = $('option:selected', this).attr('attr_filter_id');
    var attr_filter_id1 = $('option:selected', this).attr('attr_filter_id1');
    var classified_filter_id = $('option:selected', this).attr('classified_filter_id');
    console.log(attr_filter_id, classified_filter_id);
    console.log(attr_filter_id1);
    // console.log(classified_filter_id.length());
    if ((attr_filter_id) && !(classified_filter_id))
    {
        var shoeArray = {}; // note this
        shoeArray[attr_filter_id] = [0];

        //console.log(shoeArray);
        //alert("here");
        var myJsonString = JSON.stringify(shoeArray);
        var classified_filter_id = myJsonString;
        //$('.attr_' + attr_filter_id).val(classified_filter_id);
    }
    if ((attr_filter_id1))
    {
        //alert("hello");
//      var shoeArray = {}; // note this
//        shoeArray[attr_filter_id1] =[''] ;
//        
//        //console.log(shoeArray);
//        //alert("here");
//        var myJsonString = JSON.stringify(shoeArray);
//        var classified_filter_id =myJsonString;
        $('.attr_' + attr_filter_id1).val('');
    }
    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();
    var dropdownid = $selectedval;

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);
    $('#dropdowns').val(dropdownid);
    $('.attr_' + attr_filter_id).val(classified_filter_id);

    //console.log("hello1");

    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);

            $('.car-search-listing').html(response);

        },
        error: function (data) {

        }
    });
    event.stopPropagation()
});

$(document).on('change', '.filterchkbox', function (event) {

    var attr_filter_id = $(this).attr('attr_filter_id');
    var checkedId = [];
    var classified_filter_id = [];
    $('.dyCheckBox_' + attr_filter_id).each(function (index, data) {
        if ($(this).is(":checked")) {
            classified_filter_id.push($(this).attr('classified_filter_id'));
        }
    });
//    $('.filterchkbox').each(function (index, data) {
//        if ($(this).is(":checked")) {
//            checkedId.push($(this).val());
//        } else {
//            for (var i = 0; i < checkedId.length; i++)
//                if (checkedId[i] === $(this).val())
//                    delete checkedId[i];
//        }
//    });
    //alert(checkedId);
    var $checkedid = checkedId;
    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();
    var checkedid = $checkedid;

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);
    $('#checkboxs').val($checkedid);
//    console.log(classified_filter_id.length);

    var newmultiHiddenVal = [];
    if (classified_filter_id.length > 0) {
        $.each(classified_filter_id, function (i, v) {
            if (v != '') {
                var jsonStr = $.parseJSON('[' + v + ']');
//        console.log(jsonStr[0]);
                $.each(jsonStr[0], function (i1, v1) {
//            console.log(i1, v1);
                    newmultiHiddenVal.push(v1);
                });
            }

        });
    }
//    console.log(newmultiHiddenVal, newmultiHiddenVal.length);
    if (newmultiHiddenVal.length > 0) {
        var result1 = newmultiHiddenVal.shift().filter(function (v) {
            return newmultiHiddenVal.every(function (a) {
                return a.indexOf(v) !== -1;
            });
        });
    } else {
        var result1 = [];
    }
    var result2 = {};
    result2[attr_filter_id] = result1;
//    console.log(result2);
//    console.log(JSON.stringify(result2));
    $('.attr_' + attr_filter_id).val(JSON.stringify(result2));
    //console.log("hello1");

    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);

            $('.car-search-listing').html(response);

        },
        error: function (data) {

        }
    });

    event.stopPropagation()
});

$(document).on('change', '.filterradio', function (event) {
    event.preventDefault();
    //var $this = $(this).attr("option:selected");
    var $selectedradio = $(this).find('checked:checked').val();
    var attr_filter_id = $(this).attr('attr_filter_id');

    var classified_filter_id = $(this).attr('classified_filter_id');
    console.log(classified_filter_id);
    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();
    var radioid = $selectedradio;

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);
    $('#radios').val(radioid);
    $('.attr_' + attr_filter_id).val(classified_filter_id);
    //console.log("hello1");

    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);

            $('.car-search-listing').html(response);

        },
        error: function (data) {

        }
    });
    event.stopPropagation()
});

$(document).on('click', '.numericfilter', function (event) {
    event.preventDefault();
    var $range = $(this).prev().attr('classified_json_input');
    var attr_filter_id = $(this).prev().attr('attr_filter_id');
    var givenval = parseInt($(this).prev().val());
    var newnumericval = [];
    if ($range.length > 0) {
        var jsonStr = $.parseJSON('[' + $range + ']');
        // console.log(jsonStr[0]);
        $.each(jsonStr[0], function (i, v) {
            $.each(v, function (i1, v1) {
                var valNew = i1.split(';');
                if (givenval > parseInt(valNew[0]) && givenval < parseInt(valNew[1]))
                {
                    newnumericval.push(v1[0]);

                }

            });

        });
        console.log(newnumericval);

        var result2 = {};
        result2[attr_filter_id] = newnumericval;
        $('.attr_' + attr_filter_id).val(JSON.stringify(result2));
        //console.log(result2);
    }
    var attr_filter_id = $(this).attr('attr_filter_id');

    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();
    // var radioid = $selectedradio;

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);
    //   $('.attr_' + attr_filter_id).val(newnumericval);


    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);

            $('.car-search-listing').html(response);

        },
        error: function (data) {

        }
    });
    event.stopPropagation()
});

$(document).on('click', '.datefilter', function (event) {
    event.preventDefault();
    var $range = $(this).prev().attr('classified_json_input');
    var attr_filter_id = $(this).prev().attr('attr_filter_id');
    var givenval = Date.parse($(this).prev().val());
    var newnumericval = [];
    if ($range.length > 0) {
        var jsonStr = $.parseJSON('[' + $range + ']');
        console.log(jsonStr[0]);
        console.log(givenval);
        $.each(jsonStr[0], function (i, v) {
            $.each(v, function (i1, v1) {
                var valNew = i1.split(';');
                var fDate, lDate;
                fDate = Date.parse(valNew[0]);
                lDate = Date.parse(valNew[1]);
                console.log(valNew[0], valNew[1])
                console.log(fDate, lDate)
                if ((givenval <= lDate && givenval >= fDate))
                {
                    newnumericval.push(v1[0]);

                }

            });

        });
        console.log(newnumericval);

        var result2 = {};
        result2[attr_filter_id] = newnumericval;
        $('.attr_' + attr_filter_id).val(JSON.stringify(result2));
        //console.log(result2);
    }
    var attr_filter_id = $(this).attr('attr_filter_id');

    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();
    // var radioid = $selectedradio;

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);

    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);

            $('.car-search-listing').html(response);

        },
        error: function (data) {

        }
    });
    event.stopPropagation()
});

$(document).on('click', '.timefilter', function (event) {
    event.preventDefault();
    var $range = $(this).prev().attr('classified_json_input');

    var attr_filter_id = $(this).prev().attr('attr_filter_id');
    // var givenval = Date.parse($(this).prev().val());
    var givenval = $(this).prev().val();

    var newnumericval = [];
    if ($range.length > 0) {
        var jsonStr = $.parseJSON('[' + $range + ']');
        console.log(jsonStr[0]);
        console.log(givenval);
        $.each(jsonStr[0], function (i, v) {
            $.each(v, function (i1, v1) {
                var valNew = i1.split(';');
                var stime, etime;
                stime = valNew[0];
                etime = valNew[1];
                console.log(valNew[0], valNew[1])

                if ((givenval <= etime && givenval >= stime))
                {
                    newnumericval.push(v1[0]);

                }

            });

        });
        //console.log(newnumericval);

        var result2 = {};
        result2[attr_filter_id] = newnumericval;
        $('.attr_' + attr_filter_id).val(JSON.stringify(result2));
        //console.log(result2);
    }
    var attr_filter_id = $(this).attr('attr_filter_id');

    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();
    // var radioid = $selectedradio;

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);

    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);

            $('.car-search-listing').html(response);

        },
        error: function (data) {

        }
    });
    event.stopPropagation()
});

$(document).on('change', '.filtercalanderdrop', function (event) {
    event.preventDefault();
    //alert('heree');
    //var $this = $(this).attr("option:selected");
    var $selectedval = $(this).find('option:selected').val();
    var attr_filter_id = $('option:selected', this).attr('attr_filter_id');
    var classified_filter_id = $('option:selected', this).attr('classified_filter_id');
    var cat_id = $('#cat_id').val();
    var city = $('#headerLocationSearchBox').val();
    var itemname = $('#project').val();
    var km = $('#km').val();
    var lat = $('#headerLocationSearchLat').val();
    var lag = $('#headerLocationSearchLong').val();
    var dropdownid = $selectedval;

    $('#cat_ids').val(cat_id);
    $('#citys').val(city);
    $('#itemnames').val(itemname);
    $('#kms').val(km);
    $('#lats').val(lat);
    $('#lngs').val(lag);
    $('#dropdowns').val(dropdownid);
    $('.attr_' + attr_filter_id).val(classified_filter_id);

    //console.log("hello1");

    $.ajax({
        //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
        url: $("#searchlistform").attr("action"),
        data: $("#searchlistform").serialize(),
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
            //console.log(data);

            $('.car-search-listing').html(response);

        },
        error: function (data) {

        }
    });
    event.stopPropagation()
});
//ajax for search  

//$(document).on('submit', '#searchFrom', function (event) {
//    event.preventDefault();
//    $.ajax({
//        url: $(this).attr("action"),
//        data: $(this).serialize(),
//        dataType: "html",
//        method: "POST",
//        cache: false,
//        success: function (response) {
//            $('.searchboxresult').html(response);
//           // alert("hello");
//           // $('#headerLocationSearchLat').val('');
//            //$('#headerLocationSearchLong').val('');
//            $('#example').DataTable({
//                "ordering": false,
//                "info": false,
//                "bFilter": false,
//                "bLengthChange": false,
//            })
//        },
//        error: function (data) {
//            //            $('.errorMsg').remove();
//            //            $.each($.parseJSON(data.responseText), function (key, value) {
//            //                Notify.showMessage(key, 'Please enter ' + key);
//            //            });
//        }
//    });
//}
//        );

//$(document).on('submit', '#searchFrom', function (event) {
//    event.preventDefault();
//    $.ajax({
//        url: $(this).attr("action"),
//        data: $(this).serialize(),
//        dataType: "html",
//        method: "POST",
//        cache: false,
//        success: function (response) {
//            $('.searchboxresult').html(response);
//            // alert("hello");
//            // $('#headerLocationSearchLat').val('');
//            //$('#headerLocationSearchLong').val('');
//            $('#example').DataTable({
//                "ordering": false,
//                "info": false,
//                "bFilter": false,
//                "bLengthChange": false,
//            })
//        },
//        error: function (data) {
//            //            $('.errorMsg').remove();
//            //            $.each($.parseJSON(data.responseText), function (key, value) {
//            //                Notify.showMessage(key, 'Please enter ' + key);
//            //            });
//        }
//    });
//}
//);

// User Profile page scripts {SAGAR JAJORIYA}
$(document).on("click", ".usr-updt-adrs-edt-lnk", function () {
    $('html, body').animate({
        'scrollTop': $(".location-update-inner-form").position().top
    });
})

//update email form
$(".usr-prfl-updt-eml").submit(function () {
    $(".eml-updtn-ld-icn").removeClass("hide");
    $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize(),
        method: "POST",
        cache: false,
        success: function (response) {
            $(".eml-updtn-ld-icn").addClass("hide");
            if (response.status) {
                $(".usr-prfl-updt-eml")[0].reset()
                // $("span.usr-prfl-updt-eml-error").text("");
                // $(".curr-reg-email").val(response.new_email)
                $("#usr-prfl-updt-eml .error-message").text("");
                Notify.showMessage(response.message, 'done');
            } else {
                $(".eml-updtn-ld-icn").addClass("hide");
                Notify.showMessage(response.message, 'warning');
            }
        },
        error: function (data) {
            $(".eml-updtn-ld-icn").addClass("hide");
            var jsonData = $.parseJSON(data.responseText);
            $("span.usr-prfl-updt-eml-error").text("");
            if (jsonData.current_email != '') {
                $('#usr-prfl-updt-crnt-eml').text(jsonData.current_email);
            }
            if (jsonData.new_email != '') {
                $('#usr-prfl-updt-new-eml').text(jsonData.new_email);
            }
            if (jsonData.confirm_new_email != '') {
                $('#usr-prfl-updt-cnfrm-eml').text(jsonData.confirm_new_email[0]);
            }
        }
    });
    return false;
});

//update password
$(".usr-prfl-updt-pswrd").submit(function () {
    $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize(),
        method: "POST",
        cache: false,
        success: function (response) {
            //console.log(response.message);
            if (response.status) {
                $(".usr-prfl-updt-pswrd")[0].reset()
                $("span.usr-prfl-updt-pswrd-error").text("");
                Notify.showMessage(response.message, 'done');
            } else {
                $('#usr-prfl-updt-crnt-pswrd').text(response.message);
                if (response.message == "undefined") {
                    Notify.showMessage(response.message, 'warning');
                }
                if (response.message = '') {
                    $('#usr-prfl-updt-crnt-pswrd').text(jsonData.current_password);
                }
            }
        },
        error: function (data) {
            var jsonData = $.parseJSON(data.responseText);
            $("span.usr-prfl-updt-pswrd-error").text("");
//            if (jsonData.current_password != '') {
//                $('#usr-prfl-updt-crnt-pswrd').text(jsonData.current_password);
//            }
            if (jsonData.new_password != '') {
                $('#usr-prfl-updt-new-pswrd').text(jsonData.new_password);
            }
            if (jsonData.confirm_new_password != '') {
                $('#usr-prfl-updt-cnfrm-new-pswrd').text(jsonData.confirm_new_password[0]);
            }
        }
    });
    return false;
});


$(document).on("click", ".usr-prfl-bsc-info-updt-btn", function () {
    if ($(this).attr("action") == "edit") {
        $(".usr-nm-edit-icn, .edit-mbl-no").removeClass("hide");
        $(".profileimgcl").removeClass("hide");
        $(this).text("update");
        $(this).attr("action", "update")
        //$(this).addClass("hide")
    } else {
        var status = true;
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if ($(".usr-prfl-nme-fld").val() == "") {
            Notify.showMessage("Name field can not be left empty.", 'warning');
            status = false;
        }
//        if ($(".usr-prfl-mbl-no-fld").val() == "") {
//            Notify.showMessage("Mobile no field can not be left empty.", 'warning');
//            status = false;
//        } else if (!numberRegex.test($(".usr-prfl-mbl-no-fld").val())) {
//            Notify.showMessage("Invalid number.", 'warning');
//            status = false;
//        }
        if (status) {
            $(".usr-prfl-bsc-info-frm").submit();
        }
    }
})

//edit mobile number
$(document).on("click", ".edit-mbl-no", function () {
    $(this).addClass("hide");
    $(".usr-mble-no").addClass("hide");
    $(".edt-mbl-no-dv").removeClass("hide")
})

$(".usr-prfl-updt-mbl").submit(function () {
    $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize(),
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {
                $(".usr-mble-no, .edit-mbl-no").removeClass("hide");
                $(".edit-mbl-no").html('(Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i>)')
                $(".edt-mbl-no-dv").addClass("hide")
                $(".usr-mble-no").text(response.new_numb)
                Notify.showMessage(response.message, 'done');
            } else {
                Notify.showMessage(response.message, 'warning');
            }
        },
        error: function (data) {
            var jsonData = $.parseJSON(data.responseText);
            if (jsonData.mobile_no != '') {
                Notify.showMessage(jsonData.mobile_no[0], 'warning');
            }
        }
    });
    return false;
})

//email subscription
$(document).on("change", ".eml-sbscrptn-chkbx", function () {
    $.ajax({
        url: $(".usr-prfl-updt-sbscrptn").attr("action"),
        data: $(".usr-prfl-updt-sbscrptn").serialize(),
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {
                Notify.showMessage(response.message, 'done');
            } else {
                Notify.showMessage(response.message, 'warning');
            }
        }
    });
})

//update address form
$(".usr-prfl-updt-adrs").submit(function (event) {
    event.preventDefault();
    return false;
});
$(document).on("click", ".usr-prfl-updt-adrs-btn", function () {
    $.ajax({
        url: root_url + "/user/update-profile",
        data: $(".usr-prfl-updt-adrs").serialize(),
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {
                $(".usr-prfl-tp-adrs").text($(".usr-crnt-loc").val());
                Notify.showMessage(response.message, 'done');

            } else {
                Notify.showMessage(response.message, 'warning');
            }
        }
    });

});
// End User Profile page scripts

// End User Profile page scripts

// add/remove items from wishlist
$(document).on("click", ".add-wishlist-btn", function (event) {
    event.preventDefault();
    var action = '';
    if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        action = 'del';
    } else {
        $(this).addClass("active");
        action = 'add';
    }
    var is_page_reload = $(this).attr("is-page-refresh")
    $.ajax({
        url: root_url + '/edit-wishlist',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "clid": $(this).attr("data-id"),
            "action": action
        },
        method: "POST",
        cache: false,
        success: function (response) {
            if (is_page_reload == 1) {
                location.reload();
            }
        }
    });
})

$(document).on('click', '.deleteRecord', function () {


    if (!confirm("Are you sure?")) {
        return false;
    }
    var thisObj = $(this);
    var id = $(this).attr('classid');

    $.ajax({
        url: root_url + '/user/classifieds/delete',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": id
        },
        //dataType: "html",
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {
                $(thisObj).parents('li').remove();
                //window.location.href = root_url + '/admin' + '/' + response.url + pid_set;
            } else {
                return alert(response.message);

            }
        },
        error: function (response) {
            Notify.showMessage('You Have Not Permission To Perform This Action', 'warning');
            // return alert("You Have Not Permission")
        }

    });
})

$(document).on('click', '.editclassifiedstatus', function (event, state) {

    var classifiedid = $(this).attr('classifiedid');
    //var status = $(this).attr('status');
    //alert(state);
    if ($(this).prop("checked") == true) {
        //alert('here');
        var status = 1;
    } else {
        //alert('there');
        var status = 0;
    }
    $.ajax({
        type: "POST",
        url: root_url + '/user/classifieds/changestatus',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": classifiedid,
            "state": status
        },
        success: function (response) {

        }
    })

});

//$(document).on('switchChange.bootstrapSwitch', function(event, state) {
//        var classifiedid = $(this).attr('classifiedid');
//        alert(classifiedid);
//        $.ajax({
//            type: "POST",
//            url: root_url + '/admin/feeds/admin_update_feed_home_status',
//            data: {
//                "_token": $('meta[name="csrf-token"]').attr('content'),
//                "id": id,
//                "state": state
//            },
//            success: function (response) {
//            
//            }
//        })
//    });
