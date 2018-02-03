<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Order Confirmation</title>
    </head>
    <body>
        <center>
            <table width="600" background="#FFFFFF" style="text-align:left;" cellpadding="0" cellspacing="0">
<?php
 $username = Auth::guard('web')->user()->name;
  $useremail = Auth::guard('web')->user()->email;
?>
                <tr>
                    <td colspan="3">
                        <!--CONTENT STARTS HERE-->
                        <br />
                        <br />
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding-right:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;" valign="top">
                                    <p>Hello {{$seller_name}},</p>
                                    <br/>
                                    <br/><br/>
                                    <p>Order ID: {{$values['order_id']}}</p>
                                    <br/><br/>
                                    <p>
                                    Buyer Pickup Date:- {{$values['buyer_pick_date']}} <br />
                                    Buyer Pickup Time:- {{$values['buyer_pick_time']}} <br />
                                    </p>
                                    <p>
                                    Message from Buyer:- <br />
                                    {{$values['buyer_msg']}}
                                    </p>
                                    
                                    Thanks,
                                    {{  $username}}, <br />
                                    {{ $useremail}}
                                </td>

                            </tr>
                             
                        </table>
                    </td>
                </tr>
            </table>
            <br />

        </center>
    </body>
</html>