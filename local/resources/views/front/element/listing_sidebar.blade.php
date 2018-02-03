<!-- common sidebar -->
<aside id="home-sidebar">
	<!-- <div class="widgets marketing-banner">
		<img src="{{ URL::asset('plugins/front/img/marketing-banner.jpg') }}" alt="fashion-sale">
	</div> -->
	
		<!-- fashion-sale widget iframe appears here in replacement of this banner -->
		@if(sizeof($right_positions_ads) == 0)
                <div class="widgets fashion-sale">
			@if(!empty($default_right_position_ad))
			<a href="{!! Helper::show_url($default_right_position_ad->image_url) !!}" target="_blank">
				<img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_right_position_ad->image) !!}" alt="adv-banner.jpg">
			</a>
			@endif
		@else
			@foreach($right_positions_ads as $right_ad_key => $right_single_ad)
				<a href="{!! Helper::show_url($right_single_ad->image_url) !!}" target="_blank">
					<img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$right_single_ad->image) !!}" alt="adv-banner.jpg">
				</a>
			@endforeach
                        </div>
		@endif
	
</aside>