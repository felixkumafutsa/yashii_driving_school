<?php
session_start();
if (isset($_SESSION['user_data'])) {
  if ($_SESSION['user_data']['role']!='manager') {
  }
}
$conn = new mysqli("localhost", "root", "", "yashii");
 if (isset($_POST['update_profile'])) {
 		$firstname = $_POST['firstname'];
 		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$password = $_POST['email'];
		$email= md5($_POST['password']);
		$id = $_POST['id'];

		// prepare and bind
		mysqli_query($conn,"UPDATE users SET firstname = '$firstname', email = '$email', lastname = '$lastname', username = '$username', password = '$password'  WHERE id ='$id'");
		header('location:../home.php');
		$_SESSION['msg'] = "Profile updated successfuly";
		
  }
?>