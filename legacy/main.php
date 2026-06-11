<?php
session_start();
include_once 'connection.php';

if(!isset($_SESSION['user']))
{
 header("Location: login.php");
}
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrative Center</title>

 <script type="text/javascript">
 var loadNewPages = function (url,dtitle, module, iconClass)
         {
			 var Pages = Ext.getCmp('start-panel')
             var tab = Pages.getItem(module + ";" + url);
             
            if (!tab) {
                tab = Pages.add({
					xtype:'iframepanel',
                    id: module + ";" + url,
                    title: dtitle,
                    closable: true,
                   	defaultSrc:url.split(';')[0]
                      
                });
				
            }
            else
            {
				tab.defaultSrc = url.split(';')[0];
                tab.getUpdater().refresh();   
            }
            
		   Pages.doLayout();
           Pages.setActiveTab(tab);
        }
 </script>
    

    <!-- ** Javascript ** -->
    <!-- ExtJS library: base/adapter -->
    <script type="text/javascript" src="js/adapter/ext/ext-base.js"></script>
    <link rel="stylesheet" type="text/css" href="resources/css/ext-all.css" />
    <script type="text/javascript" src="js/ext-all.js"></script>
   
     <script type="text/javascript" src="js/layout-browser.js"></script>
     <script type="text/javascript" src="js/miframe.js"></script> 

    <!-- example code -->

    <link rel="stylesheet" type="text/css" href="css/layout-browser.css">
    <link href="ngf_survey/style.css" rel="stylesheet" type="text/css" />

    <!-- GC -->


    <!-- page specific -->
   
   
    

</head>

<body>
 <div style="display:none;">

 <!-- Start page content -->
        <div id="start-div">
             <?php //echo $userRow['username']; ?>
        </div>


</div>
</body>
</html>