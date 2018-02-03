<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="ad-sec-inner">
                <div class="title">
                    <h1>Post an Ad - Preview your Ad</h1>
                </div>
                <ul class="automotive-car-btns">
                    <li><a href="javascript:void(0);"><img src="{{ url("/upload_images/categories/icon/$result->categoriesname->id/$result->categoriesname->icon") }}" > {{$result->categoriesname->name}}</a></li>
                    <li><a href="javascript:void(0);"><img src="{{ url("/upload_images/categories/icon/$result->subcategoriesname->id/$result->subcategoriesname->icon") }}" >  {{$result->subcategoriesname->name}}</a></li>
                </ul>
            </div>
        </div>                                                  
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="ad-category-box">
                <h2>Your Advert Preview</h2> 
                <div class="advert-preview-sec">
                    <input type="hidden" name="class_id" class="class_id" value="{{$result->id}}" >
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
                            <h2 class="product-side-title">{{$result->title}} </h2>
                            <ul class="real-view-icon-list product-view-list">
                                <li><a href="javascript:void(0);"><img src="{{ URL:: asset('/plugins/front/img/view-icon.png')}}" alt="img"> <span>20</span> </a></li>
                                <li><a href="javascript:void(0);"><span class="product-ranking"><img src="{{ URL:: asset('/plugins/front/img/star-ranking.png')}}" alt="img"></span><span>4.7</span></a></li>                  
                            </ul>

                            <ul class="total-pro-review">
                                <li><a href="javascript:void(0);">899 Reviews</a> |  <a href="javascript:void(0);">Write a Review</a></li>
                            </ul> 
                            <h2 class="real-budget"><img src="{{ URL:: asset('/plugins/front/img/icon-1.png')}}" alt="img"> ${{$result->price}}</h2>

                            <div class="product-descriptions">
                                <p class="more"><strong>Product Description</strong> 
                                    {{$result->product_description}}
                                </p>
                            </div>
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
                                        <a href="javascript:void(0);">-</a>
                                        <input placeholder="2" value="" type="text" name="">
                                        <a class="inc" href="javascript:void(0);">+</a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="product-addtocart-save">
                                <li>
                                    <a class="addtocart-btn" href="javascript:void(0);">ADD TO CART</a>
                                </li>
                                <li>
                                    <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                                </li>
                            </ul>


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
                                                            <a href="javascript:void(0);">
                                                                @if($value['image'] != '')
                                                                <img src="{{ URL:: asset('/upload_images/others/'.$value['image'].'')}}" alt="img" class="img-responsive">
                                                                @else
                                                                <img src="{{ URL:: asset('/plugins/front/img/fearture-thumb.jpg')}}" alt="img" class="img-responsive">
                                                                @endif
                                                            </a>
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
                                                @foreach($result->classified_hasmany_other as $key=>$value)
                                                @if($value['other_slug'] == 'demo_guides')
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
    <div class="row">
        <div class="col-sm-12">
            <div class="ad-detail-form preview-ad-sub-btns">
                <ul class="ad-detail-form-sec">                     
                    <li class="no-ad-padding">  
                        <input class="back-tab" value="Back" type="button">
                        <input class="back-tab next-tab finalSubmitAfterPrev" value="Next" type="button">             
                    </li>
                </ul>
            </div>
        </div>
    </div>            
</div> 