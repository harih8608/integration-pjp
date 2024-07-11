<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="OSS Repository">
    <meta name="author" content="OSS Repository">
    <link rel="icon" href="images/favicon.ico">

    <title>OSS Repository Portal</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
	
	
	
	
    
    <link href="JSandCSS/glyphicon.css" rel="stylesheet" />
<!--
	<link href="JSandCSS/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
-->
	<link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" />
	<!-- <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css"> -->
	<!-- <link href="JSandCSS/jquery-ui.css" rel="stylesheet" /> -->
    <link type="text/css" href="JSandCSS/jquery.ui.chatbox.css" rel="stylesheet" />
    <link href="JSandCSS/all.min.css" rel="stylesheet" />
	<link href="css/selectdropdown.css" rel="stylesheet" />
	<link href="assets/css/slick_slider.css" rel="stylesheet" />
	<script src="assets/js/popper.min.js"></script>
	
	
	  

    <!-- Waves Effect Css -->
    <!--<link href="plugins/node-waves/waves.css" rel="stylesheet" />-->

    <!-- Animation Css -->
    <!--<link href="plugins/animate-css/animate.css" rel="stylesheet" />-->

    
    
	
	
	<style>
	.not-active {
  pointer-events: none;
  cursor: default;
  text-decoration: none;
  
}
	.active:after {
  content: "" !important; /* Unicode character for "minus" sign (-) */
}
.carousel-indicators li
{
	background-color: #fc5502 !important;
}
.images{text-align:center;}
.images img{
	width:80%;
	
}
.frame {
    height: 100%;      /* equals max image height */
    width: 100%;
    white-space: nowrap;
    position: relative;
    text-align: center; margin: 1em 0;
}

.helper {
    display: inline-block;
    height: 100%;
    vertical-align: middle;
}

.frame img {
    width: 95%;
	
    vertical-align: middle;
   max-height: 350px;
   /* max-width: 160px;*/
}
.bottomright {
  position: absolute;
  bottom: 8px;
  right: 16px;
  font-size: 18px;
}

</style>
  </head>
<?php
 ini_set('display_errors', false);
 ini_set('display_startup_errors', false);
 if(session_id() == ''){
	session_start();
 }

?>
  <body>
    
	<?php
	//include 'xml2json.php'; 
	//echo XMLtoJSON('xml.xml');
	include 'coding/customfuncs.php'; 

	$logincount="";
	$userid="";
	$refid = "";
	$user_roleid = "";
	$validtill="";
	if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
	$emailid = $_SESSION['email'];
	$_SESSION['roleid'] = setroleid($emailid);
	$user_roleid = $_SESSION['roleid']; 
	
	$domain = get_domain($emailid);

	}
	else{
		$emailid = '0';
		}
	
	if($emailid == '0')
	{
		$sso_flag = '0';
		$acc_active_status = false;
	}
	else
	{
		$sso_flag = getssoflag($emailid);
		$acc_active_status = getUserActiveStatus($emailid);
	}

if(isset($_SESSION['loginvia']) && $_SESSION['loginvia'] == 'S')
{$_SESSION['jwtset'] = '0';}
else{$_SESSION['jwtset'] = '1';}
	
//echo 'sso flag '.$sso_flag."  <br/> role id ".$_SESSION['roleid']."  <br/> jwt flg ".$_SESSION['jwtset'] ;
if($acc_active_status == false){
	include 'common/head_landingpage.php'; 
}
elseif ($acc_active_status == true){
	include 'common/head.php'; 
}
if($_SESSION['jwtset'] == '1')
{
	update_login_hist($emailid);// for only via digital redirect
}
if($user_roleid == '4'){
	$logcount_userid = getuserid_logcount($emailid);
	$logcount_userid_arr = explode("~", $logcount_userid);
	if($logcount_userid_arr[0] == '1')
	{ 	//if success rec fetch
		$userid = $logcount_userid_arr[1];
		$logincount = $logcount_userid_arr[2];
		if($userid > 100000 && $logincount == '2' || $logincount == '')
		{	$refid_validity = getrefid_validtill($userid);
			$refid_validity_arr = explode("~", $refid_validity);
			if($refid_validity_arr[0] == '1')
			{$refid = $refid_validity_arr[1];
			$validtill = ymd_to_dmy($refid_validity_arr[2]);
			}
		}
	}
	else
	{
	$logincount = '';
	$userid = '';
	}
}
else
{
	
}



$showfeedback =false;
if (isset($_GET['feedback']) && isset($_SESSION['user'])) {
	$showfeedback =  true;		
	}
//echo "*****".$userid."*****".$logincount."*****".$user_roleid."*****".$refid."*****".$validtill;
	
  function get_domain($email_address) {
    // Check if a valid email address was submitted
    
    
    // Split the email address at the @ symbol
    $email_parts = explode( '@', $email_address );
    
    // Pop off everything after the @ symbol
    $domain = array_pop( $email_parts );
    
    return $domain;
  }





?>

    <div class="container-fluid ">
	   <div id="wrapper">
		<!--<div class="toggled" id="wrapper">
		<div class="row ">
        <?php
			
			
		?>
        </div>-->

        <main role="main" class="col-md-12 ml-sm-auto col-lg-12 pt-3 px-4 pb-3">
          
          <!-- carousel starts-->
		  <div id="nonniclogin" class="text-center text-red font-weight-bold"> <?php if(isset($_SESSION['signin_email_error']) && $_SESSION['signin_email_error'] != '' && $_SESSION['signin_email_error'] != NULL) { ?>
			<label id="username1-error" class="error" for="username"> <?php echo $_SESSION['signin_email_error']; ?></label>
	<?php }unset($_SESSION['signin_email_error']); ?>
</div>


</div>
		  <!-- carousel ends-->

	
   

</div>
		
        </main>
      </div>
    </div>
	<?php 
	include 'sign-in.php';
	//include 'pws.php';
?>
	<?php
	
if($acc_active_status == false){
			include 'common/footer_landingpage.php'; 
}
elseif($acc_active_status == true){
			include 'common/footer.php'; 
}
		?>
		<?php 
    unset($_SESSION['login_error']);
    unset($_SESSION['signin_email_error']);
    unset($_SESSION['signin_pass_error']);
    unset($_SESSION['signin_captcha_error']);
?>
<!-- chatbot starts -->
		 <!--<div id="chatMe_btn" style="text-align:right; margin-bottom:150px; margin-right:15px;">-->
		 <?php if(isset($_SESSION['roleid']) && !empty($_SESSION['roleid'])){ ?>
		 
	<?php } ?>
    <div id="box">
    </div>
	<!--div id="showData" style="width:30%"></div-->
	
	<div class="container-fluid">
	<div class="row">
	

    <!--Chat box will be generated in this container-->
    <div id="chat_div">
    </div>
    <!--This div is used to store the ChatHistory-->
    <input type="hidden" id="hiddenOtp" />
    <div id="log" style="visibility:hidden;"></div>
    <div id="logToSave"></div>
    <div id="userIssueDesp" ></div>
	
	
	 
	
	</div>
	</div>
		 <!-- chatbot ends -->
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="js/jmespath.min.js"></script>
    <script src="assets/js/ossfunctionality.js"></script>
	<script src="assets/js/jquerysession.js"></script>
	<script src="assets/js/slick.js"></script>
	
	<!--script src="JSandCSS/jquery.min.js"></script-->
	<!--<script src="https://code.jquery.com/jquery.js"></script>-->
<!--
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
-->
    <script src="assets/js/jquery.dataTables.min.js"></script>
	<!--script src="JSandCSS/dataTables.min.js"></script-->
    <script src="JSandCSS/shieldui-all.min.js"></script>
    <!--<script src="JSandCSS/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="JSandCSS/jquery-ui.js"></script>
	<script type="text/javascript" src="JSandCSS/jquery.ui.chatbox.js"></script>
    <script type="text/javascript" src="JSandCSS/cbox.js"></script>
  <script src="assets/js/simple-rating_1.js"></script>

	
	<style type="text/css">
        /* fallback */
