<?php

$username =$_GET['username'];

$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpassword = 'h804804804';
$conn = mysql_connect($dbhost, $dbuser, $dbpassword);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db( 'trafolio_db' );

$portfolioarray = Array();
$result =mysql_query("SELECT user_id FROM user WHERE username = '$username'");
$userid = mysql_fetch_row($result)[0];
//echo $userid . "\n";
$result2 = mysql_query("SELECT name,description,public,finished,date,portfolio_id FROM portfolio WHERE ownerid = '$userid'");
while($row = mysql_fetch_row($result2))
{
   $portfolioname = $row[0];
   $portfoliodescription = $row[1];
   $portfoliopublic = $row[2];
   $portfoliofinished = $row[3];
   $portfoliodate = $row[4];
   $portfolioid = $row[5];
   $result3 = mysql_query("SELECT filename FROM photo WHERE portfolioid = '$portfolioid'");
   $num_pic = mysql_num_rows($result3);
//   echo $portfolioname;
//   echo $portfoliodescription;
   $temparray = Array("username"=>$username,"name"=>$portfolioname,"description"=>$portfoliodescription,"public"=>$portfoliopublic,"finished"=>$portfoliofinished,"date"=>$portfoliodate,"num_pic"=>$num_pic);
//   echo json_encode ($temparray);
 array_push($portfolioarray,$temparray);
}


mysql_close($conn);
echo json_encode($portfolioarray);




?>
