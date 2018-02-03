@extends('admin/layout/common')
@section('content')

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
                {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'id' => 'FeedFilterByTitle')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}
                <div class="col-sm-3">
                    {!! Form::select('filter', ['' => '-- Filter By --', 'page' => 'Page', 'category' => 'Category', 'title' => 'title'], (isset($requestVal)) ? $requestVal : '-- Filter By --', ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    <div class="input-group input-group-sm">
                        {!! Form::text('keyword', '', array('placeholder' => 'Enter keyword', 'class' => 'form-control')) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Go!', ['class' => 'btn btn-info btn-flat']) !!}
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}

                {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'id' => 'FeedFilterByStatus')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}   
                <div class="col-sm-3 pull-right">
                    <div class="form-group">
                        <input type="hidden" name="page_id" value="1" class="pgvalue" />
                        <input type="hidden" name="banner_position" value="top" class="pgbnpos" />
                        {!! Form::select('status', ['' => '-- Select Status --', '1' => 'Active', '0' => 'Inactive'], (isset($requestStatus)) ? $requestStatus : '-- Select Status --', ['class' => 'form-control filterByFeedStatus']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

            </div>

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href='{{ url("/admin/$viewName/add") }}' class="btn btn-block btn-primary">Add New Advertisement</a></h3>

                    <div class="col-sm-5 pull-right">
                        {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'id' => 'AdFilterByPagePos')) !!}          
                        {!! Form::hidden('form_search', 'form_search') !!}
                        <div class="col-sm-5">
                            {!! Form::select('page_id', $all_ad_positions, (isset($requestVal['page_id'])) ? $requestVal['page_id'] : null, ['class' => 'form-control ad_pg_id']) !!}
                        </div>
                        <div class="col-sm-5">
                                {!! Form::select('banner_position', array(), (isset($requestVal['banner_position'])) ? $requestVal['banner_position'] : null, ['class' => 'form-control ad_bn_ps']) !!}
                        </div>
                        <div class="col-sm-2">{!! Form::submit('Go!', ['class' => 'btn btn-block btn-primary AdFilterByPagePosSub']) !!}</div>
                        {!! Form::close() !!}
                    </div>
                </div>
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
                            <th>{{ Form::checkbox('categoriesactionall', 1, null, ['id' => 'ckbCheckAll']) }}</th>
                            <th>ID</th>
                            <th>Advertisement Title</th>
                            <th>Category</th>
                            <th>Page</th>
                            <th>Is Default</th>
                            <th>Status</th>
                            <th style="width: 12%">Set Order</a>&nbsp;&nbsp;<a href="" class="save_category_order btn btn-primary" title="Click here to save Order"><i class="fa fa-check"></a></th>
                            <th>Start Date</th>
                            <th>End Date</th>                  
                            <th>Actions</th>                  
                        </tr>

                        @foreach($data as $key => $value)
                        <tr>
                            <td>{{ Form::checkbox('categoriesaction[]', $value->id, null, ['class' => 'field checkBoxClass']) }}</td>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->title }}</td>
                            <td>{{ $value->category['name'] }}</td>
                            <td>{{ $value->page->name }}</td>
                            <td>
                                <span class="label label-<?php if ($value->is_default == 0) { ?>danger<?php } else { ?>success<?php } ?>">
                                    @if($value->is_default == 0) No @else Yes @endif</span>
                            </td>
                            <td>
                                <span class="label label-<?php if ($value->status == 0) { ?>danger<?php } else { ?>success<?php } ?>">
                                    @if($value->status == 0) Inactive @else Active @endif</span>
                            </td>
                            <td><input type="text" name="order" class="set_order_number" data-id="{{ $value->id }}" value="{{ $value->order_no }}" /></td>
                            <td>
                                {{ ($value->start_date == null) ? null : date('d-M-Y',strtotime($value->start_date)) }}
                            </td>
                            <td>
                                {{ ($value->start_date == null) ? null : date('d-M-Y',strtotime($value->end_date)) }}
                            </td>
                            <td>
                                <a href='{{ url("/admin/$viewName/edit",$value->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="deleteRecord('{{$value->id}}', '{!! $viewName !!}', 'admin_delete', this, 0)" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach

                        @if(sizeof($data)==0)
                        <tr><td colspan="9" style="text-align:center">no record found</td></tr>
                        @endif
                        
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
    $('.AdFilterByPagePosSub').css('height', '33px');
    $(document).on("change", ".filterByFeedStatus", function() {
        $('.pgvalue').val($('.ad_pg_id').val());
        $('.pgbnpos').val($('.ad_bn_ps').val());
        $("#FeedFilterByStatus").submit();
    })

    var previous, exact_value = 0;
    var changedFields = {};
    $(".set_order_number").on('keyup', function (event) {   
        previous = exact_value;
        exact_value = $(this).val();
        if(previous != exact_value) {
            changedFields[$(this).attr('data-id')] =  $(this).val();
        }
    })

    $(document).on("click", ".save_category_order", function(event) {
        event.preventDefault();
        if(jQuery.isEmptyObject(changedFields)) {
            Notify.showMessage("Please make your changes before save the Order No.", 'warning');
        } else {
            $.ajax({
                type: "POST",
                url: root_url + '/admin/advertisements/set-order',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "data": JSON.stringify(changedFields)
                },
                success: function (response) {
                    changedFields = {};
                    if(response.status) {
                        //Notify.showMessage(response.message, 'done');
                        location.reload();
                    } else {
                        Notify.showMessage(response.message, 'black');
                    }
                    
                }
            })    
        }   
    })

    var dflt_selected_page_id = $('.ad_pg_id').val();
    $.ajax({
        url: root_url + '/admin/advertisements/get-positions',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "page": dflt_selected_page_id
        },
        //dataType: "html",
        method: "POST",
        cache: false,
        success: function (response) {
            $(".ad_bn_ps").html('');
            //$(".ad_bn_ps").append($('<option></option>').val('').html('Select Banner Position'));
            $.each(response.all_positions, function (key, value) {
                if(value != 0) {
                    $(".ad_bn_ps").append($('<option></option>').val(key).html(key));    
                }
            });
            var last_filtr_b_pos = "<?php echo isset($requestVal['banner_position']) ? $requestVal['banner_position'] : ''; ?>";
            if(last_filtr_b_pos != '') {
                $(".ad_bn_ps").val(last_filtr_b_pos);
            }
        }
    });


    $(document).on("change", ".ad_pg_id", function(event) {
        var page = $(this).val();

        //Ajax for active positions on the selected page
        $.ajax({
            url: root_url + '/admin/advertisements/get-positions',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "page": page
            },
            //dataType: "html",
            method: "POST",
            cache: false,
            success: function (response) {
                $(".ad_bn_ps").html('');
                $(".ad_bn_ps").append($('<option></option>').val('').html('Select Banner Position'));
                $.each(response.all_positions, function (key, value) {
                    if(value != 0) {
                        $(".ad_bn_ps").append($('<option></option>').val(key).html(key));    
                    }
                });
            }

        });                                
    });  
    
</script>
@stop

