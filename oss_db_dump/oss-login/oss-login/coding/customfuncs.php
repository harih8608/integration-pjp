<?php
 include 'coding/dbconnect.php';
  $dbcon = $conn;
  setextuservalidity();
  // clean user inputs to prevent sql injections
  /*
  //$empcode = trim(strip_tags(htmlentities($_POST['empcode'])));
  $name = trim(strip_tags(htmlentities($_SESSION['username'])));
  $email = trim(strip_tags(htmlentities($_SESSION['email'])));
  $mobile = trim(strip_tags(htmlentities($_POST['mobile'])));
  $services = trim(strip_tags(htmlentities($_POST['services'])));
  $comment = trim(strip_tags(htmlentities($_POST['comment'])));
  */
  

  
  
  
    
  // if there's no error, continue to submit feedback
  
   
   /*$query = "INSERT INTO oss_portal.trn_feedback(emp_code,emp_name,email_id, mobile_no,service_id,fb_description,assigned_emp_code) VALUES('1234','$name','$email','$mobile','$services','$comment','5678')";
   $res = pg_query($conn, $query);
    
   if ($res) {
*/

function rec_add(){
	global $dbcon;

	$_SESSION['add'] = "true";
	$qry = "select max(trn_id) as trn_id from oss_portal.trn_feedback";
	$sqlname = "rec_add";
	if (!pg_prepare($dbcon, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$trnidres = pg_execute($dbcon, $sqlname, array());
	

//   $trnidres = pg_query($conn,$trnid_qry);
   //$result =  pg_fetch_assoc($trnidres);
   $fb_trnid =  pg_fetch_result($trnidres, 0, 0);
   //$count = pg_num_rows($result);
   $_SESSION['trn_id'] = $fb_trnid;
   echo $fb_trnid;
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
   
   //header("Location: ../ossfeedback.php?fb=success");
   } 
  
function getssoflag($email)
{
  global $dbcon;
  //$ssoflagqry = "select * from mas_user where email_id='$email'";
  
  $qry = "select * from mas_user where email_id=$1";
  $sqlname = "getssoflag";
  if (!pg_prepare($dbcon, $sqlname, $qry)) {
	  die("Can't prepare '$qry': " . pg_last_error());
  }
  $ssoflagres = pg_execute($dbcon, $sqlname, array($email));

//  $ssoflagres= pg_query($dbcon,$ssoflagqry);
  $result =  pg_fetch_all($ssoflagres);
  //echo "   from db ".$result[0]['sso_flag']. " ------ ";
  //$fb_trnid =  pg_fetch_result($gettidres, 0, 0);
  if($result[0]['sso_flag']== 't'){
	  $ssoflag = '1';
	  $_SESSION['user'] = trim(strip_tags(htmlentities($result[0]['user_id'])));
  }
  else{
	  $ssoflag = '0';
  }
  return $ssoflag;
}
function getemailforempcode($empcode)
{
  global $dbcon;
  $emailid = "";
//  $getemailqry = "SELECT * FROM public.mas_user where emp_code='$empcode'";
  $qry = "SELECT * FROM public.mas_user where emp_code=$1";
  $sqlname = "getemailforempcode";
  if (!pg_prepare($dbcon, $sqlname, $qry)) {
	  die("Can't prepare '$qry': " . pg_last_error());
  }
  $getemailqryres = pg_execute($dbcon, $sqlname, array($empcode));

//  $getemailqryres= pg_query($dbcon,$getemailqry);
  $count = pg_num_rows($getemailqryres);
  $result =  pg_fetch_all($getemailqryres);
  if($count == 1)
  {
	  $emailid= $result[0]['email_id'];
  }
  return $emailid;
}
function setroleid($email)
  {
	  global $dbcon;
//	  $ssoflagqry = "select * from mas_user where email_id='$email'";
	  $qry = "select * from mas_user where email_id=$1";
	  $sqlname = "setroleid";
	  if (!pg_prepare($dbcon, $sqlname, $qry)) {
		  die("Can't prepare '$qry': " . pg_last_error());
	  }
	  $ssoflagres = pg_execute($dbcon, $sqlname, array($email));
	
//	  $ssoflagres= pg_query($dbcon,$ssoflagqry);
	  $result =  pg_fetch_all($ssoflagres);
	  //echo "   from db ".$result[0]['sso_flag']. " ------ ";
	  //$fb_trnid =  pg_fetch_result($gettidres, 0, 0);
	  if($result[0]['user_id'] < 100000 ){
		  $role = '2';
	  }
	  else{
		  $role = '4';
	  }
	  return $role;
  }
  function getuserid_logcount($email)
  {
	  global $dbcon;
	  $returnid_count="";
//	  $id_logcountqry = "select * from mas_user where email_id='$email'";
	  $qry = "select * from mas_user where email_id=$1";
	  $sqlname = "getuserid_logcount";
	  if (!pg_prepare($dbcon, $sqlname, $qry)) {
		  die("Can't prepare '$qry': " . pg_last_error());
	  }
	  $id_logcount_res = pg_execute($dbcon, $sqlname, array($email));

//	  $id_logcount_res= pg_query($dbcon,$id_logcountqry);
	   $count = pg_num_rows($id_logcount_res);
	  $result =  pg_fetch_all($id_logcount_res);
	  if($count == 1)
	  {
		  $returnid_count = '1~'.$result[0]['user_id'].'~'.$result[0]['login_count'];
	  }
	  else{
		  $returnid_count = '0';
	  }
	  
	  return $returnid_count;
  }
  function getrefid_validtill($userid)
  {
	  global $dbcon;
	  $returnrefid_validity="";
//	  $refid_validity_qry = "select * from mas_user_regn where regn_id='$userid'";
	  $qry = "select * from mas_user_regn where regn_id=$1";
	  $sqlname = "getrefid_validtill";
	  if (!pg_prepare($dbcon, $sqlname, $qry)) {
		  die("Can't prepare '$qry': " . pg_last_error());
	  }
	  $refid_validity_res = pg_execute($dbcon, $sqlname, array($userid));

//	  $refid_validity_res= pg_query($dbcon,$refid_validity_qry);
	   $count = pg_num_rows($refid_validity_res);
	  $result =  pg_fetch_all($refid_validity_res);
	  if($count == 1)
	  {
		  $returnrefid_validity = '1~'.$result[0]['ref_nician_email_id'].'~'.$result[0]['valid_till'];
	  }
	  else{
		  $returnrefid_validity = '0';
	  }
	  
	  return $returnrefid_validity;
  }

function setextuservalidity()
{
	global $dbcon;
	pg_query("BEGIN") or die("Could not start transaction\n");
	  //$updateappuid = pg_query($dbcon,"set local.appuid = ' " . $_SESSION['user'] . " ' ");
//	  $updmas_user_regn_qry = "update public.mas_user_regn set status='D', updated_date=now(), status_remarks='Validity Expired' where regn_id >= 100000 and status='A' and valid_till < current_date";
	  $updmas_user_regn_qry = "update mas_user_regn set status='D', updated_date=now(), status_remarks='Validity Expired' where regn_id >= 100000 and status='A' and valid_till < current_date";
	  $sqlname = "setextuservalidity1";
	  if (!pg_prepare($dbcon, $sqlname, $updmas_user_regn_qry)) {
		  die("Can't prepare '$updmas_user_regn_qry': " . pg_last_error());
	  }
	  $updmas_user_regn_res = pg_execute($dbcon, $sqlname, array());
	//	  $updmas_user_regn_res=pg_query($dbcon, $updmas_user_regn_qry);

	//$updateappuid = pg_query($dbcon,"set local.appuid = ' " . $_SESSION['user'] . " ' ");
	//	  $updmas_user_qry = "update mas_user set active_status='D', updated_date=now() where user_id >= 100000 and active_status='A' and valid_till < current_date";
	$updmas_user_qry = "update mas_user set active_status='D', updated_date=now() where user_id >= 100000 and active_status='A' and valid_till < current_date";
	$sqlname = "setextuservalidity2";
	if (!pg_prepare($dbcon, $sqlname, $updmas_user_qry)) {
		die("Can't prepare '$updmas_user_regn_qry': " . pg_last_error());
	}
	$updmas_user_res = pg_execute($dbcon, $sqlname, array());

//	  $updmas_user_res=pg_query($dbcon, $updmas_user_qry);
	  
	  if($updmas_user_regn_res && $updmas_user_res)
	  {
		  pg_query("COMMIT") or die("Transaction commit failed\n");
		  //echo '1';
	  }
	  else{
		  pg_query("ROLLBACK") or die("Transaction rollback failed\n");
		  //echo '0';
	  }
	  //pg_close($dbcon); 
}
function getUserActiveStatus($mail)
{
	global $dbcon;
  $act_flg =false;
//  $getemailqry = "SELECT active_status FROM public.mas_user where email_id='$mail'";
  $qry = "SELECT active_status FROM public.mas_user where email_id=$1";
  $sqlname = "getUserActiveStatus";
  if (!pg_prepare($dbcon, $sqlname, $qry)) {
	  die("Can't prepare '$qry': " . pg_last_error());
  }
  $getemailqryres = pg_execute($dbcon, $sqlname, array($mail));

//  $getemailqryres= pg_query($dbcon,$getemailqry);
  $count = pg_num_rows($getemailqryres);
  $result =  pg_fetch_all($getemailqryres);
  if($count == 1)
  {
	  if($result[0]['active_status'] == 'A')
	  {
		  $act_flg= true;
	  }
	  else
	  {
		  $act_flg= false;
	  }
  }
  return $act_flg;
}

function ymd_to_dmy($infoAsOn)
{
	$date = $infoAsOn;
$dmyparsed = explode("-", $date); //"regex [/.-]" for slash or dot or hyphen delimiters in date

return $dmyparsed[2].'-'.$dmyparsed[1].'-'.$dmyparsed[0];

}
function update_login_hist($email)
{
	global $dbcon;
//	$res=pg_query($dbcon, "SELECT user_id, name, email_id, password, mobile_no FROM mas_user WHERE email_id='$email' and active_status='A'");
	$qry="SELECT user_id, name, email_id, password, mobile_no FROM mas_user WHERE email_id=$1 and active_status='A'";
	$sqlname = "update_login_hist1";
	if (!pg_prepare($dbcon, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$res = pg_execute($dbcon, $sqlname, array($email));
  
   $result =  pg_fetch_all($res);
   $count = pg_num_rows($res);


   if( $count == 1 ) {
	   
    $_SESSION['user'] = trim(strip_tags(htmlentities($result[0]['user_id'])));
    $_SESSION['username'] =trim(strip_tags(htmlentities( ucfirst($result[0]['name']))));
	$_SESSION['email'] = trim(strip_tags(htmlentities($result[0]['email_id'])));
	$_SESSION['mobile'] = trim(strip_tags(htmlentities($result[0]['mobile_no'])));
	$emailforcb = $_SESSION['email'];
	$user_id= trim(strip_tags(htmlentities($result[0]['user_id'])));
	$loginstatus = 'D';
	$ipclient = get_client_ip_server();
	$failattempts = 0;
	//echo "<script>alert($ipclient);</script>";
	//exit;
	$loggeduserid = $_SESSION['user'];
//	$roleres=pg_query($dbcon, "select mas_user.user_id,password,email_id,active_status,role_id,(select role_name from mas_roles where mas_roles.role_id=mas_user_roles.role_id)as rolename from mas_user,mas_user_roles where mas_user.user_id=mas_user_roles.user_id and mas_user.active_status='A' and mas_user.user_id='$loggeduserid'");
	$qry="select mas_user.user_id,password,email_id,active_status,role_id,(select role_name from mas_roles where mas_roles.role_id=mas_user_roles.role_id)as rolename from mas_user,mas_user_roles where mas_user.user_id=mas_user_roles.user_id and mas_user.active_status='A' and mas_user.user_id=$1";
	$sqlname = "update_login_hist2";
	if (!pg_prepare($dbcon, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$roleres = pg_execute($dbcon, $sqlname, array($loggeduserid));

	$rolresult =  pg_fetch_all($roleres);
	//$count = pg_num_rows($res);
	//$_SESSION['userid'] = trim(strip_tags(htmlentities($result[0]['user_id'])));
    $_SESSION['roleid'] =trim(strip_tags(htmlentities( ucfirst($rolresult[0]['role_id']))));
	//echo "session variables are " .$_SESSION['user'] ."   ". $_SESSION['username']."   ". $_SESSION['email']. "   ". $_SESSION['mobile']. "  " .$_SESSION['roleid'];
	$roleidval = "";
	$roleidval = $_SESSION['roleid'];
	loginhistory($user_id,$ipclient,$loginstatus,$email,$failattempts);
   }
   
   
}
function isExistInOSOpinion($emailid)
{
	global $dbcon;
//	$res=pg_query($dbcon, "SELECT * FROM oss_portal.trn_os_opinion WHERE email_id='$emailid'");
	$qry="SELECT * FROM oss_portal.trn_os_opinion WHERE email_id=$1";
	$sqlname = "isExistInOSOpinion";
	if (!pg_prepare($dbcon, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$res = pg_execute($dbcon, $sqlname, array($emailid));

   $result =  pg_fetch_all($res);
   $count = pg_num_rows($res);
   if($count == 1)
   {
	   return 1;
   }
   else{
	   return 0;
   }
}
?>