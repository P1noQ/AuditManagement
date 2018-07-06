<?php


		
			session_start()   ;
  			
 			 

if(isset($_POST['sub'])) { 
   logout();
} 
if(isset($_POST['up'])) { 
   upload();
} 

if(isset($_POST['psw'])) { 
   users();
} 

if(isset($_POST['rolesub'])) { 
   setrole();
}

if(isset($_POST['SaveRowsalo'])) { 
   insertChecklist();
}
if(isset($_POST['juju'])) { 
   inserNotification();
} 
if(isset($_POST['SaveRows'])) { 
  insertform();
} 
if(isset($_POST['agha'])) { 
   homeinsert();
} 

if(isset($_POST['SRows'])) { 
  auditplan();
} 

if(isset($_POST['SetLead'])) { 

	$con = @mysql_connect('localhost','root','');
 	mysql_select_db("Ebrahim", $con);
	
	$qry="select count(*) as Line from userinrole inner join users on users.id=userinrole.userid inner join role on role.id=userinrole.roleid where role.id=1";
	$RES= mysql_query($qry) or die(mysql_error());

	while($Rowl=mysql_fetch_array($RES))
	{
		$Count=$Rowl['Line'];
		
		for($i=1;$i<=$Count;$i++)
		{
			$Check="CheckAud$i";
			$Select=$_POST['SelLead'];
			$ValC=$_POST["$Check"];
			if(isset($_POST["$Check"]))
			{
				$qury="insert into leadforauditors(Lead_Auditor,Auditor) values($Select,$ValC)";
				mysql_query($qury) or die(mysql_error());
			}
		}
	}
}

if(isset($_POST['ChangePass'])){

	ChangingPass();
}



function homeinsert()
{
$con = @mysql_connect('localhost','root','');
 	mysql_select_db("Ebrahim", $con);

$s=$_POST['check'];
$n1= $_POST["area$s"];
$n2= $_POST["ahsan$s"];
	$qury="update form_audit_checklist set finding='$n1',StatusID='$n2' where id='$_POST[check]'";
	mysql_query($qury) or die(mysql_error());






	mysql_close($con);
}


















function ChangingPass()
{
	$con = @mysql_connect('localhost','root','');
 	mysql_select_db("Ebrahim", $con);

	$query="select * from users where name='$_COOKIE[user]' ";
	$Result=mysql_query($query) or die(mysql_error());

	while($Rowing=mysql_fetch_array($Result))
	{
		$PASSWORD=$Rowing['psw'];

		if($_POST['CurrentP']==$PASSWORD)
		{
			if($_POST['NewP']==$_POST['ConfirmP'])
			{
				$qury="update users set psw='$_POST[NewP]' where name='$_COOKIE[user]'";
				mysql_query($qury) or die(mysql_error());

				$expire=time()+1;
				setcookie("SuccessC", "Your password has changed successfully", $expire);
			}
		
			else
			{
				$expire=time()+1;
				setcookie("Notmatch", "New password and confirm are not match", $expire);
			}
		}
	
		else
		{
			$expire=time()+1;
			setcookie("ErrorPass", "Please Enter the correct password", $expire);
		}
	}


	ob_start();
				
	header('Location: http://localhost/Ebrahim/Setting.php');    //this line works now
	ob_end_flush();			 

}




function logout()
{

$expire=time()-1;
setcookie("user", "$name", $expire);


setcookie("role", "$role", $expire);


ob_start();
				
header('Location: http://localhost/Ebrahim/index.php');    //this line works now
ob_end_flush();			 

}

function upload()
{



}


function users()
{
		
			$con = @mysql_connect('localhost','root','');
 			mysql_select_db("Ebrahim", $con);	
			$result = mysql_query("select * from users where Email='$_POST[Email]' and psw='$_POST[psw]'") ;
		
			while($row = mysql_fetch_array($result))
 			 {
				$id=$row['id'];
				$user=$row['Email'];
				$pass=$row['psw'];
				$name=$row['Name'];
  			 }
			if($user==null || $pass==null)
			{
				$expire=time()+1;
				setcookie("wronge", "Wrong email or password. Try again", $expire);



				ob_start();
				
				header('Location: http://localhost/Ebrahim/index.php');    //this line works now
				ob_end_flush();		
			}
			else
			{
				
				$expire=time()+3600;
				setcookie("user", "$name", $expire);
				
				$con1 = mysql_connect('localhost','root','');
 				mysql_select_db("Ebrahim", $con1);
	
				$result = mysql_query("select * from userinrole where UserId=$id") ;
				while($row = mysql_fetch_array($result))
 				 {
					$role=$row['RoleId'];
  				 }

				setcookie("role", "$role", $expire);
				
				ob_start();
				
				header('Location: http://localhost/Ebrahim/index.php');    //this line works now
				ob_end_flush();			 

			
			}
}


