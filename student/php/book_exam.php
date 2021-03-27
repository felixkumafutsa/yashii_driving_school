<?php
	session_start();
	if (isset($_SESSION['user_data'])) {
	  if ($_SESSION['user_data']['role']!='student') {
	    header("Location:../index.php?error=no user found");
	  
	}
	}
	else{
	  header("Location:../index.php?error=You are logged out, please log in");
	}
	$conn = new mysqli("localhost", "root", "", "yashii");
	if (isset($_POST['submit_exam_booking'])) {
		$fees_balance_check ="SELECT * FROM payment WHERE firstname = '".$_SESSION['user_data']['firstname']."'";
		$result = $conn->query($fees_balance_check);
		$row = mysqli_fetch_array($result);
		if ($row['balance'] == 0) {
			$TRN = $_POST['TRN'];
			$firstname = $_POST['firstname'];
			$lastname  = $_POST['lastname'];
			$course_name =$_POST['course_name']; 

			$stmt = $conn->prepare("INSERT INTO exam (TRN, firstname, lastname, course_name) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("ssss", $TRN, $firstname, $lastname, $course_name);


			$stmt->execute();

			if($stmt){
			  header("location:../home.php");
			}
			$stmt->close();
			$conn->close();
		}
		else{
			$_SESSION['msg'] = "You have outstanding fees balance";
			 header("location:../home.php");
		}
	}

?>