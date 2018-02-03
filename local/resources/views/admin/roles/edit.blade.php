<style>
    .error-message{color:#dd4b39;}
</style>
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Role
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Role Edit</li>
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
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ url('/admin/roles') }}"> Back</a>
                    </div>
                </div>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- /.box-header -->
                <!-- form start -->    

                {!! Form::model($role, array('action' => ["admin\\RoleController@update", $role->id])) !!}
                <div class="box-body">

                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>

                    <div class="mgmtCheckboxes">
                        <?php
                        $data = array();

                        foreach ($permission as $row) {
                            $data[$row['controler_name']][] = $row;
                        }
                        $new_name = array();
                        $new_name['RoleController'] = 'Role Management';
                        $new_name['CategoriesController'] = 'Category Management';
                        $new_name['AttributesController'] = 'Attribute Management';
                        $new_name['ClassifiedController'] = 'Classified Management';
                        $new_name['AdvertisementsController'] = 'Advertisement Management';
                        $new_name['FeedsController'] = 'Manage Rss Feeds';
                        $new_name['NewslettersController'] = 'Manage Newsletter';
                        $new_name['UsersController'] = 'User Management';
                        $new_name['QueriesController'] = 'Support Tickets Management';
                        $new_name['FoodProductsController'] = 'Food Products Management';
                        $new_name['RestrictedIngredientsController'] = 'Restricted Ingredients Management';
                        $new_name['GroupsController'] = 'Groups Management';
                        $new_name['MembershipPlansController'] = 'MembershipPlans Management';
                        $new_name['PromoCodesController'] = 'PromoCodes Management';
                        $new_name['PackagesController'] = 'Packages Management';
                        $new_name['TemplatesController'] = 'Templates Management';
                        $i = 1;
                        foreach ($data as $key => $row) {

                            $show_name = $new_name[$key];
                            ?>
                            <div class="checkboxGroup">
                                <div class="mgtcheckbox">
                                    <input type="checkbox" name="main"   data-id="<?php echo $i; ?>" class="main"><span><?php echo $show_name; ?></span>
                                </div>
                                <ul class="subcheckbox">
                                    <?php
                                    $checked = 'checked="checked"';
                                    foreach ($row as $value) {
                                        ?>
                                        <li>
                                            <input type="checkbox" name="permission[]"  class="sub_<?php echo $i; ?> " value="<?php echo $value['id']; ?> "<?php if (in_array($value['id'], $rolePermissions->toarray())) echo 'checked="checked"' ?> ><?php echo $value['display_name']; ?>

                                        </li>
                                        <?php
                                    }
                                    $i++;
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                    <button type="submit" class="btn btn-primary">Submit</button>

                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href="">Cancel</a>

                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!--/.col -->        
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->	

@stop
@section('scripts')
<script>
    $(document).ready(function () {
        var numUnchecked = '';
        
        $( "ul.subcheckbox" ).each(function( index ) {
            var numUnchecked = $(this).find("input[type='checkbox']:not(:checked)").length;
            if(!numUnchecked)
            {
               $(this).prevAll("div:first").find("input[type='checkbox']").prop("checked", true); 
               
            }
          
        });
        
        
        jQuery(".main").click(function () {
            var id = jQuery(this).data("id");
            var cur = jQuery(this).prop("checked");
            var sub_id = ".sub_" + id;
            jQuery(sub_id).prop("checked", cur);
        });
    });

</script>
@stop