<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name = "viewport" content = "width = device-width">

<title>Καταχώρηση επίσκεψης ασθενούς</title>
</head>
<link href="format.css" rel="stylesheet" type="text/css">
<? 
include ("Connect.php");
include ("encryption.php");
include ("decrypt.php");


if(empty($_GET['user'])){ ?>
	<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1><h2><font color="#000066">
	<a href="index.html">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2></div><hr color="#FF0000" />
	<? exit();
}


$user = $_GET['user']; 
$userD = my_decrypt($user, $key);
  


// Check in DataBase if User has any record
$sql = "SELECT * FROM basic WHERE  user = '$userD';";
$result = mysqli_query($conn, $sql);
$countsql = mysqli_num_rows($result);  
  
  
if($countsql == 0){?>
  <div align="center"><h3><font color="#000066">Δεν βρέθηκε κανένας ασθενής</font></h3></div>
    <hr color="#FF0000" />
	<? exit();
  
}  
  
  
  
  
  
  
  
  
?>

<script>
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

<body>

<table width="1000" align="center" background= "back-visit.jpg">
  <tr><td>

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
      
      		</th>
   	    </tr>
  	  </tbody>
	</table>

	<table width="1000" >
  		<tbody>
    		<tr>
      			<th width="990" height="72" scope="col" style="font-size:25px">
      <form name="search" method="post"   action="kataxorisi.php">
  	  				<table width="495" align="center">
  	  					<tr>
  	  						<td style="font-size:25px" align="center" class="text-visit">Επιλέξτε ασθενή</td>
  	  					</tr>
      					<tr>
      						 <td align="center"  width="441" class="">
							 <? $SQL = "SELECT * FROM basic WHERE user = '$userD'"; 
									$result = mysqli_query($conn, $SQL); ?> 
      			             
                             <!-- Drop down list with all patients of specific user  -->
                             <select name="search"  class="search-list"  id="Username-AMKAList">
                             				<option></option>
      						   				<?
											while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                                            		<option value="<? print $row['lname']; ?>"><? print $row['lname']."   ".$row['fname']."   -   ".$row['amka']; ?></option>
										<? } ?>
      			             </select>
                              
      						<input type="hidden" name="user" value="<? print $user; ?>"/> 
      						<!-- post encrypted username -->
                            
   						  </td>
      					</tr>
      					<tr>
      					   	 <td align="center">
                          		<input name="Εύρεση" type="submit" class="buton2" id="Εύρεση"  value="Εμφάνιση"> 
                             </td>
                        </tr>
  	  				</table>
       </form>
				</th>
   			</tr>
  		</tbody>
	</table>

  </td></tr>
</table>


</body>
</html>