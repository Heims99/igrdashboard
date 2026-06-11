<?php
session_start();
include_once 'connection.php';

if(!isset($_SESSION['user']))
{
 header("Location: login_front.php");
}
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="NGF IGR Dashboard">
<meta name="keywords" content="IGR,NGF,Dashboard,Tax,Allocation,Revenue">
<meta name="author" content="Maduka S. Okafor">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<title>Federation Allocation - <?php echo $userRow['state']; ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.myimg {
	border: thin solid #5D3235;
}
.menu_nav {
	margin:22px 0 0 0;
	padding:0;
	width:1000px;
	float:right;
}
.menu_nav ul {
	list-style:none;
	margin:0;
	padding:0;
	float:right;
}
.menu_nav ul li {
	margin:0;
	padding:0;
	float:left;
}
.menu_nav ul li a {
	display: block;
	margin: 0;
	padding: 25px 15px;
	color: #461D1D;
	text-decoration: none;
	font-size: 13px;
	line-height: 16px;
}
.menu_nav ul li.active a, .menu_nav ul li a:hover {
	color:#7baf30;
	text-decoration:none;
}
</style>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td><a href="index.php"><img src="images/NGF_logo.png" width="353" height="129" /></a></td>
    <td><table width="100%" border="0">
      <tr>
        <td align="right" valign="top" class="mytopmenunew"><div id="content">
         Welcome, <?php echo $userRow['username']; ?> ::<a href="logout_front.php?logout">Sign Out</a>| <a href="home.php?logout">My Admin</a>| <a href="downloads.php">My Reports</a>
      </div></td>
      </tr>
      
      <tr>
        <td  valign="bottom">
<div class="menu_nav">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="group_explorer.php">Group Explorer</a></li>
<li><a href="state_explorer.php">State Explorer</a></li>
<li><a href="state_igr.php">States' IGR</a></li>
<li><a href="#">Federation Allocation</a></li>
<li><a href="trr.php">Total Recurrent Revenue</a></li>
<li><a href="trr_analysis.php">TRR Analytics</a></li>
<li><a href="http://www.nggovernorsforum.org/index.php/resources/category/21-igr-dashboard-resource-tools" target="new">Resources</a></li>
</ul>
</div></td>
      </tr>
    </table></td>
  </tr>
</table>
<hr width="100%" />

<table width="100%" border="0" class="outer_table">
  <tr>
    <td valign="top"><table width="100%" border="0">
      <tr>
        
        <td valign="top"><table width="100%" border="0">
          <tr>
            <td><table width="100%" border="0">
              <tr>
                <td><form name="form1" method="post" action="faac.php">
            <label>Select View<span></span></label>
              <select name="zone" size="1">
			  <?php
		  //include 'connection.php';
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   $sql = mysqli_query($con, "SELECT zoneId, zoneName FROM zone ORDER BY zoneName");
   $result = mysqli_query($sql);
     if(mysqli_num_rows($sql)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysqli_fetch_row($sql))
       {
          print("<option value=\"$row[0]\">$row[1]</option>");
       }
     } else {
       print("<option value=\"\">No Zone created yet</option>");
     }
?></select>        
                <label>Select Year<span></span></label>
                <select name="faacYear" size="1"><?php
		 // include 'connection.php';
		 $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   $sql = mysqli_query($con, "SELECT DISTINCT(faacYear) FROM faacMonthly ORDER BY faacYear");
   $result = mysqli_query($sql);
     if(mysqli_num_rows($sql)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysqli_fetch_row($sql))
       {
          print("<option value=\"$row[0]\">$row[0]</option>");
       }
     } else {
       print("<option value=\"\">No year created yet</option>");
     }
?></select>
  <input name="Submit" type="submit" class="" value="Display" />
                </form>
                <?php
//include 'connection.php';
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if(isset($_POST['Submit']))
{ 
$zone=$_POST['zone']; //echo $zone;
$faacyear=$_POST['faacYear']; //echo $igryear;
mysqli_query($con, "SET SQL_BIG_SELECTS=1");
$sq1 = "SELECT state, january, february, march, april, may, june, july, august, september, october, november, december, january + february + march + april + may + june + july + august + september + october + november + december AS totalSum, state.stateName, zone.zoneName FROM faacMonthly, state, zone WHERE faacYear = '" . $faacyear . "' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND state=state.stateName";
//echo $sql;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result=mysqli_query($con, $sq1); //echo $result;
		
}
?>
                </td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0">
              <tr>
                <td width=""><b><?php $query="SELECT zoneId, zoneName FROM zone WHERE zoneId = '" . $zone . "'";
				$result1=mysqli_query($con, $query); 
				while($row = mysqli_fetch_array($result1))
  {
      if ($row["zoneName"]=="National") {$row["zoneName"]="of the 36 States";}
      if ($row["zoneName"]=="North Central") {$row["zoneName"]="(North Central)";}
	  if ($row["zoneName"]=="North East") {$row["zoneName"]="(North East)";}
	  if ($row["zoneName"]=="North West") {$row["zoneName"]="(North West)";}
	  if ($row["zoneName"]=="South East") {$row["zoneName"]="(South East)";}
	  if ($row["zoneName"]=="South South") {$row["zoneName"]="(South South)";}
	  if ($row["zoneName"]=="South West") {$row["zoneName"]="(South West)";}
  
				echo '</b></td>';
               echo '<td><b>' . $faacyear . '  Federation Allocation ' . $row["zoneName"] . '</b></td><td></td><td></td>';
                 }
                 ?>
                <td align="right">&nbsp;</td>
                <td align="right"><button onclick="myFunction()">Print page</button>

