<!DOCTYPE HTML>
<html>

<head>
  <title>simplestyle_6</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />

</head>

<body>
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
			$forminrole=mysql_query("select * from forminrole");
			while($RT=mysql_fetch_array($forminrole))
			{
				$RoleN=$RT['RoleId'];
				$FormN=$RT['formId'];
	
			
			/*
				$Reselect=mysql_query("select a.formid,form.FormName,scope.Scope_name,a.date_of_audit, section.Section_name,a.reference,users.name,users.family,a.Date from forminrole inner join form on forminrole.formid= form.id inner join role on forminrole.roleid =role.id inner join form_audit_plan a on a.formid = form.id inner join Scope on Scope.id = a.scopeid inner join section on section.id = a.section_id inner join users on users.id=a.Auditors");
					
					while($r=mysql_fetch_array($Reselect))
					{
						if($_COOKIE["role"]==$RoleN && $FormN==$r['formid'])
						{
							echo "$r[Scope_name]";
							echo "$r[date_of_audit]";
							echo "$r[Section_name]";
							echo "$r[reference]";
							echo "$r[name]";
							echo "$r[family]";
							echo "$r[Date]";
						}
					}*/
			}

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

	

          <h1>Audit Management System</h1>
          <h2>Management Users WebApplication</h2>

        </div>
      </div>
      <div id="menubar">


    <ul id="menu">
          
 <?php 

if(isset($_COOKIE["user"]))
{
	echo '<li class="selected"><a href="index.php">Home</a></li>';
	
}

if (isset($_COOKIE["role"]))
{
	if($_COOKIE["role"]==4)
	{			
	
		echo " 
	<div id='cssmenu'>
		<ul>

			<li class='has-sub'><a href=''>Audit Proccess</a>
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

		
	
	}


	if($_COOKIE["role"]==2)
	{			
	
		echo " 
	<div id='cssmenu'>
		<ul>

			<li class='has-sub'><a href='#'>Audit Proccess</a>
      				<ul>
        				
         				<li><a href='audit-checklist.php'>Audit Checklist</a></li>
					<li class='last'><a href='audit-notification.php'>Audit Notification</a></li>
         				<li class='last'><a href='internal-audit-report.php'>Audit Report</a></li>
         				<li class='last'><a href='#'>CAP</a></li>
         				
      				</ul>
   			</li>
		</ul>
	</div>


		";

		
	
	}






	if($_COOKIE["role"]==2)
	{			
	
		echo " 
		<li><a href='Setting.php'>Setting</a></li>
		";
	}


}
if(isset($_COOKIE["user"]))
{
	echo" <li style='width:75px'>";
	if(isset($_COOKIE["user"]))
	{	
		echo "<input type='submit' name='sub' value='Log out' style='height:30px;width:70px;background-color:whitesmoke;border-radius:6px 6px 6px 6px;' />";
	}
	echo "</li>";
}


	if(!isset($_COOKIE["user"]))
	{
		echo '<li class="selected"><a href="index.php">Login to control panel</a></li>';
	}
 ?>
          
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="sidebar_container">
        <div class="sidebar">
          
          
        </div>

       
      </div>
      <div id="content">
        <?php

