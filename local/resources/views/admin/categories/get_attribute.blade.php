@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Attributes of {{$data->name}}
       
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li>{{$modelTitle}}</li>
        <li class="active">Attributes</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">                  
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Attribute</th>
                            <th>Attribute Type</th>
                            <th>Type (Contact/Key Details)</th>
                            <th>Status</th>
                        </tr>

                       
                        @foreach($data->attributes as $key => $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ ($value->name) }}</td>
                            <td>{{ ($value->attributeType->name) }}</td>
                             <td>
                                
                                {!! Form::select('show_type', [1 => 'Contact Details', 2 => 'Key Details'], ($value->show_type),['class'=>'showvalue','data-id'=>$value->id])!!}

                            </td>
                            <td>
                                <input type="checkbox" name="switch-states" class="switch-states" data-id="{{ $value->id }}" {{ ($value->status) ? "checked" : null }}>
<!--                                <span class="label label-<?php if ($value->status == 0) { ?>danger<?php } else { ?>success<?php } ?>">
                                    @if($value->status==0) Inactive @else Active @endif</span>-->
                            </td>
                            </td>
                        </tr>
                        @endforeach

                        @if(sizeof($data->attributes) == 0)
                        <tr><td colspan="4" style="text-align:center">No record found</td></tr>
                        @endif
                        
                    </table>                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php /* {!! $data->render() !!} */ ?>
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
    
    $(document).on('change', '.showvalue', function() {
      
       var state = $(this).val();
       var attrid = $(this).attr('data-id');
     //  alert(attrid);
        $.ajax({
            type: "POST",
            url: root_url + '/admin/attributes/showvalue',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "id": attrid,
                "state": state
            },
            success: function (response) {
            
            }
        })
    });   
    $('input[name="switch-states"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: root_url + '/admin/attributes/admin_update_attribute_status',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "id": id,
                "state": state
            },
            success: function (response) {
            
            }
        })
    });
</script>
@stop
