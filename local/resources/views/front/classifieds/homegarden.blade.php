@extends('front/layout/layout')
@section('content')

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
        <div class="col-sm-12 col-md-7">
           <div class="products-slider-sec">
             <div class="preview-ad-thumbs">
               <div class="ad-large-thumb home-gardern-lg-thumb">
                  <section class="home-slider-for slider">
                  @foreach($result->classified_image as $key => $value)
                    <div> 
                      <img src='{{ url("/upload_images/classified/$result->id/$value->name") }}' />
                    </div>
                @endforeach
                  </section>
               </div>
               <div class="ad-sm-thumb home-gardern-sm-thumb">
                  <section class="home-slider-nav slider">
                  @foreach($result->classified_image as $key => $value)              
                    <div>
                      <img src='{{ url("/upload_images/classified/$result->id/$value->name") }}' />
                    </div>
                @endforeach
                 </section>               
               </div>
             </div>
           </div>
        </div>
        <div class="col-sm-12 col-md-5">
          <h2 class="product-side-title">{{ $result->title }}  </h2>
           <ul class="real-view-icon-list product-view-list">
                    <li><a href="javascript:void(0)"><img src="{{ URL:: asset('/plugins/front/img/view-icon.png')}}" alt="img"> <span>{{ $result->count }}</span> </a></li>
                   <li><a href="#"><span class="product-ranking"><img src="{{ URL:: asset('/plugins/front/img/star-ranking.png')}}" alt="img"></span><span>4.7</span></a></li>                  
            </ul>

          <ul class="total-pro-review">
            <li><a href="#">899 Reviews</a> |  <a href="#">Write a Review</a></li>
          </ul> 
           <h2 class="real-budget"><img src="{{ URL:: asset('/plugins/front/img/icon-1.png')}}" alt="img"> @if($result->price > 0)    
                                            ${{ $result->price }}
                                            @endif</h2>
           <div class="product-descriptions">
           <?php if (isset($result->description) && $result->description != '') { ?>
                                         <p class="more"><strong>Product Description</strong> 
                 {{ strip_tags($result->description) }}
                 
                 </p>
                <?php } ?>
                
          </div>
          {!! Form::open(array("url" => "add_to_cart/", "role" => "form", 'files' => true)) !!}	
          <ul class="product-color-quantity">
            <?php /*?><li>
              <h3><img src="{{ URL:: asset('/plugins/front/img/meter-ad-icon.png')}}" alt="img"> Available Colour</h3>
              <select class="custompws">
                <option>Red</option>
                <option>Green</option>
              </select>
            </li><?php */?>
            <li>
              <h3>Quantity</h3>
              <div class="product-quantity-box">
               <?php /*?> <a href="#">-</a>
                <input value="1" type="text" name="qty">
                <a class="inc" href="#">+</a><?php */?>
                
                <input type='button' value='–' class='qtyminus' field='qty' style="width: 35px;top: 0;left: 0; background: #ef4b23; font: 20px/36px ;color: #fff;text-align: center;" />
