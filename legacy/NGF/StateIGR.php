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
    <h4>States' Internally Generated Revenue</h4>
    <form class="form-inline mt-5 d-flex justify-content-between" id="form1" name="form1" method="post" action="#">
        <?php
			//include 'connection.php';
			$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   $sql = mysqli_query($con, "SELECT DISTINCT(users.state), annex.mysession FROM annex, users WHERE users.username = annex.mysession ORDER BY users.state");
   $result = @mysqli_query($sql);
     if(mysqli_num_rows($sql)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysqli_fetch_row($sql))
       {
          $mystate=$row[0];
       }
     } else {
       print("<option value=\"\">No year created yet</option>");
     }
	 ?>
        <div class="d-flex">
            <div class="form-group mx-sm-3 mb-2">
                <label for="state" class="sr-only">State</label>
                <select id="state" name="state" size="1" class="form-control">
                    <?php
		  //include 'connection.php';
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   $sql = mysqli_query($con, "SELECT DISTINCT(users.state), annex.mysession FROM annex, users WHERE users.username = annex.mysession ORDER BY users.state");
   $result = mysqli_query($sql);
     if(mysqli_num_rows($sql)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysqli_fetch_row($sql))
       {
          print("<option value=\"$row[1]\">$row[0]</option>");
       }
     } else {
       print("<option value=\"\">No year created yet</option>");
     }
?></select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="year" class="sr-only">Year</label>
                <select id="year" name="year" size="1" class="form-control">
                    <?php
		  //include 'connection.php';
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   $sql = mysqli_query($con, "SELECT DISTINCT(year) FROM ngfYear ORDER BY year");
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
            </div>
        </div>
        <div class="d-flex">
            <input name="Submit" type="submit" value="Display" class="btn btn-success mb-2" />
            <!--<button type="submit" class="btn btn-success mb-2">Display</button>-->
            <button onclick="window.print()" type="button" class="btn btn-outline-primary mb-2 border-dark text-dark">Print Page</button>
        </div>
    </form>
</div>
<div class="container shadow_bg mt-5">
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
    //define chart to plot
include "../libchart/libchart/classes/libchart.php";
	$chart = new LineChart(1300, 300);
$state=$_POST['state']; //echo $state;
//$month=$_POST['month']; //echo $month;
$year=$_POST['year']; //echo $year;
$sq1 = "SELECT annexid, mysession, state, month, year, paye, tax_audit, wht, direct_assess, direct_informal, capital_gain, levies, taxpayer_reg, monthly_tin, num_levies, num_education, num_appeal, num_cases, num_hinwi, num_license, mda_revenue
FROM annex 
WHERE month = 'January'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'January'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq1;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result=mysqli_query($con, $sq1); //echo $result;

$sq2 = "SELECT annexid, mysession, state, month, year, paye AS pfeb, tax_audit AS tafeb, wht AS whtfeb, direct_assess AS dafeb, direct_informal AS difeb, capital_gain AS cgfeb,  levies AS lfeb, taxpayer_reg AS trfeb, monthly_tin AS mtfeb, num_levies AS nlfeb, num_education AS nefeb, num_appeal AS nafeb, num_cases AS ncfeb, num_hinwi AS nhfeb, num_license AS nlefeb, mda_revenue AS mrfeb
FROM annex 
WHERE month = 'February'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'February'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq2;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result1=mysqli_query($con, $sq2); //echo $result;

$sq3 = "SELECT annexid, mysession, state, month, year, paye AS pmar, tax_audit AS tamar, wht AS whtmar, direct_assess AS damar, direct_informal AS dimar, capital_gain AS cgmar,  levies AS lmar, taxpayer_reg AS trmar, monthly_tin AS mtmar, num_levies AS nlmar, num_education AS nemar, num_appeal AS namar, num_cases AS ncmar, num_hinwi AS nhmar, num_license AS nlemar, mda_revenue AS mrmar
FROM annex 
WHERE month = 'March'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'March'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq3;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result2=mysqli_query($con, $sq3); //echo $result;

$sq4 = "SELECT annexid, mysession, state, month, year, paye AS papr, tax_audit AS taapr, wht AS whtapr, direct_assess AS daapr, direct_informal AS diapr, capital_gain AS cgapr,  levies AS lapr, taxpayer_reg AS trapr, monthly_tin AS mtapr, num_levies AS nlapr, num_education AS neapr, num_appeal AS naapr, num_cases AS ncapr, num_hinwi AS nhapr, num_license AS nleapr, mda_revenue AS mrapr
FROM annex 
WHERE month = 'April'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'April'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq4;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result3=mysqli_query($con, $sq4); //echo $result;

$sq5 = "SELECT annexid, mysession, state, month, year, paye AS pmay, tax_audit AS tamay, wht AS whtmay, direct_assess AS damay, direct_informal AS dimay, capital_gain AS cgmay,  levies AS lmay, taxpayer_reg AS trmay, monthly_tin AS mtmay, num_levies AS nlmay, num_education AS nemay, num_appeal AS namay, num_cases AS ncmay, num_hinwi AS nhmay, num_license AS nlemay, mda_revenue AS mrmay
FROM annex 
WHERE month = 'May'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'May'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq5;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result4=mysqli_query($con, $sq5); //echo $result;

$sq6 = "SELECT annexid, mysession, state, month, year, paye AS pjun, tax_audit AS tajun, wht AS whtjun, direct_assess AS dajun, direct_informal AS dijun, capital_gain AS cgjun,  levies AS ljun, taxpayer_reg AS trjun, monthly_tin AS mtjun, num_levies AS nljun, num_education AS nejun, num_appeal AS najun, num_cases AS ncjun, num_hinwi AS nhjun, num_license AS nlejun, mda_revenue AS mrjun
FROM annex 
WHERE month = 'June'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'June'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq6;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result5=mysqli_query($con, $sq6); //echo $result;

$sq7 = "SELECT annexid, mysession, state, month, year, paye AS pjul, tax_audit AS tajul, wht AS whtjul, direct_assess AS dajul, direct_informal AS dijul, capital_gain AS cgjul,  levies AS ljul, taxpayer_reg AS trjul, monthly_tin AS mtjul, num_levies AS nljul, num_education AS nejul, num_appeal AS najul, num_cases AS ncjul, num_hinwi AS nhjul, num_license AS nlejul, mda_revenue AS mrjul
FROM annex 
WHERE month = 'July'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'July'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq7;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result6=mysqli_query($con, $sq7); //echo $result;

$sq8 = "SELECT annexid, mysession, state, month, year, paye AS paug, tax_audit AS taaug, wht AS whtaug, direct_assess AS daaug, direct_informal AS diaug, capital_gain AS cgaug,  levies AS laug, taxpayer_reg AS traug, monthly_tin AS mtaug, num_levies AS nlaug, num_education AS neaug, num_appeal AS naaug, num_cases AS ncaug, num_hinwi AS nhaug, num_license AS nleaug, mda_revenue AS mraug
FROM annex 
WHERE month = 'August'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'August'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq8;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result7=mysqli_query($con, $sq8); //echo $result;

