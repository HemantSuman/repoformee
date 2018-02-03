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
        case "name":
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
        {{str_plural(preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/', ' $0', $modelTitle))}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">{{str_plural(preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/', ' $0', $modelTitle))}}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                {!! Form::open(array("url" => "admin/prayer-timings", 'method'=>'post', "role" => "form", 'id' => 'PrayerTimingFilterByTitle')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}
                <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                        {!! Form::text('name', '', array('placeholder' => 'Search by name...', 'class' => 'form-control')) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Go!', ['class' => 'btn btn-primary btn-flat']) !!}
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}

                {!! Form::open(array("url" => "admin/prayer-timings", 'method'=>'post', "role" => "form", 'id' => 'PrayerTimingFilterByStatus')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}   
                <div class="col-sm-3 pull-right">
                    <div class="form-group">
                        {!! Form::select('status', ['' => '-- Select Status --', '1' => 'Active', '0' => 'Inactive'], (isset($requestVal)) ? $requestVal : '-- Select Status --', ['class' => 'form-control filterByPrayerTimingStatus']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
            <div class="box">
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                @if( Session::has( 'success' ))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> {{ Session::get( 'success' ) }}
                </div>
                @elseif( Session::has( 'danger' ))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Oops!</strong> {{ Session::get( 'danger' ) }}
                </div>
                @endif

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">                  
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><a href="?sort=id&direction=<?php echo $numberDirection; ?>">ID </a></th>
                            <th><a href="?sort=name&direction=<?php echo $alphabetDirection; ?>">Name </a></th>
                            <th>Is Default</th>
                            <th>Actions</th>                  
                        </tr>

                        @foreach($data as $key => $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ ($value->name) }}</td>
                            <td>
                                <input type="radio" name="switch-default-status" class="switch-default-states" data-on-text="Yes" data-off-text="No" data-id="{{ $value->id }}" {{ ($value->is_default) ? "checked" : null }}>
                            </td>
                            <td>
                                <input type="checkbox" name="switch-status" class="switch-states" data-on-text="Active" data-off-text="Inactive" data-id="{{ $value->id }}" {{ ($value->status) ? "checked" : null }}>
                            </td>  
                        </tr>
                        @endforeach   
                        
                        <tfoot></tfoot>
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
    $("[name='switch-default-status']").bootstrapSwitch();
    $("[name='switch-status']").bootstrapSwitch();
    
    $('input[name="switch-default-status"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: root_url + '/admin/prayer_timings/admin_update_default_status',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "id": id,
                "state": state
            },
            success: function (response) {
            }
        })
    });

    $('input[name="switch-status"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var el = $(this);
        var id = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: root_url + '/admin/prayer_timings/admin_update_status',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "id": id,
                "state": state
            },  
            success: function (response) {
                if(response.status) {
                    //Notify.showMessage(response.message, 'done');
                } else {
                    Notify.showMessage(response.message, 'warning');
                    el.bootstrapSwitch('state', true);
                }
            }
        })
    });

    $(document).on("change", ".filterByPrayerTimingStatus", function() {
        $("#PrayerTimingFilterByStatus").submit();
    })
    
</script>
@stop

