<?
if($_POST['action']=="view")
	{
	$fisier = file_get_contents($_POST['file']);
	//echo $fisier;

	?>
	<table cellpadding=0 cellspacing=0>

	<tr>
		<td valign=top align=middle style="padding-right:10px;">
			<a href="javascript:save_file();" style="font-size:11px;"><img src="php_manager/images/icons/actions/save.png"><br >SAVE</a>
			<BR><BR>
			<a href="javascript:new_file_name();" style="font-size:11px;"><img src="php_manager/images/icons/actions/save_as.png"><br >SAVE AS</a>
			<BR><BR>
			<a href="javascript:" onclick="$('#loading').dialog('close')" id="cancel" style="font-size:11px;"><img src="php_manager/images/icons/actions/button_cancel-48.png"><br>CANCEL</a>
		</td>
		
		<td valign=top align=middle>
			<textarea id="file_content" style="width:620px;height:400px;"><?=utf8_encode($fisier)?></textarea><br/>
			<b id="progress" style="color:grey;float:left;display:none;"></b>
			<input type="hidden" id="file_path" value="<?=$_POST['file']?>"/>
			
		</td>
	</tr>

	</table>
	<?
	}
else if($_POST['action']=="save")
	{
	$file = $_POST['file'];
	$content = $_POST['content'];
	file_put_contents($file, $content);
	
	
	
	}
else if($_POST['action']=="save_as")
	{
	$file = $_POST['file'];
	$content = $_POST['content'];
	if(file_put_contents($file, $content))
		echo "ok";
		else echo "error";
	
	}
?>