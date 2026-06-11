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
<title>FAQ - <?php echo $userRow['state']; ?></title>
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
<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
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
            <td><h3>Frequently Asked Questions (FAQ)</h3></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr><td></td></tr>
          <tr>
            <td><div id="CollapsiblePanel1" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">1.	What is the IGR Dashboard?</div>
              <div class="CollapsiblePanelContent">The IGR Dashboard is an online platform that assesses the tax/revenue environment of States; tracks the impact of policy reforms; and facilitates the replication of commendable practices across the 36 States of Nigeria – through research, evidence and peer learning.</div>
            </div></td>
            </tr>
          <tr>
            <td><div id="CollapsiblePanel2" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">2.	What are the benefits of the Dashboard to my State and BIR?</div>
              <div class="CollapsiblePanelContent">The Dashboard seeks to promote (i) the use of evidence and policy analysis, (ii) the prioritization of tax/revenue issues by Governors; and (iii) increased capacity of State governments to address domestic revenue challenges. The primary objective is to increase internally generated revenue and improve the tax environment of the 36 States of the federation through strong decision-maker engagement.</div>
            </div></td>
            </tr>
          <tr>
            <td><div id="CollapsiblePanel3" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">3.	How do States access the Dashboard?</div>
              <div class="CollapsiblePanelContent">The Dashboard is accessible via the www.nggovernorsforum/igrdashboard url or directly from the Nigeria Governors’ Forum homepage.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel4" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">4.	Who can view the information on the Dashboard?</div>
              <div class="CollapsiblePanelContent">The Dashboard is an exclusive platform for the 36 States’ Boards of Internal Revenue (SBIR) and the Joint Tax Board (JTB). The portal is managed by the Nigeria Governors’ Forum Secretariat.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel5" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">5.	What is the role of SBIRs on the Dashboard?</div>
              <div class="CollapsiblePanelContent">States are required to update monthly IGR data and quarterly questionnaires on the Dashboard. These updates will provide the bedrock of information for preparing monthly reports and recommendations for Governors and SBIRs.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel6" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">6.	When do I upload my State’s monthly data and complete the quarterly questionnaire?</div>
              <div class="CollapsiblePanelContent">Updates should be submitted by the 5th of every month to enable the Dashboard team provide an analysis of submissions and allow sufficient time for discussions with the State SBIR, prior to its presentation to the State Governor at the monthly NGF meeting.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel7" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">7.	When can I view an analysis of my submission?</div>
              <div class="CollapsiblePanelContent">Once a State has completed and submitted its monthly data and quarterly questionnaire, results can be viewed within 24 hours of submission.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel8" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">8.	What is the nature of my State’s report to my Governor?</div>
              <div class="CollapsiblePanelContent">State reports will consist of three major sections – key findings, data analytics and major recommendations.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel9" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">9.	Can I view my State’s report prior to its presentation to my Governor?</div>
              <div class="CollapsiblePanelContent">States can view an analysis of their submissions within 24 hours of submission.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel10" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">10.	How do I revise an incorrect entry made into the questionnaire or monthly data section?</div>
              <div class="CollapsiblePanelContent">Once a questionnaire has been submitted, States will be unable to edit such entries. In the event that an incorrect entry was made, this can be brought to the notice of the Dashboard Manager via the contact form.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel11" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">11.	What happens if I do not complete my State’s report on time?</div>
              <div class="CollapsiblePanelContent">If a State is unable to update its data on time, the State’s report will not be developed for that period. The State Governor’s report will state that data was not provided for reporting.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel12" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">12.	How can I get a key message to my Governor?</div>
              <div class="CollapsiblePanelContent">Key messages can be provided in the additional comment section of the Tax Enforcement questionnaire. The Dashboard Manager can also be contacted via the contact form.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel13" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">13.	We do not currently collect some of the data you are asking for, what do I do?</div>
              <div class="CollapsiblePanelContent">States are encouraged to provide details of all data requested. In the event that a data category is unavailable, the State may bring this to the notice of the Dashboard Manager via the contact form to ensure that this is taken into account in the data analysis process.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel14" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">14.	Can I share my login details with other third parties such as my revenue consultants?</div>
              <div class="CollapsiblePanelContent">States are advised to keep their login details personal and accessible to only relevant State officials. In the event that a State’s login detail has been compromised, new details can be provided by contacting the Dashboard Manager via the contact form.</div>
            </div></td>
          </tr>
          <tr>
            <td><div id="CollapsiblePanel15" class="CollapsiblePanel">
              <div class="CollapsiblePanelTab" tabindex="0">15.	What is the NGF HelpDesk?</div>
              <div class="CollapsiblePanelContent">The NGF HelpDesk is a support office in the NGF Secretariat created to provide demand-based support to States in key areas of governance, through knowledge transfer, peer learning, and direct technical assistance.</div>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
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
<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel2");
var CollapsiblePanel3 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel3");
var CollapsiblePanel4 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel4");
var CollapsiblePanel5 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel5");
var CollapsiblePanel6 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel6");
var CollapsiblePanel7 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel7");
var CollapsiblePanel8 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel8");
var CollapsiblePanel9 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel9");
var CollapsiblePanel10 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel10");
var CollapsiblePanel11 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel11");
var CollapsiblePanel12 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel12");
var CollapsiblePanel13 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel13");
var CollapsiblePanel14 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel14");
var CollapsiblePanel15 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel15");
</script>
</body>
</html>