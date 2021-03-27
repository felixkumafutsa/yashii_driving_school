<?php
   $conn = new mysqli("localhost", "root", "", "yashii");
	if (isset($_GET['quiz_question'])) {
        $id = $_GET['quiz_question'];
      mysqli_query($conn,"DELETE FROM quiz_questions WHERE question_id =$id");
      $_SESSION['msg'] = "Quiz question removed successfuly";
      header("location:../home.php");
  }
?>