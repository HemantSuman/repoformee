<div class="Messageblock MessageDeatil">
	<div class="topmsgdetail">
		<div class="row">
			<div class="col-md-3 col-sm-3">
				<div class="topmsgdetailleft">
                                    <input type="hidden" name="classifiedid_chat" class="classifiedid_chat" value="{{$result[0]->classified_id}}"/>
					<img src='{{ URL::asset("upload_images/classified/".$result[0]->classified_id."/".$result[0]->image_name) }}' alt="">
				</div>
			</div>
			<div class="col-md-9 col-sm-9">
				<div class="topmsgdetailright clearfix">
					<div class="_desc">
						<h3>{{ $result[0]->title }}</h3>
						<p>{!! str_limit($result[0]->description, $limit = 20, $end = '...') !!}</p>
					</div>
					<div class="price">
						${{ $result[0]->price }}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="chatWrap">
		<div class="row">
			<div class="col-md-3 col-sm-3">
				<ul class="chatWrapleft avi">
					<li>
						<a href="#">
							<span><img src="{{ URL::asset('plugins/front/img/icons/eye.png') }}" alt=""></span>
							{{ $result[0]->count }}
						</a>
					</li>
					<?php /*
					<li>
						<a href="#">
							<span><img src="{{ URL::asset('plugins/front/img/locate-icon.png') }}" alt=""></span>
							MelBourne
						</a>
					</li >
					*/ 
                                        //dd($result);
                                        ?>
					<li class="cityname">{{ $result[0]->city_name }}</li>
					<li class="classcat"><a href="#">{{ $result[0]->category_name }}</a></li>
				</ul>
			</div>
			<div class="col-md-9 col-sm-9">
				<div class="chatBlock">
						<div class="chatboxInner">
							<div class="chatbox" id="chatBox">
								@foreach($result as $resultKey => $chatMsg)
                                                                   
									@if($chatMsg->authUserId == $chatMsg->sender_id)
										
										<div class="withouticonmsg chatmsg">
                                                                                     <input type="hidden" name="receiveruser_id" class="receiveruser_id" value="{{$chatMsg->user_id}}"/>
											<div class="msgtxt">
												<p>{{ $chatMsg->massage }}</p>
											</div>
											<div class="chattime">
												<span>{!! Helper::time_since(time() - strtotime($chatMsg->time)).' ago' !!}</span>
											</div>
										</div>

									@else

										<div class="withiconmsg chatmsg">
											<div class="icon">
                                                                                            <input type="hidden" name="receiveruser_id" class="receiveruser_id" value="{{$chatMsg->user_id}}"/>
												<a href="#">
													@if(!empty($chatMsg->user_image))
														<img src='{{ URL::asset("/upload_images/users/$chatMsg->user_id/$chatMsg->user_image") }}' alt="">
													@else
														<img src="{{ URL::asset('plugins/front/img/icons/user.png') }}" alt="">
													@endif
												</a>
											</div>
											<div class="msgtxt">
												<p>{{ $chatMsg->massage }}</p>
											</div>
											<div class="chattime">
												<span>{{ $chatMsg->time }}</span>
											</div>
										</div>
										
									@endif

								@endforeach


								
							</div>

						</div>
						<div class="sendmsgWrp">
							<div class="sendmsg">
								<input type="text" name="" value="" placeholder="Type here..." class="form-control textareaMessageChat">
								<input type="Submit" name="" value="Send" text="Send" class="btn sendbtn sendMessageButton" classliidforchat="{{ $result[0]->classified_id }}" sender_id="{{ $result[0]->authUserId }}" receiver_id="{{ $result[0]->user_id }}">
							</div>
						</div>

				</div>
			</div>
		</div>
	</div>
</div>