<script>
function myFunction() {
    window.print();
}
</script></td>
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
			  while($rs=@mysqli_fetch_array($result,MYSQLI_NUM)){
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
                echo '<td align="right">' . number_format($january,2) . '</td>';
                echo '<td align="right">' . number_format($february,2) . '</td>';
                echo '<td align="right">' . number_format($march,2) . '</td>';
		echo '<td align="right">' . number_format($april,2) . '</td>';
		echo '<td align="right">' . number_format($may,2) . '</td>';
                echo '<td align="right">' . number_format($june,2) . '</td>';
                echo '<td align="right">' . number_format($july,2) . '</td>';
		echo '<td align="right">' . number_format($august,2) . '</td>';
		echo '<td align="right">' . number_format($september,2) . '</td>';
                echo '<td align="right">' . number_format($october,2) . '</td>';
                echo '<td align="right">' . number_format($november,2) . '</td>';
		echo '<td align="right">' . number_format($december,2) . '</td>';
		echo '<td align="right">' . number_format($total,2) . '</td>';
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
            <td><? 
			
			//include("connection.php");
			$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
			$zone=$_POST['zone'];
			$faacyear=$_POST['faacYear'];
			$sql="SELECT state, january + february + march + april + may + june + july + august + september + october + november + december AS totalSum, state.stateName, zone.zoneName FROM faacMonthly, state, zone WHERE faacYear = '" . $faacyear . "' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND state=state.stateName";
			$result = mysqli_query($con, $sql);
     if(mysqli_num_rows($result)) {
		 
		?>
		 <!-- new chart -->
     <script type="text/javascript">
     google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'State');
      data.addColumn('number', 'Federation Allocation');

      data.addRows([  
	  <?php 
		 
       while($row = mysqli_fetch_row($result))
       {
	   echo "['".$row[0]."', ".$row[1]."],";
  }
  $query="SELECT zoneId, zoneName FROM zone WHERE zoneId = '" . $zone . "'";
				$result1=mysqli_query($con, $query); 
				while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC))
  {
      //national view
	  if ($row["zoneName"]=="National") {$row["zoneName"]="of the 36 States";}
	  if ($row["zoneName"]=="North Central") {$row["zoneName"]="(North Central)";}
	  if ($row["zoneName"]=="North East") {$row["zoneName"]="(North East)";}
	  if ($row["zoneName"]=="North West") {$row["zoneName"]="(North West)";}
	  if ($row["zoneName"]=="South East") {$row["zoneName"]="(South East)";}
	  if ($row["zoneName"]=="South South") {$row["zoneName"]="(South South)";}
	  if ($row["zoneName"]=="South West") {$row["zoneName"]="(South West)";}

	?>
      ]);

      var options = {
        title: '<?php echo ''. $faacyear .' Federation Allocation '. $row["zoneName"] . ''; ?>',
		<?php } ?>
		legend: {position: 'none', textStyle: {color: '#000000', fontSize: 11}, maxLines: 3},
        hAxis: {
          title: 'State',
		  textStyle: { 
  fontSize: 11
   }, titleTextStyle: { 
  fontSize: 11, color: 'grey'
   }
        },
        vAxis: {
          title: 'Naira',
		  format: 'long',
		  textStyle: { 
  fontSize: 11
   }, titleTextStyle: { 
  fontSize: 11, color: 'grey'
   }
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
	</script>
    
    <?php
       }
?>
<div id="chart_div" style="width: 1400px; height: 500px;"></div></td>
          </tr>
          <tr>
            <td><hr /></td>
          </tr>
          <tr>
            <td align="center" class="mytopmenu"><a href="faq.php">FAQ</a>| <a href="help.php">Help</a>| <a href="IGR Dashboard How-to-Guide.pdf" target="new">User Guide</a>| <a href="contactform.php" target="new">Contact Us</a></td>
          </tr>
          <tr>
            <td align="center" class="myfooter">&copy;2016 - 2017 Nigeria Governors' Forum  </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>