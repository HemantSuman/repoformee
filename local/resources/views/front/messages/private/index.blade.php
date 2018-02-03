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
                      @include('front/element/user_dashboard_menubar_private')
                  </div>
                  <div class="col-sm-12">
                       <div class="dashboardData">
                   
                
                <div class="DashboardTabWrap clearfix">
                    <div class="DashboardleftTab">
                        <h2>Messages</h2>                      
                        <ul >
                        <li><a href="#" class="btn-orange"> Compose</a></li>

                        <li class="active sideMsgTypeLi" index_type="sent_index"><a href="javascript:void(0)" class="messageTypeLinks active" msg_flag="receiver_id" msg_flag_second="sender_id" index_type="sent_index">Inbox</a>

                        <li class="sideMsgTypeLi" index_type="inbox_index"><a href="javascript:void(0)" class="messageTypeLinks" msg_flag="sender_id" msg_flag_second="receiver_id" index_type="inbox_index">Sent </a></li>

                        <li class="sideMsgTypeLi" index_type="archive_index"><a href="javascript:void(0)" class="messageTypeLinks" msg_flag="" msg_flag_second="" index_type="archive_index">Trash</a></li>
                        
                        <li class="sideMsgTypeLi" index_type="archive_index"><a href="javascript:void(0)" class="messageTypeLinks" msg_flag="" msg_flag_second="" index_type="archive_index">Archive</a></li>
                    </ul>
                    </div>
                    
                    
                    <div class="tab-content">
                        <div class="hdercont clearfix">
                    <div class="title">
                     <!--<h3>Messages</h3>-->
                    </div>
                    <div class="messageLinks">
                        <ul>
                            <li><a href="javascript:void(0)" class="messageTypeLinks active" msg_flag="receiver_id" msg_flag_second="sender_id" index_type="sent_index">selling</a></li>
                            <li><a href="javascript:void(0)" class="messageTypeLinks" msg_flag="sender_id" msg_flag_second="receiver_id" index_type="inbox_index">Buying </a></li>
                            <li><a href="javascript:void(0)" class="messageTypeLinks" >BLOCKED </a></li>                            
                        </ul>
                    </div>
                    <div class="search pull-right">
                        <input type="search" name="" value="" placeholder="Search here..." class="searchinput searchtext">
                        <input type="button" name="" value="" class="searchbt">
                    </div>
                </div>

                        <input type="hidden" class="msg_flag" value="receiver_id" >
                        <input type="hidden" class="msg_flag_second" value="sender_id" >
                        <input type="hidden" class="index_type" value="inbox_index" >
                        <input type="hidden" class="page_no_value" value="1" >

                        <div class="Topbar msg-topbar">
                            <ul>
                                <li class="select arrowWithCheck">
                                    <a>
                                        <input type="checkbox" name="" value="" class="m-checkbox checkAllClass">
                                        <label><i class="" aria-hidden="true"></i></label>
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
                                <li class="delete">
                                    <a href="javascript:void(0)" class="deleteIconCheck">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <div class="deleteMsgLoadIcon hide">
                                        <img src="{{ URL:: asset('/plugins/front/img/icons/p2.gif') }}">
                                    </div>
                                </li>
                                <li class="pull-right">
                                    <span>Sort By:</span>
                                    <select class="custom-select readUnread msg-sort-select-box">
                                        <option value="">Select one</option>
                                        <option value="1">Read Message</option>
                                        <option value="0">Unread Message</option>
                                    </select>
                                    <select class="custom-select shortBy msg-sort-select-box" style="float: right; margin: 5px 0 0;">
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

                        <div class="tab-pane active inbox-msg-block" id="Active">
                            
                        </div>

                        <div class="tab-pane" id="Inactive">
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
                                                    <img src="{{ URL::asset('plugins/front/img/icons/dash-img.jpg') }}" alt="">
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
                                                                    <span><img src="{{ URL::asset('plugins/front/img/icons/eye.png') }}" alt=""></span>
                                                                    1000
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <span><img src="{{ URL::asset('plugins/front/img/locate-icon.png') }}" alt=""></span>
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
    $(document).ready(function() {

        get_messages('<?php echo $msg_flag; ?>', '<?php echo $msg_flag_scond; ?>', '', '', '<?php echo $index_type; ?>');

        $(document).on('click', '.messageTypeLinks', function () {

            $(".checkAllClass").attr('checked', false);
            $(".inbox-msg-block").empty();
            $(".msg-topbar").removeClass("hide");
            $(".processing-block").removeClass("hide");
            $(".messageTypeLinks").removeClass("active");
            $(".sideMsgTypeLi").removeClass("active");
            $('a[index_type*="'+$(this).attr('index_type')+'"]').addClass("active");
            $('li[index_type*="'+$(this).attr('index_type')+'"]').addClass("active");

            var msg_flag = $(this).attr('msg_flag');
            var msg_flag_second = $(this).attr('msg_flag_second');
            var index_type = $(this).attr('index_type');
            $('.msg_flag').val(msg_flag);
            $('.msg_flag_second').val(msg_flag_second);
            $('.index_type').val(index_type);
            $('.page_no_value').val(1);
            var readUnread = $('.readUnread :selected').val();
            var shortBy = $('.shortBy :selected').val();
            get_messages(msg_flag, msg_flag_second, readUnread, shortBy, index_type);
        });

        $(document).on('change', '.msg-sort-select-box', function () {
            $(".checkAllClass").attr('checked', false);
            $(".inbox-msg-block").empty();
            $(".processing-block").removeClass("hide");
            
            var msg_flag = $('.msg_flag').val();
            var msg_flag_second = $('.msg_flag_second').val();
            var index_type = $('.index_type').val();
            var readUnread = $('.readUnread :selected').val();
            var shortBy = $('.shortBy :selected').val();
            get_messages(msg_flag, msg_flag_second, readUnread, shortBy, index_type);
        });
        
        $(document).on('click', '.searchbt', function () {
            $(".checkAllClass").attr('checked', false);
            $(".inbox-msg-block").empty();
            $(".processing-block").removeClass("hide");
            
            var msg_flag = $('.msg_flag').val();
            var msg_flag_second = $('.msg_flag_second').val();
            var index_type = $('.index_type').val();
            var readUnread = $('.readUnread :selected').val();
            var shortBy = $('.shortBy :selected').val();
            var title = $('.searchtext').val();
            get_messages(msg_flag, msg_flag_second, readUnread, shortBy, index_type,title);
        });

        $(document).on('click', '.checkAllClass', function () {
            var thisObj = $(this);
            $('.inbox-msg-block input[type="checkbox"]').each(function (index, value) {
                if ($(thisObj).is(':checked')) {
                    $(this).prop('checked', true);
                } else {
                    $(this).attr('checked', false);
                }
            });
        });

        $(document).on('click', '.singleCheckbox', function () {
            if ($(this).not(':checked')) {
                $('.checkAllClass').prop('checked', false);
            }
        });

        $(document).on('click', '.deleteIconCheck', function () {
            $(".deleteMsgLoadIcon").removeClass("hide")
            var index_type = $('.index_type').val();

            var msg_id = [];
            $('.inbox-msg-block input[type="checkbox"]').each(function (index, value) {
                if ($(this).is(':checked')) {
                    msg_id.push($(this).attr('msg_id'));
                    $(this).parents('.msgrow').remove();
                }
            });

            console.log(msg_id.length);
            if(msg_id.length == 0) {
                $(".deleteMsgLoadIcon").addClass("hide")
                Notify.showNotification("Please select at least one.", 'error');
            } else {
                $.ajax({
                    url: root_url + '/user/messages/delete_message_check',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "msg_id": msg_id,
                        "index_type": index_type,
                    },
                    method: "POST",
                    cache: false,
                    success: function (response) {
                        $(".deleteMsgLoadIcon").addClass("hide")
                        Notify.showNotification("Successfully moved to archieved.", 'success');
                    },
                    error: function (data) {

                    }
                });   
            }
        });

        $(document).on("click", ".viewFullChat", function (event) {
            $(".msg-topbar").addClass("hide");
            $(".inbox-msg-block").empty();
            $(".processing-block").removeClass("hide");
            var classifiedId = $(this).attr('classliidforchat');
            var second_user_id = $(this).attr('second_user_id');

            $.ajax({
                url: root_url + '/user/messages/all_message_chat',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "classifiedId": classifiedId,
                    "second_user_id": second_user_id,
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    $(".processing-block").addClass("hide");
                    $(".inbox-msg-block").html(response);
                    
                    mcustome();
                },
                error: function (data) {

                }
            });
        });

        function send_message(currentObj) {
            //console.log(currentObj.attr('classliidforchat'));
            var classifiedId = currentObj.attr('classliidforchat');
            var receiver_id = currentObj.attr('receiver_id');
            var sender_id = currentObj.attr('sender_id');
            var textareaMessageChat = $('.textareaMessageChat').val().trim();
            
            if (textareaMessageChat == '') {
                Notify.showNotification("Please enter message.", 'error');
                return false;
            }

            var now = new Date(Date.now());
            var formatted = now.getHours() + ":" + now.getMinutes();

            var appendMsgToChat = "<div class='withouticonmsg chatmsg'><div class='msgtxt'><p>"+textareaMessageChat+"</p></div><div class='chattime'><span>"+formatted+"</span></div></div>"
            $('.textareaMessageChat').val('');
            
            $('#chatBox div.chatmsg:last').after(appendMsgToChat);
            $(".chatbox").mCustomScrollbar("scrollTo","bottom");

            $.ajax({
                url: root_url + '/user/messages/send_message_chat',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "classifiedId": classifiedId,
                    "receiver_id": receiver_id,
                    "sender_id": sender_id,
                    "textareaMessageChat": textareaMessageChat,
                },
                method: "POST",
                cache: false,
                success: function (response) {
                },
                error: function (data) {
                }
            });
        }

        $(document).on('keydown', '.textareaMessageChat', (function (event, state) {
            if (event.which == 13) {
                var getElem = $(".sendMessageButton");
                send_message(getElem);
            }
        }));

        $(document).on("click", ".sendMessageButton", function (event) {
            var getElem = $(".sendMessageButton");
            send_message(getElem); 
        });

        function get_messages(msg_flag, msg_flag_second, readUnread, shortBy, index_type,title=null) {
            var page_no_value = $('.page_no_value').val();
            $.ajax({
                url: root_url + '/user/messages/all_message',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "msg_flag": msg_flag,
                    "msg_flag_second": msg_flag_second,
                    "readUnread": readUnread,
                    "shortBy": shortBy,
                    "index_type": index_type,
                    "page_no_value": page_no_value,
                    "title": title,
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    $(".processing-block").addClass("hide");
                    $(".inbox-msg-block").html(response);
                },
                error: function (response) {

                }

            });
        }
    })
</script>
@stop