<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete</title>
</head>
<link href="format.css" rel="stylesheet" type="text/css">

<? 
include ("Connect.php");
include ("encryption.php");
include ("decrypt.php");
  
date_default_timezone_set('Greece/Athens');

if(empty($_POST['user'])){ ?>
<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1><h2><font color="#000066">
<a href="http://index.html">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2></div><hr color="#FF0000" /><? exit();}





$date = date("d/m/Y");
?>
<body>
<? 

$amka = $_POST['amka'];
$user = $_POST['user'];

$userD = my_decrypt($user,$key);  // decrypt userName




// -----------------Delete Record--------------------------------//
if (empty($amka)){?> <div align="center"><h1><font color="#B22222">H Διαγραφή δεν έγινε...(amka-not found)</font></h1></div><hr color="#FF0000" /> <? exit();}


$ins = "DELETE FROM basic  WHERE user = '$userD' AND amka = '$amka'";
$delup = "DELETE FROM upload WHERE user ='$userD' AND amka = '$amka'";
$delold = "DELETE FROM older WHERE user ='$userD' AND amka = '$amka'";
$delcom ="DELETE FROM comment WHERE user ='$userD' AND amka = '$amka'"; 
$delexam = "DELETE FROM exam WHERE user ='$userD' AND amka = '$amka'";
$delvis = "DELETE FROM visit WHERE user ='$userD' AND amka = '$amka'";



  $SQL = "SELECT * FROM upload WHERE amka = '$amka' AND user = '$userD'"; 
  
  $result = mysqli_query($conn, $SQL);	
   while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

$file = $row['f1'];

if(file_exists($row['f1'])){unlink($file);}}
  
if(!mysqli_query($conn, $ins) || !mysqli_query($conn, $delup) || !mysqli_query($conn, $delold) || !mysqli_query($conn, $delcom) || !mysqli_query($conn, $delexam) || !mysqli_query($conn, $delvis)){?> <div align="center"><h1><font color="#B22222">H Διαγραφή δεν έγινε...</font></h1></div><hr color="#FF0000" /> <? exit();}
//---------------------------------------------------------------------//

?>

<div align="center"><h1><font color="#000066">H Διαγραφή των στοιχείων του ασθενούς έγινε επιτυχώς</font></h1></div><hr color="#FF0000" />
<form action="main.php"  method="post">
<input type="hidden" name="user" value="<? print $user; ?> "/>

<p align="center"><input  type="submit"  name="submit" value="Επιστροφή"  align="middle"  class="buton2"/></p>
</form>








</body>
</html>