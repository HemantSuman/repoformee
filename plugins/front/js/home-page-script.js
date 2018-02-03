var latitute1 = 0;
var longitude1 = 0;
getLocation();

$(function () {
    getLocation();
    getClassifiedForMostViewed1(0, 0, 0);
    getClassifiedForMostRecent1(0, 0, 0);
    get_today_prayer_timing(0, 0)
    get_classified_map(-37.813628, 144.963058)
    getallclassified()
//    get_sensis_search();
//    console.log($('#headerLocationSearchBox').val(), '#######');
});

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, err);
    } else {
        //console.log("Geolocation is not supported by this browser.");
    }
}

function err(position) {
    getClassifiedForMostViewed(0, 0, 0, 1);
    getClassifiedForMostRecent(0, 0, 0, 1);
    console.log("-----------called in err -------------->")
    get_today_prayer_timing(0, 0)
    get_classified_map(-37.813628, 144.963058)
    latitute1 = 0;
    longitude1 = 0;

    $('.trending_classi').html('');
    $('.recent_classi').html('');
}
function showPosition(position) {

    var geocoder;
    geocoder = new google.maps.Geocoder();
    latitute1 = position.coords.latitude;
    longitude1 = position.coords.longitude;
    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

    $('.trending_classi').html('');
    $('.recent_classi').html('');

    geocoder.geocode(
            {'latLng': latlng},
            function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var add = results[0].formatted_address;
                        var value = add.split(",");

                        count = value.length;
                        country = value[count - 1];
                        state = value[count - 2];
                        city = value[count - 3];
                        //console.log("city name is: " + city);
                        $('.locationfield').val(city + '' + state + '' + country);
                        $('#headerLocationSearchLat').val(position.coords.latitude);
                        $('#headerLocationSearchLong').val(position.coords.longitude);
                        getClassifiedForMostViewed(position.coords.latitude, position.coords.longitude, 0, 1);
                        getClassifiedForMostRecent(position.coords.latitude, position.coords.longitude, 0, 1);
                        get_today_prayer_timing(position.coords.latitude, position.coords.longitude)
                        get_classified_map(position.coords.latitude, position.coords.longitude)
                        //alert($('#headerLocationSearchLat').val().length);
                        
                        get_sensis_search(results[0].formatted_address);
                        
                        if ($('#headerLocationSearchLat').val() == "") {
//                            getClassifiedForMostViewed(0, 0, 0);
//                            getClassifiedForMostRecent(0, 0, 0);
                        }
                    } else {
                        //console.log("address not found");
                    }
                } else {
                    //console.log("Geocoder failed due to: " + status);
                }
            }
    );
}

