@extends('front/layout/layout')
@section('content')

<div id="middle" class="no-banner">
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>

                    <li class="active">Post an Ad</li>
                </ol>
            </div>
        </div>
    </section>






    <div id="post-add">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs hide" role="tablist" >
            <li role="presentation" class="active"><a class="tab1" href="#select_category" aria-controls="select_category" role="tab" data-toggle="tab">Select Category</a></li>
            <li role="presentation"><a class="tab2" href="#select_sub_category" aria-controls="select_sub_category" role="tab" data-toggle="tab">Select Subcategory</a></li>
            <li role="presentation"><a class="tab3" href="#post_classified" aria-controls="post_classified" role="tab" data-toggle="tab">Post Classified</a></li> 
            <li role="presentation"><a class="tab5" href="#package_classified" aria-controls="package_classified" role="tab" data-toggle="tab">package_classified</a></li> 
            <li role="presentation"><a class="tab4" href="#advert_preview" aria-controls="advert_preview" role="tab" data-toggle="tab">Advert Preview</a></li>   
        </ul>
        <input type="hidden" id="stateCode" name="stateCode" value="{{json_encode($stateCode)}}">
        <input type="hidden" id="template_arr" name="template_arr" value="">

        <!-- Tab panes -->
        {!! Form::open(array("url" => "user/classifieds/private_post_create", "role" => "form", 'files' => true, 'id'=>'submitFrm')) !!} 
        <div class="tab-content">
            <input type="hidden" name="parent_categoryid" class="parent_categoryid" >
            <input type="hidden" name="category_id" class="category_id" >
            <input type="hidden" name="package_id" class="package_id" >
            <input type="hidden" name="is_premium_parent_cat" class="is_premium_parent_cat" value="0" >
            <input type="hidden" name="is_premium_sub_cat" class="is_premium_sub_cat" value="0" >
            <input type="hidden" name="is_premium" class="is_premium" value="0" >
            <input type="hidden" name="featured_classified" class="featured_classified" value="0" >
            <div role="tabpanel" class="tab-pane active tab-content1" id="select_category">        
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title">
                                <h1>post an add</h1>
                            </div>
                            <div class="ad-category-top-text">
                                <p>We have recognised your subscription plan as <span>Merchant</span>. Below we have provide suitable categories related to your business. Please select your appropriate category and sub category, and start your ad posting.</p>
                            </div>
                        </div>                
                    </div> 
                    <div class="col-md-6 col-sm-6">
                        <div class="select-cat-box">
                            <h2>Select a Category</h2>
                            <ul class="mcustom">
                                @foreach($parent_cat as $key => $val)
                                <li>
                                    <a href="javascript:void(0);" categoryId ="{{$val->id}}" class="parent_cat">
                                        <span class="cat-img"><img class='cat-icon' src="{{ URL::asset("upload_images/categories/icon/$val->id/$val->icon")}}" alt=""></span>
                                        <span class="cat-name">{{$val->name}}</span>
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="selectSubCat emptySubCat">
                            <div class="selectSubinner">
                                <h2>Select a sub category</h2>
                            </div>

                        </div>
                        <div class="selectSubcategory filledSubCat" style="display: none;">
                            <h2>Category</h2>
                            <ul class="mcustom" id="sub-categories" style="overflow:scroll;">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane tab-content2" id="select_sub_category">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ad-sec-inner">
                                <div class="title">
                                    <h1>Post an Ad - Ad Details</h1>
                                </div>
                                <ul class="automotive-car-btns">
                                    <li><a href="javascript:void(0);"><img class="pCatIcon" src=""><span class="pCatName"></span></a></li>
                                    <li><a href="javascript:void(0);"><img class="cCatIcon" src="" ><span class="cCatName"></span></a></li>
                                </ul>

                                <div class="ad-detail-form">
                                    <h3>Enter Details About Your Ad</h3>
                                    <ul class="ad-detail-form-sec">
                                        <li class="no-ad-padding">      
                                            <label>Title</label>
                                            <input is_required="1" id="title" iderr="title-text" class="textRequired" type="text" name="title" >                        
                                            <p class="ad-error" id="title-text_error"></p>
                                        </li>
                                    </ul>
                                    <ul class="ad-detail-form-sec ad-data-form-sec" id="is_sellable_attrs_ul" style="display:none;width: 100%;" >
                                    </ul>
                                    <ul class="ad-detail-form-sec price_ul">

                                    </ul>
                                    <ul class="ad-detail-form-sec" id="attrName">

                                    </ul>
                                    <ul class="ad-detail-form-sec product_description_ul">
                                        <li class="no-ad-padding">                        
                                            <textarea class="ad-descrip" name="product_description" placeholder="Product Description"></textarea>
                                            <p class="ad-error" id="product_description_error"></p>
                                        </li>
                                    </ul>
                                    <ul class="ad-detail-form-sec" id="inspection_date_div">

                                    </ul>
                                    <ul class="ad-detail-form-sec">
                                        <li class="no-ad-padding">                        
                                            <input type="text" name="" placeholder="Type Catch Line.">                        
                                        </li>
                                        <li class="no-ad-padding">                        
                                            <textarea class="ad-descrip default_desc" name="description" placeholder="Description"></textarea>
                                            <span class="form-tag-line">Did you know it's FREE to edit your listing for the full duration of your ad?</span> 
                                            <span class="form-tag-line characters-count">4000 characters left</span>                   
                                        </li>

                                    </ul>
                                    <div id="questions_answer_parent_div" class="additional_ul_li"  style="display:none;">
                                        <h4 class='img-text-ad'><strong>Additional Questions from the Employer</strong>
                                            You can add upto 5 additional questions.
                                        </h4>
                                        <div id="questions_answer_div">

                                        </div>
                                        <ul class="ad-detail-form-sec">
                                            <li class="no-ad-padding">                        
                                                <a class="add_more_ques" href="javascript:void(0);"><i class='fa fa-plus'></i>Add Question</a>                       
                                            </li>
                                        </ul>
                                    </div>

                                    <ul class="ad-detail-form-sec">
                                        <li class="no-ad-padding">  
                                            <input class="back-tab back_content2" type="button" value="Back">
                                            <input class="back-tab next-tab showfillvalue" type="button" value="Next">             
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>                
                    </div>             
                </div>
            </div>
            <div role="tabpanel" class="tab-pane tab-content5" id="package_classified">
                <div class="container">

                    <div class="subscription-head">
                        <div class="subscription-tagline">Upgrade your ad to get more views & more replies</div>
                    </div>

                    <!--<div class="subscription-container">-->
                    <div class="accordion-wrapper">
                        <div class="accordion-row">
                            <div class="accordionContent">
                                <div class="subscription-panel">
                                    @if(count($packages))
                                    <div class="row">
                                        @foreach ($packages as $plan)
                                        <div class="col-md-3 col-sm-3 col-xs-12 subscription-colum subscription-{{$loop->iteration}}">
                                            <?php /* {{ ($plan['is_premium_parent_cat'] == 1) ? 'selected-box':'' }} */ ?>
                                            <div class="subscription-col">
                                                <div class="subscription-top">
                                                    <div class="subscription-categ">{{$plan['package_name']}}</div>
                                                    <div class="subscription-cost">${{$plan['package_price']}}</div>
                                                    <div class="subscription-desc1">INCREASE VIEWS BY</div>
                                                    <div class="subscription-desc">
                                                        + Up to {{$plan['number_image_upload']}} Photos<br />

                                                    </div>
                                                </div>
                                                <div class="subscription-btn">
                                                    <a href="javascript:void(0)" planId="{{$plan['id']}}" class="pinkButton whiteButton planSelectBtn">Select</a>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach

                                    </div>
                                    <div class="subscription-info">Your ad will be live for 30 days.<br>

                                        Based on average results across all categories compared to free ad.
                                    </div>
                                    @else
                                    <div class="subscription-info">
                                        No Plans Available!
                                    </div>
                                    @endif


                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ad-sec-inner">



                                <div class="ad-detail-form">

                                    <ul class="ad-detail-form-sec ad-data-form-sec">

                                        <li>  
                                            <input class="back-tab back_content5" type="button" value="Back">
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>                
                    </div> 

                </div>
            </div>

            <div role="tabpanel" class="tab-pane tab-content3" id="post_classified">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ad-sec-inner">
                                <div class="title">
                                    <h1>Post an Ad - Review Your Ad Details</h1>
                                </div>
                                <ul class="automotive-car-btns">
                                    <li><a href="javascript:void(0);"><img class="pCatIcon" src=""><span class="pCatName"></span></a></li>
                                    <li><a href="javascript:void(0);"><img class="cCatIcon" src="" ><span class="cCatName"></span></a></li>
                                </ul>

                                <div class="ad-detail-form">
                                    <h3>Details About Your Ad</h3>
                                    <ul class="ad-date-lists show_before_attr_prev">
                                    </ul>
                                    <ul class="ad-date-lists show_attr_prev">
                                    </ul>
                                    <ul class="ad-date-lists ">
                                        <li>
                                            <div class="desc showDefaultDesc">Description</div>                      
                                        </li>                   
                                    </ul>
                                    <div class="image-for-ads">
                                        <!--<h3>Details About Your Ad</h3>-->
                                        <!--                                        <ul class="ad-img-list display_images">
                                        
                                                                                </ul>-->

                                    </div>
                                    <!--<h3>Details About Your Ad</h3>-->
                                    <ul class="ad-date-lists job_display">

                                    </ul>

                                    <ul class="ad-date-lists is_features_ul">

                                    </ul>

                                    <ul class="ad-detail-form-sec">
                                        <li class="no-ad-padding">
                                            <h4 class="img-text-ad"><strong> Upload Images for the Ad</strong>
                                                For best results, we recommend choosing landscape images.</h4> 
                                        </li>
                                        <li class="no-ad-padding">
                                            <!--<div class="col-sm-8">-->
                                            <input type="file" name="image[]" value="" id="uploadimg_private" class="">
                                            <span class="form-tag-line">require image size 650*375</span> 
                                            <p class="ad-error" id="uploadimg_private_error"></p>
                                            <!--</div>-->
                                        </li>
                                    </ul>

                                    <div id="is_features_parent_div" class="additional_ul_li" style="display:none;">
                                        <h4 class='img-text-ad'><strong>Additional Feature Information</strong>
                                            about the product.
                                        </h4>
                                        <div id="is_features_div">

                                        </div>
                                        <ul class="ad-detail-form-sec">
                                            <li class="no-ad-padding">                        
                                                <a class="add_more_features" href="javascript:void(0);"><i class='fa fa-plus'></i>Add more</a>                       
                                            </li>
                                        </ul>
                                    </div>

                                    <div id="demo_guides_parent_div" class="additional_ul_li" style="display:none;">
                                        <h4 class='img-text-ad'><strong>Additional Information</strong>
                                            about Demo and Guides.
                                        </h4>
                                        <div id="demo_guides_div">

                                        </div>
                                        <ul class="ad-detail-form-sec">
                                            <li class="no-ad-padding">                        
                                                <a class="add_more_demo_guides" href="javascript:void(0);"><i class='fa fa-plus'></i>Add more</a>                       
                                            </li>
                                        </ul>
                                    </div>

                                    <h3>Agents Contact Details</h3>
                                    <div class="row step3row">
                                        <div class="col-sm-12">
                                            <ul class="contact-surname divCheckBox_static" idErr='contact_title'>
                                                <li>
                                                    <input id="mr" name="contact_title" class="inputCheckBox_static" is_required='1' value="Mr" type="radio">
                                                    <label for="mr">Mr</label>
                                                    <div class="check"></div>
                                                </li>
                                                <li>
                                                    <input id="mrs" name="contact_title" class="inputCheckBox_static" is_required='1' value="Mrs" type="radio">
                                                    <label for="mrs">Mrs</label>
                                                    <div class="check"></div>
                                                </li>
                                                <li>
                                                    <input id="Ms" name="contact_title" class="inputCheckBox_static" is_required='1' value="Ms" type="radio">
                                                    <label for="Ms">Ms</label>
                                                    <div class="check"></div>
                                                </li>
                                                <li>
                                                    <input id="Other" name="contact_title" class="inputCheckBox_static" is_required='1' value="Other" type="radio">
                                                    <label for="Other">Other</label>
                                                    <div class="check"></div>
                                                </li>
                                                <li>
                                                    <p class="ad-error" id="contact_title_error"></p>
                                                </li>

                                            </ul>

                                        </div>     
                                    </div>
                                    <ul class="ad-detail-form-sec ad-data-form-sec">
                                        <li>                        
                                            @if((Auth::guard('web')->user()->name))

                                            {!! Form::input('text', 'contact_name', (Auth::guard('web')->user()->name), ['id'=>'contact_name','class' => 'contact_name textRequired_static ','placeholder'=>'Contact Name', 'is_required' => 1, 'idErr' => 'contact_name']) !!}
                                            @else
                                            {!! Form::input('text', 'contact_name', null, ['id'=>'contact_name','class' => 'contact_name textRequired_static ','placeholder'=>'Contact Name', 'is_required' => 1, 'idErr' => 'contact_name']) !!}
                                            @endif
                                            <p class="ad-error" id="contact_name_error"></p>
                                        </li>
                                        <li>      
                                            @if((Auth::guard('web')->user()->email))
                                            {!! Form::input('text', 'contact_email', Auth::guard('web')->user()->email, ['id'=>'contact_email','class' => 'textRequired_static','placeholder'=>'Contact Email', 'is_required' => 1, 'idErr' => 'contact_email']) !!}
                                            @else
                                            {!! Form::input('text', 'contact_email', null, ['id'=>'contact_email','class' => 'textRequired_static','placeholder'=>'Contact Email', 'is_required' => 1, 'idErr' => 'contact_email']) !!}
                                            @endif
                                            <span class="form-tag-line">Your email address will not be displayed.</span>
                                            <p class="ad-error" id="contact_email_error"></p>
                                        </li>
                                        <li>                        
                                            @if(!empty((Auth::guard('web')->user()->mobile_no)))
                                            <?php $completephone = (Auth::guard('web')->user()->phonecode) . (Auth::guard('web')->user()->mobile_no) ?>
                                            {!! Form::input('text', 'contact_mobile', Auth::guard('web')->user()->mobile_no, ['id'=>'contact_mobile','class' => 'textRequired_static','placeholder'=>'Contact Mobile','min'=>'0','readonly' => 'true', 'is_required' => 1, 'idErr' => 'contact_mobile']) !!}
                                            @else
                                            {!! Form::input('number', 'contact_mobile', null, ['id'=>'contact_mobile','class' => 'textRequired_static','placeholder'=>'Contact Mobile','min'=>'0', 'is_required' => 1, 'idErr' => 'contact_mobile']) !!}
                                            @endif
                                            <p class="ad-error" id="contact_mobile_error"></p>
                                        </li>
                                        <li>                       
                                            @if(!empty((Auth::guard('web')->user()->location)))
                                            <input type="hidden" id="lat" name="lat" value="<?php echo Auth::guard('web')->user()->latitude ?>" />
                                            <input type="hidden" id="lng" name="lng" value="<?php echo Auth::guard('web')->user()->longitude ?>"/>
                                            <input type="text" name="location" id="address" class="textRequired_static" idErr='location' is_required=1 placeholder="Location" value="<?php echo Auth::guard('web')->user()->location ?>">
                                            @else
                                            <input type="hidden" id="lat" name="lat" />
                                            <input type="hidden" id="lng" name="lng" />
                                            <input type="text" name="location" id="address" class="textRequired_static" idErr='location' is_required=1 placeholder="Location">
                                            @endif

                                            <span class="form-tag-line use_mycurrent_location my_current_location">Use my current location</span>
                                            <h5>Help users locate your ad by entering your full address or suburb.</h5>
                                            <p class="ad-error" id="location_error"></p>
                                        </li>                  
                                        <li>                       
                                            @if(!empty((Auth::guard('web')->user()->state)))
                                            {!! Form::input('text', '', (Auth::guard('web')->user()->state), ['id'=>'statevalue','class' => 'statevalue textRequired_static','placeholder'=>'State','readonly' => 'true', 'is_required' => 1, 'idErr' => 'statevalue']) !!}
                                            {!! Form::select('state_id', $state, $statevalueid, ['id' => 'stateid','placeholder' => 'Select ', 'class' => 'hide stateid staticattribute']) !!}
                                            @else
                                            {!! Form::input('text', '', null, ['id'=>'statevalue','class' => 'statevalue textRequired_static','placeholder'=>'State','readonly' => 'true', 'is_required' => 1, 'idErr' => 'statevalue']) !!}
                                            {!! Form::select('state_id', $state, '0', ['id' => 'stateid','placeholder' => 'Select ', 'class' => 'hide stateid staticattribute']) !!}
                                            @endif
                                        </li>                  
                                        <li>                       
                                            @if(!empty((Auth::guard('web')->user()->city)))
                                            {!! Form::input('text', 'subregions_id', (Auth::guard('web')->user()->city), ['id'=>'subregion_id','class' => 'subregion_id textRequired_static','placeholder'=>'City','readonly' => 'true', 'is_required' => 1, 'idErr' => 'subregion_id']) !!}
                                            @else
                                            {!! Form::input('text', 'subregions_id', null, ['id'=>'subregion_id','class' => 'subregion_id textRequired_static','placeholder'=>'City','readonly' => 'true', 'is_required' => 1, 'idErr' => 'subregion_id']) !!}
                                            @endif
                                        </li>                  
                                        <li>                       
                                            @if(!empty((Auth::guard('web')->user()->pincode)))
                                            {!! Form::input('text', 'pincode', (Auth::guard('web')->user()->pincode), ['id'=>'pincode','class' => 'pincode textRequired_static','placeholder'=>'PinCode', 'is_required' => 1, 'idErr' => 'pincode']) !!}
                                            @else
                                            {!! Form::input('text', 'pincode', null, ['id'=>'pincode','class' => 'pincode textRequired_static','placeholder'=>'PinCode', 'is_required' => 1, 'idErr' => 'pincode']) !!}
                                            @endif
                                        </li>                  
                                        <li>  
                                            <input type="hidden" name="suburbs_id" id="suburbs_id" value="" />
                                            <input class="back-tab back_content3" type="button" value="Back">
                                            <input class="back-tab next-tab finalSubmitBtn" type="button" value="Next">             
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>                
                    </div>             
                </div>      
            </div>
            <div role="tabpanel" class="tab-pane detail_prev tab-content4" id="advert_preview">

            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<span class="categoryJson" style="display: none;">{{$parentCategory->toJson()}}</span>
