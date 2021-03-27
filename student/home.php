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
$conn = new mysqli("localhost", "root", "", "yashii");
?>
<!DOCTYPE html>
<html>
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

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
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

/* Make circles that indicate the steps of the form: */
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

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-text-white w3-small w3-center" style="background-color: #032331; z-index:4;">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
 
    <h5 class="w3-bar-item  w3-text-white" style="margin-left: 35%"> <img src="../assets/img/pic4.jpg" class="w3-round  w3-center" style="width:30px; height: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YASHII DRIVING SCHOOL</h5>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-text-white w3-collapsew3-animate-left" style="background-color:#1c526a; z-index:3;width:250px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="../assets/img/avatar.jpg" name="profile_img" class="w3-round w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>

        <?php
        echo "Logged in as, ".$_SESSION['user_data']['username'].": Student";
        ?>
      </span><br>
      <button  class="w3-bar-item w3-button w3-small" onclick="openDiv(event, 'messages')">
        <?php 
          
          $sql = "SELECT * FROM student_messages WHERE reciever_email = '".$_SESSION['user_data']['email']."' ";
          $result = $conn->query($sql);
          $messages = mysqli_fetch_assoc($result);
          $message_count = count($messages);
          echo '<i class="fa fa-envelope"></i><sup class="w3-badge w3-green">'.$message_count.'</sup>';
        ?>
          
      </button>
       <button class="w3-bar-item w3-button w3-small" onclick="openDiv(event, 'profile')"><i class="fa fa-user"></i></button>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button  w3-round w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <button  class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'transactions')"><i class="fa fa-table fa-fw"></i>  Transactions</button>
    <button  class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'schedule')"><i class="fa fa-table fa-fw"></i>  Schedule</button>
    <button  class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'book_exam')"><i class="fa fa-book fa-fw"></i>  Book Exam</button>
    <button  class="w3-bar-item w3-button  w3-round " onclick="openDiv(event, 'exam_results')"><i class="fa fa-archive fa-fw"></i>  Exam Results</button>
     <a href="php/Quizzie.php" class="w3-bar-item w3-button w3-round tablink" onclick="openDiv(event, 'take_exam')"><i class="fa fa-pencil fa-fw"></i> Take Exam</a>
    <button  class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'messages')"><i class="fa fa-envelope fa-fw"></i>View Messages</button>
     <div class="w3-dropdown-hover">
    <button   class="w3-bar-item w3-button  w3-round " ><i class="fa fa-send fa-fw"></i>Send Message</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <button class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'send_message')">To One</button>
      <button class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'send_broadcast_message')">Broadcast</button>
    </div>
  </div>
     <a  class="w3-bar-item w3-button  w3-round tablink" href="../includes/logout.php"><i class="fa fa-sign-out fa-fw"></i>  Logout</a>
    <br><br>
  </div>
