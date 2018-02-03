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
<!--	<div class="dashboard-banner">
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
					<li class="active">Saved Searches</li>
				</ol>
			</div>
		</div>
	</section>
	<section class="dashboard-content private-user-dashboard">
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
                <div class="col-sm-12">
                    @include('front/element/user_dashboard_menubar_private') 
                </div>
                 <div class="col-sm-12">
                     
		<div class="dashboardData">
			<div class="container">
				<div class="hdercont clearfix">
					<div class="title">
<!--						<h3>Saved Searches</h3>-->
					</div>
					<div class="search pull-right">
						{!! Form::open(array('method'=>'get', "role" => "form")) !!}
							{!! Form::text('name', $searchVal, array('placeholder' => 'search here...', 'class' => 'searchinput')) !!}
							<input type="submit" name="" class="searchbt" value="">
						{!! Form::close() !!}
					</div>
				</div>
				<div class="saveSearchTable">
					<div id="prayer-timing-table" class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Categories</th>
									<th>Phrase</th>
									<th>Location</th>
									<th>Email Frequency</th>
									<th>Remove</th>
								</tr>
							</thead>
							<tbody>
								@if(count($data) > 0)
									@foreach($data as $svdSrchKey => $svdSrchVal)
										<tr>
											<td>{{ $svdSrchVal->category['name'] }}</td>
											<!-- <td>Phrase1 ,Phrase2 ,Phrase3 </td> -->
											<td>
												<?php
												$qryParamsArray = array(
													'itemname' => $svdSrchVal->keyword,
													'city' => $svdSrchVal->city,
													'lat' => $svdSrchVal->lat,
													'lng' => $svdSrchVal->lng,
													'usr_state' => $svdSrchVal->usr_state,
													'usr_city' => $svdSrchVal->usr_city,
													'usr_pcode' => $svdSrchVal->usr_pcode,
													'km' => $svdSrchVal->distance,
													'cat_id' => $svdSrchVal->category_id,
												);
												?>
												<a href="{{ action('admin\ClassifiedController@get_searchresult', $qryParamsArray) }}" target="_blank">{{ $svdSrchVal->name }}</a>
											</td>
											<td>
                                                                                            @if($svdSrchVal->defaultlocation==1)
                                                                                            Australia
                                                                                            @else
                                                                                            {{ $svdSrchVal->usr_city." ".$svdSrchVal->usr_state }}
                                                                                            @endif
                                                                                        </td>
											<td><?php
												$options = array(
													"1" => "Immediately",
													"2" => "Daily",
													"3" => "Weekly",
													"4" => "Never"
												); ?>
												{!! Form::select('filter', $options, $svdSrchVal->email_frequency, ['class' => 'svd-srch-eml-frqncy-sbx', 'data-id' => $svdSrchVal->id]) !!}
											</td>
											<td>
												<span><a href="{{ url('/user/delete-save-search/'.$svdSrchVal->id) }}"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Are you sure?')"></i></a></span>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
					<nav aria-label="Page navigation">
						{{ $data->render() }}
					</nav>
					<!-- <nav aria-label="Page navigation">
						<ul class="pagination">
							<li>
								<a href="javascript:void(0)" aria-label="Previous">
									<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
								</a>
							</li>
							<li><a href="javascript:void(0)">1</a></li>
							<li><a href="javascript:void(0)">2</a></li>
							<li><a href="javascript:void(0)">3</a></li>
							<li><a href="javascript:void(0)">4</a></li>
							<li><a href="javascript:void(0)">5</a></li>
							<li>
								<a href="#" aria-label="Next">
									<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
								</a>
							</li>
						</ul>
					</nav> -->
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
<script type="text/javascript">
		//$( ".svd-srch-eml-frqncy-sbx" ).selectmenu({
		$(document).on("change", ".svd-srch-eml-frqncy-sbx", function() {
			var eFrq = $(this).val();
			var svdSrchID = $(this).attr('data-id');
			$.ajax({
	            url: root_url+"/user/saved-searches",
	            data: {
		            "_token": $('meta[name="csrf-token"]').attr('content'),
		            "svdSrchID": svdSrchID,
		            "e_freq": eFrq
		        },
	            method: "POST",
	            cache: false,
	            success: function (response) {
	                if (response.status) {
	                    Notify.showNotification(response.message, 'success');
	                } else {
	                    Notify.showNotification(response.message, 'error');
	                }
	            }
	        });
		});
</script>
@stop