
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
		rethtml=rethtml + "<a href=\""+versionlinksarr[i]+"\" target=\"_blank\" style=\"color:#00bfff;\">" + versionlinksarr[i] + "</a>,&nbsp;&nbsp;";
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

function selectOneRequest(data,choiceOption) 
{
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
accorhtml = accorhtml + "<div class=\"accordion\"><div style=\"font-size:14px;\">" + choiceOption + "&nbsp;(<strong style=\"color:\#00994C;\">"+seggregate(jmespath.search(majorVersions,"[].minorVersions[?colourCode=='GREEN'].minorVersion | []"))	+"</strong>)<span style=\"float:right;height:auto;\"> Last update on: " + dateymd_to_dmy(currentTool[0].infoAsOn) +"</span></div><div class=\"card-body\" style=\"overflow-wrap: break-word;\"><p><div style=\"display: block;float: right;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://10.163.14.63/toollister/?tool="+decodetoolname(choiceOption)+"\" target=\"_blank\"><img src=\"images/download1.gif\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"et\" style=\"\">&nbsp;&nbsp;<img src=\"images/advisory6.png\" style=\"height:25px;\" ></img>&nbsp;&nbsp;<div class=\"et-left et-arrow\" id=\"ttcontent\" style=\" font-size:12px;position:absolute;z-index:10;\"><i>Advisory</i> <br/> Upgrade : "+advisory+"</div></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"\" data-toggle=\"modal\" data-target=\"#myModal\"><img src=\"images/subscribe.png\" style=\"height:25px;\" ></img></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></p>"
				//<div class="et">Hover me<div class="et-bottom" id="ttcontent">Its Advisory</div></div></br>

	accorhtml = accorhtml + "<div><table class=\"table table-bordered table-hover table-condensed\"><tbody><tr><th>Functional Domain </th><td> " + currentTool[0].functionalDomain +"</td></tr>"
	accorhtml = accorhtml + "<tr><th>Stack Relevance </th><td> "+nodearrayvalues(currentTool[0].stackRelevance)+"</td></tr>"
	accorhtml = accorhtml + "<tr><th>License </th><td> " +nodearrayvalues(currentTool[0].license)+"</td></tr>"
	accorhtml = accorhtml + "<tr><th>Digital Nic Id </th><td> " +currentTool[0].digitalNicId+"</td></tr>"
	accorhtml = accorhtml  + "<tr><th>Community URL </th><td> <a href=\""+currentTool[0].communityURL+"\" target=\"_blank\" style=\"color:#00bfff;\">" + currentTool[0].communityURL + "</a></td></tr>"
	accorhtml = accorhtml  + "<tr><th>Version Information Link </th><td style=\"word-break: break-all;\"> " + setversionlinks(currentTool[0].versionInformationLink) + "</td></tr>"
	
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
	  accorhtml = accorhtml + "<tr style=\"color:#ffbf00;\"><th>Still Supported Version(s) </th><td class=\"comment more\" style=\"word-break: break-all;\"> <strong> (" + colorCount + ")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong>" + colorCurrentList + "</strong></td></tr>"
	 else if (colorCount > 0 && colourCodes[color] == "RED"  )
	  accorhtml = accorhtml + colourCodes[color] + "<tr style=\"color:#ff0000;\"><th>UnSupported Versions</th><td style=\"word-break: break-all;\"> <strong> (" + colorCount + ")&nbsp;&nbsp;</strong> ::&nbsp;&nbsp;<strong>" + colorCurrentList + "</strong></td></tr>"
	// todisplay = todisplay + colourCodes[color] + ":" + colorCount + " "

	}

	accorhtml = accorhtml + "</tbody></table></div><br/>"+majorminoraccordions(data,choiceOption)+"</div></div>"
				
	//console.log(toolNameList);
//accorhtml = accorhtml + "</div></div>"

//console.log(accorhtml);
return(accorhtml);
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

function decodetoolname(toolname)
{
	//alert(toolname);
	var encodedval = window.btoa(toolname);
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
	majminaccords = majminaccords + "<button id=\""+setMajverbtnId(toolname,majorVersions[k].majorVersion)+"\" class=\"btn btn-default border border-light\" data-toggle=\"modal\" data-target=\"#minorVersionsModal\" onclick=\"onmajVerbtnclick(this.id,\'"+toolname+"\',\'"+majorVersions[k].majorVersion+"\')\"><div class=\"majVersion table-responsive\"><table class=\"table table-bordered\"><tbody><tr><th>Major Version </th><td> " + majorVersions[k].majorVersion +"</td></tr>"
	majminaccords = majminaccords + "<tr><th>End of Life </th><td> "+dateymd_to_dmy(majorVersions[k].advisory.endOfLife)+"</td></tr></tbody></table></div></button>"
	}
	return majminaccords;
}
//onclick=\"onmajVerbtnclick(this.id,\""+toolname+"\",\""+majorVersions[k].majorVersion+"\")\"
function onmajVerbtnclick(clickedid, selectedtoolname, majVersion )
{
	var meta_data;
	$('.accordion').collapse();
	meta_data = getmetadata();
	//var majverclicked = $(this).attr('id');
	//alert("clicked version "+clicked_id);
	//alert("td value 1 "+$("#"+clicked_id).next().next().next().next('tr').find("td:eq(1)").val());
	var Row = document.getElementById(clickedid);
	var Cells = Row.getElementsByTagName("td");
	document.getElementById("minVerSelectedTool").innerHTML = "Tool :  "+selectedtoolname;
	document.getElementById("minVerSelectedToolMajVer").innerHTML = "Major Version : "+majVersion;

	var currentTool = jmespath.search(meta_data, "ossTools[?toolName=='" + selectedtoolname + "']");
    var majorVersions = jmespath.search(currentTool[0],"majorVersions[]");
	var minors ="";
	var minversaccordhtml="";
	var minversaccordhtml_h = "";
	var minversaccordhtml_b = "";
	var minversmaxnodeindx=0;
	var minversnodecount=0;
	var endofuseflag = 0;
	for (a=0; a < majorVersions.length; a++)
	{
		if(majorVersions[a].majorVersion == majVersion)
		{
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
			minversaccordhtml = minversaccordhtml + "</tbody></table></div>";
		}
		
		//alert("max nodes minvers index is "+minversmaxnodeindx);
		//for (b in minors){
		
	}
	//alert("index "+minversmaxnodeindx+" nodecount "+minversnodecount);
	//disoneaccordion("minVerAccordionForSelectedTool",minversaccordhtml);
	disoneaccordion_expanded("minVerAccordionForSelectedTool",minversaccordhtml, clickedid);

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
				console.log("min versions not undefine : "+ getminver);
			}
			else if(minors[b].minorVersions )
			{
				getminver = String(minors[b].minorVersions);	
				console.log("min versions are : "+ getminver);				
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

function setcolor(colorname)
{
	var colorcode;
	if(((colorname).trim()).toUpperCase() == "AMBER")
	{
		colorcode = "#ffbf00";
	}	
	else if (((colorname).trim()).toUpperCase() == "GREEN")
	{
		colorcode ="#00994C";
	}
	else if (((colorname).trim()).toUpperCase() == "RED")
	{
		colorcode = "#FF0000";
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


