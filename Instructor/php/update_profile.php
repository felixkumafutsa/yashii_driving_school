<?php
session_start();
if (isset($_SESSION['user_data'])) {
  if ($_SESSION['user_data']['role']!='student') {
  }
}
$conn = new mysqli("localhost", "root", "", "yashii");
 if (isset($_POST['update_profile'])) {
 		$firstname = $_POST['firstname'];
 		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$password = md5($_POST['password']) ;
		$email= $_POST['email'];
		$id = $_POST['id'];
		mysqli_query($conn,"UPDATE users SET firstname = '$firstname', email = '$email', lastname = '$lastname', username = '$username', password = '$password'  WHERE id ='$id'");
		$_SESSION['msg'] = "Profile updated successfuly";
		header('location:../home.php');
		
  }
?>