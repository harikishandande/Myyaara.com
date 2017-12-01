<?php
session_start();
include('includes/article.php');
include('includes/connection.php');

if(isset($_POST['admin_signup']))
{ 
	$admin_name = $_POST['admin_name'];
	$admin_email = $_POST['admin_email'];
	$admin_phone = $_POST['admin_phone'];
		
	$admin_password = ""; 
	
		for($i=0; $i<7; $i++)
		{ 
			$randnum = mt_rand(0,61); 
			if($randnum < 10)
			{ 
				$admin_password .= chr($randnum+48); 
			}else if($randnum < 36)
			{ 
				$admin_password .= chr($randnum+55); 
			}else
			{ 
				$admin_password .= chr($randnum+61); 
			} 
		}
	
		$count=mysqli_query($connection,"SELECT id FROM myyaara_admin WHERE admin_email = '$admin_email'");
			
			if(mysqli_num_rows($count) < 1)
			{
				$adminid = new Article;
				$adminids = $adminid->fetch_adminids();
				if(!isset($adminids['0']))
				{	
					$admin_no = 1;
				}
				else
				{	
					$adminid = new Article;
					$adminids = $adminid->fetch_adminids();
					$array = $adminids['admin_id'];
					$admin_no = filter_var($array, FILTER_SANITIZE_NUMBER_INT);
					$admin_no++;
				}
				$admin_id = "MYYAARA" . "0" . $admin_no; 
										
				$query = $pdo->prepare('INSERT into myyaara_admin(admin_id, admin_name, admin_phone, admin_email, admin_password, admin_timestamp)values(?,?,?,?,?,?)');
					$query->bindValue(1, $admin_id);
					$query->bindValue(2, $admin_name);
					$query->bindValue(3, $admin_phone);
					$query->bindValue(4, $admin_email);
					$query->bindValue(5, $admin_password);
					$query->bindValue(6, date('Y-m-d'));
					$query->execute();
										
				include 'smtp/Send_Mail.php';
				require_once('smtp/class.smtp.php');
				$to=$admin_email;
				$subject="Myyaara Email verification";
				$body='<!DOCTYPE html>
<html lang="en">
<head>
  <link href="http://fonts.googleapis.com/css?family=Exo+2:900" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Skranji" rel="stylesheet" type="text/css">
	<style>

	.dl-horizontal dt {
    float: left;
    width: 160px;
    overflow: hidden;
    clear: left;
    text-align: right;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .dl-horizontal dd {
    margin-left: 180px;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
	
	.text-danger {
  color: #b94a48;
}

.text-danger:hover {
  color: #953b39;
}

	.lead {
  margin-bottom: 20px;
  font-size: 16px;
  font-weight: 200;
  line-height: 1.4;
}
	
	.text-center {
  text-align: center;
}
	.text-info {
  color: #3a87ad;
}

.text-info:hover {
  color: #2d6987;
}</style>
<body>
		<center>
			<h1 class="text-info text-center" style="font-family: "Exo 2", sans-serif;">
				<b>Myyaara.com</b>
			</h1>
			<p class="lead text-center">
				Hi <span class="text-danger" style="font-family: "Skranji", cursive;letter-spacing: 2px;"><b>' . $admin_name . '</b></span> ,<br>We are happy to inform that you are successfully registered in Myyaara.com.<br/>Here your credentials are,
			</p>
				<h3 style=""><dl class="dl-horizontal">
					<dt style="color:#0099cc;">
						Group ID
					</dt>
					<dd>' . $admin_id . ' </dd>
					<dt style="color:#0099cc;">
						Password
					</dt>
					<dd>
						' . $admin_password .
					'</dd>
				</dl>
				</h3>
			<p class="lead text-center">
				Let\'s have some fun now.<br>Regards,<br>Myyaara.com Team.
			</p>
			<p class="text-danger text-center">
				<b style="color:red;">Note:</b> The reply to this email address is not considered.
			</p>
			<div>
				
			</div>
			
		</center>
</body>
</html>
';
				Send_Mail($to,$subject,$body);
						
					$_SESSION['popup1'] = 1;
					header('Location: index.php');
			}
			else
			{
				$_SESSION['popup2'] = 1;	
				header('Location: index.php');
			}
}

if(isset($_POST['user_signup']))
{ 
	$user_name = $_POST['user_name'];
	$user_email = $_POST['user_email'];
	$user_phone = $_POST['user_phone'];
		
	$user_password = ""; 
	
		for($i=0; $i<7; $i++)
		{ 
			$randnum = mt_rand(0,61); 
			if($randnum < 10)
			{ 
				$user_password .= chr($randnum+48); 
			}else if($randnum < 36)
			{ 
				$user_password .= chr($randnum+55); 
			}else
			{ 
				$user_password .= chr($randnum+61); 
			} 
		}
	
		$count=mysqli_query($connection,"SELECT user_id FROM myyaara_user WHERE user_email = '$user_email'");
			
			if(mysqli_num_rows($count) < 1)
			{
				$query = $pdo->prepare('INSERT into myyaara_user(user_name, user_email, user_password, user_phone, user_timestamp)values(?,?,?,?,?)');
					$query->bindValue(1, $user_name);
					$query->bindValue(2, $user_email);
					$query->bindValue(3, $user_password);
					$query->bindValue(4, $user_phone);
					$query->bindValue(5, date('Y-m-d'));
					$query->execute();
										
				include 'smtp/Send_Mail.php';
				require_once('smtp/class.smtp.php');
				$to=$user_email;
				$subject="Myyaara Email verification";
				$body='<!DOCTYPE html>
<html lang="en">
<head>
  <link href="http://fonts.googleapis.com/css?family=Exo+2:900" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Skranji" rel="stylesheet" type="text/css">
	<style>

	.dl-horizontal dt {
    float: left;
    width: 160px;
    overflow: hidden;
    clear: left;
    text-align: right;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .dl-horizontal dd {
    margin-left: 180px;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
	
	.text-danger {
  color: #b94a48;
}

.text-danger:hover {
  color: #953b39;
}

	.lead {
  margin-bottom: 20px;
  font-size: 16px;
  font-weight: 200;
  line-height: 1.4;
}
	
	.text-center {
  text-align: center;
}
	.text-info {
  color: #3a87ad;
}

.text-info:hover {
  color: #2d6987;
}</style>
<body>
		<center>
			<h1 class="text-info text-center" style="font-family: "Exo 2", sans-serif;">
				<b>Myyaara.com</b>
			</h1>
			<p class="lead text-center">
				Hi <span class="text-danger" style="font-family: "Skranji", cursive;letter-spacing: 2px;"><b>' . $user_name . '</b></span> ,<br>We are happy to inform that you are successfully registered in Myyaara.com.<br/>Here are your credentials,
			</p>
				<h3 style=""><dl class="dl-horizontal">
					<dt style="color:#0099cc;">
						Password
					</dt>
					<dd>
						' . $user_password .
					'</dd>
				</dl>
				</h3>
			<p class="lead text-center">
				Let\'s have some fun now.<br>Regards,<br>Myyaara.com Team.
			</p>
			<p class="text-danger text-center">
				<b style="color:red;">Note:</b> The reply to this email address is not considered.
			</p>
			<div>
				
			</div>
			
		</center>
</body>
</html>
';
				Send_Mail($to,$subject,$body);
						
				$_SESSION['popup1'] = 1;
				header('Location: index.php');
			}
			else
			{
				$_SESSION['popup2'] = 1;	
				header('Location: index.php');
			}
}

if(isset($_POST['submit_admin_details']))
{ 
	$admin_phone = $_POST['admin_phone'];
	$admin_college = $_POST['admin_college'];
	$admin_branch = $_POST['admin_branch'];
	$first_year = $_POST['first_year'];
	$last_year = $_POST['last_year'];
	$admin_batch = $first_year . " - " . $last_year;
	$admin_no_of_students = $_POST['admin_no_of_students'];
	
	$sql = "UPDATE myyaara_admin SET admin_phone = ?,admin_college = ?, admin_branch = ?, admin_batch = ?, admin_no_of_students = ? WHERE admin_email = ?";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $admin_phone);
		$query->bindValue("2", $admin_college);
		$query->bindValue("3", $admin_branch);
		$query->bindValue("4", $admin_batch);
		$query->bindValue("5", $admin_no_of_students);
		$query->bindValue("6", $_SESSION['admin_email']);
		$query->execute();
	
	$_SESSION['popup3'] = 1;	
	header('Location: myyaara_dir/a_index.php');
}

if(isset($_POST['submit_user_story']))
{ 
	$user_id = $_GET['id'];
	$user_mystory_title = $_POST['user_mystory_title'];
	$user_mystory = $_POST['user_mystory'];
	
	$sql = "UPDATE myyaara_user SET user_mystory_title = ?,user_mystory = ? WHERE user_id = ?";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $user_mystory_title);
		$query->bindValue("2", $user_mystory);
		$query->bindValue("3", $user_id);
		$query->execute();
	
	$_SESSION['popup3'] = 1;	
	header('Location: myyaara_dir/u_mystory.php');
}

if(isset($_POST['submit_college_information']))
{ 
	$admin_id = $_GET['admin_id'];
	$id = $_GET['id'];
	$college_information = $_POST['college_information'];
	echo $admin_id . $college_information ;
	$sql = "UPDATE myyaara_college_information SET college_information = ? WHERE ( admin_id = ? && id = ? )";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $college_information);
		$query->bindValue("2", $admin_id);
		$query->bindValue("3", $id);
		$query->execute();
	
	$_SESSION['popup4'] = 1;	
	header('Location: myyaara_dir/a_our_college.php');
}


if(isset($_POST['submit_picture_description']))
{ 
	$admin_id = $_GET['admin_id'];
	$college_picture_id = $_GET['id'];
	$college_picture_description = $_POST['college_picture_description'];

	$sql = "UPDATE myyaara_college_pictures SET college_picture_description = ? WHERE ( admin_id = ? && id = ? )";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $college_picture_description);
		$query->bindValue("2", $admin_id);
		$query->bindValue("3", $college_picture_id);
		$query->execute();
	
	$_SESSION['popup6'] = 1;	
	header('Location: myyaara_dir/a_our_college.php');
}

