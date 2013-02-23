<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("SimplaTweet", $con);
$s = $_REQUEST["s"];
$ecstore = $_REQUEST["ecstore"];
$output = "";
$s = str_replace(" ", "%", $s);
$query = "SELECT * FROM users WHERE Name LIKE '%" . $s . "%'";
$squery = mysql_query($query);
if((mysql_num_rows($squery) != 0) && ($s != "")){
while($sLookup = mysql_fetch_array($squery)){
$displayName = $sLookup["Name"];
if($displayName!=$ecstore)
{ $output .= '<li onclick="sendToSearch(\'' . $displayName . '\')">' . $displayName . '</li>'; } 
}
}	

echo $output;
?> 
