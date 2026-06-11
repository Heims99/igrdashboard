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
<meta name="author" content="Maduka Okafor">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<title>Total Recurrent Revenue - <?php echo $userRow['state']; ?></title>
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
<li><a href="faac.php">Federation Allocation</a></li>
<li><a href="#">Total Recurrent Revenue</a></li>
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
    <td><table width="100%" border="0" class="inner_table">
      <tr>
        <td colspan="5"><table width="100%" border="0">
          <tr>
            <td colspan="2"><form id="form1" name="form1" method="post" action="#">
            <?php /*?><?php
			include 'connection.php';
   $sql = "SELECT DISTINCT(users.state), annex.mysession FROM annex, users WHERE users.username = annex.mysession ORDER BY users.state";
   $result = mysql_query($sql);
     if(mysql_num_rows($result)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysql_fetch_row($result))
       {
          $mystate=$row[0];
       }
     } else {
       print("<option value=\"\">No year created yet</option>");
     }
	 ?><?php */?>
              <?php /*?><label>State<span></span></label>
              <select name="state" size="1"><?php
		  include 'connection.php';
   $sql = "SELECT DISTINCT(users.state), annex.mysession FROM annex, users WHERE users.username = annex.mysession ORDER BY users.state";
   $result = mysql_query($sql);
     if(mysql_num_rows($result)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysql_fetch_row($result))
       {
          print("<option value=\"$row[1]\">$row[0]</option>");
       }
     } else {
       print("<option value=\"\">No year created yet</option>");
     }
?></select><?php */?>
              <label>Year<span></span></label>
              <select name="year" size="1"><?php
		 // include 'connection.php';
		 $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   $sql = mysqli_query($con, "SELECT DISTINCT(year) FROM annex ORDER BY year");
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
<label>Month<span></span></label>
              <select name="month" size="1"><?php
		  //include 'connection.php';
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   $sql = mysqli_query($con, "SELECT DISTINCT(month) FROM annex");
   $result = mysqli_query($sql);
     if(mysqli_num_rows($sql)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysqli_fetch_row($sql))
       {
          print("<option value=\"$row[0]\">$row[0]</option>");
       }
     } else {
       print("<option value=\"\">No month created yet</option>");
     }
?></select>

              <input name="Submit" type="submit" class="" value="Display" />
              <br />
            </form></td>
            </tr>
          <tr>
            <td><h3>Total Recurrent Revenue (TRR) </h3></td>
            <td align="right"><button onclick="myFunction()">Print or download page</button>

<script>
function myFunction() {
    window.print();
}
</script></td>
          </tr>
        </table></td>
      </tr>
      <tr>
      <?php
//include 'connection.php';
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//include chart library
include "libchart/libchart/classes/libchart.php";
$chart = new VerticalBarChart(1000, 250);
$dataSet = new XYDataSet();

if(isset($_POST['Submit']))
{ 
//$state=$_POST['state']; //echo $state;
//$month=$_POST['month']; //echo $month;
$year=$_POST['year']; //echo $year;
$month=$_POST['month']; //echo $month;
$sq1 = "SELECT state, year, SUM(paye) + SUM(tax_audit) + SUM(wht) + SUM(direct_assess) + SUM(direct_informal) + SUM(capital_gain) + SUM(levies) AS igr
FROM annex
WHERE year ='".$year."'
AND month ='".$month."'
GROUP BY state
ORDER BY state";
//echo $sq1;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result=mysqli_query($con, $sq1); //echo $result;
}


?>

        <td valign="top" width="20%"><table width="100%" border="0" class="status_table" cellpadding="4" cellspacing="0">
          <tr>
     
                <th>State</th>
                <th>Last Recorded IGR <?php echo '('.$month.', '.$year.', N)'; ?></th>
                
                
              </tr>
          <?php
			  while($rs=@mysqli_fetch_array($result,MYSQLI_NUM))
			  {
			
		
		$state=$rs[0]; //echo $janigr;
		//$month=$rs[1]; //echo $febigr;
		$year=$rs[1];
		$igr=$rs[2];
		
		//create dataset for chart
		$dataSet->addPoint(new Point($state,$igr));
		
		//link dataset to chart
		$chart->setDataSet($dataSet);
		
		//}  
		
		
		
  echo'     
              
              <tr>
                
                <td>' . $state . '</td>
				<td align="right">' . number_format($igr,2) . '</td>
				
				
              </tr>';
               
			 }
			  ?>
              
           
                         
        </table></td><td valign="top" width="20%">
        <table width="100%" border="0" class="status_table" cellpadding="4" cellspacing="0">
          
          <?php
 //include 'connection.php';
 $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
 //include chart library
