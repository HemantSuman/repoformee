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
    <div id="post-add" class="step1">
        <div class="container">
            <div class="title">
                <h1>post an add</h1>

            </div>
            <div class="row">
                <div id="rootwizard">
                    <div class="navbar" style="display: none;">
                        <div class="navbar-inner">
                            <ul>
                                <li>
                                    <a href="#tab1" class="tab1" data-toggle="tab">
                                        <div class="category-name">Select Category</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" class="tab2" data-toggle="tab">
                                        <div class="category-name">Select Subcategory</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" class="tab3" data-toggle="tab">
                                        <div class="category-name">Post Classified</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab4" class="tab4" data-toggle="tab">
                                        <div class="category-name">Post Classified</div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                     {!! Form::open(array("url" => "classifieds/create", "role" => "form", 'files' => true, 'id'=>'submitFrm')) !!} 
                    <div class="tab-content" >
                        <div class="tab-pane" id="tab1">
                            <div class="col-md-6 col-sm-6">
                                <div class="select-cat-box">
                                    <h2>Select a Category</h2>
                                    <ul class="mcustom">
                                        @foreach($parent_cat as $key => $val)
                                        <li>
                                            <a href="javascript:void(0);" categoryId ="{{$val->id}}" class="parent_cat">
                                                <span class="cat-img"><img src="{{ URL::asset("upload_images/categories/icon/$val->id/$val->icon")}}" alt=""></span>
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
                        <div class="tab-pane" id="tab2">
                            <div class="row step3row">
                                <div class="col-sm-6">
                                    <div class="selectedCat">
                                        <a href="javascript:void(0);" class="pCatName"></a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="selectedCat">
                                        <a href="javascript:void(0);" class="cCatName"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row step3row">
                                
                                <input type="hidden" name="parent_categoryid" class="parent_categoryid" >
                                <input type="hidden" name="category_id" class="category_id" >
                                <h3>Enter Details about your ad</h3>
                                <div class="col-sm-8">
                                    {!! Form::input('text', 'title', null, ['id' => 'title1', 'is_required'=>1, 'class' => 'form-control textRequired title','placeholder'=>'Title Name']) !!}

                                </div>
                                <div class="col-sm-4">
                                    <p class="form-control-static">Give your ad a descriptive title to improve its visibility</p>
                                </div>
                            </div>
                            <!--                            <div class="row step3row">
                                                            <div class="col-sm-4">
                                                                <input type="text" name="" value="" placeholder="price($ 3000.00)" class="form-control">
                                                                <span class="error">Error msg</span>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <ul class="contact-surname pricelabel">
                                                                    <li>
                                                                        AUD
                                                                    </li>
                                                                    <li>
                                                                        <input id="Amount" name="price" value=""  type="radio">
                                                                        <label for="Amount">Amount</label>
                            
                                                                    </li>
                                                                    <li>
                                                                        <input id="Negotiable" name="price" value=""  type="radio">
                                                                        <label for="Negotiable">Negotiable</label>
                            
                                                                    </li>
                                                                    <li>
                                                                        <input id="Free" name="price" value=""  type="radio">
                                                                        <label for="Free">Free</label>
                            
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>-->
                            <div class="row step3row">
                                <div class="col-sm-8">
                                   {!! Form::input('number', 'price', null, ['id'=>'price','class' => 'form-control','placeholder'=>'Price (AUD)']) !!}

                                </div>
                                <!--                                <div class="col-sm-1">
                                                                    <span class="audSpan">AUD </span>
                                                                </div>-->
                                <div class="col-sm-7">

<!--                                    <p class="form-control-static">  You will not receive offers notification<br> below the minimum amount</p>-->
                                </div>
                            </div>
                            <div class="" id="attrName">

                            </div>

                            <div class="row step3row">
                                <div class="col-sm-8">
                                    {!! Form::textarea('description', null, ['id' => 'message','class' => 'form-control desc','placeholder'=>'Description','rows'=>5]) !!}
<!--                                    <textarea name="message" id="message" title="Description" rows="5" maxlength="100" placeholder="Message" required class="form-control desc">
                                    </textarea>-->

                                </div>
                                <div class="col-sm-4 textaraeright">
                                    <p class="form-control-static">Did you know it is free to edit your listing for the full duration off your ad?</p>
