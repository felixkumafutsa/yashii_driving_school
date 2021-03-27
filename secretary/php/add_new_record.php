<?php
$conn = new mysqli("localhost", "root", "", "yashii");
//add schedule
if (isset($_POST['insert_new'])) {
    $TRN= $_POST['TRN'];
    $firstname = $_POST['firstname'];
    $lastname= $_POST['lastname'];
    $course_name = $_POST['course_name'];
    $status =$_POST['status']; 
    $stmt = $conn->prepare("INSERT INTO road_traffic ( TRN, firstname, lastname, course_name, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $TRN, $firstname, $lastname, $course_name, $status);
    $stmt->execute();
    if($stmt){
      $_SESSION['msg'] = "New Record added successfuly";
      header("location:../home.php");
      
    }
    $stmt->close();
    $conn->close();
}
?>