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
                <?php
                $totalrating_show = $totalrating_count = count($result->classified_hm_reviews);
                $totalrating_count = ($totalrating_count == 0) ? 1 : $totalrating_count;

                $rating_add = 0;
                foreach ($result->classified_hm_reviews as $key => $value) {
                    $all_ratings[$value['rating']][] = $value;
                    $rating_add += $value->rating;
                }
                $ave_rating = $rating_add / $totalrating_count;
                ?>
                <div class="col-sm-12 col-md-5">
                    <h2 class="product-side-title">{{ $result->title }}  </h2>
                    <ul class="real-view-icon-list product-view-list">
                        <li><a href="javascript:void(0)"><img src="{{ URL:: asset('/plugins/front/img/view-icon.png')}}" alt="img"> <span>{{ $result->count }}</span> </a></li>
                        <li>
                            <a href="javascript:void(0);">
                                <!--<span class="product-ranking">-->
                                <span class="product-ranking star-rate-avg-review">
                                    <?php
                                    $floor_ave_rating = floor($ave_rating);
                                    $ceil_ave_rating = ceil($ave_rating);
                                    $empty_star = (int) 5 - $ceil_ave_rating;
//                                                dd($empty_star);
                                    for ($i = 1; $i <= $floor_ave_rating; $i++) {
                                        ?>

                                        <i class="fa fa-star"></i> 
                                        <?php
                                    }
                                    if ($floor_ave_rating != $ave_rating) {
                                        echo "<i class='fa fa-star-half-o'></i>";
                                    }

                                    for ($i = 1; $i <= $empty_star; $i++) {
                                        ?>

                                        <i class="fa fa-star-o"></i> 
                                        <?php
                                    }
                                    ?>
                                </span>

                            </a>
                        </li>   
                        <li><a href="javascript:void(0);"><span>{{$ave_rating}}</span>  </a></li>
                    </ul>

                    <ul class="total-pro-review">
                        <li>
                            <a href="javascript:void(0);">{{$totalrating_show}} Reviews</a> | 
                            @if((Auth::guard('web')->user()))
                            <a class="write_a_review" href="javascript:void(0);">Write a Review</a>
                            @endif
                        </li>
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
                    <?php /* ?>
                      {!! Form::open(array("url" => "add_to_cart/", "role" => "form", 'files' => true)) !!}
                      <ul class="product-color-quantity">
                      <li>
                      <h3><img src="{{ URL:: asset('/plugins/front/img/meter-ad-icon.png')}}" alt="img"> Available Colour</h3>
                      <select class="custompws">
                      <option>Red</option>
                      <option>Green</option>
                      </select>
                      </li>
                      <li>
                      <h3>Quantity</h3>
                      <div class="product-quantity-box">
                      <a href="#">-</a>
                      <input value="1" type="text" name="qty">
                      <a class="inc" href="#">+</a>

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
                      <?php */ ?>

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
                                            @foreach($result->classified_hasmany_other as $key=>$value)
                                            @if($value['other_slug'] == 'is_features')
                                            <li>
                                                <div class="feature-thumbs">
                                                    <a href="#"><img src='{{ URL:: asset("/upload_images/others/$value[image]")}}' alt="img" class="img-responsive"></a>
                                                </div>
                                                <div class="feature-list-details">
                                                    <p>
                                                        <strong>{{$value['other_title']}}</strong>
                                                        {{$value['other_value']}}    
                                                    </p>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="map_id">
                                    <div class="ad-preview-tab-detail overview-tabs-detail">


                                        <?php foreach ($result->subcategoriesname->category_hm_groups as $key => $value) { ?>

                                            <h5>{{$value['title']}}</h5>
                                            <ul>
                                                <?php
                                                foreach ($value['attributes_groups'] as $k1 => $v1) {
                                                    ?>
                                                    <li>
                                                        <label><?php echo $v1['display_name']; ?></label>

                                                        <?php
                                                        if (isset($all_attr[$v1->id]) && ($all_attr[$v1->id][0]['attr_type_name'] == 'Drop-Down' || $all_attr[$v1->id][0]['attr_type_name'] == 'Radio-button')) {
//                                                            dd($all_attr[463]);
                                                            if (isset($all_attr[$v1->id][0]['attribute_value'])) {
                                                                echo $all_attr[$v1->id][0]['attribute_value'][$all_attr[$v1->id][0]['attr_value']];
                                                            }
                                                        } else if (isset($all_attr[$v1->id]) && in_array($all_attr[$v1->id][0]['attr_type_name'], ['Numeric', 'calendar', 'textarea', 'Time', 'Email', 'Date', 'Url', 'text', 'Color']) >= 0) {
                                                            echo $all_attr[$v1->id][0]['attr_value'];
                                                        }
                                                        ?>

                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="nearby_id">
                                    <div class="product-review-tab">                      
                                        <div class="product-reviews-onbase">



                                            <span class="product-ranking star-rate-avg-review">
                                                <?php
                                                $floor_ave_rating = floor($ave_rating);
                                                $ceil_ave_rating = ceil($ave_rating);
                                                $empty_star = (int) 5 - $ceil_ave_rating;
//                                                dd($empty_star);
                                                for ($i = 1; $i <= $floor_ave_rating; $i++) {
                                                    ?>

                                                    <i class="fa fa-star"></i> 
                                                    <?php
                                                }
                                                if ($floor_ave_rating != $ave_rating) {
                                                    echo "<i class='fa fa-star-half-o'></i>";
                                                }

                                                for ($i = 1; $i <= $empty_star; $i++) {
                                                    ?>

                                                    <i class="fa fa-star-o"></i> 
                                                    <?php
                                                }
                                                ?>
                                            </span>

                                            <span>{{$ave_rating}}</span>
                                            <h3>(based on {{$totalrating_show}} Reviews)</h3>
                                            @if((Auth::guard('web')->user()))
                                            <a class="write-a-review write_a_review" href="javascript:void(0);">Write a Review</a>
                                            @endif
                                        </div>
                                        <h4 class="product-reviews-sec-title">Ratings Distribution</h4>
                                        <div class="base-reviews-sec">
                                            <div class="rating-bar">
                                                <ul class="ranking-list-box">
                                                    <?php
                                                    for ($i = 5; $i > 0; $i--) {

                                                        if (isset($all_ratings[$i])) {
                                                            $sapratecount = count($all_ratings[$i]);
                                                        } else {
                                                            $sapratecount = 0;
                                                        }

                                                        $saprate_per = ($sapratecount * 100) / $totalrating_count;
                                                        ?>

                                                        <li>
                                                            <span>{{$i}} starts</span>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$saprate_per}}%;">
                                                                    <span class="sr-only">{{$saprate_per}}% Complete</span>
                                                                </div>

                                                            </div>
                                                            <span>({{$sapratecount}})</span>
                                                        </li>

                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <h4 class="product-reviews-sec-title">{{count($result->classified_hm_reviews)}} Reviews</h4>

                                        @foreach($result->classified_hm_reviews as $key => $value)
                                        <div class="products-reviews-list-sec">
                                            <div class="name-of-reviews">
                                                <p>By <a href="javascript:void(0);">{{$value->reviews_bt_users->name}}</a></p>
                                                <ul>
                                                    <li><img src="{{ URL:: asset('/plugins/front/img/review-location.png')}}" alt="img">{{$value->reviews_bt_users->location}}</li>
                                                    <li><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img">{{date('m/d/Y', strtotime($value->created_at))}}</li>
                                                </ul>
                                            </div>
                                            <div class="details-of-reviews">
                                                <div class="star-rate-review">
                                                    <?php
                                                    $rating_count = 0;
                                                    for ($i = 1; $i <= $value->rating; $i++) {
                                                        $rating_count++;
                                                        ?>
                                                        <i class="fa fa-star"></i> 

                                                        <?php
                                                    }

                                                    for ($i = 1; $i <= 5 - $rating_count; $i++) {
                                                        ?>
                                                        <i class="fa fa-star-o"></i> 

                                                    <?php } ?>
                                                    <span>{{$rating_count}}</span>
                                                </div>
                                                <p>{{$value->review}}</p>
                                            </div>
                                        </div>
                                        @endforeach

                                        <!--                                        <div class="pagination-wrapper">
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
                                                                                </div>                                             -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="local_school">
                                    <div class="ad-preview-tab-detail">
                                        <!--<h5>Guides</h5>-->
                                        <?php $demoGuidCount = 0; ?>
                                        @foreach($result->classified_hasmany_other as $key=>$value)
                                        @if($value['other_slug'] == 'demo_guides')
                                        <?php $demoGuidCount++; ?>
                                        <div class="demo-and-guide-tab">
                                            <h3>{{$value['other_title']}}</h3>
                                            <p>
                                                <strong></strong>
                                                {{$value['other_value']}}
                                            </p>
                                            @if($value['url'] != '')
                                            <a target="_blank" href="{{$value['url']}}">DOWNLOAD</a>
                                            @endif

                                        </div>
                                        @endif
                                        @endforeach

                                        <?php if ($demoGuidCount == 0) { ?>
                                            Demo and Guides not available
                                        <?php } ?>
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
                                <h3>{{ $result->classified_users->name }}
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
                                            <h2 class="real-budget">
                                                <img src="{{ URL:: asset('/plugins/front/img/icon-1.png')}}" alt="img">
                                                ${{ $result->price }}
                                            </h2>
                                            {!! Form::open(array("url" => "add_to_cart/", "role" => "form", 'files' => true)) !!}
                                            <ul class="product-color-quantity product-availables-sec">
                                                <li>
                                                    <h3><span>Available: {{ $result->quantity }}</span></h3>
                                                    <h3><span>Condition: {{ $result->condition }}</span></h3>
                                                </li>
                                                <li>
                                                    <h3>Quantity</h3>
                                                    <div class="product-quantity-box">
                                                        <a class="minus_qty"  href="javascript:void(0)">-</a>
                                                        <input type='number' min="1" name='qty' value='1' class='qty' style="margin-bottom: 0px !important"/>
                                                        <!--<input placeholder="2" value="" name="" type="text">-->
                                                        <a class="inc plus_qty" href="javascript:void(0)">+</a>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="Postage-box">
                                                <h2><span>Postage</span> AU $12.00</h2>
                                                <a class="see-detail-Postage" href="javascript:void(0)">See Details</a>
                                                <p>Usually Ships within 48 hours</p>
                                            </div>

                                            <ul class="product-addtocart-save">
                                                <li>
                                                    <input type="submit" name="submit" value="ADD TO CART" class="addtocart-btn" />
                                                    <!--<a class="addtocart-btn" href="#">ADD TO CART</a>-->
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
                                    <div role="tabpanel" class="tab-pane" id="offer-now">
                                        <div class="buy-now-detail-sec">
                                            <h2 class="real-budget"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/icon-1.png" alt="img">
                                                ${{ $result->price }}
                                            </h2>
                                            <form action="/messages/create" id="makeAnOfferForm" method="post" >
                                                <ul class="offer-now-form">
                                                    <li>
                                                        @if(Auth::guard('web')->user() && Auth::guard('web')->user()->id == $result->classified_users['id'])
                                                        <textarea class="msg" placeholder="Message" disabled="disabled"></textarea>
                                                        @else
                                                        <textarea class="msg offer_message" name="offer_message" placeholder="Message"></textarea>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-dollar"></i>
                                                        @if(Auth::guard('web')->user() && Auth::guard('web')->user()->id == $result->classified_users['id'])
                                                        <input type="text" placeholder="{{ $result->price }}" disabled="disabled">
                                                        @else
                                                        <input type="text" class="offer_price" placeholder="{{ $result->price }}" name="offer_price">

                                                        <input type="hidden" class="receiver_id" name="receiver_id" value="<?php echo $result->classified_users['id']; ?>" > 
                                                        <input type="hidden" class="classified_id" name="classified_id" value="<?php echo $result->id; ?>" >
                                                        @endif
                                                    </li>
                                                    <li>
                                                     @if(!Auth::guard('web')->user())
                                                        <a href="#">Sign in to make your offer</a>
                                                     @endif   
                                                        <p>By clicking on the “Send Message” button you are agreeing to Formee’s Terms and Conditions and Privacy Policy.</p>
                                                    </li>
                                                </ul>                    
                                                <ul class="product-addtocart-save">
                                                    <li>
                                                        @if(Auth::guard('web')->user() && Auth::guard('web')->user()->id == $result->classified_users['id'])
                                                        <button type="submit" name="button" disabled="disabled" class="addtocart-btn">Make offer</button>
                                                        @else
                                                        <button type="submit" name="button" class="addtocart-btn">Make offer</button>
                                                        @endif
                                                        <div class="text-center loadingMakeOfferDiv"><i class="fa fa-refresh fa-spin hide"></i></div>
                                                        <!--<a class="addtocart-btn" href="#">Make Offer</a>-->
                                                    </li>
                                                    <li>
                                                        <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                                                    </li>
                                                </ul>
                                            </form>
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

<!-- review modal pop up -->
<div class="modal fade" tabindex="-1" role="dialog" id="review_modal_popup">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{  URL::asset('/plugins/front/img/icons/close-btn.png') }}" >
            </button>
            <div class="modal-body">
                <div class="review-new-form">
                    <div class="form-group">
                        <label class="re-label">Rating</label>
                        <div class="star-rating">
                            <fieldset>
                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Outstanding">5 stars</label>
                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Very Good">4 stars</label>
                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Good">3 stars</label>
                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Poor">2 stars</label>
                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Very Poor">1 star</label>
                            </fieldset>
                        </div>
