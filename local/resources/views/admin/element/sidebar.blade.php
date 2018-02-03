<!-- sidebar: style can be found in sidebar.less -->
<?php
$action = app('request')->route()->getAction();
$controller = class_basename($action['controller']);
list($controller, $action) = explode('@', $controller);
?>
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ URL::asset('plugins/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">

            <p>{!!Auth::guard('admin')->user()->name!!}</p>

<!--          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
        </div>
    </div>
    <!-- search form -->
    <!--      <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
            </div>
          </form>-->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
            <a href="{!! url('admin/dashboard'); !!}">
                <i class="fa fa-home"></i> <span>Dashboard</span> 
            </a>

        </li>

        <?php
        $activeClass = (($controller == 'CategoriesController') && ($action == 'admin_add' || $action == 'admin_index')) ? "active" : "";
        $openClass = ($controller == 'CategoriesController') ? "open" : "";
        $selectedClass = ($controller == 'CategoriesController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/categories') !!}">
                <i class="fa fa-certificate"></i>
                <span>Category Management</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_add') { ?>class="active"<?php } ?> ><a href="{!! url('admin/categories/add') !!}"><i class="fa fa-circle-o"></i> Add New Category</a></li>
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/categories') !!}"><i class="fa fa-circle-o"></i> Category List</a></li>

            </ul>
        </li>
        <?php
        $activeClass = (($controller == 'CategoriesController') && ($action == 'admin_add_info' || $action == 'admin_index_info')) ? "active" : "";
        $openClass = ($controller == 'CategoriesController') ? "open" : "";
        $selectedClass = ($controller == 'CategoriesController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/categories') !!}">
                <i class="fa fa-certificate"></i>
                <span>Information Category</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_add_info') { ?>class="active"<?php } ?> ><a href="{!! url('admin/categories-info/add') !!}"><i class="fa fa-circle-o"></i> Add New Information Category</a></li>
                <li <?php if ($action == 'admin_index_info') { ?>class="active"<?php } ?> ><a href="{!! url('admin/categories-info') !!}"><i class="fa fa-circle-o"></i> Information Category List</a></li>
            </ul>
        </li>

        <?php
        $activeClass = ($controller == 'FoodProductsController' || $controller == 'RestrictedIngredientsController') ? "active" : "";
        $openClass = ($controller == 'FoodProductsController') ? "open" : "";
        $selectedClass = ($controller == 'FoodProductsController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/food_products') !!}">
                <i class="fa fa-certificate"></i>
                <span>Food Products Management</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_add' && $controller == 'FoodProductsController') { ?>class="active"<?php } ?> ><a href="{!! url('admin/food_products/add') !!}"><i class="fa fa-circle-o"></i> Add New Food Products</a></li>
                <li <?php if ($action == 'admin_index' && $controller == 'FoodProductsController') { ?>class="active"<?php } ?> ><a href="{!! url('admin/food_products') !!}"><i class="fa fa-circle-o"></i>Food Products List</a></li>

                <li <?php if ($controller == 'RestrictedIngredientsController' && $action == 'admin_add') { ?>class="active"<?php } ?> ><a href="{!! url('admin/restricted_ingredients/add') !!}"><i class="fa fa-circle-o"></i> Add New Ingredients</a></li>
                <li <?php if ($controller == 'RestrictedIngredientsController' && $action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/restricted_ingredients') !!}"><i class="fa fa-circle-o"></i>Restricted Ingredients List</a></li>
            </ul>
        </li>

        <?php
        $activeClass = ($controller == 'AttributesController') ? "active" : "";
        $openClass = ($controller == 'AttributesController') ? "open" : "";
        $selectedClass = ($controller == 'AttributesController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/attributes') !!}">
                <i class="fa fa-delicious"></i>
                <span>Attribute Management</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                <li <?php if ($action == 'admin_add') { ?>class="active"<?php } ?> ><a href="{!! url('admin/attributes/add') !!}"><i class="fa fa-circle-o"></i> Add Attribute</a></li>
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/attributes') !!}"><i class="fa fa-circle-o"></i> Attribute List</a></li>
            </ul>
        </li>

        <?php
        $activeClass = ($controller == 'GroupsController') ? "active" : "";
        $openClass = ($controller == 'GroupsController') ? "open" : "";
        $selectedClass = ($controller == 'GroupsController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/classifieds') !!}">
                <i class="fa fa-calendar-o"></i>
                <span>Groups Management</span>

            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/groups') !!}"><i class="fa fa-circle-o"></i> Groups List<small class="label pull-right bg-green"></small></a></li>
                <li <?php if ($action == 'admin_add') { ?>class="active"<?php } ?> ><a href="{!! url('admin/groups/add') !!}"><i class="fa fa-circle-o"></i> Add Groups</a></li>
            </ul>
        </li>

        <?php
        $activeClass = ($controller == 'MembershipPlansController') ? "active" : "";
        $openClass = ($controller == 'MembershipPlansController') ? "open" : "";
        $selectedClass = ($controller == 'MembershipPlansController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/classifieds') !!}">
                <i class="fa fa-calendar-o"></i>
                <span>Membership Plans</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/membership_plans') !!}"><i class="fa fa-circle-o"></i> Membership Plans List<small class="label pull-right bg-green"></small></a></li>
                <li <?php if ($action == 'admin_add') { ?>class="active"<?php } ?> ><a href="{!! url('admin/membership_plans/add') !!}"><i class="fa fa-circle-o"></i> Add New Plan</a></li>
            </ul>
        </li>

        <?php
        $activeClass = ($controller == 'PromoCodesController') ? "active" : "";
        $openClass = ($controller == 'PromoCodesController') ? "open" : "";
        $selectedClass = ($controller == 'PromoCodesController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/promo_codes') !!}">
                <i class="fa fa-calendar-o"></i>
                <span>Promo Codes</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/promo_codes') !!}"><i class="fa fa-circle-o"></i> Promo Codes List<small class="label pull-right bg-green"></small></a></li>
                <li <?php if ($action == 'admin_add') { ?>class="active"<?php } ?> ><a href="{!! url('admin/promo_codes/add') !!}"><i class="fa fa-circle-o"></i> Add New Promo Codes</a></li>
            </ul>
        </li>


        <?php
        $activeClass = ($controller == 'TemplatesController') ? "active" : "";
        $openClass = ($controller == 'TemplatesController') ? "open" : "";
        $selectedClass = ($controller == 'TemplatesController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/templates') !!}">
                <i class="fa fa-calendar-o"></i>
                <span>Templates</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/templates') !!}"><i class="fa fa-circle-o"></i>Templates List<small class="label pull-right bg-green"></small></a></li>
            </ul>
        </li>

        <?php
        $activeClass = ($controller == 'PackagesController') ? "active" : "";
        $openClass = ($controller == 'PackagesController') ? "open" : "";
        $selectedClass = ($controller == 'PackagesController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/packages') !!}">
                <i class="fa fa-calendar-o"></i>
                <span>Ad Posting Packages</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/packages') !!}"><i class="fa fa-circle-o"></i> Packages List<small class="label pull-right bg-green"></small></a></li>
            </ul>
        </li>

        <?php
        $activeClass = ($controller == 'ClassifiedController') ? "active" : "";
        $openClass = ($controller == 'ClassifiedController') ? "open" : "";
        $selectedClass = ($controller == 'ClassifiedController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/classifieds') !!}">
                <i class="fa fa-calendar-o"></i>
                <span>Classified Management</span>

            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/classifieds') !!}"><i class="fa fa-circle-o"></i> Classified List<small class="label pull-right bg-green"><?php echo $classifiedcount['active'] ?></small></a></li>
                <li <?php if ($action == 'admin_add') { ?>class="active"<?php } ?> ><a href="{!! url('admin/classifieds/add') !!}"><i class="fa fa-circle-o"></i> Add Classified</a></li>
                <li <?php if ($action == 'admin_approve') { ?>class="active"<?php } ?> ><a href="{!! url('admin/classifieds/approve') !!}"><i class="fa fa-circle-o"></i> Approved Classified <small class="label pull-right bg-blue"><?php echo $classifiedcount['approved'] ?></small></a></li>
                <li <?php if ($action == 'admin_reject') { ?>class="active"<?php } ?> ><a href="{!! url('admin/classifieds/reject') !!}"><i class="fa fa-circle-o"></i> Rejected Classified <small class="label pull-right bg-red"><?php echo $classifiedcount['reject'] ?></small></a></li>
            </ul>
        </li>

        <?php
        /*         * ************** Advertisement Manager ***************** */
        $activeClass = ($controller == 'AdvertisementsController') ? "active" : "";
        $openClass = ($controller == 'AdvertisementsController') ? "open" : "";
        $selectedClass = ($controller == 'AdvertisementsController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/advertisements') !!}">
                <i class="fa fa-feed"></i>
                <span>Advertisement Manager</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_add') { ?>class="active"<?php } ?> ><a href="{!! url('admin/advertisements/add') !!}"><i class="fa fa-circle-o"></i> Add Advertisement</a></li>
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/advertisements') !!}"><i class="fa fa-circle-o"></i> Advertisement Details</a></li>

            </ul>
        </li> <?php /*         * ************** Advertisement Manager End ***************** */ ?>

        <?php
        /*         * ************** Inbox / Support Tickets Manager Starts ***************** */
        $activeClass = ($controller == 'QueriesController') ? "active" : "";
        $openClass = ($controller == 'QueriesController') ? "open" : "";
        $selectedClass = ($controller == 'QueriesController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/queries') !!}">
                <i class="fa fa-ticket"></i>
                <span>Inbox / Support Tickets</span>
                @if($total_unread_queries > 0)
                <span class="label label-primary pull-right">{{ $total_unread_queries }}</span>
                @endif
            </a>
        </li> <?php /*         * ************** Inbox / Support Tickets Manager End ***************** */ ?>


        <?php
        /*         * ************** RSS Feeds Manager Starts ***************** */
        $activeClass = ($controller == 'FeedsController') ? "active" : "";
        $openClass = ($controller == 'FeedsController') ? "open" : "";
        $selectedClass = ($controller == 'FeedsController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/feeds') !!}">
                <i class="fa fa-feed"></i>
                <span>Manage RSS Feeds</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/feeds') !!}"><i class="fa fa-circle-o"></i> Feed Detail</a></li>
                <li <?php if ($action == 'admin_add') { ?>class="active"<?php } ?> ><a href="{!! url('admin/feeds/add') !!}"><i class="fa fa-circle-o"></i> Create Feed</a></li>

            </ul>
        </li> <?php /*         * ************** RSS Feeds Manager End ***************** */ ?>

        <?php
        /*         * ************** Newsletter Manager Starts ***************** */
        $activeClass = ($controller == 'NewslettersController' || $controller == 'SubscriberListsController') ? "active" : "";
        $openClass = ($controller == 'NewslettersController' || $controller == 'SubscriberListsController') ? "open" : "";
        $selectedClass = ($controller == 'NewslettersController' || $controller == 'SubscriberListsController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/newsletters') !!}">
                <i class="fa fa-newspaper-o"></i>
                <span>Manage Newsletters</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($controller == 'NewslettersController' && $action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/newsletters') !!}"><i class="fa fa-circle-o"></i> Newsletters</a></li>
                <li <?php if ($controller == 'SubscriberListsController' && $action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/subscriber-lists') !!}"><i class="fa fa-circle-o"></i> Subscriber List<small class="label pull-right bg-green"><?php echo $subscribercount['active'] ?></small></a></li>

            </ul>
        </li> <?php /*         * ************** Newsletter Manager End ***************** */ ?>

        <?php
        /*         * ************** Prayer Timings Manager Starts ***************** */
        $rolename = Auth::guard('admin')->user()->active_role_name;
        if ($rolename == 'admin') {
            $activeClass = ($controller == 'PrayerTimingsController') ? "active" : "";
            $openClass = ($controller == 'PrayerTimingsController') ? "open" : "";
            $selectedClass = ($controller == 'PrayerTimingsController') ? "selected" : "";
            ?>
            <li class="<?php echo $activeClass; ?> treeview">
                <a href="{!! url('admin/prayer-timings') !!}">
                    <i class="fa fa-tachometer"></i>
                    <span>Prayer Timings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/prayer-timings') !!}"><i class="fa fa-circle-o"></i> Methods</a></li>
                </ul>
            </li> <?php
        }
        /*         * ************** Prayer Timings Manager End ***************** */
        ?>

        <?php
        /*         * ************** Role Manager Starts ***************** */
        $activeClass = (($controller == 'RoleController') && ($action == 'create' || $action == 'index')) ? "active" : "";
        $openClass = ($controller == 'RoleController') ? "open" : "";
        $selectedClass = ($controller == 'RoleController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/roles') !!}">
                <i class="fa fa-delicious"></i>
                <span> Role Management</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                <li <?php if ($action == 'create') { ?>class="active"<?php } ?> ><a href="{!! url('admin/roles/create') !!}"><i class="fa fa-circle-o"></i> Add Role</a></li>
                <li <?php if ($action == 'index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/roles') !!}"><i class="fa fa-circle-o"></i> Manage Role</a></li>
            </ul>
        </li>

        <?php
        /*         * ************** Role Manager Starts ***************** */
        $activeClass = (($controller == 'RoleController') && ($action == 'add_corporate' || $action == 'corporates')) ? "active" : "";
        $openClass = ($controller == 'RoleController') ? "open" : "";
        $selectedClass = ($controller == 'RoleController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/corporates') !!}">
                <i class="fa fa-delicious"></i>
                <span> Corporate Users</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'add_corporate') { ?>class="active"<?php } ?> ><a href="{!! url('admin/roles/add_corporate') !!}"><i class="fa fa-circle-o"></i> Add corporate user</a></li>
                <li <?php if ($action == 'corporates') { ?>class="active"<?php } ?> ><a href="{!! url('admin/corporates') !!}"><i class="fa fa-circle-o"></i> Corporate users</a></li>
            </ul>
        </li>

        <?php
        /*         * ************** RSS Feeds Manager Starts ***************** */
        $activeClass = ($controller == 'ReportsController') ? "active" : "";
        $openClass = ($controller == 'ReportsController') ? "open" : "";
        $selectedClass = ($controller == 'ReportsController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/reports') !!}">
                <i class="fa fa-feed"></i>
                <span>Classified Spam Reports</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php if ($action == 'admin_index') { ?>class="active"<?php } ?> ><a href="{!! url('admin/reports') !!}"><i class="fa fa-circle-o"></i> Spam Reports</a></li>
            </ul>
        </li> <?php /*         * ************** RSS Feeds Manager End ***************** */ ?>

        <?php
        /*         * ************** Review and Ratings ***************** */
        $activeClass = ($controller == 'ReviewsController') ? "active" : "";
        $openClass = ($controller == 'ReviewsController') ? "open" : "";
        $selectedClass = ($controller == 'ReviewsController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/reviews') !!}">
                <i class="fa fa-ticket"></i>
                <span>Reviews</span>
            </a>
        </li> 
        <?php /*         * ************** Review and Ratings ***************** */ ?>

        <?php
        /*         * ************** Role Manager Starts ***************** */
        $activeClass = ($controller == 'UsersController' && ($action == 'admin_registeruserlist' || $action == 'admin_userlist' || $action == 'admin_adduser' || $action == 'admin_business_users')) ? "active" : "";
        $openClass = ($controller == 'UsersController') ? "open" : "";
        $selectedClass = ($controller == 'UsersController') ? "selected" : "";
