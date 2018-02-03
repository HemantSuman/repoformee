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
	$useremail = '';
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
	$useremail = Auth::guard('web')->user()->email;
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
                <li class="active"><a href="#">Step 1</a></li>
                <li><a href="#">Step 2</a></li>
                <li><a href="#">Step 3</a></li>
                <li><a href="#">Step 4</a></li>
              </ul>
             <?php /*?> <div class="print-invoice-title">
                <p>Check and Print your invoice. You will arrange payment method with the seller. <a href="#"><img src="{{ URL:: asset('/plugins/front/img/printer-icon.png')}}" alt="paypal"></a></p>
              </div><?php */?>
              <!-- End of checkout-steps -->
            </div>

            <div class="col-sm-12">            
               <div class="order-invoice-sec pick-invoice-sec">
                         <div class="row">
                             <div class="col-sm-6">
                                <div class="invoice-formee-title">
                                  <img src="{{ URL:: asset('/plugins/front/img/logo.png')}}" alt="img">
                                  <h3>[{{$productData['cart_bt_cart_classified']['contact_name']}}]</h3>
                                  <p>{{$productData['cart_bt_cart_classified']['location']}} <br> </p>
                                  <p>{{$productData['cart_bt_cart_classified']['contact_email']}}</p>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <h1>Formee Invoice</h1>
                             </div>
                         </div>
                         <div class="invoice-billto-sec">
                             <div class="row">
                                 <div class="col-sm-6">
                                     <p><span>Bill To</span> {{$username}} ({{$useremail}}) <br>
                                        {{$userlocation}}</p>
                                 </div>
                                  <div class="col-sm-6">
                                      <ul class="invoice-number-box">
                                         <?php /*?> <li>Invoice Number <span>16/23</span></li><?php */?>
                                          <li>Date <span> <?php echo date('Y/m/d');?></span></li>
                                         <?php /*?> <li>Due Date <span>2017-12-19 </span></li><?php */?>
                                      </ul>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-sm-12">
                                    <div class="invoice-table-sec">
                                     <div class="table-responsive">
                                         <table class="table">
                                             <tr>
                                                  <th>Description</th>
                                                  <th>Quantity</th>
                                                  <th>Unit Price</th>
                                                  <th>Tax</th>
                                                  <th>Total</th>
                                              </tr>
                                              <tr>
                                                  <td>{{$productData['cart_bt_cart_classified']['title']}}</td>
                                                  <td>{{ $productData['qty']}}</td>
                                                  <td>${{ $productData['cart_bt_cart_classified']['price']}}</td>
                                                  <td><span>GST</span></td>
                                                  <?php $totalPrice = $productData['cart_bt_cart_classified']['price'] * $productData['qty'] ;?>
                                                  <td>${{ $totalPrice }}</td>
                                              </tr>
                                             
                                        </table>                                         
                                     </div>
                                      <table class="table table-total-price">                                             
                                              <?php /*?> <tr>
                                                  <td><span>Total without GST</span></td>
                                                  <td>$150.00</td>               
                                              </tr>
                                              <tr>
                                                  <td><span>GST</span></td>
                                                  <td>$10.00</td>               
                                              </tr> <?php */?>
                                              <tr>
                                                  <td><span>Total with GST</span></td>
                                                  <td>${{ $totalPrice }}</td>               
                                              </tr>                                              
                                      </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
               </div>

               <div class="pick-setp-btn"><a href="{{ URL('/user/picknpay_2')}}">Next Step <i class="fa fa-caret-right"></i></a></div>
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
