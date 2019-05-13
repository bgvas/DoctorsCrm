
<?
$username = "2169907_balokas";
$password = "Pfizer09";
$hostname = "fdb3.freehostingeu.com";

$conn = mysqli_connect($hostname, $username, $password) or die('Could not connect: ' . mysqli_connect_error());
mysqli_select_db($conn, '2169907_balokas');
mysqli_set_charset($conn, "utf8");

?>