include "libchart/libchart/classes/libchart.php";
$chart1 = new VerticalBarChart(1000, 250);
$dataSet1 = new XYDataSet();

if(isset($_POST['Submit']))
{ 
//$state=$_POST['state']; //echo $state;
//$month=$_POST['month']; //echo $month;
$year=$_POST['year']; //echo $year;
$month=$_POST['month']; //echo $month;
 $sq2 = "SELECT faacMonthly.state, faacMonthly.faacYear, faacMonthly.january, faacMonthly.february, faacMonthly.march, faacMonthly.april, faacMonthly.may, faacMonthly.june, faacMonthly.july, faacMonthly.august, faacMonthly.september, faacMonthly.october, faacMonthly.november, faacMonthly.december, annex.state, annex.year
FROM faacMonthly, annex
WHERE faacMonthly.faacYear = annex.year
AND faacYear ='".$year."'
AND annex.year ='".$year."'
AND annex.month ='".$month."'
AND faacMonthly.state = annex.state
GROUP BY annex.state
ORDER BY annex.state";
$result1=mysqli_query($con, $sq2);

}             
     ?>
     <tr>
     <th>State</th>
     <th>Last Recorded FA <?php echo '('.$month.', '.$year.', N)'; ?></th>
     </tr>
  <?php
  
  while($rs1=@mysqli_fetch_array($result1,MYSQLI_NUM)){  
  
 		$statefa=$rs1[0]; 
		$year=$rs1[1]; 
		$janfa=$rs1[2];
		$febfa=$rs1[3];
		$marfa=$rs1[4];
		$aprfa=$rs1[5];
		$mayfa=$rs1[6];
		$junfa=$rs1[7];
		$julfa=$rs1[8];
		$augfa=$rs1[9];
		$sepfa=$rs1[10];
		$octfa=$rs1[11];
		$novfa=$rs1[12];
		$decfa=$rs1[13];  
		
		if($month == "January"){
			$curfa=$rs1[2];
		}
		
		if($month == "February"){
			$curfa=$rs1[3];
		}
		
		if($month == "March"){
			$curfa=$rs1[4];
		}
		
		if($month == "April"){
			$curfa=$rs1[5];
		}
		
		if($month == "May"){
			$curfa=$rs1[6];
		}
		
		if($month == "June"){
			$curfa=$rs1[7];
		}
		
		if($month == "July"){
			$curfa=$rs1[8];
		}
		
		if($month == "August"){
			$curfa=$rs1[9];
		}
		
		if($month == "September"){
			$curfa=$rs1[10];
		}
		
		if($month == "October"){
			$curfa=$rs1[11];
		}
		
		if($month == "November"){
			$curfa=$rs1[12];
		}
		
		if($month == "December"){
			$curfa=$rs1[13];
		}
		
		//create dataset for chart
		$dataSet1->addPoint(new Point($statefa,$curfa));
		
		//link dataset to chart
		$chart1->setDataSet($dataSet1);
	
	echo'     
              
              <tr>
                
				<td>' . $statefa . '</td>
				<td align="right">' . number_format($curfa,2) . '</td>
				
              </tr>';
               
			 }
			  ?>
              </table>
        </td><td valign="top" width="20%"><table width="100%" border="0" class="status_table" cellpadding="4" cellspacing="0">
          <?php
 //include 'connection.php';
 $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
 //include chart library
include "libchart/libchart/classes/libchart.php";
$chart2 = new VerticalBarChart(1000, 250);
$dataSet2 = new XYDataSet();

