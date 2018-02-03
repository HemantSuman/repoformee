@extends('front/layout/layout')
@section('content')

<?php //dd($cartItems);?>

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
	$username='';
	$userid='';
	$userlocation = '';
	?>
@else
<?php //dd(Auth::guard('web')->user());
	$username = Auth::guard('web')->user()->name;
    $userid = Auth::guard('web')->user()->id;
	$userlocation = Auth::guard('web')->user()->location;
	?>
@endif

    <section>
      <div id="main-inner-section">
        <div class="container">
          <div class="row">

            <div class="col-sm-offset-1 col-sm-10">
              <div class="cart-added-section">
                <h4><?php if($username!=''){ echo '['.$username.']'; } ?> Shopping Cart</h4>
                <div class="product-added-info" style="display:none;">
                   <?php /*?>[Product Name] was just successfully added to your cart!<?php */?>
                </div>
                <!-- End of product-added-info -->
              </div>
              <!-- End of cart-added-section -->
            </div>

            <div class="col-sm-12 col-md-9">
              <div class="outlined-container">
              <?php
			  $cartCount = 0;
				$cartSubTotal = 0;
				$cartGrandTotal = 0;
				$cartShipCost = 0;
				//dd($cartItems);
				if(isset($cartItems) && $cartItems!= ""){
					 $cartCount = count($cartItems);
			  ?>
              @foreach($cartItems as $key => $value)
              <?php
			  if(isset($value->price)){
			  	$prodsubtotal = ($value->qty) * ($value->price);
			  	$cartSubTotal += $prodsubtotal ;
			  	$cartShipCost += $value->ship_amount_1;
				$photo = $value->photo;
				$title = $value->title;
				$contact_name = $value->contact_name;
				$price = $value->price;
				$ship_amount = $value->ship_amount_1;
				$classified_id = $value->classified_id;
				$qty = $value->qty;
			  }else{
				  //dd($value->classified_id);
				  $items_AllValues = DB::table('classifieds')
				  ->select('classifieds.*', DB::raw('(select name from classifiedimage where classified_id  =   classifieds.id  order by id asc limit 1) as photo'))
				 // ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
				  ->where('classifieds.id', $value['classified_id'])->first();
				 //dd($items_AllValues);
				  $prodsubtotal = ($value['qty']) * ($items_AllValues->price);
			  	  $cartSubTotal += $prodsubtotal ;
			  	  $cartShipCost += $items_AllValues->ship_amount_1;
				  $photo = $items_AllValues->photo;
				  $title = $items_AllValues->title;
				  $contact_name = $items_AllValues->contact_name;
				  $price = $items_AllValues->price;
				  $ship_amount = $items_AllValues->ship_amount_1;
				  $classified_id = $value['classified_id'];
				  $qty = $value['qty'];
			  }
			  ?>
                <div class="shopping-card">
                  <div class="row">
                    <div class="col-md-3 col-sm-4">
                      <img src='{{ url("/upload_images/classified/$classified_id/$photo") }}' alt="" class="img-responsive" />
                    </div>
                    <div class="col-md-9 col-sm-8">
                      <div class="row">
                        <div class="col-sm-6">
                          <h3><?php echo $title?></h3>
                          <ul class="item-info-list">
                            <li>Condition: Used-Like New</li>
                            <li>Quantity: <?php echo $qty;?></li>
                            <li><span class="user-icon"><img src='{{ url("/plugins/front/img/user-icon.png") }}' alt="" /></span> Seller: [<?php echo $contact_name;?>]</li>
                          </ul>
                          <!-- END of item-info-list -->
                        </div>
                        <div class="col-sm-6">
                          <div class="price">
                            <span>$<?php echo $price?></span>
                          </div>
                          <div class="shipping-price">
                            Shipping Cost: +$<?php echo $ship_amount;?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <ul class="user-action">
                      <?php if(!isset($value->cart_id)){
						   $cart_id = 0;
					  }else{
						  $cart_id = $value->cart_id;
					  }?>
                        <li><a href='{{ url("removeitem", ["id" => $classified_id, "cartid" => $cart_id] )}}' onclick="return confirm('Are you sure to remove this product from cart?')">Remove</a></li>
                        <li><a href="javascript:void(0)" class="add-wishlist-cart" data-id="{{ $classified_id }}" >Save for Later</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- End of shopping-card -->
			  @endforeach
              	
               <?php
				}else{
				echo "No product in the Cart.";	
				}
			   $cartGrandTotal = $cartSubTotal + $cartShipCost ;
			   ?> 
       


                <!-- End of shopping-card -->
              </div>
              <!-- END of outlined-container -->
              <?php //dd($wishlistItems);?>
              @if(isset($wishlistItems) && $wishlistItems !='')
              <div class="saved-cart-wrapper">
                <h2>Your Saved Adverts <?php /*?><a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a><?php */?></h2>
               @foreach($wishlistItems as $key => $value)
                <div class="shopping-card">
                  <div class="row">
                    <div class="col-md-3 col-sm-4">
                      <img src={{ url("/upload_images/classified/$value->classified_id/$value->photo") }} alt="" class="img-responsive" />
                    </div>
                    <div class="col-md-9 col-sm-8">
                      <div class="row">
                        <div class="col-sm-6">
                          <h3><?php echo $value->title?></h3>
                          <ul class="item-info-list">
                            <li>Condition: New</li>
                            <li>Quantity: 1</li>
                            <li><span class="user-icon"><img src="{!! asset('plugins/front/img/user-icon.png') !!}" alt="" /></span> Seller: [<?php echo $value->contact_name;?>]</li>
                          </ul>
                          <!-- END of item-info-list -->
                        </div>
                        <div class="col-sm-6">
                          <div class="price">
                            <span>$<?php echo $value->price; ?></span>
                          </div>
                          <div class="shipping-price">
                            Shipping Cost: +$<?php echo $value->ship_amount_1; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <ul class="user-action">
                        <li><a href='{{ url("removeitem_wishlist", ["id" => $value->classified_id] )}}' onclick="return confirm('Are you sure to remove this product from cart?')">Remove</a></li>
                        <li><a href='{{ url("add_to_cart_wishlist", ["id" => $value->classified_id] )}}'>Add to Cart</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
               @endforeach 
              </div>
              
              @else

              <div class="saved-cart-wrapper">
                <h2>Your Saved Adverts <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></h2>
                <p>You currently have no saved items. You can click on the heart icon next to every advert and it will have into your cart! Happy Shopping!</p>
              </div>
              @endif
              <!-- END of saved-cart-wrapper -->

              <div class="total-amt-section">
                <div class="row">
                  <div class="col-md-offset-2 col-md-10 col-sm-12">
                    <p>Subtotal (<?php echo $cartCount; ?>) Items:  $<?php echo $cartSubTotal;?></p>
                    <p>Delivery to <?php echo $userlocation?>: $<?php echo $cartShipCost; ?></p>
                    <div class="total-amt">
                      Total: $<?php echo $cartGrandTotal; ?>
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

            <div class="col-sm-12 col-md-3">
              <div class="sidebar-cart-section">
                <h3>Cart Summary</h3>
                <small><?php echo $cartCount; ?> items</small>
                <div class="total">
                  Total: $<?php echo $cartGrandTotal; ?>
                </div>
                <a href="javascript:void(0);" class="btn-filled full-width proceed-checkout">Proceed to Checkout</a>
              </div>
              <!-- End of sidebar-cart-section -->
              @if(isset($similarClass) && count($similarClass) > 0)
              <div class="similar-jobs-right-sec cart-similar-job">
                  <div class="sidebar-products-box">
                      <h2>Simliar Adverts</h2>
                      @foreach($similarClass as $key => $value)
                      <div class="sidebar-products-list">
                          <div class="product-img-holder">
                              <?php
                              $seemore_link = "/classified-list/".preg_replace('/[^A-Za-z0-9-]+/', '-', $value['subcategoriesname']['name'])."/".$value['subcategoriesname']['id'];
                              $imagename = $value['classified_image'][0]['name'];
                              ?>
                              <a href="{{ url("/classifieds/".preg_replace('/[^A-Za-z0-9-]+/', '-', $value['title'])."/$value[id]") }}" class="">
                              <img src='{{ url("/upload_images/classified/$value[id]/$imagename") }}' class="img-responsive" />
                              </a>
                          </div>
                          <a href="{{ url("/classifieds/".preg_replace('/[^A-Za-z0-9-]+/', '-', $value['title'])."/$value[id]") }}" class="product-title">{{str_limit($value['title'], 20)}}</a>
                          <div class="product-description"><p>{{str_limit($value['description'],50)}}</p></div>
                          <ul class="breadcrumb">
<!--                              <li><a href="#">Home</a> </li>
                              <li><a href="#">Breadcrumb</a> </li>-->
                              <li><a href="javascript:void(0);">Ad ID {{$value['id']}}</a> </li>
                          </ul>
                          <div class="sidebar-product-save">
                              <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                              <h4>{{str_limit($value['location'],30)}} <br>{!! Helper::time_since(time() - strtotime($value['created_at'])) !!} ago</h4>
                          </div>
                      </div>
                      
                      @endforeach
                      <div class="btn-sec">
                          <a href="{{ url("$seemore_link") }}">See More</a>
                      </div>
                  </div>
              </div>
              @endif
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
