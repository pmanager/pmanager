<?php
try
{
  //create or open the database
  $database = new SQLiteDatabase('users.sqlite', 0666, $error);
}
catch(Exception $e)
{
  die($error);
}

//add Movie table to database

//insert data into database
$query = 'INSERT INTO users (id,username,password) values ("1", "admin", "21232f297a57a5a743894a0e4a801fc3")';

if(!$database->queryExec($query, $error))
{
  die($error);
}

//read data from database
$query = "SELECT * FROM users";
if($result = $database->query($query, SQLITE_BOTH, $error))
{
  while($row = $result->fetch())
  {
    print("Title: {$row['Title']} <br />" .
          "Director: {$row['Director']} <br />".
          "Year: {$row['Year']} <br /><br />");
  }
}
else
{
  die($error);
}

?>