@extends('admin/layout/common')
@section('content')
<section class="content-header">
    <style>
        .filterul li{ list-style: none; display: inline-block; margin-right: 10px;}
        
        
    </style>
    <h1>
        Registered Users Management
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active"> Registered Users Managment</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                
                
                    {!! Form::open(array("url" => "admin/register_user", 'method'=>'post', "role" => "form", 'id' => 'FeedFilterByTitle')) !!}          
                         
<!--                    <div class="col-sm-2">
                    <div class="input-group input-group-sm form-group"> 

                               {!! Form::select('status', ['' => '-- Filter By --', 'ALL' => 'ALL', 'Android' => 'Android', 'Iphone' => 'Iphone', 'Web' => 'Web'], (isset($requestVal)) ? $requestVal : '-- Filter By --', ['class' => 'form-control','id' => 'categoriesmulti11']) !!}
                            </div>
                    </div>-->
                    <div class="col-sm-4">
                    <div class="input-group input-group-sm form-group"> 

                        {!! Form::text('name', '', array('placeholder' => 'Search by User ...', 'class' => 'form-control')) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Go!', ['class' => 'btn btn-info btn-flat']) !!}
                        </span>
                    </div> 
                 {!! Form::close() !!}
                </div>
               
<!--                <div class="col-sm-4">
                    {!! Form::open(array("url" => "admin/register_user", 'method'=>'post', "role" => "form", 'id' => 'FeedFilterByTitle')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}
                    <div class="input-group input-group-sm form-group">
               {!! Form::select('status', [''=>'-- Select Users --','All' => 'All', 'Web' => 'Web','Android' => 'Android','Iphone' => 'Iphone'], null, ['class' => 'form-control customwidth','id' => 'categoriesmulti']) !!}

                    </div> 
                 {!! Form::close() !!}
                </div>-->
            </div>
            
         

            <div class="box">
                <div class="box-header">

                    <ul class="filterul">
                        <li><a class="btn btn-block btn-primary" href="{{ url('/admin/users/add_register_user') }}"> Create New  User</a></li>
<!--                        <li><a class="btn btn-block btn-primary" href="#" id="sendnotification"> Send Notification</a></li>-->
<!--                        <li> {!! Form::select('status', [''=>'-- Select Status --','All' => 'All', 'Web' => 'Web','Android' => 'Android','Iphone' => 'Iphone'], null, ['class' => 'form-control customwidth','id' => 'categoriesmulti']) !!}</li>-->
<!--                        <li> <button class="btn btn-block btn-primary" id="sendnotification"> Send Notification </button></li>-->
                        
                       
                    </ul>


                </div>
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">


                    <table class="table table-hover table-bordered">
                        <tr> 
                            <th>{{ Form::checkbox('categoriesactionall', 1, null, ['id' => 'ckbCheckAll','class'=>'userchk']) }}</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile/Phone No.</th>
                            <th>Add Date</th>
                            <th>Status</th>
                            <th >Action</th>                
                        </tr>


                        @foreach($users as $key => $user)

                        <tr>
                            <td>{{ Form::checkbox('userid[]', $user->id, null, ['class' => 'field usercheckBoxClass']) }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phonecode.' '.$user->mobile_no }}</td>
                            <td>{{@date('d-M-Y',strtotime($user->created_at))}}</td>
                            <td>
                                <input type="checkbox" name="switch-states" class="switch-states"  data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-id="{{ $user->id }}" {{ ($user->status) ? "checked" : null }}>
                            </td>

                            <td>            @if(empty($user->login_type))
                                <a href='{{ url("/admin/users/register_edit",$user->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                @endif
                                <a href="javascript:void(0)" onclick="deleteRecord('{{$user->id}}',  'users','delete_register', this, 0)" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>                                
                            </td>  

                        </tr>   

                        @endforeach    

                        @if(sizeof($users)==0)
                        <tr><td colspan="7" style="text-align:center">no record found</td></tr>
                        @endif



                    </table>

                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {!! $users->render() !!}
                    </ul>
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
    $('input[name="switch-states"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var id = $(this).attr("data-id");
         var email = $(this).attr("data-email");
        var name = $(this).attr("data-name");
        $.ajax({
            type: "POST",
            url: root_url + '/admin/users/admin_update_user_status',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "id": id,
                "email": email,
                "name": name,
                "state": state
            },
            success: function (response) {
            
            }
        })
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

//        if (!confirm("Are you sure change the status?")) {
//            return false;
//        } else {
            $("#notify").modal("show");
            
            
       // }
    } else {
        alert('Please select atleast one checkbox.');
         window.location.href = root_url + '/admin/' + 'register_user';
    }
});

$(document).on('click', '.notifysave', function (e) { 
    var massage = $('#txtArea').val();
    
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
                    $('.close').click();
                    if (response.status) {
                        console.log(response.url);
                        window.location.href = root_url + '/admin/' + response.url;
                    }
                }
            });
    });    
</script>
@stop