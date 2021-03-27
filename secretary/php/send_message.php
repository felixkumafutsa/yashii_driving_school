
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
	if (isset($_POST['send_message'])) {
		$sender_email = $_POST['sender_email'];
		$reciever_email = $_POST['reciever_email'];
		$subject =$_POST['subject']; 
		$content =$_POST['content']; 
		if ($_POST['recipient'] == 'secretary') {
			$stmt = $conn->prepare("INSERT INTO secretary_messages (sender_email, subject, content) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $sender_email, $subject, $content);
			$stmt->execute();
			if($stmt){
				$_SESSION['msg'] = "Message sent successfuly";
			  header("location:../home.php");
			}
			$stmt->close();
			$conn->close();
		}
		elseif ($_POST['recipient'] == 'manager') {
			$sender_email = $_POST['sender_email'];
			$subject =$_POST['subject']; 
			$content =$_POST['content'];
			$stmt = $conn->prepare("INSERT INTO manager_messages (sender_email, subject, content) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $sender_email, $subject, $content);
			$stmt->execute();
			if($stmt){
				$_SESSION['msg'] = "Message sent successfuly";
			  header("location:../home.php");
			}
			$stmt->close();
			$conn->close();
		}
		elseif ($_POST['recipient'] == 'student') {
			$sender_email = $_POST['sender_email'];
			$reciever_email = $_POST['reciever_email'];
			$subject =$_POST['subject']; 
			$content =$_POST['content'];
			$stmt = $conn->prepare("INSERT INTO student_messages (sender_email, reciever_email, subject, content) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("ssss", $sender_email, $reciever_email, $subject, $content);
			$stmt->execute();
			if($stmt){
				$_SESSION['msg'] = "Message sent successfuly";
			  header("location:../home.php");
			}
			$stmt->close();
			$conn->close();
		}
		else{
			 $_SESSION['msg'] = "Message not sent, recipient not found";
			 header("location:../home.php");
		}
		
   }

  	if (isset($_POST['send_broadcast_message'])) {
		$sender_email = $_POST['sender_email'];
		$subject =$_POST['subject']; 
		$content =$_POST['content']; 
		$stmt = $conn->prepare("INSERT INTO broadcast_messages (sender_email,  subject, content) VALUES ( ?, ?, ?)");
		$stmt->bind_param("sss", $sender_email, $subject, $content);
		$stmt->execute();
		if($stmt){
			$_SESSION['msg'] = "Message sent successfuly";
		  header("location:../home.php");
		}
		$stmt->close();
		$conn->close();
   }
  ?>