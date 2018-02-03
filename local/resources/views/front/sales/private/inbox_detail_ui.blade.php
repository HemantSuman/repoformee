@extends('front/layout/layout')

@section('content')
<?php // dd($orderData->toArray());
$order = $orderData->toArray();
$orderDetails = $order[0]['order_detail'];
//dd($order);
foreach($orderDetails as $key => $value){
	if($value['id'] == $sub_order_id){
		$sellerInfo = $value['order_detail_seller'];	
		$orderDetailsData = $value;
	}
}

//dd($sellerInfo);
 ?>
 <?PHP
					$customer = DB::table('users')->select('email')->where(['id'=>$order[0]['user_id']])->first();
					$customer_email = $customer->email;
					?>	
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
<!--            {!! Form::open(array("role" => "form", 'id' => 'update-profile-img-form', 'files' => true, 'method' => 'POST')) !!}
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
                    <li><a href="javascript:void(0)">Order Detail</a></li>
                   
                </ol>
            </div>
        </div>
    </section>
    <section class="dashboard-content private-user-dashboard">

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
                <div class="col-sm-12">
                    @include('front/element/user_dashboard_menubar_private')
                </div>
                <div class="col-sm-12">   
                     <div class="dashboardData leads-data">    
                     <h2 class="dashboard-title">Orders Management</h2>        
                     
                     <div class="order-invoice-sec">
                         <div class="row">
                             <div class="col-sm-6">
                                <div class="invoice-formee-title">
                                  <img src="{{ URL:: asset('/plugins/front/img/logo.png') }}" alt="img">
                                  <h3>[<?php echo $sellerInfo['name'];?>]</h3>
                                  <p><?php echo $sellerInfo['location'];?> <br> <?php echo $sellerInfo['city'];?>, <?php echo $sellerInfo['state'];?>, <?php echo $sellerInfo['pincode'];?></p>
                                  <p><?php echo $sellerInfo['phonecode'];?> <br><?php echo $sellerInfo['email'];?></p>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <h1>Formee Invoice</h1>
                             </div>
                         </div>
                         <div class="invoice-billto-sec">
                             <div class="row">
                                 <div class="col-sm-6">
                                     <p><span>Bill To</span> <?php echo $customer_email ?> <br /><?php echo $order[0]['customer_fname'].' ' . $order[0]['customer_lname'];?> <br>
                                        <?php echo $order[0]['customer_address1'].', '. $order[0]['customer_address2'];?>, <br>
                                        <?php echo $order[0]['customer_city'];?>, <?php echo $order[0]['customer_state'];?>, <?php echo $order[0]['customer_postcode'];?><br /><?php echo $order[0]['customer_country'];?></p>
                                 </div>
                                  <div class="col-sm-6">
                                      <ul class="invoice-number-box">
                                          <li>Invoice Number <span><?php echo $order[0]['id'].'/'.$sub_order_id;?></span></li>
                                          <li>Date <span><?php echo $orderDetailsData['created_at'];?></span></li>
                                          <li>Due Date <span> </span></li>
                                      </ul>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-sm-12">
                                    <div class="invoice-table-sec">
                                     <div class="table-responsive">
                                         <table class="table">
                                              <tr>
                                                  <th>Product Name</th>
                                                  <th>Quantity</th>
                                                  <th>Unit Price</th>
                                                  <th>Ship Method/Ship Cost</th>
                                                  <th>Total</th>
                                              </tr>
                                              <tr>
                                                  <td><?php echo $orderDetailsData['item_name'];?></td>
                                                  <td><?php echo $orderDetailsData['item_qty'];?></td>
                                                  <td>$<?php echo $orderDetailsData['item_price'];?></td>
                                                  <td><?php echo $orderDetailsData['item_ship_name'];?> / $<?php echo $orderDetailsData['item_ship_cost'];?></td>
                                                  <td>$<?php echo $orderDetailsData['item_total_amt'];?></td>
                                              </tr>
                                             
                                         </table>                                         
                                     </div>
                                      <table class="table table-total-price">                                             
                                              <?php /*?><tr>
                                                  <td><span>Total without GST</span></td>
                                                  <td>$50.00</td>               
                                              </tr>
                                              <tr>
                                                  <td><span>GST</span></td>
                                                  <td>$5.00</td>               
                                              </tr><?php */?>
                                              <tr>
                                                  <td><span>Total with GST</span></td>
                                                  <td>$<?php echo $orderDetailsData['item_total_amt'];?></td>               
                                              </tr>                                             
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>  
					
                    <?php
					//********check if seller logged in
					if($user_details->id == $sellerInfo['id']){
						$url = "user/sales/view/".$orderDetailsData['id']."/".$order[0]['id'];
					 ?>
                     <div class="invoice-bottom-sec">
						{!! Form::open(array("url" => $url, "role" => "form", 'files' => false)) !!}	
                     <h2 class="dashboard-title">Change Order Status</h2> 
                     <div class="pending-selectbox">
                         <select name="order_status">
                             <option value="Pending" <?php if($orderDetailsData['order_status']=="Pending"){ ?> selected="selected"<?php } ?>>Pending</option>
                             <option value="Shipped" <?php if($orderDetailsData['order_status']=="Shipped"){ ?> selected="selected"<?php } ?>>Shipped</option>
                             <option value="Cancel" <?php if($orderDetailsData['order_status']=="Cancel"){ ?> selected="selected"<?php } ?>>Cancel</option>
                             <option value="Complete" <?php if($orderDetailsData['order_status']=="Complete"){ ?> selected="selected"<?php } ?>>Complete</option>
                         </select>
                     </div>  
                      <ul class="invoice-btn-sec">
                         <li class="full-width"><input name="status_submit" type="submit" value="Save Changes" class="save-change"></li>
                     </ul>   
                     {!! Form::close() !!}
					
                    {!! Form::open(array("url" => $url, "role" => "form", 'files' => false)) !!}
                    	
                     <h2 class="dashboard-title">Send Email to User <span>(<?php echo $customer_email; ?>)</span> <?php /*?><a href="#">edit</a><?php */?></h2>
                     <div class="invoice-textarea">
                         <textarea name="email_content" placeholder="enter here"></textarea>
                     </div>    
                     <ul class="invoice-btn-sec">
                         <li><input type="reset" value="Reset" class="reset-btn"></li>
                         <li><input name="send_email" type="submit" value="Send Email" class="send-e-btn"></li>
                        <?php /*?> <li class="full-width"><input type="submit" value="Save Changes" class="save-change"></li><?php */?>
                     </ul>   
                     </div>   
                     <input type="hidden" name="to_email" value="<?php echo $customer_email; ?>" />
                     <input type="hidden" name="sender_name" value="<?php echo $sellerInfo['name'];?>" />
                     <input type="hidden" name="sender_email" value="<?php echo $sellerInfo['email'];?>" />
                     {!! Form::close() !!}
                     <?php } ?>
                     
                     <?php if($order[0]['paypal_paykey'] == '' || $order[0]['paypal_paykey'] == null){ ?>
                     <?php $url = "user/sales/view/".$orderDetailsData['id']."/".$order[0]['id'];?>
					 {!! Form::open(array("url" => $url, "role" => "form", 'files' => false)) !!}
                     <div class="invoice-bottom-sec invoice-bottom-sec-pick">
                     <h2 class="dashboard-title">Confirm Pick Up</h2> 

                     <div class="row">
                      
                         <div class="col-sm-6">
                             <div class="confirm-pick-box">
                                 <label>Date Approved by Seller</label>
                                 <input name="user_preferred_date" type="text" placeholder="10/8/2017" class="datepicker" value="<?php echo $orderDetailsData['buyer_pick_date']; ?>"> <span> <img src="{{ URL:: asset('/plugins/front/img/correct-icon.png') }}" alt="img"></span>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="confirm-pick-box">
                                 <label>Time Approved by Seller</label>
                                 <?php
							$start = "8:00:00";
							$end = "21:00:00";
							
							$tStart = strtotime($start);
							$tEnd = strtotime($end);
							$tNow = $tStart;
							?>
							<select name="user_preferred_time">
							<?php
							while($tNow <= $tEnd){ ?>
							
								<option value="<?php  echo date("H:i:s",$tNow); ?>" <?php if($orderDetailsData['buyer_pick_time'] == date("H:i:s",$tNow)){ ?> selected="selected"  <?php } ?>> <?php echo date("H:i:s",$tNow);?></option>
								<?php
							
							  $tNow = strtotime('+30 minutes',$tNow);
							}
							?>
                       		</select> <span> <img src="{{ URL:: asset('/plugins/front/img/correct-icon.png') }}" alt="img"></span>
                             </div>
                         </div>

                          <div class="col-sm-12">
                             <div class="confirm-pick-box pickup-location">
                                 <label>Pick Up Location</label>
                                 <textarea class="pick-msg" name="pickup_location" ><?php echo $sellerInfo['location'];?></textarea>
                             </div>
                             
                         </div>
                     </div>


                                    
                      
                     <ul class="invoice-btn-sec">
                         <li><input type="reset" value="Change New Pick Up" class="reset-btn"></li>
                         <li><input type="submit" value="Confirm Pick Up" class="send-e-btn" name="confirm_pickup"></li>
                        <?php /*?> <li class="full-width"><input type="submit" value="Save Changes" class="save-change"></li><?php */?>
                        <input type="hidden" name="to_email" value="<?php echo $customer_email; ?>" />
                     <input type="hidden" name="sender_name" value="<?php echo $sellerInfo['name'];?>" />
                     <input type="hidden" name="sender_email" value="<?php echo $sellerInfo['email'];?>" />
                     </ul>   
                     </div> 
                     {!! Form::close() !!}
                     <?php } ?>

                    </div>    
                </div>
             </div>
         </div>        
    </section>
</div>
@stop

@section('scripts')
<script type="text/javascript">

function addDays(n){
    var t = new Date();
    t.setDate(t.getDate() + n); 
    var month = "0"+(t.getMonth()+1);
    var date = "0"+t.getDate();
    month = month.slice(-2);
    date = date.slice(-2);
     var date = month +"/"+date +"/"+t.getFullYear();
    //alert(date);
	return date;
}

var newDate = addDays(10);


$(".datepicker").datepicker({
     minDate:new Date(),
	 maxDate: newDate
    });
	


</script>
@stop