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
               <li><a href="#" class='st_facebook_large' displayText='Facebook' ><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon">
                 
                

               </a></li>
               <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>
               <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/insta-icon.png')}}" alt="insta-icon"></a></li>
             </ul>
           </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
           <div class="preview-ad-left real-estate-detal-left">              
             <div class="preview-ad-thumbs">
               <div class="ad-large-thumb real-slick-lg-thumb">
                  <section class="real-slider-for slider">
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                  </section>
               </div>
               <div class="ad-sm-thumb real-slick-sm-thumb">
                  <section class="real-slider-nav slider">
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>
                    <div> 
                      <img src="{{ URL:: asset('/plugins/front/img/real-estate1.jpg')}}" alt="img">
                    </div>

                 </section>  
                             
               </div>
             </div>  
           </div>
        </div>
    </div>
    <div class="row">      
        <div class="col-sm-8">
           <div class="preview-ad-left real-estate-detal-left real-page-left-sec">
              <h2 class="preview-ad-title">101/1314 Malvern Road, Malvern, VIC 3144 </h2>
              <div class="real-bed-icons">
                 <ul class="real-bed-icon-list">
                   <li><a href="javascript:void(0)"><span>4</span> <img src="{{ URL:: asset('/plugins/front/img/bed-icon.png')}}" alt="img"></a></li>
                   <li><a href="javascript:void(0)"><span>3</span> <img src="{{ URL:: asset('/plugins/front/img/bath-icon.png')}}" alt="img"></a></li>
                   <li><a href="javascript:void(0)"><span>2</span> <img src="{{ URL:: asset('/plugins/front/img/car-icon-real.png')}}" alt="img"></a></li>
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
                  <li role="presentation"><a href="#map_id" aria-controls="map_id" role="tab" data-toggle="tab"><span>Map</span> </a></li>
                  <li role="presentation"><a href="#nearby_id" aria-controls="nearby_id" role="tab" data-toggle="tab"><span>Nearby</span> </a></li>
                  <li role="presentation"><a href="#local_school" aria-controls="local_school" role="tab" data-toggle="tab"><span>Local School Catchments</span> </a></li>
                  
                </ul> 
                <!-- Tab panes -->
                <div class="tab-content">
                   <div role="tabpanel" class="tab-pane active" id="summary">
                     <div class="ad-preview-tab-detail">
                       <h3>Utterly uncompromising.</h3>
                       <p>Utterly uncompromising in a premier bayside address, this superb executive residence's generous family proportions, impeccably updated finishes and classic modern style deliver a home of timeless elegance on a low maintenance footprint that's ideal for those with high expectations and busy family lifestyles. Behind its handsome portico entry, intelligent design has created a fabulous free flowing format in which formal, family and alfresco spaces are linked to offer day to day flexibility as well as effortless indoor/outdoor entertaining. Wide board Oak floors and elevated ceilings frame bright formal sitting and dining spaces aside a gas open fire, before sun filled open plan family zones slide back to incorporate a completely private decked courtyard with auto sun awning. A sophisticated designer kitchen featuring European appointments, marble benchtops and central island dining serves with style. Upstairs, four double bedrooms include the luxurious main with extensive WIR/BIRs and lavish twin ensuite plus three additional bedrooms, all with WIR/BIRs, arranged to accompany a teen sitting or media domain with built in bookcase/bureau and family bathroom with spa bath. Additional complements include a downstairs powder room, ducted heating/cooling, new carpet and double glazing throughout, plantation shutters and LED lighting. A remote double garage and secure OSP complete a home entirely in tune with modern family demands, easily accessing the beaches, celebrated shopping, dining districts and sought after schools for which the area is so sought after. </p>
                       <h4>Property type: <span>House</span></h4>
                     </div>
                   </div>
                   <div role="tabpanel" class="tab-pane" id="map_id">
                     <div class="ad-preview-tab-detail">
                      <div class="real-es-detail-location">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50422.47322940408!2d144.93524652180866!3d-37.827413420253535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2sMelbourne+VIC+3004%2C+Australia!5e0!3m2!1sen!2sin!4v1509708517172" class="detail-map-area" allowfullscreen></iframe>
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
                    <div class="local-school-tab">
                      <!-- Nav tabs -->
                      <ul class="school-all-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">All <span>(4)</span></a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Primary <span>(3)</span></a></li>
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Secondary <span>(1)</span></a></li>
                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Others <span>(2)</span></a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                          <div class="ad-preview-tab-detail">                      
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
                        <div role="tabpanel" class="tab-pane" id="profile">
                          <div class="ad-preview-tab-detail">                      
                            <ul>                              
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
                        <div role="tabpanel" class="tab-pane" id="messages">
                           <div class="ad-preview-tab-detail">                      
                            <ul>
                              
                              <li>
                                <label>College <span>4.29km</span></label>
                                <div class="school-location-tags">
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
                        <div role="tabpanel" class="tab-pane" id="settings">
                          <div class="ad-preview-tab-detail">                      
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
             </div>
           </div>
        </div>
        <div class="col-sm-4">
           <h2 class="real-budget"><img src="{{ URL:: asset('/plugins/front/img/icon-1.png')}}" alt="img"> $480,000 - $520,000</h2>
           <div class="next-inspection-box">
              <h2>
                 Next Inspection
                 <strong>29 July 2017 <span>14:00</span></strong>
              </h2>
           </div>
           <div class="real-enquire-box">
             To enquire please contact:
             <a href="#">hockingstuart.com.au</a>
             <a href="#">03 9690 4388</a>
             <div class="real-enquire-box-brand">
              hemant suman
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
 <script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=af574cb1-c8d1-456e-983c-4fcac8797a90"></script>
@stop


