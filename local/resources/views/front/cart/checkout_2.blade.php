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
                <li class="active"><a href="#">Step 2</a></li>
                <li><a href="#">Step 3</a></li>
                <li><a href="#">Step 4</a></li>
              </ul>
              <!-- End of checkout-steps -->
            </div>
            <div class="col-sm-12">
               <div class="checkout-step-2">
                  <h3>Please select your delivery address:</h3>
                  <p>Either choose one of your favourite addresses below, or add a new address.</p>
                  <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <div class="checkout-address-box">
                          <h2>Buyer Name</h2>
                          <p>Street address line 1 ,  <br>
                            Suburb, <br>
                            City , State , <br>
                            Postal Code</p>
                          <ul class="checkout-btns">
                            <li><a href="#">Deliver to this address</a></li>
                            <li><a href="#">Edit</a></li>
                            <li><a href="#">Delete</a></li>
                          </ul>
                      </div>                                         
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div class="checkout-address-box">
                          <h2>Buyer Name</h2>
                          <p>Street address line 1 ,  <br>
                            Suburb, <br>
                            City , State , <br>
                            Postal Code</p>
                          <ul class="checkout-btns">
                            <li><a href="#">Deliver to this address</a></li>
                            <li><a href="#">Edit</a></li>
                            <li><a href="#">Delete</a></li>
                          </ul>
                      </div>                                         
                    </div>
                  </div>
                  <div class="check-or"><span>or</span></div>
                  <div class="addnew-address-sec">
                     <h3>Add a new delivery address:</h3>
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
                        <li>                         
                          <input type="submit" value="Deliver to this address" class="checout-btn">
                        </li>
                     </ul>
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
