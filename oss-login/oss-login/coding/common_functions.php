<?php

$conn = '';
$ossdomain='';
include 'dbconnect.php';
include 'url_locs.php';
// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);
// error_reporting(E_ALL);

$method = $_REQUEST['method'];

  switch ($method) {
      case "getInfo":
          getInfo($_REQUEST, $conn);
          break;
/*
		  case 'getOSStack':
          getOSStack($_REQUEST, $conn);
          break;
      case 'getOSCombo':
          getOSCombo($_REQUEST, $conn);
          break;
      case 'getRemarks':
          getRemarks($_REQUEST, $conn);
          break;
      case 'getfileURL':
          getfileURL($_REQUEST, $conn);
          break;

	  case 'searchOSS' :
          getOssSearch($_REQUEST, $conn);
          break;
      case 'getTechStack' :
          getTechStack($_REQUEST, $conn);
          break;
      case 'getSolutionStack' :
          getSolutionStack($_REQUEST, $conn);
          break;
      case 'getFunctionalArea' :
          getFunctionalArea($_REQUEST, $conn);
          break;
      case 'getOSSList' :
          getOSSList($_REQUEST, $conn);
          break;
      case 'getSoftwareList' :
          getSoftwareList($_REQUEST, $conn);
          break;
      case 'getFreeSearchValues' :
          getFreeSearchValues($_REQUEST, $conn);
          break;
	  case 'logentryshare' :
		  logentryshare($_REQUEST, $conn);
		  break;

		  */		  
	  case 'matchCaptcha' :
			matchCaptcha($_REQUEST, $conn);
			break;
	  case 'getToolId' :
		  getToolId($_REQUEST,$conn);
		  break;
	  case 'logentry' :
		  logentry($_REQUEST, $conn);
		  break;
	  case 'check_ext_user_emailstatus':
		  check_ext_user_emailstatus($_REQUEST, $conn);
		  break;
	  case 'saveChangeValidity':
		  saveChangeValidity($_REQUEST, $conn);
		  break;
	  case 'deactivateExtUser':
		  deactivateExtUser($_REQUEST, $conn);
		  break;
	  case 'setextuservalidity':
		  setextuservalidity($conn);
		  break;
	  case 'checkextuservalidity':
		  checkextuservalidity($_REQUEST, $conn);
		  break;
	  case 'getextuserhistory':
		  getextuserhistory($_REQUEST, $conn);
		  break;
	  case 'update_stack_2020':
		  update_stack_2020($_REQUEST, $conn);
		  break;
	  case 'delete_stack_2020':
		  delete_stack_2020($_REQUEST, $conn);
		  break;
      case 'stack_2020_sugg_report':
		  stack_2020_sugg_report($_REQUEST, $conn);
		  break;
	  case 'updateLastLogin':
		  updateLastLogin($_REQUEST, $conn);
		  break;
	  case 'savechoice':
		  savechoice($_REQUEST, $conn);
		  break;
	  case 'getosoptions':
		  getosoptions($_REQUEST, $conn);
		  break;
	  case 'checkServiceUser':
		  checkServiceUser($_REQUEST, $conn);
		  break;
	  case 'saveServiceTicketUser':
		  saveServiceTicketUser($_REQUEST, $conn);
		  break;
	  case 'saveServiceTicketUserProfile':
		  saveServiceTicketUserProfile($_REQUEST, $conn);
		  break;
	  case 'getTicketData':
		  getTicketData($_REQUEST, $conn);
		  break;
	  case 'solutionProvided':
		  solutionProvided($_REQUEST, $conn);
		  break;
	  case 'repoUpdLocWise':
		$locwise = repoUpdLocWise($_REQUEST, $conn);
		echo json_encode($locwise);
		  break;
	  case 'getSearchResults':
		$getSearchResults = getSearchResults($_REQUEST, $conn);
		echo json_encode($getSearchResults);
			break;
	  case 'logentry_txtfile':
		$logentry_txtfile = logentry_txtfile($_REQUEST, $conn);
		echo json_encode($logentry_txtfile);
			break;
	  case 'getToolAdvisoryPriority':
		$advisory = getToolAdvisoryPriority($_REQUEST, $conn);
		echo $advisory;
			break;
	  case 'getToolAdvisorySupp':
		$advisory = getToolAdvisorySupp($_REQUEST, $conn);
		echo $advisory;
			break;
			
		
      default:
          getInfo($_REQUEST, $conn);
  }

  function getInfo($param1) {
	return;
  }

  function matchCaptcha($param1) {
    session_start();

    $sess_captcha = $_SESSION["code"];
    $captcha_entered = $param1['captcha'];
file_put_contents("../vareportupload.txt", "Inp captcha :  ".$captcha_entered."  ***  Gen captcha:". $sess_captcha.PHP_EOL);
    if($sess_captcha == $captcha_entered) {
      echo '1';
    } else {
      echo '0';
    }

  }
