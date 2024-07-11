<style>
.active {
  font-color: yellow;
  
}
.noHover{
    pointer-events:none;
}
</style>
 <?php
 	$_SESSION['captcha_error'] = "";

 /*if(isset($_POST['logout']))
 {
 header("Location: index.php");
 }*/
//include 'coding/dbconnect.php'; 
 ?>
 <div class="modal fade" id="ContinueToFeedback">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	  
		<!-- Modal Header -->
		<div class="modal-header">
		  <h5 class="modal-title" style="color: DodgerBlue;">Want to proceed to feedback ?</h5>
		  <button type="button" class="close sno_ids_modal_close" data-dismiss="modal" aria-hidden="true" aria-label="Close">&times;</button>
		</div>
		
		<!-- Modal body -->
		<div class="modal-body">
		 <!-- To mail starts -->
		 <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 justify-content-around">
			<button type="button" class="btn btn-primary proceed " data-toggle="modal" data-target="#FeedbackForm" data-dismiss="modal">Proceed</button>
			<button type="button" id="logoutwofeedback" class="btn btn-primary later" data-dismiss="modal">Later</button>
		 </div>
		 <!-- To mail body starts -->
		</div>
		
		<!-- Modal footer -->
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger sno_ids_modal_close" data-dismiss="modal">Close</button>
		</div>
		
	  </div>
	</div>
 </div>


 <div class="modal fade" id="FeedbackForm">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	  
		<!-- Modal Header -->
		<div class="modal-header">
		  <h5 class="modal-title" style="color: DodgerBlue;">Feedback</h5>
		  <button type="button" class="close sno_ids_modal_close" data-dismiss="modal" aria-hidden="true" aria-label="Close">&times;</button>
		</div>
		
		<!-- Modal body -->
		<div class="modal-body">
		 <!-- To mail starts -->
		 <form id="feedback_form">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div id="feedback"><br/>
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<table class="table table-bordered table-condensed">
				<tbody>
				<tr class='d-none'><th>Employee Code </th><td><input id="empcode_1" name="empcode_1" type="text" disabled value="<?php echo isset($_SESSION['user'])?$_SESSION['user']:''; ?>"/></td></tr>
				<tr class='d-none'><th>Name</th><td><input id="empname_1" name="empname_1" type="text"  disabled value="<?php echo isset($_SESSION['username'])?$_SESSION['username']:''; ?>"/></td></tr>
				<tr class='d-none'><th>Email-id</th><td><input id="email_1" name="email_1" type="email" disabled value="<?php echo isset($_SESSION['email'])?$_SESSION['email']:''; ?>"/></td></tr>
				<tr class='d-none'><th>Mobile (10 digit)</th><td>+91<input id="mobile_1" name="mobile_1" type="tel" pattern="[0-9]{10}" maxlength="10" disabled value="<?php echo isset($_SESSION['mobile'])?$_SESSION['mobile']:''; ?>"/></td></tr>
				<tr><th class="mandatory col-lg-4 col-sm-3">Service</th><td><select id="services_1" name="services_1" class="form-control col-lg-8 col-md-4 col-sm-4 col-xs-4" required><option value="0"> Select Service</option><?php 
//				$result=pg_query($conn, "SELECT service_id, service_name FROM oss_portal.mas_services where service_id != '11' ORDER BY service_name ASC");
					$qry="SELECT service_id, service_name FROM oss_portal.mas_services where service_id != '11' ORDER BY service_name ASC";
					$sqlname = "ossfeedback_modal";
					if (!pg_prepare($conn, $sqlname, $qry)) {
						die("Can't prepare '$qry': " . pg_last_error());
					}
					$result = pg_execute($conn, $sqlname, array());

					//$res =  pg_fetch_all($result);
					//$count = pg_num_rows($res);
								while($row = pg_fetch_assoc($result)){ ?>
				 
				<option value="<?php echo $row['service_id'];?>"> <?php echo $row['service_name'];?>

				</option>

<?php }?> </select></td></tr>
				<tr id="subservicerow_1"><th class="col-lg-4 col-sm-3">Sub-Service</th><td><select id="subservices_1" name="subservices_1" class="form-control col-lg-8 col-md-4 col-sm-4 col-xs-4" required disabled><option value="0"> Select Sub-Service</option></select></td></tr>
				<tr id="ratingrow_1"><th class=" col-lg-4 col-sm-3">Want to give Ratings?<span class="mandatory"></span> &nbsp;&nbsp;<br/>
				<input type="radio" name="rate_1" value="Y" checked>Yes &nbsp;&nbsp;<input type="radio" name="rate_1" value="N">No
</th><td>
  <!--<input type="range" min="0" max="5" value="5" class="slider" id="myRange_1">&nbsp;&nbsp; <i>Rating: <span id="demo_1"></span></i>-->
  <div id="rate_div_1" class="row pl-3"><input class="rating_1" value="0"/><span id="clearrate_1" class="glyphicon glyphicon-remove p-1" style="color:red;"></span>
<input type="hidden" id="rated_value_1" value="0"/></div>
</td></tr>
				<tr><th class="mandatory col-lg-4 col-sm-3">Feedback</th><td><textarea class="form-control col-lg-8 col-md-4 col-sm-4 col-xs-4" rows="3" id="comment_1" name="comment_1" required></textarea></td></tr>
				<tr>
					<th class=" col-lg-4 col-sm-3">
					Captcha
					</th>
					<td>
					<div class="input-group" id="captcha_code_1">
                        <span class="input-group-addon">
                            <i class="material-icons"></i>
                        </span>
                        <div id="imgdiv_1" style="margin-left: 20px;">
                            <img id="cap_img_1" src="coding/captcha.php" style="height: 40px;">
                            <i class="material-icons" id="reload_1" style="cursor: pointer;">
                                <img src="images/refresh.png" style="height: 30px;">
                            </i>
                        </div>
                    </div>
