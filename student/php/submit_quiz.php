<?php
$conn = new mysqli("localhost", "root", "", "yashii");
if (isset($_POST['click'])) {
     $conn = mysqli_connect("localhost","root","","yashii");
     $sql = "SELECT * from quiz_questions";
     $result = $conn->query($sql);
     $row = mysqli_fetch_array($result);
     $correct_choice = $row;
     $student_choices =  array($_POST['choice']);
     $score = 0;

     foreach ($student_choices as $student_choice) {
      foreach ($correct_choices as $correct_choice) {
         if ($student_choice === $correct_choice) {
            $score += 5;
           }
      }
      
      $stmt = $conn->prepare("INSERT INTO quiz_results (student, score) VALUES (?, ?)");
      $stmt->bind_param("si",$student, $score );
      $stmt->execute();
         if($stmt){
             print_r($_POSTT);
         }
         else{
          echo "silly nigga";
         }
      $stmt->close();
      $conn->close();
    }
  }

?>