
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
<?php
ini_set('display_errors',0);
error_reporting(E_ALL ^ E_WARNING); // Added for suppressing warnings

?>

<?php 
    //session_start();
	require_once 'coding/customfuncs.php';
	//unset($_SESSION['user']);
//session_unset();
//session_destroy();
    // if($_REQUEST['login'] == 'error') {
    //     var_dump($_SESSION);
    // }
	//include 'coding/login.php';
	/*function exhaustiontime($lastlogin)
  {
	  $starttimestamp = new DateTime($lastlogin);
	  echo "start time ". $starttimestamp->format('Y-m-d H:i:s')."<br/>";
	  date_default_timezone_set('Asia/Kolkata');
	  $endtimestamp = new DateTime(date('Y-m-d H:i:s'));
	  //$endtimestamp = new DateTime("2019-10-04 15:34:49");
	  echo "end time ". $endtimestamp->format('Y-m-d H:i:s')."<br/>";
	  //$difference = abs($starttimestamp - $endtimestamp)/3600;
	  
	  $diff = $endtimestamp->diff($starttimestamp);
	  
	  $hours = $diff->H;
		$hours = $hours + ($diff->days*24);

	echo " Time diff is ".$hours;
	//return $hours;
  }
//exhaustiontime("2019-10-04 12:58:00.035813");
exhaustiontime("2019-10-04 05:00:51.767767");*/
?>    
<section>
    <div class="login-box">
	<!-- sign in modal starts -->
			<div class="modal fade col-md-12" id="md5Modal">
				<div class="modal-dialog modal-md">
				  <div class="modal-content" style="background-color:#ffffff;">
				  
					<!-- Modal Header -->
					<div class="modal-header">
					  
					  
<a href="https://digital.nic.in/" class="btn btn-info btn-md col-lg-12 col-md-10 col-sm-6 col-xs-12">Sign-In for NIC employee &nbsp;&nbsp;<span class="glyphicon glyphicon-log-in"></span>&nbsp; Digital NIC
						</a>
					  <!--<button type="button" class="closemodal" data-dismiss="modal" aria-label="Close">&times;</button>-->
					</div>
					
					<!-- Modal body -->
					<div class="modal-body" id="md5content"   >
					 	  
						 
						  
						  
						  <div class="card">
            <div class="body">
                <form id="sign_in_form" method="POST" action="coding/login.php" class="bg-paleorange p-2">
		<input type="hidden" name='pwd' />
                    <div class="msg"><h6 class="modal-title font-weight-bold text-left unselectable" style="font-family:arial;color: DodgerBlue;"> Sign-In for Registered User</h6></div><br/>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line col-lg-11">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                        </div>
                       
                    </div>
					<br/>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line col-lg-11">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required>
                        </div>
                            <?php if( isset($_SESSION['signin_pass_error']) && $_SESSION['signin_pass_error'] != '' && $_SESSION['signin_pass_error'] != NULL) { ?>
                                <label id="username1-error" class="error" for="password"> <?php echo $_SESSION['signin_pass_error']; ?></label>
                            <?php } ?>
                    </div>
                    <br/>
                    <div class="input-group" id="captcha_code">
                        <span class="input-group-addon">
                            <i class="material-icons"></i>
                        </span>
                        <div id="imgdiv"  class="col-lg-11 ml-4">
                            <img id="cap_img" src="coding/captcha.php" style="height: 40px;">
                            <i class="material-icons" id="reload" style="cursor: pointer;">
                                <img src="images/refresh.png" style="height: 30px;">
                            </i>
                        </div>
                    </div>
<br/>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">done</i>
                        </span>
                        <div class="form-line col-lg-11">
                            <input type="text" class="form-control" maxlength="6" id="captcha" name="captcha" placeholder="Please enter above captcha here" autocomplete="off" required>
                        </div>
                        <?php if(isset($_REQUEST['login']) && isset($_SESSION['signin_captcha_error'])) {if($_REQUEST['login'] == 'error' && $_SESSION['signin_captcha_error'] != '' && $_SESSION['signin_captcha_error'] != NULL) { ?>
                            <label id="username1-error" class="error" for="captcha"> <?php echo $_SESSION['signin_captcha_error']; ?></label>
                        <?php } }?>
                        <label id="captcha1-error" class="error" for="captcha"></label>
                    </div>
					<br/>
                    <div class="row">
                        <!-- <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-lg-5">
                            <a href="non_nic_login.php">Non-NIC Users Login</a></br><a href="sign-up.php">Register Now!</a>
                        </div>
						<div class="col-lg-4">
                            <a href="#" class="waves-effect font-weight-bold text-pink" id="regis_policy" name="regis_policy" data-toggle="modal" data-target="#registration_policy">Not Registered? click here</a>
                        </div>-->
						
                        <div class="col-lg-12">
                            <!--<input class="btn btn-block bg-pink waves-effect" id="sign-in-btn" name="btn-login" type="submit" value="SUBMITTTT">-->
							<button class="btn btn-block bg-pink waves-effect font-weight-bold text-orange" id="sign-in-btn" name="btn-login" type="button">SIGN IN</button>
                        </div>
						<br/><br/>
						<div class="col-lg-12 waves-effect font-weight-bold text-pink">Not registered? Please contact your NIC Co-Ordinator
						</div>
                    </div>
                    <!--  <div class="row m-t-15 m-b--20">
                       <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div> 
                    </div>-->
					<br/>
                </form>
            </div>
        </div>						  
						  
						  						  
						  
						  
						  
					 </div>
					
					<!-- Modal footer -->
					<div class="modal-footer" id="md5contentfooter" style="float:right;">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					  <!--<button type="button" class="closemodal" data-dismiss="modal" aria-label="Close">&times;</button>-->
					  <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
					  <!--<button id="CloseModalbtn" type="button" class="btn btn-danger">Close</button>-->
					</div>
					
				  </div>
				</div>
			</div>
			<!-- sign in modal ends -->
    </div>
