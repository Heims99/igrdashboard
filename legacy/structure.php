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
            <td align="right" class="mytopmenu"><a href="help.php">Foreword</a>&raquo;<a href="overview.php">Overview</a>&raquo;<a href="environment.php">Environment</a>&raquo;<a href="#">Structure</a>&raquo;<a href="functionality.php">Functionality</a>&raquo;<a href="genreport.php">Generating Reports</a>&raquo;<a href="navigation.php">Navigation</a>&raquo;<a href="access.php">Access</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td width="50%"><b>HOME PAGE STRUCTURE</b></td>
            <td align="right" class="mytopmenuhelp"><a href="environment.php">Previous</a><a href="help.php">Top</a><a href="functionality.php">Next</a></td>
          </tr>
          <tr>
            <td colspan="2"><ul><li>The purpose of this section is to define the structure, functions and features of the NGF IGR Dashboard Home page.</li>
            </ul>
            </td>
            </tr>
          <tr>
            <td colspan="2"><b>Portal Interface</b></td>
          </tr>
          <tr>
            <td colspan="2"><ul><li>This feature is the "Home" page component of the dashboard. It is the entrance to the states' IGR data world. The options generally available to authorized users will be accessible through a combination of menu options, general content, and links to relevant information.</li><br />
            <li>External users such as remote state personnel, development partners, international donors, and other authorized individuals will access the dashboard to access information related to revenue generation/allocation 
within the state and/or their area of interest.</li>
            </ul>
              <blockquote>
                <p><em>interface image here</em></p>
              </blockquote></td>
          </tr>
          <tr>
            <td colspan="2"><b>Security</b></td>
          </tr>
          <tr>
            <td colspan="2"><ul><li>Two types of security are implemented to control access to the documents and data and the capabilities of the dashboard. Authentication, and function access controls have been implemented to satisfy the security requirements.<ul><br /><li>Authentication – A Username and Password is required to access the features of the dashbaord which interface directly with the NGF IGR repository. The features which will require authentication include:<ul><br /><li>Data Query</li><li>Analytics/Reports</li><li>Downloadable Resources</li></ul></li><br />
            <li>Function Access Controls – Additional Function Access Controls (FAC) will be created in the existing NGF IGR database which will control the ability for users to access the different features of the dashboard. The FAC's to be created include Questionnaire Access; Monthly Data Updates; Data Uploads; User Management.</li></ul></li></ul>
</td>
          </tr>
          <tr>
            <td colspan="2"><b>Home Page Features</b></td>
          </tr>
          <tr>
            <td colspan="2"><ul><li>The Home Page of the NGF IGR Dashboard is the user's interface to the Web Portal application. The structure is a combination of static content, links to related pages, dynamic content, and restricted access to features for accessing data and documents residing in the NGF IGR repository will be accessible through this interface.</li>
              </ul>
              <blockquote>
                <p><em>home page image here</em></p>
              </blockquote></td>
          </tr>
          <tr>
            <td colspan="2"><b>Home Page Template</b></td>
          </tr>
          <tr>
            <td colspan="2"><ul><li>Template Features<ul><br /><li>This is the basic NGF IGR Dashboard Home Page template used to access, manipulate, view, display, print and save aspects of the major dashboard functions. This portion of the dashboard screen appears no matter what is in the blank portion of the screen (an exception is the user logon hyperlink which will read "Sign Out" when the user is logged on).</li><br /><li>A valid user, when logged on, can access the major functions (download a resource/document, IGR and allocation data and analytics, reports), FAQ, Help, Manuals, Contacts and Links.</li><br /><li>When logged onto the Dashboard, anyone can access all the menu links and pages.</li></ul></li><br /><li>The Home hyperlink can be used by any user to return to the Home page from any Dashboard screen in the Dashboard application.</li></ul>
              <blockquote>
                <p><em>template image here</em></p>
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