<?php
   $conn = new mysqli("localhost", "root", "", "yashii");
  if (isset($_GET['remove_message'])) {
        $id = $_GET['remove_message'];
      mysqli_query($conn,"DELETE FROM student_messages WHERE id =$id");
      $_SESSION['msg'] = "Message removed successfuly";
      header("location:../home.php");
  }
?>