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
                <div class="product-added-info">
                   [Product Name] was just successfully added to your cart!
                </div>
                <!-- End of product-added-info -->
              </div>
              <!-- End of cart-added-section -->
            </div>

            <div class="col-sm-9">
              <div class="outlined-container">
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


                <!-- End of shopping-card -->
              </div>
              <!-- END of outlined-container -->
              <div class="saved-cart-wrapper">
                <h2>Your Saved Adverts <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></h2>
                <div class="shopping-card">
                  <div class="row">
                    <div class="col-md-3 col-sm-4">
                      <img src="{!! asset('plugins/front/img/sc-item-4.png') !!}" alt="" class="img-responsive" />
                    </div>
                    <div class="col-md-9 col-sm-8">
                      <div class="row">
                        <div class="col-sm-6">
                          <h3>Mlele Cylinder Vacuum</h3>
                          <ul class="item-info-list">
                            <li>Condition: New</li>
                            <li>Quantity: 1</li>
                            <li><span class="user-icon"><img src="{!! asset('plugins/front/img/user-icon.png') !!}" alt="" /></span> Seller: [Seller Name]</li>
                          </ul>
                          <!-- END of item-info-list -->
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
              </div>

              <div class="saved-cart-wrapper">
                <h2>Your Saved Adverts <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></h2>
                <p>You currently have no saved items. You can click on the heart icon next to every advert and it will have into your cart! Happy Shopping!</p>
              </div>
              <!-- END of saved-cart-wrapper -->

              <div class="total-amt-section">
                <div class="row">
                  <div class="col-sm-offset-2 col-sm-10">
                    <p>Subtotal (3) Items:  $309.98</p>
                    <p>Delivery to North Melbourne, 3051: $44.97</p>
                    <div class="total-amt">
                      Total: $354.95
                    </div>
                  </div>
                </div>
              </div>
              <!-- End of total-amt-section -->

              <div class="bottom-footer-btns">
                <div class="row">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="row">
                      <div class="col-sm-6">
                        <a href="#" class="btn-outlined full-width">Continue Shopping</a>
                      </div>
                      <div class="col-sm-6">
                        <a href="#" class="btn-filled full-width">Proceed to Checkout</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END of bottom-footer-btns -->
            </div>

            <div class="col-sm-3">
              <div class="sidebar-cart-section">
                <h3>Cart Summary</h3>
                <small>3 items</small>
                <div class="total">
                  Total: $500
                </div>
                <a href="#" class="btn-filled full-width">Proceed to Checkout</a>
              </div>
              <!-- End of sidebar-cart-section -->

              <div class="similar-jobs-right-sec">
                  <div class="sidebar-products-box">
                      <h2>Simliar Adverts</h2>
                      <div class="sidebar-products-list">
                          <div class="product-img-holder">
                            <img src="{!! asset('plugins/front/img/car-ad.jpg') !!}" alt="" class="img-responsive" />
                          </div>
                          <a href="#" class="product-title">Ad Name</a>
                          <div class="product-description"><p>Description</p></div>
                          <ul class="breadcrumb">
                              <li><a href="#">Home</a> </li>
                              <li><a href="#">Breadcrumb</a> </li>
                              <li><a href="#">Ad ID 12345678</a> </li>
                          </ul>
                          <div class="sidebar-product-save">
                              <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                              <h4>Locations <br>5 hours ago</h4>
                          </div>
                      </div>


                      <div class="sidebar-products-list">
                          <div class="product-img-holder">
                            <img src="{!! asset('plugins/front/img/car-ad.jpg') !!}" alt="" class="img-responsive" />
                          </div>
                          <a href="#" class="product-title">Ad Name</a>
                          <div class="product-description"><p>Description</p></div>
                          <ul class="breadcrumb">
                              <li><a href="#">Home</a> </li>
                              <li><a href="#">Breadcrumb</a> </li>
                              <li><a href="#">Ad ID 12345678</a> </li>
                          </ul>
                          <div class="sidebar-product-save">
                              <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                              <h4>Locations <br>5 hours ago</h4>
                          </div>
                      </div>

                      <div class="btn-sec">
                          <a href="#">See More</a>
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
