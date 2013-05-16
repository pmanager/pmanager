<?
error_reporting(E_ALL);	

//$source_path = realpath($_GET['src']);

//echo $_GET['src']." - ".$source_path;
if(mkdir($_GET['src'])) echo "Folder created!";
else echo "Could not create folder";


?>