//dd()
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/users') !!}">
                <i class="fa fa-delicious"></i>
                <span> User Management</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                <li <?php if ($action == 'admin_registeruserlist') { ?>class="active"<?php } ?> ><a href="{!! url('admin/register_user') !!}"><i class="fa fa-circle-o"></i> Registered Users </a></li>
                <li <?php if ($action == 'admin_business_users') { ?>class="active"<?php } ?> ><a href="{!! url('admin/business_users') !!}"><i class="fa fa-circle-o"></i> Business Users </a></li>
                <li <?php if ($action == 'admin_userlist') { ?>class="active"<?php } ?> ><a href="{!! url('admin/admin_user') !!}"><i class="fa fa-circle-o"></i> Admin Users </a></li>
                <li <?php if ($action == 'admin_adduser') { ?>class="active"<?php } ?> ><a href="{!! url('admin/add_user') !!}"><i class="fa fa-circle-o"></i> Add Admin User</a></li>
            </ul>
        </li>


        <?php
        /*         * ************** Push Manager Starts ***************** */
        $activeClass = ($controller == 'NotificationController' && ($action == 'admin_notification')) ? "active" : "";
        $openClass = ($controller == 'NotificationController') ? "open" : "";
        $selectedClass = ($controller == 'NotificationController') ? "selected" : "";
