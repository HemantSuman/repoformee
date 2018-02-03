@extends('front/layout/layout')
@section('content')

<?php //dd($result); ?>

<div id="middle" class="no-banner">
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>

                     <li class="active">{{ $result->title }}</li>
                </ol>
            </div>
        </div>
    </section>
    
    
    <div class="real-estate-main-sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="backtosearch-bar">
           <a class="backtosearch-btn" href="#"><i class="fa fa-caret-left"></i> Back to Search</a>
           <div class="details-save-socail-sec">
             <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i><span>Save this Car</span></a>
             
             <ul class="details-social-btn">
              <li><a href="#" class='st_facebook_large' displayText='Facebook' ><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon"></a></li>
               <li><a href="#" class='st_twitter_large' displayText='Tweet'><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>
               <li><a href="#"  class='st_googleplus_large' displayText='Google +'><img src="{{ URL:: asset('/plugins/front/img/insta-icon.png')}}" alt="insta-icon"></a></li>
             </ul>
           </div>
        </div>
      </div>
    </div>
    <div class="row">      
        <div class="col-sm-8">
           <div class="preview-ad-left real-estate-detal-left">
             <h2 class="preview-ad-title">{{ $result->title }}
              <span><img src="{{ URL:: asset('/plugins/front/img/ad-price-icon.png')}}" alt="img"> @if($result->price > 0)    
                                            ${{ $result->price }}
                                            @endif</span>
            </h2>
             <div class="preview-ad-thumbs">
               <div class="ad-large-thumb">
                  <section class="slider-for slider">
    
     @foreach($result->classified_image as $key => $value)
    <div> 
      <img src='{{ url("/upload_images/classified/$result->id/$value->name") }}' />
    </div>
    @endforeach
    
    
  </section>
               </div>
<div class="ad-sm-thumb">
  <section class="slider-nav slider">
    @foreach($result->classified_image as $key => $value)              
    <div>
      <img src='{{ url("/upload_images/classified/$result->id/$value->name") }}' />
    </div>
    @endforeach
    
   

  </section>               
