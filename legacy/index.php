<?php
session_start();
include_once 'connection.php';

if(!isset($_SESSION['user']))
{
 header("Location: homengf.php");
}
$connection = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!");
$db = mysqli_select_db($connection, "nggovern_dashboard");
$res=mysqli_query($connection, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, $db);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="NGF IGR Dashboard">
<meta name="keywords" content="IGR,NGF,Dashboard,Tax,Allocation,Revenue">
<meta name="author" content="Maduka Okafor">
<title>Welcome To NGF IGR Dashboard - <?php echo $userRow['state']; ?></title>
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
#grad1 {
    height: 4px;
    background: white; /* For browsers that do not support gradients */
    background: linear-gradient(to right, green , yellow, white); /* Standard syntax (must be last) */
}
#grad2 {
    height: 20px;
    background: white; /* For browsers that do not support gradients */
    background: linear-gradient(to right, white , green); /* Standard syntax (must be last) */
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
<li><a href="#">Home</a></li>
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
            <td width="1%" valign="bottom"><img src="images/bullet.png" width="20" height="20" /></td><td><div id="grad2"><h3>Welcome to the Nigeria Governors' Forum IGR Dashboard</h3></div></td>
            
          </tr>
          <tr><td colspan="2"><div id="grad1"></div></td></tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="2" cellpadding="10">
        
        <tr><td width="5%" bgcolor="#93C840"></td><td bgcolor="#0D8040">
<font color="#FFFFFF"><p align="justify">The IGR Dashboard was launched by the Nigeria Governors’ Forum on February 15, 2017, as one of its flagship programmes to support State governments raise domestic revenues.</p>
<p align="justify">The platform is designed to assess the tax/revenue environment of States, track the impact of tax reforms, and facilitate the sharing of commendable practices through peer learning and technical assistance.
</p>
</font>
</td><td width="1%" bgcolor="#C1C2C4"></td></tr></table>

<tr><td><table width="100%" border="0">
          <tr>
            <td width="1%" valign="bottom"><img src="images/bullet.png" width="20" height="20" /></td><td><div id="grad2"><h3>How It Works</h3></div></td>
            
          </tr>
          <tr><td colspan="2"><div id="grad1"></div></td></tr>
        </table></td></tr>

<tr><td><table width="100%" border="0" cellspacing="2" cellpadding="10"><tr><td width="5%" bgcolor="#93C840"></td><td bgcolor="#0D8040">

<font color="#FFFFFF"><p align="justify">The Dashboard provides real time access to all 36 States’ Internal Revenue Service (SIRS) to regularly maintain and track data on tax administration, tax processing, tax procedures, tax enforcement as well as monthly internally generated revenues.</p>
<p align="justify">The NGF Secretariat drives the operation of the programme and supports the implementation and monitoring of recommended actions of the Dashboard, including those agreed at Joint Tax Board (JTB) meetings.</p>
<p align="justify">The platform also provides evidence to drive strong political commitment from State Governors in the implementation of needed reforms.</p></font></td><td width="1%" bgcolor="#C1C2C4"></td></tr></table></td></tr>
        
        <tr><td width="100%" bgcolor="" align="center"><iframe width="1237" height="291.5" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSMzpRzxvBm1EQYR_cUBKrBnenRmb3sOH4dZjhaAnDWK1o4w7_vc2e7Tc45V_J_QmZw4GY6FkOIq3Zt/pubchart?oid=231624236&amp;format=interactive"></iframe></td></tr>
        <tr><td width="100%" bgcolor="" align="center"><iframe width="1237" height="292" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSMzpRzxvBm1EQYR_cUBKrBnenRmb3sOH4dZjhaAnDWK1o4w7_vc2e7Tc45V_J_QmZw4GY6FkOIq3Zt/pubchart?oid=513088522&amp;format=interactive"></iframe></td></tr>
          <tr><td width="100%" bgcolor="" align="center"><iframe width="1237" height="292" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTWySUaWmQGWzbiXtcx75WvXUaeMMNJTvIhW2uaXcw0_---VZQlu2MaKXFjWa2xXQBWTCd_7wWjwOtj/pubchart?oid=1953004448&format=interactive"></iframe></td></tr>
        <tr><td bgcolor="" align="center"><iframe width="1237" height="291.5" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTWySUaWmQGWzbiXtcx75WvXUaeMMNJTvIhW2uaXcw0_---VZQlu2MaKXFjWa2xXQBWTCd_7wWjwOtj/pubchart?oid=1335958749&amp;format=interactive"></iframe></td></tr>
        
<tr><td><table width="100%"><tr><td width="1%" valign="bottom"><img src="images/bullet.png" width="20" height="20" /></td><td><div id="grad2"><b><font color="green">The Dashboard Process</font></b></div></td></tr></table></td></tr>
        <tr>
          <td align="center">
            <img src="images/Dashboard Steps.jpg" width="830" height="543" usemap="#Map2" border="0" /></td></tr>
              <tr><td><table width="100%"><tr><td width="1%" valign="bottom"><img src="images/bullet.png" width="20" height="20" /></td><td><div id="grad2"><b><font color="green">The IGR Dashboard Framework</font></b></div></td></tr></table></td></tr>
        <tr><td align="center">
              <img src="images/infograph 2-01.jpg" width="1300" height="626" /></td></tr>
        
    </table></td>
  </tr>
</table>
<table width="100%"><tr><td><table width="100%" border="0">
  <tr>
    <td align="center" class="mytopmenu"><a href="faq.php">FAQ</a>| <a href="help.php">Help</a>| <a href="IGR Dashboard How-to-Guide.pdf" target="new">User Guide</a>| <a href="contactform.php" target="new">Contact Us</a></td>
  </tr>
  <tr>
    <td align="center" class="myfooter">&copy;2016 - 2017 Nigeria Governors' Forum </td>
  </tr>
</table></td></tr></table>

<map name="Map2" id="Map2">
  <area shape="rect" coords="565,207,684,223" href="home.php?logout" target="new" alt="click here to fill quarterly questionnaire for your state" onmouseover="click here to fill quarterly questionnaire for your state" />
  <area shape="rect" coords="680,171,750,189" href="home.php?logout" target="new" alt="click here to fill quarterly questionnaire for your state" onmouseover="click here to fill quarterly questionnaire for your state" />
  <area shape="rect" coords="565,187,645,206" href="home.php?logout" target="new" alt="click here to enter monthly data for your state" onmouseover="click here to enter monthly data for your state" />
  <area shape="rect" coords="670,189,734,205" href="home.php?logout" target="new" alt="click here to enter monthly data for your state" onmouseover="click here to enter monthly data for your state" />
</map>
</body>
</html>