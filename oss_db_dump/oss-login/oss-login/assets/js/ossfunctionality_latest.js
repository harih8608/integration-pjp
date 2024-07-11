
function loadmenuitems()
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
			$("#menulist").append(menuaccordwrap);


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
var funcdom = $('#SelectFuncDomain');
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


function sitemap()
{
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
				//menuaccord = menuaccord + '<a href="#'+datamitems.type.split(" ").join("")+'" class="list-group-item" data-toggle="collapse" title="'+datamitems.title+'"><i class="glyphicon glyphicon-chevron-right"></i>'+datamitems.type+'</a><div class="list-group collapse" id="'+datamitems.type.split(" ").join("")+'">';
				for(i = 0; i < datamitems.submenu1.length; i++) {
					
					pagelist = pagelist+ '<li class="leaf"><a href="'+datamitems.submenu1[i].href+'" title="'+datamitems.submenu1[i].title+'">'+datamitems.submenu1[i].type+'</a></li>';
					//pagelist = pagelist+ '<a href="'+datamitems.submenu1[i].href+'" class="list-group-item" title="'+datamitems.submenu1[i].title+'">'+datamitems.submenu1[i].type+'</a>';
				}
				//menuaccord = menuaccord + submenuaccord + '</div>';
			}
			else
			{
				pagelist = pagelist+ '<li class="leaf"><a href="'+datamitems.href+'" title="'+datamitems.title+'">'+datamitems.type+'</a></li>';
				//menuaccord = menuaccord + '<a href="'+datamitems.href+'" class="list-group-item" title="'+datamitems.title+'">'+datamitems.type+'</a>';
			}
			});
	   $("#sitemapjsonmenu").append(pagelist);
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
var colourCodes = ["GREEN","AMBER" ] ;
//console.log("currentTool-------------------" + JSON.stringify(currentTool,null,4));
//console.log("currentTool-------------------" + currentTool[0].infoAsOn);
var majorVersions = jmespath.search(currentTool[0],"majorVersions[]")
var advisory = JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update[0]"), null,4);
//console.log("Advisory :"+ JSON.stringify(advisory,null,4));
//accorhtml = accorhtml + "<div class=\"accordion\"><div class=\"acctool\" style=\"font-size:14px; color:#00008b;\">" + choiceOption + "&nbsp;(<strong class=\"accvers\" style=\"color:\#00994C;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='GREEN'].minorVersion | []"))	+"</strong>)<span class=\"lastupd\" style=\"float:right;height:auto;color:teal;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;\"><p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"et\" style=\"\">&nbsp;&nbsp;<img src=\"images/advisory6.png\" style=\"height:25px;\" ></img>&nbsp;&nbsp;<div class=\"et-left et-arrow\" id=\"ttcontent\" style=\" font-size:12px;position:absolute;z-index:10;\"><i>Advisory</i> <br/> Upgrade : "+advisory+"</div></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></p>"

accorhtml = accorhtml + "<div class=\"accordion\"><div class=\"acctool\" style=\"font-size:14px; color:#00008b;\">" + choiceOption + "&nbsp;(<strong class=\"accvers\" style=\"color:\#00994C;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='GREEN'].minorVersion | []"))	+"</strong>)<span class=\"lastupd\" style=\"float:right;height:auto;color:teal;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;\"><p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue(choiceOption)+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><img src=\"images/download1.gif\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"et\" style=\"\">&nbsp;&nbsp;<img src=\"images/advisory6.png\" style=\"height:25px;\" ></img>&nbsp;&nbsp;<div class=\"et-left et-arrow\" id=\"ttcontent\" style=\" font-size:12px;position:absolute;z-index:10;\"><i>Advisory</i> <br/> Upgrade : "+advisory+"</div></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></p>"