</div>



             </div>
             <ul class="preview-meter-list">
             <?php $num = 0;?>
             @foreach($result->classified_attribute as $key => $value)
             <?php if($num >4) continue; ?>
             	@if($value->show_list == 1)
                	@if(in_array($value->attr_type_name,['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))
                                        @if(in_array($value->attr_type_name, ["Drop-Down"]))
                                        <li>
                                            <span>{{$value->display_name}}</span>
                                           <strong><img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="img"> {{$value->attr_AllValues[$value->attr_value]}}</strong>
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["Radio-button"]))
                                        <li>
                                            <span>{{$value->display_name}}</span>
                                            <strong><img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="img">{{ $result->multi_select[$value['attribute_id']]['attribute_value'][$result->multi_select[$value['attribute_id']]['selected'][0]] }}</strong>
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["calendar", "Date", "Time"]))
                                        <li>
                                            <span>{{$value->display_name}}</span>
                                           <strong><img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="img">{{ str_replace(';',' - ',$value->attr_value ) }}</strong>
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["Color"]))
                                        <li>
                                            <span>{{$value->display_name}}</span>
                                            <span style=" display: inline-block; margin: 10px; background-color:{{$value->attr_value}}"></span>
                                        </li>
                                        @else
                                        <li>
                                            <span>{{$value->display_name}}</span>
                                          <strong><img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="img"> {{$value->attr_value}}</strong>
                                        </li>
                                        @endif
                                        @endif
                <?php $num++; ?>
                @endif
             @endforeach
                 
             </ul>
             <div class="ad-seller-description">
              
                <?php if (isset($result->description) && $result->description != '') { ?>
                                         <h3>Seller's Description</h3>
                 <p>{{ strip_tags($result->description) }}</p>
                <?php } ?>
             </div>
             <div class="ad-preview-tab-sec">
                 <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#essential_information" aria-controls="essential_information" role="tab" data-toggle="tab"><span>Essential Information</span> </a></li>
                  <li role="presentation"><a href="#details" aria-controls="details" role="tab" data-toggle="tab"><span>Details</span> </a></li>
                  <li role="presentation"><a href="#seller_location" aria-controls="seller_location" role="tab" data-toggle="tab"><span>Seller Location</span> </a></li>
                </ul> 
                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="essential_information">
                    <div class="ad-preview-tab-detail">
                    <?php //dd($result->classified_attribute); ?>
                      <ul>
                       @foreach($result->classified_attribute as $key => $value)
                                        @if(in_array($value->attr_type_name,['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))
                                        @if(in_array($value->attr_type_name, ["Drop-Down"]))
                                        <li>
                                            <label>{{$value->display_name}}</label>
                                            {{$value->attr_AllValues[$value->attr_value]}}
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["Radio-button"]))
                                        <li>
                                            <label>{{$value->display_name}}</label>
                                            {{ $result->multi_select[$value['attribute_id']]['attribute_value'][$result->multi_select[$value['attribute_id']]['selected'][0]] }}
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["calendar", "Date", "Time"]))
                                        <li>
                                            <label>{{$value->display_name}}</label>
                                           {{ str_replace(';',' - ',$value->attr_value ) }}
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["Color"]))
                                        <li>
                                            <label>{{$value->display_name}}</label>
                                            <span style=" display: inline-block; margin: 10px; background-color:{{$value->attr_value}}"></span>
                                        </li>
                                        @else
                                        <li>
                                            <label>{{$value->display_name}}</label>
                                           {{$value->attr_value}}
                                        </li>
                                        @endif
                                        @endif
                                        @endforeach
                                       
                                        @if(isset($result->multi_select))
                                        @foreach($result->multi_select as $key => $value)
                                        @if(in_array($value['attr_type_name_multi'],['Multi-Select']))
                                        <li>
                                            <label>{{$value['name']}}</label>
                                           
                                                @foreach($value['selected'] as $k => $v)
                                                <?php if ($k != 0) echo ', '; ?>{{ $value['attribute_value'][$v] }}
                                                @endforeach
                                            
                                        </li>
                                        @endif
                                        @endforeach
                                        @endif
                                        
                                        
                                        
                        
                       
                      </ul>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="details">
                    <div class="ad-preview-tab-detail">
                      <p>Sample peragraph text</p>
                      <ul>
                        <li>
                          <label>Vehicle</label>
                          W205 Sedan 4dr 7G-TRONIC + 7sp 2.0T [Jan]
                        </li>
                        <li>
                          <label>Price</label>
                          $69,900 Drive Away
                        </li>
                        <li>
                          <label>Kilometers</label>
                          4,685 km
                        </li>
                        <li>
                          <label>Colour</label>
                          Cavansite Blue
                        </li>
                        <li>
                          <label>Transmission</label>
                          7 Speed Sports Automatic
                        </li>
                        <li>
                          <label>Body</label>
                          4 Doors - 5 Seat - Sedan
                        </li>
                        <li>
                          <label>Drive Type</label>
                          Rear Wheel Drive
                        </li>
                        <li>
                          <label>Engine</label>
                          4 Cylinder Petrol Turbo Intercooled 2.0L
                        </li>
                        <li>
                          <label>Registration Expiry</label>
                          1 Month - August 2017
                        </li>
                        <li>
                          <label>Fuel Economy</label>
                          6 (L/100km)
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="seller_location">
                    <div class="ad-preview-tab-detail">
                      <div class="real-es-detail-location">
                       @if(!empty($result->location))
    <div class="widgets widgets-map">
        <div class="mapadder">
            <ul>
               
                <li>
                    {{ $result->location }}
                    <!-- <span>15 km away</span> -->
                </li>
            </ul>
            <?php /* <img src="{{ URL:: asset('/plugins/front/img/map.png') }}" alt=""> */ ?>
            <div id="detail-map" class="detail_sidebar"></div>
        </div>
    </div>
    @endif
    
                       <?php /*?> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50422.47322940408!2d144.93524652180866!3d-37.827413420253535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2sMelbourne+VIC+3004%2C+Australia!5e0!3m2!1sen!2sin!4v1509708517172" class="detail-map-area" allowfullscreen></iframe><?php */?>
                      </div>
                    </div>
                  </div>
                </div>
             </div>
           </div>
        </div>
        <div class="col-sm-4">
              <div class="ad-preview-right real-estate-sidebar">
                <div class="make-a-enquiry-form">
                  <h2>MAKE AN ENQUIRY</h2>
                  <form method="post">
                  <ul>
                    <li><input type="text" placeholder="Name" name="e_name" class="e_name"></li>
                    <li><input type="text" placeholder="Email" name="e_email" class="e_email"></li>
                    <li><input type="text" placeholder="Telephone" name="e_phone" class="e_phone"></li>
                    <li><textarea placeholder="Message" class="e_msg" name="e_msg"></textarea></li>
                    <li>
                      <div class="trade-in-radio">
                       <p>Would you like to trade in?</p>
                       <p><input type="radio" id="test1" name="e_trade" checked value="1"><label for="test1">Yes</label></p>  
                       <p><input type="radio" id="test2" name="e_trade" value="0">     <label for="test2">No</label></p>
                      </div>
                    </li>
                    <li><p class="s-msg-info">By clicking on the "Send Message" button you are agreeing to Formee's Terms and Conditions and Privacy Policy.</p></li>
                    <li><input type="button" class="send-enq-msg" name="e_submit" value="Send Message"></li>
                  </ul>
                  <input type="hidden" class="receiver_id" name="receiver_id" value="{{ $result->user_id }}" > 
                  <input type="hidden" class="classified_id" name="classified_id" value="{{ $result->id }}" >
                  </form>
                </div>
                <div class="show-number-ad">
                   <?php /*?><span><img src="{{ URL:: asset('/plugins/front/img/ad-num-phone.png')}}" alt="img" class="img-responsive"></span>
                   ********000    <a href="#">Show Number</a><?php */?>
                   
                   <span><img src="{{ URL:: asset('/plugins/front/img/ad-num-phone.png') }}" alt="" class="img-responsive"></span>
                    <div class="hide-num mob_number" style="float:left;">*******<?php echo substr($result->contact_mobile, 6, 4); ?></div>
                    <!-- <span clasa="hide-num">******8065</span> -->
                    @if((Auth::guard('web') !== null) && (Auth::guard('web')->user())) 
                    <a <?php echo $result->classified_users['mobile_no']; ?>  href="javascript:void(0)" class="show-number" data-value="<?php echo $result->contact_mobile; ?>">Show number</a> 
                    @endif
                    
                </div>

                <div class="sidebar-products-box">
                <?php //dd($similarAdds); ?>
                 @if(isset($similarAdds) && !empty($similarAdds))
                  <h2>Cars Like This</h2>
                  @foreach ($similarAdds as $key => $value)
                   <?Php $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $value['title']); ?>
                  <div class="sidebar-products-list">
                    <div class="sidebar-products-thumb">
                      <a href='{{ url("/classifieds/$encodetitle/$value[id]") }}'><?php
                                                        if (!empty($value['classified_image'])) {
                                                            $src = $value['id'] . '/' . $value['classified_image'][0]['name'];
                                                        } else {
                                                            $src = '';
                                                        }
                                                        ?>
                                                        <img src='{{ url("/upload_images/classified/$src") }}' alt="Classified image"></a>
                    </div>
                    <a href='{{ url("/classifieds/$encodetitle/$value[id]") }}' class="product-title">{!! str_limit($value['title'],20) !!}</a>
                    <?php /*?><ul class="product-years-model">
                      <li><a href="#">Year</a></li>
                      <li><a href="#">Model Name</a></li>
                    </ul><?php */?>
                    <ul class="breadcrumb">
                      <li><a href="#">Home</a> </li>
                      <li><a href="#">Automotive</a> </li>
                      <li><a href="#">Cars & Vans</a> </li>
                      <li><a href="#">Mercedes Benz</a> </li>
                    </ul>
                    <div class="sidebar-product-save">
                      @if(in_array($value['id'], $wishlistItems))
                                                    <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $value['id'] }}">
                                                        <div class="heart" data-id="{{ $value['id'] }}">
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                        </div>
                                                    </a>
                                                    @else
                                                    <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $value['id'] }}">
                                                        <div class="heart">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                        </div>
                                                    </a>
                                                    @endif
                      <h4>@if(!empty($value['location']))
                                                        @if(!empty($value['city']))
                                                        <?php //$expSimLoc = explode(',', trim($value['location']));
                                                        //dd($expSimLoc);
                                                        ?>
                                                        <span>{{ $value['city']['City'] }}</span>
                                                        @endif
                                                        @endif
                                                         <br>{!! Helper::time_since(time() - strtotime($value['created_at'])) !!} ago</h4>
                    </div>
                  </div>
                  @endforeach
                 @endif
                  
                  
                  <?php /*?><div class="btn-sec">
                    <a href="#">See More</a>
                  </div><?php */?>
                </div>
              </div> 
        </div>      
    </div>
  </div>
