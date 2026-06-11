<?php
//Session starts here
session_start();
include_once 'connection.php';
if(!isset($_SESSION['user']))
{
 header("Location: login.php");
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
<title>Welcome To NGF Dashboard - <?php echo $userRow['state']; ?></title>
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
.mybutton {
	font-weight: normal;
	color: #FFF;
	background-color: #93C73E;
	padding: 7px;
}
</style>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td><img src="images/NGF_logo.png" width="353" height="129" /></td>
    <td><table width="100%" border="0">
      <tr>
        <td align="right" valign="top" class="mytopmenunew"><div id="content">
         Welcome, <?php echo $userRow['username']; ?> ::<a href="logout_front.php?logout">Sign Out</a>| <a href="logout_fro.php?logout">My Admin</a>| <a href="#">My Reports</a>
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
    <td><table width="100%" border="0" class="inner_table">
      <tr>
        <td><table width="100%" border="0">
          <tr>
            <td><h3>Nigeria Governors' Forum IGR Dashboard Downloads </h3></td>
            <td align="right" class="mytopmenu">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td width="50%"><b>MY REPORTS</b></td>
            <td align="right" class="mytopmenuhelp">&nbsp;</td>
          </tr>
          
            <?php
            
            $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
            
			$sql=mysqli_query($con, "SELECT id,file_name,uploaded FROM files WHERE file_name LIKE '%$userRow[state]%' OR file_name LIKE 'ngf%'");
			
			//$result=mysql_query($sql,$db) or die(mysql_error());
			while($row=mysqli_fetch_array($sql)) {
				$fileid=$row['id'];
				$filename=$row['file_name'];
				$uploaded=$row['uploaded'];
				?>
			<tr>
            <td colspan="2">
            <table width="50%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>	
				<a href="<? echo "statefiles/uploads/".$filename.'"'; ?>"><? if(stripos($filename, 'pdf') !== FALSE){

				 echo "&nbsp;&nbsp;<img src='statefiles/images.png' width=40 height=40 />&nbsp;" .$filename. "<br><hr width=100% size=1px color='#e9e9e9'>"; ?></a></td>
                <td align="right"  valign="bottom"><a href="<? echo "statefiles/uploads/".$filename.'"'; ?>"><? echo "<span class='mybutton'>DOWNLOAD</span><br><hr width=100% size=1px color='#e9e9e9'>";}
				
				if(stripos($filename, 'doc') !== FALSE){

				 echo "&nbsp;&nbsp;<img src='statefiles/doc.jpg' width=40 height=40 />&nbsp;" .$filename. "<br><hr width=100% size=1px color='#e9e9e9'>"; ?></a></td>
                <td align="right"  valign="bottom"><a href="<? echo "statefiles/uploads/".$filename.'"'; ?>"><? echo "<span class='mybutton'>DOWNLOAD</span><br><hr width=100% size=1px color='#e9e9e9'>";} ?></a></td>
              </tr>
            </table>
		
            </td>
            </tr>
            <?php	}
		?>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"><tr><td><table width="100%" border="0">
  <tr>
    <td align="center" class="mytopmenu"><a href="faq.php">FAQ</a>| <a href="#">Help</a>| <a href="IGR Dashboard How-to-Guide.pdf" target="new">User Guide</a>| <a href="contactform.html" target="new">Contact Us</a></td>
  </tr>
  <tr>
    <td align="center" class="myfooter">&copy;2016 - 2017 Nigeria Governors' Forum </td>
  </tr>
</table></td></tr></table>
</body>
</html>