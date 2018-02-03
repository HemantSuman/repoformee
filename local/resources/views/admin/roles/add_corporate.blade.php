@extends('admin/layout/common')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create New Corporate Role
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Create New Corporate>
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
                        <!--<a class="btn btn-primary" href="{{ url('/admin/roles') }}"> Back</a>-->
                    </div>
                </div>
                {!! Form::open(array("url" => "admin/$viewName/create_corporate", "role" => "form", 'files' => true, "id"=>"formSubmit")) !!}	
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Corporate Name </label>                  
                        {!! Form::input('text', 'name', null, ['class' => 'form-control','placeholder'=>'Corporate Name ']) !!}
                        <div id="name_error" class="error-message">{{$errors->first('name_value')}}</div>
                    </div> 
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Role Slug </label>                  
                       <select name="role_slug" class="form-control">
                       
                       <option value="real-estate">real-estate</option>
                       <option value="merchant">merchant</option>
                       <option value="car-dealer">car-dealer</option>
                       <option value="job">job</option>
                       
                       
                       </select>
                        <div id="role_slug_error" class="error-message">{{$errors->first('role_slug')}}</div>
                    </div>
                    

                    <div class="form-group">
                        <div class=" checkbox bike-category">
                            <label>
                                {!! Form::checkbox('is_merchant', '1', null, ['class' => 'is_merchant']) !!} Is Merchant
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Select Category</label>        
                        {!! Form::input('hidden', 'category_id', null, ['id' => 'category_id']) !!}
                        {!! Form::input('hidden', 'pid', null, ['id' => 'pid']) !!}
                        <div class="easyui-panel defaultCatList" style="padding:5px; border: none;">
                            <ul id="tt" class="easyui-tree" ></ul>
                        </div>
                        <!--                        <div class="easyui-panel parentCatList" style="padding:5px; border: none;">
                                                    <ul id="tt1" class="easyui-tree" ></ul>
                                                </div>-->

                        <div id="category_id_error" class="error-message">{{$errors->first('category_id')}}</div>
                    </div> 



                    <div class="form-group">
                        <div class=" checkbox bike-category">
                            <label>
                                {!! Form::checkbox('status', '1', null) !!} Active
                            </label>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button> 
                        <a style="margin-left: 5px;" class="btn btn-default btn-close" href='{!! url("admin/corporates"); !!}'>Cancel</a>
                    </div>
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

@endsection
@section('scripts')
<script>

    get_categories_json('categories_json');

    $(document).on('click', '.is_merchant', function () {

        var thisObj = $(this);
        $('#category_id').val('');
        if ($(this).is(":checked")) {
            get_categories_json('categories_json_is_sellable');
        } else {
            get_categories_json('categories_json');
        }

    });

    function get_categories_json(routeName) {
        $('#tt').tree({
            //url:'categories_json',
//        "_token": $('meta[name="csrf-token"]').attr('content'),
            url: root_url + '/admin/attributes/' + routeName,
            data: [{
                    _token: $('meta[name="csrf-token"]').attr('content'),
                }],
            method: 'get',
            animate: true,
            checkbox: true,
            loadFilter: function (rows) {
                var results = [];
                $.each(rows, function(index,value){
                    if(typeof value.id != 'undefined' && !$.isEmptyObject(value['children'])){
                        results.push(value);
                    }
                });
                return results;
            },
            onCheck: function (node) {
                var nodes = $('#tt').tree('getChecked');
                var checkedNodes = [];
                var checkedNodesPid = [];
                for (var i = 0; i < nodes.length; i++) {
                    node = nodes[i];
                    if (node.checked) {
                        checkedNodes.push(node.id);
                        checkedNodesPid.push(node.pid);
                    }
                }
                $('#category_id').val(checkedNodes);
                $('#pid').val(checkedNodesPid);
//            console.log(checkedNodes);
            }
        });
    }


</script>
@stop