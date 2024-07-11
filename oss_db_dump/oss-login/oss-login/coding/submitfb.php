<?php
 ob_start();
 session_start();

ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", "../nic.log");
//var_dump
//print_r


 ini_set('display_errors', true);
 ini_set('display_startup_errors', true);

 if( isset($_SESSION['user'])!="" ){
  header("Location: ../index.php");
 }

 include_once 'dbconnect.php';

 $error = false;
/*
$sess_captcha = $_SESSION['code'];
$captcha_entered = trim(strip_tags(htmlentities($_POST['captcha'])));
$_SESSION['captcha_error'] ="";
  if($captcha_entered == '' || $captcha_entered == NULL) {
    $error = true;
    $captchaError = "Please enter captcha";
    $_SESSION['captcha_error'] = $captchaError;
	exit;
  } else if($sess_captcha != $captcha_entered) {
    $error = true;
    $captchaError = "Captcha entered not matched";
    $_SESSION['captcha_error'] = $captchaError;
	exit;
  }
*/
 if ( isset($_POST['fbsubmit']) ) {
  
  
  // clean user inputs to prevent sql injections
  
  //$empcode = trim(strip_tags(htmlentities($_POST['empcode'])));
  $name = trim(strip_tags(htmlentities($_SESSION['username'])));
  $email = trim(strip_tags(htmlentities($_SESSION['email'])));
  $mobile = trim(strip_tags(htmlentities($_POST['mobile'])));
  $services = trim(strip_tags(htmlentities($_POST['services'])));
  $comment = trim(strip_tags(htmlentities($_POST['comment'])));
  
  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }
  /*
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT email FROM public.users WHERE email='$email'";
   $result = pg_query($conn, $query);
   $count = pg_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
   
  }
  */
  // comment validation
  if (empty($comment)){
   $error = true;
   $passError = "Please enter comment.";
  } 
  
    
  // if there's no error, continue to submit feedback
  if( !$error ) {
  /* 
   $query = "INSERT INTO oss_portal.trn_feedback(emp_code,emp_name,email_id, mobile_no,service_id,fb_description,assigned_emp_code) VALUES('1234','$name','$email','$mobile','$services','$comment','5678')";
   $res = pg_query($conn, $query);
    
   if ($res) {
*/ if (1) {
    unset($name);
    unset($email);
	unset($services);
    unset($comment);
    
	$trnid_qry = "select max(trn_id) as trn_id from oss_portal.trn_feedback";
   $trnidres = pg_query($conn,$trnid_qry);
   //$result =  pg_fetch_assoc($trnidres);
   $fb_trnid =  pg_fetch_result($trnidres, 0, 0);
   //$count = pg_num_rows($result);
   $_SESSION['trn_id'] = $fb_trnid;
   return $_SESSION['trn_id'];
  /* if( $count ) {
	   $_SESSION['trn_id']="";
	$_SESSION['trn_id'] = $result[0]['trn_id'];
	header("Location: ../ossfeedback.php?fb=success_if");
   }
   else{
   $_SESSION['trn_id'] = "no result";
   header("Location: ../ossfeedback.php?fb=success_else");
   }
   */
   header("Location: ../ossfeedback.php?fb=success");
   } else {

    header("Location: ../ossfeedback.php?fb=failure");

   } 
  
  } else {

    header("Location: ../ossfeedback.php?fb=elsefailure");

  }
  
 }
 ob_end_flush();

?>