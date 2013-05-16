var list="";

function showPrompt(camp,forma)
{
$("<div>").attr("id","showPrompt").appendTo("body");
$("#showPrompt").dialog({ buttons: { "Cancel": function() { $(this).dialog("close"); },"Ok":function(){
	$("#"+camp).val($("#prompt_name").val());
	$("#"+forma).sumbit();

} } ,autoOpen:false, modal:true});
$("#showPrompt").dialog("open");
$("#showPrompt").dialog( "option", "title", "Introduceti nume" );
$("#showPrompt").html("Introduceti numele persoanei care semneaza<br/><input type='text' id='prompt_nume'/>");
}


function open_folder(address)
	{
	window.location=address;
	}

function make_request(href,type,id) {
			/*href:adresa;
			  type:list,thumb;
			  id:id-ul div-ului, stanga sau dreapta*/
			  
			$.ajax({
		   type: "GET",
		   url: href,
		   data: ({ div_id:id	}),
			ajaxStart: function(){
			$('#loading').css("visibility","visible");
			},
			
		   success: function(transport){
			$('#loading').css("visibility","visible");
			$('#'+id).html(transport);
			
		$.tablesorter.addParser({ 
        // set a unique id 
        id: 'size', 
        is: function(s) { 
            // return false so this parser is not auto detected 
            return false; 
        }, 
        format: function(s) { 
            // format your data for normalization 
			s = s.split(",").join("");
			//alert(s);
            return s; 
        }, 
        // set type, either numeric or text 
        type: 'numeric' 
    }); 
			
		 $("#left #tabel").tablesorter({debug:false,headers: { 
                3: { 
                    sorter:'size' 
                } 
            } });
		 $("#left #link").click(function() { 
                var sorting = [[1,0]]; 
				$("#left #tabel").trigger("sorton",[sorting]); 
                return false; 
    }); 
		$("#left #ext").click(function() { 
                var sorting = [[2,0]]; 
				$("#left #tabel").trigger("sorton",[sorting]); 
                return false; 
    }); 
		$("#left #size").click(function() { 
                var sorting = [[3,0]]; 
				$("#left #tabel").trigger("sorton",[sorting]); 
                return false; 
    });
	
		$("#right #tabel").tablesorter({debug:false,headers: { 
                3: { 
                    sorter:'size' 
                } 
            } });
		 $("#right #link").click(function() { 
                var sorting = [[1,0]]; 
				$("#right #tabel").trigger("sorton",[sorting]); 
                return false; 
    }); 
		$("#right #ext").click(function() { 
                var sorting = [[2,0]]; 
				$("#right #tabel").trigger("sorton",[sorting]); 
                return false; 
    }); 
		$("#right #size").click(function() { 
                var sorting = [[3,0]]; 
				$("#right #tabel").trigger("sorton",[sorting]); 
                return false; 
    });
			//$("#tabel").trigger("update");
			
			
			
			//evnts();
		   }
		 });	
	}

function upload_file(file_target)
{

			$('#loading').dialog("open");
			$( "#loading" ).dialog( "option", "height", "auto" );
			$( "#loading" ).dialog( "option", "width", 465 );
			$( "#loading" ).dialog( "option", "title", "Upload files" );
			$( "#loading" ).dialog( "option", "position", ['center','middle'] );
			$('#loading').html("<center><img src='php_manager/images/loader.gif'><BR>Loading...");
			//$('#loading').load("php_manager/content/upload.php?target="+urlencode(file_target));
			$.ajax({
		   type: "GET",
		   url: "php_manager/content/upload.php",
		   data: ({ trgt:file_target
					
				}),
			
		   success: function(transport){
			
			//$('#loading').html("");
			
			$('#loading').html(transport);
			
		
			
			
			
		   }
		 });
			
			
			

}


