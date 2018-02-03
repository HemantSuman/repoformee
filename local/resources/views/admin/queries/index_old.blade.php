@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Inbox & Support Tickets
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
                {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'id' => 'QueryFilterByType')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}   
                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::select('type', ['inbox' => 'Inbox Queries', 'support_query' => 'Support Queries'], array('id' => $requestVal), ['class' => 'form-control filterByQueryType', 'placeholder' => 'Select...']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

                {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'id' => 'QueryFilterByType')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}
                <div class="col-sm-5 pull-right">
                    <div class="input-group input-group-sm">
                        {!! Form::text('name', '', array('placeholder' => 'Search by name...', 'class' => 'form-control')) !!}
                        <!-- <input type="text" class="form-control" placeholder="Search by name..."> -->
                        <span class="input-group-btn">
                            {!! Form::submit('Go!', ['class' => 'btn btn-info btn-flat']) !!}
                            <!-- <button type="submit" class="btn btn-info btn-flat">Go!</button> -->
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
            <div class="box">  
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- _________ START __________ -->
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            
                            @foreach($data as $key => $single)
                            <div class="post">
                                <div class="user-block">
                                    <img src="{{ URL::asset('plugins/admin/dist/img/user1-128x128.jpg') }}" class="img-circle" alt="User Image">
                                    <span class="username">
                                        <a href="{{ URL('admin/queries/chat').'/'.$single->id }}">{{ $single->name }}</a>
                                    </span>
                                </div>
                                <p>{{ $single->query }}</p>


                                {!! Form::open(array("url" => "admin/$viewName/query-respond", 'method'=>'post', "class" => "form-horizontal")) !!}          
                                    {!! Form::hidden('query_id', $single->id) !!}
                                    <div class="form-group margin-bottom-none">
                                        <div class="col-sm-9">
                                            {!! Form::text('respond', '', array('placeholder' => 'Type Message ...', 'class' => 'form-control input-sm')) !!}
                                        </div>
                                        <div class="col-sm-3">
                                            {!! Form::submit('Send', ['class' => 'btn btn-danger pull-right btn-block btn-sm']) !!}
                                        </div>
                                    </div>
                                    <div class="error-message">{{$errors->first('respond')}}</div>
                                {!! Form::close() !!}

                                <!-- <form class="form-horizontal">
                                    <div class="form-group margin-bottom-none">
                                        <div class="col-sm-9">
                                            <input class="form-control input-sm" placeholder="Response">
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                                        </div>
                                    </div>
                                </form> -->
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- _________ END __________ -->

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
    $(document).on('change', '.filterByQueryType', function () {
        $("#QueryFilterByType").submit();
    });
</script>
@stop
