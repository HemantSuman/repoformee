<!DOCTYPE html>
<html>
    <head>
        @include('admin/element/head') 
        <script>
            var root_url = "<?php echo Request::root(); ?>"
            var Feacture_Classified_Day = "<?php echo Redis::get('Feature-Classified-Day'); ?>"
            var Unfeacture_Classified_Day = "<?php echo Redis::get('Unfeature-Classified-Day'); ?>"
           var halalname = '<?php echo Redis::get('Halal Products');?>'
            
        </script>   
        <meta name="csrf-token" content="<?= csrf_token() ?>">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                @include('admin/element/header')    
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                @include('admin/element/sidebar')   
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @yield('content')    
            </div>

            @include('admin/element/footer')   
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.0 -->
        <script src="{{ URL::asset('plugins/admin/plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>

        <!-- Bootstrap 3.3.6 -->
        <script src="{{ URL::asset('plugins/admin/bootstrap/js/bootstrap.min.js') }}"></script>


        <!-- Jquery validator -->
        <script src="{{ URL::asset('plugins/admin/plugins/jquery-validator/jquery.validate.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ URL::asset('plugins/admin/plugins/select2/select2.full.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ URL::asset('plugins/admin/plugins/fastclick/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ URL::asset('plugins/admin/dist/js/app.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ URL::asset('plugins/admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
        <!-- jvectormap -->
        <script src="{{ URL::asset('plugins/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="{{ URL::asset('plugins/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <!-- ChartJS 1.0.1 --> 
        

        
    
        
        
        
        
        
        <script src="{{ URL::asset('plugins/admin/plugins/chartjs/Chart.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/admin/plugins/flot/jquery.flot.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/admin/plugins/flot/jquery.flot.categories.min.js') }}"></script>
    
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <?php /* <script src="{{ URL::asset('plugins/admin/dist/js/pages/dashboard2.js') }}"></script> */ ?>
        <!-- AdminLTE for demo purposes -->

        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script src="{{ URL::asset('plugins/admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
        <script src="{{ URL::asset('plugins/admin/plugins/datetimepicker/bootstrap-datetimepicker.js') }}"></script>
        <!-- bootstrap datepicker -->
        <script src="{{ URL::asset('plugins/admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
        <!-- iCheck 1.0.1 -->
        <script src="{{ URL::asset('plugins/admin/plugins/iCheck/icheck.min.js') }}"></script>
        <!-- iCheck 1.0.1 -->
        <script src="{{ URL::asset('plugins/admin/plugins/autosize-master/autosize.js') }}"></script>
        <!-- Bootstrap Switch -->
        <script src="{{ URL::asset('plugins/admin/plugins/bootstrap-switch/bootstrap-switch.js') }}"></script>
        <script src="{{ URL::asset('plugins/admin/dist/js/demo.js') }}"></script>
        <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
        <script src="{{ URL::asset('plugins/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

        <script src="{{ URL::asset('plugins/admin/js/jquery.easyui.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/admin/plugins/jquery-ui/jquery-ui.js') }}"></script>
        <script src="{{ URL::asset('plugins/admin/js/adminfunction_main.js') }}"></script>
        <script src="{{ URL::asset('plugins/admin/js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/admin/js/notific8_custom.js') }}"></script>
        <script src="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
        <?php /* <script src="{{ URL::asset('plugins/admin/dist/js/pages/dashboard2.js') }}"></script> 

        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ URL::asset('plugins/admin/plugins/morris/morris.js') }}"></script> */ ?>

        @yield('scripts')
        <script type="text/javascript">
                    $(function () {
                        //Initialize Select2 Elements
                        try {
                            $(".select2").select2();


                            //iCheck for checkbox and radio inputs
                            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                                checkboxClass: 'icheckbox_minimal-blue',
                                radioClass: 'iradio_minimal-blue'
                            });
                            //Red color scheme for iCheck
                            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                                checkboxClass: 'icheckbox_minimal-red',
                                radioClass: 'iradio_minimal-red'
                            });
                            //Flat red color scheme for iCheck
                            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                                checkboxClass: 'icheckbox_flat-green',
                                radioClass: 'iradio_flat-green'
                            });
                        
                        //Date picker
                        $('#datepicker').datepicker({
                            autoclose: true
                        });
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        //CKEDITOR.replace('editor1');
                        
                        CKEDITOR.replace('editor1', {
                            fullPage: false,
                            allowedContent: true
                        });
                        //CKEDITOR.instances['#editor1'].getData()
                       CKEDITOR.instances['editor1'].on('contentDom', function() {
                            CKEDITOR.instances['editor1'].document.on('keyup', function(event) {
                                var editor12 = CKEDITOR.instances["editor1"].document.getBody().getHtml();
                                //console.log(CKEDITOR.instances["editor1"].document.getBody().getHtml());
//                                console.log($(".cke_wysiwyg_frame").contents().find("body p").not('style').html());
                                $('.editor11').html(editor12);
                                //document.getElementById("preview").innerHTML = CKEDITOR.instances.editor.getData();
                            });
                        });
                        //bootstrap WYSIHTML5 - text editor
                        //$(".textarea").wysihtml5();
                        $('#datetimepicker1').datetimepicker();
                        $(".rprt-cmnt-tooltip").tooltip();
                        } catch (e) {

                        }
                    });
                    try {
                        $("[name='switch-states']").bootstrapSwitch();
                    } catch (e) {
                    }
        //     $('.datepicker').datepicker({
        //      autoclose: true
        //    });
        //$('.startdate').change(function() {
        //  
        //});



        </script>
    </body>
</html>