</div>
    



</div>    




@stop

@section('scripts')
<script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=af574cb1-c8d1-456e-983c-4fcac8797a90"></script>
<script type="text/javascript">stLight.options({publisher: "af574cb1-c8d1-456e-983c-4fcac8797a90", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU?sensor=false"></script>

<script type="text/javascript">

$.ajax({
    url: root_url + '/classifieds/increase_count',
    data: {
        "_token": $('meta[name="csrf-token"]').attr('content'),
        "classified_id": $('.classified_id_new').val(),
    },
//        dataType: "html",
    method: "POST",
    cache: false,
    success: function (response) {

    },
    error: function (data) {

    }
});

$("#makeAnOfferForm").validate({
    rules: {
        offer_price: {
            required: true,
            number: true,
            min: 1
        }
    },
    submitHandler: function (form) {
        makeOfferPrice();
    }
});

//ajax for make a offer 
function makeOfferPrice() {
    if ($("#loginUserId").val()) {
        $(".loadingMakeOfferDiv i").removeClass("hide")
        var offerprice = $('.offer_price').val();
        $(".loadingMakeOfferDiv i").addClass("hide")
        $('.offer_price').val("")
        //Notify.showNotification("Your offer has been sent to the seller.", "success")
        $.ajax({
            url: root_url + '/user/messages/create',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "offer_price": offerprice,
                "classified_id": $('.classified_id').val(),
                "receiver_id": $('.receiver_id').val(),
            },
            method: "POST",
            cache: false,
            success: function (response) {
                if (response.status) {
                    $(".loadingMakeOfferDiv i").addClass("hide")
                  //  $('.offer_price').val("")
                    Notify.showNotification("Your offer has been sent to the seller.", "success")
                } else {
                    $(".loadingMakeOfferDiv i").addClass("hide")
                    Notify.showNotification(response.message, "error")
                }
            },
            error: function (data) {

            }
        });
    } else {
        Notify.showNotification("You must be logged in to perform this action", "error")
    }
}


$(document).on("click", ".send-enq-msg", function (e) {
		//alert("hello");
	if ($('.e_name').val() == '') {
        Notify.showNotification('Please enter your name', 'error');
        return false;
    }
	if ($('.e_email').val() == '') {
        Notify.showNotification('Please enter your Email id', 'error');
        return false;
    }
	if ($('.e_phone').val() == '') {
        Notify.showNotification('Please enter your Phone No.', 'error');
        return false;
    }
	if ($('.e_msg').val() == '') {
        Notify.showNotification('Please enter Message', 'error');
        return false;
    }
	
	var e_name = $('.e_name').val();
    $('.e_name').val('');
     var e_email = $('.e_email').val();
    $('.e_email').val('');
     var e_phone = $('.e_phone').val();
    $('.e_phone').val('');
     var e_msg = $('.e_msg').val();
    $('.e_msg').val('');

	$.ajax({
        url: root_url + '/classifieds/send_enq_msg',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "classified_id": $('.classified_id').val(),
            "receiver_id": $('.receiver_id').val(),
            "e_name": e_name,
			"e_email": e_email,
			"e_phone": e_phone,
			"e_msg": e_msg,
        },
        method: "POST",
        cache: false,
        success: function (response) {
//                $('.msgTextBox').val('');
                Notify.showNotification('Your message has been sent successfully.', 'success');
        },
        error: function (data) {

        }
    });
	
});

