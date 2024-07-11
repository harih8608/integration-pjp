<?php // $data = json_decode(file_get_contents('kickstart_json/kickstart-meta-data.json'),1);
	//echo '<pre>';print_r($data['kickStartCollection'][0]['subCategories']);die;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="OSS Repository">
    <meta name="author" content="OSS Repository">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <title>OSS Repository Portal</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- ChartJs CSS -->
    <!-- <link href="assets/css/chartjs.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/faq.css" rel="stylesheet">
	<link href="css/jquery-ui.css" rel="stylesheet" />
	
	
	 <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 Jquery Core Js -->
	<!-- <link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
	-->
	<style>
	
.panel-group .panel-heading + .panel-collapse > .panel-body {
  border: 1px solid #ddd;
}
.panel-group,
.panel-group .panel,
.panel-group .panel-heading,
.panel-group .panel-heading a,
.panel-group .panel-title,
.panel-group .panel-title a,
.panel-group .panel-body,
.panel-group .panel-group .panel-heading + .panel-collapse > .panel-body {
  border-radius: 2px;
  border: 0;
}
.panel-group .panel-heading {
  padding: 0;
}
.panel-group .panel-heading a {
  display: block;
  background: #807d59;
  color: #ffffff;
  padding: 10px;
  text-decoration: none;
  position: relative;
}
.panel-group .panel-heading a.collapsed {
  background: #eeeeee;
  color: inherit;
}
.panel-group .panel-heading a:after {
  content: '-';
  position: absolute;
  right: 20px;
  top:5px;
  font-size:30px;
}
.panel-group .panel-heading a.collapsed:after {
  content: '+';
}
.panel-group .panel-collapse {
  margin-top: 5px !important;
}
.panel-group .panel-body {
  background: #e5e4dc;
  padding: 15px;
}
.panel-group .panel {
  background-color: transparent;
}
.panel-group .panel-body p:last-child,
.panel-group .panel-body ul:last-child,
.panel-group .panel-body ol:last-child {
  margin-bottom: 0;
}

