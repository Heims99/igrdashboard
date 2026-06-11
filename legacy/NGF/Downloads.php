<?php
session_start();
include_once '../connection.php';
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$connection = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!");
$db = mysqli_select_db($connection, "nggovern_dashboard");
$res=mysqli_query($connection, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, $db);
?><?php include('_header.php') ?>
<div class="mb-4 container shadow_bg py-4">
    <div class="col text-left">
        <p class="green">Nigeria Governors' Forum IGR Dashboard Downloads - MY REPORTS</p>
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
        <p class="small_text">
            <a href="<? echo "statefiles/uploads/".$filename.'"'; ?>"><? if(stripos($filename, 'pdf') !== FALSE){

				 echo "&nbsp;&nbsp;<img src='../statefiles/images.png' width=40 height=40 />&nbsp;" .$filename. ""; ?></a>
                <a href="<? echo "statefiles/uploads/".$filename.'"'; ?>"><? echo " | <span class='mybutton'>DOWNLOAD</span>";}
				
				if(stripos($filename, 'doc') !== FALSE){

				 echo "&nbsp;&nbsp;<img src='statefiles/doc.jpg' width=40 height=40 />&nbsp;" .$filename. ""; ?></a>
                <a href="<? echo "statefiles/uploads/".$filename.'"'; ?>"><? echo " | <span class='mybutton'>DOWNLOAD</span>";} ?></a>
              
            <?php	}
		?>
        </p>
    </div>
</div>
<div class="mb-4 container shadow_bg py-4">
    <div class="col text-left">
        <p class="green">How it works</p>
        <p>The Dashboard provides real time access to all 36 States’ Internal Revenue Service (SIRS) to regularly maintain and track data on tax administration, tax processing, tax procedures, tax enforcement as well as monthly internally generated revenues.

The NGF Secretariat drives the operation of the programme and supports the implementation and monitoring of recommended actions of the Dashboard, including those agreed at Joint Tax Board (JTB) meetings.

The platform also provides evidence to drive strong political commitment from State Governors in the implementation of needed reforms.</p>
    </div>
</div>
    

<?php include('_footer.php') ?>

<script>
        $('a[href="Downloads"]').addClass('active')
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