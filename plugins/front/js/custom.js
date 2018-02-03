
$(function () {

    get_sensis_search('Melton South, Victoria, Australia');

    $('#foodProductName').autocomplete();

    //Registration Form Submit
    $(document).on('submit', '#registration-form', function (event) {
        event.preventDefault();
        $(".user-reg-prcs-dv").removeClass("hide");
        $("label.error").text("")
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            dataType: "json",
            method: "POST",
            cache: false,
            success: function (response) {
                if (response.status) {
                    $(".user-reg-prcs-dv").addClass("hide");
                    $("#register-modal").modal("hide")
                    Notify.showNotification(response.message, "success")
                    $("#registration-form")[0].reset();
                } else {
                    Notify.showNotification(response.message, "error")
                    $(".user-reg-prcs-dv").addClass("hide");
                }
            },
            error: function (data) {
                $.each($.parseJSON(data.responseText), function (key, value) {
                    $("#registration-form").find("." + key).next("label.error").text(value)
                });
                $(".user-reg-prcs-dv").addClass("hide");
            }

        });
    });

    //ajax for Login  
    $(document).on('submit', '#login-form', function (event) {
        event.preventDefault();
        $(".user-login-prcs-dv").removeClass("hide");
        $("label.error").text("")
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            dataType: "json",
            method: "POST",
            cache: false,
            success: function (response) {
                $(".user-login-prcs-dv").addClass("hide");
                if (response.status) {
                    location.href = root_url + '/user/dashboard';
//                    location.reload();
                } else {
                    Notify.showNotification(response.msg, "error")
                    $(".user-login-prcs-dv").addClass("hide");
                }
            },
            error: function (data) {
                // $.each($.parseJSON(data.responseText), function (key, value) {
                //     Notify.showMessage(value, 'warning');
                // });
                $.each($.parseJSON(data.responseText), function (key, value) {
                    $("#login-form").find("." + key).next("label.error").text(value)
                });
                $(".user-login-prcs-dv").addClass("hide");
            }
        });
    });

    //update email form
    $("#update-email-form").submit(function (e) {
        $("#update-email-form div.loading-div").removeClass("hide");
        $("#update-email-form label.error").text("")
        e.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "POST",
            cache: false,
            success: function (response) {
                $("#update-email-form div.loading-div").addClass("hide");
                if (response.status) {
                    Notify.showNotification(response.message, "success")
                    $("#update-email-form label.error").text("")
                    $("#update-email-form")[0].reset();
                    //$("#update-email-form .current_email").val(response.new_email);
                } else {
                    Notify.showNotification(response.message, "error")
                }
            },
            error: function (data) {
                $("#update-email-form div.loading-div").addClass("hide");
                $.each($.parseJSON(data.responseText), function (key, value) {
                    $("#update-email-form").find("." + key).next("label.error").text(value)
                });
            }
        });
        //return false;
    });


    //update name form
    $("#update-name-form").submit(function (e) {
        $("#update-name-form div.loading-div").removeClass("hide");
        $("#update-name-form label.error").text("")
        e.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "POST",
            cache: false,
            success: function (response) {
                $("#update-name-form div.loading-div").addClass("hide");
                if (response.status) {
                    Notify.showNotification(response.message, "success")
                    $("#update-name-form label.error").text("")
                    $("#update-name-form")[0].reset();
                    $("#update-name-form .user-fname").val(response.fname);
                    $("#update-name-form .user-lname").val(response.lname);
                } else {
                    Notify.showNotification(response.message, "error")
                }
            },
            error: function (data) {
                $("#update-name-form div.loading-div").addClass("hide");
                $.each($.parseJSON(data.responseText), function (key, value) {
                    $("#update-name-form").find("." + key).next("label.error").text(value)
                });
            }
        });
        //return false;
    });


    //update password
    $("#update-password-form").submit(function (e) {
        $("#update-password-form div.loading-div").removeClass("hide");
        $("#update-password-form label.error").text("")
        e.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            method: "POST",
            cache: false,
            success: function (response) {
                //console.log(response.message);
                $("#update-password-form div.loading-div").addClass("hide");
                if (response.status) {
                    $("#update-password-form")[0].reset()
                    Notify.showNotification(response.message, 'success');
                    $("#update-password-form label.error").text("")
                } else {
                    Notify.showNotification(response.message, "error")
                }
            },
            error: function (data) {
                $("#update-password-form div.loading-div").addClass("hide");
                $.each($.parseJSON(data.responseText), function (key, value) {
                    $("#update-password-form").find("." + key).next("label.error").text(value)
                });
            }
        });
    });

    //email subscription
    $(document).on("change", ".subscription-checkbox", function () {
        $.ajax({
            url: $("#update-subscription-form").attr("action"),
            data: $("#update-subscription-form").serialize(),
            method: "POST",
            cache: false,
            success: function (response) {
                if (response.status) {
                    Notify.showNotification(response.message, 'success');
                } else {
                    Notify.showNotification(response.message, 'error');
                }
            }
        });
    })

    $(document).on("change", ".chng-prfl-pic-btn", function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $(".usr-prfl-img-prvw");
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                console.log(file[0].size);
                if (!regex.test(file[0].name.toLowerCase())) {
                    $(this).val('');
                    Notify.showNotification("Image must have an extension of .jpeg, .jpg, or .png", 'error');

                }

//                    else {
//	            	$("#update-profile-img-form").submit();
//	            }

                else if ((file[0].size > (1024 * 1024 * 5))) {
                    console.log('here');
                    // $(this).val('');
                    Notify.showNotification("The image size can not exceed 5MB", 'error');
                } else {
                    $("#update-profile-img-form").submit();
                }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    })

    //update password
    $("#update-address-form").submit(function (event) {
        event.preventDefault();
        return false;
    });
    $(document).on("click", ".update-address-submit-btn", function () {
        //$("#update-address-form").submit(function (e) {
        $("#update-address-form div.loading-div").removeClass("hide");
        $("#update-address-form label.error").text("")
        $.ajax({
            url: $("#update-address-form").attr("action"),
            data: $("#update-address-form").serialize(),
            method: "POST",
            cache: false,
            success: function (response) {
                //console.log(response.message);
                $("#update-address-form div.loading-div").addClass("hide");
                if (response.status) {
                    Notify.showNotification(response.message, 'success');
                    $("#update-address-form label.error").text("")
                    setTimeout(function () {
                        location.reload(1);
                    }, 3000);

                } else {
                    Notify.showNotification(response.message, "error")
                }

            },
            error: function (data) {
                $("#update-address-form div.loading-div").addClass("hide");
                $.each($.parseJSON(data.responseText), function (key, value) {
                    if (key == "location") {
                        $("#update-address-form").find(".user-current-location").next("label.error").text(value)
                    } else {
                        $("#update-address-form").find("." + key).next("label.error").text(value)
                    }
                });
            }
        });
    });


    $(document).on("click", ".wishlist-icon", function (e) {
        var action = '';
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).find("i").removeClass("fa-heart").addClass("fa-heart-o");
            action = 'del';
        } else {
            $(this).addClass("active");
            $(this).find("i").removeClass("fa-heart-o").addClass("fa-heart");
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

    $(document).on("click", ".add-wishlist-cart", function (e) {
        var action = '';
        action = 'add';
        var is_page_reload = 1;
        if (confirm("Are you sure you want to move this product into your wishlist?")) {
            $.ajax({
                url: root_url + '/edit-wishlist-cart',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "clid": $(this).attr("data-id"),
                    "action": action
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    if (is_page_reload == 1) {
                        Notify.showNotification(response.message, 'success');
                        location.reload();
                    }
                }
            });
        } else {
            return false;
        }
    })


    $(document).on("click", ".proceed-checkout", function (e) {


        $.ajax({
            url: root_url + '/chk-cart-items',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                // "clid": $(this).attr("data-id"),
                // "action": action
            },
            method: "POST",
            cache: false,
            success: function (response) {
                //alert(response);
                if (response.toString() == 'paypal') {
                    url = root_url + '/user/checkout_1';
                    window.location.href = url;
                } else {
                    if (response.toString() == 'picknpay') {
                        url = root_url + '/user/picknpay_1';
                        window.location.href = url;
                    } else {
                        $(".product-added-info").show();
                        $(".product-added-info").html(response);
                        return false;
                    }
                }
            }
        });

    })


    $(document).on("submit", ".report-classified-form", function (eve) {
        eve.preventDefault();
        $(".report-reason").css("border", "1px solid #ccc")
        if (!$(".report-reason").val()) {
            $(".report-reason").css("border", "1px solid red")
        } else {
            $.ajax({
                url: $(".report-classified-form").attr("action"),
                data: $(".report-classified-form").serialize(),
                method: "POST",
                cache: false,
                success: function (response) {
                    if (response.status) {
                        $(".report-li-drpdwn").removeClass("open");
                        $(".report-classified-form")[0].reset()
                        Notify.showNotification(response.message, 'success');
                    } else {
                        Notify.showNotification(response.message, 'error');
                    }
                }
            });
        }
    })

    //ajax for newsletter subscription
    $(document).on('submit', '#ns-sb-frm', function (event) {
        event.preventDefault();
        $("label.error").text("");
        $('.ns-processing-block').removeClass("hide");
        $.ajax({
            url: $(this).attr("action"),
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "email": $("#newsletter_mail").val()
            },
            dataType: "json",
            method: "POST",
            cache: false,
            success: function (response) {
                $('.ns-processing-block').addClass("hide");
                if (response.status) {
                    Notify.showNotification(response.message, 'success');
                    $("#ns-sb-frm")[0].reset();
                    $("label.error").text("");
                } else {
                    Notify.showNotification(response.message, 'error');
                }
            },
            error: function (data) {
                $('.ns-processing-block').addClass("hide");
                var jsonData = $.parseJSON(data.responseText);
                if (jsonData.email != '') {
                    Notify.showNotification(jsonData.email, 'error');
                    //$("#ns-email-error label.error").text(jsonData.email)
                }
            }
        });
    });
    $(document).on('click', '.header-search-category li', function (event) {
        $("#header_cat_id").val($(this).attr("data-id"));
        $("#header_cat_name").val($(this).attr("cat_name"));
        event.stopPropagation()
    });
    //for pagination
    $(document).on('click', '.searchlist li a', function (event) {
        // alert('here');
        event.preventDefault();
        var cat_id = $('#cat_id').val();
        // alert(cat_id);
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

        $.ajax({
            url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
            data: $("#searchlistform").serialize(),
            dataType: "html",
            method: "GET",
            cache: false,
            success: function (response) {
                $('.search-result-list').html(response);
                heightAdjust();
            },
            error: function (data) {

            }
        });
        event.stopPropagation()
    });

    $(document).on('click', '.search-category-selection', function (event) {
        $("#cat_id").val($(this).attr("data-id"));
    });

