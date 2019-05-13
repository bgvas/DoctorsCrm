<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name = "viewport" content = "width = device-width">

<title>Λίστα Ασθενών</title>
</head>
<link href="format.css" rel="stylesheet" type="text/css">
<? 

// check if posted (from main.php) and set $user as $_GET['user'] else give error page 
if(empty($_GET['user'])){ ?>
	<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1><h2>
	<font color="#000066"><a href="http://index.htlm">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2></div><hr color="#FF0000" />
	<? exit();
}


include ("Connect.php");
include ("decrypt.php");
include ("encryption.php");

$user = $_GET['user'];
$userD = my_decrypt($user, $key);

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

<? 
date_default_timezone_set('Greece/Athens'); 
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
   					      <? $nowdate = date('d/m/Y');
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
			<table width="1000" >
  				<tbody>
    				<tr>
      					<th width="990" height="72" scope="col" style="font-size:25px">Λίστα Ασθενών Ιατρείου</th>
    				</tr>
  				</tbody>
			</table>
			<table width="1000" align="center" border="1">
    			<tr class="header-list">
      				<td width="95" align="center" class="header-list" style="font-size:10px">Επίθετο</td>
      				<td width="95" style="font-size:10px" align="center">Όνομα</td>
      				<td width="57" style="font-size:10px" align="center">ΑΜΚΑ</td>
      				<td width="31" style="font-size:10px" align="center">Ηλικία</td>
      				<td width="100" style="font-size:10px" align="center">Πόλη</td>
      				<td width="141" style="font-size:10px" align="center">Δνση</td>
      				<td width="35" style="font-size:10px" align="center">ΤΚ</td>
      				<td width="65" style="font-size:10px" align="center">Τηλέφωνο</td>
      				<td width="65" style="font-size:10px" align="center">Κινητό</td>
      				<td width="80" style="font-size:10px" align="center">Νέα επίσκεψη</td>
      				<td width="80" style="font-size:10px" align="center">Επεξεργασία</td>
      				<td width="80" style="font-size:10px" align="center">Διαγραφή</td>
    			</tr>
    			<tr>
    			<? 
                    $bas = "SELECT * FROM basic WHERE user = '$userD' ORDER BY lname ASC";
                    $res = mysqli_query($conn, $bas);	
                    while ($rw = mysqli_fetch_array($res, MYSQLI_ASSOC)) {?>
   						<td width="95" style="font-size:10px" align="center"><? print $rw['lname']; ?></td>
      					<td width="95" style="font-size:10px" align="center"><? print $rw['fname']; ?></td>
      					<td width="57" style="font-size:10px" align="center"><? print $rw['amka']; ?></td>
      					<td width="31" style="font-size:10px" align="center"><? print $rw['age']; ?></td>
      					<td width="100" style="font-size:10px" align="center"><? print $rw['town']; ?></td>
      					<td width="141" style="font-size:10px" align="center"><? print $rw['address']; ?></td>
      					<td width="35" style="font-size:10px" align="center"><? print $rw['tk']; ?></td>
      					<td width="65" style="font-size:10px" align="center"><? print $rw['til']; ?></td>
      					<td width="65" style="font-size:10px" align="center"><? print $rw['mobile']; ?></td>
      					<td width="80" style="font-size:10px" align="center">
      					<form action="kataxorisi.php" method="post" name="επίσκεψη">
      						<input type="submit" name="visit" value="Νέα επίσκεψη" class="buton-litle" />
       						<input type="hidden" name="amka" value="<? print $rw['amka']; ?>"/>
       						<input type="hidden" name="user" value="<? print $user; ?>"/>
      					</form>
     					</td>
      					<td width="80" style="font-size:10px" align="center">
      					<form action="change.php" method="post" name="επεξεργασία">
      						<input type="submit" name="epex" value="Eπεξεργασία" class="buton-litle" style="color:#060" />
       						<input type="hidden" name="amka" value="<? print $rw['amka']; ?>"/>
        					<input type="hidden" name="user" value="<? print $user; ?>"/>
      					</form>
      					</td>
      					<td width="80" style="font-size:10px" align="center">
      					<form action="todel.php" method="post" name="διαγραφή">
      						<input type="submit" name="del" value="Διαγραφή" class="buton-litle" style="color:#F00" />
       						<input type="hidden" name="amka" value="<? print $rw['amka']; ?>"/>
       						<input type="hidden" name="user" value="<? print $user; ?>"/>
      					</form>
      					</td>
   						</tr>
   							<? 
                    } 
                            ?>
			</table>
		</td>
	</tr>
</table>


</body>
</html>


