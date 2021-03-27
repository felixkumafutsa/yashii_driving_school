<?php
session_start();
if (isset($_SESSION['user_data'])) {
  if ($_SESSION['user_data']['role']!='instructor') {
   header("Location:../index.php?error=no user found");
    //$_SESSION['success_msg'] = "<strong>welcome </strong>, ".$_SESSION['user_data']['username'];
  }
  
}
else{
  header("Location:../index.php?error=You are logged out, please log in");
}
//
$conn = new mysqli("localhost", "root", "", "yashii");

if (isset($_POST['add_quiz_question'])) {
$question_number = $_POST['question_number'];
$question = $_POST['question'];
$choice1= $_POST['choice1'];
$choice2 = $_POST['choice2'];
$choice3 =$_POST['choice3']; 
$choice4 =$_POST['choice4'];
$correct_choice =$_POST['correct_choice'];
$stmt = $conn->prepare("INSERT INTO quiz_questions (question_number, question, choice1, choice2, choice3, choice4, correct_choice) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssi", $question_number, $question, $choice1, $choice2, $choice3, $choice4, $correct_choice);
$stmt->execute();

if($stmt){
  header("location:home.php");
}
$stmt->close();
$conn->close();
  }
  

  //for removing stuff from database
   if (isset($_GET['remove_question'])) {
        $id = $_GET['remove_question'];
      mysqli_query($conn,"DELETE FROM quiz_questions WHERE question_id =$id");
  }

   if (isset($_GET['remove_payment'])) {
        $id = $_GET['remove_payment'];
      mysqli_query($conn,"DELETE FROM payment WHERE id =$id");
  }

?>
<!DOCTYPE html>
<html>
<title>Yashii</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="../assets/themes/w3-theme-grey.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assets/sweet alert/sweetalert.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-theme-l3">

<!-- Top container -->
<div class="w3-bar w3-top w3-text-white w3-small w3-center" style="background-color: #032331; z-index:4;">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
 
    <h5 class="w3-bar-item  w3-text-white" style="margin-left: 35%"> <img src="../assets/img/pic4.jpg" class="w3-round  w3-center" style="width:30px; height: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YASHII DRIVING SCHOOL</h5>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-text-white w3-animate-left" style="background-color:#1c526a; z-index:3;width:250px;" id="mySidebar"><br><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="../w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>
        <?php
        echo "Logged in as, ".$_SESSION['user_data']['username'];
        ?>
        
      </span><br>
      <button  class="w3-bar-item w3-button tablink" onclick="openDiv(event, 'profile')"><i class="fa fa-user fa-fw"></i></button>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <button  class="w3-bar-item w3-button tablink" onclick="openDiv(event, 'schedule')"><i class="fa fa-table fa-fw"></i>  Schedule</button>
    <button  class="w3-bar-item w3-button tablink" onclick="openDiv(event, 'student')"><i class="fa fa-users fa-fw"></i>  Students</button>
      <div class="w3-dropdown-hover">
    <button   class="w3-bar-item w3-button " ><i class="fa fa-envelope fa-fw"></i>  Quiz</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <button class="w3-bar-item w3-button tablink" onclick="openDiv(event, 'add_quiz')">Add Quiz Question</button>
      <button class="w3-bar-item w3-button tablink" onclick="openDiv(event, 'view_quiz')">View Quiz Question</button>
      <button class="w3-bar-item w3-button tablink" onclick="openDiv(event, 'quiz_results')">Quiz Results</button>
    </div>
  </div>
    <!-- <button  class="w3-bar-item w3-button tablink" onclick="openDiv(event, 'reports')"><i class="fa fa-archive fa-fw"></i> Reports</button> -->
    <a  class="w3-bar-item w3-button tablink" href="../includes/logout.php"><i class="fa fa-sign-out fa-fw"></i>  Logout</a>
    <br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
     <?php if (isset($_SESSION['msg'])): ?>
  <div class="w3-block w3-green w3-large w3-center">
    <?php 
      echo $_SESSION['msg']; 
      unset($_SESSION['msg']);
    ?>
  </div>
<?php endif ?>
  </header>


 <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div id="schedule" class="w3-container yashii" > 
       <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Id</th>
                  <th>Date</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Location</th>
                  <th>Course</th>
                
              </tr>
              <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT schedu.schdule_id, schedu.nthawi, schedu.nyengo, schedu.nyengo1, schedu.location, schedu.course_name, instructor.course_name FROM schedu INNER JOIN instructor ON schedu.course_name = instructor.course_name ";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['schdule_id']; ?></td>
                            <td><?php echo $row['nthawi']; ?></td>
                             <td><?php echo $row['nyengo']; ?></td>
                            <td><?php echo $row['nyengo1']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td><?php echo $row['course_name']; ?></td>
                          </tr>
                        <?php } ?>
  </table>
    
       
      </div>
   
    </div>
  </div>

    <div class="w3-row-padding" style="margin:0 -16px">
      <div id="student" class="w3-container yashii" style="display:none">
		         <h5>Student</h5>
      
      <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Id</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Gender</th>
                  <th>Age</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Course</th>
                  <th>TRN</th>
                  <th>Address</th>
              </tr>

                 <?php
                           $conn = mysqli_connect("localhost","root","","yashii");

                           $sql = "SELECT students.id, students.firstname, students.lname, students.email, students.mobile, students.email, students.course_name, students.TRN, students.nyumba, instructor.course_name FROM students INNER JOIN instructor ON students.course_name = instructor.course_name";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                           <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['firstname']; ?></td>
                             <td><?php echo $row['lname']; ?></td>
                             <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                             <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['TRN']; ?></td>
                            <td><?php echo $row['nyumba']; ?></td>
                          </tr>
                        <?php } ?>

        </table>
 
        
      </div>
   
    </div>




  

  <div id="add_quiz" class="w3-container yashii" style="display:none">
    <h5>Add Quiz Questions</h5>

