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
                <?php /* <div class="box-header">
                  <h3 class="box-title"><a href='{{ url("/admin/$viewName/add") }}' class="btn btn-block btn-primary">Add {{$modelTitle}}</a></h3>
                  <div class="custom-searchbar col-md-9 pull-right">

                  {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'files' => true)) !!}


                  <div class="cst-search-category">
                  {!! Form::text('promocode', (isset($result->form_request['promocode']))?$result->form_request['promocode']:'', ['placeholder' => 'Promo Code', 'class' => 'form-control']) !!}
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
                  </div> */ ?>
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">


                    <table class="table table-hover table-bordered">

                        <tr>
                            <?php /* <th>{{ Form::checkbox('categoriesactionall', 1, null, ['id' => 'ckbCheckAll']) }}</th> */ ?>
                            <th><a href="?sort=id&direction=<?php echo $numberDirection; ?>">ID</a></th>
                            <th>Template Name</th>
                            <th>Categories</th>
                            <th>Actions</th>                  
                        </tr>

                        <tbody class="">
                            @foreach($result as $key=>$val)
                            <tr>
                                <?php /* <td>{{ Form::checkbox('categoriesaction[]', $val->id, null, ['class' => 'field checkBoxClass']) }}</td> */ ?>
                                <td>{{$val->id}} </td>
                                <td>{{$val->template_name}} </td>
                                <td>{{$val->template_name}} </td>
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

                                    <!--{!! Form::select('status', [''=>'-- Select Status --',1 => 'Active', 0 => 'Inactive'], null, ['class' => 'form-control customwidth','id' => 'categoriesmulti', 'viewName' => $viewName]) !!}-->

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
