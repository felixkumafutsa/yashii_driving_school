<?php
session_start();
if (isset($_SESSION['user_data'])) {
  if ($_SESSION['user_data']['role']!='secretary') {
    header("Location:../index.php?error=no user found");
   
  }
  
}
else{
  header("Location:../index.php?error=You are logged out, please log in");
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
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-theme-l3">

<!-- Top container -->
<div class="w3-bar w3-top w3-text-white w3-small w3-center" style="background-color: #032331;z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <h5 class="w3-bar-item  w3-text-white" style="margin-left: 35%"> <img src="../assets/img/pic4.jpg" class="w3-round  w3-center" style="width:30px; height: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YASHII DRIVING SCHOOL</h5>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-text-white w3-animate-left" style="background-color:#1c526a; z-index:3;width:250px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="../assets/img/avatar.jpg" name="profile_img" class="w3-round w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span> 
       <?php
        echo "Logged in as, ".$_SESSION['user_data']['username'];
        ?>
      </span><br>
       <button  class="w3-bar-item w3-button w3-small" onclick="openDiv(event, 'messages')">
        <?php 
           $conn = new mysqli("localhost", "root", "", "yashii");
          $sql = "SELECT * FROM secretary_messages";
          $result = $conn->query($sql);
          $messages = mysqli_fetch_array($result);
          $message_count = count($messages);
          echo '<i class="fa fa-envelope"></i><sup class="w3-badge w3-green">'.$message_count.'</sup>';
        ?>
          
      </button>
       <button href="#" class="w3-bar-item w3-button w3-small" onclick="openDiv(event, 'profile')"><i class="fa fa-user"></i></i></button>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5> Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <button   class="w3-bar-item w3-button w3-round tablink" onclick="openDiv(event, 'all_users')"><i class="fa fa-users fa-fw"></i>  All Users</button>

    <button   class="w3-bar-item w3-button w3-round tablink" onclick="openDiv(event, 'accounts')"><i class="fa fa-money fa-fw"></i>  Accounts</button>

    <button  class="w3-bar-item w3-button w3-round tablink" onclick="openDiv(event, 'courses')"><i class="fa fa-table fa-fw"></i>  Courses</button>

    <button  class="w3-bar-item w3-button w3-round tablink" onclick="openDiv(event, 'schedule')"><i class="fa fa-table fa-fw"></i>  Schedule</button>

    <button  class="w3-bar-item w3-button w3-round tablink" onclick="openDiv(event, 'road_traffic')"><i class="fa fa-table fa-fw"></i>Road Traffic Results</button>

    <button  class="w3-bar-item w3-button w3-round tablink" onclick="openDiv(event, 'student')"><i class="fa fa-book fa-fw"></i>  Student</button>

    <button  class="w3-bar-item w3-button w3-round tablink" onclick="openDiv(event, 'instructor')"><i class="fa fa-user fa-fw"></i>  Instructor</button>

     <button  class="w3-bar-item w3-button w3-round tablink" onclick="openDiv(event, 'manager')"><i class="fa fa-user fa-fw"></i>  Manager</button>
      <button  class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'messages')"><i class="fa fa-envelope fa-fw"></i>View Messages</button>
       <div class="w3-dropdown-hover">
    <button   class="w3-bar-item w3-button  w3-round " ><i class="fa fa-send fa-fw"></i>Send Message</button>

    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <button class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'send_message')">To One</button>

      <button class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'send_broadcast_message')">Broadcast</button>
    </div>
  </div>
      <a  class="w3-bar-item w3-button w3-round tablink" href="../includes/logout.php"><i class="fa fa-sign-out fa-fw"></i>  Logout</a>
    <br><br>
  </div>
</nav>
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
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

