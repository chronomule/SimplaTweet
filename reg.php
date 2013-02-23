<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("SimplaTweet", $con);
$z2=$_POST['name'];
$z3=$_POST['email'];
$z4=$_POST['scrname'];
$z5=$_POST['pass'];

mysql_query("CREATE TABLE $z2 (
ID INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 Messages VARCHAR(30))");

mysql_query("CREATE TABLE $z4(
ID INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 Followers VARCHAR(30))"); 

mysql_query("INSERT INTO Users (Name, Screen, Password, Email)
VALUES
('$z2','$z4','$z5','$z3')");
echo '<a href="Pritish_Metisme.html">Account successfully created. Return to sign in page</a>';

mysql_close($con);
?>
