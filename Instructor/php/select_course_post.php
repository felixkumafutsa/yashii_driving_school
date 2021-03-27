<?php
session_start();
if (isset($_SESSION['user_data'])) {
  if ($_SESSION['user_data']['role']!='instructor') {
    header("Location:../index.php?error=no user found");
  
}
}
else{
  header("Location:../index.php?error=You are logged out, please log in");
}
$conn = new mysqli("localhost", "root", "", "yashii");

if ($_SERVER["REQUEST_METHOD"] == "POST"){

		$firstname =$_POST['firstname'];
		$lname = $_POST['lname'];
		
		$mobile =$_POST['mobile'];
		$email= $_POST['email'];
		$course =$_POST['course_name'];  
		$nyumba = $_POST['address'];
		$stmt = $conn->prepare("INSERT INTO instructor (firstname, lastname,  email, mobile, course_name, address) VALUES ( ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssss", $firstname, $lname,  $email, $mobile, $course ,  $nyumba);
		$stmt->execute();

				 if($stmt){
				 	$_SESSION['msg'] = "Course selected successfuly";
				     header("location:../home.php");
				 }
				 else{
				  echo "silly nigga";
				 }
		  $stmt->close();
		  $conn->close();
}  

?>