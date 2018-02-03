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
                    @if($result->requestId != '')
                    {!! Form::hidden('parent_id', $result->requestId, ['id' => 'parent_id']) !!}
                    <h3 class="box-title"><a href='{{ url("/admin/$viewName/add/$result->requestId") }}' class="btn btn-block btn-primary">Add New Sub Attribute</a></h3>
                    @else
                    <h3 class="box-title"><a href='{{ url("/admin/$viewName/add") }}' class="btn btn-block btn-primary">Add New Attribute</a></h3>
                    @endif

                    <div class="custom-searchbar col-md-9 pull-right">
                        @if($result->requestId != '')
                        {!! Form::open(array("url" => "admin/$viewName/$result->requestId", 'method'=>'post', "role" => "form", 'files' => true)) !!}	
                        @else
                        {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'files' => true)) !!}	
                        @endif
                        <div class="cst-search-category">
                            {!! Form::text('name', (isset($result->form_request['name']))?$result->form_request['name']:'', ['placeholder' => 'Attribute Name', 'class' => 'form-control']) !!}
                        </div>
                        <div class="cst-search-category">
                            {!! Form::text('cat_name', (isset($result->form_request['cat_name']))?$result->form_request['cat_name']:'', ['placeholder' => 'Sub Category Name', 'class' => 'form-control']) !!}
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


                    <table class="table table-hover table-bordered table-icon">

                        <tr>
                            <th>{{ Form::checkbox('categoriesactionall', 1, null, ['id' => 'ckbCheckAll']) }}</th>
                            <th><a href="?sort=id&direction=<?php echo $numberDirection; ?>">ID</a></th>
                            <th><a href="?sort=name&direction=<?php echo $alphabetDirection; ?>">Attribute Name</a></th>
                            <th>Attribute Type</th>
                            <th>Status</th>
                            <!--<th>Type (Contact/Key Details)</th>-->
                            <th>Actions</th>                  
                        </tr>


                        @foreach($result as $key=>$val)
                        <tr>
                            <td>{!! Form::checkbox('categoriesaction[]', $val->id, null, ['class' => 'field checkBoxClass']) !!}</td>
                            <td>{!! $val->id !!}</td>

                            <td>{!! @ucfirst($val->name) !!}</td>                
                            <td>{!! $val['attributeType']['name']!!}</td>
                            <td><span class="label label-<?php if ($val->status == 0) { ?>danger<?php } else { ?>success<?php } ?>">
                                    @if($val->status==0) Inactive @else Active @endif</span>
                            </td>
                            <?php /*
                            <td>
                                
                                {!! Form::select('show_type', [1 => 'Contact Details', 2 => 'Key Details'], ($val->show_type),['class'=>'showvalue','data-id'=>$val->id])!!}

                            </td>
                             
                             */ ?>
                            <td>					
                                <a href='{!! url("/admin/$viewName/edit",$val->id) !!}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="deleteRecord('{{$val->id}}', '{!! $viewName !!}', 'admin_delete', this,{{$val->p_attr_id}})" class="btn btn-danger" title="Delete Record"><i class="fa fa-trash"></i></a>
                                @if($result->requestId == '' && count($val->sub_attributes) > 0)
                                <a href='{!! url("/admin/$viewName/$val->id") !!}' class="btn btn-primary" title="View Sub Attributes"><i class="fa fa-list"></i></a>
                                @endif
                                @if($result->requestId == '')
                                <a href='{!! url("/admin/$viewName/$val->id/categories") !!}' class="btn btn-warning" title="View Categories & Subcategories"><i class="fa fa-sliders"></i></a>
                                @endif
                            </td>
                        </tr>   

                        @endforeach    

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
                                    {!! Form::select('status', [''=>'-- Select Status --',1 => 'Active', 0 => 'Deactive'], null, ['class' => 'form-control customwidth','id' => 'categoriesmulti', 'viewName' => $viewName]) !!}
                                </td>
                            </tr>
                        </tfoot>
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
</script>
@stop