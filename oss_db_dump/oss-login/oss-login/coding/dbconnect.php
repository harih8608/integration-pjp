<?php

 // error_reporting( ~E_DEPRECATED & ~E_NOTICE );
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
 define('DBHOST', 'localhost');
 define('DBUSER', 'ossportal');
 define('DBPASS', 'ossportal');
 //define('DBNAME', 'opt_sys');
 //define('DBNAME', 'ossTools'); 
 //define('DBNAME', 'ossToolsNew');
 define('DBNAME', 'oss_docker'); //new live db 
 //define('DBNAME', 'postgres'); //old live
 define('DBPORT', '5432');

 // global $conn;
//$ksloc = "http://10.163.14.80:808/toollister/tool/kickstart/";

 $conn = pg_connect("host=" . DBHOST .  " port=" . DBPORT . " dbname=" . DBNAME . " user=" . DBUSER . " password=" . DBPASS)  or die('connection failed' . error_get_last());




/*
function getUserAccessRoleByID($id)
{
	global $conn;
		
	$query = "select user_role from tbl_user_rolewhere  id = ".$id;
	
	$rs = mysqli_query($conn,$query);
	$row = mysqli_fetch_assoc($rs);
		
	return $row['user_role'];
}
*/
function get_client_ip_server() {
    $ipaddress = '';
    if (array_key_exists('HTTP_CLIENT_IP', $_SERVER))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}
