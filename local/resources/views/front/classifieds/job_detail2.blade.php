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
                         <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i><span>Save this Job</span></a>
                         
                         <ul class="details-social-btn">
                           <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon"></a></li>
                           <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>
                           <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/insta-icon.png')}}" alt="insta-icon"></a></li>
                         </ul>
                       </div>
                    </div>
                    <div class="job-detail-main-title">
                     <h2 class="product-side-title">Assistant Accountant <span>Hays Accountancy & Finance | <a href="#">More jobs from this advertiser</a> </span>  </h2>
                    </div>
                </div>
            </div>  
            <div class="row">  
                <div class="col-sm-12 col-md-8 col-lg-7">
                   <div class="job-main-details">
                       <div class="job-detail-main-title">
                         <h2 class="product-side-title">Assistant Accountant <span>Hays Accountancy & Finance</span>  </h2>
                         <ul class="real-view-icon-list">
                               <li><a href="#"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/view-icon.png" alt="img"> <span>20</span> </a></li>      
                        </ul>
                       </div>
                       <div class="job-main-des">
                         <h3>$40,000 - $50,000 + Super</h3>
                         <h4>About the job role:</h4>
                         <p>You will join a medium sized team and carry out a wide range of accounting and administration duties that include accounts payable, accounts receivable, payroll, data entry and general administrative tasks for the branch.</p>
                         <h4>About the company:</h4>
                         <p>Our client is an established construction group build on hard work, quality products and service. They are a true leader and have proven significant market share within the South East Queensland region, hence their need for additional support.</p>
                         <h4>To become a successful candidate:</h4>
                         <p>As this role is varied and supports a number of departments you possess a can do attitude and helpful positive demeanour. Your previous experience in a similar and recent role will be advantageous and you must be immediately available to commence a temporary assignment.</p>
                         <p>You will be extremely organised, detail orientated and have working knowledge of Excel.</p>
                         <h4>The benefit you will get:</h4>
                         <p>You will get the opportunity to join and work within a friendly and busy team environment whilst getting paid an attractive hourly rate by Hays Recruitment.</p>
                         <h4>How to Apply:</h4>
                         <p>If you are interested in this role, click ‘apply’ to forward an up-to-date copy of your CV, or call Alannah Kubacki - Accountancy and Finance Division on 07 5571 0751</p>                        
                       </div>
                   </div>

                   <div class="similar-jobs-right-sec job-margin">  
                        <div class="sidebar-products-box">
                            <h2>Similar Jobs</h2> 
                             <div class="job-list-box">
                                <div class="sidebar-products-list">
                                  <div class="job-detail-box">                    
                                    <a href="#" class="product-title">Job Title</a>
                                    <h3 class="job-salary">$40,000 - $50,000</h3>
                                    <ul class="product-years-model">
                                        <li><a href="#">Company Name </a></li>
                                        <li><a href="#">Full Time Permanent Position</a></li>
                                    </ul>
                                    <ul class="job-right-list">
                                        <li>Benefit 1</li>
                                        <li>Benefit 2</li>
                                    </ul>
                                    <ul class="breadcrumb">                      
                                        <li><a href="#">Home</a> </li>
                                        <li><a href="#">Jobs</a> </li>
                                        <li><a href="#">Accounting</a> </li>
                                        <li><a href="#">Specific Job Roles</a> </li>
                                    </ul>
                                 </div>
                                 <div class="job-detail-right">   
                                 <div class="sidebar-product-save">
                                    <a class="wishlist-icon" href="javascript:void(0)"><span>Save this job</span><i class="fa fa-heart-o"></i></a>
                                    <div class="job-company-logo">
                                        <img src="{{ URL:: asset('/plugins/front/img/company-logos.png')}}" alt="img" class="img-responsive">
                                    </div>
                                    <h4>Locations <br>5 hours ago</h4>
                                 </div>
                                 </div>
                                 </div>
                             </div>
                             <div class="job-list-box">
                                <div class="sidebar-products-list">
                                  <div class="job-detail-box">                    
                                    <a href="#" class="product-title">Job Title</a>
                                    <h3 class="job-salary">$40,000 - $50,000</h3>
                                    <ul class="product-years-model">
                                        <li><a href="#">Company Name </a></li>
                                        <li><a href="#">Full Time Permanent Position</a></li>
                                    </ul>
                                    <ul class="job-right-list">
                                        <li>Benefit 1</li>
                                        <li>Benefit 2</li>
                                    </ul>
                                    <ul class="breadcrumb">                      
                                        <li><a href="#">Home</a> </li>
                                        <li><a href="#">Jobs</a> </li>
                                        <li><a href="#">Accounting</a> </li>
                                        <li><a href="#">Specific Job Roles</a> </li>
                                    </ul>
                                 </div>
                                 <div class="job-detail-right">   
                                 <div class="sidebar-product-save">
                                    <a class="wishlist-icon" href="javascript:void(0)"><span>Save this job</span><i class="fa fa-heart-o"></i></a>
                                    <div class="job-company-logo">
                                        <img src="{{ URL:: asset('/plugins/front/img/company-logos.png')}}" alt="img" class="img-responsive">
                                    </div>
                                    <h4>Locations <br>5 hours ago</h4>
                                 </div>
                                 </div>
                                 </div>
                             </div>
                             <div class="job-list-box">
                                <div class="sidebar-products-list">
                                  <div class="job-detail-box">                    
                                    <a href="#" class="product-title">Job Title</a>
                                    <h3 class="job-salary">$40,000 - $50,000</h3>
                                    <ul class="product-years-model">
                                        <li><a href="#">Company Name </a></li>
                                        <li><a href="#">Full Time Permanent Position</a></li>
                                    </ul>
                                    <ul class="job-right-list">
                                        <li>Benefit 1</li>
                                        <li>Benefit 2</li>
                                    </ul>
                                    <ul class="breadcrumb">                      
                                        <li><a href="#">Home</a> </li>
                                        <li><a href="#">Jobs</a> </li>
                                        <li><a href="#">Accounting</a> </li>
                                        <li><a href="#">Specific Job Roles</a> </li>
                                    </ul>
                                 </div>
                                 <div class="job-detail-right">   
                                 <div class="sidebar-product-save">
                                    <a class="wishlist-icon" href="javascript:void(0)"><span>Save this job</span><i class="fa fa-heart-o"></i></a>
                                    <div class="job-company-logo">
                                        <img src="{{ URL:: asset('/plugins/front/img/company-logos.png')}}" alt="img" class="img-responsive">
                                    </div>
                                    <h4>Locations <br>5 hours ago</h4>
                                 </div>
                                 </div>
                                 </div>
                             </div>
                             <div class="job-list-box">
                                <div class="sidebar-products-list">
                                  <div class="job-detail-box">                    
                                    <a href="#" class="product-title">Job Title</a>
                                    <h3 class="job-salary">$40,000 - $50,000</h3>
                                    <ul class="product-years-model">
                                        <li><a href="#">Company Name </a></li>
                                        <li><a href="#">Full Time Permanent Position</a></li>
                                    </ul>
                                    <ul class="job-right-list">
                                        <li>Benefit 1</li>
                                        <li>Benefit 2</li>
                                    </ul>
                                    <ul class="breadcrumb">                      
                                        <li><a href="#">Home</a> </li>
                                        <li><a href="#">Jobs</a> </li>
                                        <li><a href="#">Accounting</a> </li>
                                        <li><a href="#">Specific Job Roles</a> </li>
                                    </ul>
                                 </div>
                                 <div class="job-detail-right">   
                                 <div class="sidebar-product-save">
                                    <a class="wishlist-icon" href="javascript:void(0)"><span>Save this job</span><i class="fa fa-heart-o"></i></a>
                                    <div class="job-company-logo">
                                        <img src="{{ URL:: asset('/plugins/front/img/company-logos.png')}}" alt="img" class="img-responsive">
                                    </div>
                                    <h4>Locations <br>5 hours ago</h4>
                                 </div>
                                 </div>
                                 </div>
                             </div>
                             <div class="job-list-box">
                                <div class="sidebar-products-list">
                                  <div class="job-detail-box">                    
                                    <a href="#" class="product-title">Job Title</a>
                                    <h3 class="job-salary">$40,000 - $50,000</h3>
                                    <ul class="product-years-model">
                                        <li><a href="#">Company Name </a></li>
                                        <li><a href="#">Full Time Permanent Position</a></li>
                                    </ul>
                                    <ul class="job-right-list">
                                        <li>Benefit 1</li>
                                        <li>Benefit 2</li>
                                    </ul>
                                    <ul class="breadcrumb">                      
                                        <li><a href="#">Home</a> </li>
                                        <li><a href="#">Jobs</a> </li>
                                        <li><a href="#">Accounting</a> </li>
                                        <li><a href="#">Specific Job Roles</a> </li>
                                    </ul>
                                 </div>
                                 <div class="job-detail-right">   
                                 <div class="sidebar-product-save">
                                    <a class="wishlist-icon" href="javascript:void(0)"><span>Save this job</span><i class="fa fa-heart-o"></i></a>
                                    <div class="job-company-logo">
                                        <img src="{{ URL:: asset('/plugins/front/img/company-logos.png')}}" alt="img" class="img-responsive">
                                    </div>
                                    <h4>Locations <br>5 hours ago</h4>
                                 </div>
                                 </div>
                                 </div>
                             </div>                            
                            
                            
                            
                            <div class="btn-sec">
                                <a href="#">See More</a>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12 col-md-4 col-lg-4">
                   <div class="existing-user-side">
                     <ul class="job-application-form">
                        <li><h2>Applicant Details</h2></li>
                        <li><input type="text" placeholder="Email"></li>
                        <li><input type="text" placeholder="First Name"></li>
                        <li><input type="text" placeholder="Last Name"></li>
                        <li><input type="text" placeholder="Phone (Mobile Preferred)"></li>
                        <li><h2>Previous Job Role</h2></li>
                        <li> 
                           <div class="pws-checkbox">
                             <p>
                               <input type="checkbox" id="app1" checked="checked" />
                               <label for="app1">New to the workforce</label>
                             </p>
                             <p>
                               <input type="checkbox" id="app2" />
                               <label for="app2">Still in role</label>
                             </p>
                           </div> 
                         </li>                         
                        <li><input type="text" placeholder="Job Title"></li>
                        <li><input type="text" placeholder="Company Name"></li>
                        <li><input type="text" placeholder="Date Start (MM/YYYY)"></li>
                        <li><h2>Supporting Documents</h2></li>
                        <li>
                            <p class="app-form-text">Maximum file uploads up to 2MB.<br> Files accepted .pdf .doc .docx .rtf .txt.</p>
                         </li>                         
                         <li>
                            <label>Cover Letter</label>
                            <div class="pws-checkbox jobapp-checkbox">
                             <p>
                               <input type="checkbox" id="app3" />
                               <label for="app3">Write cover letter</label>
                             </p>
                             <p>
                               <input type="checkbox" id="app4" />
                               <label for="app4">No cover letter</label>
                             </p>
                           </div>
                            <label class="fileContainer">
                              <input type="file" value="Upload a cover letter">
                              <span>+</span>Upload a cover letter
                            </label>
                        </li>
                        <li class="last-list">
                            <label>Resume</label>
                            <div class="pws-checkbox jobapp-checkbox">
                             <p>
                               <input type="checkbox" id="app5" />
                               <label for="app5">No Resume</label>
                             </p>                           
                           </div>
                            <label class="fileContainer">
                              <input type="file" value="Upload a cover letter">
                              <span>+</span>Upload a resume
                            </label>
                        </li>                          
                     </ul>
                   </div>

                   <div class="existing-user-side">
                     <ul class="job-application-form">
                        <li><h2>Additional Questions from Employer</h2></li>
                        <li>
                            <p class="app-form-text">To help assess your application better, Company Name requires few questions to be answered.</p>
                         </li>
                        <li>
                            <label>Which of the following statements best describes your right to work in Australia?</label>
                            <select>
                                <option>I’m an Australian citizen</option>
                                <option>I’m an Australian citizen</option>
                                <option>I’m an Australian citizen</option>
                                <option>I’m an Australian citizen</option>
                                <option>I’m an Australian citizen</option>
                                <option>I’m an Australian citizen</option>
                            </select>
                        </li>
                        <li>
                            <label>What’s your expected annual salary?</label>
                            <select>
                                <option>300000</option>
                                <option>400000</option>
                            </select>
                        </li>
                        <li>
                            <label>How many years’ experience do you have in an accounting role?</label>
                            <select>
                                <option>5</option>
                                <option>6</option>
                            </select>
                        </li>
                        <li>
                            <label>Do you have experience completing ad hoc and month end reporting?</label>
                            <div class="pws-checkbox jobapp-checkbox">
                             <p>
                               <input type="checkbox" id="app6" checked="checked" />
                               <label for="app6">Yes</label>
                             </p>
                             <p>
                               <input type="checkbox" id="app7" />
                               <label for="app7">No</label>
                             </p>
                           </div>                            
                        </li>
                        <li class="trade-in-radio">                                                
                               <p><input id="test1" name="radio-group" checked="" type="radio"><label for="test1">Yes</label></p> 
                               <p><input id="test2" name="radio-group" type="radio">     <label for="test2">No</label></p>
                        </li>
                        <li>
                            <label>Which of the following accounting packages are you experienced with?</label>
                            <select>
                                <option>experienced 1</option>
                                <option>experienced 2</option>
                            </select>
                        </li>
                        
                        <li class="last-list">
                            <p class="app-form-text">Answers to employer questions will be added to your account and used in accordance with our <span>Privacy Statement.</span></p>
                         </li> 
                     </ul>
                   </div>

                   <div class="existing-user-side">
                     <ul class="job-application-form">
                        <li><input class="send-app" type="submit" value="Send Application"></li>
                         <li>
                            <p class="app-form-text"><a href="#">Or, Cancel</a></p>
                         </li>
                         <li><p class="app-form-text">All personal information submitted by you as part of an application will be used by us in accordance with our <span>Privacy Statement.</span></p></li>
                        
                     </ul>
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


