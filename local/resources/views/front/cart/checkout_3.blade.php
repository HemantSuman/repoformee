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
                <h4>[User Name] Shopping Cart</h4>
              </div>
              <!-- End of cart-added-section -->
            </div>

            <div class="col-sm-12">
              <ul class="checkout-steps">
                <li><a href="#">Step 1</a></li>
                <li><a href="#">Step 2</a></li>
                <li class="active"><a href="#">Step 3</a></li>
                <li><a href="#">Step 4</a></li>
              </ul>
              <!-- End of checkout-steps -->
            </div>

             <div class="col-sm-12">
               <div class="checkout-step-2">
                  <h3>Payment Method:</h3>
                  <p>Dummy text this is Either choose one of your favourite addresses below, or add a new address. Dummy text this is Either choose one of your favourite addresses below, or add a new address. Dummy text this is Either choose one of your favourite addresses below, or add a new address. Dummy text this is Either choose one of your favourite addresses below, or add a new address.</p>
                 <div class="payment-options">
                   <ul>
                     <li><a href="javascript:void(0)" class="active via-paypal"><img src="{{ URL:: asset('/plugins/front/img/paypal-icon.jpg')}}" alt="paypal"> <span class="recommended">(Recommended)</span></a></li>
                     <li><a href="javascript:void(0)" class="via-credit"><span>Via Credit Card</span></a></li>
                   </ul>
                 </div>
                  <div class="check-or"></div>
                  
                  <div class="payment-by-paypal-sec">
                  <div class="payment-by-paypal via-paypal-sec">
                    <div class="payment-by-paypal-inner">
                       <div class="payment-by-paypal-box">
                         <div class="row">
                            <div class="col-sm-12 col-md-7">
                               <div class="payment-paypal-detail">
                                  <h3><img src="{{ URL:: asset('/plugins/front/img/paypal-icon.jpg')}}" alt="paypal"> <span><i class="fa fa-cart-arrow-down"></i> $344.36</span></h3>
                                  <h2>Pay with PayPal <span>English</span></h2>
                                  <ul class="paypal-payment-form">
                                     <li><input type="text" placeholder="Email"></li>
                                     <li><input type="text" placeholder="Password"></li>                                    
                                     <li class="pws-checkbox">                                        
                                        <input type="checkbox" id="faster" checked="checked" />
                                        <label for="faster">Stay logged in for faster checkout <span>?</span></label>
                                    </li>
                                    <li><input type="submit" value="Log In" class="login"></li>
                                    <li><a href="#">Having trouble logging in?</a></li> 
                                    <li> <div class="check-or"><span>or</span></div></li> 
                                    <li><a href="#" class="newtopaypal">New to PayPal</a></li>
                                    <li><p>Securly pay using your debit, credit or prepaid card.</p></li>
                                  </ul>
                               </div>
                            </div>
                            <div class="col-sm-12 col-md-5">
                               <div class="paypal-welcome-sec">
                                  <img src="{{ URL:: asset('/plugins/front/img/paypal-thumb.jpg')}}" alt="paypal"> 
                                  <h2>New. Faster. Easier.</h2>
                                  <p>Welcome to the new PayPal checkout! <br>
                                    The security you rely on - new even faster. <br>
                                  it’s everything checkout should be.</p>                                 
                               </div>
                            </div>
                         </div>
                       </div>
                    </div>
                  </div>

                   <div class="payment-by-paypal via-credit-sec">
                     <div class="pws-checkbox billing-address-check">
                     <span type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <input type="checkbox" id="billing_address" />
                         <label for="billing_address">Billing address different to delivery</label> 
                     </span> 
                      </div>

                     
                       <div class="addnew-address-sec collapse"  id="collapseExample">
                         <h3>Add your billing address:</h3>
                         <ul class="add-new-address-form">
                            <li>
                              <label>First Name</label>
                              <input type="text" >
                            </li>
                            <li>
                              <label>Last Name</label>
                              <input type="text" >
                            </li>
                            <li>
                              <label>Address Line 1</label>
                              <input type="text" >
                            </li>
                            <li>
                              <label>Address Line 2</label>
                              <input type="text" >
                            </li>
                            <li>
                              <label>City</label>
                              <input type="text" >
                            </li>
                            <li>
                              <label>State</label>
                              <input type="text" >
                            </li>
                            <li>
                              <label>Country</label>
                              <input type="text" >
                            </li>
                            <li>
                              <label>Postcode</label>
                              <input type="text" >
                            </li>                          
                         </ul>
                      </div>

                      
                      <div class="addnew-address-sec">
                       <h3>Entry your credit card details below:</h3>
                       <ul class="add-new-address-form credit-card-detail">
                          <li>
                            <label>Select Card Type</label>
                            <select>
                               <option>Viza</option>
                               <option>Master</option>
                            </select>
                          </li>
                          <li>
                            <label>Name on Credit Card</label>
                            <input type="text" >
                          </li>
                          <li>
                            <label>Credit card Number</label>
                            <input type="text" >
                          </li>
                          <li class="card-expiry">
                            <label>Expiry Date</label>
                            <select>
                               <option>01</option>
                               <option>02</option>
                            </select>
                            <select>
                               <option>August</option>
                               <option>Sep</option>
                            </select>
                            <select>
                               <option>2017</option>
                               <option>2016</option>
                            </select>
                          </li>
                          <li>
                            <label>Security Code</label>
                            <input type="text" class="security-code" >
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#whatisthis" class="what-is-this">What is this ?</a>
                          </li>
                          <li>
                           <p>We Accept</p>
                           <img src="{{ URL:: asset('/plugins/front/img/payment-cards.png')}}" alt="img"> 
                          </li>                        
                          <li>                         
                            <input type="submit" value="Complete payment" class="checout-btn">
                          </li>
                       </ul>
                       <!-- Modal -->
                            <div class="modal fade" id="whatisthis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">What is your cards Security Code?</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-sm-5">
                                        <img src="{{ URL:: asset('/plugins/front/img/credit-card-thumb.png')}}" alt="img"> 
                                      </div>
                                      <div class="col-sm-7">
                                         <h3>Visa, masterCard, Discover or Maestro</h3>
                                         <p>Dummy text here What is your cards Security Code? What is your cards Security Code?</p>
                                         <h3>American Express</h3>
                                         <p>Dummy text here What is your cards Security Code? What is your cards Security Code?</p>
                                      </div>
                                    </div>
                                  </div>                                 
                                </div>
                              </div>
                            </div>
                          </div>
                      
                  </div>
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

<script type="text/javascript">

</script>
@stop
