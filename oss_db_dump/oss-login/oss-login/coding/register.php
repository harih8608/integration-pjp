<?php
 ob_start();
 session_start();

 ini_set('display_errors', true);
 ini_set('display_startup_errors', true);

 if( isset($_SESSION['user'])!="" ){
  header("Location: ../index.php");
 }

 include_once 'dbconnect.php';

 $error = false;

 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections
  $empid = trim(strip_tags(htmlspecialchars($_POST['empid'])));
  $name = trim(strip_tags(htmlspecialchars($_POST['name'])));
  $email = trim(strip_tags(htmlspecialchars($_POST['email'])));
  $mobile = trim(strip_tags(htmlspecialchars($_POST['mobile'])));
  $pass = trim(strip_tags(htmlspecialchars($_POST['password'])));
  
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
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $qry = "SELECT email FROM mas_user WHERE email_id=$1";
   $sqlname = "register0";
   if (!pg_prepare($conn, $sqlname, $qry)) {
     die("Can't prepare '$qry': " . pg_last_error());
   }
   $result = pg_execute($conn, $sqlname, array($email));

//   $result = pg_query($conn, $query);
   $count = pg_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 5) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
  
  // password encrypt using md5();
  $password = md5($pass);
  
  // if there's no error, continue to signup
  if( !$error ) {
 //  $query = "INSERT INTO mas_user(user_id,emp_code,name,email_id,password,updated_date, mobile_no) VALUES('$empid','$empid','$name','$email','$password',now(),'$mobile')";

   $qry = "INSERT INTO mas_user(user_id,emp_code,name,email_id,password,updated_date, mobile_no) VALUES($1,$2,$3,$4,$5,now(),$6)";
   $sqlname = "register";
   if (!pg_prepare($conn, $sqlname, $qry)) {
     die("Can't prepare '$qry': " . pg_last_error());
   }
   $res = pg_execute($conn, $sqlname, array($empid,$empid,$name,$email,$password,$mobile));


//   $res = pg_query($conn, $query);
    
   if ($res) {

    unset($name);
    unset($email);
    unset($pass);
    header("Location: ../sign-in.php?reg=success");
   
   } else {

    header("Location: ../sign-up.php?reg=failure");

   } 
  
  } else {

    header("Location: ../sign-up.php?reg=failureelse");

  }
  
 }
 ob_end_flush();

?>