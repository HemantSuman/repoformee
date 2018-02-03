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
                <li class="active"><a href="#">Step 1</a></li>
                <li><a href="#">Step 2</a></li>
                <li><a href="#">Step 3</a></li>
                <li><a href="#">Step 4</a></li>
              </ul>
              <!-- End of checkout-steps -->
            </div>

            <div class="col-sm-12 col-md-8">
              <div class="outlined-container">
                <h2 class="heading">Review Shopping Cart and Shipping</h2>
                <div class="shopping-card">
                  <div class="row">
                    <div class="col-md-3 col-sm-4">
                      <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/sc-item-1.jpg" alt="" class="img-responsive" />
                    </div>
                    <div class="col-md-9 col-sm-8">
                      <div class="row">
                        <div class="col-sm-6">
                          <h3>Book  Collection</h3>
                          <ul class="item-info-list">
                            <li>Condition: Used-Like New</li>
                            <li>Quantity: 1</li>
                            <li><span class="user-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/user-icon.png" alt="" /></span> Seller: [Seller Name]</li>
                          </ul>
                          <!-- END of item-info-list -->

                          <ul class="radio-list">
                            <li>
                              <div class="custom-radio">
                                <label for="st-post-1">
                                  <input type="radio" id="st-post-1" value="" name="st-post">
                                  Standard Post - $14.40
                                  <span class="icon"></span>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="custom-radio">
                                <label for="st-post-2">
                                  <input type="radio" id="st-post-2" value="" name="st-post">
                                  Standard Post width Signature - $17.50
                                  <span class="icon"></span>
                                </label>
                              </div>
                              </li>
                            <li>
                              <div class="custom-radio">
                                <label for="st-post-3">
                                  <input type="radio" id="st-post-3" value="" name="st-post">
                                  Express Post - Next Business Day* - $23.20
                                  <span class="icon"></span>
                                </label>
                              </div>
                            </li>
                          </ul>
                          <!-- END of radio-list -->
                        </div>
                        <div class="col-sm-6">
                          <div class="price">
                            <span>$50.00</span>
                          </div>
                          <div class="shipping-price">
                            Shipping Cost: +$4.99
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <ul class="user-action">
                        <li><a href="#">Remove</a></li>
                        <li><a href="#">Save for Later</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- End of shopping-card -->

                <div class="shopping-card">
                  <div class="row">
                    <div class="col-md-3 col-sm-4">
                      <img src="http://192.168.100.242/suman/formeenew/plugins/front/img/sc-item-2.png" alt="" class="img-responsive" />
                    </div>
                    <div class="col-md-9 col-sm-8">
                      <div class="row">
                        <div class="col-sm-6">
                          <h3>5-Speed Diamond Blender</h3>
                          <ul class="item-info-list">
                            <li>Condition: New</li>
                            <li>Quantity: 1</li>
                            <li><span class="user-icon"><img src="http://192.168.100.242/suman/formeenew/plugins/front/img/user-icon.png" alt="" /></span> Seller: [Seller Name]</li>
                          </ul>
                          <!-- END of item-info-list -->
                          <ul class="radio-list">
                            <li>
                              <div class="custom-radio">
                                <label for="st-post-11">
                                  <input type="radio" id="st-post-11" value="" name="st-post0">
                                  Standard Post - $14.40
                                  <span class="icon"></span>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="custom-radio">
                                <label for="st-post-12">
                                  <input type="radio" id="st-post-12" value="" name="st-post0">
                                  Standard Post width Signature - $17.50
                                  <span class="icon"></span>
                                </label>
                              </div>
                              </li>
                            <li>
                              <div class="custom-radio">
                                <label for="st-post-13">
                                  <input type="radio" id="st-post-13" value="" name="st-post0">
                                  Express Post - Next Business Day* - $23.20
                                  <span class="icon"></span>
                                </label>
                              </div>
                            </li>
                          </ul>
                          <!-- END of radio-list -->
                        </div>
                        <div class="col-sm-6">
                          <div class="price">
                            <span>$159.99</span>
                          </div>
                          <div class="shipping-price">
                            Shipping Cost: +$19.99
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <ul class="user-action">
                        <li><a href="#">Remove</a></li>
                        <li><a href="#">Save for Later</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- End of shopping-card -->

                <div class="shopping-card">
                  <div class="row">
                    <div class="col-md-3 col-sm-4">
                      <img src="{!! asset('plugins/front/img/sc-item-3.png') !!}" alt="" class="img-responsive" />
                    </div>
                    <div class="col-md-9 col-sm-8">
                      <div class="row">
                        <div class="col-sm-6">
                          <h3>Dyson 65005 - 01 DC37C</h3>
                          <ul class="item-info-list">
                            <li>Condition: New</li>
                            <li>Quantity: 1</li>
                            <li><span class="user-icon"><img src="{!! asset('plugins/front/img/user-icon.png') !!}" alt="" /></span> Seller: [Seller Name]</li>
                          </ul>
                          <!-- END of item-info-list -->
                          <ul class="radio-list">
                            <li>
                              <div class="custom-radio">
                                <label for="st-post-14">
                                  <input type="radio" id="st-post-14" value="" name="st-post1">
                                  Standard Post - $14.40
                                  <span class="icon"></span>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="custom-radio">
                                <label for="st-post-15">
                                  <input type="radio" id="st-post-15" value="" name="st-post1">
                                  Standard Post width Signature - $17.50
                                  <span class="icon"></span>
                                </label>
                              </div>
                              </li>
                            <li>
                              <div class="custom-radio">
                                <label for="st-post-16">
                                  <input type="radio" id="st-post-16" value="" name="st-post1">
                                  Express Post - Next Business Day* - $23.20
                                  <span class="icon"></span>
                                </label>
                              </div>
                            </li>
                          </ul>
                          <!-- END of radio-list -->
                        </div>
                        <div class="col-sm-6">
                          <div class="price">
                            <span>$99.99</span>
                          </div>
                          <div class="shipping-price">
                            Shipping Cost: +$19.99
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <ul class="user-action">
                        <li><a href="#">Remove</a></li>
                        <li><a href="#">Save for Later</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- End of shopping-card -->
              </div>
              <!-- END of outlined-container -->

              <div class="bottom-footer-btns">
                <div class="row">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="row">
                      <div class="col-sm-offset-6 col-sm-6">
                        <a href="#" class="btn-outlined full-width">Continue Shopping</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END of bottom-footer-btns -->

              <div class="voucher-section correct">
                <div class="row">
                  <div class="col-sm-6"><h4>Add your voucher code:</h4></div>
                  <div class="col-sm-6"><input type="text" class="form-control" value="FOEMEEPROMO2017" /> </div>
                </div>
              </div>
              <!-- END of voucher-section -->

            </div>

            <div class="col-sm-12 col-md-4">
              <div class="sidebar-cart-section checkout-cart-section">
                <h3>Cart Summary</h3>
                <small>Subtotal (3) Items: $309.98</small>
                <small>Delivery to North Melbourne, 3051: $54.38</small>
                <small>Formee Voucer -$20.00 </small>
                <div class="total">
                  Total: $500
                </div>
                <a href="#" class="btn-filled full-width">Proceed to Delivery Information</a>
              </div>
              <!-- End of sidebar-cart-section -->
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
