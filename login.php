
<?php
header("HTTP/1.1 200 OK");
header("Content-Type:text/plain");

$data = (file_get_contents("php://input"));
$obj = json_decode($data);
$vusername =$obj->{'username'};
$vpassword = $obj->{'password'};

$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpassword = 'h804804804';
$conn = mysql_connect($dbhost, $dbuser, $dbpassword);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db( 'trafolio_db' );



$result = mysql_query("SELECT * FROM user WHERE username = '$vusername'");
if(mysql_num_rows($result) == 0) {
     die ('{"result":"nouser"}');
}

$result = mysql_query("SELECT * FROM user WHERE username = '$vusername' AND password = '$vpassword'");
if(mysql_num_rows($result) == 0) {
     die ('{"result":"fail"}');
}

mysql_close($conn);
$arr = array('result' =>'succeed' );
echo json_encode($arr);
?>

