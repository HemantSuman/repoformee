<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Welcome Message</title>
    </head>
    <body>
        <center>
            <table width="600" background="#FFFFFF" style="text-align:left;" cellpadding="0" cellspacing="0">

<!--<tr>
        <td height="2" width="31" style="border-bottom:1px solid #e4e4e4;">
        <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
        </td>
        <td height="2" width="131">
        <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
        </td>
        <td height="2" width="466" style="border-bottom:1px solid #e4e4e4;">
        <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
        </td>
</tr>-->
                <!--GREEN STRIPE-->
                <!--<tr>
                        <td background="images/greenback.gif" width="31" bgcolor="#45a853" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;" height="113">
                        <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
                        </td>
                        
                        WHITE TEXT AREA
                        <td width="131" bgcolor="#FFFFFF" style="border-top:1px solid #FFF; text-align:center;" height="113" valign="middle">
                        <span style="font-size:25px; font-family:Trebuchet MS, Verdana, Arial; color:#2e8a3b;">Success!</span>
                        </td>
                        
                        GREEN TEXT AREA
                        <td background="images/greenback.gif" bgcolor="#45a853" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF; padding-left:15px;" height="113">
                        <span style="color:#FFFFFF; font-size:18px; font-family:Trebuchet MS, Verdana, Arial;">Thank you for register.</span>
                        </td>
                </tr>-->

                <!--DOUBLE BORDERS BOTTOM-->

                <tr>
                    <td colspan="3">
                        <!--CONTENT STARTS HERE-->
                        <br />
                        <br />
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding-right:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;" valign="top">
                                    <span style="font-family:Trebuchet MS, Verdana, Arial; font-size:17px; font-weight:bold;">Hi <?php echo $userdata['name'] ?>,</span>
                                    <br />
                                    <p>Welcome to Formee.</p>
                                    <?php
                                    if (!empty($userdata['rolename'])) {
                                        $roledata = 'as ' . $userdata['rolename'];
                                        $url = Request::root() . '/admin/login';
                                    } else {
                                        $roledata = '';
                                        $url = Request::root() . '/';
                                    }
                                    ?>
                                    <p>Thank you for joining Formee. Your account has been Registered successfully <?php echo $roledata ?>.</p>

                                    <p>
                                        <table style="margin:0;width:500px;font-size: 13px;text-decoration:none;display:block;padding: 10px;border: 1px solid #CECECE;color: #181818;text-align:center;border-radius:3px;background: #E4E4E4;text-align: left;">
                                            <tbody>  
                                                <tr>
                                                    <td style=" padding: 5px 0;">Site Url:-</td>
                                                    <td style=" padding: 5px 0;"><a href="<?php echo $url ?>"><?php echo $url ?></a></td>
                                                </tr>
                                                <tr>
                                                    <td style=" padding: 5px 0;">Your Username:-</td>
                                                    <td style=" padding: 5px 0;"><?php echo $userdata['email'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style=" padding: 5px 0;">Your Password:-</td>
                                                    <td style=" padding: 5px 0;"><?php echo $userdata['password'] ?></td>
                                                </tr>
                                                </tbody>
                                        </table>

                                    </p>
                                    <br/>

                                    Best Regards,<br/>
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