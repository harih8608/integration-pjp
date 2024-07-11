function loadmenuitems()
{
	var menuaccordwrap ="";
	var menuaccord="";
	var menu2accord="";
	var menu3accord="";
	var submenuaccordwrap="";
	var submenuaccord="";
	var submenu2accord="";
	var submenu3accord="";
	var usermenu="";
	var roleid = sessionStorage.getItem('userroleid');
	var jwtflag = sessionStorage.getItem('jwtstatus');
	
	if(roleid != '4')
	{ usermenu = "menulist.json";}
else
	{ usermenu = "menulist_staff.json";
	
}
	menuaccordwrap = menuaccordwrap + '<div class="navbar-nav ml-auto"><a href="index.php" class="nav-item"><img src="images/home1.png" title="home"></img></a>';
	
	$.ajax(
	usermenu, 
{
    dataType: 'json', // type of response data
    success: function (data,status,xhr) {   
	$.each(data['menuList'], function (index, datamitems) {
				if (datamitems.submenu1.length > 0 )//if has submenus
			{
				menuaccord = menuaccord + '<div class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle font-weight-bold" data-toggle="dropdown" title="'+datamitems.title+'">'+datamitems.type+'</a><div class="dropdown-menu" id="'+datamitems.type.split(" ").join("")+'">';
				for(i = 0; i < datamitems.submenu1.length; i++){
					if(datamitems.submenu1[i].submenu2.length > 0){
						menu2accord = menu2accord + '<div class="nav-item dropdown-submenu"><a href="#" class="nav-link dropdown-toggle text-teal" data-toggle="dropdown-submenu" title="'+datamitems.submenu1[i].title+'">'+datamitems.submenu1[i].type+'</a><div class="dropdown-content" id="'+datamitems.submenu1[i].type.split(" ").join("")+'">';
						for(j = 0; j < datamitems.submenu1[i].submenu2.length; j++){
						submenu2accord = submenu2accord+ '<a href="'+datamitems.submenu1[i].submenu2[j].href+'" class="dropdown-item text-purple" title="'+datamitems.submenu1[i].submenu2[j].title+'">'+datamitems.submenu1[i].submenu2[j].type+'</a>';
						}
						menu2accord = menu2accord+submenu2accord + '</div></div>';
						submenu2accord="";
						
					}
					else{
						menu2accord = menu2accord + '<a href="'+datamitems.submenu1[i].href+'" class="dropdown-item nav-link  text-teal'+datamitems.submenu1[i].color+'" title="'+datamitems.submenu1[i].title+'">'+datamitems.submenu1[i].type+'</a>';
					}
					
					//menu2accord  = menu2accord + '<a href="'+datamitems.submenu1[i].href+'" class="dropdown-item" title="'+datamitems.submenu1[i].title+'">'+datamitems.submenu1[i].type+'</a>';
				}
				//alert(submenuaccord);
				menuaccord = menuaccord + menu2accord + '</div></div>';
				menu2accord = "";
			}
			else
			{
				menuaccord = menuaccord + '<a href="'+datamitems.href+'" class="nav-item nav-link font-weight-bold '+datamitems.color+'" title="'+datamitems.title+'">'+datamitems.type+'</a>';
			}
		
			});
//menuaccordwrap = menuaccordwrap + menuaccord + '<a href="coding/logout.php?logout" class="name nav-item nav-link" style="text-decoration: none !important; color:#f4780b;font-weight:bold;"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></div>';
//menuaccordwrap = menuaccordwrap + menuaccord + '<a href="index.php?feedback" class="name nav-item nav-link" style="text-decoration: none !important; color:#f4780b;font-weight:bold;"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></div>';

//commented for feedback on logout code change

if(jwtflag == '1' && roleid !=4)
{
	//menuaccordwrap = menuaccordwrap + menuaccord + '<a href="index.php?logoutbacktodigital" class="name nav-item nav-link" style="text-decoration: none !important; color:#f4780b;font-weight:bold;"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Back to digital.nic</a></div>';
	menuaccordwrap = menuaccordwrap + menuaccord + '<a href="index.php?feedback" class="name nav-item nav-link" style="text-decoration: none !important; color:#f4780b;font-weight:bold;"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Back to digital.nic</a></div>';
}
else
{
	//menuaccordwrap = menuaccordwrap + menuaccord + '<a href="index.php?logout" class="name nav-item nav-link" style="text-decoration: none !important; color:#f4780b;font-weight:bold;"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></div>';
	menuaccordwrap = menuaccordwrap + menuaccord + '<a href="index.php?feedback" class="name nav-item nav-link" style="text-decoration: none !important; color:#f4780b;font-weight:bold;"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></div>';

}


			//console.log(menu3accord);
			//$("#navbarCollapse").html("");
			$("#navbarCollapse").append(menuaccordwrap);


	   /*if(data['menuList'].length > 0)
	   {
		   for(i = 0; i < data['menuList'].length; i++) { 
			$('#cardslist').append('<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 pb-3 "> <a class="card card-block custom-card m-auto justify-content-center '+data["menuList"][i].tile+'" href="'+data["menuList"][i].href+'"><div class="card-body align-items-center d-flex m-auto text-center"><span class="card-title text-white text-uppercase">'+data["menuList"][i].type+'</span></div></a></div>'); 
			}
	   }*/
    },
    error: function (jqXhr, textStatus, errorMessage) { // error callback 
        $('p').append('Error: ' + errorMessage);
    }
});

var coll = document.getElementsByClassName("collapsible");
	var i;

	for (i = 0; i < coll.length; i++) {
	  coll[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var content = this.nextElementSibling;
		if (content.style.maxHeight){
		  content.style.maxHeight = null;
		} else {
		  content.style.maxHeight = content.scrollHeight + "px";
		  content.style.borderBottom = "1px solid #bfbfbf";
		} 
	  });
	}

}
$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

function loadmenuitems_old_with_leftmenu()
{
	var menuaccordwrap ="";
	var menuaccord="";
	var submenuaccord="";
	menuaccordwrap = menuaccordwrap + '<div class="just-padding"><div class="list-group list-group-root well">';
	$.ajax('menulist.json', 
{
    dataType: 'json', // type of response data
    success: function (data,status,xhr) {   // success callback function
	//console.log(data);
       //$("#menulist").append('<li><a href="/user/messages"><span class="tab">Message Center</span></a></li>');
	   //var obj = JSON.parse(data);
	   //console.log(data['menuList']);
	  /*$.each(data['menuList'], function (index, data) { $("#menulist").append('<li class="nav-item text-black"><a class="nav-link" href="'+data.href+'" title="'+data.title+'"><span class="tab">'+data.type+'</span></a></li>'); })
	   if(data['menuList'].length > 0){
	   for(i = 0; i < data['menuList'].length; i++) { 
		$('#cardslist').append('<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 pb-3 "> <a class="card card-block custom-card m-auto justify-content-center '+data["menuList"][i].tile+'" href="'+data["menuList"][i].href+'"><div class="card-body align-items-center d-flex m-auto text-center"><span class="card-title text-white text-uppercase">'+data["menuList"][i].type+'</span></div></a></div>'); 
	}
	   }*/
	   		$.each(data['menuList'], function (index, datamitems) {
				

			if (datamitems.submenu1.length > 0 )
			{
				menuaccord = menuaccord + '<a href="#'+datamitems.type.split(" ").join("")+'" class="list-group-item" data-toggle="collapse" title="'+datamitems.title+'"><i class="glyphicon glyphicon-chevron-right"></i>'+datamitems.type+'</a><div class="list-group collapse" id="'+datamitems.type.split(" ").join("")+'">';
				for(i = 0; i < datamitems.submenu1.length; i++) {
					
					submenuaccord = submenuaccord+ '<a href="'+datamitems.submenu1[i].href+'" class="list-group-item" title="'+datamitems.submenu1[i].title+'">'+datamitems.submenu1[i].type+'</a>';
				}
				menuaccord = menuaccord + submenuaccord + '</div>';
				submenuaccord = "";
			}
			else
			{
				menuaccord = menuaccord + '<a href="'+datamitems.href+'" class="list-group-item" title="'+datamitems.title+'">'+datamitems.type+'</a>';
			}
			
			
			
			
			
			
			});
menuaccordwrap = menuaccordwrap + menuaccord + '</div></div>';
			//alert(menuaccordwrap);
			$("#navbarCollapse").append(menuaccordwrap);


	   /*if(data['menuList'].length > 0)
	   {
		   for(i = 0; i < data['menuList'].length; i++) { 
			$('#cardslist').append('<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 pb-3 "> <a class="card card-block custom-card m-auto justify-content-center '+data["menuList"][i].tile+'" href="'+data["menuList"][i].href+'"><div class="card-body align-items-center d-flex m-auto text-center"><span class="card-title text-white text-uppercase">'+data["menuList"][i].type+'</span></div></a></div>'); 
			}
	   }*/
    },
    error: function (jqXhr, textStatus, errorMessage) { // error callback 
        $('p').append('Error: ' + errorMessage);
    }
});

var coll = document.getElementsByClassName("collapsible");
	var i;

	for (i = 0; i < coll.length; i++) {
	  coll[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var content = this.nextElementSibling;
		if (content.style.maxHeight){
		  content.style.maxHeight = null;
		} else {
		  content.style.maxHeight = content.scrollHeight + "px";
		  content.style.borderBottom = "1px solid #bfbfbf";
		} 
	  });
	}

}
$('.list-group-item').on('click', function() {
    $('.glyphicon', this)
      .toggleClass('glyphicon-chevron-right')
      .toggleClass('glyphicon-chevron-down');
  });
function loadfuncdomainddwn(meta_data)
{
var functionalDomain = jmespath.search(meta_data,"functionalDomain[].name");
functionalDomain = functionalDomain.sort(function(x,y){ 
      var a = String(x).toUpperCase(); 
      var b = String(y).toUpperCase(); 
      if (a > b) 
         return 1 
      if (a < b) 
         return -1 
      return 0; 
    }); 
var funcdom = $('#SelectFuncDomain_card');
funcdom.empty();
funcdom.append('<option selected="true" value="0" style="font-weight: bold;">Select Functional Domain</option>');
for ( i in functionalDomain )
{
	functionalDomainCurrent = functionalDomain[i];
	funcdom.append('<option value="' + (parseInt(i)+1) + '">' + functionalDomainCurrent + '</option>');
}

}

function loadtools(meta_data)
{
var Tools = jmespath.search(meta_data,"ossTools[].toolName");
Tools = Tools.sort(function(x,y){ 
      var a = String(x).toUpperCase(); 
      var b = String(y).toUpperCase(); 
      if (a > b) 
         return 1 
      if (a < b) 
         return -1 
      return 0; 
    }); 
var toolid = $('#SelectTool');
toolid.empty();
toolid.append('<option selected="true" value="0" style="font-weight: bold;" disabled>Select Tools</option>');
for ( i in Tools )
{
	currtool = Tools[i];
	toolid.append('<option value="' + (parseInt(i)+1) + '">' + currtool + '</option>');
}

}
function loadtools_card(meta_data)
{
var Tools = jmespath.search(meta_data,"ossTools[].toolName");
Tools = Tools.sort(function(x,y){ 
      var a = String(x).toUpperCase(); 
      var b = String(y).toUpperCase(); 
      if (a > b) 
         return 1 
      if (a < b) 
         return -1 
      return 0; 
    }); 
var toolid = $('#SelectTool_card');
toolid.empty();
toolid.append('<option selected="true" value="0" style="font-weight: bold;" disabled>Select Tools</option>');
for ( i in Tools )
{
	currtool = Tools[i];
	toolid.append('<option value="' + (parseInt(i)+1) + '">' + currtool + '</option>');
}

}

