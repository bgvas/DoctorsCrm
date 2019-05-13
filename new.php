<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name = "viewport" content = "width = device-width">

<title>Καταχώρηση στοιχείων νέου ασθενή</title>
</head>
<link href="format.css" rel="stylesheet" type="text/css">

<!---------------- Only numbers are accepted ---------------------------->
 <script>
    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
   </script> 

<!-------------------------------------------------------------->




<!-------------Clock ------------------------->
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

<!------------------------------------------->

<? 

include ("encryption.php");
include ("decrypt.php");



// if user posted from main.php, then set $user = $_GET['user'] else give error page 
if(empty($_GET['user'])){ ?>
	<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1><h2><font color="#000066">
	<a href="http://balokas.eu.pn">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2></div><hr color="#FF0000" />
	<? exit();
}

$user= $_GET['user'];
$userD = my_decrypt($user, $key);  //decrypt username


?>


<body>

<table width="1000" align="center" background= "back-visit.jpg">
	<tr>
		<td>
			<table width="1000"   class="top-banner">
  				<tbody>
    				<tr>
      					<th width="45" height="39" scope="col"><img src="logo.jpg" width="60" height="42" alt="logo"></th>
      					<th width="185" scope="col">Medical PLAN</th>
      					<th width="515" scope="col">
      					<?   $nowdate = date('d/m/Y');
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
		<form action="sav-new.php" id="neos" name="neos" method="post">
			<table width="368"  align="center" border="1">
				<tr>
					<td colspan="5" align="center" class="header">ΚΑΤΑΧΩΡΗΣΗ ΣΤΟΙΧΕΙΩΝ ΝΕΟΥ ΠΕΛΑΤΗ</td>
				</tr>
			</table>
			<hr>
			<table width="444"  align="center" border="1">
    			<tr>
    				<td width="126" align="center">Επίθετο</td>
    				<td width="292" colspan="4"><input name="lname" type="text" id="lname" size="100" maxlength="100" width="100"  class="p2"/>*</td>
  				</tr>
  
  				<tr>
    				<td width="126" align="center">Όνομα</td>
    				<td colspan="4"><input name="fname" type="text" id="fname" size="100" maxlength="100" width="100"  class="p2"/>*</td>
  				</tr>
  				<tr>
    				<td align="center">ΑΜΚΑ</td>
    				<td colspan="4"><input  type="tel" size="11" id="someid" name="amka" class="p2" maxlength="11" onKeyPress="return isNumberKey(event)" />*
    				</td>
  				</tr>
  				<tr>
    				<td align="center">Ηλικία</td>
    				<td colspan="4"><input  type="tel" size="3" id="someid" name="age" class="p2" maxlength="3" onKeyPress="return isNumberKey(event)" />*</td>
  				</tr>
  				<tr>
    				<td align="center">Δ/νση</td>
    				<td colspan="4"><input name="adr" type="text" id="adr" size="100" maxlength="100" width="100"  class="p2"/></td>
  				</tr>
  				<tr>
    				<td align="center">Πόλη</td>
    				<td colspan="4"><input name="town" type="text" id="town" size="100" maxlength="100" width="100"  class="p2"/>*</td>
  				</tr>
  				<tr>
    				<td align="center">Τ.Κ</td>
    				<td colspan="4"><input  type="tel" size="6" id="someid" name="tk" class="p2" maxlength="5" onKeyPress="return isNumberKey(event)" /></td>
  				</tr>
  				<tr>
    				<td align="center">Τηλ.</td>
    				<td colspan="4"><input  type="til" size="10" id="someid" name="til" class="p2" maxlength="10" onKeyPress="return isNumberKey(event)" /></td>
  				</tr>
  				<tr>
    				<td align="center">Κιν.</td>
    				<td colspan="4"><input  type="tel" size="10" id="someid" name="kin" class="p2" maxlength="10" onKeyPress="return isNumberKey(event)" />*</td>
  				</tr>
  				<tr>
    				<td align="center">Email</td>
    			<td colspan="4">
    				<input name="mail" type="text" id="mail" size="100" maxlength="100" width="100"  class="p2"/>
    			</td>
  			</tr>
  		</table>
  
  		<p style="font-size:9px" align="center">(Τα πεδία με * είναι υποχρεωτικά στην συμπλήρωση)</p>
  			<hr>
    		<table align="center" border="1" width="368">
    			<tr>
    				<td colspan="5" align="center" class="header">ΕΙΚΟΝΑ ΑΣΘΕΝΟΥΣ</td>
  				</tr>
			</table>

			<hr>
			<table width="395"  align="center" border="1" >
  				<tr>
    				<td width="96" align="center">Διαβήτης</td>
    				<td width="177" align="center" style="border:0px">Τύπου Ι<input name="d1" type="checkbox" class="input.largerCheckbox" id="d1" style="font-size:xx-small"></td>
        			<td width="177" align="center" style="border:0px">Τύπου ΙΙ<input name="d2" type="checkbox"  id="d2" ></td>
  				</tr>
  				<tr>
    				<td align="center">Υπέρταση</td>
    				<td colspan="4" align="center">
      					<input type="checkbox" name="hyper" id="hyper">
      				</td>
  				</tr>
  				<tr>
    				<td align="center">Δυσλιπιδαιμία</td>
    				<td colspan="4" align="center">
      					<input type="checkbox" name="chol" id="chol">
      				</td>
  				</tr>
  				<tr>
    				<td align="center">Άλλο χρόνιο νόσημα</td>
    				<td colspan="4" align="center"><input name="nos" type="text" class="text-visit" id="nos" size="40"/>
    				</td>
    			</tr>
    		</table>
    		<table border="1" align="center">
  				<tr>
    				<td width="102" align="center">Ιστορικό</td>
    				<td width="600" colspan="4" align="center"><textarea name="hist" cols="80" class="p" id="hist"></textarea></td>
  				</tr>
			</table>
			<hr>
			<table width="368"  align="center">
  				<tr>
    				<td colspan="5" align="center">
    					<input type="hidden" name="user" value="<? print $user; ?>" >
      					<input name="submit" type="submit" class="buton" id="submit" value="Καταχώρηση στοιχείων"  style=" color:#030">
      				</td>
      			</tr>
      		</table>
      	</form>
  		</tr>
  		<tr>
    		<td colspan="5" align="center">
    	<form name="form6" method="post" action="main.php">
    		<input type="hidden" name="user" value="<? print $user; ?>" >
   			<input name="cancel" type="submit" class="buton" id="cancel" value="Ακύρωση">
    	</form>
    		</td>
      	</tr>
</table>
</body>
</html>