<br/>
                    <div class="input-group">
                        <div class="form-line">
                            <input type="text" class="form-control" maxlength="6" id="captcha_1" name="captcha_1" placeholder="Type above captcha here" required autocomplete="off">
                        </div>
                       
                            <label id="username1-error_1" class="error" for="captcha_1"> </label>
                       
                        <label id="captcha1-error_1" class="error" for="captcha_1"><?php echo $_SESSION['captcha_error']; ?></label>
                    </div>
					</td>
				</tr>
				<tr style="text-align:center;"><td colspan="2"><input id="fbsubmit_1" name="fbsubmit_1" type="button" value="submit" class="btn btn-primary bg-stone "/>
				</td></tr>
				</tbody>
				</table>
				
				</div>
			</div>
			</div>
			</div>
			<br/>
		 
							
		
		
	</div>	
	
		
		
		<br/>
		
	</form>
		 <!-- To mail body starts -->
		</div>
		
		<!-- Modal footer -->
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger sno_ids_modal_close" data-dismiss="modal">Close</button>
		</div>
		
	  </div>
	</div>
 
<div class="modal fade" id="FeedbackModal_1">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	  
		<!-- Modal Header -->
		<div class="modal-header">
		  <h5 class="modal-title" style="color: DodgerBlue;">Feedback Submission Status </h5>
		  <button type="button" class="close trnfb_close" data-dismiss="modal" aria-hidden="true" aria-label="Close">&times;</button>
		</div>
		
		<!-- Modal body -->
		<div class="modal-body">
		 <!-- To mail starts -->
		 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div id="FeedbackContent_1" style="color: DodgerBlue;">
			Thanks for your feedback on service <b><span id="servicename_1" ></span></b> <br/>
			<span class="d-none">Your Feedback Transaction id is </span><b><span class="d-none" id="trnid_1"></span></b>
			</div>
		 </div>
		 <!-- To mail body starts -->
		</div>
		
		<!-- Modal footer -->
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger trnfb_close" data-dismiss="modal">Close</button>
		</div>
		
	  </div>
	</div>
 </div>
 
 <div class="modal fade" data-backdrop="static" id="SDmodal">
	<!-- <div class="modal-dialog modal-xl" style="width:98%; max-width:none; height:98%; margin:5; padding:0;"> -->
	<div class="modal-dialog modal-xl">
	  <div class="modal-content" style="height: 100%;">
	  
		<!-- Modal Header -->
		<div class="modal-header">
		  <h5 class="modal-title" style="color: DodgerBlue;">Support Digest</h5>
		  <button type="button" class="close sd_close" data-dismiss="modal" aria-hidden="true" aria-label="Close">&times;</button>
		</div>
		
		<!-- Modal body -->
		<div class="modal-body" style="overflow-y: auto;">
		 <!-- To mail starts -->
		 <div class="row">
			<div class="col-lg-12 col-md-10 col-sm-8 col-xs-12">
				<div id="SD_content" style="color: DodgerBlue;">
					<div class="p-2" style="background:#e5e4e2;"><b><i>Support Detail Issue:</i></b>&nbsp;<b><span id="sd_ques" ></span></b> <br/></div><br/>
					<div id="sd_div_for_iframe" class="p-2" style="background:#e5e4e2;"><b><i>Solution:</i></b>&nbsp;<b><span id="sd_ans"> </span></b><br/></div><br/>
					<div class="container">
						<iframe id="sd_ans_iframe" src="" alt="Support Digest" class="col-lg-12 col-sm-12 col-md-10 m-0 unselectable"  width="100%" height="500px" name="sd_iframe" >
						</iframe>
					</div>
				</div>
			</div>
			<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				Search comes here
				<div class="row">
					<select id="sd_os" class="form-control col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<?php
							/* $qry="SELECT * FROM oss_portal.mas_os_digest";
							$sqlname = "sd_os";
							if (!pg_prepare($conn, $sqlname, $qry)) {
								die("Can't prepare '$qry': " . pg_last_error());
							}
							$result = pg_execute($conn, $sqlname, array());

							while($row = pg_fetch_assoc($result)){ ?>
								<option value="<?php echo $row['os_id'];?>"> <?php echo $row['os_name'];
								} */?>
					
					</select>
					<select id="sd_os" class="form-control col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<?php
							/* $qry="SELECT * FROM oss_portal.mas_paas where active_status='A'";
							$sqlname = "sd_paas";
							if (!pg_prepare($conn, $sqlname, $qry)) {
								die("Can't prepare '$qry': " . pg_last_error());
							}
							$result = pg_execute($conn, $sqlname, array());

							while($row = pg_fetch_assoc($result)){ ?>
								<option value="<?php echo $row['paas_id'];?>"> <?php echo $row['paas_desc'];
								} */?>
					
					</select>
					
				</div>
			</div> -->
		 </div>
		 <div class="d-flex justify-content-around">
			<div id="sd_document_elmt"><a class="showdoc" id="sd_document" href="#" data-anslnk="#" >Show Document</a></div>
			<div id="sd_video_elmt"><a class="showvideo" id="sd_video" href="#" video="" data-videolnk="#">Show Video</a></div>
		 </div>
		 
		 <!-- To mail body starts -->
		</div>	
		
		<!-- Modal footer -->
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger sd_close" data-dismiss="modal">Close</button>
		</div>
		
	  </div>
	</div>
</div>