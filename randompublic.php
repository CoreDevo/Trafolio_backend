<?php

$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpassword = 'h804804804';
$conn = mysql_connect($dbhost, $dbuser, $dbpassword);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db( 'trafolio_db' );


$result = mysql_query("SELECT name,description,public,finished,date,portfolio_id,ownerid FROM portfolio WHERE public='true' ORDER BY date DESC LIMIT 20");

$returnArray = Array();

while($row = mysql_fetch_row($result))
{
   $portfolioname = $row[0];
   $portfoliodescription = $row[1];
   $portfoliopublic = $row[2];
   $portfoliofinished = $row[3];
   $portfoliodate = $row[4];
   $portfolioid = $row[5];
   $userid = $row[6];
   $result2 = mysql_query("SELECT filename FROM photo WHERE portfolioid = '$portfolioid'");
   $num_pic = mysql_num_rows($result2);
   $result3 = mysql_query("SELECT username FROM user WHERE user_id = '$userid'");
   $username = mysql_fetch_row($result3)[0];
   $temparray = Array("username"=>$username,"name"=>$portfolioname,"description"=>$portfoliodescription,"public"=>$portfoliopublic,"finished"=>$portfoliofinished,"date"=>$portfoliodate,"num_pic"=>$num_pic);
   array_push($returnArray,$temparray);
}


mysql_close($conn);
echo json_encode($returnArray);


?>
