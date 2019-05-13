<?php
ob_start();

$username = "2169907_balokas";
$password = "Pfizer09";
$hostname = "fdb3.freehostingeu.com";
$dbname = "2169907_balokas";

// if mysqldump is on the system path you do not need to specify the full path
// simply use "mysqldump --add-drop-table ..." in this case
$command = " /backup/mysqldump --add-drop-table --host=$hostname --user=$username";
if ($password)
    $command .= "--password=" . $password . " ";
$command .= $dbname;
system($command);

$dump = ob_get_contents();
ob_end_clean();

// send dump file to the output
date_default_timezone_set('Europe/Athens');
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($dbname . "_" . date("d-m-Y_H-i-s") . ".sql"));
flush();
echo $dump;
exit();
?>