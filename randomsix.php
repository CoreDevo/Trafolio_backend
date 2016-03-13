<?php
header('Access-Control-Allow-Origin: *');

$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpassword = 'h804804804';
$conn = mysql_connect($dbhost, $dbuser, $dbpassword);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db( 'trafolio_db' );


$result = mysql_query("SELECT * FROM photo");
$totalimage = (mysql_num_rows($result));

if ($totalimage==0){
	$temparray = Array("response"=>"no picture on server");
	echo json_encode($temparray);
}else{




$random  = rand(0,$totalimage);
$result = mysql_query("SELECT * FROM photo ORDER BY RAND() LIMIT 1");
$row = mysql_fetch_row($result);
$portfolioid=$row[1];
$filename = $row[5];
$result =mysql_query("SELECT ownerid  FROM portfolio  WHERE portfolio_id = '$portfolioid' LIMIT 1");
$userid = mysql_fetch_row($result)[0];
$pic1 = "http://ec2-54-175-171-191.compute-1.amazonaws.com/image/" . $userid . "/" . $portfolioid   . "/" . $filename;

$random  = rand(0,$totalimage);
$result = mysql_query("SELECT * FROM photo ORDER BY RAND() LIMIT 1");
$row = mysql_fetch_row($result);
$portfolioid=$row[1];
$filename = $row[5];
$result =mysql_query("SELECT ownerid  FROM portfolio  WHERE portfolio_id = '$portfolioid' LIMIT 1");
$userid = mysql_fetch_row($result)[0];
$pic2 = "http://ec2-54-175-171-191.compute-1.amazonaws.com/image/" . $userid . "/" . $portfolioid   . "/" . $filename;

$random  = rand(0,$totalimage);
$result = mysql_query("SELECT * FROM photo ORDER BY RAND() LIMIT 1");
$row = mysql_fetch_row($result);
$portfolioid=$row[1];
$filename = $row[5];
$result =mysql_query("SELECT ownerid  FROM portfolio  WHERE portfolio_id = '$portfolioid' LIMIT 1");
$userid = mysql_fetch_row($result)[0];
$pic3 = "http://ec2-54-175-171-191.compute-1.amazonaws.com/image/" . $userid . "/" . $portfolioid   . "/" . $filename;

$random  = rand(0,$totalimage);
$result = mysql_query("SELECT * FROM photo ORDER BY RAND() LIMIT 1");
$row = mysql_fetch_row($result);
$portfolioid=$row[1];
$filename = $row[5];
$result =mysql_query("SELECT ownerid  FROM portfolio  WHERE portfolio_id = '$portfolioid' LIMIT 1");
$userid = mysql_fetch_row($result)[0];
$pic4 = "http://ec2-54-175-171-191.compute-1.amazonaws.com/image/" . $userid . "/" . $portfolioid   . "/" . $filename;

$random  = rand(0,$totalimage);
$result = mysql_query("SELECT * FROM photo ORDER BY RAND() LIMIT 1");
$row = mysql_fetch_row($result);
$portfolioid=$row[1];
$filename = $row[5];
$result =mysql_query("SELECT ownerid  FROM portfolio  WHERE portfolio_id = '$portfolioid' LIMIT 1");
$userid = mysql_fetch_row($result)[0];
$pic5 = "http://ec2-54-175-171-191.compute-1.amazonaws.com/image/" . $userid . "/" . $portfolioid   . "/" . $filename;

$random  = rand(0,$totalimage);
$result = mysql_query("SELECT * FROM photo ORDER BY RAND() LIMIT 1");
$row = mysql_fetch_row($result);
$portfolioid=$row[1];
$filename = $row[5];
$result =mysql_query("SELECT ownerid  FROM portfolio  WHERE portfolio_id = '$portfolioid' LIMIT 1");
$userid = mysql_fetch_row($result)[0];
$pic6 = "http://ec2-54-175-171-191.compute-1.amazonaws.com/image/" . $userid . "/" . $portfolioid   . "/" . $filename;
$temparray = Array("one"=>$pic1,"two"=>$pic2,"three"=>$pic3,"four"=>$pic4,"five"=>$pic5,"six"=>$pic6);
echo json_encode($temparray);
mysql_close($conn);
}


?>
