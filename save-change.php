<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Αποθήκευση αλλαγών</title>
</head>
<link href="format.css" rel="stylesheet" type="text/css">
<? 

if(empty($_POST['user'])){ ?>
<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1><h2><font color="#000066">
<a href="http://balokas.eu.pn">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2></div><hr color="#FF0000" /><? exit();}



include ("Connect.php");
include("decrypt.php");
include("encryption.php");
date_default_timezone_set('Greece/Athens');


$date = date("d/m/Y");
?>
<body>
<? 
$user = $_POST['user'];
$amka = $_POST['amka'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$amka = $_POST['amka'];
$age = $_POST['age'];
$town = $_POST['town'];
$kin = $_POST['kin'];
$adr = $_POST['adr'];
$tk = $_POST['tk'];
$til = $_POST['til'];
$mail = $_POST['mail']; 
$hamka = $_POST['hamka'];


$userD = my_decrypt($user,$key);  // decrypt userName

// ------------------------------Ελεγχοι καταχωρημένων στοιχείων----------------------------------------------------//

if ((empty($lname)) ||  (empty($fname)) || (empty($amka)) ||  (empty($age)) || (empty($town)) ||  (empty($kin))){
	?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε καταχωρήσει όλες τις βασικές επιλογές....</font></h1></div><hr color="#FF0000" /><? exit();} 

$num_length = strlen((string)$amka);
  if($num_length < 11) {
     ?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στo AMKA....</font></h1></div><hr color="#FF0000" />
     <? exit();
  } 

if (strlen($til) > 0 && strlen(trim($til)) == 0 || empty($til)){}else{$num_length = strlen((string)$til);if($num_length < 10) {
?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στo Tηλέφωνο που δώσατε....</font></h1></div><hr color="#FF0000" /><? exit();}}

$num_length = strlen((string)$kin);if($num_length < 10) {
?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στo Kινητό που δώσατε....</font></h1></div><hr color="#FF0000" /><? exit();} 

if (strlen($tk) > 0 && strlen(trim($tk)) == 0 || empty($tk)){}else{$num_length = strlen((string)$tk);if($num_length < 5) {
?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στoν T.Κ. που δώσατε....</font></h1></div><hr color="#FF0000" /><? exit();}}

$sql = "SELECT * FROM basic WHERE   user = '$user'  AND amka = '$amka';"; $result = mysqli_query($conn, $sql); $countsql = mysqli_num_rows($result);


// -----------------Καταχώρηση στο basic--------------------------------//

if($amka == $hamka){
$int = "UPDATE  basic  SET  lname = '$lname', fname = '$fname', age = '$age' ,  town= '$town', address = '$adr', til = '$til', mobile = '$kin', mail = '$mail', tk = '$tk' WHERE user = '$userD' AND amka = '$hamka' ";
if(!mysqli_query($conn, $int)){?><div align="center"><h1><font color="#000066">Δεν έγινε αποθήκευση της εγγραφής....</font></h1><h6>(Κωδικός λάθους bas001)</h6></div><hr color="#FF0000" /><? echo("Error description: " . mysqli_error($conn)); exit();} }


if(($amka <> $hamka) && ($countsql > 0)){
?><div align="center"><h1><font color="#000066">Το ΑΜΚΑ υπάρχει ήδη....</font></h1><h6>(Κωδικός λάθους bas001)</h6></div><hr color="#FF0000" /><? exit();}


if(($amka <> $hamka) && ($countsql == 0)){
$int1= "UPDATE  basic  SET  lname = '$lname', fname = '$fname', age = '$age' , amka= '$amka',  town= '$town', address = '$adr', til = '$til', mobile = '$kin', mail = '$mail', tk = '$tk' WHERE user = '$userD' AND amka = '$hamka' ";
$int2= "UPDATE  comment  SET  amka= '$amka' WHERE user = '$userD' AND amka = '$hamka' ";
$int3= "UPDATE  upload  SET  amka= '$amka' WHERE user = '$userD' AND amka = '$hamka' ";
$int4= "UPDATE  visit  SET  amka= '$amka' WHERE user = '$userD' AND amka = '$hamka' ";
$int5= "UPDATE  older  SET  amka= '$amka' WHERE user = '$userD' AND amka = '$hamka' ";
$int6= "UPDATE  exam  SET  amka= '$amka' WHERE user = '$userD' AND amka = '$hamka' ";

if(!mysqli_query($conn, $int1) || !mysqli_query($conn, $int2) || !mysqli_query($conn, $int3) || !mysqli_query($conn, $int4) || !mysqli_query($conn, $int5) ||!mysqli_query($conn, $int6) ){
?><div align="center"><h1><font color="#000066">Δεν έγινε αποθήκευση της εγγραφής....</font></h1><h6><? echo(mysqli_error($conn));   ?></h6></div><hr color="#FF0000" /><? exit();}}
//---------------------------------------------------------------------//  ?>


	
	


<div align="center"><h1><font color="#000066">H αποθήκευση των αλλαγών έγινε επιτυχώς</font></h1></div><hr color="#FF0000" />

<form action="main.php" method="post"><p align="center">
<input type="hidden" name="user" value="<? print $user; ?>" >
<input  type="submit"  name="submit" value="Επιστροφή"  class="buton2" align="middle"/></p></form>









</body>
</html>