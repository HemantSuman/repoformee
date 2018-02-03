@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>

        Settings
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Settings</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <?php /* <h3 class="box-title"><a href='{{ url("/admin/settings/add") }}' class="btn btn-block btn-primary">Add New Key</a></h3> */ ?>
                </div>

                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                <?php
                $radius = array();
                $classified = array();
                foreach ($result as $key => $val) {
                    if ($key == 'Default-Search-Radius') {
                        $radius = array(
                            $key => $val,
                        );
                    } elseif ($key == 'classified-listing-top-ad-max-images' || $key == 'Feature-Classified-Day' || $key == 'Trending-Classified-hours' || $key == 'classified-detail-bottom-ad-max-images' || $key == 'classified-listing-bottom-ad-max-images' || $key == 'classified-detail-right-ad-max-images' || $key == 'classified-listing-right-ad-max-images' || $key == 'Unfeature-Classified-Day' || $key == 'classified-detail-top-ad-max-images' || $key == 'Recent-Classified-hours') {
                        $classified[] = array(
                            $key => $val,
                        );
                    } else {
                        $general[] = array(
                            $key => $val,
                        );
                    }
                }
                //dd($classified);
                ?>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered table-icon">

                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th>Actions</th>                  
                        </tr>
                        <tr>
                            <td  style="font-weight: bold; background-color: #ecf0f5"colspan="9">
                                RADIUS (km)
                            </td>
                        </tr>
                        @foreach($radius as $key=>$val)

                        <tr>
                            <td>{!! $key; !!}</td>
                            <td>{!! $val; !!}</td>
                            <td>
                                <a href='{!! url("/admin/settings/edit",$key) !!}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>   
                        @endforeach
                        <tr>
                            <td  style="font-weight: bold; background-color: #ecf0f5"colspan="9">
                                CLASSIFIEDS
                            </td>
                        </tr>
                        @foreach($classified as $key=>$val)

                        <tr>
                            <td>{!! key($val); !!}</td>
                            <td>{!! $val[key($val)]; !!}</td>
                            <td>
                                <a href='{!! url("/admin/settings/edit",key($val)) !!}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>   
                        @endforeach
                        <tr>
                            <td  style="font-weight: bold; background-color: #ecf0f5"colspan="9">
                                GENERAL
                            </td>
                        </tr>
                        @if(!empty($general))
                        @foreach($general as $key=>$val)

                        <tr>
                            <td>{!! key($val); !!}</td>
                            <td>{!! $val[key($val)]; !!}</td>
                            <td>
                                <a href='{!! url("/admin/settings/edit",key($val)) !!}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>   
                        @endforeach
                        @endif
                        <tr>
                            <td  style="font-weight: bold; background-color: #ecf0f5"colspan="9">
                                Change Admin Email
                            </td>
                        </tr>
                        {!! Form::open(array("url" => "admin/admin_changeemail", "role" => "form", 'id' => 'update-email-form', 'novalidate')) !!}
                        <tr>
                            <td> Current E-mail:</td>
                            <td>
                                <input type="email" name="current_email" value="{!! $user_details->email !!}" placeholder="Your current email address" class="form-control current_email" readonly>
                                <input type="hidden" name="user_id" value="{!! $user_details->id !!}"  class="form-control" >
                    
                            </td>
                        </tr>
                        <tr>
                            <td> New E-mail:</td>
                            <td>
                            <input type="email" name="new_email" value="" placeholder="New Email Address" class="form-control new_email">
                            <div class="error-message">{{$errors->first('new_email')}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td>
                            <button type="submit" name="button" class="btn">Change Email</button>
                            </td>
                        </tr>
                        {!! Form::close() !!}
                        
                        <tr>
                            <td  style="font-weight: bold; background-color: #ecf0f5"colspan="9">
                                Change Admin Password
                            </td>
                        </tr>
                        {!! Form::open(array("url" => "admin/admin_changpassword", "role" => "form", 'id' => 'update-email-form', 'novalidate')) !!}
                        <tr>
                            <td> Enter Current Password:</td>
                            <td>
                                <input type="password" name="current_password" placeholder="Enter Current Password" class="form-control current_password">
                                <input type="hidden" name="user_id" value="{!! $user_details->id !!}"  class="form-control" >
                                <input type="hidden" name="checkcurrentpassword" value="{!! $user_details->password !!}"  class="form-control" >
                    
                            </td>
                        </tr>
                        <tr>
                            <td> Enter new Password:</td>
                            <td>
                            <input type="password" name="new_password" placeholder="Enter new Password" class="form-control new_password">
                            <div class="error-message">{{$errors->first('new_password')}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td> Confirm Password:</td>
                            <td>
                            <input type="password" name="confirm_new_password" placeholder="Re-Enter new password" class="form-control confirm_new_password">    
                            <div class="error-message">{{$errors->first('confirm_new_password')}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td>
                            <button type="submit" name="button" class="btn">Change Password</button>
                            </td>
                        </tr>
                        {!! Form::close() !!}
                        
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                </td>
                            </tr>
                        </tfoot>
                    </table>


<!--                    <table class="table table-hover table-bordered table-icon">

                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th>Actions</th>                  
                        </tr>
                        @foreach($result as $key=>$val)
                        @if($key=='Default-Search-Radius')

                        <tr>
                            <td  style="font-weight: bold;"colspan="9">
                                Radius
                            </td>
                        </tr>
                        <tr>
                            <td>{!! $key; !!}</td>
                            <td>{!! $val; !!}</td>
                            <td>
                                <a href='{!! url("/admin/settings/edit",$key) !!}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>   

                        @elseif($key=='classified-listing-top-ad-max-images'|| $key=='Feature-Classified-Day'|| $key=='Trending-Classified-hours'|| $key=='classified-detail-bottom-ad-max-images'|| $key=='classified-listing-bottom-ad-max-images'|| $key=='classified-detail-right-ad-max-images'|| $key=='classified-listing-right-ad-max-images'|| $key=='Unfeature-Classified-Day'|| $key=='classified-detail-top-ad-max-images'|| $key=='Recent-Classified-hours')
                        <tr>
                            <td  style="font-weight: bold;" colspan="9">
                                Classified
                            </td>
                        </tr>
                        <tr>
                            <td>{!! $key; !!}</td>
                            <td>{!! $val; !!}</td>
                            <td>
                                <a href='{!! url("/admin/settings/edit",$key) !!}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>   
                        @else
                        <tr>
                            <td style="font-weight: bold;" colspan="9">
                               General
                            </td>
                        </tr>
                        <tr>
                            <td>{!! $key; !!}</td>
                            <td>{!! $val; !!}</td>
                            <td>
                                <a href='{!! url("/admin/settings/edit",$key) !!}' class="btn btn-info" title="Edit Record"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>   

                        @endif

                        @endforeach 
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                </td>
                            </tr>
                        </tfoot>
                    </table>-->

                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
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


</script>
@stop