/*
  function getOSStack($param1, $conn) {

    $opt_sys_list_query = pg_query($conn, "select id, opt_sys, version from software_stack where status='1' and opt_sys = " . $param1[''] . " and version = " . $param1['version']);
    $os_list = pg_fetch_all($opt_sys_list_query);

    echo json_encode($os_list);
  }

  function getOSCombo($param1, $conn) {
    $os = $param1['os'];
    $version = str_replace(' ', '', $param1['version']);
    
    $opt_sys_combo_query = pg_query($conn, "select id, soft_stack from software_stack where status='1' and soft_stack !='' and opt_sys = '" . $os . "' and version = '" . $version . "'");
    $os_combo_list = pg_fetch_all($opt_sys_combo_query);

    echo json_encode($os_combo_list);
  }

  function getRemarks($param1, $conn) {

    $opt_sys_remark_query = pg_query($conn, "select opt_sys, version, details, recom, remarks from software_stack where id='" . $param1['id'] . "'" );
    $os_remarks = pg_fetch_all($opt_sys_remark_query);

    echo json_encode($os_remarks);
  }

  function getfileURL($param1, $conn) {

    $os_combo_val = $param1['os_combo'];
    $os_db = $param1['os_db'];

    $result = array();

    $os_iso_query = pg_query($conn, "select os_temp, cloud_temp from software_stack where id='" . $os_combo_val . "'" );
    $os_iso = pg_fetch_all($os_iso_query);
    
    $os_db_query = pg_query($conn, "select db_cloud_temp, iso_cloud_template from software_stack where id='" . $os_db . "'" );
    $os_db = pg_fetch_all($os_db_query);

    $result = array_merge($os_iso, $os_db);

    $result_arr = call_user_func_array('array_merge', $result);

    $new_result_array = array();
    $i = 0;

    foreach ($result_arr as $key => $value) {

      $url     = 'http://10.163.14.91/nic/' . $value;
      $headers = get_headers($url, true);
      $size = $headers['Content-Length'];
      $file_size = getFileSize($size);

      $new_result_array[$i]['name'] = explode("/", $value)[1];
      $new_result_array[$i]['url'] = $url;
      $new_result_array[$i]['size'] = $file_size;
      $i++;
    }
    
    echo json_encode($new_result_array);
  }
  
  function getFileSize($size) {
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return $file_size = number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
  }


  function getTechStack($param1, $conn) {

    $tech_stack_query = pg_query($conn, "select * from technology_stack_mst where status='active' order by id ASC");
    $tech_stack = pg_fetch_all($tech_stack_query);

    echo json_encode($tech_stack);
  }

  function getSolutionStack($param1, $conn) {

    $sol_stack_query = pg_query($conn, "select * from solution_for_mst where status='active' order by id ASC");
    $sol_stack = pg_fetch_all($sol_stack_query);

    echo json_encode($sol_stack);
  }

  function getFunctionalArea($param1, $conn) {
    $sol_for = $param1['sol_for'];

    $fun_area_query = pg_query($conn, "select * from functional_area_mst where status='active' and solution_for_type in ( " . $sol_for . ") order by id ASC");
    $fun_area = pg_fetch_all($fun_area_query);

    echo json_encode($fun_area); 
  }

  function getOSSList($param1, $conn) {

    $sol_for = "'" . str_replace(",", "','", $param1['sol_for']) . "'";
    $technologies = "'" . str_replace(",", "','", $param1['tech']) . "'";
    $functional_area = "'" . str_replace(",", "','", $param1['func_area']) . "'";

    $sol_for = $param1['sol_for'];
    $technologies = $param1['tech'];
    $functional_area = $param1['func_area'];

    $where_condition_1 = '';

    $sol_for_arr = array_filter(explode(',', $sol_for));
    $technologies_arr = array_filter(explode(',', $technologies));
    $functional_area_arr = array_filter(explode(',', $functional_area));

    foreach ($technologies_arr as $key => $value) {
      if($where_condition_1 == '' || $where_condition_1 == NULL) {
        $where_condition_1 .= " stack_json->>'" . $value . "' = '1'";
      } else {
        $where_condition_1 .= " or stack_json->>'" . $value . "' = '1'";
      }
    }

    $where_condition_conjection_1 = '';
    $where_condition_2 = '';

    if($where_condition_1 == '' || $where_condition_1 == NULL) {
      $where_condition_conjection_1 = '';

    } else {
      $where_condition_1 = "(" . $where_condition_1 . ")";
      
      if($sol_for_arr != '' && $sol_for_arr != NULL) {
        
        $where_condition_conjection_1 = ' and ';

        foreach ($sol_for_arr as $key => $value) {
          if($where_condition_2 == '' || $where_condition_2 == NULL) {
            $where_condition_2 .= " stack_json->>'" . $value . "' = '1'";
          } else {
            $where_condition_2 .= " or stack_json->>'" . $value . "' = '1'";
          }
        }

      }

    }

    $where_condition_conjection_2 = '';
    $where_condition_3 = '';

    if($where_condition_2 == '' || $where_condition_2 == NULL) {
      $where_condition_conjection_2 = '';

    } else {
      $where_condition_2 = "(" . $where_condition_2 . ")";

      if($functional_area_arr != '' && $functional_area_arr != NULL) {
        
        $where_condition_conjection_2 = ' and ';

        foreach ($functional_area_arr as $key => $value) {
          if($where_condition_3 == '' || $where_condition_3 == NULL) {
            $where_condition_3 .= " stack_json->>'" . $value . "' = '1'";
          } else {
            $where_condition_3 .= " or stack_json->>'" . $value . "' = '1'";
          }
        }
      }
    }

    if($where_condition_2 != '' && $where_condition_2 != NULL && $where_condition_3 != '' && $where_condition_3 != NULL) {
      $where_condition_3 = "(" . $where_condition_3 . ")";
    }

    $final_query_condition = $where_condition_1 . $where_condition_conjection_1 . $where_condition_2 . $where_condition_conjection_2 . $where_condition_3;


    $oss_stack_query = pg_query($conn, "select * from oss_stack_mst_json_new where " . $final_query_condition);
    $oss_stack = pg_fetch_all($oss_stack_query);

    echo json_encode($oss_stack);
  }

  function getSoftwareList($param1, $conn) {

    $oss_software_list_query = pg_query($conn, "select name from oss_stack_mst_json_new");
    $oss_software_list = pg_fetch_all($oss_software_list_query);

    $oss_software_array = [];
    foreach ($oss_software_list as $key => $value) {
      array_push($oss_software_array, $value['name']);
    }

    $oss_software_list_string = implode(',', $oss_software_array);

    echo $oss_software_list_string;

  }

  function getFreeSearchValues($param1, $conn) {

    $search_key =  strtolower($param1['search_key']);

    $oss_software_list_query = pg_query($conn, "select * from oss_stack_mst_json_new where LOWER(name) like '%$search_key%'");
    $oss_software_list = pg_fetch_all($oss_software_list_query);

    echo json_encode($oss_software_list);

  }
 */ 
  function getToolId($param1,$conn)
  {
	  $tname = $param1['toolname'];
	  $gettid = "select tool_id from oss_stack.mas_stack_tools where lower(tool_name)= lower($1)";
	  $sqlname="getToolId";
	  if (!pg_prepare($conn, $sqlname, $gettid)) {
		  die("Can't prepare '$gettid': " . pg_last_error());
	  }
	  $gettidres = pg_execute($conn, $sqlname, array($tname));         

//	  $gettidres = pg_query($conn,$gettid);
	  $tidres =  pg_fetch_row($gettidres);
	  $count = pg_num_rows($gettidres);
	  
	  //$fb_trnid =  pg_fetch_result($gettidres, 0, 0);
	  if($gettidres)
	  {
		$tidval = $tidres[0];
		echo $tidval;
	  }
	  else
	  {
		  echo "Tool Id Fetch error";
	  }
  }
  
  function logentry($param1,$conn)
  {

	global $ossdomain;
	$inpVal_flg =  1;
	$userid =  (int)htmlspecialchars($param1['userid']);
	  //$userid= $_POST['userid'];
	  //$roleid= $_POST['roleid'];
	  $serviceid= (int)$param1['serviceid'];
	  if(  !filter_var( $userid, FILTER_VALIDATE_INT) ||  !filter_var($serviceid, FILTER_VALIDATE_INT) )
	  {
			$inpVal_flg = 0;
	  }
	  
	  if($serviceid == 4)
	  {
	  $refurl= $ossdomain.$param1['refurl'];
	  }
	  else
	  {
		  $refurl= $param1['refurl'];
	  }
	  $srcref= $param1['srcref'];//W(web) or C(chatbot)
	  if(isset($param1['refid'])){$refid = $param1['refid'];}else {$refid="-";}
	  $tid = (isset($param1['toolid'])) ? $param1['toolid'] : NULL;
	  
//  		$updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
//		  $qry = "set local.appuid =" . $userid;
		  $qry = "SELECT set_config('local.appuid', $1, FALSE);" ;;
		  $sqlname = "appuid";
		  if (!pg_prepare($conn, $sqlname, $qry)) {
		  die("Can't prepare '$qry': " . pg_last_error());}
		  $updateappuid = pg_execute($conn, $sqlname, array($userid));
	

  // 		$logqry = "insert into oss_portal.trn_log (user_id,service_id,refe,log_date_time,source_ref,ref_id) values('$userid','$serviceid','$refurl',now(),'$srcref','$refid')"; 
	  $logqry = "insert into oss_portal.trn_log (user_id,service_id,tool_id,refe,log_date_time,source_ref,ref_id) values($1,$2,$3,$4,now(),$5,$6)"; 
	  $sqlname = "logentry";
	  if (!pg_prepare($conn, $sqlname, $logqry)) {
		  die("Can't prepare '$logqry': " . pg_last_error());
	  }
	  //file_put_contents("../vareportupload.txt", "Inp val true :  ".$inpVal_flg."  ***  ". $userid."  **  ".$serviceid."  **  ".$tid."  **  ".$refurl."  **  ".$srcref."  **  ".$refid.PHP_EOL);
	  if($inpVal_flg){
		
		  $loginsert = pg_execute($conn, $sqlname, array($userid,$serviceid,$tid,$refurl,$srcref,$refid));
	  }
	  else{
		$loginsert = 0;
		  echo "Log Entry Error"; die;
	  }
//		$loginsert = pg_query($conn,$logqry);
		//echo $logqry;
		if($loginsert)
		{
			echo "true";
		}
		else
		{	echo "false";}
  }

  /*
  function logentryshare($param1,$conn)
  {
	  //global $dbcon;
	  $userid = $param1['userid'];
		//$userid= $_POST['userid'];
		//$roleid= $_POST['roleid'];
		$serviceid= $param1['serviceid'];
		$tid = $param1['toolid'];
		$refurl= $param1['refurl'];
		$srcref= $param1['srcref'];//W(web) or C(chatbot)
		$updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
//		$logqry = "insert into oss_portal.trn_log (user_id,service_id,tool_id,refe,log_date_time,source_ref) values('$userid','$serviceid','$tid','$refurl',now(),'$srcref')"; 
		$logqry = "insert into oss_portal.trn_log (user_id,service_id,tool_id,refe,log_date_time,source_ref) values($1,$2,$3,$4,now(),$5)"; 
		$sqlname = "logentryshare";
		if (!pg_prepare($conn, $sqlname, $logqry)) {
			die("Can't prepare '$logqry': " . pg_last_error());
		}
		$loginsert = pg_execute($conn, $sqlname, array($userid,$serviceid,$refurl,$srcref,$refid));

		$loginsert = pg_query($conn,$logqry);
		
		if($loginsert)
		{
			echo "true";
		}
		else
		{	echo "false";}
  }
  */

  function check_ext_user_emailstatus($param1,$conn)
  {
	  $eu_mailid = $param1['email'];
	  $currdate= date("Y-m-d");
	  //$chkemailqry = "select * from mas_user_regn where email_id='$eu_mailid'"; //'$currdate'<= valid_till"; //if exists, check within validity or not also
//	  $chkemailqry = "select regn_id, name, email_id, ref_nician_email_id, status, mobile_no, eu_cat_id, designation, (select valid_till from mas_user where email_id='$eu_mailid') as validity  from mas_user_regn where email_id='$eu_mailid'";
	  $chkemailqry = "select regn_id, name, email_id, ref_nician_email_id, status, mobile_no, eu_cat_id, designation, (select valid_till from mas_user where email_id=$1) as validity  from mas_user_regn where email_id=$2";
	  $sqlname = "check_ext_user_emailstatus";
	  if (!pg_prepare($conn, $sqlname, $chkemailqry)) {
		  die("Can't prepare '$chkemailqry': " . pg_last_error());
	  }
	  $chkemailqryres = pg_execute($conn, $sqlname, array($eu_mailid,$eu_mailid));
//        file_put_contents('../ostmd-upload/sql1.txt',$chkemailqry.PHP_EOL.' email='.$eu_mailid);

//	  $chkemailqryres= pg_query($conn,$chkemailqry);
	  $result =  pg_fetch_all($chkemailqryres);
	  $count = pg_num_rows($chkemailqryres);
	  //echo "   from db ".$result[0]['sso_flag']. " ------ ";
	  //$fb_trnid =  pg_fetch_result($gettidres, 0, 0);
	  if($count >0){
	  $chk_eu_mail_flag = trim(strip_tags(htmlentities($result[0]['regn_id']))).'$'.trim(strip_tags(htmlentities($result[0]['name']))).'$'.trim(strip_tags(htmlentities($result[0]['email_id']))).'$'.trim(strip_tags(htmlentities($result[0]['ref_nician_email_id']))).'$'.trim(strip_tags(htmlentities($result[0]['status']))).'$'.trim(strip_tags(htmlentities($result[0]['mobile_no']))).'$'.trim(strip_tags(htmlentities($result[0]['eu_cat_id']))).'$'.trim(strip_tags(htmlentities($result[0]['designation']))).'$'.trim(strip_tags(htmlentities($result[0]['validity'])));
	  }
	  else{
		  $chk_eu_mail_flag = 'N';
	  }
	  /*if($count >0){
		  $chk_eu_mail_flag = '1'.'$'.trim(strip_tags(htmlentities($result[0]['ref_nician_email_id'])));
		  //$_SESSION['user'] = trim(strip_tags(htmlentities($result[0]['user_id'])));
	  }
	  else{
		  $chk_eu_mail_flag = '0'.'$'.trim(strip_tags(htmlentities($result[0]['ref_nician_email_id'])));
	  }*/
	  echo $chk_eu_mail_flag;
  }

  function saveChangeValidity($param,$conn)
  {
	  pg_query("BEGIN") or die("Could not start transaction\n");
	  $userid = htmlspecialchars($param['userid']);
	  $regid = $param['regid'];
	  $name=$param['name'];
	  $newvalidity=$param['changedvalidity'];
	  $nicrefid = $param['nicrefid'];
	  $validchangeremarks = $param['validchangeremarks'];
//	  $updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
	  $qry = "SELECT set_config('local.appuid', $1, FALSE);" ;;
	  $sqlname = "appuid";
	  if (!pg_prepare($conn, $sqlname, $qry)) {
	  die("Can't prepare '$qry': " . pg_last_error());}
	  $updateappuid = pg_execute($conn, $sqlname, array($userid));
        

//	  $updmas_user_regn_qry = "update mas_user_regn set valid_till='$newvalidity',updated_by_uid='$nicrefid', updated_date=now(), status_remarks='$validchangeremarks' where regn_id='$regid' and name='$name'";
	  $updmas_user_regn_qry = "update mas_user_regn set valid_till=$1,updated_by_uid=$2, updated_date=now(), status_remarks=$3 where regn_id=$4";
	  $sqlname = "saveChangeValidity1";
	  if (!pg_prepare($conn, $sqlname, $updmas_user_regn_qry)) {
		  die("Can't prepare '$updmas_user_regn_qry': " . pg_last_error());
	  }
	  $updmas_user_regn_res = pg_execute($conn, $sqlname, array($newvalidity,$nicrefid,$validchangeremarks,$regid));
//	  $updmas_user_regn_res=pg_query($conn, $updmas_user_regn_qry);
	  
//	  $updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
//	  $qry = "set local.appuid =$userid";
//	  $sqlname = "appuid";
//	  if (!pg_prepare($conn, $sqlname, $qry)) {
//	  die("Can't prepare '$qry': " . pg_last_error());}
//	  $updateappuid = pg_execute($conn, $sqlname, array());

//	  $updmas_user_qry = "update mas_user set valid_till='$newvalidity',updated_by_uid='$nicrefid', updated_date=now() where user_id='$regid' and name='$name'";
	  $updmas_user_qry = "update mas_user set valid_till=$1,updated_by_uid=$2, updated_date=now() where user_id=$3";
	  $sqlname = "saveChangeValidity2";
	  if (!pg_prepare($conn, $sqlname, $updmas_user_qry)) {
		  die("Can't prepare '$updmas_user_qry': " . pg_last_error());
	  }
	  $updmas_user_res = pg_execute($conn, $sqlname, array($newvalidity,$nicrefid,$regid));

//	  $updmas_user_res=pg_query($conn, $updmas_user_qry);
	  
	  if($updmas_user_regn_res && $updmas_user_res)
	  {
		  pg_query("COMMIT") or die("Transaction commit failed\n");
		  echo '1';
	  }
	  else{
		  pg_query("ROLLBACK") or die("Transaction rollback failed\n");
		  echo '0';
	  }
	  pg_close($conn); 
  }
  
  function deactivateExtUser($param, $conn){
	  pg_query("BEGIN") or die("Could not start transaction\n");
	  $userid = htmlspecialchars($param['userid']);
	  $regid = $param['regid'];
	  $name=$param['name'];
	  $newvalidity=$param['changedvalidity'];
	  $nicrefid = $param['nicrefid'];
	  $deactivateremarks = $param['deactivateremarks'];
//	  $updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
//	  $qry = "set local.appuid =" . $userid;
	  $qry = "SELECT set_config('local.appuid', $1, FALSE);" ;
	  $sqlname = "appuid";
	  if (!pg_prepare($conn, $sqlname, $qry)) {
	  die("Can't prepare '$qry': " . pg_last_error());}
	  $updateappuid = pg_execute($conn, $sqlname, array($userid));

//	  $updmas_user_regn_qry = "update mas_user_regn set status='D',updated_by_uid='$nicrefid', updated_date=now(), status_remarks='$deactivateremarks' where regn_id='$regid' and name='$name' and status='A'";
	  $updmas_user_regn_qry = "update mas_user_regn set status='D',updated_by_uid=$1, updated_date=now(), status_remarks=$2 where regn_id=$3 and status='A'";
	  $sqlname = "deactivateExtUser1";
	  if (!pg_prepare($conn, $sqlname, $updmas_user_regn_qry)) {
		  die("Can't prepare '$updmas_user_regn_qry': " . pg_last_error());
	  }
	  $updmas_user_regn_res = pg_execute($conn, $sqlname, array($nicrefid,$deactivateremarks,$regid));

//	  $updmas_user_regn_res=pg_query($conn, $updmas_user_regn_qry);
	  
//	  $updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
//	  $qry = "set local.appuid =$userid";
//	  $sqlname = "appuid";
//	  if (!pg_prepare($conn, $sqlname, $qry)) {
//	  die("Can't prepare '$qry': " . pg_last_error());}
//	  $updateappuid = pg_execute($conn, $sqlname, array());
	
//	  $updmas_user_qry = "update mas_user set active_status='D',updated_by_uid='$nicrefid', updated_date=now() where user_id='$regid' and name='$name' and active_status='A'";
	  $updmas_user_qry = "update mas_user set active_status='D',updated_by_uid=$1, updated_date=now() where user_id=$2 and active_status='A'";
	  $sqlname = "deactivateExtUser2";
	  if (!pg_prepare($conn, $sqlname, $updmas_user_qry)) {
		  die("Can't prepare '$updmas_user_qry': " . pg_last_error());
	  }
	  $updmas_user_res = pg_execute($conn, $sqlname, array($nicrefid,$regid));

//	  $updmas_user_res=pg_query($conn, $updmas_user_qry);
	  
	  if($updmas_user_regn_res && $updmas_user_res)
	  {
		  pg_query("COMMIT") or die("Transaction commit failed\n");
		  echo '1';
	  }
	  else{
		  pg_query("ROLLBACK") or die("Transaction rollback failed\n");
		  echo '0';
	  }
	  pg_close($conn); 
  }
  
  //--- setextuservalidity not used. can be deleted
  function setextuservalidity($dbcon)
{
	pg_query("BEGIN") or die("Could not start transaction\n");
//	  $updateappuid = pg_query($dbcon,"set local.appuid = ' " . $_SESSION['user'] . " ' ");
//	  $qry = "set local.appuid =". htmlspecialchars($_SESSION['user']);
	  $qry = "SELECT set_config('local.appuid', $1, FALSE);" ;
	  $sqlname = "appuid";
	  if (!pg_prepare($dbcon, $sqlname, $qry)) {
	  die("Can't prepare '$qry': " . pg_last_error());}
	  $updateappuid = pg_execute($dbcon, $sqlname, array(htmlspecialchars($_SESSION['user'])));
	
//	  $updmas_user_regn_qry = "update mas_user_regn set status='D', updated_date=now(), status_remarks='Validity Expired' where regn_id >= 100000 and status='A' and valid_till < current_date";
	  $updmas_user_regn_qry = "update mas_user_regn set status='D', updated_date=now(), status_remarks='Validity Expired' where regn_id >= 100000 and status='A' and valid_till < current_date";
	  $sqlname = "setextuservalidity1";
	  if (!pg_prepare($dbcon, $sqlname, $updmas_user_regn_qry)) {
		  die("Can't prepare '$updmas_user_regn_qry': " . pg_last_error());
	  }
	  $updmas_user_regn_res = pg_execute($dbcon, $sqlname, array());
//	  $updmas_user_regn_res=pg_query($dbcon, $updmas_user_regn_qry);
	  
//	  $updateappuid = pg_query($dbcon,"set local.appuid = ' " . $_SESSION['user'] . " ' ");
//	  $qry = "set local.appuid =". $_SESSION['user'];
//	  $sqlname = "appuid";
//	  if (!pg_prepare($dbcon, $sqlname, $qry)) {
//	  die("Can't prepare '$qry': " . pg_last_error());}
//	  $updateappuid = pg_execute($dbcon, $sqlname, array());
	
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
		  echo '1';
	  }
	  else{
		  pg_query("ROLLBACK") or die("Transaction rollback failed\n");
		  echo '0';
	  }
	  pg_close($dbcon); 
}
function checkextuservalidity($param, $conn)
{
	$email= $param['username'];
//	$res=pg_query($conn, "SELECT user_id, name, email_id, password, mobile_no FROM mas_user WHERE email_id='$email' and user_id >= 100000 and active_status='D'");
	$res="SELECT user_id, name, email_id, password, mobile_no FROM mas_user WHERE email_id=$1 and user_id >= 100000 and active_status='D'";
//        file_put_contents('/tmp/sql.txt',$res.PHP_EOL);

	$sqlname = "checkextuservalidity";
	if (!pg_prepare($conn, $sqlname, $res)) {
		die("Can't prepare '$res': " . pg_last_error());
	}
	$res = pg_execute($conn, $sqlname, array($email));

//   $result =  pg_fetch_all($res);
   $count = pg_num_rows($res);
//file_put_contents('/tmp/res.txt',$count.PHP_EOL);

   if( $count>0 ) {
	   //$userid = trim(strip_tags(htmlentities($result[0]['user_id'])));
	   echo '0';
   }
   else
   {
	   echo '1';
   }
}