.panel-body div p{
	text-decoration: justify;
}
.panel-body .panel-group .panel-heading a.collapsed {
  background: #999578;
  color: inherit;
}
.panel-body .panel-group .panel-body .panel-group .panel-heading a.collapsed {
  background: #fcd6b6;
  color: inherit;
}
.panel .panel-default:hover{box-shadow: 0px 0px 3px 0px #a6a6a6;}
.repo_i{
	color:darkgreen;
	font-size:0.8em;
}
	</style>
  </head>
<?php
 ini_set('display_errors', false);
 ini_set('display_startup_errors', false);

 // header('Content-type: application/pdf');
  //session_start();
    require "coding/session_check.php";
	require "doctables.php";
/*require "../toollister/settoken.php";
    require "../toollister/download-file.php";*/

	$user_id = $_SESSION['user'];
    //require 'new/common/head.php';
    //require 'new/common/left_menu.php';
?>
  <body class="style-1">
  <?php
	include 'common/head.php'; 
	include 'repo_json_sort.php';
	?>
    


    <div class="container-fluid ">
     <div id="wrapper">
      
        <?php	

				    function formatSizeUnits($bytes)

				    {
				        if ($bytes >= 1073741824)
				        {
				            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
				        }
				        elseif ($bytes >= 1048576)
				        {
				            $bytes = number_format($bytes / 1048576, 2) . ' MB';
				        }
				        elseif ($bytes >= 1024)
				        {
				            $bytes = number_format($bytes / 1024, 2) . ' KB';
				        }
				        elseif ($bytes > 1)
				        {
				            $bytes = $bytes . ' bytes';
				        }
				        elseif ($bytes == 1)
				        {
				            $bytes = $bytes . ' byte';
				        }
				        else
				        {
				            $bytes = '0 bytes';
				        }

				        return $bytes;
					}

		?>
        

<main role="main" class="col-md-12 ml-sm-auto col-lg-12 pt-3 pb-3">     	
<div class="body">
<table id="ossisoimg" class="table table-bordered table-condensed text-center">
			<tbody>
			<tr ><th colspan="6" class="text-white p-1 bg-isoimg-2"><h3>RPM Distributions for OSS Tools for use in NIC cloud environment</h3></th></tr>
			</tbody></table>
<table id="rpmdistributionss_analytics" class="table table-bordered table-condensed">
	<tbody>
	<!--<tr><th colspan="4" class="text-white p-1">Kickstart Ubuntu Images for e-Court</th></tr>
	<tr><td colspan="4" class="p-1" style="background-color:#f6933c !important;color:white">NIC Open Source Repository Services kickstart images are the vulnerability assessment tested images for ready deployment specific to the project stack</td></tr>-->
	<tr><th class="text-white text-center bg-rpm-1">PHP</th>
		<th class="text-white text-center bg-rpm-1">Apache with Tomcat</th>
		<th class="text-white text-center bg-rpm-1">Tomcat</th>
		<th class="text-white text-center bg-rpm-1">Apache Httpd</th>
		<th class="text-white text-center bg-rpm-1">PostgreSQL</th>
		<th class="text-white text-center bg-rpm-1">Others</th>
		<th class="text-white text-center bg-rpm-1">Total</th>
	</tr>
	<tr>
	<?php 
	//$allcounts = getrpmcount();
	$allcounts = getrpmcount();
//	$allcounts = getrpmcount_pubjson();

	$countarr = explode('*',$allcounts);
	?>
	<td class="text-center bg-rpm-2"><strong><h3><?php echo $countarr[0]; ?></h3></strong></td>
	<td class="text-center bg-rpm-2"><strong><h3><?php echo $countarr[1]; ?></h3></strong></td>
	<td class="text-center bg-rpm-2"><strong><h3><?php echo $countarr[2]; ?></h3></strong></td>
	<td class="text-center bg-rpm-2"><strong><h3><?php echo $countarr[3]; ?></h3></strong></td>
	<td class="text-center bg-rpm-2"><strong><h3><?php echo $countarr[4]; ?></h3></strong></td>
	<td class="text-center bg-rpm-2"><strong><h3><?php echo $countarr[5]; ?></h3></strong></td>
	<td class="text-center bg-rpm-2"><strong><h3><?php echo array_sum ($countarr); ?></h3></strong></td>
	</tr>
	</tr>
</tbody>
</table>
	<form>
	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             
            
			<br/>
       <div id="BykickStartMajorCategory">
				<div class="card" style="border: none;">
					<div class="header" style ="color: #808080;">				
					</div>
				
				</div>
				<div id="accToolList"></div>
				
	    </div>

        
<!-- nested accordion starts -->


	<?php $rpmjson = json_decode(file_get_contents('oss-json/rpm_pub.json'),1);
$repostatusjson="";
$data = 	repo_json_sort_pub($rpmjson);
		foreach($data['mainCategories'] as $key=>$mainCatg_org){
			foreach($mainCatg_org['subCategories'] as $subcatkey=>$subCatg_org){
			if(count(	$subCatg_org['repoCollection']) > 0 ){
				
				$data['mainCategories'][$key]['subCategories'][$subcatkey]['hasRepo'] ="true";
				$data['mainCategories'][$key]['mainwithRepo']="true";
			 //echo "{$key} => {$mainCatg} ";
			 //print_r($data['kickStartCollection']);
			}
			/*else{
				$data['mainCategories'][$key]['subCategories'][$subcatkey]['hasRepo'] ="false";
				$data['mainCategories'][$key]['mainwithRepo']="false";
			}*/
			
			}
		}
		
		foreach($data['mainCategories'] as $key=>$mainCatg_org){
			if($mainCatg_org['mainwithRepo'] == "true" ){
			
				$mainCatg = $mainCatg_org;
				?>
	<div class="panel-group" id="accordion-<?php echo $mainCatg['mcId']; ?>">
		<div class="panel panel-default">
		   <div class="panel-heading">
			  <h6 class="panel-title">
				 <a class="category collapsed" data-toggle="collapse" data-parent="#accordion-<?php echo $mainCatg['mcId']; ?>" href="#ecourt-<?php echo $mainCatg['mcId'] ?>">
				 <b><?php echo $key+1; ?></b>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $mainCatg['mainCategory'] ?>&nbsp; <i class="repo_i">(last updated: <?php echo $mainCatg['mainOrder'].')';?></i>
				 </a><!-- Main category -->
			  </h6>
		   </div><!--/.panel-heading -->
		   <div id="ecourt-<?php echo $mainCatg['mcId'] ?>" class="panel-collapse collapse">
			  <div class="panel-body">
			  <?php echo $mainCatg['mainDesc'] ?> <!-- Main category Description-->
			  
				<!-- nested -->

				<?php foreach($mainCatg['subCategories'] as $key_sub=>$subCatg){ 
				if($subCatg['hasRepo'] == "true"){
				?>


				<div class="panel-group" id="ecourtiso-<?php echo $subCatg['scId']; ?>">
					<div class="panel panel-default">
					   <div class="panel-heading">
						  <h6 class="panel-title">
							 <a class="collapsed" data-toggle="collapse" data-parent="#ecourtiso-<?php echo $subCatg['scId'] ?>" href="#ec-<?php echo $subCatg['scId'].'-'.$key; ?>">
							 <?php echo $key_sub+1; ?> - <?php echo $subCatg['subCategory'];?> &nbsp; <i class="repo_i">(last updated: <?php echo $mainCatg['subCategories'][$key_sub]['subOrder'].')';?></i>
							 </a>
						  </h6>
					   </div><!--/.panel-heading -->
					   <div id="ec-<?php echo $subCatg['scId'].'-'.$key; ?>" class="panel-collapse collapse in">
						  <div class="panel-body">
							<table class="table table-bordered table-hover table-condensed">
							<tbody>
							<?php
								//kickstarts ends
							 foreach($subCatg['repoCollection'] as $ks_key=>$kstart) /*echo print_r($subCatg['kickStarts']);*/ {
							  ?>

							 <tr>
							 <?php 
							 //$docs = $kstart['docs'][0];
							 $ksId = $kstart['repoId'];
							 $mcId = $mainCatg['mcId'];
							 $scId = $subCatg['scId'];
							 $ksisoFileName =$kstart['repoFileName'];
							 //$ksdocFileName=$docs['fileName'];
							
							 /*$ch = curl_init($ksloc.$ksisoFileName);
							 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
							 curl_setopt($ch, CURLOPT_HEADER, TRUE);
							 curl_setopt($ch, CURLOPT_NOBODY, TRUE);
							 $data = curl_exec($ch);
							 $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
                             curl_close($ch);

                             $ch1 = curl_init($ksloc.$ksdocFileName);
							 curl_setopt($ch1, CURLOPT_RETURNTRANSFER, TRUE);
							 curl_setopt($ch1, CURLOPT_HEADER, TRUE);
							 curl_setopt($ch1, CURLOPT_NOBODY, TRUE);
							 $data1 = curl_exec($ch1);
							 $size_doc = curl_getinfo($ch1, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
                             curl_close($ch1);
*/
?>
							<td>Download Docs:&nbsp;&nbsp;&nbsp;<br/>
							<?php

                       foreach ($kstart['docs'] as $doc_key => $doc_value) { 
							 if(!empty($doc_value['documentName']) && !empty($doc_value['filename'])){ ?> 
							 <a id="doc_link" class="download_file" ks_id="<?php echo $ksId; ?>" doc_id="<?php echo $doc_key; ?>"  href="#" file_type="2"><?php echo $doc_value['documentName'];  ?> 
							 </a>
							 <?php echo nl2br("\r\n");}else {}} ?>
                                    </td>

							 <?php if(!empty($kstart['repoName'])){ ?> 
                             <td width="550" style="word-break: break-word;">Download:&nbsp;&nbsp;&nbsp;<br/><a id="ks_link" class="download_file" href="#" ks_id="<?php echo $ksId; ?>" file_type="1">
                            <?php echo $kstart['repoName'];  ?> 
                             </a> </td>
                            <?php } ?> 

<td>Download SHA:&nbsp;&nbsp;&nbsp;<br/>
                            <?php if(!empty($kstart['hash'])){ ?> 
							 <a id="md5_link" class="download_file_pdf" ks_id="<?php echo $ksId; ?>" href="javascript:void(0);" a_href="<?php  echo $ksloc.$kstart['hashFileName']; ?>" data-toggle="modal" title="<?php echo $kstart['repoName']; ?>" onclick="openmodal(this,'<?php echo $ksId; ?>','<?php echo $mcId; ?>','<?php echo $scId; ?>')"><?php 
							 if($kstart['hashType'] == "1") {
								 echo '[MD5]'; 
							 }
							 else{echo '[SHA512]';}
							 ?></a></td><?php }else { echo "-";} ?>
                               


							 <?php if(!empty($kstart['createdDate'])){ ?> 
                             <td style="word-break: normal"> Created Date:<br/><?php echo $kstart['createdDate']; ?> 
                             </td>
                             <?php } ?>


                             <?php if(!empty($kstart['modifiedDate'])){ ?> 
                             <td style="word-break: normal"> Modified Date:<br/><?php echo $kstart['modifiedDate']; ?> 
                             </td>
                             <?php } ?>


							</tr>
							<?php 
							//kickstarts ends
							} ?>
							</tbody>
							</table>
						  </div><!--/.panel-body -->
					   </div><!--/.panel-collapse -->
					</div><!-- /.panel -->
				</div><!-- /.panel-group -->
					<?php 
					//subcategory ends
				}} ?>
			  </div><!--/.panel-body -->
		   </div><!--/.panel-collapse -->
		</div><!-- /.panel -->
		<!--Policy & standards ends-->
	</div>
		<?php }}
			
	//main category ends here ?>
	

<!-- nested accordion ends -->	

				
		 </div>

		<br/>
<!--
<div class="modal fade" id="md5Modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                    <h6 class="modal-title" style="color: DodgerBlue;" id="md5title"></h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                       
                        </div>
                <div class="modal-body1" id="md5content" style="background-color: #fef9e7;">
                          <div class="box box-info">
                          </div>
                        </div>
                   <div class="modal-footer" id="md5contentfooter" style="float:right;"></div>
                    </div>
                </div>
</div>
-->
<div class="modal fade" id="md5Modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">

		<h6 class="modal-title" style="color: DodgerBlue;" id="md5title"></h6>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
		   
			</div>
	<div class="modal-body1 p-2" id="md5content" style="background-color: #fef9e7;">
	<table>
	<tr>
	<td style="word-break: break-word;">
	<b><span class="toolsha512"></span></b> <br><br>
	<span class="tooltarfile"></span>
	</td>
	</tr>
	</table>
	<table>
	<tr>
	 <td align="left" >

	<b>Note: Please check the sha512sum of the tar downloaded using below mentioned steps </b>
	</td>
	</tr> <br><br>
	<tr>
	<td><br>
	<b>Step 1: </b>
	<span style="color: #0000ff;" color="#0000ff"> #sha512sum &nbsp;&nbsp;&nbsp;&nbsp;<span class="tooltarfile"></span></span> 
	</td>
	</tr>
	<tr>
	<td style="word-break: break-word;">
	<p>Output:</p>
	<span style="color: #0000ff;" color="#0000ff">#sha512sum &nbsp;&nbsp;&nbsp;&nbsp;<span class="tooltarfile"></span></span><br/>
	<span style="color: #993366;" color="#993366"><b><span class="toolsha512"></span></b> &nbsp;&nbsp;&nbsp;&nbsp;<span class="tooltarfile"></span></span>
	</td>
	</tr>
	<td>
	<br>
	<b>Points to check:</b>
	<br><br>
	1) sha512sum is the command to check the tar (tar File Downloaded from the link) file is corrupted or not.(Written in blue colour)
	<br><br>
	2) Output of the command "#sha512sum(command)  'downloaded kickstart tar(file name)'" should match the sha512sum output mentioned above.
	<br><br>
	3) Mistmatch in the sha512sum output shows the downloaded file is corrupted.(Installation will start but will fail at any point of time)
	<br>
	</td>
	</table>
