@extends('admin/layout/common')
@section('content')

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
        case "title":
            if ($direction == "desc") {
                $alphabetDirection = "asc";
            } else {
                $alphabetDirection = "desc";
            }
            break;
        case "category_name":
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
        Group/Label
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
                    <h3 class="box-title"><a href='{{ url("/admin/groups/add") }}' class="btn btn-block btn-primary">Add Groups</a></h3>
                    <div class="custom-searchbar col-md-9 pull-right">

                        {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'files' => true)) !!}	


                        <div class="cst-search-category">
                            {!! Form::text('title', (isset($result->form_request['title']))?$result->form_request['title']:'', ['placeholder' => 'Group/Label', 'class' => 'form-control']) !!}
                        </div>

                        <div class="cst-search-category">
                            {!! Form::select('status', [''=>'-- Select Status --',1 => 'Active', 0 => 'Inactive'], (isset($result->form_request['status']))?$result->form_request['status']:'-- Select Status --', ['class' => 'form-control']) !!}
                        </div>
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
                            <th>{{ Form::checkbox('categoriesactionall', 1, null, ['id' => 'ckbCheckAll']) }}</th>
                            <th>ID</th>
                            <th>Group/Label</th>
                            <th>Category Name</th>
                            <th>Sub Category Name</th>
                            <th>Status</th>
                            <th>Add Date</th>                  
                            <th>Actions</th>                  
                        </tr>

                        @foreach($result as $key=>$val)

                        <tr>
                            <td>{{ Form::checkbox('classified[]', $val->id, null, ['class' => 'field checkBoxClass']) }}</td>
                            <td>{{ $val->id }}</td>
                            <td class="custom_width">{{ $val->title }}</td>
                            <td>{{ $val->category_name }}</td>
                            <td>{{ $val->cat_c_name }}</td>
                            <td><span <?php echo $val->status; ?> class="label label-<?php if ($val->status == 0) { ?>danger
                                                                  <?php } else if ($val->status == 1) {
                                                                      ?>success<?php } ?>">
                                    @if($val->status==0) Inactive @else Active @endif</span>
                            </td>

                            <td>{{@date('d-M-Y',strtotime($val->created_at))}}</td>

                            <td><a href='{{ url("/admin/$viewName/edit",$val->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="deleteRecord('{{$val->id}}', '{!! $viewName !!}', 'admin_delete', this, '')" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>
                            </td>





                        </tr>   

                        @endforeach    

                        @if(sizeof($result)==0)
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



<input type="hidden" value="" id="catSubHidden" >
<a  id="savecsv" href="" download="Acme Documentation (ver. 2.0.1).csv" style="display: none" target="_blank"></a>
@stop

