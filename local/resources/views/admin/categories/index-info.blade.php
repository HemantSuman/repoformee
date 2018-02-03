@extends('admin/layout/common')
@section('content')


<style>
    /*.sortable {}
    .sortable td { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
    .sortable td span { position: absolute; margin-left: -1.3em; }*/   
    .sortable tr td:first-child { padding-left: 50px; background: url(../plugins/admin/images/arrow-move.png) no-repeat 15px center;} 
</style>
<?php
$numberDirection = "asc";
$alphabetDirection = "desc";
if (!empty(Request::query('sort'))) {
    $direction = Request::query('direction');
    switch (Request::query('sort')) {
        case "id":
            if ($direction == "desc") {
                $numberDirection = "asc";
            } else {
                $numberDirection = "desc";
            }
            break;
        case "name":
            if ($direction == "desc") {
                $alphabetDirection = "asc";
            } else {
                $alphabetDirection = "desc";
            }
            break;
        case "order_no":
            if ($direction == "desc") {
                $alphabetDirection = "asc";
            } else {
                $alphabetDirection = "desc";
            }
            break;
        case "created_at":
            if ($direction == "desc") {
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
        @if($result->requestId != '')
        Sub Category
        @else
        {{$modelTitle}}     
        @endif
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
                <div class="box-header">
                    @if($result->requestId != '')
                    {!! Form::hidden('parent_id', $result->requestId, ['id' => 'parent_id']) !!}
                    <h3 class="box-title"><a href='{{ url("/admin/$viewName/add/$result->requestId") }}' class="btn btn-block btn-primary">Add New Sub Category</a></h3>
                    @else
                    <h3 class="box-title"><a href='{{ url("/admin/$viewName/add") }}' class="btn btn-block btn-primary">Add New Category</a></h3>
                    @endif
                    <div class="custom-searchbar col-md-9 pull-right">
                        @if($result->requestId != '')
                        {!! Form::open(array("url" => "admin/$viewName/$result->requestId", 'method'=>'post', "role" => "form", 'files' => true)) !!}	
                        @else
                        {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'files' => true)) !!}	
                        @endif
                        <div class="cst-search-category">
                            {!! Form::text('name', (isset($result->form_request['name']))?$result->form_request['name']:'', ['placeholder' => 'Category Name', 'class' => 'form-control']) !!}
                        </div>
                        <div class="cst-search-category">
                            {!! Form::select('status', [''=>'-- Select Status --',1 => 'Active', 0 => 'Inactive'], (isset($result->form_request['status']))?$result->form_request['status']:'-- Select Status --', ['class' => 'form-control']) !!}
                        </div>
                        <div class="cst-search-category">
                            {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!} 
                            @if($result->requestId != '')
                            <a href='{{ url("/admin/$viewName/$result->requestId") }}' class="btn btn-primary">Reset</a>
                            @else
                            <a href='{{ url("/admin/$viewName") }}' class="btn btn-primary">Reset</a>
                            @endif

                        </div>
                        {!! Form::hidden('form_search', 'form_search') !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">


                    <table class="table table-hover table-bordered">

                        <tr>
                            <th style="text-align: center;">{{ Form::checkbox('categoriesactionall', 1, null, ['id' => 'ckbCheckAll']) }}</th>
                            <th><a href="?sort=id&direction=<?php echo $numberDirection; ?>">ID</a></th>
                            <th>Icon</th>
                            <th>BG Image</th>
                            <th><a href="?sort=name&direction=<?php echo $alphabetDirection; ?>">Category Name</a></th>
                            <th>Status</th>
                            <!--<th>Community/Information</th>-->
<!--                            <th style="width: 12%"><a href="?sort=order_no&direction=<?php echo $alphabetDirection; ?>">Set Order</a>&nbsp;&nbsp;<a href="" class="save_category_order btn btn-primary" title="Click here to save Order"><i class="fa fa-check"></a></th>                  -->
                            <th><a href="?sort=created_at&direction=<?php echo $alphabetDirection; ?>">Add Date</a></th>                  
                            <th>Actions</th>                  
                        </tr>

                        <tbody class="sortable">
                            @foreach($result as $key=>$val)
                            <tr>
                                <td>{{ Form::checkbox('categoriesaction[]', $val->id, null, ['class' => 'field checkBoxClass']) }}</td>
                                <td>{{ $val->id }}</td>
                                <td>
                                    @if($val->icon != '')
                                    {{ Html::image(asset('/upload_images/categories/icon/'.$val->id.'/'.$val->icon), 'alt', array( 'width' => 40, 'height' => 40 )) }}
                                    @endif
                                </td>
                                <td>
                                    @if($val->image != '')
                                    {{ Html::image(asset('/upload_images/categories/backgroundimage/30px/'.$val->id.'/'.$val->image), 'alt', array( 'width' => 40, 'height' => 40 )) }} 
                                    @endif
                                </td>  
                                <td>{{ @ucfirst($val->name) }}</td>                
                                <td><span class="label label-<?php if ($val->status == 0) { ?>danger<?php } else { ?>success<?php } ?>">
                                        @if($val->status==0) Inactive @else Active @endif</span>
                                </td>
                               <!-- <td>{!! ($val->belong_to_community == 1 || $val->show_on_info_area == 1)? '<i class="icon fa fa-check"></i>' : '<i class="icon fa fa-ban"></i>'  !!} </td>-->

<!--                                <td><input type="text" name="order" class="set_order_number" data-id="{{ $val->id }}" value="{{ $val->order_no }}" /></td>-->


                                <td>{{@date('d-M-Y',strtotime($val->created_at))}}</td>

                                <td>					
                                    <a href='{{ url("/admin/$viewName/edit",$val->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0)" onclick="deleteRecord('{{$val->id}}', '{!! $viewName !!}', 'admin_delete', this, {{$val->pid}})" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>
                                    <!--@if($result->requestId == '')

                                    <a href='{!! url("/admin/categories/$val->id") !!}' class="btn btn-warning" title="View Sub Categories"><i class="fa fa-list"></i></a>
                                    @else
                                    <a href='{!! url("/admin/categories/attributes/$val->id") !!}' class="btn btn-warning" title="View Attributes"><i class="fa fa-delicious"></i></a>
                                    @endif-->
                                    @if ($val->belong_to_community == '1' || $val->show_on_info_area == '1')
                                   <a href='{!! url("/admin/categories/attributes/$val->id") !!}' class="btn btn-warning" title="View Attributes"><i class="fa fa-delicious"></i></a>

                                    @endif
                                </td>
                            </tr>   

                            @endforeach 
                        </tbody>   

                        @if(sizeof($result)==0)
                        <tr><td colspan="9" style="text-align:center">no record found</td></tr>
                        @endif
                        <!--tr>
                            <td>
                                 {!! Form::select('status', [''=>'-- Select Status --',1 => 'Active', 0 => 'Deactive'], null, ['class' => 'form-control','id' => 'categoriesmulti']) !!}
                            </td>
                        </tr-->
                        <tfoot>
                            <tr>
                                <td colspan="9">

                                    {!! Form::select('status', [''=>'-- Select Status --',1 => 'Active', 0 => 'Inactive'], null, ['class' => 'form-control customwidth','id' => 'categoriesmulti', 'viewName' => $viewName]) !!}

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <!--<ul id="sortable">
                      <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
                      <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
                      <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
                      <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
                      <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
                      <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
                      <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
                    </ul>-->
                </div>
                <!-- /.box-body -->

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
<!--<script src="//code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
                                        var previous, exact_value = 0;
                                        var changedFields = {};
                                        $(".set_order_number").on('keyup', function (event) {
                                        previous = exact_value;
                                        exact_value = $(this).val();
                                        if (previous != exact_value) {
                                        changedFields[$(this).attr('data-id')] = $(this).val();
                                        }
                                        })

                                                $(document).on("click", ".save_category_order", function(event) {
                                        event.preventDefault();
                                        if (jQuery.isEmptyObject(changedFields)) {
                                        Notify.showMessage("Please make your changes before save the Order No.", 'warning');
                                        } else {
                                        $.ajax({
                                        type: "POST",
                                                url: root_url + '/admin/categories/set-order',
                                                data: {
                                                "_token": $('meta[name="csrf-token"]').attr('content'),
                                                        "data": JSON.stringify(changedFields)
                                                },
                                                success: function (response) {
                                                changedFields = {};
                                                if (response.status) {
                                                //Notify.showMessage(response.message, 'done');
                                                location.reload();
                                                } else {
                                                Notify.showMessage(response.message, 'black');
                                                }

                                                }
                                        })
                                        }


                                        })
                                                $(document).ready(function () {
                                        $(".sortable").sortable({
                                        update: function () {
                                        var arr = [];
                                        $('.sortable tr td:first-child input.checkBoxClass').each(function(i, v){
                                        arr.push($(this).val())

                                        })
                                                console.log(arr);
                                        $.ajax({
                                        type: "POST",
                                                url: root_url + '/admin/categories/setOrderSave',
                                                data: {
                                                "_token": $('meta[name="csrf-token"]').attr('content'),
                                                        "item": arr
                                                },
                                                success: function (response) {

                                                if (response.status) {
                                                Notify.showMessage(response.message, 'done');
                                                // location.reload();
                                                } else {
                                                Notify.showMessage(response.message, 'black');
                                                }

                                                }
                                        })
                                                // alert(arr);
                                        }

                                        });
                                        });
//     $( function() {
////   $( ".sortable" ).sortable();
////    $( ".sortable" ).disableSelection();
//  } );

</script>
@stop
