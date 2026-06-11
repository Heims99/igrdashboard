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
<?php include('_header.php') ?>
<div class="container shadow_bg">
    <h4>IGR FA Analysis</h4>
    <form class="form-inline mt-5 d-flex justify-content-between" id="form1" name="form1" method="post" action="#">
        <div class="d-flex">
            <div class="form-group mx-sm-3 mb-2">
                <label for="year" class="sr-only">Year</label>
                <select id="year" name="year" class="form-control">
                    <?php
		  //include 'connection.php';
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}  
   $sql = mysqli_query($con, "SELECT DISTINCT(year) FROM annex ORDER BY year");
   //$result = mysql_query($sql);
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
            <div class="form-group mx-sm-3 mb-2">
                <label for="month" class="sr-only">Month</label>
                <select id="month" name="month" class="form-control">
                    <?php
		 // include 'connection.php';
		 $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}  
   $sql = mysqli_query($con, "SELECT DISTINCT(month) FROM annex");
   //$result = mysql_query($sql);
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
            <button name="Submit" type="submit" class="btn btn-success mb-2">Display</button>
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

$year=$_POST['year']; //echo $year;
$month=$_POST['month']; //echo $month;
//$yeardiff=$year - 1;

	//echo $previgr;
$sq1 ="SELECT faacMonthly.state, annex.state AS nstate, faacMonthly.faacYear, annex.year, faacMonthly.january, faacMonthly.february, faacMonthly.march, faacMonthly.april, faacMonthly.may, faacMonthly.june, faacMonthly.july, faacMonthly.august, faacMonthly.september, faacMonthly.october, faacMonthly.november, faacMonthly.december, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'January' AND annex.state = nstate GROUP BY state ORDER BY state) AS janigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'February' AND annex.state = nstate GROUP BY state ORDER BY state) AS febigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'March' AND annex.state = nstate GROUP BY state ORDER BY state) AS marigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'April' AND annex.state = nstate GROUP BY state ORDER BY state) AS aprigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'May' AND annex.state = nstate GROUP BY state ORDER BY state) AS mayigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'June' AND annex.state = nstate GROUP BY state ORDER BY state) AS junigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'July' AND annex.state = nstate GROUP BY state ORDER BY state) AS juligr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'August' AND annex.state = nstate GROUP BY state ORDER BY state) AS augigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'September' AND annex.state = nstate GROUP BY state ORDER BY state) AS sepigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'October' AND annex.state = nstate GROUP BY state ORDER BY state) AS octigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'November' AND annex.state = nstate GROUP BY state ORDER BY state) AS novigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'December' AND annex.state = nstate GROUP BY state ORDER BY state) AS decigr
FROM faacMonthly, annex
WHERE faacMonthly.faacYear = annex.year
AND faacMonthly.faacYear ='".$year."'
AND annex.year ='".$year."'
AND annex.month ='".$month."'
AND faacMonthly.state = annex.state
GROUP BY annex.state
ORDER BY annex.state";

$result=mysqli_query($con, $sq1); //echo $result;

}
?>
<div class="container shadow_bg mt-5">
    <div class="table-wrapper">
        <div class="header-info justify-content-center">
            <!--<div class="state-name">ADAMAWA |&nbsp;</div>
            <div class="year">Year: 2016</div>-->
        </div>
        <div class="overflow-x">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">State</th>
                        <th scope="col">IGR <?php echo '('.$month.', '.$year.', N)'; ?></th>
                        <th scope="col">IGR (∆, N)</th>
                        <th scope="col">IGR (∆, %)</th>
                        <th scope="col">IGR (% of TRR)</th>
                    </tr>
                </thead>
                
