<?php
   $conn = new mysqli("localhost", "root", "", "yashii");
	

  if (isset($_GET['remove_message'])) {
        $id = $_GET['remove_message'];
      mysqli_query($conn,"DELETE FROM manager_messages WHERE id =$id");
      $_SESSION['msg'] = "Message removed successfuly";
      header("location:../home.php");
  }

  if (isset($_GET['remove'])) {
        $id = $_GET['remove'];
      mysqli_query($conn,"DELETE FROM exam WHERE Id =$id");
      $_SESSION['msg'] = "Exam booking removed successfuly";
      header("location:../home.php");
  }

  if (isset($_GET['remove_traffic'])) {
        $id = $_GET['remove_traffic'];
      mysqli_query($conn,"DELETE FROM road_traffic WHERE Id =$id");
      $_SESSION['msg'] = "Exam booking removed successfuly";
      header("location:../home.php");
  }
?>