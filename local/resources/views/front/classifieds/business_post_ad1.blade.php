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





    <div id="post-add">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#select_category" aria-controls="select_category" role="tab" data-toggle="tab">Select Category</a></li>
            <li role="presentation"><a href="#select_sub_category" aria-controls="select_sub_category" role="tab" data-toggle="tab">Select Subcategory</a></li>
            <li role="presentation"><a href="#post_classified" aria-controls="post_classified" role="tab" data-toggle="tab">Post Classified</a></li> 
            <li role="presentation"><a href="#advert_preview" aria-controls="advert_preview" role="tab" data-toggle="tab">Advert Preview</a></li>   
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="select_category">        
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title">
                                <h1>post an add</h1>
                            </div>
                            <div class="ad-category-top-text">
                                <p>We have recognised your subscription plan as <span>Merchant</span>. Below we have provide suitable categories related to your business. Please select your appropriate category and sub category, and start your ad posting.</p>
                            </div>
                        </div>                
                    </div> 
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ad-category-box">
                                <h2>Category</h2> 
                                <div class="sb-container ad-cat-scroll-sec">
                                    <ul class="ad-category-list">
                                        <li>
                                            <a href="#" class="active" data-toggle="tooltip" data-placement="top" title="Electronics Electronics Electronics">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png" alt="img"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Electronics Electronics Electronics">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="ad-category-box ad-subcategory-box">
                                <h2>Sub Category</h2> 
                                <div class="sb-container ad-cat-scroll-sec">
                                    <ul class="ad-category-list">
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="ad-cat-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-icon1.png"></span>
                                                <span class="ad-cat-text">Electronics</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>                
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="select_sub_category">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ad-sec-inner">
                                <div class="title">
                                    <h1>Post an Ad - Ad Details</h1>
                                </div>
                                <ul class="automotive-car-btns">
                                    <li><a href="#"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/autocar-icon.png" alt="img"> Automotive</a></li>
                                    <li><a href="#"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/van-icon.png" alt="img">  Cars & Vans</a></li>
                                </ul>

                                <div class="ad-detail-form">
                                    <h3>Enter Details About Your Ad</h3>
                                    <ul class="ad-detail-form-sec">
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <input type="text" name="" placeholder="Make">
                                            <p class="ad-error">This field is required</p>
                                            <span class="form-tag-line">Your ad title will be the make and model of your car</span>
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <input type="text" name="" placeholder="Model">
                                        </li>
                                        <li class="badge-series-row">
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <input type="text" name="" placeholder="Badge">
                                            <input type="text" name="" placeholder="Series">
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <select>
                                                <option>Year</option>
                                                <option>2017</option>
                                                <option>2016</option>
                                            </select>
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <input type="text" name="" placeholder="Price">
                                            <span class="ad-form-price">AUD</span>
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <input type="text" name="" placeholder="Mileage">
                                            <span class="ad-form-price">KM</span>
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <input type="text" name="" placeholder="Colour">
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <select>
                                                <option>Transmission</option>
                                            </select>
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <select>
                                                <option>Body Type</option>
                                            </select>
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <select>
                                                <option>Drive Type</option>
                                            </select>
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <select>
                                                <option>Fuel Type</option>
                                            </select>
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <input type="text" name="" placeholder="Economy">
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <input type="text" name="" placeholder="Registration Expiry">
                                        </li>
                                        <li>
                                            <span class="ad-detial-field-icon">
                                                <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-car-icon.png" alt="img">
                                            </span>
                                            <input type="text" name="" placeholder="Type Additional Features">
                                            <span class="form-tag-line">Please seperate with a commar “,”</span>
                                        </li>
                                        <li class="no-ad-padding">                        
                                            <input type="text" name="" placeholder="Location eg City or Postcode">                        
                                        </li>
                                        <li class="no-ad-padding">                        
                                            <input type="text" name="" placeholder="Type Catch Line.">                        
                                        </li>
                                        <li class="no-ad-padding">                        
                                            <textarea class="ad-descrip" placeholder="Description"></textarea>
                                            <span class="form-tag-line">Did you know it's FREE to edit your listing for the full duration of your ad?</span> 
                                            <span class="form-tag-line characters-count">4000 characters left</span>                   
                                        </li>
                                        <li class="no-ad-padding">
                                            <h4 class="img-text-ad"><strong> Upload Images for the Ad</strong>
                                                For best results, we recommend choosing landscape images.</h4> 
                                        </li>
                                        <li class="no-ad-padding">                 
                                            <label class="fileContainer">
                                                <input type="file"></label>  
                                            <span class="form-tag-line">Ads with pictures are more successful! Load up to 10 pictures. You can upload images up to 4MB. Drag and drop files onto this window to upload. <br><br>Pick up and drag the images around to re-order them.</span>                
                                        </li>
                                        <li class="no-ad-padding">  
                                            <input class="back-tab" type="submit" value="Back">
                                            <input class="back-tab next-tab" type="submit" value="Next">             
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>                
                    </div>             
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="post_classified">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ad-sec-inner">
                                <div class="title">
                                    <h1>Post an Ad - Review Your Ad Details</h1>
                                </div>
                                <ul class="automotive-car-btns">
                                    <li><a href="#"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/autocar-icon.png" alt="img"> Automotive</a></li>
                                    <li><a href="#"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/van-icon.png" alt="img">  Cars & Vans</a></li>
                                </ul>

                                <div class="ad-detail-form">
                                    <h3>Details About Your Ad</h3>
                                    <ul class="ad-date-lists">
                                        <li>Make & Model</li>
                                        <li>Badge & Series</li>
                                        <li>Year</li>
                                        <li>Price</li>
                                        <li>Mileage</li>
                                        <li>Colour</li>
                                        <li>Transmission</li>
                                        <li>Body Type</li>
                                        <li>Drive Type</li>
                                        <li>Fuel Type</li>
                                        <li>Fuel Economy</li>
                                        <li>Registration</li>
                                        <li>Features, Features, Features, Features</li>
                                        <li>Location</li>
                                        <li>Catch line</li> 
                                        <li>
                                            <div class="desc">Description</div>                      
                                        </li>                   
                                    </ul>
                                    <div class="image-for-ads">
                                        <h3>Details About Your Ad</h3>
                                        <ul class="ad-img-list">
                                            <li><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-img-01.jpg" alt="img" class="img-responsive"></li>
                                            <li><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-img-01.jpg" alt="img" class="img-responsive"></li>
                                            <li><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/ad-img-01.jpg" alt="img" class="img-responsive"></li>
                                        </ul>

                                    </div>
                                    <h3>Agents Contact Details</h3>
                                    <div class="row step3row">
                                        <div class="col-sm-12">
                                            <ul class="contact-surname">
                                                <li>
                                                    <input id="mr" name="gender" value="" type="radio">
                                                    <label for="mr">Mr</label>
                                                    <div class="check"></div>
                                                </li>
                                                <li>
                                                    <input id="mrs" name="gender" value="" type="radio">
                                                    <label for="mrs">Mrs</label>
                                                    <div class="check"></div>
                                                </li>
                                                <li>
                                                    <input id="Ms" name="gender" value="" type="radio">
                                                    <label for="Ms">Ms</label>
                                                    <div class="check"></div>
                                                </li>
                                                <li>
                                                    <input id="Other" name="gender" value="" type="radio">
                                                    <label for="Other">Other</label>
                                                    <div class="check"></div>
                                                </li>
                                            </ul>
                                        </div>     
                                    </div>

                                  


                                    <ul class="ad-detail-form-sec ad-data-form-sec">
                                        <li>                        
                                            <input type="text" name="" placeholder="Contact Name">
                                        </li>
                                        <li>                        
                                            <input type="text" name="" placeholder="Email">
                                            <span class="form-tag-line">Your email address will not be displayed.</span>
                                        </li>
                                        <li>                        
                                            <input type="text" name="" placeholder="Phone Number">
                                        </li>
                                        <li>                       
                                            <input type="text" name="" placeholder="Location ">
                                            <span class="form-tag-line">Use my current location</span>
                                            <h5>Help users locate your ad by entering your full address or suburb.</h5>
                                        </li>                  
                                        <li>  
                                            <input class="back-tab" type="submit" value="Back">
                                            <input class="back-tab next-tab" type="submit" value="Next">             
                                        </li>

                                    </ul>

                                    <ul class="ad-detail-form-sec ad-data-form-sec" style="width: 100%;">
                                        <li>
                                         <div class="row step3row">
                                           <ul class="contact-surname">
                                                <li>
                                                    <input id="pp" name="gender" value="" type="radio">
                                                    <label for="pp"><img src="{{ URL:: asset('/plugins/front/img/pp.png')}}" alt="Paypal"></label>
                                                    <div class="check"></div>
                                                </li>     
                                            </ul>
                                         </div>                                            
                                        </li>

                                        <li>
                                        <div class="pickup-check">
                                         <div class="row step3row">
                                           <ul class="contact-surname">
                                                <li>
                                                    <input id="pick" name="" value="" type="radio">
                                                    <label for="pick">PICK UP N’ PAY</label>
                                                    <div class="check"></div>
                                                </li>     
                                            </ul>
                                         </div> 
                                         </div>

                                         <div class="pickup-check-inputs">
                                             <ul class="pickup-check-ul">           
                                                <li>                        
                                                    <input type="text" name="" placeholder="Phone Number">
                                                </li>
                                                <li>                        
                                                    <input type="text" name="" placeholder="Phone Number">
                                                </li>
                                                <li>                        
                                                    <input type="text" name="" placeholder="Phone Number">
                                                </li>
                                                <li>                        
                                                    <input type="text" name="" placeholder="Phone Number">
                                                </li>
                                                <li class="badge-series-row">                        
                                                    <input type="text" name="" placeholder="Phone Number">
                                                    <input type="text" name="" placeholder="Phone Number" class="pull-right">
                                                </li>    
                                            </ul>
                                         </div>

                                        </li>

                                        <li>
                                         <div class="row step3row">
                                           <ul class="contact-surname">
                                                <li>
                                                    <input id="mr" name="gender" value="" type="radio">
                                                    <label for="mr">Free</label>
                                                    <div class="check"></div>
                                                </li>
                                                
                                                <li>
                                                    <input id="Ms" name="gender" value="" type="radio">
                                                    <label for="Ms">Enter Shipping Amount</label>
                                                    <div class="check"></div>
                                                </li>    
                                            </ul>
                                             <div class="free-ship-cal">
                                                       <input type="text" name="" placeholder="Phone Number">
                                                       <span class="ad-form-price">AUD</span>
                                                       <a href="#">Free Shiping Cal.</a>
                                                   </div>
                                         </div>                                            
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>                
                    </div>             
                </div>      
            </div>
            <div role="tabpanel" class="tab-pane" id="advert_preview">
                <div id="loading-overlay"> 
                    <i class="fa fa-spinner fa-spin spin-big"></i>
                </div> 
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ad-sec-inner">
                                <div class="title">
                                    <h1>Post an Ad - Preview your Ad</h1>
                                </div>
                                <ul class="automotive-car-btns">
                                    <li><a href="#"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/autocar-icon.png" alt="img"> Automotive</a></li>
                                    <li><a href="#"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/van-icon.png" alt="img">  Cars & Vans</a></li>
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
                                                <h2 class="preview-ad-title">2016 Mercedes-Benz C250 Auto 
                                                    <span><img src="{{ URL:: asset('/plugins/front/img/ad-price-icon.png')}}" alt="img"> $69,900</span>
                                                </h2>
                                                <div class="preview-ad-thumbs">
                                                    <div class="ad-large-thumb">
                                                        <img src="{{ URL:: asset('/plugins/front/img/ad-preview1.jpg')}}" alt="img" class="img-responsive">               
                                                    </div>
                                                    <div class="ad-sm-thumb">
                                                        <ul>
                                                            <li>
                                                                <img src="{{ URL:: asset('/plugins/front/img/ad-preview-icon1.jpg')}}" alt="img" class="img-responsive">
                                                            </li>
                                                            <li>
                                                                <img src="{{ URL:: asset('/plugins/front/img/ad-preview-icon1.jpg')}}" alt="img" class="img-responsive">
                                                            </li>
                                                            <li>
                                                                <img src="{{ URL:: asset('/plugins/front/img/ad-preview-icon1.jpg')}}" alt="img" class="img-responsive">
                                                            </li>
                                                            <li>
                                                                <img src="{{ URL:: asset('/plugins/front/img/ad-preview-icon1.jpg')}}" alt="img" class="img-responsive">
                                                            </li>
                                                        </ul>

                                                    </div>
                                                </div>
                                                <ul class="preview-meter-list">
                                                    <li>
                                                        <span>ODOMETER</span>
                                                        <strong><img src="{{ URL:: asset('/plugins/front/img/meter-ad-icon.png')}}" alt="img"> 4,685 km</strong>
                                                    </li>
                                                    <li>
                                                        <span>Body Type</span>
                                                        <strong><img src="{{ URL:: asset('/plugins/front/img/meter-ad-icon.png')}}" alt="img"> Sedan</strong>
                                                    </li>
                                                    <li>
                                                        <span>Transmission</span>
                                                        <strong><img src="{{ URL:: asset('/plugins/front/img/meter-ad-icon.png')}}" alt="img"> Automatic</strong>
                                                    </li>
                                                    <li>
                                                        <span>Fuel Type</span>
                                                        <strong><img src="{{ URL:: asset('/plugins/front/img/meter-ad-icon.png')}}" alt="img"> Petrol</strong>
                                                    </li>
                                                    <li>
                                                        <span>Engine</span>
                                                        <strong><img src="{{ URL:: asset('/plugins/front/img/meter-ad-icon.png')}}" alt="img"> 4cyl 2.0L</strong>
                                                    </li>
                                                </ul>
                                                <div class="ad-seller-description">
                                                    <h3>Seller’s Description</h3>
                                                    <p>***** COMPANY DEMONSTRATOR! *****</p>
                                                    <p>This Mercedes-Benz C250 Sedan is finished in Brilliant Blue with Black AMG Leather Interior, and includes the following features:</p>
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
                                                        <li role="presentation" class="active"><a href="#essential_information" aria-controls="essential_information" role="tab" data-toggle="tab"><span>Essential Information</span></a></li>
                                                        <li role="presentation"><a href="#details" aria-controls="details" role="tab" data-toggle="tab"><span>Details</span></a></li>
                                                        <li role="presentation"><a href="#seller_location" aria-controls="seller_location" role="tab" data-toggle="tab"><span>Seller Location</span></a></li>
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
                                                                <p>Detail Here</p>
                                                            </div>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" id="seller_location">
                                                            <div class="ad-preview-tab-detail">
                                                                <h3>Seller Location Here</h3>
                                                                <p>Location Detail Here</p>
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
                                        <input class="back-tab" value="Back" type="submit">
                                        <input class="back-tab next-tab" value="Next" type="submit">             
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
<script src="{{ URL::asset('plugins/admin/plugins/ionslider/scrollBar.js') }}"></script>
<script type="text/javascript">
   $(".sb-container").scrollBox();
   $(function () {
     $('[data-toggle="tooltip"]').tooltip()
   })
</script>

@stop