if(isset($_POST['submit_user_picture_description']))
{ 
	$user_id = $_GET['user_id'];
	$id = $_GET['id'];
	$user_picture_description = $_POST['user_picture_description'];

	$sql = "UPDATE myyaara_user_pictures SET user_picture_description = ? WHERE ( user_id = ? && id = ? )";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $user_picture_description);
		$query->bindValue("2", $user_id);
		$query->bindValue("3", $id);
		$query->execute();
	
	$_SESSION['popup6'] = 1;	
	header('Location: myyaara_dir/u_mypics.php');
}

if(isset($_POST['submit_teacher_information']))
{ 
	$admin_id = $_GET['admin_id'];
	$teacher_id = $_GET['id'];
	$teacher_name = $_POST['teacher_name'];
	$teacher_subject = $_POST['teacher_subject'];
	$teacher_opinion = $_POST['teacher_opinion'];
	$teacher_advice = $_POST['teacher_advice'];

	$sql = "UPDATE myyaara_teacher_information SET teacher_name = ?, teacher_subject = ?, teacher_opinion = ?, teacher_advice = ? WHERE ( admin_id = ? && id = ? )";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $teacher_name);
		$query->bindValue("2", $teacher_subject);
		$query->bindValue("3", $teacher_opinion);
		$query->bindValue("4", $teacher_advice);
		$query->bindValue("5", $admin_id);
		$query->bindValue("6", $teacher_id);
		$query->execute();
	
	$_SESSION['popup7'] = 1;	
	header('Location: myyaara_dir/a_our_teachers.php');
}

