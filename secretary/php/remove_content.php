<?php

	
   $conn = new mysqli("localhost", "root", "", "yashii");
	if (isset($_GET['remove_user'])) {
        $id = $_GET['remove_user'];
      mysqli_query($conn,"DELETE FROM users WHERE id =$id");
      $_SESSION['msg'] = "User removed successfuly";
      header("location:../home.php");
  }

   if (isset($_GET['remove_payment'])) {
        $id = $_GET['remove_payment'];
      mysqli_query($conn,"DELETE FROM payment WHERE id =$id");
      $_SESSION['msg'] = "Payment removed successfuly";
      header("location:../home.php");
  }

  if (isset($_GET['remove_course'])) {
        $id = $_GET['remove_course'];
      mysqli_query($conn,"DELETE FROM course WHERE id =$id");
      $_SESSION['msg'] = "Course removed successfuly";
      header("location:../home.php");
  }

  if (isset($_GET['remove_message'])) {
        $id = $_GET['remove_message'];
      mysqli_query($conn,"DELETE FROM secretary_messages WHERE id =$id");
      $_SESSION['msg'] = "Message removed successfuly";
      header("location:../home.php");
  }

  if (isset($_GET['remove_schedule'])) {
        $id = $_GET['remove_schedule'];
      mysqli_query($conn,"DELETE FROM schedu WHERE schdule_id =$id");
      $_SESSION['msg'] = "Schedule removed successfuly";
      header("location:../home.php");
  }
?>