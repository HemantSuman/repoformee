<style>
    #classifiedInputFile {
        margin-top: 6px;
    }
    .thumbnail{

        height: 100px;
        margin: 10px; 
        float: left;
    }
    #clear{
        display:none;
    }
    #result {
        border: 4px dotted #cccccc;
        display: none;
        float: left;
        margin:0 auto;
        margin-top: 5px;
        width: 100%;
    }

</style>
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Group
    </h1>
    <ol class="breadcrumb">

        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/groups') }}">{{$modelTitle}}</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!--column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>

                <!-- /.box-header -->
                <!-- form start -->    

                {!! Form::open(array("url" => "admin/$viewName/create", "role" => "form", 'files' => true, 'id'=>'formSubmit')) !!}  
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Group/Label</label>                  
                        {!! Form::input('text', 'title', null, ['id' => 'title','class' => 'form-control title textRequired', 'is_required'=>1, 'placeholder'=>'Title Name']) !!}
                        <div id="title_error" class="error-message">{{$errors->first('title')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label>    

                        {!! Form::select('parent_categoryid', $categories, '', ['placeholder' => 'Select Category', 'class' => 'form-control parent_categoryid textRequired addClassified', 'is_required'=>1, 'id' => 'parent_categoryid_group']) !!}
                        <div id="parent_categoryid_error" class="error-message">{{$errors->first('parent_categoryid')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select SubCategory</label>
                        {!! Form::select('category_id', [], '', ['placeholder' => 'Select Sub Category', 'class' => 'form-control sub_categories textRequired ', 'is_required'=>1, 'id' => 'sub_categories_group']) !!}

                        <div id="category_id_error" class="error-message subcategoryerror">{{$errors->first('category_id')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Attributes</label>         
                        <!--<input type="hidden" name="other_saved_attr_ids" id="other_saved_attr_ids" value="{{implode(',',($other_saved_attr_ids))}}"   />-->
                        <div id="attrName" class="attr_value_single">
                            No attribute selected

                        </div>

                        <div id="attr_ids_error" class="error-message"></div>

                    </div>


                    <div class="form-group">
                        <div class="checkbox1 bike-category">
                            <label>
                                {!! Form::checkbox('status', '1', true, ['class' => 'status']) !!} Status
                            </label>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->


                <div class="box-footer">

                    <button type="submit" class="btn btn-primary">Submit</button> 

                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href="{!! url('admin/groups'); !!}">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box -->

        </div>
        <!--/.col -->        
    </div>
    <!-- /.row -->



    <!-- /.input group -->
</section>
<!-- /.content -->  


@stop

@section('scripts')

@stop