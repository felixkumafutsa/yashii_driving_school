<?php
$conn = new mysqli("localhost", "root", "", "yashii");
//add schedule
if (isset($_POST['submit_schedule'])) {
    $nthawi = $_POST['nthawi'];
    $nyengo = $_POST['nyengo'];
    $nyengo1= $_POST['nyengo1'];
    $location = $_POST['location'];
    $course =$_POST['course']; 
    $stmt = $conn->prepare("INSERT INTO schedu (nthawi, nyengo, nyengo1, location, course) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nthawi, $nyengo, $nyengo1, $location, $course);
    $stmt->execute();
    if($stmt){
      $_SESSION['msg'] = "Schedule added successfuly";
      header("location:../home.php");
      
    }
    $stmt->close();
    $conn->close();
}
?>