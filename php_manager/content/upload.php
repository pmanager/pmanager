



<link href="php_manager/style/defaulta.css" rel="stylesheet" type="text/css" />
<link href="php_manager/style/uploadify.css" rel="stylesheet" type="text/css" />
<!--<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>-->
<script type="text/javascript" src="php_manager/javascript/swfobject.js"></script>
<script type="text/javascript" src="php_manager/javascript/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$("#uploadify").uploadify({
		'uploader'       : 'php_manager/style/uploadify.swf',
		'script'         : 'php_manager/content/uploadify.php',
		'cancelImg'      : 'php_manager/style/cancel.png',
		'buttonImg'      : 'php_manager/images/icons/actions/upload_05.png',
		'folder'         : '<? echo urlencode($_GET['trgt']); ?>',
		'queueID'        : 'fileQueue',
		'displayData'	 : 'speed',
		'method'		 : 'GET',
		'auto'           : false,
		'multi'          : true,
		'onAllComplete'  : function(){make_request($("#left").find("#url").text(),"","left");
			make_request($("#right").find("#url").text(),"","right");}
	});
});
</script>



<? //echo substr(substr($_GET['trgt'],0,-1),2)." - ".$_SERVER['DOCUMENT_ROOT']; ?>
<table>
	<tr>
		<td>
		<input type="file" name="uploadify" id="uploadify" />
		</td>
		<td>
			<a href="javascript:$('#uploadify').uploadifyUpload()"><img src="php_manager/images/icons/actions/upload_03.png" style="width:118px;"/></a>
		</td>
		<td>
			<a href="javascript:jQuery('#uploadify').uploadifyClearQueue()"><img src="php_manager/images/icons/actions/upload_07.png" style="width:113px;"/></a>
		</td>
	</td>
</table>
<div id="fileQueue"></div>









