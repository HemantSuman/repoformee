<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="general">
	    
		<table id="nws-feed-table" class="display news-list" data-page-length='10'>
			<thead>
				<tr><th style="border-bottom: 0; padding: 0;"></th ></tr>
			</thead>
			<tbody>
			    @if(!empty($feeds))
					@foreach($feeds as $fdKey => $fdVal)
			        	<tr is_data="1">
			        		<td>
		            			<div class="feed-icon">
									<img src="{{$fdVal['image'] ? $fdVal['image']  :  URL::asset('plugins/front/img/newsfeed.png') }}" alt="feed-icon">
								</div>
								<div class="feed-content">
									<div class="title">{{$fdVal['news_type']}}</div>
									<a href="{{$fdVal['url']}}" target="_blank">{{$fdVal['title']}} </a>
									<div class="date">{{$fdVal['publish_date']}}</div>
								</div>
							</td>
			        	</tr>
			        @endforeach
		    	@else
		    		<tr is_data="0"><td><h3>No Records.</h3></td></li>
		    	@endif
		    </tbody>
		</table>
    </div>
</div>