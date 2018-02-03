@extends('admin/layout/common')
@section('content')
<?php
$numberDirection = "asc";
$alphabetDirection = "desc";
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
                <div class="box-header">
                    
                    <div class="custom-searchbar col-md-9 pull-right">

                        {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'files' => true)) !!}	


                        <div class="cst-search-category">
                            {!! Form::text('order_id', (isset($result->form_request['order_id']))?$result->form_request['order_id']:'', ['placeholder' => 'Order Id', 'class' => 'form-control']) !!}
                        </div>

                       <?php /*?> <div class="cst-search-category">
                            {!! Form::select('status', [''=>'-- Select Status --',1 => 'Active', 0 => 'Inactive'], (isset($result->form_request['status']))?$result->form_request['status']:'-- Select Status --', ['class' => 'form-control']) !!}
                        </div><?php */?>
                        <div class="cst-search-category">
                            {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!} <a href='{{ url("/admin/$viewName") }}' class="btn btn-primary">Reset</a>
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
                           
                            <th><a href="?sort=id&direction=<?php echo $numberDirection; ?>">Sub Order ID</a></th>
                            <th>Order Id</th>
                            <th>Seller ID</th>
                            <th>Product Name</th>
                            <th>Order Total</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Actions</th>                  
                        </tr>

                        <tbody class="">
                            @foreach($result as $key=>$val)
                            <tr>
                               
                                <td>{{$val->id}} </td>
                                <td>{{$val->order_id}} </td>
                                <td>{{$val->seller_id}} </td>
                                <td>{{$val->item_name}} </td>
                                <td>${{$val->item_total_amt}} </td>
                                <td>{{$val->created_at}} </td>
                                <td>{{$val->order_status}} </td>
                                
                                
                                
                                
                                <td>					
                                    <a href='{{ url("/admin/$viewName/edit",$val->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0)" onclick="deleteRecord('{{$val->id}}', '{!! $viewName !!}', 'admin_delete', this, {{$val->pid}})" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>
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
                        
                    </table>
                </div>
                <!-- /.box-body -->
			<div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {!! $result->render() !!}
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

//     $( function() {
////   $( ".sortable" ).sortable();
////    $( ".sortable" ).disableSelection();
//  } );

</script>
@stop
