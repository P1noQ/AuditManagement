<!DOCTYPE HTML>
<html>

<head>
  <title>simplestyle_6 - a page</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body>

<?php
if (isset($_POST['ChangePicU'])){
	ChangePic();
}

function ChangePic()
{
	$con = @mysql_connect('localhost','root','');
 	mysql_select_db("ebrahim", $con);

	if (isset($_FILES['imageChange']) && $_FILES['imageChange']['size'] > 0) 
	{
		$tmpUP = $_FILES['imageChange']['tmp_name'];

		$fptup = fopen($tmpUP, 'r');
		$logup = fread($fptup, filesize($tmpUP));
		$logup = addslashes($logup);
		fclose($fptup);

		$upim="update users set image='$logup' where name='$_COOKIE[user]'";
		mysql_query($upim) or die(mysql_error());

	}
	else 
	{
		print "No Picture selected/uploaded";
	}
}

?>
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
         				<li><a href='#'>Audit checklist</a></li>
         				<li class='last'><a href='#'>audit report</a></li>
         				<li class='last'><a href='#'>CAP</a></li>
         				<li class='last'><a href='#'>Result</a></li>
         				<li class='last'><a href='#'>Review</a></li>
      				</ul>
   			</li>
		</ul>
	</div>
	  <li><a href='define-the-scope.php'>Manage Users</a></li>
          <li class='selected'><a href='Setting.php'>Setting</a></li>
	
	  <li style='width:75px'>";

		if(isset($_COOKIE["user"]))
		{	echo '<form action="php.php" method="post">';
				echo "<input type='submit' name='sub' value='Log out' style='height:30px;width:70px;background-color:whitesmoke;border-radius:6px 6px 6px 6px' />";
			echo '</form>';
		}

	 echo '</li>';
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
		<li class='selected'><a href='Setting.php'>Setting</a></li>
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
      <div id="sidebar_container">


      </div>
      <div id="content">
	<form action="Setting.php" method="post">
	<?php
	$con = @mysql_connect('localhost','root','');
 	mysql_select_db("ebrahim", $con);
	
	$WName=$_COOKIE['user'];

	$qry="select Name,family,MobileNum,Email from users where Name='$WName'";
	$RES= mysql_query($qry) or die(mysql_error());

	while($row=mysql_fetch_array($RES))
	{
		
		$name=$row['Name'];
		$family=$row['family'];
		$email=$row['Email'];
		$mobile=$row['MobileNum'];	
	
		echo "
		Name : <span style='margin-left:5%'> $name </span>
		</br></br>
		Family : <span style='margin-left:4%'> $family </span>
		</br></br>
		Mobile : <span style='margin-left:4%'> <input type='text' name='change' style='width:17%' value='$mobile' /></span>
		</br></br>
		Email : <span style='margin-left:5%'> $email </span>
		</br></br></br>
		<input type='submit' name='changeM' value='changemobile' style='width:17%;height:20%;margin-left:12%'/>
		";
		
		if(isset($_POST['change']))
		{
			$MobUpdate=$_POST['change'];

			$qury="update users set MobileNum='$MobUpdate' where name='$_COOKIE[user]'";
			mysql_query($qury) or die(mysql_error());

		}
	}
	
	mysql_close($con);
	?>
	</form>

	<form action="php.php" method="post">

	</br></br></br></br><hr></br></br></br>
	
	current password : <input type='password' name='CurrentP' style='margin-left:12% ' />	

	</br></br></br>

	New password : <input type='password' name='NewP' style='margin-left:15% ' />
	
	</br></br></br>

	confirm password : <input type='password' name='ConfirmP' style='margin-left:12% ' />

	</br></br></br>

	<input type='submit' style='margin-left:37.5%;width:15%;height:30px;font-size:12px' value='submit change' name='ChangePass'>
	</form>
	<?php
		if(isset($_COOKIE['SuccessC']))
		{
			echo "</br></br></br></br>"."<span style='margin-left:29%'>".$_COOKIE['SuccessC']."</span>";
		}
		if(isset($_COOKIE['ErrorPass']))
		{
			echo "</br></br></br></br>"."<span style='margin-left:29%'>".$_COOKIE['ErrorPass']."</span>";
		}
		
		if(isset($_COOKIE['Notmatch']))
		{
			echo "</br></br></br></br>"."<span style='margin-left:29%'>".$_COOKIE['Notmatch']."</span>";
		}
	 ?>
	</br></br></br><hr></br></br>
	<form enctype="multipart/form-data" action="Setting.php" method="post" name="changer">
		Change Your Picture : <input name="MAX_FILE_SIZE" value="102400000" type="hidden">
		<input name="imageChange" accept="image/jpeg" style='margin-left:10%' type="file">
	
		</br>
		</br>
		</br>
		</br>
		<input type='submit' name='ChangePicU' value='change pic' style='margin-left:31%;width:15%;height:40px;font-size:14px'/>

	</form>

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