function sitemap()
{
	var menuaccord="";
	var menu2accord="";
	var submenuaccordwrap="";
	var submenuaccord="";
	var submenu2accord="";
	var pagelist="";
	$.ajax('menulist.json', 
{
    dataType: 'json', // type of response data
    success: function (data,status,xhr) {   // success callback function
	//console.log(data);
       //$("#menulist").append('<li><a href="/user/messages"><span class="tab">Message Center</span></a></li>');
	   //var obj = JSON.parse(data);
	   //console.log(data['menuList']);
	   //$.each(data['menuList'], function (index, data) { $("#sitemapjsonmenu").append('<li class="leaf"><a href="'+data.href+'" title="'+data.title+'">'+data.type+'</a></li>'); })
	   
	   
	   $.each(data['menuList'], function (index, datamitems) {
			if (datamitems.submenu1.length > 0 )
			{
				menuaccord = menuaccord + '<li class="leaf"><a href="'+datamitems.href+'" title="'+datamitems.title+'">'+datamitems.type+'</a><ul class="">';
				for(i = 0; i < datamitems.submenu1.length; i++) {
					if(datamitems.submenu1[i].submenu2.length > 0){
						menu2accord = menu2accord + '<li class="leaf"><a href="'+datamitems.submenu1[i].href+'" title="'+datamitems.submenu1[i].title+'">'+datamitems.submenu1[i].type+'</a></li><ul class="">';
						for(j = 0; j < datamitems.submenu1[i].submenu2.length; j++){
					submenu2accord = submenu2accord+ '<li class="leaf"><a href="'+datamitems.submenu1[i].submenu2[j].href+'" title="'+datamitems.submenu1[i].submenu2[j].title+'">'+datamitems.submenu1[i].submenu2[j].type+'</a></li>';
					//pagelist = pagelist+ '<a href="'+datamitems.submenu1[i].href+'" class="list-group-item" title="'+datamitems.submenu1[i].title+'">'+datamitems.submenu1[i].type+'</a>';
						}
						menu2accord = menu2accord+submenu2accord + '</ul></li>';
						submenu2accord="";
					}
					else{
						menu2accord = menu2accord+ '<li class="leaf"><a href="'+datamitems.submenu1[i].href+'" title="'+datamitems.submenu1[i].title+'">'+datamitems.submenu1[i].type+'</a></li>';
					}
				}
				menuaccord = menuaccord + menu2accord + '</ul></li>';
				menu2accord="";
			}
			else
			{
				menuaccord = menuaccord+ '<li class="leaf"><a href="'+datamitems.href+'" title="'+datamitems.title+'">'+datamitems.type+'</a></li>';
				//menuaccord = menuaccord + '<a href="'+datamitems.href+'" class="list-group-item" title="'+datamitems.title+'">'+datamitems.type+'</a>';
			}
			});
	   $("#sitemapjsonmenu").append(menuaccord);
	   //console.log(menuaccord);
	}

	   ,
    error: function (jqXhr, textStatus, errorMessage) { // error callback 
        $('p').append('Error: ' + errorMessage);
    }
	
});
}
function dateymd_to_dmy(datearg)
{
	var receiveddate = String(datearg);
	var retdmydate="";
	//alert(typeof receivedversionlinks);
	var stringarr;
	//alert("received date "+ datearg);
	if(receiveddate != "" && receiveddate != "undefined")
	{
		stringarr = receiveddate.split('-');
		//alert(versionlinksarr.length);	
		retdmydate = stringarr[2]+'-'+stringarr[1]+'-'+stringarr[0];
		//alert("return else date "+ retdmydate);
	}
	else
	{
		retdmydate = '-';
		//alert("return if date "+ retdmydate);
	}
	//alert(rethtml);
	//retdmydate = retdmydate.substring(0, retdmydate.length - 7);
	//rethtml = rethtml.trim(',');
	//alert(rethtml);
	return retdmydate.toString();
	
}

function setMajverbtnId(toolname,majver)
{
	var retbtnId;
	var gottoolname = String(toolname);
	gottoolname = gottoolname.split(" ").join("");
	//alert("trimmed tool name "+ gottoolname);
	retbtnId = gottoolname+'-'+majver;
	return retbtnId;
}
function setversionlinks(versionlinkstxt)
{
	//alert(typeof versionlinkstxt);
	var receivedversionlinks = String(versionlinkstxt);
	var rethtml="";
	//alert(typeof receivedversionlinks);
	var versionlinksarr = receivedversionlinks.split(',');
	//alert(versionlinksarr.length);
	
	for(i in versionlinksarr)
	{
		rethtml=rethtml + "<a href=\""+versionlinksarr[i]+"\" target=\"_blank\">" + versionlinksarr[i] + "</a>,&nbsp;&nbsp;";
	}
	//alert(rethtml);
	rethtml = rethtml.substring(0, rethtml.length - 13);
	//rethtml = rethtml.trim(',');
	//alert(rethtml);
	return rethtml.toString();
}

function nodearrayvalues(nodearray)
{
	var indexvalues="";
	for(j in nodearray)
	{
		indexvalues = indexvalues + nodearray[j]+", ";
	}
	indexvalues = indexvalues.slice(0, -2);
	return indexvalues;
}

function remarks(remarkarg)
{
	var receivedremark = String(remarkarg);
	var retremark="";
	if(receivedremark != "" && receivedremark != "undefined")
	{
		retremark = receivedremark;
	}
	else
	{
		retremark = '-';
	}
	return retremark.toString();
}

function getroleid()
{
	var roleid="";
	$.ajax({
        type: "GET",
    url: 'getrol.php',
    success: function(data){

		roleid = data;
    },		
        error: function(error) { alert("received php role error "); }
    });
	return roleid;
}

function selectOneRequest(data,choiceOption,roleid,userid) 
{
	// jQuery

	//******tooltip downloaded
var accorhtml="";
// Select the OSS Tool
var currentTool = jmespath.search(data, "ossTools[?toolName=='" + choiceOption + "']");
//var colourCodes = ["GREEN","AMBER","RED" ] ;
var colourCodes = ["PaleGreen","LightSkyBlue" ] ;
//console.log("currentTool-------------------" + JSON.stringify(currentTool,null,4));
//console.log("currentTool-------------------" + currentTool[0].infoAsOn);
var majorVersions = jmespath.search(currentTool[0],"majorVersions[]")
var advisory = JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update[0]"), null,4);
//console.log("Advisory :"+ JSON.stringify(advisory,null,4));
//accorhtml = accorhtml + "<div class=\"accordion\"><div class=\"acctool\" style=\"font-size:14px; color:#00008b;\">" + choiceOption + "&nbsp;(<strong class=\"accvers\" style=\"color:\#00994C;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='GREEN'].minorVersion | []"))	+"</strong>)<span class=\"lastupd\" style=\"float:right;height:auto;color:teal;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;\"><p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"et\" style=\"\">&nbsp;&nbsp;<img src=\"images/advisory6.png\" style=\"height:25px;\" ></img>&nbsp;&nbsp;<div class=\"et-left et-arrow\" id=\"ttcontent\" style=\" font-size:12px;position:absolute;z-index:10;\"><i>Advisory</i> <br/> Upgrade : "+advisory+"</div></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></p>"

accorhtml = accorhtml + "<div class=\"accordion\"><div class=\"acctool\" style=\"font-size:14px;background-color:#82298c;\">" + choiceOption + "&nbsp;(<strong class=\"accvers\" style=\"color:white;font-weight:bold;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='PaleGreen'].minorVersion | []"))	+"</strong>)<span class=\"lastupd\" style=\"float:right;height:auto;color:white;font-weight:bold;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;background-color:#f2e6ff;\"><p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue(choiceOption)+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><img src=\"assets/icons_round/download.png\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"et\" style=\"\">&nbsp;&nbsp;<img src=\"images/advisory6.png\" style=\"height:25px;\" ></img>&nbsp;&nbsp;<div class=\"et-left et-arrow\" id=\"ttcontent\" style=\" font-size:12px;position:absolute;z-index:10;\"><i>Advisory</i> <br/> Upgrade : "+advisory+"</div></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></p>"

//accorhtml = accorhtml + "<div class=\"accordion\"><div class=\"acctool\" style=\"font-size:14px; color:#00008b;\">" + choiceOption + "&nbsp;(<strong class=\"accvers\" style=\"color:\#00994C;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='GREEN'].minorVersion | []"))	+"</strong>)<span class=\"lastupd\" style=\"float:right;height:auto;color:teal;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;\"><p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue(choiceOption)+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><img src=\"images/download1.gif\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"et\" style=\"\">&nbsp;&nbsp;<img src=\"images/advisory6.png\" style=\"height:25px;\" ></img>&nbsp;&nbsp;<div class=\"et-left et-arrow\" id=\"ttcontent\" style=\" font-size:12px;position:absolute;z-index:10;\"><i>Advisory</i> <br/> Upgrade : "+advisory+"</div></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'subscribe.php\';return false;\" target=\"_blank\"><img src=\"images/subscribe.png\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></p>"

				//<div class="et">Hover me<div class="et-bottom" id="ttcontent">Its Advisory</div></div></br>

	accorhtml = accorhtml + "<div><table class=\"advisory table table-bordered table-hover table-condensed\"><tbody><tr><th style=\"background-color:#f2e6ff;\">Functional Domain </th><td> " + currentTool[0].functionalDomain +"</td></tr>"
	accorhtml = accorhtml + "<tr><th style=\"background-color:#f2e6ff;\">Stack Relevance </th><td> "+nodearrayvalues(currentTool[0].stackRelevance)+"</td></tr>"
	accorhtml = accorhtml + "<tr><th style=\"background-color:#f2e6ff;\">License </th><td> " +nodearrayvalues(currentTool[0].license)+"</td></tr>"
	//accorhtml = accorhtml + "<tr><th>Digital Nic Id </th><td> " +currentTool[0].digitalNicId+"</td></tr>"
	//accorhtml = accorhtml  + "<tr><th>Community URL </th><td style=\"word-break: break-all;\">"+setversionlinks(currentTool[0].communityURL) + "</td></tr>"
	//accorhtml = accorhtml  + "<tr><th>Version Information Link </th><td style=\"word-break: break-all;\"> " + setversionlinks(currentTool[0].versionInformationLink) + "</td></tr>"
	
	//  find versions of tool

	//console.log("digital Nic id : "+currentTool[0].digitalNicId);
	// For each majorVersion find number of Minor Versions with GREEN,AMBER and RED
	for ( color in colourCodes ){
		//console.log(colourCodes[color]);
		// var colorCount = jmespath.search(majorVersions,"[].minorVersions[?colourCode==']" + colourCodes[color] + "']")
		var colorCurrentList = 	jmespath.search(majorVersions,"[].minorVersions[?colourCode=='" + colourCodes[color] +"'].minorVersion | []");				
		var colorCount = jmespath.search(majorVersions,"[].minorVersions[?colourCode=='" + colourCodes[color] +"'].minorVersion | length([])");
		
	 //console.log("minorVersions : " + colorCount );
	 //console.log("minorVersions : " + colorCurrentList );
	 
	
	 if ( colorCount > 0 && colourCodes[color] == "PaleGreen")
//	 accorhtml = accorhtml + colourCodes[color] + "<p>Number of Minor Versions:" + colorCount + "</p><p>Latest Version " + colorCurrentList + "</p>"
		 accorhtml = accorhtml  + "<tr style=\"color:#059405;\"><th style=\"background-color:#f2e6ff;\"> Latest Version</th><td>    <strong>" + seggregate(colorCurrentList) + "&nbsp;&nbsp;&nbsp;</strong></td></tr>"
	 else if (colorCount > 0 && colourCodes[color] == "LightSkyBlue" ) 
	  accorhtml = accorhtml + "<tr style=\"color:#375e97;\"><th style=\"background-color:#f2e6ff;\">Still Supported Version(s) </th><td style=\"word-break: break-all;\"> <strong> (" + colorCount + ")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong class=\"comment more\">" + seggregate(colorCurrentList) + "</strong></td></tr>"
	 else if (colorCount > 0 && colourCodes[color] == "#ff4d4d"  )
	  accorhtml = accorhtml + colourCodes[color] + "<tr style=\"color:#ff0000;\"><th style=\"background-color:#f2e6ff;\">UnSupported Versions</th><td style=\"word-break: break-all;\"> <strong> (" + colorCount + ")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong>" + seggregate(colorCurrentList) + "</strong></td></tr>"
	// todisplay = todisplay + colourCodes[color] + ":" + colorCount + " "

	}

	accorhtml = accorhtml + "</tbody></table></div><br/>"+getcolornote()+"<br/>"+majorminoraccordions(data,choiceOption)+"</div></div>"
				
	//console.log(toolNameList);
