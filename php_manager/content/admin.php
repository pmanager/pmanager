<?
if(isset($_POST['add']))
	{
	$database = new SQLiteDatabase('../users.sqlite', 0666, $error);
	$query = "insert into users(username,password) values ('".$_POST['username']."','".md5($_POST['password'])."')";
	$result = $database->queryExec($query);
	if(!result)
		die("Error");
	else
		echo "Ok";
	}
elseif(isset($_POST['modify']))
	{
	$database = new SQLiteDatabase('../users.sqlite', 0666, $error);
	$query = "update users set password='".md5($_POST['password'])."' where username='".$_POST['username']."'";
	$result = $database->queryExec($query);
	if(!result)
		die("Error");
	else
		echo "Ok";
	}
elseif(isset($_POST['del']))
	{
	$database = new SQLiteDatabase('../users.sqlite', 0666, $error);
	$query = "delete from users where username='".$_POST['username']."'";
	$result = $database->queryExec($query);
	if(!result)
		die("Error");
	else
		echo "Ok";
	}
else //AFISARE
{
$database = new SQLiteDatabase('../users.sqlite', 0666, $error);

$query = "select * from users";

if($result = $database->query($query, SQLITE_BOTH, $error))
{

echo "<h2>Users list</h2>
		<table border=1 style='border-collapse:collapse' cellpadding=9>
			<tr align=center>
				<td><b>Username</td>
				<td><b>Password</td>
				<td><b>Actiuni</td>
			</tr>";
  while($row = $result->fetch())
  {
  ?>
    <tr>
			<td><?=$row['username']?></td>
			<td><?=$row['password']?></td>
			<td><input type='button' value='Modifica' onclick='javascript:admin("modify","<?=$row['password']?>",event)'/>
			<?
			if ($row['username']!="admin")
			{
			?>
			&nbsp;&nbsp;&nbsp;<input type='button' value='Sterge' onclick='javascript:admin("delete","<?=$row['password']?>",event)'/>
			<?
			}
			?>
			</td>
		</tr>
  <?
  }
}
  
?> 
 </table><br/>
<fieldset><legend>Adaugare utilizator</legend>	<table>
	<tr>
		<td>Nume</td>
		<td><input type="text" name="admin_nume" id="admin_nume"/></td>
	</tr>
	<tr>
		<td>Parola</td>
		<td><input type="text" name="admin_parola" id="admin_parola"/></td>
	</tr>
	</table>
	<input type='button' value='Adauga' onclick='javascript:admin("add","",event)'/></td>
</fieldset>
<?
}
?>