<!--                                    <span>400 characters left</span>-->
                                </div>
                            </div>
                            
                            <div class="row step3row">


                                <div class="col-sm-4 col-xs-6">
                                    <button type="button" name="button" class="btn backbtn" value="Back">Back</button>
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <button type="button" name="button" class="btn postbtn showfillvalue" value="next">Next</button>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <div id="post-add" class="step4">
                                <div class="container">
                                    <div class="row step3row">
                                        <div class="col-sm-6">
                                            <div class="selectedCat">
                                                <a href="javascript:void(0);" class="pCatName"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="selectedCat">
                                                <a href="javascript:void(0);" class="cCatName"></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row step3row">
                                        <h3>Details about your ad</h3>
                                        <div class="col-sm-8">
                                            <ul class="ad-data static">
                                                <li> <span class="postat"> Title:</span> <span class="titleshow"></span></li>
                                                <li> <span class="postat"> Price:</span> <span class="priceshow"></span></li>
                                               <li class="desc"><span class="descshow postat"> Description:</span>
                                                </li>
                                                
                                            </ul>
                                            <ul class="ad-data dyanamicshow">
                                                
                                                <li> $3000.00 AUD negotiable</li>
                                                <li>$3000.00 AUD Minimum offer</li>
                                                <li>Condition used</li>
                                                
                                                <!--								<li class="adimgWrap">
                                                                                                                        <h4>Images for the ad</h4>
                                                                                                                                <div class="row">
                                                                                                                                                <div class="col-sm-4 col-xs-6">
                                                                                                                                                        <div class="adimg">
                                                                                                                                                                        <img src="assets/img/icons/add-img.jpg" alt="">
                                                                                                                                                        </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-4 col-xs-6">
                                                                                                                                                        <div class="adimg">
                                                                                                                                                                        <img src="assets/img/icons/add-img.jpg" alt="">
                                                                                                                                                        </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-4 col-xs-6">
                                                                                                                                                        <div class="adimg">
                                                                                                                                                                        <img src="assets/img/icons/add-img.jpg" alt="">
                                                                                                                                                        </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-4 col-xs-6">
                                                                                                                                                        <div class="adimg">
                                                                                                                                                                        <img src="assets/img/icons/add-img.jpg" alt="">
                                                                                                                                                        </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-4 col-xs-6">
                                                                                                                                                        <div class="adimg">
                                                                                                                                                                        <img src="assets/img/icons/add-img.jpg" alt="">
                                                                                                                                                        </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-4 col-xs-6">
                                                                                                                                                        <div class="adimg">
                                                                                                                                                                        <img src="assets/img/icons/add-img.jpg" alt="">
                                                                                                                                                        </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-4 col-xs-6">
                                                                                                                                                        <div class="adimg">
                                                                                                                                                                        <img src="assets/img/icons/add-img.jpg" alt="">
                                                                                                                                                        </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-4 col-xs-6">
                                                                                                                                                        <div class="adimg">
                                                                                                                                                                        <img src="assets/img/icons/add-img.jpg" alt="">
                                                                                                                                                        </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-4 col-xs-6">
                                                                                                                                                        <div class="adimg">
                                                                                                                                                                        <img src="assets/img/icons/add-img.jpg" alt="">
                                                                                                                                                        </div>
                                                                                                                                                </div>
                                                
                                                
                                                                                                                                </div>
                                                                                                                </li>-->
                                            </ul>
                                        </div>
                                    </div>


                                    <!--				<div class="row step3row">
                                                                                            <div class="col-sm-12">
                                                                                                    <ul class="contact-surname">
                                                                                                            <li>
                                                                                                                    <input id="mr" name="gender" value=""  type="radio">
                                                                                                                    <label for="mr">Mr</label>
                                                                                                                    <div class="check"></div>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                    <input id="mrs" name="gender" value=""  type="radio">
                                                                                                                    <label for="mrs">Mrs</label>
                                                                                                                    <div class="check"></div>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                    <input id="Ms" name="gender" value=""  type="radio">
                                                                                                                    <label for="Ms">Ms</label>
                                                                                                                    <div class="check"></div>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                    <input id="Other" name="gender" value=""  type="radio">
                                                                                                                    <label for="Other">Other</label>
                                                                                                                    <div class="check"></div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </div>
                                    
                                                                    </div>-->
                                    <div class="row step3row sttcAttrbts">
                                        <div class="col-sm-8"> 
                                            @if((Auth::guard('web')->user()->name))
                                            
                                            {!! Form::input('text', 'contact_name', (Auth::guard('web')->user()->name), ['id'=>'contact_name','class' => 'form-control contact_name staticattribute ','placeholder'=>'Contact Name']) !!}
                                            @else
                                            {!! Form::input('text', 'contact_name', null, ['id'=>'contact_name','class' => 'form-control contact_name staticattribute ','placeholder'=>'Contact Name']) !!}
                                           @endif
                                            <div class="error-message">{{$errors->first('contact_name')}}</div>


                                        </div>
                                    </div>
                                    <div class="row step3row sttcAttrbts">
                                        <div class="col-sm-8">
                                             @if((Auth::guard('web')->user()->email))
                                            {!! Form::input('text', 'contact_email', Auth::guard('web')->user()->email, ['id'=>'contact_email','class' => 'contact_email form-control staticattribute','placeholder'=>'Contact Email']) !!}
                                             @else
                                            {!! Form::input('text', 'contact_email', null, ['id'=>'contact_email','class' => 'contact_email form-control staticattribute','placeholder'=>'Contact Email']) !!}
                                             @endif

                                        </div>
                                        <div class="col-sm-4">
                                            <p class="form-control-static">Your Email will not be displayed</span>
                                        </div>
                                    </div>
                                    <div class="row step3row sttcAttrbts">
                                        <div class="col-sm-8">
                                            @if(!empty((Auth::guard('web')->user()->mobile_no)))
                                          <?php $completephone = (Auth::guard('web')->user()->phonecode).(Auth::guard('web')->user()->mobile_no)?>
                                            {!! Form::input('text', 'contact_mobile', $completephone, ['id'=>'contact_mobile','class' => 'form-control contact_mobile singleNumbernumeric staticattribute','placeholder'=>'Contact Mobile','min'=>'0','readonly' => 'true']) !!}
                                             @else
                                            {!! Form::input('number', 'contact_mobile', null, ['id'=>'contact_mobile','class' => 'form-control contact_mobile singleNumbernumeric staticattribute','placeholder'=>'Contact Mobile','min'=>'0']) !!}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row step3row sttcAttrbts">
                                        <div class="col-sm-8">
                                            {!! Form::input('text', 'website', null, ['id'=>'website','class' => ' form-control website staticattribute','placeholder'=>'Website']) !!}

                                        </div>
                                    </div>
                                    <div class="row step3row sttcAttrbts">
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                 @if(!empty((Auth::guard('web')->user()->location)))
                                                 <input type="hidden" id="lat" name="lat" value="<?php echo Auth::guard('web')->user()->latitude?>" />
                                                 <input type="hidden" id="lng" name="lng" value="<?php echo Auth::guard('web')->user()->longitude?>"/>
                                                <input type="text" name="location" id="address" class="form-control staticattribute" placeholder="Location" value="<?php echo Auth::guard('web')->user()->location?>">
                                                @else
                                                <input type="hidden" id="lat" name="lat" />
                                                <input type="hidden" id="lng" name="lng" />
                                                <input type="text" name="location" id="address" class="form-control staticattribute" placeholder="Location">
                                                @endif
                                                <span class="loctxt">Help users locate your ad by entering your full address or suburb</span>
                                            </div>
