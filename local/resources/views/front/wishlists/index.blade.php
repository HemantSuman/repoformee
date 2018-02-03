@extends('front/layout/layout')
@section('content')
<div id="middle">
	<!-- main banner section -->
	<section>
        <div id="main-banner">
            <div class="banner-carousel">
                @if(sizeof($top_positions_ads) > 0)
                    @foreach($top_positions_ads as $top_ad_key => $top_single_ad)
                        <a href="{!! Helper::show_url($top_single_ad->image_url) !!}" target="_blank">
                            <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$top_single_ad->image) !!}" alt="banner-img">
                        </a>
                    @endforeach
                @elseif(!empty($default_top_position_ad))
                    <a href="{!! Helper::show_url($default_top_position_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_top_position_ad->image) !!}" alt="banner-img">
                </a>
                @endif
            </div>
        </div>
    </section>

	<!-- breadcrumb section -->
	<section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>              
                    <li class="active">Wishlist</li>
                </ol>
            </div>
        </div>
    </section>

	<!-- categories section -->
	<section>
		<div id="main-inner-section">
			<div class="container">
				<div class="row">
					<!-- style in main-categories.scss file -->
					<div class="col-sm-8 col-sm-offset-2	">
						<div id="list-view" class="listing-block">
							<div class="top-section wishlisht-top">
								<div class="top-titile">
									<div class="title">
										<h1>Wishlist</h1>
									</div>
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
											<!-- <div class="col-md-7">
												<div class="filters">
													<span class="sortby">Sort by:</span>
													<div class="sorting-options">
														<select id="select-options-1">
															<option value="title_asc">Name A to Z</option>
                                                            <option value="title_desc">Name Z to A</option>
													</select>
												</div>
												<span class="decending-img"><img src="{{url('plugins/front/img/descending.png')}}" alt=""></span>

												</div>
											</div> -->
										</div>
									</div>
							</div>
							<!-- style in class-fied grid.scss -->
							<div class="search-listing search-result-list list-view">
	                            @if(count($wishlistItems) > 0)
                                    
	                            	@foreach($wishlistItems as $wishlKey => $wishlVal)
										<div class="list-row">
											<div href="javascript:void(0)" class="clearfix">
											<div class="col-md-3 col-sm-6 col-xs-6"> 
                                                                                            <?Php $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $wishlVal['classified']['title']); ?>
												<a href="{{ url('/classifieds/'. $encodetitle .'/'.$wishlVal['classified']['id']) }}" target="_blank">
													<div class="list-img">
															<img src="{!! asset('/upload_images/classified/'.$wishlVal['classified']['id'].'/'.$wishlVal['classified']['classified_image'][0]['name']) !!}" alt="">
															<span class="tab-badge">{!! Helper::time_since_for_classified(time() - strtotime($wishlVal['classified']['created_at'])) !!}</span>
													</div>
												</a>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<div class="list-data">
													<a href="{{ url('/classifieds/'.$wishlVal['classified']['id']) }}" target="_blank"><h3>{{ str_limit($wishlVal['classified']['title'], 20) }}</h3></a>
													<p>{{ str_limit(strip_tags($wishlVal['classified']['description']), 100) }}</p>

													@if(isset($wishlVal['classified']['classified_attribute']) && !empty($wishlVal['classified']['classified_attribute']))
                                                        <ul class="list-features">
                                                                <?php
                                                                foreach ($wishlVal['classified']['classified_attribute'] as $i => $v) {

                                                                    if (in_array($v['attr_type_name'], ['Multi-Select', 'Radio-button'])) {
                                                                        ?>
                                                                        <li>
	                                                                        <label><img src="{{ url("upload_images/attributes/30px/$v[attribute_id]/$v[icon]") }}" alt="specification-icon"></label>
					                                                        <?php /*<label><img src="{{url('plugins/front/img/icons/share.png')}}" alt="icon"></label>*/ ?>
					                                                        <span>{{ str_limit($v['attribute_value'][$v['attr_value']], 15) }}</span>
				                                                        </li>

                                                                    <?php } else if (in_array($v['attr_type_name'], ['Drop-Down'])) {
                                                                        ?>
                                                                        <li>
					                                                        <label><img src="{{ url("upload_images/attributes/30px/$v[attribute_id]/$v[icon]") }}" alt="specification-icon"></label>
					                                                        <?php /*<label><img src="{{url('plugins/front/img/icons/share.png')}}" alt="icon"></label>*/ ?>
					                                                        <span>{{ str_limit($v['attr_AllValues'][$v['attr_value']], 10) }}</span>
					                                                    </li>

                                                                    <?php } else {
                                                                        ?>
                                                                        <li>
					                                                        <label><img src="{{ url("upload_images/attributes/30px/$v[attribute_id]/$v[icon]") }}" alt="specification-icon"></label>
					                                                        <?php /*<label><img src="{{url('plugins/front/img/icons/share.png')}}" alt="icon"></label> */ ?>
					                                                        <span>{{ str_limit($v['attr_value'], 10) }}</span>
					                                                    </li>


                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                       @endif

													
													@if($wishlVal['classified']['price'] > 0)
                                                        <span class="price">${{ $wishlVal['classified']['price'] }}</span>
                                                    @endif
												</div>
											</div>
											<div class="col-md-3 col-sm-12 col-xs-12">
												<div class="list-right">

												    <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $wishlVal['classified']['id'] }}" is-page-refresh="1">
                                                        <div class="heart"><i class="fa fa-heart"></i></div>
                                                    </a>

													<!-- <div class="heart"><i class="fa fa-heart"></i></div> -->
													<div class="location">
                                                                                                            
														@if(!empty($wishlVal['classified']['location']))
														@if(!empty($wishlVal['classified']['city']))
								                            <?php $expSimLoc = explode(',',trim($wishlVal['classified']['location'])); ?>
								                            <span class="classfd-location">{{ $wishlVal['classified']['city']['City'] }}</span>
								                        @endif
								                        @endif
														<span>{!! Helper::time_since(time() - strtotime($wishlVal['classified']['created_at'])) !!} ago</span>
													</div>
												</div>
											</div>
											</div>
										</div>
                                 	@endforeach
								@else
					   				<div class="row list-row"><h3>No Records Found.</h3></div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- categories section -->
	@if(sizeof($bottom_positions_ads) > 0)
        <section id="add-space">
            <div class="adv-banner">
                @foreach($bottom_positions_ads as $bottom_ad_key => $bottom_single_ad)
                    <a href="{!! Helper::show_url($bottom_single_ad->image_url) !!}" target="_blank">
                        <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$bottom_single_ad->image) !!}" alt="banner-img">
                    </a>
                @endforeach
            </div>
        </section>
    @elseif(!empty($default_bottom_position_ad))
        <section id="add-space">
            <div class="adv-banner">
                <a href="{!! Helper::show_url($default_bottom_position_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_bottom_position_ad->image) !!}" alt="banner-img">
                </a>
            </div>
        </section>
    @endif
