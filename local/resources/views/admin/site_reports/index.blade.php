@extends('admin/layout/common')
@section('content')

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
    <!--    <div class="row">
            <div class="col-lg-3 col-xs-6">
             small box 
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h4><strong>{{ strtoupper($most_posted_classified_category['category']). " (".$most_posted_classified_category['total_classified'].")" }}</strong></h4>
                        <p>Most Posted Classified Category</p>
                    </div>
                </div>
            </div>
             ./col 
            <div class="col-lg-3 col-xs-6">
             small box 
                <div class="small-box bg-green">
                    <div class="inner">
                        <h4><strong>{{ strtoupper($most_viewed_classified_category['category'])." (".$most_viewed_classified_category['total_views'].")" }}</strong></h4>
                        <p>Most Viewed Classified Category</p>
                    </div>
                </div>
            </div>
             ./col 
            <div class="col-lg-3 col-xs-6">
             small box 
                <div class="small-box bg-red">
                    <div class="inner">
                        <h4><strong>{{ $unique_visitors }}</strong></h4>
                        <p>Unique Visitors</p>
                    </div>
              </div>
            </div>
        </div>-->

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Report Manager</h3>
                </div>

                {!! Form::open(array("role" => "form", 'class' => 'form-horizontal clsfd-fltr-frm', 'method' => 'POST')) !!} 
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Report Type</label>
                        <?php
                        $reporttype = array(
                            'MostPostedClassifiedCategory' => 'Most Posted Classified Category',
                            'MostViewedClassifiedCategory' => 'Most Viewed Classified Category',
                            'AnalyticsofEachCategory' => 'Analytics of Each Category',
                            'Analyticsofsavesearch' => 'Analytics of Save Search',
                        );
                        ?>
                        <div class="col-sm-10">
                            {!! Form::select('report_type', $reporttype, null, array('class' => 'form-control pctId', 'placeholder' => 'Select Report Type', 'id' => 'reporttypeid') ) !!}
                            <div class="error-message reporttype_error">{{$errors->first('report_type')}}</div>
                        </div>
                    </div>
                    <div id="category_subcat">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                {!! Form::select('parent_category_id', $categories, null, array('class' => 'form-control pctId', 'placeholder' => 'Select Category', 'id' => 'parent_categoryid') ) !!}
                                <div class="error-message parent_category_id_error">{{$errors->first('parent_category_id')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sub Category</label>
                            <div class="col-sm-10">
                                {!! Form::select('subcategory_id', array(), null, array('class' => 'form-control sbctId', 'placeholder' => 'Select Sub Category', 'id' => 'sub_categories') ) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Reports </label>
                        <div class="col-sm-10">

                             {!! Form::radio('report_duration', 'Daily', true,array('class'=>'Custom')) !!} Daily
                             {!!Form::radio('report_duration', 'weekly',false,array('class'=>'Custom')) !!} weekly
                             {!!Form::radio('report_duration', 'Monthly',false,array('class'=>'Custom')) !!} Monthly
                             {!!Form::radio('report_duration', 'Custom' ,false,array('class'=>'Custom')) !!} Custom


                        </div>
                    </div>
                    <div class="customradio hide">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Start Date</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="start_date" class="form-control pull-right strDt" id="rprt_start_date" placeholder="Click here to select">
                                </div>
                                <div class="error-message start_date_error">{{$errors->first('start_date')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">End Date</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="end_date" class="form-control pull-right endDt" id="rprt_end_date" placeholder="Click here to select">
                                </div>
                                <div class="error-message end_date_error">{{$errors->first('end_date')}}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer col-sm-offset-2"> 
                    <button type="submit" class="btn btn-primary">Sumbit</button>
                </div>
                {!! Form::close() !!}
            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="" id="clsfd-fltrd-data">
                        <!-- <div class="box-header with-border">
                            <h3 class="box-title">Filter Data</h3>
                        </div> -->
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
            <!--            <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Generate Reports</h3>
                            </div>
            
                            {!! Form::open(array("role" => "form", "url" => "admin/site-reports/generatereport",'class' => 'form-horizontal clsfd-report-frm', 'method' => 'POST')) !!} 
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Report Type</label>
            <?php
            $reporttype = array(
                'MostPostedClassifiedCategory' => 'Most Posted Classified Category',
                'MostViewedClassifiedCategory' => 'Most Viewed Classified Category',
                'AnalyticsofEachCategory' => 'Analytics of Each Category',
                'Analyticsofsavesearch' => 'Analytics of Save Search',
            );
            ?>
                                        <div class="col-sm-10">
                                            {!! Form::select('report_type', $reporttype, null, array('class' => 'form-control pctId', 'placeholder' => 'Select Repoart Type', 'id' => 'reporttypeid') ) !!}
                                            <div class="error-message reporttype_error">{{$errors->first('report_type')}}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Start Date</label>
                                        <div class="col-sm-10">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="start_date" class="form-control pull-right strDt" id="rprtype_start_date" placeholder="Click here to select">
                                            </div>
                                            <div class="error-message start_date_reporterror">{{$errors->first('start_date')}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">End Date</label>
                                        <div class="col-sm-10">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="end_date" class="form-control pull-right endDt" id="rprtype_end_date" placeholder="Click here to select">
                                            </div>
                                            <div class="error-message end_date_reporterror">{{$errors->first('end_date')}}</div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="box-footer col-sm-offset-2"> 
                                    <button type="submit" class="btn btn-primary">Sumbit</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="" id="clsfd-report-frm">
                                     <div class="box-header with-border">
                                        <h3 class="box-title">Filter Data</h3>
                                    </div> 
                                     /.box-body 
                                </div>
                            </div>
                        </div>-->
        </div>
    </div>
</section>
<!-- /.content -->
@stop

@section('scripts')
<script type="text/javascript">

    $(document).ready(function () {
       // $("#customradio").hide();
        $("#category_subcat").css({display: "none"});
        $('#reporttypeid').change(function () {
            var selectedtext = $("#reporttypeid option:selected").val();
            $("#clsfd-fltrd-data").html('');
            console.log(selectedtext);
            if (selectedtext == 'AnalyticsofEachCategory')
            {
                $("#category_subcat").css({display: "block"});

            } else
            {
                $("#category_subcat").css({display: "none"});
            }
            //alert($("#reporttypeid option:selected").text());
        });
        $(".Custom").change(function () {
            if ($(this).is(':checked')&& $(this).val()=='Custom')
            {
                $(".customradio").removeClass('hide');
                $(".customradio").addClass('show');
               // alert($(this).val());
            }
            else
            {
               $(".customradio").addClass('hide');
            }
        });
    });
    $("#rprt_start_date").datepicker();

    $("#rprt_end_date").datepicker();

    $("#rprtype_start_date").datepicker();

    $("#rprtype_end_date").datepicker();


    BelongsToCommunities = [$.parseJSON('<?php echo json_encode($BelongsToCommunities); ?>')];
    var BelongsToCommunities1;

    $(".clsfd-fltr-frm").submit(function (event) {
        event.preventDefault();
        $(".error-message").text("");
        $("#clsfd-fltrd-data").html('');
        var status = true;
        if ($("#parent_categoryid").val() == "" && $("#reporttypeid option:selected").val() == "AnalyticsofEachCategory") {
            $(".parent_category_id_error").text("The Category field is required.");
            status = false;
        }
        if ($("#reporttypeid").val() == "") {
            $(".reporttype_error").text("The Report type field is required.");
            status = false;
        }
//        if ($("#rprt_start_date").val() == "") {
//            $(".start_date_error").text("The Start Date field is required.");
//            status = false;
//        }
//        if ($("#rprt_end_date").val() == "") {
//            $(".end_date_error").text("The End Date field is required.");
//            status = false;
//        } else if (new Date($("#rprt_end_date").val()) > new Date()) {
//            $(".end_date_error").text("End Date should not be greater than current date.");
//            status = false;
//        } else if (new Date($("#rprt_start_date").val()) > new Date($("#rprt_end_date").val())) {
//            //compare end <=, not >=    
//            $(".start_date_error").text("Start Date should not be greater than End Date.");
//            status = false;
//        }


        if (status) {
            $.ajax({
                url: $(this).attr("action"),
                data: $(this).serialize(),
                method: "POST",
                cache: false,
                success: function (response) {
                    $("#clsfd-fltrd-data").html(response);
                },
                // error: function (data) {
                //     var jsonData = $.parseJSON(data.responseText);
                //     if (jsonData.parent_category_id != '') {
                //         //Notify.showMessage(jsonData.parent_category_id[0], 'warning');
                //         $(".parent_category_id_error").text(jsonData.parent_category_id[0]);
                //     }
                //     if (jsonData.start_date != '') {
                //         //Notify.showMessage(jsonData.start_date[0], 'warning');
                //         $(".start_date_error").text(jsonData.start_date[0]);
                //     }
                //     if (jsonData.end_date != '') {
                //         //Notify.showMessage(jsonData.end_date[0], 'warning');
                //         $(".end_date_error").text(jsonData.end_date[0]);
                //     }
                // }
            });
        }
    })

    //clsfd-report-frm
    $(".clsfd-report-frm").submit(function (event) {
        event.preventDefault();
        $(".error-message").text("");
        var status = true;
        if ($("#reporttypeid").val() == "") {
            $(".reporttype_error").text("The Report type field is required.");
            status = false;
        }
        if ($("#rprtype_start_date").val() == "") {
            $(".start_date_reporterror").text("The Start Date field is required.");
            status = false;
        }
        if ($("#rprtype_end_date").val() == "") {
            $(".end_date_reporterror").text("The End Date field is required.");
            status = false;
        } else if (new Date($("#rprtype_end_date").val()) > new Date()) {
            $(".end_date_reporterror").text("End Date should not be greater than current date.");
            status = false;
        } else if (new Date($("#rprtype_start_date").val()) > new Date($("#rprtype_end_date").val())) {
            //compare end <=, not >=    
            $(".start_date_reporterror").text("Start Date should not be greater than End Date.");
            status = false;
        }


        if (status) {
            $.ajax({
                url: $(this).attr("action"),
                data: $(this).serialize(),
                method: "POST",
                cache: false,
                success: function (response) {
                    $("#clsfd-report-frm").html(response);
                },
                // error: function (data) {
                //     var jsonData = $.parseJSON(data.responseText);
                //     if (jsonData.parent_category_id != '') {
                //         //Notify.showMessage(jsonData.parent_category_id[0], 'warning');
                //         $(".parent_category_id_error").text(jsonData.parent_category_id[0]);
                //     }
                //     if (jsonData.start_date != '') {
                //         //Notify.showMessage(jsonData.start_date[0], 'warning');
                //         $(".start_date_error").text(jsonData.start_date[0]);
                //     }
                //     if (jsonData.end_date != '') {
                //         //Notify.showMessage(jsonData.end_date[0], 'warning');
                //         $(".end_date_error").text(jsonData.end_date[0]);
                //     }
                // }
            });
        }
    })
    //ajax for pagination on filtered data
    $(document).on("click", "ul.pagination li a", function (event) {
        event.preventDefault();
        console.log("pp");

        $.ajax({
            url: $(this).attr("href"),
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "parent_category_id": $(".pctId").val(),
                "subcategory_id": $(".sbctId").val(),
                "start_date": $(".strDt").val(),
                "end_date": $(".endDt").val()
            },
            method: "POST",
            cache: false,
            success: function (response) {
                $("#clsfd-fltrd-data").html(response);
            }
        });
    })

</script>
@stop
