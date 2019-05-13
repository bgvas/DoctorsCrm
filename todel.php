<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name = "viewport" content = "width = device-width">

<title>Καταχώρηση στοιχείων νέου ασθενή</title>
</head>
<link href="format.css" rel="stylesheet" type="text/css">

<? 
if(empty($_POST['user'])){ ?>
<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1><h2><font color="#000066">
<a href="http://index.html">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2></div><hr color="#FF0000" /><? exit();}
include ("Connect.php"); 
include("decrypt.php");
include("encryption.php");
  

  

  
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

$amka = $_POST['amka']; 
$user = $_POST['user'];
 

$userD = my_decrypt($user,$key);  // decrypt userName


?>

<table width="1000" align="center" background= "back-visit.jpg">
<tr><td>

<table width="1000"   class="top-banner">
  <tbody>
    <tr>
      <th width="45" height="39" scope="col"><img src="logo.jpg" width="60" height="42" alt="logo"></th>
      <th width="185" scope="col">Media PLAN</th>
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

<hr>
<?     
  $bas = "SELECT * FROM basic WHERE user = '$userD' AND amka = '$amka' ";
  $res = mysqli_query($conn, $bas);	
   while ($rw = mysqli_fetch_array($res, MYSQLI_ASSOC)) {?>

<table align="center" width="900">
<tr>
<td style="font-weight:bolder; color:#DC143C; font-size:22px" align="center">ΠΡΟΣΟΧΗ!!! Αν συνεχίσετε, θα διαγραφούν οριστικά τα στοιχεία του ασθενούς με το όνομα:<font color="#000000"><? print "  ".$rw['lname']."  ". $rw['fname']."  ";} ?> </font>Θέλετε να συνεχίσετε;</td>
</tr>
</table>

<hr>

<table align="center">
<tr><td align="center">
<form action="del.php" name="del" method="post">
<input type="hidden" name="amka" value="<? print $amka; ?>" />
<input type="hidden" name="user" value="<? print $user; ?>" />
<input type="submit" name="submit" value="Διαγραφή στοιχείων οριστικά"  class="buton"/>
</form>
</td>
</tr>
<tr>
<td align="center">
<form action="main.php" name="cancel" method="post">
<input type="hidden" name="user" value="<? print $user; ?>" />
<input type="submit" name="submit" value="Ακύρωση διαγραφής" class="buton" style="color:#000000"/>
</form>
</td>
</tr>
</table>

</td></tr></table>

</body>
</html>