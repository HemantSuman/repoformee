<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome Message</title>
</head>
<body>
<center>
<table width="600" background="#FFFFFF" style="text-align:left;" cellpadding="0" cellspacing="0">
<!--DOUBLE BORDERS BOTTOM-->

<tr>
	<td colspan="3">
	<!--CONTENT STARTS HERE-->
	<br />
	<br />
	<table cellpadding="0" cellspacing="0">
	<tr>
	<td style="padding-right:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;" valign="top">
	<span style="font-family:Trebuchet MS, Verdana, Arial; font-size:17px; font-weight:bold;">Hi <?php echo $user['name'] ?>,</span>
	<br />
    <p>Welcome to Formee.</p>    
	<p>Your request for change email is being processed. Please click below to update your email.</p>
	
	<a style="margin:0;width:250px;font-size:18px;text-decoration:none;display:block;padding:12px;border:1px solid #5193e2;color:#fff;text-align:center;border-radius:3px;background:#5ca6ff" href="<?php echo Request::root(); ?>/update-email/<?php echo $emailVerCode; ?>">Click here to update</a>
	<br/>
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