<form class="w3-container" action="home.php" method="post">
        <div class="w3-section">
          <label><b>Question Number</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="Enter question number" name="question_number" required>
          <label><b>Question</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Enter question content" name="question" required> 
          <label><b>Choice 1</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter choice 1" name="choice1" required>
          <label><b>Choice 2</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter choice 2" name="choice2" required>
          <label><b>Choice 3</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter choice 3" name="choice3" required>
          <label><b>Choice 4</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter choice 4" name="choice4" required>
          <label><b>Correct Choice</b></label>
           <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter the correct choice" name="correct_choice" required>
        <br>
          <button class="w3-button  w3-green  " type="submit" name="add_quiz_question">Add Question</button><button onclick="document.getElementById('add_payment').style.display='none'"  class="w3-button w3-red w3-right">Cancel</button>
        </div>
      </form>

  </div>

  
  <div id="view_quiz" class="w3-container yashii" style="display:none">
    <h5>Question Questions</h5>
      
      <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Question Number</th>
                  <th>Question</th>
                  <th>Choice 1</th>
                  <th>Choice 2</th>
                  <th>Choice 3</th>
                  <th>Choice 4</th>
                  <th>Correct Choice</th>
                  <th colspan="2">Action</th>
              </tr>
              <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * from quiz_questions";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['question_number']; ?></td>
                             <td><?php echo $row['question']; ?></td>
                            <td><?php echo $row['choice1']; ?></td>
                             <td><?php echo $row['choice2']; ?></td>
                            <td><?php echo $row['choice3']; ?></td>
                             <td><?php echo $row['choice4']; ?></td>
                            <td><?php echo $row['correct_choice']; ?></td>
                           
                            <td >
                              <a name="edit_question" class="w3-button w3-small w3-round w3-green" onclick="document.getElementById('edit_question').style.display='block'" href="home.php?edit_question=<?php echo $row['question_id'];?>" ><i class="fa fa-pencil fa-fw"></i></a>
                            </td>
                            <td>
                              <a href="php/remove_content.php?quiz_question=<?php echo $row['question_id']?>" name="quiz_question" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
      </table>


  </div>


<div id="quiz_results" class="w3-container yashii" style="display:none">
    <h5>Quiz Results</h5>
      
      <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Id</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Course</th>
                  <th>Score</th>
                  <th>Date</th>
              </tr>
              <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * from quiz_results";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['score']; ?></td>                       
                            <td><?php echo $row['date']; ?></td>
                          </tr>
                        <?php } ?>
      </table>


  </div> 
  <!-- new profile-->
<div id="profile" class="w3-container yashii" style="display:none">
       
        <div class="w3-col w3-card-4 w3-padding">
          <form class="w3-container w3-margin w3-light-grey" action="php/update_profile.php" method="post">
            <h5>Update Profile</h5>
        <div class="w3-section">           
          <input type="text" class="w3-input w3-border w3-margin-bottom" value="<?php echo $_SESSION['user_data']['id']; ?>" name="id" hidden>
            <label><b>First Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="firstname" value="<?php echo $_SESSION['user_data']['firstname']; ?>" required>
            <label><b>Last Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="lastname" value="<?php echo $_SESSION['user_data']['lastname']; ?>" required>
          <label><b>User Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="username" value="<?php echo $_SESSION['user_data']['username']; ?>" required>
          <label><b>Email Address</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Email Address" name="email" value="<?php echo $_SESSION['user_data']['email']; ?>" required>
          <label><b>New  Password</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Enter New Password" name="password" ><br>
          <label><b>Upload new image</b></label>
          <input class="w3-input w3-border" type="file" placeholder="Enter Second installment" name="psw" >
          <input type="file" name="profile_picture" id="profile_input" value="" style="display: none;">
          <button class="w3-button  w3-green w3-small" name="update_profile" type="submit">Update</button>
          <button onclick="document.getElementById('profile').style.display='none'" type="reset" class="w3-button w3-red w3-right">Cancel</button>
        </div>
      </form>

        </div>
      
</div>
</div>
 
   <!-- Footer -->
 <div class="w3-bar w3-bottom w3-text-white w3-small w3-center" style="background-color: #032331; z-index:4">
  <span class="w3-bar-item " style="margin-left: 35%; ">&copy; Yashii Driving School</span>
</div>

  <!-- End page content -->
</div>

<script>

</script>
<script type="text/javascript" src="../assets/js/main.js"></script>
<script type="text/javascript" src="../assets/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../assets/pooper/pooper.min.js"></script>
<script type="text/javascript" src="../assets/sweet alert/sweetalert.js"></script>
<script type="text/javascript" src="../assets/sweet alert/sweetalert.min.js"></script>
</body>
</html>
