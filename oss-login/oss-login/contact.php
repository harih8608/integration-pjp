<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="OSS Repository">
    <meta name="author" content="OSS Repository">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <title>OSS Repository Portal</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- ChartJs CSS -->
    <!-- <link href="assets/css/chartjs.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
	
	<link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" rel="stylesheet" />
	<link href="css/jquery-ui.css" rel="stylesheet" />
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <!-- Jquery Core Js -->
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
  </head>
<?php
 ini_set('display_errors', false);
 ini_set('display_startup_errors', false);
    session_start();
    //require "coding/session_check.php";
    //require 'new/common/head.php';
    //require 'new/common/left_menu.php';
?>
  <body class="style-1">
 <?php
	
	include 'coding/customfuncs.php'; 
	if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
	$emailid = $_SESSION['email'];
	}
	else{
		$emailid = '0';
		}
	//echo "email id =". $emailid."=";
	if($emailid == '0')
	{
		$sso_flag = '0';
	}
	else
	{
		$sso_flag = getssoflag($emailid);	
	}
	
if($sso_flag== '0'){
	include 'common/head_landingpage.php'; 
}
elseif ($sso_flag == '1'){
	include 'common/head.php'; 
}
	
	?>
    


    <div class="container-fluid ">
     <div id="wrapper">
      <!--<div class="row ">
        <?php
			
			//include 'common/left_menu.php'; 
		?>
        </div>-->

        <main role="main" class="col-md-12 ml-sm-auto col-lg-12 pt-3 pb-3">
          <!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h4>About OTG</h4>
            <div class="collapse mb-2 mb-md-0" id="userinfotop">
               <div class="info-container row mr-3 align-self-center">
                   <div class="email pr-2 pt-2 text-black-50">Last Login: <?php //echo date('d-m-y h:i a', time()); ?> </div>
                    <div class="name pr-2 pt-2"><?php //echo $_SESSION['username']; ?></div>
                     <div class="image">
                   	 	<img src="assets/img/user.png" alt="User" width="30" height="30">
                	</div>
					<div class="name pr-2 pt-2"><a href="coding/logout.php?logout" class="name" style="text-decoration: none !important;">Logout</a></div>
                </div>
            </div>
          </div>-->
          

         	
<div class="body">
<table id="ossabout" class="table table-bordered table-condensed text-center">
			<tbody>
			<tr ><th colspan="6" class="text-white p-1 bg-darkblue"><h3>Contact Us</h3></th></tr>
			</tbody></table>
	<form>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div id="osstemplates"  class="p-4">
				<h5>Contact</h5>
				<div>
				<table><tr><td>Open Technology Group</td></tr>
				<tr><td>National Informatics Centre</td></tr>
				<tr><td>A2B, First Floor, A wing, Rajaji Bhawan,</td></tr>
				<tr><td>Besant Nagar, Chennai 600 090, Tamilnadu.</td></tr>
				<tr><td>Email : otghelpdesk[at]nic[dot]in</td></tr>
				<tr><td>Telephone : 044-24908119</td></tr></table>
				</div>
				<br/>
				<br/>
				<br/>
			</div>
		 </div>
	</div>	
		<br/>
		
	</form>
	
	
</div>
	  <br/>
		
		
	  
		
	  </div>
			  
        </main>
      </div>
    </div>
<br/>
<br/>
<?php
	include 'sign-in.php'; 
if($sso_flag== '0'){
			include 'common/footer_landingpage.php'; 
}
elseif($sso_flag== '1'){
			include 'common/footer.php'; 
}
		?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/chartjs.js"></script>
	<script src="js/jmespath.min.js"></script>
    <script src="js/jquery-ui.js"></script>
	<script src="assets/js/ossfunctionality.js"></script>
	
    <script>
$(document).ready(function(){
	loadmenuitems();
	$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
		$("#sm-sidebar-wrapper").addClass("sm-toggled");
    });
});
</script>
<style>


/*tr:nth-child(even) { background-color: #f2f2f2; }*/

th {
	background-color: #F0F0F0;
	color: #808080;
}

.card-header {
	padding: 1.75rem 1.25rem !important;
}

</style>
  </body>
</html>
