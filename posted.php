<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("SimplaTweet", $con);
$z2=$_POST['commentbox'];
echo $z2;
$z3=$_POST['f'];
echo $z3;
mysql_query("INSERT INTO $z3 (Messages)
VALUES
('$z2')");

?> 
