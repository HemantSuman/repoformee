@extends('front/layout/layout')
@section('content')

<?php //dd($result); ?>
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
                <h4><?php if($username!=''){ echo '['.$username.']'; } ?> Checkout</h4>
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
                  <div class="congrts-icon"><img src="{{ URL:: asset('/plugins/front/img/oops-payment.png')}}" alt="img"> </div>
                  <h3>OOPS! Something seems to have gone wrong!</h3>
                  <p>Please go back and try to check out again.</p>
                  <div class="review-order"><a href="{{ url('cart')}}">Back to Payment</a></div>                
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
