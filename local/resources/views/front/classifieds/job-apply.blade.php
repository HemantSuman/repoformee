@extends('front/layout/layout')
@section('content')

<input type="hidden" name="loginUserId" id="loginUserId" value="{{ Auth::guard('web')->user() ? Auth::guard('web')->user()->id : null }}">

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
                         <a class="save-this-car wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i><span>Save this Job</span></a>
                         
                         <ul class="details-social-btn">
                          <li><a href="#" class='st_facebook_large' displayText='Facebook' ><img src="{{ URL:: asset('/plugins/front/img/fb-icon.png')}}" alt="fb-icon"></a></li>
               <li><a href="#" class='st_twitter_large' displayText='Tweet'><img src="{{ URL:: asset('/plugins/front/img/twitt-icon.png')}}" alt="twitt-icon"></a></li>
               <li><a href="#"  class='st_googleplus_large' displayText='Google +'><img src="{{ URL:: asset('/plugins/front/img/insta-icon.png')}}" alt="insta-icon"></a></li>
                         </ul>
                       </div>
                    </div>
                     <?php //dd($result);
					$companyname = '';
					$Aboutthejobrole='';
					$Aboutthecompany='';
					$Tobecomesuccessfulcandidate ='';
					$Thebenefityouwillget='';
					$HowtoApply ='';
					?>
                     @foreach($result->classified_attribute as $key => $value)
                        @if($value->show_list == 1)
                            @if($value->name == "company_name")
                                <?php $companyname = $value->attr_value;?>
                            @endif
                        @endif
                         @if($value->name == "About the job role")
                                <?php $Aboutthejobrole = $value->attr_value;?>
                         @endif
                         @if($value->name == "About the company")
                                <?php $Aboutthecompany = $value->attr_value;?>
                         @endif
                         @if($value->name == "Tobecomesuccessfulcandidate")
                                <?php $Tobecomesuccessfulcandidate = $value->attr_value;?>
                         @endif
                         @if($value->name == "The benefit you will get")
                                <?php $Thebenefityouwillget = $value->attr_value;?>
                         @endif
                         @if($value->name == "HowtoApply")
                                <?php $HowtoApply = $value->attr_value;?>
                         @endif
                         @if($value['name'] == "salary_range")
                               <?php $salary_range = explode(";", $value['attr_value']);?>
                         @endif
                     
                     @endforeach
                     
                    <div class="job-detail-main-title">
                     <h2 class="product-side-title">{{ $result->title }}<span>{{ $companyname }} | <a href="#">More jobs from this advertiser</a> </span>  </h2>
                    </div>
                </div>
            </div>  
            <div class="row">  
                <div class="col-sm-12 col-md-8 col-lg-7">
                   <div class="job-main-details">
                       <div class="job-detail-main-title">
                         <h2 class="product-side-title">{{ $result->title }} <span>{{ $companyname }}</span>  </h2>
                         <ul class="real-view-icon-list">
                               <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/view-icon.png')}}" alt="img"> <span>{{$result->count}}</span> </a></li>      
                        </ul>
                       </div>
                       <div class="job-main-des">
                        <?php if(isset($salary_range) and $salary_range != NULL){ ?>
                         <h3><?php echo '$'.$salary_range[0].' - $'.$salary_range[1];?> + Super</h3>
                         <?php } ?>
                         <?php if($Aboutthejobrole != ""){?>
                         <h4>About the job role:</h4>
                         <p><?php echo $Aboutthejobrole; ?></p>
                         <?php } ?>
                          <?php if($Aboutthecompany != ""){?>
                         <h4>About the company:</h4>
                         <p><?php echo $Aboutthecompany; ?></p>
                         <?php } ?>
                         <?php if($Tobecomesuccessfulcandidate != ''){?>
                         <h4>To become a successful candidate:</h4>
                         <p><?php echo $Tobecomesuccessfulcandidate; ?></p>
                         <?php } ?>
                         <?php if($Thebenefityouwillget != ''){?>
                         <h4>The benefit you will get:</h4>
                         <p><?php echo $Thebenefityouwillget; ?></p>
                         <?php }?>
                         <?php if($HowtoApply != ''){ ?>
                         <h4>How to Apply:</h4>
                         <p><?php echo $HowtoApply; ?></p>  
                         <?php } ?>                                           
                       </div>
                   </div>
					
                    @if(isset($similarAdds) && !empty($similarAdds))
                   <div class="similar-jobs-right-sec job-margin">  
                        <div class="sidebar-products-box">
                            <h2>Similar Jobs</h2> 
                             @foreach ($similarAdds as $key => $value)
                             <?Php 
							$company_name ='';
							$job_type = '';
							$encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $value['title']); ?>
                             <div class="job-list-box">
                                <div class="sidebar-products-list">
                                  <div class="job-detail-box">                    
                                    <a href='{{ url("/classifieds/$encodetitle/$value[id]") }}' class="product-title">{!! str_limit($value['title'],20) !!}</a>
                                    <?php //dd($value['classified_attribute'])
									?>
                               @foreach($value['classified_attribute'] as $key => $val)
                               					@if($val['name'] == "company_name")
                                                 <?php $company_name = $val['attr_value'];?>
                                                @endif
                                                @if($val['name'] == "job_type")
                                                            <?php
															$attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
															//dd($attr_AllValues);
															?>
                                                            <?php $job_type = $attr_AllValues[$val['attr_value']];?>
                                                @endif
                                                @if($val['name'] == "salary_range")
													<?php $salary_range = explode(";", $val['attr_value']);?>
                        						@endif
                               @endforeach
                                    
                                    <?php if(isset($salary_range) and $salary_range != NULL){ ?>
                         				<h3 class="job-salary"><?php echo '$'.$salary_range[0].' - $'.$salary_range[1];?> + Super</h3>
                         			<?php } ?>
                                    <ul class="product-years-model">
                                       <li><a href="#"> <?php echo $company_name ?></a></li>
                                    <li><a href="#"><?php echo $job_type; ?></a></li>
                                    </ul>
                                    <ul class="job-right-list">
                                        <li>{{strip_tags(str_limit($value['description'], 100))}}</li>
                                    </ul>
                                    <?php
										$parent_catarr = DB::table('categories')->where('id', $value['parent_categoryid'])->pluck('name', 'id');
										$parent_catname = $parent_catarr[$value['parent_categoryid']];
										$parent_catname=preg_replace('/[^A-Za-z0-9-]+/', '-', $parent_catname);
										$parent_caturl = Request::root() . '/classified-list/'.$parent_catname .'/'. $value['parent_categoryid'];
													
										$catarr = DB::table('categories')->where('id', $value['category_id'])->pluck('name', 'id');
										$catname = $catarr[$value['category_id']];
										$catname=preg_replace('/[^A-Za-z0-9-]+/', '-', $catname);
										$caturl = Request::root() . '/classified-list/'.$catname .'/'. $value['category_id'];
									?>
                                    <ul class="breadcrumb">                      
                                        <li><a href="{{ url('/') }}">Home</a> </li>
                                    <li><a href="{{$parent_caturl}}">Jobs</a> </li>
                                    <li><a href="{{$caturl}}">Accounting</a> </li>
                                   <li><a href="javascript:void(0)">Specific Job Roles</a> </li>
                                    </ul>
                                 </div>
                                 <div class="job-detail-right">   
                                 <div class="sidebar-product-save">
                                   @if(in_array($value['id'], $wishlistItems))
                                                    <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $value['id'] }}">
                                                        <div class="heart" data-id="{{ $value['id'] }}">
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                        </div>
                                                    </a>
                                                    @else
                                                    <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $value['id'] }}">
                                                        <div class="heart">
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                        </div>
                                                    </a>
                                                    @endif
                                    <div class="job-company-logo">
                                        <img src="{{ URL:: asset('/plugins/front/img/company-logos.png')}}" alt="img" class="img-responsive">
                                    </div>
                                    <h4>@if(!empty($value['location']))
                                                        @if(!empty($value['city']))
                                                        <?php //$expSimLoc = explode(',', trim($value['location']));
                                                        //dd($expSimLoc);
                                                        ?>
                                                        <span>{{ $value['city']['City'] }}</span>
                                                        @endif
                                                        @endif <br>{!! Helper::time_since(time() - strtotime($value['created_at'])) !!} ago</h4>
                                 </div>
                                 </div>
                                 </div>
                             </div>
                             @endforeach
                             
                            <?php /*?><div class="btn-sec">
                                <a href="#">See More</a>
                            </div><?php */?>
                        </div>
                    </div>
                    @endif
                </div> 
                {!! Form::open(array("url" => "classifieds-job/job-apply-post", "role" => "form", 'files' => true)) !!}	
                <div class="col-sm-12 col-md-4 col-lg-4">
                   <div class="existing-user-side">
                     <ul class="job-application-form">
                        <li><h2>Applicant Details</h2></li>
                        <li><input type="text" placeholder="Email" name="applicant_email" class="applicant_email"></li>
                        <li><input type="text" placeholder="First Name" name="fname" class="fname"></li>
                        <li><input type="text" placeholder="Last Name" name="lname" class="lname"></li>
                        <li><input type="text" placeholder="Phone (Mobile Preferred)" name="mobile" class="mobile"></li>
                        <li><h2>Previous Job Role</h2></li>
                        <li> 
                           <div class="pws-checkbox">
                             <p>
                               <input type="checkbox" id="app1" checked="checked" name="job_role_type" value="new" />
                               <label for="app1">New to the workforce</label>
                             </p>
                             <p>
                               <input type="checkbox" id="app2" name="job_role_type" value="still_in_role" />
                               <label for="app2">Still in role</label>
                             </p>
                           </div> 
                         </li>                         
                        <li><input type="text" placeholder="Job Title" name="prev_job_title"></li>
                        <li><input type="text" placeholder="Company Name" name="prev_company"></li> 
                        <li><input class="datepicker" type="text" placeholder="Date Start (MM/YYYY)" name="prev_job_start"></li> 
                        <li><h2>Supporting Documents</h2></li>
                        <li>
                            <p class="app-form-text">Maximum file uploads up to 2MB.<br> Files accepted .pdf .doc .docx .rtf .txt.</p>
                         </li>                         
                         <li class="trade-in-radio">
                            <label>Cover Letter</label>
                            <div class="pws-checkbox jobapp-checkbox">
                             <p>
                               <input type="radio" id="app3" class="cover_letter" name="cover_letter" value="1" onclick="chkuploadcover(this.value)" checked="checked" />
                               <label for="app3">Write cover letter</label>
                             </p>
                             <p>
                               <input type="radio" id="app4" class="cover_letter" name="cover_letter" value="0" onclick="chkuploadcover(this.value)"/>
                               <label for="app4">No cover letter</label>
                             </p>
                           </div>
                            <label class="fileContainer" id="uploadcover">
                              <input type="file" value="Upload a cover letter" name="coverfile" id="coverfile">
                              <span>+</span>Upload a cover letter
                            </label>
                        </li>
                        <li class="last-list">
                            <label>Resume</label>
                            <div class="pws-checkbox jobapp-checkbox">
                             <p>
                               <input type="checkbox" id="app5" name="resume" value="1" onclick="chkresume()"/>
                               <label for="app5">No Resume</label>
                             </p>                           
                           </div>
                            <label class="fileContainer" id="uploadresume">
                              <input type="file" value="Upload a cover letter" name="resumefile" id="resumefile">
                              <span>+</span>Upload a resume
                            </label>
                        </li>                          
                     </ul>
                   </div>
                   
                   @if(count($result->classified_hasmany_questions) > 0)
					
                   <div class="existing-user-side">
                     <ul class="job-application-form">
                        <li><h2>Additional Questions from Employer</h2></li>
                        <li>
                            <p class="app-form-text">To help assess your application better, Company Name requires few questions to be answered.</p>
                         </li>
                          @foreach($result->classified_hasmany_questions as $key => $value)
                         <li class="trade-in-radio">
                          <label><?php echo $value['question'];?></label>
                          @if($value['ans_type'] == "text")
                          	<input type="text" name="ans[<?php echo $value['id'];?>]" />
                          @endif
                          
                          @if($value['ans_type'] == "dropdown")
                          	<select name="ans[<?php echo $value['id'];?>]">
                            	@foreach($value['question_hasmany_options'] as $key1 => $value1)
                                	<option value="<?php echo $value1['option_value'];?>"><?php echo $value1['option_value'];?></option>
                                @endforeach
                            </select>
                          @endif
                           @if($value['ans_type'] == "radio")
                           		@foreach($value['question_hasmany_options'] as $key1 => $value1)
                           		<p><input  id="<?php echo $key1?>"  type="radio" name="ans[<?php echo $value['id'];?>]" value="<?php echo $value1['option_value'];?>" /><label for="<?php echo $key1?>"><?php echo $value1['option_value'];?></label></p>
                                @endforeach
                           @endif
                          </li>
                          @endforeach 
                        
                        
                        <li class="last-list">
                            <p class="app-form-text">Answers to employer questions will be added to your account and used in accordance with our <span>Privacy Statement.</span></p>
                         </li> 
                     </ul> 
                   </div>
					@endif	
                   <div class="existing-user-side">
                     <ul class="job-application-form">
                        <li><input class="send-app send-job-app" type="submit" value="Send Application" name="send-job-app">
                         <input type="hidden" class="receiver_id" name="receiver_id" value="{{ $result->user_id }}" > 
                 		 <input type="hidden" class="classified_id" name="classified_id" value="{{ $result->id }}" >
                         <input type="hidden" class="customer_id" name="customer_id" value="{{ Auth::guard('web')->user() ? Auth::guard('web')->user()->id : null }}" >
                        
                        </li>
                         <li>
                            <p class="app-form-text"><a href="#">Or, Cancel</a></p>
                         </li>
                         <li><p class="app-form-text">All personal information submitted by you as part of an application will be used by us in accordance with our <span>Privacy Statement.</span></p></li>
                        
                     </ul>
                   </div>

                   


                  
                </div>        
                {!! Form::close() !!}
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

