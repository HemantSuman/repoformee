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
        <li class="active"> Business Plans</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">

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
                            <th>ID</th>
                            <th>Plan Name</th>
                            <th>Plan Type</th>
                            <th>Plan Price</th>
                            <th>Discount(Type)</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <td>&nbsp;</td>
                        </tr>


                        @foreach($result as $key => $data)

                        <?php $currentDate = date('Y-m-d'); 
                        
                        if ((strtotime($data->start_date) <= strtotime($currentDate)) && (strtotime($currentDate) <= strtotime($data->end_date))) {
                        
                            $activeRow = true;
                        } else {
                            $activeRow = false;
                        }
                        ?>
                        
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->plan_name }}</td>
                            <td>{{ $data->plan_type }}</td>
                            <td>{{ $data->plan_price }}</td>
                            <td>
                                @if($data->discount_value)
                                {{ $data->discount_value }}({{ $data->discount_type }}) 
                                @else
                                No Discount
                                @endif
                            </td>
                            <td>{{@date('d-M-Y',strtotime($data->start_date))}}</td>
                            <td>{{@date('d-M-Y',strtotime($data->end_date))}}</td>
                            <td>
                                @if($activeRow)
                                <span class="label label-success">Active </span>
                                @endif
                            </td>
                        </tr>   

                        @endforeach    

                        @if(sizeof($result)==0)
                        <tr><td colspan="7" style="text-align:center">no record found</td></tr>
                        @endif



                    </table>

                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php /* ?>{!! $users->render() !!} <?php */ ?>
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