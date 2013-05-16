<?
if(!isset($_SESSION['pmanager_logged']))
	header("location:index.php");

?>

<html>
<head>
	 <style type="text/css">
#tabel .ui-selecting {
	background: white;
}
#tabel .ui-selected {
	background: white;
}
</style>

	<script type="text/javascript" src="php_manager/javascript/jquery.js"></script>
	<script type="text/javascript" src="php_manager/javascript/php.default.min.js"></script>
	<script type="text/javascript" src="php_manager/javascript/ui.core.js"></script>
	<script type="text/javascript" src="php_manager/javascript/ui.selectable.js"></script>
	<script type="text/javascript" src="php_manager/javascript/ui.resizable.js"></script>
	<script type="text/javascript" src="php_manager/javascript/ui.draggable.js"></script>
	<script type="text/javascript" src="php_manager/javascript/ui.dialog.js"></script>
	
	<script type="text/javascript" src="php_manager/javascript/jquery.lightbox-0.5.js"></script>
	
	<!--
	<script type="text/javascript" src="php_manager/javascript/ui.selectable.js"></script>
	
	
	<script type="text/javascript" src="php_manager/javascript/jquery.disable.text.select.js"></script>-->
	<script type="text/javascript" src="php_manager/javascript/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="php_manager/javascript/functions.js"></script>
	
	<link rel="stylesheet" href="php_manager/style/jquery.lightbox-0.5.css" type="text/css" />
	<link rel="stylesheet" href="php_manager/style/style.css"  type="text/css" />  
	<link rel="stylesheet" href="php_manager/style/jquery_style.css"  type="text/css" /> 
	
	
	
	<script>
	$(document).ready(function () {
	//$("#loading").resizable();
	//$("#loading").draggable();
	$("#loading").dialog({ autoOpen: false });
	$("#admin").dialog({autoOpen:false});
	$("#file_name").dialog({autoOpen:false});
	$("#question").dialog({ buttons: { "Ok": function() { $(this).dialog("close"); } } ,autoOpen:false, modal:true});
	
	
    make_request("php_manager/direct.php","","left");
	make_request("php_manager/direct.php","","right");
	 
	 $("#upload_link").click(
			function()
				{
				if($(".ui-selected").parent().parent().parent().parent().attr("id")=="left")
					upload_file($('#path_left').text());
				else
					upload_file($('#path_right').text());
				}
		);
	
	/*	$("#link").click(function() { 
                var sorting = [[1,0]]; 
                $("table").trigger("sorton",[sorting]); 
                return false; 
    }); 
		$("#ext").click(function() { 
                var sorting = [[2,0]]; 
                $("table").trigger("sorton",[sorting]); 
                return false; 
    }); 
		$("#size").click(function() { 
                var sorting = [[3,0]]; 
                $("table").trigger("sorton",[sorting]); 
                return false; 
    });*/ 
	 
	
	 
	 
	 //make_request("php_manager/direct.php","","right");
	 //$("button").button();
});
	
	//$("#tabel").tablesorter({debug:false});	
	//$("#tabel").trigger("update");
	
	
	</script>
	
	
	
</head>

<body style="background:#b7c7d1;background-image:url('php_manager/images/bg.png');background-repeat:repeat-x;">

	<div class="header">
		<img src="php_manager/images/pManager.png">
	</div>
	<BR>
	<center>
	<div id="loading" >halo</div>
	<div id="question" title="Dialog">halo</div>
	<div id="file_name"></div>
	<div id="admin"></div>
	<!--<div id="loading" style="position:absolute;left:40%;top:40%;width:200px;height:100px;background:#b7c7d1;border:1px solid white">
	ceva
	</div>-->
	<div class="content" style="margin-left:10px;">
	<div id="menu_left" style="display:block;margin-left:0px;position:absolute;left:0px;top:60px;width:60px;height:520px;background-image:url('php_manager/images/corners/sidebar1.png');background-repeat:repeat-y;border:1px solid black;border-left-width:0px;padding-top:5px;padding-bottom:5px;">
	<!--<a href="javascript:showPrompt();"><img src="php_manager/images/icons/actions/editcopy-48.png"><br/>PROMPT</a>
	<BR><BR>-->
		<a id="upload_link" href="javascript:"><img src="php_manager/images/icons/actions/up-48.png"><br/>UPLOAD</a>
	<br><BR>
	<a href="javascript:cpy('copy');"><img src="php_manager/images/icons/actions/editcopy-48.png"><br/>COPY</a>
	<BR><BR>
	<a href="javascript:cpy('move');"><img src="php_manager/images/icons/actions/editpaste-48.png"><br/>MOVE</a>
	<BR><BR>
	<a href="javascript:cpy('delete');"><img src="php_manager/images/icons/actions/cnrdelete-all1-48.png"><br/>DELETE</a>
	<BR><BR>
	<a href="javascript:cpy('mkdir');"><img src="php_manager/images/icons/actions/folder_new-48.png"><br/>(MKDIR)</a>
	<BR><BR>
	
	<a href="javascript:thumbs();"><img src="php_manager/images/icons/actions/thumbnail-48.png"><br/>THUMBS</a>
	<BR><BR>
	<a href="javascript:edit_file();"><img src="php_manager/images/icons/actions/edit.png"><br/>EDIT</a>
	<BR><BR>
	<a href="javascript:window.location='index.php?logout=true';"><img src="php_manager/images/icons/actions/logout.png"><br/>LOGOUT</a>
	
	
	<?if($_SESSION['is_admin']==1){?>
		<BR><BR>
		<a href="javascript:admin('view','',this);"><img src="php_manager/images/icons/actions/admin.png"><br/>ADMIN</a>
	<?}?>
	
	</div>
		<center><BR>
	
				<!-- ----------------------------------THIS IS CONTENT-->
		<table style="border:1px solid #e3eff6;padding:6px;-webkit-box-shadow: 1px 2px 0px white; ">
			<tr>
			<td>
				<div id="path_left" style="font-family:arial;font-size:9pt;color:black;font-weight:regular;margin-top:0px;margin-left:3px;margin-bottom:10px;">Path \ to \ folder</div>
				<div id="left" style="height:500px;width:450px;overflow:hidden;"></div>
			</td>
			<td>
				<div id="path_right" style="font-family:arial;font-size:9pt;color:black;font-weight:regular;margin-top:0px;margin-left:3px;margin-bottom:10px;">Path \ to \ folder</div>
				<div id="right" style="height:500px;width:450px;overflow:hidden;"></div>
			</td>
			</tr>
		</table>
		
				<!-- -----------------------------/////THIS IS CONTENT-->
				
			
	</div>
	
</body>
<script>
 

</script>
</html>