function get_today_prayer_timing(lat, lng) {
    var cur_city = "";
    var current_date = new Date();
    var timezone = -(current_date.getTimezoneOffset())

    var c_timeStamp = new Date();
    var c_date = c_timeStamp.getDate();
    var c_month = c_timeStamp.getMonth();
    var c_year = c_timeStamp.getFullYear();
    var c_hour = c_timeStamp.getHours();
    var c_minute = c_timeStamp.getMinutes();

    var final_string = c_year+"-"+(c_month+1)+"-"+c_date+" "+c_hour+":"+c_minute;
    console.log("------------------------------------------------"+final_string+"-------------------------")
    
    if(lat != 0 && lng != 0) {
        var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + '%2C' + lng + '&language=en';
        $.getJSON(GEOCODING).done(function(locationn) {
//            console.log(locationn.results[0]);
            var lcnn = locationn.results[0].address_components
        
            for (var i = 0; i < lcnn.length; i++) {
                var addressType = lcnn[i].types[0];
                if (addressType == 'locality') {
                    cur_city = lcnn[i]['long_name'];
                    console.log(cur_city)
                }
            }

            $.ajax({
                url: root_url + '/get_p_timing',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "lat": lat,
                    "lng": lng,
                    "timezone": timezone,
                    "cur_city": cur_city,
                    "cur_time": final_string
                },
                dataType: "html",
                method: "POST",
                cache: true,
                success: function (response) {
                    $(".p_timing_sidebar_blck").html(response);

                    var curr_time = new Date();
                    var get_curr_hour = curr_time.getHours();
                    var get_curr_minute = curr_time.getMinutes();
                    var exact_time_diff = '';
                    if($(".isTodayTiming").val() == 1) {
                        var fffff = get_curr_hour+":"+get_curr_minute;
                        var diff = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;

                        var get_minute = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
                        var get_hour = parseInt(get_minute / 60);
                        var get_remain_min = (get_minute % 60);
                        console.log(get_hour+" hour and "+get_remain_min+" minute left")

                        if(get_hour == 0) {
                            exact_time_diff = get_remain_min+" minute left";
                        } else {
                            exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
                        }
                        $(".pt_time_left").text(exact_time_diff)

                    } else {

                        var fffff = get_curr_hour+":"+get_curr_minute;
                        var diff = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;

                        var get_minute = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
                        var get_hour = parseInt(get_minute / 60);
                        var get_remain_min = (get_minute % 60);
                        console.log(get_hour+" hour and "+get_remain_min+" minute left")

                        if(get_hour == 0) {
                            exact_time_diff = get_remain_min+" minute left";
                        } else {
                            exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
                        }
                        $(".pt_time_left").text(exact_time_diff)

                    }
                }
            })
        })
    } else {
        $.ajax({
            url: root_url + '/get_p_timing',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "lat": lat,
                "lng": lng,
                "timezone": timezone,
                "cur_city": cur_city,
                "cur_time": final_string
            },
            dataType: "html",
            method: "POST",
            cache: true,
            success: function (response) {
                $(".p_timing_sidebar_blck").html(response);

                var curr_time = new Date();
                var get_curr_hour = curr_time.getHours();
                var get_curr_minute = curr_time.getMinutes();
                var exact_time_diff = '';
                if($(".isTodayTiming").val() == 1) {
                    var fffff = get_curr_hour+":"+get_curr_minute;
                    var diff = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;

                    var get_minute = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
                    var get_hour = parseInt(get_minute / 60);
                    var get_remain_min = (get_minute % 60);
                    console.log(get_hour+" hour and "+get_remain_min+" minute left")

                    if(get_hour == 0) {
                        exact_time_diff = get_remain_min+" minute left";
                    } else {
                        exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
                    }
                    $(".pt_time_left").text(exact_time_diff)

                } else {

                    var fffff = get_curr_hour+":"+get_curr_minute;
                    var diff = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;

                    var get_minute = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
                    var get_hour = parseInt(get_minute / 60);
                    var get_remain_min = (get_minute % 60);
                    console.log(get_hour+" hour and "+get_remain_min+" minute left")

                    if(get_hour == 0) {
                        exact_time_diff = get_remain_min+" minute left";
                    } else {
                        exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
                    }
                    $(".pt_time_left").text(exact_time_diff)

                }
            }
        })
    }
}

