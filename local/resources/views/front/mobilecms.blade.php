
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="shortcut icon" href="{{ URL::asset('plugins/front/img/faviconnew.png') }}" type="image/x-icon"/>
<title>Formee</title>


<!--Fonts CDN-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>

<style type="text/css">
*{ padding:0; margin:0;}
a{color: #181818; text-decoration: none;}
.page-heading{padding-top: 45px;}
.page-heading h2{ font-family: "Roboto",sans-serif; padding:0 20px; color: #ef4b23; font-size: 26px; line-height: 30px; text-transform: uppercase;}
.container-wrap{ padding: 10px 25px; font-family: "Roboto",sans-serif; font-size:16px; color:#181818;}
.container-wrap p{font-family: "Roboto",sans-serif; font-size: 16px; line-height: 25px; text-align: justify; color: #181818;}
.container-wrap .title {
    color: #ef4b23;
    font-weight: 600;
    padding-bottom: 10px;
}
ul{padding-left: 35px;}
ul li{font-family: "Roboto",sans-serif; font-size:16px; color:#181818;}
ul.ul-bullet {  padding: 10px 20px; list-style:none;}
ul.ul-bullet li{ padding-bottom:8px; background:url(bullet-arrow.png) no-repeat left 5px; padding-left:20px;}
.multi-levelul ol li {
    padding-bottom: 8px;
}
</style>

<!--[if lt IE 9]>
<script src="assets/js/html5shiv.js"></script>
<![endif]-->



</head>

<body>


<!--Page Heading-->
<div class="page-heading">
	<div class="container"><h2><?php echo $result->title?></h2></div>
</div>
<!--/Page Heading-->


<!--Mid Part-->
<div class="container-wrap">
    <div class="container">
    <div class="multi-levelul">
      <?php
      echo $result->description
      ?>
       </div>
    </div>
</div>
<!--/Mid Part-->


</body>
</html>
