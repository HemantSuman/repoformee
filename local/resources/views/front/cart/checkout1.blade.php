@extends('front/layout/layout')
@section('content')

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
    ?>
    @else
    <?php
//    dd($cartItems->cart_hm_cart_classified[0]->cart_bt_cart_classified->classified_image[0]->name);
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
                            <h4><?php
                                if (Auth::guard('web')->user()->name != ' ') {
                                    echo Auth::guard('web')->user()->name;
                                } else {
                                    echo Auth::guard('web')->user()->email;
                                }
                                ?> 
                                Shopping Cart</h4>
                        </div>
                        <!-- End of cart-added-section -->
                    </div>
                    <div class="dy_checkout_steps">
                        <div class="col-sm-12">
                            <ul class="checkout-steps">
                                <li class="active"><a href="javascript:void(0);">Step 1</a></li>
                                <li><a href="javascript:void(0);">Step 2</a></li>
                                <li><a href="javascript:void(0);">Step 3</a></li>
                                <li><a href="javascript:void(0);">Step 4</a></li>
                            </ul>
                            <!-- End of checkout-steps -->
                        </div>

                        <div class="col-sm-12 col-md-8">
                            {!! Form::open(array("url" => "user/checkout_2", "role" => "form", 'files' => true, 'id'=>'checkout1_form_id')) !!} 
                            <input type="hidden" class="cart_id" value="{{$cartItems->id}}" name="cart_id" >
                            <div class="outlined-container">
                                <h2 class="heading">Review Shopping Cart and Shipping</h2>
                                <?php
                                $cartItemTotal = 0;
                                $cartItemShipTotal = 0;
                                $shipping_total = 0;
                                ?>
                                @foreach($cartItems->cart_hm_cart_classified as $key => $value)
                                <?php
                                $image_name = $value->cart_bt_cart_classified->classified_image[0]->name;
                                $price = $value->cart_bt_cart_classified->price;
                                $price_with_shipping = $price * $value->qty;

                                $cartItemTotal += $price_with_shipping;
                                $cartItemShipTotal = $cartItemShipTotal + $price_with_shipping + $value->ship_cost;
                                $shipping_total = $shipping_total + $value->ship_cost;
                                ?>
                                <div class="shopping-card item_div">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4">
                                            <img src='{{ url("/upload_images/classified/$value->classified_id/$image_name") }}' alt="" class="img-responsive" />
                                        </div>
                                        <input type="hidden" class="price_val" value="{{$value->cart_bt_cart_classified->price}}" name="cart_classified[{{$value->id}}][price]" >
                                        <input type="hidden" class="classified_id" value="{{$value->classified_id}}" name="cart_classified[{{$value->id}}][classified_id]" >
                                        <input type="hidden" class="qty" value="{{$value->qty}}" name="cart_classified[{{$value->id}}][qty]" >
                                        <input type="hidden" class="shipping_name" value="{{$value->ship_name}}" name="cart_classified[{{$value->id}}][shipping_name]" >
                                        <div class="col-md-9 col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3>{{$value->cart_bt_cart_classified->title}}</h3>
                                                    <ul class="item-info-list">
                                                        <li>Condition: Used-Like New</li>
                                                        <li>Quantity: {{$value->qty}}</li>
                                                        <li>
                                                            <span class="user-icon">
                                                                <img src='{{ url("/plugins/front/img/user-icon.png") }}' alt="" />
                                                            </span>
                                                            Seller: [{{$value->cart_bt_cart_classified->contact_name}}]
                                                        </li>
                                                    </ul>
                                                    <!-- END of item-info-list -->

                                                    <ul class="radio-list">
                                                        @if($value->cart_bt_cart_classified->shipping)
                                                        <?php if ($value->cart_bt_cart_classified->ship_name_1 != '') { ?>
                                                            <li>
                                                                <div class="custom-radio">
                                                                    <label for="st-post-1_{{$value->classified_id}}">
                                                                        <input name="cart_classified[{{$value->id}}][shipping]" shipping_name="{{$value->cart_bt_cart_classified->ship_name_1}}" class="ship_radio" <?php echo ($value->cart_bt_cart_classified->ship_name_1 == $value->ship_name) ? 'checked' : ''; ?> type="radio" id="st-post-1_{{$value->classified_id}}" value="{{$value->cart_bt_cart_classified->ship_amount_1}}"  >
                                                                        <?php echo $value->cart_bt_cart_classified->ship_name_1 ?> - $<?php echo $value->cart_bt_cart_classified->ship_amount_1; ?>
                                                                        <span class="icon"></span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if ($value->cart_bt_cart_classified->ship_name_2 != '') { ?>
                                                            <li>
                                                                <div class="custom-radio">
                                                                    <label for="st-post-2_{{$value->classified_id}}">
                                                                        <input name="cart_classified[{{$value->id}}][shipping]" shipping_name="{{$value->cart_bt_cart_classified->ship_name_2}}" class="ship_radio" <?php echo ($value->cart_bt_cart_classified->ship_name_2 == $value->ship_name) ? 'checked' : ''; ?> type="radio" id="st-post-2_{{$value->classified_id}}" value="{{$value->cart_bt_cart_classified->ship_amount_2}}"  >
                                                                        <?php echo $value->cart_bt_cart_classified->ship_name_2 ?> - $<?php echo $value->cart_bt_cart_classified->ship_amount_2; ?>
                                                                        <span class="icon"></span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if ($value->cart_bt_cart_classified->ship_name_3 != '') { ?>
                                                            <li>
                                                                <div class="custom-radio">
                                                                    <label for="st-post-3_{{$value->classified_id}}">
                                                                        <input name="cart_classified[{{$value->id}}][shipping]" shipping_name="{{$value->cart_bt_cart_classified->ship_name_3}}" class="ship_radio" <?php echo ($value->cart_bt_cart_classified->ship_name_3 == $value->ship_name) ? 'checked' : ''; ?> type="radio" id="st-post-3_{{$value->classified_id}}" value="{{$value->cart_bt_cart_classified->ship_amount_3}}"  >
                                                                        <?php echo $value->cart_bt_cart_classified->ship_name_3 ?> - $<?php echo $value->cart_bt_cart_classified->ship_amount_3; ?>
                                                                        <span class="icon"></span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php } ?>

                                                        @else
                                                        <li>
                                                            <div class="custom-radio">
                                                                <label for="st-post-3_{{$value->classified_id}}">
                                                                    <input name="cart_classified[{{$value->id}}][shipping]" shipping_name="" class="ship_radio" checked="checked" type="radio" id="st-post-3_{{$value->classified_id}}" value="0"  >
                                                                    Free - $0
                                                                    <span class="icon"></span>
                                                                </label>
                                                            </div>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                    <!-- END of radio-list -->
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="price">
                                                        <span>${{$price_with_shipping}}</span>
                                                    </div>
                                                    <div class="shipping-price">
                                                        Shipping Cost: +$<span class="shipping_per_item">{{$value->ship_cost}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if (!isset($value->cart_id)) {
                                            $cart_id = 0;
                                        } else {
                                            $cart_id = $value->cart_id;
                                        }
                                        ?>
                                        <div class="col-sm-12">
                                            <ul class="user-action">
                                                <li>
                                                    <a href='{{ url("removeitem", ["id" => $value->classified_id, "cartid" => $value->cart_id] )}}' 
                                                       onclick="return confirm('Are you sure to remove this product from cart?')">
                                                        Remove
                                                    </a></li>
                                                <li><a href="javascript:void(0)" class="add-wishlist-cart" data-id="{{ $value->classified_id }}" >Save for Later</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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
                            @if($promoCodes)
                            <div class="voucher-section promo_div">
                                <div class="row">
                                    <div class="col-sm-6"><h4>Add your voucher code:</h4></div>
                                    <div class="col-sm-4"><input type="text" class="form-control promocode_input" name="promo_code" /> </div>
                                    <div class="col-sm-2"><a href="javascript:void(0);" class="btn-filled full-width promo_apply">Apply</a> </div>
                                </div>
                            </div>
                            @endif
                            <!-- END of voucher-section -->

                        </div>
                        {!! Form::close() !!}
                        <div class="col-sm-12 col-md-4">
                            <div class="sidebar-cart-section checkout-cart-section">
                                <h3>Cart Summary</h3>
                                <small>Subtotal ({{count($cartItems->cart_hm_cart_classified)}}) Items:  $ <span class="item_total">{{$cartItemTotal}}</span></small>
                                <small>Delivery to <?php echo $userlocation ?>: $ <span class="shipping_total">{{$shipping_total}}</span></small>
                                <small>Formee Voucer -$<span class="doscounted_value">0.00</span></small>
                                <div class="total">
                                    Total: $<span class="cart_item_ship_total">{{$cartItemShipTotal}}</span>
                                </div>
                                <a href="javascript:void(0);" class="btn-filled full-width checkout_1_submit">Proceed to Delivery Information</a>
                            </div>
                            <!-- End of sidebar-cart-section -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <span class="promocodes_json" style="display: none;"></span>

</div>




@stop

@section('scripts')

<script type="text/javascript">

    $(document).on('change', '.ship_radio', function () {

        checkshipment();

    });

    $(document).on('click', '.checkout_1_submit', function () {


        $('#checkout1_form_id').submit();

    });

    $(document).on('click', '.edit_address', function () {

        var address_id = $(this).attr('address_id');

        get_address_form(address_id);

    });

    $(document).on('click', '.deliver_with_address', function () {

        var address_id = $(this).attr('address_id');

        get_third_step_checkout(address_id);

    });

    $(document).on('click', '.delete_address', function () {
        
        var thisObj = $(this);
        var address_id = $(this).attr('address_id');

        $.ajax({
            url: root_url + '/user/cart/delete_user_address',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                address_id: address_id,
            },
            method: "POST",
            cache: false,
            success: function (response)
            {
                $(thisObj).parents('.address_single_div').remove();
                var address_json = $('.address_json').text();
                var address_json_obj = JSON.parse(address_json);
                
                delete address_json_obj[address_id];
                
                console.log(JSON.stringify(address_json_obj));
                
                $('.address_json').text(JSON.stringify(address_json_obj));
                get_address_form('');
            }
        });

    });

    function get_address_form(address_id) {

        var address_json = $('.address_json').text();
        var address_json_obj = JSON.parse(address_json);
        var show_address_form = false;

        var address_length = Object.keys(address_json_obj).length;

        if (address_id != '') {
            var show_address_form = true;
            var address_values = address_json_obj[address_id][0];
        } else {
            if (address_length < 2) {
                var show_address_form = true;

                var address_values = {};
                address_values.fname = '';
                address_values.lname = '';
                address_values.address_1 = '';
                address_values.address_2 = '';
                address_values.city = '';
                address_values.state = '';
                address_values.country = '';
                address_values.postalcode = '';
            }

        }

        console.log(address_values);
        if (show_address_form) {
            var address_form_html = '';
            if (address_id != '') {
                address_form_html += "<h3>Edit delivery address:</h3>";
                address_form_html += "<input name='address_id' class='address_id' value='" + address_id + "' type='hidden' >";
            } else {
                address_form_html += "<h3>Add a new delivery address:</h3>";
                address_form_html += "<input name='address_id' class='address_id' value='" + address_id + "' type='hidden' >";
            }
            address_form_html += "<ul class='add-new-address-form'>";

            address_form_html += "<li>";
            address_form_html += "<label>First Name</label>";
            address_form_html += "<input name='fname' class='fname' value='" + address_values['fname'] + "' type='text' >";
            address_form_html += "<span class='fname_error error_span'></span>";
            address_form_html += "</li>";

            address_form_html += "<li>";
            address_form_html += "<label>Last Name</label>";
            address_form_html += "<input name='lname' class='lname' value='" + address_values['lname'] + "' type='text' >";
            address_form_html += "<span class='lname_error error_span'></span>";
            address_form_html += "</li>";

            address_form_html += "<li>";
            address_form_html += "<label>Address Line 1</label>";
            address_form_html += "<input name='address_1' class='address_1' value='" + address_values['address_1'] + "' type='text' >";
            address_form_html += "<span class='address_1_error error_span'></span>";
            address_form_html += "</li>";

            address_form_html += "<li>";
            address_form_html += "<label>Address Line 2</label>";
            address_form_html += "<input name='address_2' class='address_2' value='" + address_values['address_2'] + "' type='text' >";
            address_form_html += "<span class='address_2_error error_span'></span>";
            address_form_html += "</li>";

            address_form_html += "<li>";
            address_form_html += "<label>City</label>";
            address_form_html += "<input name='city' class='city' value='" + address_values['city'] + "' type='text' >";
            address_form_html += "<span class='city_error error_span'></span>";
            address_form_html += "</li>";

            address_form_html += "<li>";
            address_form_html += "<label>State</label>";
            address_form_html += "<input name='state' class='state' value='" + address_values['state'] + "' type='text' >";
            address_form_html += "<span class='state_error error_span'></span>";
            address_form_html += "</li>";

            address_form_html += "<li>";
            address_form_html += "<label>Country</label>";
            address_form_html += "<input name='country' class='country' value='" + address_values['country'] + "' type='text' >";
            address_form_html += "<span class='country_error error_span'></span>";
            address_form_html += "</li>";

            address_form_html += "<li>";
            address_form_html += "<label>Postcode</label>";
            address_form_html += "<input name='postalcode' class='postalcode' value='" + address_values['postalcode'] + "' type='text' >";
            address_form_html += "<span class='postalcode_error error_span'></span>";
            address_form_html += "</li>";

            address_form_html += "<li>";
            address_form_html += "<input type='button' value='Deliver to this address' class='checout-btn deliver_with_form'>";
            address_form_html += "</li>";
            address_form_html += "</ul>";

            $('.address_form_div').html(address_form_html);
            $('html, body').animate({
                scrollTop: $('.address_form_div').offset().top - 120
            }, 1000);
        }


    }

    $(document).on('submit', "#checkout1_form_id", function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response)
            {
                $('.dy_checkout_steps').html(response);

                get_address_form('');

                var address_json = $('.address_json').text();

                if (address_json != '') {

                    var address_json_obj = JSON.parse(address_json);
                    console.log(Object.keys(address_json_obj).length);

                    var address_length = Object.keys(address_json_obj).length;
                    if (address_length >= 1) {
                        $('.address_div').html('');

                        $.each(address_json_obj, function (index, value) {
                            console.log(value[0])
                            var add_html = "";
                            add_html += "<div class='col-sm-12 col-md-6 address_single_div'>";
                            add_html += "<div class='checkout-address-box'>";
                            add_html += "<h2>" + value[0]['fname'] + " " + value[0]['lname'] + "</h2>";
                            add_html += "<p>" + value[0]['address_1'] + ", <br>";
                            add_html += "" + value[0]['address_2'] + ", <br>";
                            add_html += "" + value[0]['city'] + " , " + value[0]['state'] + ", <br>";
                            add_html += "" + value[0]['postalcode'] + "</p>";
                            add_html += "<ul class='checkout-btns'>";
                            add_html += "<li><a address_id='" + value[0]['id'] + "' class='deliver_with_address' href='javascript:void(0);'>Deliver to this address</a></li>";
                            add_html += "<li><a address_id='" + value[0]['id'] + "' class='edit_address' href='javascript:void(0);'>Edit</a></li>";
                            add_html += "<li><a address_id='" + value[0]['id'] + "' class='delete_address' href='javascript:void(0);'>Delete</a></li>";
                            add_html += "</ul></div></div>";
                            $('.address_div').append(add_html);

                        });

                    }
                }


            }

        });

    });

    $(document).on('click', '.deliver_with_form', function () {

        $('.error_span').text('');

        var errorObj = true;

        var address_id = $('.address_id').val();
        var fname = $('.fname').val();
        var lname = $('.lname').val();
        var address_1 = $('.address_1').val();
        var address_2 = $('.address_2').val();
        var city = $('.city').val();
        var state = $('.state').val();
        var country = $('.country').val();
        var postalcode = $('.postalcode').val();

        if (fname == '') {
            $('.fname_error').text('This field is required!');
            errorObj = false;
        }
        if (lname == '') {
            $('.lname_error').text('This field is required!');
            errorObj = false;
        }
        if (address_1 == '') {
            $('.address_1_error').text('This field is required!');
            errorObj = false;
        }
        if (address_2 == '') {
            $('.address_2_error').text('This field is required!');
            errorObj = false;
        }
        if (city == '') {
            $('.city_error').text('This field is required!');
            errorObj = false;
        }
        if (state == '') {
            $('.state_error').text('This field is required!');
            errorObj = false;
        }
        if (country == '') {
            $('.country_error').text('This field is required!');
            errorObj = false;
        }
        if (postalcode == '') {
            $('.postalcode_error').text('This field is required!');
            errorObj = false;
        }

        if (errorObj) {

            $.ajax({
                url: root_url + '/user/cart/save_user_address',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    address_id: address_id,
                    fname: fname,
                    lname: lname,
                    address_1: address_1,
                    address_2: address_2,
                    city: city,
                    state: state,
                    country: country,
                    postalcode: postalcode,
                },
                //dataType: "html",
                method: "POST",
                cache: false,
                success: function (response) {

                    if (response.status) {

                        get_third_step_checkout(response.results);


                    } else {
                        if (response.message != '') {
                            Notify.showNotification(response.message);
                        }

                    }
                }

            });

        }

    });

    function get_third_step_checkout(address_id) {

        $.ajax({
            url: root_url + '/user/checkout_3',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                address_id: address_id,
            },
            //dataType: "html",
            method: "POST",
            cache: false,
            success: function (response1) {
                console.log(address_id);
                $('.dy_checkout_steps').html(response1);
            }
        });

    }

    function checkshipment() {
        var item_total = 0;
        var shipping_total = 0;
        var doscounted_value = 0;
        var promocodes_json = $('.promocodes_json').text();

        $('.item_div').each(function (index, value) {

            var classified_id = $('.classified_id', value).val();
            var price_val = $('.price_val', value).val();
            var qty = $('.qty', value).val();

            var price_with_qty = parseFloat(price_val) * parseFloat(qty);
            var shipping_per_item = $('.ship_radio:checked', value).val();
            var shipping_name_per_item = $('.ship_radio:checked', value).attr('shipping_name');

            if (promocodes_json != '') {


                var promocodes_json_obj = JSON.parse(promocodes_json);

                if (classified_id == promocodes_json_obj['classified_id']) {

                    if (promocodes_json_obj['discount_type'] == 'Percentage') {
                        doscounted_value = parseFloat(parseFloat(price_val) * parseFloat(promocodes_json_obj['discount_value'])) / 100;
                    } else if (promocodes_json_obj['discount_type'] == 'Fix') {
                        doscounted_value = parseFloat(promocodes_json_obj['discount_value']);
                    }
                    price_with_qty = parseFloat(price_with_qty) - parseFloat(doscounted_value);
                }


            }

            item_total = parseFloat(item_total) + parseFloat(price_with_qty);
            shipping_total = parseFloat(shipping_total) + parseFloat(shipping_per_item);

            $('.shipping_per_item', value).html(shipping_per_item);
            $('.shipping_name', value).val(shipping_name_per_item);
        });

        $('.item_total').html(item_total);
        var cart_item_ship_total = parseFloat(item_total) + parseFloat(shipping_total);
        $('.doscounted_value').html(doscounted_value);

        $('.shipping_total').html(shipping_total);
        $('.cart_item_ship_total').html(cart_item_ship_total);

    }

    $(document).on('click', '.promo_apply', function () {

        $('.promocodes_json').text('');
        var promocode_input = $('.promocode_input').val();

        if (promocode_input != '') {
            $('.promo_div').removeClass('correct');
            $.ajax({
                url: root_url + '/user/promo_codes/apply_promo',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    promocode: promocode_input,
                },
                //dataType: "html",
                method: "POST",
                cache: false,
                success: function (response) {
                    if (response.status) {
                        $('.promo_div').addClass('correct');
                        $('.promocodes_json').text(JSON.stringify(response.promocodes));
                        checkshipment();

                    } else {
                        checkshipment();
                        $('.promo_div').removeClass('correct');
                        Notify.showNotification('Invalid promo codes!');
                    }
                }

            });
        }

    });

</script>
@stop