//accorhtml = accorhtml + "</div></div>"

//console.log(accorhtml);
return(accorhtml);
}
//for Chatbot
function selectOneRequest_forCB(data,choiceOption,roleid,userid) 
{
	// jQuery

	//******tooltip downloaded
var accorhtml="";
// Select the OSS Tool
var currentTool = jmespath.search(data, "ossTools[?toolId=='" + choiceOption + "']");
//var colourCodes = ["GREEN","AMBER","RED" ] ;
var colourCodes = ["PaleGreen","LightSkyBlue" ] ;
//console.log("currentTool-------------------" + JSON.stringify(currentTool,null,4));
//console.log("currentTool-------------------" + currentTool[0].infoAsOn);
var majorVersions = jmespath.search(currentTool[0],"majorVersions[]")
var advisory = JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update[0]"), null,4);
//console.log("Advisory :"+ JSON.stringify(advisory,null,4));
//accorhtml = accorhtml + "<div class=\"accordion\"><div class=\"acctool\" style=\"font-size:14px; color:#00008b;\">" + choiceOption + "&nbsp;(<strong class=\"accvers\" style=\"color:\#00994C;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='GREEN'].minorVersion | []"))	+"</strong>)<span class=\"lastupd\" style=\"float:right;height:auto;color:teal;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;\"><p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"et\" style=\"\">&nbsp;&nbsp;<img src=\"images/advisory6.png\" style=\"height:25px;\" ></img>&nbsp;&nbsp;<div class=\"et-left et-arrow\" id=\"ttcontent\" style=\" font-size:12px;position:absolute;z-index:10;\"><i>Advisory</i> <br/> Upgrade : "+advisory+"</div></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></p>"

accorhtml = accorhtml + "<div class=\"accordion\"><div class=\"acctool\" style=\"font-size:14px;background-color:#82298c;\">" + choiceOption + "&nbsp;(<strong class=\"accvers\" style=\"color:white;font-weight:bold;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='PaleGreen'].minorVersion | []"))	+"</strong>)<span class=\"lastupd\" style=\"float:right;height:auto;color:white;font-weight:bold;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;background-color:#f2e6ff;\">"

//accorhtml = accorhtml + "<div class=\"accordion\"><div class=\"acctool\" style=\"font-size:14px; color:#00008b;\">" + choiceOption + "&nbsp;(<strong class=\"accvers\" style=\"color:\#00994C;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='GREEN'].minorVersion | []"))	+"</strong>)<span class=\"lastupd\" style=\"float:right;height:auto;color:teal;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;\"><p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue(choiceOption)+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><img src=\"images/download1.gif\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"et\" style=\"\">&nbsp;&nbsp;<img src=\"images/advisory6.png\" style=\"height:25px;\" ></img>&nbsp;&nbsp;<div class=\"et-left et-arrow\" id=\"ttcontent\" style=\" font-size:12px;position:absolute;z-index:10;\"><i>Advisory</i> <br/> Upgrade : "+advisory+"</div></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'subscribe.php\';return false;\" target=\"_blank\"><img src=\"images/subscribe.png\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></p>"

				//<div class="et">Hover me<div class="et-bottom" id="ttcontent">Its Advisory</div></div></br>

	accorhtml = accorhtml + "<div><table class=\"advisory table table-bordered table-hover table-condensed\"><tbody><tr><th style=\"background-color:#f2e6ff;\">Functional Domain </th><td> " + currentTool[0].functionalDomain +"</td></tr>"
	accorhtml = accorhtml + "<tr><th style=\"background-color:#f2e6ff;\">Stack Relevance </th><td> "+nodearrayvalues(currentTool[0].stackRelevance)+"</td></tr>"
	accorhtml = accorhtml + "<tr><th style=\"background-color:#f2e6ff;\">License </th><td> " +nodearrayvalues(currentTool[0].license)+"</td></tr>"
	//accorhtml = accorhtml + "<tr><th>Digital Nic Id </th><td> " +currentTool[0].digitalNicId+"</td></tr>"
	//accorhtml = accorhtml  + "<tr><th>Community URL </th><td style=\"word-break: break-all;\">"+setversionlinks(currentTool[0].communityURL) + "</td></tr>"
	//accorhtml = accorhtml  + "<tr><th>Version Information Link </th><td style=\"word-break: break-all;\"> " + setversionlinks(currentTool[0].versionInformationLink) + "</td></tr>"
	
	//  find versions of tool

	//console.log("digital Nic id : "+currentTool[0].digitalNicId);
	// For each majorVersion find number of Minor Versions with GREEN,AMBER and RED
	for ( color in colourCodes ){
		//console.log(colourCodes[color]);
		// var colorCount = jmespath.search(majorVersions,"[].minorVersions[?colourCode==']" + colourCodes[color] + "']")
		var colorCurrentList = 	jmespath.search(majorVersions,"[].minorVersions[?colourCode=='" + colourCodes[color] +"'].minorVersion | []");				
		var colorCount = jmespath.search(majorVersions,"[].minorVersions[?colourCode=='" + colourCodes[color] +"'].minorVersion | length([])");
		
	 //console.log("minorVersions : " + colorCount );
	 //console.log("minorVersions : " + colorCurrentList );
	 
	
	 if ( colorCount > 0 && colourCodes[color] == "PaleGreen")
//	 accorhtml = accorhtml + colourCodes[color] + "<p>Number of Minor Versions:" + colorCount + "</p><p>Latest Version " + colorCurrentList + "</p>"
		 accorhtml = accorhtml  + "<tr style=\"color:#059405;\"><th style=\"background-color:#f2e6ff;\"> Latest Version</th><td>    <strong>" + seggregate(colorCurrentList) + "&nbsp;&nbsp;&nbsp;</strong></td></tr>"
	 else if (colorCount > 0 && colourCodes[color] == "LightSkyBlue" ) 
	  accorhtml = accorhtml + "<tr style=\"color:#375e97;\"><th style=\"background-color:#f2e6ff;\">Still Supported Version(s) </th><td style=\"word-break: break-all;\"> <strong> (" + colorCount + ")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong class=\"comment more\">" + seggregate(colorCurrentList) + "</strong></td></tr>"
	 else if (colorCount > 0 && colourCodes[color] == "#ff4d4d"  )
	  accorhtml = accorhtml + colourCodes[color] + "<tr style=\"color:#ff0000;\"><th style=\"background-color:#f2e6ff;\">UnSupported Versions</th><td style=\"word-break: break-all;\"> <strong> (" + colorCount + ")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong>" + seggregate(colorCurrentList) + "</strong></td></tr>"
	// todisplay = todisplay + colourCodes[color] + ":" + colorCount + " "

	}

	accorhtml = accorhtml + "</tbody></table></div><br/>"+getcolornote_forCB()+"<br/></div></div>"
				
	//console.log(toolNameList);
//accorhtml = accorhtml + "</div></div>"

//console.log(accorhtml);
return(accorhtml);
}
function selectOneRequest_stktable_adv(data,choiceOption,roleid,userid) 
{
	// jQuery

	//******tooltip downloaded
var accorhtml="";
// Select the OSS Tool
var currentTool = jmespath.search(data, "ossTools[?toolName=='" + choiceOption + "']");
//var colourCodes = ["GREEN","AMBER","RED" ] ;
var colourCodes = ["PaleGreen","LightSkyBlue" ] ;
//console.log("currentTool-------------------" + JSON.stringify(currentTool,null,4));
//console.log("currentTool-------------------" + currentTool[0].infoAsOn);
var majorVersions = jmespath.search(currentTool[0],"majorVersions[]")
var advisory = JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update[0]"), null,4);
//console.log("Advisory :"+ JSON.stringify(advisory,null,4));
accorhtml = accorhtml + "<div class=\"\"><div class=\"acctool\" style=\"font-size:14px; color:white;background-color:#82298c;\">" + choiceOption + "&nbsp;(<strong class=\"accvers\" style=\"color:white;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='PaleGreen'].minorVersion | []"))	+"</strong>)<span class=\"lastupd\" style=\"float:right;height:auto;color:white;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;background-color:#f2e6ff;\">"


	accorhtml = accorhtml + "<div style=\"font-size:15px;\"><table class=\"table table-bordered table-hover table-condensed\"><tbody><tr><th style=\"background-color:#f2e6ff;\">Functional Domain </th><td> " + currentTool[0].functionalDomain +"</td></tr>"
	accorhtml = accorhtml + "<tr><th style=\"background-color:#f2e6ff;\">Stack Relevance </th><td> "+nodearrayvalues(currentTool[0].stackRelevance)+"</td></tr>"
	accorhtml = accorhtml + "<tr><th style=\"background-color:#f2e6ff;\">License </th><td> " +nodearrayvalues(currentTool[0].license)+"</td></tr>"
	//accorhtml = accorhtml + "<tr><th style=\"background-color:#f2e6ff;\">Digital Nic Id </th><td> " +currentTool[0].digitalNicId+"</td></tr>"
	//accorhtml = accorhtml  + "<tr><th style=\"background-color:#f2e6ff;\">Community URL </th><td style=\"word-break: break-all;\">"+setversionlinks(currentTool[0].communityURL) + "</td></tr>"
	//accorhtml = accorhtml  + "<tr><th style=\"background-color:#f2e6ff;\">Version Information Link </th><td style=\"word-break: break-all;\"> " + setversionlinks(currentTool[0].versionInformationLink) + "</td></tr>"
	
	//  find versions of tool

	//console.log("digital Nic id : "+currentTool[0].digitalNicId);
	// For each majorVersion find number of Minor Versions with GREEN,AMBER and RED
	for ( color in colourCodes ){
		//console.log(colourCodes[color]);
		// var colorCount = jmespath.search(majorVersions,"[].minorVersions[?colourCode==']" + colourCodes[color] + "']")
		var colorCurrentList = 	jmespath.search(majorVersions,"[].minorVersions[?colourCode=='" + colourCodes[color] +"'].minorVersion | []");				
		var colorCount = jmespath.search(majorVersions,"[].minorVersions[?colourCode=='" + colourCodes[color] +"'].minorVersion | length([])");
		
	 //console.log("minorVersions : " + colorCount );
	 //console.log("minorVersions : " + colorCurrentList );
	 
	
	 if ( colorCount > 0 && colourCodes[color] == "PaleGreen")
//	 accorhtml = accorhtml + colourCodes[color] + "<p>Number of Minor Versions:" + colorCount + "</p><p>Latest Version " + colorCurrentList + "</p>"
		 accorhtml = accorhtml  + "<tr style=\"color:#2d8655;\"><th style=\"background-color:#f2e6ff;\"> Latest Version</th><td>    <strong>" + seggregate(colorCurrentList) + "&nbsp;&nbsp;&nbsp;</strong></td></tr>"
	 else if (colorCount > 0 && colourCodes[color] == "LightSkyBlue" ) 
	  accorhtml = accorhtml + "<tr style=\"color:#375e97;\"><th style=\"background-color:#f2e6ff;\">Still Supported Version(s) </th><td style=\"word-break: break-all;\"> <strong> (" + colorCount + ")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong class=\"comment more\">" + seggregate(colorCurrentList) + "</strong></td></tr>"
	 else if (colorCount > 0 && colourCodes[color] == "#ff4d4d"  )
	  accorhtml = accorhtml + colourCodes[color] + "<tr style=\"color:#ff0000;\"><th style=\"background-color:#f2e6ff;\">UnSupported Versions</th><td style=\"word-break: break-all;\"> <strong> (" + colorCount + ")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong>" + seggregate(colorCurrentList) + "</strong></td></tr>"
	// todisplay = todisplay + colourCodes[color] + ":" + colorCount + " "

	}

	accorhtml = accorhtml + "</tbody></table></div><br/>"+getcolornote()+"<br/></div></div>"
				
	//console.log(toolNameList);
