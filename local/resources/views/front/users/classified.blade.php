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
					<li><a href="javascript:void(0)">Profile</a></li>
					<li class="active">Ads Management</li>
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
                    
    <div class="dashboardData">
      <h2>Ad Management</h2>  
          
               
                <div class="DashboardTabWrap clearfix">
                    <ul class="DashboardleftTab">
                                            
                                            
                        <li class=""><a href="{{ url('/user/post-classified') }}" class="btn-orange"> Post an Ad</a></li>

                        <li class="active"><a href="#active" role="tab" class="classi-tab-link" data-toggle="tab" data-tab="active" data-tab-field="status" data-tab-val="1">Active</a></li>

                        <li><a href="#inactive" role="tab" data-toggle="tab" class="classi-tab-link" data-tab="inactive" data-tab-field="status" data-tab-val="0">Inactive</a></li>

                        <li><a href="#expired" data-toggle="tab" role="tab" class="classi-tab-link" data-tab="expired" data-tab-field="end_date" data-tab-val='{{ date("Y-m-d") }}'>Expired</a></li>

                        <li><a href="#unapproved" data-toggle="tab" role="tab" class="classi-tab-link" data-tab="unapproved" data-tab-field="status" data-tab-val='2'>Pending</a></li>

                        <li><a href="#rejected" data-toggle="tab" role="tab" class="classi-tab-link" data-tab="rejected" data-tab-field="status" data-tab-val='3'>Rejected</a></li>

                        <li><a href="#Trash" role="tab" data-toggle="tab" class="classi-tab-link" data-tab="rejected" data-tab-field="status" data-tab-val="2">Trash</a></li>

                    </ul>
                    <div class="tab-content">

                        <div class="Topbar msg-topbar">
                            <ul>
                                <li class="select arrowWithCheck">
                                    <a>
                                        <input type="checkbox" name="" value="" class="m-checkbox checkAllClass">
                                        <label><i class="fa fa-caret-down" aria-hidden="true"></i></label>
                                    </a>
                                </li>
                                <li class="refresh">
                                    <a>
                                        <img src="{{ URL::asset('plugins/front/img/icons/refresh-icon.jpg') }}" alt="">
                                    </a>
                                </li>
                                <li class="">
                                    <a href="">
                                        More
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </a>
                                </li>
                               <!-- <li class="delete">
                                    <a href="javascript:void(0)" class="deleteIconCheck">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <div class="deleteMsgLoadIcon hide">
                                        <img src="{{ URL:: asset('/plugins/front/img/icons/p2.gif') }}">
                                    </div>
                                </li>-->
                                <li class="pull-right">
                                    <span>Sort By:</span>
                                   <!--  <select class="custom-select readUnread msg-sort-select-box">
                                        <option value="">Select one</option>
                                        <option value="1">Read Message</option>
                                        <option value="0">Unread Message</option>
                                    </select> -->
                                    <select class="custom-select shortBy msg-sort-select-box">
                                        <option value="">Select one</option>
                                        <option value="ASC">Ascending</option>
                                        <option value="DESC">Descending</option>
                                    </select>
                                </li>
                            </ul>
                        </div>

                        <div class="processing-block text-center">
                            <img src="{{ URL::asset('plugins/front/img/animation_processing.gif') }}">
                        </div>

                        <div class="tab-pane active tab-classi-content" id="Active">
                            
                        </div>
<!--                        <nav aria-label="Page navigation">
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
                                            </nav>-->
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
	$(function() {
         $('#msgToggle').bootstrapToggle({
            width: 25,
            height: 50,
        });


		$.ajax({
            url: root_url + '/user/classifieds',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "status": 1,
                "tab": "active"
            },
            method: "POST",
            cache: false,
            success: function (response) {
                $(".processing-block").addClass("hide");
                $('.tab-classi-content').append(response);
                 
            }
        });	

        $(document).on('click', '.classi-tab-link', function() {
        	
        	var $container = $('.tab-classi-content'),
    		$noRemove = $container.find('.classi-proc-img');
			$container.html($noRemove);
			$('.classi-proc-img').removeClass('hide');
        	
        	var tab_field = $(this).attr('data-tab-field');
        	var data = {};
        	data["_token"] = $('meta[name="csrf-token"]').attr('content');
        	data[tab_field] = $(this).attr('data-tab-val');
        	data["tab"] = $(this).attr('data-tab');

            console.log(data);
            console.log(root_url + '/user/classifieds');

        	$.ajax({
	            url: root_url + '/user/classifieds',
	            data: data,
	            method: "POST",
	            cache: false,
	            success: function (response) {
	                $('.classi-proc-img').addClass('hide');
	                $('.tab-classi-content').html(response);
	                $("#searchClassified")[0].reset()

	                if(data["tab"] == "expired") {
						$('.exprd-rmv-icns').addClass("hide");
					}
	            }
	        });
        })

        $(document).on('click', 'ul.pagination li a', function(event) {
        	event.preventDefault();

        	var $container = $('.tab-classi-content'),
    		$noRemove = $container.find('.classi-proc-img');
			$container.html($noRemove);
			$('.classi-proc-img').removeClass('hide');

        	var data = {};
        	var tab_field = $('ul#myTabs li.active').find('a').attr('data-tab-field');
        	data["_token"] = $('meta[name="csrf-token"]').attr('content');
        	data[tab_field] = $('ul#myTabs li.active').find('a').attr('data-tab-val');
        	data["tab"] = $('ul#myTabs li.active').find('a').attr('data-tab');
        	$.post($(this).attr("href"), data, function (response) {
        		$('.tab-classi-content').html(response);
        		$('html, body').animate({
        			'scrollTop' : $(".tab-classi-content").position().top
    			});
    			$("#searchClassified")[0].reset()
            });
        })

        $("#searchClassified").submit(function(){
        	var $container = $('.tab-classi-content'),
    		$noRemove = $container.find('.classi-proc-img');
			$container.html($noRemove);
			$('.classi-proc-img').removeClass('hide');

			var data = {};
			var tab_field = $('ul#myTabs li.active').find('a').attr('data-tab-field');
			var tab_value = $('ul#myTabs li.active').find('a').attr('data-tab-val');
			var tab = $('ul#myTabs li.active').find('a').attr('data-tab');
        	
        	data["_token"] = $('meta[name="csrf-token"]').attr('content');
        	data[tab_field] = tab_value;
        	data["tab"] = tab;
        	data["title"] = $(".searchClassifiedSrchKeywrd").val();

			$.ajax({
	            url: $(this).attr("action"),
	            data: data,
	            method: "POST",
	            cache: false,
	            success: function (response) {

	            	$('.classi-proc-img').addClass('hide');
	                $('.tab-classi-content').html(response);
	            }
	        });
			return false;
		});


//        $(document).on('click', '.deleteRecord', function() {
//
//            var id= $(this).attr("classId");
//
//            if(confirm('Are you sure for delete?'))
//            {
//                return true;
//            }
//            else
//            {
//                return false;
//            }
//        })


         
       


	})
	
</script>
@stop
