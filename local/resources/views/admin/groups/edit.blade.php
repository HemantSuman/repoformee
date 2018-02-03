<style>
    #classifiedInputFile {
        margin-top: 6px;
    }
    .thumbnail{

        height: 40px;
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
        Edit Group
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

                {!! Form::model($result, array('action' => ["admin\\$controllerName@admin_update", $result->id], 'files' => true, 'id'=>'formSubmit')) !!}


                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Group/Label</label>                  
                        {!! Form::input('text', 'title', null, ['id' => 'title','class' => 'form-control title textRequired', 'is_required'=>1, 'placeholder'=>'Title Name']) !!}
                        <div id="title_error" class="error-message">{{$errors->first('title')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label>    
                        <input type="hidden" value="{{(isset($result->parent_categoryid))?$result->parent_categoryid:''}}" class="form-control city" name="parent_categoryid"/>
                        {!! Form::select('parent_categoryid', $categories, $result->parent_categoryid, ['placeholder' => 'Select Category', 'class' => 'form-control parent_categoryid', 'id' => 'parent_categoryid_group']) !!}
                        <div id="parent_categoryid_error" class="error-message">{{$errors->first('parent_categoryid')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select SubCategory</label>

                        <input type="hidden" value="{{(($result->category_id) && $result->category_id != 0)?$result->category_id:''}}" class="form-control city" name="category_id"/>
                        {!! Form::select('category_id', $subcategories, (($result->category_id) && $result->category_id != 0)?$result->category_id:'', ['placeholder' => 'Select Sub Category', 'class' => 'form-control sub_categories textRequired ', 'is_required'=>0, 'id' => 'sub_categories_group']) !!}

                        <div id="category_id_error" class="error-message subcategoryerror">{{$errors->first('category_id')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Attributes</label>      
                          <input type="hidden" name="parent_cat_id" id="parent_cat_id" value="{{$result->parent_categoryid}}"   />
                          <input type="hidden" name="child_cat_id" id="child_cat_id" value="{{$result->category_id}}"   />
                          <input type="hidden" name="attributes_groups_saved" id="attributes_groups_saved" value="{{implode(',',($saved_attr_ids))}}"   />

                          <input type="hidden" name="other_saved_attr_ids" id="other_saved_attr_ids" value="{{implode(',',($other_saved_attr_ids))}}"   />
                        <div id="attrName" class="attr_value_single">
                                @foreach ($all_attributes->attributes as $val)
                                    <input name="attr_ids[]" class="inputCheckBox" type="checkbox" @if(in_array($val['attribute_id'],$other_saved_attr_ids)) disabled @endif value="{{$val['attribute_id']}}" @if(in_array($val['attribute_id'],$saved_attr_ids))checked @endif  >  <label @if(in_array($val['attribute_id'],$other_saved_attr_ids)) style="color:#a79e9e;" @endif> {{$val['display_name']}} </label> <br />
                                @endforeach

                        </div>
                          <div id="attr_ids_error" class="error-message"></div>
                    </div>


                    <!--<div class="rows">-->
                    <div class=" form-group">
                        <div class="checkbox1">
                            <label>
                                {!! Form::checkbox('status', '1', null, ['class' => 'status']) !!} Status
                            </label>
                        </div>
                    <!--</div>-->
                    </div>


                </div>
                <!-- /.box-body -->


                <div class="box-footer">
                    <input type="hidden" value="{{ $result->id }}" name="id">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href="" onclick="javascript:history.go(-1);">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.box -->

    </div>
    <!--/.col -->        
    <!--</div>-->
    <!-- /.row -->
</section>
<!-- /.content -->	

@stop

@section('scripts')

@stop