<?php
			  while($rs=@mysqli_fetch_array($result, MYSQLI_NUM)){
			
		
		/*$state=$rs[1]; 
		$year=$rs[3]; 
		$fa=$rs[4];
		$igr=$rs[5]; 
		$previgr=$rs[7]; 
		$totaltrr=$igr + $fa;
		$percenttrr=($igr/$totaltrr)*100;
		$igrdiff=$igr - $previgr; 
		if($year <= 2015){
    	$igrdiff = 0.00;
		}
		$percentigrdiff=($igrdiff/$previgr)*100;*/
		
		$state=$rs[1]; 
		$year=$rs[3]; 
		$janfa=$rs[4];
		$febfa=$rs[5];
		$marfa=$rs[6];
		$aprfa=$rs[7];
		$mayfa=$rs[8];
		$junfa=$rs[9];
		$julfa=$rs[10];
		$augfa=$rs[11];
		$sepfa=$rs[12];
		$octfa=$rs[13];
		$novfa=$rs[14];
		$decfa=$rs[15];
		$janigr=$rs[16];
		$febigr=$rs[17];
		$marigr=$rs[18];
		$aprigr=$rs[19];
		$mayigr=$rs[20];
		$junigr=$rs[21];
		$juligr=$rs[22];
		$augigr=$rs[23];
		$sepigr=$rs[24];
		$octigr=$rs[25];
		$novigr=$rs[26];
		$decigr=$rs[27];
		
		if($month == "January"){
			$curigr=$rs[16];
			$igrdiff=$curigr - 0.00;
			$percentigrdiff=@($igrdiff/0.00)*100;
			$totaltrr=$janfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}
		
		if($month == "February"){
			$curigr=$rs[17];
			$igrdiff=$curigr - $janigr;
			$percentigrdiff=@($igrdiff/$janigr)*100;
			$totaltrr=$febfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}
			
		if($month == "March"){
			$curigr=$rs[18];
			$igrdiff=$curigr - $febigr;
			$percentigrdiff=@($igrdiff/$febigr)*100;
			$totaltrr=$marfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}
			
		if($month == "April"){
			$curigr=$rs[19];
			$igrdiff=$curigr - $marigr;
			$percentigrdiff=@($igrdiff/$marigr)*100;
			$totaltrr=$aprfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}
			
		if($month == "May"){
			$curigr=$rs[20];
			$igrdiff=$curigr - $aprigr;
			$percentigrdiff=@($igrdiff/$aprigr)*100;
			$totaltrr=$mayfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}
			
		if($month == "June"){
			$curigr=$rs[21];
			$igrdiff=$curigr - $mayigr;
			$percentigrdiff=@($igrdiff/$mayigr)*100;
			$totaltrr=$junfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}
			
		if($month == "July"){
			$curigr=$rs[22];
			$igrdiff=$curigr - $junigr;
			$percentigrdiff=@($igrdiff/$junigr)*100;
			$totaltrr=$julfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}
			
		if($month == "August"){
			$curigr=$rs[23];
			$igrdiff=$curigr - $juligr;
			$percentigrdiff=@($igrdiff/$juligr)*100;
			$totaltrr=$augfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}	
			
		if($month == "September"){
			$curigr=$rs[24];
			$igrdiff=$curigr - $augigr;
			$percentigrdiff=@($igrdiff/$augigr)*100;
			$totaltrr=$sepfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}		
			
		if($month == "October"){
			$curigr=$rs[25];
			$igrdiff=$curigr - $sepigr;
			$percentigrdiff=@($igrdiff/$sepigr)*100;
			$totaltrr=$octfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}	
			
		if($month == "November"){
			$curigr=$rs[26];
			$igrdiff=$curigr - $octigr;
			$percentigrdiff=@($igrdiff/$octigr)*100;
			$totaltrr=$novfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}
			
		if($month == "December"){
			$curigr=$rs[27];
			$igrdiff=$curigr - $novigr;
			$percentigrdiff=@($igrdiff/$novigr)*100;
			$totaltrr=$decfa + $curigr;
			$percenttrr=@($curigr/$totaltrr)*100;
			}				  
		
		if(stripos($percentigrdiff, '-') !== FALSE || stripos($igrdiff, '-') !== FALSE){
  echo'
                <tbody>
                    <tr>
                
                <td>' . $state . '</td>
				<td align="right">' . number_format($curigr,2) . '</td>
				<td align="right"><font color="#FF0000">' . number_format($igrdiff,2) . '</font></td>
				<td align="right"><font color="#FF0000">' . number_format($percentigrdiff,2) . '</font></td>
				<td align="right">' . number_format($percenttrr,2) . '</td>
				
              </tr>';
		} else {
		    echo'     
              
              <tr>
                
                <td>' . $state . '</td>
				<td align="right">' . number_format($curigr,2) . '</td>
				<td align="right"><font color="#009900">' . number_format($igrdiff,2) . '</font></td>
				<td align="right"><font color="#009900">' . number_format($percentigrdiff,2) . '</font></td>
				<td align="right">' . number_format($percenttrr,2) . '</td>
				
              </tr></tbody>';
		}   
			 }
			  ?>
            </table>
        </div>
    </div>
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
$year=$_POST['year']; //echo $year;
$month=$_POST['month']; //echo $month;
 $sq2 ="SELECT faacMonthly.state, annex.state AS nstate, faacMonthly.faacYear, annex.year, faacMonthly.january, faacMonthly.february, faacMonthly.march, faacMonthly.april, faacMonthly.may, faacMonthly.june, faacMonthly.july, faacMonthly.august, faacMonthly.september, faacMonthly.october, faacMonthly.november, faacMonthly.december, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'January' AND annex.state = nstate GROUP BY state ORDER BY state) AS janigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'February' AND annex.state = nstate GROUP BY state ORDER BY state) AS febigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'March' AND annex.state = nstate GROUP BY state ORDER BY state) AS marigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'April' AND annex.state = nstate GROUP BY state ORDER BY state) AS aprigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'May' AND annex.state = nstate GROUP BY state ORDER BY state) AS mayigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'June' AND annex.state = nstate GROUP BY state ORDER BY state) AS junigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'July' AND annex.state = nstate GROUP BY state ORDER BY state) AS juligr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'August' AND annex.state = nstate GROUP BY state ORDER BY state) AS augigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'September' AND annex.state = nstate GROUP BY state ORDER BY state) AS sepigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'October' AND annex.state = nstate GROUP BY state ORDER BY state) AS octigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'November' AND annex.state = nstate GROUP BY state ORDER BY state) AS novigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'December' AND annex.state = nstate GROUP BY state ORDER BY state) AS decigr