</nav>
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
    <div class="w3-row-padding" style="margin:0 -16;display:none">
      <div id="registration" class="w3-container yashii" >
		<h5>Course Registration</h5>

          <form id="regForm" action="php/register_course.php" method="post">
  <h1>Register:</h1>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">Name:
    <p><input type="text" placeholder="First name..." oninput="this.className = ''" name="firstname"></p>
    <p><input type="text" placeholder="Last name..." oninput="this.className = ''" name="lname"></p>
  </div>
  <div class="tab">Demographic Info:
    <p><input type="text" placeholder="Gender" oninput="this.className = ''" name="gender"></p>
    <p><input type="number" placeholder="Age" oninput="this.className = ''" name="age"></p>
  </div>
   <div class="tab">Contact Info:
    <p><input type="text" placeholder="phone" oninput="this.className = ''" name="mobile"></p>
    <p><input type="email"  placeholder="email" oninput="this.className = ''" name="email"></p>
    <p><input type="text"  placeholder="Physical Address" oninput="this.className = ''" name="nyumba"></p>
  </div> 
  <div class="tab">Course Details:
    <p><input type="text"  placeholder="TRN" oninput="this.className = ''" name="TRN"></p>
    <p><select class="form-control" name ="course">
              <option onselect="this.className = ''">heavy weight</option>
              <option onselect="this.className = ''">light weight</option>
    </select></p>
   <!--  <p><input placeholder="Course name" oninput="this.className = ''" name="course name" type="text"></p> -->
  <!--   <p><input placeholder="Duration" oninput="this.className = ''" name="duration"></p>
    <p><input placeholder="Fees" oninput="this.className = ''" name="fees"></p> -->
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" class="w3-small w3-round" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" class="w3-small w3-round" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>
       
      </div>
    </div>
  </div>


  

  <div id="transactions" class="w3-container yashii" >
    <h5>Transactions</h5>

     <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Id</th>
                  <th>First Installment</th>
                  <th>Second installment</th>
                  <th>Balance</th>
              </tr>

                 <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $session_variable = $_SESSION['user_data']['firstname'];

                          $sql = "SELECT * FROM payment WHERE firstname = '".$_SESSION['user_data']['firstname']."'";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['first_installment']; ?></td>
                             <td><?php echo $row['second_installment']; ?></td>
                            <td><?php echo $row['balance']; ?></td>
                          </tr>
                        <?php } ?>

        </table>
    
  </div>

  


  <div id="schedule" class="w3-container yashii" style="display:none">
    <h5>Schedule</h5>
    	
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
                           $session_variable = $_SESSION['user_data']['firstname'];
                           $sql = "SELECT schedu.schdule_id, schedu.nthawi, schedu.nyengo, schedu.nyengo1, schedu.location, schedu.course_name, students.course_name FROM schedu INNER JOIN students ON schedu.course_name = students.course_name ";
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

  

  <div id="messages" class="w3-container yashii" style="display:none">
    <h5>Messages</h5>
  
    	  <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                <th>Sender</th>
                <th>Subject</th>
                <th>Content</th>
                <th>Date</th>
                <th colspan="2">Action</th>
            </tr>

            <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                          $sql = "SELECT * FROM student_messages WHERE reciever_email = '".$_SESSION['user_data']['email']."'";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            
                            <td><?php echo $row['sender_email']; ?></td>
                            
                             <td><?php echo $row['subject']; ?></td>
                            
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                           <td>
                              <button class="w3-button w3-small w3-green w3-round tablink" onclick="openDiv(event, 'send_message')"><i class="fa fa-reply fa-fw" ></i></button>  
                            </td>
                            <td>
                              <a href="php/remove_content.php?remove_message=<?php echo $row['id']?>" name="remove_payment" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
        </table>

  </div>
  
 <div id="send_message" class="w3-container yashii" style="display:none">
    <h5>Send Message to One</h5>
        <form class="w3-container w3-card-4 w3-light-grey  w3-margin" action="php/send_message.php" method="post">
        <div class="w3-section">
          <label><b>Send to</b></label>
         <select class="form-control" name="recipient">
              <option>--select recipient--</option>
              <option>secretary</option>
              <option>manager</option>
              <option>student</option>
            </select>
          <input class="w3-input w3-border w3-margin-bottom" type="email" value="<?php echo $_SESSION['user_data']['email']; ?>"  name="sender_email" hidden>
          <label><b>Reciever email</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Reciever Email" name="reciever_email" required>
          <label><b>Subject</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Message Subject" name="subject" required>
          <label><b>Content</b></label>
          <textarea type="text" class="w3-input w3-border" name="content" style="resize:vertical;"></textarea>
          <label><b>Date</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="date" value="" name="date" required>
          <button class="w3-button w3-green w3-small w3-round w3-section w3-padding" type="submit" name="send_message">Send</button>
           <button class="w3-button w3-green w3-small w3-round w3-section w3-padding w3-right" type="reset" name="send_message">Cancel</button>
        </div>
      </form>


  </div>

   <div id="send_broadcast_message" class="w3-container yashii" style="display:none">
    <h5>Send Broadcast Message</h5>
        <form class="w3-container w3-card-4 w3-light-grey  w3-margin" action="php/send_message.php" method="post">
        <div class="w3-section">
           <input class="w3-input w3-border w3-margin-bottom" type="email" value="<?php echo $_SESSION['user_data']['email']; ?>"  name="sender_email" hidden>
          <label><b>Subject</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Message Subject" name="subject" required>
          <label><b>Content</b></label>
          <textarea type="text" class="w3-input w3-border" name="content" style="resize:vertical;"></textarea>
          <label><b>Date</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="date" value="" name="date" required>
          <button class="w3-button w3-green w3-small w3-round w3-section w3-padding" type="submit" name="send_broadcast_message">Send</button>
           <button class="w3-button w3-green w3-small w3-round w3-section w3-padding w3-right" type="reset" name="send_message">Cancel</button>
        </div>
      </form>


  </div>

  <div id="book_exam" class="w3-container yashii" style="display:none">
   
  <h5>Book Exam</h5>
<form class="w3-container w3-card-4 w3-light-grey  w3-margin" action="php/book_exam.php" method="post">
        <div class="w3-section">
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $_SESSION['user_data']['firstname']; ?>" name ="firstname" hidden>
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $_SESSION['user_data']['lastname']; ?>" name ="lastname" hidden>
          <label><b>TRN</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Traffic Road Number" name="TRN" required>
          <label><b>Course</b></label>
         <select class="form-control" name="course_name">
              <option>--select course--</option>
              <option>heavy weight</option>
              <option>light weight</option>
            </select>
            <label><b>Date</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="date" placeholder="" name="date" required>
           <button class="w3-button  w3-green w3-small w3-round w3-section w3-padding" type="submit"type="reset" name="submit_exam_booking"><i class="fa fa-send fa-fw"> </i>Book exam</button>
          <button class="w3-button  w3-red w3-section w3-small w3-round w3-padding w3-right" ><i class="fa fa-close fa-fw"></i> Cancel</button>
        </div>
      </form>



  </div>

  

  <div id="exam_results" class="w3-container yashii" style="display:none">
    <h5>Exam Results</h5>
    	 <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Id</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Score</th>
                  <th>Date</th>
              </tr>

              <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * FROM quiz_results WHERE firstname = '".$_SESSION['user_data']['firstname']."'";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
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
           <label><b>Physical Address</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Physical Address" name="address" value="<?php echo $_SESSION['user_data']['address']; ?>" required>
           <label><b>Phone Number</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Phone Number" name="mobile" value="<?php echo $_SESSION['user_data']['mobile']; ?>" required>
          <label><b>New  Password</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Enter New Password" name="password" ><br>
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
