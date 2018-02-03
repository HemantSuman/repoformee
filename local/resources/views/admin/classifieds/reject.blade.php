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
        case "category_name":
            if($direction == "desc") {
                $alphabetDirection = "asc";
            } else {
                $alphabetDirection = "desc";
            }
            break;
        case "start_date":
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
       Rejected Classified
    </h1>
    <ol class="breadcrumb">
<!--        <li>
            <a href="{!! url('admin/classifieds/export-unapprove'); !!}" class="btn btn-info btn-lg">Export</a>
        </li>-->
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
                        
                        {!! Form::open(array("url" => "admin/$viewName/reject", 'method'=>'post', "role" => "form", 'files' => true)) !!}	
                      
                        <div class="cst-search-category">
                            {!! Form::text('name', (isset($result->form_request['name']))?$result->form_request['name']:'', ['placeholder' => 'Category Name', 'class' => 'form-control']) !!}
                        </div>
                        <div class="cst-search-category">
                            {!! Form::text('title', (isset($result->form_request['title']))?$result->form_request['title']:'', ['placeholder' => 'Classified Name', 'class' => 'form-control']) !!}
                        </div>
<!--                        <div class="cst-search-category">
                            {!! Form::select('status', [''=>'-- Select Status --',1 => 'Active', 0 => 'Inactive'], (isset($result->form_request['status']))?$result->form_request['status']:'-- Select Status --', ['class' => 'form-control']) !!}
                        </div>-->
                        <div class="cst-search-category">
                            {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!} <a href='{{ url("/admin/$viewName/reject") }}' class="btn btn-primary">Reset</a>
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
                            <th><a href="?sort=category_name&direction=<?php  echo $alphabetDirection; ?>">Category Name</a></th>
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
                            <td>{{ $val->title }}</td>
                            <td>{{ $val->category_name }}</td>
                             <td>{{ $val->cat_c_name }}</td>
                            <td><span class="label label-<?php if ($val->status == 0) { ?>danger<?php } elseif ($val->status == 2){ ?>info<?php } elseif ($val->status == 3){ ?>danger<?php }else { ?>success<?php } ?>">
                                    @if($val->status==0) Inactive @elseif($val->status==2) UnApproved  @elseif($val->status==3) Rejected @else Active @endif</span>
                            </td>
                            <td>
                                {!! ($val->featured_classified == 1)? '<i class="icon fa fa-check"></i>' : '<i class="icon fa fa-ban"></i>'  !!}
                                
                                </td>
                            <td>{{@date('d-M-Y',strtotime($val->start_date))}}</td>
                            <td>
                                <?php /*<a href='{{ url("/admin/$viewName/edit",$val->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>*/ ?>
                                <a href='{{ url("/admin/$viewName/view",$val->id).'/reject' }}' class="btn btn-info" title="View and rejected"><i class="fa fa-eye"></i></a>
                                <a href="javascript:void(0)" onclick="deleteRecord('{{$val->id}}', 'reject', 'admin_delete', this,'')" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>
                               </td>
                            
                           
                           
                            
                            
                        </tr>   

                        @endforeach    

                        @if(sizeof($result)==0)
                        <tr><td colspan="9" style="text-align:center">no record found</td></tr>
                        @endif
                        
                        <tfoot>
<!--                            <tr>
                                <td colspan="9">

                                    {!! Form::select('status', [''=>'-- Select Status --',1 => 'Active', 0 => 'Inactive'], null, ['class' => 'form-control customwidth','id' => 'categoriesmulti', 'viewName' => $viewName]) !!}

                                </td>
                            </tr>-->
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
