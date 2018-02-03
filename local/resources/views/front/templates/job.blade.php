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
                        <div class="col-sm-4">
                            <aside class="job-leftside">
                                <div class="job-company-thumb">
                                    <?php 
                                    $logo_img = '';
                                    if(isset($result->classified_image[0])){
                                        $logo_img =  $result->classified_image[0]['name'];
                                    }
                                     ?>
                                    <img src='{{ url("/upload_images/classified/$result->id/$logo_img") }}'  class="img-responsive" />
                                    <span>hays.com.au</span>
                                </div>
                                <div class="job-apply-location-box">
                                    <div class="job-apply-box">
                                        <ul class="product-addtocart-save">
                                            <li>
                                                <a class="addtocart-btn" href="javascript:void(0);">APPLY</a>
                                            </li>
                                            <li>
                                                <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <ul class="job-left-preview">
                                        @foreach($result->classified_attribute as $key => $value)
                                        @if(in_array($value->attr_type_name, ["Drop-Down","Radio-button"]))
                                        <li>
                                            <img src="{{ URL:: asset("/upload_images/attributes/30px/$value->attribute_id/$value->icon")}}" class="img-responsive">
                                            <label>{{$value->display_name}}</label>
                                            <p>{{$value->attr_AllValues[$value->attr_value]}}</p>
                                        </li>
                                        @endif
                                        @endforeach
                                        <li class="no-padding">                               
                                            <label>SHARE</label>
                                            <ul class="details-social-btn">
                                                <li><a href="javascript:void(0);"><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon"></a></li>
                                                <li><a href="javascript:void(0);"><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>                                  
                                            </ul>
                                        </li>
                                        <li>
                                            <img src="{{ URL:: asset('/plugins/front/img/review-location.png')}}" alt="img" class="img-responsive">
                                            <label>Location</label>
                                            <p>{{ $result->location }}</p>
                                        </li>
                                        <li class="no-padding">
                                            <div class="job-location-map" id="map">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                        </div> 

                        <div class="col-sm-8">
                            <div class="job-main-details">
                                <div class="job-detail-main-title">
                                    <h2 class="product-side-title">{{$result->title}}</h2>
                                    <ul class="real-view-icon-list">
                                        <li><a href="#"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/view-icon.png" alt="img"> <span>20</span> </a></li>      
                                    </ul>
                                </div>
                                <div class="job-main-des">
                                    <!--<h3>$40,000 - $50,000 + Super</h3>-->
                                    @foreach($result->classified_attribute as $key => $value)
                                    @if(in_array($value->attr_type_name, ['text','Url','Email','textarea']))
                                    <h4>{{$value->display_name}}</h4>
                                    <p>{{$value->attr_value}}</p>
                                    @elseif(in_array($value->attr_type_name, ["calendar", "Date", "Time"]))
                                    <h4>{{$value->display_name}}</h4>
                                    <p>{{ str_replace(';',' - ',$value->attr_value ) }}</p>
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