$(document).on("click", ".sendMsgBtn", function (e) {

    if ($('.msgTextBox').val() == '') {
        Notify.showNotification('Please enter message', 'error');
        return false;
    }

    if (!$("#loginUserId").val()) {
        Notify.showNotification("You must be logged in to perform this action", "error")
        return false;
    }


    var msg_tx = $('.msgTextBox').val();
    $('.msgTextBox').val('')
    Notify.showNotification('Your message has been sent successfully.', 'success');
    $.ajax({
        url: root_url + '/user/classifieds/send_msg_popup',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "classified_id": $('.classified_id').val(),
            "receiver_id": $('.receiver_id').val(),
            "msgTeaxArea": msg_tx,
        },
        method: "POST",
        cache: false,
        success: function (response) {
//                $('.msgTextBox').val('');
//                Notify.showNotification('Your message has been sent successfully.', 'success');
        },
        error: function (data) {

        }
    });
});

$(document).on('click', '.show-number', function () {
    $('.mob_number').text($(this).attr("data-value"));
    $('.show-number').hide();
});



<?php if (!empty($result->lat) && !empty($result->lng)) { ?>
    function myMap() {
        var msq_latitude = <?php echo $result->lat; ?>;
        var msq_logtitude = <?php echo $result->lng; ?>;
        var myCenter = new google.maps.LatLng(msq_latitude, msq_logtitude);
        var mapCanvas = document.getElementById("detail-map");
        var mapOptions = {center: myCenter, zoom: 8};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position: myCenter});
        marker.setMap(map);
    }
    $(function () {
        myMap();
    });
<?php } ?>






</script>
<!-- Use for social share -->
@stop