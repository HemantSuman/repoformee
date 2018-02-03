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
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">


                    <table class="table table-hover table-bordered">

                        <tr>
                            <th>{{ Form::checkbox('categoriesactionall', 1, null, ['id' => 'ckbCheckAll']) }}</th>
                            <th><a href="?sort=id&direction=<?php echo $numberDirection; ?>">ID</a></th>
                            <th>Package Name</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Price($)</th>
                            <th>Status</th>
                            <th>Actions</th>                  
                        </tr>

                        <tbody class="">
                            @foreach($result as $key=>$val)
                            <tr>
                                <td>{{ Form::checkbox('categoriesaction[]', $val->id, null, ['class' => 'field checkBoxClass']) }}</td>
                                <td>{{$val->id}} </td>
                                <td>{{$val->package_name}} </td>
                                <td>{{$val->package_slug}} </td>
                                <td>{{ @ucfirst($val->package_discription) }}</td> 
                                <td>{{ @ucfirst($val->package_price) }}</td> 
                                <td><span class="label label-<?php if ($val->status == 0) { ?>danger<?php } else { ?>success<?php } ?>">
                                        @if($val->status==0) Inactive @else Active @endif</span>
                                </td>
                                <td>					
                                    <a href='{{ url("/admin/$viewName/edit",$val->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
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

//     $( function() {
////   $( ".sortable" ).sortable();
////    $( ".sortable" ).disableSelection();
//  } );

</script>
@stop