function createuser()
{


if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {

$tmpName = $_FILES['image']['tmp_name'];

$fp = fopen($tmpName, 'r');
$data = fread($fp, filesize($tmpName));
$data = addslashes($data);
fclose($fp);
print "Thank you, your file has been uploaded.";

}
else {
print "No image selected/uploaded";
}


$con1 = @mysql_connect('localhost','root','');
mysql_select_db("Ebrahim", $con1);

$res="insert into users(name,family,Email,psw,MobileNum,image)values('$_POST[name]','$_POST[family]','$_POST[email]','$_POST[psw]','$_POST[mobile]','$data')";

mysql_query($res);	



ob_start();
				
header('Location: http://localhost/Ebrahim/ManageUsers/create-user.php');    //this line works now
ob_end_flush();	

}



function setrole()
{
$ValCheck=$_POST['checkH'];
$ValRole=$_POST['OptionVal'];


$con1 = @mysql_connect('localhost','root','');
mysql_select_db("Ebrahim", $con1);
$res="insert into userinrole(UserId,RoleId)values($ValCheck,$ValRole)";

mysql_query($res);

ob_start();
				
header('Location: http://localhost/Ebrahim/define-the-scope.php');    //this line works now
ob_end_flush();	

}









function insertChecklist()
{
			$con = @mysql_connect("localhost","root","");
		
			mysql_select_db("ebrahim",$con);
			for($oops=1;$oops<=$_POST[SendNum];$oops++)
			{
			$n1= $_POST["Title$oops"];
			$n2= $_POST["Reference$oops"];
			$n3= $_POST["Description$oops"];
			$n4= $_POST["Status$oops"];
			$n5= $_POST["Designation$oops"];

	
			
			$RES= mysql_query("INSERT INTO form_audit_checklist(FormId,Title_id,Reference,Description,StatusID,Finding) VALUES ('3','$n1','$n2','$n3','$n4','$n5')");

			}			
			
			mysql_close($con);

				ob_start();
				
				header('Location: http://localhost/Ebrahim/audit-checklist.php');    //this line works now
				ob_end_flush();	
		
}
function inserNotification()
{
			
	$con = @mysql_connect("localhost","root","");		
	mysql_select_db("Ebrahim", $con);	
	for($oops=1;$oops<=$_POST['SendNum'];$oops++)
	{
		$n1= $_POST["scops$oops"];
		$n2= $_POST["part$oops"];
		$n3= $_POST["Date$oops"];
		$n4= $_POST["Location$oops"];
		$n5= $_POST["ScopeAud$oops"];
		$n6= $_POST["Reference$oops"];
		$n7= $_POST["Designation$oops"];		
		$RES="insert into audit_notification(FormID,Scope_Id,Objective,Audit_Date,Audit_Location,Auditors,Reference,Designation,plID) VALUES ('3','$n1','$n2','$n3','$n4','$n5','$n6','$n7','7')";
		mysql_query($RES) or die(mysql_error());
	}			
			
	mysql_close($con);
	
	ob_start();
	header('Location: http://localhost/Ebrahim/audit-notification.php');    //this line works now
	ob_end_flush();	
		
}

		
function generateRandomString($length) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


