<?php
 $conn = new mysqli("localhost", "root", "", "yashii");
if (isset($_GET['edit_user'])) {
	   $id = $_GET['edit_user'];

	   $rec = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
	   $record = mysqli_fetch_array($rec);

	   $firstname = $record['firstname'];
	   $lastname = $record['lastname'];
	   $username = $record['username'];
	   $email = $record['email'];
	   $role = $record['role'];
	   $id = $record['id'];

        mysqli_query($conn,"UPDATE users SET id = '$id', firstname = '$firstname', lastname = '$lastname', username = '$username', email = '$email', password = '$password' WHERE id ='$id'");
		$_SESSION['msg'] = "User details updated successfuly";
		header('location:../home.php');
}

//edit payment
 if (isset($_POST['edit_payment'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email= $_POST['email'];
    $role = $_POST['role'];
    $id = $_POST['id'];
    mysqli_query($conn,"UPDATE users SET firstname = '$firstname', email = '$email', lastname = '$lastname', username = '$username', role = '$role' WHERE id ='$id'");
    $_SESSION['msg'] = "Payment info updated successfuly";
    header("location:home.php");
    
  }
//edit course
if (isset($_POST['update_course'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email= $_POST['email'];
    $role = $_POST['role'];
    $id = $_POST['id'];
    mysqli_query($conn,"UPDATE users SET firstname = '$firstname', email = '$email', lastname = '$lastname', username = '$username', role = '$role' WHERE id ='$id'");
    $_SESSION['msg'] = "Course info updated successfuly";
    header("location:home.php");
    
  }
//edit schedule
if (isset($_POST['update_schedule'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email= $_POST['email'];
    $role = $_POST['role'];
    $id = $_POST['id'];
    mysqli_query($conn,"UPDATE users SET firstname = '$firstname', email = '$email', lastname = '$lastname', username = '$username', role = '$role' WHERE id ='$id'");
    $_SESSION['msg'] = "Schedule updated successfuly";
    header("location:home.php");
    
  }

?>