</div>


@stop

@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add-attachment input[type="file"]').on('change', function() {
            var file_name = $(this).val().replace(/\\/g, '/').replace(/.*\//,'');
            $('.custom-label').text(file_name).css('display', 'block');
        });

        $(".contact-us-form").submit(function(event) {
            var status = true;
            var email_regex = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            $(".error-message").text("");
            if($(".cntct-name").val() == '') {
                $(".cntct-name-error").text("This field is required.");
                status = false;
            }
            if($(".cntct-email").val() == '') {
                $(".cntct-email-error").text("This field is required.");
                status = false;
            } else if(!email_regex.test($(".cntct-email").val())) {
                $('.cntct-email-error').text('Invalid email address.');
                status = false;
            }
            if($(".cntct-query").val() == '') {
                $(".cntct-query-error").text("This field is required.");
                status = false;
            }
            if($("#g-recaptcha-response").val() == '') {
                $(".google-cptcha-error").text("Verify the captcha.");
                status = false;
            }

            if(status) {
                return true;
            } else {
                event.preventDefault();
            }
        })

        <?php
        if(Session::has('success')) {
            $showMessage = array('status' => 1, 'type' => 'done', 'message' => Session::get('success')); ?>
            Notify.showMessage("<?php echo $showMessage['message']; ?>", "<?php echo $showMessage['type']; ?>"); <?php
        }

        if(Session::has('danger')) {
            $showMessage = array('status' => 1, 'type' => 'warning', 'message' => Session::get('danger')); ?>
            Notify.showMessage("<?php echo $showMessage['message']; ?>", "<?php echo $showMessage['type']; ?>"); <?php
        }
        ?>
    });    
</script>

@stop