if(isset($_POST['submit_college_photos']))
{ 
	$college_pic1 = $_POST['college_pic1'];
	$college_pic2 = $_POST['college_pic2'];
	$college_pic3 = $_POST['college_pic3'];
	$college_pic4 = $_POST['college_pic4'];
	$college_pic5 = $_POST['college_pic5'];
	$college_pic6 = $_POST['college_pic6'];
	$college_pic7 = $_POST['college_pic7'];
	$college_pic8 = $_POST['college_pic8'];
	$college_pic9 = $_POST['college_pic9'];
	$college_pic10 = $_POST['college_pic10'];
	
	$college_picture = $college_pic1 . $college_pic2 . $college_pic3 . $college_pic4 . $college_pic5 . $college_pic6 . $college_pic7 . $college_pic8 . $college_pic9 . $college_pic10 ;
	
	$admin_id = $_POST['admin_id'];
	
	$sql = "UPDATE myyaara_admin SET admin_phone = ?,admin_college = ?, admin_branch = ?, admin_batch = ?, admin_no_of_students = ? WHERE admin_email = ?";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $admin_phone);
		$query->bindValue("2", $admin_college);
		$query->bindValue("3", $admin_branch);
		$query->bindValue("4", $admin_batch);
		$query->bindValue("5", $admin_no_of_students);
		$query->bindValue("6", $_SESSION['admin_email']);
		$query->execute();
	
	$_SESSION['popup3'] = 1;	
	header('Location: myyaara_dir/a_index.php');
}


