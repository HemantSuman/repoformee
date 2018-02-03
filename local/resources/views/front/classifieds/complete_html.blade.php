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

<div class="real-estate-main-sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="backtosearch-bar">
           <a class="backtosearch-btn" href="#"><i class="fa fa-caret-left"></i> Back to Search</a>
           <div class="details-save-socail-sec">
             <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i><span>Save this Car</span></a>
             
             <ul class="details-social-btn">
               <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon"></a></li>
               <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>
               <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/insta-icon.png')}}" alt="insta-icon"></a></li>
             </ul>
           </div>
        </div>
      </div>
    </div>

    <div class="row">      
        <div class="col-sm-12 col-md-8">
          <div class="preview-ad-left real-estate-detal-left">
              <h2 class="preview-ad-title">2016 Mercedes-Benz C250 Auto 
               <span><img src="{{ URL:: asset('/plugins/front/img/ad-price-icon.png')}}" alt="img"> $50.00</span>
             </h2>
             <div class="preview-ad-thumbs">
               <div class="ad-large-thumb home-gardern-lg-thumb">
                  <section class="home-slider-for slider">
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                     <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                  </section>
               </div>
               <div class="ad-sm-thumb home-gardern-sm-thumb">
                  <section class="home-slider-nav slider">
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                       <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/book.jpg')}}" alt="img">
                    </div>
                 </section>               
               </div>
             </div>
             <ul class="real-view-icon-list real-view-icon-list-left">
                   <li><a href="javascript:void(0)"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/view-icon.png" alt="img"> <span>20</span> </a></li>
                   <li><a href="javascript:void(0)"><span class="location-hrs">5h</span><span>5 hours ago</span></a></li>                  
                 </ul>
             <div class="ad-seller-description">
               <h3>Seller’s Description</h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
               <ul>
                  <li>- AMG Sports Styling Package</li>
                  <li>- Panoramic Glass Sunroof and LED Intelligent Lights</li>
                  <li>- Electric, Memory front seats w/ heating</li>
                  <li>- COMAND Navigation w/ Voice Activation</li>
               </ul>
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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50422.47322940408!2d144.93524652180866!3d-37.827413420253535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2sMelbourne+VIC+3004%2C+Australia!5e0!3m2!1sen!2sin!4v1509708517172" class="detail-map-area" allowfullscreen></iframe>
                      </div>
                    </div>
                  </div>
                </div>
             </div>
           </div>

          
        </div>
        <div class="col-sm-12 col-md-4">
          
            <div class="ad-preview-right real-estate-sidebar no-padding">
                <div class="make-a-enquiry-form make-a-offer-form">
                  <h2>MAKE AN OFFER</h2>
                  <form method="post">
                  <ul>
                    <li><div class="user-name-box-in">
              <img src="{{ URL:: asset('/plugins/front/img/user-thumb.png')}}" alt="img">
              <h3>User Name 
                <span>Member since 2017</span>
                <span class="last-view-user">Last active Yesterday </span>
              </h3>
              </div></li>   

                    <li><textarea placeholder="Message" class="msg"></textarea></li>
                    <li>
                         <i class="fa fa-dollar"></i>
                         <input placeholder="159.99" name="" type="text">
                    </li>
                    <li>
                      <a href="#">Sign in to make your offer</a>
                      <p class="s-msg-info">By clicking on the “Send Message” button you are agreeing to Formee’s Terms and Conditions and Privacy Policy.</p></li>
                    <li><input type="submit" class="send-msg" value="Make Offer"></li>
                  </ul>
                  </form>
                </div>
                <div class="show-number-ad">
                   <span><img src="{{ URL:: asset('/plugins/front/img/ad-num-phone.png')}}" alt="img" class="img-responsive"></span>
                   ********000    <a href="#">Show Number</a>
                </div>

                <div class="sidebar-products-box">
                  <h2>Simliar Adverts</h2>
                  <div class="sidebar-products-list">
                    <div class="sidebar-products-thumb">
                      <a href="#"><img src="{{ URL:: asset('/plugins/front/img/ad-preview1.jpg')}}" alt="img"></a>
                    </div>
                    <a href="#" class="product-title">Ad Name</a>
                    <ul class="product-years-model">
                      <li>Description</li>                      
                    </ul>
                    <ul class="breadcrumb">
                      <li><a href="#">Home</a> </li>
                      <li><a href="#">Automotive</a> </li>
                      <li><a href="#">Cars & Vans</a> </li>
                      <li><a href="#">Mercedes Benz</a> </li>
                    </ul>
                    <div class="sidebar-product-save">
                      <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                      <h4>Locations <br>5 hours ago</h4>
                    </div>
                  </div>
                  <div class="sidebar-products-list">
                    <div class="sidebar-products-thumb">
                      <a href="#"><img src="{{ URL:: asset('/plugins/front/img/ad-preview1.jpg')}}" alt="img"></a>
                    </div>
                    <a href="#" class="product-title">Ad Name</a>
                    <ul class="product-years-model">
                      <li><a href="#">Year</a></li>
                      <li><a href="#">Model Name</a></li>
                    </ul>
                    <ul class="breadcrumb">
                      <li><a href="#">Home</a> </li>
                      <li><a href="#">Automotive</a> </li>
                      <li><a href="#">Cars & Vans</a> </li>
                      <li><a href="#">Mercedes Benz</a> </li>
                    </ul>
                    <div class="sidebar-product-save">
                      <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                      <h4>Locations <br>5 hours ago</h4>
                    </div>
                  </div>
                  <div class="btn-sec">
                    <a href="#">See More</a>
                  </div>
                </div>

                <div class="products-sidebar-shown no-padding">
                  <div class="user-name-box">
                    <div class="user-name-box-in">
                    <img src="{{ URL:: asset('/plugins/front/img/user-thumb.png')}}" alt="img">
                    <h3>User Name 
                      <span>Member since 2017</span>
                      <span class="last-view-user">Last active Yesterday </span>
                    </h3>
                    </div>
                  </div>
                  <div class="buy-offer-box">
                    <div class="buy-offer-tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#buy-now" aria-controls="buy-now" role="tab" data-toggle="tab">Buy Now</a></li>
                      <li role="presentation"><a href="#offer-now" aria-controls="offer-now" role="tab" data-toggle="tab">Offer Now</a></li>              
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="buy-now">
                        <div class="buy-now-detail-sec">
                          <h2 class="real-budget"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/icon-1.png" alt="img"> $159.99</h2>
                          <ul class="product-color-quantity product-availables-sec">
                          <li>
                            <h3><span>Available: 1</span></h3>
                            <h3><span>Condition: Used</span></h3>
                          </li>
                          <li>
                            <h3>Quantity</h3>
                            <div class="product-quantity-box">
                              <a href="#">-</a>
                              <input placeholder="2" value="" name="" type="text">
                              <a class="inc" href="#">+</a>
                            </div>
                          </li>
                          </ul>
                          <div class="Postage-box">
                          <h2><span>Postage</span> AU $12.00</h2>
                          <a class="see-detail-Postage" href="#">See Details</a>
                          <p>Usually Ships within 48 hours</p>
                          </div>
                          <ul class="product-addtocart-save">
                          <li>
                            <a class="addtocart-btn buy-btn" href="#">Buy it Now</a>
                            <a class="addtocart-btn pick-btn" href="#">PICK UP N’ PAY</a>
                            <a class="addtocart-btn add-btn" href="#">Add to Cart</a>
                          </li>
                          <li>
                            <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                          </li>
                          </ul>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="offer-now">
                        <div class="buy-now-detail-sec">
                          <h2 class="real-budget"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/icon-1.png" alt="img"> $159.99</h2>
                           <ul class="offer-now-form">
                             <li>
                               <textarea class="msg" placeholder="Message"></textarea>
                             </li>
                             <li>
                               <i class="fa fa-dollar"></i>
                               <input type="text" placeholder="159.99" name="">
                             </li>
                             <li>
                               <a href="#">Sign in to make your offer</a>
                               <p>By clicking on the “Send Message” button you are agreeing to Formee’s Terms and Conditions and Privacy Policy.</p>
                             </li>
                           </ul>                    
                          <ul class="product-addtocart-save">
                          <li>
                            <a class="addtocart-btn" href="#">Make Offer</a>
                          </li>
                          <li>
                            <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                          </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                   </div>
                  </div>
               </div>
              </div> 
           
       </div>      
    </div>
 
  </div>
</div>

</div>

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

@stop