function get_classified_map(lat, lng) {
    $.ajax({
        url: root_url + '/get_c_map',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "lat": lat,
            "lng": lng,
        },
        dataType: "json",
        method: "POST",
        cache: true,
        success: function (response) {
            //console.log(response)

            var locations = [];
            // var msqData = <?php echo json_encode($near_mosques) ?>;
            $.each(response, function (key, value) {
                locations[key] = [value.title, value.lat, value.lng, key + 1
                ];
            });
            var map = new google.maps.Map(document.getElementById('msq-near-map'), {
                zoom: 5,
                center: new google.maps.LatLng(lat, lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    })
}
//function get_classified_map(lat, lng) {
//    var cur_city = "";
//    var current_date = new Date();
//    var timezone = -(current_date.getTimezoneOffset())
//
//    var c_timeStamp = new Date();
//    var c_date = c_timeStamp.getDate();
//    var c_month = c_timeStamp.getMonth();
//    var c_year = c_timeStamp.getFullYear();
//    var c_hour = c_timeStamp.getHours();
//    var c_minute = c_timeStamp.getMinutes();
//
//    var final_string = c_year+"-"+(c_month+1)+"-"+c_date+" "+c_hour+":"+c_minute;
//    console.log("------------------------------------------------"+final_string+"-------------------------")
//    
//    if(lat != 0 && lng != 0) {
//        var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + '%2C' + lng + '&language=en';
//        $.getJSON(GEOCODING).done(function(locationn) {
//
//            var lcnn = locationn.results[0].address_components
//        
//            for (var i = 0; i < lcnn.length; i++) {
//                var addressType = lcnn[i].types[0];
//                if (addressType == 'locality') {
//                    cur_city = lcnn[i]['long_name'];
//                    console.log(cur_city)
//                }
//            }
//
//            $.ajax({
//                url: root_url + '/get_c_map',
//                data: {
//                    "_token": $('meta[name="csrf-token"]').attr('content'),
//                    "lat": lat,
//                    "lng": lng,
//                    "timezone": timezone,
//                    "cur_city": cur_city,
//                    "cur_time": final_string
//                },
//                dataType: "html",
//                method: "POST",
//                cache: true,
//                success: function (response) {
//                    $(".p_timing_sidebar_blck").html(response);
//
//                    var curr_time = new Date();
//                    var get_curr_hour = curr_time.getHours();
//                    var get_curr_minute = curr_time.getMinutes();
//                    var exact_time_diff = '';
//                    if($(".isTodayTiming").val() == 1) {
//                        var fffff = get_curr_hour+":"+get_curr_minute;
//                        var diff = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;
//
//                        var get_minute = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
//                        var get_hour = parseInt(get_minute / 60);
//                        var get_remain_min = (get_minute % 60);
//                        console.log(get_hour+" hour and "+get_remain_min+" minute left")
//
//                        if(get_hour == 0) {
//                            exact_time_diff = get_remain_min+" minute left";
//                        } else {
//                            exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
//                        }
//                        $(".pt_time_left").text(exact_time_diff)
//
//                    } else {
//
//                        var fffff = get_curr_hour+":"+get_curr_minute;
//                        var diff = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;
//
//                        var get_minute = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
//                        var get_hour = parseInt(get_minute / 60);
//                        var get_remain_min = (get_minute % 60);
//                        console.log(get_hour+" hour and "+get_remain_min+" minute left")
//
//                        if(get_hour == 0) {
//                            exact_time_diff = get_remain_min+" minute left";
//                        } else {
//                            exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
//                        }
//                        $(".pt_time_left").text(exact_time_diff)
//
//                    }
//                }
//            })
//        })
//    } else {
//        $.ajax({
//            url: root_url + '/get_c_map',
//            data: {
//                "_token": $('meta[name="csrf-token"]').attr('content'),
//                "lat": lat,
//                "lng": lng,
//                "timezone": timezone,
//                "cur_city": cur_city,
//                "cur_time": final_string
//            },
//            dataType: "html",
//            method: "POST",
//            cache: true,
//            success: function (response) {
//                $(".p_timing_sidebar_blck").html(response);
//
//                var curr_time = new Date();
//                var get_curr_hour = curr_time.getHours();
//                var get_curr_minute = curr_time.getMinutes();
//                var exact_time_diff = '';
//                if($(".isTodayTiming").val() == 1) {
//                    var fffff = get_curr_hour+":"+get_curr_minute;
//                    var diff = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;
//
//                    var get_minute = ( new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
//                    var get_hour = parseInt(get_minute / 60);
//                    var get_remain_min = (get_minute % 60);
//                    console.log(get_hour+" hour and "+get_remain_min+" minute left")
//
//                    if(get_hour == 0) {
//                        exact_time_diff = get_remain_min+" minute left";
//                    } else {
//                        exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
//                    }
//                    $(".pt_time_left").text(exact_time_diff)
//
//                } else {
//
//                    var fffff = get_curr_hour+":"+get_curr_minute;
//                    var diff = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60 / 60;
//
//                    var get_minute = ( new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff) ) / 1000 / 60;
//                    var get_hour = parseInt(get_minute / 60);
//                    var get_remain_min = (get_minute % 60);
//                    console.log(get_hour+" hour and "+get_remain_min+" minute left")
//
//                    if(get_hour == 0) {
//                        exact_time_diff = get_remain_min+" minute left";
//                    } else {
//                        exact_time_diff = get_hour+" hour and "+get_remain_min+" minute left";
//                    }
//                    $(".pt_time_left").text(exact_time_diff)
//
//                }
//            }
//        })
//    }
//}


function getClassifiedForMostViewed(lat, lng, offset, is_first) {
    $(".trend-clasf-loading").removeClass("hide")
    $.ajax({
        url: root_url + '/most_viewed_classifieds',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "lat": lat,
            "lng": lng,
            "offset": offset,
        },
        //dataType: "html",
        method: "POST",
        cache: true,
        success: function (response) {
            $(".trend-clasf-loading").addClass("hide")
            if (response.status) {
                var html = '';
                $.each(response.data, function (index, value) {

                    // var url = 'upload_images/classified/' + value.id + '/' + value.name;
                    var url = 'upload_images/classified/' + value.classifiedid + '/' + value.imagename;
                    if(value.City!= null)
                    {
                      var city=value.City;  
                    }
                    else
                    {
                        var city='';
                    }
                    // if (value.price != 0) {
                    //     var price = "<div class='category-price'>$" + value.price + "</div>";
                    // } else {
                    //     var price = '';
                    // }

                    //html += "<div class='col-md-4 grid-item'><div class='listing-inner'><div class='p-img'><a href='" + root_url + "/classifieds/" + value.classified_id + "'><img src='" + root_url + "/" + url + "' class='' alt='product-img'></a></div><div class='p-description'>" + price + "<div class='category-name'><a href='" + root_url + "/classifieds/" + value.classified_id + "' >" + value.title + "</a></div><div class='category-loaction'><i class='fa fa-map-marker' aria-hidden='true'></i>" + value.country + "</div></div><span class='cart add-wishlist-btn "+chckItemIsInWishlistdd+"' data-id='"+value.classified_id+"'><i class='fa fa-star-o' aria-hidden='true'></i></span></div></div>"


                    var classifiedTitle = value.title;
                    var encodedTitle = value.title.replace(/[^A-Za-z0-9\s]/gi, '-').replace(/[_\s]/g, '-');
                    if (value.title.length > 19) {
                         classifiedTitle = classifiedTitle.slice(0,10)+'...';
                    }
                  
                    html += "<div class='col-md-3 grid-item'>";
                    html += "<div class='listing-inner'>";
                    html += "<div class='p-img'><a href=" + root_url + "/classifieds/" + encodedTitle.toLowerCase() + "/" + value.classified_id + "><img src=" + root_url + "/" + url + " alt='product-img'></a></div>";
                    html += "<div class='p-description'>";
                    if (value.price > 0)
                    {
                        html += "<div class='category-price'>$" + value.price;
                    } else
                    {
                        html += "<div class='category-price'>" + ' ';
                    }
                    if ($.inArray(value.classified_id, wishlistItems) != -1) {
                        html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon active'><i class='fa fa-heart' aria-hidden='true'></i></a>";
                    } else {
                        html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon'><i class='fa fa-heart-o' aria-hidden='true'></i></a>";
                    }

                    //html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon'><i class='fa fa-heart-o' aria-hidden='true'></i></a>";
                    html += "</div>";
                    html += "<div class='category-name'>" + classifiedTitle + "</div>";
                    html += "<div class='category-loaction'>" + city + "</div></div>";
                    html += "<span class='top-badge'>"+ value.createtime + "</span>";
                    html += "</div></div>"

                    var offset_up = parseInt(Object.keys(response.data).length) + parseInt(offset);
                    $('.most_trending').attr('offset_count', offset_up);
                });
                if (is_first) {
                    $('#most-viewed-classified-list').html(html);
                } else {
                    $('#most-viewed-classified-list').append(html);
                }
                heightAdjust();
            } else {
                if ($('#most-viewed-classified-list .no-record').length == 0) {
                    // $('#most-viewed-classified-list').append("<div class='col-md-12 text-center no-record'><p>To View More Ads Click the Button Below.</p></div>");
                    $('#most-viewed-classified-list').append("<div class='col-md-12 text-center no-record'><p></p></div>");

                }
            }
        }
    });
}

function getClassifiedForMostViewed1(lat, lng, offset) {
    $(".trend-clasf-loading").removeClass("hide")
    $.ajax({
        url: root_url + '/most_viewed_classifieds',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "lat": lat,
            "lng": lng,
            "offset": offset,
        },
        //dataType: "html",
        method: "POST",
        cache: true,
        success: function (response) {
            //$("#most-viewed-classified-list").html(response)
            $(".trend-clasf-loading").addClass("hide")
            if (response.status) {
                var html = '';
                $.each(response.data, function (index, value) {

                    var url = 'upload_images/classified/' + value.classifiedid + '/' + value.imagename;
                    //console.log(value);
                    if(value.City!= null)
                    {
                      var city=value.City;  
                    }
                    else
                    {
                        var city='';
                    }
                    
                 
//var $interval->format('%R%a days');
                    // if (value.price != 0) {
                    //     var price = "<div class='category-price'>$" + value.price + "</div>";
                    // } else {
                    //     var price = '';
                    // }

                    //html += "<div class='col-md-4 grid-item'><div class='listing-inner'><div class='p-img'><a href='" + root_url + "/classifieds/" + value.classified_id + "'><img src='" + root_url + "/" + url + "' class='' alt='product-img'></a></div><div class='p-description'>" + price + "<div class='category-name'><a href='" + root_url + "/classifieds/" + value.classified_id + "' >" + value.title + "</a></div><div class='category-loaction'><i class='fa fa-map-marker' aria-hidden='true'></i>" + value.country + "</div></div><span class='cart add-wishlist-btn "+chckItemIsInWishlist+"' data-id='"+value.classified_id+"'><i class='fa fa-star-o' aria-hidden='true'></i></span></div></div>"

                    var classifiedTitle = value.title;
                    var encodedTitle = value.title.replace(/[^A-Za-z0-9\s]/gi, '-').replace(/[_\s]/g, '-');
                   
                    if (value.title.length > 19) {
                       // classifiedTitle = $.trim(value.title).substring(0, 19).split(" ").slice(0, -1).join(" ") + "...";
                        classifiedTitle = classifiedTitle.slice(0,10)+'...';
                        
                    }

                    html += "<div class='col-md-3 grid-item'>";
                    html += "<div class='listing-inner'>";
                    html += "<div class='p-img'><a href=" + root_url + "/classifieds/" + encodedTitle.toLowerCase() + "/" +value.classified_id + "><img src=" + root_url + "/" + url + " alt='product-img'></a></div>";
                    html += "<div class='p-description'>";
                    if (value.price > 0)
                    {
                        html += "<div class='category-price'>$" + value.price;
                    } else
                    {
                        html += "<div class='category-price'>" + ' ';
                    }
                    if ($.inArray(value.classified_id, wishlistItems) != -1) {
                        html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon active'><i class='fa fa-heart' aria-hidden='true'></i></a>";
                    } else {
                        html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon'><i class='fa fa-heart-o' aria-hidden='true'></i></a>";
                    }

                    //html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon'><i class='fa fa-heart-o' aria-hidden='true'></i></a>";
                    html += "</div>";
                    html += "<div class='category-name'>" + classifiedTitle + "</div>";
                    html += "<div class='category-loaction'>" + city + "</div></div>";
                    html += "<span class='top-badge'> "+ value.createtime + "</span>";
                    html += "</div></div>"

                    var offset_up = parseInt(Object.keys(response.data).length) + parseInt(offset);
                    //$('.most_trending').attr('offset_count', offset_up);
                    $('.most_trending').attr('offset_count', 10);
                });
                $('#most-viewed-classified-list').html(html);
                heightAdjust();
            } else {
                if ($('#most-viewed-classified-list .NoRecordsFound').length == 0) {
                    // $('#most-viewed-classified-list').append("<div class='NoRecordsFound col-md-4 grid-item' style='width: 100%;margin: 5px;position: absolute;bottom: 0px;text-align: center;'>To View More Ads Click the Button Below</div>");
                    $('#most-viewed-classified-list').append("<div class='NoRecordsFound col-md-4 grid-item' style='width: 100%;margin: 5px;position: absolute;bottom: 0px;text-align: center;'></div>");

                }
            }
        }
    });
}


function getClassifiedForMostRecent(lat, lng, offset, is_first) {
    $(".recent-clasf-loading").removeClass("hide")
    $.ajax({
        url: root_url + '/most_recent_classifieds',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "lat": lat,
            "lng": lng,
            "offset": offset,
        },
        //dataType: "html",
        method: "POST",
        cache: true,
        success: function (response) {
            // $("#most-recent-classified-list").html(response)
            // if($("#is_load_more").val() == 0) {
            //     $("#most-recent-classified-list").html(response)   
            // } else {
            //     $("#most-recent-classified-list").append(response)
            //     $('.more-recent-classified-btn').attr('offset_count', parseInt($("#recent_offset_count").val()) + parseInt($(".more-recent-classified-btn").attr("offset_count")));
            //     $("#is_load_more").val(0)
            // }
            $(".recent-clasf-loading").addClass("hide")
            if (response.status) {
                var html = '';
                $.each(response.data, function (index, value) {

                    var url = 'upload_images/classified/' + value.classified_id + '/' + value.name;
                    if(value.City!= null)
                    {
                      var city=value.City;  
                    }
                    else
                    {
                        var city='';
                    }
                    // if (value.price != 0) {
                    //     var price = "<div class='category-price'>$" + value.price + "</div>";
                    // } else {
                    //     var price = '';
                    // }

                    //html += "<div class='col-md-4 grid-item'><div class='listing-inner'><div class='p-img'><a href='" + root_url + "/classifieds/" + value.classified_id + "'><img src='" + root_url + "/" + url + "' class='' alt='product-img'></a></div><div class='p-description'>" + price + "<div class='category-name'><a href='" + root_url + "/classifieds/" + value.classified_id + "' >" + value.title + "</a></div><div class='category-loaction'><i class='fa fa-map-marker' aria-hidden='true'></i>" + value.country + "</div></div><span class='cart add-wishlist-btn "+chckItemIsInWishlist+"' data-id='"+value.classified_id+"'><i class='fa fa-star-o' aria-hidden='true'></i></span></div></div>"

                    var classifiedTitle = value.title;
                    var encodedTitle = value.title.replace(/[^A-Za-z0-9\s]/gi, '-').replace(/[_\s]/g, '-');
                    if (value.title.length > 19) {
                         classifiedTitle = classifiedTitle.slice(0,10)+'...';
                    }

                    html += "<div class='col-md-3 grid-item'>";
                    html += "<div class='listing-inner'>";
                    html += "<div class='p-img'><a href=" + root_url + "/classifieds/" + encodedTitle.toLowerCase() + "/" + value.classified_id + "><img src=" + root_url + "/" + url + " alt='product-img'></a></div>";
                    html += "<div class='p-description'>";
                    if (value.price > 0)
                    {
                        html += "<div class='category-price'>$" + value.price;
                    } else
                    {
                        html += "<div class='category-price'>" + ' ';
                    }
                    if ($.inArray(value.classified_id, wishlistItems) != -1) {
                        html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon active'><i class='fa fa-heart' aria-hidden='true'></i></a>";
                    } else {
                        html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon'><i class='fa fa-heart-o' aria-hidden='true'></i></a>";
                    }

                    //html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon'><i class='fa fa-heart-o' aria-hidden='true'></i></a>";
                    html += "</div>";
                    html += "<div class='category-name'>" + classifiedTitle + "</div>";
                    html += "<div class='category-loaction'>" + city + "</div></div>";
                    html += "<span class='top-badge'>"+ value.createtime + "</span>";
                    html += "</div></div>"

                    var offset_up = parseInt(Object.keys(response.data).length) + parseInt(offset);
                    $('.most_recent').attr('offset_count', offset_up);
                });
                if (is_first) {
                    $('#most-recent-classified-list').html(html);
                } else {
                    $('#most-recent-classified-list').append(html);
                }
                 heightAdjust();
            } else {
                if ($('#most-recent-classified-list .no-record').length == 0) {
                    // $('#most-recent-classified-list').append("<div class='no-record col-md-12 text-center'>To View More Ads Click the Button Below</div>");
                    $('#most-recent-classified-list').append("<div class='no-record col-md-12 text-center'></div>");

                }
            }
        }
    });
}


