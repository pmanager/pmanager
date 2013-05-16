<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['pmanager_logged']))
	{
	
	
	include "php_manager/login.php";
	
	}
elseif($_GET['logout']=="true"){
	
	unset($_SESSION['pmanager_logged']);
	unset($_SESSION['is_admin']);
	session_destroy();
	header("location:index.php");
}
	
else
	include "php_manager/file_manager_ajax.php";
?>