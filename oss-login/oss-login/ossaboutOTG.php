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
	
<!--
	<link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" rel="stylesheet" />
-->
	<link href="css/jquery-ui.css" rel="stylesheet" />
	
	
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
	 <!-- Jquery Core Js -->
    <!--<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script> -->
    <!--<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script> -->
  </head>
<?php
 ini_set('display_errors', false);
 ini_set('display_startup_errors', false);
    session_start();
    //require "coding/session_check.php";
    //require 'new/common/head.php';
    //require 'new/common/left_menu.php';
?>
  <body class="style-1">
	<?php
	include 'coding/customfuncs.php'; 
	
	
	if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
	$emailid = $_SESSION['email'];
	}
	else{
		$emailid = '0';
		}
	//echo "email id =". $emailid."=";
	if($emailid == '0')
	{
		$sso_flag = '0';
	}
	else
	{
		$sso_flag = getssoflag($emailid);	
	}
	

if($sso_flag== '0'){
	include 'common/head_landingpage.php'; 
}
elseif ($sso_flag == '1'){
	include 'common/head.php'; 
}
	
	?>

    


    <div class="container-fluid ">
     <div id="wrapper">
      <!--<div class="row ">
        <?php
			
			//include 'common/left_menu.php'; 
		?>
        </div>-->

        <main role="main" class="col-md-12 ml-sm-auto col-lg-12 pt-3 pb-3">
          <!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h4>About OTG</h4>
            <div class="collapse mb-2 mb-md-0" id="userinfotop">
               <div class="info-container row mr-3 align-self-center">
                   <div class="email pr-2 pt-2 text-black-50">Last Login: <?php //echo date('d-m-y h:i a', time()); ?> </div>
                    <div class="name pr-2 pt-2"><?php //echo $_SESSION['username']; ?></div>
                     <div class="image">
                   	 	<img src="assets/img/user.png" alt="User" width="30" height="30">
                	</div>
					<div class="name pr-2 pt-2"><a href="coding/logout.php?logout" class="name" style="text-decoration: none !important;">Logout</a></div>
                </div>
            </div>
          </div>-->
          

         	
<div class="body">
<table id="ossabout" class="table table-bordered table-condensed text-center">
			<tbody>
			<tr ><th colspan="6" class="text-white p-1 bg-darkblue"><h3>About - Open Technology Group </h3></th></tr>
			</tbody></table>
	<form>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div id="osstemplates">
			<div>
				<!--<h4>Open Technology Group</h4>-->
				
				<!--<p style="text-indent:5%; font-size: 16px">-->
				<p style="font-size: 16px">
NIC has established Open Technology Group (OTG) to spearhead the technology exploration and
provisioning support services for adoption of OSS in various e-Governance Projects and
applications under MeitY. NIC-OTG is mandated to facilitate strategic control of Open Technology
within NIC and spearhead the knowledge centric activities in e-Governance Projects all over India.
OTG made significant contribution for formulation of e-Governance Standards, Policy on adoption
of Open Source Software for Government of India, Framework for adoption of Open Source
Software in e-Governance Systems and Open API Policy.
<br/><br/>
OTG brings value to provide additional information on OSS stack to give the track of all versions
with the details of supported and not supported versions with provision to download the respective
version from NIC OSS Repository. OTG also provides Golden templates, CentOS, ALmaLinux, Rocky Linux and Ubuntu ISO
images with various deployment scenarios, update utilities, RPM and Deb Packages for NIC Cloud environment.
				<br/>
