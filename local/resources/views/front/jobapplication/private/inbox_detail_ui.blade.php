@extends('front/layout/layout')

@section('content')

<div id="middle" class="no-banner"> 
    <div class="dashboard-banner">
		<div class="userImg">
                  
			@if(!empty($user_details['image']))
            <img src="{{ URL::asset('upload_images/users/'.$user_details['id'].'/'.$user_details['image']) }}" alt="profile-img-new">
            
            @elseif(($user_details['avatar']))
            <img src="{{ $user_details['avatar'] }}" alt="profile-img-new"> 
            @else
            <img src="{{ URL::asset('plugins/front/img/no_avatar.gif') }}" alt="profile-img-new">   
            @endif

				
		</div>
         <div class="userStates">
            <select class="" name="">
                <option value="">Online</option>
                <option value="">Offline</option>
                <option value="">Away</option>Away
            </select>
        </div>
		<div class="Changepic">
<!--			{!! Form::open(array("role" => "form", 'id' => 'update-profile-img-form', 'files' => true, 'method' => 'POST')) !!}
			<input type="file" name="image" id="file2" class="filetype chng-prfl-pic-btn">
			<label for="file2">Change Photo</label>
			<p>Image must be in JPG or PNG format and under 5 mb.</p>
			{!! Form::close() !!}-->
		</div>
	</div>