function mkdir()
{
if($(".ui-selected").parent().parent().parent().parent().attr("id")=="left")
				{
				var source = $("#path_left").text()+"/"+$("#new_folder_name").val();
			    //var destination = $("#path_right").text();
				}
			else
				{
				var source = $("#path_right").text()+"/"+$("#new_folder_name").val();
			    //var destination = $("#path_left").text();
				}
				
				
			$.ajax({
		   type: "GET",
		   url: "php_manager/content/mkdir.php",
		   data: ({ src:source
				}),
			ajaxStart: function(){
							
			
			},
			beforeSend: function(){
			$('#loading').dialog("open");
				//$('#loading').html("<center>Are you sure you want to "+act+" the selected files? <BR> <button id='ok'>Ok</button><button id='cancel'>Cancel</button>");
				
				$('#loading').html("<center><img src='php_manager/images/loader.gif'><BR>Please wait...");
			
			},
		   success: function(transport){
			
			$('#loading').html("");
			
			$('#loading').html(transport);
			
			make_request($("#left").find("#url").text(),"","left");
			make_request($("#right").find("#url").text(),"","right");
			
			//$('#'+id).html(transport);
			
			//evnts();
		   }
		 });

}
function edit_file()
{
if($(".ui-selected").find(".ext").text()!="<dir>")
{
//alert($(".ui-selected").find(".ext").text());
if($(".ui-selected").parent().parent().parent().parent().attr("id")=="left")
				{
				var source = $("#path_left").text();
				}
				else
				{
				var source = $("#path_right").text();
				}

var fisier = source+$(".ui-selected").children().eq(1).text()+"."+$(".ui-selected").children().eq(2).html();
//alert($(".ui-selected").children().eq(2).html());
if($(".ui-selected").children().eq(2).html()!=null)
	$.ajax({
		   type: "POST",
		   url: "php_manager/content/edit.php",
		   data: ({ file:fisier,action:'view'}),
			ajaxStart: function(){
							
			
			},
			beforeSend: function(){
			$('#loading').dialog("open");
			$( "#loading" ).dialog( "option", "height", 465 );
			$( "#loading" ).dialog( "option", "width", 710 );
			$( "#loading" ).dialog( "option", "title", "Edit file - "+fisier );
			$( "#loading" ).dialog( "option", "position", ['center','middle'] );
		
				//$('#loading').html("<center>Are you sure you want to "+act+" the selected files? <BR> <button id='ok'>Ok</button><button id='cancel'>Cancel</button>");
				
				$('#loading').html("<center><img src='php_manager/images/loader.gif'><BR>Please wait...");
			
			},
		   success: function(transport){
				//$('#loading').html("");
		//alert('ceva');		
				$('#loading').html(transport);
			
			//make_request($("#left").find("#url").text(),"","left");
			//make_request($("#right").find("#url").text(),"","right");
			
			//$('#'+id).html(transport);
			
			//evnts();
		   }
		 });


}
}

function save_file(){

var contents = $("#file_content").val();
//var fisier = $( "#loading" ).dialog( "option", "title");
var fisier = $( "#file_path").val();

$.ajax({
		   type: "POST",
		   url: "php_manager/content/edit.php",
		   data: ({ 
					file:fisier, 
					content:contents,
					action:'save'
					}),
		   ajaxStart: function(){
		   
		   },
		   beforeSend: function(){
		   
		   $("#progress").text("Saving file...");
		   $("#progress").fadeIn();
		   
		   },
		   success: function(transport){
		   $("#progress").text("File saved!");
		   $("#progress").fadeIn();
		   }
			
});
}				

function new_file_name(){

			$('#file_name').dialog("open");
			$( "#file_name" ).dialog( "option", "height", 265 );
			$( "#file_name" ).dialog( "option", "width", 360 );
			$( "#file_name" ).dialog( "option", "title", "New file name" );
			$( "#file_name" ).dialog( "option", "position", ['center','middle'] );
				//$('#loading').html("<center>Are you sure you want to "+act+" the selected files? <BR> <button id='ok'>Ok</button><button id='cancel'>Cancel</button>");
				
				$('#file_name').html("New file name: <input type='text' id='new_name' name='new_name'/><br/>"+
				"<center><table cellpadding='15'><tr><td><center><a href='javascript:' id='ok_file'>"+
				"<img src='php_manager/images/icons/actions/apply-48.png'><BR>Ok</a><td><center>"+
				"<a href='javascript:' id='cancel_file'>"+
				"<img src='php_manager/images/icons/actions/button_cancel-48.png'><BR>Cancel</a></table>");	

			$('#ok_file').click(function(){
			
			save_file_as();
			$('#file_name').dialog("close");$('#file_name').html();
			
			});
			$('#cancel_file').click(function(act){$('#file_name').dialog("close");$('#file_name').html();});
	
}