if(isset($_POST['Submit']))
{ 
//$state=$_POST['state']; //echo $state;
//$month=$_POST['month']; //echo $month;
$year=$_POST['year']; //echo $year;
$month=$_POST['month']; //echo $month;
 $sq3 = "SELECT faacMonthly.state, annex.state, faacMonthly.faacYear, annex.year, faacMonthly.january, faacMonthly.february, faacMonthly.march, faacMonthly.april, faacMonthly.may, faacMonthly.june, faacMonthly.july, faacMonthly.august, faacMonthly.september, faacMonthly.october, faacMonthly.november, faacMonthly.december, SUM(paye) + SUM(tax_audit) + SUM(wht) + SUM(direct_assess) + SUM(direct_informal) + SUM(capital_gain) + SUM(levies) AS totaligr
FROM faacMonthly, annex
WHERE faacMonthly.faacYear = annex.year
AND faacMonthly.faacYear ='" . $year . "'
AND annex.year ='" . $year . "'
AND annex.month ='" . $month . "'
AND faacMonthly.state = annex.state
GROUP BY annex.state
ORDER BY annex.state";
$result2=mysqli_query($con, $sq3);

}             
     ?>
          <tr>
            <th>State</th>
            <th>Last Recorded TRR <?php echo '('.$month.', '.$year.', N)'; ?></th>
          </tr>
          <?php
  
  while($rs2=@mysqli_fetch_array($result2,MYSQLI_NUM)){  
  
 	$state=$rs2[1];
	$janfa=$rs2[4];
	$febfa=$rs2[5];
	$marfa=$rs2[6];
	$aprfa=$rs2[7];
	$mayfa=$rs2[8];
	$junfa=$rs2[9];
	$julfa=$rs2[10];
	$augfa=$rs2[11];
	$sepfa=$rs2[12];
	$octfa=$rs2[13];
	$novfa=$rs2[14];
	$decfa=$rs2[15];
	$totaligr=$rs2[16]; 
	
	if($month == "January"){
			$totaltrr=$janfa + $totaligr;
	}
	
	if($month == "February"){
			$totaltrr=$febfa + $totaligr;
	}
	
	if($month == "March"){
			$totaltrr=$marfa + $totaligr;
	}
	
	if($month == "April"){
			$totaltrr=$aprfa + $totaligr;
	}
	
	if($month == "May"){
			$totaltrr=$mayfa + $totaligr;
	}
	
	if($month == "June"){
			$totaltrr=$junfa + $totaligr;
	}
	
	if($month == "July"){
			$totaltrr=$julfa + $totaligr;
	}
	
	if($month == "August"){
			$totaltrr=$augfa + $totaligr;
	}
	
	if($month == "September"){
			$totaltrr=$sepfa + $totaligr;
	}
	
	if($month == "October"){
			$totaltrr=$octfa + $totaligr;
	}
	
	if($month == "November"){
			$totaltrr=$novfa + $totaligr;
	}
	
	if($month == "December"){
			$totaltrr=$decfa + $totaligr;
	}
	
	//create dataset for chart
		$dataSet2->addPoint(new Point($state,$totaltrr));
		
		//link dataset to chart
		$chart2->setDataSet($dataSet2);
	
	echo'     
              
              <tr>
                
				<td>' . $state . '</td>
				<td align="right">' . number_format($totaltrr,2) . '</td>
				
              </tr>';
               
			 }
			  ?>
        </table></td><td>&nbsp;</td><td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="5" valign="top"><?php
		//render the chart here
       /* $chart->setTitle("Last Recorded IGR (".$month.", ".$year.", N)");
	$chart->render("libchart/demo/generated/demo7.png");*/ ?>
   <!-- <img alt="Vertical bars chart" src="libchart/demo/generated/demo7.png" style="border: 1px solid gray;"/>-->
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
$year=$_POST['year']; //echo $year;
$month=$_POST['month']; //echo $month;
 $sq3 = "SELECT faacMonthly.state, annex.state, faacMonthly.faacYear, annex.year, faacMonthly.january, faacMonthly.february, faacMonthly.march, faacMonthly.april, faacMonthly.may, faacMonthly.june, faacMonthly.july, faacMonthly.august, faacMonthly.september, faacMonthly.october, faacMonthly.november, faacMonthly.december, SUM(paye) + SUM(tax_audit) + SUM(wht) + SUM(direct_assess) + SUM(direct_informal) + SUM(capital_gain) + SUM(levies) AS totaligr
