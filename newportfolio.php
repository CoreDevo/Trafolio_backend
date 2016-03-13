<?php
header("HTTP/1.1 200 OK");
header("Content-Type:application/json");

$data = (file_get_contents("php://input"));
$obj = json_decode($data);
$username =$obj->{'username'};
$name = $obj->{'title'};
$description = $obj->{'description'};
$public = $obj->{'public'};
$date = $obj->{'date'};
$finished = 0;
$num_pic = 0;

$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpassword = 'h804804804';
$conn = mysql_connect($dbhost, $dbuser, $dbpassword);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db( 'trafolio_db' );

$result2 =mysql_query("SELECT user_id FROM user WHERE username = '$username'");
$userid = mysql_fetch_row($result2)[0];

$result = mysql_query("SELECT * FROM portfolio WHERE (ownerid = '$userid' AND name = '$name')");
if(mysql_num_rows($result) != 0) {
     die ('{"result":"exist"}');
}


$sql = "INSERT INTO portfolio(ownerid,name,description,public,num_pic,finished,date) VALUES ('$userid','$name','$description','$public','$num_pic','$finished','$date')";

$retval = mysql_query( $sql, $conn );

$result =mysql_query("SELECT * FROM portfolio WHERE (ownerid = '$userid' AND name = '$name')");
$portfolioid = mysql_fetch_row($result)[0];

mysql_close($conn);
$arr = array('result' =>'succeed' );

$target_dir = "./image/". $userid ."/" . $portfolioid;
$s = "python ./create_dir.py " . $target_dir;
$command = escapeshellcmd(s);
$output = shell_exec($command);

if(!file_exists($target_dir))
{
mkdir($target_dir, 0777, true);
}
echo json_encode($arr);
?>
