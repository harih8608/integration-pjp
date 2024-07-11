<?php 
 if(session_id() == ''){
	session_start();
 } 
/*
//check if session user is available or not
if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
	echo "session check user set ".$_SESSION['user'];
	}
	else{
		echo "session check user unset ".$_SESSION['user'];
	}
*/
if ( !isset($_SESSION['user']) ) {
  header("Location: index.php");
   //header("Location: index.php");
  exit();
 }
 /*
	else if (isset($_SESSION['user'])!="" && isset($_SESSION['LAST_ACTIVITY']) && ((time() - $_SESSION['LAST_ACTIVITY']) > 60)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
	header("Location: sign-in.php");
   //header("Location: index.php");
  //exit;
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

*/
?>