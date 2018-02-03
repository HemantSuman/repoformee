<style>
    .{color:#dd4b39;}
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
        /*        border: 4px dotted #cccccc;*/
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
        View Classified
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/classifieds/approve') }}">{{$modelTitle}}</a></li>
        <li class="active"></li>
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

                <div class="box-body custom-table-structure">

                    <div class="form-group">
                        <?php
                        // dd($result->toarray());
                        ?>
                        <label for="exampleInputEmail1">Title</label>                  

                        <div class="form-control">{{(isset($result->title))?$result->title:null}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Category</label>         
                        <?php
                        foreach ($categories as $key => $value) {
                            if ($result->parent_categoryid == $key) {
                                $category = $value;
                                break;
                            }
                        }
                        ?>
                        <div class="form-control">{{(isset($category))?$category:''}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> SubCategory</label>         
                        <?php
                        $subcategories1 = '';
                        foreach ($subcategories->toarray() as $key => $value) {
                            if ($result->category_id == $key) {
                                $subcategories1 = $value;
                            } 
                        }
                        ?>
                        <div class="form-control">{{(!empty($subcategories1))?$subcategories1:''}}</div>
                    </div>
                    <!--                    <div class="form-group">
                                            <label for="exampleInputEmail1">Attributes</label>       
                                        </div>-->
                    <!--                    <div class="form-group">-->



                    @foreach ($result->classified_attribute as $val)
                    <div class="form-group">
                        <label>{{ $val->name }}</label>


                        <?php
                        $input_type = $val->attr_type_name;
                        if ($input_type == "textarea") {
                            ?>
                            <textarea disabled class="attr_value form-control" name="attr_value[]">{{ $val->attr_value }}</textarea> 
                        <?php } else if ($input_type == "calendar" || $input_type == "Date" || $input_type == "Time") { ?>
                            <input type="text" value="<?php echo str_replace(';','-', $val->attr_value); ?>" class="attr_value form-control" name="attr_value[]" id="datepicker" disabled>
                        <?php } else if (in_array($input_type, ["Multi-Select", "Radio-button", "Drop-Down"])) { ?>
                            <input type="text" value="{{ $val->attr_AllValuesText }}" class="attr_value form-control" name="attr_value[]" disabled>
                        <?php } else { ?>
                            <input type="text" value="{{ $val->attr_value }}" class="attr_value form-control" name="attr_value[]" disabled>
                        <?php } ?>
                    </div>
                    @endforeach



                    <?php if($result->price != 0){ ?>
                    <div class="form-group">
                        <label for="">Price</label>                  

                        <div class="form-control">{{$result->price}}</div>
                    </div> 
                    <?php } ?>

                    <!--</div>-->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Location</label>                  

                        <div class="form-control">{{(isset($result->location))?$result->location:null}}</div>
                    </div> 
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1"> State</label>   
                        <?php
                        foreach ($state as $key => $value) {
                            if ($result->state_id == $key) {
                                $statevalue = $value;
                            }
                        }
                        ?>

                        <div class="form-control">{{(isset($statevalue))?$statevalue:null}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Suburb</label>  
                        <?php
                        foreach ($suburb as $key => $value) {
                            if ($result->subregions_id == $key) {
                                $subvalue = $value;
                            }
                        }
                        ?>

                        <div class="form-control">{{(isset($subvalue))?$subvalue:null}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">PinCode</label>                  

                        <div class="form-control">{{(isset($result->pincode))?$result->pincode:null}}</div>
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Contact Name</label>                  

                        <div class="form-control">{{(isset($result->contact_name))?$result->contact_name:null}}</div>
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Contact Email</label>                  

                        <div class="form-control">{{(isset($result->contact_email))?$result->contact_email:null}}</div>
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Contact Mobile</label>                  

                        <div class="form-control">{{(isset($result->contact_mobile))?$result->contact_mobile:null}}</div>
                    </div>  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Website</label>                  

                        <div class="form-control">{{(isset($result->website))?$result->website:null}}</div>
                    </div> 
                    <div class="form-group extra-height">
                        <label for="exampleInputEmail1"> Classified Description</label>                  

                        <div  class="form-control">{!!(isset($result->description))?$result->description:null!!}</div>
                    </div>
                    <div class="form-group extra-height">
                        <label class="col-sm-2 control-label">Image </label>
                        <div class="col-sm-10">

                            @if(count(isset($result->classified_image)) > 0)
                            <output id="result" style="display: block">
                                @foreach($result->classified_image as $key => $single)
                                <div>
                                    <img src="{!! asset('/upload_images/classified/30px/'.$result->id.'/'.$single['name']) !!}" title="preview image" class="thumbnail" />
                                </div>
                                @endforeach
                            </output>
                            @else
                            <output id="result"></output>
                            @endif
                        </div>
                    </div>
                    <?php if($result->categoriesname['belong_to_community'] != 1){ 
                        ?>
                    <div class=" form-group">
                        <div class="checkbox1 form-control">
                            <label>

                                {!! Form::checkbox('featured_classified', '1', ($result  && $result->featured_classified != 0)? true:null,array('disabled')) !!} Is Featured Classified
                            </label>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <div class=" form-group">
                        <div class="checkbox1 form-control">
                            <label>

                                {!! Form::checkbox('status', '1', ($result  && $result->status != 0)? true:null, array('disabled'),['class' => 'status']) !!} Status
                            </label>
                        </div>
                    </div>
                    <div class="form-group ">

                        <label class="pull-left"> Date:</label>
                        <div class="col-sm-5">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div  style="border: 1px #ccc solid;padding: 5px;" class="">{{(isset($result->start_date))?@date('d-M-Y',strtotime($result->start_date)):null}}</div>

                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div style="border: 1px #ccc solid;padding: 5px;" class="">{{(isset($result->end_date))?@date('d-M-Y',strtotime($result->end_date)):null}}</div>

                            </div>
                        </div>


                        <!-- /.input group -->

                    </div>
                </div>
                <!-- /.box-body -->


                <?php
                // dd($viewbutton);
                if ($viewbutton == 'approved') {
                    ?>
                    {!! Form::open(array("url" => "admin/$viewName/approved_submit", "role" => "form", 'files' => true, 'id'=>'submitFrm')) !!}
                    <div class="box-footer">
                        <input type="hidden"  name="classified_id" value="{{$result->id}}" >
                        <input type="submit" value="Approve" name="status" class="btn btn-primary"> 
                        <input type="submit" value="Reject" name="status" class="btn btn-primary"> 

                        <!--<a style="margin-left: 5px;" class="btn btn-default btn-close" href="{!! url('admin/classifieds/approve'); !!}">Cancel</a>-->
                    </div>
                    {!! Form::close() !!}

                    <?php
                } elseif ($viewbutton == 'reject') {
                    ?>
                    {!! Form::open(array("url" => "admin/$viewName/approved_submit_reject", "role" => "form", 'files' => true, 'id'=>'submitFrm')) !!}
                    <div class="box-footer">
                        <input type="hidden"  name="classified_id" value="{{$result->id}}" >
                        <input type="submit" value="Approve" name="status" class="btn btn-primary"> 
                    </div>
                    {!! Form::close() !!}

                    <?php
                } else {
                    
                }
                ?>


            </div>
            <!-- /.box -->

        </div>
        <!--/.col -->        
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->	

@stop