<script language="javascript">

$( ".datepicker" ).datepicker({ dateFormat: 'mm/yy' });

	$(document).on("click", ".send-job-app", function (e) {
			alert($('.applicant_email').val());
		if ($('.applicant_email').val() == '' || typeof $('.applicant_email').val() == "undefined") {
			Notify.showNotification('Please enter your Email id', 'error');
			return false;
		}else{
			if(!isValidEmailAddress($('.applicant_email').val()))
            {
			Notify.showNotification('Please enter Valid Email id', 'error');
			return false;
			
			}
		}
		if ($('.fname').val() == '' || typeof $('.fname').val() == "undefined") {
			Notify.showNotification('Please enter your first name', 'error');
			return false;
		}
		if ($('.lname').val() == '' || typeof $('.lname').val() == "undefined") {
			Notify.showNotification('Please enter your last name', 'error');
			return false;
		}
		if ($('.mobile').val() == '' || typeof $('.mobile').val() == "undefined") {
			Notify.showNotification('Please enter your Phone No.', 'error');
			return false;
		}
		
		if ($("input:radio[name=cover_letter]:checked").val() == 1) {
			if ($('#coverfile').get(0).files.length === 0) {
			Notify.showNotification('Please enter Cover Letter file', 'error');
			return false;
			}else{
				var ext = $('#coverfile').val().split('.').pop().toLowerCase();
				if($.inArray(ext, ['doc','docx','pdf']) == -1) {
					Notify.showNotification('Invalid file format for Cover Letter', 'error');
					return false;
				}
								
			}
		}
		
		if (!$("input:checkbox[name=resume]:checked").val() == 1) {
			if ($('#resumefile').get(0).files.length === 0) {
			Notify.showNotification('Please enter Resume file', 'error');
			return false;
			}else{
				var ext = $('#resumefile').val().split('.').pop().toLowerCase();
				if($.inArray(ext, ['doc','docx','pdf']) == -1) {
					Notify.showNotification('Invalid file format for Resume file', 'error');
					return false;
				}
								
			}
		}
		
		return true;
	});
	
	function chkuploadcover(chk){
		if(chk == 0){
			document.getElementById("uploadcover").style.display='none';	
		}else{
			document.getElementById("uploadcover").style.display='block';
		}
	}
	
	function chkresume(){
		var chk = $('#app5:checked').val();
		
		if(chk){
			document.getElementById("uploadresume").style.display='none';	
		}else{
			document.getElementById("uploadresume").style.display='block';
		}
		
	}
	
	function isValidEmailAddress(emailAddress) {
			var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return pattern.test(emailAddress);
	}
	
</script>
@stop


