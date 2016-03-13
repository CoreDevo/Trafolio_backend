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
if(mysql_num_rows($result) != 0) {
     die ('{"result":"exist"}');
}


$sql = "INSERT INTO user(username,password) VALUES ('$vusername','$vpassword')";

$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not add the new user: ' . mysql_error());
}
$result = mysql_query("SELECT * FROM user WHERE username = '$vusername'");
$row = mysql_fetch_row($result);
$userid = $row[0];

mysql_close($conn);
$arr = array('result' =>'succeed' );

$target_dir = "./image/". $userid;
$s = "python ./create_dir.py " . $target_dir;
$command = escapeshellcmd(s);
$output = shell_exec($command);

if(!file_exists($target_dir))
{
mkdir($target_dir, 0777, true);
}


echo json_encode($arr);
?>