<span class="packagesjson" style="display: none;">{{$packages->groupBy('id')->toJson()}}</span>
@stop

@section('scripts')
<style>
</style>
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU"></script>
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">-->
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.skinNice.css') }}">
<!--<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<script src="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('plugins/front/js/post_classified.js') }}"></script>-->
<script src="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ URL::asset('plugins/admin/plugins/ionslider/scrollBar.js') }}"></script>
<script src="{{ URL::asset('plugins/front/js/private_post_classified.js') }}"></script>
<script src="{{ URL::asset('plugins/front/js/async.js') }}"></script>
<script type="text/javascript">
$(".sb-container").scrollBox();

$(function () {

//    $('.pCatName').text($('.parent_cat:first').find('.cat-name').text());
//    $('.pCatIcon').attr('src', $('.parent_cat').find('.cat-icon').attr('src'));
//    $('.parent_cat').find()

});

var stateCode = [$.parseJSON($('#stateCode').val())];
var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {
    //types: ['(cities)'],
    componentRestrictions: {country: "au"},
    types: []
});

google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();

    document.getElementById('lat').value = place.geometry.location.lat();
    document.getElementById('lng').value = place.geometry.location.lng();

    var place = autocomplete.getPlace();
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        console.log(place.address_components);
        console.log(addressType);
        if (addressType == 'administrative_area_level_1') {
            var gStateId = place.address_components[i]['short_name'];
            var state = place.address_components[i]['long_name'];
            $('#stateid').val(stateCode[0][gStateId]);
            $('#statevalue').val(state);
        }
        if (addressType == 'administrative_area_level_2') {
            var state2 = place.address_components[i]['long_name'];
        }
        if (addressType == 'locality') {
            var gCityCode = place.address_components[i]['long_name'];
            console.log(gCityCode);
            $('#subregion_id').val(gCityCode);
        }
        if (addressType == 'postal_code') {
            var gPostalCode = place.address_components[i]['short_name'];
            $('#pincode').val(gPostalCode);
        }
    }

    var location_str = state + " " + state2 + " " + gCityCode;

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
});


$(document).on('click', '.my_current_location', function () {

//    var startPos;
//    var nudge = document.getElementById("nudge");
//
//    var showNudgeBanner = function () {
//        nudge.style.display = "block";
//    };
//
//    var hideNudgeBanner = function () {
//        nudge.style.display = "none";
//    };
//
//    var nudgeTimeoutId = setTimeout(showNudgeBanner, 5000);
//
//    var geoSuccess = function (position) {
//        hideNudgeBanner();
//        // We have the location, don't display banner
//        clearTimeout(nudgeTimeoutId);
//
//        // Do magic with location
//        startPos = position;
//        document.getElementById('startLat').innerHTML = startPos.coords.latitude;
//        document.getElementById('startLon').innerHTML = startPos.coords.longitude;
//    };
//    var geoError = function (error) {
//        switch (error.code) {
//            case error.TIMEOUT:
//                // The user didn't accept the callout
//                showNudgeBanner();
//                break;
//        }
//    };
//
//    navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
});
</script>

@stop