<input type='text' name='qty' value='1' class='qty' style="margin-bottom: 0px !important"/>
<input type='button' value='+' class='qtyplus inc' field='qty' style="width: 35px; top: 0;left: 0;background: #ef4b23;font: 20px/36px ; color: #fff; text-align: center;" />

              </div>
            </li>
          </ul>
          <ul class="product-addtocart-save">
            <li>
             
              <input type="submit" name="submit" value="ADD TO CART" class="addtocart-btn" />
            </li>
            <li>
              <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
            </li>
          </ul>
          @if(!(Auth::guard('web')->user()))
          	<input type="hidden" name="user_id" value="0" />
          @else
          	<input type="hidden" name="user_id" value="{{Auth::guard('web')->user()->id}}" />
          @endif
          <input type="hidden" name="classified_id" value="{{ $result->id }}" />
          <input type="hidden" name="ship_name" value="{{ $result->ship_name_1 }}" />
          <input type="hidden" name="ship_cost" value="{{ $result->ship_amount_1 }}" />
           {!! Form::close() !!}
           
           
       </div>      
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-7">
        <div class="preview-ad-left home-garden-tab-sec">
          <div class="ad-preview-tab-sec real-des-tabs">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#summary" aria-controls="summary" role="tab" data-toggle="tab"><span>Features</span> </a></li>
              <li role="presentation"><a href="#map_id" aria-controls="map_id" role="tab" data-toggle="tab"><span>Specifications</span> </a></li>
              <li role="presentation"><a href="#nearby_id" aria-controls="nearby_id" role="tab" data-toggle="tab"><span>Reviews</span> </a></li>
              <li role="presentation"><a href="#local_school" aria-controls="local_school" role="tab" data-toggle="tab"><span>Demos & Guides</span> </a></li>                  
            </ul> 
            <!-- Tab panes -->
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="summary">
                 <div class="ad-preview-tab-detail">
                   <ul class="feature-list-sec">
                     <li>
                       <div class="feature-thumbs">
                        <a href="#"><img src="{{ URL:: asset('/plugins/front/img/fearture-thumb.jpg')}}" alt="img" class="img-responsive"></a>
                       </div>
                       <div class="feature-list-details">
                         <p><strong>Diamond Blending System</strong>
                         The diamond blending system ensures that all ingredients blend together quickly and efficiently. A robust motor, unique one-piece, BPA-Free diamond pitcher, stainless steel blades and electronic controls combine to create a powerful vortex that is fast and thorough for exceptional blending results.</p>
                       </div>
                     </li>
                     <li>
                       <div class="feature-thumbs">
                        <a href="#"><img src="{{ URL:: asset('/plugins/front/img/fearture-thumb.jpg')}}" alt="img" class="img-responsive"></a>
                       </div>
                       <div class="feature-list-details">
                         <p><strong>Diamond Blending System</strong>
                         The diamond blending system ensures that all ingredients blend together quickly and efficiently. A robust motor, unique one-piece, BPA-Free diamond pitcher, stainless steel blades and electronic controls combine to create a powerful vortex that is fast and thorough for exceptional blending results.</p>
                       </div>
                     </li>
                     <li>
                       <div class="feature-thumbs">
                        <a href="#"><img src="{{ URL:: asset('/plugins/front/img/fearture-thumb.jpg')}}" alt="img" class="img-responsive"></a>
                       </div>
                       <div class="feature-list-details">
                         <p><strong>Diamond Blending System</strong>
                         The diamond blending system ensures that all ingredients blend together a powerful vortex that is fast and thorough for exceptional blending results.</p>
                       </div>
                     </li>
                     <li>
                       <div class="feature-thumbs">
                        <a href="#"><img src="{{ URL:: asset('/plugins/front/img/fearture-thumb.jpg')}}" alt="img" class="img-responsive"></a>
                       </div>
                       <div class="feature-list-details">
                         <p><strong>Diamond Blending System</strong>
                         The diamond blending system ensures that all ingredients blend together quickly and efficiently. A robust motor,and thorough for exceptional blending results.</p>
                       </div>
                     </li>
                     <li>
                       <div class="feature-thumbs">
                        <a href="#"><img src="{{ URL:: asset('/plugins/front/img/fearture-thumb.jpg')}}" alt="img" class="img-responsive"></a>
                       </div>
                       <div class="feature-list-details">
                         <p><strong>Diamond Blending System</strong> create a powerful vortex that is fast and thorough for exceptional blending results.</p>
                       </div>
                     </li>
                     <li>
                       <div class="feature-thumbs">
                        <a href="#"><img src="{{ URL:: asset('/plugins/front/img/fearture-thumb.jpg')}}" alt="img" class="img-responsive"></a>
                       </div>
                       <div class="feature-list-details">
                         <p><strong>Diamond Blending System</strong>
                         tainless steel blades and electronic controls combine to create a powerful vortex that is fast and thorough for exceptional blending results.</p>
                       </div>
                     </li>
                     <li>
                       <div class="feature-thumbs">
                        <a href="#"><img src="{{ URL:: asset('/plugins/front/img/fearture-thumb.jpg')}}" alt="img" class="img-responsive"></a>
                       </div>
                       <div class="feature-list-details">
                         <p><strong>Diamond Blending System</strong>
                         The diamond blending system ensures that all ingredients blend together quickly and efficiently</p>
                       </div>
                     </li>
                   </ul>
                 </div>
               </div>
               <div role="tabpanel" class="tab-pane" id="map_id">
                 <div class="ad-preview-tab-detail overview-tabs-detail">
                  <h5>Configuration and Overview</h5>
                  <ul>
                    <li>
                      <label>No. of Speeds </label>
                       5
                    </li>
                    <li>
                      <label>Intelli-Speed</label>
                       Yes
                    </li>                       
                  </ul>
                  <h5>Design</h5>
                  <ul>
                    <li>
                      <label>Jar Size (oz)</label>
                       60
                    </li>
                    <li>
                      <label>Jar Material</label>
                       Diamond - BPA Free
                    </li>
                    <li>
                      <label>Jar Size (oz)</label>
                       60
                    </li>
                    <li>
                      <label>Jar Material</label>
                       Diamond - BPA Free
                    </li>
                    <li>
                      <label>Jar Size (oz)</label>
                       60
                    </li>                        
                  </ul>
                  <h5>Dimensions & Weight</h5>
                  <ul>
                    <li>
                      <label>Jar Size (oz)</label>
                       60
                    </li>
                    <li>
                      <label>Jar Material</label>
                       Diamond - BPA Free
                    </li>
                    <li>
                      <label>Jar Size (oz)</label>
                       60
                    </li>
                    <li>
                      <label>Jar Material</label>
                       Diamond - BPA Free
                    </li>                                              
                  </ul>

                </div>
               </div>
               <div role="tabpanel" class="tab-pane" id="nearby_id">
                <div class="product-review-tab">                      
                   <div class="product-reviews-onbase">
                      <span class="product-ranking"><img src="{{ URL:: asset('/plugins/front/img/star-ranking.png')}}" alt="img"></span><span>4.7</span>
                      <h3>(based on 899 Reviews)</h3>
                      <a class="write-a-review" href="#">Write a Review</a>
                   </div>
                   <h4 class="product-reviews-sec-title">Ratings Distribution</h4>
                   <div class="base-reviews-sec">
                      <div class="rating-bar">
                        <img src="{{ URL:: asset('/plugins/front/img/fivestar-rate.png')}}" alt="img">
                      </div>
                      <div class="rating-list-sec">
                         <ul class="reviews-lists-design"> 
                           <li>
                             <label>Design:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Ease of Use:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Features:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Innovation:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Performance:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Quality:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Sound Levels:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>                              
                         </ul>
                      </div>
                   </div>
                   <h4 class="product-reviews-sec-title">899 Reviews</h4>
                   <div class="products-reviews-list-sec">
                      <div class="name-of-reviews">
                        <p>By <a href="#">John Long</a></p>
                        <ul>
                          <li><img src="{{ URL:: asset('/plugins/front/img/review-location.png')}}" alt="img">  Toorak, VIC</li>
                          <li><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> 06/06/2017</li>
                        </ul>
                      </div>
                      <div class="details-of-reviews">
                        <div class="star-rate-review">
                           <i class="fa fa-star-o"></i> 
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <span>5.0</span>
                        </div>
                        <p>It´s is a powerful blender. Robust for special recipes.</p>
                        <p>This review was submitted as a sweepstakes entry. I bought last week and I am very satisfied with this purchase. Especialy for people who love kitchen appliances.</p>

                         <ul class="reviews-lists-design">
                           <li>
                             <label>Design:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Ease of Use:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Features:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Innovation:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Performance:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Quality:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Sound Levels:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li> 
                          <li>Was this review helpful?   <a href="#">Yes</a>   /   <a href="#">No</a></li>
                          <li>Flag this review?   <a href="#">Yes</a>   /   <a href="#">No</a></li>
                         </ul>
                      </div>
                   </div>
                   <div class="products-reviews-list-sec">
                      <div class="name-of-reviews">
                        <p>By <a href="#">John Long</a></p>
                        <ul>
                          <li><img src="{{ URL:: asset('/plugins/front/img/review-location.png')}}" alt="img">  Toorak, VIC</li>
                          <li><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> 06/06/2017</li>
                        </ul>
                      </div>
                      <div class="details-of-reviews">
                        <div class="star-rate-review">
                           <i class="fa fa-star-o"></i> 
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <span>5.0</span>
                        </div>
                        <p>It´s is a powerful blender. Robust for special recipes.</p>
                        <p>This review was submitted as a sweepstakes entry. I bought last week and I am very satisfied with this purchase. Especialy for people who love kitchen appliances.</p>

                         <ul class="reviews-lists-design">
                           <li>
                             <label>Design:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Ease of Use:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Features:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Innovation:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Performance:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Quality:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Sound Levels:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li> 
                          <li>Was this review helpful?   <a href="#">Yes</a>   /   <a href="#">No</a></li>
                          <li>Flag this review?   <a href="#">Yes</a>   /   <a href="#">No</a></li>
                         </ul>
                      </div>
                   </div>
                   <div class="products-reviews-list-sec">
                      <div class="name-of-reviews">
                        <p>By <a href="#">John Long</a></p>
                        <ul>
                          <li><img src="{{ URL:: asset('/plugins/front/img/review-location.png')}}" alt="img">  Toorak, VIC</li>
                          <li><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> 06/06/2017</li>
                        </ul>
                      </div>
                      <div class="details-of-reviews">
                        <div class="star-rate-review">
                           <i class="fa fa-star-o"></i> 
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <span>5.0</span>
                        </div>
                        <p>It´s is a powerful blender. Robust for special recipes.</p>
                        <p>This review was submitted as a sweepstakes entry. I bought last week and I am very satisfied with this purchase. Especialy for people who love kitchen appliances.</p>

                         <ul class="reviews-lists-design">
                           <li>
                             <label>Design:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Ease of Use:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Features:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Innovation:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Performance:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Quality:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li>
                          <li>
                             <label>Sound Levels:</label>
                             <span><img src="{{ URL:: asset('/plugins/front/img/rateing.png')}}" alt="img"></span>
                          </li> 
                          <li>Was this review helpful?   <a href="#">Yes</a>   /   <a href="#">No</a></li>
                          <li>Flag this review?   <a href="#">Yes</a>   /   <a href="#">No</a></li>
                         </ul>
                      </div>
                   </div>

                   <div class="pagination-wrapper">
                      <div class="pagination-wrapper-inner">
                          <ul class="pagination">   
                            <li class="disabled"><span>«</span></li>
                            <li class="active"><span>1</span></li>         
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#" rel="next">»</a></li>
                          </ul>
                        </div>
                      </div>                                             
                </div>
               </div>
               <div role="tabpanel" class="tab-pane" id="local_school">
                 <div class="ad-preview-tab-detail">
                  <h5>Guides</h5>
                   <div class="demo-and-guide-tab">
                     <h3>Warranty Information</h3>
                     <p>A complete description of your warranty coverage, and contact information for service and support.
                     </p>
                     <a href="#">DOWNLOAD</a>
                   </div>
                   <div class="demo-and-guide-tab">
                     <h3>Warranty Information</h3>
                     <p>A complete description of your warranty coverage, and contact information for service and support.
                     </p>
                     <a href="#">DOWNLOAD</a>
                   </div>


                 </div>
               </div>                 
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-5">
         <div class="products-sidebar-shown">
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
                      <a class="addtocart-btn" href="#">ADD TO CART</a>
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
                         <p>By clicking on the "Send Message" button you are agreeing to Formee's Terms and Conditions and Privacy Policy.</p>
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




@stop

@section('scripts')
<script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=af574cb1-c8d1-456e-983c-4fcac8797a90"></script>
<script type="text/javascript">stLight.options({publisher: "af574cb1-c8d1-456e-983c-4fcac8797a90", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU?sensor=false"></script>

<script type="text/javascript">

jQuery(document).ready(function(){
        // This button will increment the value
        $('.qtyplus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name='+fieldName+']').val(currentVal + 1);
                //$('.qtyminus').val("-").removeAttr('style')
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(1);

            }
        });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
			$('.qtyminus').val("-");   
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
            $('.qtyminus').val("X").css('border','1px solid red');       
        }
    });
});



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

