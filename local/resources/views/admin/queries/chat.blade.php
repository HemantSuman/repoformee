<style type="text/css">
    .error-message{color:#dd4b39;}
</style>
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Inbox & Support Tickets
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li><a href="{{ url('/admin/queries') }}"><i class="fa fa-ticket"></i> Inbox & Support Queries</a></li>
        <li class="active">Chat</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary direct-chat direct-chat-primary">  
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- _________ START __________ -->
                <div class="box-header with-border">
                    <h3 class="box-title">Direct Chat</h3>
                </div>
                

                <div class="box-body">
                    <div class="direct-chat-messages" id="direct-chat-messages">
                        <?php $last_query_id = null; ?> 
                        @foreach($data as $key => $single)
                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">{{ $single->name }}</span>
                                    <span class="direct-chat-timestamp pull-right">
                                        {{ @date('d-M-Y h:i',strtotime($single->created_at)) }}
                                    </span>
                                </div>
                                <img class="direct-chat-img" src="{{ URL::asset('plugins/front/img/profile-img-new-header.jpg') }}" alt="Message User Image">
                                <div class="direct-chat-text" style="padding-right: 94px">
                                    {{ $single->contact_query }}
                                </div>
                            </div>
                            <?php $last_query_id = $single->id; ?>
                            <!-- Message to the right -->
                            @if(!empty($single->query_respond))
                                @foreach($single->query_respond as $res_key => $respond)
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">Admin</span>
                                            <span class="direct-chat-timestamp pull-left">{{ $respond->created_at }}</span>
                                        </div>
                                        <img class="direct-chat-img" src="{{ URL::asset('plugins/admin/dist/img/avtar.png') }}" alt="Message User Image">
                                        <div class="direct-chat-text">
                                            {{ $respond->respond }}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach

                    </div>
                </div>
                <div class="box-footer">
                    {!! Form::open(array("url" => "admin/$viewName/query-respond", 'method'=>'post', "role" => "form", 'id' => 'QueryRespondByAdmin')) !!}          
                        {!! Form::hidden('query_id', $last_query_id) !!}
                        <div class="">
                            
                        
                        <textarea rows="6" name="respond" class="form-control" placeholder="Type Message ..." id="edito" style="height: 200px;"></textarea>
                            
                        </div>
                        <br/>
                        {!! Form::submit('Send', ['class' => 'btn btn-primary btn-flat query-submit-btn']) !!}
                        <div class="error-message">{{$errors->first('respond')}}</div>
                    {!! Form::close() !!}
                </div>
                <!-- _________ END __________ -->

            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
<script type="text/javascript">
    $('#edito').css('resize', 'none');
    //$('#edito').css('height', '135px');
    autosize(document.querySelectorAll('textarea'));
    var chatBox = document.getElementById('direct-chat-messages');
    chatBox.scrollTop = chatBox.scrollHeight;

</script>
@stop
