<?php
session_start();
if (isset($_SESSION['user_data'])) {
  if ($_SESSION['user_data']['role']!='manager') {
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
<div class="w3-bar w3-top w3-text-white w3-small w3-center" style="background-color: #032331; z-index:4;">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
 
    <h5 class="w3-bar-item  w3-text-white" style="margin-left: 35%"> <img src="../assets/img/pic4.jpg" class="w3-round  w3-center" style="width:30px; height: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YASHII DRIVING SCHOOL</h5>
</div>
<br>
<hr class="w3-white" size="5px">
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-text-white  w3-animate-left" style="background-color:#1c526a; z-index:3;width:250px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s3">
      <img src="../assets/img/pic4.jpg" class="w3-round w3-margin-right" style="width:46px; height: 46px">
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
          $sql = "SELECT * FROM manager_messages ";
          $result = $conn->query($sql);
          $messages = mysqli_fetch_assoc($result);
          $message_count = count($messages);
          echo '<i class="fa fa-envelope"></i><sup class="w3-badge w3-green">'.$message_count.'</sup>';
        ?>
          
      </button>
      <button class="w3-bar-item w3-button" onclick="openDiv(event, 'profile')"><i class="fa fa-user"></i></button>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
   <!--  <button  class="w3-bar-item w3-button tablink" onclick="openDiv(event, 'schedule')"><i class="fa fa-table fa-fw"></i>  Schedule</button> -->
    
    <button   class="w3-bar-item w3-button tablink" onclick="openDiv(event, 'exam_bookings')"><i class="fa fa-book fa-fw"></i>Exam Bokings</button>
    
      
    <button  class="w3-bar-item w3-button tablink" onclick="openDiv(event, 'road_traffic_results')"><i class="fa fa-book fa-fw"></i>  Road Traffic Results</button> 
   <button  class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'messages')"><i class="fa fa-envelope fa-fw"></i>View Messages</button>
     <div class="w3-dropdown-hover">
    <button   class="w3-bar-item w3-button  w3-round " ><i class="fa fa-send fa-fw"></i>Send Message</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <button class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'send_message')">To One</button>
      <button class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'send_broadcast_message')">Broadcast</button>
    </div>
  </div>
   <a  class="w3-bar-item w3-button tablink" href="../includes/logout.php"><i class="fa fa-sign-out fa-fw"></i>  Logout</a>
    <br><br>
  </div>
</nav>
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>
 <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
    </div>
  </div>
  <div id="exam_bookings" class="w3-container yashii" style="display:block">
    <h5>Exam bookings</h5>
    	<div class="w3-col s12 w3-center">
                     <form method="post" action="php/students_report.php">  
                          <input type="submit" name="generate_pdf" class="w3-button w3-green w3-small w3-right" value="Generate PDF" />
                     </form>  
                     </div>
                     <br/><br/>
    	<table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Id</th>
                  <th>TRN</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Course Name</th>
                  <th>Date</th>
                  <th colspan="2">Action</th>
              </tr>
              <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * from exam";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['Id']; ?></td>
                            <td><?php echo $row['TRN']; ?></td>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['course_name']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td>                              
                              <a href="php/remove_content.php?remove=<?php echo $row['Id']?>" name="remove" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
      </table>


  </div>
  <div id="road_traffic_results" class="w3-container yashii" style="display:none">
    <h5>Road Traffic Results</h5>
    <div class="w3-col s12 w3-center">
                     <form method="post" action="php/students_report.php">  
                          <input type="submit" name="generate_pdf" class="w3-button w3-green w3-small w3-right" value="Generate PDF" />
                     </form>  
                     </div>
                     <br/><br/>
      <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                <th>TRN</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Course</th>
                <th>Date</th>
                <th colspan="2">Action</th>
            </tr>

            <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * FROM road_traffic";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                             <td><?php echo $row['TRN']; ?></td>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                          <td colspan="2">                           
                              <a href="php/remove_content.php?remove_traffic=<?php echo $row['id']?>" name="remove_traffic" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
        </table>

  </div>
  

  <div id="messages" class="w3-container yashii" style="display:none">
    <h5>Messages</h5>
  
    	<table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                <th>Sender Email</th>
                
                <th>Subject</th>
                <th>Content</th>
                <th colspan="2">Action</th>
            </tr>

            <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * FROM manager_messages";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['sender_email']; ?></td>
                             <td><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['content']; ?></td>
                          <td colspan="2">
                              <button class="w3-button w3-small w3-green w3-round tablink" onclick="openDiv(event, 'send_message')"><i class="fa fa-reply fa-fw" ></i></button>  
                           
                            <a href="php/remove_content.php?remove_message=<?php echo $row['id']?>" name="remove_message" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
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
           <button class="w3-button w3-red w3-small w3-round w3-section w3-padding w3-right" type="reset" name="send_message">Cancel</button>
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
           <button class="w3-button w3-red w3-small w3-round w3-section w3-padding w3-right" type="reset" name="send_message">Cancel</button>
        </div>
      </form>


  </div>


  <!-- new profile-->
<div id="profile" class="w3-container yashii" style="display:none">
          <form class="w3-container w3-padding w3-margin w3-card-4 w3-light-grey" action="php/update_profile.php" method="post">
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
          <!-- <label><b>Upload new image</b></label>
          <input class="w3-input w3-border" type="file" placeholder="Enter Second installment" name="psw" > --><br>
          <button class="w3-button  w3-green w3-small" name="update_profile" type="submit">Update</button>
          <button onclick="document.getElementById('profile').style.display='none'" type="reset" class="w3-button w3-red w3-right">Cancel</button>
        </div>
      </form>

      
</div>


  </div>
  <br> 
</div>

    <!-- Footer -->
 <div class="w3-bar w3-bottom w3-text-white w3-small w3-center" style="background-color: #032331; z-index:4">
  <span class="w3-bar-item " style="margin-left: 35%; ">&copy; Yashii Driving School</span>
</div>


<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
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
</script>
<script type="text/javascript" src="../assets/js/main.js"></script>
<script type="text/javascript" src="../assets/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../assets/pooper/pooper.min.js"></script>
<script type="text/javascript" src="../assets/sweet alert/sweetalert.js"></script>
<script type="text/javascript" src="../assets/sweet alert/sweetalert.min.js"></script>
</body>
</html>
