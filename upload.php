<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name = "viewport" content = "width = device-width">
<link href="format.css" rel="stylesheet" type="text/css">
<title>Upload εγγράφων</title>
</head>


<!-------------Ρολόι------------------------->
<script>
<?
 include ("Connect.php");
include ("encryption.php");
include ("decrypt.php");



 ?>

function date_time(id)
{
        date = new Date;
     
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}


</script>

<!------------------------------------------->
<script>
function showImg() {
   document.getElementById("map_img").style.display = "";
}
</script>
	
<!------------------------->
  
<?
$user = $_GET['user'];
$userD = my_decrypt($user, $key); // decrypt userName
  
  
  

// Check in DataBase if User has any record
$sql = "SELECT * FROM basic WHERE  user = '$userD';";
$result = mysqli_query($conn, $sql);
$countsql = mysqli_num_rows($result);  
  
  
if($countsql < 1){?>
  <div align="center"><h3><font color="#000066">Δεν βρέθηκε κανένας ασθενής</font></h3></div>
    <hr color="#FF0000" />
	<? exit();
  
}  ?>


<body>
<?


// if user-Post(From main.php) is empty, give error page
if(empty($_GET['user'])){ ?>
	<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1><h2><font color="#000066">
	<a href="http://index.html">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2></div><hr color="#FF0000" />
	<? exit();
} 



?>

  
  
  
  
  

<table width="1000" align="center" background= "back-visit.jpg">
	<tr>
		<td>
			<table width="1000"   class="top-banner">
  				<tbody>
    				<tr>
      					<th width="45" height="39" scope="col"><img src="logo.jpg" width="60" height="42" alt="logo"></th>
      					<th width="185" scope="col">Medical PLAN</th>
      					<th width="515" scope="col">
       					<? 
       					    $nowdate = date('d/m/Y');
                            echo $nowdate;
                        ?>
      					</th>
      					<th width="120" scope="col">
      
                            <!---- Real clock ---------->
      						<span id="date_time"></span>
      						<script type="text/javascript">window.onload = date_time('date_time');</script>
                            <!-------------------------->
          				</th>
    				</tr>
  				</tbody>
			</table>
<hr>
			<form action="ok-upload.php" id="upload" name="upload" method="post"  enctype="multipart/form-data">
				<table width="368"  align="center" border="1">
					<tr>
						<td colspan="5" align="center" class="header">UPLOAD ΕΓΓΡΑΦΩΝ</td>
					</tr>
				</table>
<hr>

				<table width="444"  align="center" border="1">
  					<tr>
    					<td width="126" align="center">Επιλογη ασθενους
						<?
                            $bas = "SELECT * FROM basic WHERE  user='$userD'";
                            $res = mysqli_query($conn, $bas);	
                        ?>
  							<select name="amka"> 
							<option></option>
						<? 
						    while ($rw = mysqli_fetch_array($res, MYSQLI_ASSOC)){ ?>
                            	
								<option value="<? print $rw['amka']; ?>"><? print $rw['lname']."  ".$rw['fname']."   ".$rw['amka']; 
							}?>
                                </option>
 							</select>
						</td>
  					</tr>
				</table>
				<input type="hidden" name="user" value="<? print $user; ?>" >
				<table align="center" width="444" border="1">
					<tr>
						<td align="center">
							Αρχειο:
							<input type="file" name="photo" id="MyButton" value="Capacity Chart">
						</td>
					</tr>
				</table>
<hr>
				<table width="306"  align="center">
  					
                   
                    	
                    
                    <tr align="center">
                    		
                        <td colspan="5" align="center">
        					<input name="submit" type="submit" class="buton" id="map" value="Upload"  onclick="showImg()" style=" color:#030"></input>
      					</td>
					</tr>
				</table>
			</form>
			<table align="center">
				<tr>
  					<td colspan="5" align="center">
    				<form name="form6" method="post" action="main.php">
    					<input type="hidden" name="user" value="<? print $user; ?>" >
      					<input name="cancel" type="submit" class="buton" id="cancel" value="Ακύρωση">
      				</form>
      				</td>
      			</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>