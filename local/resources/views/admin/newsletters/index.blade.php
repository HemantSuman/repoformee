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
    }    
}
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
            <div class="row">
                {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'id' => 'NewsletterFilterByTitle')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}
                <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                        {!! Form::text('title', '', array('placeholder' => 'Search by title...', 'class' => 'form-control')) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Go!', ['class' => 'btn btn-primary btn-flat']) !!}
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}

                {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'id' => 'NewsletterFilterByType')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}   
                <div class="col-sm-3 pull-right">
                    <div class="form-group">
                        {!! Form::select('type', ['' => '-- Filter By Type --', 'html' => 'HTML', 'plain' => 'Plain'], (isset($requestVal)) ? $requestVal : '-- Filter By Type --', ['class' => 'form-control filterByNewsletterType']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>


            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href='{{ url("/admin/$viewName/create") }}' class="btn btn-block btn-primary">Create Newsletter</a></h3>
                </div>
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                
                @if( Session::has( 'success' ))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> {{ Session::get( 'success' ) }}
                </div>
                @elseif( Session::has( 'danger' ))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Oops!</strong> {{ Session::get( 'danger' ) }}
                </div>
                @endif

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">                    
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><a href="?sort=id&direction=<?php echo $numberDirection; ?>">ID</a></th>
                            <th><a href="?sort=title&direction=<?php echo $alphabetDirection; ?>">Newsletter Title</a></th>
                            <!-- <th>Newsletter Type</th> -->
                            <th>Sent Date</th>
                            <th>No. of Recipients</th>
                            <th>No. of Unsubscribers</th>                  
                            <th>Actions</th>                  
                        </tr>

                        @foreach($data as $key => $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->title }}</td>
                            <?php /* <td>{{ $value->type }}</td> */ ?>
                            <td>
                                @if($value->timer == null)
                                {{ @date('d-M-Y', strtotime($value->created_at)) }}
                                @else
                                {{ @date('d-M-Y', strtotime($value->timer)) }}
                                @endif
                            </td>
                            <td>{{ $value->no_of_reciepents }}</td>
                            <td>{{ ($value->no_of_reciepents - count($value->newsletter_subscribers)) }}</td>
                            <td>
                                <a href='{{ url("/admin/$viewName/edit",$value->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="deleteRecord('{{$value->id}}', '{!! $viewName !!}', 'admin_delete', this, 0)" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {!! $data->render() !!}
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

@section('scripts')
<script type="text/javascript">
    
    $(document).on("change", ".filterByNewsletterType", function() {
        $("#NewsletterFilterByType").submit();
    })
    
</script>
@stop