<?php
session_start();
include_once 'connection.php';

if(!isset($_SESSION['user']))
{
 header("Location: login_front.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="NGF IGR Dashboard">
<meta name="keywords" content="IGR,NGF,Dashboard,Tax,Allocation,Revenue">
<meta name="author" content="Maduka Okafor">
<title>NGF IGR Dashboard Help - <?php echo $userRow['state']; ?></title>
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
    <td><img src="images/NGF_logo.png" width="353" height="129" /></td>
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
            <td><h3>Nigeria Governors' Forum IGR Dashboard Help Document</h3></td>
            <td align="right" class="mytopmenu"><a href="help.php">Foreword</a>&raquo;<a href="overview.php">Overview</a>&raquo;<a href="#">Environment</a>&raquo;<a href="structure.php">Structure</a>&raquo;<a href="functionality.php">Functionality</a>&raquo;<a href="genreport.php">Generating Reports</a>&raquo;<a href="navigation.php">Navigation</a>&raquo;<a href="access.php">Access</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td width="50%"><b>ENVIRONMENT</b></td>
            <td align="right" class="mytopmenuhelp"><a href="overview.php">Previous</a><a href="help.php">Top</a><a href="structure.php">Next</a></td>
          </tr>
          <tr>
            <td colspan="2"><ul><li>The purpose of this section is to graphically depict the Hardware, Network and processing flow of requests for states' revenue reports, federation allocation data and reports.</li>
            </ul>
            <p>&nbsp;</p>
            </td>
            </tr>
          <tr>
            <td colspan="2"><b>Hardware and Network</b></td>
          </tr>
          <tr>
            <td colspan="2"><ul><li>The following diagram is a representation of the expected hardware and networking configuration needed to support the NGF IGR Dashboard.</li>
            </ul>
              <blockquote>
                <p><em>hardware/network diagram here</em></p>
              </blockquote></td>
          </tr>
          <tr>
            <td colspan="2"><b>Dashboard Processing Flow</b></td>
          </tr>
          <tr>
            <td colspan="2"><ul><li>The following flowchart is a representation of the expected flow of processing for users of the NGF IGR Dashboard.</li></ul>
              <blockquote>
                <p><em>flowchart diagram here</em></p>
              </blockquote></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"><tr><td><table width="100%" border="0">
  <tr>
    <td align="center" class="mytopmenu"><a href="faq.php">FAQ</a>| <a href="#">Help</a>| <a href="IGR Dashboard How-to-Guide.pdf" target="new">User Guide</a>| <a href="contactform.php" target="new">Contact Us</a></td>
  </tr>
  <tr>
    <td align="center" class="myfooter">&copy;2016 - 2017 Nigeria Governors' Forum </td>
  </tr>
</table></td></tr></table>
</body>
</html>