if(isset($_POST['customer_forget_password']))
{
			$customer_email = $_POST['customer_email'];
			
			if(empty($customer_email))
			{
				$_SESSION['popup3'] = 1;	
				header('Location: index.php');
			}
			else
			{
				$count=mysqli_query($connection,"SELECT id FROM customers WHERE customer_email = '$customer_email'");
			
				if(mysqli_num_rows($count) < 1)
				{	
					$_SESSION['popup7'] = 1;	
					header('Location: index.php');	
				}
				else
				{
					$user = new Article;
					$users = $user->fetch_forgetdetails($customer_email);
					$customer_name = $users['customer_name'];
					$customer_id = $users['customer_id'];
					$customer_password = $users['customer_password'];
					include 'smtp/Send_Mail.php';
				require_once('smtp/class.smtp.php');
				$to=$customer_email;
				$subject="Forget Password EazyShifting.com";
				$body='<!DOCTYPE html>
<html lang="en">
<head>
  <link href="http://fonts.googleapis.com/css?family=Exo+2:900" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Skranji" rel="stylesheet" type="text/css">
	<style>

	.dl-horizontal dt {
    float: left;
    width: 160px;
    overflow: hidden;
    clear: left;
    text-align: right;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .dl-horizontal dd {
    margin-left: 180px;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
	
	.text-danger {
  color: #b94a48;
}

.text-danger:hover {
  color: #953b39;
}

	.lead {
  margin-bottom: 20px;
  font-size: 16px;
  font-weight: 200;
  line-height: 1.4;
}
	
	.text-center {
  text-align: center;
}
	.text-info {
  color: #3a87ad;
}

.text-info:hover {
  color: #2d6987;
}</style>
<body>
		<center>
			<h1 class="text-info text-center" style="font-family: "Exo 2", sans-serif;">
				<b>EazyShifting.com</b>
			</h1>
			<p class="lead text-center">
				Hi <span class="text-danger" style="font-family: "Skranji", cursive;letter-spacing: 2px;"><b>' . $customer_name . '</b></span> ,<br>You forget your CUSTOMER ID and PASSWORD details right.<br/>Here they are,
			</p>
				<h3 style=""><dl class="dl-horizontal">
					<dt style="color:#0099cc;">
						Customer id
					</dt>
					<dd>' . $customer_id . ' </dd>
					<dt style="color:#0099cc;">
						Password
					</dt>
					<dd>
						' . $customer_password .
					'</dd>
				</dl>
				</h3>
			<p class="lead text-center">
				Be prepare to experience our service of its own kind.<br>Regards,<br>EazyShifting.com Team.
			</p>
			<p class="text-danger text-center">
				<b style="color:red;">Note:</b> The reply to this email address is not considered.
			</p>
			<div>
				
			</div>
			
		</center>
</body>
</html>
';
				Send_Mail($to,$subject,$body);
				
				$_SESSION['popup4'] = 1;	
				header('Location: index.php');
				}
			}
}
	
if(isset($_POST['admin_login']))
{ 
	$admin_email = $_POST['admin_email'];
	$admin_password = $_POST['admin_password'];

	$query = $pdo -> prepare("SELECT admin_email, admin_password FROM myyaara_admin WHERE admin_email = ? AND admin_password = ?");
	$query->bindValue(1, $admin_email);
	$query->bindValue(2, $admin_password);
	$query->execute();
	$num = $query->rowCount();
	if($num==1)
	{	
		$_SESSION['admin_email'] = $admin_email;
		$_SESSION['admin_session'] = true;
		header('Location: myyaara_dir/a_index.php');
		exit();
	}
	if(!isset($_SESSION['admin_session']))
	{
		$_SESSION['popup5'] = 1;	
		header('Location: index.php');
	}
}

if(isset($_POST['user_login']))
{ 
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];

	$query = $pdo -> prepare("SELECT user_email, user_password FROM myyaara_user WHERE user_email = ? AND user_password = ?");
	$query->bindValue(1, $user_email);
	$query->bindValue(2, $user_password);
	$query->execute();
	$num = $query->rowCount();
	if($num==1)
	{	
		$_SESSION['user_email'] = $user_email;
		$_SESSION['user_session'] = true;
		header('Location: myyaara_dir/u_myself.php');
		exit();
	}
	if(!isset($_SESSION['user_session']))
	{
		$_SESSION['popup5'] = 1;	
		header('Location: index.php');
	}
}

if(isset($_POST['update_customer_profile']))
{
	$customer_email = $_SESSION['customer_email'];
	$customer_name = $_POST['customer_name'];
	$customer_password = $_POST['customer_password'];
	$sql = "UPDATE customers SET customer_name = ?, customer_password = ? WHERE customer_email = ?";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $customer_name);
		$query->bindValue("2", $customer_password);
		$query->bindValue("3", $customer_email);
		$query->execute();
	
	$_SESSION['popup6'] = 1;	
	header('Location: index.php');
}

