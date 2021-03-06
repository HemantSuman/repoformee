<?php
$receiverAmount = array();
$receiverEmail = array();
$primaryReceiver = array();

$cartCount = 0;
$cartSubTotal = 0;
$cartGrandTotal = 0;
$cartShipCost = 0;

foreach ($cartItems as $key => $value) {
    //$receiverAmount[] = $value->price + $value->ship_cost ;
    //$receiverEmail[] = $value->paypal_email ;
    //$primaryReceiver[] = 0;
    $prodsubtotal = ($value->qty) * ($value->price);
    $cartSubTotal += $prodsubtotal;
    $cartShipCost += $value->ship_cost;
}

$cartGrandTotal = $cartSubTotal + $cartShipCost;
?>
@if(!(Auth::guard('web')->user()))
<?php
$username = '';
$userid = '';
$userlocation = '';
?>
@else
<?php
//dd(Auth::guard('web')->user());
$username = Auth::guard('web')->user()->name;
$userid = Auth::guard('web')->user()->id;
$userlocation = Auth::guard('web')->user()->location;
?>
@endif




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
                <?php /* ?> <li><a href="javascript:void(0)" class="via-credit"><span>Via Credit Card</span></a></li><?php */ ?>
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
                                    <h3><img src="{{ URL:: asset('/plugins/front/img/paypal-icon.jpg')}}" alt="paypal"> <span><i class="fa fa-cart-arrow-down"></i> $<?php echo $cartGrandTotal ?></span></h3>
                                    <h2>Pay with PayPal <span>English</span></h2>
                                    <?php /* ?><form action='{{ url("user/paypal_process")}}' method="post"><?php */ ?>
                                    {!! Form::open(array('url' => "user/paypal_process" )) !!}
                                    <ul class="paypal-payment-form">
                                        <?php /* ?> <li><input type="text" placeholder="Email"></li>
                                          <li><input type="text" placeholder="Password"></li>
                                          <li class="pws-checkbox">
                                          <input type="checkbox" id="faster" checked="checked" />
                                          <label for="faster">Stay logged in for faster checkout <span>?</span></label>
                                          </li><?php */ ?>
                                        <li><input type="submit" value="Proceed to Payment" class="login"></li>
                                        <?php /* ?> <li><a href="#">Having trouble logging in?</a></li> 
                                          <li> <div class="check-or"><span>or</span></div></li>
                                          <li><a href="#" class="newtopaypal">New to PayPal</a></li><?php */ ?>
                                        <li><p>Securly pay using your debit, credit or prepaid card.</p></li>
                                    </ul>
                                    <?php /* ?></form><?php */ ?>
                                    <input type="hidden" name="address_id" value="<?php echo $address_id; ?>" />
                                    {!! Form::close() !!}
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


