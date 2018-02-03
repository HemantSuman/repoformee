@extends('front/layout/layout')
@section('content')

 <input type="hidden" name="loginUserId" id="loginUserId" value="{{ Auth::guard('web')->user() ? Auth::guard('web')->user()->id : null }}">
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
                         <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i><span>Save this Job</span></a>
                         
                         <ul class="details-social-btn">
                           <li><a href="#" class='st_facebook_large' displayText='Facebook' ><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon"></a></li>
               <li><a href="#" class='st_twitter_large' displayText='Tweet'><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>
               <li><a href="#"  class='st_googleplus_large' displayText='Google +'><img src="{{ URL:: asset('/plugins/front/img/insta-icon.png')}}" alt="insta-icon"></a></li>
                         </ul>
                       </div>
                    </div>
                    <?php //dd($result);
					$companyname = '';
					$Aboutthejobrole='';
					$Aboutthecompany='';
					$Tobecomesuccessfulcandidate ='';
					$Thebenefityouwillget='';
					$HowtoApply ='';
					?>
                     @foreach($result->classified_attribute as $key => $value)
                        @if($value->show_list == 1)
                            @if($value->name == "company_name")
                                <?php $companyname = $value->attr_value;?>
                            @endif
                        @endif
                         @if($value->name == "About the job role")
                                <?php $Aboutthejobrole = $value->attr_value;?>
                         @endif
                         @if($value->name == "About the company")
                                <?php $Aboutthecompany = $value->attr_value;?>
                         @endif
                         @if($value->name == "Tobecomesuccessfulcandidate")
                                <?php $Tobecomesuccessfulcandidate = $value->attr_value;?>
                         @endif
                         @if($value->name == "The benefit you will get")
                                <?php $Thebenefityouwillget = $value->attr_value;?>
                         @endif
                         @if($value->name == "HowtoApply")
                                <?php $HowtoApply = $value->attr_value;?>
                         @endif
                     
                     @endforeach
                    <div class="job-detail-main-title">
                     <h2 class="product-side-title">{{ $result->title }} <span>{{ $companyname }} | <a href="#">More jobs from this advertiser</a> </span>  </h2>
                    </div>
                </div>
            </div>  
            <div class="row">      
                <div class="col-sm-3">
                    <aside class="job-leftside">
                        <div class="job-company-thumb">
                        <?php $num = 0; ?>
                        @foreach($result->classified_image as $key => $value)
                        <?php if($num > 0) continue;?>
                        	<img src='{{ url("/upload_images/classified/$result->id/$value->name") }}' class="img-responsive" />
                        <?php $num ++ ;?>    
                        @endforeach
                         
                          <span>{{ $companyname }}</span> 
                        </div>
                        <div class="job-apply-location-box">
                            <div class="job-apply-box">
                                <ul class="product-addtocart-save">
                                 @if(!(Auth::guard('web')->user()))
                                    <li>
                                      <a class="addtocart-btn" href='{{url("classifieds-job/job-login/$result->id")}}'>APPLY</a>
                                    </li>
                                 @else
                                 	 <li>
                                      <a class="addtocart-btn" href='{{url("classifieds-job/job-apply/$result->id")}}'>APPLY</a>
                                    </li>
                                 @endif   
                                    <li>
                                      <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                                    </li>
                              </ul>
                            </div>
                            <ul class="job-left-preview">
                               <?php $num = 0;?>
             @foreach($result->classified_attribute as $key => $value)
             <?php if($num >4) continue; ?>
             	@if($value->show_list == 1)
                	@if(in_array($value->attr_type_name,['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric','Radio-button']))
                                        @if(in_array($value->attr_type_name, ["Drop-Down"]))
                                        <li>
                                        <img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="img">
                                            <label>{{$value->display_name}}</label>
                                            <p>{{$value->attr_AllValues[$value->attr_value]}}</p>
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["Radio-button"]))
                                        <li>
                                           <img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="img">
                                           <label>{{$value->display_name}}</label>
                                            <p>{{ $result->multi_select[$value['attribute_id']]['attribute_value'][$result->multi_select[$value['attribute_id']]['selected'][0]] }}</p>
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["calendar", "Date", "Time"]))
                                        <li>
                                            <img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="img">
                                            <label>{{$value->display_name}}</label>
                                           <p>{{ str_replace(';',' - ',$value->attr_value ) }}</p> 
                                        </li>
                                        @elseif(in_array($value->attr_type_name, ["Color"]))
                                        <li>
                                            <label>{{$value->display_name}}</label>
                                            <p style=" display: inline-block; margin: 10px; background-color:{{$value->attr_value}}"></p>
                                        </li>
                                        @else
                                        <li>
                                        <img src='{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}' alt="img">
                                            <label>{{$value->display_name}} </label>
                                            @if($value['name'] == "salary_range")
                                                            	<?php $salary_range = explode(";", $value['attr_value']);?>
                                                                <p> <?php echo '$'.$salary_range[0].' - $'.$salary_range[1];?></p>
                                           @else
                                          <p> {{$value->attr_value}}</p>
                                          @endif
                                        </li>
                                        @endif
                                        @endif
                <?php $num++; ?>
                @endif
             @endforeach
                               <li class="no-padding">                               
                                  <label>SHARE</label>
                                  <ul class="details-social-btn">
                                       <li><a href="#" class='st_facebook_large' displayText='Facebook' ><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon"></a></li>
               <li><a href="#" class='st_twitter_large' displayText='Tweet'><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>                                  
                                 </ul>
                               </li>
                               <li>
                                  <img src="{{ URL:: asset('/plugins/front/img/review-location.png')}}" alt="img" class="img-responsive">
                                  <label>Location</label>
                                  <p>{{ $result->city['City']}}</p>
                               </li>
                               <li class="no-padding">
                                  <div class="job-location-map">
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
                                  </div>
                               </li>
                            </ul>
                        </div>
                    </aside>
                </div> 

                <div class="col-sm-6">
                   <div class="job-main-details">
                       <div class="job-detail-main-title">
                         <h2 class="product-side-title">{{ $result->title }} <span>{{ $companyname }}</span>  </h2>
                         <ul class="real-view-icon-list">
                               <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/view-icon.png')}}" alt="img"> <span>{{$result->count}}</span> </a></li>      
                        </ul>
                       </div>
                       <div class="job-main-des">
                       <?php if(isset($salary_range) and $salary_range != NULL){ ?>
                         <h3><?php echo '$'.$salary_range[0].' - $'.$salary_range[1];?> + Super</h3>
                         <?php } ?>
                         <?php if($Aboutthejobrole != ""){?>
                         <h4>About the job role:</h4>
                         <p><?php echo $Aboutthejobrole; ?></p>
                         <?php } ?>
                         <?php if($Aboutthecompany != ""){?>
                         <h4>About the company:</h4>
                         <p><?php echo $Aboutthecompany; ?></p>
                         <?php } ?>
                         <?php if($Tobecomesuccessfulcandidate != ''){?>
                         <h4>To become a successful candidate:</h4>
                         <p><?php echo $Tobecomesuccessfulcandidate; ?></p>
                         <?php } ?>
                        <?php if($Thebenefityouwillget != ''){?>
                         <h4>The benefit you will get:</h4>
                         <p><?php echo $Thebenefityouwillget; ?></p>
                         <?php }?>
                         <?php if($HowtoApply != ''){ ?>
                         <h4>How to Apply:</h4>
                         <p><?php echo $HowtoApply; ?></p>  
                         <?php } ?>                      
                       </div>
                   </div>
                </div>

                <div class="col-sm-3">
                   <div class="receive-job-alert-box">
                       <h2>Receive Job Alerts</h2>
                       <ul class="job-email-form">
                           <li><input type="text" placeholder="Enter your email"></li>
                           <li><input type="submit" class="send-job-alert" value="Send Alert to Email"></li>
                       </ul>
                       <p><span>Be careful</span> - Don't provide your bank or credit card details when applying for jobs. If you see something suspicious <a href="#">report this job ad.</a></p>
                   </div>
                    <?php //dd($similarAdds);
					
					?>
					@if(isset($similarAdds) && !empty($similarAdds))
                    <div class="similar-jobs-right-sec">  
                        <div class="sidebar-products-box">
                            <h2>Similar Jobs</h2>
                             @foreach ($similarAdds as $key => $value)
                   			<?Php 
							$company_name ='';
							$job_type = '';
							$encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $value['title']); ?>
                            <div class="sidebar-products-list">                    
                                <a href='{{ url("/classifieds/$encodetitle/$value[id]") }}' class="product-title">{!! str_limit($value['title'],20) !!}</a>
                                <?php //dd($value['classified_attribute'])?>
                               @foreach($value['classified_attribute'] as $key => $val)
                               					@if($val['name'] == "company_name")
                                                 <?php $company_name = $val['attr_value'];?>
                                                @endif
                                                @if($val['name'] == "job_type")
                                                            <?php
															$attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
															//dd($attr_AllValues);
															?>
                                                            <?php $job_type = $attr_AllValues[$val['attr_value']];?>
                                                @endif
                               @endforeach
                                <ul class="product-years-model">
                                    <li><a href="#"> <?php echo $company_name ?></a></li>
                                    <li><a href="#"><?php echo $job_type; ?></a></li>
                                </ul>
                                <ul class="job-right-list"><li>{{strip_tags(str_limit($value['description'], 100))}}</li></ul>
                                <?php
													$parent_catarr = DB::table('categories')->where('id', $value['parent_categoryid'])->pluck('name', 'id');
													$parent_catname = $parent_catarr[$value['parent_categoryid']];
													$parent_catname=preg_replace('/[^A-Za-z0-9-]+/', '-', $parent_catname);
													$parent_caturl = Request::root() . '/classified-list/'.$parent_catname .'/'. $value['parent_categoryid'];
													
													$catarr = DB::table('categories')->where('id', $value['category_id'])->pluck('name', 'id');
													$catname = $catarr[$value['category_id']];
													$catname=preg_replace('/[^A-Za-z0-9-]+/', '-', $catname);
													$caturl = Request::root() . '/classified-list/'.$catname .'/'. $value['category_id'];
													?>
                                                    
                                <ul class="breadcrumb">                      
                                    <li><a href="{{ url('/') }}">Home</a> </li>
                                    <li><a href="{{$parent_caturl}}">Jobs</a> </li>
                                    <li><a href="{{$caturl}}">Accounting</a> </li>
                                   <li><a href="javascript:void(0)">Specific Job Roles</a> </li>
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
                                                        @endif <br>{!! Helper::time_since(time() - strtotime($value['created_at'])) !!} ago</h4>
                                </div>
                            </div>
                            @endforeach
                            
                           
                        </div>
                    </div>
                    @endif
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