//    $.ajax({
//        url: root_url + '/get_all_classifieds',
//        data: {
//            "_token": $('meta[name="csrf-token"]').attr('content'),
//        },
//        //dataType: "html",
//        method: "POST",
//        cache: true,
//        success: function (projects) {
//            var projects = JSON.parse(projects);
//
//            $("#project").autocomplete({
//                minLength: 0,
//                source: projects,
//                focus: function (event, ui) {
//                    $("#project").val(ui.item.label);
//                    return false;
//                },
//                select: function (event, ui) {
//                    $("#selectval").text($("[dataSelectionId=" + ui.item.catid + "]").text())
//                    $("#cat_id").val(ui.item.catid);
//                    return false;
//                }
//            }).autocomplete("instance")._renderItem = function (ul, item) {
//                if (item.sub_name == null) {
//                    item.sub_name = '';
//                } else {
//                    item.sub_name = ', ' + item.sub_name;
//                }
//                return $("<li>").append("<div><label>" + item.label + "</label><br><span class='values'>" + 'in ' + item.catname + item.sub_name + "</span></div>").appendTo(ul);
//            };
//        }
//    });
    // var autocomplete = new google.maps.places.Autocomplete($("#headerLocationSearchBox")[0], {componentRestrictions: {country: "au"}});

