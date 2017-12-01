<?php
	session_start();
	if(isset($_SESSION['user_session']) && !empty($_SESSION['user_session'])){
		include_once('../includes/connection.php');
		$lenArr = count($_POST);
		$indxVal = 0;
		$query = "UPDATE myyaara_user SET ";
		foreach($_POST as $index =>$value){
			$indxVal++;
			if($index == 'user_Paragraph_selection')
				$value = htmlspecialchars($value);
			if($indxVal< $lenArr)
				$query .= "`$index` = '$value' , ";
			else
				$query .= "`$index` = '$value' ";
		}
		 $query.= "where user_email = '".$_SESSION['user_email']."'";
		if(mysqli_query($connection,$query))
			echo "updated";
		else
			echo "error";
	}
	else{
		$_SESSION['popup5'] = 1;	
		header('Location: ../index.php');
	}
	//var_dump($_POST);
?>
		