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
        <div class="col-md-3">
          
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Queries</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked"> <?php
                        $activeQueryClass = "";
                        if(!empty(Request::query('type'))) {
                            $activeQueryClass = Request::query('type');
                        } ?>
                        <li class="<?php echo ($activeQueryClass == "inbox") ? "active" : null; ?>">
                            <a href="?type=inbox"><i class="fa fa-inbox"></i> Inbox Queries</a>
                        </li>
                        <li class="<?php echo ($activeQueryClass == "support_query") ? "active" : null; ?>">
                            <a href="?type=support_query"><i class="fa fa-file-text-o"></i> Support Queries</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                {!! Form::open(array("url" => "admin/$viewName", 'method'=>'post', "role" => "form", 'id' => 'QueryFilterByType')) !!}
                <div class="box-header with-border">
                    <h3 class="box-title">Inbox</h3>
                              
                    {!! Form::hidden('form_search', 'form_search') !!}
                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            {!! Form::text('name', null, array('placeholder' => 'Search by name...', 'class' => 'form-control input-sm')) !!}
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                    
                </div>
                {!! Form::close() !!}

                <div class="box-body no-padding">
                    
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                                @foreach($data as $key => $single)
                                <tr>
                                    <td class="mailbox-name"><a href="{{ URL('admin/queries/chat').'/'.$single->id }}">{{ $single->name }}</a></td>
                                    <td class="mailbox-subject"><a href="{{ URL('admin/queries/chat').'/'.$single->id }}"><b>{{ ($single->type == "inbox" ? "Inbox Query" : "Support Query") }}</b> - {{ str_limit($single->contact_query, 25) }}...</a></td>
                                    <td class="mailbox-date"><a href="{{ URL('admin/queries/chat').'/'.$single->id }}">{!! Helper::time_since(time() - strtotime($single->created_at)) !!} ago</a></td>
                                </tr>
                                @endforeach

                                @if(sizeof($data) == 0)
                                <tr>
                                    <td colspan="3">No record found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php /* {!! $data->render() !!} */ ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
<script type="text/javascript">
    $(document).on('change', '.filterByQueryType', function () {
        $("#QueryFilterByType").submit();
    });
</script>
@stop
