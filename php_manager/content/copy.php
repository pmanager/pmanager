<?
error_reporting(E_ALL);	
$fp = fopen('data.txt', 'w');
	
//fwrite($fp, "ceva ");	
$overwrite = "";
function recurse_delete($src) {
//global $fp;

    $dir = opendir($src);
    //@mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
	//fwrite($fp, "src: ".$src." - ".$file);
        if (( $file != '.' ) && ( $file != '..' )) {
		
            if ( is_dir($src. '/' . $file) ) {
				
                recurse_delete($src. '/' . $file);
				
            }
            else {
							
               if(unlink($src . '/' . $file)) 
			   echo "Procedure complete<br/>";
			   else 
			   echo "Error: ".$src . '/' . $file;
				}
            }
        }
    closedir($dir);
	rmdir($src);
	
	}




function recurse_copy($src,$dst) {
//global $fp;
global $overwrite;
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
			
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
				if(file_exists($dst . '/' . $file)) $overwrite[] = $dst . '/' . $file;
				
                if(copy($src . '/' . $file,$dst . '/' . $file))
				{
				echo "Procedure complete<br/>";
				//fwrite($fp, "ceva - copy($src/$file,$dst/$file)");
				if($_GET['action']=="move") unlink($src . '/' . $file); 
				}
				else{echo "error:".$src . '/' . $file." - ".$dst . '/' . $file." <BR>";}
            }
        }
    }
	
    closedir($dir);
	if($_GET['action']=="move") rmdir($src);
} 

//$source = "d:/web/NWE/banner_small.jpg";
//$destination = "d:/web/NWE/qqq.a";

/*echo "
<BR>
SERVER: ".$_SERVER['DOCUMENT_ROOT']."
<BR>
realpath: ".realpath("/")."

<BR>";*/

//$source = $_GET['src'];
$source_path = realpath($_GET['src'])."\\";
$destination_path = realpath($_GET['dest']);//."\\".substr($source,strrpos($source,"\\"),strlen($source));
$list = unserialize($_GET['file_lst']);
$source = $destination = "";

for($i=0;$i<count($list);$i++)
{
$source = $destination = "";

	if(strlen($list[$i]['name'])>0)
		{
		if($list[$i]['ext']== "&lt;dir&gt;")
			{
			//echo $source_path.$list[$i]['name']."<BR>";
			$source = $source_path.$list[$i]['name'];
			$destination = $destination_path.substr($source,strrpos($source,"\\"),strlen($source));
			//echo "$source - $destination";
			if($_GET['action']=="delete")
				recurse_delete($source);
			else
				recurse_copy($source,$destination);
			
			}
		
		else
			{
			$source = $source_path.$list[$i]['name'].'.'.$list[$i]['ext'];
			$destination = $destination_path.substr($source,strrpos($source,"\\"),strlen($source));
			
			//echo $source.$list[$i]['name'].'.'.$list[$i]['ext']."<BR>";
			//echo "copiez ".$source." - ".$destination;
			if($_GET['action']=="delete")
				{
				unlink($source);	
			echo "<BR>Procedure complete";
				}
			else
				{
				if(!copy($source,$destination))
					{
					echo "<BR>An error occured";
					}
				else {
				if($_GET['action']=="move")
				unlink($source);	
				echo "<BR>Procedure complete";
				}
				}
			}
			
		}

}


/*if(count($overwrite)>0)
	{
	echo "
	<script>
	//$('#question').dialog('open');
		//	  $('#question').html('ceva');
		
		$('#loading').html(
		\"<center>Do you want to overwrite the file: </center> <BR>\"+
		\"<center><table cellpadding='15'><tr><td><center><a href='javascript:' id='ok'>\"+
		\"<img src='php_manager/images/icons/actions/apply-48.png'><BR>Ok</a><td><center>\"+
		\"<a href='javascript:' id='cancel'>\"+
		\"<img src='php_manager/images/icons/actions/button_cancel-48.png'><BR>Cancel</a></table>\");	
	</script>";
	
	foreach($overwrite as $ov)
		{
		fwrite($fp,$ov.":");
		
		
		} //end foreach
		
	
	}// end if count
	*/

fclose($fp);
?>