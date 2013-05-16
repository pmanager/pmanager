<?include "functions.php";?>

  <link rel="stylesheet" href="style/style.css"  type="text/css" />  
  
  <style>
  body
  {
  background:<?=$bg_color?>;
  color:black;
  font-size:8pt;
  
  }
  
	
  </style>
  <title>PHP File manager</title>
  
  <link type="text/css" href="javascript/ui.all.css" rel="stylesheet" />
 <script>
 $(document).ready(function(){

 $("#left #tabel").selectable({filter:"tr",
   start: function(event, ui) { $("#right #tabel tr").removeClass("ui-selected"); }
});

$("#right #tabel").selectable({filter:"tr",
   start: function(event, ui) { $("#left #tabel tr").removeClass("ui-selected"); }
});

$("#left #tabel").selectable({tolerance:"touch",filter:"tr"});
$("#right #tabel").selectable({tolerance:"touch",filter:"tr"});






$("#tabel").contents().find("a").click(function(){

return $(this).attr("onclick");

});

});




 
 //select();
 </script>
	<!--<script src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/ui.core.js"></script>
	<script type="text/javascript" src="javascript/ui.selectable.js"></script>
	<script type="text/javascript" src="javascript/ui.resizable.js"></script>
	<script type="text/javascript" src="javascript/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="javascript/jquery.disable.text.select.js"></script>
	<script src="javascript/functions.js"></script>-->		

  


  
    
   
   
  <input type="hidden" name="list" id="list">
    <?php
	
	$root = $_SERVER['DOCUMENT_ROOT'];
	//$root = "/web/htdocs/licenta";
	//$root = "/web/".dirname($_SERVER['PHP_SELF']);
	//$root = $_SERVER['SERVER_NAME'].substr($_SERVER['DOCUMENT_ROOT'],strpos($_SERVER['DOCUMENT_ROOT'],"/"));
	//$root = $_SERVER['DOCUMENT_ROOT'];
	if(isset($_POST['rename']))
	{
	rename_function($_POST['valori']);
	}
	
	else
	if(isset($_GET['ff']))
	    direct(decrypt($_GET['ff']));
	else
		direct($root);

	echo "</div></table>";
	$ex = explode("/",$_SERVER['REQUEST_URI']);
	$ex2 = explode("&",$ex[(count($ex)-1)]);
	$res = array_unique($ex2);
	$res1 = implode("&",$res);
	
		echo "<div style='display:none' id='url'>".$ex[(count($ex)-2)]."/".$res1."</div>";	
    ?>
 
 
 
 
 
 
 
 
 
 <?php
		
		function rename_function($valori)
		{
		echo "POST[valori]: ".$valori."<BR>";
		$ex = explode("//",$valori);
		array_shift($ex);
		array_shift($ex);
		$adresa="";
		foreach($ex as $val)
		{
			$adresa.= "/".$val;
		}
		
		$adresa = $_SERVER['DOCUMENT_ROOT'].substr($adresa,0,-1);
		echo "adresa fisier: ".$adresa;
		//rename($adresa,"ceva.m3u");
		}
	
	
      function direct($c) 
	  {

		global $cur_color,$root;
		$contor=0;
		
		$imagini = array("jpg","jpeg","bmp","png","ico","gif","nef");
		$sounds = array("mp3","mp4","mp2","snd","wav","m3u","pls");
		$archive = array("rar","zip","tar","gz","ace");
        
		$fff = substr($c,0,strrpos($c,"/"));
				
        
		
		
		//Headerul de tabel
		echo '
			<table style="width:100%;overflow:hidden;" border=0>
				<tr>
					<td class="link" id="link"><a href="javascript:">Name</a></td>
					<td class="ext" id="ext"><a href="javascript:">Ext</a></td>
					<td class="size" id="size"><a href="javascript:">Size</a></td>
				</tr>
			</table>';
	
		
		//incepe div-ul de jos care e cu scroll
		// si TABLE-ul general
		echo "
		<div style='float:left;height:95%;overflow:scroll;width:100%;background:#dbe3e8;border:1px solid white' id='cumva'>
		
			<table style='width:100%;overflow:hidden;' id='tabel' border=0>
				<thead style='display:none'>
					<th>Icon</th>
					<th>Name</th>
					<th>Ext</th>
					<th>Size</th>
				</thead><tbody>";
		

		echo "<script>
		$('#path_".$_GET['div_id']."').html('".preg_replace("#/+#", "/", $c)."/');
		
		</script>";
		
		//Parent directory
		if($c!=$root)
		if(isset($_GET['thumbs']))
			  {
			  echo"	<div class='thumb'>
						<a href='javascript:' onclick='make_request(\"php_manager/direct.php?ff=".encrypt($fff)."&thumbs=true\",\"ceva\",\"".$_GET['div_id']."\");'>
						<div class='img' style='background-image:url(php_manager/images/icons/back-128.png);background-position:center bottom;' >
							<div style='width:98px;overflow:hidden;background-image:url(php_manager/images/bg1.png);font-size:12px;padding:1px;'>
							Parent directory</div></div></a></div>";
			  }
		else
			echo"
			<tr class='ceva'>
				<td class='icon'><img src='php_manager/images/icons/back-icon.png'></td><td style='font-size:13px;font-family:arial;padding:0px;'  border=0> 
					<a href='javascript:' onclick='make_request(\"php_manager/direct.php?ff=".encrypt($fff)."\",\"ceva\",\"".$_GET['div_id']."\");'>Parent directory</a>
				</td><td></td><td></td>
			</tr><tr><td>";
					
		
		//incepe while-ul
		$d = opendir($c);
	while($f = readdir($d)) 
	{
	
          if(strpos($f, '.') === 0) continue; //aici cred ca iese dak e in radacina
				
          $ff = $c . '/' . $f;
		  
		  $contor++; 
          
		if(is_dir($ff)) 
		{
			  if(isset($_GET['thumbs']))
			  {
			  echo '
			  <div class="thumb" ondblclick="open_folder(\'direct.php?thumbs=1&ff='.encrypt($ff).'\')">
				
					<a title="'.$f.'" href="javascript:make_request(\'php_manager/direct.php?ff='.encrypt($ff).'&thumbs=true\',\'ceva\',\''.$_GET['div_id'].'\');" onclick="make_request(\'php_manager/direct.php?ff='.encrypt($ff).'&thumbs=true\',\'ceva\',\''.$_GET['div_id'].'\');"  >
					<div class="img" style="background-image:url(php_manager/images/icons/folder-1281.png);background-position:center bottom;" >
						<div style="width:98px;overflow:hidden;background-image:url(php_manager/images/bg1.png);font-size:12px;padding:1px;">' . $f . 						'</div>
				</div></a>
			  </div>';
			  }
			  else
			  echo '
			  <tr ondblclick="make_request(\'php_manager/direct.php?ff='.encrypt($ff).'\',\'ceva\',\''.$_GET['div_id'].'\');" class="ceva">
				<td class="icon"><img src="php_manager/images/icons/folder.png"></td>
				<td class="link"><a title="'.$f.'" href="javascript:make_request(\'php_manager/direct.php?ff='.encrypt($ff).'\',\'ceva\',\''.$_GET['div_id'].'\');" onclick="make_request(\'php_manager/direct.php?ff='.encrypt($ff).'\',\'ceva\',\''.$_GET['div_id'].'\');"  >' . $f . '</a></td>
				<td class="ext">&lt;dir&gt;</td>
				<td class="size">&nbsp;</td>
			  </tr>';
		}
		else
		{		  			  		  
			  if(strstr($f,"."))
			  {
			  $ext = strtolower(substr($f,strrpos($f,".")+1,strlen($f)));
			  $f = substr($f,0,strrpos($f,"."));
			  }
			  
			  //selectie icons
			  if(isset($_GET['thumbs']))
			  {
				  if	 (in_array($ext,$imagini))    {$src = 'php_manager/thumb.php?pic='.urlencode($ff).'&height=170';$stil = "";}
				  elseif (in_array($ext,$sounds))    {$src = "php_manager/images/icons/winamp-128.png";$stil = "background-position:center bottom;";}
				  elseif (in_array($ext,$archive))   {$src = "php_manager/images/icons/archive-128.png";$stil = "background-position:center bottom;";}
				  else 								 {$src = "php_manager/images/icons/filenew-1281.png";$stil = "background-position:center bottom;";}
			  }
			  else
			  {
				  if	 (in_array($ext,$sounds))    $icon = "winamp.png";
				  elseif (in_array($ext,$imagini))   $icon = "irfanview.png";
				  elseif (in_array($ext,$archive))   $icon = "winrar.png";	
				  else 								 $icon = "document.png";
			  }
			  //afisare fisiere
			  if(isset($_GET['thumbs']))
				{if	 (in_array($ext,$imagini))
					echo '
					<div class="thumb">
						<a  title='.$f.".".$ext.' href="'. str_replace($_SERVER['DOCUMENT_ROOT'],"",$ff). '" class="lightboxa" ><div class="img" style="background-image:url('.$src.');'.$stil.'" ><div style="width:98px;overflow:hidden;background-image:url(php_manager/images/bg1.png);font-size:12px;padding:1px;">' . shorten_text($f,11) . '</div></div></a>
					</div>	';
					else
					echo '
					<div class="thumb">
						<a  title='.$f.".".$ext.' href="'. str_replace($_SERVER['DOCUMENT_ROOT'],"",$ff). '" target="_blank" ><div class="img" style="background-image:url('.$src.');'.$stil.'" ><div style="width:98px;overflow:hidden;background-image:url(php_manager/images/bg1.png);font-size:12px;padding:1px;">' . shorten_text($f,11) . '</div></div></a>
					</div>	';
					
				}
				else
				{
					echo '
					<tr class="ceva" >
						<td class="icon"><img src="php_manager/images/icons/'.$icon.'"></td>
						<td class="link"><a href="'. str_replace($_SERVER['DOCUMENT_ROOT'],"",$ff) .'" target="_blank">' . $f . '</a></td>
						<td class="ext">'.$ext.'</td>
						<td class="size" id="'.filesize($ff).'">'.number_format(filesize($ff)).'</td>
					</tr>';
				}
				
		}//end else de fisier, nu folder
    }//end while
//	echo strpos($c,$_SERVER['DOCUMENT_ROOT'])." - ";
//	echo strlen($_SERVER['DOCUMENT_ROOT']);
	}//end function
	
	//echo "ceva - ".$c;
	
      
    ?>
	<script>
	$(function() {
	
	$('.lightboxa').lightBox({maxHeight:400,maxWidth:800});
	});
	</script>
   