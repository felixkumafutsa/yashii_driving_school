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
<link rel="stylesheet" href="../../assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="../../assets/themes/w3-theme-grey.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="../../assets/bootstrap/css/bootstrap.min.css">
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
<!--/*/////////////////////////////////////////////////////////////////////////////////////////////////////// /[ Tables for showing content on from the database ]/////////////////////////////////////// ////////////////////////////////////////////////////////////////////////////*/-->

 <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
          <div id="all_users" class="w3-container yashii">
               <button onclick="document.getElementById('add_user').style.display='none'" class="w3-button  w3-blue w3-small w3-round"><i class="fa fa-plus fa-fw"></i>Add User</button>
            <table class="w3-table-all w3-hoverable">
             <tr class="w3-text-white" style="background-color:   #032331;">
                 
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Date Created</th>
                  <th colspan="2">Action</th>
              </tr>

                 <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * from users";
                           $result = $conn->query($sql);
                       while ($row1 = mysqli_fetch_array($result)) { ?>
                          <tr>
                            
                            <td><?php echo $row1['firstname']; ?></td>
                            <td><?php echo $row1['lastname']; ?></td>
                            <td><?php echo $row1['username']; ?></td>
                            <td><?php echo $row1['email']; ?></td>
                            <td><?php echo $row1['role']; ?></td>
                            <td><?php echo $row1['create_at']; ?></td>
                            <td colspan="2">
                              <button name="edit_user" class="w3-button w3-small w3-round w3-green" onclick="document.getElementById('edit_user').style.display='block'" href="#edit_user?edit_user=<?php echo $row1['id'];?>" ><i class="fa fa-pencil fa-fw"></i></button>
                            
                              <a href="php/remove_content.php?remove_user=<?php echo $row['id']?>" name="remove_user" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>

        </table>
       
      </div>
   
    </div>
  </div>


  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div id="accounts" class="w3-container yashii" style="display:none">
            <h5>Accounts</h5>
            <div class="w3-col s12 w3-center">
                     <form method="post" action="php/payments_report.php">  
                          <input type="submit" name="generate_pdf" class="w3-button w3-green w3-small w3-round w3-right" value="Generate Report" />  
                     </form> 
                      <button onclick="document.getElementById('add_payment').style.display='block'" class="w3-bar-item w3-button w3-blue w3-small w3-round tablink" onclick="openDiv(event, 'insert_new')"><i class="fa fa-plus fa-fw"></i>Add Payment</button>
        <table class="w3-table-all w3-hoverable">
                     </div>
                     <br/><br/>
        
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Id</th>
                  <th>First Installment</th>
                  <th>Second installment</th>
                  <th>Balance</th>
                  <th colspan="2">Action</th>
              </tr>
                 <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * from payment";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['first_installment']; ?></td>
                             <td><?php echo $row['second_installment']; ?></td>
                            <td><?php echo $row['balance']; ?></td>
                            <td colspan="2">    
                              <button name="edit_payment" class="w3-button w3-small w3-round w3-green" onclick="document.getElementById('edit_payment').style.display='block'" href="#edit_user?edit_payment=<?php echo $row1['id'];?>" ><i class="fa fa-pencil fa-fw"></i></button>                        
                              <a href="php/remove_content.php?remove_payment=<?php echo $row['id']?>" name="remove_payment" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>

        </table>
       
      </div>
   
    </div>
  </div>



    <div id="courses" class="w3-container yashii" style="display:none">
    <h5>Courses</h5>
  <button onclick="document.getElementById('add_course').style.display='block'" class="w3-button w3-small w3-round w3-blue "><i class="fa fa-plus fa-fw"></i>Add Course</button>
  <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Course Name</th>
                  <th>Duration</th>
                  <th>Fees</th>
                  <th colspan="2">Action</th>
              </tr>
                            <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * from course";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['course_name']; ?></td>
                            <td><?php echo $row['duration']; ?></td>
                             <td><?php echo $row['fees']; ?></td>
                             <td colspan="2">
                              <button name="edit_course" class="w3-button w3-small w3-round w3-green" onclick="document.getElementById('edit_course').style.display='block'" href="?edit_course=<?php echo $row['id'];?>" ><i class="fa fa-pencil fa-fw"></i></button>
                              <a href="php/remove_content.php?remove_course=<?php echo $row['id']?>" name="remove_course" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>

        </table>
    
  </div>


  <div id="schedule" class="w3-container yashii" style="display:none">
    <h5>Schedule</h5>
  <button onclick="document.getElementById('add_schedule').style.display='block'" class="w3-button w3-small w3-round w3-blue "><i class="fa fa-plus fa-fw"></i>Add Schedule</button>
  <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Id</th>
                  <th>Date</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Location</th>
                  <th>Course</th>
                  <th colspan="2">Action</th>
              </tr>
                            <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * from schedu";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['schdule_id']; ?></td>
                            <td><?php echo $row['nthawi']; ?></td>
                             <td><?php echo $row['nyengo']; ?></td>
                            <td><?php echo $row['nyengo1']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                             <td colspan="2">
                              <button name="edit_schedule" class="w3-button w3-small w3-round w3-green" onclick="document.getElementById('edit_schedule').style.display='block'" href="home.php?edit_schedule=<?php echo $row['schdule_id'];?>" ><i class="fa fa-pencil fa-fw"></i></button>
                            
                              <a href="php/remove_content.php?remove_schedule=<?php echo $row['schdule_id']?>" name="remove_schedule" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>

        </table>
    
  </div>

  <div id="road_traffic" class="w3-container yashii" style="display:none">
    <h5>Road Traffic</h5>
        <div class="w3-col s12 w3-center">

                     <form method="post" action="php/payments_report.php">  
                      
                          <input type="submit" name="generate_pdf" class="w3-button w3-green w3-small w3-round w3-right" value="Generate Report" />  
                     </form>
                     <button onclick="openDiv(event, 'insert_new')" class="w3-button w3-blue w3-small w3-round"><i class="fa fa-plus fa-fw"></i>Insert new</button>  
                     </div>
                     <br/><br/>
     <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>Id</th>
                  <th>TRN</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Course</th>
                  <th>Status</th>
                  <th colspan="2">Action</th>
              </tr>

                 <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * from road_traffic";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['TRN']; ?></td>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                             <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td colspan="2">
                               <button name="edit_user" class="w3-button w3-small w3-round w3-green" onclick="document.getElementById('edit_user').style.display='block'" href="#edit_user?edit_user=<?php echo $row1['id'];?>" ><i class="fa fa-pencil fa-fw"></i></button>

                              <a href="php/remove_content.php?remove_user=<?php echo $row['id'] ?>" name="remove_user" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>

        </table>


  </div>

  

  <div id="messages" class="w3-container yashii" style="display:none">
    <h5>Messages</h5>
  
      <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                <th>Id</th>
                <th>Sender Email</th>
                <th>Subject</th>
                <th>Content</th>
             
                <th colspan="2">Action</th>
            </tr>

            <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                          $sql = "SELECT * FROM secretary_messages";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['sender_email']; ?></td>
                            
                            
                             <td><?php echo $row['subject']; ?></td>
                            
                            <td><?php echo $row['content']; ?></td>
                            
                           <td colspan="2">
                              <button name="edit_message" class="w3-button w3-small w3-round w3-green" onclick="document.getElementById('send_message').style.display='block'" href="?edit_message=<?php echo $row['id'];?>" ><i class="fa fa-reply fa-fw"></i></button>
                            
                              <a href="php/remove_content.php?remove_message=<?php echo $row['id']?>" name="remove_message" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
        </table>

  </div>
  

  <div id="student" class="w3-container yashii" style="display:none">
    <h5>Student</h5>
      
       <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>User Name</th>
                  <th>Course</th> 
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th colspan="2">Action</th>
              </tr>

              <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * FROM users WHERE role = 'student'";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['username']; ?></td>                           
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td>
                             <td>
                              <a href="edit_student.php" name="edit" class="w3-button w3-small w3-round w3-green"><i class="fa fa-pencil fa-fw"></i></a> 
                              <a href="php/remove_content.php" name="remove_student" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
       </table>

  </div>

  

  <div id="instructor" class="w3-container yashii" style="display:none">
    <h5>Instructor</h5>
      <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>User Name</th>
                  <th>Course Name</th> 
                  <th>Email</th>
                  <th colspan="2">Action</th>
              </tr>

              <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * FROM users WHERE role = 'instructor'  ";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                              
                            </td>
                            <td>
                              <a href="edit_schedule.php" name="edit" class="w3-button w3-small w3-round w3-green"><i class="fa fa-pencil fa-fw"></i></a> 
                           
                              <a href="php/remove_content.php" name="remove_user" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
       </table>
  </div>

   

  <div id="manager" class="w3-container yashii" style="display:none">
    <h5>Manager</h5>


    <table class="w3-table-all w3-hoverable">
        <tr class="w3-text-white" style="background-color:   #032331;">
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>User Name</th>
                 <!--  <th>Last Name</th> -->
                  <th>Email</th>
                  <!-- <th>Mobile</th>
                  <th>Address</th> -->
                  <th colspan="2">Action</th>
              </tr>

              <?php
                           $conn = mysqli_connect("localhost","root","","yashii");
                           $sql = "SELECT * FROM users WHERE role = 'manager'";
                           $result = $conn->query($sql);
                       while ($row = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                             
                            <td><?php echo $row['email']; ?>
                              
                            </td>
                           <td>
                              <a href="edit_schedule.php" name="edit" class="w3-button w3-small w3-round w3-green"><i class="fa fa-pencil fa-fw"></i></a> 
                              <a href="php/remove_content.php" name="remove_user" class="w3-button w3-small w3-round w3-red"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
       </table>
  </div>

  <div id="manager" class="w3-container yashii" style="display:block;">
    
      <form class="w3-container" action="php/edit_content.php" method="post">
        <div class="w3-section">
          <div class="w3-container w3-center w3-block w3-text-white">
            <h5 style="background-color:   #032331;"><i class="fa fa-pencil"></i> Edit User</h5>
          </div>
          <label><b>First Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $row1['firstname']?>" name="firstname" required>
          <label><b>Last Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $row1['lastname']?>" name="lastname" required>
          <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" value="<?php echo $row1['username']?>" name="username" required>
        
          <label><b>Email</b></label>
          <input class="w3-input w3-border" type="email" value="<?php echo $row1['email']?>" name="email" required>         
           <label><b>Role</b></label>
          <input class="w3-input w3-border" type="text" value="<?php echo $row1['role']?>" name="role" required>
          <br>
          <button class="w3-button  w3-green w3-small w3-round w3-padding" type="submit" name="update_user">Update</button>
          <button onclick="document.getElementById('edit_user').style.display='none'" type="button" class="w3-button w3-small w3-round w3-red w3-padding w3-right">Cancel</button>
        </div>
      </form> 
  </div>

  <!-- new profile-->
<div id="profile" class="w3-container yashii" style="display:none">
 <form class="w3-container w3-card-4 w3-margin w3-light-grey" action="php/update_profile.php" method="post">
        <div class="w3-section">
          <h3>Update Profile</h3>
           
          <input class="w3-input w3-border w3-margin-bottom" value="<?php echo $_SESSION['user_data']['id']; ?>" hidden>
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
         <!--  <label><b>Upload new image</b></label>
          <input class="w3-input w3-border" type="file" placeholder="Enter Second installment" name="psw" > --><br>
          <button class="w3-button  w3-green w3-small" name="update_profile" type="submit">Update</button>
          <button onclick="document.getElementById('profile').style.display='none'" type="reset" class="w3-button w3-red w3-right">Cancel</button>
        </div>
      </form>      
</div>




<!--/*/////////////////////////////////////////////////////////////////////////////////////////////////////// /[ Modals for adding content into the database ]/////////////////////////////////////// ////////////////////////////////////////////////////////////////////////////*/-->
  <!--.........add payment modal.......-->
   <div id="add_payment" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom " style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('add_payment').style.display='none'" class=" w3-round w3-text-white w3-margin-bottom w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal" style="background-color:   #032331;">&times;</span>
      </div>
      <div class="w3-container w3-border-top w3-margin-top  w3-center" style="background-color:   #032331;">
         <h5 class="w3-text-white  w3-padding" style="background-color:   #032331;">Add New Payment</h5>
      </div>
      <form class="w3-container" action="php/add_payment.php" method="post">
        <div class="w3-section">
         
          <label><b>TRN</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter student TRN" name="TRN" required>
          <label><b>First Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter student first name" name="firstname" required>
          <label><b>Last Name</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Enter student lastname" name="lastname" required> 
          <label><b>First Installment</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter amount paind on first installment" name="first_installment" >
           <label><b>Second Installment</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Enter amount paid on second installment " name="second_installment">
        <br>
          <button class="w3-button  w3-green w3-round " type="submit" name="add">Add</button>
          <button onclick="document.getElementById('add_payment').style.display='none'" type="button" class="w3-button w3-round w3-red w3-right">Cancel</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16" >
        
      </div>

    </div>
  </div>


  <!--.......add course modal.......-->
  <div id="add_course" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom  w3-light-gray" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('add_course').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" action="php/add_course.php" method="post">
        <div class="w3-section">
          <label><b>Course Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Course Name" name="course_name" required>
          <label><b>Duration</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Duration in months" name="duration" required>
          <label><b>Fees</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Fees" name="fees" required>
          <br>
          <button class="w3-button w3-green w3-small w3-round  w3-padding" type="submit" name="add_course">Add</button>
           <button onclick="document.getElementById('add_course').style.display='none'" type="button" class="w3-button w3-small w3-round w3-red w3-right w3-padding">Cancel</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        
      </div>

    </div>

  </div>

  <!--.......add schedule modal.......-->
  <div id="add_schedule" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom  w3-light-gray" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('add_schedule').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" action="php/add_schedule.php" method="post">
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
          <button class="w3-button w3-green w3-small w3-round  w3-padding" type="submit" name="submit_schedule">Add</button>
           <button onclick="document.getElementById('add_schedule').style.display='none'" type="button" class="w3-button w3-small w3-round w3-red w3-right w3-padding">Cancel</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        
      </div>

    </div>

  </div>

    <!--.......edit schedule modal.......-->
  <div id="edit_schedule" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom  w3-light-gray" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('edit_schedule').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" action="php/add_schedule.php" method="post">
        <h5 class="w3-center">Edit Schedule</h5>
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
          <button class="w3-button w3-green w3-small w3-round  w3-padding" type="submit" name="submit_schedule">Add</button>
           <button onclick="document.getElementById('edit_schedule').style.display='none'" type="button" class="w3-button w3-small w3-round w3-red w3-right w3-padding">Cancel</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        
      </div>

    </div>

  </div>


 <!--send message-->
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
   <!--send message-->
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
    <!--.......add user modal.......-->
  <div id="add_user" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom  w3-light-gray" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('add_user').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" action="php/add_user.php" method="post">
        <div class="w3-section">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <label><b>First Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter first name" name="firstname" required>
          <label><b>Last Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter last name" name="lastname" required>
          <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter username" name="username" required>
         
          <label><b>Email</b></label>
          <input class="w3-input w3-border" type="email" placeholder="Enter email address " name="email" required>
          <label><b>Role</b></label>
          <select class="form-control" name ="role">
            <option>--select user type--</option>
            <option>instructor</option>
              <option>manager</option>
              <option>secretary</option>  
              <option>student</option>
      </select>
           <label><b>Date Created</b></label>
          <input class="w3-input w3-border" type="date" placeholder="" name="create_at" required>
          
           <label><b>Password</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Generate password and input here" name="password" id="password" required>
          <hr>
          <input class="w3-input w3-border" type="text" id="display">

          <input class="w3-input w3-border" type="range" name="slider" min="0" max="20" id="slider">
          <button class="w3-button  w3-blue w3-small w3-round w3-padding" onclick="generate()" style="margin-left: 25%">Generate password</button>
           <button class="w3-button  w3-blue w3-small w3-round w3-padding" onclick="copy()" style="">Copy to clipboard</button>
          <span id="length"></span>
          <br><hr>
          <button class="w3-button  w3-green w3-small w3-round w3-padding" type="submit" name="submit_user">Add</button>
          <button onclick="document.getElementById('add_user').style.display='none'" type="button" class="w3-button w3-small w3-round w3-red w3-padding w3-right">Cancel</button>
        </div>
      </form> 

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        
      </div>

    </div>

  </div>
        <!--.......add schedule modal.......-->
  <div id="insert_new" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom  w3-light-gray" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('insert_new').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container w3-card-4 w3-margin w3-light-grey" action="php/add_new_record.php" >
        <div class="w3-section">
          <h3 class="w3-center">New Road Traffic Record</h3>

            <label><b>First Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="firstname" placeholder="Enter student firstame" required>
            <label><b>Last Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="lastname" placeholder="Enter student lastname" required>
          <label><b>Course Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="email" placeholder="Enter course name" required>
           <label><b>Status</b></label>
            <select class="form-control" name ="course">
            <option>--select status--</option>
            <option>approved</option>
            <option>denied</option>
      </select><br>
          <button class="w3-button  w3-green w3-small" name="insert" type="submit">Update</button>
          <button onclick="document.getElementById('insert_new').style.display='block'" type="reset" class="w3-button w3-red w3-right">Cancel</button>
        </div>
      </form>      

    </div>

  </div>
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////[ Modals for updating database content ]////////////////////////////////////////// ///////////////////////////////////////////////////////////////////////////////////////////////////-->
    <!--.......edit user modal.......-->
   
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
