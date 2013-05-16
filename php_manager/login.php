<?
error_reporting(E_ALL);
if(isset($_POST['ok']))
{	
		
	$database = new SQLiteDatabase('php_manager/users.sqlite', 0666, $error);
    
	/*$query = $database->query("SELECT name FROM sqlite_master", SQLITE_ASSOC, $query_error); #Lists all tables

		print $query->numRows();
		while ($row = $query->fetch())
			echo($row['name']."\n");
	*/
	
	$query = "SELECT * FROM Users where username='".$_POST['nume']."' and password='".md5($_POST['parola'])."'";
	$result = $database->arrayQuery($query, SQLITE_BOTH);
	if(count($result)!=0)
	{
	//echo "REZULTAT";
	session_start();
	$_SESSION['pmanager_logged']=1;
	
	if($_POST['nume']=="admin")
		$_SESSION['is_admin']=1;
	}
	header("location:".$_SERVER['REQUEST_URI']);
	
	/*while($row = $result->fetch())
		{
			print("Id: {$row['id']} <br />" .
			  "nume: {$row['username']} <br />".
			  "password: {$row['password']} <br /><br />");
		}*/
//	}
	
	
}
else
{
//unset($_SESSION['pmanager_logged']);
//unset($_SESSION['is_admin']);
?>

<link rel="stylesheet" href="php_manager/style/style.css"  type="text/css" /> 

<body style="background:#b7c7d1;background-image:url('php_manager/images/bg.png');background-repeat:repeat-x;">
<div class="header">
		<img src="php_manager/images/pManager.png">
	</div>
<form action="" method="post">
	<center>
	<div style="text-align:left;margin-top:100px;width:300px;height:auto;border:1px solid black;padding-top:20px;padding-left:20px;padding-bottom:15px;">
	<B style="margin-left:5px;margin-top:25px;font-family:arial;font-size:17px;color:white">Please Log In</b><BR><BR>
	<table cellpadding=2>
	<tr><td><B>Name:<td><input type="text" name="nume"></tr>
	<tr><td><B>Password:<td><input type="password" name="parola"></tr>
	</table><BR>
	<input type="submit" value="Log In" name="ok">
	</div>

</form>

</body>
<?
}
?>