function save_file_as(){

var contents = $("#file_content").val();
//var fisier = $( "#loading" ).dialog( "option", "title");
var path = $( "#file_path").val().substring(0,$( "#file_path").val().lastIndexOf("/"));
if($("#new_name").val().lastIndexOf(".")==-1)
	var nume_fisier = $("#new_name").val();
else
	var nume_fisier = $("#new_name").val().substring(0,$("#new_name").val().lastIndexOf("."));

var extensie = $( "#file_path").val().substring($( "#file_path").val().lastIndexOf("."));

var fisier = path +"/"+ nume_fisier + extensie;


//alert(fisier);
//alert($("#new_name").val().substring(0,$("#new_name").val().lastIndexOf(".")) + $( "#file_path").val().substring($( "#file_path").val().lastIndexOf(".")));
//alert($( "#file_path").val());

$.ajax({
		   type: "POST",
		   url: "php_manager/content/edit.php",
		   data: ({ 
					file:fisier, 
					content:contents,
					action:'save_as'
					}),
		   ajaxStart: function(){
		   
		   },
		   beforeSend: function(){
		   
		   $("#progress").text("Saving file...");
		   $("#progress").fadeIn();
		   
		   },
		   success: function(transport){
		   $("#progress").text("File saved!");
		   $("#progress").fadeIn();
		   make_request($("#left").find("#url").text(),"","left");
			make_request($("#right").find("#url").text(),"","right");
		   
		   }
			
});
}				

function copy_file(act) {
			/*href:adresa;
			  type:list,thumb;
			  id:id-ul div-ului, stanga sau dreapta*/
			  
			 var list="";
			 var file_list = [{"name":"","ext":""}];
			 $(".ui-selected").each(function(i,sel){
			 
			 var item = { 
					"name":$(this).children().eq(1).text(), 
					"ext": $(this).children().eq(2).html()};
					
			 file_list[file_list.length] = item;
					
					/*var data = 
						  { "list": [ 
							  { "name" : "John", "ext" : "Brown" },
							  { "firstname" : "Marc", "lastname" : "Johnson" }
							] // end of sales array
						  }*/
					
				 /*if($(this).children().eq(2).text()=="<dir>")
					list+= $(this).children().eq(1).text() + "<BR>";
				 else{
					list+= $(this).children().eq(1).text() + "." +$(this).children().eq(2).html() + "<BR>";
				 }*/
			
			}); 
			
			
			

			if($(".ui-selected").parent().parent().parent().parent().attr("id")=="left")
				{
				var source = $("#path_left").text()+"/";
			    var destination = $("#path_right").text();
				}
			else
				{
				var source = $("#path_right").text()+"/";
			    var destination = $("#path_left").text();
				}
				
				var lst = $.param(file_list);
			$.ajax({
		   type: "GET",
		   url: "php_manager/content/copy.php",
		   data: ({ src:source,
					dest:destination,
					file_lst:serialize(file_list),
					action:act
					//an:an,
					//tip:tip
				}),
			ajaxStart: function(){
							
			
			},
			beforeSend: function(){
			$('#loading').dialog("open");
			
				//$('#loading').html("<center>Are you sure you want to "+act+" the selected files? <BR> <button id='ok'>Ok</button><button id='cancel'>Cancel</button>");
				
				$('#loading').html("<center><img src='php_manager/images/loader.gif'><BR>Please wait...");
			
			},
		   success: function(transport){
			
			$('#loading').html("");
			
			$('#loading').html(transport);
			
			make_request($("#left").find("#url").text(),"","left");
			make_request($("#right").find("#url").text(),"","right");
			
			//$('#'+id).html(transport);
			
			//evnts();
		   }
		 });
	}

