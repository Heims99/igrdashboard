<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$faacYear=$_GET["faacYear"]; //echo $faacYear;
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}  
$sql =mysqli_query($con, "SELECT * from faacMonthly WHERE faacYear='$faacYear'"); //echo $sql;
$faq = $db_handle->runQuery($sql); echo $faq;
//$faq = $sql; echo $faq;
?>
<html>
    <head>
      <title>PHP MySQL Inline Editing using jQuery Ajax</title>
		<link rel="stylesheet" href="../style.css" />
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "saveedit.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		</script>
    </head>
    <body>	
    
          
	   <table border="0" align="center" cellpadding="2" cellspacing="1" class="outer_table">
		  <thead>
          <tr><td colspan="15"><p>You are viewing FAAC data for <?php echo $faacYear; ?> <br>
      To change/edit/update/delete any entry, click inside a cell and make your changes. Click outside the table when you are done.</p></td></tr>
			  <tr>
				<th width="2%">SN.</th>
				<th>State</th>
				<th>Jan</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Apr</th>
                <th>May</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Aug</th>
                <th>Sep</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dec</th>
                <th>FAAC Year</th>
			  </tr>
		  </thead>
		  <tbody>
		  <?php
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr class="status_tr">
				<td><?php echo $k+1; ?></td>
				<td contenteditable="true" onBlur="saveToDatabase(this,'state','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["state"]; ?></td>
				<td contenteditable="true" onBlur="saveToDatabase(this,'january','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["january"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'february','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["february"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'march','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["march"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'april','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["april"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'may','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["may"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'june','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["june"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'july','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["july"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'august','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["august"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'september','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["september"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'october','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["october"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'november','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["november"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'december','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["december"]; ?></td>
                <td contenteditable="true" onBlur="saveToDatabase(this,'faacYear','<?php echo $faq[$k]["faacMonthlyId"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["faacYear"]; ?></td>
			  </tr>
		<?php
		}
		?>
		  </tbody>
		</table>
        

        
    </body>
</html>
