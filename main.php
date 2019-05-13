<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Start Menu</title>

<link href="format.css" rel="stylesheet" type="text/css">

</head>
<body>
<div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
<div align="justify"  class="divform">

            <!--  The main Menu Form -->



<?
include ("encryption.php");
include ("decrypt.php");

// if user-Post is empty, give error page
if (empty($_POST['user'])){?>
	<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1>
		<h2>
			<font color="#000066">
				<a href="index.html">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a>
			</font>
		</h2>
	</div>
	
	<hr color="#FF0000" />
	<? exit();
}

$user = $_POST['user'];
$userD = my_decrypt($user, $key); // decrypt userName



?>

<table width="533" align="center" class="top-banner" >
   <tr valign="middle" >  
      <th width="79" align="center" scope="col"><img src="logo.jpg" width="72" height="64" alt=""/></th>
      <th width="194" scope="col" >Medical PLAN</th>
   	  <th width="191" scope="col" >
		
		
		<!-- JS Script for Date and real clock  -->
		<script>
    		var date = new Date(Date());
			var options = {year: "numeric", month: "short", day: "numeric", hour: "2-digit", minute: "2-digit"	};
			document.write(date.toLocaleTimeString("el-gr", options));
     	</script>
     	
     	
      </th>
 	  <th width="41" scope="col"></th>
    </tr>
</table>



<table width="533" align="center" background="back-visit.jpg">
    <tr>
    	<td height="42" colspan="3" align="center" style="font-size:22px; font-weight:bolder">Κεντρικό Μενού<hr></td>
    </tr>
    <tr>
    	<td colspan="3" >&nbsp;</td>
    </tr>
    <tr align="center">
    	<td width="63" >&nbsp;</td>
    	<td height="30"  bgcolor="#CCCCCC"><a href="patien.php?user=<? print $user; ?>" class="buton2">Καταχώρηση Επίσκεψης</a></td>
    	<td width="51" >&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="3">&nbsp;</td>
    </tr>
    <tr align="center">
    	<td width="63">&nbsp;</td>
    	<td height="30"  bgcolor="#CCCCCC"><a href="new.php?user=<? print $user; ?>" class="buton2">Καταχώρηση Νέου ασθενή</a></td>
    	<td width="51" >&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="3">&nbsp;</td>
    </tr>
    <tr align="center">
    	<td width="63" >&nbsp;</td>
    	<td height="30"  bgcolor="#CCCCCC"><a href="selchange.php?user=<? print $user; ?>" class="buton2">Αλλαγή στοιχείων ασθενούς</a></td>
    	<td width="51" >&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="3">&nbsp;</td>
    </tr>
    <tr align="center">
    	<td width="63" >&nbsp;</td>
    	<td height="30"  bgcolor="#CCCCCC"><a href="upload.php?user=<? print $user; ?>" class="buton2">Upload εγγράφων</a></td>
    	<td width="51" >&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="3">&nbsp;</td>
    </tr>
    <tr align="center">
    	<td width="63">&nbsp;</td>
    	<td height="30"  bgcolor="#CCCCCC"><a href="list.php?user=<? print $user; ?>" class="buton2">Λίστα Ασθενών</a></td>
    	<td width="51" >&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="3">&nbsp;</td>
    </tr>
    <tr>
     	<td>&nbsp;</td>
     	<td align="center"><a href="backup.php" title="Backup" ><img src="backup.jpg" width="74" height="48" alt="backup"></a></td>
     	<td>&nbsp;</td>
   </tr>
   <tr>
   		<td colspan="3" align="center"style="font-size:12px">!!! Πατήστε για BackUp τουλάχιστον μια φορά την ημέρα!!!</td>
   </tr>
   <tr>
   		<td height="62" colspan="3"  align="center"  bgcolor="#CCCCCC" style="font-size:20px"><a href="index.html" class="buton2">Έξοδος</a></td>
   </tr>
</table>


</div>
</body>
</html>