function cpy(act)
{	//alert($(".ui-selected").length);
	if($(".ui-selected").length>0)
	{
	$('#loading').dialog("open");
	$( "#loading" ).dialog( "option", "height", "auto" );
	$( "#loading" ).dialog( "option", "width", 465 );
	$( "#loading" ).dialog( "option", "position", ['center','middle'] );
	
	if(act!="mkdir")
	{
		$( "#loading" ).dialog( "option", "title", act+" files" );
		
		var lista="";

		$(".ui-selected").each(function(i,sel)
		{
				lista+= $(this).children().eq(1).text()+"."+$(this).children().eq(2).html()+"<BR>";
					});

		$("#loading").attr("title","ceeeee");
		$('#loading').html(
		"<center>Are you sure you want to "+act+" the selected files?</center> <BR>"+
		""+lista+
		"<center><table cellpadding='15'><tr><td><center><a href='javascript:' id='ok'>"+
		"<img src='php_manager/images/icons/actions/apply-48.png'><BR>Ok</a><td><center>"+
		"<a href='javascript:' id='cancel'>"+
		"<img src='php_manager/images/icons/actions/button_cancel-48.png'><BR>Cancel</a></table>");	

		$('#ok').click(function(){
		//alert(act);
		copy_file(act);

		});
		$('#cancel').click(function(act){$('#loading').dialog("close");$('#loading').html();});
	}	
	else
	{
		$( "#loading" ).dialog( "option", "title", "Create Directory" );
		$('#loading').html(
		"New folder: <input type='text' id='new_folder_name' style='width:170px;'> <BR>"+
		"<center><table cellpadding='15'><tr><td><center><a href='javascript:' id='ok'>"+
		"<img src='php_manager/images/icons/actions/apply-48.png'><BR>Ok</a><td><center>"+
		"<a href='javascript:' id='cancel'>"+
		"<img src='php_manager/images/icons/actions/button_cancel-48.png'><BR>Cancel</a></table>");	

		$('#ok').click(function(){
		//alert(act);
		mkdir();

		});
		$('#cancel').click(function(act){$('#loading').dialog("close");$('#loading').html();});
	}
	}
}




function thumbs()
{
//e o problema cu linia 88 din direct.php, prea multe chestii in url

/*if($(".ui-selected").parent().parent().parent().parent().attr("id")=="right")
	{
	if(strstr($("#right").find("#url").text(),"&thumb=true")==false)
		make_request($("#right").find("#url").text()+"&thumbs=true","","right");
	else
		make_request(substr($("#right").find("#url").text(),0,strpos($("#right").find("#url").text(),"&thumbs=true")),"","right");
	}
else 
	{
	if(strstr($("#left").find("#url").text(),"&thumb=true")==false)
		make_request($("#left").find("#url").text()+"&thumbs=true","","left");
	else
		make_request(substr($("#left").find("#url").text(),0,strpos($("#left").find("#url").text(),"&thumbs=true")),"","left");
	}
*/
	var txt = $("#left").find("#url").text();
	var vect = new Array();
	vect = explode("&",txt);
	var i = array_search("thumbs=true",vect);
	//alert(vect[0]);
	if(i)
		{
		//alert('ca');
		vect[i]="";
		path = implode("&",vect);
		
		
//$("#left").css("width","450px");
$("#right").animate({width: "450px"},500);
$("#left").animate({width: "450px"},500);
//$("#right").css("display","block");
$("#path_right").css("display","block");
make_request(path,"","left");
		}
	else
		{
		path = txt+"&thumbs=true";
		$("#left").html("<center><img src='php_manager/images/loader.gif'><BR>Please wait...");
		make_request(path,"","left");
//$("#left").css("width","900px");
$("#right").animate({width: "0px"},500);
$("#left").animate({width: "900px"},500);
//$("#right").css("display","none");
$("#path_right").css("display","none");
		}
	





}

function admin_modifica(event)
{
//alert("cucu");
var usr_name = $(event.target).parent().siblings().eq(0).text();
//alert(usr_name);
$.ajax({
		   type: "POST",
		   url: "php_manager/content/admin.php",
		   data: ({ modify:'modify',username:usr_name,password:$("#parola_modifica").val()}),
			ajaxStart: function(){
							
			
			},
			beforeSend: function(){
						
			},
		   success: function(transport){
			admin('view','',this);
			//$('#loading').html(transport);
			
					
			
		   }
		 })
}


