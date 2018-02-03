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
        <!--		<div class="Changepic">
                                {!! Form::open(array("role" => "form", 'id' => 'update-profile-img-form', 'files' => true, 'method' => 'POST')) !!}
                                <input type="file" name="image" id="file2" class="filetype chng-prfl-pic-btn">
                                <label for="file2">Change Photo</label>
                                <p>Image must be in JPG or PNG format and under 5 mb.</p>
                                {!! Form::close() !!}
                        </div>-->
    </div>
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">Dashboard</li>
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
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    @include('front/element/user_dashboard_menubar') 
                </div>

                <div class="col-sm-12 col-md-9">
                   <div class="dashboard-main-detail">
                     <h2 class="dashboard-title">Manage Users</h2>
                     <div class="manage-users-sec">
                         <h2>Collaborators in this Group</h2>
                         <div class="manage-users-box">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="manage-user-thumb">
                                        <img src="{{ URL:: asset('/plugins/front/img/manage-users.png') }}" alt="user">
                                    </div>
                                    <div class="manage-user-detail">
                                        <h3>Richard Am (you) <span>richard.am@samsung.com</span></h3>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="manage-user-control">
                                       <h3>is owner</h3>
                                    </div>                                   
                                </div>
                            </div>
                         </div>
                         <div class="manage-users-box">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="manage-user-thumb">
                                        <img src="{{ URL:: asset('/plugins/front/img/manage-users.png') }}" alt="user">
                                    </div>
                                    <div class="manage-user-detail">
                                        <h3>Richard Am (you) <span>richard.am@samsung.com</span></h3>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="manage-user-control">
                                       <ul>
                                           <li><a href="#"><i class="fa fa-pencil"></i></a></li>
                                           <li><div class="dropdown">
                                                  <a id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="caret"></span>
                                                  </a>
                                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="#">Is owner</a></li>
                                                    <li><a href="#">Can organize, add & edit</a></li>
                                                    <li><a href="#">Can view only</a></li>
                                                  </ul>
                                                </div>
                                            </li>
                                           <li><a href="#" class="close-user">x</a></li>
                                       </ul>
                                    </div>                                   
                                </div>
                            </div>
                         </div>
                         <div class="manage-users-box">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="manage-user-thumb">
                                        <img src="{{ URL:: asset('/plugins/front/img/manage-users.png') }}" alt="user">
                                    </div>
                                    <div class="manage-user-detail">
                                        <h3>Richard Am (you) <span>richard.am@samsung.com</span></h3>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="manage-user-control">
                                       <ul>
                                           <li><a href="#"><i class="fa fa-pencil"></i></a></li>
                                           <li><div class="dropdown">
                                                  <a id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="caret"></span>
                                                  </a>
                                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="#">Is owner</a></li>
                                                    <li><a href="#">Can organize, add & edit</a></li>
                                                    <li><a href="#">Can view only</a></li>
                                                  </ul>
                                                </div>
                                            </li>
                                           <li><a href="#" class="close-user">x</a></li>
                                       </ul>
                                    </div>                                   
                                </div>
                            </div>
                         </div>
                     </div>

                     <div class="manage-users-sec">
                         <h2>Invite People to this Group</h2>
                         <div class="row">
                             <div class="col-sm-10">
                                 <input type="text" placeholder="Enter email addresses...">
                             </div>
                             <div class="col-sm-2">
                                 <div class="manage-user-control">
                                       <ul class="no-margin">
                                           <li><a href="#"><i class="fa fa-pencil"></i></a></li>
                                           <li><div class="dropdown">
                                                  <a id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="caret"></span>
                                                  </a>
                                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="#">Can organize, add & edit</a></li>
                                                    <li><a href="#">Can view only</a></li>
                                                  </ul>
                                                </div>
                                            </li>                                         
                                       </ul>
                                    </div> 
                             </div>
                         </div> 
                     </div> 

                     <div class="manage-users-sec">
                         <h2>Owner Settings</h2>
                         <ul class="paypal-payment-form">                                                                     
                                     <li class="pws-checkbox">                                        
                                        <input type="checkbox" id="faster" checked="checked">
                                        <label for="faster">Prevent editors from changing access and adding new people</label>
                                    </li> 
                         </ul>
                     </div> 
                      <a href="#" class="users-update-btn">Update</a>


                   </div>
                </div>
            </div>
        </div>
       
      
        
    </section>
</div>


@stop

@section('scripts')
<script type="text/javascript">
    

</script>
@stop