//accorhtml = accorhtml + "</div></div>"

//console.log(accorhtml);
return(accorhtml);
}
function getcolornote()
{
	var colornotes = "<div class=\"clearfix\" style=\"color:#808080;\"><div class=\"colornote float-right\"><ul><li><div class=\"input-color\"><span class=\"textgreen\">Latest</span><div class=\"color-box green\"></div></div></li><li><div class=\"input-color\"><span class=\"textamber\">Still Supported</span><div class=\"color-box amber\"></div></div></li><li><div class=\"input-color\"><span class=\"textred\">NOT Supported</span><div class=\"color-box red\"></div></div></li></ul></div></div>";
	return colornotes;
}
function getcolornote_forCB()
{
	var colornotes = "<div class=\"clearfix\" style=\"color:#808080;\"><div class=\"colornote float-right\"><ul><li><div class=\"input-color\"><span class=\"textgreen\" style=\"color: #00994c !important;\">Latest</span><div class=\"color-box green\"></div></div></li><li><div class=\"input-color\"><span class=\"textamber\" style=\"color: #375e97 !important;\">Still Supported</span><div class=\"color-box amber\"></div></div></li><li><div class=\"input-color\"><span class=\"textred\" style=\"color: #ff0000 !important;\">NOT Supported</span><div class=\"color-box red\"></div></div></li></ul></div></div>";
	return colornotes;
}
function getadvcolornote()
{
	var colornotes = "<div class=\"clearfix\" style=\"color:#808080;\"><div class=\"colornote float-right\"><ul><li><div class=\"input-color\"><span class=\"textgreen\">Latest</span><div class=\"color-box green\"></div></div></li><li><div class=\"input-color\"><span class=\"textamber\">Still Supported</span><div class=\"color-box amber\"></div></div></li><li><div class=\"input-color\"><span class=\"textred\">NOT Supported</span><div class=\"color-box red\"></div></div></li></ul></div></div>";
	return colornotes;
}
function readmore(stillsuppVers)
{
	var retspacedstring="";
	var stringarr = String(stillsuppVers).split(',');
		//alert(versionlinksarr.length);	
	for (a=0; a < 4; a++)
	{
		retspacedstring = retspacedstring + stringarr[a]+", ";
	}
	retspacedstring = retspacedstring.trim();
	retspacedstring = retspacedstring.substring(0, retspacedstring.length - 1);
	return retspacedstring;
}

function encodevalue(value)
{
	//alert(toolname);
	var encodedval = window.btoa(value);
	//alert(encodedval);
	return encodedval;
}
function seggregate(versions_string)
{
	var retspacedstring="";
	var stringarr = String(versions_string).split(',');
		//alert(versionlinksarr.length);	
	for (a=0; a < stringarr.length; a++)
	{
		retspacedstring = retspacedstring + stringarr[a]+", ";
	}
	retspacedstring = retspacedstring.trim();
	retspacedstring = retspacedstring.substring(0, retspacedstring.length - 1);
	return retspacedstring;
}
function seggregatebrac_comma(versions)
{
	var retspacedstring="";
	versions_string = String(versions);
	//alert(versions_string);
	if(versions_string != "null"){
		versions_string = versions_string.split("[").join("");
		versions_string = versions_string.split("]").join("");
		versions_string = versions_string.split("\"").join("");
		versions_string = versions_string.split(" ").join("");
		versions_string = versions_string.split("\n").join("");
		versions_string = versions_string.split(",").join(", ");
		retspacedstring = versions_string;
		/*var stringarr = String(versions_string).split(',');
		for (a=0; a < stringarr.length; a++)
		{
			retspacedstring = retspacedstring + stringarr[a]+", ";
		}*/
		//alert(retspacedstring);
		retspacedstring = retspacedstring.trim();
		//retspacedstring = retspacedstring.substring(0, retspacedstring.length - 1);
	}
	else{
		retspacedstring = "";
	}
	return retspacedstring;
}

function disonetool(searchbyelement,htmltext) {

$("#"+searchbyelement).empty().append(htmltext);
$(".accordion").accordion();

$(function() {

  $(".accordion").accordion({
    collapsible: false,
    active: false,
heightStyle:"content"	
  });
});
}

function disoneaccordion(searchbyelement,htmltext) {

$("#"+searchbyelement).empty().append(htmltext);
$(".accordion").accordion();

$(function() {

  $(".accordion").accordion({
    collapsible: true,
    active: false,
heightStyle:"content"	
  });
  var icons = $(".accordion").accordion("option", "icons");
  $('.open').click(function() {
    $('.ui-accordion-header').removeClass('ui-corner-all').addClass('ui-accordion-header-active ui-state-active ui-corner-top').attr({
      'aria-selected': 'true',
      'tabindex': '0'
    });
    $('.ui-accordion-header-icon').removeClass(icons.header).addClass(icons.headerSelected);
    $('.ui-accordion-content').addClass('ui-accordion-content-active').attr({
      'aria-expanded': 'true',
      'aria-hidden': 'false'
    }).show();
    $(this).attr("disabled", "disabled");
    $('.close').removeAttr("disabled");
  });
  $('.close').click(function() {
    $('.ui-accordion-header').removeClass('ui-accordion-header-active ui-state-active ui-corner-top').addClass('ui-corner-all').attr({
      'aria-selected': 'false',
      'tabindex': '-1'
    });
    $('.ui-accordion-header-icon').removeClass(icons.headerSelected).addClass(icons.header);
    $('.ui-accordion-content').removeClass('ui-accordion-content-active').attr({
      'aria-expanded': 'false',
      'aria-hidden': 'true'
    }).hide();
    $(this).attr("disabled", "disabled");
    $('.open').removeAttr("disabled");
  });
  $('.ui-accordion-header').click(function() {
    $('.open').removeAttr("disabled");
    $('.close').removeAttr("disabled");

  });
});


}

function disoneaccordion_expanded(searchbyelement,htmltext,clickedelementid) {

$("#"+searchbyelement).empty().append(htmltext);
$("#"+clickedelementid).parent('div').parent('div').parent('div').parent('div').parent('div').collapsible({collapsed: false});
}

function majorminoraccordions(data, toolname)
{
	var currentTool = jmespath.search(data, "ossTools[?toolName=='"+toolname+"']");
	var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var majminaccords ="";
	for (k in majorVersions)
	{
	//majminaccords = majminaccords + "<div class=\"card-header\"><h5 class=\"mb-0\"><a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" href=\"#collapse-0-0\" aria-expanded=\"false\" aria-controls=\"collapse-0-0\"><table class=\"majVertable fit\"><tbody><tr><th>Major Version </th><td> " + majorVersions[k].majorVersion +"</td></tr>"
	//majminaccords = majminaccords + "<tr><th>End of Life </th><td> "+majorVersions[k].advisory.endOfLife+"</td></tr></tbody></table></a></h5></div>"
	majminaccords = majminaccords + "<button type=\"button\" id=\""+setMajverbtnId(toolname,majorVersions[k].majorVersion)+"\" title=\"Get all minor version details\" class=\"btn btn-default border border-light\" data-toggle=\"modal\" data-target=\"#minorVersionsModal\" onclick=\"onmajVerbtnclick(this.id,\'"+toolname+"\',\'"+majorVersions[k].majorVersion+"\')\"><div class=\"majVersion table-responsive\"><table class=\"table table-bordered\"><tbody><tr><th style=\"background-color:"+getmajcolor(data,this.id,toolname, majorVersions[k].majorVersion)+";\">Major Version </th><td style=\"color:black;\"> " + majorVersions[k].majorVersion +"</td></tr>"
	majminaccords = majminaccords + "<tr><th style=\"background-color:"+getmajcolor(data,this.id,toolname, majorVersions[k].majorVersion)+";\">End of Life </th><td style=\"color:black;\"> "+dateymd_to_dmy(majorVersions[k].advisory.endOfLife)+"</td></tr>"
	majminaccords = majminaccords + "<tr><th style=\"background-color:"+getmajcolor(data,this.id,toolname, majorVersions[k].majorVersion)+"; \">Advisory</th><td  style=\"color:black;\"> Update: "+ remarks(majorVersions[k].advisory.update)+"<br/>Upgrade: "+remarks(majorVersions[k].advisory.upgrade)+"</td></tr></tbody></table></div></button>"
	}
	return majminaccords;
}

function getdocstring(darr)
{	var docarr = darr;
	var dstr="";
	for (i in docarr) {
		
		dstr=dstr + "<a href=\""+docarr[i].downloadURL+"\" target=\"_blank\" style=\"color:#00bfff;\">" + docarr[i].documentName + "</a>,&nbsp;&nbsp;";
	}
	dstr = dstr.trim();
	dstr = dstr.substring(0, dstr.length - 13);
	return dstr;
}
function getmajcolor(data1,clickedid, selectedtoolname, majVersion )
{
	var meta_data;
	meta_data = data1;
	var Row = document.getElementById(clickedid);
	var currentTool = jmespath.search(meta_data, "ossTools[?toolName=='" + selectedtoolname + "']");
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var minors ="";
	var greencnt, ambercnt, redcnt;
	greencnt = ambercnt = redcnt=0;
	
	for (a=0; a < majorVersions.length; a++)
	{
		if(majorVersions[a].majorVersion == majVersion)
		{
			minors = majorVersions[a].minorVersions;
			for(b=0; b < minors.length; b++) {
				//var count = Object.keys(minors[b]).length;
				
				/*for(d in minors[b])
				{
					if(d == "colourCode")
					{
						//minversaccordhtml = minversaccordhtml + "<tr style=\"color:"+setcolor(minors[b][d])+";\">";
						if(minors[b][d] == "GREEN")
						{ return setcolor(minors[b][d]);}
						if(minors[b][d] == "AMBER")
						{ return setcolor(minors[b][d]);}
						if(minors[b][d] == "#ff4d4d")
						{ return setcolor(minors[b][d]);}
					}
				}*/
				if(minors[b].colourCode == "PaleGreen")
				{greencnt =1;}
				if(minors[b].colourCode == "LightSkyBlue")
				{ambercnt =1;}
				if(minors[b].colourCode == "#ff4d4d")
				{redcnt =1;}
			}
			if(greencnt == 1)
			{ return setmajbgopacitycolor("PaleGreen");}
			if(ambercnt == 1)
			{ return setmajbgopacitycolor("LightSkyBlue");}
			if(redcnt == 1)
			{ return setmajbgopacitycolor("#ff4d4d");}
			
		}
	}
				
}

