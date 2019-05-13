<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name = "viewport" content = "width = device-width">
<title>upload</title>
</head>
<body>
<link href="format.css" rel="stylesheet" type="text/css">
<? 

if(empty($_POST['user'])){ ?>
		<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1>
        	<h2><font color="#000066"><a href="http://balokas.eu.pn">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2>
        </div>
        <hr color="#FF0000" />
		<? exit();
}

include ("Connect.php");
include ("encryption.php");
include ("decrypt.php");


// Posted from upload.php
$user = $_POST['user'];
$amka =$_POST['amka'];
$date = date('d/m/Y');
 
$userD = my_decrypt($user,$key);  // decrypt userName
 
if(empty($_FILES['photo']['name']) || empty($_POST['amka'])){ ?>
	<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε επιλεξει αρχειο η ασθενη....</font></h1></div><hr color="#FF0000" />
	<? exit();
}

// set upload target Folder
$target_path = "upload/"; 
$f1 = "upload/".$_FILES['photo']['name'];
$target_path = $target_path.basename($_FILES['photo']['name']); 

// Checking in DataBase for same files
$bas = "SELECT * FROM upload WHERE  user='$userD' AND amka = '$amka' AND f1 = '$f1'";
$res = mysqli_query($conn, $bas);	
$countsql = mysqli_num_rows($res);
if ($countsql !=0){		// if  found same file in DataBase return error page
       ?><div align="center"><h1><font color="#000066">Υπάρχει ήδη αυτό το αρχείο.</font></h1></div><hr color="#FF0000" />			
		<? exit();
}


// Upload file to folder 'upload' in site
if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) { 

								// -----------------Save data to table 'Basic' in DataBase --------------------------------//
			$int = "INSERT INTO upload(user, amka, f1, date) VALUES ('$userD','$amka', '$f1', '$date')";
			if(!mysqli_query($conn, $int)){?>
					<div align="center"><h1><font color="#000066">Δεν έγινε αποθήκευση της εγγραφής....</font></h1></div>
        			<hr color="#FF0000" />
			<?	exit();
			} 
			
			//---------------------------------------------------------------------//
?>
			<div align="center"><h1><font color="#000066">
					<? print "Το αρχειο ".$_FILES['photo']['name']." ανεβηκε επιτυχως!!!"; ?></font></h1><hr color="#FF0000" />
					<form action="main.php" method="post">
						<input type="hidden" name="user" value="<? print $user; ?>" />
						<input type="submit" name="back" value="Επιστροφη" class="buton2"/>
					</form>
			</div>
<? 
} else{
		?> <div align="center">
        			<h1><font color="#000066">Υπήρξε ένα πρόβλημα κατά το Upload...</font></h1>
             </div>
			<?  exit();
} 
 
?>



</body>
</head>
</html>
