<!DOCTYPE HTML>
<html>

<head>
  <title>simplestyle_6 - contact us</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <script src="style/js.js" type="text/javascript"></script>
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
	  <li class='selected'><a href='create-form.php'>Create form</a></li>
          <li><a href='define-the-scope.php'>Manage Users</a></li>
          <li><a href='result.php'>Results</a></li>
          <li><a href='Review.php'>Reviews</a></li>";	
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
	  <li class='selected'><a href='create-form.php'>Create form</a></li>
          
          <li><a href='Review.php'>Reviews</a></li>";	
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

        <div class="sidebar">
          <div class="sidebar_top"></div>
          <div class="sidebar_item">
            <h3>Useful Links</h3>
            <ul>
              <li><a href="audit-plan.php">audit plan</a></li>
              <li><a href="audit-notification.php">audit notification</a></li>
              <li><a href="audit-checklist.php">audit checklist</a></li>
              <li><a href="internal-audit-report.php">internal audit report</a></li>
            </ul>
          </div>

          <div class="sidebar_base"></div>
        </div>
        
      </div>
      <div id="content">
        
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