</div>
	   <div class="modal-footer" id="md5contentfooter" style="float:right;"></div>
		</div>
	</div>
    </div>	
	</form>
	<div id='somediv'></div>
	
</div>
	  <br/>
		
		
	  
		
	  </div>
			  
        </main>
      </div>
    </div>
<br/>
<br/>

		



<div id="downloading-file" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-lg">
      
  
   <div class="modal-content">
   <!-- Modal Header -->
	<div class="modal-header btn-info text-center" style="color:#2B4A9F;background-color: #85e5f8;display: block; font-weight:bold;font-size:100%;">
	  Preparing for download please wait...
	  <button type="button" class="close downloadcancel" data-dismiss="modal" aria-hidden="true" aria-label="Close">&times;</button>
	</div> 
				
    <!--   <div class="modal-header btn-info">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Preparing for download please wait...</h4>
      </div> -->
      <div class="modal-body">     	
     <div class="progress">
     <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:1%">
    </div><br/>
    </div>
    <div id="information" style="display:block;"></div>
    </div>
    </div>
      
    </div>

  </div>
<a href="#" id="hreflink" target="_blank" hidden="hidden">File Download</a>

	<?php
			
			include 'common/footer.php'; 
		?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/chartjs.js"></script>
	<script src="js/jmespath.min.js"></script>
    <script src="js/jquery-ui.js"></script>
	<script  src="assets/js/jq-ajax-progress.min.js"></script> 
	<script src="assets/js/ossfunctionality.js"></script>
	
    <script>


