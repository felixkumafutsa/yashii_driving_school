<?php
		session_start();
if (isset($_SESSION['user_data'])) {
  if ($_SESSION['user_data']['role']!='student') {
    header("Location:../index.php?error=no user found");
  
}
}
else{
  header("Location:../index.php?error=You are logged out, please log in");
}
		if (isset($_POST['submit_quiz'])) {
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
			// set parameters and execute
			$stmt->bind_param("si",$student, $score );
			$stmt->execute();

				 if($stmt){
				 	$_SESSION['msg'] = "Quiz submitted successfuly";
				     header("location:home.php");
				    
				 }
				 else{
				  echo "silly nigga";
				 }
			$stmt->close();
			$conn->close();
		}
	}

?>