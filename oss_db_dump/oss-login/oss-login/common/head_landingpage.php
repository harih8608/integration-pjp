<!DOCTYPE html>
<html>



<?php 
ini_set('display_errors', false);
 ini_set('display_startup_errors', false);
/*  ob_start();
  session_start();

  if(isset($_SESSION['user']) == "") {
    header("Location: sign-in.php");
  }
*/
?>

<head>

  <meta charset="UTF-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=Edge">-->
  
  <!--<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> NIC | LINUX OS Template Service</title>
  <!-- Favicon-->
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">

	
  <!-- Bootstrap Core Css -->
  <!--<link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">-->

  <!-- Waves Effect Css -->
  <!--<link href="../plugins/node-waves/waves.css" rel="stylesheet" />-->

  <!-- Animation Css -->
  <!--<link href="../plugins/animate-css/animate.css" rel="stylesheet" />-->

  <!-- Colorpicker Css -->
  <!--<link href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />-->

  <!-- Dropzone Css -->
  <!--<link href="../plugins/dropzone/dropzone.css" rel="stylesheet">-->

  <!-- Multi Select Css -->
  <!--<link href="../plugins/multi-select/css/multi-select.css" rel="stylesheet">-->

  <!-- Bootstrap Spinner Css -->
  <!--<link href="../plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">-->

  <!-- Bootstrap Tagsinput Css -->
  <!--<link href="../plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">-->

  <!-- Bootstrap Select Css -->
  <!--<link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->

  <!-- noUISlider Css -->
  <!--<link href="../plugins/nouislider/nouislider.min.css" rel="stylesheet" />-->

  <!-- Custom Css -->
  <!--<link href="../css/style.css" rel="stylesheet">-->

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <!--<link href="../css/themes/all-themes.css" rel="stylesheet" />-->
<style>
#navbarCollapse1 a:hover{
	color:teal !important;
	background-color: rgb(255, 230, 204);
	border-radius: 3px;
	font-weight:bold;
}
#navbarCollapse1 a:active{
	color:red;
}
</style>
</head>

<body class="theme-red">
  
  
  <!-- Top Bar -->

    <nav class="navbar navbar-expand-md navbar-light bg-navbar">
        <a href="index.php"  style="text-decoration:none;display:inline-block;"><h3 class="text-white unselectable" href="#"><img src="assets/img/logo.png" alt="User" width="100px" height="30px"> Open Source Software Services</h3></a>
	</nav>
	<nav class="navbar navbar-expand-md navbar-light bg-indigo sticky-top">
	
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse1">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse unselectable" id="navbarCollapse1">
	<!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap pb-0 mb-1 unselectable navbar-nav">
		<a href="https://digital.nic.in/" target="_self" class="nav-item nav-link font-weight-bold text-palegreen">[ NIC Sign-in through Digital ]</a>
    </div>
	-->
		<div class="navbar-nav ml-auto">
		<a href="index.php" class="nav-item"><img src="images/home1.png" title="home"></img></a>
		<a href="#" class="nav-item nav-link font-weight-bold" data-toggle="modal" data-target="#md5Modal" ><span class="glyphicon glyphicon-log-in"></span>&nbsp;Sign-In</a>
		</div>
</div>

	

    </nav>

  <!--<nav class="navbar navbar-dark sticky-top bg-indigo flex-md-nowrap p-0">
      
	  <div class="navbar-brand col-lg-6 col-sm-6 col-md-6 m-0"><a href="index.php" style="text-decoration:none;display:inline-block;"><h3 class="text-white unselectable" href="#"><strong>NIC</strong> Open Source Software Services</h3></a></div>
	  
	  <div class="col-lg-6 col-sm-6 col-md-6 ">
	   <a href="index.php"><img src="images/home1.png" title="home"></img></a>&nbsp;
       <a class="btn btn-link text-white" data-toggle="collapse" href="#userinfotop" role="button" aria-expanded="false" aria-controls="userinfotop" href="#menu-toggle" id="menu-toggle">
       	<img src="assets/img/bars.png" alt="Menu" title="Menu" />
       </a>
	
	  <ul class="navbar-nav" id="menulist_top">
    <li class="nav-item">
      <a class="nav-link" href="#">Link 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 3</a>
    </li>
  </ul>
	  
	  
	  </div>
	
	   <div class="col-sm-1 col-md-1 text-center righttoggle">
	  
       </div>-->
	   <!--<a href="index.php" style="text-decoration:none;display:inline-block;"><h3 class="text-white unselectable"><strong>NIC</strong> Open Source Software Services</h3></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="btn btn-link text-white" data-toggle="collapse" href="#userinfotop" role="button" aria-expanded="false" aria-controls="userinfotop" href="#menu-toggle" id="menu-toggle">
       	<img src="assets/img/bars.png" alt="Menu" title="Menu" />
       </a>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
	<li class="nav-item">
	<a href="index.php"><img src="images/home1.png" title="home"></img></a>&nbsp;
       
	</li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>    
    </ul>
  </div>  
    </nav>-->
	
  <!--<nav class="navbar navbar-dark sticky-top bg-indigo flex-md-nowrap p-0">
      <div class="navbar-brand col-sm-11 col-md-11 mr-0 p-0"><a href="index.php"><img src="assets/img/ossr_theme_full.png" title="OSS_Theme" style="height:65px;"></img></a></div>
	   <div class="col-sm-1 col-md-1 text-center righttoggle">
	   <a href="index.php"><img src="images/home1.png" title="home"></img></a>&nbsp;
       <a class="btn btn-link text-white" data-toggle="collapse" href="#userinfotop" role="button" aria-expanded="false" aria-controls="userinfotop" href="#menu-toggle" id="menu-toggle">
       	<img src="assets/img/bars.png" alt="Menu" title="Menu" />
       </a>
       </div>
      </ul>
    </nav>-->
	
	<!--<nav class="navbar navbar-dark sticky-top bg-indigo flex-md-nowrap p-0">
      <div class="row clearfix navbar-brand col-lg-11 col-sm-11 col-md-11 mr-0 pt-0 pb-0">
	  <div class="col-lg-6 col-md-5 col-sm-4 col-xs-12 "><h3 class="text-white unselectable" href="#"><strong>NIC</strong> Open Source Software Services</div>
	  <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12 "><img src="assets/img/ossr_theme_small.png" title="OSS_Theme" style="float:right;"></img></div>
	  </div>

	  <div class="row container-fluid navbar-brand col-lg-11 col-sm-11 col-md-11 mr-0 pt-0 pb-0">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		  <h3 class="text-white unselectable" href="#"><strong>NIC</strong> Open Source Software Services</h3>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-5 col-xs-5" >
		  <img src="assets/img/ossr_theme_small.png" title="OSS_Theme" style="float:right;"></img>
		</div>
	  </div>

	   <div class="col-sm-1 col-md-1 text-center righttoggle">
	   <a href="index.php"><img src="images/home1.png" title="home"></img></a>&nbsp;
       <a class="btn btn-link text-white" data-toggle="collapse" href="#userinfotop" role="button" aria-expanded="false" aria-controls="userinfotop" href="#menu-toggle" id="menu-toggle">
       	<img src="assets/img/bars.png" alt="Menu" title="Menu" />
       </a>
       </div>

    </nav>-->
<!-- #Top Bar -->
