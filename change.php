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

// check if posted img for delete, from (list.php or selchange.php)
if(!empty($_GET['img'])){
    $f1 = $_GET['img'];
    $us = $_GET['user'];
    $am = $_GET['amka'];
    $_POST['amka'] = $_GET['amka'];
    $_POST['user'] = $_GET['user'];
    $a = "DELETE FROM upload WHERE amka ='$am' AND f1 = '$f1'";
    if(!mysqli_query($conn, $a) || !unlink($f1)){
        ?><div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έγινε η διαγραφή...(error-img)</font></h1></div>
          <hr color="#FF0000" />
        <? exit();
    }
}

// check if values, posted from (list.php or selchange.php)
if(empty($_POST['user'])){ ?>
	<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1><h2><font color="#000066">
	<a href="http://index.php">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2></div>
	<hr color="#FF0000" /><? 
	exit();
}

$user = $_POST['user'];
$userD = my_decrypt($user, $key); // decrypt userName
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


<script>
$('input[name="number"]').keyup(function(e)
{
    if (/\D/g.test(this.value))
    {
        // Filter non-digits from input value.
        this.value = this.value.replace(/\D/g, '');
    }
});
</script>




<body>
<?

date_default_timezone_set('Greece/Athens');


if(!isset($_POST['amka'])){     
    $search = $_POST['search'];
    if(!$search){?><div align="center"><h1><font color="#000066">Δεν πληκτρολογήσατε  τίποτα.</font></h1></div><hr color="#FF0000" />
    	<? exit();
    }
    $sql = "SELECT * FROM basic WHERE  user='$userD' AND amka  LIKE '$search'  OR lname LIKE '$search'";
    $result = mysqli_query($conn, $sql);	
    $countsql = mysqli_num_rows($result);
    if ($countsql==0){?><div align="center"><h1><font color="#000066">Δεν βρέθηκε τίποτα. Δοκιμάστε ξανά...</font></h1></div>
    	<hr color="#FF0000" />
    	<? exit();
    }
}else{$search = $_POST['amka'];}

?>

<table width="998"   class="top-banner" align="center">
  <tbody>
    <tr>
      <th width="66" height="39" scope="col"><img src="logo.jpg" width="60" height="42" alt="logo"></th>
      <th width="203" scope="col">Λουκας Μπαλόκας</th>
      <th width="567" scope="col">
      
       <? $nowdate = date('d/m/Y');
          echo $nowdate;
       ?>
      </th>
      <th width="138" scope="col">
      
      <!---- Real clock ---------->
      <span id="date_time"></span>
      <script type="text/javascript">window.onload = date_time('date_time');</script>
      <!-------------------------->
      
      </th>
    </tr>
  </tbody>
</table>

<table width="998" align="center" background="back-visit.jpg">
	<tr>
	  <td>
		<table width="990" >
  			<tbody>
    			<tr>
      				<th width="990" height="72" scope="col" style="font-size:25px">Aλλαγή στοιχείων ασθενούς</th>
    			</tr>
  			</tbody>
		</table>