<div class="modal fade" id="registration_policy">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	  
		<!-- Modal Header -->
		<div class="modal-header">
		  <h5 class="modal-title" style="color: DodgerBlue;">To register, Please contact your NIC Co-Ordinator</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close">&times;</button>
		</div>
		
		<!-- Modal body -->
		
		
		
	  </div>
	</div>
 </div>
 </section>
 <script src="assets/js/jquery.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    var captcha_match;
	/*$.ajax({
              type: "POST",
              url: 'coding/common_functions.php',
              data : {method:'setextuservalidity'},
              success: function(data) {
               if(data == '1')
				{
					
				}
				else{
					alert("Validity check Error !!");
				}
				return true;
              },
              error: function(res) {
				  alert("Server error "+errdata);
				return false;
              }
            });
		*/	
$( "#md5Modal" ).on('shown.bs.modal', function(e){
	$( "#reload" ).trigger( "click" );
});
    $(document).on('click', '#reload', function(e) {
        $("#imgdiv").html('');
        var id = Math.random();
        $('#imgdiv').html('<img style="height:40px;" id="cap_img" src="coding/captcha.php?id='+id+'"/> <i class="material-icons" id="reload" style="cursor: pointer;"><img src="images/refresh.png" style="height: 30px;"></i></div>');
        $('#captcha').val('');
        $('#captcha1-error').html('');
    });

    $(document).on('foucusout, blur', '#captcha', function(e){
        captchaValidation($(this).val());
    });
	$(document).on('foucusout, blur', '#username', function(e){
		var uname = $("#username").val();
        $.ajax({
              type: "POST",
              url: 'coding/common_functions.php',
              data : {method:'checkextuservalidity',username:uname},
              success: function(data) {
               if(data == '0')
				{
					alert("Account in deactive !!");
//					 $("#username").val('');
//					 $("#username").focus();
					return false;
				}
				else{
					//alert("Valid account !!");
					return true;
				}
              },
              error: function(res) {
				  alert("Server error "+errdata);
				return false;
              }
            });
    });
/*
$('#captcha').keyup(function(e){
    if(e.keyCode == '13')
    {
        $(this).trigger("enterKey");
    }
});
$('#captcha').bind("enterKey",function(e){
   //do stuff here
   //captchaValidation($(this).val());
   $("#sign-in-btn").trigger("click");
});*/
    function captchaValidation(captcha) {
        var captcha = captcha;
        var data = "captcha="+captcha+"&method=matchCaptcha";
        if(captcha.length == 6) {
            $.ajax({
              type: "POST",
			  async:false,
              url: 'coding/common_functions.php',
              data : data,
              success: function(res) {
               //alert(res);
                captcha_match = JSON.parse(res);
               //alert('res = '+res);
                if(captcha_match != '1') {
                    $('#captcha1-error').html('Captcha not matched, Please try again!').show();
                    //setTimeout(function(){ $('#captcha1-error').attr('style',''); $('#captcha1-error').html('Captcha not matched, Please try again');}, 100);
                } else {
                    $('#captcha1-error').html('');
                    //$('#sign_in_form').submit();
                }
              },
              error: function(res) {
              }
            });
        } else {
            //$('#captcha1-error').html('');
			$('#captcha1-error').html('Captcha not matched, Please try again!!').show();
        }
        return captcha_match;
    }
    
    $(document).on('click', '#sign-in-btn', function(e){
        var captcha = $('#captcha').val();
        var cap_val = captchaValidation(captcha);
        var email_val = isValidEmailAddress($('#username').val());

        if(cap_val == 1) {
	    var pwd = $("#password").val();
            randres = makeid(62-pwd.length);
            $("input[name='pwd']").val(ascii_to_hexa(pwd+"//"+randres)); //64 - 2chars(//) -  pwd length => 128 length hex val
            $("#password").val("");
            $('#sign_in_form').submit();
        } else {
            $('#captcha1-error').html('Captcha not matched, Please try again!!!').show();
            //setTimeout(function(){ $('#captcha1-error').attr('style',''); $('#captcha1-error').html('Captcha not matched, Please try again');}, 100);
        }
    });
   function ascii_to_hexa(str)//generates 2chars for 1 char, 128 length like sha512 is from 64 chars string. 
  {
	var arr1 = [];
	for (var n = 0, l = str.length; n < l; n ++) 
     {
		var hex = Number(str.charCodeAt(n)).toString(16);
		arr1.push(hex);
	 }
	return arr1.join('');
   }
   function makeid(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
    }
    return result;
  }


    function isValidEmailAddress(emailAddress) {
        var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return pattern.test(emailAddress);
    }

})

</script>