function getClassifiedForMostRecent1(lat, lng, offset) {
    $(".recent-clasf-loading").removeClass("hide")
    $.ajax({
        url: root_url + '/most_recent_classifieds',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "lat": lat,
            "lng": lng,
            "offset": offset,
        },
        //dataType: "html",
        method: "POST",
        cache: true,
        success: function (response) {
            //$("#most-recent-classified-list").html(response)
            $(".recent-clasf-loading").addClass("hide")
            if (response.status) {
                var html = '';
                $.each(response.data, function (index, value) {

                    var url = 'upload_images/classified/' + value.classified_id + '/' + value.name;
                    if(value.City!= null)
                    {
                      var city=value.City;  
                    }
                    else
                    {
                        var city='';
                    }
                    // if (value.price != 0) {
                    //     var price = "<div class='category-price'>$" + value.price + "</div>";
                    // } else {
                    //     var price = '';
                    // }

                    //html += "<div class='col-md-4 grid-item'><div class='listing-inner'><div class='p-img'><a href='" + root_url + "/classifieds/" + value.classified_id + "'><img src='" + root_url + "/" + url + "' class='' alt='product-img'></a></div><div class='p-description'>" + price + "<div class='category-name'><a href='" + root_url + "/classifieds/" + value.classified_id + "' >" + value.title + "</a></div><div class='category-loaction'><i class='fa fa-map-marker' aria-hidden='true'></i>" + value.country + "</div></div><span class='cart add-wishlist-btn "+chckItemIsInWishlist+"' data-id='"+value.classified_id+"'><i class='fa fa-star-o' aria-hidden='true'></i></span></div></div>"

                    var classifiedTitle = value.title;
                     var encodedTitle = value.title.replace(/[^A-Za-z0-9\s]/gi, '-').replace(/[_\s]/g, '-');
                    if (value.title.length > 19) {
                         classifiedTitle = classifiedTitle.slice(0,10)+'...';
                    }

                    html += "<div class='col-md-3 grid-item'>";
                    html += "<div class='listing-inner'>";
                    html += "<div class='p-img'><a href=" + root_url + "/classifieds/" + encodedTitle.toLowerCase() + "/" +  value.classified_id + "><img src=" + root_url + "/" + url + " alt='product-img'></a></div>";
                    html += "<div class='p-description'>";
                    if (value.price > 0)
                    {
                        html += "<div class='category-price'>$" + value.price;
                    } else
                    {
                        html += "<div class='category-price'>" + ' ';
                    }
                    if ($.inArray(value.classified_id, wishlistItems) != -1) {
                        html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon active'><i class='fa fa-heart' aria-hidden='true'></i></a>";
                    } else {
                        html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon'><i class='fa fa-heart-o' aria-hidden='true'></i></a>";
                    }

                    //html += "<a href='javascript:void(0)' data-id=" + value.classified_id + " class='cart wishlist-icon'><i class='fa fa-heart-o' aria-hidden='true'></i></a>";
                    html += "</div>";
                    html += "<div class='category-name'>" + classifiedTitle + "</div>";
                    html += "<div class='category-loaction'>" + city + "</div></div>";
                    html += "<span class='top-badge'>"+ value.createtime + "</span>";
                    html += "</div></div>"

                    var offset_up = parseInt(Object.keys(response.data).length) + parseInt(offset);
                    // $('.most_recent').attr('offset_count', offset_up);
                    $('.most_recent').attr('offset_count', 10);
                });
                $('#most-recent-classified-list').html(html);
                heightAdjust();
            } else {
                if ($('#most-recent-classified-list .no-record').length == 0) {
                    // $('#most-recent-classified-list').append("<div class='no-record col-md-12 text-center'>To View More Ads Click the Button Below</div>");
                    $('#most-recent-classified-list').append("<div class='no-record col-md-12 text-center'></div>");

                }
            }
        }
    });
}

