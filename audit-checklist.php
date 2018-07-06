<!DOCTYPE HTML>
<html>

<head>
  <title>simplestyle_6 - contact us</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <script src="style/js.js" type="text/javascript"></script>

<script> 
		<?php
		$con = @mysql_connect("localhost","root","");
		
		mysql_select_db("Ebrahim", $con);

		$result2 = mysql_query("SELECT * FROM statous");
		$result4 = mysql_query("SELECT * FROM audit_checklist_title");

		echo'
			function CreateAuditplaneform(number) {
			document.getElementById("tabl").innerHTML ="<tr><td><center>No.</center></td><td><center>Title</center></td><td><center>Reference</center></td><td><center>Description</center></td><td><center>Status</center></td><td><center>Finding</center></td></tr>";
			for(i=1;i<=number;i++)
			{';
				echo 'document.getElementById("tabl").innerHTML +=';echo '"<tr>';echo '<td>"+i+"</td>';$alef='"+i+"';echo '<td>'; echo "<center><select name='Title$alef' style='width:180px;height:60px'>";while($rows = mysql_fetch_array($result4)){echo "<option value='$rows[id]'>";echo $rows['Title'];echo '</option>';};echo '</select></center>';echo '</td>';echo "<td><center><textarea rows='5' name='Reference$alef' cols='7'></textarea></center></td>";echo "<td><center><textarea rows='5' name='Description$alef' cols='7'></textarea></center></td>";echo '<td>'; echo "<center><select name='Status$alef' style='width:90px'>";while($rowasa = mysql_fetch_array($result2)){echo "<option value='$rowasa[id]'>";echo $rowasa['status_type'];echo '</option>';};echo '</select></center>';echo '</td>';echo "<td><center><textarea rows='9' name='Designation$alef' enable='false'  cols='9'></textarea></center></td>";echo '</tr>"';
        		echo'}
		}';
	
	?>

	</script>


</head>

<body>
<?php

if (isset($_COOKIE["role"]))
{
  if($_COOKIE["role"]==4)
	{
	}
  if($_COOKIE["role"]==3)
	{
	
ob_start();
				
header('Location: http://localhost/Ebrahim/index.php');    //this line works now
ob_end_flush();	
	}
  if($_COOKIE["role"]==2)
	{
	
	
	
	}
  if($_COOKIE["role"]==1)
	{
	
ob_start();
				
header('Location: http://localhost/Ebrahim/index.php');    //this line works now
ob_end_flush();	
	}
}
else
{
header('Location: http://localhost/Ebrahim/index.php');
}


?>

<form action="php.php" method="post">
  <div id="main">
    <div id="header">
<?php 	

	

	if (isset($_COOKIE["user"]))
	{
	$Uso=$_COOKIE['user'];
	$con = @mysql_connect('localhost','root','');
 	mysql_select_db("ebrahim", $con);
	
	
	echo "<div style='margin-right:7.3%;margin-top:0.6%;float:right;'>";

	$qry="select image from users where Name='$Uso'";
	$RES= mysql_query($qry) or die(mysql_error());
	while($row=mysql_fetch_array($RES))
	{	
		echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="130" height="105">';
		echo "</br>"."<span style='color:white;margin-left:14%'>"."user  :  $Uso"."</span>";
		if(isset($_COOKIE["role"]))
		{
			$qrySel="select * from role where id='$_COOKIE[role]'";	
			$ResSel=mysql_query($qrySel) or die(mysql_error());

			while($gol=mysql_fetch_array($ResSel))
			{
				
				$ID=$gol['id'];

				$Name=$gol['RoleName'];

				if($_COOKIE["role"]==$ID)
				{
					echo "</br>"."<span style='color:white;margin-left:30%;'>"."$Name"."</span>";
				}

				else
				{
					echo "no role";
				}
			}
		}
		else
		{
			echo "</br>"."<span style='color:white;margin-left:28%;'>"."no role"."</span>";
		}
	}

	mysql_close($con);

	echo "</div>";
}			
?>
      <div id="logo">
        <div id="logo_text">
          <h1>ebrahim heydarnia</h1>
          <h2>management users WebApplication</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
         
	  <li><a href="index.php">Home</a></li>
        
<?php 

if (isset($_COOKIE["role"]))
{
  if($_COOKIE["role"]==4)
	{
	  
	echo "  
	  <div id='cssmenu'>
		<ul>

			<li class='has-sub'><a href='#'>Audit Proccess</a>
      				<ul>
        				<li><a href='audit-plan.php'>Audit plan</a></li>
         				<li><a href='audit-checklist.php'>Audit checklist</a></li>
         				<li class='last'><a href='internal-audit-report.php'>audit report</a></li>
         				<li class='last'><a href='#'>CAP</a></li>
         				<li class='last'><a href='result.php'>Result</a></li>
         				<li class='last'><a href='Review.php'>Review</a></li>
      				</ul>
   			</li>
		</ul>
	</div>

	<li><a href='define-the-scope.php'>Manage Users</a></li>
	<li><a href='Setting.php'>Setting</a></li>

	";
	
	echo" <li style='width:75px'>";
		if(isset($_COOKIE["user"]))
		{	echo '<form action="php.php" method="post">';
				echo "<input type='submit' name='sub' value='Log out' style='height:30px;width:70px;background-color:whitesmoke;border-radius:6px 6px 6px 6px' />";
			echo '</form>';
		}
	  echo "</li>";

	}
	else if($_COOKIE["role"]==2)
	{
	  
	echo " 
	<div id='cssmenu'>
		<ul>

			<li class='has-sub'><a href='#'>Audit Proccess</a>
      				<ul>
        				
         				<li><a href='audit-checklist.php'>Audit Checklist</a></li>
					<li class='last'><a href='#'>Audit Notification</a></li>
         				<li class='last'><a href='internal-audit-report.php'>Audit Report</a></li>
         				<li class='last'><a href='#'>CAP</a></li>
         				
      				</ul>
   			</li>
		</ul>
	</div>
		";
			
	
		echo " 
		<li><a href='Setting.php'>Setting</a></li>
		";

	
		echo" <li style='width:75px'>";

		if(isset($_COOKIE["user"]))
		{	echo '<form action="php.php" method="post">';
				echo "<input type='submit' name='sub' value='Log out' style='height:30px;width:70px;background-color:whitesmoke;border-radius:6px 6px 6px 6px' />";
			echo '</form>';
		}

	  	echo "</li>";

	}
}
?>

        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="content">

		<style>
			#tabl{
				width:140%;
				background-color:black;

				font-size:12px
			}

			.conform{
				float:left;
				list-style:none;
				width:100px
			}
		</style>

		<div style="list-style:none;width:100%">
			
		<input type="text" id="SendNumber" name="SendNum"/>
		<button type="button" style="width:15%;" onclick="CreateAuditplaneform(SendNumber.value)">create row</botton>

		</div>
	</br>
     		<table id="tabl">
			<tr>
				<td>
					<center>No.</center>
				</td>
				<td>
					<center>Title</center>
				</td>
				<td>
					<center>Reference</center>
				</td>
				<td>
					<center>Description</center>
				</td>
				<td>
					<center>Status</center>
				</td>
				<td>
					<center>Finding</center>
				</td>
			</tr>

		</table>
<input type="submit" name="SaveRowsalo" value="Submit">
      </div>

    </div>


    <div id="content_footer"></div>
    <div id="footer">



      <p><a href="index.html">Home</a> | <a href="create-user.html">Create User</a> | <a href="create-form.html">Create Form</a> | <a href="define-the-scope.html">Define The Scope</a> | <a href="result.html">Results</a> | <a href="Review.html">Reviews</a></p>
      <p>Copyright &copy; Management Users WebApplication | <a href="http://www.iigroup.ir">designed by iigroup.ir</a></p>
    </div>
    <p>&nbsp;</p>
  </div>
</form>
</body>
</html>