//    $(document).on('change', '.sort-classified-listing', function (event) {
//        var order = $(this).val();
//        //alert(order);
//        var cat_id = $('#cat_id').val();
//        var city = $('#headerLocationSearchBox').val();
//        var itemname = $('#project').val();
//        var km = $('#km').val();
//        var lat = $('#headerLocationSearchLat').val();
//        var lag = $('#headerLocationSearchLong').val();
//
//        $('#cat_ids').val(cat_id);
//        $('#citys').val(city);
//        $('#itemnames').val(itemname);
//        $('#kms').val(km);
//        $('#lats').val(lat);
//        $('#lngs').val(lag);
//        $('#orders').val(order);
//        //console.log("hello1");
//
//        $.ajax({
//            url: $("#searchlistform").attr("action"),
//            data: $("#searchlistform").serialize(),
//            dataType: "html",
//            method: "GET",
//            cache: false,
//            success: function (response) {
//                $('.search-result-list').html(response);
//            },
//            error: function (data) {
//            }
//        });
//        event.stopPropagation()
//    });

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
                    Notify.showNotification(response.message, 'done');
                    $("#user-forgot-password-form")[0].reset();
                    $("label.error").text("");
                } else {
                    Notify.showNotification(response.message, 'warning');
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

    $(document).on('click', '.deleteRecord', function () {


        if (!confirm("Are you sure?")) {
            return false;
        }
        var thisObj = $(this);
        var id = $(this).attr('classid');

        $.ajax({
            url: root_url + '/user/classifieds/deletenomsg',
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
                    Notify.showNotification('Classified Remove Successfully', 'done');
                    setTimeout(function () {
                        location.reload(1);
                    }, 3000);
                    //window.location.href = root_url + '/admin' + '/' + response.url + pid_set;
                } else {
                    return alert(response.message);

                }
            },
            error: function (response) {
                Notify.showNotification('You Have Not Permission To Perform This Action', 'warning');
                // return alert("You Have Not Permission")
            }

        });
    })

    $(document).on('click', '.editclassifiedstatus ', function (event, state) {

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
                Notify.showNotification('Status change Successfully', 'done');
                setTimeout(function () {
                    location.reload(1);
                }, 3000);
            }
        })

    });
    $(document).on('click', '.msgToggle ', function (event, state) {

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

    $(document).on('click', '.filtercategory_label', function (event) {
        event.preventDefault();
        var $this = $(this);
        var cat_id = $this.attr("cat_id");
        var city = $('#headerLocationSearchBox').val();
        var itemname = $('#project').val();
        var km = $('#km').val();
        var lat = $('#headerLocationSearchLat').val();
        var lag = $('#headerLocationSearchLong').val();
        var catname = $this.find("label span").first().text();

        $('#cat_ids').val(cat_id);
        $('#cat_id').val(cat_id);
        $('#citys').val(city);
        $('#itemnames').val(itemname);
        $('#kms').val(km);
        $('#lats').val(lat);
        $('#lngs').val(lag);

        $.ajax({
            url: $("#searchlistform").attr("action"),
            data: $("#searchlistform").serialize(),
            method: "GET",
            cache: false,
            dataType: 'html',
            success: function (response) {
//                console.log(response);
                $('.listing-block').html(response);
//                $('.categoryheading').html(catname);
//                var placedata = $('.dynamicplacesdata').html();
//                $('.place').html('');
//                $('#treeplace').html(placedata);
//                $('#treeplace').treed({openedClass: 'fa fa-minus', closedClass: 'fa fa-plus'});
            },
            error: function (data) {
            }
        });

    });

//    $(document).on('click', '.filtercategory', function (event) {
//
////        event.preventDefault();
////        var $this = $(this);
//        $('#tree1 li').removeClass('active');
//        $this.addClass('active');
////        var cat_id = $this.attr("value");
////        var city = $('#headerLocationSearchBox').val();
////        var itemname = $('#project').val();
////        var km = $('#km').val();
////        var lat = $('#headerLocationSearchLat').val();
////        var lag = $('#headerLocationSearchLong').val();
////        var catname = $this.find("label span").first().text();
//        $(".filtercategory.branch.active").parent().siblings('ul').hide();
//        $(".filtercategory.branch.active").children('i').toggleClass('fa-minus');
//        $(".filtercategory.branch.active").children().children().toggle();
////        $('#cat_ids').val(cat_id);
////        $('#cat_id').val(cat_id);
////        $('#citys').val(city);
////        $('#itemnames').val(itemname);
////        $('#kms').val(km);
////        $('#lats').val(lat);
////        $('#lngs').val(lag);
//        $('.categoryheading').html('');
//        $('.car-search-listing').html('');
//        $(".searchprocess").removeClass("hide");
////        $.ajax({
////            url: $("#searchlistform").attr("action"),
////            data: $("#searchlistform").serialize(),
////            method: "GET",
////            cache: false,
////            success: function (response) {
//                $(".searchprocess").addClass("hide");
////                $('.car-search-listing').html(response);
////                $('.categoryheading').html(catname);
////                var placedata = $('.dynamicplacesdata').html();
////                $('.place').html('');
////                $('#treeplace').html(placedata);
////                $('#treeplace').treed({openedClass: 'fa fa-minus', closedClass: 'fa fa-plus'});
////            },
////            error: function (data) {
////            }
////        });
//
//        $.ajax({
//            //url: $("#searchlistform").attr("action") + "?page=" + $(this).text(),
//            url: root_url + "/classified-dynamicattribute",
//            data: $("#searchlistform").serialize(),
//            // dataType: "html",
//            method: "GET",
//            cache: false,
//            success: function (response) {
//                console.log(response.length);
//                //  $("#tree1 li:nth-child(2)").nextAll().remove();
//                //  $(".load").addClass("hide");
//                if (response.length > 0)
//                {
//                    $('#tree2').html(response);
//                } else
//                {
//                    $('#tree2').html('');
//                }
//                //$('#tree1').removeClass("tree");
//
//                // $('#tree2').treed({openedClass: 'fa fa-caret-down', closedClass: 'fa fa-caret-right'});
//                $('#tree2').treed({openedClass: 'fa fa-minus', closedClass: 'fa fa-plus'});
//
//                /*initialize wickedpicker*/
//                $('.timepicker').wickedpicker({twentyFour: true});
//                $(".datepicker").datepicker();
//                // $('#tree1').removetreed() //remove
//                // $('#tree1').removeClass("tree");
////                topMenuToggle();
////                selectDropText();
////                toggleTopBarSelectBox();
//
//
//                // $('.categoryheading').html($('#categoryheading').val());
//            },
//            error: function (data) {
//
//            }
//        });
//        event.stopPropagation()
//    });

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
            //console.log(jsonStr[0]);
            $.each(jsonStr[0], function (i, v) {
                $.each(v, function (i1, v1) {
                    var valNew = i1.split(';');

                    if (givenval >= parseInt(valNew[0]) && givenval <= parseInt(valNew[1]))
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


    $(document).on('change', '.classForOnChange', function () {
        //  alert("a");
        var thisObj = $(this);
        var attributeid = $(this).attr('attributeid');
        var attributeValueid = $(this).val();
        $('.childValueDiv_' + attributeid).remove();

        $.ajax({
            url: root_url + '/attributes/allchildattributes',
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
                        var html = '';
                        //console.log(valueMain);
                        $.each(valueMain, function (index, value) {
                            options += "<option value='" + value.id + "'>" + value.attribute_value + "</option>";

                        });
                        html += "<li>"
                        html += "<label> " + valueMain[0].display_name + "</label>";
                        html += "<ul><li>";
                        //html += "<select attributeId="<?php echo $val[0]['attribute_id']; ?>" value="<?php echo $val[0]['attribute_id']; ?>" class='filterdrop classForOnChange'>";
                        html += "<select attributeId='56' class='attr_value  textRequired preselect filterdropchild'\n\
                            dataname='" + valueMain[0].display_name + "' name='attr_value[]'>" + options + "</select>";
                        html += "</ul></li>";
                        html += "</li>";
                        //var html = "<div class='divAttrValue childdropfiltersearch row step3row childValueDiv_" + attributeid + " form-row1'>
                        //<div class='col-sm-12'><label>" + valueMain[0].display_name + "</label></div><div class='col-sm-12 '>
                        //<input type='hidden' value='Drop-Down' name='attr_type_name[]'>
                        //<input type='hidden' value='4' name='attr_type_id[]'>
                        //<input type='hidden' class='parent_value_id' value='" + valueMain[0].attribute_value_id + "' name='parent_value_id[]'>
                        //<input type='hidden' class='parent_attribute_id' value='" + attributeid + "' name='parent_attribute_id[]'>
                        //<input type='hidden' class='attr_ids' value='" + valueMain[0].attribute_id + "' name='attr_ids[]'>
                        //<select attributeid='56' class='attr_value  textRequired preselect filterdropchild' dataname='" 
                        //+ valueMain[0].display_name + "' name='attr_value[]'>" + options + "</select></div></div>";

                        $(thisObj).parent().parent().parent().after(html);

                    });
                }
            }
        });
    });

    $(document).on('change', '.filterdropchild', function () {
        var $selectedval = $(this).find('option:selected').val();
        var thisObj = $(this);
        var parent_value_id = $('.parent_value_id').val();
        var parent_attribute_id = $('.parent_attribute_id').val();
        var attr_ids = $('.attr_ids').val();

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
        $('#parent_value_id').val(parent_value_id);
        $('#parent_attribute_id').val(parent_attribute_id);
        $('#attr_ids').val(attr_ids);


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
        //event.stopPropagation()
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

    $(document).on('click', '.removekeyword', function (event) {


        $('.searchkeyword').val('');
        $('#project').val('');
    });

    $(document).on('click', '.clearfiltter', function (event) {
        $('#tree1 li').removeClass('active');
        $('#project').val('');
        $('#headerLocationSearchBox').val('');
        $('#headerLocationSearchLat').val('');
        $('#headerLocationSearchLong').val('');
        $('#cat_id').val('');
        $('#selectval').html('All Categories');
        $("#searchFrom1").submit();
//location.reload();
    });
    $(document).on('click', '.clearcategoryfiltter', function (event) {

        $('#tree1 li').removeClass('active');
        $('#project').val('');
        $('#headerLocationSearchBox').val('');
        $('#headerLocationSearchLat').val('');
        $('#headerLocationSearchLong').val('');
        $('#cat_id').val('');
        $('#selectval').html('All Categories');
        $("#searchFrom1").submit();
//location.reload();
    });
    $(document).on('click', '.cust-info i.fa-minus', function (event) {
        // alert('yes');
        $(this).parent().next().slideUp();
        $(this).addClass('fa-plus');
        $(this).removeClass('fa-minus');



    });
    $(document).on('click', '.cust-info i.fa-plus', function (event) {
        $(this).parent().next().slideDown();
        $(this).addClass('fa-minus');
        $(this).removeClass('fa-plus');


    });




    $(document).on('change', '#select-options-1', function () {
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

    $(document).on('click', '.pricefilter', function (event) {
        event.preventDefault();

        // console.log($(this).text())
        var cat_id = $('#cat_id').val();
        var city = $('#headerLocationSearchBox').val();
        var itemname = $('#project').val();
        var km = $('#km').val();
        var lat = $('#headerLocationSearchLat').val();
        var lag = $('#headerLocationSearchLong').val();
        var minprice = $('.pricemin').val();
        var maxprice = $('.pricemax').val();
        // var radioid = $selectedradio;

        $('#cat_ids').val(cat_id);
        $('#citys').val(city);
        $('#itemnames').val(itemname);
        $('#kms').val(km);
        $('#lats').val(lat);
        $('#lngs').val(lag);
        $('#minprice').val(minprice);
        $('#maxprice').val(maxprice);

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

    console.log($('.searchkeyword').val());
    if ($('.searchkeyword').val() == '')
    {
        $('.hidekey').hide();
    }


//var myLength = $(".searchkeyword").val().length;
//if(myLength > 0)
//{
//    alert('hii');
//}
})

$(document).on('keyup', '.searchkeyword', function () {
    console.log($('.searchkeyword').val());
    if ($('.searchkeyword').val() == '')
    {
        $('.hidekey').hide();
    } else
    {
        $('.hidekey').show();
    }
})


$(document).on('submit', '#foodScanForm', function (event) {

    event.preventDefault();
    $('.foodScan_loading').show();
    $('.foodScan_no_records').hide();
    $('.foodScan_main_div').hide();
    $('.foodScan_div').hide();
    var thisObj = $(this);
    var formData = new FormData($(thisObj)[0]);

    $.ajax({
        url: $(thisObj).attr('action'),
        data: formData,
        method: "POST",
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
            if (response.status) {
                if (response.results != null) {
                    $('.foodScan_loading').hide();
                    $('.foodScan_no_records').hide();
                    $('.foodScan_main_div').show();
                    $('.foodScan_div').show();
                    $('.foodScanTitle').html(response.results.name);
                    $('.foodScanTitle_ingredients').html(response.results.ingredient);
                    var nutrition = response.results.nutrition.split(',')

                    var nutrition_html = '';
                    $.each(nutrition, function (index, value) {

                        nutrition_html += "<div class='prolabel-info-row row'>";
                        nutrition_html += "<div class='col-md-6 col-sm-6 col-xs-6 prolabel-title'>" + value + "</div>";
                        nutrition_html += "<div class='col-md-6 col-sm-6 col-xs-6 prolabel-value'></div>";
                        nutrition_html += "</div>";
                    });
                    
                    $('.nutrition_value').html(nutrition_html);
                } else {
                    $('.foodScan_loading').hide();
                    $('.foodScan_main_div').show();
                    $('.foodScan_no_records').show();
                    $('.foodScan_div').hide();
                }


            }
        },
        error: function (data) {
            var dataObj = JSON.parse(data.responseText);
        }
    });
});

$(document).on('keyup', '#foodProductName', function () {

    var thisObj = $(this);
    var product_name = $(thisObj).val();

    if (product_name != '') {
        $.ajax({
            url: root_url + '/food_products/food_product_list',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                product_name: product_name
            },
            method: "POST",
            cache: false,
            success: function (response) {
                $(thisObj).autocomplete({
                    source: response.names,
                });
            },
            error: function (data) {
//                var dataObj = JSON.parse(data.responseText);
            }
        });
    }
});

$(document).on('submit', '#searchFrom', function (e) {

    var thisObj = $(this);
    e.preventDefault();

    var state_id = $('#usr-state option:selected').attr('state_id');
    $('#state_id').val(state_id);

    var form = $('#searchFrom')[0];
    var formData = new FormData(form);

    if ($('#header_cat_name').val() != '') {
        var url = $(form).attr('action') + '/' + $('#header_cat_name').val() + '/' + $('#header_cat_id').val();
    } else {
        var url = $(form).attr('action');
    }
    $('#searchFrom').attr('action', url);
    $('#searchFrom')[0].submit();

});

$(function () {
    $("#itemname")
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
                        url: root_url + '/get_all_classifieds',
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                            text_data: $('#itemname').val(),
                        },
                        dataType: "json",
                        method: "POST",
                        cache: true,
                        success: function (response1) {

                            console.log(response1.data);
                            response(response1.data);
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
                    $("#itemname").val(ui.item.label);
                    $("#header_cat_id").val(ui.item.sub_id);
                    $("#header_cat_name").val(ui.item.sub_name);
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
        if (item.sub_name == null) {
            item.sub_name = '';
        } else {
            item.sub_name = ', ' + item.sub_name;
        }
        return $("<li>").append("<div><label>" + item.label + "</label><br><span class='values'>" + 'in ' + item.catname + item.sub_name + "</span></div>").appendTo(ul);
    };
});

$(document).on("click", ".use_mycurrent_location", function () {
    getLocation();


})

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, err);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }

    navigator.permissions.query({name: 'geolocation'})
            .then(function (permissionStatus) {
                console.log('geolocation permission state is ', permissionStatus.state);

                permissionStatus.onchange = function () {
                    console.log('geolocation permission state has changed to ', this.state);
                };
            });
}