//dd()
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/notification') !!}">
                <i class="fa fa-delicious"></i>
                <span> Notification</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                <li <?php if ($action == 'admin_notification') { ?>class="active"<?php } ?> ><a href="{!! url('admin/notification') !!}"><i class="fa fa-circle-o"></i> Notification </a></li>

            </ul>
        </li>

        <?php
        /*         * ************** Site Report Manager Starts ***************** */
        $activeClass = ($controller == 'SiteReportsController') ? "active" : "";
        $openClass = ($controller == 'SiteReportsController') ? "open" : "";
        $selectedClass = ($controller == 'SiteReportsController') ? "selected" : "";
        ?>
        <li class="<?php echo $activeClass; ?> treeview">
            <a href="{!! url('admin/site-reports') !!}">
                <i class="fa fa-ticket"></i>
                <span>Reports</span>
            </a>
        </li> <?php /*         * ************** Site Report Manager End ***************** */ ?>


        <?php
        $rolename = Auth::guard('admin')->user()->active_role_name;
        if ($rolename == 'admin') {
            //role_id
            // dd($rolename);
            /*             * ************** Settings Manager Starts ***************** */
            $activeClass = ($controller == 'SettingsController') ? "active" : "";
            $openClass = ($controller == 'SettingsController') ? "open" : "";
            $selectedClass = ($controller == 'SettingsController') ? "selected" : "";
            ?>
            <li class="<?php echo $activeClass; ?>">
                <a href="{!! url('admin/settings') !!}">
                    <i class="fa fa-cogs"></i>
                    <span> Settings Management</span>

                </a>
            </li>
        <?php } ?>

        <?php
        $rolename = Auth::guard('admin')->user()->active_role_name;
        if ($rolename == 'admin') {
            //role_id
            // dd($rolename);
            /*             * ************** Settings Manager Starts ***************** */
            $activeClass = ($controller == 'CmsController' || $controller == 'FaqController' || $controller == 'FaqcategoryController') ? "active" : "";
            $openClass = ($controller == 'CmsController' || $controller == 'FaqController' || $controller == 'FaqcategoryController') ? "open" : "";
            $selectedClass = ($controller == 'CmsController' || $controller == 'FaqController' || $controller == 'FaqcategoryController') ? "selected" : "";
            ?>
            <li class="<?php echo $activeClass; ?>">
                <a href="{!! url('admin/cms') !!}">
                    <i class="fa fa-file-text-o"></i>
                    <span> Cms Management</span>

                </a>
                <ul class="treeview-menu">

                    <li <?php if ($action == 'admin_cms') { ?>class="active"<?php } ?> ><a href="{!! url('admin/cms') !!}"><i class="fa fa-circle-o"></i> Cms List </a></li>
                    <li <?php if ($action == 'admin_faqcategorylist') { ?>class="active"<?php } ?> ><a href="{!! url('admin/faqcategorylist') !!}"><i class="fa fa-circle-o"></i> Faq Category </a></li>
                    <li <?php if ($action == 'admin_faqlist') { ?>class="active"<?php } ?> ><a href="{!! url('admin/faqlist') !!}"><i class="fa fa-circle-o"></i> Faq Question Answer</a></li>
    <!--                <li <?php if ($action == 'admin_addcms') { ?>class="active"<?php } ?> ><a href="{!! url('admin/addcms') !!}"><i class="fa fa-circle-o"></i> Add Cms Page</a></li>-->
                </ul>
            </li>
        <?php } ?>

        <?php
        $rolename = Auth::guard('admin')->user()->active_role_name;
        if ($rolename == 'admin') {
            //role_id
            // dd($rolename);
            /*             * ************** Settings Manager Starts ***************** */
//        $activeClass = ($controller == 'FaqController') ? "active" : "";
//        $openClass = ($controller == 'FaqController') ? "open" : "";
//        $selectedClass = ($controller == 'FaqController') ? "selected" : "";
            ?>
                        <!--        <li class="<?php echo $activeClass; ?>">
                            <a href="{!! url('admin/faq') !!}">
                                <i class="fa fa-question-circle"></i>
                                <span> Faq Management</span>
                                
                            </a>
                            <ul class="treeview-menu">
                                
                                <li <?php if ($action == 'admin_faqcategorylist') { ?>class="active"<?php } ?> ><a href="{!! url('admin/faqcategorylist') !!}"><i class="fa fa-circle-o"></i> Faq Category </a></li>
                                <li <?php if ($action == 'admin_faqlist') { ?>class="active"<?php } ?> ><a href="{!! url('admin/faqlist') !!}"><i class="fa fa-circle-o"></i> Faq Question Answer</a></li>
                            </ul>
                        </li>-->
        <?php } ?>
    </ul>
</section>
<!-- /.sidebar -->