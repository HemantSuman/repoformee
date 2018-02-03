
<div class="dashboardLink">
    <?php
    $action = app('request')->route()->getAction();
    $controller = class_basename($action['controller']);
    list($controller, $action) = explode('@', $controller);
    ?>

    <ul>
        <li>
            <a href="{{ url('/user/profile') }}" class="{{ ($controller == 'UsersController' && $action == 'user_profile') ? 'active' : '' }}">Profile</a>
        </li>
        <li>
            <a href="{{ url('/user/messages') }}" class="{{ ($controller == 'MessagesController' && $action == 'index') ? 'active' : '' }}">Message</a>
        </li>
        <li>
            <a href="{{ url('/user/classifieds') }}" class="{{ ($controller == 'UsersController' && $action == 'user_classified') ? 'active' : '' }}">Manage Ads</a>
            <!--<a href="javascript:void(0)" class="">Manage Ads</a>-->
        </li>
        <li>
            <a href="{{ url('/user/saved-searches') }}" class="{{ ($controller == 'SavedSearchesController' && $action == 'index') ? 'active' : '' }}">Saved Searches</a>
        </li>
       <?php /*?> <li>
            <a href="{{ url('/user/leads') }}" class="{{ ($controller == 'MessagesController' && $action == 'leadsindex') ? 'active' : '' }}">Leads</a>
        </li><?php */?>
       
      <?php /*?>  <li>
            <a href="{{ url('/user/jobapplications') }}" class="{{ ($controller == 'MessagesController' && $action == 'jobsindex') ? 'active' : '' }}">Job Applications</a>
        </li><?php */?>
       
        <li>
            <a href="{{ url('/user/orders') }}" class="{{ ($controller == 'UsersController' && $action == 'ordersindex') ? 'active' : '' }}">My Orders</a>
        </li>
       <?php /*?> <li>
            <a href="{{ url('/user/sales') }}" class="{{ ($controller == 'UsersController' && $action == 'salesindex') ? 'active' : '' }}">Orders Received</a>
        </li><?php */?>
       
    </ul>

</div>