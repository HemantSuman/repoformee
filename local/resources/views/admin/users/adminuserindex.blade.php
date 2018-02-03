@extends('admin/layout/common')
@section('content')
<section class="content-header">
    <h1>
        Admin User Management
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">User Managment</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                {!! Form::open(array("url" => "admin/admin_user", 'method'=>'post', "role" => "form", 'id' => 'FeedFilterByTitle')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}
                <div class="col-sm-4">
                    <div class="input-group input-group-sm form-group">
                        {!! Form::text('name', '', array('placeholder' => 'Search by User ...', 'class' => 'form-control')) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Go!', ['class' => 'btn btn-info btn-flat']) !!}
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
            <div class="box">
                <div class="box-header">

                                        <h3 class="box-title">
                                            
                                               <a class="btn btn-block btn-primary" href="{{ url('/admin/add_user') }}"> Create Admin User</a>
                                        </h3>


                </div>
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">


                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Add Date</th>
                            <th>Status</th>
                            <th >Action</th>                
                        </tr>


                        @foreach($users as $key => $user)

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role_name['name'] }}</td>
                            <td>{{@date('d-M-Y',strtotime($user->created_at))}}</td>
                            <td>
                                <input type="checkbox" name="switch-states" class="switch-states" data-role_name="{{ $user->role_name['name'] }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-id="{{ $user->id }}" {{ ($user->status) ? "checked" : null }}>
                            </td>
                            
                            <td>
                                <a href='{{ url("/admin/users/edit",$user->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="deleteRecord('{{$user->id}}',  'users','delete', this, 0)" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>                                
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
        var role_name = $(this).attr("data-role_name");
        $.ajax({
            type: "POST",
            url: root_url + '/admin/users/admin_update_user_status',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "id": id,
                "email": email,
                "name": name,
                "state": state,
                "role_name": role_name
            },
            success: function (response) {
            
            }
        })
    });

    
</script>
@stop