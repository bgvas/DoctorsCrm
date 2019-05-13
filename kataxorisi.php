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


// if username-Post(from patien.php or from list.php) is empty, give error page

if(empty($_POST['user'])){ ?>
	<div align="center"><h1><font color="#000066">ΠΡΟΣΟΧΗ!!! Δεν έχετε συνδεθεί....</font></h1><h2><font color="#000066">
	<a href="http://index.html">ΣΥΝΔΕΣΗ ΤΩΡΑ!!!</a></font></h2></div><hr color="#FF0000" /><? 
    exit();
    
}



?>


<!-- Date and time JS script -->
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

<!-- This form is for Importing new Data for patient -->

<?

$user = $_POST['user']; 
$userD = my_decrypt($user,$key);  // decrypt userName


date_default_timezone_set('Greece/Athens');


if(isset($_POST['amka'])){      // if amka posted from list.php set it to $search
    $search = $_POST['amka'];
}

if(isset($_POST['search'])){
    $search = $_POST['search'];  // if search posted from patien.php set it to $search 
}

if((!isset($_POST['amka'] )) && (!isset($_POST['search']))){?>
  	<div align="center"><h1><font color="#000066">Δεν δώθηκαν δεδομένα.</font></h1></div>
  	<hr color="#FF0000" />
  	<? exit();
}?>

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
      					      <span id="date_time"></span>
      						  <script type="text/javascript">window.onload = date_time('date_time');</script>
      				    </th>
    				</tr>
  				</tbody>
			</table>
                          <!-- check if  exist in DataBase  patien or AMKA like $search -->
      					<?  $bas = "SELECT * FROM basic WHERE  user='$userD' AND amka  LIKE '$search'  OR lname LIKE '$search'";
                            $res = mysqli_query($conn, $bas);	
							$countsql = mysqli_num_rows($res);
							if ($countsql==0){ 					// if  found nothing, return error page 
           								 ?><div align="center"><h1><font color="#000066">Δεν βρέθηκε τίποτα. Δοκιμάστε ξανά...</font></h1></div><hr color="#FF0000" />			
										 <? 
	       								exit();
							}?>

			<table width="1000" >
			<tbody>
    				<tr>
      					<th width="990" height="72" scope="col" style="font-size:25px">Επίσκεψη Ασθενούς στο ιατρείο</th>
    				</tr>
  				</tbody>
			</table>


			<!-- Table for presentation of patien's Data -->
			<table width="1000"  border="1">
  				<tbody>
    				<tr>
      					<th width="54" scope="col">Επίθετο</th>
      					
                        	<!-- else if found record like $search, present data	 -->
						<th width="59" scope="col" class="text-visit"><?
					        while ($rw = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                       	         $amka = $rw['amka'];
							}
                        	     $SQL = "SELECT * FROM basic WHERE amka = '$amka' AND user = '$userD'"; 
                                 $result = mysqli_query($conn, $SQL);	
                                 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	                          				  print $row['lname'];?>
	                    </th>
	                	<th width="46" scope="col" >Όνομα</th>
      					<th width="76" scope="col" class="text-visit"><? print $row['fname']; ?></th>
      					<th width="51" scope="col">ΑΜΚΑ</th>
      					<th width="126" scope="col" class="text-visit"><? print $row['amka']; ?></th>
      					<th width="150" scope="col">Τελευταία επίσκεψη</th>
      					<th width="152" scope="col" class="text-visit"><? print $row['lastrec']; ?></th>
      					<th width="68" scope="col">Ηλικία</th>
      					<th width="46" scope="col" class="text-visit"><? print $row['age']; ?></th>
    				</tr>
  				</tbody>
			</table>


			<table width="1000" border="1">
  				<tbody>
    				<tr>
      					<th width="68" scope="col">Πόλη κατοικίας</th>
      					<th width="87" scope="col" class="text-visit"><? print $row['town']; ?></th>
      					<th width="37" scope="col">Δνση</th>
      					<th width="165" scope="col" class="text-visit"><? print $row['address']; ?></th>
      					<th width="72" scope="col">Τηλέφωνο</th>
      					<th width="104" scope="col" class="text-visit"><? print $row['til']; ?></th>
      					<th width="58" scope="col">Κινητό</th>
      					<th width="98" scope="col" class="text-visit"><? print $row['mobile']; ?></th>
      					<th width="40" scope="col">Εmail</th>
      					<th width="98" scope="col" class="text-visit"><? print $row['mail']; ?></th>
    				</tr>
  				</tbody>
			</table>


			<hr class="text-visit">


	<!-- Post all changes that you did, in sav-chan.php -->
	<form action="sav-chan.php" method="post">
			<input type="hidden" name="amka"  value="<? print $row['amka']; ?>" />
			<table width="1000" border="1">
  				<tbody>
    				<tr>
      					<th width="134" rowspan="2" scope="col">Χρόνια Νοσήματα</th>
       					<th colspan="4" scope="col">Διαβήτης</th>
      					<th width="155" rowspan="2" scope="col">Δυσλιπιδαιμία</th>
      				<? 
      			       if  ($row['d3'] == '1') { $a = "checked" ;} 
      			    ?>
      					<th width="40" rowspan="2" scope="col" class="text-visit"><input type="checkbox"  name="chol"   <?  print $a; ?>  class="text-visit"/></th>
      					<th width="80" rowspan="2" scope="col">Υπέρταση</th>
       				<? 
       				   if  ($row['d4'] == '1') { $b = "checked" ;} 
       				?>
      					<th width="39" rowspan="2" scope="col" class="text-visit"><input type="checkbox"  name="hyper" <? print $b; ?> class="text-visit"/></th>
      					<th width="57" rowspan="2" scope="col">Άλλο νόσημα</th>
      					<th width="166" rowspan="2" scope="col" class="text-visit"><input type="text" name="nosima" value="<? print $row['d5']; ?>" class="text-visit" width="100"></input></th>
    				</tr>
    				<tr>
      					<th width="60" height="24" scope="col">Τύπου Ι</th>
      				<? 
      				  if  ($row['d1'] == '1') { $c= "checked" ;} 
      				?>
      					<th width="17" scope="col" valign="middle" class="text-visit"><input  id="diab-1" name="diab-1" type="checkbox"  <?  print $c; ?> /></th>
      					<th width="63" scope="col">Τύπου ΙΙ</th>
      				<? 
      				  if  ($row['d2'] == '1') { $d= "checked" ;} 
      				?>
      					<th width="11" scope="col" class="text-visit"><input type="checkbox"  id="diab-2" name="diab-2" <? print $d; } ?> /></th>
    				</tr>
  			   </tbody>
		    </table>
			<table width="1000" border="1">
  				<tbody>
    				<tr>
      					<th width="179" scope="col">Ιστορικό</th>
	        			<th width="696" scope="col" class="text-visit" align="left">
        					<textarea name="istoriko" cols="100" id="istoriko"   class=" p" >
        				<? 
        				    $SQL = "SELECT * FROM older WHERE  amka = '$amka' AND user = '$userD'"; 																																								
                            $result = mysqli_query($conn, $SQL);	
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                                print $row['comments'];
                            } 
                        ?>
        					</textarea>
            			</th>
    				</tr>
    			</tbody>
			</table>


			<hr class="text-visit">

			<table width="1000" border="1">
  				<tbody>
    				<tr>
      					<th width="203" scope="col">Εργαστηριακές  Εξέτασεις</th>
      					<th width="781" scope="col">
      						<table width="717">
      					<? 
      					     $SQL = "SELECT * FROM exam WHERE amka = '$amka' AND user = '$userD' ORDER by date ASC"; 
                             $result = mysqli_query($conn, $SQL);	
                             while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
								<tr>
									<td align="left" class="text-visit"  style="font-size:10px">
										<table>
											<tr>
												<td align="left">
     												<? 
     												   print $row['date']; 
     												?> 
     											</td>
     											<td align="left">
     												<? 
     												   print  $row['exam']; 
     												?>
     											</td>
     										</tr>
     									</table>
     								</td>
     							</tr>
     					<? 
                             } 
                        ?>
        						<tr>
        							<td>
        								<input name="exam" type="text" class="text-visit"  size="90"></input>
        							</td>
        						</tr>
      				 		</table>
      					</th>
    				</tr>
    			</tbody>
			</table>
	
			<table width="1000" border="1">
  				<tbody>
    				<tr>
      					<th width="175" scope="col">Κλινική Εξέταση</th>
      					<th width="696" scope="col">
      				
      						<table width="717" align="center">
      				<? 
      				      $SQL = "SELECT * FROM visit WHERE amka = '$amka' AND user = '$userD' ORDER by date ";
                          $result = mysqli_query($conn, $SQL);	
                          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
								<tr>
									<td align="left" class="text-visit" style="font-size:10px" >
								
										<table align="left">
											<tr>
												<td align="left">
										<?  
										   print $row['date']; 
										?> 
												</td>
												<td align="left">
										<? 
										   print  $row['comment']; 
										?>
												</td>
											</tr>
										</table>
								
									</td>
								</tr>
						<? 
                        	 } 
                        ?>
        						<tr align="center">
        							<td class="text-visit" align="center">
        								<textarea  name="kliniki" cols="90"  class="p"></textarea>
        							</td>
        						</tr>
        					</table>
        			
      		   			 </th>
       				</tr>
    			</tbody>
			</table>

			<table width="1000" border="1" align="center">
  				<tbody>
    				<tr align="center">
      					<th width="172" scope="col">Παρατηρήσεις</th>
      					<th width="699" scope="col" valign="top" >
                        		
	   								<textarea name="parat" cols="90"   class="p" >
	   								<? // printing comments
	   				    			$SQL = "SELECT * FROM comment WHERE  amka = '$amka' AND user = '$userD'"; 												
									$result = mysqli_query($conn, $SQL);	
                        			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                           					print $row['com'];
                        			} 
                    				?>
        							</textarea>
                            
        				</th>
    				</tr>
      			</tbody>
			</table>

			<table align=" center" width="1000">
				<tr>
					<td align="center">
						<input type="hidden" name="user" value="<? print $user ; ?>" >
						<input type="submit" id="submit" value="Καταχώρηση αλλαγών" class="buton" style="color:#063" />
					</td>
				</tr>
			</table>
	
	</form>

			<table width="1000">
				<tr>
					<td align="center">
						<form action="main.php" method="post">
							<input type="hidden" name="user" value="<? print $user ; ?>" >
							<input type="submit" name="cancel" value="Ακύρωση αλλαγών" class="buton" align="middle"/>
						</form>
					</td>
				</tr>	
			</table>

<? 
    $SQL = "SELECT * FROM upload WHERE amka = '$amka' AND user = '$userD'"; 
?>																								

    		<table>
				<tr>				
   		<?
   		// Searching in dataBase and set visible (if exist), clickable shortcut images of uploaded exams
   		    $result = mysqli_query($conn, $SQL);	
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
					<td align="center" class="text-visit" style="font-size:10px">
						<a href="<? echo $row['f1'] ; ?>" width="100">
							<img src="<? print $row['f1']; ?>" name="upload"  width="60" height="40">
						</a>
						<br><? print $row['f1']; ?></br><? print $row['date']; 
			}?>
					</td>
	    		</tr>
     		</table>
 		</td>
  	</tr>
</table>


</body>
</html>