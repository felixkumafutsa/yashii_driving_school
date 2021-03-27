<!DOCTYPE>
<html>
<?php require 'dbconfig.php';
session_start();
if (isset($_SESSION['user_data'])) {
  if ($_SESSION['user_data']['role']!='student') {
    header("Location:../../index.php?error=no user found");
  
}
}
else{
  header("Location:../../index.php?error=You are logged out, please log in");
}
 ?>
<head>
<title>Yashii</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../assets/w3css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
* {
  box-sizing: border-box;
}
body {
  background-color: #f1f1f1;
}
#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}
h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}
input.invalid {
  background-color: #ffdddd;
}
.tab {
  display: none;
}
button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}
button:hover {
  opacity: 0.8;
}
#prevBtn {
  background-color: #bbbbbb;
}
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}
.step.active {
  opacity: 1;
}
.step.finish {
  background-color: #4CAF50;
}
</style>
</head>
<body>
<div class="w3-bar w3-top w3-text-white w3-small w3-center" style="background-color: #032331; z-index:4;"> 
    <h2 class="w3-bar-item  w3-text-white" style="margin-left: 35%; color:white;"> <img src="../../assets/img/pic4.jpg" class="w3-round  w3-center" style="width:60px; height: 60px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YASHII DRIVING SCHOOL</h2>
</div>
   <div class=" w3-container">
  <center>

<div style="background-color: #032331; width: 1000px;color:white;">
<h3>Quiz Page</h3>
<p>Welcome to the quiz, please read all the following instructions.</p>
<ol>
  <li>Answer all questions</li>
  <li>Dont return to the Dashboard without answering all questions</li>
  <li>Click the return to return to Dashboard</li>
</ol>
</div>
<?php
if (isset($_POST['click']) || isset($_GET['start'])) {
@$_SESSION['clicks'] += 1 ;
$c = $_SESSION['clicks'];
if(isset($_POST['choice'])) { 
$student_choice = $_POST['choice'];
$firstname = $_SESSION['user_data']['firstname'];
$lastname = $_SESSION['user_data']['lastname'];
$course_name = "heavy weight full";
$score = $_SESSION['score'];
$fetchqry2 = "INSERT INTO  quiz_results (firstname, lastname, course_name, score ) VALUES('$firstname','$lastname',$course_name,'$score')";
$result2 = mysqli_query($con,$fetchqry2);
unset($score);
// $_SESSION['msg'] = "Quiz submitted successful";
// header("location:../home.php");
}


} else {
    $_SESSION['clicks'] = 0;
}

//echo($_SESSION['clicks']);
?>
<div class="bump">
  <br>
  <form><?php if($_SESSION['clicks']==0){ ?> 
      <button class="w3-button w3-round w3-small" name="start" float="left">
      <span>START QUIZ</span></button> <?php } ?>
    </form>
  </div>
<form action="Quizzie.php" method="post">
<table>
  <?php if(isset($c)) {   $fetchqry = "SELECT * FROM `quiz_questions` where question_id='$c'";
                $result=mysqli_query($con,$fetchqry);
                $num=mysqli_num_rows($result);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC); }
          ?>
<tr>
  <td>
    <h3>
      <br>
        <?php echo @$row['question_number'].'    '.@$row['question'];?>
      </h3>
  </td>
</tr> 
<?php if($_SESSION['clicks'] > 0 && $_SESSION['clicks'] < 4){ ?>
  <tr>
    <td><input required type="radio" name="choice" value="<?php echo $row['choice1'];?>">&nbsp;<?php echo $row['choice1']; ?><br>
  <tr>
    <td>
      <input required type="radio" name="choice" value="<?php echo $row['choice2'];?>">&nbsp;<?php echo $row['choice2'];?>
    </td>
  </tr>
  <tr>
    <td>
      <input required type="radio" name="choice" value="<?php echo $row['choice3'];?>">&nbsp;<?php echo $row['choice3']; ?>
    </td>
  </tr>
  <tr>
    <td><input required type="radio" name="choice" value="<?php echo $row['choice4'];?>">&nbsp;<?php echo $row['choice4']; ?><br><br><br>
    </td>
  </tr>
  <tr>
    <td>
      <button class="w3-button w3-small w3-round" name="click" >Next</button>
    </td>
  </tr>
 <?php }  ?>
  <form>
 <?php 
    $storeArray1 = Array($_SESSION['clicks']);
    if($_SESSION['clicks']>count($storeArray1)){
    $qry3 = "SELECT * FROM `quiz_questions`;";
    $result3 = mysqli_query($con,$qry3);
    // $storeArray = Array(); 
    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
      $student_choice = $_POST['choice'];
     if($student_choice==$row3['correct_choice']){
         @$_SESSION['score'] += 5 ;
         $total_score = $_SESSION['score'];
     }
}

 ?>


 <h2>Result</h2>
 <span>No. of Correct Answer:&nbsp;<?php echo $no = @$_SESSION['score'];
  ?></span><br>
 <span>Current Score:&nbsp<?php echo $no*count($storeArray1);
  ?></span>
<?php } ?>

</center>
</div>
</body>
</html>