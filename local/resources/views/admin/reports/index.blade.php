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
        case "title":
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

                
                <div class="box-header">
                    <div class="col-sm-5 pull-right">
                        {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form")) !!}          
                        {!! Form::hidden('form_search', 'form_search') !!}
                        <div class="col-sm-9">
                            {!! Form::text('title', $requestVal, ['placeholder' => 'Classified Name', 'class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-3">{!! Form::submit('Search', ['class' => 'btn btn-block btn-primary']) !!}</div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">                  
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Classified ID</th>
                            <th>Classified Name</th>
                            <th>Classified Owner</th>
                            <th>Report By</th>
                            <th>Reason</th>
                            <th>Comment</th>
                            <th>Classified Status</th>
                            <th>Reported date</th>
                            <th style="width: 90px">Actions</th>
                        </tr>

                        @foreach($data as $key => $value)
                        <tr>
                            <td>{{ $value->classified['id'] }}</td>
                            <td>{{ $value->classified['title'] }}</td>
                            <td>{{ $value->classified->classified_users['name'] }}</td>
                            <td>{{ $value->user['name'] }}</td>
                            <td>{{ title_case($value->report_type) }}</td>
                            <td>
                                <a href="#" class="rprt-cmnt-tooltip" title="{{$value->comment}}">View</a>
                            </td>
                            <td><span class="label label-<?php if ($value->classified['status'] == 0) { ?>danger<?php } else { ?>success<?php } ?>">
                                    @if($value->classified['status']==0) Inactive @else Active @endif</span>
                            </td>
                            <td>{{@date('d-M-Y',strtotime($value->created_at))}}</td>
                            <td>
                                <a href='{{ url("/admin/classifieds/view",$value->classified["id"]) }}' class="btn btn-info" title="View Detail" target="_blank"><i class="fa fa-eye"></i></a>
                                @if($value->classified['status'] == 1)
                                    <a href='{{ url("/admin/classifieds/deactivate",$value->classified["id"]) }}' class="btn btn-warning" title="Deactivate Classified"><i class="fa fa-list"></i></a>
                                @else
                                    <a href="{{ action('admin\ClassifiedController@activate_classified', array('clId' => $value->classified['id'], 'spmRptId' => $value->id)) }}" title="Activate Classified" class="btn btn-warning"><i class="fa fa-list"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach   
                        
                        <tfoot>
                            
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
    $('input[name="switch-states"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: root_url + '/admin/feeds/admin_update_feed_home_status',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "id": id,
                "state": state
            },
            success: function (response) {
            
            }
        })
    });

    $(document).on("change", ".filterByFeedStatus", function() {
        $("#FeedFilterByStatus").submit();
    })
    
</script>
@stop

