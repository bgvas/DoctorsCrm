<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Check user</title>
</head>

<body>
<?

clearstatcache();

// ------------------------------------------------------------------------------//
include ("Connect.php");
include ("encryption.php");
include ("decrypt.php");



// Give Error page if passWord-Post or user-Post, is empty
if (empty($_POST['user']) || empty($_POST['pass'])) {?>
	
	<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε δώσει το Username ή το Password....</font></h1></div>
	<hr color="#FF0000" />
<? 
    exit();
}

// encryption and decryption of userName and passWord
$user = my_encrypt($_POST['user'], $key);
$pass = $_POST['pass'];
$userD = my_decrypt($user,$key);  // decrypt userName



// Check in DataBase if User exists with this passWord
$sql = "SELECT * FROM user WHERE  user = '$userD'  AND pass = '$pass';";
$result = mysqli_query($conn, $sql);
$countsql = mysqli_num_rows($result);


// if user exists and password is ok, post the encrypted userName to main.php
if ($countsql >= 1) {?>
	
	<form action="main.php" name="main" method="post" id="main">
		<input type="hidden" name="user" value="<? print $user; ?>" />
		<script type="text/javascript">document.getElementById("main").submit(); </script>
	</form>



<?

// else give error page

} else {?>
 		<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Λάθος στο Username ή το Password....</font></h1></div>
		<hr color="#FF0000" />
<?

        exit();
}?>






</body>
</html>