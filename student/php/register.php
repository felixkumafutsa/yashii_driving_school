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


       $conn = mysqli_connect("localhost","root","","yashii");
       $firstname = $_SESSION['user_data']['firstname'];
       $sql = "SELECT * FROM students WHERE firstname ='$firstname'";
       $result = $conn->query($sql);
       $row = mysqli_fetch_array($result);

           if($row > 0){
               header("Location:../home.php");
           }
           // else{
           //      header("Location:register.php");
           // }
        
        $conn->close();
?>
<!DOCTYPE html>
<html>
<title>Yashii</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../assets/w3css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="../../assets/bootstrap/css/bootstrap.min.css">
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
 
    <h5 class="w3-bar-item  w3-text-white" style="margin-left: 35%"> <img src="../../assets/img/pic4.jpg" class="w3-round  w3-center" style="width:30px; height: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YASHII DRIVING SCHOOL</h5>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-text-white w3-collapsew3-animate-left" style="background-color:#1c526a; z-index:3;width:250px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="../../assets/img/avatar.jpg" name="profile_img" class="w3-round w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>

        <?php
        echo "Logged in as, ".$_SESSION['user_data']['username'].": Student";
        ?>
      </span><br>
      <!-- <button href="#" class="w3-bar-item w3-button w3-small" onclick="openDiv(event, 'messages')"><i class="fa fa-envelope"></i></button>
       <button href="#" class="w3-bar-item w3-button w3-small" onclick="openDiv(event, 'profile')"><i class="fa fa-user"></i></i></button> -->
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button  w3-round w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <button   class="w3-bar-item w3-button  w3-round tablink" onclick="openDiv(event, 'registration')"><i class="fa fa-plus fa-fw"></i>  Registration</button>
     <a  class="w3-bar-item w3-button  w3-round tablink" href="../../includes/logout.php"><i class="fa fa-sign-out fa-fw"></i>  Logout</a>
    <br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
   <!--  <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5> -->
     <?php if (isset($_SESSION['msg'])): ?>
  <div class="w3-block w3-red w3-large w3-center">
    <?php 
      echo $_SESSION['msg']; 
      unset($_SESSION['msg']);
    ?>
  </div>
<?php endif ?>
  </header>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div id="registration" class="w3-container yashii" >
		<h5 class="w3-center">Course Registration</h5>
    <div class="w3-center">
      <?php
        echo "Welcome <b>".$_SESSION['user_data']['firstname']. "</b> you need to register for course first";
     ?>
     </div>

          <form id="regForm" action="register_course.php" method="post">
  <h1>Register:</h1>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">Name:
    <p><input type="text" value="<?php echo $_SESSION['user_data']['firstname']; ?>" placeholder="First name..." oninput="this.className = ''" name="firstname"></p>
    <p><input type="text" value="<?php echo $_SESSION['user_data']['lastname']; ?>" placeholder="Last name..." oninput="this.className = ''" name="lname"></p>
  </div>
  <div class="tab">Demographic Info:
     <p><select class="form-control" name ="gender">
              <option onselect="this.className = ''">Male</option>
              <option onselect="this.className = ''">Female</option>
       </select></p>
    <p><input type="number" placeholder="Age" oninput="this.className = ''" name="age"></p>
  </div>
   <div class="tab">Contact Info:
    <p><input type="text" placeholder="phone" oninput="this.className = ''" name="mobile"></p>
    <p><input type="email" value="<?php echo $_SESSION['user_data']['email']; ?>"  placeholder="email" oninput="this.className = ''" name="email"></p>
    <p><input type="text"  placeholder="Physical Address" oninput="this.className = ''" name="nyumba"></p>
  </div> 
  <div class="tab">Course Details:
    <p><input type="text"  placeholder="TRN" oninput="this.className = ''" name="TRN"></p>
    <p><select class="form-control" name ="course">
              <option onselect="this.className = ''">heavy Weight Full</option>
              <option onselect="this.className = ''">light Weight Full</option>
              <option onselect="this.className = ''">heavy Weight Refresher</option>
              <option onselect="this.className = ''">light Weight Refresher</option>
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
  <!-- Footer -->
 <div class="w3-bar w3-bottom w3-text-white w3-small w3-center" style="background-color: #032331; z-index:4">
  <span class="w3-bar-item " style="margin-left: 35%; ">&copy; Yashii Driving School</span>
</div>
  <!-- End page content -->
</div>

<script>

// Multi-Step registration form
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit("");
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
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

(function () {
  function display( notifier, str ) {
    document.getElementById(notifier).innerHTML = '<b>Timer</b> '+str;
  }
 
  function toMinuteAndSecond( x ) {
    return Math.floor(x/120) + ":" + (x=x%120 < 10 ? 0 : x);
  }
 
  function setTimer( remain, actions ) {
    var action;
    (function countdown() {
       display("countdown", toMinuteAndSecond(remain));
       if (action = actions[remain]) {
         action();
       }
       if (remain > 0) {
         remain -= 1;
         setTimeout(arguments.callee, 1000);
       }
    })(); // End countdown
  }
 
  setTimer(120, {
    60: function () { display("notifier", " less than 60 seconds to go"); },
    30: function () { display("notifier", "less than 30 seconds left");        },
     0: function () { display("notifier", "Time is up ");       }
  });
})();
</script>
<script type="text/javascript" src="../assets/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../assets/pooper/pooper.min.js"></script>
</body>
</html>
