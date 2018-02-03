@extends('admin/layout/common')
@section('content')


<!-- Content Header (Page header) -->

<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="{{ url('/admin/classifieds') }}">
                <div class="small-box bg-aqua">

                    <div class="inner">
                        <h3>{{ $total_active_classifieds }}</h3>
                        <p>Total Classified Ads</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="{{ url('/admin/queries') }}">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $total_messages }}</h3>
                        <p>Total Messages</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $unique_visitors}}</h3>
                    <p>Total Visiter User</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="{{ url('/admin/register_user') }}">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{ $registered_user}}</h3>
                        <p>Total Registered User</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ url('/admin/classifieds') }}">
              <div class="info-box">
                  <span class="info-box-icon bg-aqua"></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Classified Ads</span>
                      <span class="info-box-number">{{ $total_active_classifieds }}</span>
                  </div>
              </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ url('/admin/queries') }}">
            <div class="info-box">
                <span class="info-box-icon bg-red"></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Messages</span>
                    <span class="info-box-number">{{ $total_messages }}</span>
                </div>

            </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Visiter User</span>
                    <span class="info-box-number">{{ $unique_visitors}}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ url('/admin/register_user') }}">
            <div class="info-box">
                <span class="info-box-icon bg-orange"></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Registered User</span>
                    <span class="info-box-number">{{ $registered_user}}</span>
                </div>

            </div>
            </a>
        </div> -->

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="{{ url('/admin/classifieds') }}">
                            <h3 class="box-title">Recently Posted Classifieds</h3>
                        </a>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category Name</th>
                                <th> Sub Category Name</th>
                                <th> User Name</th>
                                <th>Status</th>
                                <th>Add Date</th>                  
                                <th>Actions</th>                  
                            </tr>

                            @foreach($recentclassifids as $key=>$val)

                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ $val->title }}</td>
                                <td>{{ $val->category_name }}</td>
                                <td>{{ $val->cat_c_name }}</td>
                                <td>{{ $val->username }}</td>
                                <td><span class="label label-<?php if ($val->status == 0) { ?>danger<?php } else { ?>success<?php } ?>">
                                        @if($val->status==0) Inactive @else Active @endif</span>
                                </td>

                                <td>{{@date('d-M-Y',strtotime($val->created_at))}}</td>

                                <td><a href='{{ url("/admin/classifieds/edit",$val->id) }}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                    <a href='{{ url("/admin/classifieds/view",$val->id) }}' class="btn btn-info" title="View Record"><i class="fa fa-eye"></i></a> 
                                    <a href="javascript:void(0)" onclick="deleteRecord('{{$val->id}}', 'classifieds', 'admin_delete', this, '')" class="btn btn-warning" title="Delete Record"><i class="fa fa-trash"></i></a>
                                </td>

                            </tr>   

                            @endforeach    

                            @if(sizeof($recentclassifids)==0)
                            <tr><td colspan="9" style="text-align:center">no record found</td></tr>
                            @endif
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary with-border">
                <div class="box-header with-border">
                    <a href="{{ url('/admin/register_user') }}">
                        <h3 class="box-title">Latest Members</h3>
                    </a>
                </div>



                <div class="box-body recent-users">
                    <ul>

                        @foreach($recentusers as $key=>$val)
                        <li>
                            <a href="{{ url('/admin/register_user') }}">
                                <span class="user-img">
                                    @if(($val->image))
                                    <img src="{{ URL::asset('upload_images/users/'.$val->id.'/'.$val->image) }}" alt="profile-img-new">

                                    @elseif($val->avatar)
                                    <img src="{{ $val->avatar }}" alt="profile-img-new">
                                    @else
                                    <img src="{{ URL::asset('plugins/front/img/profile-img-new.jpg') }}" alt="profile-img">
                                    @endif
                                </span>
                                <span class="user-name">{{$val->name}}</span>
                            </a>
                        </li> 
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 ">
            <div class="box box-primary with-border">
                <div class="box-header with-border">
                    <a href="{{ url('/admin/queries') }}">
                        <h3 class="box-title">Latest Queries</h3>
                    </a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th>Query Name</th>
                                <th>Title</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($recenqueries as $key => $single)
                            <tr>
                                <td class="mailbox-name"><b>{{ $single->name }}</b></td>
                                <td class="mailbox-subject"><b>{{ ($single->type == "inbox" ? "Inbox Query" : "Support Query") }}</b> - {{ str_limit($single->contact_query, 25) }}...</td>
                                <td class="mailbox-date">{!! Helper::time_since(time() - strtotime($single->created_at)) !!} ago</td>
                                <td><a class="btn btn-info" href="{{ URL('admin/queries/chat').'/'.$single->id }}">Reply</a></td>
                            </tr>
                            @endforeach

                            @if(sizeof($recenqueries) == 0)
                            <tr>
                                <td colspan="3">No record found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">



            <div class="box box-primary with-border">
                <div class="box-header with-border">
                    <div class="form-group row">
                        <label class="col-sm-3 control-label"> Graph Type</label>
                        <div class="col-sm-9">

                            {!! Form::radio('report_durationpost', 'Daily', false,array('class'=>'Custompost')) !!} Daily
                            {!!Form::radio('report_durationpost', 'weekly',false,array('class'=>'Custompost')) !!} weekly
                            {!!Form::radio('report_durationpost', 'Monthly',true,array('class'=>'Custompost')) !!} Monthly
                            {!!Form::radio('report_durationpost', 'Custom' ,false,array('class'=>'Custompost')) !!} Custom


                        </div>
                    </div>
                    <div class="box-body border-radius-none">
                        <div class="box-header ui-sortable-handle" style="cursor: move;">
                            <i class="fa fa-th"></i>

                            <h3 class="box-title">Most Posted Category</h3>



                        </div>
                        <div class="box-body">
                            <div class="scaley">Total No. of Post</div>
                            <div id="bar-chart" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" width="478" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 478px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 22px; text-align: center;">January</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 99px; text-align: center;">February</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 185px; text-align: center;">March</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 267px; text-align: center;">April</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 347px; text-align: center;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 424px; text-align: center;">June</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 270px; left: 7px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 203px; left: 7px; text-align: right;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 135px; left: 1px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 68px; left: 1px; text-align: right;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">20</div></div></div><canvas class="flot-overlay" width="478" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 478px; height: 300px;"></canvas></div>
                        </div>
                        <div class="scalex">Categories</div>
                        <div class="report"> <i class="ion-stats-bars"></i> <span class="reportname">Month </span> Report</div>
                        <div class="box-footer no-border">

                        </div>

                    </div>
                </div>

            </div>








        </div>

        <div class="col-md-6">



            <div class="box box-primary with-border">
                <div class="box-header with-border">
                    <div class="form-group row">
                        <label class="col-sm-3 control-label"> Graph Type </label>
                        <div class="col-sm-9">

                            {!! Form::radio('report_durationview', 'Daily', false,array('class'=>'Customview')) !!} Daily
                            {!!Form::radio('report_durationview', 'weekly',false,array('class'=>'Customview')) !!} weekly
                            {!!Form::radio('report_durationview', 'Monthly',true,array('class'=>'Customview')) !!} Monthly
                            {!!Form::radio('report_durationview', 'Custom' ,false,array('class'=>'Customview')) !!} Custom


                        </div>
                    </div>
                    <div class="box-body border-radius-none">
                        <div class="box-header ui-sortable-handle" style="cursor: move;">
                            <i class="fa fa-th"></i>

                            <h3 class="box-title">Most View Category</h3>

                            <!--                    <div class="box-tools pull-right">
                                                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                                    </button>
                                                </div>-->

                        </div>
                        <div class="box-body">
                            <div class="scaley">Total No. of Views</div>
                            <div id="bar-chart1" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" width="478" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 478px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 22px; text-align: center;">January</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 99px; text-align: center;">February</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 185px; text-align: center;">March</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 267px; text-align: center;">April</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 347px; text-align: center;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 424px; text-align: center;">June</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 270px; left: 7px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 203px; left: 7px; text-align: right;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 135px; left: 1px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 68px; left: 1px; text-align: right;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">20</div></div></div><canvas class="flot-overlay" width="478" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 478px; height: 300px;"></canvas></div>
                            <div class="scalex">Categories</div>
                            <div class="report"><i class="ion-stats-bars"></i> <span class="reportname1">Month </span> Report</div>
                        </div>
                        <!--                <div class="box-body border-radius-none">
                                            <div class="chart" id="line-chart" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="250" version="1.1" width="390" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; top: -0.59375px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="40" y="214" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: 'Open Sans';" font-size="10px" font-family="Open Sans" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#efefef" d="M52.5,214H365" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="40" y="166.75" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: 'Open Sans';" font-size="10px" font-family="Open Sans" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">5,000</tspan></text><path fill="none" stroke="#efefef" d="M52.5,166.75H365" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="40" y="119.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: 'Open Sans';" font-size="10px" font-family="Open Sans" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">10,000</tspan></text><path fill="none" stroke="#efefef" d="M52.5,119.5H365" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="40" y="72.25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: 'Open Sans';" font-size="10px" font-family="Open Sans" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">15,000</tspan></text><path fill="none" stroke="#efefef" d="M52.5,72.25H365" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="40" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: 'Open Sans';" font-size="10px" font-family="Open Sans" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">20,000</tspan></text><path fill="none" stroke="#efefef" d="M52.5,25H365" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="307.6640340218712" y="226.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: 'Open Sans';" font-size="10px" font-family="Open Sans" font-weight="normal" transform="matrix(1,0,0,1,0,5.5)"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan></text><text x="168.69076549210206" y="226.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: 'Open Sans';" font-size="10px" font-family="Open Sans" font-weight="normal" transform="matrix(1,0,0,1,0,5.5)"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan></text><path fill="none" stroke="#efefef" d="M52.5,188.8063C61.233292831105715,188.5417,78.69987849331713,190.4009875,87.43317132442284,187.74790000000002C96.16646415552856,185.09481250000002,113.63304981773997,168.75624016393445,122.36634264884569,167.5816C131.00470838396112,166.41972766393442,148.281439854192,180.6438625,156.91980558930743,178.40185C165.55817132442286,176.1598375,182.83490279465371,151.8811350409836,191.47326852976914,149.6455C200.20656136087484,147.3852975409836,217.67314702308627,158.0678125,226.40643985419197,160.4185C235.1397326852977,162.7691875,252.60631834750913,179.6189893442623,261.33961117861486,168.451C269.9779769137303,157.4044018442623,287.25470838396114,78.52883321823204,295.8930741190766,71.56015C304.43651275820173,64.66804571823204,321.523390036452,105.24937403846155,330.06682867557714,113.00785C338.80012150668284,120.93873653846155,356.2667071688943,128.9901625,365,134.3176" stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="52.5" cy="188.8063" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="87.43317132442284" cy="187.74790000000002" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="122.36634264884569" cy="167.5816" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="156.91980558930743" cy="178.40185" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="191.47326852976914" cy="149.6455" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="226.40643985419197" cy="160.4185" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="261.33961117861486" cy="168.451" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="295.8930741190766" cy="71.56015" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="330.06682867557714" cy="113.00785" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="365" cy="134.3176" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="left: 297px; top: 60px; display: none;"><div class="morris-hover-row-label">2013 Q2</div><div class="morris-hover-point" style="color: #efefef">
                                                        Item 1:
                                                        8,432
                                                    </div></div></div>
                                        </div>-->

                        <div class="box-footer no-border">

                        </div>

                    </div>
                </div>

            </div>


            <!--            <div class="box box-primary">
                        <div class="box-header with-border">
                          <i class="fa fa-bar-chart-o"></i>
            
                          <h3 class="box-title">Bar Chart</h3>
            
                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                          <div id="bar-chart" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" width="478" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 478px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 22px; text-align: center;">January</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 99px; text-align: center;">February</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 185px; text-align: center;">March</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 267px; text-align: center;">April</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 347px; text-align: center;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 79px; top: 283px; left: 424px; text-align: center;">June</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 270px; left: 7px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 203px; left: 7px; text-align: right;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 135px; left: 1px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 68px; left: 1px; text-align: right;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">20</div></div></div><canvas class="flot-overlay" width="478" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 478px; height: 300px;"></canvas></div>
                        </div>
                         /.box-body
                      </div>-->





        </div>
    </div>
    <div class="modal" id="customdate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Custom Report</h4>
                </div>
                <div class="modal-body message">
                    <div class="form-group">
                        <input type="text" name="start_date" class="form-control pull-right strDt" id="rprt_start_date" placeholder="Click here to select">
                    </div>
                </div>
                <div class="modal-body message"> 
                    <div class="form-group">
                        <input type="text" name="end_date" class="form-control pull-right endDt" id="rprt_end_date" placeholder="Click here to select">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary customdatesave" >Send</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</section>

