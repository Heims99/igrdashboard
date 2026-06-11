<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>States Monthly IGR</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
.
<table width="100%" border="0">
  <tr>
    <td><a href="upload_igr/import.php"><img src="images/NGF_logo.png" width="400" height="166" /></a></td>
    <td><table width="100%" border="0">
      <tr>
        <td align="right" valign="top" class="menu_link"><img src="images/worldbank_logo.png" width="210" height="80" /><img src="images/ukaid_logo.png" width="87" height="80" alt="UKAID" /></td>
      </tr>
      <tr>
        <td  valign="bottom" align="right" class="menu_link"><a href="index.php">Home</a>| <a href="#">About Us</a>| <a href="action_plan.php">States' Action Plan</a>| <a href="igr.php">States' IGR</a>| <a href="#">FAAC</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<form name="form1" method="post" action="igr.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1">
<tr>
<td colspan="2" class=""><strong>Select IGR Year to Display</strong></td>
</tr>
<tr>
<td align="right" width="30%">Select Year:</td>
<td><select name="igrYear" size="1"><?
		  include 'connection.php';
   $sql = "SELECT DISTINCT(igrYear) FROM igrMonthly ORDER BY igrYear";
   $result = mysql_query($sql);
     if(mysql_num_rows($result)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysql_fetch_row($result))
       {
          print("<option value=\"$row[0]\">$row[0]</option>");
       }
     } else {
       print("<option value=\"\">No year created yet</option>");
     }
?></select>
  <input name="Submit" type="submit" class="" value="Display" /></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
</td>
</form>
<?php
include 'connection.php';

if(isset($_POST['Submit']))
{ 
$igryear=$_POST['igrYear']; //echo $igryear;
$sq1 = "SELECT state, january, february, march, april, may, june, july, august, september, october, november, december, january + february + march + april + may + june + july + august + september + october + november + december AS totalSum FROM igrMonthly WHERE igrYear = '" . $igryear . "'";
//echo $sql;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result=mysql_query($sq1); //echo $result;
		
}
?>
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
            <td><?php include "chart_sample.html"; ?></td>
          </tr>
          <tr>
            <td><hr /></td>
          </tr>
          <tr>
            <td align="center" class="myfooter">&copy;2016 | IGR 2015 National Peer Learning Event  </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>