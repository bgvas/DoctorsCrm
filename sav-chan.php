<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Καταχώρηση επίσκεψης ασθενούς</title>
</head>
<link href="format.css" rel="stylesheet" type="text/css">
<? 
include ("Connect.php");
include ("decrypt.php");
include ("encryption.php");

date_default_timezone_set('Greece/Athens');




// if user-Post is empty give error page
if(empty($_POST['user'])){ ?>
	<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1><h2><font color="#000066">
	<a href="http://index.html">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2></div><hr color="#FF0000" /><? exit();
}

$date = date("d/m/Y");
?>
<body>
<? 

// posted from kataxorisi.php

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

$userD = my_decrypt($_POST['user'], $key); // decrypt userName

if ($diab1 == $diab2 AND $diab1 == 'on'){
        ?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Έχει γίνει λάθος στην επιλογή διαβήτη....</font></h1></div><hr color="#FF0000" />
		<? exit();
} 

// -----------------Update Diab-1--------------------------------//
if (empty($diab1)){
    $ins = "UPDATE  basic  SET d1 = '0' WHERE user = '$userD' AND amka='$amka'";
}else{
      $ins ="UPDATE  basic  SET  d1='1' WHERE user = '$userD' AND amka='$amka' ";
     } 
if(!mysqli_query($conn, $ins)){
    ?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε αποθήκευση της τιμής -> diab1</font></h1></div><hr color="#FF0000" />
    <? exit();
}
//---------------------------------------------------------------------//


// -----------------Update Diab-2--------------------------------//
if (empty($diab2)){
    $ins = "UPDATE  basic  SET d2 = '0' WHERE user = '$userD' AND amka='$amka'";
}else{
    $ins = "UPDATE  basic  SET  d2='1' WHERE user = '$userD' AND amka='$amka' ";
} 
if(!mysqli_query($conn, $ins)){
    ?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε αποθήκευση της τιμής -> diab2</font></h1></div><hr color="#FF0000" />
    <? exit();
}
//---------------------------------------------------------------------//



// -----------------Update Chol--------------------------------//
if (empty($chol)){
    $ins = "UPDATE  basic  SET d3 = '0' WHERE user = '$userD' AND amka='$amka'";
}else{
    $ins = "UPDATE  basic  SET  d3='1' WHERE user = '$userD' AND amka='$amka' ";
} 
if(!mysqli_query($conn, $ins)){
    ?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε αποθήκευση της τιμής -> chol</font></h1></div><hr color="#FF0000" />
    <? exit();
}
//---------------------------------------------------------------------//



// -----------------Update Hyper--------------------------------//
if (empty($hyper)){
    $ins = "UPDATE  basic  SET d4 = '0' WHERE user = '$userD' AND amka='$amka'";
}else{
    $ins = "UPDATE  basic  SET  d4='1' WHERE user = '$userD' AND amka='$amka' ";
} 
if(!mysqli_query($conn, $ins)){
    ?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε αποθήκευση της τιμής -> hyper</font></h1></div><hr color="#FF0000" />
    <? exit();
}
//---------------------------------------------------------------------//

	


// -----------------Update nosima--------------------------------//
if (isset ($nosima)){
    $ins = "UPDATE  basic  SET d5 = '$nosima' WHERE user = '$userD' AND amka='$amka'";
	if(!mysqli_query($conn, $ins)){
    	?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε αποθήκευση της τιμής -> nosima</font></h1></div><hr color="#FF0000" />
    	<? exit();
	}
}
//---------------------------------------------------------------------//



// -----------------New istoriko--------------------------------//
if (isset ($istoriko)){
    $ins = "UPDATE  older  SET comments = '$istoriko' WHERE user = '$userD' AND amka='$amka'";
	if(!mysqli_query($conn, $ins)){
    	?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε αποθήκευση της τιμής -> istoriko</font></h1></div><hr color="#FF0000" />
    	<? exit();
	}
}
//---------------------------------------------------------------------//



// -----------------New exam--------------------------------//
if(!empty($exam)){
    $ins = "INSERT INTO  exam (user, exam, date, amka) VALUES ('$userD' , '$exam', '$date', '$amka')";
	if(!mysqli_query($conn, $ins)){
    		?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε αποθήκευση της τιμής -> exam</font></h1></div><hr color="#FF0000" />
        	<? exit();
	}
}
//---------------------------------------------------------------------//

// -----------------Update kliniki--------------------------------//
if (!empty($kliniki)){
    $ins = "INSERT INTO  visit (user, amka, comment, date) VALUES ('$userD' , '$amka', '$kliniki', '$date')";
	if(!mysqli_query($conn, $ins)){
    	?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε αποθήκευση της τιμής -> kliniki</font></h1></div><hr color="#FF0000" />
    	<? exit();
	}
}
//---------------------------------------------------------------------//


// -----------------Update comments--------------------------------//
$ins = "UPDATE  comment  SET com = '$parat' WHERE user = '$userD' AND amka='$amka'";
if(!mysqli_query($conn, $ins)){
    ?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε αποθήκευση της τιμής -> parat</font></h1></div><hr color="#FF0000" />
    <? exit();
}
//---------------------------------------------------------------------//?>


<!--  if Posted from kataxorisi.php  new data in $exam or $kliniki, then set nowDate as last visit date for this patien -->
<? 
if ((!empty($exam)) || (!empty($kliniki))){
        $ins = "UPDATE  basic  SET lastrec = '$date' WHERE user = '$userD' AND amka='$amka'";
        if(!mysqli_query($conn, $ins)){
            ?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε αποθήκευση της τιμής -> last-rec</font></h1></div><hr color="#FF0000" />
            <? exit();
        }
}?>


	<div align="center"><h1><font color="#000066">H αποθήκευση των αλλαγών έγινε επιτυχώς</font></h1></div><hr color="#FF0000" />


<form action="main.php" method="post">
	<input type="hidden" name="user" value="<? print $user; ?>">
	<p align="center"><input  type="submit"  name="submit" value="Επιστροφή"  class="buton2" align="middle"/></p>
</form>








</body>
</html>