function loginhistory($user_id,$ipclient,$loginstatus,$mail,$failattempts)
  {
	  global $conn;
	  /*if(mailexist_loghis($mail) == false){
		$loginqry = "insert into login_history (user_id,ipaddress,login_time,login_status,email_id,failure_count) values('$user_id','$ipclient',now(),'$loginstatus','$mail','$failattempts')"; 
	  }
	  else
	  {
			$faillastlogtime=pg_query($conn, "SELECT * FROM login_history WHERE email_id='$mail'");
			$flltimresult =  pg_fetch_all($faillastlogtime);
			$lapsetime = exhaustiontime($flltimresult[0]['login_time']);
			if($lapsetime < 3)
			{
			$loginqry ="update login_history set login_status='$loginstatus',failure_count='$failattempts',ipaddress='$ipclient' where email_id='$mail'";	
			}
			elseif($lapsetime >= 3)
			{
				$loginqry ="update login_history set login_time=now(),login_status='$loginstatus',failure_count='$failattempts',ipaddress='$ipclient' where email_id='$mail'";
			}
	  }*/
//	  $updateappuid = pg_query($conn,"set local.appuid = ' " . $user_id . " ' ");
	  $qry = "set local.appuid = " . htmlspecialchars_decode($user_id);
	  $sqlname = "appuid1";
	  if (!pg_prepare($conn, $sqlname, $qry)) {
	  die("Can't prepare '$qry': " . pg_last_error());}
	  $updateappuid = pg_execute($conn, $sqlname, array());
  
//	  $loginqry = "insert into login_history (user_id,ipaddress,login_time,login_status,email_id,failure_count) values('$user_id','$ipclient',now(),'$loginstatus','$mail','$failattempts')";
	  $qry = "insert into login_history (user_id,ipaddress,login_time,login_status,email_id,failure_count) values($1,$2,now(),$3,$4,$5)";
	  $sqlname = "loginhistory1";
	  if (!pg_prepare($conn, $sqlname, $qry)) {
		  die("Can't prepare '$qry': " . pg_last_error());
	  }
  
//	  $updateappuid = pg_query($conn,"set local.appuid = ' " . $user_id . " ' ");
//		$updateappuid_row=pg_fetch_array($updateappuid);
		$logininsert = pg_execute($conn, $sqlname, array($user_id,$ipclient,$loginstatus,$mail,$failattempts));

	//	$logininsert = pg_query($conn,$loginqry);
		
//	$update_mas_user_res = pg_query($conn, "update public.mas_user set last_login=now() where user_id='$user_id'");
	$qry = "update public.mas_user set last_login=now() where user_id=$1";
	$sqlname = "loginhistory2";
	if (!pg_prepare($conn, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$update_mas_user_res = pg_execute($conn, $sqlname, array($user_id));

		/*if($logininsert)
		{}
		else
		{}*/
	return true;
  }
function mailexist_loghis($mail)
  {
	  global $conn;
//	  $mailexist=pg_query($conn, "SELECT * FROM login_history WHERE email_id='$mail'");
	  $qry="SELECT * FROM login_history WHERE email_id=$1";
	  $sqlname = "mailexist_loghis";
	  if (!pg_prepare($conn, $sqlname, $qry)) {
		  die("Can't prepare '$qry': " . pg_last_error());
	  }
	  $mailexist = pg_execute($conn, $sqlname, array($mail));
     $mchkresult =  pg_fetch_all($mailexist);
   $mccount = pg_num_rows($mailexist);
   if($mccount == 1)
   { //if mail id exists return emp id
	   $user_id= trim(strip_tags(htmlentities($mchkresult[0]['user_id'])));
	   $idexiststatus = true;
	}
	else
	{ //if not exists return 0 as emp id
		$user_id = 0;
		$idexiststatus = false;
	}
	   return $idexiststatus;   
  }
  function noofattempts($mail)
  {
	  global $conn;
//	   $nooffails=pg_query($conn, "SELECT user_id,login_time,email_id, failure_count FROM login_history WHERE email_id='$mail'");
	   $qry="SELECT user_id,login_time,email_id, failure_count FROM login_history WHERE email_id=$1";
	   $sqlname = "noofattempts";
	   if (!pg_prepare($conn, $sqlname, $qry)) {
		   die("Can't prepare '$qry': " . pg_last_error());
	   }
	   $nooffails = pg_execute($conn, $sqlname, array($mail));
 
	   $nooffailsres =  pg_fetch_all($nooffails);
	   $mccount = pg_num_rows($nooffails);
	   
	   if($nooffailsres[0]['failure_count'] <=2)
	   { 
			//if mail id exists return emp id
		   //$user_id= trim(strip_tags(htmlentities($nooffailsres[0]['failure_count'])));
		   $attempts = $nooffailsres[0]['failure_count']+ 1;
		   $_SESSION['login_error'] = "Username/Password not matched";
		}
		elseif ($nooffailsres[0]['failure_count'] == 3 ) // check attempts exhaustion below 3hrs
		{ 
			//if not exists return 0 as emp id
			$timediff = exhaustiontime($nooffailsres[0]['login_time']);
			if($timediff >= 3) // grt than or eq 3 hrs  check timediff value by updating in any string field
			{
				$attempts = 1;//  time check **********
				$_SESSION['login_error'] = "Username/Password not matched";
				
			}
			elseif($timediff < 3) // less than 3 hrs
			{
				$attempts = 3;	
				$_SESSION['login_error'] = "No.of attempts lapsed, Please try later";

			}
			
		}
		/*else if ($nooffailsres[0]['failure_count'] == 3 && exhaustiontime($nooffailsres[0]['login_time']) < 3) // check attempts exhaustion below 3hrs
		{ //if not exists return 0 as emp id
			echo "<script>alert('Please try later');</script>";
			$attempts = 3;
		}
		*/
		   return $attempts; 
	  
  }
  function exhaustiontime($lastlogin)
  {
	  $starttimestamp = new DateTime($lastlogin);
	  date_default_timezone_set('Asia/Kolkata');
	  $endtimestamp = new DateTime(date('Y-m-d H:i:s'));
	  //$endtimestamp = new DateTime('2019-10-04 11:41:25');
	  //$difference = abs($starttimestamp - $endtimestamp)/3600;
	  
	  $diff = $endtimestamp->diff($starttimestamp);
	  $hours = $diff->H;
		$hours = $hours + ($diff->days*24);

	//echo $hours;
	return $hours;
  }
 ?>
