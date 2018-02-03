<style>
    .error-message{color:#dd4b39;}
    .message{color:rgb(60, 141, 188);}
    .sel-box{
        position:relative;
    }

    #myselect{display:block; width:100%; /*height:20px;*/ border:1px solid #d2d6de; padding:5px; overflow: hidden; } .toc-odd{position:absolute; top:32px; background:#fff; width:100%; display:none; border:1px solid #999; z-index: 9; max-height: 187px; overflow: auto; } .toc-odd li{padding:5px 10px; border-bottom:1px solid #999; list-style: none; } .toc-odd li:hover{background: #f4f4f4; } .toc-odd li a{text-decoration:none; display: block; color: #181818; } .toc-odd li a span {display: inline-block; width: 15px; height: 15px; float: right; margin-top: 2px; }
</style>
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit {{ $modelTitle}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url("/admin/$viewName") }}">{{$modelTitle}}</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!--column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>

                <!-- /.box-header -->
                <!-- form start -->    

                
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Invoice ID : </label>    
                        {!! Form::input('text', '', $result->id, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Order ID : </label>    
                        {!! Form::input('text', '', $result->order_id, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Customer name : </label> 
                        <?php
						$custname = $orderData[0]['customer_fname']. " ".  $orderData[0]['customer_lname'] ;
						?>   
                        {!! Form::input('text', '', $custname, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Customer Address : </label>    
                        <?php
						$custAdd = $orderData[0]['customer_address1']. ", ".  $orderData[0]['customer_address2'] ;
						?>
                        {!! Form::input('text', '', $custAdd, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Customer City : </label>    
                        {!! Form::input('text', '', $orderData[0]['customer_city'], ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Customer State : </label>    
                        {!! Form::input('text', '', $orderData[0]['customer_state'], ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Customer Country : </label>    
                        {!! Form::input('text', '', $orderData[0]['customer_country'], ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Classified ID : </label>    
                        {!! Form::input('text', '', $result->classified_id, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name : </label>    
                        {!! Form::input('text', '', $result->item_name, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ordered Quantity : </label>    
                        {!! Form::input('text', '', $result->item_qty, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Unit Price : </label>    
                        {!! Form::input('text', '', '$'.$result->item_price, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product total amount : </label>    
                        {!! Form::input('text', '', '$'.$result->item_total_amt, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Seller ID : </label>    
                        {!! Form::input('text', '', $result->seller_id, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Order Create Date : </label>    
                        {!! Form::input('text', '', $result->created_at, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                    </div>
                    
                    <?php
					if($orderData[0]['paypal_paykey'] != '' || $orderData[0]['paypal_paykey'] != NULL){ //PayPal Order
					?>
						
                        <div class="form-group">
                        <label for="exampleInputEmail1">Shipping Details : </label>    
                        {!! Form::input('text', '', $result->item_ship_name ." / $".$result->item_ship_cost , ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                   		 </div>  
                        <div class="form-group">
                        <label for="exampleInputEmail1">PayPal Transaction ID : </label>    
                        {!! Form::input('text', '', $result->transaction_id, ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                   		 </div>                    
                    
                    <?php
					}else{ //picknpay?>
                    	<div class="form-group">
                        <label for="exampleInputEmail1">Buyer Pickup Date and Time : </label>    
                        {!! Form::input('text', '', $result->buyer_pick_date ."   ".$result->buyer_pick_time , ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                   		 </div>  
                        <div class="form-group">
                        <label for="exampleInputEmail1">Pickup location : </label>    
                        {!! Form::input('text', '', $result->pickup_location , ['class' => 'form-control textRequired', 'disabled'=>'disabled']) !!}
                   		 </div>   
                    
                    <?php } ?>


                </div>
                <!-- /.box-body -->


               
               
            </div>
            <!-- /.box -->

        </div>
        <!--/.col -->        
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->	

@stop

@section('scripts')
<script>
    $('body').on('focus', ".datepicker", function () {
        $(this).datepicker();
    });

</script>
@stop