function admin(act,param,event)
{
if(act=="view")
	{
	$('#loading').dialog("open");
	
	$( "#loading" ).dialog( "option", "height", "auto" );
	$( "#loading" ).dialog( "option", "width", "auto" );
	$( "#loading" ).dialog( "option", "position", ['center','middle'] );
	$( "#loading" ).dialog( "option", "title", "Admin" );
	//$('#loading').html();
	$('#loading').load("php_manager/content/admin.php");
	}
if(act=="add")
	{
	$.ajax({
		   type: "POST",
		   url: "php_manager/content/admin.php",
		   data: ({ add:'add',username:$("#admin_nume").val(),password:$("#admin_parola").val()}),
			ajaxStart: function(){
							
			
			},
			beforeSend: function(){
						
			},
		   success: function(transport){
			admin('view','',this);
			//$('#loading').html(transport);
			
					
			
		   }
		 })
	}
if(act=="modify")
	{
	//alert($(event.target).parent().siblings().eq(1).html());
	
	$(event.target).parent().siblings().eq(1).html("<input type='text' name='parola_modifica' id='parola_modifica'/><input type='button' name='modifica_ok' id='modifica_ok' onclick='admin_modifica(event)' value='Ok'>");
	}
if(act=="delete")
	{
	$.ajax({
		   type: "POST",
		   url: "php_manager/content/admin.php",
		   data: ({ del:'delete',username:$(event.target).parent().siblings().eq(0).text()}),
			ajaxStart: function(){
							
			
			},
			beforeSend: function(){
						
			},
		   success: function(transport){
			admin('view','',this);
			//$('#loading').html(transport);
			
					
			
		   }
		 })
	}


}

function serialize (mixed_value) {
    // http://kevin.vanzonneveld.net
    // +   original by: Arpad Ray (mailto:arpad@php.net)
    // +   improved by: Dino
    // +   bugfixed by: Andrej Pavlovic
    // +   bugfixed by: Garagoth
    // +      input by: DtTvB (http://dt.in.th/2008-09-16.string-length-in-bytes.html)
    // +   bugfixed by: Russell Walker (http://www.nbill.co.uk/)
    // +   bugfixed by: Jamie Beck (http://www.terabit.ca/)
    // +      input by: Martin (http://www.erlenwiese.de/)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // -    depends on: utf8_encode
    // %          note: We feel the main purpose of this function should be to ease the transport of data between php & js
    // %          note: Aiming for PHP-compatibility, we have to translate objects to arrays
    // *     example 1: serialize(['Kevin', 'van', 'Zonneveld']);
    // *     returns 1: 'a:3:{i:0;s:5:"Kevin";i:1;s:3:"van";i:2;s:9:"Zonneveld";}'
    // *     example 2: serialize({firstName: 'Kevin', midName: 'van', surName: 'Zonneveld'});
    // *     returns 2: 'a:3:{s:9:"firstName";s:5:"Kevin";s:7:"midName";s:3:"van";s:7:"surName";s:9:"Zonneveld";}'

    var _getType = function (inp) {
        var type = typeof inp, match;
        var key;
        if (type == 'object' && !inp) {
            return 'null';
        }
        if (type == "object") {
            if (!inp.constructor) {
                return 'object';
            }
            var cons = inp.constructor.toString();
            match = cons.match(/(\w+)\(/);
            if (match) {
                cons = match[1].toLowerCase();
            }
            var types = ["boolean", "number", "string", "array"];
            for (key in types) {
                if (cons == types[key]) {
                    type = types[key];
                    break;
                }
            }
        }
        return type;
    };
    var type = _getType(mixed_value);
    var val, ktype = '';
    
    switch (type) {
        case "function": 
            val = ""; 
            break;
        case "boolean":
            val = "b:" + (mixed_value ? "1" : "0");
            break;
        case "number":
            val = (Math.round(mixed_value) == mixed_value ? "i" : "d") + ":" + mixed_value;
            break;
        case "string":
            mixed_value = this.utf8_encode(mixed_value);
            val = "s:" + encodeURIComponent(mixed_value).replace(/%../g, 'x').length + ":\"" + mixed_value + "\"";
            break;
        case "array":
        case "object":
            val = "a";
            /*
            if (type == "object") {
                var objname = mixed_value.constructor.toString().match(/(\w+)\(\)/);
                if (objname == undefined) {
                    return;
                }
                objname[1] = this.serialize(objname[1]);
                val = "O" + objname[1].substring(1, objname[1].length - 1);
            }
            */
            var count = 0;
            var vals = "";
            var okey;
            var key;
            for (key in mixed_value) {
                ktype = _getType(mixed_value[key]);
                if (ktype == "function") { 
                    continue; 
                }
                
                okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key);
                vals += this.serialize(okey) +
                        this.serialize(mixed_value[key]);
                count++;
            }
            val += ":" + count + ":{" + vals + "}";
            break;
        case "undefined": // Fall-through
        default: // if the JS object has a property which contains a null value, the string cannot be unserialized by PHP
            val = "N";
            break;
    }
    if (type != "object" && type != "array") {
        val += ";";
    }
    return val;
}