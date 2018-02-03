@extends('admin/layout/common')
@section('content')
<section class="content-header">
    <style>
        .filterul li{ list-style: none; display: inline-block; margin-right: 10px;}


    </style>
    <h1>
        Push Notification
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active"> Push Notification</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">




            <div class="box">
                <div class="box-header">

                   


                </div>
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- /.box-header -->
                <div class="box-body">

                    
                    <div class="form-group">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-10">

                                {!! Form::textarea('question', null, ['class' => 'form-control', 'id'=>'txtArea','placeholder'=>'Message','rows'=>5]) !!}
                                <div class="error-message">{{$errors->first('question')}}</div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-2 control-label">Select User</label>

                            <div class="col-sm-10">

                                {!! Form::select('status', ['' => '-- Filter By --', 'ALL' => 'ALL', 'Android' => 'Android', 'Iphone' => 'Iphone', 'Web' => 'Web'], (isset($requestVal)) ? $requestVal : '-- Filter By --', ['class' => 'form-control selectuser','id' => 'categoriesmulti11']) !!}

                                <div class="error-message">{{$errors->first('faq_category_id')}}</div>
                            </div>
                        </div>
                    </div>
                     <ul class="filterul">

                        <li> <button class="btn btn-block btn-primary" id="sendnotification"> Send Notification </button></li>


                    </ul>
                    <div class="table-responsive" id="notificationdata">
                        
                    </div>
                </div>
               
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="modal" id="notify">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Notification Modal</h4>
                </div>
                <div class="modal-body message">
                    ​<textarea id="txtArea" class="form-control" rows="5" cols="70"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary notifysave" >Send</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</section>

<!--	@if ($message = Session::get('success'))
                <div class="alert alert-success">
                        <p>{{ $message }}</p>
                </div>
        @endif-->

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).on('change', '.ckbCheckAll', function () {
   
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
    
    var checkedId = [];
    $(document).on('click', '#sendnotification', function (e) {

//    var status = $(this).val();
//    var parent_id = $('#parent_id').val();

    var viewname = 'users';
    $('.usercheckBoxClass').each(function (index, data) {
    if ($(this).is(":checked")) {

    checkedId.push($(this).val());
    }
    });
    if (checkedId.length > 0) {
        var massage = $('#txtArea').val();
        if(massage == '')
        {
             Notify.showMessage('Please add message', 'warning');
             return false;
           // Notify.showNotification('Please add message', "error");
        }
    $.ajax({
    url: root_url + '/admin/usernotification',
            data: {
            "_token": "{{ csrf_token() }}",
                    "checkedId": checkedId,
                    "massage": massage,
//                    "parent_id": parent_id
            },
            //dataType: "html",
            method: "GET",
            cache: false,
            success: function (response) {
           $('#txtArea').val('');
            if (response.status) {
            console.log(response.url);
            window.location.href = root_url + '/admin/' + response.url;
            }
            }
    });
    } else {
    alert('Please select atleast one User.');
    window.location.href = root_url + '/admin/' + 'notification';
    }
    });
//    $(document).on('click', '.notifysave', function (e) {
//    var massage = $('#txtArea').val();
//    $.ajax({
//    url: root_url + '/admin/usernotification',
//            data: {
//            "_token": "{{ csrf_token() }}",
//                    "checkedId": checkedId,
//                    "massage": massage,
////                    "parent_id": parent_id
//            },
//            //dataType: "html",
//            method: "GET",
//            cache: false,
//            success: function (response) {
//            $('.close').click();
//            if (response.status) {
//            console.log(response.url);
//            window.location.href = root_url + '/admin/' + response.url;
//            }
//            }
//    });
//    });
    
    $(document).on('change', '.selectuser', function () {

    var status = $(this).val();

    //Ajax for subregions list
    $.ajax({
        url: root_url + '/admin/userlistnotification',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "status": status
        },
        dataType: "html",
        method: "GET",
        cache: false,
        success: function (response) {
           $('#notificationdata').html(response);
        }

    });

});
</script>
@stop