//onclick=\"onmajVerbtnclick(this.id,\""+toolname+"\",\""+majorVersions[k].majorVersion+"\")\"
function onmajVerbtnclick(clickedid, selectedtoolname, majVersion )
{
	var meta_data;
	var documentsstring="";
	$('.accordion').collapse();
	meta_data = getmetadata();
	//var majverclicked = $(this).attr('id');
	//alert("clicked version "+clicked_id);
	//alert("td value 1 "+$("#"+clicked_id).next().next().next().next('tr').find("td:eq(1)").val());
	var Row = document.getElementById(clickedid);
	var Cells = Row.getElementsByTagName("td");
	var currentTool = jmespath.search(meta_data, "ossTools[?toolName=='" + selectedtoolname + "']");
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var minors ="";
	var minversaccordhtml="";
	var minversaccordhtml_h = "";
	var minversaccordhtml_b = "";
	var minversmaxnodeindx=0;
	var minversnodecount=0;
	var endofuseflag = 0;
	document.getElementById("minVerSelectedTool").innerHTML = "Tool :  <strong>"+selectedtoolname+"</strong>";
	document.getElementById("minVerSelectedToolMajVer").innerHTML = "Major Version : <strong>"+majVersion+"</strong>";
	
	/*for(b=0;b < documents.length ; b++)
	{
		alert(documents[b].documentName);
		alert(documents[b].downloadURL);
		alert(documents[b].docType);
	}*/
	
	
	for (a=0; a < majorVersions.length; a++)
	{
		if(majorVersions[a].majorVersion == majVersion)
		{
			documentsstring = getdocstring( majorVersions[a].advisory.documents);
			if(documentsstring != "")
			{
				document.getElementById("majVerDocuments").innerHTML = "Documents : "+documentsstring;
			}
			else
			{
				document.getElementById("majVerDocuments").innerHTML = "Documents : -	";
			}
			minors = majorVersions[a].minorVersions;
			minversaccordhtml = minversaccordhtml + "<div class=\"minVersions\"><table class=\"table table-bordered table-hover table-condensed\"><tbody><tr>";
			minversaccordhtml_h = minversaccordhtml_h+"<th>Minor Version</th><th>Release Date</th><th>End Of Use</th><th>Remarks</th>"
				minversaccordhtml = minversaccordhtml + minversaccordhtml_h+"</tr>";
			for(b=0; b < minors.length; b++) {
				var count = Object.keys(minors[b]).length;
				var minversionnode,releaseDatenode,endOfUsenode,remarksnode;
				minversionnode = releaseDatenode = endOfUsenode = remarksnode ="";
				/*
				//table header as per nodes
				if(minversnodecount < count)
				{
					minversnodecount = count;
					minversmaxnodeindx = b;
					minversaccordhtml_h = "";
					for(c in minors[b])
					{
						if(c != "colourCode")
						{
							minversaccordhtml_h = minversaccordhtml_h+"<th>" + c +"</th>"
						}
						
					}
					minversaccordhtml = minversaccordhtml + minversaccordhtml_h+"</tr>";
					
				}
				//minversaccordhtml = minversaccordhtml + "<tr>";
				for(d in minors[b])
				{
					if(d == "colourCode")
					{
						minversaccordhtml = minversaccordhtml + "<tr style=\"color:"+setcolor(minors[b][d])+";\">";
					}
				}
				for(d in minors[b])
				{
					if(d != "colourCode")
					{
						minversaccordhtml = minversaccordhtml + "<td> "+mindateymd_to_dmy(minors[b][d])+"</td>"
					}
				}
				minversaccordhtml = minversaccordhtml+"</tr>";
				
				*/
				/////////default table header starts
				
				/*if(minversnodecount < count)
				{
					minversnodecount = count;
					minversmaxnodeindx = b;
					minversaccordhtml_h = "";
					for(c in minors[b])
					{
						if(c != "colourCode")
						{
							minversaccordhtml_h = minversaccordhtml_h+"<th>" + c +"</th>"
						}
						
					}
					minversaccordhtml = minversaccordhtml + minversaccordhtml_h+"</tr>";
					
				}
				*/
				
				//minversaccordhtml = minversaccordhtml + "<tr>";
				for(d in minors[b])
				{
					if(d == "colourCode")
					{
						minversaccordhtml = minversaccordhtml + "<tr style=\"color:"+setcolor(minors[b][d])+";\">";
					}
				}
				for(d in minors[b])
				{
					if(d == "minorVersion")
					{
						minversionnode = "<td> "+mindateymd_to_dmy(minors[b][d])+"</td>";
					}
					else if(d == "releaseDate")
					{
						releaseDatenode = "<td> "+mindateymd_to_dmy(minors[b][d])+"</td>";
					}
					else if(d == "endOfUse")
					{
						endofuseflag =1;
						if((String)(minors[b][d]).toUpperCase() == "TRUE")
						{
							endOfUsenode = "<td> Yes </td>";
						}
						else if((String)(minors[b][d]).toUpperCase() == "FALSE")
						{
							endOfUsenode = "<td> - </td>";
						}
					}
					else if(d == "colourCode")
					{
					
					}
					else
					{
						remarksnode = remarksnode +d+" : "+mindateymd_to_dmy(minors[b][d])+"<br/>";
					}
					
				}
				
				//minversaccordhtml = minversaccordhtml +"<th>"+minors[b].minorVersion+"</th><th>"+dateymd_to_dmy(minors[b].releaseDate)+"</th><th>"+minors[b].endOfUse+"</th><th>"
				minversaccordhtml = minversaccordhtml + minversionnode+ releaseDatenode+ ((endofuseflag)? endOfUsenode : endOfUsenode ="<td> - </td>") + "<td>"+remarksnode+"</td></tr>";
				
				
				
				/////////default table header ends
				
				//minversaccordhtml_h = minversaccordhtml_h+"<th>" + c +"</th>"
				//minversaccordhtml = minversaccordhtml+ "</tr></tbody></table></div>";
				
				//minvers accordion starts
				/*minversaccordhtml = minversaccordhtml + "<div class=\"\"><h6 style=\"color:#808080;\">" + minors[b].minorVersion + "</h6><div class=\"card-body\" style=\"overflow-wrap: break-word;\">"

				minversaccordhtml = minversaccordhtml + "<div><table class=\"table table-bordered table-hover table-condensed\"><tbody><tr><th>Minor Version</th><td> " + minors[b].minorVersion +"</td></tr>"
				minversaccordhtml = minversaccordhtml + "<tr><th>Release Date</th><td> "+dateymd_to_dmy(minors[b].releaseDate)+"</td></tr>"
				minversaccordhtml = minversaccordhtml + "<tr><th>End of Life </th><td> " +dateymd_to_dmy(minors[b].endOfLife)+"</td></tr>"
				minversaccordhtml = minversaccordhtml + "<tr><th>Remark</th><td> " +remarks(minors[b].remark)+"</td></tr>"
				minversaccordhtml = minversaccordhtml + "</tbody></table></div></div></div>"
				//minvers accordion ends
				*/
				/*minversaccordhtml = minversaccordhtml + "<div><table class=\"table table-bordered table-hover table-condensed\"><tbody><tr><th>Minor Version</th><td> " + minors[b].minorVersion +"</td></tr>"
				minversaccordhtml = minversaccordhtml + "<tr><th>Release Date</th><td> "+dateymd_to_dmy(minors[b].releaseDate)+"</td></tr>"
				minversaccordhtml = minversaccordhtml + "<tr><th>End of Life </th><td> " +dateymd_to_dmy(minors[b].endOfLife)+"</td></tr>"
				minversaccordhtml = minversaccordhtml + "<tr><th>Remark</th><td> " +remarks(minors[b].remark)+"</td></tr>"
				minversaccordhtml = minversaccordhtml + "</tbody></table></div>"
				*/
			}
			minversaccordhtml = minversaccordhtml + "</tbody></table><br/><div ><br> <a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'disclaimer.php\';return false;\" target=\"_blank\">Disclaimer</a></div></div>";
		}
		
		//alert("max nodes minvers index is "+minversmaxnodeindx);
		//for (b in minors){
		
	}
	//alert("index "+minversmaxnodeindx+" nodecount "+minversnodecount);
	//disoneaccordion("minVerAccordionForSelectedTool",minversaccordhtml);
	disoneaccordion_expanded("minVerAccordionForSelectedTool",minversaccordhtml, clickedid);

}

