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
    <!-- <link href="assets/css/chartjs.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
   <!--  <link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/faq.css" rel="stylesheet"> -->
	
	
	<link href="css/jquery-ui.css" rel="stylesheet" />
	
	
	<!-- <script src="assets/js/jquery.min.js"></script> -->
	 <!-- Jquery Core Js -->

  </head>
<?php
 ini_set('display_errors', false);
 ini_set('display_startup_errors', false);
    session_start();
    require "coding/session_check.php";
    //require 'new/common/head.php';
    //require 'new/common/left_menu.php';
?>
<!--
<body class="style-1"> 

    <div class="container-fluid ">
     <div id="wrapper">

        <main role="main" class="col-md-12 ml-sm-auto col-lg-12 pt-3 pb-3">
-->
  <?php
	include 'common/head.php'; 
	?>
    
          <table id="ossack" class="table table-bordered table-condensed text-center">
			<tbody>
			<tr ><th colspan="6" class="text-white p-1 bg-kms-1"><h3>OSS Templates and Customized ISO images for NIC Cloud </h3></th></tr>
			</tbody></table>

         	
<?php include 'otg-oss-cloud-artefacts.php'; ?>
<br/><br/><br/><br/><br/>		
	<?php
			
			include 'common/footer.php'; 
		?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
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
	
	$(".ques").click(function(e) {
		//alert($.trim($(this).text()));
		var tid="";
		var methd="logentry";
		var sid="10";
		var sref = "W";
		var uid="<?php echo $_SESSION['user'] ?>";
		//var getUrl = window.location;
		//var baseUrl = getUrl.protocol + "//" + getUrl.host + getUrl.pathname;
		var baseUrl = $.trim($(this).text()); // store version no. instead of url for advisory
		$.ajax({
		   type: "POST",
		   async:false,
			url: 'coding/common_functions.php',
			data: { method:methd,refurl:baseUrl, userid:uid, serviceid:sid, srcref:sref},
			success: function(data){
			
			
			},
		  });
		
		
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
.footer{
	position:relative !important;
}
</style>
  </body>
</html>
