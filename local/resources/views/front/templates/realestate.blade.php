<div class="real-estate-main-sec">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="ad-sec-inner">
                    <div class="title">
                        <h1>Post an Ad - Preview your Ad</h1>
                    </div>
                    <ul class="automotive-car-btns">
                        <input type="hidden" name="class_id" class="class_id" value="{{$result->id}}" >
                        <li><a href="javascript:void(0);"><img src="{{ url("/upload_images/categories/icon/$result->categoriesname->id/$result->categoriesname->icon") }}" > {{$result->categoriesname->name}}</a></li>
                        <li><a href="javascript:void(0);"><img src="{{ url("/upload_images/categories/icon/$result->subcategoriesname->id/$result->subcategoriesname->icon") }}" >  {{$result->subcategoriesname->name}}</a></li>
                    </ul>
                </div>
            </div>                                                  
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="preview-ad-left real-estate-detal-left">              
                    <div class="preview-ad-thumbs">
                        <div class="ad-large-thumb real-slick-lg-thumb">
                            <section class="real-slider-for slider">
                                @foreach($result->classified_image as $key => $value)
                                <div> 
                                    <img src='{{ url("/upload_images/classified/$result->id/$value->name") }}' />
                                </div>
                                @endforeach

                            </section>
                        </div>
                        <div class="ad-sm-thumb real-slick-sm-thumb">
                            <section class="real-slider-nav slider">
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
        </div>


        <div class="row">      
            <div class="col-sm-8">
                <div class="preview-ad-left real-estate-detal-left real-page-left-sec">
                    <h2 class="preview-ad-title">{{$result->title}}</h2>
                    <div class="real-bed-icons">
                        <ul class="real-bed-icon-list">
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

                        <ul class="real-view-icon-list">
                            <li><a href="javascript:void(0)"><img src="{{ URL:: asset('/plugins/front/img/view-icon.png')}}" alt="img"> <span>20</span> </a></li>
                            <li><a href="javascript:void(0)"><span class="location-hrs">5h</span><span>5 hours ago</span></a></li>                  
                        </ul>
                    </div>           

                    <div class="ad-preview-tab-sec real-des-tabs">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#summary" aria-controls="summary" role="tab" data-toggle="tab"><span>Summary</span> </a></li>
                            <li role="presentation"><a href="#map_id" class="inner_tab2" aria-controls="map_id" role="tab" data-toggle="tab"><span>Map</span> </a></li>
                            <li role="presentation"><a href="#nearby_id" aria-controls="nearby_id" role="tab" data-toggle="tab"><span>Nearby</span> </a></li>
                            <li role="presentation"><a href="#local_school" aria-controls="local_school" role="tab" data-toggle="tab"><span>Local School Catchments</span> </a></li>

                        </ul> 
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="summary">
                                <div class="ad-preview-tab-detail">
                                    <p>{{ strip_tags($result->description) }}</p>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="map_id">
                                <div class="ad-preview-tab-detail">
                                    <div class="real-es-detail-location" id="map">
                                        {{ $result->location }}
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="nearby_id">
                                <div class="ad-preview-tab-detail">
                                    <h5>Restaurants</h5>
                                    <ul>
                                        <li>
                                            <label>BOY & Co.<span>426 m</span></label>
                                            224 Glenferrie Rd Malvern, Malvern 3144 
                                        </li>
                                        <li>
                                            <label>BOY & Co.<span>426 m</span></label>
                                            224 Glenferrie Rd Malvern, Malvern 3144 
                                        </li>
                                        <li>
                                            <label>BOY & Co.<span>426 m</span></label>
                                            224 Glenferrie Rd Malvern, Malvern 3144 
                                        </li>
                                        <li>
                                            <label>BOY & Co.<span>426 m</span></label>
                                            224 Glenferrie Rd Malvern, Malvern 3144 
                                        </li>
                                        <li>
                                            <label>BOY & Co.<span>426 m</span></label>
                                            224 Glenferrie Rd Malvern, Malvern 3144 
                                        </li>
                                    </ul>
                                    <h5>Bars</h5>
                                    <ul>
                                        <li>
                                            <label>BOY & Co.<span>426 m</span></label>
                                            224 Glenferrie Rd Malvern, Malvern 3144 
                                        </li>
                                        <li>
                                            <label>BOY & Co.<span>426 m</span></label>
                                            224 Glenferrie Rd Malvern, Malvern 3144 
                                        </li>
                                        <li>
                                            <label>BOY & Co.<span>426 m</span></label>
                                            224 Glenferrie Rd Malvern, Malvern 3144 
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="local_school">
                                <div class="ad-preview-tab-detail">
                                    <div class="school-all-tabs">
                                        <a class="active" href="#">All <span>(4)</span></a>
                                        <a href="#">Primary <span>(3)</span></a>
                                        <a href="#">Secondary <span>(1)</span></a>
                                        <a href="#">Others <span>(2)</span></a>
                                    </div>
                                    <ul>
                                        <li>
                                            <label>Melbourne Girl’s College <span>4.29km</span></label>
                                            <div class="school-location-tags">
                                                <a href="javascript:void(0)">Girls</a>
                                                <a href="javascript:void(0)">Government</a>
                                                <a href="javascript:void(0)">Private</a>
                                            </div>
                                        </li>
                                        <li>
                                            <label>Melbourne Girl’s College <span>4.29km</span></label>
                                            <div class="school-location-tags">
                                                <a href="javascript:void(0)">Private School</a>
                                                <a href="javascript:void(0)">Co-ed</a>
                                            </div>
                                        </li>
                                        <li>
                                            <label>Melbourne Girl’s College <span>4.29km</span></label>
                                            <div class="school-location-tags">
                                                <a href="javascript:void(0)">Co-ed</a>
                                                <a href="javascript:void(0)">Government</a>
                                                <a href="javascript:void(0)">Private</a>
                                            </div>
                                        </li>
                                        <li>
                                            <label>Melbourne Girl’s College <span>4.29km</span></label>
                                            <div class="school-location-tags">
                                                <a href="javascript:void(0)">Girls</a>
                                                <a href="javascript:void(0)">Government</a>
                                            </div>
                                        </li>
                                        <li>
                                            <label>Melbourne Girl’s College <span>4.29km</span></label>
                                            <div class="school-location-tags">
                                                <a href="javascript:void(0)">Girls</a>
                                                <a href="javascript:void(0)">Private</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h2 class="real-budget"><img src="{{ URL:: asset('/plugins/front/img/icon-1.png')}}" alt="img"> ${{$result->price}} - ${{$result->price_to}}</h2>

                @foreach($result->classified_hasmany_other as $key=>$value)
                <?php
                $currentDate = strtotime(date("Y-m-d"));
                if (strtotime($value['other_value']) >= $currentDate) {
                    ?>
                    <div class="next-inspection-box">
                        <h2>
                            Next Inspection
                            <strong>{{$value['other_value']}}<span></span></strong>
                        </h2>
                    </div>
                    <?php
                    break;
                }
                ?>
                @endforeach

                <div class="real-enquire-box">
                    To enquire please contact:
                    <a href="javascript:void(0);">{{Auth::guard('web')->user()->email}}</a>
                    <a href="javascript:void(0);">{{Auth::guard('web')->user()->mobile_no}}</a>
                    <div class="real-enquire-box-brand">
                        {{Auth::guard('web')->user()->name}}
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
</div>