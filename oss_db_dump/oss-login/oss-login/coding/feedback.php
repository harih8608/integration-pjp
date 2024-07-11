<?php
 
ob_start();
session_start();
 
if( isset($_POST['feedback_submit']) ) { 
  // prevent sql injections/ clear user invalid inputs
  $req_soft = trim(strip_tags(htmlspecialchars($_POST['req_soft'])));
  $suggestion = trim(strip_tags(htmlspecialchars($_POST['suggestion'])));
  $user_id = $_SESSION['user'];
  
  if ($suggestion != '' && $suggestion != NULL && $req_soft != '' && $req_soft != NULL) {
    $conString = "host=localhost port=5432 dbname=opt_sys user=postgres password=postgres";
    $db_con = pg_connect($conString) or die('Could not connect: ' . pg_last_error());

//    $res=pg_query($db_con, "INSERT into feedback (user_id, soft_req, suggestion, updated_date) VALUES ('$user_id','$req_soft','$suggestion',now())");
    $qry="INSERT into feedback (user_id, soft_req, suggestion, updated_date) VALUES ($1,$2,$3,now())";
    $sqlname = "feedback";
    if (!pg_prepare($conn, $sqlname, $qry)) {
      die("Can't prepare '$qry': " . pg_last_error());
    }
    $res = pg_execute($db_con, $sqlname, array($user_id,$req_soft,$suggestion));
 
    if($res) {
      header("Location:../pages/contact_us.php?feedback=success");
    } else {
      header("Location:../pages/contact_us.php?feedback=failer");
    }
    
  } else {
    header("Location:../pages/contact_us.php");
  }
}

?>