<!--                        <select  name="rating" class="rating">
                            <option value="1" >1</option>
                            <option value="2" >2</option>
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                            <option value="5" >5</option>
                        </select>-->
                        <label class="error"></label>
                    </div>
                    <div class="form-group">
                        <label class="re-label">Review</label>
                        <textarea type="text" name="review" class="review"></textarea>
                        <label class="error"></label>
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="{{$result->id}}" class="classid">
                        <input type="submit" value="Submit" class="submit-btn review_submit">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript" id="st_insights_js" src="//w.sharethis.com/button/buttons.js?publisher=af574cb1-c8d1-456e-983c-4fcac8797a90"></script>
<script type="text/javascript">stLight.options({publisher: "af574cb1-c8d1-456e-983c-4fcac8797a90", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
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

<script type="text/javascript">

$(document).on('click', '.write_a_review', function () {

    $("#review_modal_popup").modal("show")

});

$(document).on('click', '.minus_qty', function () {

    if ($(".qty").val() <= 1) {
        $(".qty").val(1);
    } else {
        $(".qty").val(parseInt($(".qty").val()) - 1);
    }

});

$(document).on('click', '.plus_qty', function () {

    if ($(".qty").val() < 1) {
        $(".qty").val(1);
    } else {
        $(".qty").val(parseInt($(".qty").val()) + 1);
    }

});

$(document).on('keyup', '.qty', function () {

    if ($(".qty").val() < 1) {
        $(".qty").val(1);
    }
});

$(document).on('click', '.review_submit', function () {

    if (typeof $('input[name=rating]:checked').val() == 'undefined') {
        Notify.showNotification('rating is required.', "info");
        return false;
    }

    $.ajax({
        url: root_url + '/user/classifieds/add_review',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            classified_id: $('.classid').val(),
            rating: $('input[name=rating]:checked').val(),
            review: $('.review').val(),
        },
        //dataType: "html",
        method: "POST",
        cache: true,
        success: function (response) {
            if (response.status) {
                $("#review_modal_popup").modal("hide");
                Notify.showNotification('Your feedback submitted successfully.');
            }
        }
    });

});

$("#makeAnOfferForm").validate({
    rules: {
        offer_price: {
            required: true,
            number: true,
            min: 1
        },
        offer_message: {
            required: true,
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
        var offer_message = $('.offer_message').val();
        $('.offer_price').val("")
        $('.offer_message').val("")
//        Notify.showNotification("Your offer has been sent to the seller.", "success")
        $.ajax({
            url: root_url + '/user/messages/create',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                offer_price: offerprice,
                offer_message: offer_message,
                classified_id: $('.classified_id').val(),
                receiver_id: $('.receiver_id').val(),
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

</script>

@stop