//accorhtml = accorhtml + "<div class=\"accordion\"><div class=\"acctool\" style=\"font-size:14px; color:#00008b;\">" + choiceOption + "&nbsp;(<strong class=\"accvers\" style=\"color:\#00994C;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='GREEN'].minorVersion | []"))	+"</strong>)<span class=\"lastupd\" style=\"float:right;height:auto;color:teal;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;\"><p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue(choiceOption)+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><img src=\"images/download1.gif\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"et\" style=\"\">&nbsp;&nbsp;<img src=\"images/advisory6.png\" style=\"height:25px;\" ></img>&nbsp;&nbsp;<div class=\"et-left et-arrow\" id=\"ttcontent\" style=\" font-size:12px;position:absolute;z-index:10;\"><i>Advisory</i> <br/> Upgrade : "+advisory+"</div></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'subscribe.php\';return false;\" target=\"_blank\"><img src=\"images/subscribe.png\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></p>"

				//<div class="et">Hover me<div class="et-bottom" id="ttcontent">Its Advisory</div></div></br>

	accorhtml = accorhtml + "<div><table class=\"table table-bordered table-hover table-condensed\"><tbody><tr><th>Functional Domain </th><td> " + currentTool[0].functionalDomain +"</td></tr>"
	accorhtml = accorhtml + "<tr><th>Stack Relevance </th><td> "+nodearrayvalues(currentTool[0].stackRelevance)+"</td></tr>"
	accorhtml = accorhtml + "<tr><th>License </th><td> " +nodearrayvalues(currentTool[0].license)+"</td></tr>"
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
	 
	
	 if ( colorCount > 0 && colourCodes[color] == "GREEN")
//	 accorhtml = accorhtml + colourCodes[color] + "<p>Number of Minor Versions:" + colorCount + "</p><p>Latest Version " + colorCurrentList + "</p>"
		 accorhtml = accorhtml  + "<tr style=\"color:#2d8655;\"><th> Latest Version</th><td>    <strong>" + seggregate(colorCurrentList) + "&nbsp;&nbsp;&nbsp;</strong></td></tr>"
	 else if (colorCount > 0 && colourCodes[color] == "AMBER" ) 
	  accorhtml = accorhtml + "<tr style=\"color:#375e97;\"><th>Still Supported Version(s) </th><td style=\"word-break: break-all;\"> <strong> (" + colorCount + ")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong class=\"comment more\">" + seggregate(colorCurrentList) + "</strong></td></tr>"
	 else if (colorCount > 0 && colourCodes[color] == "RED"  )
	  accorhtml = accorhtml + colourCodes[color] + "<tr style=\"color:#ff0000;\"><th>UnSupported Versions</th><td style=\"word-break: break-all;\"> <strong> (" + colorCount + ")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong>" + seggregate(colorCurrentList) + "</strong></td></tr>"
	// todisplay = todisplay + colourCodes[color] + ":" + colorCount + " "

	}

	accorhtml = accorhtml + "</tbody></table></div><br/>"+getcolornote()+"<br/>"+majorminoraccordions(data,choiceOption)+"</div></div>"
				
	//console.log(toolNameList);
//accorhtml = accorhtml + "</div></div>"

