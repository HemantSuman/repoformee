@extends('front/layout/layout')

@section('content')
<div id="middle" class="no-banner">
	<div class="dashboard-banner">
		<div class="userImg">
			@if(empty($user_details['image']))
            	<img src="{{ URL::asset('plugins/front/img/no_avatar.gif') }}" alt="profile-img-new">
            @elseif(($user_details['avatar']))
            	<img src="{{ Auth::guard('web')->user()->avatar }}" alt="profile-img-new">	
            @else
            	<img src="{{ URL::asset('upload_images/users/'.$user_details['id'].'/'.$user_details['image']) }}" alt="profile-img-new">	
            @endif

				
		</div>
		<div class="Changepic">
			{!! Form::open(array("role" => "form", 'id' => 'update-profile-img-form', 'files' => true, 'method' => 'POST')) !!}
			<input type="file" name="image" id="file2" class="filetype chng-prfl-pic-btn">
			<label for="file2">Change Photo</label>
			<p>Image must be in JPG or PNG format and under 5 mb.</p>
			{!! Form::close() !!}
		</div>
	</div>
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
					Matt dabson
				</div>
				<ul class="aboutUser">
					<li>163900 views</li>
					<li>16 Ads foud</li>
					<li> <span><img src="assets/img/locate-icon.png" alt=""></span>Melbourne</li>
					<li><span><img src="assets/img/icons/calander-icon.png" alt=""></span> Member Since</li>
				</ul>
			</div>
	</div>
	<div class="dashboardLink">
		<div class="container">
			<ul>
				<li>
					<a href="#">Profile</a>
				</li>
				<li>
					<a href="#" class="active">Message</a>
				</li>
				<li>
					<a href="#">Manage Ads</a>
				</li>
				<li>
					<a href="#">Saved Searches</a>
				</li>
			</ul>
		</div>


	</div>
	<div class="dashboardData">
			<div class="container">
				<div class="hdercont clearfix">
					<div class="title">
							<h3>Messages</h3>
					</div>
					<div class="messageLinks">
						<ul>
							<li><a href="#" class="active">Buying</a></li>
							<li><a href="#">selling</a></li>
							<li><a href="#">Blocked</a></li>
						</ul>
					</div>
					<div class="search pull-right">
							<input type="search" name="" value="" placeholder="Search here..." class="searchinput">
							<input type="submit" name="" value="" class="searchbt">
					</div>
				</div>
				<div class="DashboardTabWrap clearfix">
					<ul class="DashboardleftTab">
						<li class=""><a href="#" class="btn-orange"> Compose</a></li>
						<li class="active"><a href="#Active" data-toggle="tab">Inbox</a></li>
						<li><a href="#Inactive" data-toggle="tab">Sent</a></li>
						<li><a href="#Expired" data-toggle="tab">Trash</a></li>
						<li><a href="#Trash" data-toggle="tab">Archive</a></li>

					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="Active">
							<div class="Topbar">
								<ul>
									<li class="select arrowWithCheck">
										<a>
											<input type="checkbox" name="" value="" class="m-checkbox">
											<label><i class="fa fa-caret-down" aria-hidden="true"></i></label>
										</a>
									</li>
									<li class="refresh">
										<a>
											<img src="assets/img/icons/refresh-icon.jpg" alt="">
										</a>
									</li>
									<li class="">
										<a href="">
											More
											<i class="fa fa-caret-down" aria-hidden="true"></i>

										</a>
									</li>
									<li class="delete">
										<a href="">

											<i class="fa fa-trash" aria-hidden="true"></i>

										</a>
									</li>
									<li class="pull-right">
										<span>Sort By:</span>
										<a href="">
											Read Message
											<i class="fa fa-caret-down" aria-hidden="true"></i>

										</a>
										<a href="">
											BY Date
											<i class="fa fa-caret-down" aria-hidden="true"></i>

										</a>
									</li>
								</ul>
							</div>
							<div class="Messageblock emailblock">
								<div class="row msgrow">
									<div class="col-md-4 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5 col-sm-4">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-star-o" aria-hidden="true"></i></i></span>

														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7 col-sm-8">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-8 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7 col-sm-7">
													<div class="msgData">
															<h3>Classified name</h3>

															<ul>
																<li class="icon">
																	<a href="#">
																		<img src="assets/img/icons/user.png" alt="">
																	</a>
																</li>
																<li class="desc">
																	<a href="#" >
																		<span> Seller name</span>
																		<p>message content</p>
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5 col-sm-5">
													<div class="msgRight">
														<span>Conversions : 1</span>
														<span class="time">3:31 Pm</span>
														<span class="date"><a href="#">Reply <i class="fa fa-reply" aria-hidden="true"></i></a></span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-4 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5 col-sm-4">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-star-o" aria-hidden="true"></i></i></span>

														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7 col-sm-8">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-8 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7 col-sm-7">
													<div class="msgData">
															<h3>Classified name</h3>

															<ul>
																<li class="icon">
																	<a href="#">
																		<img src="assets/img/icons/user.png" alt="">
																	</a>
																</li>
																<li class="desc">
																	<a href="#" >
																		<span> Seller name</span>
																		<p>message content</p>
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5 col-sm-5">
													<div class="msgRight">
														<span>Conversions : 1</span>
														<span class="time">3:31 Pm</span>
														<span class="date"><a href="#">Reply <i class="fa fa-reply" aria-hidden="true"></i></a></span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-4 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5 col-sm-4">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-star-o" aria-hidden="true"></i></i></span>

														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7 col-sm-8">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-8 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7 col-sm-7">
													<div class="msgData">
															<h3>Classified name</h3>

															<ul>
																<li class="icon">
																	<a href="#">
																		<img src="assets/img/icons/user.png" alt="">
																	</a>
																</li>
																<li class="desc">
																	<a href="#" >
																		<span> Seller name</span>
																		<p>message content</p>
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5 col-sm-5">
													<div class="msgRight">
														<span>Conversions : 1</span>
														<span class="time">3:31 Pm</span>
														<span class="date"><a href="#">Reply <i class="fa fa-reply" aria-hidden="true"></i></a></span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-4 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5 col-sm-4">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-star-o" aria-hidden="true"></i></i></span>

														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7 col-sm-8">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-8 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7 col-sm-7">
													<div class="msgData">
															<h3>Classified name</h3>

															<ul>
																<li class="icon">
																	<a href="#">
																		<img src="assets/img/icons/user.png" alt="">
																	</a>
																</li>
																<li class="desc">
																	<a href="#" >
																		<span> Seller name</span>
																		<p>message content</p>
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5 col-sm-5">
													<div class="msgRight">
														<span>Conversions : 1</span>
														<span class="time">3:31 Pm</span>
														<span class="date"><a href="#">Reply <i class="fa fa-reply" aria-hidden="true"></i></a></span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-4 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5 col-sm-4">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-star-o" aria-hidden="true"></i></i></span>

														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7 col-sm-8">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-8 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7 col-sm-7">
													<div class="msgData">
															<h3>Classified name</h3>

															<ul>
																<li class="icon">
																	<a href="#">
																		<img src="assets/img/icons/user.png" alt="">
																	</a>
																</li>
																<li class="desc">
																	<a href="#" >
																		<span> Seller name</span>
																		<p>message content</p>
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5 col-sm-5">
													<div class="msgRight">
														<span>Conversions : 1</span>
														<span class="time">3:31 Pm</span>
														<span class="date"><a href="#">Reply <i class="fa fa-reply" aria-hidden="true"></i></a></span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-4 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5 col-sm-4">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-star-o" aria-hidden="true"></i></i></span>

														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7 col-sm-8">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-8 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7 col-sm-7">
													<div class="msgData">
															<h3>Classified name</h3>

															<ul>
																<li class="icon">
																	<a href="#">
																		<img src="assets/img/icons/user.png" alt="">
																	</a>
																</li>
																<li class="desc">
																	<a href="#" >
																		<span> Seller name</span>
																		<p>message content</p>
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5 col-sm-5">
													<div class="msgRight">
														<span>Conversions : 1</span>
														<span class="time">3:31 Pm</span>
														<span class="date"><a href="#">Reply <i class="fa fa-reply" aria-hidden="true"></i></a></span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-4 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5 col-sm-4">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-star-o" aria-hidden="true"></i></i></span>

														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7 col-sm-8">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-8 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7 col-sm-7">
													<div class="msgData">
															<h3>Classified name</h3>

															<ul>
																<li class="icon">
																	<a href="#">
																		<img src="assets/img/icons/user.png" alt="">
																	</a>
																</li>
																<li class="desc">
																	<a href="#" >
																		<span> Seller name</span>
																		<p>message content</p>
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5 col-sm-5">
													<div class="msgRight">
														<span>Conversions : 1</span>
														<span class="time">3:31 Pm</span>
														<span class="date"><a href="#">Reply <i class="fa fa-reply" aria-hidden="true"></i></a></span>
													</div>
												</div>
											</div>
										</div>

								</div>
							</div>
							<nav aria-label="Page navigation">
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
												</nav>
						</div>
						<div class="tab-pane" id="Inactive">
							<div class="Topbar">
								<ul>
									<li class="select arrowWithCheck">
										<a>
											<input type="checkbox" name="" value="" class="m-checkbox">
											<label><i class="fa fa-caret-down" aria-hidden="true"></i></label>
										</a>
									</li>
									<li class="refresh">
										<a>
											<img src="assets/img/icons/refresh-icon.jpg" alt="">
										</a>
									</li>
									<li class="">
										<a href="">
											More
											<i class="fa fa-caret-down" aria-hidden="true"></i>

										</a>
									</li>
									<li class="pull-right">
										<span>Sort By:</span>
										<a href="">
											BY Date
											<i class="fa fa-caret-down" aria-hidden="true"></i>

										</a>
									</li>
								</ul>
							</div>
							<div class="Messageblock">
								<div class="row msgrow">
									<div class="col-md-5 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-heart-o"></i></span>
															<span>10800</span>
														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-7 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7">
													<div class="msgData">
															<h3>Classified name</h3>
															<p>Classified Desc</p>
															<a class="clascat" href="#">Classified Category</a>
															<ul >
																<li>
																	<a href="#">
																		<span><img src="assets/img/icons/eye.png" alt=""></span>
																		1000
																	</a>
																</li>
																<li>
																	<a href="#">
																		<span><img src="assets/img/locate-icon.png" alt=""></span>
																		MelBourne
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5">
													<div class="msgRight">
														<ul>
															<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
														</ul>
														<span class="price">$99.99</span>
														<span class="date">20 January 2017</span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-5 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-heart-o"></i></span>
															<span>10800</span>
														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-7 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7">
													<div class="msgData">
															<h3>Classified name</h3>
															<p>Classified Desc</p>
															<a class="clascat" href="#">Classified Category</a>
															<ul >
																<li>
																	<a href="#">
																		<span><img src="assets/img/icons/eye.png" alt=""></span>
																		1000
																	</a>
																</li>
																<li>
																	<a href="#">
																		<span><img src="assets/img/locate-icon.png" alt=""></span>
																		MelBourne
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5">
													<div class="msgRight">
														<ul>
															<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
														</ul>
														<span class="price">$99.99</span>
														<span class="date">20 January 2017</span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-5 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-heart-o"></i></span>
															<span>10800</span>
														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-7 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7">
													<div class="msgData">
															<h3>Classified name</h3>
															<p>Classified Desc</p>
															<a class="clascat" href="#">Classified Category</a>
															<ul >
																<li>
																	<a href="#">
																		<span><img src="assets/img/icons/eye.png" alt=""></span>
																		1000
																	</a>
																</li>
																<li>
																	<a href="#">
																		<span><img src="assets/img/locate-icon.png" alt=""></span>
																		MelBourne
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5">
													<div class="msgRight">
														<ul>
															<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
														</ul>
														<span class="price">$99.99</span>
														<span class="date">20 January 2017</span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-5 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-heart-o"></i></span>
															<span>10800</span>
														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-7 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7">
													<div class="msgData">
															<h3>Classified name</h3>
															<p>Classified Desc</p>
															<a class="clascat" href="#">Classified Category</a>
															<ul >
																<li>
																	<a href="#">
																		<span><img src="assets/img/icons/eye.png" alt=""></span>
																		1000
																	</a>
																</li>
																<li>
																	<a href="#">
																		<span><img src="assets/img/locate-icon.png" alt=""></span>
																		MelBourne
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5">
													<div class="msgRight">
														<ul>
															<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
														</ul>
														<span class="price">$99.99</span>
														<span class="date">20 January 2017</span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-5 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-heart-o"></i></span>
															<span>10800</span>
														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-7 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7">
													<div class="msgData">
															<h3>Classified name</h3>
															<p>Classified Desc</p>
															<a class="clascat" href="#">Classified Category</a>
															<ul >
																<li>
																	<a href="#">
																		<span><img src="assets/img/icons/eye.png" alt=""></span>
																		1000
																	</a>
																</li>
																<li>
																	<a href="#">
																		<span><img src="assets/img/locate-icon.png" alt=""></span>
																		MelBourne
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5">
													<div class="msgRight">
														<ul>
															<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
														</ul>
														<span class="price">$99.99</span>
														<span class="date">20 January 2017</span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-5 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-heart-o"></i></span>
															<span>10800</span>
														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-7 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7">
													<div class="msgData">
															<h3>Classified name</h3>
															<p>Classified Desc</p>
															<a class="clascat" href="#">Classified Category</a>
															<ul >
																<li>
																	<a href="#">
																		<span><img src="assets/img/icons/eye.png" alt=""></span>
																		1000
																	</a>
																</li>
																<li>
																	<a href="#">
																		<span><img src="assets/img/locate-icon.png" alt=""></span>
																		MelBourne
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5">
													<div class="msgRight">
														<ul>
															<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
														</ul>
														<span class="price">$99.99</span>
														<span class="date">20 January 2017</span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-5 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-heart-o"></i></span>
															<span>10800</span>
														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-7 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7">
													<div class="msgData">
															<h3>Classified name</h3>
															<p>Classified Desc</p>
															<a class="clascat" href="#">Classified Category</a>
															<ul >
																<li>
																	<a href="#">
																		<span><img src="assets/img/icons/eye.png" alt=""></span>
																		1000
																	</a>
																</li>
																<li>
																	<a href="#">
																		<span><img src="assets/img/locate-icon.png" alt=""></span>
																		MelBourne
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5">
													<div class="msgRight">
														<ul>
															<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
														</ul>
														<span class="price">$99.99</span>
														<span class="date">20 January 2017</span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-5 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-heart-o"></i></span>
															<span>10800</span>
														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-7 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7">
													<div class="msgData">
															<h3>Classified name</h3>
															<p>Classified Desc</p>
															<a class="clascat" href="#">Classified Category</a>
															<ul >
																<li>
																	<a href="#">
																		<span><img src="assets/img/icons/eye.png" alt=""></span>
																		1000
																	</a>
																</li>
																<li>
																	<a href="#">
																		<span><img src="assets/img/locate-icon.png" alt=""></span>
																		MelBourne
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5">
													<div class="msgRight">
														<ul>
															<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
														</ul>
														<span class="price">$99.99</span>
														<span class="date">20 January 2017</span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="row msgrow">
									<div class="col-md-5 col-sm-5 col-xs-12">
										<div class="row">
											<div class="col-md-5">
												<ul class="firstBox">
													<li class="chek">
														<a>
															<input type="checkbox" name="" value="" class="m-checkbox">
															<label></label>
														</a>
													</li>
													<li class="hert">
														<a>
															<span><i class="fa fa-heart-o"></i></span>
															<span>10800</span>
														</a>
													</li>
												</ul>
											</div>
											<div class="col-md-7">
												<div class="msgImg">
													<img src="assets/img/icons/dash-img.jpg" alt="">
												</div>

											</div>
										</div>
									</div>
										<div class="col-md-7 col-sm-7 col-xs-12">
											<div class="row">
												<div class="col-md-7">
													<div class="msgData">
															<h3>Classified name</h3>
															<p>Classified Desc</p>
															<a class="clascat" href="#">Classified Category</a>
															<ul >
																<li>
																	<a href="#">
																		<span><img src="assets/img/icons/eye.png" alt=""></span>
																		1000
																	</a>
																</li>
																<li>
																	<a href="#">
																		<span><img src="assets/img/locate-icon.png" alt=""></span>
																		MelBourne
																	</a>
																</li>
															</ul>
													</div>
												</div>
												<div class="col-md-5">
													<div class="msgRight">
														<ul>
															<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
															<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
														</ul>
														<span class="price">$99.99</span>
														<span class="date">20 January 2017</span>
													</div>
												</div>
											</div>
										</div>

								</div>
							</div>
							<nav aria-label="Page navigation">
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
												</nav>

						</div>
						<div class="tab-pane" id="Expired"><div class="Topbar">
							<ul>
								<li class="select arrowWithCheck">
									<a>
										<input type="checkbox" name="" value="" class="m-checkbox">
										<label><i class="fa fa-caret-down" aria-hidden="true"></i></label>
									</a>
								</li>
								<li class="refresh">
									<a>
										<img src="assets/img/icons/refresh-icon.jpg" alt="">
									</a>
								</li>
								<li class="">
									<a href="">
										More
										<i class="fa fa-caret-down" aria-hidden="true"></i>

									</a>
								</li>
								<li class="pull-right">
									<span>Sort By:</span>
									<a href="">
										BY Date
										<i class="fa fa-caret-down" aria-hidden="true"></i>

									</a>
								</li>
							</ul>
						</div>
						<div class="Messageblock">
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
						</div>
						<nav aria-label="Page navigation">
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
											</nav></div>
						<div class="tab-pane" id="Trash"><div class="Topbar">
							<ul>
								<li class="select arrowWithCheck">
									<a>
										<input type="checkbox" name="" value="" class="m-checkbox">
										<label><i class="fa fa-caret-down" aria-hidden="true"></i></label>
									</a>
								</li>
								<li class="refresh">
									<a>
										<img src="assets/img/icons/refresh-icon.jpg" alt="">
									</a>
								</li>
								<li class="">
									<a href="">
										More
										<i class="fa fa-caret-down" aria-hidden="true"></i>

									</a>
								</li>
								<li class="pull-right">
									<span>Sort By:</span>
									<a href="">
										BY Date
										<i class="fa fa-caret-down" aria-hidden="true"></i>

									</a>
								</li>
							</ul>
						</div>
						<div class="Messageblock">
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
							<div class="row msgrow">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="row">
										<div class="col-md-5">
											<ul class="firstBox">
												<li class="chek">
													<a>
														<input type="checkbox" name="" value="" class="m-checkbox">
														<label></label>
													</a>
												</li>
												<li class="hert">
													<a>
														<span><i class="fa fa-heart-o"></i></span>
														<span>10800</span>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-md-7">
											<div class="msgImg">
												<img src="assets/img/icons/dash-img.jpg" alt="">
											</div>

										</div>
									</div>
								</div>
									<div class="col-md-7 col-sm-7 col-xs-12">
										<div class="row">
											<div class="col-md-7">
												<div class="msgData">
														<h3>Classified name</h3>
														<p>Classified Desc</p>
														<a class="clascat" href="#">Classified Category</a>
														<ul >
															<li>
																<a href="#">
																	<span><img src="assets/img/icons/eye.png" alt=""></span>
																	1000
																</a>
															</li>
															<li>
																<a href="#">
																	<span><img src="assets/img/locate-icon.png" alt=""></span>
																	MelBourne
																</a>
															</li>
														</ul>
												</div>
											</div>
											<div class="col-md-5">
												<div class="msgRight">
													<ul>
														<li><a href="#"><i class="fa fa-toggle-on" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
													</ul>
													<span class="price">$99.99</span>
													<span class="date">20 January 2017</span>
												</div>
											</div>
										</div>
									</div>

							</div>
						</div>
						<nav aria-label="Page navigation">
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
											</nav></div>
					</div>
				</div>

			</div>
	</div>
</section>
</div>
@stop