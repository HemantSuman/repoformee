@extends('front/layout/layout')
@section('content')

<?php //dd($result); ?>
<?php
//$order = $order->toArray();

    $username = Auth::guard('web')->user()->name;
    $userid = Auth::guard('web')->user()->id;
    $userlocation = Auth::guard('web')->user()->location;
	$useremail = Auth::guard('web')->user()->email;

?>

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


    <section>
      <div id="main-inner-section">
         <div class="container">
          <div class="row">

            <div class="col-sm-offset-1 col-sm-10">
              <div class="cart-added-section">
                <h4>CONGRATULATIONS!  <br> You Just Purchased [<?php echo $order['order_detail'][0]['item_name'];?>]!</h4>
                <p>On checkout you selected “Pick up & Pay”. <br> 
                   Follow the steps below and you’ll be on your way to get your purchase in no time! </p>
              </div>
              <!-- End of cart-added-section -->
            </div>

            <div class="col-sm-12">
              <ul class="checkout-steps">
                <li><a href="#">Step 1</a></li>
                <li><a href="#">Step 2</a></li>
                <li><a href="#">Step 3</a></li>
                <li class="active"><a href="#">Step 4</a></li>
              </ul>
              <div class="print-invoice-title invoice-title2">
                 <h3 class="step4title">Pick Up Confirmed!</h3>
              
                     
                <ul class="pick-step2-forms pick-step4-forms">                        
                         <li>
                           <label>Date Approved by Seller</label>
                           <input type="text" placeholder="10/8/2017" value="<?php echo $order['order_detail'][0]['buyer_pick_date'];?>" disabled="disabled">
                           <span> <img src="{{ URL:: asset('/plugins/front/img/correct-icon.png')}}" alt="img"></span>                          
                         </li>
                         <li>
                           <label>Time Approved by Seller</label>
                          <input type="text" placeholder="4:30pm - 18:00pm" value="<?php echo $order['order_detail'][0]['buyer_pick_time'];?>" disabled="disabled">
                           <span> <img src="{{ URL:: asset('/plugins/front/img/correct-icon.png')}}" alt="img"></span>
                         </li>                         
                         
                         <li class="full-width">
                           <label>Pick Up Location</label>
                           <p> <?php echo $order['order_detail'][0]['pickup_location'];?></p>
                         </li>                        
                      </ul>


                <?php /*?><p>Please remember to bring your printed invoice along with the total payment.  </p>
             

                      <ul class="pick-step2-forms"> 
                         <li class="full-width">
                           <label>Message</label>
                           <textarea class="pick-msg" placeholder="Write Your Messgae"></textarea>
                         </li>
                          <li class="full-width">
                            <input type="submit" value="Send Message" class="send-msg">
                         </li>
                      </ul>

                       <div class="pick-setp-btn"><a href="#">Next Step <i class="fa fa-caret-right"></i></a></div>
                  <?php */?>
               
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

</script>
@stop