function err(position) {
    latitute = 0;
    longitude = 0;
}

function showPosition(position) {
    var geocoder;
    geocoder = new google.maps.Geocoder();
    latitute = position.coords.latitude;
    longitude = position.coords.longitude;
    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);



    geocoder.geocode(
            {'latLng': latlng},
            function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('#address').val(results[0].formatted_address);
                        console.log(results[0])

                        for (var i = 0; i < results[0].address_components.length; i++) {
                            var addressType = results[0].address_components[i].types[0];
                            if (addressType == 'country') {
                                var state = results[0].address_components[i]['long_name'];
                                $('.user-country').val(state);
                            }
                            if (addressType == 'administrative_area_level_1') {
                                var state = results[0].address_components[i]['long_name'];
                                $('.statevalue').val(state);
                            }
                            if (addressType == 'administrative_area_level_2') {
                                var state2 = results[0].address_components[i]['long_name'];
                            }
                            if (addressType == 'locality') {
                                var city = results[0].address_components[i]['long_name'];
                                $('.subregion_id').val(city);
                            }
                            if (addressType == 'postal_code') {
                                var gPostalCode = results[0].address_components[i]['short_name'];
                                $('.pincode').val(gPostalCode);
                            }

                            $("#lat").val(latitute);
                            $("#lng").val(longitude);
                        }

                        var location_str = state + " " + state2 + " " + city;

                        $.ajax({
                            url: root_url + '/get_suburbs',
                            data: {
                                "postal_code": gPostalCode, "location_str": location_str,
                            },
                            //dataType: "html",
                            method: "GET",
                            cache: true,
                            success: function (suburbId) {
                                $('#suburbs_id').val(suburbId);
                            }
                        });
                    } else {
                        console.log("address not found");
                    }
                } else {
                    console.log("Geocoder failed due to: " + status);
                }
            }
    );
}

function get_sensis_search(location) {
    //call sessis API for restorent
    $.ajax({
        url: root_url + '/get_sensis_search',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            query: "Restaurants",
            location: location,
        },
        method: "POST",
        cache: false,
        success: function (response) {

            if (response.status) {
                var html_li = '';
                $.each(response.results.results, function (index, value) {

                    html_li += "<li><a href='javascript:void(0);'><img src='"+root_url+"/plugins/front/img/link-icon1.png'><span title='"+value.name+"'>" + value.name.substring(0,30); + "(" + value.distance.toFixed(2) + ")</span></a></li>";

                });
                $('.information_data').html(html_li);
            }
        }
    });
}
        