<!--    <div class="dashboard-banner">
        <div class="userImg">
            @if(empty($user_details['image']))
                <img src="{{ URL::asset('plugins/front/img/no_avatar.gif') }}" alt="profile-img-new">
            @elseif(($user_details['avatar']))
                <img src="{{ Auth::guard('web')->user()->avatar }}" alt="profile-img-new">  
            @else
                <img src="{{ URL::asset('upload_images/users/'.$user_details['id'].'/'.$user_details['image']) }}" alt="profile-img-new">   
            @endif
            
        </div>
        <div class="userStates">
            <select class="" name="">
                <option value="">Online</option>
                <option value="">Offline</option>
                <option value="">Away</option>Away
            </select>
        </div>
    </div>-->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li><a href="javascript:void(0)">Job Application</a></li>
                    <li><a href="javascript:void(0)">View</a></li>
                    <li class="active">Inbox</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="dashboard-content">
        <div class="dashboarduserDetail">
            <div class="container">
                <div class="userName">
                    {{ Auth::guard('web')->user()->name }}
                </div>
                   
                <ul class="aboutUser">
                                @if(empty($total_viewer->total_views))
                    <li> 0 views</li>
                                @else
                    <li>{{ $total_viewer->total_views }} views</li>
                                @endif
                                 @if(!empty($user_total_classifieds))
                    <li>{{ $user_total_classifieds }} Ads foud</li> 
                                @else
                    <li> 0 Ads foud</li>
                     @endif
                    @if(!empty($user_details['city']))
                        <li> <span><img src="{{ URL:: asset('/plugins/front/img/locate-icon.png') }}" alt=""></span>{!! $user_details['city'] !!}</li>
                        @else
                                        <li> <span><img src="{{ URL:: asset('/plugins/front/img/locate-icon.png') }}" alt=""></span>N/A</li>
                    @endif
                                @if(!empty($user_details['created_at']))
                    <li><span><img src="{{ URL:: asset('/plugins/front/img/icons/calander-icon.png') }}" alt=""></span> {!! date("d-m-y",strtotime($user_details['created_at'])) !!}</li>
                                @endif
                </ul>
            </div>
        </div>

        <div class="container private-user-dashboard">
            <div class="row">
                <div class="col-sm-12">
                   @include('front/element/user_dashboard_menubar')
                </div>

                <div class="col-sm-12">

                  <div class="dashboardData leads-data">    
                        <h2 class="dashboard-title">Job Applications</h2>
  @if(!empty($result))
       
       <?php $resultData = $result[0] ;
   // dd($resultData);
      ?>
                        <div class="lead-view-page">
                        {!! Form::open(array("url" => "user/jobapplications/view/$resultData->id", "role" => "form", 'files' => true)) !!}  
                            <ul class="lead-detail-top">
                                 <li>
                                    <h3>User Details</h3>
                                    <p>{{$resultData->fname}} {{$resultData->lname}}</p>
                                 </li>
                                 <li>
                                    <h3>Contact Details</h3>
                                    <p>{{$resultData->applicant_email}} <br>
                                     {{$resultData->mobile}}</p>
                                 </li>
                                 <li>
                                     <h3> Ad Title</h3>
                                     <p>
                                           <a href='{{ url("/classifieds/$resultData->classified_id") }}' target="_blank">{{ $resultData->title }}</a><br />
                                           Job Role Type: {{ $resultData->job_role_type}}<br />
                                    </p>
                                 </li>
                                 <li>
                                 	<h3> Previous Job Details</h3>
                                    <p>
                                                            Previous Job Title: {{ $resultData->prev_job_title}}<br />
                                                            Previous Company: {{ $resultData->prev_company}}<br />
                                                            Previous Job Start: {{ $resultData->prev_job_start}}<br />
                                                            <br />
                                    </p>
                                 </li>
                                  @if(count($resultData->jobapply_answer) > 0 )
                                                        <li>
                                                       <h3> Questions - Answers </h3>
                                                      @foreach($resultData->jobapply_answer as $key=>$value)
                                                      
                                                    Question: {{$value['jobapply_answer_question']['question']}} ?<br />
                                                    Answer: {{ $value['answer']}} <br /><br />
                                                      
                                                      @endforeach
                                                      </li> 
                                   @endif 
                                  <li>
                                                       <h3> Documents </h3>
                                                       @if($resultData->cover_letter_file != '')
                                                       <a target="_blank" href="{!! asset('/upload_images/jobs/coverletters/'.$resultData->id.'/'.$resultData->cover_letter_file) !!}">View Cover Letter</a> <br />
                                                       @else
                                                       No Cover Letter <br />
                                                       @endif
                                                        @if($resultData->cover_letter_file != '')
                                                       <a target="_blank" href="{!! asset('/upload_images/jobs/resume/'.$resultData->id.'/'.$resultData->resume_file) !!}">View Resume file</a> <br />
                                                       @else
                                                       No Resume file <br />
                                                       @endif
                                 </li>                      
                                 
                                 
                                 <li>
                                     <h3>Application Status</h3>
                                       <div class="pending-selectbox">
                                         <select name="application_status">
                                             <option value="Hold" <?php if($resultData->application_status == 'Hold') {?> selected="selected" <?php } ?>>Hold</option>
                                             <option value="Accepted" <?php if($resultData->application_status == 'Accepted') {?> selected="selected" <?php } ?>>Accepted</option>
                                             <option value="Rejected" <?php if($resultData->application_status == 'Rejected') {?> selected="selected" <?php } ?>>Rejected</option>
                                         </select>
                                     </div> 
                                 </li>

                                 <?php /*?><li>
                                     <h3>Assigned To</h3>
                                       <div class="pending-selectbox">
                                         <select>
                                             <option value="">Location</option>
                                             <option value="">Location 2</option>
                                         </select>
                                     </div> 
                                 </li><?php */?>

                                 <li>
                                     <h3>Send Message to Applicant <span>Add notes on lead</span></h3>
                                     <div class="invoice-textarea">
                                         <textarea name="sendmag" placeholder="enter here"> <?php echo $resultData->sendmsg;?></textarea>
                                         
                                     </div>
                                 </li>
                            </ul>  

                            <ul class="invoice-btn-sec">
                                 <li><input value="Reset" class="reset-btn" type="reset"></li>                         
                                 <li><input value="Save" class="save-change" type="submit"></li>
                                 <input type="hidden" name="apply_job_id" value="{{$resultData->id}}" />
                                 <input type="hidden" name="employer_id" value="{{$resultData->receiver_id}}" />
                                 <input type="hidden" name="classifiedid" value="{{$resultData->classified_id}}" />
                            </ul> 
						 {!! Form::close() !!}
                        </div>  
@endif                                            
                    </div>
    
                </div>


 
        
	</section>
</div>
@stop        