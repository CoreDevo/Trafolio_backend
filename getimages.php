<?php


$username = $_GET['username'];
$portfolioname = $_GET['portfolio'];


$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpassword = 'h804804804';
$conn = mysql_connect($dbhost, $dbuser, $dbpassword);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db( 'trafolio_db' );

$photoarray = Array();
$result =mysql_query("SELECT user_id FROM user WHERE username = '$username'");
$userid = mysql_fetch_row($result)[0];

$result =mysql_query("SELECT portfolio_id FROM portfolio WHERE name = '$portfolioname'");
$portfolioid = mysql_fetch_row($result)[0];
//echo $userid;
//echo $portfolioid;

$result2 = mysql_query("SELECT * FROM photo  WHERE portfolioid = '$portfolioid'");
while($row = mysql_fetch_row($result2))
{
   $photoid = $row[0];
   $photodescription = $row[2];
   $photolongitude = $row[3];
   $photolatitude = $row[4];
   $filename = $row[5];
   $photodate = $row[6];



   $url = "http://ec2-54-175-171-191.compute-1.amazonaws.com/image/" . $userid . "/" . $portfolioid   . "/" . $filename;
   $temparray = Array("id"=>$photoid,"url"=>$url,"description"=>$photodescription,"longitude"=>$photolongitude,"latitude"=>$photolatitude,"date"=>$photodate);
   
//   echo json_encode ($temparray);
   array_push($photoarray,$temparray);
}


mysql_close($conn);
echo json_encode($photoarray);


?>
