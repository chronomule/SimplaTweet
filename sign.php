<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.5b1.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js"></script>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js'></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SimplaTweet</title>
</head>
<body>
<script type="text/javascript">
function rolldown() {
if ($(".txt").is(":hidden")) {
$(".txt").slideDown("fast");
$("#pbutton").hide("fast");
} else {
$(".txt").hide();
}
}

</script>

<div class="pgheader">	<!--Welcome note-->
<style type="text/css">
div.pgheader {
position: absolute;
display: inline;
top: 0px;
left: 0px;
width: 1475px;
height: 50px;
border-radius: 4px;
margin:5px;
border:5px solid black;
padding:5px;
box-shadow: 2px 2px 2x 2px;
outline: 2px ridge #;
outline-offset: 10px;
}
</style>
<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("SimplaTweet", $con);
$z3=$_POST['email'];
$z5=$_POST['pass'];


$result = mysql_query("SELECT * FROM users WHERE Email='$z3'");
while($row = mysql_fetch_array($result))
  {
  $x1 = $row['Password'];
  $x2 = $row['Name'];
  $x3 = $row['Screen'];
  if($x1==$z5)
  {	echo "<h2>Welcome ".$x2."(".$x3.")<dd><dd><h3><a href='Pritish_MetisMe.html'>Sign Out</a></h3></h2>"; }

  else     //need to add more cases to this clause
  { echo "Wrong username/password";
    echo "<br/>";
	echo '<a href="Pritish_MetisMe.html">Try Again</a>';
	}
	}
mysql_close($con);
?>
</div>
<div class="postmessage">

<style type="text/css">
div.postmessage {
top: 200px;
position: absolute;
width: 200px;
height: 300px;
box-shadow: 2px 2px 2x 2px;
outline: 2px ridge #;
outline-offset: 10px;
border-radius: 4px;
} 
</style>
<input type="button" value="Post a message" id="pbutton" onclick="rolldown()">
<br/>
<div class="txt">
<style type="text/css">
div.txt {
position: absolute;
display:none;
width: 200px;
height: 200px;
}
</style>
<form id="form3" name="form3" method="post" action="posted.php" onsubmit="return false;">
<input size="50" form="form3" name="commentbox" autocomplete="on" placeholder="Tweet your mind!"></textarea>
<input type="hidden" form="form3" name="f" value="<?php echo $x2; ?>" />
<button id="sub" onclick="updatedb()">Post</button>
</form>
<script type="text/javascript">
      function updatedb() {
	   $.post( $("#form3").attr("action"), 
       $("#form3 :input").serializeArray(), 
      function(){ alert("Your post has been successfully posted");}); 
       clearInput();
      function clearInput() {
	   $("#form3 :input").each( function() {
	   $(this).val('');
	   $("#pbutton").show("fast");
	   $(".txt").hide("fast");
	});
}
 }     
</script>	  
</div>	<!--txt-->
</div>	<!--Postmessage-->
<div class="wall">
<style type="text/css">
div.wall {
position: absolute;
top: 100px;
left: 450px;
height: 300px;
width: 300px;
box-shadow: 2px 2px 2x 2px;
outline: 2px ridge #;
outline-offset: 10px;
border-radius: 4px;
overflow: y;
margin:5px;
border:5px solid black;
padding:5px;
}
</style>
<?php
$e = array();
$i = 0;
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("SimplaTweet", $con);
$result12 = mysql_query("SELECT * FROM $x2");
while($row = mysql_fetch_array($result12))
  {
  $st = $row['Messages'];
  echo "I"." "."said :"." ".$st;
  echo '<br/>';
  }
$result1 = mysql_query("SELECT Followers FROM $x3");
while($row = mysql_fetch_array($result1))
  {
  $e[$i] = $row['Followers'];
  $i++;
  }
if($i>0)  
{for($k=0;$k<$i;$k++)
{
$result2 = mysql_query("SELECT Messages FROM $e[$k]");	
while($row1= mysql_fetch_array($result2))
{ echo $e[$k]." "."said : "." ".$row1['Messages'];
  echo "<br/>";
}
}
} 
mysql_close($con);
?>
</div>
<div class="livesearch">
<style type="text/css">
div.livesearch {
position: absolute;
top: 100px;
left:800px;
width:300px;
height:400px;
box-shadow: 2px 2px 2x 2px;
outline: 2px ridge #;
outline-offset: 10px;
border-radius: 4px;
margin:5px;
border:5px solid black;
padding:5px;
}
</style>

<form id="quick-search" action="../search" method="post" onsubmit="return false;" >
<p>
<label for="qsearch">Click the suggested name to follow:</label>
<input id="qsearch" type="text" name="qsearch" onkeyup="liveSearch()" />
<input type="hidden" form="form3" name="f" value="<?php echo $x2; ?>" />
<input type="submit" />
<script type="text/javascript">
function createRequestObject(){
var request_o;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
request_o = new ActiveXObject("Microsoft.XMLHTTP");
}else{
request_o = new XMLHttpRequest();
}
return request_o;
}

var http = createRequestObject(); 

function liveSearch()
{
var ecstore = '<?php echo $x2; ?>';
var url = "transfer.php";
var s = document.getElementById('qsearch').value;
var params = "&s="+s+"&ecstore="+ecstore;
http.open("POST", url, true);
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http.onreadystatechange = function() {
if(http.readyState == 4 && http.status != 200) {
document.getElementById('searchResults').innerHTML='<li>Loading...</li>';
}
if(http.readyState == 4 && http.status == 200) {
document.getElementById('searchResults').innerHTML = http.responseText; 
} 
}
http.send(params);
}

function sendToSearch(str){
document.getElementById('qsearch').value = str;
var store = document.getElementById('qsearch').value;
document.getElementById('searchResults').innerHTML = "";
$.post( "connect.php", 
         $("#quick-search :input").serializeArray(), 
           function(){ alert(str + " " + "is being followed");});}
</script>
</p>
<ul id="searchResults">
</ul>
</form>
</div>
</body>
</html>