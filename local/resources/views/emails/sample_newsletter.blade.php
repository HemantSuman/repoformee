<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Formee</title>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet"> 
<style>
html {
    -webkit-text-size-adjust: none !important; / Prevent font scaling in landscape /
}
  @media screen and (max-width:568px) {
  table {width: 100%!important;}
img{
  max-width:100%!important; height:auto!important;}
  .view-link{ font-size:12px !important}
  .midtxt1{font-size:14px !important}
  .midtxt2{font-size:16px !important}
  .shop-link{font-size:13px !important}
  .logo img{ max-width:70% !important; height:auto !important}
  .CatName{font-size:14px !important}
  .Catdesc{font-size:14px !important}
  .locat{font-size:13px !important}
  .price{ font-size:13px !important}
  .emaillink{ font-size:13px !important}
  .copyright{ font-size:12px !important}
  .connecttxt{ font-size:15px !important}
  .time{ font-size:14px !important}
  
}
</style>
</head>

<body style="margin:0px; padding:0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" bgcolor="#f2f0f0" style="background-color:#f2f0f0; padding-top:20px; padding-bottom:20px;"><table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td align="center" valign="top" bgcolor="#fff" style="padding-top:20px; padding-bottom:20px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td valign="top">
                  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                      <td align="center" valign="top"><a href="{{ url('/') }}" class="logo"><img src="<?php echo Request::root().'/plugins/front/img/newsletter-img/logo.png'; ?>" width="188" height="69" style="display:block; border:0;"></a></td>
                      
                    </tr>
                  </table>
                 </td>
              </tr>
              <tr>
                <td align="center" valign="top" style="padding-top:15px;">
                  <table width="100%" bgcolor="#ef4b23" border="0" cellpadding="0" cellspacing="0" align="center">  
                    <!-- <tr>
                      <td style=" font-family:'Roboto', sans-serif; font-size:21px; line-height:30px; color:#fff;text-align:center; font-weight:300; padding-top:65px;" class="midtxt1"><p style="margin:0">There are new results matching your search weekly</p></td>
                    </tr> -->
                     <tr>
                      <td style=" font-family:'Roboto', sans-serif; font-size:32px;color:#fff;  font-weight:bold;text-align:center; padding-top:15px; padding-bottom:15px;" class="midtxt2"><p style="margin:0">{{ $title }} </p></td>
                    </tr>
                    <!-- <tr>
                      <td align="center" style="padding-bottom:55px; padding-top:10px;font-family:'Roboto', sans-serif;">
                            <a href="#" style="color:#fff; display:block; text-align:center; text-decoration:none; text-transform:uppercase; max-width:275px; width:100%; padding:10px 0; border:1px solid #fff" class="shop-link">shop now</a>
                        </td>
                    </tr> -->
                      
                    </table>
                </td>
              </tr>
              <tr>
                <td  style="background:#edeaea; padding-top:30px; padding-bottom:30px;">
                  <table width="90%" align="center"  cellpadding="0" cellspacing="0" bgcolor="#edeaea">
                      <tr>
                          <td style="" align="center" valign="middle"><h2 style="font-family:'Roboto', sans-serif; font-size:32px;color:#000;  font-weight:bold;text-align:center; margin:0">Neque porro quisquam est qui
dolorem ipsum quia dolor sit amet. </h2></td>
                            
                            
                        </tr>
                        
                        <tr>
                          <td style="padding-top:15px;" align="center" valign="middle"><h4 style="font-family:'Roboto', sans-serif; font-size:26px;color:#000;  font-weight:bold;text-align:center; margin:0">What is Lorem Ipsum?</h4></td>
                        </tr>
                        <tr>
                          <td style="padding-top:15px;" align="center" valign="middle"><p style="font-family:'Roboto', sans-serif; font-size:15px;color:#000;  font-weight:400;text-align:center; margin:0; line-height:130%"><?php echo $body; ?></p></td>
                        </tr>
                        <tr>
                          <td style="padding-top:15px; padding-bottom:10px;" align="center" valign="middle">
                              <table width="250px" align="center" cellpadding="0" cellspacing="0" border="0">
                                
                                <tr><td><a href="#" style="font-family:'Roboto', sans-serif;  background:#EF4B23; display:block; padding:10px 0; text-align:center; color:#fff; font-size:15px; width:100%;">Learn More</a></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
              </tr>
              
              
              
              
              
              <tr>
                <td style=" background:#2d2544; padding-top:10px; padding-bottom:10px;">
                  <table cellpadding="0" cellspacing="0" border="0" width="80%" style="margin:0 auto" align="center">
                      <tr>
                          <td class="connecttxt" style="font-size:20px; font-family:'Roboto', sans-serif;color:#fff;font-weight:bold; padding-left:8px"><p style="margin:0">Connect With</p></td>
                           <td style="padding-right:50px;"><img src="<?php echo Request::root().'/plugins/front/img/newsletter-img/footer-logo.png'; ?>" width="46" height="46"></td>
                           <td><a href="{{ Redis::get('social-facebook-page-url') }}"><img src="<?php echo Request::root().'/plugins/front/img/newsletter-img/facebook.png'; ?>" width="40" height="40"></a></td>
                           <td><a href="{{ Redis::get('social-google-plus-page-url') }}"><img src="<?php echo Request::root().'/plugins/front/img/newsletter-img/google.png'; ?>" width="40" height="40"></a></td>
                           <td><a href="{{ Redis::get('social-twitter-page-url') }}"><img src="<?php echo Request::root().'/plugins/front/img/newsletter-img/twitter.png'; ?>" width="41" height="41"></a></td>
                           <td style="padding-right:8px"><img src="<?php echo Request::root().'/plugins/front/img/newsletter-img/you-tube.png'; ?>" width="42" height="40"></td>
                           
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td style=" background:#171026; padding-top:25px; padding-bottom:25px;">
                  <table cellpadding="0" cellspacing="0" border="0" width="80%" style="margin:0 auto" align="center">
                      <tr>
                          <td style="font-family:'Roboto', sans-serif;font-size:16px; color:#fff; text-align:right; font-weight:bold" valign="middle" class="emaillink">
                            <a href="{{ url('/') }}" style="color:#fff; text-decoration:none">www.formee.com.au </a></td>
                            <td style="text-align:center; padding-left:10px; padding-right:10px; padding-top:5px;"><img src="<?php echo Request::root().'/plugins/front/img/newsletter-img/seprator.png'; ?>" width="2" height="14"></td>
                            <td class="emaillink" style="font-size:16px; font-family:'Roboto', sans-serif;color:#fff; text-align:left; font-weight:bold" valign="middle"><a href="#"style="color:#fff; text-decoration:none">info@ formee.com.au </a></td>
                        </tr>
                        <tr>
                          <td class="emaillink" style="font-size:16px;font-family:'Roboto', sans-serif; color:#fff; text-align:center; font-weight:400; padding-top:15px;" valign="middle" colspan="3"><a href="<?php echo Request::root().'/unsubscribe/'.$token; ?>"style="color:#fff;">Unsubscribe
 </a></td>
                        </tr>
                    </table>
                </td>
              </tr>
               <tr>
                <td class="copyright" style=" background:#000; padding-top:15px;font-family:'Roboto', sans-serif; padding-bottom:15px; font-size:15px; color:#fff; text-align:center"><p style=" margin:0;">&copy;Copyright 2017 Formee.com</p></td>
              </tr>
              
              
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
