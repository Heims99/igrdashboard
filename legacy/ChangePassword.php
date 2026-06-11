<?php
//Session starts here
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
<title>User</title>
<link rel="stylesheet" href="" type="text/css">
<link href="ngf_survey/style.css" rel="stylesheet" type="text/css" />
<script src="" type="text/javascript">
  </script>
<script src="" type="text/javascript" charset="utf-8">

 </script>
<script type="text/javascript" src=""></script>
<script src="" type="text/javascript" charset="utf-8"></script>
<script src="" type="text/javascript" charset="utf-8"></script>
<script>

        jQuery(document).ready(function(){
              // binds form submission and fields to the validation engine
              jQuery("#frmEvent").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});

            });
        </script>
</head>

<body>
<div class="container">
            
                                
                                
                 <form action="change.php" method="post" name="frmEvent" id="frmEvent"  style="Width:100%; ">
<div class="main">
 
  <table width="100%" cellpadding="0px" >
  <tr><td colspan="2"><h2>Change Password</h2><hr/></td><tr>
    <tr>
     <td width="25%">
  <label for="txtPassword" >Password:</label>
  </td>
  <td>
      <input class=""  type="password" name="txtPassword" id="txtPassword" style="width:80%;"  />
      </td>
     
          </tr>
      
       <tr>
     <td width="25%">
  <label for="txtnewPassword" > New Password:</label>
  </td>
  <td>
      <input class=""  type="password" name="txtnewPassword" id="txtnewPassword" style="width:80%;"  />
      </td>
     
          </tr>
          
           <tr>
     <td width="25%">
  <label for="txtConfirm" > Confirm Password:</label>
  </td>
  <td>
      <input class=""  type="password" name="txtConfirm" id="txtConfirm" style="width:80%;"  />
      </td>
     
          </tr>
      
      <tr>
      
         <tr>
  
          
     
      
      <tr>
      
       <tr>
      
      <td colspan="2"   align="center"><input type="submit" name="btnSave" id="btnSave" value="Update"/><input  type="reset" value="Reset" /> </td>
      </tr>
      </table>
      
      
 
   
</div>

</form> 

</div>
</body>
</html>