</p>
				<!--<h6><b style="font-size: 16px;">Focus Areas:</b></h6>-->
				<b style="font-size: 18px;">Focus Areas:</b>
				<ul style="font-size: 16px"><li>Evaluate and Recommend the open source software for e-Governance Solutions.</li>
				<li>Maintain Distribution Repository of recommended open source software for usage across NIC.</li>
				<li>Guide and handhold NIC teams in keeping their open source driven system secure.</li>
				<li>Training on Open Source Software.</li>
				<li>Oversight of open source Infrastructure across NIC with respect to Cyber Security.</li>
				</ul> 
				</p>
				<br/>
				<!--<h6><b>Services Offered:</b></h6>-->
				<b style="font-size: 16px">Services Offered:</b>
				<ul style="font-size: 16px"><li>Compliance to OSS Policy ( OSS Stack, OSS adhearance & enabling SoPs, Roadmaps, Best Practice documents are being relesed )</li>
                                <li>OSS repository & Cloud Datacentre Support ( Guiding SoPs, Roadmaps, Cheatsheets, metadata updates, ISOs/Updates/RPMs for CentOS, Templates/Updates/DEBs for Ubuntu, RPMs/Updates on OSS tools on RHEL, ISO images and RPM packages for AlmaLinux and Rocky Linux  are being released )</li>
                                <li>OSS Security support ( VA guidance, VA clearance, CVEs evaluation, metadata updates/releases/downloads software update alerts are being provided )</li>
                                <li>OSS Servicedesk support ( Service support calls through NIC ServiceDesk are addressed )</li>
				<li>Capacity building on open source ( Periodical and on-demand capacity building programmes conducted online and offline)</li> </ul>
<br/>
</p>
<h6><b style="font-size: 16px"> Activities carried out during the year 2022 are given below:</b></h6>
<p style="text-indent:5%; font-size: 16px">
Open Source Stack 2022 was prepared and released after consultation with stake holders. </br>
As Linux 7 is moving towards end of life, OTG has prepared and provisioned necessary artifacts for adopting Linux 8 and Linux 9 in NIC Cloud Infrastructure. </br>
Additional Public Repositories for AlmaLinux, Rocky Linux, NGINX, Docker, gitlab, EPEL, NPM, PIP, MariaDB and PGDG have been replicated (updated regularly) and made available in NIC Cloud Environment which will reduce the effort required to provide latest packages. </br></p>
<h7><b>Following initiatives were taken:</b></h7>
    <ul style="font-size: 16px"><li> Process improvements were carried out to squeeze the time to make the system go live by introducing auto update and PaaS installation through provisioning scripts were introduced.</li>
    <li> A PoC was demonstrated for the NIC Cloud Market Place project which envisages automatic provisioning of infrastructure, PaaS and application deployment.</li>
    <li> Automatic pipe line for building OSS artifacts using “DevOps” was demonstrated. To keep project teams aware of update requirements Repositories Update Status Information System was implemented.</li>
    <li> To simplify VA Moderation requests and responses, VA Moderation and Management System was implemented.</li>
    <li> The Support Digest webinar series was introduced to effectively disseminate information about support requests resolved so that projects teams can adopt the concept of “do it yourself” for known issues.</li>
    <li> Task management system was used for internal task management to effectively monitor performance and bring in accountability.</li>
    <li> OSS Tools version meta-data collection, update and maintenance automation has been taken up and is complete for 2 tools.</li>
    <li> OpenAPI based OSS Metadata Service was developed to provide information/alerts on OSS tools.</li>
    <li> OTG Component Repository using Gitlab has been setup to disseminate information to stakeholders and facilitate collabrative contribution by the NIC community</li></ul>