function getallclassified()
{
//     $.ajax({
//         url: root_url + '/get_all_classifieds',
//         data: {
//             "_token": $('meta[name="csrf-token"]').attr('content'),
//         },
//         //dataType: "html",
//         method: "POST",
//         cache: true,
//         success: function (projects) {
// //            var projects = [
// //                {
// //                    value: "jquery",
// //                    label: "jQuery",
// //                    desc: "the write less, do more, JavaScript library",
// //                    icon: "jquery_32x32.png"
// //                },
// //                {
// //                    value: "jquery-ui",
// //                    label: "jQuery UI",
// //                    desc: "the official user interface library for jQuery",
// //                    icon: "jqueryui_32x32.png"
// //                },
// //                {
// //                    value: "jquery-ui",
// //                    label: "jQuery UI",
// //                    desc: "the official user interface library for jQuery",
// //                    icon: "jqueryui_32x32.png"
// //                },
// //                {
// //                    value: "jquery-ui",
// //                    label: "jQuery UI",
// //                    desc: "the official user interface library for jQuery",
// //                    icon: "jqueryui_32x32.png"
// //                },
// //                {
// //                    value: "jquery-ui",
// //                    label: "jQuery UI",
// //                    desc: "the official user interface library for jQuery",
// //                    icon: "jqueryui_32x32.png"
// //                },
// //                {
// //                    value: "jquery-ui",
// //                    label: "jQuery UI",
// //                    desc: "the official user interface library for jQuery",
// //                    icon: "jqueryui_32x32.png"
// //                },
// //                {
// //                    value: "sizzlejs",
// //                    label: "Sizzle JS",
// //                    desc: "a pure-JavaScript CSS selector engine",
// //                    icon: "sizzlejs_32x32.png"
// //                }
// //            ];

//             var projects = JSON.parse(projects);
//             //console.log(typeof projects);

//             $("#project").autocomplete({
//                 minLength: 0,
//                 source: projects,
//                 focus: function (event, ui) {
//                     $("#project").val(ui.item.label);
//                     return false;
//                 },
//                 select: function (event, ui) {
//                     $("#project").val(ui.item.label);
//                     $("#project-id").val(ui.item.label);
//                     $("#project-description").html(ui.item.catname);
//                     //$("#project-description").html(ui.item.catid);
//                     var selectVal = $(".custom-selectbox .selected");
//                     var dataVal = $(".select-options li[data-id= "+ui.item.catid+"] a").html();
//                     selectVal.html(dataVal);
//                     $("#cat_id").val(ui.item.catid);
//                     //$("#project-icon").attr("src", "images/" + ui.item.icon);

//                     return false;
//                 }
//             })
//                     .autocomplete("instance")._renderItem = function (ul, item) {
//                 if (item.sub_name == null)
//                 {
//                     item.sub_name = '';
//                 } else {
//                     item.sub_name = ', ' + item.sub_name;
//                 }
//                 return $("<li>")
//                         .append("<div><label>" + item.label + "</label><br><span class='values'>" + 'in ' + item.catname + item.sub_name + "</span></div>")
//                         .appendTo(ul);
//             };





//         }
//     });
}