//console.log(accorhtml);
return(accorhtml);
}
function getcolornote()
{
	var colornotes = "<div class=\"clearfix\" style=\"color:#808080;\"><div class=\"colornote float-right\"><ul><li><div class=\"input-color\"><span>Recommended</span><div class=\"color-box green\"></div></div></li><li><div class=\"input-color\"><span>Still Supported</span><div class=\"color-box amber\"></div></div></li><li><div class=\"input-color\"><span>NOT Supported</span><div class=\"color-box red\"></div></div></li></ul></div></div>";
	return colornotes;
}
function getadvcolornote()
{
	var colornotes = "<div class=\"clearfix\" style=\"color:#808080;\"><div class=\"colornote float-right\"><ul><li><div class=\"input-color\"><span>Recommended</span><div class=\"color-box green\"></div></div></li><li><div class=\"input-color\"><span>Still Supported</span><div class=\"color-box amber\"></div></div></li><li><div class=\"input-color\"><span>NOT Supported</span><div class=\"color-box red\"></div></div></li></ul></div></div>";
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
	majminaccords = majminaccords + "<button type=\"button\" id=\""+setMajverbtnId(toolname,majorVersions[k].majorVersion)+"\" title=\"Get all minor version details\" class=\"btn btn-default border border-light\" data-toggle=\"modal\" data-target=\"#minorVersionsModal\" onclick=\"onmajVerbtnclick(this.id,\'"+toolname+"\',\'"+majorVersions[k].majorVersion+"\')\"><div class=\"majVersion table-responsive\"><table class=\"table table-bordered\"><tbody><tr><th style=\"background-color:"+getmajcolor(data,this.id,toolname, majorVersions[k].majorVersion)+";\">Major Version </th><td> " + majorVersions[k].majorVersion +"</td></tr>"
	majminaccords = majminaccords + "<tr><th style=\"background-color:"+getmajcolor(data,this.id,toolname, majorVersions[k].majorVersion)+";\">End of Life </th><td> "+dateymd_to_dmy(majorVersions[k].advisory.endOfLife)+"</td></tr>"
	majminaccords = majminaccords + "<tr><th style=\"background-color:"+getmajcolor(data,this.id,toolname, majorVersions[k].majorVersion)+"; \">Advisory</th><td> Update: "+ remarks(majorVersions[k].advisory.update)+"<br/>Upgrade: "+remarks(majorVersions[k].advisory.upgrade)+"</td></tr></tbody></table></div></button>"
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
						if(minors[b][d] == "RED")
						{ return setcolor(minors[b][d]);}
					}
				}*/
				if(minors[b].colourCode == "GREEN")
				{greencnt =1;}
				if(minors[b].colourCode == "AMBER")
				{ambercnt =1;}
				if(minors[b].colourCode == "RED")
				{redcnt =1;}
			}
			if(greencnt == 1)
			{ return setmajbgopacitycolor("GREEN");}
			if(ambercnt == 1)
			{ return setmajbgopacitycolor("AMBER");}
			if(redcnt == 1)
			{ return setmajbgopacitycolor("RED");}
			
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
			minversaccordhtml = minversaccordhtml + "</tbody></table><br/><div ><br> <a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'disclaimer.php\';return false;\" target=\"_blank\">Disclaimer</a></div></div>";
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
				if((minors[b].colourCode).trim() == "AMBER" )
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is still supported <br/><u>Advisory</u> <br/>"+advisory);
					$("#versioncheckeditem").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "GREEN")
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is recommended");
					$("#versioncheckeditem").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "RED")
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is not recommended <br/><u>Advisory</u> <br/>"+advisory);
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
				if((minors[b].colourCode).trim() == "AMBER" )
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is still supported <br/><u>Advisory</u> <br/>"+advisory);
					$("#versioncheckeditem").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "GREEN")
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is recommended");
					$("#versioncheckeditem").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "RED")
				{
					$("#versioncheckeditem").html($("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is not recommended <br/><u>Advisory</u> <br/>"+advisory);
					$("#versioncheckeditem").css('color','#ff0000');
					
				}	
			break;				
			}
		}
		
	}
	$("#versioncheckeditem").show();
	$("#SelectedAdvisory").val($("#versioncheckeditem").val());
	
	tooldownload ="<p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue($("#versioncheckitem").val())+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><img src=\"images/download1.gif\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'subscribe.php\';return false;\" target=\"_blank\"><img src=\"images/subscribe.png\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"#\" onclick=\"sendemail()\"><img src=\"assets/img/share1.png\" id=\"shareveradvisory\" style=\"height:25px;\" title=\"share to mail\"/></a></div></p>";
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
				advisory_update = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)))+"</span>";
				
				//advisory_upgrade ="";
				advisory_upgrade = getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				
				//advisory ="<span style=\"color:"+$("#SelectVersionNo option[value='"+jmespath.search(majorVersions,"["+a+"].advisory.update[0]")+"']").text()+";\">Update : " + seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4))+"</span>";
				//advisory ="<span>Update : " + seggregatebrac_comma(jmespath.search(majorVersions,"["+a+"].advisory.update[0]"), null,4)+"</span>";
				//advisory = advisory +"<br/><span>Upgrade : "+ seggregatebrac_comma(  jmespath.search(majorVersions,"["+a+"].advisory.upgrade[0]"), null,4)+"</span>";
				
				//setupdatetxt = setupgradetext(advisory, $("#SelectVersionNo").find(":selected").text());
				if((minors[b].colourCode).trim() == "AMBER" )
				{
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is still supported </b><br/><br/>However you are advised to upgrade/update to <b style=\"color:#00994c;\">Version "+advisory+"</b><b style=\"color:#375e97;\">*</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "GREEN")
				{
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is recommended. </b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "RED")
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
					
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is NOT SUPPORTED.</b><br/><br/><span style=\"color:#00994c;\"><b>"+advisory+" is recommended.</b> You may upgrade to version "+advisory+"</span><b style=\"color:#375e97;\">*</b><br/><br/>"+interim+"<br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
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
				advisory_update = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.update"), null,4)))+"</span>";
				
				//advisory_upgrade ="";
				advisory_upgrade = getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				//setupdatetxt = setupgradetext(advisory, $("#SelectVersionNo").find(":selected").text());
				if((minors[b].colourCode).trim() == "AMBER" )
				{	
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is still supported </b><br/><br/>However you are advised to upgrade/update to <b style=\"color:#00994c;\">Version "+advisory+"</b><b style=\"color:#375e97;\">*</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "GREEN")
				{
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is recommended. </b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "RED")
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
					
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is NOT SUPPORTED.</b><br/><br/><span style=\"color:#00994c;\"><b>"+advisory+" is recommended.</b> You may upgrade to version "+advisory+"</span><b style=\"color:#375e97;\">*</b><br/><br/>"+interim+"<br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
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
	
	//tooldownload ="<p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'https://ossrepository.gov.in/toollister/tools/index.php?tool="+encodevalue($("#versioncheckitem").val())+"\';return false;\" target=\"_blank\"><img src=\"images/download1.gif\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'subscribe.php\';return false;\" target=\"_blank\"><img src=\"images/subscribe.png\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"#\" onclick=\"sendemail()\"><img src=\"assets/img/share1.png\" id=\"shareveradvisory\" style=\"height:25px;\" title=\"share to mail\"/></a></div></p>";
	//http://ossrepository.gov.in/toollister/?tool=
	
	$("#ToolDownload").empty().append(tooldownload);*/
	advisorybtns= "<button class=\"advbtn m-1\" title=\"Download tool's latest version\" type=\"button\" onclick=\"window.open(\'\',\'_new\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue($("#versioncheckitem").val())+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><i class=\"fa fa-download\"></i> Download</button><button id=\"Subscribe_tool\" class=\"advbtn m-1 d-none\" title=\"Subscribe for advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#SubscribeModal\" type=\"button\" onclick=\"subscribeclick('" + $("#versioncheckitem").val() + "','"+currentTool[0].toolId+"','"+userid+"','"+roleid+"');\"><i class=\"fa fa-bell\"></i> Subscribe</button><button id=\"Unsubscribe_tool\" class=\"advbtn m-1 d-none\" title=\"Unsubscribe for advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#UnsubscribeModal\" type=\"button\" onclick=\"unsubscribeclick('" + $("#versioncheckitem").val() + "','"+currentTool[0].toolId+"','"+userid+"','"+roleid+"');\"><i class=\"fa fa-bell\"></i> Unsubscribe</button>";
	
	$("#advisory_btns").empty();
	$("#advisory_btns").append(advisorybtns);
	//advisorysubscribebtn= getsubscribestatus($("#versioncheckitem").val(), currentTool[0].toolId,userid,roleid);
	getsubscribestatus($("#versioncheckitem").val(), currentTool[0].toolId,userid,roleid);
	advisorysharebtn = "<button id=\"SharetoMail\" class=\"advbtn m-1\" title=\"Share this advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#ShareModal\" type=\"button\" onclick=\"sharetomail();\"><i class=\"fa fa-share\"></i> Share</button>";
	//$("#advisory_btns").append(advisorysubscribebtn);
	$("#advisory_btns").append(advisorysharebtn);
	$("#SelectedTool").empty();
	$("#SelectedTool").append($("#versioncheckitem").val());
	$("#advisory_btns").addClass("d-block");
	
}
function homepageversioncheck(meta_data,roleid,userid)
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
				if((minors[b].colourCode).trim() == "AMBER" )
				{
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is still supported </b><br/><br/>However you are advised to upgrade/update to <b style=\"color:#00994c;\">Version "+advisory+"</b><b style=\"color:#375e97;\">*</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production. </b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "GREEN")
				{
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is recommended. </b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "RED")
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
					
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is NOT SUPPORTED.</b><br/><br/><span style=\"color:#00994c;\"><b>"+advisory+" is recommended.</b> You may upgrade to version "+advisory+"</span><b style=\"color:#375e97;\">*</b><br/><br/>"+interim+"<br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.</b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
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
				interim = advisory_update+"</span>";
				
				//advisory_upgrade ="";
				advisory_upgrade = getcolorforversions_update( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"["+a+"].advisory.upgrade"), null,4)))+"</span>";
				//setupdatetxt = setupgradetext(advisory, $("#SelectVersionNo").find(":selected").text());
				if((minors[b].colourCode).trim() == "AMBER" )
				{	
					advisory ="";
					advisory = getcolorforversions_upgrade( seggregatebrac_comma(JSON.stringify( jmespath.search(majorVersions,"[0].advisory.update"), null,4)))+"</span>";
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is still supported </b><br/><br/>However you are advised to upgrade/update to <b style=\"color:#00994c;\">Version "+advisory+"</b><b style=\"color:#375e97;\">*</b><br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production.  </b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#375e97');
					
				}
				else if ((minors[b].colourCode).trim() == "GREEN")
				{
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is recommended. </b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#00994c');
					
				}
				else if ((minors[b].colourCode).trim() == "RED")
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
					
					$("#versioncheckeditem").html("<b>"+$("#versioncheckitem").val()+" version "+ $("#SelectVersionNo").find(":selected").text() +" is NOT SUPPORTED.</b><br/><br/><span style=\"color:#00994c;\"><b>"+advisory+" is recommended.</b> You may upgrade to version "+advisory+"</span><b style=\"color:#375e97;\">*</b><br/><br/>"+interim+"<br/><br/><b style=\"color:#375e97;background-color:yellow;\">*While upgrading/updating, you may ensure that the application is tested on staging server before deployment on production. </b><br/><div class=\"row clearfix  justify-content-left\">  <div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Advisory generated on "+ dateymd_to_dmy(callphpdatefunc())+")</i></div><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"display:inline;>"+getadvcolornote()+"</i><div class=\"col-lg-4 col-md-3 col-sm-6 col-xs-12 p-1\"><i style=\"color:#375e97;\">(Metadata updated as on "+ dateymd_to_dmy(currentTool[0].infoAsOn)+")</i></div></div></div>");
					$("#versioncheckeditem").css('color','#ff0000');
					
				}	
			break;				
			}
		}
		
	}
	$("#versioncheckeditem").removeClass('text-left');
	$("#versioncheckeditem").addClass('text-center');
	$("#versioncheckeditem").show();
	
	/*//$("#shareveradvisory").show();
	
	//tooldownload ="<p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'https://ossrepository.gov.in/toollister/tools/index.php?tool="+encodevalue($("#versioncheckitem").val())+"\';return false;\" target=\"_blank\"><img src=\"images/download1.gif\" style=\"height:25px;\" title=\"download\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'subscribe.php\';return false;\" target=\"_blank\"><img src=\"images/subscribe.png\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"#\" onclick=\"sendemail()\"><img src=\"assets/img/share1.png\" id=\"shareveradvisory\" style=\"height:25px;\" title=\"share to mail\"/></a></div></p>";
	//http://ossrepository.gov.in/toollister/?tool=
	
	$("#ToolDownload").empty().append(tooldownload);*/
	
	advisorybtns= "<button class=\"advbtn m-1\" title=\"Download tool's latest version\" type=\"button\" onclick=\"window.open(\'\',\'_new\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue($("#versioncheckitem").val())+"&tool_id="+encodevalue(currentTool[0].toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\"><i class=\"fa fa-download\"></i> Download</button><button id=\"Subscribe_tool\" class=\"advbtn m-1 d-none\" title=\"Subscribe for advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#SubscribeModal\" type=\"button\" onclick=\"subscribeclick('" + $("#versioncheckitem").val() + "','"+currentTool[0].toolId+"','"+userid+"','"+roleid+"');\"><i class=\"fa fa-bell\"></i> Subscribe</button><button id=\"Unsubscribe_tool\" class=\"advbtn m-1 d-none\" title=\"Unsubscribe for advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#UnsubscribeModal\" type=\"button\" onclick=\"unsubscribeclick('" + $("#versioncheckitem").val() + "','"+currentTool[0].toolId+"','"+userid+"','"+roleid+"');\"><i class=\"fa fa-bell\"></i> Unsubscribe</button>";
	
	$("#advisory_btns").empty();
	$("#advisory_btns").append(advisorybtns);
	//advisorysubscribebtn= getsubscribestatus($("#versioncheckitem").val(), currentTool[0].toolId,userid,roleid);
	getsubscribestatus($("#versioncheckitem").val(), currentTool[0].toolId,userid,roleid);
	advisorysharebtn = "<button id=\"SharetoMail\" class=\"advbtn m-1\" title=\"Share this advisory on "+$("#versioncheckitem").val()+"\" data-toggle=\"modal\" data-target=\"#ShareModal\" type=\"button\" onclick=\"sharetomail();\"><i class=\"fa fa-share\"></i> Share</button>";
	//$("#advisory_btns").append(advisorysubscribebtn);
	$("#advisory_btns").append(advisorysharebtn);
	$("#SelectedTool").empty();
	$("#SelectedTool").append($("#versioncheckitem").val());
	$("#advisory_btns").addClass("d-block");
	/*$("#SelectedTool").empty();
	$("#SelectedTool").append($("#versioncheckitem").val());
	$("#advisory_btns").addClass("d-block");
	*/
	
	
}
function callphpdatefunc()
{
	var receiveddate;
	$.ajax({
	   type: "POST",
	   async:false,
		url: 'getdate.php',
		data: {},
		success: function(data){
			receiveddate = data;
			
		}
	  });
	  return receiveddate;
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
function getsubscribestatus(tname, tid, uid, rid)
  {
	  var datajs;
	  var reason="none";
	  $.ajax({
	   type: "POST",
	   async:false,
		url: 'sub_unsub.php',
		data: {toolname:tname, toolid: tid, userid: uid, roleid:rid,create:1,subflag:0,unsubreason:reason},
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
var colourCodes = ["GREEN","AMBER" ] ;
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


function loadVersionNums(data,toolname)
{	
	var currentTool = jmespath.search(data, "ossTools[?toolName=='" + toolname + "']");
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var minors ="";
	var minorversionlist = $('#SelectVersionNo');
	var indx=1;
	var getminver="";
	minorversionlist.empty();
	minorversionlist.append('<option selected="true" value="0">Select Version</option>');
	for (a=0; a < majorVersions.length; a++)
	{
		minors = majorVersions[a].minorVersions;
		//for (b in minors){
		for(b=0; b < minors.length; b++) {
			if( minors[b].minorVersion)
			{
				getminver = String(minors[b].minorVersion);
				//console.log("min versions not undefine : "+ getminver);
			}
			else if(minors[b].minorVersions )
			{
				getminver = String(minors[b].minorVersions);	
				//console.log("min versions are : "+ getminver);				
			}
			
			//getminver = (minors[b].minorVersion != "undefined" ) ? (minors[b].minorVersion) : (minors[b].minorVersions);
			minorversionlist.append('<option value="' + indx + '" style="color:'+setcolor(minors[b].colourCode)+';">' + getminver + '</option>');
			//****************option item """"color"'""""""
			indx++;
			
		}
		
		
	}
	
	/*$.each(myOptions, function(val, text) {
		mySelect.append(
			$('<option></option>').val(val).html(text)
		);
	});*/
	
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

function setcolor(colorname)
{
	var colorcode;
	
	if(((colorname).trim()).toUpperCase() == "AMBER")
	{
		colorcode = "#375e97";
	}	
	else if (((colorname).trim()).toUpperCase() == "GREEN")
	{
		colorcode ="#00994c";
	}
	else if (((colorname).trim()).toUpperCase() == "RED")
	{
		colorcode = "#ff0000";
	}
	return colorcode;
}
function setmajbgopacitycolor(colorname)
{
	var colorcode;
	
	if(((colorname).trim()).toUpperCase() == "AMBER")
	{
		//colorcode = "rgb(255, 165, 0, 0.3)";
		colorcode = "#c7d5eb";
	}	
	else if (((colorname).trim()).toUpperCase() == "GREEN")
	{
		//colorcode ="rgb(0, 153, 76, 0.3)";
		colorcode = "#B2E0C9";
	}
	else if (((colorname).trim()).toUpperCase() == "RED")
	{
		//colorcode = "rgb(255, 0, 0, 0.3)";
		colorcode = "#FFB2B2";
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
document.getElementById("SelectedTool").innerHTML = "Tool :  "+toolname;
toolresource ="<br/><a href=\"javascript:void(0)\" onclick=\"window.open(\'\',\'_new\').location.href=\'https://ossrepository.gov.in/toollister/file-list.php?tool="+encodevalue(toolname)+"&tool_id="+encodevalue(toolId)+"&user_role="+encodevalue(roleid)+"&user_id="+encodevalue(userid)+"\';return false;\" target=\"_blank\">Download</a>&nbsp;&nbsp;&nbsp;&nbsp;";
	
	$("#ToolResource").empty().append(toolresource);

}