function versioncheck_old(meta_data,roleid,userid)
{
	//version_recommend_status($("#versioncheckitem").val(), $("#SelectVersionNo").find(":selected").text());
	$("#versioncheckeditem").html('');
	var currentTool = jmespath.search(meta_data, "ossTools[?toolName=='" + $("#versioncheckitem").val() + "']");
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var advisory="";
	var minors ="";
	var tooldownload="";
	var minorversionselected = $("#SelectVersionNo").find(":selected").text();
	var setupdatetxt="";
	for (a=0; a < majorVersions.length; a++)
	{
		minors = majorVersions[a].minorVersions;
		//for (b in minors){
		for(b=0; b < minors.length; b++) {
			if( minors[b].minorVersion == minorversionselected )
			{
				//static color
				//advisory ="<span style=\"color:"+getcolor(seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4)))+";\">Update : " + seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4))+"</span>";
				//advisory = advisory +"<br/><span style=\"color:#00994C;\">Upgrade : "+ seggregatebrac_comma(JSON.stringify(jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4))+"</span>";
				
				advisory ="" +getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)))+"</span>";
				advisory = advisory +"<br/>"+getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				
				
				//advisory ="<span style=\"color:"+$("#SelectVersionNo option[value='"+jmespath.search(majorVersions,"["+a+"].advisory.update[0]")+"']").text()+";\">Update : " + seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4))+"</span>";
				//advisory ="<span>Update : " + seggregatebrac_comma(jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4)+"</span>";
				//advisory = advisory +"<br/><span>Upgrade : "+ seggregatebrac_comma(  jmespath.search(majorVersions,"["+a+"].advisory.upgrade[0]"), null,4)+"</span>";
				
				//setupdatetxt = setupgradetext(advisory, $("#SelectVersionNo").find(":selected").text());
				if((minors[b].colourCode).trim() == "LightSkyBlue" )
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is still supported <br/><u>Advisory</u> <br/>"+advisory);
					$("#versioncheckeditem").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "PaleGreen")
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is latest");
					$("#versioncheckeditem").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "#ff4d4d")
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is not latest <br/><u>Advisory</u> <br/>"+advisory);
					$("#versioncheckeditem").css('color','#ff0000');
					
				}
				break;
			}
			else if( minors[b].minorVersions == $("#SelectVersionNo").find(":selected").text() )
			{
				//advisory ="<span style=\"color:"+getcolor(seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4)))+";\">Update : " + seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4))+"</span>";
				//advisory = advisory +"<br/><span style=\"color:#00994C;\">Upgrade : "+ seggregatebrac_comma(JSON.stringify(jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4))+"</span>";
				
				advisory ="<span style=\"color:#808080;\">" +getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)))+"</span>";
				advisory = advisory +"<br/><span style=\"color:#808080;\">"+getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				
				//setupdatetxt = setupgradetext(advisory, $("#SelectVersionNo").find(":selected").text());
				if((minors[b].colourCode).trim() == "LightSkyBlue" )
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is still supported <br/><u>Advisory</u> <br/>"+advisory);
					$("#versioncheckeditem").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "PaleGreen")
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is latest");
					$("#versioncheckeditem").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "#ff4d4d")
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is not latest <br/><u>Advisory</u> <br/>"+advisory);
					$("#versioncheckeditem").css('color','#ff0000');
					
				}	
			break;				
			}
		}
		
	}
	$("#versioncheckeditem").show();
	$("#SelectedAdvisory").val($("#versioncheckeditem").val());
	
	tooldownload ="<p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue($("#versioncheckitem").val())+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><img src=\"assets/icons_round/download.png\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'subscribe.php\';return false;\" target=\"_blank\"><img src=\"images/subscribe.png\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"#\" onclick=\"sendemail()\"><img src=\"assets/img/share1.png\" id=\"shareveradvisory\" style=\"height:25px;\" title=\"share to mail\"/></a></div></p>";
	//http://ossrepository.gov.in/toollister/?tool=
	
	$("#ToolDownload").empty().append(tooldownload);
	
	
}
function versioncheck(meta_data,roleid,userid)
{
	//version_recommend_status($("#versioncheckitem").val(), $("#SelectVersionNo").find(":selected").text());
	$("#versioncheckeditem").html('');
	var currentTool = jmespath.search(meta_data, "ossTools[?toolName=='" + $("#versioncheckitem").val() + "']");
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var advisory="";
	var advisory_upgrade="";
	var advisory_update="";
	var interim="";
	var minors ="";
	var tooldownload="";
	var minorversionselected = $("#SelectVersionNo").find(":selected").text();
	var setupdatetxt="";
	for (a=0; a < majorVersions.length; a++)
	{
		minors = majorVersions[a].minorVersions;
		//for (b in minors){
		for(b=0; b < minors.length; b++) {
			if( minors[b].minorVersion == minorversionselected )
			{
				//static color
				//advisory ="<span style=\"color:"+getcolor(seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4)))+";\">Update : " + seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4))+"</span>";
				//advisory = advisory +"<br/><span style=\"color:#00994C;\">Upgrade : "+ seggregatebrac_comma(JSON.stringify(jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4))+"</span>";
				
				//advisory ="" +getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)))+"</span>";
				//advisory = advisory +""+getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				
				//advisory_update ="";
				advisory_update = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)));
				interim= advisory_update+"</span>";
				//advisory_upgrade ="";
				advisory_upgrade = getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				
				//advisory ="<span style=\"color:"+$("#SelectVersionNo option[value='"+jmespath.search(majorVersions,"["+a+"].advisory.update[0]")+"']").text()+";\">Update : " + seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4))+"</span>";
				//advisory ="<span>Update : " + seggregatebrac_comma(jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4)+"</span>";
				//advisory = advisory +"<br/><span>Upgrade : "+ seggregatebrac_comma(  jmespath.search(majorVersions,"["+a+"].advisory.upgrade[0]"), null,4)+"</span>";
				
				//setupdatetxt = setupgradetext(advisory, $("#SelectVersionNo").find(":selected").text());
				if((minors[b].colourCode).trim() == "LightSkyBlue" )
				{
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is still supported. You may update this as an interim measure. </b><br/><br/>However you are advised to upgrade/update to <b style=\"color:#00994c;\">Version "+advisory+"</b><b style=\"color:#375e97;\">*</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "PaleGreen")
				{
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is latest. </b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "#ff4d4d")
				{
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";

					if(advisory_update != "")
					{
						interim = advisory_update+"<span style=\"color:#375e97;\"> is still supported. You may update this as an interim measure.<br/>However you are advised to migrate to Version "+advisory+"</span><b style=\"color:#375e97;\">*</b>";
					}
					else
					{
						interim="";
					}
					
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is NOT SUPPORTED.</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#ff0000');
					
				}
				break;
			}
			else if( minors[b].minorVersions == $("#SelectVersionNo").find(":selected").text() )
			{
				//advisory ="<span style=\"color:"+getcolor(seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4)))+";\">Update : " + seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4))+"</span>";
				//advisory = advisory +"<br/><span style=\"color:#00994C;\">Upgrade : "+ seggregatebrac_comma(JSON.stringify(jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4))+"</span>";
				
				//advisory ="<span style=\"color:#808080;\">" +getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)))+"</span>";
				//advisory = advisory +"<span style=\"color:#808080;\">"+getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				//advisory_update ="";
				advisory_update = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)));
				interim= advisory_update+"</span>";
				//advisory_upgrade ="";
				advisory_upgrade = getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				//setupdatetxt = setupgradetext(advisory, $("#SelectVersionNo").find(":selected").text());
				if((minors[b].colourCode).trim() == "LightSkyBlue" )
				{	
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is still supported. You may update this as an interim measure. </b><br/><br/>However you are advised to upgrade/update to <b style=\"color:#00994c;\">Version "+advisory+"</b><b style=\"color:#375e97;\">*</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "PaleGreen")
				{
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is latest. </b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "#ff4d4d")
				{
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";
					
					if(advisory_update != "")
					{
						interim = advisory_update+"<span style=\"color:#375e97;\"> is still supported. You may update this as an interim measure.<br/>However you are advised to migrate to Version "+advisory+"</span><b style=\"color:#375e97;\">*</b>";
					}
					else
					{
						interim="";
					}
					
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is NOT SUPPORTED.</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#ff0000');
					
				}	
			break;				
			}
		}
		
	}
	$("#versioncheckeditem").removeClass('text-left');
	$("#versioncheckeditem").addClass('text-center');
	$("#versioncheckeditem").show();
	$("#SelectedAdvisory").val($("#versioncheckeditem").val());
	/*//$("#shareveradvisory").show();
	
	//tooldownload ="<p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'https://ossrepository.gov.in/toollister/tools/index.php?tool="+encodevalue($("#versioncheckitem").val())+"\';return false;\" target=\"_blank\"><img src=\"images/download1.gif\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'subscribe.php\';return false;\" target=\"_blank\"><img src=\"images/subscribe.png\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"#\" onclick=\"sendemail()\"><img src=\"assets/img/share1.png\" id=\"shareveradvisory\" style=\"height:25px;\" title=\"share to mail\"/></a></div></p>";
	//http://ossrepository.gov.in/toollister/?tool=
	
	$("#ToolDownload").empty().append(tooldownload);*/
	advisorybtns= "<button class=\"advbtn_download m-1\" title=\"Download tool's latest version\" type=\"button\" onclick=\"window.open(\'\',\'_blank\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue($("#versioncheckitem").val())+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><i class=\"fa fa-download\"></i> Download</button><button id=\"Subscribe_tool\" class=\"advbtn_sub_share m-1 d-none\" title=\"Subscribe for advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#SubscribeModal\" type=\"button\" onclick=\"subscribeclick('" + $("#versioncheckitem").val() + "','"+currentTool[0].toolId+"','"+userid+"','"+roleid+"');\"><i class=\"fa fa-bell\"></i> Subscribe</button><button id=\"Unsubscribe_tool\" class=\"advbtn_sub_share m-1 d-none\" title=\"Unsubscribe for advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#UnsubscribeModal\" type=\"button\" onclick=\"unsubscribeclick('" + $("#versioncheckitem").val() + "','"+currentTool[0].toolId+"','"+userid+"','"+roleid+"');\"><i class=\"fa fa-bell\"></i> Unsubscribe</button>";
	
	$("#advisory_btns").empty();
	$("#advisory_btns").append(advisorybtns);
	//advisorysubscribebtn= getsubscribestatus($("#versioncheckitem").val(), currentTool[0].toolId,userid,roleid);
	getsubscribestatus($("#versioncheckitem").val(), currentTool[0].toolId,userid,roleid);
	advisorysharebtn = "<button id=\"SharetoMail\" class=\"advbtn_sub_share m-1\" title=\"Share this advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#ShareModal\" type=\"button\" onclick=\"sharetomail();\"><i class=\"fa fa-share\"></i> Share</button>";
	//$("#advisory_btns").append(advisorysubscribebtn);
	$("#advisory_btns").append(advisorysharebtn);
	$("#SelectedTool").empty();
	$("#SelectedTool").append($("#versioncheckitem").val());
	$("#advisory_btns").addClass("d-block");
	
}
function homepageversioncheck(meta_data,roleid,userid)
{
	//version_recommend_status($("#versioncheckitem").val(), $("#SelectVersionNo").find(":selected").text());
	$("#versioncheckeditem_card").html('');
	var currentTool = jmespath.search(meta_data, "ossTools[?toolName=='" + $("#versioncheckitem_card").val() + "']");
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var advisory="";
	var advisory_upgrade="";
	var advisory_update="";
	var interim="";
	var minors ="";
	var tooldownload="";
	var minorversionselected = $("#SelectVersionNo_card").find(":selected").text();
	var setupdatetxt="";
	for (a=0; a < majorVersions.length; a++)
	{
		minors = majorVersions[a].minorVersions;
		//for (b in minors){
		for(b=0; b < minors.length; b++) {
			if( minors[b].minorVersion == minorversionselected )
			{
				//static color
				//advisory ="<span style=\"color:"+getcolor(seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4)))+";\">Update : " + seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4))+"</span>";
				//advisory = advisory +"<br/><span style=\"color:#00994C;\">Upgrade : "+ seggregatebrac_comma(JSON.stringify(jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4))+"</span>";
				
				//advisory ="" +getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)))+"</span>";
				//advisory = advisory +""+getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				
				//advisory_update ="";
				advisory_update = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)));
				interim= advisory_update+"</span>";
				
				//advisory_upgrade ="";
				advisory_upgrade = getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				
				//advisory ="<span style=\"color:"+$("#SelectVersionNo option[value='"+jmespath.search(majorVersions,"["+a+"].advisory.update[0]")+"']").text()+";\">Update : " + seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4))+"</span>";
				//advisory ="<span>Update : " + seggregatebrac_comma(jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4)+"</span>";
				//advisory = advisory +"<br/><span>Upgrade : "+ seggregatebrac_comma(  jmespath.search(majorVersions,"["+a+"].advisory.upgrade[0]"), null,4)+"</span>";
				
				//setupdatetxt = setupgradetext(advisory, $("#SelectVersionNo").find(":selected").text());
				if((minors[b].colourCode).trim() == "LightSkyBlue" )
				{
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";
					$("#versioncheckeditem_card").html("<b>"+$("#versioncheckitem_card").val()+" version "+ $("#SelectVersionNo_card").find(":selected").text() +" is still supported. You may update this as an interim measure. </b><br/><br/>However you are advised to upgrade/update to <b style=\"color:#00994c;\">Version "+advisory+"</b><b style=\"color:#375e97;\">*</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem_card").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "PaleGreen")
				{
					$("#versioncheckeditem_card").html("<b>"+$("#versioncheckitem_card").val()+" version "+ $("#SelectVersionNo_card").find(":selected").text() +" is latest. </b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem_card").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "#ff4d4d")
				{
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";

					if(advisory_update != "")
					{
						interim = advisory_update+"<span style=\"color:#375e97;\"> is still supported. You may update this as an interim measure.<br/>However you are advised to migrate to Version "+advisory+"</span><b style=\"color:#375e97;\">*</b>";
					}
					else
					{
						interim="";
					}
					
					$("#versioncheckeditem_card").html("<b>"+$("#versioncheckitem_card").val()+" version "+ $("#SelectVersionNo_card").find(":selected").text() +" is NOT SUPPORTED.</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem_card").css('color','#ff0000');
					
				}
				break;
			}
			else if( minors[b].minorVersions == $("#SelectVersionNo_card").find(":selected").text() )
			{
				//advisory ="<span style=\"color:"+getcolor(seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4)))+";\">Update : " + seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4))+"</span>";
				//advisory = advisory +"<br/><span style=\"color:#00994C;\">Upgrade : "+ seggregatebrac_comma(JSON.stringify(jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4))+"</span>";
				
				//advisory ="<span style=\"color:#808080;\">" +getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)))+"</span>";
				//advisory = advisory +"<span style=\"color:#808080;\">"+getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				//advisory_update ="";
				advisory_update = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)));
				interim = advisory_update+"</span>";
				
				//advisory_upgrade ="";
				advisory_upgrade = getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				//setupdatetxt = setupgradetext(advisory, $("#SelectVersionNo").find(":selected").text());
				if((minors[b].colourCode).trim() == "LightSkyBlue" )
				{	
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";
					$("#versioncheckeditem_card").html("<b>"+$("#versioncheckitem_card").val()+" version "+ $("#SelectVersionNo_card").find(":selected").text() +" is still supported. You may update this as an interim measure. </b><br/><br/>However you are advised to upgrade/update to <b style=\"color:#00994c;\">Version "+advisory+"</b><b style=\"color:#375e97;\">*</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem_card").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "PaleGreen")
				{
					$("#versioncheckeditem_card").html("<b>"+$("#versioncheckitem_card").val()+" version "+ $("#SelectVersionNo_card").find(":selected").text() +" is latest. </b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem_card").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "#ff4d4d")
				{
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";

					if(advisory_update != "")
					{
						interim = advisory_update+"<span style=\"color:#375e97;\"> is still supported. You may update this as an interim measure.<br/>However you are advised to migrate to Version "+advisory+"</span><b style=\"color:#375e97;\">*</b>";
					}
					else
					{
						interim="";
					}
					
					$("#versioncheckeditem_card").html("<b>"+$("#versioncheckitem_card").val()+" version "+ $("#SelectVersionNo_card").find(":selected").text() +" is NOT SUPPORTED.</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/>"+$("#versioncheckeditem_hid").html()+"<br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem_card").css('color','#ff0000');
					
				}	
			break;				
			}
		}
		
	}
	$("#versioncheckeditem_card").removeClass('text-left');
	$("#versioncheckeditem_card").addClass('text-center');
	$("#versioncheckeditem_card").show();
	
	/*//$("#shareveradvisory").show();
	
	//tooldownload ="<p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'https://ossrepository.gov.in/toollister/tools/index.php?tool="+encodevalue($("#versioncheckitem").val())+"\';return false;\" target=\"_blank\"><img src=\"images/download1.gif\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'subscribe.php\';return false;\" target=\"_blank\"><img src=\"images/subscribe.png\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"#\" onclick=\"sendemail()\"><img src=\"assets/img/share1.png\" id=\"shareveradvisory\" style=\"height:25px;\" title=\"share to mail\"/></a></div></p>";
	//http://ossrepository.gov.in/toollister/?tool=
	
	$("#ToolDownload").empty().append(tooldownload);*/
	
	advisorybtns= "<button class=\"advbtn_download m-1\" title=\"Download tool's latest version\" type=\"button\" onclick=\"window.open(\'\',\'_blank\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue($("#versioncheckitem_card").val())+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><i class=\"fa fa-download\"></i> Download</button><button id=\"Subscribe_tool_card\" class=\"advbtn_sub_share m-1 d-none\" title=\"Subscribe for advisory on "+$("#versioncheckitem_card").val()+"\" data-toggle=\"modal\" data-target=\"#SubscribeModal_card\" type=\"button\" onclick=\"$(this).subscribeclick_card('" + $("#versioncheckitem_card").val() + "','"+currentTool[0].toolId+"','"+userid+"','"+roleid+"');\"><i class=\"fa fa-bell\"></i> Subscribe</button><button id=\"Unsubscribe_tool_card\" class=\"advbtn_sub_share m-1 d-none\" title=\"Unsubscribe for advisory on "+$("#versioncheckitem_card").val()+"\" data-toggle=\"modal\" data-target=\"#UnsubscribeModal_card\" type=\"button\" onclick=\"$(this).unsubscribeclick_card('" + $("#versioncheckitem_card").val() + "','"+currentTool[0].toolId+"','"+userid+"','"+roleid+"');\"><i class=\"fa fa-bell\"></i> Unsubscribe</button>";
	
	$("#advisory_btns_card").empty();
	$("#advisory_btns_card").append(advisorybtns);
	//advisorysubscribebtn= getsubscribestatus($("#versioncheckitem").val(), currentTool[0].toolId,userid,roleid);
	getsubscribestatus_card($("#versioncheckitem_card").val(), currentTool[0].toolId,userid,roleid);
	advisorysharebtn = "<button id=\"SharetoMail_card\" class=\"advbtn_sub_share m-1\" title=\"Share this advisory on "+$("#versioncheckitem_card").val()+"\" data-toggle=\"modal\" data-target=\"#ShareModal_card\" type=\"button\" onclick=\"sharetomail_card();\"><i class=\"fa fa-share\"></i> Share</button>";
	//$("#advisory_btns").append(advisorysubscribebtn);
	$("#advisory_btns_card").append(advisorysharebtn);
	$("#SelectedTool_card").empty();
	$("#SelectedTool_card").append($("#versioncheckitem_card").val());
	$("#advisory_btns_card").addClass("d-block");
	/*$("#SelectedTool").empty();
	$("#SelectedTool").append($("#versioncheckitem").val());
	$("#advisory_btns").addClass("d-block");
	*/
	
	
}
function sharetomail_card(){
	/*$("#SelectedAdvisory").html('');
	$("#SelectedAdvisory").html($("#versioncheckeditem").html());
	//$("#shareontool").html($("#versioncheckitem").val());
	//$("#shareonversion").html($("#SelectVersionNo").find(":selected").text());
	var destination = $('#SelectedAdvisory').eq(0);
    var source = $('#versioncheckeditem')[0];

    for (i = 0; i < source.attributes.length; i++)
    {
        var a = source.attributes[i];
        destination.attr(a.name, a.value);
    }
	//$("#SelectedAdvisory").children('div').css('background-color','black');
	*/
	/*var src = $("#versioncheckeditem").html();
	var dest = $("#SelectedAdvisory").html(src);
	*/
	$("#SelectedAdvisory_card").html('');
	$("#versioncheckeditem_card").clone().appendTo($("#SelectedAdvisory_card"));
	}