$(document).ready(function(){
	loadmenuitems();
	$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
		$("#sm-sidebar-wrapper").addClass("sm-toggled");
    });

	
	$("#CloseModalbtn").click(function(){
		alert("closemodal btn");
		//$("#minorVersionsModal").modal('dispose'); 
		$("#md5Modal").modal('hide'); 
	});

	$(window).bind("resize", rescale);
	
});
var ajaxdownloadprogresscall;
$(".downloadcancel").click(function(){
	alert("Download Cancelled"); 
 ajaxdownloadprogresscall.abort();

});
function openmodal_w_obj_file(obj)
	{
       /* var x = document.getElementById("md5Modal");
        x.open = true;*/
        var path =  $(obj).attr('a_href');
        $(obj).attr("href",path);
		$("#md5title").empty();
		$("#md5content").empty();
		$("#md5contentfooter").empty();
		$("#md5title").html("Md5/SHA512sum for - "+obj.title);
		$("#md5content").html('<object width="100%" height="100%" type="text/html" data='+obj.href+' ></object>');
		var $btnappnd = $('<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
		$btnappnd.appendTo($('#md5contentfooter'));
		
		$("#md5Modal").modal('show'); 
		rescale();
		$(obj).removeAttr("href");
        $(obj).attr("href","javascript:void(0);");	
	}
function getupdatetooljson()
{
	var metadata="";
	$.ajax({
        //type: "GET",
        url: "oss-json/rpm_pub.json",
		async: false,
        //data: "{'MemberNumber': '" + $("#txt_id").val() + "'}",
        //contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data){
			//receivedjson = JSON.stringify(data);
			metadata = data;
		},
		
        error: function(error) { metadata = error; }
    });
	return metadata;
}

