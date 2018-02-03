@extends('admin/layout/common')
@section('content')
<section class="content-header">
    <style>
        .filterul li{ list-style: none; display: inline-block; margin-right: 10px;}


    </style>
    <h1>
        Business Users Management
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active"> Business Users Managment</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">


                {!! Form::open(array("url" => "admin/business_users", 'method'=>'post', "role" => "form", 'id' => 'FeedFilterByTitle')) !!}          

<!--                <div class="col-sm-4">
                    <div class="input-group input-group-sm form-group"> 

                        {!! Form::text('name', '', array('placeholder' => 'Search by User ...', 'class' => 'form-control')) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Go!', ['class' => 'btn btn-info btn-flat']) !!}
                        </span>
                    </div> 
                </div>-->
                {!! Form::close() !!}
            </div>



            <div class="box">
                <div class="box-header">

<!--                    <ul class="filterul">
                        <li><a class="btn btn-block btn-primary" href="{{ url('/admin/users/add_register_user') }}"> Create New  User</a></li>
                    </ul>-->


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
                            <th>Company Name</th>
                            <th>Add Date</th>
                            <th>Membership Plan</th>
                            <th>Status</th>
                            <th >Action</th>                
                        </tr>


                        @foreach($users as $key => $user)
                        
                        <?php
						
						//dd($membership_plan);
						?>

                        <tr>
                            <td>{{ Form::checkbox('userid[]', $user->id, null, ['class' => 'field usercheckBoxClass']) }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->business_name }}</td>
                            <td>{{@date('d-M-Y',strtotime($user->created_at))}}</td>
                            <td>
                            <?php 
							$membership_plan = $user->membership_user->toArray();
							if(isset($membership_plan) && count($membership_plan) > 0){
								$membership_plan_data = $membership_plan[0];
							?>
                            {{ $membership_plan_data['plan_name'] }}
                            <?php } ?>
                            </td>
                            <td>
                                <input type="checkbox" name="switch-states" class="switch-states"  data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-id="{{ $user->id }}" {{ ($user->status) ? "checked" : null }}>
                            </td>

                            <td>          
                                @if(empty($user->login_type))
                                <a href='{{ url("/admin/users/business_edit",$user->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                @endif
                                <a href='{{ url("/admin/users/business_plans",$user->id) }}' class="btn btn-info" title="View Membership plan"><i class="fa fa-arrows-alt"></i></a>
                                <?php /* ?><a href="javascript:void(0)" onclick="deleteRecord('{{$user->id}}', 'users', 'delete_register', this, 0)" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a><?php */ ?>
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

@endsection
@section('scripts')
<script type="text/javascript">

    $('input[name="switch-states"]').on('switchChange.bootstrapSwitch', function (event, state) {
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
        });
    });
</script>
@stop