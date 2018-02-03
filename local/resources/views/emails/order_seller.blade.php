<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Order Confirmation</title>
    </head>
    <body>
        <center>
            <table width="600" background="#FFFFFF" style="text-align:left;" cellpadding="0" cellspacing="0">

                <tr>
                    <td colspan="3">
                        <!--CONTENT STARTS HERE-->
                        <br />
                        <br />
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding-right:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;" valign="top">
                                    <p>You have recevied an Order on Formee. Here is your Order details below:</p>
                                    <br/>
                                    <br/><br/>
                                    <table cellpadding="0" cellspacing="0">
                                    <tr>
                                    <td>Product Name</td>
                                    <td>Product Qty.</td>
                                    <td>Product Total Price (including shipping)</td>
                                    <td>Shipping Method/Cost</td>
                                    <td>Seller Name</td>
                                    </tr>
                                    <?php
									$GrandTotal = 0;
									$totalShipping = 0;
									 ?>
                                   
                                    <tr>
                                    <td>{{ $orderDetails->product_name }}</td>
                                    <td>{{ $orderDetails->item_qty }}</td>
                                    <td>${{ $orderDetails->item_total_amt }} </td>
                                    <td>{{ $orderDetails->item_ship_name }} / ${{ $orderDetails->item_ship_cost }}</td>
                                    <td>{{ $orderDetails->seller_name }}</td>
                                    </tr>
                                    <tr>
                                    <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <?php
									$GrandTotal += $orderDetails->item_total_amt ;
									?>
                                   
                                    <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td>Grand Total:</td>
                                    <td>$<?php echo $GrandTotal; ?></td>
                                    </tr>
                                    </table>
                                   
                                </td>

                            </tr>
                             <tr>
                            <td>&nbsp; </td></tr>
                            <tr>
                            <td>Customer Address:</td></tr>
                            <tr>
                            <td>
                           <table cellpadding="0" cellspacing="0">
                           	<tr>
                            <td> {{ $ordertb->customer_fname }} &nbsp; {{ $ordertb->customer_lname }}, <br />
                            {{ $ordertb->customer_address1 }} , <br />
                            {{ $ordertb->customer_address2 }} , <br />
                            {{ $ordertb->customer_city }}, {{ $ordertb->customer_state }} - {{ $ordertb->customer_postcode }} <br />
                            {{ $ordertb->customer_country }} 
                            
                            </td>
                            </tr>
                           </table>
                            </td>
                            </tr>
                            <tr>
                            <td> </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br />
Thanks, Formee
        </center>
    </body>
</html>