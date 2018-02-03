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


    <section>
      <div id="main-inner-section">
        <div class="container">
          <div class="row">

            <div class="col-sm-offset-1 col-sm-10">
              <div class="cart-added-section">
                <h4>[User Name] Checkout</h4>
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
              <!-- End of checkout-steps -->
            </div>

             <div class="col-sm-12">
               <div class="checkout-step-4">
                  <div class="congrts-icon"><img src="{{ URL:: asset('/plugins/front/img/congrts-payment.png')}}" alt="img"> </div>
                  <h3>Congratulations <span>[User Name]!</span></h3>
                  <p>You have completed your payment and your order is confirmed! <br>
                  Tou will soon receive a comfirmation in your inbox.</p>  
                  <p>Now just sit back and wait for your items to arrive!</p>
                  <p><img src="{{ URL:: asset('/plugins/front/img/congrts-van.png')}}" alt="img"> <span>Estimated Delivery:</span> Monday 14th August - Friday 18th August</p>
                  <div class="review-order"><a href="#">Review your order</a></div>
                  <div class="choukout-share">
                     <ul class="check-social-btn">
                        <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/fb-icon1.png')}}" alt="img"></a></li>
                        <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/insta-icon1.png')}}" alt="img"></a></li>
                        <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/twit-icon1.png')}}" alt="img"></a></li>
                     </ul>
                     <h3>Share your puchase now!</h3>

                     <div class="check-share-thumb-detail">
                        <div class="check-share-thumb">
                           <img src="{{ URL:: asset('/plugins/front/img/check-share-thumb.png')}}" alt="img" class="img-responsive">
                        </div>
                        <div class="check-share-detail">
                           <h3>I just bought - Book Collection <a href="#">formee.com</a></h3>
                           <p>dummy text this is You have completed your payment and your order is confirmed!                   Tou will soon receive a comfirmation in your inbox. You have completed </p>
                           <a href="#" class="sharenow">Share now!</a>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="checkout-step-4">
                  <div class="congrts-icon"><img src="{{ URL:: asset('/plugins/front/img/oops-payment.png')}}" alt="img"> </div>
                  <h3>OOPS! Something seems to have gone wrong!</h3>
                  <p>Please go back and try to check out again.</p>
                  <div class="review-order"><a href="#">Back to Payment</a></div>                
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
