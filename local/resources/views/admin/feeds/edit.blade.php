<style>
    .error-message{color:#dd4b39;}
    #newsletterInputFile {
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
        Edit {{ $modelTitle }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/feeds') }}">{{$modelTitle}}</a></li>
        <li class="active">Edit {{$modelTitle}}</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>

                {!! Form::model($data, array('action' => ["admin\\$controllerName@admin_edit", $data->id], 'files' => true, 'class' => 'form-horizontal')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Select Category</label>
                            <div class="col-sm-10">
                                {!! Form::select('feed_category_id', $feed_categories, (!empty($data->feed_category_id)) ? $data->feed_category_id : null, array('class' => 'form-control', 'placeholder' => 'Select Category') ) !!}
                                <div class="error-message">{{$errors->first('feed_category_id')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">News type</label>
                            <div class="col-sm-10">
                                {!! Form::text('news_type', $data->news_type ? $data->news_type : null, array('class' => 'form-control', 'placeholder' => 'News type')) !!}
                                <div class="error-message">{{$errors->first('news_type')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Feed Title</label>
                            <div class="col-sm-10">
                                {!! Form::text('title', $data->title ? $data->title : null, array('class' => 'form-control', 'placeholder' => 'Feed Title')) !!}
                                <div class="error-message">{{$errors->first('title')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Feed URL</label>
                            <div class="col-sm-10">
                                {!! Form::text('url', $data->url ? $data->url : null, array('class' => 'form-control', 'placeholder' => 'Feed URL')) !!}
                                <div class="error-message">{{$errors->first('url')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                {!! Form::checkbox('status', '1', $data->status ? true : false, array('class' => 'minimal')) !!}
                            </div>
                        </div>
                    </div>
                
                    <div class="box-footer col-sm-offset-2"> 
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-default btn-close" href="{!! url('admin/feeds'); !!}">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

@stop

@section('scripts')
<script type="text/javascript">
        $(document).on("change", "#newsletterInputFile", function() {
           var files = event.target.files; //FileList object
            var output = document.getElementById("result");
            for(var i = 0; i< files.length; i++) {
                var file = files[i];
                //Only pics
                if(file.type.match('image.*')) {
                    if(this.files[0].size < 2097152) {    
                        var picReader = new FileReader();
                        picReader.addEventListener("load",function(event){
                            var picFile = event.target;
                            var div = document.createElement("div");
                            div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                                    "title='preview image'/>";
                            output.insertBefore(div,null);            
                        });
                        //Read the image
                        $('#clear, #result').show();
                        picReader.readAsDataURL(file);
                    } else {
                        alert("Image Size is too big. Minimum size is 2MB.");
                        $(this).val("");
                    }
                } else {
                    alert("You can only upload image file.");
                    $(this).val("");
                }
            }                                 
        });

        
</script>
@stop
