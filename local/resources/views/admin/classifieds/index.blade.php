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
        case "start_date":
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
        Classified
    </h1>
    <ol class="breadcrumb">

        <li>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#SampleFileModel">Sample Download</button>
            <a href="{!! url('admin/classifieds/export'); !!}" class="btn btn-info btn-lg">Export</a>
        </li>
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
                    <h3 class="box-title"><a href='{{ url("/admin/classifieds/add") }}' class="btn btn-block btn-primary">Add Classified</a></h3>
                    <div class="custom-searchbar col-md-9 pull-right">

                        {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'files' => true)) !!}	


                        <div class="cst-search-category">
                            {!! Form::text('name', (isset($result->form_request['name']))?$result->form_request['name']:'', ['placeholder' => 'Category Name', 'class' => 'form-control']) !!}
                        </div>

                        <div class="cst-search-category">
                            {!! Form::text('title', (isset($result->form_request['title']))?$result->form_request['title']:'', ['placeholder' => 'Classified Name', 'class' => 'form-control']) !!}
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
                            <th><a href="?sort=id&direction=<?php echo $numberDirection; ?>">ID</a></th>
                            <th><a href="?sort=title&direction=<?php echo $alphabetDirection; ?>">Title</a></th>
                            <th><a href="?sort=category_name&direction=<?php echo $alphabetDirection; ?>">Category Name</a></th>
<!--                            <th>Category Name</th>-->
                            <th> Sub Category Name</th>
                            <th>Status</th>
                            <th>Is Featured</th>                  
                            <th><a href="?sort=start_date&direction=<?php echo $alphabetDirection; ?>">Add Date</a></th>                  
                            <th>Actions</th>                  
                        </tr>

                        @foreach($result as $key=>$val)

                        <tr>
                            <td>{{ Form::checkbox('classified[]', $val->id, null, ['class' => 'field checkBoxClass']) }}</td>
                            <td>{{ $val->id }}</td>
                            <td class="custom_width">{{ $val->title }}</td>
                            <td>{{ $val->category_name }}</td>
                            <td>{{ $val->cat_c_name }}</td>
                            <td><span <?php echo $val->status; ?> class="label label-<?php if ($val->status == 0) {
    ?>danger
                                                                  <?php } else if ($val->status == 2) {
                                                                      ?>info
                                                                  <?php } else if ($val->status == 3) {
                                                                      ?>rejected 
                                                                  <?php } else if ($val->status == 1) {
                                                                      ?>success<?php } ?>">
                                    @if($val->status==0) Inactive @else Active @endif</span>
                            </td>
                            <td>
                                {!! ($val->featured_classified == 1)? '<i class="icon fa fa-check"></i>' : '<i class="icon fa fa-ban"></i>'  !!}

                            </td>
                            <td>{{@date('d-M-Y',strtotime($val->created_at))}}</td>

                            <td><a href='{{ url("/admin/$viewName/edit",$val->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                <a href='{{ url("/admin/$viewName/view",$val->id) }}' class="btn btn-info" title="View Record"><i class="fa fa-eye"></i></a> 
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

<!-- Modal -->
<div id="SampleFileModel" class="modal fade" role="dialog">
    <div class="modal-dialog" style="height:200px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sample CSV File</h4>
            </div>
            {!! Form::open(array("url" => "admin/attributes/generate_csv", "role" => "form", 'files' => true, 'id'=>'submitFrmExport')) !!}
            <div class="modal-body">

                <div class="form-group">
                    <label for="recipient-name" class="control-label">Categories:</label>
                    <select id="p_categories" name="p_categories"></select>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Sub Categories:</label>
                    <select id="child_categories" name="child_categories"></select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                </div>

            </div>
            {!! Form::close() !!}

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="" id="catSubHidden" >
<a  id="savecsv" href="" download="Acme Documentation (ver. 2.0.1).csv" style="display: none" target="_blank"></a>
@stop

@section('scripts')
<script>

    $('#SampleFileModel').on('shown.bs.modal', function () {

    $('#child_categories').html('');
    $.ajax({
    url: root_url + '/admin/categories/allcategories',
            data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": 0
            },
            //dataType: "html",
            method: "GET",
            cache: false,
            success: function (response) {
            if (response.status) {

            $("#p_categories").html('');
            $("#p_categories").append($('<option></option>').val('').html('Select Category'));
            $.each(response.categories, function (key, value) {

            $("#p_categories").append($('<option></option>').val(key).html(value));
            });
            }
            }  });
    $(document).on('change', '#p_categories', function(){
    var p_catid = $(this).val();
    $.ajax({
    url: root_url + '/admin/categories/allcategories',
            data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": p_catid
            },
            //dataType: "html",
            method: "GET",
            cache: false,
            success: function (response) {
            if (response.status) {

            $("#child_categories").html('');
            $("#child_categories").append($('<option></option>').val('').html('Select Sub Category'));
            $.each(response.categories, function (key, value) {

            $("#child_categories").append($('<option></option>').val(key).html(value));
            });
            if (jQuery.isEmptyObject(response.categories)){
            $('#catSubHidden').val(0);
            } else {
            $('#catSubHidden').val(1);
            }
            }
            }

    });
    });
    });
    $(document).on('submit', '#submitFrmExport', function(e){
//    e.preventDefault();
    if ($('#p_categories :selected').val() == ''){
    Notify.showMessage("Please select category file.", 'warning');
    return false;
    }
    if ($('#catSubHidden').val() == '1'){
    if ($('#child_categories').val() == ''){
    Notify.showMessage("Please select sub category file.", 'warning');
    return false;
    }
    }
    $.ajax({
    url: root_url + '/admin/attributes/generate_csv',
            async:false,
            data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
                    "p_categories": $('#p_categories').val(),
                    "child_categories": $('#child_categories').val()
            },
            //dataType: "html",
            method: "GET",
            cache: false,
            success: function (response) {
            if (response.status) {
//                        console.log('dfs')
            //  $('#submitFrmExport').submit();
//                        $("#savecsv").attr("href", root_url+'/'+response.downLoadFile);
//                        var href = $("#savecsv").attr('href');
//                  
//                        $('#savecsv')[0].click();

            //        window.open('data:attachment/csv;charset=utf-8,' + encodeURI(csvString));
//            if(window.open('data:attachment/csv;charset=utf-8,' + encodeURI(root_url+'/'+response.downLoadFile))){
//                            $('#SampleFileModel').modal('hide');
//                        }
            if (window.open(root_url + '/' + response.downLoadFile)){
            $('#SampleFileModel').modal('hide');
            }
            }

            }
    });
    });
</script>
@stop
