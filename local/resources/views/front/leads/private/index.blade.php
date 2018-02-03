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
                    <li><a href="javascript:void(0)">Leads</a></li>
                   
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
                      <li><a href="#" class="active">STATUS</a></li>
                      <li><a href="#">EDIT</a></li>
                      <li><a href="#">CAMPAIGN</a></li>
                  </ul><?php */?>
                  <div class="orders-manage-table leads-manage-table">
                         <div class="table-responsive">
                           @if(!empty($result))
                               
                             <table class="table">
                                 <tr>                                                              
                                     <th>NAME</th>     
                                     <th>EMAIL</th>        
                                     <th>PHONE NUMBER</th>        
                                     <th>DATA CREATED </th>          
                                    <?php /*?> <th>STATUS</th><?php */?>
                                     <th>ACTION</th>
                                 </tr> 
                                  @foreach($result as $resultKey => $resultData)
                                 <tr>                                                              
                                     <td>{{$resultData->name}}</td>
                                     <td>{{$resultData->email}}</td>
                                     <td>{{$resultData->phone}}</td>
                                     <td>{{$resultData->created_at}}</td>
                                     <?php /*?><td>Closed</td><?php */?>
                                     <td><a href='{{ url("/user/leads/view/$resultData->id") }}'>View</a></td>
                                 </tr>
                                 @endforeach
                             </table>
                             @else
                                
                                        No Message Found
                                   
                           
                             @endif
                         </div>
                  </div>


                
                <div class="DashboardTabWrap clearfix">
                  
                    
                    <div class="tab-content" style="width: 100%;">

                       

                        <?php /*?><div class="Topbar msg-topbar">
                            <ul>
                               
                                <li class="pull-right">
                                    <span>Sort By:</span>
                                    <select class="custom-select readUnread msg-sort-select-box">
                                        <option value="">Select one</option>
                                        <option value="1">Read Message</option>
                                        <option value="0">Unread Message</option>
                                    </select>
                                    <select class="custom-select shortBy msg-sort-select-box">
                                        <option value="">Select one</option>
                                        <option value="ASC">Ascending</option>
                                        <option value="DESC">Descending</option>
                                    </select>
                                </li>
                            </ul>
                        </div><?php */?>

                        <?php /*?><div class="processing-block text-center">
                            <img src="{{ URL::asset('plugins/front/img/animation_processing.gif') }}">
                        </div><?php */?>

                        <div class="tab-pane active inbox-msg-block2" id="Active">
                        
                  <?php /*?>      <div class="Messageblock emailblock">

                            @if(!empty($result))
                                @foreach($result as $resultKey => $resultData)
                                    <div class="row msgrow">
                                        <div class="col-md-4 col-sm-5 col-xs-12">
                                            <div class="row">
                                                <div class="col-md-5 col-sm-4">
                                                    <ul class="firstBox">
                                                        <li class="chek">
                                                            Name: {{$resultData->name}} <br />
                                                            Email:{{$resultData->email}} <br />
                                                            Phone: {{$resultData->phone}}
                                                        </li>
                                                       
                                                    </ul>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-7 col-xs-12">
                                            <div class="row">
                                                <div class="col-md-7 col-sm-7">
                                                    <div class="msgData">
                                                            <h3><a href='{{ url("/classifieds/$resultData->classified_id") }}' target="_blank">{{ $resultData->title }}</a></h3>
                        
                                                            <ul>
                                                                
                                                                <li class="">
                                                                   
                                                                        <span> {{ $resultData->name }}</span>
                                                                        <p>{{$resultData->message}}</p>
                                                                   
                                                                </li>
                                                            </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-5">
                                                    <div class="msgRight">
                                                        
                                                       <?php 
                                                      // dd( strtotime($resultData->msg_time));
                                                     //  dd(time());
                                                       ?>
                                                        
                                                        <span class="time">{!! Helper::time_since(time() - strtotime($resultData->created_at)) !!} ago</span>
                                                        <span><a href='{{ url("/user/leads/view/$resultData->id") }}'> view </a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row msgrow">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        No Message Found
                                    </div>
                                </div>
                            @endif
                        </div><?php */?>
                        
                        <div class="">
                                                <div class="">
                                                    {!!$result->links()!!}
                                                </div>
                                            </div>
                            
                        </div>

                        
                    </div>
                </div>
            </div>
    
                </div>
             </div>
         </div>        
    </section>
</div>
@stop

@section('scripts')
@stop