function sharetomail(){
	/*$("#SelectedAdvisory").html('');
	$("#SelectedAdvisory").html($("#versioncheckeditem").html());
	//$("#shareontool").html($("#versioncheckitem").val());
	//$("#shareonversion").html($("#SelectVersionNo").find(":selected").text());
	var destination = $('#SelectedAdvisory').eq(0);
    var source = $('#versioncheckeditem')[0];

    for (i = 0; i < source.attributes.length; i++)
    {
        var a = source.attributes[i];
        destination.attr(a.name, a.value);
    }
	//$("#SelectedAdvisory").children('div').css('background-color','black');
	*/
	/*var src = $("#versioncheckeditem").html();
	var dest = $("#SelectedAdvisory").html(src);
	*/
	$("#SelectedAdvisory").html('');
	$("#versioncheckeditem").clone().appendTo($("#SelectedAdvisory"));
	}
function getsubscribestatus_card(tname, tid, uid, rid)
  {
	  var datajs;
	  var reason="none";
	  var sid="3"; //ll - subscribe , 12 - share, 13- feedback
	var sref = "W";
	var getUrl = window.location;
	var baseUrl = getUrl.protocol + "//" + getUrl.host + getUrl.pathname;
	  $.ajax({
	   type: "POST",
	   async:false,
		url: 'sub_unsub.php',
		data: {toolname:tname, toolid: tid, userid: uid, roleid:rid,create:1,subflag:0,unsubreason:reason, serviceid:sid, refurl:baseUrl, srcref:sref},
		success: function(data){
			if(data == "subscribe")
			{
				$("#Subscribe_tool_card").addClass("d-inline");
				$("#Unsubscribe_tool_card").addClass("d-none");
			}
			else if(data == "unsubscribe")
			{
				$("#Subscribe_tool_card").addClass("d-none");
				$("#Unsubscribe_tool_card").addClass("d-inline");
			}
		}
	  });
	  return datajs;
  }
function getsubscribestatus(tname, tid, uid, rid)
  {
	  var datajs;
	  var reason="none";
	  var sid="3"; //ll - subscribe , 12 - share, 13- feedback
	var sref = "W";
	var getUrl = window.location;
	var baseUrl = getUrl.protocol + "//" + getUrl.host + getUrl.pathname;
	  $.ajax({
	   type: "POST",
	   async:false,
		url: 'sub_unsub.php',
		data: {toolname:tname, toolid: tid, userid: uid, roleid:rid,create:1,subflag:0,unsubreason:reason, serviceid:sid, refurl:baseUrl, srcref:sref},
		success: function(data){
			if(data == "subscribe")
			{
				$("#Subscribe_tool").addClass("d-inline");
				$("#Unsubscribe_tool").addClass("d-none");
			}
			else if(data == "unsubscribe")
			{
				$("#Subscribe_tool").addClass("d-none");
				$("#Unsubscribe_tool").addClass("d-inline");
			}
		}
	  });
	  return datajs;
  }
