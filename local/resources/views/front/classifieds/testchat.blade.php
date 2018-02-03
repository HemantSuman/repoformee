@extends('front/layout/layout')
@section('content')
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>

<style type="text/css">
    #messages{
        border: 1px solid black;
        height: 300px;
        margin-bottom: 8px;
        overflow: scroll;
        padding: 5px;
    }
</style>
@if((Auth::guard('web')->user()->id))
@endif
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Chat Message Module</div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-8" >
                            <div id="messages" ></div>
                        </div>
                        <div class="col-lg-8" >
                            <form action="chkchat" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                <input type="hidden" name="user" value="{{ Auth::guard('web')->user()->name }}" >
                                <textarea class="form-control msg"></textarea>
                                <br/>
                                <input type="button" value="Send" class="btn btn-success send-msg">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
 
@section('scripts')
<script>
var socket = io.connect('http://192.168.100.242:8089');

//      socket.on('message', function (data) {
//        data = jQuery.parseJSON(data);
//        console.log(data.user);
//        $( "#messages" ).append( "<strong>"+data.user+":</strong><p>"+data.message+"</p>" );
//      });

var loginid='{!! Auth::guard("web")->user()->id !!}';
console.log(loginid +'avb');
socket.on('message', function (data) {
    data = jQuery.parseJSON(data);
    console.log(data.user);
    $("#messages").append("<strong>" + data.user + ":</strong><p>" + data.message + "</p>");
});



$(".send-msg").click(function (e) {
    e.preventDefault();
    var token = $("input[name='_token']").val();
    var user = $("input[name='user']").val();
    var msg = $(".msg").val();
    if (msg != '') {
        $.ajax({
            type: "POST",
            url: '{!! URL::to("chkchat") !!}',
            dataType: "json",
            data: {'_token': token, 'message': msg, 'user': user},
            success: function (data) {
                console.log(data);
                $(".msg").val('');
            }
        });
    } else {
        alert("Please Add Message.");
    }
})
</script>
@stop