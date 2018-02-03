@extends('admin/layout/common')
@section('content')
<section class="content-header">
    <h1>
        Admin Cms Page
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Cms Page Managment</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
<!--                {!! Form::open(array("url" => "admin/admin_user", 'method'=>'post', "role" => "form", 'id' => 'FeedFilterByTitle')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}
                <div class="col-sm-4">
                    <div class="input-group input-group-sm form-group">
                        {!! Form::text('name', '', array('placeholder' => 'Search by User ...', 'class' => 'form-control')) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Go!', ['class' => 'btn btn-info btn-flat']) !!}
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}-->

            </div>
            <div class="box">
                <div class="box-header">

<!--                                        <h3 class="box-title">
                                            
                                               <a class="btn btn-block btn-primary" href="{{ url('/admin/addcms') }}"> Add Cms Page</a>
                                        </h3>-->


                </div>
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">


                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
<!--                            <th>Email</th>
                            <th>Role</th>
                            <th>Add Date</th>
                            <th>Status</th>-->
                            <th >Action</th>                
                        </tr>


                        @foreach($data as $key => $result)

                        <tr>
                            <td>{{ $result->id }}</td>
                            <td>{{  str_replace("-"," ",$result->title) }}</td>
                            <td>
                                <a href='{{ url("/admin/cms/edit",$result->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
<!--                                <a href="javascript:void(0)" onclick="deleteRecord('{{$result->id}}',  'cms','delete', this, 0)" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>                                -->
                            </td>  

                        </tr>   

                        @endforeach    

                        @if(sizeof($data)==0)
                        <tr><td colspan="4" style="text-align:center">no record found</td></tr>
                        @endif


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
</section>


@endsection
@section('scripts')

@stop