<!--/*/////////////////////////////////////////////////////////////////////////////////////////////////////// /[ forms for editing content in the database ]/////////////////////////////////////// ////////////////////////////////////////////////////////////////////////////*/-->

    <div id="edit_user" class="w3-container yashii" style="display:none">
    <h5>Courses</h5>
        <form class="w3-container" action="edit_user.php" method="post">
        <div class="w3-section">
          <div class="w3-container w3-center w3-block w3-text-white">
            <h5 style="background-color:   #032331;"><i class="fa fa-pencil"></i> Edit User</h5>
          </div>
          <label><b>First Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $firstname; ?>" name="firstname" required>
          <label><b>Last Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $lastname; ?>" name="lastname" required>
          <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $username; ?>" name="username" required>
        
          <label><b>Email</b></label>
          <input class="w3-input w3-border" type="email" value="<?php echo $email; ?>" name="email" required>         
           <label><b>Role</b></label>
          <input class="w3-input w3-border" type="text" value="<?php echo $role; ?>" name="role" required>
          <br>
          <button class="w3-button  w3-green w3-small w3-round w3-padding" type="submit" name="update_user">Update</button>
          <button onclick="document.getElementById('edit_user').style.display='none'" type="button" class="w3-button w3-small w3-round w3-red w3-padding w3-right">Cancel</button>
        </div>
      </form> 

    
  </div>









<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////[ Modals for updating database content ]////////////////////////////////////////// ///////////////////////////////////////////////////////////////////////////////////////////////////-->
    <!--.......edit user modal.......-->
  <div id="edit_user" class="w3-modal">
    <div class="w3-modal-content w3-round w3-card-4 w3-animate-zoom  w3-light-grey" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('edit_user').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" action="edit_user.php" method="post">
        <div class="w3-section">
          <div class="w3-container w3-center w3-block w3-text-white">
            <h5 style="background-color:   #032331;"><i class="fa fa-pencil"></i> Edit User</h5>
          </div>
          <label><b>First Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $firstname; ?>" name="firstname" required>
          <label><b>Last Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $lastname; ?>" name="lastname" required>
          <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $username; ?>" name="username" required>
        
          <label><b>Email</b></label>
          <input class="w3-input w3-border" type="email" value="<?php echo $email; ?>" name="email" required>         
           <label><b>Role</b></label>
          <input class="w3-input w3-border" type="text" value="<?php echo $role; ?>" name="role" required>
          <br>
          <button class="w3-button  w3-green w3-small w3-round w3-padding" type="submit" name="update_user">Update</button>
          <button onclick="document.getElementById('edit_user').style.display='none'" type="button" class="w3-button w3-small w3-round w3-red w3-padding w3-right">Cancel</button>
        </div>
      </form> 

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        
      </div>

    </div>

  </div>
   
      <!--.......edit course modal.......-->
  <div id="edit_course" class="w3-modal">
    <div class="w3-modal-content w3-round w3-card-4 w3-animate-zoom  w3-light-grey" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('edit_user').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" action="edit_user.php" method="post">
        <div class="w3-section">
          <div class="w3-container w3-center w3-block w3-text-white">
            <h5 style="background-color:   #032331;"><i class="fa fa-pencil"></i> Edit Course</h5>
          </div>
        <div class="w3-section">
          <label><b>Course Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Course Name" name="course_name" required>
          <label><b>Duration</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Duration in months" name="duration" required>
          <label><b>Fees</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Fees" name="fees" required>
          <br>
          <button class="w3-button w3-green w3-small w3-round  w3-padding" type="submit" name="edit_course">Add</button>
           <button onclick="document.getElementById('edit_course').style.display='none'" type="button" class="w3-button w3-small w3-round w3-red w3-right w3-padding">Cancel</button>
        </div>
      </form> 

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        
      </div>

    </div>

  </div>

  <!--.......edit schedule modal.......-->
  <div id="edit_schedule" class="w3-modal">
    <div class="w3-modal-content w3-round w3-card-4 w3-animate-zoom  w3-light-grey" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('edit_schedule').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" action="edit_user.php" method="post">
        <div class="w3-section">
          <div class="w3-container w3-center w3-block w3-text-white">
            <h5 style="background-color:   #032331;"><i class="fa fa-pencil"></i> Edit Schedule</h5>
          </div>
        <div class="w3-section">
          <label><b>Date</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="date" placeholder="Date" name="nthawi" required>
          <label><b>Start Timet</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Start time" name="nyengo" required>
          <label><b>End Time</b></label>
          <input class="w3-input w3-border" type="text" placeholder="End time" name="nyengo1" required>
           <label><b>Location</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Location" name="location" required>
           <label><b>Course</b></label>
            <select class="form-control" name ="course">
            <option>--select course--</option>
            <option>heavy goods</option>
            <option>light goods</option>
            </select>
          <br>
          <button class="w3-button w3-green w3-small w3-round  w3-padding" type="submit" name="edit_schedule">Add</button>
           <button onclick="document.getElementById('edit_schedule').style.display='none'" type="button" class="w3-button w3-small w3-round w3-red w3-right w3-padding">Cancel</button>
        </div>
      </form> 

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        
      </div>

    </div>

  </div>
   <!--.........profile modal.......-->
   <div id="profile" class="w3-modal ">
    <div class="w3-modal-content w3-round w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('profile').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <div class="row">
        <div class="w3-col s5">
          <img src="../assets/img/avatar.jpg" name="profile_img" class="w3-round " style="width:100px; margin-left: 30%; margin-right: 50%;"><hr class="w3-margin-left">
           <span>

              <?php

              echo "&nbsp;&nbsp;&nbsp;&nbsp;Hello, ".$_SESSION['user_data']['username']."<br>&nbsp;&nbsp;&nbsp;&nbsp;Here you can change your profile";
              ?>
      </span><br>

        </div>
        <div class="w3-col s7 w3-padding">
          <form class="w3-container w3-margin" action="" >
        <div class="w3-section">
          <h3>Update Profile</h3>
          <label><b>User Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Amount" name="username" value="<?php echo $_SESSION['user_data']['username']; ?>" required>
          <label><b>Email Address</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter First Installment" name="email" value="<?php echo $_SESSION['user_data']['email']; ?>" required>
          <label><b>Old Password</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Enter Second installment" name="psw" required><br>
          <label><b>Upload new image</b></label>
          <input class="w3-input w3-border" type="file" placeholder="Enter Second installment" name="psw" required><br>
          <button class="w3-button  w3-green " type="submit">Update</button>
          <button onclick="document.getElementById('profile').style.display='none'" type="reset" class="w3-button w3-red w3-right">Cancel</button>
        </div>
      </form>

        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
 <div class="w3-bar w3-bottom w3-text-white w3-small w3-center" style="background-color: #032331; z-index:4">
  <span class="w3-bar-item " style="margin-left: 35%; ">&copy; Yashii Driving School</span>