if (!isset($_COOKIE["user"]))
{
	echo "
		<div >
			
		</br></br>
			<ul style='margin-top:2%'>		
				<li style='padding-left:15%;font-size:25px'>E-MAIL : <input type='text' name='Email' id='LoginEmail' style='height:40px;width:160px;font-size:20px;border-radius:15px;border:1px solid lightgray;padding-left:12px'/></li>
					
				</br>	
				</br>	
				</br>	

				<li style='padding-left:16%;font-size:25px'>PASS &nbsp; : <input type='Password' name='psw' id='LoginPassword' style='height:40px;width:160px;font-size:20px;border-radius:15px;border:1px solid lightgray;padding-left:12px'/></li>
					
				</br>	
				</br>	

				<li style='padding-left:32%'> <button type='submit' id='Login' style='height:50px;width:120px;font-size:20px;border-radius:90px;background-color:gray;color:white;border:1px solid lightgray'>Login</button> </li>
";
				echo '<li style="margin-left:60%"><p style="color:red">';  if(isset($_COOKIE["wronge"])){echo $_COOKIE["wronge"];} echo '</p></li>';
			echo '</ul>
		</div>';

}
if (isset($_COOKIE["role"]))
{

		function select()
		{
			$con = @mysql_connect('localhost','root','');
 			mysql_select_db("ebrahim", $con);
			$forminrole=mysql_query("select form_audit_checklist.id,form_audit_plan.Name,audit_checklist_title.title,form_audit_checklist.Reference,Description,s.status_type,Finding from form_audit_checklist inner join statous s on form_audit_checklist.StatusID =s.id inner join audit_checklist_title on audit_checklist_title.id=form_audit_checklist.Title_id inner join form_audit_plan on form_audit_plan.id=form_audit_checklist.plID");


			echo "<table>";

				echo "<tr>";
			
				echo "<td><center>Project</center>";

				echo "<td><center>Checklist Title</center>";
				
				echo "<td><center>Reference</center>";
				
				echo "<td><center>Description</center>";
				
				echo "<td><center>Status</center>";
				
				echo "<td><center>Finding</center>";

				echo "<tr>";

			while($RT=mysql_fetch_array($forminrole))
			{
				$aa=$RT['id'];
				echo "<tr>";
		
				echo "<td>";
				echo $RT['Name'];
				echo "</td>";
				echo "<td>";
				echo $RT['title'];
				echo "</td>";
				echo "<td>";
				echo $RT['Reference'];
				echo "</td>";
				echo "<td>";
				echo $RT['Description'];
				echo "</td>";
				if($_COOKIE["role"]==1)
				{
			
			
					echo "<td>";
					echo "<select name='ahsan$aa' style='width:52px'><option value='1'>yes</option><option value='2'>no</option><option value='3'>pertial</option></select>";
					echo "</td>";
			
				}
				else	
				{
					echo "<td>";
					echo $RT['status_type'];
					echo "</td>";
				}
				if($_COOKIE["role"]==1)
				{
					echo "<td>";
					echo "<textarea rows='1' cols='15' name='area$aa'> </textarea>";
					echo "</td>";
				}
				else
				{
					echo "<td>";
					echo $RT['Finding'];
					echo "</td>";
				}
				echo "<td>";
				echo "<input type='checkbox' value='$RT[id]' name='check'>";
				echo "</td>";

				echo "</tr>";
			

			}
		echo "</table>";
		echo "<input type='submit' name='agha'>";
		echo "<br>";
	}





		function selectNotification()
		{
			$con = @mysql_connect('localhost','root','');
 			mysql_select_db("ebrahim", $con);
			$forminrole=mysql_query("select a.Scope_Name,Objective,audit_date,audit_location,s.name,s.family,reference,Designation from audit_notification inner join scope a on audit_notification.Scope_Id=a.id inner join users s on audit_notification.auditors=s.id");


			echo "<table>";

				echo "<tr>";
			
				echo "<td><center>Scope Name</center>";

				echo "<td><center>Objective</center>";
				
				echo "<td><center>audit date</center>";
				
				echo "<td><center>audit location</center>";
				
				echo "<td><center>Name</center>";
				
				echo "<td><center>Family</center>";

				echo "<td><center>reference</center>";

				echo "<td><center>Designation</center>";

				echo "<tr>";

			while($RT=mysql_fetch_array($forminrole))
			{
				echo "<tr>";
		
				echo "<td>";
				echo $RT['Scope_Name'];
				echo "</td>";
				echo "<td>";
				echo $RT['Objective'];
				echo "</td>";
				echo "<td>";
				echo $RT['audit_date'];
				echo "</td>";
				echo "<td>";
				echo $RT['audit_location'];
				echo "</td>";
				echo "<td>";
				echo $RT['name'];
				echo "</td>";
				echo "<td>";
				echo $RT['family'];
				echo "</td>";
				echo "<td>";
				echo $RT['reference'];
				echo "</td>";
				echo "<td>";
				echo $RT['Designation'];
				echo "</td>";
				

				echo "</tr>";
			

			}
		echo "</table>";
	}





function selectPlan()
	{
			$con = @mysql_connect('localhost','root','');
 			mysql_select_db("ebrahim", $con);
			$forminrole=mysql_query("select auditees.CompanyName as Company,Scope.Scope_Name,form_audit_plan.Date_Of_Audit,

s1.Section_Name as s1,
s2.Section_Name as s2,
s3.Section_Name as s3,
s4.Section_Name as s4,
s5.Section_Name as s5,
s6.Section_Name as s6,
s7.Section_Name as s7,
s8.Section_Name as s8,
s9.Section_Name as s9,
s10.Section_Name as s10,
s11.Section_Name as s11,
s12.Section_Name as s12,
s13.Section_Name as s13,
s14.Section_Name as s14,
s15.Section_Name as s15,
s16.Section_Name as s16,
s17.Section_Name as s17,
s18.Section_Name as s18,
s19.Section_Name as s19,
s20.Section_Name as s20,
s21.Section_Name as s21,
s22.Section_Name as s22,
s23.Section_Name as s23,
s24.Section_Name as s24,
s25.Section_Name as s25,
form_audit_plan.reference,

au1.Name as AU1Name,
au1.Family as AU1Family,

au2.Name as AU2Name,
au2.Family as AU2Family,

au3.Name as AU3Name,
au3.Family as AU3Family,

au4.Name as AU4Name,
au4.Family as AU4Family,

au5.Name as AU5Name,
au5.Family as AU5Family,

au6.Name as AU6Name,
au6.Family as AU6Family,

au7.Name as AU7Name,
au7.Family as AU7Family,

form_audit_plan.Name

from form_audit_plan

inner join Scope
on Scope.id=form_audit_plan.ScopeId

inner join Secs
on Secs.id=form_audit_plan.SecId

inner join auditor_in_sec
on auditor_in_sec.id=form_audit_plan.auditors

inner join Section s1
on s1.id=Secs.Sec1

inner join Section s2
on s2.id=Secs.Sec2

inner join Section s3
on s3.id=Secs.Sec3

inner join Section s4
on s4.id=Secs.Sec4

inner join Section s5
on s5.id=Secs.Sec5

inner join Section s6
on s6.id=Secs.Sec6

inner join Section s7
on s7.id=Secs.Sec7

inner join Section s8
on s8.id=Secs.Sec8

inner join Section s9
on s9.id=Secs.Sec9

inner join Section s10
on s10.id=Secs.Sec10

inner join Section s11
on s11.id=Secs.Sec11

inner join Section s12
on s12.id=Secs.Sec12

inner join Section s13
on s13.id=Secs.Sec13

inner join Section s14
on s14.id=Secs.Sec14

inner join Section s15
on s15.id=Secs.Sec15

inner join Section s16
on s16.id=Secs.Sec16

inner join Section s17
on s17.id=Secs.Sec17

inner join Section s18
on s18.id=Secs.Sec18

inner join Section s19
on s19.id=Secs.Sec19

inner join Section s20
on s20.id=Secs.Sec20

inner join Section s21
on s21.id=Secs.Sec21

inner join Section s22
on s22.id=Secs.Sec22

inner join Section s23
on s23.id=Secs.Sec23

inner join Section s24
on s24.id=Secs.Sec24

inner join Section s25
on s25.id=Secs.Sec25



inner join users au1
on au1.id=auditor_in_sec.Auditor1

inner join users au2
on au2.id=auditor_in_sec.Auditor2

inner join users au3
on au3.id=auditor_in_sec.Auditor3

inner join users au4
on au4.id=auditor_in_sec.Auditor4

inner join users au5
on au5.id=auditor_in_sec.Auditor5

inner join users au6
on au6.id=auditor_in_sec.Auditor6

inner join users au7
on au7.id=auditor_in_sec.Auditor7

inner join auditees
on auditees.id=form_audit_plan.CompanyId");


			echo "<table>";

				echo "<tr>";

					echo "<td> <center>Form Name</center> </td>";

					echo "<td> <center>Company</center> </td>";
			
					echo "<td> <center>Audit Scope</center> </td>";
			
					echo "<td> <center>Date of Audit</center> </td>";
			
					echo "<td> <center>Section</center> </td>";
			
					echo "<td> <center>Reference</center> </td>";
			
					echo "<td> <center>Auditors</center> </td>";

			
				echo "</tr>";
			



			while($RT=mysql_fetch_array($forminrole))
			{
				$Aud1=$RT['AU1Name']."-".$RT['AU1Family'];
				$Aud2=$RT['AU2Name']."-".$RT['AU2Family'];
				$Aud3=$RT['AU3Name']."-".$RT['AU3Family'];
				$Aud4=$RT['AU4Name']."-".$RT['AU4Family'];
				$Aud5=$RT['AU5Name']."-".$RT['AU5Family'];
				$Aud6=$RT['AU6Name']."-".$RT['AU6Family'];
				$Aud7=$RT['AU7Name']."-".$RT['AU7Family'];

				if($Aud1!=null||$Aud1!="")
				{
					$AUDITOR=$Aud1;
				}
				if($Aud2!=null||$Aud2!=""||$Aud2=="-")
				{
					$AUDITOR=$Aud1."</br>".$Aud2;
				}
				if($Aud3!=null||$Aud3!="")
				{
					$AUDITOR=$Aud1."</br>".$Aud2."</br>".$Aud3;
				}
				if($Aud4!=null||$Aud4!="")
				{
					$AUDITOR=$Aud1."</br>".$Aud2."</br>".$Aud3."</br>".$Aud4;
				}
				if($Aud5!=null||$Aud5!="")
				{
					$AUDITOR=$Aud1."</br>".$Aud2."</br>".$Aud3."</br>".$Aud4."</br>".$Aud5;
				}
				if($Aud6!=null||$Aud6!="")
				{
					$AUDITOR=$Aud1."</br>".$Aud2."</br>".$Aud3."</br>".$Aud4."</br>".$Aud5."</br>".$Aud6;
				}
				if($Aud7!=null||$Aud7!="")
				{
					$AUDITOR=$Aud1."</br>".$Aud2."</br>".$Aud3."</br>".$Aud4."</br>".$Aud5."</br>".$Aud6."</br>".$Aud7;
				}


				if($RT['s1']!=null||$RT['s1']!="")
				{
					$SEC=$RT['s1']."</br>";
				}

				if($RT['s2']!=null||$RT['s2']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>";
				}

				if($RT['s3']!=null||$RT['s3']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>";
				}

				if($RT['s4']!=null||$RT['s4']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>";
				}

				if($RT['s5']!=null||$RT['s5']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>";
				}

				if($RT['s6']!=null||$RT['s6']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>";
				}

				if($RT['s7']!=null||$RT['s7']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>";
				}

				if($RT['s8']!=null||$RT['s8']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>";
				}

				if($RT['s9']!=null||$RT['s9']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>";
				}

				if($RT['s10']!=null||$RT['s10']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>";
				}

				if($RT['s11']!=null||$RT['s11']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>";
				}

				if($RT['s12']!=null||$RT['s12']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>";
				}

				if($RT['s13']!=null||$RT['s13']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>";
				}

				if($RT['s14']!=null||$RT['s14']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>";
				}

				if($RT['s15']!=null||$RT['s15']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>";
				}

				if($RT['s16']!=null||$RT['s16']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>".$RT['s16']."</br>";
				}

				if($RT['s17']!=null||$RT['s17']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>".$RT['s16']."</br>".$RT['s17']."</br>";
				}

				if($RT['s18']!=null||$RT['s18']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>".$RT['s16']."</br>".$RT['s17']."</br>".$RT['s18']."</br>";
				}

				if($RT['s19']!=null||$RT['s19']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>".$RT['s16']."</br>".$RT['s17']."</br>".$RT['s18']."</br>".$RT['s19']."</br>";
				}

				if($RT['s20']!=null||$RT['s20']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>".$RT['s16']."</br>".$RT['s17']."</br>".$RT['s18']."</br>".$RT['s19']."</br>".$RT['s20']."</br>";
				}

				if($RT['s21']!=null||$RT['s21']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>".$RT['s16']."</br>".$RT['s17']."</br>".$RT['s18']."</br>".$RT['s19']."</br>".$RT['s20']."</br>".$RT['s21']."</br>";
				}

				if($RT['s22']!=null||$RT['s22']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>".$RT['s16']."</br>".$RT['s17']."</br>".$RT['s18']."</br>".$RT['s19']."</br>".$RT['s20']."</br>".$RT['s21']."</br>".$RT['s22']."</br>";
				}

				if($RT['s23']!=null||$RT['s23']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>".$RT['s16']."</br>".$RT['s17']."</br>".$RT['s18']."</br>".$RT['s19']."</br>".$RT['s20']."</br>".$RT['s21']."</br>".$RT['s22']."</br>".$RT['s23']."</br>";
				}

				if($RT['s24']!=null||$RT['s24']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>".$RT['s16']."</br>".$RT['s17']."</br>".$RT['s18']."</br>".$RT['s19']."</br>".$RT['s20']."</br>".$RT['s21']."</br>".$RT['s22']."</br>".$RT['s23']."</br>".$RT['s24']."</br>";
				}

				if($RT['s25']!=null||$RT['s25']!="")
				{
					$SEC=$RT['s1']."</br>".$RT['s2']."</br>".$RT['s3']."</br>".$RT['s4']."</br>".$RT['s5']."</br>".$RT['s6']."</br>".$RT['s7']."</br>".$RT['s8']."</br>".$RT['s9']."</br>".$RT['s10']."</br>".$RT['s11']."</br>".$RT['s12']."</br>".$RT['s13']."</br>".$RT['s14']."</br>".$RT['s15']."</br>".$RT['s16']."</br>".$RT['s17']."</br>".$RT['s18']."</br>".$RT['s19']."</br>".$RT['s20']."</br>".$RT['s21']."</br>".$RT['s22']."</br>".$RT['s23']."</br>".$RT['s24']."</br>".$RT['s25']."</br>";
				}
				echo "<tr>";

					echo "<td> <center>$RT[Name]</center> </td>";
			
					echo "<td> <center>$RT[Company]</center> </td>";

					echo "<td> <center>$RT[Scope_Name]</center> </td>";
			
					echo "<td> <center>$RT[Date_Of_Audit]</center> </td>";
			
					echo "<td> <center>$SEC</center> </td>";
			
					echo "<td> <center>$RT[reference]</center> </td>";
			
					echo "<td> <center>Mr ( s ) </br></br> $AUDITOR</center> </td>";
			
				echo "</tr>";
			
			}
	

			echo "</table>";
	}

  if($_COOKIE["role"]==4)
	{
	

	}
  if($_COOKIE["role"]==3)
	{
	select();
	}
  if($_COOKIE["role"]==2)
	{
	
		selectPlan();
	}
  if($_COOKIE["role"]==1)
	{
	
		echo "<br><hr> Audit Checklist<br>";
		select();
		echo "<br><hr>Audit Plan<br>";
		selectPlan();
		echo "<br><hr>Notification<br>";
		selectNotification();
	}
}
else
{
}


if(isset($_POST['sub'])) { 
   logout();
} 

?>
<span style="margin-left:80%;">


</span>

      </div>


    </div>
    <div id="content_footer"></div>
    <div id="footer">
      <p>
<a href="index.php">Home</a>
 | <a href="create-user.php">Create User</a> 
| <a href="create-form.php">Create Form</a> 
| <a href="define-the-scope.html">Define The Scope</a>

| <a href="Review.html">Reviews</a>
</p>


      <p>Copyright &copy; Management Users WebApplication | <a href="http://www.iigroup.ir">designed by iigroup.ir</a></p>
	
    </div>
    <p>&nbsp;</p>
  </div>

</form>
</body>
</html>
