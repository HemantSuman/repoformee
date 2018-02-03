@extends('front/layout/layout')
@section('content')
<style>
    .nofiimg{
            height: 94px !important;
    }
</style>
<div id="middle" class="detail-middle">
    <!-- breadcrumb section -->
    <input type="hidden" name="loginUserId" id="loginUserId" value="{{ Auth::guard('web')->user() ? Auth::guard('web')->user()->id : null }}">
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Notifications</li>
                </ol>
            </div>
        </div>
    </section>
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="NotificationLeft">
                    @if(count($data) != 0)
                    @foreach($data as $key=>$values)
                    
                    <div class="NotificationBlock"> 
                        <a href="{{ url('/user/messages') }}">
                        <div class="row"> 

                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <div class="tutorImg NFImg" style="">
                                    @if(!empty($values->image))
                                    <img  class="nofiimg" src="{{ URL::asset('upload_images/users/'.$values->id.'/'.$values->image) }}"alt="" width="94" height="94">

                                    @elseif(!empty($values->avatar))
                                    <img src="{{ $values->avatar }}" alt="" width="94" height="94" style="height: 94px !important">	
                                    @else
                                    <img src="{{ URL::asset('plugins/front/img/no_avatar.gif') }}" alt="" width="94" height="94">	
                                    @endif
                        <!--                                <img src="/front/images/dum.png" alt="" width="94" height="94">-->
                                </div>
                                
                            </div>
                            <div class="col-md-7 col-sm-6 col-xs-8">
                                <div class="NFDetail">
                                    <div class="NfTtile">
                                        <b>{{$values->name}} </b> &nbsp has sent you a new message. </br> </br>

                                        {{$values->massage}}
                                    </div>
                                </div>
                            </div>
<!--                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="NFTime"><i class="fa fa-clock-o" aria-hidden="true"></i> {!! Helper::time_since(time() - strtotime($values->notcreate)) !!}</div>
                            </div>-->
                        </div>
                                                </a>

                        <div class="clsbtn"><a href="#" class="delete deletenotify" classId ="{{$values->notid}}">x</a></div>
                    </div> 
                    @endforeach

                    @else
                    No Records Found.
                    @endif
                   
                    <div class="pagination-wrapper">
                        <div class="pagination-wrapper-inner">

                            {!!$data->render()!!}

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
$(document).on('click', '.deletenotify', function () {


    if (!confirm("Are you sure?")) {
        return false;
    }
    var thisObj = $(this);
    var id = $(this).attr('classid');

    $.ajax({
        url: root_url + '/user/messages/deletenomsg',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": id
        },
        //dataType: "html",
        method: "POST",
        cache: false,
        success: function (response) {
            if (response.status) {
                $(thisObj).parents('li').remove();
                Notify.showNotification('Notification Remove Successfully', 'done');
                setTimeout(function () {
                        location.reload(1);
                    }, 3000);
                //window.location.href = root_url + '/admin' + '/' + response.url + pid_set;
            } else {
                return alert(response.message);

            }
        },
        error: function (response) {
            Notify.showNotification('You Have Not Permission To Perform This Action', 'warning');
            // return alert("You Have Not Permission")
        }

    });
})
</script>
@stop