</div>

  <!-- End page content -->
</div>
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////// /[  Javastcrip code ]/////////////////////////////////////// //////////////////////////////////////////////////////////////////////////////-->
<script>
var mySidebar = document.getElementById("mySidebar");
var overlayBg = document.getElementById("myOverlay");
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}

function openDiv(evt, divName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("yashii");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-light-blue", ""); 
  }
  document.getElementById(divName).style.display = "block";
  evt.currentTarget.className += " w3-light-blue";
}

//generate pasword
function generate() {
  let complexity = document.getElementById('slider').value;
  let values = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz12345667890!@#$%^&*()_+";
  let password = "";

  for (var i = 0; i < complexity; i++) {
    password = password + values.charAt(Math.floor(Math.random() * Math.floor(values.length - 1)));
  }
  document.getElementById('display').value = password;
  document.getElementById('length').innerHTML = "length: 10";
  document.getElementById('slider').oninput = function (){
      if (document.getElementById('slider').value > 0) {
            document.getElementById('length').innerHTML = "length: " + document.getElementById('slider').value;
      }
      else{
          document.getElementById('length').innerHTML = "length: 1";
      }
  }
}
//copy generated password to clipoard
  function copy(){
    document.getElementById('display').select();
    document.execCommand('copy');
    alert('password copied to clipboard');
   }
</script>
<script type="text/javascript" src="../assets/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../assets/pooper/pooper.min.js"></script>
</body>
</html>
