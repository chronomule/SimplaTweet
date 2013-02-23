<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("SimplaTweet", $con);
$z2=$_POST['qsearch'];
echo $z2;	//obtains the person who is to be followed
$z3 = $_POST['f'];
echo $z3;	//obtains the screen name of follower(not necessary)
$result40 = mysql_query("SELECT * FROM users WHERE Name='$z2'"); 
while($row = mysql_fetch_array($result40))
{ $x35=$row['Screen'];
}
mysql_query("INSERT INTO $x35 (Followers)
VALUES
('$z3')");

mysql_close($con);
