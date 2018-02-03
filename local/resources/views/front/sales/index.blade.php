@extends('front/layout/layout')

@section('content')
<?php //dd ($order->toArray());?>
<div id="middle" class="no-banner"> 
    <div class="dashboard-banner">
		<div class="userImg">
                  
			@if(!empty($user_details['image']))
            <img src="{{ URL::asset('upload_images/users/'.$user_details['id'].'/'.$user_details['image']) }}" alt="profile-img-new">
            
            @elseif(($user_details['avatar']))
            <img src="{{ $user_details['avatar'] }}" alt="profile-img-new"> 
            @else
            <img src="{{ URL::asset('plugins/front/img/no_avatar.gif') }}" alt="profile-img-new">   
            @endif

				
		</div>
         <div class="userStates">
            <select class="" name="">
                <option value="">Online</option>
                <option value="">Offline</option>
                <option value="">Away</option>Away
            </select>
        </div>
		<div class="Changepic">
<!--			{!! Form::open(array("role" => "form", 'id' => 'update-profile-img-form', 'files' => true, 'method' => 'POST')) !!}
			<input type="file" name="image" id="file2" class="filetype chng-prfl-pic-btn">
			<label for="file2">Change Photo</label>
			<p>Image must be in JPG or PNG format and under 5 mb.</p>
			{!! Form::close() !!}-->
		</div>
	</div>
<!--    <div class="dashboard-banner">
        <div class="userImg">
            @if(empty($user_details['image']))
                <img src="{{ URL::asset('plugins/front/img/no_avatar.gif') }}" alt="profile-img-new">
            @elseif(($user_details['avatar']))
                <img src="{{ Auth::guard('web')->user()->avatar }}" alt="profile-img-new">  
            @else
                <img src="{{ URL::asset('upload_images/users/'.$user_details['id'].'/'.$user_details['image']) }}" alt="profile-img-new">   
            @endif
            
        </div>
        <div class="userStates">
            <select class="" name="">
                <option value="">Online</option>
                <option value="">Offline</option>
                <option value="">Away</option>Away
            </select>
        </div>
    </div>-->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li><a href="javascript:void(0)">Orders</a></li>
                   
                </ol>
            </div>
        </div>
    </section>
    <section class="dashboard-content">

        <div class="dashboarduserDetail">
            <div class="container">
                <div class="userName">
                    {{ Auth::guard('web')->user()->name }}
                </div>
                   
                <ul class="aboutUser">
                                @if(empty($total_viewer->total_views))
                    <li> 0 views</li>
                                @else
                    <li>{{ $total_viewer->total_views }} views</li>
                                @endif
                                 @if(!empty($user_total_classifieds))
                    <li>{{ $user_total_classifieds }} Ads foud</li> 
                                @else
                    <li> 0 Ads foud</li>
                     @endif
                    @if(!empty($user_details['city']))
                        <li> <span><img src="{{ URL:: asset('/plugins/front/img/locate-icon.png') }}" alt=""></span>{!! $user_details['city'] !!}</li>
                        @else
                                        <li> <span><img src="{{ URL:: asset('/plugins/front/img/locate-icon.png') }}" alt=""></span>N/A</li>
                    @endif
                                @if(!empty($user_details['created_at']))
                    <li><span><img src="{{ URL:: asset('/plugins/front/img/icons/calander-icon.png') }}" alt=""></span> {!! date("d-m-y",strtotime($user_details['created_at'])) !!}</li>
                                @endif
                </ul>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    @include('front/element/user_dashboard_menubar')
                </div>
<?php
$orderData = $order->toArray();

?>                
                <div class="col-sm-12 col-md-9">   
                     <div class="dashboardData leads-data">    
                     <h2 class="dashboard-title">Orders Management</h2>        
                     <div class="orders-manage-table">
                         <div class="table-responsive">
                             <table class="table">
                                 <tr>
                                     <th>ORDER NO</th>     
                                     <th>PRODUCT NAME</th>        
                                     <th>PRICE</th>        
                                     <th>TYPE</th>          
                                     <th>ACTION</th>
                                 </tr>
                                @foreach($orderData as $key => $value)
                                	
                                 <tr>
                                     <td><?php echo $value['id'];?></td>     
                                     <td><?php echo $value['item_name'];?></td>
                                    
                                     <td>$<?php echo $value['item_total_amt'];?></td>
                                     <td><?php //echo $valuedt['order_status'];?>
                                     <?php if($value['orders']['paypal_paykey'] != '' && $value['orders']['paypal_paykey'] != null){ 
									 echo 'PayPal';
									 }else{
										echo 'Pick n Pay'; 
									 }
									 ?>
                                     </td>
                                    
                                     <td><a href="<?php echo URL('user/sales/view', ['id'=>$value['id'], 'OrderId'=>$value['order_id']])?>">View / Edit</a> 
                                        <?php /*?><span class="t-btn"><input data-toggle="toggle" value="1" checked="" type="checkbox"></span><?php */?></td>
                                 </tr>
                                 	
                                 
                                @endforeach
                                 
                             </table>
                         </div>
                     </div>
                        
                      
                    </div>
    
                </div>
             </div>
         </div>        
    </section>
</div>
@stop

@section('scripts')
@stop