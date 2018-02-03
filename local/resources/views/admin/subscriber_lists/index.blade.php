@extends('admin/layout/common')
@section('content')

<?php
$numberDirection = "asc";
$alphabetDirection = "desc";
if(!empty(Request::query('sort'))) {
    $direction = Request::query('direction');
    switch (Request::query('sort')) {
        case "id":
            if($direction == "desc") {
                $numberDirection = "asc";
            } else {
                $numberDirection = "desc";
            }
            break;
        case "email":
            if($direction == "desc") {
                $alphabetDirection = "asc";
            } else {
                $alphabetDirection = "desc";
            }
            break;
        case "created_at":
            if($direction == "desc") {
                $alphabetDirection = "asc";
            } else {
                $alphabetDirection = "desc";
            }
            break;
    }    
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{$modelTitle}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">{{$modelTitle}}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                {!! Form::open(array("url" => "admin/subscriber-lists", 'method'=>'post', "role" => "form", 'id' => 'SubscriberListFilterByEmail')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}
                <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                        {!! Form::text('email', '', array('placeholder' => 'Search by email...', 'class' => 'form-control')) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Go!', ['class' => 'btn btn-info btn-flat']) !!}
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}

                {!! Form::open(array("url" => "admin/subscriber-lists", 'method'=>'post', "role" => "form", 'id' => 'SubscriberListFilterByStatus')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}   
                <div class="col-sm-3 pull-right">
                    <div class="form-group">
                        {!! Form::select('status', ['' => '-- Select Status --', '1' => 'Active', '0' => 'Inactive'], (isset($requestVal)) ? $requestVal : '-- Select Status --', ['class' => 'form-control filterBySubscriberStatus']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
            <div class="box"> 
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">                     
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>{{ Form::checkbox('categoriesactionall', 1, null, ['id' => 'ckbCheckAll']) }}</th>
                            <th><a href="?sort=id&direction=<?php echo $numberDirection; ?>">ID</a></th>
                            <th><a href="?sort=email&direction=<?php echo $alphabetDirection; ?>">Subscriber Email</a></th>
                            <th>Status</th>
                            <th><a href="?sort=created_at&direction=<?php echo $alphabetDirection; ?>">Add Date</a></th>                  
                            <th>Actions</th>                  
                        </tr>

                        @foreach($data as $key => $value)
                        <tr>
                            <td>{{ Form::checkbox('categoriesaction[]', $value->id, null, ['class' => 'field checkBoxClass']) }}</td>
                            <td>{{ $value->id }}</td>
                            <td>{{ ($value->email) }}</td>
                            <td>
                                <input type="checkbox" name="switch-status" class="switch-states" data-on-text="Active" data-off-text="Inactive" data-id="{{ $value->id }}" {{ ($value->status) ? "checked" : null }}>
                            </td>
                            <td>{{@date('d-M-Y',strtotime($value->created_at))}}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="deleteRecord('{{$value->id}}', '{!! $viewName !!}', 'admin_delete', this, 0)" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>                                
                            </td>  
                        </tr>
                        @endforeach   
                        
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                    {!! Form::select('status', [''=>'-- Select Status --',1 => 'Active', 0 => 'Inactive'], null, ['class' => 'form-control customwidth','id' => 'categoriesmulti', 'viewName' => $viewName]) !!}

                                </td>
                            </tr>
                        </tfoot>
                    </table>                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {!! $data->render() !!}
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@stop

@section('scripts')
<script type="text/javascript">
    $("[name='switch-status']").bootstrapSwitch();
    $('input[name="switch-status"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: root_url + '/admin/subscriber_lists/admin_update_status',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "id": id,
                "state": state
            },
            success: function (response) {
                
            }
        })
    });
    $(document).on("change", ".filterBySubscriberStatus", function() {
        $("#SubscriberListFilterByStatus").submit();
    })   
</script>
@stop
