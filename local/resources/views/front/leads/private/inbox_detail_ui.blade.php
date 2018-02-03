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
                    <li><a href="javascript:void(0)">Messages</a></li>
                    <li><a href="javascript:void(0)">Buying</a></li>
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
                        <h2 class="dashboard-title">Lead</h2>

                        <?php /*?><ul class="lead-top-links">                             
                              <li><a href="#">DETAILS</a></li>
                              <li><a href="#">STATUS</a></li>
                              <li><a href="#" class="active">EDIT</a></li>
                              <li><a href="#">CAMPAIGN</a></li>
                        </ul>
<?php */?>
@if(!empty($result))
       
       <?php $resultData = $result[0] ;
	   //dd($resultData);
	    ?>
                        <div class="lead-view-page">
                        
                        {!! Form::open(array("role" => "form", 'id' => 'update-profile-img-form', 'files' => false, 'method' => 'POST')) !!}
                        
                            <ul class="lead-detail-top">
                             
                                 <li>
                                    <h3>User Details</h3>
                                    <p>{{$resultData->name}}</p>
                                 </li>
                                 <li>
                                    <h3>Contact Details</h3>
                                    <p>{{$resultData->email}} <br>
                                     {{$resultData->phone}}</p>
                                 </li>
                                 <li>
                                     <h3>Ad Title</h3>
                                     <p>
                                           <a href='{{ url("/classifieds/$resultData->classified_id") }}' target="_blank">{{ $resultData->title }}</a>
                                    </p>
                                 </li>
                                  <li>
                                     <h3>Lead Details</h3>
                                     <input type="text" placeholder="Title" value="{{ $resultData->message}}">
                                 </li>
                                 <li>
                                     <h3>Lead Status</h3>
                                       <div class="pending-selectbox">
                                         <select name="lead_status">
                                             <option value="Open" <?php if($resultData->status == "Open"){?> selected="selected" <?php } ?>>Open</option>
                                             <option value="Processing" <?php if($resultData->status == "Processing"){?> selected="selected" <?php } ?>>Processing</option>
                                             <option value="Closed" <?php if($resultData->status == "Closed"){?> selected="selected" <?php } ?>>Closed</option>
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
                                     <h3>Notes <span>Add notes on lead</span></h3>
                                     <div class="invoice-textarea">
                                         <textarea name="lead_notes" placeholder="enter here"><?php echo $resultData->lead_content ;?></textarea>
                                     </div>
                                 </li>
                            </ul>  

                            <ul class="invoice-btn-sec">
                                 <li><input value="Reset" class="reset-btn" type="reset"></li>                         
                                 <li><input value="Save" class="save-change" type="submit" name="save_leads"></li>
                            </ul> 
                            
                            {!! Form::close() !!}

                        </div> 
	@else
        <div class="row msgrow">
            <div class="col-md-12 col-sm-12 col-xs-12">
                No Message Found
            </div>
        </div>
    @endif                                            
                    </div>
    
                </div>

        




                <!-- <div class="col-sm-12 col-md-9">   
        <div class="Messageblock emailblock">

    @if(!empty($result))
       
       <?php $resultData = $result[0] ;
	   //dd($resultData);
	    ?>
            <div class="row msgrow">
                <div class="col-md-4 col-sm-5 col-xs-12">
                                            <div class="row">
                                                <div class="col-md-5 col-sm-4">
                                                    
                                                </div>
                                               
                                            </div>
                                        </div>
                <div class="col-md-8 col-sm-7 col-xs-12">
                    <div class="row">
                    <ul class="">
                                                        <li>
                                                            Name: {{$resultData->name}} <br />
                                                            Email:{{$resultData->email}} <br />
                                                            Phone: {{$resultData->phone}}<br />
                                                            Ad Title: <a href='{{ url("/classifieds/$resultData->classified_id") }}' target="_blank">{{ $resultData->title }}</a><br />
                                                            Message: {{ $resultData->message}}
                                                            
                                                        </li>
                                                       
                                                    </ul>
                        <?php /*?><div class="col-md-7 col-sm-7">
                            <div class="msgData">
                                    <h3><a href='{{ url("/classifieds/$resultData->classified_id") }}' target="_blank">{{ $resultData->title }}</a></h3>

                                    <ul>
                                       
                                        <li class="">
                                            <a href="#" >
                                                <span> {{ $resultData->name }}</span>
                                                <p>{{ $resultData->message}}</p>
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                        </div><?php */?>
                        <div class="col-md-5 col-sm-5">
                            <div class="msgRight">
                                
                               <?php 
                              // dd( strtotime($resultData->msg_time));
                             //  dd(time());
                               ?>
                                
                                <span class="time">{!! Helper::time_since(time() - strtotime($resultData->created_at)) !!} ago</span>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
    @else
        <div class="row msgrow">
            <div class="col-md-12 col-sm-12 col-xs-12">
                No Message Found
            </div>
        </div>
    @endif
</div>
</div> -->
</div>
</div>
        
	</section>
</div>
@stop        