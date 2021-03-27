<?php 
$conn = new mysqli("localhost", "root", "", "yashii");
		//add course
if (isset($_POST['add_course'])) {
      $course_name = $_POST['course_name'];
      $duration = $_POST['duration'];
      $fees =$_POST['fees']; 
      $stmt = $conn->prepare("INSERT INTO course (course_name, duration, fees) VALUES (?, ?, ?)");
      $stmt->bind_param("sii", $course_name, $duration, $fees);
      $stmt->execute();
      if($stmt){
        $_SESSION['msg'] = "Course added successfuly";
        header("location:../home.php");
      }
      $stmt->close();
      $conn->close();
}

 ?>