function auditplan()
{	
	$con = @mysql_connect("localhost","root","");	
	mysql_select_db("Ebrahim", $con);

	$Dates=generateRandomString(4);

	for($oops=1;$oops<=$_POST['SendNum'];$oops++)
	{
		$Comp=$_POST["Company$oops"];
		$Section1=25;
		$Section2=25;
		$Section3=25;
		$Section4=25;
		$Section5=25;
		$Section6=25;
		$Section7=25;
		$Section8=25;
		$Section9=25;
		$Section10=25;
		$Section11=25;
		$Section12=25;
		$Section13=25;
		$Section14=25;
		$Section15=25;
		$Section16=25;
		$Section17=25;
		$Section18=25;
		$Section19=25;
		$Section20=25;
		$Section21=25;
		$Section22=25;
		$Section23=25;
		$Section24=25;
		$Section25=25;

		if(isset($_POST['Section1']))
		{
			$Section1=$_POST['Section1'];
		}
		if(isset($_POST['Section2']))
		{
			$Section2=$_POST['Section2'];
		}
		if(isset($_POST['Section3']))
		{
			$Section3=$_POST['Section3'];
		}
		if(isset($_POST['Section4']))
		{
			$Section4=$_POST['Section4'];
		}
		if(isset($_POST['Section5']))
		{
			$Section5=$_POST['Section5'];
		}
		if(isset($_POST['Section6']))
		{
			$Section6=$_POST['Section6'];
		}
		if(isset($_POST['Section7']))
		{
			$Section7=$_POST['Section7'];
		}
		if(isset($_POST['Section8']))
		{
			$Section8=$_POST['Section8'];
		}
		if(isset($_POST['Section9']))
		{
			$Section9=$_POST['Section9'];
		}
		if(isset($_POST['Section10']))
		{
			$Section10=$_POST['Section10'];
		}
		if(isset($_POST['Section11']))
		{
			$Section11=$_POST['Section11'];
		}
		if(isset($_POST['Section12']))
		{
			$Section12=$_POST['Section12'];
		}
		if(isset($_POST['Section13']))
		{
			$Section13=$_POST['Section13'];
		}
		if(isset($_POST['Section14']))
		{
			$Section14=$_POST['Section14'];
		}
		if(isset($_POST['Section15']))
		{
			$Section15=$_POST['Section15'];
		}
		if(isset($_POST['Section16']))
		{
			$Section16=$_POST['Section16'];
		}
		if(isset($_POST['Section17']))
		{
			$Section17=$_POST['Section17'];
		}
		if(isset($_POST['Section18']))
		{
			$Section18=$_POST['Section18'];
		}
		if(isset($_POST['Section19']))
		{
			$Section19=$_POST['Section19'];
		}
		if(isset($_POST['Section20']))
		{
			$Section20=$_POST['Section20'];
		}
		if(isset($_POST['Section21']))
		{
			$Section21=$_POST['Section21'];
		}
		if(isset($_POST['Section22']))
		{
			$Section22=$_POST['Section22'];
		}
		if(isset($_POST['Section23']))
		{
			$Section23=$_POST['Section23'];
		}
		if(isset($_POST['Section24']))
		{
			$Section24=$_POST['Section24'];
		}
		if(isset($_POST['Section25']))
		{
			$Section25=$_POST['Section25'];
		}
		$quryt="insert into secs(Sec1,Sec2,Sec3,Sec4,Sec5,Sec6,Sec7,Sec8,Sec9,Sec10,Sec11,Sec12,Sec13,Sec14,Sec15,Sec16,Sec17,Sec18,Sec19,Sec20,Sec21,Sec22,Sec23,Sec24,Sec25) VALUES ('$Section1','$Section2','$Section3','$Section4','$Section5','$Section6','$Section7','$Section8','$Section9','$Section10','$Section11','$Section12','$Section13','$Section14','$Section15','$Section16','$Section17','$Section18','$Section19','$Section20','$Section21','$Section22','$Section23','$Section24','$Section25')";
		mysql_query($quryt) or die(mysql_error());


		$Auditores1=28;
		$Auditores2=28;
		$Auditores3=28;
		$Auditores4=28;
		$Auditores5=28;
		$Auditores6=28;
		$Auditores7=28;

		if(isset($_POST['Auditores1']))
		{
			$Auditores1=$_POST['Auditores1'];
		}
		if(isset($_POST['Auditores2']))
		{
			$Auditores2=$_POST['Auditores2'];
		}
		if(isset($_POST['Auditores3']))
		{
			$Auditores3=$_POST['Auditores3'];
		}
		if(isset($_POST['Auditores4']))
		{
			$Auditores4=$_POST['Auditores4'];
		}
		if(isset($_POST['Auditores5']))
		{
			$Auditores5=$_POST['Auditores5'];
		}
		if(isset($_POST['Auditores6']))
		{
			$Auditores6=$_POST['Auditores6'];
		}
		if(isset($_POST['Auditores7']))
		{
			$Auditores7=$_POST['Auditores7'];
		}
		$quryu="insert into auditor_in_sec(Auditor1,Auditor2,Auditor3,Auditor4,Auditor5,Auditor6,Auditor7) values($Auditores1,$Auditores2,$Auditores3,$Auditores4,$Auditores5,$Auditores6,$Auditores7)";
		mysql_query($quryu) or die(mysql_error());


		$n1= $_POST["Scope$oops"];
		$n2= $_POST["Date$oops"];
		$n4= $_POST["Ref$oops"];


		$qury3="SELECT id FROM secs ORDER BY id DESC LIMIT 1";
		$adido=mysql_query($qury3) or die(mysql_error());
		while($RO=mysql_fetch_array($adido))
		{
			$SECID=$RO['id'];
		}


		$qury4="SELECT id FROM auditor_in_sec ORDER BY id DESC LIMIT 1";
		$adidoa=mysql_query($qury4) or die(mysql_error());
		while($ROt=mysql_fetch_array($adidoa))
		{
			$AUID=$ROt['id'];
		}


		$qury="insert into form_audit_plan(FormId,CompanyId,ScopeID,Date_Of_Audit,SecId,reference,Auditors,Name) VALUES ('1','$Comp','$n1','$n2','$SECID','$n4','$AUID','$Dates')";
		mysql_query($qury) or die(mysql_error());
	}

	mysql_close($con);

	ob_start();
	header('Location: http://localhost/Ebrahim/audit-plan.php');    //this line works now
	ob_end_flush();	
}
?>