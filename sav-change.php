<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<? 
include ("Connect.php");
include("decrypt.php");
include("ecnryption.php") ;
  
date_default_timezone_set('Greece/Athens');

$date = date("d/m/Y");
?>
<body>
<? 
$user = $_POST['user'];
$chol = $_POST['chol'];
$hyper = $_POST['hyper'];
$amka = $_POST['amka'];
$nosima = $_POST['nosima'];
$diab1 = $_POST['diab-1'];
$diab2 = $_POST['diab-2'];
$istoriko = $_POST['istoriko'];
$exam = $_POST['exam'];
$kliniki = $_POST['kliniki'];
$parat = $_POST['parat'];

$userD = my_decrypt($user,$key);  // decrypt userName


if ($diab1 == $diab2 AND $diab1 == 'on'){?><div align="center"><h1><font color="#006">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στην επιλογή διαβήτη....</font></h1></div><hr color="#FF0000" /><? exit();} 

// -----------------Καταχώρηση Diab-1--------------------------------//
if (empty($diab1)){$ins = "UPDATE  basic  SET d1 = '0' WHERE user = '$userD' AND amka='$amka'";}
else{$ins = "UPDATE  basic  SET  d1='1' WHERE user = '$userD' AND amka='$amka' ";} 
if(!mysqli_query($conn, $ins)){echo "Δεν έγινε αποθήκευση της τιμής Diab-1..." ; exit();}
//---------------------------------------------------------------------//


// -----------------Καταχώρηση Diab-2--------------------------------//
if (empty($diab2)){$ins = "UPDATE  basic  SET d2 = '0' WHERE user = '$userD' AND amka='$amka'";}
else{$ins = "UPDATE  basic  SET  d2='1' WHERE user = '$userD' AND amka='$amka' ";} 
if(!mysqli_query($conn, $ins)){echo "Δεν έγινε αποθήκευση της τιμής Diab-2..." ; exit();}
//---------------------------------------------------------------------//



// -----------------Καταχώρηση Chol--------------------------------//
if (empty($chol)){$ins = "UPDATE  basic  SET d3 = '0' WHERE user = '$userD' AND amka='$amka'";}
else{$ins = "UPDATE  basic  SET  d3='1' WHERE user = '$userD' AND amka='$amka' ";} 
if(mysqli_query($conn, $ins)){$c = "ok";}else{echo "Δεν έγινε αποθήκευση της τιμής Chol..." ; exit();}
//---------------------------------------------------------------------//




// -----------------Καταχώρηση Hyper--------------------------------//
if ( empty($hyper)){$ins = "UPDATE  basic  SET d4 = '0' WHERE user = '$userD' AND amka='$amka'";}
else{$ins = "UPDATE  basic  SET  d4='1' WHERE user = '$userD' AND amka='$amka' ";} 
if(mysqli_query($conn, $ins)){$d = "ok";}else{echo "Δεν έγινε αποθήκευση της τιμής Hyper..." ; exit();}
//---------------------------------------------------------------------//

	


// -----------------Καταχώρηση nosima--------------------------------//
if (isset ($nosima)){$ins = "UPDATE  basic  SET d5 = '$nosima' WHERE user = '$userD' AND amka='$amka'";}
if(mysqli_query($conn, $ins)){$e = "ok";}else{echo "Δεν έγινε αποθήκευση της τιμής nosima..." ; exit();}
//---------------------------------------------------------------------//



// -----------------Καταχώρηση istoriko--------------------------------//
if (isset ($istoriko)){$ins = "UPDATE  older  SET comments = '$istoriko' WHERE user = '$userD' AND amka='$amka'";}
if(mysqli_query($conn, $ins)){$f = "ok";}else{echo "Δεν έγινε αποθήκευση της τιμής istoriko..." ; exit();}
//---------------------------------------------------------------------//



// -----------------Καταχώρηση exam--------------------------------//
if (!empty($exam)){$inp = "INSERT INTO  exam (user, amka, exam, date) VALUES ('$userD' , '$amka', '$exam', '$date')";
if(mysqli_query($conn, $inp)){$g= "ok";}else{echo "Δεν έγινε αποθήκευση της τιμής exam.." ; exit();}}
//---------------------------------------------------------------------//

// -----------------Καταχώρηση kliniki--------------------------------//
if (!empty($kliniki)){$ins = "INSERT INTO  visit (user, amka, comment, date) VALUES ('$userD' , '$amka', '$kliniki', '$date')";}
if(mysqli_query($conn, $ins)){$h= "ok";}else{echo "Δεν έγινε αποθήκευση της τιμής kliniki..." ; exit();}
//---------------------------------------------------------------------//


// -----------------Καταχώρηση comments--------------------------------//
$ins = "UPDATE  comment  SET com = '$parat' WHERE user = '$userD' AND amka='$amka'";
if(mysqli_query($conn, $ins)){$i= "ok";}else{echo "Δεν έγινε αποθήκευση της τιμής parat..." ; exit();}
//---------------------------------------------------------------------//?>


<?  if ((!empty($exam)) || (!empty($kliniki))){
$ins = "UPDATE  basic  SET lastrec = '$date' WHERE user = '$userD' AND amka='$amka'";
if(mysqli_query($conn, $ins)){$i= "ok";}else{echo "Δεν έγινε αποθήκευση της τιμής last-rec..." ; exit();}

	
	
}?>


<div align="center"><h1><font color="#000066">H αποθήκευση των αλλαγών έγινε επιτυχώς</font></h1></div><hr color="#FF0000" />
<form action="index.html"  action="index.html">
<p align="center"><input  type="submit"  name="submit" value="Επιστροφή"  align="middle"/></p>
</form>








</body>
</html>