<?php
//foreach($mostpostedrepoartata as $key=>$value)
//{
//    //dd($value);
//    $label[]=$value->labels;
//    $data[]=$value->data;
//}
//dd($label);
//$comma_separated = implode(",", $label);
//dd($comma_separated);
//$string2 =implode(', ', $comma_separated);
//$string2 = join(', ', $comma_separated);
//dd($string2);
?>

@stop
@section('scripts')
<style>
    #rprt_start_date {
        z-index: 1600 !important; /* has to be larger than 1050 */
    }
    #ui-datepicker-div{
        z-index: +3;
    }

    #customdate{
        z-index: +2;
    }
    .modal-backdrop{
        z-index: +1;
    }
    .report{
        text-align: center;
        font-weight: 700;
        color: #ef4b23;
    }
    .report i{
        font-size: 24px;
        margin-right: 5px;
        display: inline-block;
        vertical-align: middle;
    }
    .scalex,
    .scaley{
        font-weight: 600;
    }
</style>
<script>

    $(function () {
    getcustompost();
    getcustomview();
    $("#rprt_start_date").datepicker();
    $("#rprt_end_date").datepicker();
    });
    $(document).on("change", ".Custompost", function (event) {
    
    var checkname = $('input[name=report_durationpost]:checked').val();
    
    if (checkname == 'Custom')
    {
    //alert(checkname);
    $('#customdate').modal('show');
    $(document).on('click', '.customdatesave', function (e) {

    var checkname = $('input[name=report_durationview]:checked').val();
    var start_date = $('#rprt_start_date').val();
    var end_date = $('#rprt_end_date').val();
    if (start_date == '')
    {
    Notify.showMessage('Please add Start date', 'warning');
    return false;
    // Notify.showNotification('Please add message', "error");
    }
    if (end_date == '')
    {
    Notify.showMessage('Please add End Date', 'warning');
    return false;
    // Notify.showNotification('Please add message', "error");
    }
    if (new Date($("#rprt_start_date").val()) > new Date()) {
        Notify.showMessage('From Date should be less than or equal to current date', 'warning');
    return false;
        }
    if (new Date($("#rprt_end_date").val()) > new Date()) {
        Notify.showMessage('To Date should be less than or equal to current date', 'warning');
    return false;
        }
        
        if (new Date($("#rprt_end_date").val()) < new Date($("#rprt_start_date").val())) {
        Notify.showMessage('To Date should be greater than or equal to from date', 'warning');
    return false;
        }
    $.ajax({
            url: root_url + '/admin/site-reports/post-categorygraph',
                    data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                            "duration": checkname,
                            "start_date": start_date,
                    "end_date": end_date,
                    },
                    method: "POST",
                    cache: false,
                    dataType:"json",
                    success: function (response) {
                    // alert(response);
                    $('#rprt_start_date').val('');
            $('#rprt_end_date').val('');
            $('.close').click();
                    var datas = [];
                    $.each(response, function (index, value) {
                    datas.push([value.name, value.total]);
                    });
                    var bar_data = {
                    //data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
                    data: datas,
                            color: "#3c8dbc"
                    };
                    console.log(bar_data);
                    $.plot("#bar-chart", [bar_data], {
                    grid: {
                    borderWidth: 1,
                            borderColor: "#f3f3f3",
                            tickColor: "#f3f3f3"
                    },
                            series: {
                            bars: {
                            show: true,
                                    barWidth: 0.5,
                                    align: "center"
                            }
                            },
                            xaxis: {
                            mode: "categories",
                                    tickLength: 0
                            }

                    });
                    //$("#clsfd-fltrd-data").html(response);
                    }
            });
    
//    $.ajax({
//    url: root_url + '/admin/site-reports/view-categorygraph',
//            data: {
//            "_token": $('meta[name="csrf-token"]').attr('content'),
//                    "duration": checkname,
//                    "start_date": start_date,
//                    "end_date": end_date,
//            },
//            method: "POST",
//            cache: false,
//            dataType:"json",
//            success: function (response) {
//            // alert(response);
//            $('#rprt_start_date').val('');
//            $('#rprt_end_date').val('');
//            $('.close').click();
//            var datas = [];
//            $.each(response, function (index, value) {
//            datas.push([value.name, value.total]);
//            });
//            var bar_data = {
//            //data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
//            data: datas,
//                    color: "#3c8dbc"
//            };
//            console.log(bar_data);
//            $.plot("#bar-chart1", [bar_data], {
//            grid: {
//            borderWidth: 1,
//                    borderColor: "#f3f3f3",
//                    tickColor: "#f3f3f3"
//            },
//                    series: {
//                    bars: {
//                    show: true,
//                            barWidth: 0.5,
//                            align: "center"
//                    }
//                    },
//                    xaxis: {
//                    mode: "categories",
//                            tickLength: 0
//                    },
//            });
//            //$("#clsfd-fltrd-data").html(response);
//            }
//    });
    
    });
    }
    $('.reportname').html(checkname)
            
            getcustompost();
    })

            $(document).on("change", ".Customview", function (event) {
    //var checkname = $(this).is(':checked').text();
    var checkname = $('input[name=report_durationview]:checked').val();
    if (checkname == 'Custom')
    {
    //alert(checkname);
    $('#customdate').modal('show');
    $(document).on('click', '.customdatesave', function (e) {

    var checkname = $('input[name=report_durationview]:checked').val();
    var start_date = $('#rprt_start_date').val();
    var end_date = $('#rprt_end_date').val();
    if (start_date == '')
    {
    Notify.showMessage('Please add Start date', 'warning');
    return false;
    // Notify.showNotification('Please add message', "error");
    }
    if (end_date == '')
    {
    Notify.showMessage('Please add End Date', 'warning');
    return false;
    // Notify.showNotification('Please add message', "error");
    }
    //alert(checkname);
    //event.preventDefault();
    $.ajax({
    url: root_url + '/admin/site-reports/view-categorygraph',
            data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
                    "duration": checkname,
                    "start_date": start_date,
                    "end_date": end_date,
            },
            method: "POST",
            cache: false,
            dataType:"json",
            success: function (response) {
            // alert(response);
            $('#rprt_start_date').val('');
            $('#rprt_end_date').val('');
            $('.close').click();
            var datas = [];
            $.each(response, function (index, value) {
            datas.push([value.name, value.total]);
            });
            var bar_data = {
            //data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
            data: datas,
                    color: "#3c8dbc"
            };
            console.log(bar_data);
            $.plot("#bar-chart1", [bar_data], {
            grid: {
            borderWidth: 1,
                    borderColor: "#f3f3f3",
                    tickColor: "#f3f3f3"
            },
                    series: {
                    bars: {
                    show: true,
                            barWidth: 0.5,
                            align: "center"
                    }
                    },
                    xaxis: {
                    mode: "categories",
                            tickLength: 0
                    },
            });
            //$("#clsfd-fltrd-data").html(response);
            }
    });
    });
    }
    $('.reportname1').html(checkname)
            //alert(checkname);
            //event.preventDefault();
            getcustomview();
    })

            function getcustompost()
            {
            var checkname = $('input[name=report_durationpost]:checked').val();
            //alert(checkname);
            //event.preventDefault();
            $.ajax({
            url: root_url + '/admin/site-reports/post-categorygraph',
                    data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                            "duration": checkname,
                    },
                    method: "POST",
                    cache: false,
                    dataType:"json",
                    success: function (response) {
                    // alert(response);
                    var datas = [];
                    $.each(response, function (index, value) {
                    datas.push([value.name, value.total]);
                    });
                    var bar_data = {
                    //data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
                    data: datas,
                            color: "#3c8dbc"
                    };
                    console.log(bar_data);
                    $.plot("#bar-chart", [bar_data], {
                    grid: {
                    borderWidth: 1,
                            borderColor: "#f3f3f3",
                            tickColor: "#f3f3f3"
                    },
                            series: {
                            bars: {
                            show: true,
                                    barWidth: 0.5,
                                    align: "center"
                            }
                            },
                            xaxis: {
                            mode: "categories",
                                    tickLength: 0
                            }

                    });
                    //$("#clsfd-fltrd-data").html(response);
                    }
            });
            }

    function getcustomview()
    {
    var checkname = $('input[name=report_durationview]:checked').val();
    //alert(checkname);
    //event.preventDefault();
    $.ajax({
    url: root_url + '/admin/site-reports/view-categorygraph',
            data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
                    "duration": checkname,
            },
            method: "POST",
            cache: false,
            dataType:"json",
            success: function (response) {
            // alert(response);
            var datas = [];
            $.each(response, function (index, value) {
            datas.push([value.name, value.total]);
            });
            var bar_data = {
            //data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
            data: datas,
                    color: "#3c8dbc"
            };
            console.log(bar_data);
            $.plot("#bar-chart1", [bar_data], {
            grid: {
            borderWidth: 1,
                    borderColor: "#f3f3f3",
                    tickColor: "#f3f3f3"
            },
                    series: {
                    bars: {
                    show: true,
                            barWidth: 0.5,
                            align: "center"
                    }
                    },
                    xaxis: {
                    mode: "categories",
                            tickLength: 0
                    },
                    options: {
                    scales: {
                    xAxes: [{
                    stacked: true
                    }],
                            yAxes: [{
                            stacked: true
                            }]
                    }
                    }
//                    options: {
//        scales: {
//            xaxis: [{
//                ticks: {
//                    beginAtZero:true
//                },
//                scaleLabel: {
//                    display: true,
//                    labelString: '1k = 1000'
//                }
//            }]
//        }
//    }


            });
            //$("#clsfd-fltrd-data").html(response);
            }
    });
    }
</script>   
<!--<script>
    var label = <?php //echo json_encode($label);   ?>;
    var datavalues = <?php //echo json_encode($data);    ?>
    //console.log(label);
   
var salesChartData = {
   labels: label,
   datasets: [
//      {
//        label: "Electronics",
//        fillColor: "rgb(210, 214, 222)",
//        strokeColor: "rgb(210, 214, 222)",
//        pointColor: "rgb(210, 214, 222)",
//        pointStrokeColor: "#c1c7d1",
//        pointHighlightFill: "#fff",
//        pointHighlightStroke: "rgb(220,220,220)",
//        data: [65, 59, 80, 81, 56, 55, 40]
//      },
     {
       label: "Digital Goods",
       fillColor: "rgba(60,141,188,0.9)",
       strokeColor: "rgba(60,141,188,0.8)",
       pointColor: "#3b8bba",
       pointStrokeColor: "rgba(60,141,188,1)",
       pointHighlightFill: "#fff",
       pointHighlightStroke: "rgba(60,141,188,1)",
       //data: [65, 59, 80, 81, 56, 55, 40]
       data: datavalues
      
     }
   ]
 };
</script>-->

@stop