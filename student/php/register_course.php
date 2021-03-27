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

if ($_SERVER["REQUEST_METHOD"] == "POST"){

		$firstname =$_POST['firstname'];
		$lname = $_POST['lname'];
		$gender =$_POST['gender'];
		$age = $_POST['age'];
		$mobile =$_POST['mobile'];
		$email= $_POST['email'];
		$course =$_POST['course']; 
		$TRN =$_POST['TRN']; 
		$nyumba = $_POST['nyumba'];
		

				 if($age<= 18){

				 		$_SESSION['msg'] = "You are not allowed to take any driving course";
				     	header("location:register.php");
				 }
				 else{
				 		$stmt = $conn->prepare("INSERT INTO students (firstname, lname, gender, age, mobile, email, course, TRN, nyumba) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)");
						$stmt->bind_param("sssisssss", $firstname, $lname, $gender, $age,  $mobile, $email, $course , $TRN, $nyumba);
						$stmt->execute();
						if($stmt){
					        $_SESSION['msg'] = "Course registered successfuly";
					        header("location:../home.php");
					      }
				 }
		  $stmt->close();
		  $conn->close();
}  

?>