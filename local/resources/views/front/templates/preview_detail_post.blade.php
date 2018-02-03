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
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="preview-ad-left">
                                <input type="hidden" name="class_id" class="class_id" value="{{$result->id}}" >
                                <h2 class="preview-ad-title">{{$result->title}}
                                    <span><img src="{{ URL:: asset('/plugins/front/img/ad-price-icon.png')}}" alt="img"> ${{$result->price}}</span>
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
                                    <?php $num = 0; ?>
                                    @foreach($result->classified_attribute as $key => $value)
                                    <?php if ($num > 4) continue; ?>
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
                                        <li role="presentation" class="active"><a href="#essential_information" aria-controls="essential_information" role="tab" data-toggle="tab"><span>Essential Information</span></a></li>
                                        <li role="presentation"><a href="#details" aria-controls="details" role="tab" data-toggle="tab"><span>Details</span></a></li>
                                        <li role="presentation"><a href="#seller_location" aria-controls="seller_location" role="tab" data-toggle="tab"><span>Seller Location</span></a></li>
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
                                                <p>Detail Here</p>
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

                                                    <?php /* ?> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50422.47322940408!2d144.93524652180866!3d-37.827413420253535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2sMelbourne+VIC+3004%2C+Australia!5e0!3m2!1sen!2sin!4v1509708517172" class="detail-map-area" allowfullscreen></iframe><?php */ ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="ad-preview-right">
                                <div class="ad-preview-form">
                                    <img src="{{ URL:: asset('/plugins/front/img/ad-priview-form.jpg')}}" alt="img" class="img-responsive">
                                </div>
                                <div class="show-number-ad">
                                    <span><img src="{{ URL:: asset('/plugins/front/img/ad-num-phone.png')}}" alt="img" class="img-responsive"></span>
                                    ********000    <a href="#">Show Number</a>
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