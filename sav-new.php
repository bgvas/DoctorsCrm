<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
$chol = $_POST['chol'];
$hyper = $_POST['hyper'];
$amka = $_POST['amka'];
$nos = $_POST['nos'];
$d1 = $_POST['d1'];
$d2 = $_POST['d2'];
$ist = $_POST['hist'];
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

$userD = my_decrypt($user,$key);  // decrypt userName

// ------------------------------Ελεγχοι καταχωρημένων στοιχείων----------------------------------------------------//

if ((empty($lname)) ||  (empty($fname)) || (empty($amka)) ||  (empty($age)) || (empty($town)) ||  (empty($kin))){
	?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε καταχωρήσει όλες τις βασικές επιλογές....</font></h1></div><hr color="#FF0000" /><? exit();} 
  
$num_length = strlen((string)$amka);if($num_length < 11) {
?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στo AMKA....</font></h1></div><hr color="#FF0000" /><? exit();} 

$num_length = strlen((string)$kin);if($num_length < 10) {
?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στo Kινητό που δώσατε....</font></h1></div><hr color="#FF0000" /><? exit();} 

if(!empty($til)){$num_length = strlen((string)$til);if($num_length < 10) {
?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στo Tηλέφωνο που δώσατε....</font></h1></div><hr color="#FF0000" /><? exit();}}
	
if(!empty($tk)){$num_length = strlen((string)$tk);if($num_length < 5) {
?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στoν  T.Κ. που δώσατε....</font></h1></div><hr color="#FF0000" /><? exit();}}

if ($d1 == $d2 AND $d1 == 'on'){?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στην επιλογή διαβήτη....</font></h1></div><hr color="#FF0000" /><? exit();} 


$sql = "SELECT * FROM basic WHERE  user = '$userD'  AND amka = '$amka';";
$result = mysqli_query($conn, $sql);	
$countsql = mysqli_num_rows($result);
if ($countsql >0){?><div align="center"><h1><font color="#000066">Προσοχή!!! Το ΑΜΚΑ που καταχωρήσατε, υπάρχει ήδη...</font></h1></div><hr color="#FF0000" /><? exit();}

//---------------------------------------------------------------------------------------------------//

//-----------------Καταχώρηση τιμης για τα checkbox-----------------------------------//
if($d1 == 'on'){$da1 = "1";}else{$da1 = "0";}
if($d2 == 'on'){$da2 = "1";}else{$da2 = "0";}
if($chol == 'on'){$cl = "1";}else{$cl = "0";}
if($hyper == 'on'){$hp = "1";}else{$hp = "0";}
//----------------------------------------------------------------------------------------------------//



// -----------------Καταχώρηση στο basic--------------------------------//
$int = "INSERT INTO basic (user, lname, fname, amka, age, town, address, til, mobile, mail, d1, d2, d3, d4, d5, lastrec, tk) VALUES ('$userD','$lname', '$fname', '$amka' , '$age', '$town', '$adr', '$til', '$kin', '$mail', '$da1', '$da2', '$cl', '$hp', '$nos' ,'','$tk')";
if(!mysqli_query($conn, $int)){?><div align="center"><h1><font color="#000066">Δεν έγινε αποθήκευση της εγγραφής....</font></h1><h6>(Κωδικός λάθους bas001)</h6></div><hr color="#FF0000" /><? echo("Error description: " . mysqli_error($conn)); exit();} 
//---------------------------------------------------------------------//




// -----------------Καταχώρηση στο older--------------------------------//
$int = "INSERT INTO older (user, amka, comments) VALUES ('$userD' , '$amka', '$ist')";
if(!mysqli_query($conn, $int)){?><div align="center"><h1><font color="#000066">Δεν έγινε αποθήκευση της εγγραφής....</font></h1></div><hr color="#FF0000" /><? echo("Error description: " . mysqli_error($conn));  exit();} 
//---------------------------------------------------------------------//


// -----------------Καταχώρηση στο comment--------------------------------//
$int = "INSERT INTO comment (user, amka, com) VALUES ('$userD' , '$amka', '')";
if(!mysqli_query($conn, $int)){?><div align="center"><h1><font color="#000066">Δεν έγινε αποθήκευση της εγγραφής....</font></h1></div><hr color="#FF0000" /><? echo("Error description: " . mysqli_error($conn));  exit();} 
//---------------------------------------------------------------------//?>






<div align="center"><h1><font color="#000066">H αποθήκευση των αλλαγών έγινε επιτυχώς</font></h1></div><hr color="#FF0000" />

<form action="main.php" method="post"><p align="center"><input  type="submit"  name="submit" value="Επιστροφή"  align="middle" class="buton2"/></p>
<input type="hidden" name="user" value="<? print $user ?>" >

</form>









</body>
</html>