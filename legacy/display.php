<?php
include 'connection.php';

if(isset($_POST['Submit']))
{ 
$igryear=$_POST['igrYear']; //echo $igryear;
$sq1 = "SELECT state, january, february, march, april, may, june, july, august, september, october, november, december FROM igrMonthly WHERE igrYear = '" . $igryear . "'";
//echo $sql;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result=mysql_query($sq1); //echo $result;
		
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>States Monthly IGR</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" onload="MM_preloadImages('images/home_down.png','images/maps_down.png')">
<table width="100%" border="0">
  <tr>
    <td><img src="images/NGF_logo.png" width="353" height="129" /></td>
    <td valign="bottom" align="right" class="menu_link"><a href="index.php">Home</a>| <a href="#">About Us</a>| <a href="action_plan.php">States' Action Plan</a>| <a href="igr.php">States' IGR</a>| <a href="#">FAAC</a></td>
  </tr>
</table>
<table width="100%" border="0" class="outer_table">
  <tr>
    <td valign="top"><table width="100%" border="0">
      <tr>
        
        <td valign="top"><table width="100%" border="0">
          <tr>
            <td><table width="100%" border="0">
              <tr>
                <td>&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0">
              <tr>
                <td width=""><b><? $query="SELECT DISTINCT igrYear FROM igrMonthly where igrYear = '" . $igryear . "'";
				$result1=mysql_query($query); 
				while($row = mysql_fetch_array($result1))
  {
  echo $row['igrYear'];
 
				echo '</b></td>';
               echo '<td><b>IGR Year: ' . $row['igrYear']. '</b></td><td></td><td></td>';
                 }
                 ?>
                <td align="right">&nbsp;</td>
                <td width="10%">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><hr /></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" class="status_table">
              <tr>
                <th>State</th>
                <th>January</th>
                <th>February</th>
                <th>March</th>
                <th>April</th>
                <th>May</th>
                <th>June</th>
                <th>July</th>
                <th>August</th>
                <th>September</th>
                <th>October</th>
                <th>November</th>
                <th>December</th>
                <th>Total</th>
              </tr>
			  
              <?php
			  while($rs=mysql_fetch_array($result,MYSQL_NUM)){
			$state=$rs[0]; 
		$january=$rs[1];
		$february=$rs[2];
		$march=$rs[3];
		$april=$rs[4];
		$may=$rs[5];
		$june=$rs[6];
		$july=$rs[7];
		$august=$rs[8];
		$september=$rs[9];
		$october=$rs[10];
		$november=$rs[11];
		$december=$rs[12];
		$total=$rs[13];
		//}  
                echo '<tr>';
                echo '<td>' . $state . '</td>';
                echo '<td>' . number_format($january,2) . '</td>';
                echo '<td>' . number_format($february,2) . '</td>';
                echo '<td>' . number_format($march,2) . '</td>';
				echo '<td>' . number_format($april,2) . '</td>';
				echo '<td>' . number_format($may,2) . '</td>';
                echo '<td>' . number_format($june,2) . '</td>';
                echo '<td>' . number_format($july,2) . '</td>';
				echo '<td>' . number_format($august,2) . '</td>';
				echo '<td>' . number_format($september,2) . '</td>';
                echo '<td>' . number_format($october,2) . '</td>';
                echo '<td>' . number_format($november,2) . '</td>';
				echo '<td>' . number_format($december,2) . '</td>';
				echo '<td>' . number_format($total,2) . '</td>';
              echo '</tr>';
			 }
			  ?>
              
 
	         
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><hr /></td>
          </tr>
          <tr>
            <td align="center">&copy;2016 </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