@font-face {
  font-family: 'Material Icons';
  font-style: normal;
  font-weight: 400;
  src: url(css/font/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
}

.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  display: inline-block;
  white-space: nowrap;
  word-wrap: normal;
  direction: ltr;
  -moz-font-feature-settings: 'liga';
  -moz-osx-font-smoothing: grayscale;
}
</style>
	    <style>
		.card-header
		{
			padding: 0.7rem 0.7rem !important;
		}
        th, td, p, input {
            font:14px Verdana;
        }
        table, th
        {
            border: solid 1px #DDD;
            border-collapse: collapse;
            padding: 2px 3px;
            text-align: center;
        }
		td{
			text-align:left;
		}
        th {
            font-weight:bold;
        }
		.blueP:hover{
		 text-decoration:underline;
		}
		.messages > p {
			    word-break: break-all;
			}
		option
		{
			color: teal;
		}
    
        .button {
            float: right;
            background-size: 100% 100%;
            cursor: pointer;
            border: none; /*noness*/
            width: 150px;
            height: 150px;
            vertical-align: middle; /* align the text vertically centered */
        }
		.latestUpdateScroll{
			width:100%;
			
			height:400px;
			overflow:hidden;
		}
		.latestUpdateScroll ul{
		list-style:none;
		position:relative;
		}
		.latestUpdateScroll ul li{
		height:100px;
		}
		

		.divscroll, .sdresult{
			width:100%;
			
			height:400px;
			overflow:hidden;
		}
		.divscroll ul, .sdresult ul{
		list-style:none;
		position:relative;
		padding:0;
		}
		.divscroll ul li, .sdresult ul li{
		/*height:80px;*/
		height:auto;
		
		}
		.sdresult{
			overflow-y: auto;
		}
		#sdFilterElements
		{
			height:180px;
			overflow-y: auto;
		}
		#sdFilterResultdiv
		{
			width:100%;
			height:180px;
			overflow-y: auto;
		}
		#sdFilterResult
		{
			list-style:none;
			padding:0;
		}
		.section::-webkit-scrollbar {
		width: 10px;
		}

		.section::-webkit-scrollbar-track {
		background-color: #e4e4e4;
		border-radius: 100px;
		}

		.section::-webkit-scrollbar-thumb {
		background-color: #6faad2;
		border-radius: 100px;
		}

    </style>

    <script>
        function updateImage() {

            obj = document.imagename;
            obj.src = obj.src + "?" + Math.random();
            obj.src = "JSandCSS/images/vanihere.gif";
        }
		 

        //setInterval("updateImage()", 7000);
		
		

		
		function hihello(){   
		
		$("#chat_div .ui-chatbox-msg1").remove();
		$("#chat_div .ui-chatbox-msg2").remove();
		$("#chat_div .ui-chatbox-msg3").remove();
		$("#log").html("");
		$("#logToSave").html("");
		$("#userIssueDesp").html("");
		$("#chatMe_btn").removeAttr('disabled');
		$('#chatwith_me').show();                       

		contextName = "user";RespMsg="";intentName = "";ChatCount = 0;count = 1;SessionID = null;chatLog = "";cdate = "";appname = "otgChatBot";mode="";df="";

		$("#ooo").val("");
		$(".msg_flag").remove();
		$("#log").html("");
		$("#logToSave").html("");
		$("#userIssueDesp").html("");                       
		$('#chatwith_me').hide();  
		CALLInvoke();
		
    } 	
	$(function(){
  var tickerLength = $('.latestUpdateScroll ul li').length;
  var tickerHeight = $('.latestUpdateScroll ul li').outerHeight();
  $('.latestUpdateScroll ul li:last-child').prependTo('.latestUpdateScroll ul');
  $('.latestUpdateScroll ul').css('marginTop',-tickerHeight);
  function moveTop(){
    $('.latestUpdateScroll ul').animate({
		top : -tickerHeight
    },500, function(){
     $('.latestUpdateScroll ul li:first-child').appendTo('.latestUpdateScroll ul');
      $('.latestUpdateScroll ul').css('top','');
    });
   }
  setInterval( function(){
    moveTop();
  }, 3000);
  });	

  $(function(){
  var tickerLength = $('.divscroll ul li').length;
  var tickerHeight = $('.divscroll ul li').outerHeight();
  $('.divscroll ul li:last-child').prependTo('.divscroll ul');
  $('.divscroll ul').css('marginTop',-tickerHeight);
  function moveTop(){
    $('.divscroll ul').animate({
		top : -tickerHeight
    },500, function(){
     $('.divscroll ul li:first-child').appendTo('.divscroll ul');
      $('.divscroll ul').css('top','');
    });
   }
  setInterval( function(){
    moveTop();
  }, 3000);
  });	
    </script>
	<?php if($showfeedback){?>
  <script type="text/javascript"> $('#ContinueToFeedback').modal('show');</script>
	<?php } ?>
    <script>
	var roleid= '<?php if(isset($_SESSION["roleid"])){ echo $_SESSION["roleid"];} else {echo "";} ?>';
	var jwtflag=  '<?php echo $_SESSION["jwtset"]; ?>';
	var logincount = '<?php echo $logincount; ?>';
	var userid = '<?php echo $userid; ?>';
	//$.session.remove('polllater') ;
	//var poll_later = sessionStorage.getItem('polllater');
	//if(poll_later == 'Y')
	//{}
		
	$.session.set('userroleid', roleid);
	$.session.set('jwtstatus', jwtflag);
	loadmenuitems();
	//if(userid > 0 ){update_lastlogin();}
	//$("#wrapper").toggleClass("toggled");
	if((logincount == '2' || logincount == "") && userid > 100000)
	{
		$("#expirydate").html('<?php echo $validtill; ?>');
		$("#nicofficer").text('<?php echo $refid; ?>');
		$("#welcome_note").modal({
			backdrop: 'static',
            keyboard: false
		});
		$("#welcome_note").modal('toggle');
		
	}
	else
	{
		
	}
	/* $("#g20").modal({
		backdrop: 'static',
        keyboard: false
	}); */