FROM faacMonthly, annex
WHERE faacMonthly.faacYear = annex.year
AND faacMonthly.faacYear ='" . $year . "'
AND annex.year ='" . $year . "'
AND annex.month ='" . $month . "'
AND faacMonthly.state = annex.state
GROUP BY annex.state
ORDER BY annex.state";
$result2=mysqli_query($con, $sq3);

}             
     ?>
          
    <!-- new chart -->
     <script type="text/javascript">
     google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawStacked);

function drawStacked() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'State');
      data.addColumn('number', 'IGR');
      data.addColumn({type:'string', role:'style'});
      data.addColumn('number', 'Federation Allocation');
	  data.addColumn({type:'string', role:'style'});

      data.addRows([      
          
          <?php
  
  while($rs2=mysqli_fetch_array($result2,MYSQLI_NUM)){  
  
 	$state=$rs2[1];
	$janfa=$rs2[4];
	$febfa=$rs2[5];
	$marfa=$rs2[6];
	$aprfa=$rs2[7];
	$mayfa=$rs2[8];
	$junfa=$rs2[9];
	$julfa=$rs2[10];
	$augfa=$rs2[11];
	$sepfa=$rs2[12];
	$octfa=$rs2[13];
	$novfa=$rs2[14];
	$decfa=$rs2[15];
	$totaligr=$rs2[16]; 
	
	if($month == "January"){
			$faac=$janfa;
	}
	
	if($month == "February"){
			$faac=$febfa;
	}
	
	if($month == "March"){
			$faac=$marfa;
	}
	
	if($month == "April"){
			$faac=$aprfa;
	}
	
	if($month == "May"){
			$faac=$mayfa;
	}
	
	if($month == "June"){
			$faac=$junfa;
	}
	
	if($month == "July"){
			$faac=$julfa;
	}
	
	if($month == "August"){
			$faac=$augfa;
	}
	
	if($month == "September"){
			$faac=$sepfa;
	}
	
	if($month == "October"){
			$faac=$octfa;
	}
	
	if($month == "November"){
			$faac=$novfa;
	}
	
	if($month == "December"){
			$faac=$decfa;
	}

echo "['".$state."', ".$totaligr.", '#4D89F9' , ".$faac.", '#C6D9FD'],";
  }
	?>
      ]);

      var options = {
        title: 'Recurrent Revenue Trend For <?php echo '' . $month . ', ' . $year; ?>',
        colors: ['#4D89F9', '#C6D9FD'],
        isStacked: true,
		legend: {position: 'bottom', textStyle: {color: '#000000', fontSize: 11}, maxLines: 3},
        hAxis: {
          title: 'State',
		  textStyle: { 
  fontSize: 11
   }, titleTextStyle: { 
  fontSize: 11, color: 'grey'
   }
          <?php /*?>format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }<?php */?>
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
    
   <div id="chart_div" style="width: 1200px; height: 500px;"></div></td>
      </tr>
      <tr>
        <td colspan="5" valign="top"><?php
		//render the chart here
        /*$chart1->setTitle("Last Recorded FA (".$month.", ".$year.", N)");
	$chart1->render("libchart/demo/generated/demo8.png");*/ ?>
   <!-- <img alt="Vertical bars chart" src="libchart/demo/generated/demo8.png" style="border: 1px solid gray;"/>--></td>
      </tr>
      <tr>
        <td colspan="5" valign="top"><?php
		//render the chart here
        /*$chart2->setTitle("Last Recorded TRR (".$month.", ".$year.", N)");
	$chart2->render("libchart/demo/generated/demo9.png");*/ ?>
   <!-- <img alt="Vertical bars chart" src="libchart/demo/generated/demo9.png" style="border: 1px solid gray;"/>--></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<hr width="100%" />
<table width="100%"><tr><td><table width="100%" border="0">
<tr>
    <td align="center" class="mytopmenu"><a href="faq.php">FAQ</a>| <a href="help.php">Help</a>| <a href="IGR Dashboard How-to-Guide.pdf" target="new">User Guide</a>| <a href="contactform.php" target="new">Contact Us</a></td>
  </tr>
  <tr>
    <td align="center" class="myfooter">&copy;2016 - 2017 Nigeria Governors' Forum </td>
  </tr>
</table></td></tr></table>
</body>
</html>