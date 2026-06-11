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
</style>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td><img src="images/NGF_logo.png" width="353" height="129" /></td>
    <td><table width="100%" border="0">
      <tr>
        <td align="right" valign="top" class="mytopmenunew"><div id="content">
         Welcome, <?php echo $userRow['username']; ?> ::<a href="logout_front.php?logout">Sign Out</a>| <a href="home.php?logout">My Admin</a>
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
            <td align="right" class="mytopmenu"><a href="help.php">Foreword</a>&raquo;<a href="overview.php">Overview</a>&raquo;<a href="environment.php">Environment</a>&raquo;<a href="structure.php">Structure</a>&raquo;<a href="functionality.php">Functionality</a>&raquo;<a href="genreport.php">Generating Reports</a>&raquo;<a href="navigation.php">Navigation</a>&raquo;<a href="#">Access</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td width="50%"><b>ACCESS</b></td>
            <td align="right" class="mytopmenuhelp"><a href="navigation.php">Previous</a><a href="help.php">Top</a></td>
          </tr>
          <tr>
            <td colspan="2"><ul><li>After logging on to the PC (if required), the NGF IGR Dashboard can be accessed via the NGF website. Secure access to the function and features requires a valid Username and Password.</li>
            </ul>
            </td>
            </tr>
          <tr>
            <td colspan="2"><b>Logon/Logoff</b></td>
          </tr>
          <tr>
            <td colspan="2"><ul>
              <li>Using any browser of your choice, logon by clicking on the IGR Dashboard menu link from the NGF Web Site. The website address is <b>http://www.nggovernorsforum.org</b>, or logon directly to the IGR Dashboard using <b>http://www.nggovernorsforum.org/igrdashboard</b></li></ul>
              <blockquote>
                <p><img src="images/Screen Shot 2017-03-14 at 8.11.28 AM.png" width="1000" height="259" /></p>
                <p>The NGF IGR Dashboard login screen appears. Enter the <b>"Username"</b> and <b>"Password"</b> as provided to you, by the Dashboard Administrator, in their respective fields and then click <b>"SIGN IN"</b></p>
                <p><img src="images/Screen Shot 2017-03-14 at 8.19.15 AM.png" width="360" height="400" /></p>
                <p>On logon, you would have access to the features of the IGR reports, analytics, and resources.</p>
                <p><img src="images/Screen Shot 2017-03-14 at 8.20.05 AM.png" width="827" height="375" /></p>
                <p>To logoff, click on the <b>&quot;Sign Out&quot;</b> link at the top right  corner of the home screen. Always remember to logout after using the dashboard.</p>
              </blockquote></td>
          </tr>
          <tr>
            <td colspan="2"><b>Admin Login</b></td>
          </tr>
          <tr>
            <td colspan="2"><ul>
              <li>The <b>&quot;Admin Login&quot;</b> give you access to the dashboard's content management console, where states can enter data (via web forms and questionnaires) that forms input to the analytics for the dashbaord.
                <ul><br />
                  <li>To access the content management console - after you must have accessed the dashbaord, click on the <b>&quot;Admin Login&quot;</b> link at the top right corner of the dashboard.                    </li><br />
                  <p><img src="images/Screen Shot 2017-03-14 at 8.44.32 AM.png" width="329" height="400" /></p>
                  <br />
            <li>To logon, enter your state (e.g. Abia, Adamawa, Kogi, Borno, Delta, Lagos, etc); and then enter your default password. If login parameter is correct, you would be able to access the content management console.<br /><br />
              <b>Note: </b>You should endeavour to change your password after your first login to ensure access to you console is authorized. To do this, click on the <b>&quot;User Management&quot;</b> menu by the left of pane on the content management console, and then select <b>&quot;Change Password&quot;</b></li>
            <br />
            <p><img src="images/Screen Shot 2017-03-14 at 8.34.51 AM.png" width="1000" height="500" /></p><br />
            <li>Enter the current password in the <b>&quot;Password&quot;</b> field; enter your new password in the <b>&quot;New Password&quot;</b> field, and then enter same password in the <b>&quot;Confirm Password&quot;</b> field to confirm your new password.</li><br />
            <li>Remember to log off by clicking on the <b>&quot;Sign Out&quot;</b> link at the top right corner, and then re-login with the new password.</li>
                </ul>
              </li></ul>
</td>
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