if(isset($_POST['pam_registration']))
{ 
	$pam_name = $_POST['pam_name'];
	$pam_email = $_POST['pam_email'];
	$pam_phone = $_POST['pam_phone'];
	
	$pam_password = ""; 
	
		for($i=0; $i<7; $i++)
		{ 
			$randnum = mt_rand(0,61); 
			if($randnum < 10){ 
				$pam_password .= chr($randnum+48); 
			}else if($randnum < 36){ 
				$pam_password .= chr($randnum+55); 
			}else{ 
				$pam_password .= chr($randnum+61); 
			} 
		}
	
		$count=mysqli_query($connection,"SELECT id FROM paminfo WHERE pam_email = '$pam_email'");
			
			if(mysqli_num_rows($count) < 1)
			{
					$customerid = new Article;
					$customerids = $customerid->fetch_customerids();
					if(!isset($customerids['0']))
					{	
						$customer_no = 1;
					}
					else
					{	
						$pamid = new Article;
						$pamids = $pamid->fetch_pamids();
						$array = $pamids['pam_id'];
						$pam_no = filter_var($array, FILTER_SANITIZE_NUMBER_INT);
						$pam_no++;
					}

					$pam_id = "PAM" . "0" . $pam_no; 
										
					$query = $pdo->prepare('INSERT into paminfo(pam_id, pam_name, pam_phone, pam_email, pam_password, pam_timestamp)values(?,?,?,?,?,?)');
						$query->bindValue(1, $pam_id);
						$query->bindValue(2, $pam_name);
						$query->bindValue(3, $pam_phone);
						$query->bindValue(4, $pam_email);
						$query->bindValue(5, $pam_password);
						$query->bindValue(6, date('Y-m-d'));
						$query->execute();
						
					include 'smtp/Send_Mail.php';
				require_once('smtp/class.smtp.php');
				$to=$pam_email;
				$subject="EazyShifting Email Verification";
				$body='<!DOCTYPE html>
<html lang="en">
<head>
  <link href="http://fonts.googleapis.com/css?family=Exo+2:900" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Skranji" rel="stylesheet" type="text/css">
	<style>

	.dl-horizontal dt {
    float: left;
    width: 160px;
    overflow: hidden;
    clear: left;
    text-align: right;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .dl-horizontal dd {
    margin-left: 180px;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
	
	.text-danger {
  color: #b94a48;
}

.text-danger:hover {
  color: #953b39;
}

	.lead {
  margin-bottom: 20px;
  font-size: 16px;
  font-weight: 200;
  line-height: 1.4;
}
	
	.text-center {
  text-align: center;
}
	.text-info {
  color: #3a87ad;
}

.text-info:hover {
  color: #2d6987;
}</style>
<body>
		<center>
			<h1 class="text-info text-center" style="font-family: "Exo 2", sans-serif;">
				<b>EazyShifting.com</b>
			</h1>
			<p class="lead text-center">
				Hi <span class="text-danger" style="font-family: "Skranji", cursive;letter-spacing: 2px;"><b>' . $pam_name . '</b></span> ,<br>We are happy to inform that you are successfully registered and submitted your shifting cart with EazyShifting.com.<br/>Here are your credentials,
			</p>
				<h3 style=""><dl class="dl-horizontal">
					<dt style="color:#0099cc;">
						Packer & Mover id
					</dt>
					<dd>' . $pam_id . ' </dd>
					<dt style="color:#0099cc;">
						Password
					</dt>
					<dd>
						' . $pam_password .
					'</dd>
				</dl>
				</h3>
			<p class="lead text-center">
				Be prepare to experience our service of its own kind.<br>Regards,<br>EazyShifting.com Team.
			</p>
			<p class="text-danger text-center">
				<b style="color:red;">Note:</b> The reply to this email address is not considered.
			</p>
			<div>
				
			</div>
			
		</center>
</body>
</html>
';
				Send_Mail($to,$subject,$body);
						
					$_SESSION['popup14'] = 1;
					header('Location: index.php');
			}
			else
			{
				$_SESSION['popup2'] = 1;	
				header('Location: index.php');
			}
}

if(isset($_POST['admin_forget_password']))
{
			$admin_email = $_POST['admin_email'];
			
			if(empty($admin_email))
			{
				$_SESSION['popup7'] = 1;	
				header('Location: index.php');
			}
			else
			{
				$count=mysqli_query($connection,"SELECT id FROM myyaara_admin WHERE admin_email = '$admin_email'");
			
				if(mysqli_num_rows($count) < 1)
				{	
					$_SESSION['popup8'] = 1;	
					header('Location: index.php');					
				}
				else
				{
					$admin = new Article;
					$admins = $admin->fetch_adminforgetpassword($admin_email);
					$admin_name = $admins['admin_name'];
					$admin_password = $admins['admin_password'];
					include 'smtp/Send_Mail.php';
				require_once('smtp/class.smtp.php');
				$to=$admin_email;
				$subject="Forget Password Myyaara.com";
				$body='<!DOCTYPE html>
<html lang="en">
<head>
  <link href="http://fonts.googleapis.com/css?family=Exo+2:900" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Skranji" rel="stylesheet" type="text/css">
	<style>

	.dl-horizontal dt {
    float: left;
    width: 160px;
    overflow: hidden;
    clear: left;
    text-align: right;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .dl-horizontal dd {
    margin-left: 180px;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
	
	.text-danger {
  color: #b94a48;
}

.text-danger:hover {
  color: #953b39;
}

	.lead {
  margin-bottom: 20px;
  font-size: 16px;
  font-weight: 200;
  line-height: 1.4;
}
	
	.text-center {
  text-align: center;
}
	.text-info {
  color: #3a87ad;
}

.text-info:hover {
  color: #2d6987;
}</style>
<body>
		<center>
			<h1 class="text-info text-center" style="font-family: "Exo 2", sans-serif;">
				<b>Myyaara.com</b>
			</h1>
			<p class="lead text-center">
				Hey <span class="text-danger" style="font-family: "Skranji", cursive;letter-spacing: 2px;"><b>' . $admin_name . '</b></span> ,<br>Looks like you have forgotten your PASSWORD. Here it is,<br/>
			</p>
				<h3 style=""><dl class="dl-horizontal">
					<dt style="color:#0099cc;">
						Password
					</dt>
					<dd>
						' . $admin_password .
					'</dd>
				</dl>
				</h3>
			<p class="lead text-center">
				Let\'s have fun now.<br>Regards,<br>Myyaara.com Team.
			</p>
			<p class="text-danger text-center">
				<b style="color:red;">Note:</b> The reply to this email address is not considered.
			</p>
			<div>
				
			</div>
			
		</center>
</body>
</html>
';
				Send_Mail($to,$subject,$body);
				
				$_SESSION['popup9'] = 1;	
				header('Location: index.php');
				}
			}
	}

if(isset($_POST['user_forget_password']))
{
			$user_email = $_POST['user_email'];
			
			if(empty($user_email))
			{
				$_SESSION['popup7'] = 1;	
				header('Location: index.php');
			}
			else
			{
				$count = mysqli_query($connection,"SELECT user_id FROM myyaara_user WHERE user_email = '$user_email'");
				if(mysqli_num_rows($count) < 1)
				{	
					$_SESSION['popup8'] = 1;	
					header('Location: index.php');
				}
				else
				{
					$user = new Article;
					$users = $user->fetch_userforgetpassword($user_email);
					$user_name = $users['user_name'];
					$user_password = $users['user_password'];
					include 'smtp/Send_Mail.php';
				require_once('smtp/class.smtp.php');
				$to=$user_email;
				$subject="Forget Password Myyaara.com";
				$body='<!DOCTYPE html>
<html lang="en">
<head>
  <link href="http://fonts.googleapis.com/css?family=Exo+2:900" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Skranji" rel="stylesheet" type="text/css">
	<style>

	.dl-horizontal dt {
    float: left;
    width: 160px;
    overflow: hidden;
    clear: left;
    text-align: right;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .dl-horizontal dd {
    margin-left: 180px;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
  .dl-horizontal dd:before,
  .dl-horizontal dd:after {
    display: table;
    content: " ";
  }
  .dl-horizontal dd:after {
    clear: both;
  }
	
	.text-danger {
  color: #b94a48;
}

.text-danger:hover {
  color: #953b39;
}

	.lead {
  margin-bottom: 20px;
  font-size: 16px;
  font-weight: 200;
  line-height: 1.4;
}
	
	.text-center {
  text-align: center;
}
	.text-info {
  color: #3a87ad;
}

.text-info:hover {
  color: #2d6987;
}</style>
<body>
		<center>
			<h1 class="text-info text-center" style="font-family: "Exo 2", sans-serif;">
				<b>Myyaara.com</b>
			</h1>
			<p class="lead text-center">
				Hey <span class="text-danger" style="font-family: "Skranji", cursive;letter-spacing: 2px;"><b>' . $user_name . '</b></span> ,<br>Looks like you have forgotten your PASSWORD. Here it is,<br/>
			</p>
				<h3 style=""><dl class="dl-horizontal">
					<dt style="color:#0099cc;">
						Password
					</dt>
					<dd>
						' . $user_password .
					'</dd>
				</dl>
				</h3>
			<p class="lead text-center">
				Let\'s have fun now.<br>Regards,<br>Myyaara.com Team.
			</p>
			<p class="text-danger text-center">
				<b style="color:red;">Note:</b> The reply to this email address is not considered.
			</p>
			<div>
				
			</div>
			
		</center>
</body>
</html>
';
				Send_Mail($to,$subject,$body);
				
				$_SESSION['popup9'] = 1;	
				header('Location: index.php');
				}
			}
	}

if(isset($_POST['pam_login']))
{ 
	$pam_email = $_POST['pam_email'];
	$pam_password = $_POST['pam_password'];

		$query = $pdo -> prepare("SELECT pam_email, pam_password FROM paminfo WHERE pam_email = ? AND pam_password= ?");
		$query->bindValue(1, $pam_email);
		$query->bindValue(2, $pam_password);
		$query->execute();
		$num = $query->rowCount();
		if($num==1)
		{	
			$_SESSION['pam_email'] = $pam_email;
			$_SESSION['pam_session'] = true;
			header('Location: index.php');
			exit();
		}
		if(!isset($_SESSION['pam_session']))
		{
			$_SESSION['popup5'] = 1;	
			header('Location: index.php');
		}
}
if(isset($_POST['update_pam_profile']))
{
	$pam_email = $_SESSION['pam_email'];
	$pam_name = $_POST['pam_name'];
	$pam_address = $_POST['pam_address'];
	$pam_city = $_POST['pam_city'];
	$pam_password = $_POST['pam_password'];
	$sql = "UPDATE paminfo SET pam_name = ?, pam_address = ?, pam_city = ?, pam_password = ? WHERE pam_email = ?";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $pam_name);
		$query->bindValue("2", $pam_address);
		$query->bindValue("3", $pam_city);
		$query->bindValue("4", $pam_password);
		$query->bindValue("5", $pam_email);
		$query->execute();
	
	$_SESSION['popup10'] = 1;	
	header('Location: index.php');
}

if(isset($_POST['submit_pamquote']))
{
	$order_id = $_GET['order_id'];
	$pam_id = $_GET['pam_id'];
	$pam_quote_value = $_POST['pam_quote_value'];
	$pam_service = $_POST['pam_service'];
		
	$query = $pdo->prepare('INSERT into pamquotes(order_id, pam_id, pam_quote_value, pam_service)values(?,?,?,?)');
		$query->bindValue(1, $order_id);
		$query->bindValue(2, $pam_id);
		$query->bindValue(3, $pam_quote_value);
		$query->bindValue(4, $pam_service);
		$query->execute();
	
	$_SESSION['popup9'] = 1;	
	header('Location: index.php');			
}

if(isset($_POST['submit_quote']))
{
	$order_id = $_GET['order_id'];
	$pam_id = $_POST['pam_id'];
	
	$sql = "UPDATE customer_shifting_cart SET pam_id = ? WHERE id = ?";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $pam_id);
		$query->bindValue("2", $order_id);
		$query->execute();
	
	$_SESSION['popup11'] = 1;	
	header('Location: index.php');			
}
if(isset($_POST['submit_pam_feedback']))
{
	$order_id = $_GET['order_id'];
	
	$pam_status = $_POST['pam_status'];
	$pam_customer_feedback = $_POST['pam_customer_feedback'];
	$pam_eazyshifting_feedback = $_POST['pam_eazyshifting_feedback'];
	
	$sql = "UPDATE customer_shifting_cart SET pam_customer_feedback = ?, pam_eazyshifting_feedback = ?, pam_status = ? WHERE id = ?";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $pam_customer_feedback);
		$query->bindValue("2", $pam_eazyshifting_feedback);
		$query->bindValue("3", $pam_status);
		$query->bindValue("4", $order_id);
		$query->execute();
	
	$_SESSION['popup12'] = 1;	
	header('Location: index.php');			
}

if(isset($_POST['submit_customer_feedback']))
{
	$order_id = $_GET['order_id'];
	
	$customer_status = $_POST['customer_status'];
	$customer_pam_feedback = $_POST['customer_pam_feedback'];
	$customer_eazyshifting_feedback = $_POST['customer_eazyshifting_feedback'];
	
	$sql = "UPDATE customer_shifting_cart SET customer_pam_feedback = ?, customer_eazyshifting_feedback = ?, customer_status = ? WHERE id = ?";
		$query = $pdo->prepare($sql);
		$query->bindValue("1", $customer_pam_feedback);
		$query->bindValue("2", $customer_eazyshifting_feedback);
		$query->bindValue("3", $customer_status);
		$query->bindValue("4", $order_id);
		$query->execute();
	
	$_SESSION['popup12'] = 1;	
	header('Location: index.php');			
}
if(isset($_POST['submit_message']))
{ 
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
	
		$query = $pdo->prepare('INSERT into myyaara_contactus(name,email,phone,message,timestamp)values(?,?,?,?,?)');
			$query->bindValue(1, $name);
			$query->bindValue(2, $email);
			$query->bindValue(3, $phone);
			$query->bindValue(4, $message);
			$query->bindValue(5, date('Y-m-d'));
			$result = $query->execute();
		
		$_SESSION['popup6'] = 1;	
		header('Location: index.php');	
}