</br>
<h7><b style="font-size: 16px">The following are the metrics of the quantifiable activities carried out during the year 2022 :</b></h7> </br>
<ul style="font-size: 16px">
<li>28 customized templates for Base OS, web and Database stack were made, 
<li>36 RPMs & 96 DEB Packages for PHP, PostgreSQL, Apache HTTPD, Apache Tomcat, Python, OpenSSL, 6 Update Tools to upgrade to latest version (PHP, PostgreSQL, Apache HTTPD, Apache Tomcat, OpenSSL) for CentOS 7, 10 customized and hardened ISO Images, 4 QCOW2 Images for Open Stack, 
<li>368+ updates for 25 OSS tools were carried out to OSS Metadata on the OSS Tools repository for generating personalized advisory through DigitalNIC, 
<li>400+ total Tickets closed in the year 2022 as part of Guide & Handhold NIC teams to stay secure with OSS, the 
<li>5+ VA moderation & Exemption requests were processed to keep the OSS systems operational and 
<li>on the capacity building front 10 programs were held.</li></ul>
</p>
<!--
<p>In terms of metrics 28 customized templates for Base OS, web and Database stack were made, 36 RPMs & 96 DEB Packages for PHP, PostgreSQL, Apache HTTPD, Apache Tomcat, Python, OpenSSL, 6 Update Tools to upgrade to latest version (PHP, PostgreSQL, Apache HTTPD, Apache Tomcat, OpenSSL) for CentOS 7, 10 customized and hardened ISO Images, 4 QCOW2 Images for Open Stack, 368+ updates for 25 OSS tools were carried out to OSS Metadata on the OSS Tools repository for generating personalized advisory through DigitalNIC, 400+ total Tickets closed in the year 2022 as part of Guide & Handhold NIC teams to stay secure with OSS, the 5+ VA moderation & Exemption requests were processed to keep the OSS systems operational and on the capacity building front 10 programs were held.</p>
-->

				<!--Services Offered:
				<ul><li>Compliance to OSS Policy ( OSS Stack, OSS adhearance & enabling SoPs, Roadmaps, Best Practice documents are being relesed )</li>
                                <li>OSS repository & Cloud Datacentre Support ( Guiding SoPs, Roadmaps, Cheatsheets, metadata updates, ISOs/Updates/RPMs for CentOS, Templates/Updates/DEBs for Ubuntu, RPMs/Updates on OSS tools on RHEL are being released )</li>
                                <li>OSS Security support ( VA guidance, VA clearance, CVEs evaluation, metadata updates/releases/downloads software update alerts are being provided )</li>
                                <li>OSS Servicedesk support ( Service support calls through NIC ServiceDesk are addressed )</li>
				<li>Capacity building on open source ( Periodical and on-demand capacity building programmes conducted online and offline)</li> </ul>
<br/>
				Milestones (as on 15th February 2021):
				<ul><li><strong>1361 CentOS VMs</strong> used by e-Governance Project teams in VMware Cloud.</li>
                                <li><strong>126 Ubuntu VMs</strong> used by e-Governance Project teams in VMware Cloud.</li>
                                <li><strong>6557 RHEL VMs</strong> used by e-Governance Project teams in VMware Cloud.</li>
                                <li><strong>12601 Participants trained through 134 Courses</strong> conducted for e-Governance Project teams.</li>
</ul>
<br/><br/>
-->
<div>
<br/><br/>
<br/><br/>
	   <strong>Contact :</strong>
<table><tr><td>Open Technology Group</td></tr>
<tr><td>National Informatics Centre</td></tr>
<tr><td>A2B, First Floor, A wing, Rajaji Bhawan,</td></tr>
<tr><td>Besant Nagar, Chennai 600 090, Tamilnadu.</td></tr>
<tr><td>Email : otghelpdesk[at]nic[dot]in</td></tr>
<tr><td>Telephone : 044-24460509, 044-24908119</td></tr></table>
	  </div><br/>
				<br/>
				
				
				<br/>
			</div>
			
			
			</div>
		 </div>
							
		
		
	</div>	
	
		
		
		<br/>
		
	</form>
	
	
</div>
	  <br/>
		
		
	  
		
	  </div>
			  
        </main>
      </div>
    </div>
<br/>
<br/>
	<?php
	include 'sign-in.php'; 
if($sso_flag== '0'){
			include 'common/footer_landingpage.php'; 
}
elseif($sso_flag== '1'){
			include 'common/footer.php'; 
}
		?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/chartjs.js"></script>
	<script src="js/jmespath.min.js"></script>
    <script src="js/jquery-ui.js"></script>
	<script src="assets/js/ossfunctionality.js"></script>
	
    <script>
$(document).ready(function(){
	loadmenuitems();
	$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
		$("#sm-sidebar-wrapper").addClass("sm-toggled");
    });
});
</script>
<style>


/*tr:nth-child(even) { background-color: #f2f2f2; }*/

th {
	background-color: #F0F0F0;
	color: #808080;
}

.card-header {
	padding: 1.75rem 1.25rem !important;
}

</style>
  </body>
</html>