updatetooljson = getupdatetooljson();
function openmodal(obj,ks_id, mc_id,sc_id)
	{
     //alert("ks id "+ks_id + " --- mcid : "+ mc_id +" --- scid : "+ sc_id);
	 //check for ks_id is passed in download file
        var path =  $(obj).attr('a_href');
        $(obj).attr("href",path);
		$("#md5title").empty();
		//$("#md5content").empty();
		$("#md5contentfooter").empty();
		$("#md5title").html("Md5/SHA512sum for - "+obj.title);
		//alert(obj.title);
		//var currks = jmespath.search(updatetooljson, "kickStartCollection[].subCategories[].kickStarts[?ksId=='" + ks_id + "']");
		var currks = jmespath.search(updatetooljson, "mainCategories[].subCategories[].repoCollection[?repoId=='"+ ks_id +"']");
		var mc= jmespath.search(updatetooljson, "mainCategories[?mcId=='"+mc_id+"']");
		//alert(mc[0].mcId);
		var sc= jmespath.search(mc[0],"subCategories[?scId=='"+sc_id+"']");
		//alert(sc[0].scId);
		var ks= jmespath.search(sc[0],"repoCollection[?repoId=='"+ks_id+"']");
		//alert(ks[0].repoId);
		if(ks[0].hash != "")
		{
			$(".toolsha512").text(ks[0].hash);
		}
		else
			$(".toolsha512").text("--- SHA512 Unavailable ---");
		var repofile = ks[0].repoFileName.replace(/\\\\/g, '\\');
		var repofile = ks[0].repoFileName.replace(/\\/g, '/');
		var repofilearr = repofile.split('/');
		/* Getting just the filename from a path with JavaScript
		var fileNameIndex = yourstring.lastIndexOf("/") + 1;
		var filename = yourstring.substr(fileNameIndex);
		*/
		$(".tooltarfile").text(repofilearr[repofilearr.length - 1]);
		//$("#md5content").html('<object width="100%" height="100%" type="text/html" data='+obj.href+' ></object>');
		var $btnappnd = $('<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
		$btnappnd.appendTo($('#md5contentfooter'));
		
		$("#md5Modal").modal('show'); 
		rescale();
		$(obj).removeAttr("href");
        $(obj).attr("href","javascript:void(0);");	
	}

function rescale(){
    var size = { width: $(window).width() , height: $(window).height() }
    /*CALCULATE SIZE*/
    var offset = 20;
    var offsetBody = 150;
    $('#md5Modal').css('height', size.height - offset );
    $('.modal-body1').css('height', size.height - (offset + offsetBody));
    $('#md5Modal').css('top', 0);
}



function readableBytes(bytes) {
if (bytes == 0) { return "0.00 B"; }
		    var i = Math.floor(Math.log(bytes) / Math.log(1024)),
		    sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

		    return (bytes / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + sizes[i];
		}



function downloadProgress(e) {

		  if (e.lengthComputable) {

		      var percentage = parseInt((e.loaded * 100) / e.total);
 				//console.log(percentage);

		  $('#downloading-file .progress .progress-bar').css("width", percentage+"%");

          $("#information").show();
          //alert(parseInt(percentage));

          var fsize = readableBytes(e.total);

		  $("#information").html("<div style=\"text-align:center; font-weight:bold;\"> "+percentage+"% is processed and filesize is "+fsize+" </div>");	

		    }
		
}



$(".download_file").click(function(){
	  
	 var confirm_download= confirm('Would you like to download'+$.trim($(this).html()));
	 if(confirm_download){
      var isoFileName='';
      var access_key = sessionStorage.getItem('access_token');
      var tool_id = $(this).attr('ks_id');
	  var doc_id=$(this).attr('doc_id');
       var file_type = $(this).attr('file_type');
   
		ajaxdownloadprogresscall= $.ajax({
	    	              
                     					//url: '../toollister/download-file-rpmpub.php',
                     					url: 'download-file-rpmpub.php',
                                       headers: {'Authorization': access_key},
                                        type: 'POST',
               
                                        data: {'file_type':btoa(file_type),'tool_id':btoa(tool_id),'doc_id':btoa(doc_id)},

                                              xhrFields: {
                                                          //responseType: 'blob'
                                                          responseType: 'text'
                                               },
                                              
/*
                                             progress: downloadProgress,
                                              
											   beforeSend:function(){

											   	if(file_type=='1'){
											   	//$('#downloading-file .progress .progress-bar').css("width", "1%");
												$('#downloading-file').modal({
													backdrop: 'static'
												});
												$("#information").html("");
											   	$('#downloading-file').modal('show');
								     			}else if(file_type =='2'){
                                                $('#downloading-file').modal('hide');
								     			  }
								     			}, 
*/
								     			

                                        success: function (data,status,xhr) {
                                                 var ahref = data;
                                                 console.log('data = '+data);
                                                 document.getElementById('hreflink').href = ahref;
                                                 document.getElementById('hreflink').click();
                                                 document.getElementById('hreflink').href = "#";
/*
                                        		 var filename = '', disposition = xhr.getResponseHeader('Content-Disposition');

												  if (disposition && disposition.indexOf('attachment') !== -1) {
												    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/
												      , matches = filenameRegex.exec(disposition)

												    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '')
												  }
		     
		                                                   var a = document.createElement('a');
		                                                   var url = window.URL.createObjectURL(data);
		                                                   a.href = url;
		                                                   a.download = filename;
		                                                   document.body.append(a);
		                                                   a.click();
		                                                   a.remove();
		                                                   window.URL.revokeObjectURL(url);
		                                                   $('#downloading-file').modal('hide');
*/
                                        },

                                        error: function (xhr,status,error) {

                                        
											if(xhr.status==401){

												$('#downloading-file').modal('hide');
												alert("Authorization error occured while downloading!...");
												
											}
											else if(xhr.status==500){

												$('#downloading-file').modal('hide');
												alert("Internal Server error occured while downloading!...");
												
											}
											else{
												
												$('#downloading-file').modal('hide');
												alert("Error occurred while downloading a file!!");
												
											}

							            }
						});


}
else{
	return false;
}

	  					 
});

</script>
<style>


/*tr:nth-child(even) { background-color: #f2f2f2; }*/

th {
	background-color: #F0F0F0;
	color: #808080;
}
/*
td {
	overflow-wrap: break-word;
}
*/
.card-header {
	padding: 1.75rem 1.25rem !important;
}


</style>
  </body>
</html>