<!--							<input type="text" name="" value="" placeholder="Location" class="form-control">
                                                    <span class="loctxt">Help users locate your ad by entering your full address or suburb</span>-->
                                        </div>
                                        <!--								<div class="col-sm-4">
                                                                                                                <p class="form-control-static"> <a href="#">use my current location</a></p>
                                                                                                        </div>-->
                                    </div>
                                    <div class="row step3row sttcAttrbts">
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                @if(!empty((Auth::guard('web')->user()->state)))
                                                {!! Form::input('text', '', (Auth::guard('web')->user()->state), ['id'=>'statevalue','class' => 'form-control statevalue','placeholder'=>'State','readonly' => 'true']) !!}
                                                {!! Form::select('state_id', $state, $statevalueid, ['id' => 'stateid','placeholder' => 'Select ', 'class' => 'stateid staticattribute']) !!}
                                                @else
                                                {!! Form::input('text', '', null, ['id'=>'statevalue','class' => 'form-control statevalue','placeholder'=>'State','readonly' => 'true']) !!}
                                                {!! Form::select('state_id', $state, '0', ['id' => 'stateid','placeholder' => 'Select ', 'class' => 'stateid staticattribute']) !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row step3row sttcAttrbts">
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                @if(!empty((Auth::guard('web')->user()->city)))
                                                {!! Form::input('text', 'subregions_id', (Auth::guard('web')->user()->city), ['id'=>'subregion_id','class' => 'form-control subregion_id staticattribute','placeholder'=>'City','readonly' => 'true']) !!}
                                                @else
                                              {!! Form::input('text', 'subregions_id', null, ['id'=>'subregion_id','class' => 'form-control subregion_id staticattribute','placeholder'=>'City','readonly' => 'true']) !!}
                                               @endif
                                                <div class="error-message">{{$errors->first('subregions_id')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row step3row sttcAttrbts">
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                @if(!empty((Auth::guard('web')->user()->pincode)))
                                                {!! Form::input('text', 'pincode', (Auth::guard('web')->user()->pincode), ['id'=>'pincode','class' => 'pincode form-control staticattribute ','placeholder'=>'PinCode']) !!}
                                                @else
                                                {!! Form::input('text', 'pincode', null, ['id'=>'pincode','class' => 'pincode form-control staticattribute ','placeholder'=>'PinCode']) !!}
                                                @endif
                                                <div class="error-message">{{$errors->first('pincode')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row step3row uploadimg">
                                <h4>Upload images for the ad</h4>
                                <span>for best result we recommend choosing landscape images</span>
                                <div class="col-sm-8">
                                    <input type="file" name="image[]" value="" id="upload-Adimg" class="form-control imagerequried">
                                    
                                </div>
                                <div class="col-sm-4">
                                    <p class="form-control-static"></p>
                                    <p class="form-control-static"></p>
                                    <p class="form-control-static"></p>
                                </div>
                            </div>
                                    <div class="row step3row">
                                        <div class="col-sm-4 col-xs-6">
                                            <button type="button" name="button" class="btn backbtn backchange">Back</button>
                                        </div>
                                        <div class="col-sm-4 col-xs-6">
<!--                                            <button type="button" name="button" class="btn postbtn addpost">Post Ad</button>-->
                                             <input type="submit" name="" value="Submit" class="btn postbtn addpost">
                                        </div>

                                    </div>
                                    
                                </div>

                            </div>

                        </div>
                    </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
</div>

@stop

@section('scripts')
<style>
    
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button {  
    
    -webkit-appearance: "Always Show Up/Down Arrows";
    -moz-appearance: "Always Show Up/Down Arrows";
    opacity: 1;
    
}
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

<script>
$(function () {
//  $('.tab1').click();

    groupedCat = <?php echo json_encode($groupedCat->toarray()); ?>;
    console.log(groupedCat);
});
</script>
<script src="{{ URL::asset('plugins/front/js/post_classified.js') }}"></script> 
<script>
                                                        $(function () {
                                                            stateCode = [$.parseJSON('<?php echo json_encode($stateCode); ?>')];
                                                            stateCode[0][''] = '';
                                                            showStaticAttributes = [$.parseJSON('<?php echo json_encode($showStaticAttributes); ?>')];
                                                        });
                                                        var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {
                                                            //types: ['(cities)'],
                                                            componentRestrictions: {country: "au"},
                                                            types: []
                                                        });
                                                        google.maps.event.addListener(autocomplete, 'place_changed', function () {
                                                            var place = autocomplete.getPlace();

                                                            document.getElementById('lat').value = place.geometry.location.lat();
                                                            document.getElementById('lng').value = place.geometry.location.lng();
                                                            //console.log(place.address_components);

                                                            var place = autocomplete.getPlace();
                                                            for (var i = 0; i < place.address_components.length; i++) {
                                                                var addressType = place.address_components[i].types[0];
                                                                // console.log(addressType);
                                                                if (addressType == 'administrative_area_level_1') {
                                                                    var gStateId = place.address_components[i]['short_name'];
                                                                    var state = place.address_components[i]['long_name'];
                                                                    $('#stateid').val(stateCode[0][gStateId]);
                                                                    $('#statevalue').val(state);
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
                                                            //console.log(place.address_components);
                                                        });
                                                        $("#stateid").css("display", "none");

//                                                        jQuery(document).ready(function () {
//                                                            var html = '<div style="margin: 5px 0 5px 0;" id="image_0"><div class="img_id_0"></div><div class="file-label"><input type="file" onchange="" id="img_id_0" value="" class="addedInput blue image_field textRequired" name="image[0]"></div></div>';
//                                                            jQuery('#more_images').append(html);
//                                                        });
<?php if (Session::has('message')) { ?>
                                                            Notify.showMessage('<?php echo Session::get('message'); ?>', 'success');
<?php } ?>
</script>

@stop