FROM faacMonthly, annex
WHERE faacMonthly.faacYear = annex.year
AND faacMonthly.faacYear ='".$year."'
AND annex.year ='".$year."'
AND annex.month ='".$month."'
AND faacMonthly.state = annex.state
GROUP BY annex.state
ORDER BY annex.state";
$result1=mysqli_query($con, $sq2);

}             
     ?>
<div class="container shadow_bg mt-5">
    <div class="table-wrapper">
        <div class="header-info justify-content-center">
            <!--<div class="state-name">ADAMAWA |&nbsp;</div>
            <div class="year">Year: 2016</div>-->
        </div>
        <div class="overflow-x">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">State</th>
                        <th scope="col">FA <?php echo '('.$month.', '.$year.', N)'; ?></th>
                        <th scope="col">FA (∆, N)</th>
                        <th scope="col">FA (∆, %)</th>
                        <th scope="col">FA (% of TRR)</th>
                    </tr>
                </thead>
                
<?php
  
  while($rs1=@mysqli_fetch_array($result1, MYSQLI_NUM)){  
  
 	/*$statefa=$rs1[0];
	$totalsum=$rs1[4];
	$totaligr=$rs1[5]; 
	$prevfa=$rs1[6]; //echo $prevfa;
	$trr=$totalsum + $totaligr;
	$trrpercent=($totalsum/$trr)*100; 
	$fadiff=$totalsum - $prevfa;
	if($year <= 2015){
    $fadiff = 0.00;
	}
	$percentfadiff=($fadiff/$prevfa)*100;*/
	
	    $statefa=$rs1[0]; 
		$year=$rs1[3]; 
		$janfa=$rs1[4];
		$febfa=$rs1[5];
		$marfa=$rs1[6];
		$aprfa=$rs1[7];
		$mayfa=$rs1[8];
		$junfa=$rs1[9];
		$julfa=$rs1[10];
		$augfa=$rs1[11];
		$sepfa=$rs1[12];
		$octfa=$rs1[13];
		$novfa=$rs1[14];
		$decfa=$rs1[15];
		$janigr=$rs1[16];
		$febigr=$rs1[17];
		$marigr=$rs1[18];
		$aprigr=$rs1[19];
		$mayigr=$rs1[20];
		$junigr=$rs1[21];
		$juligr=$rs1[22];
		$augigr=$rs1[23];
		$sepigr=$rs1[24];
		$octigr=$rs1[25];
		$novigr=$rs1[26];
		$decigr=$rs1[27];
		
		if($month == "January"){
			$curfa=$rs1[4];
			$fadiff=$curfa - 0.00;
			$percentfadiff=@($fadiff/0.00)*100;
			$totaltrr=$janigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}
		
		if($month == "February"){
			$curfa=$rs1[5];
			$fadiff=$curfa - $janfa;
			$percentfadiff=@($fadiff/$janfa)*100;
			$totaltrr=$febigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}
			
		if($month == "March"){
			$curfa=$rs1[6];
			$fadiff=$curfa - $febfa;
			$percentfadiff=@($fadiff/$febfa)*100;
			$totaltrr=$marigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}	
			
		if($month == "April"){
			$curfa=$rs1[7];
			$fadiff=$curfa - $marfa;
			$percentfadiff=@($fadiff/$marfa)*100;
			$totaltrr=$aprigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}
			
		if($month == "May"){
			$curfa=$rs1[8];
			$fadiff=$curfa - $aprfa;
			$percentfadiff=@($fadiff/$aprfa)*100;
			$totaltrr=$mayigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}
			
		if($month == "June"){
			$curfa=$rs1[9];
			$fadiff=$curfa - $mayfa;
			$percentfadiff=@($fadiff/$mayfa)*100;
			$totaltrr=$junigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}
			
		if($month == "July"){
			$curfa=$rs1[10];
			$fadiff=$curfa - $junfa;
			$percentfadiff=@($fadiff/$junfa)*100;
			$totaltrr=$juligr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}
			
		if($month == "August"){
			$curfa=$rs1[11];
			$fadiff=$curfa - $julfa;
			$percentfadiff=@($fadiff/$julfa)*100;
			$totaltrr=$augigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}
			
		if($month == "September"){
			$curfa=$rs1[12];
			$fadiff=$curfa - $augfa;
			$percentfadiff=@($fadiff/$augfa)*100;
			$totaltrr=$sepigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}
			
		if($month == "October"){
			$curfa=$rs1[13];
			$fadiff=$curfa - $sepfa;
			$percentfadiff=@($fadiff/$sepfa)*100;
			$totaltrr=$octigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}
			
		if($month == "November"){
			$curfa=$rs1[14];
			$fadiff=$curfa - $octfa;
			$percentfadiff=@($fadiff/$octfa)*100;
			$totaltrr=$novigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}
			
		if($month == "December"){
			$curfa=$rs1[15];
			$fadiff=$curfa - $novfa;
			$percentfadiff=@($fadiff/$novfa)*100;
			$totaltrr=$decigr + $curfa;
			$percenttrr=@($curfa/$totaltrr)*100;
			}	
			
	    if(stripos($percentfadiff, '-') !== FALSE || stripos($fadiff, '-') !== FALSE){
	echo'     
              
              <tr>
                
				<td>' . $statefa . '</td>
				<td align="right">' . number_format($curfa,2) . '</td>
				<td align="right"><font color="#FF0000">' . number_format($fadiff,2) . '</font></td>
				<td align="right"><font color="#FF0000">' . number_format($percentfadiff,2) . '</font></td>
				<td align="right">' . number_format($percenttrr,2) . '</td>
              </tr>';
	    } else {
	        echo'     
              
              <tr>
                
				<td>' . $statefa . '</td>
				<td align="right">' . number_format($curfa,2) . '</td>
				<td align="right"><font color="#009900">' . number_format($fadiff,2) . '</font></td>
				<td align="right"><font color="#009900">' . number_format($percentfadiff,2) . '</font></td>
				<td align="right">' . number_format($percenttrr,2) . '</td>
              </tr></tbody>';
	    } 
			 }
			  ?>
            </table>
        </div>
    </div>
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
$year=$_POST['year']; //echo $year;
$month=$_POST['month']; //echo $month;
$sq3 ="SELECT faacMonthly.state, annex.state AS nstate, faacMonthly.faacYear, annex.year, faacMonthly.january, faacMonthly.february, faacMonthly.march, faacMonthly.april, faacMonthly.may, faacMonthly.june, faacMonthly.july, faacMonthly.august, faacMonthly.september, faacMonthly.october, faacMonthly.november, faacMonthly.december, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'January' AND annex.state = nstate GROUP BY state ORDER BY state) AS janigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'February' AND annex.state = nstate GROUP BY state ORDER BY state) AS febigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'March' AND annex.state = nstate GROUP BY state ORDER BY state) AS marigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'April' AND annex.state = nstate GROUP BY state ORDER BY state) AS aprigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'May' AND annex.state = nstate GROUP BY state ORDER BY state) AS mayigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'June' AND annex.state = nstate GROUP BY state ORDER BY state) AS junigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'July' AND annex.state = nstate GROUP BY state ORDER BY state) AS juligr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'August' AND annex.state = nstate GROUP BY state ORDER BY state) AS augigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'September' AND annex.state = nstate GROUP BY state ORDER BY state) AS sepigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'October' AND annex.state = nstate GROUP BY state ORDER BY state) AS octigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'November' AND annex.state = nstate GROUP BY state ORDER BY state) AS novigr, (SELECT annex.paye + annex.tax_audit + annex.wht + annex.direct_assess + annex.direct_informal + annex.capital_gain + annex.levies FROM annex WHERE month = 'December' AND annex.state = nstate GROUP BY state ORDER BY state) AS decigr
FROM faacMonthly, annex
WHERE faacMonthly.faacYear = annex.year
AND faacMonthly.faacYear ='".$year."'
AND annex.year ='".$year."'
AND annex.month ='".$month."'
AND faacMonthly.state = annex.state
GROUP BY annex.state
ORDER BY annex.state";
$result2=mysqli_query($con, $sq3);

}             
     ?>