<? 
	  
        $bas = "SELECT * FROM basic WHERE  user='$userD' AND amka  LIKE '$search'  OR lname LIKE '$search'";
        $res = mysqli_query($conn, $bas);	
        while ($rw = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $amka = $rw['amka'];
            $SQL = "SELECT * FROM basic WHERE amka = '$amka' AND user = '$userD'"; 
            $result = mysqli_query($conn, $SQL);	
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
<form action="save-change.php" id="change" name="change" method="post">
		<table width="444"  align="center" border="1">
   			<tr>
    			<td width="126" align="center">Επίθετο</td>
    			<td width="292" colspan="4" align="left"><input name="lname" type="text" id="lname" size="100" maxlength="100" width="100"  class="p2"  value="<? print $row['lname']; ?>" />*</td>
  			</tr>
    		<tr>
    			<td width="126" align="center">Όνομα</td>
    			<td colspan="4" align="left"><input name="fname" type="text" id="fname" size="100" maxlength="100" width="100"  class="p2" value="<? print $row['fname']; ?> "/>*</td>
  			</tr>
  			<tr>
    			<td align="center">ΑΜΚΑ</td>
    			<td colspan="4" align="left"><input  type="tel" size="11" id="someid" name="amka" class="p2" maxlength="11" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  value="<? print $row['amka']; ?>"/>*
    				<input  type="hidden"  name="hamka"  value="<? print $amka ?>" />
    			</td>
  			</tr>
  			<tr>
    			<td align="center">Ηλικία</td>
    			<td colspan="4" align="left"><input  type="text" size="3" id="someid" name="age" class="p2"  maxlength="3" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  value="<? print $row['age']; ?> " />*</td>
  			</tr>
  			<tr>
    			<td align="center">Δ/νση</td>
    			<td colspan="4" align="left"><input name="adr" type="text" id="adr" size="100" maxlength="100" width="100"  class="p2" value="<? print $row['address']; ?> "/></td>
  			</tr>
  			<tr>
    			<td align="center">Πόλη</td>
    			<td colspan="4" align="left"><input name="town" type="text" id="town" size="100" maxlength="100" width="100"  class="p2"value="<? print $row['town']; ?> " />*</td>
  			</tr>
 			<tr>
    			<td align="center">Τ.Κ</td>
    			<td colspan="4" align="left"><input  type="tel" size="5" id="someid" name="tk" class="p2" maxlength="5" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<? print $row['tk']; ?> " /></td>
  			</tr>
  			<tr>
    			<td align="center">Τηλ.</td>
    			<td colspan="4" align="left">
    				<input name="til" type="tel"  class="p2" value="<? print $row['til']; ?>" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="10" size="10"></td>
  			</tr>
  			<tr>
    			<td align="center">Κιν.</td>
    			<td colspan="4" align="left"><input  type="tel" size="10" id="someid" name="kin" class="p2" maxlength="10" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<? print $row['mobile']; ?> " />*</td>
  			</tr>
  			<tr>
    			<td align="center">Email</td>
    			<td colspan="4" align="left"><input name="mail" type="text" id="mail" size="100" maxlength="100" width="100"  class="p2" value="<? print $row['mail']; ?> " /></td>
  			</tr>
  		</table>
   		<p style="font-size:9px" align="center">(Τα πεδία με * είναι υποχρεωτικά στην συμπλήρωση)</p>
<hr>
		<table width="368"  align="center">
 	 		<tr>
    			<td colspan="5" align="center">
    				<input type="hidden" name="user" value="<? print $user ?>" >
      				<input name="submit" type="submit" class="buton" id="submit" value="Καταχώρηση αλλαγών"  style=" color:#228B22">
      			</td>
      		</tr>
      	</table>
      
</form>




<hr class="text-visit">

<? 
$amka = $row['amka'];

$bas = "SELECT * FROM upload WHERE  user='$userD' AND amka ='$amka'";}
$res = mysqli_query($conn, $bas);	
$countsql = mysqli_num_rows($res);


if($countsql >0){
   ?>
	<table width="980" align="center">
		<tr>
			<td align="center" style="font-weight:bolder; font-size:18px">Πατήστε πάνω στο έγγραφο για να το διαγράψετε...
			</td>
		</tr>
	</table>

<table>
	<tr>
 		  <? while ($rw = mysqli_fetch_array($res, MYSQLI_ASSOC)) {?>
			<td align="center">
					<a href="change.php?img=<? echo $rw['f1'] ; ?>&amp;user=<? print $user ;?>&amp;amka=<? print $amka; ?>" width="100">
                    <img src="<? print $rw['f1']; ?>" name="upload"  width="60" height="40"></a>
					<br><? print $rw['f1']; ?></br><br><? print $rw['date']; ?></br>
			</td><?} ?>
	</tr>
  </table>





		<table width="980">
			<tr>
				<td align="center">
					<form action="main.php" method="post">
					<input type="hidden" name="user" value="<? print $user ;?>" >
					<input type="submit" name="cancel" value="Ακύρωση αλλαγών" class="buton" align="middle" style=" color:#000000"/>
					</form>
				</td>
				<td align="center">
					<form action="todel.php" name="del" method="post">
					<input type="hidden" name="amka" value="<? print $amka; ?>"/>
					<input type="hidden" name="user" value="<? print $user; ?>"/>
					<input type="submit" name="del" value="Διαγραφή στοιχείων ασθενούς" class="buton" align="middle" style="color:#B22222"/>
					</form>
				</td>
			</tr>
		</table>


	</td>
   </tr>
</table>



</body>
</html>