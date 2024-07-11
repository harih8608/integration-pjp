<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="OSS Repository">
    <meta name="author" content="OSS Repository">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>OSS Repository Portal</title>
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.css">
    <link rel="stylesheet" type="text/css" href="assets/DataTables/Buttons-1.7.0/css/buttons.dataTables.min.css">
</head>
<?php
ini_set('display_errors', false);
ini_set('display_startup_errors', false);
if(session_id() == ''){
session_start();
}
require "coding/dbconnect.php";
require "coding/session_check.php";

?>
<body>
    <?php
        include 'common/head.php';
    ?>
    <div class="container-fluid">
		<main role="main" class="col-md-12 ml-sm-auto col-lg-12 pt-3 px-4 pb-3">
        <table id="usage" class="table table-bordered table-condensed text-center">
            <tbody>
                <tr>
                    <th colspan="6" class="text-white p-1 bg-glacierblue">
                        <h3>OSS Portal Users log</h3>
                    </th>
                </tr>
            </tbody>
        </table>
        <div>
            
            <?php
            
            global $conn;
            $tablebody="";
			$userData_arr = array();
            
		$getuserslog_sqlname_qry ="SELECT lh.user_id, mu.name, mu.email_id, lh.login_time FROM public.login_history lh inner join public.mas_user mu on lh.user_id = mu.user_id order by lh.login_time desc";
		$getuserslog_sqlname = "get_users_log";
		if(!pg_prepare($conn, $getuserslog_sqlname, $getuserslog_sqlname_qry)){
			die("Can't prepare '$getuserslog_sqlname_qry'".pg_last_error());
		}
		$getuserslog_sqlname_qry_res =  pg_execute($conn, $getuserslog_sqlname, array());
		
		while($row = pg_fetch_assoc($getuserslog_sqlname_qry_res)){
			
			$userData_arr[] =  $row;
		}
		
		$tablehead = "<div class='otgUsers'><table class='table table-bordered table-condensed' id='OTG_Users_tbl'><thead><tr><th class='p-1' style='width:25%;'>User Id</th><th class='p-1' style='width:25%;'>Name</th><th class='p-1 fit'>Email</th><th class='p-1 fit' >login date</th></tr></thead><tbody>";
		//foreach ($jsoncontent["ossTools"] as $key => $value) {
		//file_put_contents("vareportupload.txt", "toolids count array :  ".count($priorityTools_arr) ."  **  ".count($priorityToolData_arr).PHP_EOL, FILE_APPEND);
		//$priorityTools_res_cpy =  pg_execute($conn, $priorityTools_sqlname, array());

			
		foreach ($userData_arr as $key => $udata) {

			//file_put_contents("vareportupload.txt", "1st while :  ".PHP_EOL, FILE_APPEND);
			//file_put_contents("vareportupload.txt", "toolids :  ".$tdata['tool_id'] ."  **  ".$row['tool_id'].PHP_EOL, FILE_APPEND);
			$tablebody .= "<tr><td class='p-1'>".$udata["user_id"]."</td><td class='p-1'>".$udata["name"]."</td><td style='font-weight:bold; word-wrap: break-word; width:40%;' class='p-1'>".$udata["email_id"]."</td><td class='p-1 fit'>".$udata["login_time"]."</td></tr>";
			}
		//file_put_contents("vareportupload.txt", "table :  ".$tablehead.$tablebody."</tbody></table></div><br/>".PHP_EOL, FILE_APPEND);
		echo $tablehead.$tablebody."</tbody></table></div><br/><br/><br/>";

            ?>


        	</div>
	</main>
		<br/>
    </div>
    <?php
    include 'common/footer.php'; 
    ?>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.js"></script>
    <script src="assets/DataTables/Buttons-1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="assets/DataTables/Buttons-1.7.0/js/buttons.html5.min.js"></script>
    <script src="assets/DataTables/Buttons-1.7.0/js/buttons.print.min.js"></script>
    <script src="assets/DataTables/Buttons-1.7.0/js/buttons.bootstrap.min.js"></script>
    <script src="assets/js/ossfunctionality.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        loadmenuitems();
		$("#OTG_Users_tbl").DataTable(
			{
				order: [[3, 'desc']]

			}
		);

    });
    </script>
	<style>
	.osssummary  th
	{
		background-color: rgb(176, 197, 81);
		color: white;
	}
	</style>
</body>
</html>