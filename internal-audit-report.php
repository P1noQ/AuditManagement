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

		$result3 = mysql_query("SELECT * FROM section");
	
		$result4 = mysql_query("select users.id,users.name as Name,users.family from userinrole inner join users on users.id=userinrole.userid inner join role on role.id=userinrole.roleid where role.id=1");

		function CreateAuditplaneform()
		{
			$query="select auditees.CompanyName as Company ,auditees.Logo,Scope.Scope_Name, form_audit_plan.Name,form_audit_plan.Date_Of_Audit, au1.Name, au2.Name, au3.Name, au4.Name, au5.Name, au6.Name, au7.Name from form_audit_plan inner join auditees on auditees.id=form_audit_plan.CompanyId inner join Scope on Scope.id=form_audit_plan.ScopeId inner join auditor_in_sec on auditor_in_sec.id=form_audit_plan.auditors inner join users au1 on au1.id=auditor_in_sec.Auditor1 inner join users au2 on au2.id=auditor_in_sec.Auditor2 inner join users au3 on au3.id=auditor_in_sec.Auditor3 inner join users au4 on au4.id=auditor_in_sec.Auditor4 inner join users au5 on au5.id=auditor_in_sec.Auditor5 inner join users au6 on au6.id=auditor_in_sec.Auditor6 inner join users au7 on au7.id=auditor_in_sec.Auditor7 where form_audit_plan.Name='$_POST[Wal]' ";
			$Result=mysql_query($query) or die(mysql_error());

			echo 'document.getElementById("tabl").innerHTML =';echo'"';echo "<tr><td><center>Company</center></td><td><center>LOGO</center></td><td><center>Scope</center></td><td><center>Project Started On</center></td><td><center>Project Name</center></td><td><center>Auditors</center></td><td><center>Report</center></td></tr>";echo'";';
			echo 'document.getElementById("tabl").innerHTML +="';echo '<tr><td><center>'; while($Row=mysql_fetch_array($Result)){echo $Row['Company'];} ;echo '</center></td>';echo '<td>';echo'<center>';echo'</center>'; echo '</td><td><center></center></td><td><center></center></td><td><center></center></td><td><center></center></td><td><center><textarea></textarea></center></td></tr>'; echo '";';
		}
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
	
	sleep(10);
	header('Location: http://localhost/Ebrahim/index.php');
	}
  if($_COOKIE["role"]==2)
	{
	
	
	}
  if($_COOKIE["role"]==1)
	{
	
	
	header('Location: http://localhost/Ebrahim/index.php');
	}
}
else
{
header('Location: http://localhost/Ebrahim/index.php');
}


?>
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
	<li><a href='Setting.php'>Setting</a></li>";
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
	<form action="internal-audit-report.php" method="post">
	<?php
		$con = @mysql_connect('localhost','root','');
 		mysql_select_db("ebrahim", $con);

		$qry="select * from form_audit_plan";
		$RES= mysql_query($qry) or die(mysql_error());
		while($row=mysql_fetch_array($RES))
		{
			echo "Form : "."<input type='submit' value='$row[Name]' name='Wal' style='background-color:khaki'>"."</br></br>";
		}
		
		
	 ?>
	</form>
		<style>
			#tabl{
				width:140%;
				background-color:black;

				font-size:12px
			}
			#sdgv{width:140%;
				background-color:black;

				font-size:12px}

			.conform{
				float:left;
				list-style:none;
				width:100px
			}

		</style>

		<div style="list-style:none;width:100%">
		
		</div>
	</br>
		<table id="tabl">
			<tr>
				<td>
					<center>Company</center>
				</td>
				<td>
					<center>LOGO</center>
				</td>
				<td>
					<center>Scope</center>
				</td>
				<td>
					<center>Project Started On</center>
				</td>
				<td>
					<center>Project Name</center>
				</td>
				<td>
					<center>Auditors</center>
				</td>
				<td>
					<center>Report</center>
				</td>
			</tr>
		</table>
	<?php
		if(isset($_POST['Wal']))
		{
			echo "<script>";
			CreateAuditplaneform($_POST['Wal']);
			echo "</script>";
		}
	?>
			
		<input type="submit" name="SaveRows" value="Send" />
      </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">


      <p><a href="index.html">Home</a> | <a href="create-user.html">Create User</a> | <a href="create-form.html">Create Form</a> | <a href="define-the-scope.html">Define The Scope</a> | <a href="result.html">Results</a> | <a href="Review.html">Reviews</a></p>
      <p>Copyright &copy; Management Users WebApplication | <a href="http://www.iigroup.ir">designed by iigroup.ir</a></p>
    </div>
    <p>&nbsp;</p>
  </div>
</body>
</html>
