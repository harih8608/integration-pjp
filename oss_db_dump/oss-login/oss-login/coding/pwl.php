<?php
//echo __LINE__:exit;
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 include 'checkemail.php';
 $dbcon = $conn;
$roleidval;
$emailforcb="";
 // it will never let you open index(login) page if session is set
 /*if ( isset($_SESSION['user']) != "" ) {
  //header("Location: ../pages/index.php");
  header("Location: ../index.php");
  exit;
 } else {
  header("Location: ../index.php");
 }*/
 if ( isset($_SESSION['user']) && !isset($_SESSION['user_roles_actions'])  ) {
  //header("Location: ../pages/index.php");
  header("Location: ../index.php");
  exit;
 } else {
  header("Location: ../index.php");
 }
 
 $error = false;
 
 //var_dump($_POST);exit;
 
 // if( isset($_POST['btn-login']) ) { 
  
  // prevent sql injections/ clear user invalid inputs
  $email = trim(strip_tags(htmlentities($_POST['username'])));
  $pass = trim(strip_tags(htmlentities($_POST['pwd'])));
  $captcha = trim(strip_tags(htmlentities($_POST['captcha'])));
  
  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
   $_SESSION['signin_email_error'] = $emailError;
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
   $_SESSION['signin_email_error'] = $emailError;
  }
  
  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
   $_SESSION['signin_pass_error'] = $passError;
  }

  $sess_captcha = $_SESSION["code"];
  $captcha_entered = $captcha;

  if($captcha_entered == '' || $captcha_entered == NULL) {
    $error = true;
    $captchaError = "Please enter captcha";
    $_SESSION['signin_captcha_error'] = $captchaError;
  } else if($sess_captcha != $captcha_entered) {
    $error = true;
    $captchaError = "Captcha entered not matched";
    $_SESSION['signin_captcha_error'] = $captchaError;
  }

  // if there's no error, continue to login
  if (!$error) {
   
   //$password = md5(base64_decode($pass));
   $password_tmp = hex2bin($pass);
   $password_tmp_arr = explode("//", $password_tmp);
   $password = $password_tmp_arr[0];
   $password = md5($password);
   //file_put_contents('..\vareportupload.txt',$pass."  **".$password."**  ".PHP_EOL);
   //$res=pg_query($conn, "SELECT id, username, email, password, mobile FROM users WHERE email='$email' and password='$password'");
//   $res=pg_query($conn, "SELECT user_id, name, email_id, password, mobile_no FROM mas_user WHERE email_id='$email' and password='$password' and active_status='A'");
   $qry="SELECT user_id, name, email_id, password, mobile_no FROM mas_user WHERE email_id=$1 and password=$2 and active_status='A'";
   $sqlname = "login1";
   if (!pg_prepare($conn, $sqlname, $qry)) {
	   die("Can't prepare '$qry': " . pg_last_error());
   }
   $res = pg_execute($conn, $sqlname, array($email,$password));

   $result =  pg_fetch_all($res);
   $count = pg_num_rows($res);


   if( $count == 1 ) {
	   
    /*$_SESSION['user'] = $result[0]['id'];
    $_SESSION['username'] = ucfirst($result[0]['username']);*/
	/*$_SESSION['user'] = trim(strip_tags(htmlentities($result[0]['id'])));
    $_SESSION['username'] =trim(strip_tags(htmlentities( ucfirst($result[0]['username']))));
	$_SESSION['email'] = trim(strip_tags(htmlentities($result[0]['email'])));
	$_SESSION['mobile'] = trim(strip_tags(htmlentities($result[0]['mobile'])));
	*/
	
	$_SESSION['jwtset'] = '0';
	$_SESSION['user'] = trim(strip_tags(htmlentities($result[0]['user_id'])));
    $_SESSION['username'] =trim(strip_tags(htmlentities( ucfirst($result[0]['name']))));
	$_SESSION['email'] = trim(strip_tags(htmlentities($result[0]['email_id'])));
	$_SESSION['mobile'] = trim(strip_tags(htmlentities($result[0]['mobile_no'])));
	$emailforcb = $_SESSION['email'];
	$user_id= trim(strip_tags(htmlentities($result[0]['user_id'])));
	$loginstatus = 'S';
	$_SESSION['loginvia']='S';
	$ipclient = get_client_ip_server();
	$failattempts = 0;
	//echo "<script>alert($ipclient);</script>";
	//exit;
	$loggeduserid = $_SESSION['user'];
//	$updateappuid = pg_query($conn,"set local.appuid = ' " . $_SESSION['user'] . " ' ");
	$qry = "set local.appuid = " . htmlspecialchars_decode($_SESSION['user']);
	$sqlname = "appuid";
	if (!pg_prepare($conn, $sqlname, $qry)) {
	die("Can't prepare '$qry': " . pg_last_error());}
	$updateappuid = pg_execute($conn, $sqlname, array());

	//$upd_lastlogin =pg_query($conn, "update mas_user set last_login=now() where email_id='$email'");
//	$roleres=pg_query($conn, "select mas_user.user_id,password,email_id,active_status,role_id,(select role_name from mas_roles where mas_roles.role_id=mas_user_roles.role_id)as rolename from mas_user,mas_user_roles where mas_user.user_id=mas_user_roles.user_id and mas_user.active_status='A' and mas_user.user_id='$loggeduserid'");
	$qry="select mas_user.user_id,password,email_id,active_status,role_id,(select role_name from mas_roles where mas_roles.role_id=mas_user_roles.role_id)as rolename from mas_user,mas_user_roles where mas_user.user_id=mas_user_roles.user_id and mas_user.active_status='A' and mas_user.user_id=$1";
	$sqlname = "login2";
	if (!pg_prepare($conn, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$roleres = pg_execute($conn, $sqlname, array($loggeduserid));
 
	$rolresult =  pg_fetch_all($roleres);
	//$count = pg_num_rows($res);
	//$_SESSION['userid'] = trim(strip_tags(htmlentities($result[0]['user_id'])));
    $_SESSION['roleid'] =trim(strip_tags(htmlentities( ucfirst($rolresult[0]['role_id']))));
	//echo "session variables are " .$_SESSION['user'] ."   ". $_SESSION['username']."   ". $_SESSION['email']. "   ". $_SESSION['mobile']. "  " .$_SESSION['roleid'];
	$roleidval = "";
	$roleidval = $_SESSION['roleid'];
	loginhistory($user_id,$ipclient,$loginstatus,$email,$failattempts);
	setcookie("nicCookie", "nicCookieValue");
    //header("Location: ../pages/index.php");
	header("Location: ../index.php");
	//loginhistory entry

        $tlog = fopen("test.log","w");
        fwrite($tlog,"session variables are " .$_SESSION['user'] ."   ". $_SESSION['username']."   ". $_SESSION['email']. "   ". $_SESSION['mobile']. "  " .$_SESSION['roleid']);
        fclose($tlog);	
	
	
   } else {

	   $offlmidexist = officialmail_nopswd_check();
	   $offlmidexistexparr = explode('~',$offlmidexist);
	 
		$checkMailFuncs = new checkemail();
		$checkMailDomain = $checkMailFuncs->validate_by_domains($email);
		$errMSG = "digital.nic.in! ". $offlmidexistexparr[0]."  ***   ".$offlmidexistexparr[1] ."   ***   ".$checkMailDomain ;	
		//condition checks for direct sign-in 
		//if($offlmidexistexparr[0] != 0 && $offlmidexistexparr[1] == null && $checkMailDomain)//nic user with no password (ie via digital.nic)
		if($checkMailDomain == true && $offlmidexistexparr[0] < 100000)//nic user with no password (ie via digital.nic)
		{
			$errMSG = "If you are an nic user, kindly login through digital.nic.in Menu option Menu -> Online Services -> OSS Repository Services";
			//header("Location: ../index.php?login=".$errMSG);
			header("Location: ../index.php");
		}
	   elseif ( $checkMailDomain == true && $offlmidexistexparr[0] > 100000){//nic/ gov user but not in mas_user
			$errMSG = "Invalid Credentials";
			header("Location: ../index.php");
	   }
	   elseif ($offlmidexistexparr[0] == 0 && $checkMailDomain == false){//other users unauthorised
	   //record Y -	pswd Y -	domain false
			$errMSG = "You are not an authorised user, Please contact your NIC contact person for authorisation";
			header("Location: ../index.php");
	   }
	   elseif ($offlmidexistexparr[0] != 0 && $offlmidexistexparr[1] != null  && $checkMailDomain == false){//other users with invalide credentials
			$errMSG = "Invalid Credentials";
			header("Location: ../index.php");
	   }
	   else{
		   $errMSG = "Login Error";
			header("Location: ../index.php");
	   }
	   /*
	   if($offlmidexist)// if record exists checked with only email id
	   { 
	    echo '<script>alert("If you are an nic user, kindly go through digital.nic.in");</script>';
		$errMSG = "If you are an nic user, kindly go through digital.nic.in!";
		$user_id= $offlmidexist;
		$loginstatus = 'F';
		//$failattempts = 1; //to do count increment 3times
		$failattempts = 0; //noofattempts($email);
		$ipclient = get_client_ip_server();
		//$failupd = pg_query($dbcon,"update login_history set login_time=now(),login_status='$loginstatus',failure_count='$failattempts' where email_id='$email'");
		loginhistory($user_id,$ipclient,$loginstatus,$email,$failattempts);
	   }else{//official mail non existence
		$user_id= $offlmidexist; //0
		$loginstatus = 'F';
		$failattempts = 0;
		$ipclient = get_client_ip_server();
		loginhistory($user_id,$ipclient,$loginstatus,$email,$failattempts);
	   }
	   */
		//$_SESSION['login_error'] = "Username/Password not matched";
		unset($_SESSION['code']);
		//header("Location: ../sign-in.php?login=errorbbb");
		//$errMSG = "Invalid Credentials, Try again...!";
		$_SESSION['signin_email_error'] = $errMSG;
		//header("Location: ../index.php?login=incorrect");
   }
    
  } else {
    unset($_SESSION['code']);
    //header("Location: ../sign-in.php?login=erroraaa");
	$errMSG = "Invalid Credentials, Try again...!!";
	$_SESSION['signin_email_error'] = $errMSG;
  }
  function val_id($id)
  {
	  if (is_numeric($id))
		{
			return $id;
		}
		else
		{
			return 0;
		}
	  
  }
  function val_uname($uname)
  {
	  if (is_numeric($uname))
		{
			return "Invalid";
		}
		else
		{
			return $uname;
		}
	  
  }
  /*The first one getenv() is used to get the values from PHP’s environment variables and the second one $_SERVER is used to get the values from the web server (e.g. apache). Note: This would work only on live site, because on your local host your ip would be one of the internal ip addresses, like 127.0.0.1*/
  /*function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}*/

  function getUserIP()
{
    //whether ip is from share internet
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   
	  {
		$ip_address = $_SERVER['HTTP_CLIENT_IP'];
	  }
	//whether ip is from proxy
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
	  {
		$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	  }
	//whether ip is from remote address
	else
	  {
		$ip_address = $_SERVER['REMOTE_ADDR'];
	  }
    return $ip_address;
}
  
  function officialmailcheck()
  {
	  global $email, $dbcon;
//	  $mailexist=pg_query($dbcon, "SELECT user_id, name, email_id, password, mobile_no FROM mas_user WHERE email_id='$email'");
	  $qry="SELECT user_id, name, email_id, password, mobile_no FROM mas_user WHERE email_id=$1";
	  $sqlname = "login-officialmailcheck";
	  if (!pg_prepare($dbcon, $sqlname, $qry)) {
		  die("Can't prepare '$qry': " . pg_last_error());
	  }
	  $mailexist = pg_execute($dbcon, $sqlname, array($email));
  
   $mchkresult =  pg_fetch_all($mailexist);
   $mccount = pg_num_rows($mailexist);
   if($mccount == 1)
   { //if mail id exists return emp id
	   $user_id= trim(strip_tags(htmlentities($mchkresult[0]['user_id'])));
	}
	else
	{ //if not exists return 0 as emp id
		$user_id = 0;
	}
	   return $user_id;   
  }
  function officialmail_nopswd_check()
  {
	  global $email, $dbcon;
//	  $mailexist=pg_query($dbcon, "SELECT user_id, name, email_id, password, mobile_no FROM mas_user WHERE email_id='$email'");
	  $qry="SELECT user_id, name, email_id, password, mobile_no FROM mas_user WHERE email_id=$1";
	  $sqlname = "login-officialmail_nopswd_check";
	  if (!pg_prepare($dbcon, $sqlname, $qry)) {
		  die("Can't prepare '$qry': " . pg_last_error());
	  }
	  $mailexist = pg_execute($dbcon, $sqlname, array($email));

   $mchkresult =  pg_fetch_all($mailexist);
   $mccount = pg_num_rows($mailexist);
   if($mccount == 1)
   { //if mail id exists return emp id
	   $user_id= trim(strip_tags(htmlentities($mchkresult[0]['user_id']))).'~'.strip_tags(htmlentities($mchkresult[0]['password']));
	}
	else
	{ //if not exists return 0 as emp id
		$user_id = 0;
	}
	   return $user_id;   
  }
  
  
 // }
?>
