<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>User message</title>
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
                                    <span style="font-family:Trebuchet MS, Verdana, Arial; font-size:17px; font-weight:bold;">Hi <?php echo $userdata['name'] ?>,</span>
                                    <br />
                                    <p><?php echo $userdata['massage'] ?> </p>

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