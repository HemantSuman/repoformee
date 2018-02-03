@extends('front/layout/layout')
@section('content') 
<!-- include header -->

<div id="middle" class="detail-middle"> 
    <div class="membershipPlanDiv"> 
        <!-- breadcrumb section -->
        <section>
            <div id="breadcrumb-banner">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="active">Membership Plans</li>
                    </ol>
                </div>
            </div>
        </section>

        <!-- categories section -->
        <section>
            <div id="main-inner-section">
                <div class="container">
                    <div class="subscription-content">
                        <div class="subscription-head">
                            <div class="subscription-thanks"><img src="{{ URL::asset('/plugins/front/img/thank-you-note.png') }}" alt="logo"></div>
                            <div class="subscription-head-logo"><img src="{{ URL::asset('/plugins/front/img/logo.png') }}" alt="logo"></div>
                            <div class="subscription-tagline">Now it's time to chose your subscription...</div>
                        </div>

                        <div class="subscription-container"><div class="accordion-wrapper">
                                @foreach ($membership_plan as $value)
                                <div class="accordion-row">
                                    <div class="accordionButton">{{$value->name}}</div>

                                    <div class="accordionContent">
                                        <div class="subscription-panel">
                                            @if(count($value['role_membership_plans']))
                                            <div class="row">
                                                @foreach ($value['role_membership_plans'] as $plan)
                                                <div class="col-md-3 col-sm-3 col-xs-12 subscription-colum subscription-{{$loop->iteration}}">
                                                    <?php /* {{ ($plan['is_premium_parent_cat'] == 1) ? 'selected-box':'' }} */ ?>
                                                    <div class="subscription-col">
                                                        <div class="subscription-top">
                                                            <div class="subscription-categ">{{$plan['plan_name']}}</div>
                                                            <div class="subscription-cost">${{$plan['plan_price']}}/{{$plan['plan_type']}}</div>
                                                            <div class="subscription-desc1">For Larger Teams</div>
                                                            <div class="subscription-desc">
                                                                {{$plan['job_post_count']}} Job Posts<br />
                                                                {{$plan['featured_ads_count']}} Featured Ads<br />
                                                                
                                                                @if($plan['is_video'])
                                                                Video Upload<br />
                                                                @endif
                                                                
                                                                @if($plan['is_youtube'])
                                                                Youtube URL<br />
                                                                @endif
                                                                </div>
                                                        </div>
                                                        <div class="subscription-btn">
                                                            <a href="javascript:void(0)" planId="{{$plan['id']}}" class="pinkButton whiteButton planSelectBtn">Select</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                @endforeach

                                            </div>
                                            <div class="subscription-info">Enterprises: Need more than 20 Super Cool Points? <a href="javascript:void(0)">Contact Sales</a>.<br />

                                                We also offer a limited Free Version (1Super Cool Thingy, Up to 5 Per Month). Just <a href="javascript:void(0)">Sign Up Now</a>
                                            </div>
                                            @else
                                            <div class="subscription-info">
                                                No Plans Available!
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                @endforeach

                            </div></div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="becomeMemberDiv"> </div>
</div>


@stop

@section('scripts')
<script>
    $(document).ready(function () {

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
		
		/*** open first child ***/
		$('.accordion-row:first-child .accordionContent').show('normal').prev('.accordionButton').addClass('on');

//*************Accordion end*************//
    });

    $(document).on('click', '.planSelectBtn', function () {

        var thisObj = $(this);
        var planId = $(thisObj).attr('planId');
        console.log(planId);

        if (typeof loginid != 'undefined') {

            $.ajax({
                url: root_url + '/get_become_a_member_form',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    planId: planId,
                },
                method: "POST",
                cache: false,
                success: function (response) {

                    $('.membershipPlanDiv').hide();
                    $('.becomeMemberDiv').html(response);

                    var stateCode = [$.parseJSON($('#stateCode').val())];
                    var autocomplete = new google.maps.places.Autocomplete($("#location")[0], {
                        types: [],
                        componentRestrictions: {country: "au"}
                    });
                    google.maps.event.addListener(autocomplete, 'place_changed', function () {
                        var place = autocomplete.getPlace();

                        document.getElementById('lat').value = place.geometry.location.lat();
                        document.getElementById('lng').value = place.geometry.location.lng();

                        var place = autocomplete.getPlace();
                        console.log(place.address_components);
                        for (var i = 0; i < place.address_components.length; i++) {
                            var addressType = place.address_components[i].types[0];
                            if (addressType == 'administrative_area_level_1') {
                                var gStateId = place.address_components[i]['short_name'];
                                var state = place.address_components[i]['long_name'];
                                $('#stateid').val(stateCode[0][gStateId]);
                                $('#statevalue').val(state);
                            }

                            if (addressType == 'locality') {
                                var gCityCode = place.address_components[i]['long_name'];
                                $('#subregion_id').val(gCityCode);
                            }
                            if (addressType == 'postal_code') {
                                var gPostalCode = place.address_components[i]['short_name'];
                                $('#pincode').val(gPostalCode);
                                $('#city_postal').val(gPostalCode);
                            }
                        }
                    });


                }
            });

        } else {
            $('#signup').click();
        }

    });

    $(document).on('submit', '#memberShipForm', function (event) {
        event.preventDefault();
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
                if (typeof response != 'undefined') {
                    if (response.status) {
                       // window.location.href = root_url + response.url;
						window.location.href = response.url;
                    } else {
                        //window.location.href = root_url + response.url;
						window.location.href = response.url;
                    }
                }
            },
            error: function (data) {

                var dataObj = JSON.parse(data.responseText);
                $('.errorMsg').html('')
                console.log(dataObj);
                var addressFields = ['lat', 'lng', 'pincode', 'statevalue', 'subregion_id'];
                $.each(dataObj, function (index, value) {
                    if (addressFields.indexOf(index) >= 0) {
                        index = 'location';
                    }
                    $('#' + index + '_error').html(value);
                });
            }
        });
    });

    $(document).on('click', '.memPlanBreadcrumb', function () {
        $('.membershipPlanDiv').show();
        $('.becomeMemberDiv').html('');
    });


</script> 


@stop