function getcolor(version)
{
	//match option by text
	//alert("item "+version +" color: "+ $("#SelectVersionNo option:contains('"+version+"')").css("color"));
	return $("#SelectVersionNo option:contains('"+version+"')").css("color");
}
function getcolorforversions_update(version)
{
	//match option by text
	var retvercol="";
	var i=0;
	if(version != ""){
		var stringarr = version.split(',');
		//gottoolname = gottoolname.split(" ").join("");
		//alert(stringarr);
		for(item of stringarr){
		  retvercol = retvercol +"<span style=\"color:"+getcolor(item.split(" ").join(""))+";\">"+item+"</span> / ";
		  i++;
		};
		/*for (a=0; a < stringarr.length; a++)
		{
			retvercol = retvercol +"<span style=\"color:"+getcolor(stringarr[a])+";\">"+stringarr[a]+"</span>, ";
		}*/
		//retvercol = "<span style=\"color:#808080;\">"+retvercol.substring(0, retvercol.length - 2);
	}
	else
	{
		retvercol="";
	}
	return retvercol;
}
function getcolorforversions_upgrade(version)
{
	//match option by text
	var retvercol="";
	var i=0;
	if(version != ""){
	var stringarr = version.split(',');
	//gottoolname = gottoolname.split(" ").join("");
	//alert(stringarr);
	for(item of stringarr){
	  retvercol = retvercol +"<span style=\"color:"+getcolor(item.split(" ").join(""))+";\">"+item+"</span> / ";
	  i++;
	};
	/*for (a=0; a < stringarr.length; a++)
	{
		retvercol = retvercol +"<span style=\"color:"+getcolor(stringarr[a])+";\">"+stringarr[a]+"</span>, ";
	}*/
	retvercol = "<span style=\"color:#808080;\">"+retvercol.substring(0, retvercol.length - 2);
	}
	else
	{
		retvercol="";
	}
	return retvercol;
}
function mindateymd_to_dmy(string_node)
{
	var pattern =/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/;
	if(pattern.test(string_node))
	{
		return dateymd_to_dmy(string_node);
	}
	else
	{
		return string_node;
	}
}
function getmetadata()
{
	var metadata="";
	$.ajax({
        //type: "GET",
        url: "document/oss-stack-meta-data.json",
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

function prepareDataForAccord(data)
{
var accorhtml="";
functionalDomain = jmespath.search(data,"functionalDomain[].name");
//console.log("Functional domains" + functionalDomain);
//var colourCodes = ["GREEN","AMBER","RED" ] ;
var colourCodes = ["PaleGreen","LightSkyBlue" ] ;
$("#eachTool").empty();
for ( i in functionalDomain ){
functionalDomainCurrent = functionalDomain[i];
var objSelected = jmespath.search(data, "ossTools[?functionalDomain=='" + functionalDomainCurrent + "']" + " | []");
var toolNameList = jmespath.search(objSelected, "[*].toolName" + "| [] ");
if ( toolNameList.length > 0 ){
	//console.log("Functional Domain::" + functionalDomain[i]);
	//console.log("Toolnamelist::"+toolNameList);
	if ( accorhtml != "" )
		accorhtml = accorhtml + "<div class=\"accordion\"><H2>" + functionalDomainCurrent + "</H2><div >"
	else 
		accorhtml = "<div class=\"accordion\"><H2>" + functionalDomainCurrent + "</H2><div>"
		for ( i in toolNameList ){
				//console.log("Tool Name : " + toolNameList[i] );
				var currentTool = jmespath.search(data,"ossTools[?functionalDomain=='"+ functionalDomainCurrent + "' && toolName=='" +toolNameList[i]+"']")
				accorhtml = accorhtml +selectOneRequest(data, toolNameList[i]);
			}
}
//console.log(toolNameList);
accorhtml = accorhtml + "</div></div>"
} // end of end domain
//console.log(accorhtml);
return(accorhtml);
}
function loadVersionNums_card(data,toolname)
{	
	var currentTool = jmespath.search(data, "ossTools[?toolName=='" + toolname + "']");
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var minors ="";
	var minorversionlist = $('#SelectVersionNo_card');
	var indx=1;
	var getminver="";
	var minversarr=[];
	minorversionlist.empty();
	minorversionlist.append('<option selected="true" value="0">Select Version</option>');
	for (a=0; a < majorVersions.length; a++)
	{
		minors = majorVersions[a].minorVersions;
		//for (b in minors){
		for(b=0; b < minors.length; b++) {
			var objItem={};
			if( minors[b].minorVersion)
			{
				getminver = String(minors[b].minorVersion);
				//console.log("min versions not undefine : "+ getminver);
				objItem.minver = String(minors[b].minorVersion);
				objItem.colorcode = String(minors[b].colourCode);
				if(String(minors[b].colourCode).toUpperCase() == "PALEGREEN"){objItem.colorvalue = 1;}
				else if(String(minors[b].colourCode).toUpperCase() == "LIGHTSKYBLUE"){objItem.colorvalue = 2;}
				else if(String(minors[b].colourCode).toUpperCase() == "#FF4D4D"){objItem.colorvalue = 3;}
			}
			else if(minors[b].minorVersions )
			{
				getminver = String(minors[b].minorVersions);	
				//console.log("min versions are : "+ getminver);
				objItem.minver = String(minors[b].minorVersions);
				objItem.colorcode = String(minors[b].colourCode);
				if(String(minors[b].colourCode).toUpperCase() == "PALEGREEN"){objItem.colorvalue = 1;}
				else if(String(minors[b].colourCode).toUpperCase() == "LIGHTSKYBLUE"){objItem.colorvalue = 2;}
				else if(String(minors[b].colourCode).toUpperCase() == "#FF4D4D"){objItem.colorvalue = 3;}				
			}
			minversarr.push(objItem);
			//getminver = (minors[b].minorVersion != "undefined" ) ? (minors[b].minorVersion) : (minors[b].minorVersions);
			//minorversionlist.append('<option value="' + indx + '" style="color:'+setcolor(minors[b].colourCode)+';">' + getminver + '</option>');
			//****************option item """"color"'""""""
			//indx++;
			
		}
		
		
	}
	minversarr = minversarr.sort(function (a, b) {
    var x = a['colorvalue']; var y = b['colorvalue'];
            return ((x < y) ? -1 : ((x > y) ? 1 : 0));
	});
	for (c=0; c < minversarr.length; c++)
	{
		minorversionlist.append('<option value="' + indx + '" style="color:'+setcolor(minversarr[c].colorcode)+';">' + minversarr[c].minver + '</option>');
		indx++;
	}
	/*$.each(myOptions, function(val, text) {
		mySelect.append(
			$('<option></option>').val(val).html(text)
		);
	});*/
	
}

function loadVersionNums(data,toolname)
{	
	var currentTool = jmespath.search(data, "ossTools[?toolName=='" + toolname + "']");
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var minors ="";
	var minorversionlist = $('#SelectVersionNo');
	var indx=1;
	var getminver="";
	var minversarr=[];
	minorversionlist.empty();
	minorversionlist.append('<option selected="true" value="0">Select Version</option>');
	for (a=0; a < majorVersions.length; a++)
	{
		minors = majorVersions[a].minorVersions;
		//for (b in minors){
		for(b=0; b < minors.length; b++) {
			var objItem={};
			if( minors[b].minorVersion)
			{
				getminver = String(minors[b].minorVersion);
				//console.log("min versions not undefine : "+ getminver);
				objItem.minver = String(minors[b].minorVersion);
				objItem.colorcode = String(minors[b].colourCode);
				if(String(minors[b].colourCode).toUpperCase() == "PALEGREEN"){objItem.colorvalue = 1;}
				else if(String(minors[b].colourCode).toUpperCase() == "LIGHTSKYBLUE"){objItem.colorvalue = 2;}
				else if(String(minors[b].colourCode).toUpperCase() == "#FF4D4D"){objItem.colorvalue = 3;}
			}
			else if(minors[b].minorVersions )
			{
				getminver = String(minors[b].minorVersions);	
				//console.log("min versions are : "+ getminver);	
				objItem.minver = String(minors[b].minorVersions);
				objItem.colorcode = String(minors[b].colourCode);
				if(String(minors[b].colourCode).toUpperCase() == "PALEGREEN"){objItem.colorvalue = 1;}
				else if(String(minors[b].colourCode).toUpperCase() == "LIGHTSKYBLUE"){objItem.colorvalue = 2;}
				else if(String(minors[b].colourCode).toUpperCase() == "#FF4D4D"){objItem.colorvalue = 3;}				
			}
			minversarr.push(objItem);
			//getminver = (minors[b].minorVersion != "undefined" ) ? (minors[b].minorVersion) : (minors[b].minorVersions);
			//minorversionlist.append('<option value="' + indx + '" style="color:'+setcolor(minors[b].colourCode)+';">' + getminver + '</option>');
			//****************option item """"color"'""""""
			//indx++;
			
		}
		
		
	}
	minversarr = minversarr.sort(function (a, b) {
    var x = a['colorvalue']; var y = b['colorvalue'];
            return ((x < y) ? -1 : ((x > y) ? 1 : 0));
	});
	for (c=0; c < minversarr.length; c++)
	{
		minorversionlist.append('<option value="' + indx + '" style="color:'+setcolor(minversarr[c].colorcode)+';">' + minversarr[c].minver + '</option>');
		indx++;
	}
	/*$.each(myOptions, function(val, text) {
		mySelect.append(
			$('<option></option>').val(val).html(text)
		);
	});*/
	
}
function get_Item_Advisory(meta_data,toolname)
{
	//version_recommend_status($("#versioncheckitem").val(), $("#SelectVersionNo").find(":selected").text());
	$("#versioncheckeditem").html('');
	var currentTool = jmespath.search(meta_data, "ossTools[?toolName=='" + toolname + "']");
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	
	var accorhtml="";
	var checked_cont="";
var colourCodes = ["PaleGreen","LightSkyBlue" ] ;
//console.log("currentTool-------------------" + JSON.stringify(currentTool,null,4));
//console.log("currentTool-------------------" + currentTool[0].infoAsOn);

var advisory = JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update[0]"), null,4);
$("#versioncheckeditem").html('');
checked_cont = "<div class=\"p-1\" style=\"color:#00994c; background-color:palegreen;\"><b>Latest Version is "+advisory+".</b><br/></div>";

for ( color in colourCodes ){
		//console.log(colourCodes[color]);
		// var colorCount = jmespath.search(majorVersions,"[].minorVersions[?colourCode==']" + colourCodes[color] + "']")
		var colorCurrentList = 	jmespath.search(majorVersions,"[].minorVersions[?colourCode=='" + colourCodes[color] +"'].minorVersion | []");				
		var colorCount = jmespath.search(majorVersions,"[].minorVersions[?colourCode=='" + colourCodes[color] +"'].minorVersion | length([])");
		
	 //console.log("minorVersions : " + colorCount );
	 //console.log("minorVersions : " + colorCurrentList );
	if (colorCount > 0 && colourCodes[color] == "LightSkyBlue" ) 
	  checked_cont = checked_cont + "<div class=\"p-1\" style=\"color:#375e97;word-break: break-all; background-color:lightskyblue;\">&nbsp;<strong class=\"comment more\">Still Supported are " + seggregate(colorCurrentList) + "</strong>. You may update this as an interim measure. However you are advised to update /upgrade to <span style=\"color:#00994c;\">Latest Version "+advisory+"</span>.</div>";

	}
	

	return checked_cont;
	
	
}
function loadDomainTools(data,domainname)
{
	var currentTool = jmespath.search(data, "ossTools[?functionalDomain=='" + domainname + "']");
	currentTool = currentTool.sort(function(x,y){ 
      var a = String(x).toUpperCase(); 
      var b = String(y).toUpperCase(); 
      if (a > b) 
         return 1 
      if (a < b) 
         return -1 
      return 0; 
    }); 
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var minors ="";
	var toollist = $('#SelectTool');
	var indx=1;
	var getminver="";
	toollist.empty();
	toollist.append('<option selected="true" value="0">Select Tool</option>');
	for (a=0; a < currentTool.length; a++)
	{
		toollist.append('<option value="' + indx + '">' + currentTool[a].toolName + '</option>');
		indx++;
	}
}
function loadDomainTools_card(data,domainname)
{
	var currentTool = jmespath.search(data, "ossTools[?functionalDomain=='" + domainname + "']");
	currentTool = currentTool.sort(function(x,y){ 
      var a = String(x).toUpperCase(); 
      var b = String(y).toUpperCase(); 
      if (a > b) 
         return 1 
      if (a < b) 
         return -1 
      return 0; 
    }); 
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var minors ="";
	var toollist = $('#SelectTool_card');
	var indx=1;
	var getminver="";
	toollist.empty();
	toollist.append('<option selected="true" value="0">Select Tool</option>');
	for (a=0; a < currentTool.length; a++)
	{
		toollist.append('<option value="' + indx + '">' + currentTool[a].toolName + '</option>');
		indx++;
	}
}
function setcolor(colorname)
{
	var colorcode;
	
	if(((colorname).trim()).toUpperCase() == "LIGHTSKYBLUE")
	{
		colorcode = "#375e97;background-color:lightskyblue";
	}	
	else if (((colorname).trim()).toUpperCase() == "PALEGREEN")
	{
		colorcode ="#00994c;background-color:palegreen";
	}
	else if (((colorname).trim()).toUpperCase() == "#FF4D4D")
	{
		colorcode = "#ff4d4d;background-color:peachpuff";
	}
	return colorcode;
}
function setmajbgopacitycolor(colorname)
{
	var colorcode;
	
	if(((colorname).trim()).toUpperCase() == "LIGHTSKYBLUE")
	{
		//colorcode = "rgb(255, 165, 0, 0.3)";
		colorcode = "#c7d5eb";
	}	
	else if (((colorname).trim()).toUpperCase() == "PALEGREEN")
	{
		//colorcode ="rgb(0, 153, 76, 0.3)";
		colorcode = "#98FB98";
	}
	else if (((colorname).trim()).toUpperCase() == "#FF4D4D")
	{
		//colorcode = "rgb(255, 0, 0, 0.3)";
		colorcode = "#ff4d4d";
	}
	return colorcode;
}

var hexDigits = new Array
        ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 

//Function to convert rgb color to hex format
function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    function hex(x) {
        return ("0" + parseInt(x).toString(16)).slice(-2);
    }
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}


function opentoolrepos(toolname,toolId,roleid,userid) {
var toolresource;
//document.getElementById("SelectedTool").innerHTML = "Tool :  "+toolname;
//toolresource ="<br/><a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_blank\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue(toolname)+"&tool_id="+encodevalue(toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\">Download</a>&nbsp;&nbsp;&nbsp;&nbsp;";
	window.open('','_blank').location.href="https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue(toolname)+"&tool_id="+encodevalue(toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid);
	return false;
	//$("#ToolResource").empty().append(toolresource);

}
//function for custom confirmation box starts
function createModal(title, message, type) {  
   customModal(title, message, type);  
}  
function customModal(head, body, type) 
{
	if(type == 'prompt') {
		$('#modal-head').html('<h4 class="modal-title">'+head+'</h4>');
		$('#modal-body').html('<div class="row"><label class="col-sm-3">Name</label><div class="col-md-9"><input class="form-control" type="text" id="name-input"></div></div>');  
		$('#modal-footer').html('<button type="button" class="btn btn-primary" id="done-btn">Done</button><button type="button" class="btn btn-danger" id="cancel-btn">Cancel</button>');  
		$('#custom-modal').modal('show');  
		$('#cancel-btn').on('click', function() {  
		  return response('cancel');  
		});  
		$('#done-btn').on('click', function() {  
			return response('done');  
		});  
	}
	else if( type == 'alert') { 
		$('#modal-head').html('<h4 class="modal-title">'+head+'</h4>');  
		$('#modal-body').html('<p>' + body + '</p>');  
		$('#modal-footer').html('<button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>');  
		$('#custom-modal').modal('show');  
	}
	else if( type == 'confirm') { 
		$('#modal-head').html('<h6 class="modal-title">'+ head +'</h6>');  
		$('#modal-body').html('<p>' + body + '</p>');  
		$('#modal-footer').html('<button type="button" class="btn" id="ok-btn">Ok</button> <button type="button" class="btn btn-default activebtn" id="cancel-btn">Cancel</button>');  
		$('#custom-modal').modal('show');  
		$('#cancel-btn').on('click', function() {  
		//return response('cancel');  
		return false;  
		});  
		$('#ok-btn').on('click', function() {  
		//return response('ok');  
		return true;  
		});  
	}  
}  
function response(type) {
	if(type == 'done') {
		if(document.getElementById('name-input').value != '') {
			$('#user-name').html( 'Welcome '+ document.getElementById('name-input').value);  
			$('#custom-modal').modal('hide');  
			return document.getElementById('name-input').value;  
		}
		else {  
			alert('Please Enter your name');  
		}  
	}
	else if(type == 'cancel') {
		$('#custom-modal').modal('hide');  
	return false;  
	}
	else if(type == 'ok') {  
		$('#custom-modal').modal('hide');  
		return true;  
	}  
}  
//function for custom confirmation box ends
function sortTable(n, id, order) 
{
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById(id);
  switching = true;
  // Set the sorting direction to ascending:
  dir = order;
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
function sortTableByDate(n, id, order) 
{
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById(id);
  switching = true;
  // Set the sorting direction to ascending:
  dir = order;
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (convertDate(x.innerHTML) > convertDate(y.innerHTML)) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (convertDate(x.innerHTML) < convertDate(y.innerHTML)) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
function convertDate(d) {
    var p = d.split("/");
    return Date(p[2]+'/'+p[1]+'/'+ p[0]);
}