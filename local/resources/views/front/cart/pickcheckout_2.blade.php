@extends('front/layout/layout')
@section('content')

<?php //dd($result); ?>

<div id="middle" class="no-banner">
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>

                     <li class="active">23423423</li>
                </ol>
            </div>
        </div>
    </section>
    @if(!(Auth::guard('web')->user()))
    <?php
    $username = '';
    $userid = '';
    $userlocation = '';
	$usercreated = '';
    ?>
    @else
    <?php
  // dd($cartItems->cart_hm_cart_classified[0]->cart_bt_cart_classified);
   $productData = $cartItems->cart_hm_cart_classified[0];//->cart_bt_cart_classified;
   $productData = $productData->toArray();
 // dd( $productData);
    $username = Auth::guard('web')->user()->name;
    $userid = Auth::guard('web')->user()->id;
    $userlocation = Auth::guard('web')->user()->location;
	$usercreated = $userlocation = Auth::guard('web')->user()->created_at;
	list($udate,$utime) = explode(" ",$usercreated);
	$utime=strtotime($udate);
	$umonth=date("F",$utime);
	$uyear=date("Y",$utime);
    ?>
    @endif

    <section>
      <div id="main-inner-section">
         <div class="container">
          <div class="row">

            <div class="col-sm-offset-1 col-sm-10">
              <div class="cart-added-section">
                <h4>CONGRATULATIONS!  <br> You Just Purchased [{{$productData['cart_bt_cart_classified']['title']}}]!</h4>
                <p>On checkout you selected “Pick up & Pay”. <br> 
                   Follow the steps below and you’ll be on your way to get your purchase in no time! </p>
              </div>
              <!-- End of cart-added-section -->
            </div>

            <div class="col-sm-12">
              <ul class="checkout-steps">
                <li><a href="#">Step 1</a></li>
                <li class="active"><a href="#">Step 2</a></li>
                <li><a href="#">Step 3</a></li>
                <li><a href="#">Step 4</a></li>
              </ul>
              <div class="print-invoice-title invoice-title2">
                <p>Now, you can contact the seller directly to arrange your Pick up and Pay. <br>
                Transaction must be completed within 14 days of purchase.</p>
                <div class="pick2-user-sec">                 
                     <div class="user-name-box-in">
                          <img src="{{ URL:: asset('/plugins/front/img/user-thumb.png')}}" alt="img">
                           <h3>{{ $username }} 
                              <span>Member since {{ $umonth}} {{ $uyear}}</span>
                              <?php /*?><span class="last-view-user">Last active Yesterday </span><?php */?>
                           </h3>
                      </div>
                       </div>
				 {!! Form::open(array( "role" => "form", 'files' => false)) !!} 
                      <ul class="pick-step2-forms">                        
                         <li>
                           <label>Date Preferred</label>
                           <input name="user_preferred_date" type="text" placeholder="10/8/2017" class="datepicker">
                         </li>
                           <li>
                           <label>Time Preferred </label>
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
							
								<option value="<?php  echo date("H:i:s",$tNow); ?>"> <?php echo date("H:i:s",$tNow);?></option>
								<?php
							
							  $tNow = strtotime('+30 minutes',$tNow);
							}
							?>
                       		</select>
                          
                         </li>
                         <li class="full-width">
                           <label>Message</label>
                           <textarea name="buyer_msg" class="pick-msg" placeholder="Write Your Messgae"></textarea>
                         </li>
                          <li class="full-width">
                            <input type="submit" value="Send Message" class="send-msg-buyer" name="buyer_send_submit">
                         </li>
                      </ul>
			 {!! Form::close() !!}
                      <?php /*?> <div class="pick-setp-btn"><a href="#">Next Step <i class="fa fa-caret-right"></i></a></div><?php */?>
                  
               
              </div>
              
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
	

	
$(".timepicker2").timepicker();

</script>
@stop
