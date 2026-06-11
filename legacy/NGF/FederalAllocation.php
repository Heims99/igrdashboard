<?php
session_start();
include_once '../connection.php';

if(!isset($_SESSION['user']))
{
 header("Location: Login.php");
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php include('_header.php') ?>
<div class="container shadow_bg">
    <h4>Federation Allocation of States</h4>
    <form class="form-inline mt-5 d-flex justify-content-between" name="form1" method="post" action="#">
        <div class="d-flex">
            <div class="form-group mx-sm-3 mb-2">
                <label for="zone" class="sr-only">Select View</label>
                <select id="zone" name="zone" class="form-control">
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
?>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="year" class="sr-only">Select Year</label>
                <select id="faacYear" name="faacYear" class="form-control">
                    <?php
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
?>
                </select>
            </div>
        </div>
        <div class="d-flex">
            <button type="submit" name="Submit" class="btn btn-success mb-2">Display</button>
            <button onclick="window.print()" type="button" class="btn btn-outline-primary mb-2 border-dark text-dark">Print Page</button>
        </div>
    </form>
</div>
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
$result=mysqli_query($con, $sq1); //echo $result;
		
}
?>
<div class="container shadow_bg mt-5">
    <div class="table-wrapper">
        <div class="header-info justify-content-center">
            <?php $query="SELECT zoneId, zoneName FROM zone WHERE zoneId = '" . $zone . "'";
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
  
				//echo '<div class="state-name">ADAMAWA |&nbsp;</div>';
               echo '<div class="year">' . $faacyear . '  Federation Allocation ' . $row["zoneName"] . '</div>';
                 }
                 ?>
            <!--<div class="state-name">ADAMAWA |&nbsp;</div>
            <div class="year">Year: 2016</div>-->
        </div>
        <div class="overflow-x">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">States</th>
                        <th scope="col">Jan</th>
                        <th scope="col">Feb</th>
                        <th scope="col">Mar</th>
                        <th scope="col">Apr</th>
                        <th scope="col">May</th>
                        <th scope="col">Jun</th>
                        <th scope="col">Jul</th>
                        <th scope="col">Aug</th>
                        <th scope="col">Sep</th>
                        <th scope="col">Oct</th>
                        <th scope="col">Nov</th>
                        <th scope="col">Dec</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    
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
                echo '<td class="task-name">' . $state . '</td>';
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
		        echo '<td class="task-name">' . number_format($total,2) . '</td>';
                echo '</tr>';
			 }
			  ?>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<? 
			
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
<div id="chart_div" style="width: 1400px; height: 500px;"></div>
<?php include('_footer.php') ?>

<script>
    $('a[href="FederalAllocation"]').addClass('active')
</script>
<p>&nbsp;</p>
<hr width="100%" />
<table width="100%"><tr><td><table width="100%" border="0">
<tr>
    <td align="center" style="font-family: Tahoma, Geneva, sans-serif; font-size: 11px; text-decoration: none; margin: 1px; padding: 12px;"><a href="faq.php">FAQ</a> | <a href="help.php">Help</a> | <a href="IGR Dashboard How-to-Guide.pdf" target="new">User Guide</a> | <a href="contactform.php" target="new">Contact Us</a></td>
  </tr>
  <tr>
    <td align="center" style="font-size: 11px; color: #093; text-align: center;">&copy;2016 - 2017 Nigeria Governors' Forum </td>
  </tr>
</table></td></tr></table>
<p>&nbsp;</p>