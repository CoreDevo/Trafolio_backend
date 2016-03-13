<?php

header('Content-Type: application/json');

$username = $_POST["username"];
$portfolioname = $_POST["portfolioname"];
$longitude = $_POST["longitude"];
$latitude = $_POST["latitude"];
$description = $_POST["description"];
$date = $_POST["date"];

$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpassword = 'h804804804';
$conn = mysql_connect($dbhost, $dbuser, $dbpassword);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db( 'trafolio_db' );

$result =mysql_query("SELECT user_id FROM user WHERE username = '$username'");
$userid = mysql_fetch_row($result)[0];

$result =mysql_query("SELECT portfolio_id,num_pic FROM portfolio WHERE name = '$portfolioname'");
$portfolioid = mysql_fetch_row($result)[0];
$num_pic = mysql_fetch_row($result)[1];
$num_pic = $num_pic + 1;
$result =mysql_query("UPDATE portfolio SET num_pic = '$num_pic' WHERE name = '$portfolioname'", $conn);

$target_dir = "/var/www/html/image/" . $userid . "/" . $portfolioid;
$target_name = basename($_FILES["file"]["name"]);

while (mysql_num_rows(mysql_query("SELECT filename FROM photo WHERE filename = '$target_name'"))!=0){
	$target_name = "1".$target_name;
}

$target_dir = $target_dir . "/" . $target_name;

$result =mysql_query("INSERT INTO photo (portfolioid,description,longitude,latitude,filename,date) VALUES ('$portfolioid','$description','$longitude','$latitude','$target_name','$date')",$conn);

mysql_close($conn);


if (copy($_FILES["file"]["tmp_name"], $target_dir)) 
{        
echo json_encode([
"Message" => "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.",
"Status" => "OK",
"target_dir" => $target_dir,
"userId" => $_REQUEST["userId"]
]);          
  
	    
} else {

echo json_encode([ 
"Message" => "Sorry, there was an error uploading your file.",
"Status" => "Error",
"userId" => $_REQUEST["userId"],
"FileName" => "$target_name",
"output" => "$output",
"target directory" => "$target_dir"
]);
}
?>