$sq9 = "SELECT annexid, mysession, state, month, year, paye AS psep, tax_audit AS tasep, wht AS whtsep, direct_assess AS dasep, direct_informal AS disep, capital_gain AS cgsep,  levies AS lsep, taxpayer_reg AS trsep, monthly_tin AS mtsep, num_levies AS nlsep, num_education AS nesep, num_appeal AS nasep, num_cases AS ncsep, num_hinwi AS nhsep, num_license AS nlesep, mda_revenue AS mrsep 
FROM annex 
WHERE month = 'September'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'September'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq9;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result8=mysqli_query($con, $sq9); //echo $result;

$sq10 = "SELECT annexid, mysession, state, month, year, paye AS poct, tax_audit AS taoct, wht AS whtoct, direct_assess AS daoct, direct_informal AS dioct, capital_gain AS cgoct,  levies AS loct, taxpayer_reg AS troct, monthly_tin AS mtoct, num_levies AS nloct, num_education AS neoct, num_appeal AS naoct, num_cases AS ncoct, num_hinwi AS nhoct, num_license AS nleoct, mda_revenue AS mroct 
FROM annex 
WHERE month = 'October'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'October'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq10;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result9=mysqli_query($con, $sq10); //echo $result;

$sq11 = "SELECT annexid, mysession, state, month, year, paye AS pnov, tax_audit AS tanov, wht AS whtnov, direct_assess AS danov, direct_informal AS dinov, capital_gain AS cgnov,  levies AS lnov, taxpayer_reg AS trnov, monthly_tin AS mtnov, num_levies AS nlnov, num_education AS nenov, num_appeal AS nanov, num_cases AS ncnov, num_hinwi AS nhnov, num_license AS nlenov, mda_revenue AS mrnov
FROM annex 
WHERE month = 'November'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'November'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq11;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result10=mysqli_query($con, $sq11); //echo $result;

$sq12 = "SELECT annexid, mysession, state, month, year, paye AS pdec, tax_audit AS tadec, wht AS whtdec, direct_assess AS dadec, direct_informal AS didec, capital_gain AS cgdec,  levies AS ldec, taxpayer_reg AS trdec, monthly_tin AS mtdec, num_levies AS nldec, num_education AS nedec, num_appeal AS nadec, num_cases AS ncdec, num_hinwi AS nhdec, num_license AS nledec, mda_revenue AS mrdec 
FROM annex 
WHERE month = 'December'
AND year = '" . $year . "'
AND mysession = '" . $state . "'

UNION ALL

SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
FROM (SELECT 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20) T1
WHERE NOT EXISTS
(
    SELECT *
    FROM annex
    WHERE month = 'December'
AND year = '" . $year . "'
AND mysession = '" . $state . "')";
//echo $sq12;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result11=mysqli_query($con, $sq12); //echo $result;
		
}

