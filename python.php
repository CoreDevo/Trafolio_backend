<?php



$command = escapeshellcmd('python ./create_dir.py /var/www/uploads');
$output = shell_exec($command);
echo $output;


?>