function getextuserhistory($param, $conn)
{
	$email= $param['usermail'];
	$tablebody="";
//	$result=pg_query($conn,"select * from trn_user_authorize where email_id='$email' order by created_date asc");
	$res="select * from trn_user_authorize where email_id=$1 order by created_date asc";
	$sqlname = "getextuserhistory";
	if (!pg_prepare($conn, $sqlname, $res)) {
		die("Can't prepare '$res': " . pg_last_error());
	}
	$result = pg_execute($conn, $sqlname, array($email));

//	$tablehead = "<div class='stacktable'><table class='table table-bordered table-condensed'><tbody><tr><th class='p-1 fit'>Authorised By</th><th class='p-1 fit'>Validity</th></tr>";
	$tablehead = "<div class='stacktable'><table class='table table-bordered table-condensed'><tbody><tr><th class='p-1 fit'>Done By</th><th class='p-1 fit'>Status</th><th class='p-1 fit'>Done on</th><th class='p-1 fit'>Validity</th></tr>";
	$count = pg_num_rows($result);
//	file_put_contents('/tmp/res.txt',$count.PHP_EOL);

	if( $count > 0 ) {
	while($row = pg_fetch_assoc($result)){
		$vtd=$row["status"]=='A'?ymd_to_dmy($row["valid_till"]):'';
//		$tablebody = $tablebody."<tr><td style='font-weight:bold;' class='p-1 fit'>".$row["ref_nician_email_id"]."</td><td class='p-1 fit'>".ymd_to_dmy($row["valid_till"])."</td></tr>"; 
		$tablebody = $tablebody."<tr><td style='font-weight:bold;' class='p-1 fit'>".$row["ref_nician_email_id"]."</td><td class='p-1 fit'>".$row["status"]."</td><td class='p-1 fit'>".ymd_to_dmy($row["status_date"])."</td><td class='p-1 fit'>".$vtd."</td></tr>"; 
	}
	}
	else{
		$tablebody = "<tr><td> No records </td></tr>";
	}
	echo $tablehead.$tablebody."</tbody></table></div><br/>";
   
}
function ymd_to_dmy($infoAsOn)
{
	if(!empty($infoAsOn))
	{
		$date = explode(" ",$infoAsOn);
		$dmyparsed = explode("-", $date[0]); //"regex [/.-]" for slash or dot or hyphen delimiters in date
		return $dmyparsed[2].'-'.$dmyparsed[1].'-'.$dmyparsed[0];
	}
	else{
		return "";
	}
	

}
function update_stack_2020($param1,$conn)
{
  $sno = $param1['tsno'];
  $tname = $param1['tname'];
  $tvers = $param1['tvers'];
  $ttype = $param1['ttype'];
  $tdept = $param1['tdept'];
  $tproj = $param1['tproj'];
// $updateappuid = pg_query($conn,"set local.appuid = ' " . $_SESSION['user'] . " ' ");
 //$qry = "set local.appuid =". htmlspecialchars($_SESSION['user']);
 $qry = "SELECT set_config('local.appuid', $1, FALSE);" ;
 $sqlname = "appuid";
 if (!pg_prepare($conn, $sqlname, $qry)) {
 die("Can't prepare '$qry': " . pg_last_error());}
 $updateappuid = pg_execute($conn, $sqlname, array(htmlspecialchars($_SESSION['user'])));

// $updqry = "UPDATE oss_stack.stack_2020_sugg SET tool_name='$tname', version='$tvers', tooltype='$ttype', department='$tdept', project='$tproj', updated_date=now() WHERE s_id='$sno'"; 
	$updqry = "UPDATE oss_stack.stack_2020_sugg SET tool_name=$1, version=$2, tooltype=$3, department=$4, project=$5, updated_date=now() WHERE s_id=$6"; 
	$sqlname = "update_stack_2020-1";
	if (!pg_prepare($conn, $sqlname, $updqry)) {
		die("Can't prepare '$updqry': " . pg_last_error());
	}
	$toolupdres = pg_execute($conn, $sqlname, array($tname,$tvers,$ttype,$tdept,$tproj,$sno));
//	$toolupdres = pg_query($conn,$updqry);
	
	if($toolupdres)
	{
		echo "true";
	}
	else
	{	echo "false";}
}
function delete_stack_2020($param1, $conn)
{
  $sno = $param1['tsno'];
//  $updateappuid = pg_query($conn,"set local.appuid = ' " . $_SESSION['user'] . " ' ");
//  $qry = "set local.appuid =".htmlspecialchars($_SESSION['user']);
  $qry ="SELECT set_config('local.appuid', $1, FALSE);" ;
  $sqlname = "appuid";
  if (!pg_prepare($conn, $sqlname, $qry)) {
  die("Can't prepare '$qry': " . pg_last_error());}
  $updateappuid = pg_execute($conn, $sqlname, array(htmlspecialchars($_SESSION['user'])));

//  $delqry = "delete from oss_stack.stack_2020_sugg WHERE s_id='$sno'"; 
	$delqry = "delete from oss_stack.stack_2020_sugg WHERE s_id=$1"; 
	$sqlname = "update_stack_2020-2";
	if (!pg_prepare($conn, $sqlname, $delqry)) {
		die("Can't prepare '$delqry': " . pg_last_error());
	}
	$tooldelres = pg_execute($conn, $sqlname, array($sno));
//	$tooldelres = pg_query($conn,$delqry);
	
	if($tooldelres)
	{
		echo "true";
	}
	else
	{	echo "false";}
}
function stack_2020_sugg_report($param1,$conn)
{
  $ttype = $param1['ttype'];
  $ttype = $param1['ttype'];
  
$tablebody=$tablehead="";
if($ttype == 'N')
{
	$tablehead = "<button id='pdf' class='btn btn-danger' onclick='$(this).exporttopdf();'>TO PDF</button><div class='stacktable'><table id='OSS_Stack_2020_report' class='table table-bordered'><tbody><tr class='text-center'><th colspan='7'>OSS New Tools Suggestions</th></tr>";
$qry = "SELECT * FROM oss_stack.stack_2020_sugg where ossnewtool_datacentrepriority_flg='N'";
}
elseif($ttype == 'D'){
	$tablehead = "<button id='pdf' class='btn btn-danger' onclick='$(this).exporttopdf();'>TO PDF</button><div class='stacktable'><table id='OSS_Stack_2020_report' class='table table-bordered'><tbody><tr class='text-center'><th colspan='7'>Data Centre Tools Suggestions</th></tr>";
$qry = "SELECT * FROM oss_stack.stack_2020_sugg where ossnewtool_datacentrepriority_flg='D'";
}
else{
	$tablehead = "<button id='pdf' class='btn btn-danger' onclick='$(this).exporttopdf();'>TO PDF</button><div class='stacktable'><table id='OSS_Stack_2020_report' class='table table-bordered'><tbody><tr class='text-center'><th colspan='7'>Stack 2020 Suggested Tools</th></tr>";
$qry = "SELECT * FROM oss_stack.stack_2020_sugg";
}
$sqlname = "stack_2020_sugg_report";
if (!pg_prepare($conn, $sqlname, $qry)) {
	die("Can't prepare '$qry': " . pg_last_error());
}
$result = pg_execute($conn, $sqlname, array());

//$result=pg_query($conn,$qry);
$count = pg_num_rows($result);
if($count > 0)
{
$tablehead = $tablehead."<tr>
		<th>Emp Code</th>
		<th>Name</th>
		<th>Tool</th>
		<th>Version</th>
		<th>Department</th>
		<th>Project</th>
		<th>Date</th>
	</tr>";
while($row = pg_fetch_assoc($result)){
$tablebody = $tablebody."<tr><td class='p-1 fit'>".$row["emp_code"]."</td><td class='fit'>".$row["emp_name"]."</td><td class='fit'>".$row["tool_name"]."</td><td class='fit'>".$row["version"]."</td><td class='fit'>".$row["department"]."</td><td class='fit'>".$row["project"]."</td><td class='fit'>".date("d-m-Y", strtotime($row["updated_date"]))."</td></tr>"; 
}
echo $tablehead.$tablebody."</tbody></table></div><br/>";
}
else{
	$tablehead = "<div class='stacktable'><table id='OSS_Stack_2020_report' class='table table-bordered'><tbody><tr>
		<th>Emp Code</th>
		<th>Name</th>
		<th>Date</th>
		<th>Tool</th>
		<th>Version</th>
		<th>Department</th>
		<th>Project</th>
	</tr><tr><td colspan='7'>No records</td></tr></tbody></table></div><br/>";
	echo $tablehead;
}
}
function updateLastLogin($param1,$conn)
{
	$userid = htmlspecialchars($param1['userid']);
//	$updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
//	$qry = "set local.appuid = " . $userid;
	$qry = "SELECT set_config('local.appuid', $1, FALSE);" ;
	$sqlname = "appuid";
	if (!pg_prepare($conn, $sqlname, $qry)) {
	die("Can't prepare '$qry': " . pg_last_error());}
	$updateappuid = pg_execute($conn, $sqlname, array($userid));

//	$update_mas_user_res = pg_query($conn, "update public.mas_user set last_login=now() where user_id='$userid'");
	$qry = "update public.mas_user set last_login=now() where user_id=$1";
	$sqlname = "updateLastLogin";
	if (!pg_prepare($conn, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$update_mas_user_res = pg_execute($conn, $sqlname, array($userid));
	
	if($update_mas_user_res)
	{echo '1';}
	else
	{echo '0';}
}
function savechoice($param,$conn)
{
	$choices	=	$param['oschoice'];
	$userid 	=	htmlspecialchars($param['userid']);
	$email		=	$param['emailid'];
	$linuxuser	=	$param['linuxuser'];
	$whichlinux	=	$param['whichlinux'];
//	$updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
//	$qry = "set local.appuid = " . $userid;
	$qry = "SELECT set_config('local.appuid', $1, FALSE);" ;
	$sqlname = "appuid";
	if (!pg_prepare($conn, $sqlname, $qry)) {
	die("Can't prepare '$qry': " . pg_last_error());}
	$updateappuid = pg_execute($conn, $sqlname, array($userid));

//	$savechoice = "INSERT INTO oss_portal.trn_os_opinion(user_id, email_id, option_ids, created_by_uid, created_date, linux_user, which_linux_id) VALUES ('$userid', '$email', '$choices', '$userid', now(), '$linuxuser', $whichlinux) on conflict (user_id) do UPDATE SET option_ids='$choices', updated_by_uid='$userid', updated_date=now(), linux_user='$linuxuser', which_linux_id='$whichlinux'";
	$qry = "INSERT INTO oss_portal.trn_os_opinion(user_id, email_id, option_ids, created_by_uid, created_date, linux_user, which_linux_id) VALUES ($1, $2, $3, $4, now(), $5, $6) on conflict (user_id) do UPDATE SET option_ids=$3, updated_by_uid=$4, updated_date=now(), linux_user=$5, which_linux_id=$6";
	$sqlname = "savechoice";
	if (!pg_prepare($conn, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$savechoiceres = pg_execute($conn, $sqlname, array($userid, $email, $choices, $userid, $linuxuser, $whichlinux));
	//echo $savechoice;
	
//	$savechoiceres = pg_query($conn,$savechoice);
	if($savechoiceres){
		pg_query("COMMIT") or die("Transaction commit failed\n");	
		echo 1;
		
//////////////////////////////////////// GIMS start
		include __DIR__.'/../../GIMS/send1gims.php';
		$gimsflg=TRUE;
		// GIMS message
		if ($gimsflg) {
//			$xy = pg_query($conn, "SELECT name,email_id FROM mas_user WHERE user_id=$userid;");
//			$nicusernm = pg_fetch_result($xy, 0, 0);
//			$nicuser = pg_fetch_result($xy, 0, 1);

			$xy = "SELECT name,email_id FROM mas_user WHERE user_id=$1";

			$sqlname="subs_sandes";
			if (!pg_prepare($conn, $sqlname, $xy)) {
				die("Can't prepare '$xy': " . pg_last_error());
			}
			$xy = pg_execute($conn, $sqlname, array($userid));         
			$nicusernm = pg_fetch_result($xy, 0, 0);
			$nicuser = pg_fetch_result($xy, 0, 1);

			//	pg_close($conn);
			$qmsno = 0;
			$mesgtext = "$nicusernm ($nicuser) has submitted the CentOS alternate choice form.";
			$filename = "0";
			$filetype = "0";
			//$maillist = '"philip@nic.in","manisekaran.t@nic.in"';
			$maillist = "0";
			$listid = "nic-otg-default";
			//$listid = "0";
			$orgid = "0";
			$gimopt = "gimlist";
			//$gimopt = "gimind";
			$stat = 0;
			ob_start();
			getparam($nicuser, $qmsno, $mesgtext, $filename, $filetype, $maillist, $listid, $orgid, $gimopt, $stat);
			ob_end_clean();
			//		echo "<tr><td colspan='2' style='color:green;'>Sucessfully send SANDES message to OTG list!!!<br>$result</td></tr>";

			// GIMS message to submitted NIC users

			$qmsno = 0;
			$mesgtext = "Thanks for submitting CentOS alternate choice form. Update option also available in OSS Repository portal under 'OSS Stack' in the main menu.";
			$filename = "0";
			$filetype = "0";
			//		$maillist = $mslist;
			$listid = "0";
			$orgid = "0";
			$gimopt = "gimmul";
			$stat = 0;
			$maillist = '"' . $nicuser . '"';
			ob_start();
			getparam($nicuser, $qmsno, $mesgtext, $filename, $filetype, $maillist, $listid, $orgid, $gimopt, $stat);
			ob_end_clean();
		}
//////////////////////////////////////// GIMS end

	}
	else
	{
		pg_query("ROLLBACK") or die("Transaction rollback failed\n");
		echo 0;
	}
	pg_close($conn);
	

}
function getosoptions($param,$conn)
{
	$result= [];
	$options="";
	//$res=pg_query($conn, "SELECT * FROM oss_portal.ref_os_opinion order by os_desc ASC");
//	$res=pg_query($conn, "select * from oss_portal.ref_os_opinion where active_status='A' order by case when option_id = 99 then 1 else 0 end, os_desc");
	$qry="select * from oss_portal.ref_os_opinion where active_status='A' order by case when option_id = 99 then 1 else 0 end, os_desc";
	$sqlname = "savechoice";
	if (!pg_prepare($conn, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$res = pg_execute($conn, $sqlname, array());


	while ( $os = pg_fetch_assoc($res)) {
	    	$result[] = $os;
	    }
	if(!empty($result)){
			foreach ($result as $os) {
			$options= $options.'<option value='.$os["option_id"].'>'.$os["os_desc"].'</option>';
			}
			echo $options;
		}
		else
		{
			echo $options;
		}
	
}

function  checkServiceUser($param,$conn)
{
	$result=[];
	$elmid = $param['elmid'];
	$elmvalue = $param['elmvalue'];
	if($elmid == "mobile"){
//		$qry = "SELECT * FROM oss_portal.mas_service_consumer where mobile_no= '$elmvalue'";	
		$qry = "SELECT * FROM oss_portal.mas_service_consumer where mobile_no= $1";	
	}
	else{
//		$qry = "SELECT * FROM oss_portal.mas_service_consumer where email_id= '$elmvalue'";
		$qry = "SELECT * FROM oss_portal.mas_service_consumer where email_id= $1";
	}
	$sqlname = "checkServiceUser";
	if (!pg_prepare($conn, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$res = pg_execute($conn, $sqlname, array($elmvalue));

//	$res = pg_query($conn, $qry);
	$count = pg_num_rows($res);
	if($count == 1)
	{ $result[] = pg_fetch_assoc($res);}
	else if($count == 0)
	{
		if($elmid == "mobile"){
//			$qry = "SELECT * FROM public.mas_user where mobile_no= '$elmvalue' and active_status='A'";
			$qry = "SELECT * FROM public.mas_user where mobile_no= $1 and active_status='A'";	
		}
		else{
//			$qry = "SELECT * FROM public.mas_user where email_id= '$elmvalue' and active_status='A'";
			$qry = "SELECT * FROM public.mas_user where email_id= $1 and active_status='A'";
		}
		$sqlname = "checkServiceUser2";
		if (!pg_prepare($conn, $sqlname, $qry)) {
			die("Can't prepare '$qry': " . pg_last_error());
		}
		$res = pg_execute($conn, $sqlname, array($elmvalue));
			//		$res = pg_query($conn, $qry);
		$count = pg_num_rows($res);
		if($count == 1)
		{ $result[] = pg_fetch_assoc($res);}
		else if($count == 0)
		{	$result[] = array("user_id"=>"0","nouser"=>"0");}
	}
	echo json_encode($result);
}
function saveServiceTicketUser($param, $conn){
	$name	=	$param['name'];
	$emailid 	=	$param['emailid'];
	$mobileno		=	$param['mobileno'];
	$userid	=	$param['userid'];
	$loginuser	=	$param['loginuser'];
	$category	=	$param['category'];
	$divname	=	$param['divname'];
	$project	=	$param['project'];
	$urlip	=	$param['urlip'];
	$source	=	$param['source'];
	$availdate	=	$param['availdate'];
	$service	=	$param['service'];
	$refno	=	$param['refno'];
	$probstmt	=	$param['probstmt'];
	
//	$updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
//	$qry = "set local.appuid = " . htmlspecialchars($userid);
	$qry = "SELECT set_config('local.appuid', $1, FALSE);" ;
	$sqlname = "appuid";
	if (!pg_prepare($conn, $sqlname, $qry)) {
	die("Can't prepare '$qry': " . pg_last_error());}
	$updateappuid = pg_execute($conn, $sqlname, array(htmlspecialchars($userid)));

	//$saveserviceconsumer= "INSERT INTO oss_portal.mas_service_consumer(name, email_id, mobile_no, user_id, nician, div_name, active_status, status_date, updated_by_uid, updated_date, created_by_uid, created_date) 	VALUES ('$name', '$emailid', '$mobileno','$userid','$category', '$divname', 'A', now(),'$loginuser' , now(), '$loginuser', now());";
//	$saveserviceconsumer= "INSERT INTO oss_portal.mas_service_consumer(name, email_id, mobile_no, user_id, nician, div_name, active_status, status_date, updated_by_uid, updated_date, created_by_uid, created_date) 	VALUES ('$name', '$emailid', '$mobileno','$userid','$category', '$divname', 'A', now(),'$loginuser' , now(), '$loginuser', now()) on conflict (email_id) do UPDATE SET name='$name', mobile_no='$mobileno', user_id='$userid', nician='$category', div_name='$divname', active_status='A', status_date=now(), updated_by_uid='$loginuser', updated_date=now(), created_by_uid='$loginuser', created_date=now() returning cons_id";
	$qry= "INSERT INTO oss_portal.mas_service_consumer(name, email_id, mobile_no, user_id, nician, div_name, active_status, status_date, updated_by_uid, updated_date, created_by_uid, created_date) 	VALUES ($1, $2, $3,$4,$5, $6, 'A', now(),$7 , now(), $8, now()) on conflict (email_id) do UPDATE SET name=$1, mobile_no=$3, user_id=$4, nician=$5, div_name=$6, active_status='A', status_date=now(), updated_by_uid=$7, updated_date=now(), created_by_uid=$8, created_date=now() returning cons_id";
	$sqlname = "saveServiceTicketUser1";
	if (!pg_prepare($conn, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$saveserviceconsumerres = pg_execute($conn, $sqlname, array($name, $emailid, $mobileno,$userid,$category, $divname, $loginuser, $loginuser));
	//echo $saveserviceconsumer;
//	$saveserviceconsumerres = pg_query($conn,$saveserviceconsumer);
	//$saveserviceconsumerconsid = pg_fetch_result($saveserviceconsumerres,0,0);
	$saveserviceconsumerconsid = pg_fetch_row($saveserviceconsumerres);
	//$consid = $saveserviceconsumerrow[0];

//	$saveserviceprovided = "INSERT INTO oss_portal.trn_service_provided(cons_id, trn_date, proj_name, url_ip, source_id, service_id, ref_no, prob_statement, status, updated_by_uid, updated_date, created_by_uid, created_date)
//	VALUES ('$saveserviceconsumerconsid[0]',now(), '$project', '$urlip', '$source', '$service', '$refno', '$probstmt','0', '$loginuser', now(), $loginuser, now());";
	$qry= "INSERT INTO oss_portal.trn_service_provided(cons_id, trn_date, proj_name, url_ip, source_id, service_id, ref_no, prob_statement, status, updated_by_uid, updated_date, created_by_uid, created_date) VALUES ($1, now(), $2, $3, $4, $5, $6, $7,'0', $8, now(), $9, now());";
	$sqlname = "saveServiceTicketUser2";
	if (!pg_prepare($conn, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$saveserviceprovidedres = pg_execute($conn, $sqlname, array($saveserviceconsumerconsid[0],$project, $urlip, $source, $service, $refno, $probstmt, $loginuser, $loginuser));

//	$saveserviceprovidedres = pg_query($conn,$saveserviceprovided);
	
	if($saveserviceconsumerres && $saveserviceprovidedres){
		pg_query("COMMIT") or die("Transaction commit failed\n");	
		echo 1;
	}
	else
	{
		pg_query("ROLLBACK") or die("Transaction rollback failed\n");
		echo 0;
	}
	pg_close($conn);
}
function saveServiceTicketUserProfile($param, $conn){
	$name		=	htmlspecialchars($param['name']);
	$emailid 	=	htmlspecialchars($param['emailid']);
	$mobileno	=	htmlspecialchars($param['mobileno']);
	$userid		=	htmlspecialchars($param['userid']);
	$loginuser	=	htmlspecialchars($param['loginuser']);
	$category	=	htmlspecialchars($param['category']);
	$divname	=	htmlspecialchars($param['divname']);
	$minid		=	htmlspecialchars($param['minid']);
	//mvmvmv
		
//	$updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
//	$qry = "set local.appuid = " . $userid;
	$qry = "SELECT set_config('local.appuid', $1, FALSE);" ;
	$sqlname = "appuid";
	if (!pg_prepare($conn, $sqlname, $qry)) {
	die("Can't prepare '$qry': " . pg_last_error());}
	$updateappuid = pg_execute($conn, $sqlname, array($userid));

	//$saveserviceconsumer= "INSERT INTO oss_portal.mas_service_consumer(name, email_id, mobile_no, user_id, nician, div_name, active_status, status_date, updated_by_uid, updated_date, created_by_uid, created_date) 	VALUES ('$name', '$emailid', '$mobileno','$userid','$category', '$divname', 'A', now(),'$loginuser' , now(), '$loginuser', now());";
//	$saveserviceconsumer= "INSERT INTO oss_portal.mas_service_consumer(name, email_id, mobile_no, user_id, nician, div_name, active_status, status_date, updated_by_uid, updated_date, created_by_uid, created_date) 	VALUES ('$name', '$emailid', '$mobileno','$userid','$category', '$divname', 'A', now(),'$loginuser' , now(), '$loginuser', now()) on conflict (email_id) do UPDATE SET name='$name', mobile_no='$mobileno', user_id='$userid', nician='$category', div_name='$divname', active_status='A', status_date=now(), updated_by_uid='$loginuser', updated_date=now(), created_by_uid='$loginuser', created_date=now() returning cons_id";
	$qry= "INSERT INTO oss_portal.mas_service_consumer(name, email_id, mobile_no, user_id, nician, div_name, active_status, status_date, updated_by_uid, updated_date, created_by_uid, created_date, minid) 	VALUES ($1, $2, $3,$4,$5, $6, 'A', now(),$7 , now(), $8, now(), $9) on conflict (email_id) do UPDATE SET name=$1, mobile_no=$3, user_id=$4, nician=$5, div_name=$6, active_status='A', status_date=now(), updated_by_uid=$7, updated_date=now(), created_by_uid=$8, created_date=now(), minid = EXCLUDED.minid returning cons_id";
	$sqlname = "saveServiceTicketUserProfile1";
	if (!pg_prepare($conn, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$saveserviceconsumerres = pg_execute($conn, $sqlname, array($name, $emailid, $mobileno,$userid,$category, $divname, $loginuser, $loginuser, $minid));
	//mvmvmv

	

	//echo $saveserviceconsumer;
//	$saveserviceconsumerres = pg_query($conn,$saveserviceconsumer);
		
	if($saveserviceconsumerres ){
		pg_query("COMMIT") or die("Transaction commit failed\n");	
		echo 1;
	}
	else
	{
		pg_query("ROLLBACK") or die("Transaction rollback failed\n");
		echo 0;
	}
	pg_close($conn);


}
function getTicketData($param, $conn)
{
	$result=[];
	$ticketid = $param['ticketid'];
//	$qry = "SELECT sp.*,sc.name, sc.email_id,sc.mobile_no,sc.div_name FROM oss_portal.trn_service_provided sp inner join oss_portal.mas_service_consumer sc on sp.cons_id = sc.cons_id where id='$ticketid'";
	$qry = "SELECT sp.*,sc.name, sc.email_id,sc.mobile_no,sc.div_name FROM oss_portal.trn_service_provided sp inner join oss_portal.mas_service_consumer sc on sp.cons_id = sc.cons_id where id=$1";
	$sqlname = "getTicketData";
	if (!pg_prepare($conn, $sqlname, $qry)) {
		die("Can't prepare '$qry': " . pg_last_error());
	}
	$res = pg_execute($conn, $sqlname, array($ticketid));
	
//	$res = pg_query($conn, $qry);
	$count = pg_num_rows($res);
	if($count == 1)
	{ $result[] = pg_fetch_assoc($res);}
	else {
		$result[] = array("user_id"=>"0","nouser"=>"0");
	}
	echo json_encode($result);
}

function solutionProvided($param, $conn)
{
/*

	$loginuser	=	$param['loginuser'];
	$ticketid	=	$param['ticketid'];
	$solutionby	=	$param['solutionby'];
	$soldate	=	$param['soldate'];
	$knownrepeat	=	$param['knownrepeat'];
	$solprovided	=	$param['solprovided'];
	$prevrefticket	=	$param['prevrefticket'];
	
	
	$updateappuid = pg_query($conn,"set local.appuid = ' " . $userid . " ' ");
	//$savesolutionprovided = "******************update se INTO oss_portal.trn_service_provided(cons_id, trn_date, proj_name, url_ip, source_id, service_id, ref_no, prob_statement, status, updated_by_uid, updated_date, created_by_uid, created_date) 	VALUES ('$saveserviceconsumerconsid[0]',now(), '$project', '$urlip', '$source', '$service', '$refno', '$probstmt','0', '$loginuser', now(), $loginuser, now());";
	$savesolutionprovidedres = pg_query($conn,$savesolutionprovided);
	
	if($savesolutionprovided){
		pg_query("COMMIT") or die("Transaction commit failed\n");	
		echo 1;
	}
	else
	{
		pg_query("ROLLBACK") or die("Transaction rollback failed\n");
		echo 0;
	}
	pg_close($conn);
*/
}
function str_contains(string $sentence, string $word): bool
{
	return '' === $word || false !== strpos($sentence, $word);
}
function repoUpdLocWise($param)
{
	$loc = htmlspecialchars($param['loc']);
	$locWiseArr = array();
	$locwise_data="";
	$reposyncjson = json_decode(file_get_contents('../oss-json/reposync.json'),1);
	$locFlg = false;

	foreach($reposyncjson['latestUpdates'] as $key1 => $dist1)
	{
		//file_put_contents('vareportupload.txt',$dist['Distribution']."  **  ".PHP_EOL, FILE_APPEND);
		if(str_contains($dist1['Distribution'], $loc))
		{
			array_push($locWiseArr, $dist1);
			$locFlg = true;
		}
		else{}
	}
	if(!$locFlg){
		$locWiseArr = $reposyncjson['latestUpdates'];
	}
	/* usort($locWiseArr, function($c, $d){
		if ($c == $d) return 0;
		return ($c < $d)?-1:1;
	});	 */
	$locwisejson = json_encode($locWiseArr);
	$locwise_data = '<div class="latestUpdateScroll"><ul style="margin-top: -100px; margin-left:-50px;">';			
	usort($locWiseArr, function($a, $b){
		$c = date("Y-m-d",strtotime($a['UpdateDate']));
		$d = date("Y-m-d",strtotime($b['UpdateDate']));
		if ($c == $d) return 0;
		return ($c > $d)?-1:1;
	});	
	foreach($locWiseArr as $key => $dist)
	{					
		$locwise_data .=	'<li><div class="col-lg-12 col-md-10 col-sm-10 col-xs-10 pt-1">';
		$locwise_data .= "<span class='font-weight-bold text-indigo'><a class='distribution' data-serviceid='".$dist['ServiceId']."' href='".$dist['RepositoryURL']."' target='_blank'>".$dist['Distribution']."</a></span><br/>";
		$locwise_data .= "<span class='text-deep-purple'>Last Updated: &nbsp;".date("d-m-Y",strtotime($dist['UpdateDate']))."</span><br/>";
		if($dist['KernelVersion'] != "")
		{
			$locwise_data .= "<span class='text-deep-purple'>Kernel: &nbsp;".$dist['KernelVersion'].(($dist['KernelDate'] > 0)?"&nbsp;&nbsp;Date: &nbsp;".date("d-m-Y",strtotime($dist['KernelDate'])):"")."</span><br/>";
		}
		if(  (int)$dist['SyncedFiles'] > 0)
		{
			$locwise_data .= "<span class='text-deep-purple'>Synced Files: &nbsp;".$dist['SyncedFiles'].(($dist['SyncedFiles'] > 0)?"&nbsp;&nbsp;Synced On: &nbsp;".date("d-m-Y",strtotime($dist['SyncedDate'])):"")."</span>";
		}
		$locwise_data .= '</div><hr/></li>';
	}
	$locwise_data .= '</ul></div>';
	//file_put_contents('vareportupload.txt',$locwise_data."  **  ".PHP_EOL, FILE_APPEND);
	return array(1, $locwise_data);
}
function getSearchResults($param, $conn)
{
	$search_word = $param['sd_word'];
	$ret_res = "";
	$sdqry = "SELECT * from oss_portal.trn_support_digest where (tags ilike $1 or digest_question ilike $1 or digest_answer ilike $1) and (status = 10 or status is null) ORDER BY trn_date desc ";
	$sdqry_name = "";
	if(!pg_prepare($conn, $sdqry_name, $sdqry)){
		die("Can't prepare '$sdqry': ".pg_last_error());
	}
	$sdqry_res = pg_execute($conn, $sdqry_name, array("%".$search_word."%"));
	$count = pg_num_rows($sdqry_res);
	

	if($count >= 1)
	{ 
		while($row = pg_fetch_assoc($sdqry_res))
		{
			$ret_res .= "<li><div class='col-lg-12 col-md-10 col-sm-10 col-xs-10 pt-1'>";
			$ret_res .= "<span class='font-weight-bold text-indigo'><a class='digest' data-sd_id='".$row['id']."' href='#' data-toggle='modal' data-target='#SDmodal' data-ques='".base64_encode(trim($row['digest_question']))."' data-trndate='".date("d-m-Y",strtotime($row['trn_date']))."' data-anstext='".base64_encode(trim($row['digest_answer']))."' data-ans='".htmlspecialchars(trim(json_decode($row['docs'],true)[0]))."' data-videoavailable='".trim($row['video_available'])."' data-video='".htmlspecialchars(trim(json_decode($row['videos'],true)[0]))."' title='Click here for details'>".trim($row['digest_question'])."</a></span>&nbsp;<span class='text-deep-purple'>(".date("d-m-Y",strtotime($row['trn_date'])).")</span><br/>";
			$ret_res .= "</div><hr/></li>";
		}
		
	}
	else{
		$ret_res = "No records";
	}
	//file_put_contents('..\vareportupload.txt',$ret_res."  **  ".$count.PHP_EOL);
	if($sdqry_res){
		pg_query($conn, "COMMIT") or die("Transaction commit failed\n");
		pg_close($conn);
		return array(1,$ret_res);
	}
	else
	{
		pg_query("ROLLBACK") or die("Transaction rollback failed\n");
		pg_close($conn);
		return array(0,"Server Error");
	}
	
}
function logentry_txtfile($param, $conn)
{
	$sdid = $param['sdid'];
	file_put_contents('Digest_Log_'.date("Y").'.txt',get_client_ip().",".$sdid.",".date("d-m-Y H:i:s").PHP_EOL, FILE_APPEND);
	return array(1,"Log entry success");
}
function get_client_ip() {
    /* $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
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
        $ipaddress = 'UNKNOWN'; */
		$ipaddress = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');
    return $ipaddress;
}
function getToolAdvisoryPriority($param, $conn) 
{
	$tid = $param['tid'];
	$tname = $param['tname'];
	$lver = $param['lver'];
	$infoason = $param['infoason'];
	$accorhtml = "";
	$tdata_qry = "select ta.tool_id, jsonb_agg(ta.stack_area_name) func_domain, ta.stack_relavance, coalesce(ta.license,'[]'::jsonb) as license, coalesce(ta.minorversions,'[]'::jsonb) as suppvers from 
	(SELECT t.tool_id,t.tool_name, t.tool_type_code, t.stackareaid,t.repo_status, t.active_status, t.stack_relavance,t.license
	 ,a.stack_area_name,a.domain_code, d.domain_name, mv.minorversions
	 FROM 
	 (SELECT tool_id, tool_name, tool_type_code, stack_relavance, license, jsonb_array_elements(stack_area_ids) stackareaid,repo_status, active_status
	  FROM 
		 oss_stack.mas_stack_tools ) t 
		 INNER JOIN oss_stack.mas_stack_functional_area a ON  t.stackareaid::text::smallint  = a.stack_area_id
		INNER JOIN oss_stack.mas_stack_domain d ON a.domain_code = d.domain_code 
		 LEFT JOIN (select tool_id, jsonb_agg(minor_version) minorversions from oss_stack.mas_tools_minorver where color_code='A' group by tool_id) mv on mv.tool_id=t.tool_id
		 WHERE t.tool_type_code='P' AND t.active_status='A' and t.tool_id=$1)ta
		group by ta.tool_id, ta.stack_relavance, ta.license, ta.minorversions";
	$tdata_qryname="getToolAdvisory";
	if(!pg_prepare($conn, $tdata_qryname, $tdata_qry))
	{
		die("Can't prepare '$tdata_qry' : ". pg_last_error());
	}
	$tdata_res = pg_execute($conn, $tdata_qryname, array((int)$tid));
	$count = pg_num_rows($tdata_res);
	
	$row = pg_fetch_assoc($tdata_res);

	$accorhtml = $accorhtml . "<div class=''><div class='acctool' style='font-size:14px; color:white;background-color:#82298c;'>". $tname . "&nbsp;(<strong class='accvers' style='color:white;'>".$lver."</strong>)<span class='lastupd' style='float:right;height:auto;color:white;'> Last update on: ".ymd_to_dmy($infoason)."</span></div><div class='card-body' style='overflow-wrap: break-word;background-color:#f2e6ff;'>";

	$accorhtml = $accorhtml . "<div style='font-size:15px;'><table class='table table-bordered table-hover table-condensed'><tbody><tr><th style='background-color:#f2e6ff;'>Functional Domain </th><td> " .implode(",",json_decode($row['func_domain'],true))."</td></tr>";
	$accorhtml = $accorhtml . "<tr><th style='background-color:#f2e6ff;'>Stack Relevance </th><td> ".implode(",",json_decode($row['stack_relavance'],true))."</td></tr>";
	$accorhtml = $accorhtml . "<tr><th style='background-color:#f2e6ff;'>License </th><td> ".implode(",",json_decode($row['license'],true))."</td></tr>";
	$accorhtml = $accorhtml  . "<tr style='color:#2d8655;'><th style='background-color:#f2e6ff;'> Latest Version</th><td>    <strong>" .$lver. "&nbsp;&nbsp;&nbsp;</strong></td></tr>";
	$accorhtml = $accorhtml . "<tr style='color:#375e97;'><th style='background-color:#f2e6ff;'>Still Supported Version(s) </th><td style='word-break: break-all;'> <strong> (" .((count(json_decode($row['suppvers'],true)) > 0)?count(json_decode($row['suppvers'],true)):0).")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong class='comment more'>".implode(",",json_decode($row['suppvers'],true))."</strong></td></tr>";
	$accorhtml = $accorhtml . "</tbody></table></div><br/>".getcolornote()."<br/></div></div>";
				

echo $accorhtml;

}
function getToolAdvisorySupp($param, $conn) 
{
	$tid = $param['tid'];
	$tname = $param['tname'];
	$lver = $param['lver'];
	$infoason = $param['infoason'];
	$accorhtml = "";
	$tdata_qry="select ta.tool_id, jsonb_agg(ta.stack_area_name) func_domain, ta.stack_relavance, coalesce(ta.license,'[]'::jsonb) as license, coalesce(ta.minorversions,'[]'::jsonb) as suppvers from 
	(SELECT t.tool_id,t.tool_name, t.tool_type_code, t.stackareaid,t.repo_status, t.active_status, t.stack_relavance,t.license
	 ,a.stack_area_name,a.domain_code, d.domain_name, mv.minorversions
	 FROM 
	 (SELECT tool_id, tool_name, tool_type_code, stack_relavance, license, jsonb_array_elements(stack_area_ids) stackareaid,repo_status, active_status
	  FROM 
		 oss_stack.mas_stack_tools ) t 
		 INNER JOIN oss_stack.mas_stack_functional_area a ON  t.stackareaid::text::smallint  = a.stack_area_id
		INNER JOIN oss_stack.mas_stack_domain d ON a.domain_code = d.domain_code 
		 LEFT JOIN (select tool_id, jsonb_agg(minor_version) minorversions from oss_stack.mas_tools_minorver where color_code='A' group by tool_id) mv on mv.tool_id=t.tool_id
		 WHERE t.tool_type_code='A' AND t.active_status='A' and t.tool_id=$1)ta
		--INNER JOIN oss_stack.mas_tools_minorver mv ON mv.tool_id = ta.tool_id and mv.color_code='A' 
		group by ta.tool_id, ta.stack_relavance, ta.license, ta.minorversions";
	/* $tdata_qry = "select ta.tool_id, jsonb_agg(ta.stack_area_name) func_domain, ta.stack_relavance, ta.license, ta.minorversions suppvers from 
	(SELECT t.tool_id,t.tool_name, t.tool_type_code, t.stackareaid,t.repo_status, t.active_status, t.stack_relavance,t.license
	 ,a.stack_area_name,a.domain_code, d.domain_name, mv.minorversions
	 FROM 
	 (SELECT tool_id, tool_name, tool_type_code, stack_relavance, license, jsonb_array_elements(stack_area_ids) stackareaid,repo_status, active_status
	  FROM 
		 oss_stack.mas_stack_tools ) t 
		 INNER JOIN oss_stack.mas_stack_functional_area a ON  t.stackareaid::smallint  = a.stack_area_id
		INNER JOIN oss_stack.mas_stack_domain d ON a.domain_code = d.domain_code 
		 INNER JOIN (select tool_id, jsonb_agg(minor_version) minorversions from oss_stack.mas_tools_minorver where color_code='A' group by tool_id) mv on mv.tool_id=t.tool_id
		 WHERE t.tool_type_code='A' AND t.active_status='A' and t.tool_id=$1)ta
		group by ta.tool_id, ta.stack_relavance, ta.license, ta.minorversions"; */
	$tdata_qryname="getToolAdvisory";
	if(!pg_prepare($conn, $tdata_qryname, $tdata_qry))
	{
		die("Can't prepare '$tdata_qry' : ". pg_last_error());
	}
	$tdata_res = pg_execute($conn, $tdata_qryname, array((int)$tid));
	$count = pg_num_rows($tdata_res);
	
	$row = pg_fetch_assoc($tdata_res);

	$accorhtml = $accorhtml . "<div class=''><div class='acctool' style='font-size:14px; color:white;background-color:#82298c;'>". $tname . "&nbsp;(<strong class='accvers' style='color:white;'>".$lver."</strong>)<span class='lastupd' style='float:right;height:auto;color:white;'> Last update on: ".ymd_to_dmy($infoason)."</span></div><div class='card-body' style='overflow-wrap: break-word;background-color:#f2e6ff;'>";

	$accorhtml = $accorhtml . "<div style='font-size:15px;'><table class='table table-bordered table-hover table-condensed'><tbody><tr><th style='background-color:#f2e6ff;'>Functional Domain </th><td> " .implode(",",json_decode($row['func_domain'],true))."</td></tr>";
	$accorhtml = $accorhtml . "<tr><th style='background-color:#f2e6ff;'>Stack Relevance </th><td> ".implode(",",json_decode($row['stack_relavance'],true))."</td></tr>";
	$accorhtml = $accorhtml . "<tr><th style='background-color:#f2e6ff;'>License </th><td> ".implode(",",json_decode(($row['license'])?$row['license']:"[-]",true))."</td></tr>";
	$accorhtml = $accorhtml  . "<tr style='color:#2d8655;'><th style='background-color:#f2e6ff;'> Latest Version</th><td>    <strong>" .$lver. "&nbsp;&nbsp;&nbsp;</strong></td></tr>";
	$accorhtml = $accorhtml . "<tr style='color:#375e97;'><th style='background-color:#f2e6ff;'>Still Supported Version(s) </th><td style='word-break: break-all;'> <strong> (" .((count(json_decode($row['suppvers'],true)) > 0)?count(json_decode($row['suppvers'],true)):0).")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong class='comment more'>".implode(",",json_decode($row['suppvers'],true))."</strong></td></tr>";
	$accorhtml = $accorhtml . "</tbody></table></div><br/>".getcolornote()."<br/></div></div>";
				

echo $accorhtml;

}
function getcolornote()
{
	$colornotes = "<div class=\"clearfix\" style=\"color:#808080;\"><div class=\"colornote float-right\"><ul><li><div class=\"input-color\"><span class=\"textgreen\">Latest</span><div class=\"color-box green\"></div></div></li><li><div class=\"input-color\"><span class=\"textamber\">Still Supported</span><div class=\"color-box amber\"></div></div></li><li><div class=\"input-color\"><span class=\"textred\">NOT Supported</span><div class=\"color-box red\"></div></div></li></ul></div></div>";
	return $colornotes;
}
?>