?>

    <div class="table-wrapper">
        <div class="header-info justify-content-center">
            <div class="state-name"><?php echo '<b>State Internally Generated Revenue: ' . $state . ' | ' . ' &nbsp;'; ?></div>
            <div class="year"><?php echo ' ' . ' Year: ' . $year; ?></div>
        </div>
        <div class="overflow-x">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">(<?php echo '' . 'YEAR: ' . $year; ?>)</th>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
			  while($rs=@mysqli_fetch_array($result,MYSQLI_NUM))
			  while($rs1=mysqli_fetch_array($result1,MYSQLI_NUM))
			  while($rs2=mysqli_fetch_array($result2,MYSQLI_NUM))
			  while($rs3=mysqli_fetch_array($result3,MYSQLI_NUM))
			  while($rs4=mysqli_fetch_array($result4,MYSQLI_NUM))
			  while($rs5=mysqli_fetch_array($result5,MYSQLI_NUM))
			  while($rs6=mysqli_fetch_array($result6,MYSQLI_NUM))
			  while($rs7=mysqli_fetch_array($result7,MYSQLI_NUM))
			  while($rs8=mysqli_fetch_array($result8,MYSQLI_NUM))
			  while($rs9=mysqli_fetch_array($result9,MYSQLI_NUM))
			  while($rs10=mysqli_fetch_array($result10,MYSQLI_NUM))
			  while($rs11=mysqli_fetch_array($result11,MYSQLI_NUM)){
			$annexid=$rs[0]; $annexid = $annexid ?: 'null';
		$mysession=$rs[1]; $mysession = $mysession ?: 'null';
		$state=$rs[2]; $state = $state ?: 'null';
		$month=$rs[3]; $month = $month ?: 'null';
		$year=$rs[4]; $year = $year ?: 'null';
		$paye=$rs[5]; if ($paye == 5) { $paye = 0;}
		$tax_audit=$rs[6]; if ($tax_audit == 6) { $tax_audit = 0;}
		$wht=$rs[7]; if ($wht == 7) { $wht = 0;}
		$direct_assess=$rs[8]; if ($direct_assess == 8) { $direct_assess = 0;}
		$direct_informal=$rs[9]; if ($direct_informal == 9) { $direct_informal = 0;}
		$capital_gain=$rs[10]; if ($capital_gain == 10) { $capital_gain = 0;}
		$levies=$rs[11]; if ($levies == 11) { $levies = 0;}
		$taxpayer_reg=$rs[12]; if ($taxpayer_reg == 12) { $taxpayer_reg = 0;}
		$monthly_tin=$rs[13]; if ($monthly_tin == 13) { $monthly_tin = 0;}
		$num_levies=$rs[14]; if ($num_levies == 14) { $num_levies = 0;}
		$num_education=$rs[15]; //if ($num_education == 15) { $num_education = 0;}
		$num_appeal=$rs[16]; if ($num_appeal == 16) { $num_appeal = 0;}
		$num_cases=$rs[17]; if ($num_cases == 17) { $num_cases = 0;}
		$num_hinwi=$rs[18]; if ($num_hinwi == 18) { $num_hinwi = 0;}
		$num_license=$rs[19]; if ($num_license == 19) { $num_license = 0;}
		$mda_revenue=$rs[20]; if ($mda_revenue == 20) { $mda_revenue = 0;}
		$total=$paye + $tax_audit + $wht + $direct_assess + $direct_informal + $capital_gain + $mda_revenue + $levies; 
		$pfeb=$rs1[5]; if ($pfeb == 5) { $pfeb = 0;}
		$tafeb=$rs1[6]; if ($tafeb == 6) { $tafeb = 0;}
		$whtfeb=$rs1[7]; if ($whtfeb == 7) { $whtfeb = 0;}
		$dafeb=$rs1[8]; if ($dafeb == 8) { $dafeb = 0;}
		$difeb=$rs1[9]; if ($difeb == 9) { $difeb = 0;}
		$cgfeb=$rs1[10]; if ($cgfeb == 10) { $cgfeb = 0;}
		$lfeb=$rs1[11]; if ($lfeb == 11) { $lfeb = 0;}
		$trfeb=$rs1[12]; if ($trfeb == 12) { $trfeb = 0;}
		$mtfeb=$rs1[13]; if ($mtfeb == 13) { $mtfeb = 0;}
		$nlfeb=$rs1[14]; if ($nlfeb == 14) { $nlfeb = 0;}
		$nefeb=$rs1[15]; if ($nefeb == 15) { $nefeb = 0;}
		$nafeb=$rs1[16]; if ($nafeb == 16) { $nafeb = 0;}
		$ncfeb=$rs1[17]; if ($ncfeb == 17) { $ncfeb = 0;}
		$nhfeb=$rs1[18]; if ($nhfeb == 18) { $nhfeb = 0;}
		$nlefeb=$rs1[19]; if ($nlefeb == 19) { $nlefeb = 0;}
		$mrfeb=$rs1[20]; if ($mrfeb == 20) { $mrfeb = 0;}
		$totalfeb=$pfeb + $tafeb + $whtfeb + $dafeb + $difeb + $cgfeb + $mrfeb + $lfeb;
		$pmar=$rs2[5]; if ($pmar == 5) { $pmar = 0;}
		$tamar=$rs2[6]; if ($tamar == 6) { $tamar = 0;}
		$whtmar=$rs2[7]; if ($whtmar == 7) { $whtmar = 0;}
		$damar=$rs2[8]; if ($damar == 8) { $damar = 0;}
		$dimar=$rs2[9]; if ($dimar == 9) { $dimar = 0;}
		$cgmar=$rs2[10]; if ($cgmar == 10) { $cgmar = 0;}
		$lmar=$rs2[11]; if ($lmar == 11) { $lmar = 0;}
		$trmar=$rs2[12]; if ($trmar == 12) { $trmar = 0;}
		$mtmar=$rs2[13]; if ($mtmar == 13) { $mtmar = 0;}
		$nlmar=$rs2[14]; if ($nlmar == 14) { $nlmar = 0;}
		$nemar=$rs2[15]; if ($nemar == 15) { $nemar = 0;}
		$namar=$rs2[16]; if ($namar == 16) { $namar = 0;}
		$ncmar=$rs2[17]; if ($ncmar == 17) { $ncmar = 0;}
		$nhmar=$rs2[18]; if ($nhmar == 18) { $nhmar = 0;}
		$nlemar=$rs2[19]; if ($nlemar == 19) { $nlemar = 0;}
		$mrmar=$rs2[20]; if ($mrmar == 20) { $mrmar = 0;}
		$totalmar=$pmar + $tamar + $whtmar + $damar + $dimar + $cgmar + $mrmar + $lmar;
		$papr=$rs3[5]; if ($papr == 5) { $papr = 0;}
		$taapr=$rs3[6]; if ($taapr == 6) { $taapr = 0;}
		$whtapr=$rs3[7]; if ($whtapr == 7) { $whtapr = 0;}
		$daapr=$rs3[8]; if ($daapr == 8) { $daapr = 0;}
		$diapr=$rs3[9]; if ($diapr == 9) { $diapr = 0;}
		$cgapr=$rs3[10]; if ($cgapr == 10) { $cgapr = 0;}
		$lapr=$rs3[11]; if ($lapr == 11) { $lapr = 0;}
		$trapr=$rs3[12]; if ($trapr == 12) { $trapr = 0;}
		$mtapr=$rs3[13]; if ($mtapr == 13) { $mtapr = 0;}
		$nlapr=$rs3[14]; if ($nlapr == 14) { $nlapr = 0;}
		$neapr=$rs3[15]; if ($neapr == 15) { $neapr = 0;}
		$naapr=$rs3[16]; if ($naapr == 16) { $naapr = 0;}
		$ncapr=$rs3[17]; if ($ncapr == 17) { $ncapr = 0;}
		$nhapr=$rs3[18]; if ($nhapr == 18) { $nhapr = 0;}
		$nleapr=$rs3[19]; if ($nleapr == 19) { $nleapr = 0;}
		$mrapr=$rs3[20]; if ($mrapr == 20) { $mrapr = 0;}
		$totalapr=$papr + $taapr + $whtapr + $daapr + $diapr + $cgapr + $mrapr + $lapr;
		$pmay=$rs4[5]; if ($pmay == 5) { $pmay = 0;}
		$tamay=$rs4[6]; if ($tamay == 6) { $tamay = 0;}
		$whtmay=$rs4[7]; if ($whtmay == 7) { $whtmay = 0;}
		$damay=$rs4[8]; if ($damay == 8) { $damay = 0;}
		$dimay=$rs4[9]; if ($dimay == 9) { $dimay = 0;}
		$cgmay=$rs4[10]; if ($cgmay == 10) { $cgmay = 0;}
		$lmay=$rs4[11]; if ($lmay == 11) { $lmay = 0;}
		$trmay=$rs4[12]; if ($trmay == 12) { $trmay = 0;}
		$mtmay=$rs4[13]; if ($mtmay == 13) { $mtmay = 0;}
		$nlmay=$rs4[14]; if ($nlmay == 14) { $nlmay = 0;}
		$nemay=$rs4[15]; if ($nemay == 15) { $nemay = 0;}
		$namay=$rs4[16]; if ($namay == 16) { $namay = 0;}
		$ncmay=$rs4[17]; if ($ncmay == 17) { $ncmay = 0;}
		$nhmay=$rs4[18]; if ($nhmay == 18) { $nhmay = 0;}
		$nlemay=$rs4[19]; if ($nlemay == 19) { $nlemay = 0;}
		$mrmay=$rs4[20]; if ($mrmay == 20) { $mrmay = 0;}
		$totalmay=$pmay + $tamay + $whtmay + $damay + $dimay + $cgmay + $mrmay + $lmay;
		$pjun=$rs5[5]; if ($pjun == 5) { $pjun = 0;}
		$tajun=$rs5[6]; if ($tajun == 6) { $tajun = 0;}
		$whtjun=$rs5[7]; if ($whtjun == 7) { $whtjun = 0;}
		$dajun=$rs5[8]; if ($dajun == 8) { $dajun = 0;}
		$dijun=$rs5[9]; if ($dijun == 9) { $dijun = 0;}
		$cgjun=$rs5[10]; if ($cgjun == 10) { $cgjun = 0;}
		$ljun=$rs5[11]; if ($ljun == 11) { $ljun = 0;}
		$trjun=$rs5[12]; if ($trjun == 12) { $trjun = 0;}
		$mtjun=$rs5[13]; if ($mtjun == 13) { $mtjun = 0;}
		$nljun=$rs5[14]; if ($nljun == 14) { $nljun = 0;}
		$nejun=$rs5[15]; if ($nejun == 15) { $nejun = 0;}
		$najun=$rs5[16]; if ($najun == 16) { $najun = 0;}
		$ncjun=$rs5[17]; if ($ncjun == 17) { $ncjun = 0;}
		$nhjun=$rs5[18]; if ($nhjun == 18) { $nhjun = 0;}
		$nlejun=$rs5[19]; if ($nlejun == 19) { $nlejun = 0;}
		$mrjun=$rs5[20]; if ($mrjun == 20) { $mrjun = 0;}
		$totaljun=$pjun + $tajun + $whtjun + $dajun + $dijun + $cgjun + $mrjun + $ljun;
		$pjul=$rs6[5]; if ($pjul == 5) { $pjul = 0;}
		$tajul=$rs6[6]; if ($tajul == 6) { $tajul = 0;}
		$whtjul=$rs6[7]; if ($whtjul == 7) { $whtjul = 0;}
		$dajul=$rs6[8]; if ($dajul == 8) { $dajul = 0;}
		$dijul=$rs6[9]; if ($dijul == 9) { $dijul = 0;}
		$cgjul=$rs6[10]; if ($cgjul == 10) { $cgjul = 0;}
		$ljul=$rs6[11]; if ($ljul == 11) { $ljul = 0;}
		$trjul=$rs6[12]; if ($trjul == 12) { $trjul = 0;}
		$mtjul=$rs6[13]; if ($mtjul == 13) { $mtjul = 0;}
		$nljul=$rs6[14]; if ($nljul == 14) { $nljul = 0;}
		$nejul=$rs6[15]; if ($nejul == 15) { $nejul = 0;}
		$najul=$rs6[16]; if ($najul == 16) { $najul = 0;}
		$ncjul=$rs6[17]; if ($ncjul == 17) { $ncjul = 0;}
		$nhjul=$rs6[18]; if ($nhjul == 18) { $nhjul = 0;}
		$nlejul=$rs6[19]; if ($nlejul == 19) { $nlejul = 0;}
		$mrjul=$rs6[20]; if ($mrjul == 20) { $mrjul = 0;}
		$totaljul=$pjul + $tajul + $whtjul + $dajul + $dijul + $cgjul + $mrjul + $ljul;
		$paug=$rs7[5]; if ($paug == 5) { $paug = 0;}
		$taaug=$rs7[6]; if ($taaug == 6) { $taaug = 0;}
		$whtaug=$rs7[7]; if ($whtaug == 7) { $whtaug = 0;}
		$daaug=$rs7[8]; if ($daaug == 8) { $daaug = 0;}
		$diaug=$rs7[9]; if ($diaug == 9) { $diaug = 0;}
		$cgaug=$rs7[10]; if ($cgaug == 10) { $cgaug = 0;}
		$laug=$rs7[11]; if ($laug == 11) { $laug = 0;}
		$traug=$rs7[12]; if ($traug == 12) { $traug = 0;}
		$mtaug=$rs7[13]; if ($mtaug == 13) { $mtaug = 0;}
		$nlaug=$rs7[14]; if ($nlaug == 14) { $nlaug = 0;}
		$neaug=$rs7[15]; if ($neaug == 15) { $neaug = 0;}
		$naaug=$rs7[16]; if ($naaug == 16) { $naaug = 0;}
		$ncaug=$rs7[17]; if ($ncaug == 17) { $ncaug = 0;}
		$nhaug=$rs7[18]; if ($nhaug == 18) { $nhaug = 0;}
		$nleaug=$rs7[19]; if ($nleaug == 19) { $nleaug = 0;}
		$mraug=$rs7[20]; if ($mraug == 20) { $mraug = 0;}
		$totalaug=$paug + $taaug + $whtaug + $daaug + $diaug + $cgaug + $mraug + $laug; 
		$psep=$rs8[5]; if ($psep == 5) { $psep = 0;}
		$tasep=$rs8[6]; if ($tasep == 6) { $tasep = 0;}
		$whtsep=$rs8[7]; if ($whtsep == 7) { $whtsep = 0;}
		$dasep=$rs8[8]; if ($dasep == 8) { $dasep = 0;}
		$disep=$rs8[9]; if ($disep == 9) { $disep = 0;}
		$cgsep=$rs8[10]; if ($cgsep == 10) { $cgsep = 0;}
		$lsep=$rs8[11]; if ($lsep == 11) { $lsep = 0;}
		$trsep=$rs8[12]; if ($trsep == 12) { $trsep = 0;}
		$mtsep=$rs8[13]; if ($mtsep == 13) { $mtsep = 0;}
		$nlsep=$rs8[14]; if ($nlsep == 14) { $nlsep = 0;}
		$nesep=$rs8[15]; if ($nesep == 15) { $nesep = 0;}
		$nasep=$rs8[16]; if ($nasep == 16) { $nasep = 0;}
		$ncsep=$rs8[17]; if ($ncsep == 17) { $ncsep = 0;}
		$nhsep=$rs8[18]; if ($nhsep == 18) { $nhsep = 0;}
		$nlesep=$rs8[19]; if ($nlesep == 19) { $nlesep = 0;}
		$mrsep=$rs8[20]; if ($mrsep == 20) { $mrsep = 0;}
		$totalsep=$psep + $tasep + $whtsep + $dasep + $disep + $cgsep + $mrsep + $lsep; 
		$poct=$rs9[5]; if ($poct == 5) { $poct = 0;}
		$taoct=$rs9[6]; if ($taoct == 6) { $taoct = 0;}
		$whtoct=$rs9[7]; if ($whtoct == 7) { $whtoct = 0;}
		$daoct=$rs9[8]; if ($daoct == 8) { $daoct = 0;}
		$dioct=$rs9[9]; if ($dioct == 9) { $dioct = 0;}
		$cgoct=$rs9[10]; if ($cgoct == 10) { $cgoct = 0;}
		$loct=$rs9[11]; if ($loct == 11) { $loct = 0;}
		$troct=$rs9[12]; if ($troct == 12) { $troct = 0;}
		$mtoct=$rs9[13]; if ($mtoct == 13) { $mtoct = 0;}
		$nloct=$rs9[14]; if ($nloct == 14) { $nloct = 0;}
		$neoct=$rs9[15]; if ($neoct == 15) { $neoct = 0;}
		$naoct=$rs9[16]; if ($naoct == 16) { $naoct = 0;}
		$ncoct=$rs9[17]; if ($ncoct == 17) { $ncoct = 0;}
		$nhoct=$rs9[18]; if ($nhoct == 18) { $nhoct = 0;}
		$nleoct=$rs9[19]; if ($nleoct == 19) { $nleoct = 0;}
		$mroct=$rs9[20]; if ($mroct == 20) { $mroct = 0;}
		$totaloct=$poct + $taoct + $whtoct + $daoct + $dioct + $cgoct + $mroct + $loct; 
		$pnov=$rs10[5]; if ($pnov == 5) { $pnov = 0;}
		$tanov=$rs10[6]; if ($tanov == 6) { $tanov = 0;}
		$whtnov=$rs10[7]; if ($whtnov == 7) { $whtnov = 0;}
		$danov=$rs10[8]; if ($danov == 8) { $danov = 0;}
		$dinov=$rs10[9]; if ($dinov == 9) { $dinov = 0;}
		$cgnov=$rs10[10]; if ($cgnov == 10) { $cgnov = 0;}
		$lnov=$rs10[11]; if ($lnov == 11) { $lnov = 0;}
		$trnov=$rs10[12]; if ($trnov == 12) { $trnov = 0;}
		$mtnov=$rs10[13]; if ($mtnov == 13) { $mtnov = 0;}
		$nlnov=$rs10[14]; if ($nlnov == 14) { $nlnov = 0;}
		$nenov=$rs10[15]; if ($nenov == 15) { $nenov = 0;}
		$nanov=$rs10[16]; if ($nanov == 16) { $nanov = 0;}
		$ncnov=$rs10[17]; if ($ncnov == 17) { $ncnov = 0;}
		$nhnov=$rs10[18]; if ($nhnov == 18) { $nhnov = 0;}
		$nlenov=$rs10[19]; if ($nlenov == 19) { $nlenov = 0;}
		$mrnov=$rs10[20]; if ($mrnov == 20) { $mrnov = 0;}
		$totalnov=$pnov + $tanov + $whtnov + $danov + $dinov + $cgnov + $mrnov + $lnov; 
		$pdec=$rs11[5]; if ($pdec == 5) { $pdec = 0;}
		$tadec=$rs11[6]; if ($tadec == 6) { $tadec = 0;}
		$whtdec=$rs11[7]; if ($whtdec == 7) { $whtdec = 0;}
		$dadec=$rs11[8]; if ($dadec == 8) { $dadec = 0;}
		$didec=$rs11[9]; if ($didec == 9) { $didec = 0;}
		$cgdec=$rs11[10]; if ($cgdec == 10) { $cgdec = 0;}
		$ldec=$rs11[11]; if ($ldec == 11) { $ldec = 0;}
		$trdec=$rs11[12]; if ($trdec == 12) { $trdec = 0;}
		$mtdec=$rs11[13]; if ($mtdec == 13) { $mtdec = 0;}
		$nldec=$rs11[14]; if ($nldec == 14) { $nldec = 0;}
		$nedec=$rs11[15]; if ($nedec == 15) { $nedec = 0;}
		$nadec=$rs11[16]; if ($nadec == 16) { $nadec = 0;}
		$ncdec=$rs11[17]; if ($ncdec == 17) { $ncdec = 0;}
		$nhdec=$rs11[18]; if ($nhdec == 18) { $nhdec = 0;}
		$nledec=$rs11[19]; if ($nledec == 19) { $nledec = 0;}
		$mrdec=$rs11[20]; if ($mrdec == 20) { $mrdec = 0;}
		$totaldec=$pdec + $tadec + $whtdec + $dadec + $didec + $cgdec + $mrdec + $ldec;
		
		//total by tax type
		$totalpaye=$paye + $pjan + $pfeb + $pmar + $papr + $pmay + $pjun + $pjul + $paug + $psep + $poct + $pnov + $pdec;
		$totalta=$tax_audit + $tajan + $tafeb + $tamar + $taapr + $tamay + $tajun + $tajul + $taaug + $tasep + $taoct + $tanov + $tadec;
		$totalwht=$wht + $whtjan + $whtfeb + $whtmar + $whtapr + $whtmay + $whtjun + $whtjul + $whtaug + $whtsep + $whtoct + $whtnov + $whtdec;
		$totalda=$direct_assess + $dajan + $dafeb + $damar + $daapr + $damay + $dajun + $dajul + $daaug + $dasep + $daoct + $danov + $dadec;
		$totaldi=$direct_informal + $dijan + $difeb + $dimar + $diapr + $dimay + $dijun + $dijul + $diaug + $disep + $dioct + $dinov + $didec;
		$totalcg=$capital_gain + $cgjan + $cgfeb + $cgmar + $cgapr + $cgmay + $cgjun + $cgjul + $cgaug + $cgsep + $cgoct + $cgnov + $cgdec;
		$totalmr=$mda_revenue + $mrjan + $mrfeb + $mrmar + $mrapr + $mrmay + $mrjun + $mrjul + $mraug + $mrsep + $mroct + $mrnov + $mrdec;
		$totall=$levies + $ljan + $lfeb + $lmar + $lapr + $lmay + $ljun + $ljul + $laug + $lsep + $loct + $lnov + $ldec;
		
		//line chart plotting 
		$serie1 = new XYDataSet();
		$serie1->addPoint(new Point("Jan","$paye"));
		$serie1->addPoint(new Point("Feb","$pfeb"));
		$serie1->addPoint(new Point("Mar","$pmar"));
		$serie1->addPoint(new Point("Apr","$papr"));
		$serie1->addPoint(new Point("May","$pmay"));
		$serie1->addPoint(new Point("Jun","$pjun"));
		$serie1->addPoint(new Point("Jul","$pjul"));
		$serie1->addPoint(new Point("Aug","$paug"));
		$serie1->addPoint(new Point("Sep","$psep"));
		$serie1->addPoint(new Point("Oct","$poct"));
		$serie1->addPoint(new Point("Nov","$pnov"));
		$serie1->addPoint(new Point("Dec","$pdec"));
		
		$serie2 = new XYDataSet();
		$serie2->addPoint(new Point("Jan","$tax_audit"));
		$serie2->addPoint(new Point("Feb","$tafeb"));
		$serie2->addPoint(new Point("Mar","$tamar"));
		$serie2->addPoint(new Point("Apr","$taapr"));
		$serie2->addPoint(new Point("May","$tamay"));
		$serie2->addPoint(new Point("Jun","$tajun"));
		$serie2->addPoint(new Point("Jul","$tajul"));
		$serie2->addPoint(new Point("Aug","$taaug"));
		$serie2->addPoint(new Point("Sep","$tasep"));
		$serie2->addPoint(new Point("Oct","$taoct"));
		$serie2->addPoint(new Point("Nov","$tanov"));
		$serie2->addPoint(new Point("Dec","$tadec"));
		
		$serie3 = new XYDataSet();
		$serie3->addPoint(new Point("Jan","$wht"));
		$serie3->addPoint(new Point("Feb","$whtfeb"));
		$serie3->addPoint(new Point("Mar","$whtmar"));
		$serie3->addPoint(new Point("Apr","$whtapr"));
		$serie3->addPoint(new Point("May","$whtmay"));
		$serie3->addPoint(new Point("Jun","$whtjun"));
		$serie3->addPoint(new Point("Jul","$whtjul"));
		$serie3->addPoint(new Point("Aug","$whtaug"));
		$serie3->addPoint(new Point("Sep","$whtsep"));
		$serie3->addPoint(new Point("Oct","$whtoct"));
		$serie3->addPoint(new Point("Nov","$whtnov"));
		$serie3->addPoint(new Point("Dec","$whtdec"));
		
		$serie4 = new XYDataSet();
		$serie4->addPoint(new Point("Jan","$direct_assess"));
		$serie4->addPoint(new Point("Feb","$dafeb"));
		$serie4->addPoint(new Point("Mar","$damar"));
		$serie4->addPoint(new Point("Apr","$daapr"));
		$serie4->addPoint(new Point("May","$damay"));
		$serie4->addPoint(new Point("Jun","$dajun"));
		$serie4->addPoint(new Point("Jul","$dajul"));
		$serie4->addPoint(new Point("Aug","$daaug"));
		$serie4->addPoint(new Point("Sep","$dasep"));
		$serie4->addPoint(new Point("Oct","$daoct"));
		$serie4->addPoint(new Point("Nov","$danov"));
		$serie4->addPoint(new Point("Dec","$dadec"));
		
		$serie5 = new XYDataSet();
		$serie5->addPoint(new Point("Jan","$direct_informal"));
		$serie5->addPoint(new Point("Feb","$difeb"));
		$serie5->addPoint(new Point("Mar","$dimar"));
		$serie5->addPoint(new Point("Apr","$diapr"));
		$serie5->addPoint(new Point("May","$dimay"));
		$serie5->addPoint(new Point("Jun","$dijun"));
		$serie5->addPoint(new Point("Jul","$dijul"));
		$serie5->addPoint(new Point("Aug","$diaug"));
		$serie5->addPoint(new Point("Sep","$disep"));
		$serie5->addPoint(new Point("Oct","$dioct"));
		$serie5->addPoint(new Point("Nov","$dinov"));
		$serie5->addPoint(new Point("Dec","$didec"));
		
		$serie6 = new XYDataSet();
		$serie6->addPoint(new Point("Jan","$capital_gain"));
		$serie6->addPoint(new Point("Feb","$cgfeb"));
		$serie6->addPoint(new Point("Mar","$cgmar"));
		$serie6->addPoint(new Point("Apr","$cgapr"));
		$serie6->addPoint(new Point("May","$cgmay"));
		$serie6->addPoint(new Point("Jun","$cgjun"));
		$serie6->addPoint(new Point("Jul","$cgjul"));
		$serie6->addPoint(new Point("Aug","$cgaug"));
		$serie6->addPoint(new Point("Sep","$cgsep"));
		$serie6->addPoint(new Point("Oct","$cgoct"));
		$serie6->addPoint(new Point("Nov","$cgnov"));
		$serie6->addPoint(new Point("Dec","$cgdec"));
		
		$serie7 = new XYDataSet();
		$serie7->addPoint(new Point("Jan","$mda_revenue"));
		$serie7->addPoint(new Point("Feb","$mrfeb"));
		$serie7->addPoint(new Point("Mar","$mrmar"));
		$serie7->addPoint(new Point("Apr","$mrapr"));
		$serie7->addPoint(new Point("May","$mrmay"));
		$serie7->addPoint(new Point("Jun","$mrjun"));
		$serie7->addPoint(new Point("Jul","$mrjul"));
		$serie7->addPoint(new Point("Aug","$mraug"));
		$serie7->addPoint(new Point("Sep","$mrsep"));
		$serie7->addPoint(new Point("Oct","$mroct"));
		$serie7->addPoint(new Point("Nov","$mrnov"));
		$serie7->addPoint(new Point("Dec","$mrdec"));
		
		$serie8 = new XYDataSet();
		$serie8->addPoint(new Point("Jan","$levies"));
		$serie8->addPoint(new Point("Feb","$lfeb"));
		$serie8->addPoint(new Point("Mar","$lmar"));
		$serie8->addPoint(new Point("Apr","$lapr"));
		$serie8->addPoint(new Point("May","$lmay"));
		$serie8->addPoint(new Point("Jun","$ljun"));
		$serie8->addPoint(new Point("Jul","$ljul"));
		$serie8->addPoint(new Point("Aug","$laug"));
		$serie8->addPoint(new Point("Sep","$lsep"));
		$serie8->addPoint(new Point("Oct","$loct"));
		$serie8->addPoint(new Point("Nov","$lnov"));
		$serie8->addPoint(new Point("Dec","$ldec"));
		
		$dataSet = new XYSeriesDataSet();
		$dataSet->addSerie("PAYE", $serie1);
		$dataSet->addSerie("Tax Audit/Back Duty", $serie2);
		$dataSet->addSerie("WHT (All)", $serie3);
		$dataSet->addSerie("Direct Assessment", $serie4);
		$dataSet->addSerie("Direct Assessment (Informal Sector)", $serie5);
		$dataSet->addSerie("Capital Gains Tax", $serie6);
		$dataSet->addSerie("MDA Revenues", $serie7);
		$dataSet->addSerie("Other Taxes/Levies/Charges", $serie8);
		$chart->setDataSet($dataSet);
		
		?>
		<!-- New Chart -->
        <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Tax', 'Amount'],
		  
		  <?php
		  
		echo '["PAYE",' .$totalpaye.'],
			  ["Tax Audit/Back Duty",' .$totalta.'],
			  ["WHT (All)",' .$totalwht.'],
			  ["Direct Assessment",' .$totalda.'],
			  ["Direct Assessment (Informal Sector)",' .$totaldi.'],
			  ["Capital Gains Tax",' .$totalcg.'],
			  ["MDA Revenues",' .$totalmr.'],
			  ["Other Taxes/Levies/Charges",' .$totall.']'
			
           ?>
               ]);
	  
        var options = {
          title: '<?php echo '' . $state . ' State IGR, total for ' . $year; ?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    
    <?php
		//}  
		echo '
                    <tr>
                        <td class="task-name">PAYE</td>
                        <td align="">' . number_format($paye,2) . '</td>
				        <td align="">' . number_format($pfeb,2) . '</td>
				        <td align="">' . number_format($pmar,2) . '</td>
				        <td align="">' . number_format($papr,2) . '</td>
				        <td align="">' . number_format($pmay,2) . '</td>
				        <td align="">' . number_format($pjun,2) . '</td>
				        <td align="">' . number_format($pjul,2) . '</td>
				        <td align="">' . number_format($paug,2) . '</td>
				        <td align="">' . number_format($psep,2) . '</td>
				        <td align="">' . number_format($poct,2) . '</td>
				        <td align="">' . number_format($pnov,2) . '</td>
				        <td align="">' . number_format($pdec,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">Tax Audit/Back Duty</td>
                        <td align="">' . number_format($tax_audit,2) . '</td>
        				<td align="">' . number_format($tafeb,2) . '</td>
        				<td align="">' . number_format($tamar,2) . '</td>
        				<td align="">' . number_format($taapr,2) . '</td>
        				<td align="">' . number_format($tamay,2) . '</td>
        				<td align="">' . number_format($tajun,2) . '</td>
        				<td align="">' . number_format($tajul,2) . '</td>
        				<td align="">' . number_format($taaug,2) . '</td>
        				<td align="">' . number_format($tasep,2) . '</td>
        				<td align="">' . number_format($taoct,2) . '</td>
        				<td align="">' . number_format($tanov,2) . '</td>
        				<td align="">' . number_format($tadec,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">WHT (All)</td>
                        <td align="">' . number_format($wht,2) . '</td>
        				<td align="">' . number_format($whtfeb,2) . '</td>
        				<td align="">' . number_format($whtmar,2) . '</td>
        				<td align="">' . number_format($whtapr,2) . '</td>
        				<td align="">' . number_format($whtmay,2) . '</td>
        				<td align="">' . number_format($whtjun,2) . '</td>
        				<td align="">' . number_format($whtjul,2) . '</td>
        				<td align="">' . number_format($whtaug,2) . '</td>
        				<td align="">' . number_format($whtsep,2) . '</td>
        				<td align="">' . number_format($whtoct,2) . '</td>
        				<td align="">' . number_format($whtnov,2) . '</td>
        				<td align="">' . number_format($whtdec,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">Direct Assessment</td>
                        <td align="">' . number_format($direct_assess,2) . '</td>
        				<td align="">' . number_format($dafeb,2) . '</td>
        				<td align="">' . number_format($damar,2) . '</td>
        				<td align="">' . number_format($daapr,2) . '</td>
        				<td align="">' . number_format($damay,2) . '</td>
        				<td align="">' . number_format($dajun,2) . '</td>
        				<td align="">' . number_format($dajul,2) . '</td>
        				<td align="">' . number_format($daaug,2) . '</td>
        				<td align="">' . number_format($dasep,2) . '</td>
        				<td align="">' . number_format($daoct,2) . '</td>
        				<td align="">' . number_format($danov,2) . '</td>
        				<td align="">' . number_format($dadec,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">Direct Assessment (Informal Sector)</td>
                        <td align="">' . number_format($direct_informal,2) . '</td>
        				<td align="">' . number_format($difeb,2) . '</td>
        				<td align="">' . number_format($dimar,2) . '</td>
        				<td align="">' . number_format($diapr,2) . '</td>
        				<td align="">' . number_format($dimay,2) . '</td>
        				<td align="">' . number_format($dijun,2) . '</td>
        				<td align="">' . number_format($dijul,2) . '</td>
        				<td align="">' . number_format($diaug,2) . '</td>
        				<td align="">' . number_format($disep,2) . '</td>
        				<td align="">' . number_format($dioct,2) . '</td>
        				<td align="">' . number_format($dinov,2) . '</td>
        				<td align="">' . number_format($didec,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">Capital Gains Tax</td>
                        <td align="">' . number_format($capital_gain,2) . '</td>
        				<td align="">' . number_format($cgfeb,2) . '</td>
        				<td align="">' . number_format($cgmar,2) . '</td>
        				<td align="">' . number_format($cgapr,2) . '</td>
        				<td align="">' . number_format($cgmay,2) . '</td>
        				<td align="">' . number_format($cgjun,2) . '</td>
        				<td align="">' . number_format($cgjul,2) . '</td>
        				<td align="">' . number_format($cgaug,2) . '</td>
        				<td align="">' . number_format($cgsep,2) . '</td>
        				<td align="">' . number_format($cgoct,2) . '</td>
        				<td align="">' . number_format($cgnov,2) . '</td>
        				<td align="">' . number_format($cgdec,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">MDA Revenues</td>
                        <td align="">' . number_format($mda_revenue,2) . '</td>
        				<td align="">' . number_format($mrfeb,2) . '</td>
        				<td align="">' . number_format($mrmar,2) . '</td>
        				<td align="">' . number_format($mrapr,2) . '</td>
        				<td align="">' . number_format($mrmay,2) . '</td>
        				<td align="">' . number_format($mrjun,2) . '</td>
        				<td align="">' . number_format($mrjul,2) . '</td>
        				<td align="">' . number_format($mraug,2) . '</td>
        				<td align="">' . number_format($mrsep,2) . '</td>
        				<td align="">' . number_format($mroct,2) . '</td>
        				<td align="">' . number_format($mrnov,2) . '</td>
        				<td align="">' . number_format($mrdec,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">Other Taxes/Levies/Charges</td>
                        <td align="">' . number_format($levies,2) . '</td>
        				<td align="">' . number_format($lfeb,2) . '</td>
        				<td align="">' . number_format($lmar,2) . '</td>
        				<td align="">' . number_format($lapr,2) . '</td>
        				<td align="">' . number_format($lmay,2) . '</td>
        				<td align="">' . number_format($ljun,2) . '</td>
        				<td align="">' . number_format($ljul,2) . '</td>
        				<td align="">' . number_format($laug,2) . '</td>
        				<td align="">' . number_format($lsep,2) . '</td>
        				<td align="">' . number_format($loct,2) . '</td>
        				<td align="">' . number_format($lnov,2) . '</td>
        				<td align="">' . number_format($ldec,2) . '</td>
                    </tr>
                </tbody>
                <tbody style="background-color:#D0F0C0;">
                    <tr>
                        <td class="task-name">Total</td>
                        <td align="">' . number_format($total,2) . '</td>
        				<td align="">' . number_format($totalfeb,2) . '</td>
        				<td align="">' . number_format($totalmar,2) . '</td>
        				<td align="">' . number_format($totalapr,2) . '</td>
        				<td align="">' . number_format($totalmay,2) . '</td>
        				<td align="">' . number_format($totaljun,2) . '</td>
        				<td align="">' . number_format($totaljul,2) . '</td>
        				<td align="">' . number_format($totalaug,2) . '</td>
        				<td align="">' . number_format($totalsep,2) . '</td>
        				<td align="">' . number_format($totaloct,2) . '</td>
        				<td align="">' . number_format($totalnov,2) . '</td>
        				<td align="">' . number_format($totaldec,2) . '</td>
                    </tr>
                </tbody>
                <tbody>
                <tr>
                        <td class="task-name">Taxpayer Registration No of TINs per JTB</td>
                        <td align="">' . number_format($taxpayer_reg) . '</td>
        				<td align="">' . number_format($trfeb) . '</td>
        				<td align="">' . number_format($trmar) . '</td>
        				<td align="">' . number_format($trapr) . '</td>
        				<td align="">' . number_format($trmay) . '</td>
        				<td align="">' . number_format($trjun) . '</td>
        				<td align="">' . number_format($trjul) . '</td>
        				<td align="">' . number_format($traug) . '</td>
        				<td align="">' . number_format($trsep) . '</td>
        				<td align="">' . number_format($troct) . '</td>
        				<td align="">' . number_format($trnov) . '</td>
        				<td align="">' . number_format($trdec) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">New Monthly TINs registered</td>
                        <td align="">' . number_format($monthly_tin) . '</td>
        				<td align="">' . number_format($mtfeb) . '</td>
        				<td align="">' . number_format($mtmar) . '</td>
        				<td align="">' . number_format($mtapr) . '</td>
        				<td align="">' . number_format($mtmay) . '</td>
        				<td align="">' . number_format($mtjun) . '</td>
        				<td align="">' . number_format($mtjul) . '</td>
        				<td align="">' . number_format($mtaug) . '</td>
        				<td align="">' . number_format($mtsep) . '</td>
        				<td align="">' . number_format($mtoct) . '</td>
        				<td align="">' . number_format($mtnov) . '</td>
        				<td align="">' . number_format($mtdec) . '</td>
                  </tr>
                  <tr>
                        <td class="task-name">No of Taxes/Levies Instruments amended/passed/signed in the month</td>
                        <td align="">' . number_format($num_levies) . '</td>
        				<td align="">' . number_format($nlfeb) . '</td>
        				<td align="">' . number_format($nlmar) . '</td>
        				<td align="">' . number_format($nlapr) . '</td>
        				<td align="">' . number_format($nlmay) . '</td>
        				<td align="">' . number_format($nljun) . '</td>
        				<td align="">' . number_format($nljul) . '</td>
        				<td align="">' . number_format($nlaug) . '</td>
        				<td align="">' . number_format($nlsep) . '</td>
        				<td align="">' . number_format($nloct) . '</td>
        				<td align="">' . number_format($nlnov) . '</td>
        				<td align="">' . number_format($nldec) . '</td>
                  </tr>
                  <tr>
                    <td class="task-name">Number of Tax Education Activities</td>
                    <td align="">' . number_format($num_education) . '</td>
    				<td align="">' . number_format($nefeb) . '</td>
    				<td align="">' . number_format($nemar) . '</td>
    				<td align="">' . number_format($neapr) . '</td>
    				<td align="">' . number_format($nemay) . '</td>
    				<td align="">' . number_format($nejun) . '</td>
    				<td align="">' . number_format($nejul) . '</td>
    				<td align="">' . number_format($neaug) . '</td>
    				<td align="">' . number_format($nesep) . '</td>
    				<td align="">' . number_format($neoct) . '</td>
    				<td align="">' . number_format($nenov) . '</td>
    				<td align="">' . number_format($nedec) . '</td>
                  </tr>
                  <tr>
                    <td class="task-name">Number of Tax Appeal Tribunal (TAT) cases</td>
                    <td align="">' . number_format($num_appeal) . '</td>
    				<td align="">' . number_format($nafeb) . '</td>
    				<td align="">' . number_format($namar) . '</td>
    				<td align="">' . number_format($naapr) . '</td>
    				<td align="">' . number_format($namay) . '</td>
    				<td align="">' . number_format($najun) . '</td>
    				<td align="">' . number_format($najul) . '</td>
    				<td align="">' . number_format($naaug) . '</td>
    				<td align="">' . number_format($nasep) . '</td>
    				<td align="">' . number_format($naoct) . '</td>
    				<td align="">' . number_format($nanov) . '</td>
    				<td align="">' . number_format($nadec) . '</td>
                  </tr>
                  <tr>
                    <td class="task-name">Number of Tax debt cases in Court</td>
                    <td align="">' . number_format($num_cases) . '</td>
    				<td align="">' . number_format($ncfeb) . '</td>
    				<td align="">' . number_format($ncmar) . '</td>
    				<td align="">' . number_format($ncapr) . '</td>
    				<td align="">' . number_format($ncmay) . '</td>
    				<td align="">' . number_format($ncjun) . '</td>
    				<td align="">' . number_format($ncjul) . '</td>
    				<td align="">' . number_format($ncaug) . '</td>
    				<td align="">' . number_format($ncsep) . '</td>
    				<td align="">' . number_format($ncoct) . '</td>
    				<td align="">' . number_format($ncnov) . '</td>
    				<td align="">' . number_format($ncdec) . '</td>
                  </tr>
                  <tr>
                    <td class="task-name">Number of HINWI Taxpayers</td>
                    <td align="">' . number_format($num_hinwi) . '</td>
    				<td align="">' . number_format($nhfeb) . '</td>
    				<td align="">' . number_format($nhmar) . '</td>
    				<td align="">' . number_format($nhapr) . '</td>
    				<td align="">' . number_format($nhmay) . '</td>
    				<td align="">' . number_format($nhjun) . '</td>
    				<td align="">' . number_format($nhjul) . '</td>
    				<td align="">' . number_format($nhaug) . '</td>
    				<td align="">' . number_format($nhsep) . '</td>
    				<td align="">' . number_format($nhoct) . '</td>
    				<td align="">' . number_format($nhnov) . '</td>
    				<td align="">' . number_format($nhdec) . '</td>
                  </tr>
                  <tr>
                    <td class="task-name">Number of Motor Vehicle Licenses Issued</td>
                    <td align="">' . number_format($num_license) . '</td>
    				<td align="">' . number_format($nlefeb) . '</td>
    				<td align="">' . number_format($nlemar) . '</td>
    				<td align="">' . number_format($nleapr) . '</td>
    				<td align="">' . number_format($nlemay) . '</td>
    				<td align="">' . number_format($nlejun) . '</td>
    				<td align="">' . number_format($nlejul) . '</td>
    				<td align="">' . number_format($nleaug) . '</td>
    				<td align="">' . number_format($nlesep) . '</td>
    				<td align="">' . number_format($nleoct) . '</td>
    				<td align="">' . number_format($nlenov) . '</td>
    				<td align="">' . number_format($nledec) . '</td>
                  </tr>
                  </tbody>';
			  }
			  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="piechart" style="width: 900px; height: 500px;"></div>
<?php include('_footer.php') ?>

<script>
    $('a[href="StateIGR"]').addClass('active')
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