//	$("#g20").modal('toggle');	
	$("#ubuntuProAlert").modal({
		backdrop: 'static',
        keyboard: false
	});
	$("#ubuntuProAlert").modal('toggle');	
	$.ajax({
		  type: "POST",
		  url: 'coding/captcha.php',
		  success: function(res) {
			  //alert("code set");
			  $("#imgdiv").html('');
			  $('#imgdiv').html('<img style="height:40px;" id="cap_img" src="coding/captcha.php"/> <i class="material-icons" id="reload" style="cursor: pointer;"><img src="images/refresh.png" style="height: 30px;"></i></div>');
        $('#captcha').val('');
        $('#captcha1-error').html('');
		  }
	});	  
	var access_token; 
	//access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoiNjEzMyIsImlzcyI6Imh0dHBzOlwvXC9vc3NyZXBvc2l0b3J5Lmdvdi5pbiIsImF1ZCI6Imh0dHBzOlwvXC9vc3NyZXBvc2l0b3J5Lmdvdi5pbiIsImlhdCI6MTU4MzQ3NDY3NiwiZXhwIjoxNTgzNDc2NDc2LCJlbWFpbCI6InByYWRlZXAucGF1bHJhakBuaWMuaW4ifQ.av0UZ623xK9ruHzqmnu0R0RG0D0kRgOVam9PO150C00";
	//$.session.set('access_token', access_token);
	$.ajax({
		url: "https://ossrepository.gov.in/nic/employee/settoken.php",
		type: 'POST',
		//data: access_key,
		dataType: "JSON",
		success: function(data) {
			access_token=data.access_token;
			$.session.set('access_token', access_token);
		}
	});
			
	
	//$('#advisory_btns').addClass('d-block');
	var meta_data = getmetadata();
	//var ip=String(<?php echo $_SERVER['REMOTE_ADDR'] ?>);
	//alert("Ip address "+ ip);
	loadfuncdomainddwn(meta_data);
	loadtools_card(meta_data);
	var useractivestatus= '<?php echo $acc_active_status; ?>';
	//alert(ssoflag);
	if(useractivestatus){
		$('.oss-elements>div>a').removeClass("not-active");
		$("#OSSStack").removeClass("not-active");
		$("#OSSAdvisory").removeClass("not-active");
		$("#Tools").removeClass("not-active");
		$("#CentOS").removeClass("not-active");
		$("#Ubuntu").removeClass("not-active");
		$("#KickStartIso").removeClass("not-active");
		$("#UpdateTools").removeClass("not-active");
		$("#AlmaLinux").removeClass("not-active");
		$("#RockyLinux").removeClass("not-active");
		$(".frame>a").removeClass("not-active");
		$(".latestUpdateScroll a").removeClass("not-active");
		$(".repoupdates a").removeClass("not-active");
	}
	else{}
	
	 $('.oss-elements').slick({
        slidesToShow: 7,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0,
		speed: 3000,
        arrows: true,
        dots: false,
        draggable: true,
		cssEase: 'linear',
        pauseOnHover: true,
        responsive: [{
            breakpoint: 768,			
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
	$("#disclaimer_cb").change(function(){
		if($("#disclaimer_cb").is(":checked")){
			$(".welcome_note_close_btn").removeClass('d-none');
		}
		else
		{	$(".welcome_note_close_btn").addClass('d-none');}
	});
	$(".welcome_note_close_btn").click(function(){
		//alert("closed"+ userid);
		if($("#disclaimer_cb").is(":checked")){
		update_lastlogin();	  
		}
		else{alert("Please check the disclaimer box"); return false;}
	});
	function update_lastlogin(){
		var methd="updateLastLogin";
		
		$.ajax({
		  type: "POST",
		  async:false,
		  url: 'coding/common_functions.php',
		  data:{method:methd, userid:userid},
		  success: function(data) {
			  //alert("update lastlogin"+data);
			  if(data == '1')
			  {return true;}
			  else{
				  alert("User login update error");
				  return false;
			  }
		  },
			error: function (data){
				alert("User update error: "+data);
				return false;
			},
		});
	}
	
	$("#OSSStack").click(function() {
		selectedfunc("#OSSStack");
		
		$("#ossstack_card").removeClass("d-none");
		$("#ossstack_card").addClass("d-inline");
		
		$("#ossadvisory_card").removeClass("d-inline");
		$("#ossadvisory_card").addClass("d-none");
		$("#osstools_card").removeClass("d-inline");
		$("#osstools_card").addClass("d-none");
		$("#osstemplates_card").removeClass("d-inline");
		$("#osstemplates_card").addClass("d-none");
		$("#osskickstartiso_card").removeClass("d-inline");
		$("#osskickstartiso_card").addClass("d-none");
	});
	$("#OSSAdvisory").click(function() {
		selectedfunc("#OSSAdvisory");
	
		$("#ossstack_card").removeClass("d-inline");
		$("#ossstack_card").addClass("d-none");
		
		$("#ossadvisory_card").removeClass("d-none");
		$("#ossadvisory_card").addClass("d-inline");
		
		$("#osstools_card").removeClass("d-inline");
		$("#osstools_card").addClass("d-none");
		$("#osstemplates_card").removeClass("d-inline");
		$("#osstemplates_card").addClass("d-none");
		$("#osskickstartiso_card").removeClass("d-inline");
		$("#osskickstartiso_card").addClass("d-none");
	});
	
	$("#Tools").click(function() {
		selectedfunc("#Tools");
		$("#ossstack_card").removeClass("d-inline");
		$("#ossstack_card").addClass("d-none");
		$("#ossadvisory_card").removeClass("d-inline");
		$("#ossadvisory_card").addClass("d-none");
		
		$("#osstools_card").removeClass("d-none");
		$("#osstools_card").addClass("d-inline");
		
		$("#osstemplates_card").removeClass("d-inline");
		$("#osstemplates_card").addClass("d-none");
		$("#osskickstartiso_card").removeClass("d-inline");
		$("#osskickstartiso_card").addClass("d-none");
	});
	
	$("#Templates").click(function() {
		selectedfunc("#Templates");
		$("#ossstack_card").removeClass("d-inline");
		$("#ossstack_card").addClass("d-none");
		$("#ossadvisory_card").removeClass("d-inline");
		$("#ossadvisory_card").addClass("d-none");
		$("#osstools_card").removeClass("d-inline");
		$("#osstools_card").addClass("d-none");
		
		$("#osstemplates_card").removeClass("d-none");
		$("#osstemplates_card").addClass("d-inline");
		
		$("#osskickstartiso_card").removeClass("d-inline");
		$("#osskickstartiso_card").addClass("d-none");
	
	});
	$("#KickStartIso").click(function() {
		selectedfunc("#KickStartIso");
		$("#ossstack_card").removeClass("d-inline");
		$("#ossstack_card").addClass("d-none");
		$("#ossadvisory_card").removeClass("d-inline");
		$("#ossadvisory_card").addClass("d-none");
		$("#osstools_card").removeClass("d-inline");
		$("#osstools_card").addClass("d-none");
		$("#osstemplates_card").removeClass("d-inline");
		$("#osstemplates_card").addClass("d-none");
		
		$("#osskickstartiso_card").removeClass("d-none");
		$("#osskickstartiso_card").addClass("d-inline");
	});
	$("#UpdateTools").click(function() {
		selectedfunc("#UpdateTools");
		$("#ossstack_card").removeClass("d-inline");
		$("#ossstack_card").addClass("d-none");
		$("#ossadvisory_card").removeClass("d-inline");
		$("#ossadvisory_card").addClass("d-none");
		$("#osstools_card").removeClass("d-inline");
		$("#osstools_card").addClass("d-none");
		$("#osstemplates_card").removeClass("d-inline");
		$("#osstemplates_card").addClass("d-none");
		
		$("#osskickstartiso_card").removeClass("d-none");
		$("#osskickstartiso_card").addClass("d-inline");
	});
	
	$("#SelectFuncDomain_card").change(function() {
		if($("#SelectFuncDomain_card option:selected" ).index() > 0)
		{
			loadDomainTools_card(meta_data, $("#SelectFuncDomain_card").find(":selected").text());
		}
		else
		{
			loadtools_card(meta_data);
		}
	
	});
	
	$("#SelectTool_card").change(function() {
		$("#versioncheckeditem_card").html('');
		$("#advisory_btns_card").html('');
	loadVersionNums_card(meta_data, $("#SelectTool_card").find(":selected").text());
	});
	
 /* 	
	$("#SelectVersionNo_card").change(function() {
		var tid="";
		var methd="getToolId";
		var sid="3";
		var sref = "W";
		var uid="<?php if(isset($_SESSION['user'])){echo $_SESSION['user'] ;} ?>";
		$("#versioncheckitem_card").val($("#SelectTool_card").find(":selected").text());
		//var getUrl = window.location;
		//var baseUrl = getUrl.protocol + "//" + getUrl.host + getUrl.pathname;
		var tname = $("#versioncheckitem_card").val();
		var baseUrl = $("#SelectVersionNo_card").find(":selected").text(); // store version no. instead of url for advisory
		var advisorybtns;
	
	homepageversioncheck(meta_data,"<?php if(isset($_SESSION['roleid'])){echo $_SESSION['roleid'];}?>","<?php if(isset($_SESSION['user'])){echo $_SESSION['user'];}?>");
	//advisorybtns= "<button class=\"advbtn m-1\" title=\"Download tool's latest version\" type=\"button\" onclick=\"window.open(\'\',\'_new\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue($("#versioncheckitem").val())+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><i class=\"fa fa-download\"></i> Download</button>";
	
	//$("#advisory_btns").empty();
	//$("#advisory_btns").append(advisorybtns);
	//advisorysubscribebtn ="<button class=\"advbtn m-1\" title=\"Subscribe for advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#SubscribeModal\" type=\"button\"><i class=\"fa fa-bell\"></i> Subscribe</button>";
	//advisorysubscribebtn= getsubscribestatus();
	//advisorysharebtn = "<button class=\"advbtn m-1\" title=\"Share this advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#ShareModal\" type=\"button\"><i class=\"fa fa-share\"></i> Share</button>";
	//$("#advisory_btns").append(advisorysubscribebtn);
	//$("#advisory_btns").append(advisorysharebtn);
	//$("#SelectedTool").empty();
	//$("#SelectedTool").append($("#versioncheckitem").val());
	//$("#advisory_btns").addClass("d-block");
	
	$.ajax({
		   type: "POST",
		   async:false,
			url: 'coding/common_functions.php',
			data: {toolname:tname, method:methd},
			success: function(data){
				tid= data;
				$.ajax({
				   type: "POST",
				   async:false,
					url: 'log_entry.php',
					data: {toolname:tname, toolid: tid, refurl:baseUrl, serviceid:sid, srcref:sref,userid:uid},
					success: function(logdata){
						if(logdata)
						{}else{alert("Advisory log error");}
					},
				  });
				
				
				return true;
			},
			error: function (data){
				alert("Tool id fetch error");
				return false;
			},
		  });
	});
	
	$(".list-group-item").on('click', function() {
	
    $('.glyphicon', this)
      .toggleClass('glyphicon-chevron-right')
      .toggleClass('glyphicon-chevron-down');
  }); 
 */

  function stacktab_adv(tool)
  {
	  
	  var accorhtml = selectOneRequest_stktable_adv(meta_data,tool,"<?php if(isset($_SESSION['roleid'])){echo $_SESSION['roleid'];}?>","<?php if(isset($_SESSION['user'])){echo $_SESSION['user'];}?>");
	//accorhtml = selectOneRequest(meta_data,tool,"2","1");
	
	disonetool("tooldownload",accorhtml);
  }
  function selectedfunc(reposervice)
  {
		$("#OSSStack").removeClass("cardselected");
		$("#OSSAdvisory").removeClass("cardselected");
		$("#Tools").removeClass("cardselected");
		$("#CentOS").removeClass("cardselected");
		$("#Ubuntu").removeClass("cardselected");
		$("#KickStartIso").removeClass("cardselected");
		$(reposervice).addClass("cardselected");
		$("#OSSAdvisServices_form").trigger("reset");
		$("#versioncheckeditem_card").html("");
		$("#advisory_btns_card").html("");		
  }
  
  //$("#Subscribe_tool").click(function() {
	function subscribeclick_card(tname,tid,uid,rid){	  
	var datajs;
	var reason="none";
	var sid="12"; 
	var sref = "W";
	var getUrl = window.location;
	var baseUrl = getUrl.protocol + "//" + getUrl.host + getUrl.pathname;

	  $.ajax({
	   type: "POST",
	   async:false,
		url: 'sub_unsub.php', //sub or unsub with trn_log insertion
		data: {toolname:tname, toolid: tid, userid: uid, roleid:rid, create:0,subflag:0,unsubreason:reason, serviceid:sid, refurl:baseUrl, srcref:sref},
		success: function(data){
		
			/*$("#SubscribeMail").empty();
			$("#SubscribeMail").append("<?php //echo $_SESSION['email']?>");*/
			
			if(data == "update" || data=="insert")
			{
				$("#Subscribe_tool_card").removeClass("d-inline");
				$("#Subscribe_tool_card").addClass("d-none");
				$("#Unsubscribe_tool_card").removeClass("d-none");
				$("#Unsubscribe_tool_card").addClass("d-inline");
			
				/*$.ajax({
				   type: "POST",
				   async:false,
					url: 'log_insert.php',
					data: {toolid: tid, userid: uid, serviceid:sid, refurl:baseUrl, srcref:sref},
					success: function(data){
								//alert("log insert"+data);
					},
					error: function(data)
					{
						alert("log update failure");
					}
				  });
				  */
				  
			}
			else{alert("Subscription Error!!");}
			
			
		},
		error: function (data)
		{
			alert("Internal Subscription error");
		}
	  });
	  return datajs;
	}
	
  function unsubscribeclick_card(tname,tid,uid,rid){
	  var unsub_status= false;
	  /*if(confirm("Are you sure to unsubscribe?"))
		{
			$("#Unsubscribe_tool").attr("data-toggle","modal");
			$("#Update_unsub").attr("onclick","update_unsub('"+tname+"','"+tid+"','"+uid+"','"+rid+"')");
			alert("confirmed");
		}
		else
		{
			$("#Unsubscribe_tool").removeAttr("data-toggle");
			$("#Update_unsub").removeAttr("onclick");
			alert("not confirmed");
			
		}
	  */
	  	$("#Update_unsub_card_card").attr("onclick","update_unsub_card('"+tname+"','"+tid+"','"+uid+"','"+rid+"')");
	}
		
	function update_unsub_card(tname,tid,uid,rid){
		
		var reason="";
		var sid="12";
		var sref = "W";
		var getUrl = window.location;
		var baseUrl = getUrl.protocol + "//" + getUrl.host + getUrl.pathname;
		if(confirm("Are you sure to unsubscribe?"))
		{
			if($("#unsub_reason_card").val() != "")
			{
				reason = $("#unsub_reason_card").val();
				$.ajax({
				   type: "POST",
				   async:false,
					url: 'sub_unsub.php',
					data: {toolname:tname, toolid: tid, userid: uid, roleid:rid, create:0,subflag:1,unsubreason:reason, serviceid:sid, refurl:baseUrl, srcref:sref},
					success: function(data){
						/*$("#SubscribeMail").empty();
						$("#SubscribeMail").append("<?php //echo $_SESSION['email']?>");*/
						if(data == "unsubsuccess")
						{
						$("#Subscribe_tool_card").removeClass("d-none");
						$("#Subscribe_tool_card").addClass("d-inline");
						$("#Unsubscribe_tool_card").removeClass("d-inline");
						$("#Unsubscribe_tool_card").addClass("d-none");
						unsub_status = true;
						$('#UnsubscribeModal_card').modal('toggle');
						$("#unsub_reason_card").val("");
						alert("Unsubscribed Successfully !!");
						}
						else
						{
							unsub_status = false;
							alert("Unsubscription Error!!");
						}
						
					},
					error: function (data){
						alert("Unsubscription Internal Error: "+ data);
					}
				  });
				
			}
			else
			{
				alert("Please fill the Reason to unsubscribe");
				//$("#Unsubscribe_tool").removeAttr("data-toggle");
				
				
			}
		}
		else
		{
			
		}
	}
	
	function verify_submit_card()
	{
		var emailcheck=false;
		var email = new RegExp("^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(nic|gov)\.in$");
		var inp = String($("#emailaddress_card").val());
		var stringarr = inp.split(',');
		for(item of stringarr){
			
			if (email.test(item)) {
				emailcheck = true;
				continue;
			}
			else
			{
				emailcheck = false;
				break;
			}

		};
		if(emailcheck == false)
		{
			alert("Please enter nic.in/gov.in email ids");
		}
		
		
		var tid="";
		var methd="getToolId";
		var sid="13";
		var sref = "W";
		var uid="<?php if(isset($_SESSION['user'])){echo $_SESSION['user'];} ?>";
		//var getUrl = window.location;
		//var baseUrl = getUrl.protocol + "//" + getUrl.host + getUrl.pathname;
		var tname = $("#versioncheckitem_card").val();
		var baseUrl ="Shared :"+ $("#SelectVersionNo_card").find(":selected").text(); // store version no. instead of url for advisory

			$.ajax({
			   type: "POST",
			   async:false,
				url: 'coding/common_functions.php',
				data: {toolname:tname, method:methd},
				success: function(data){
					tid= data;
					methd="logentry";
					$.ajax({
					   type: "POST",
					   async:false,
						url: 'coding/common_functions.php',
						data: {method:methd,toolname:tname, toolid: tid, refurl:baseUrl, serviceid:sid, srcref:sref,userid:uid},
						success: function(logdata){
							if(logdata)
							{}else{alert("Share log error");}
						},
					  });
					
					
					return true;
				},
				error: function (data){
					alert("Tool id fetch error");
					return false;
				},
			  });
	
	}

	function showsignin(obj)
	{
		/*$("#nonniclogin").empty();
		$("#nonniclogin").load("sign-in.php");
		*/
		/*$("#md5title").empty();
		$("#md5content").empty();
		$("#md5contentfooter").empty();
		//$("#md5title").html("Md5sum for - "+obj.title);

		//$("#md5content").html('<object width="100%" height="400%" type="text/html" data='+obj.href+' ></object>').foundation('open');
		$("#md5content").html('<object width="100%" height="200%" type="text/html" data='+obj.href+' ></object>');
		var $btnappnd = $('<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
		$btnappnd.appendTo($('#md5contentfooter'));*/
	}
	
	var captcha_match;
$('#captcha1-error_1').html('');

$( "#ContinueToFeedback" ).on('shown.bs.modal', function(e){
	$('.proceed').focus();
});
$( "#FeedbackForm" ).on('shown.bs.modal', function(e){
	$( "#reload_1" ).trigger( "click" );
});

$("#services_1 option[value='9999']").remove();
$("#services_1").append('<option value="9999">Others</option>');
$('.rating_1').rating_modal();
$("#clearrate_1").click(function(e){
	e.preventDefault();
	//$(".simple-rating").html('');
	//alert("cleared");
	//$(".simple-rating").html('<i class="fa fa-star-o" data-rating="1"></i><i class="fa fa-star-o" data-rating="2"></i><i class="fa fa-star-o" data-rating="3"></i><i class="fa fa-star-o" data-rating="4"></i><i class="fa fa-star-o" data-rating="5"></i>');
	$(".simple-rating i").removeClass("fa fa-star");
	$(".simple-rating i").addClass("fa fa-star-o");
	$(".simple-rating").addClass('noHover');
	$("#rated_value_1").val(0);
	//$(".rating").val(0);
	$("input[name=rate_1][value='N']").prop('checked', true);
	
	//$('.rating').rating();
});
$(".simple-rating").click(function(){
	$("input[name=rate_1][value='Y']").prop('checked', true);
});
    $(document).on('click', '#reload_1', function(e) {
        $("#imgdiv_1").html('');
        var id = Math.random();
        $('#imgdiv_1').html('<img style="height:40px;" id="cap_img" src="coding/captcha.php?id='+id+'"/> <i class="material-icons" id="reload_1" style="cursor: pointer;"><img src="images/refresh.png" style="height: 30px;"></i></div>');
        $('#captcha_1').val('');
        $('#captcha1-error_1').html('');
    });

$('input[type=radio][name=rate_1]').change(function() {
	var radVal = $("input[name='rate_1']:checked"). val();
	if(radVal == 'Y')
	{
		$(".simple-rating").removeClass('noHover');
		$("#rate_div_1").prop('disabled',false);
	}
	else 
	{
		$("#rate_div_1").prop('disabled',true);
		$("#clearrate_1").trigger("click");
	}
});

function ratingsetreset(flag)
	{
		if (flag == 0)
		{
			$("#ratingrow_1").hide();
			$("#myRange_1").hide();
			$("#myRange_1").val("0");
			$("input[name=rate_1][value='Y']").prop('checked', false);
			$("input[name=rate_1][value='N']").prop('checked', true);
		}
		else{
			$("#ratingrow_1").show();
			$("#myRange_1").show();
			$("#myRange_1").val("5");
			$("input[name=rate_1][value='Y']").prop('checked', true);
			$("input[name=rate_1][value='N']").prop('checked', false);
		}
		
	}
    function captchaValidation(captcha) {
        var captcha = captcha;
		var captcha_match;
        var data = "captcha="+captcha+"&method=matchCaptcha";
        if(captcha.length == 6) {
            $.ajax({
              type: "POST",
			  async:false,
              url: 'coding/common_functions.php',
              data : data,
              success: function(res) {
               //console.log($.parseJSON(res));
                captcha_match = JSON.parse(res);
				//alert('captcha match = '+captcha_match);
               
                /*if(captcha_match != 1) {
                    $('#captcha1-error_1').html('func Captcha not matched, Please try again').show();
                    //setTimeout(function(){ $('#captcha1-error').attr('style',''); $('#captcha1-error').html('Captcha not matched, Please try again');}, 100);
                } else {
                    $('#captcha1-error_1').html('');
                    //$('#feedback_form').submit();
                }*/
              },
              error: function(res) {
              }
            });
        } else {
            $('#captcha1-error_1').html('');
        }
		return captcha_match;
        
    }
	
    $(document).on('change','#services_1', function(e){
		var service = $("#services_1").val();
		if($("#services_1").val() == '7')
		{
			$("#subservices_1").prop('disabled', false);
			ratingsetreset(1);
			meta_data = getmetadata();
			var osstools = jmespath.search(meta_data,"ossTools[]");
			var toolswithresource = [];
			var toollist = $("#subservices_1");
			toollist.empty();
			toollist.append('<option selected="true" value="0" style="font-weight: bold;">Select Tool</option>');
			for (var i = 0; i < osstools.length; i++) 
			{
				
				if(meta_data.ossTools[i].repoStatus == "TRUE"){
					toolswithresource.push(meta_data.ossTools[i].toolName);
				}
				//alert("inside each loop "+ " toolname "+ data.ossTools[i].toolName +" length " + data.ossTools.length);
				
			}

			toolswithresource.sort(function (a, b) {
				return a.toLowerCase().localeCompare(b.toLowerCase());
			});

			$.each(toolswithresource, function(i, item) {
		var currentTool = jmespath.search(meta_data, "ossTools[?toolName=='" + toolswithresource[i] + "']");
				/*toollist.append('<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 pb-3 "> <a href="#" class="card card-block custom-card m-auto justify-content-center" onclick="opentoolrepos(\''+toolswithresource[i]+'\',\''+currentTool[0].toolId+'\',\''+roleid+'\',\''+userid+'\')" style="background-color:'+ random_color()+';"><div class="card-body align-items-center d-flex m-auto text-center"><span class="card-title text-white text-uppercase font-weight-bold">'+toolswithresource[i]+'</span></div></a></div>'); */
				toollist.append('<option value="' + currentTool[0].toolId + '">' + currentTool[0].toolName + '</option>');
				
			});
			
		}
		else if($("#services_1").val() == '8')
		{
			$("#subservices_1").prop('disabled', false);
			ratingsetreset(1);
			var descrips = new Array();
			$.ajax({
				   //type: "GET",
				   //url: "docsjson/templates.json",
				   url: "oss-json/template_pub.json",
					async: false,
					//data: "{'MemberNumber': '" + $("#txt_id").val() + "'}",
					//contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function(data){
						
						//var templatesjson = JSON.stringify(data);
						//alert(templatesjson);
						//var tempcollec = jmespath.search(templatesjson, "TemplateCollection"); //trainingsjson.trainings);
						var toollist = $("#subservices_1");
						toollist.empty();
						//toollist.append('<option selected="true" value="0" style="font-weight: bold;">Select Template</option>');
						$.each(data.osTemplates, function(i_ot, v_ot) {
							$.each(v_ot.mainCategories, function(i_votmc, v_votmc) {
								$.each(v_votmc.subCategories, function(i_vvotmcsc, v_vvotmcsc) {
									toollist.append('<option value="' + v_vvotmcsc.scId + '">' + v_vvotmcsc.subCategory + '</option>');
									//descrips[v_vvtemcoll.tpId] = v_vvtemcoll.description;
									
								});
							});
						});
						
						  // choose target dropdown
						  var select = $('#subservices_1');
						  select.html(select.find('option').sort(function(x, y) {
							// to change to descending order switch "<" for ">"
							return $(x).text() > $(y).text() ? 1 : -1;
						  }));

						  // select default item after sorting (first item)
						  //$('select').get(0).selectedIndex = 0;
						$("#subservices_1").prepend('<option selected="true" value="0" style="font-weight: bold;">Select Template</option>');
					},
					error: function (data){
						alert("Templates list fetch error");
						return false;
					},
				  });
		}
		else if($("#services_1").val() == '9')
		{
			$("#subservices_1").prop('disabled', false);
			ratingsetreset(1);
			$.ajax({
				   //type: "GET",
				   url: "oss-json/iso_pub.json",
					async: false,
					//data: "{'MemberNumber': '" + $("#txt_id").val() + "'}",
					//contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function(data){
						
						//var templatesjson = JSON.stringify(data);
						//alert(templatesjson);
						//var tempcollec = jmespath.search(templatesjson, "TemplateCollection"); //trainingsjson.trainings);
						var toollist = $("#subservices_1");
						toollist.empty();
						//toollist.append('<option selected="true" value="0" style="font-weight: bold;">Select Template</option>');
						$.each(data.mainCategories, function(i_mc, v_mc) {
							$.each(v_mc.subCategories, function(i_vmcsc, v_vmcsc) {
								$.each(v_vmcsc.repoCollection, function(i_vvmcsc, v_vvmcsc) {
									if(v_vvmcsc.repoName != ""){
									toollist.append('<option value="' + v_vvmcsc.repoId + '">' + v_vvmcsc.repoName + '</option>');
									}
									//descrips[v_vvtemcoll.tpId] = v_vvtemcoll.description;
									
								});
							});
						});
						
						  // choose target dropdown
						  var select = $('#subservices_1');
						  select.html(select.find('option').sort(function(x, y) {
							// to change to descending order switch "<" for ">"
							return $(x).text() > $(y).text() ? 1 : -1;
						  }));

						  // select default item after sorting (first item)
						  //$('select').get(0).selectedIndex = 0;
						$("#subservices_1").prepend('<option selected="true" value="0" style="font-weight: bold;">Select ISO</option>');
					},
					error: function (data){
						alert("ISO list fetch error");
						return false;
					},
				  });
		}
		else if($("#services_1").val() == '14')
		{
			$("#subservices_1").prop('disabled', false);
			ratingsetreset(1);
			$.ajax({
				   //type: "GET",
				   url: "oss-json/deb_pub.json",
					async: false,
					dataType: "json",
					success: function(data){
						var toollist = $("#subservices_1");
						toollist.empty();
						//toollist.append('<option selected="true" value="0" style="font-weight: bold;">Select Template</option>');
						$.each(data.mainCategories, function(i_mc, v_mc) {
							$.each(v_mc.subCategories, function(i_vmcsc, v_vmcsc) {
								$.each(v_vmcsc.repoCollection, function(i_vvmcsc, v_vvmcsc) {
									if(v_vvmcsc.repoName != ""){
									toollist.append('<option value="' + v_vvmcsc.repoId + '">' + v_vvmcsc.repoName + '</option>');
									}
									//descrips[v_vvtemcoll.tpId] = v_vvtemcoll.description;
									
								});
							});
						});
						
						  // choose target dropdown
						  var select = $('#subservices_1');
						  select.html(select.find('option').sort(function(x, y) {
							// to change to descending order switch "<" for ">"
							return $(x).text() > $(y).text() ? 1 : -1;
						  }));

						  // select default item after sorting (first item)
						  //$('select').get(0).selectedIndex = 0;
						$("#subservices_1").prepend('<option selected="true" value="0" style="font-weight: bold;">Select DEB</option>');
					},
					error: function (data){
						alert("DEB list fetch error");
						return false;
					},
				  });
		}
		else if($("#services_1").val() == '15')
		{
			$("#subservices_1").prop('disabled', false);
			ratingsetreset(1);
			$.ajax({
				   //type: "GET",
				   url: "oss-json/rpm_pub.json",
					async: false,
					dataType: "json",
					success: function(data){
						var toollist = $("#subservices_1");
						toollist.empty();
						//toollist.append('<option selected="true" value="0" style="font-weight: bold;">Select Template</option>');
						$.each(data.mainCategories, function(i_mc, v_mc) {
							$.each(v_mc.subCategories, function(i_vmcsc, v_vmcsc) {
								$.each(v_vmcsc.repoCollection, function(i_vvmcsc, v_vvmcsc) {
									if(v_vvmcsc.repoName != ""){
									toollist.append('<option value="' + v_vvmcsc.repoId + '">' + v_vvmcsc.repoName + '</option>');
									}
									//descrips[v_vvtemcoll.tpId] = v_vvtemcoll.description;
									
								});
							});
						});
						
						  // choose target dropdown
						  var select = $('#subservices_1');
						  select.html(select.find('option').sort(function(x, y) {
							// to change to descending order switch "<" for ">"
							return $(x).text() > $(y).text() ? 1 : -1;
						  }));

						  // select default item after sorting (first item)
						  //$('select').get(0).selectedIndex = 0;
						$("#subservices_1").prepend('<option selected="true" value="0" style="font-weight: bold;">Select RPM</option>');
					},
					error: function (data){
						alert("RPM list fetch error");
						return false;
					},
				  });
		}
		else if($("#services_1").val() == '16')
		{
			$("#subservices_1").prop('disabled', false);
			ratingsetreset(1);
			$.ajax({
				   //type: "GET",
				   url: "oss-json/uot_pub.json",
					async: false,
					dataType: "json",
					success: function(data){
						var toollist = $("#subservices_1");
						toollist.empty();
						//toollist.append('<option selected="true" value="0" style="font-weight: bold;">Select Template</option>');
						$.each(data.mainCategories, function(i_mc, v_mc) {
							$.each(v_mc.subCategories, function(i_vmcsc, v_vmcsc) {
								$.each(v_vmcsc.repoCollection, function(i_vvmcsc, v_vvmcsc) {
									if(v_vvmcsc.repoName != ""){
									toollist.append('<option value="' + v_vvmcsc.repoId + '">' + v_vvmcsc.repoName + '</option>');
									}
									//descrips[v_vvtemcoll.tpId] = v_vvtemcoll.description;
									
								});
							});
						});
						
						  // choose target dropdown
						  var select = $('#subservices_1');
						  select.html(select.find('option').sort(function(x, y) {
							// to change to descending order switch "<" for ">"
							return $(x).text() > $(y).text() ? 1 : -1;
						  }));

						  // select default item after sorting (first item)
						  //$('select').get(0).selectedIndex = 0;
						$("#subservices_1").prepend('<option selected="true" value="0" style="font-weight: bold;">Select Update Tool</option>');
					},
					error: function (data){
						alert("Update Tools fetch error");
						return false;
					},
				  });
		}
		else if($("#services_1").val() == '9999')
		{
			$("#subservices_1").prop('disabled', 'disabled');
			$("#subservices_1").empty();
			$("#subservices_1").append('<option selected="true" value="0" style="font-weight: bold;">Select Sub-Service</option>');
			ratingsetreset(0);
		}
		else 
		{
			ratingsetreset(1);
			$("#subservices_1").empty();
			$("#subservices_1").append('<option selected="true" value="0" style="font-weight: bold;">Select Sub-Service</option>');
			$("#subservices_1").prop('disabled', 'disabled');
		}
			
	});
    $(document).on('click', '#fbsubmit_1', function(e){
        var captcha = $('#captcha_1').val();
		var mob = $('#mobile_1').val();
		var service = $("#services_1 option:selected").val();
		var subservice = $("#subservices_1 option:selected").val();
		var subservice_name, rate;
		if(subservice == 0)
		{
			subservice_name = "Nil";
		}
		else		
		{
			subservice_name = $("#subservices_1 option:selected").text();
		}
		if($("input[name='rate_1']:checked"). val() == 'Y')
		{ 
			rate = $(".rating_1").val();
		}
		else
		{
			rate = $("#rated_value_1").val();
		}
		var comment = $('#comment_1').val();
        var sid="11";
		var sref = "W";
		var getUrl = window.location;
		var baseUrl = getUrl.protocol + "//" + getUrl.host + getUrl.pathname;
		var cap_val = captchaValidation(captcha);
		
		if($("#comment_1").val() != "" && service > 0 ){
			}
		else{
			alert("Service/ Comments should not be blank");
			return false;
		}
		if(rate == 0 && $("input[name='rate_1']:checked"). val() == 'Y')
		{
			if( confirm("Want to proceed without rating?"))
			{
			}
			else
			{
				return false;
			}
		}
		/*if((service == 7 || service == 8 || service == 9) && subservice==0)
		{
			alert("Select sub service");
			return false;
		}*/
		
		
		
        if(cap_val == 1) {
            //$('#feedback_form').submit();
			//$('#fb_trn_id').val();
			//$('#fb_trn_id').show();
			
			$.ajax({
			   type: "POST",
			   async:false,
				url: 'feedback.php',
				data: {mobile:mob, services: service, subservices:subservice, subservicesname:subservice_name, rating:rate, comments:comment,refurl:baseUrl, serviceid:sid, srcref:sref},
				success: function(data){
					
					/*$("#SubscribeMail").empty();
					$("#SubscribeMail").append("<?php //echo $_SESSION['email']?>");*/
				$('#FeedbackModal_1').modal({
						backdrop: 'static'
				});
				if($.isNumeric(data))
				{
					$("#servicename_1").html($("#services_1").find(":selected").text());
					$("#trnid_1").html(data);
					$('#FeedbackModal_1').modal('toggle');
					$("#feedback_form_1").trigger("reset");
					$( "#reload_1" ).trigger( "click" );
					//$("#logoutwofeedback").trigger("click");
				}
				else
				{
					$("#FeedbackContent_1").html("Feedback Submission Error. Try again !!");
					$('#FeedbackModal_1').modal('toggle');
					$("#feedback_form_1").trigger("reset");
					$( "#reload_1" ).trigger( "click" );
				}
				},
			  });
        } else {
            $('#captcha1-error_1').html('Captcha not matched, Please try again').show();
            setTimeout(function(){ $('#captcha1-error_1').attr('style',''); $('#captcha1-error_1').html('Captcha not matched, Please try again');}, 100);
			return false;
        }
	
    });

$(document).on("click",".distribution", function(e){
	var sid = $(this).data("serviceid");
	methd="logentry";
	var sref = "W";
	var uid="<?php if(isset($_SESSION['user'])){echo $_SESSION['user'];} ?>";
	var baseUrl = $(this).attr("href");
	$.ajax({
		type: "POST",
		async:false,
		url: 'coding/common_functions.php',
		data: {method:methd, refurl:baseUrl, serviceid:sid, srcref:sref,userid:uid},
		success: function(logdata){
			if(logdata)
			{}else{alert("Share log error");}
		},
		});
});
$(document).on("click", ".locitem", function(e){
	//alert($(this).data("loc"));
	
	$.ajax({
	type:"POST",
	url:'coding/common_functions.php',
	data:{method:"repoUpdLocWise", loc:$(this).data("loc")},
	success: function(data){
		//console.log("console log data: "+data);
		var dataarr = $.parseJSON(data);
		if(dataarr[0] == 1){
			$("#latestUpdates_div").html(dataarr[1]);
			if(useractivestatus){
				$(".latestUpdateScroll a").removeClass("not-active");
			}
		}
		
	},
	error: function(err){
		alert("error : "+err);
		}
	});
});
$(document).ready(function() {
	var sdlist = <?php echo json_encode($sd_res_arr); ?>;
	var sdoslist = <?php echo json_encode($sdos_res_arr); ?>;
	var sdpaaslist = <?php echo json_encode($sdpaas_res_arr); ?>;
	var sdprobtyplist = <?php echo json_encode($sdprobtyp_res_arr); ?>;
	var sdapposlist = <?php echo json_encode($sdappos_res_arr); ?>;

	var os_from_sd = [];
	var appos_from_sd = [];
	var paas_from_sd = [];
	var probtyp_from_sd = new Array();


	//var sdlist_arr = new Array();
	var sdlist_arr = JSON.stringify(sdlist);
	var sdlist_jsonparse = JSON.parse(sdlist_arr);
	//console.log(JSON.parse(sdlist_arr));
	//console.log(sdlist_jsonparse);
	$.each( sdlist_jsonparse, function( key, val ) {
		//console.log("Index: "+val.id+"  **  "+val.digest_question);
		if($.inArray(val.os_id, os_from_sd) < 0 && $.trim(val.os_id) != ""  )  //id null = 9999 n/a
		{		os_from_sd.push(val.os_id);	}
		if($.inArray(val.applicable_os_id, appos_from_sd) < 0 && $.trim(val.applicable_os_id) != ""  )  //id null = 9999 n/a
		{		appos_from_sd.push(val.applicable_os_id);	}
		if($.inArray(val.paas_id, paas_from_sd) < 0 && $.trim(val.paas_id) != ""  )  //id null = 9999 n/a
		{		paas_from_sd.push(val.paas_id);	}
		if($.inArray(val.problem_type_id, probtyp_from_sd) < 0 && $.trim(val.problem_type_id) != ""  )  //id null = 9999 n/a
		{		probtyp_from_sd.push(val.problem_type_id);	}


	});
	/* Array.from(sdlist_jsonparse).forEach(key => { 
    //console.log("Id: " + digest);
    console.log(key.id +" - "+ key.digest_question);
	if($.inArray(key.os_id, os_from_sd) < 0 && $.trim(key.os_id) != ""  )  //id null = 9999 n/a
	{		os_from_sd.push(key.os_id);	}
	else{
		
	}
	});*/
	os_from_sd.sort(function(a, b){return a-b});
	appos_from_sd.sort(function(a, b){return a-b});
	paas_from_sd.sort(function(a, b){return a-b});
	probtyp_from_sd.sort(function(a, b){return a-b});
	//alert(os_from_sd+"  :: "+appos_from_sd+"  :: "+ paas_from_sd +"  :: "+probtyp_from_sd);

	//var sdoslist_arr = new Array();
	var sdoslist_arr = JSON.stringify(sdoslist);
	var sdoslist_jsonparse = JSON.parse(sdoslist_arr);
	//alert(sdoslist_jsonparse);
	/* Array.from(sdoslist_jsonparse).forEach(key => {
		//console.log(key.os_id +" - "+ key.os_name);
	}); */
var filterflx = "<div class='d-flex flex-wrap'>";
var listitem="";
	$.each(sdoslist_jsonparse, function (oslist_k, oslist_v){
		$.each(os_from_sd, function (key, val){
			if(oslist_v.os_id == val && oslist_v.os_id != 9999){
				/* $('#sdFilterOS')
				.append('<input type="checkbox" class="sdFilterOScls" data-sdfiltersubid="'+val+'"  id="os_'+oslist_v.os_name.replace(/ /g, "-")+'" name="os_'+oslist_v.os_name.replace(/ /g, "-")+'" value="'+oslist_v.os_name+'">')
				.append('<label for="os_'+oslist_v.os_name.replace(/ /g, "-")+'" class="pr-1">&nbsp;'+oslist_v.os_name+'</label></div>'); */
				listitem += '<div><input type="checkbox" class="sdFilterOScls" data-sdfiltersubid="'+val+'"  id="os_'+oslist_v.os_name.replace(/ /g, "-")+'" name="os_'+oslist_v.os_name.replace(/ /g, "-")+'" value="'+oslist_v.os_name+'"><label for="os_'+oslist_v.os_name.replace(/ /g, "-")+'" class="pr-1">&nbsp;'+oslist_v.os_name+'</label></div>';
			}
		});
	});
	$('#sdFilterOS').append(filterflx+listitem+'</div>');
	
	listitem = "";
	var sdapposlist_arr = JSON.stringify(sdapposlist);
	var sdapposlist_jsonparse = JSON.parse(sdapposlist_arr);
	$.each(sdapposlist_jsonparse, function (oslist_k, oslist_v){
		$.each(appos_from_sd, function (apposkey, apposval){
			//console.log(oslist_v.applicable_os_id+"  ===   "+apposval);
			if(oslist_v.applicable_os_id == apposval && oslist_v.applicable_os_id != 99){
				listitem += '<div><input type="checkbox" class="sdFilterApplicableOScls" data-sdfiltersubid="'+apposval+'" id="'+oslist_v.applicable_os_name.replace(/ /g, "-")+'" name="'+oslist_v.applicable_os_name.replace(/ /g, "-")+'" value="'+oslist_v.applicable_os_name+'"><label for="'+oslist_v.applicable_os_name.replace(/ /g, "-")+'" class="pr-1">&nbsp;'+oslist_v.applicable_os_name+'</label></div>';
			}
		});
	});
	$('#sdFilterApplicableOS').append(filterflx+listitem+'</div>');
	listitem="";
	
	var sdpaaslist_arr = JSON.stringify(sdpaaslist);
	var sdpaaslist_jsonparse = JSON.parse(sdpaaslist_arr);
	$.each(sdpaaslist_jsonparse, function (oslist_k, oslist_v){
		$.each(paas_from_sd, function (key, val){
			if(oslist_v.paas_id == val){
				listitem +='<div><input type="checkbox" class="sdFilterPaascls" data-sdfiltersubid="'+val+'" id="'+oslist_v.paas_desc.replace(/ /g, "-")+'" name="'+oslist_v.paas_desc.replace(/ /g, "-")+'" value="'+oslist_v.paas_desc+'"><label for="'+oslist_v.paas_desc.replace(/ /g, "-")+'" class="pr-1">&nbsp;'+oslist_v.paas_desc+'</label></div>';
			}
		});
	});
	$('#sdFilterPaas').append(filterflx+listitem+'</div>');
	listitem="";

	var sdprobtyplist_arr = JSON.stringify(sdprobtyplist);
	var sdprobtyplist_jsonparse = JSON.parse(sdprobtyplist_arr);
	$.each(sdprobtyplist_jsonparse, function (oslist_k, oslist_v){
		$.each(probtyp_from_sd, function (probkey, probval){
			if(oslist_v.problem_type_id == probval){
				listitem +='<div><input type="checkbox" class="sdFilterProblemTypecls" data-sdfiltersubid="'+probval+'" id="'+oslist_v.problem_type_desc.replace(/ /g, "-")+'" name="'+oslist_v.problem_type_desc.replace(/ /g, "-")+'" value="'+oslist_v.problem_type_desc+'"><label for="'+oslist_v.problem_type_desc.replace(/ /g, "-")+'" class="pr-1">&nbsp;'+oslist_v.problem_type_desc+'</label></div>';
			}
		});
	});
	$('#sdFilterProblemType').append(filterflx+listitem+'</div>');
	listitem="";
/* 	$.each(appos_from_sd, function (key, val){
		$.each(sdoslist_jsonparse, function (oslist_k, oslist_v){
			if(oslist_v.applicable_os_id == val){
				$('#sdFilterApplicableOS')
				.append('<input type="checkbox" class="" id="'+val+'" name="'+val+'" value="'+oslist_v.applicable_os_name+'">')
				.append('<label for="'+val+'" class="pr-1">&nbsp;'+oslist_v.applicable_os_name+'</label></div>')
				.append('&nbsp;');
			}
		});
	});
	$.each(paas_from_sd, function (key, val){
		$.each(sdoslist_jsonparse, function (oslist_k, oslist_v){
			if(oslist_v.paas_id == val){
				$('#sdFilterPaas')
				.append('<input type="checkbox" class="" id="'+val+'" name="'+val+'" value="'+oslist_v.paas_desc+'">')
				.append('<label for="'+val+'" class="pr-1">&nbsp;'+oslist_v.paas_desc+'</label></div>')
				.append('&nbsp;');
			}
		});
	});
	$.each(probtyp_from_sd, function (key, val){
		$.each(sdoslist_jsonparse, function (oslist_k, oslist_v){
			if(oslist_v.problem_type_id == val){
				$('#sdFilterProblemType')
				.append('<input type="checkbox" class="" id="'+val+'" name="'+val+'" value="'+oslist_v.problem_type_desc+'">')
				.append('<label for="'+val+'" class="pr-1">&nbsp;'+oslist_v.problem_type_desc+'</label></div>')
				.append('&nbsp;');
			}
		});
	}); */


	
	

	var sdpaaslist_arr = new Array();
	sdpaaslist_arr = JSON.stringify(sdpaaslist);
	var sdpaaslist_jsonparse = JSON.parse(sdpaaslist_arr);
	Array.from(sdpaaslist_jsonparse).forEach(key => {
		//console.log(key.paas_id +" - "+ key.paas_desc);
	});
	
	$(document).on("click",".sdFilterOScls, .sdFilterApplicableOScls, .sdFilterPaascls, .sdFilterProblemTypecls", function(e){
		//alert($(this).attr('class'));
		//alert($(this).data('sdfiltersubid'));
		var sdFilteredIds = [];
		//console.log(sdlist);
		//console.log(sdlist_arr);
		var selected_os_id=[], osF_ids = [];
		var selected_app_os_id =[], apposF_ids=[];
		var selected_paas_id =[], paasF_ids=[];
		var selected_prob_typ_id = [], probtypF_ids=[], filtered_ids = [];

		
		//alert($('.sdFilterOScls:checkbox:checked').val());
		//alert($('.sdFilterApplicableOScls:checkbox:checked').val());
		//alert($('.sdFilterPaascls:checkbox:checked').val());
		//alert($('.sdFilterProblemTypecls:checkbox:checked').val());
		$('.sdFilterOScls').each(function (index, obj) {
        	if (this.checked === true) {
            //alert($(this).data('sdfiltersubid'));
			if($.inArray($(this).data('sdfiltersubid'), selected_os_id) < 0 && $.trim($(this).data('sdfiltersubid')) != ""  )  //id null = 9999 n/a
			{			selected_os_id.push($.trim($(this).data('sdfiltersubid')));	}
            //alert($(this).val());
        	}
    	});
		$('.sdFilterApplicableOScls').each(function (index, obj) {
        	if (this.checked === true) {
            //alert($(this).data('sdfiltersubid'));
			if($.inArray($(this).data('sdfiltersubid'), selected_app_os_id) < 0 && $.trim($(this).data('sdfiltersubid')) != ""  )  //id null = 9999 n/a
			{			selected_app_os_id.push($.trim($(this).data('sdfiltersubid')));	}
            //alert($(this).val());
        	}
    	});
		$('.sdFilterPaascls').each(function (index, obj) {
        	if (this.checked === true) {
            //alert($(this).data('sdfiltersubid'));
			if($.inArray($(this).data('sdfiltersubid'), selected_paas_id) < 0 && $.trim($(this).data('sdfiltersubid')) != ""  )  //id null = 9999 n/a
			{			selected_paas_id.push($.trim($(this).data('sdfiltersubid')));	}
            //alert($(this).val());
        	}
    	});
		$('.sdFilterProblemTypecls').each(function (index, obj) {
        	if (this.checked === true) {
            //alert($(this).data('sdfiltersubid'));
			if($.inArray($(this).data('sdfiltersubid'), selected_prob_typ_id) < 0 && $.trim($(this).data('sdfiltersubid')) != ""  )  //id null = 9999 n/a
			{			selected_prob_typ_id.push($.trim($(this).data('sdfiltersubid')));	}
            //alert($(this).val());
        	}
    	});
		
		$.each( sdlist_jsonparse, function( key, val ) {
			//console.log(val.os_id+" **  "+selected_os_id+"  **  "+$.inArray($.trim(val.os_id), selected_os_id));
			
			/* works for OS alone
			if(
				$.inArray($.trim(val.id), filtered_ids) < 0 && $.trim(val.os_id) != ""   && $.inArray($.trim(val.os_id), selected_os_id) != -1 
				)
			{		filtered_ids.push($.trim(val.id));	}
			 */
			//console.log(val.os_id+" **  "+selected_os_id+"  **  "+val.paas_id+" **  "+selected_paas_id+"  **  "+$.inArray($.trim(val.os_id), selected_os_id)+"  **  "+$.inArray($.trim(val.paas_id), selected_paas_id));
			if(selected_os_id.length > 0){
				if(
					$.inArray($.trim(val.id), osF_ids) < 0 &&  
					($.inArray($.trim(val.os_id), selected_os_id) != -1 && $.trim(val.os_id) != "") /* && 
					(selected_paas_id.length > 0 && $.inArray($.trim(val.paas_id), selected_paas_id) != -1 && $.trim(val.paas_id) != "" ) */
					)
				{		osF_ids.push($.trim(val.id));	}
			}
			if(selected_app_os_id.length > 0){
				if(
					$.inArray($.trim(val.id), apposF_ids) < 0 && 
					($.inArray($.trim(val.applicable_os_id), selected_app_os_id) != -1 && $.trim(val.applicable_os_id) != "" )
					)
				{
					apposF_ids.push($.trim(val.id));	
						
				}
			}
			if(selected_paas_id.length > 0){
				if(
					$.inArray($.trim(val.id), paasF_ids) < 0 && 
					($.inArray($.trim(val.paas_id), selected_paas_id) != -1 && $.trim(val.paas_id) != "" )
					)
				{
					paasF_ids.push($.trim(val.id));	
						
				}
			}
			if(selected_prob_typ_id.length > 0){
				if(
					$.inArray($.trim(val.id), probtypF_ids) < 0 && 
					($.inArray($.trim(val.problem_type_id), selected_prob_typ_id) != -1 && $.trim(val.problem_type_id) != "" )
					)
				{
					probtypF_ids.push($.trim(val.id));	
						
				}
			}
			
        
		});


		/* $.each( selected_os_id, function( oskey, osval ) {
			$.each( sdlist_jsonparse, function( key, val ) {
				if($.inArray(val.id, filtered_ids) < 0 && $.trim(osval) != "" && val.os_id == osval )  //id null = 9999 n/a
				{		filtered_ids.push(val.id);	}
			});
		}); */
		//applicable os data - to be added in source query
		/* $.each( selected_app_os_id, function( oskey, osval ) {
			$.each( sdlist_jsonparse, function( key, val ) {
				if($.inArray(val.id, filtered_ids) < 0 && $.trim(osval) != "" && val.os_id == osval )  //id null = 9999 n/a
				{		filtered_ids.push(val.id);	}
			});
		}); */
		/* $.each( selected_paas_id, function( oskey, osval ) {
			$.each( sdlist_jsonparse, function( key, val ) {
				if($.inArray(val.id, filtered_ids) < 0 && $.trim(osval) != "" && val.paas_id == osval )  //id null = 9999 n/a
				{		filtered_ids.push(val.id);	}
			});
		});
		$.each( selected_prob_typ_id, function( oskey, osval ) {
			$.each( sdlist_jsonparse, function( key, val ) {
				if($.inArray(val.id, filtered_ids) < 0 && $.trim(osval) != "" && val.problem_type_id == osval )  //id null = 9999 n/a
				{		filtered_ids.push(val.id);	}
			});
		}); */
		var arr5 = [osF_ids, apposF_ids, paasF_ids, probtypF_ids];
		var arr6_user_selected = [];
		$.each( arr5, function( key, val ) {
			if(val.length > 0)  //id null = 9999 n/a
			{		arr6_user_selected.push(val);	}
		});
		//console.log(arr6_user_selected);

		/* arr6 = arr5.slice();
		filtered_ids = arr6.shift().filter(function(v) {
			return arr6.every(function(a) {
				return a.indexOf(v) !== -1;
			});
		}); */
		var newArr = "";
		newArr = arr6_user_selected.shift().reduce(function(res, v) {
			if (res.indexOf(v) === -1 && arr6_user_selected.every(function(a) {
				return a.indexOf(v) !== -1;
			})) res.push(v);
			return res;
		}, []);
		
		//alert('<pre>' +JSON.stringify(result,null,4)+ '</pre>');
		//console.log(selected_os_id+"  **  "+selected_app_os_id+"  **  "+selected_paas_id+"  **  "+selected_prob_typ_id +"  **  id counts: "+filtered_ids.length+"  **  "+filtered_ids);
		//console.log(osF_ids+"  **  "+apposF_ids+"  **  "+paasF_ids+"  **  "+probtypF_ids +"  **  common ids: "+JSON.stringify(result));
		
		//alert(arr5);
		//get common values from 2 or more arrays
		//let newArr = arr6_user_selected.reduce((x, y) => x.filter((z) => y.includes(z)));

	  //alert("common is: "+newArr+" Type  is :"+ $.type(newArr));

	  
		var filteredlist = "";
		
		if(newArr.length > 0){
			$.each( sdlist_jsonparse, function( key, val ) {
				$.each( newArr, function( k, v ) {
					if(v == val.id){
						filteredlist += "<li><div class='col-lg-12 col-md-10 col-sm-10 col-xs-10 pt-1'><span class='font-weight-bold text-indigo'><a class='digest' data-sd_id='"+val.id+"' href='#' data-toggle='modal' data-target='#SDmodal' data-anstext='"+btoa(unescape(encodeURIComponent($.trim(val.digest_answer))))+"' data-ques='"+btoa(unescape(encodeURIComponent($.trim(val.digest_question))))+"' data-trndate='"+converttodmy(val.trn_date)+"' data-ans='"+$.trim($.parseJSON(val.docs)[0])+"' data-videoavailable='"+$.trim(val.video_available)+"' data-video='"+$.trim($.parseJSON(val.videos)[0])+"'  title='Click here for details'>"+$.trim(val.digest_question)+"</a></span>&nbsp;<span class='text-deep-purple'>("+converttodmy(val.trn_date)+")</span><br/></div><hr/></li>";
					}
				});
			});
		}
		else{
			filteredlist = "No Records";
		}

		$("#sdFilterResult").html(filteredlist);
		//document.getElementById("intersection").innerHTML = "Common elements between arrays are : " + _.intersection(osF_ids, apposF_ids, paasF_ids, probtypF_ids);
	});
	function converttodmy(str) {
  var date = new Date(str),
    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
    day = ("0" + date.getDate()).slice(-2);
  return [day, mnth, date.getFullYear()].join("-");
}
	
});
$(document).on('click', "#sdFilterElements_btn", function(e){
	$("#sdFilterElements").toggle();
	$(this).text(function(i, text){
          if (text == "Hide filters")
		  {
			$("#sdFilterResultdiv").css('height', '400px') ; 
			return text = "Show filters" ;
		  }
		  else
		  {
			$("#sdFilterResultdiv").css('height', '180px'); 
			return text = "Hide filters";
		  }
      });

});
$(document).on('click', "#sdSearch_lnk", function(e){
	$(".glyphicon-search").addClass('text-yellow');
	$(".glyphicon-filter").removeClass('text-yellow');
	$(".glyphicon-remove").removeClass('text-yellow');

	$("#SupportDigest").addClass('d-none');
	$("#sdSearch").removeClass('d-none');
	$("#sdSearchText").focus();
	$("#sdFilter").addClass('d-none');
});
$(document).on('click', "#sdFilter_lnk", function(e){
	$(".glyphicon-search").removeClass('text-yellow');
	$(".glyphicon-filter").addClass('text-yellow');
	$(".glyphicon-remove").removeClass('text-yellow');

	$("#SupportDigest").addClass('d-none');
	$("#sdSearch").addClass('d-none');
	$("#sdFilter").removeClass('d-none');
	//$("#sdFilterElements_btn").removeClass('d-none');
	//$("#sdSearchText").focus();
});
$(document).on('click', "#sdClear_lnk", function(e){
	$(".glyphicon-search").removeClass('text-yellow');
	$(".glyphicon-filter").removeClass('text-yellow');
	$(".glyphicon-remove").addClass('text-yellow');

	$("#SupportDigest").removeClass('d-none');
	$("#sdSearch").addClass('d-none');
	$("#sdFilter").addClass('d-none');
});


$(document).on('keyup', "#sdSearchText", function(e){
	if($.trim($("#sdSearchText").val()) == "" )
	{return false;}
	$.ajax({
	type:"POST",
	url:'coding/common_functions.php',
	data:{method:"getSearchResults",sd_word:$("#sdSearchText").val()},
	success: function(data){
		//console.log("console log data: "+data);
		var dataarr = $.parseJSON(data);
		if(dataarr[0] == 1){
			$("#sdSearchResult").html(dataarr[1]);
			/* if(useractivestatus){
				$(".latestUpdateScroll a").removeClass("not-active");
			} */
		}
		
	},
	error: function(err){
		alert("error : "+err);
		}
	});

	

});

$(document).on("click", ".digest", function (e){
	//alert($(this).data("ques"));
	$("#sd_document").removeData('anslnk');
	$("#sd_video").removeData('videolnk');
	$("#sd_ques").css('color', 'teal');
	$("#sd_ques").text("");
	//$("#sd_ques").html(atob($(this).data("ques"))+"&nbsp;<span class='text-deep-purple'><i>("+$(this).data("trndate")+")</i></span>");
	$("#sd_ques").html(decodeURIComponent(escape(window.atob($(this).data("ques"))))+"&nbsp;<span class='text-deep-purple'><i>("+$(this).data("trndate")+")</i></span>");
	$("#sd_ans").css('color', 'teal');
	$("#sd_ans").text("");
	$("#sd_ans").html(decodeURIComponent(escape(window.atob($(this).data("anstext")))));
	if($(this).data("ans") == "" &&  $(this).data("videoavailable") == 'N'){
		$("#sd_ans_iframe").addClass('d-none');
		$("#sd_ans_iframe").prop('src',"");
	}
	else
	{
		$("#sd_ans_iframe").removeClass('d-none');
	}
	//alert($(this).data("ques")+"  **  "+ $(this).data("ans"));
	if($(this).data("videoavailable") == 'N'){
		$("#sd_video_elmt").addClass('d-none');
		$("#sd_video").attr("data-videolnk", "");
	}
	else{
		$("#sd_video_elmt").removeClass('d-none');
		$("#sd_video").attr("data-videolnk", $(this).data("video"));
		$("#sd_ans_iframe").prop('src',$(this).data("video"));
	}
	if($(this).data("ans") == ""){
		$("#sd_document_elmt").addClass('d-none');
		$("#sd_document").attr('data-anslnk', "");
	}
	else{
		$("#sd_document_elmt").removeClass('d-none');
		$("#sd_document").attr('data-anslnk', "");
		$("#sd_document").attr('data-anslnk', $(this).data("ans"));
		$("#sd_ans_iframe").prop('src',$(this).data("ans"));
	}
	$.ajax({
	type:"POST",
	url:'coding/common_functions.php',
	data:{method:"logentry_txtfile",sdid:$(this).data("sd_id")},
	success: function(data){
		//console.log("console log data: "+data);
		var dataarr = $.parseJSON(data);
		if(dataarr[0] == 1){
			//alert(dataarr[1]);
		}
		else{
			alert("Log entry failed");
		}
		
	},
	error: function(err){
		alert("error : "+err);
		}
	});
});
$(document).on("click", ".showdoc", function (e){
	e.preventDefault();
	//alert("showdoc : "+ $(this).data("anslnk")+"  **  "+$(this).data("ans"));
	/* $("#sd_document").attr('data-anslnk', "");
	$("#sd_document").attr('data-anslnk', $(this).data("ans"));  // holds previous value data ans
	*/
	$("#sd_ans_iframe").attr('src',"");
	//$("#sd_ans_iframe").contents().find("body").html("");
	$("#sd_ans_iframe").attr('src', $(this).data("anslnk"));
});
$(document).on("click", ".showvideo", function (e){
	e.preventDefault();
	//alert("showvideo");
	$("#sd_ans_iframe").attr('src', "");
	$("#sd_ans_iframe").contents().find("body").html("");
	$("#sd_ans_iframe").attr('src', $(this).data("videolnk"));
});
$("#logoutwofeedback, .trnfb_close").click(function(){	
	var roleid = sessionStorage.getItem('userroleid');
	var jwtflag = sessionStorage.getItem('jwtstatus');
	$.session.remove('polllater') ;
	//$.session.set('polllater', 'N');
	if(jwtflag == '1' && roleid !=4)
{
	window.location.replace("coding/logout.php?logoutbacktodigital");
}
else
{
	window.location.replace("coding/logout.php?logout");
}
});

$('#SDmodal').on('hidden.bs.modal', function () {
	$("#sd_ans_iframe").prop('src',"");
});

	</script>
   
  </body>
</html>
