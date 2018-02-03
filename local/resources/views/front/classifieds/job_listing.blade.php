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
                <div class="col-sm-12 col-md-3">
                    <div class="listing-sidebar">
                        <div class="refine-searchWrap">
                           <h2>Refine Search</h2>                       
                           <form  action="" method="post" class="refineForm">
                            <h4>Search</h4>
                            <ul class="filter-togleWrap">
                                <li class="filter-togle">
                                    <h3><span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> keyword</h3>
                                    <div class="keywordDiv">
                                        <input type="text" placeholder="Car" class="form-control">
                                        <a href="#">X</a>
                                    </div>
                                </li>
                                <li class="filter-togle">
                                    <h3><span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> categories</h3>
                                    <ul>
                                        <li><a href="javascript:void(0)"><span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Accounting</a>
                                            <ul>
                                                <li><a href="javascript:void(0)">
                                                    <span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Administration & Office Support</a></li>
                                                <li><a href="javascript:void(0)">
                                                    <span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Advertising</a></li>
                                                <li><a href="javascript:void(0)">
                                                    <span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Engineering</a></li>
                                            </ul>
                                        </li>

                                        <li><a href="javascript:void(0)"><span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Accounting</a>
                                            <ul>
                                                <li><a href="javascript:void(0)">
                                                    <span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Administration & Office Support</a></li>
                                                <li><a href="javascript:void(0)">
                                                    <span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Advertising</a></li>
                                                <li><a href="javascript:void(0)">
                                                    <span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Engineering</a></li>
                                            </ul>
                                        </li>                                    

                                    </ul>
                                </li>                           
                                <li class="filter-togle price">
                                    <h3><span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span>  Price</h3>
                                    <div class="row">
                                            <div class="col-md-5 col-sm-5 col-xs-5 ">
                                                <input type="text" placeholder="$min" class="form-control">
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-5">
                                                <input type="text" placeholder="$max" class="form-control">
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-2 ">
                                                <input type="submit" class="btn" value="GO">
                                            </div>

                                    </div>
                                </li>
                                <li class="filter-togle">
                                    <h3><span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Location</h3>
                                    <ul>
                                        <li>
                                            <select class="custompws">
                                                <option>North Melbourne, 3051</option>
                                            </select>
                                        </li>                                   

                                    </ul>
                                </li>
                                <li class="filter-togle">
                                    <h3><span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Posted within</h3>
                                    <ul>
                                        <li>
                                            <select class="custompws">
                                                <option>5 - 10 days</option>
                                            </select>
                                        </li>                                   

                                    </ul>
                                </li>
                            </ul>
                         
                          <h4>Advanced Search</h4>

                          
                            <ul class="filter-togleWrap">                            
                                <li class="filter-togle">
                                    <h3><span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Specific Job Roles</h3>
                                    <ul>
                                        <li>
                                            <select class="custompws">
                                                <option>Assistant Accountant</option>
                                            </select>
                                        </li>                                   

                                    </ul>
                                </li>
                                <li class="filter-togle">
                                    <h3><span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Job Type</h3>
                                    <ul>
                                        <li>
                                            <select class="custompws">
                                                <option>Full Time</option>
                                            </select>
                                        </li>                                   

                                    </ul>
                                </li>
                                <li class="filter-togle">
                                    <h3><span><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"></span> Salary Type</h3>
                                    <ul>
                                        <li>
                                            <select class="custompws">
                                                <option>Annual Salary Package</option>
                                                <option>Month Salary Package</option>
                                            </select>
                                        </li>                                   

                                    </ul>
                                </li>
                            </ul>
                          </form>
                       </div>
                   </div>
                </div> 

                <div class="col-sm-9 col-md-6">
                    <div id="list-view" class="listing-block job-listing">
                        <div class="top-section">
                            <div class="top-titile">
                                <div class="title">
                                    <h1>Accounting</h1>
                                </div>
                                <span class="savesearch-link"><a href="#">Save this Search</a></span>
                            </div>
                            <div class="top-filter">
                                <div class="row">
                                    <div class="col-md-5">
                                        <ul class="view-type">
                                            <li class="grid_view ">
                                                <a href="javascript:void(0)">
                                                </a>
                                            </li>
                                            <li class="list_view active ">
                                                <a href="javascript:void(0)">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="filters">
                                            <span class="sortby">Sort by:</span>
                                            <div class="sorting-options">
                                                <select id="select-options-1">
                                                    <option>By Date</option>
                                                    <option>My Neighbour</option>
                                                    <option>Court</option>
                                                    <option>Dvara</option>
                                                    <option>Shoudled</option>
                                                </select>
                                            </div>
                                            <span class="decending-img"><img src="{{ URL:: asset('/plugins/front/img/descending.png')}}" alt="img"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- style in class-fied grid.scss -->
                        <div class="search-listing list-view">
                            <div class="clearfix">
                              <div class="list-row">
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
                                            <li>Challenging, creative and dynamic.</li>
                                            <li>28+ year history of excellence in Payroll.</li>
                                        </ul>
                                        <ul class="breadcrumb">                      
                                            <li><a href="#">Home</a> </li>
                                            <li><a href="#">Jobs</a> </li>
                                            <li><a href="#">Accounting</a> </li>
                                            <li><a href="#">Specific Job Roles</a> </li>
                                        </ul>
                                   </div>
                                   <div class="job-detail-right">
                                    <div class="job-featured">
                                         <i class="fa fa-star"></i> Featured Advert
                                    </div>
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
                              </div>
                              <div class="list-row">
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
                                            <li>Challenging, creative and dynamic.</li>
                                            <li>28+ year history of excellence in Payroll.</li>
                                        </ul>
                                        <ul class="breadcrumb">                      
                                            <li><a href="#">Home</a> </li>
                                            <li><a href="#">Jobs</a> </li>
                                            <li><a href="#">Accounting</a> </li>
                                            <li><a href="#">Specific Job Roles</a> </li>
                                        </ul>
                                   </div>
                                   <div class="job-detail-right">
                                    <div class="job-featured">
                                         <i class="fa fa-star"></i> Featured Advert
                                    </div>
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
                              </div> 
                              <div class="list-row">
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
                                            <li>Challenging, creative and dynamic.</li>
                                            <li>28+ year history of excellence in Payroll.</li>
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
                              </div>
                              <div class="list-row">
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
                                            <li>Challenging, creative and dynamic.</li>
                                            <li>28+ year history of excellence in Payroll.</li>
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
                              </div> 
                              <div class="list-row">
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
                                            <li>Challenging, creative and dynamic.</li>
                                            <li>28+ year history of excellence in Payroll.</li>
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
                              </div> 
                              <div class="list-row">
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
                                            <li>Challenging, creative and dynamic.</li>
                                            <li>28+ year history of excellence in Payroll.</li>
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
                              </div> 
                              <div class="list-row">
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
                                            <li>Challenging, creative and dynamic.</li>
                                            <li>28+ year history of excellence in Payroll.</li>
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
                              </div> 
                              <div class="list-row">
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
                                            <li>Challenging, creative and dynamic.</li>
                                            <li>28+ year history of excellence in Payroll.</li>
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
                              </div> 
                              <div class="list-row">
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
                                            <li>Challenging, creative and dynamic.</li>
                                            <li>28+ year history of excellence in Payroll.</li>
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
                              </div> 
                              <div class="list-row">
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
                                            <li>Challenging, creative and dynamic.</li>
                                            <li>28+ year history of excellence in Payroll.</li>
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
                              </div>  
                            </div>


                             <nav aria-label="Page navigation">
                              <ul class="pagination">
                                <li>
                                  <a href="javascript:void(0)" aria-label="Previous">
                                    <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>

                                  </a>
                                </li>
                                <li class="active"><a href="javascript:void(0)">1</a></li>
                                <li><a href="javascript:void(0)">2</a></li>
                                <li><a href="javascript:void(0)">3</a></li>
                                <li><a href="javascript:void(0)">4</a></li>
                                <li><a href="javascript:void(0)">5</a></li>
                                <li>
                                  <a href="#" aria-label="Next">

                                    <span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                  </a>
                                </li>
                              </ul>
                             </nav>
                        </div>
                    </div>
                </div> 

                <div class="col-sm-3">
                    <div class="information-links-sec">
                      <h2 class="info-head">Information</h2>
                      <ul class="information-links">
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                          <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/link-icon1.png')}}" alt="img"><span>Restaurant</span></a></li>
                      </ul>
                    </div>
                    

                    <div class="similar-jobs-right-sec">  
                        <div class="sidebar-products-box">
                            <h2>Similar Jobs</h2>
                            <div class="sidebar-products-list">                    
                                <a href="#" class="product-title">Job Title</a>
                                <ul class="product-years-model">
                                    <li><a href="#">Company Name </a></li>
                                    <li><a href="#">Full Time</a></li>
                                </ul>
                                <ul class="job-right-list">
                                    <li>Challenging, creative and dynamic.</li>
                                    <li>28+ year history of excellence in Payroll.</li>
                                </ul>
                                <ul class="breadcrumb">                      
                                    <li><a href="#">Home</a> </li>
                                    <li><a href="#">Jobs</a> </li>
                                    <li><a href="#">Accounting</a> </li>
                                    <li><a href="#">Specific Job Roles</a> </li>
                                </ul>
                                <div class="sidebar-product-save">
                                    <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                                    <h4>Locations <br>5 hours ago</h4>
                                </div>
                            </div>
                            <div class="sidebar-products-list">                    
                                <a href="#" class="product-title">Job Title</a>
                                <ul class="product-years-model">
                                    <li><a href="#">Company Name </a></li>
                                    <li><a href="#">Full Time</a></li>
                                </ul>
                                <ul class="job-right-list">
                                    <li>Challenging, creative and dynamic.</li>
                                    <li>28+ year history of excellence in Payroll.</li>
                                </ul>
                                <ul class="breadcrumb">                      
                                    <li><a href="#">Home</a> </li>
                                    <li><a href="#">Jobs</a> </li>
                                    <li><a href="#">Accounting</a> </li>
                                    <li><a href="#">Specific Job Roles</a> </li>
                                </ul>
                                <div class="sidebar-product-save">
                                    <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                                    <h4>Locations <br>5 hours ago</h4>
                                </div>
                            </div>
                            <div class="sidebar-products-list">                    
                                <a href="#" class="product-title">Job Title</a>
                                <ul class="product-years-model">
                                    <li><a href="#">Company Name </a></li>
                                    <li><a href="#">Full Time</a></li>
                                </ul>
                                <ul class="job-right-list">
                                    <li>Challenging, creative and dynamic.</li>
                                    <li>28+ year history of excellence in Payroll.</li>
                                </ul>
                                <ul class="breadcrumb">                      
                                    <li><a href="#">Home</a> </li>
                                    <li><a href="#">Jobs</a> </li>
                                    <li><a href="#">Accounting</a> </li>
                                    <li><a href="#">Specific Job Roles</a> </li>
                                </ul>
                                <div class="sidebar-product-save">
                                    <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                                    <h4>Locations <br>5 hours ago</h4>
                                </div>
                            </div>
                            <div class="sidebar-products-list">                    
                                <a href="#" class="product-title">Job Title</a>
                                <ul class="product-years-model">
                                    <li><a href="#">Company Name </a></li>
                                    <li><a href="#">Full Time</a></li>
                                </ul>
                                <ul class="job-right-list">
                                    <li>Challenging, creative and dynamic.</li>
                                    <li>28+ year history of excellence in Payroll.</li>
                                </ul>
                                <ul class="breadcrumb">                      
                                    <li><a href="#">Home</a> </li>
                                    <li><a href="#">Jobs</a> </li>
                                    <li><a href="#">Accounting</a> </li>
                                    <li><a href="#">Specific Job Roles</a> </li>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('.filter-togle > ul > li:has( > ul)').addClass('inner-Catogory');
        $('.filter-togle > h3').next().css('display','none');
        $('.filter-togle > h3').click(function(){
                $(this).next().slideToggle();
                $(this).toggleClass("toggled");
            })
            $('.inner-Catogory > a').next().css('display','none');
            $('.inner-Catogory > a').click(function(){
                    $(this).next().slideToggle();
                    $(this).toggleClass("toggled");
                });

                $('.filter-togle > h3').click();
                if($(window).width() < 991) {
                        $(".refine-searchWrap h2").click(function(){
                            $(this).next().slideToggle();
                        });
                    }

    })
</script>

@stop