$(document).on('click', '.most_recent', function () {
    var offset = $('.most_recent').attr('offset_count');
    //console.log("Latitude = " + latitute1 + " Longitude = " + longitude1);
    getClassifiedForMostRecent(latitute1, longitude1, offset, 0);
});

$(document).on('click', '.most_trending', function () {
    var offset = $('.most_trending').attr('offset_count');
    //console.log("Latitude = " + latitute1 + " Longitude = " + longitude1);
    getClassifiedForMostViewed(latitute1, longitude1, offset, 0);
});


var autocomplete = new google.maps.places.Autocomplete($("#headerLocationSearchBox")[0], 
{
   componentRestrictions: {country: "au"},
            types: ['(cities)']
    
});
google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    var place = autocomplete.getPlace();
    //console.log(place);

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

google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    //console.log(place);
    //document.getElementById('placevalue').value = place;
    document.getElementById('headerLocationSearchLat').value = place.geometry.location.lat();
    document.getElementById('headerLocationSearchLong').value = place.geometry.location.lng();
    //console.log(place.address_components);
});

function heightAdjust() {
    if($(window).width() < 320) {
         $('#product-listing .grid-item .listing-inner').unSyncHeight();
    } else {
        
        $('#product-listing .grid-item .listing-inner').syncHeight({updateOnResize: true});
    }
}