<div class="container shadow_bg mt-5">
    <div class="table-wrapper">
        <div class="header-info justify-content-center">
            <!--<div class="state-name">ADAMAWA |&nbsp;</div>
            <div class="year">Year: 2016</div>-->
        </div>
        <div class="overflow-x">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">State</th>
                        <th scope="col">TRR <?php echo '('.$month.', '.$year.', N)'; ?></th>
                        <th scope="col">TRR (∆, N)</th>
                        <th scope="col">TRR (∆, %)</th>
                        <!--<th scope="col">TRR (% of TRR)</th>-->
                    </tr>
                </thead>
                
<?php
		while($rs2=@mysqli_fetch_array($result2, MYSQLI_NUM)){  
  
 	/*$state=$rs2[1];
	$fa=$rs2[4];
	$igr=$rs2[5];
	$prevfa=$rs2[6];
	$previgr=$rs2[7];
	$totaltrr=$fa + $igr; 
	$prevtrr=$prevfa + $previgr;
	$trrdiff=$totaltrr - $prevtrr;
	if($year <= 2015){
    $trrdiff = 0.00;
	}
	$percenttrrdiff=($trrdiff/$prevtrr)*100;*/
	
		$state=$rs2[1]; 
		$year=$rs2[3]; 
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
		$janigr=$rs2[16];
		$febigr=$rs2[17];
		$marigr=$rs2[18];
		$aprigr=$rs2[19];
		$mayigr=$rs2[20];
		$junigr=$rs2[21];
		$juligr=$rs2[22];
		$augigr=$rs2[23];
		$sepigr=$rs2[24];
		$octigr=$rs2[25];
		$novigr=$rs2[26];
		$decigr=$rs2[27];
		
		if($month == "January"){
			$prevtrr=0.00 + 0.00;
			$totaltrr=$janfa + $janigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}
		
		if($month == "February"){
			$prevtrr=$janfa + $janigr;
			$totaltrr=$febfa + $febigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}
			
		if($month == "March"){
			$prevtrr=$febfa + $febigr;
			$totaltrr=$marfa + $marigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}
			
		if($month == "April"){
			$prevtrr=$marfa + $marigr;
			$totaltrr=$aprfa + $aprigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}
			
		if($month == "May"){
			$prevtrr=$aprfa + $aprigr;
			$totaltrr=$mayfa + $mayigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}
			
		if($month == "June"){
			$prevtrr=$mayfa + $mayigr;
			$totaltrr=$junfa + $junigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}
			
		if($month == "July"){
			$prevtrr=$junfa + $junigr;
			$totaltrr=$julfa + $juligr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}	
			
		if($month == "August"){
			$prevtrr=$julfa + $juligr;
			$totaltrr=$augfa + $augigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}
			
		if($month == "September"){
			$prevtrr=$augfa + $augigr;
			$totaltrr=$sepfa + $sepigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}
			
		if($month == "October"){
			$prevtrr=$sepfa + $sepigr;
			$totaltrr=$octfa + $octigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}
			
		if($month == "November"){
			$prevtrr=$octfa + $octigr;
			$totaltrr=$novfa + $novigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}
			
		if($month == "December"){
			$prevtrr=$novfa + $novigr;
			$totaltrr=$decfa + $decigr;
			$trrdiff=$totaltrr - $prevtrr;
			$percenttrrdiff=@($trrdiff/$prevtrr)*100;
			}										
	
	if(stripos($trrdiff, '-') !== FALSE || stripos($percenttrrdiff, '-') !== FALSE){
	echo'     
              
              <tr>
				<td>' . $state . '</td>
				<td align="right">' . number_format($totaltrr,2) . '</td>
				<td align="right"><font color="#FF0000">' . number_format($trrdiff,2) . '</font></td>
				<td align="right"><font color="#FF0000">' . number_format($percenttrrdiff,2) . '</font></td>
              </tr>';
	} else {
	    echo'     
              
              <tr>
				<td>' . $state . '</td>
				<td align="right">' . number_format($totaltrr,2) . '</td>
				<td align="right"><font color="#009900">' . number_format($trrdiff,2) . '</font></td>
				<td align="right"><font color="#009900">' . number_format($percenttrrdiff,2) . '</font></td>
              </tr></tbody';
	}
			 }
			  ?>
            </table>
        </div>
    </div>
</div>
<?php include('_footer.php') ?>

<script>
    $('a[href="TRRAnalytics"]').addClass('active')
</script>
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