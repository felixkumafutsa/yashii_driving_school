
<!DOCTYPE html>
<html>
<head>
	<title>Yashii</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/w3css/w3.css">
	<link rel="stylesheet" type="text/css" href="assets/themes/w3-theme-pink.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
	<style type="text/css">
		.container{
			margin-top: 30px;
		}
		body{
			padding-top: 30px;
			padding-bottom: 30px;
			background-image: url('assets/img/pic4.jpg');
			background-repeat: no-repeat;
			background-size: cover;
			min-height: 910px;
			background-color:#032331;
			background-opacity: 0.2;
			background-blend-mode: screen;
		}
		.form-signin{
			max-width: 330px;
			padding: 15px;
			margin: 0 auto;
		}
		.form-signin .form-signin-heading{
			margin-bottom: 10px;

		}
		.form-signin .form-control{
			position: relative;
			height: auto;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 10px;
			font-size: 16px;
		}
		.form-signin .form-control: focus{
			z-index: 2;
		}
		.form-signin input[type = ""]{
			margin-bottom: -1px;
			border-top-left-radius: 0;
			border-bottom-right-radius: 0;
		}
		.form-signin input[type = "password"]{
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-bottom-right-radius: 0;
		}
	</style>
</head>
<body class="">
	<!-- Top container -->
<div class="w3-bar w3-top  w3-small" style="background-color: #032331; z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>

  	
  	<h2 class="w3-bar-item  w3-text-white" style=""><img src="assets/img/pic4.jpg" class="w3-round   w3-center" style="width:30px; height: 30px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YASHII DRIVING SCHOOL</h2>

</div><hr><br><br><br><br>
<div class="container">
	<div class="row">
		<?php if (isset($_REQUEST['error'])) { ?>
			<div class="col-lg-12">
			<span class="alert w3-text-red alert-danger" style="display:block; margin-top: 60px;">
				<?php echo $_REQUEST['error']; 
			          unset($_REQUEST['error']);
			    ?>
			 
			 </span>
		</div>
		
		<?php }?>
	</div>
	<div class="row">

		<div class="col-lg-4">
			
		</div>
		<div class="col-lg-4"><br>
			<form class="form-signin" action="includes/login.php" method="post">
			  <h2 class="form-signin-heading w3-text-white w3-padding w3-center" style="background-color: #032331">Login</h2> 
			  <div class="form-group">
			    <label for="inputEmailAddress" class="sr-only">Email address:</label>
			    <input type="email" class="form-control" id="inputEmailAddress" name="email" placeholder="Email address" required autofocus>
			  </div>
			  <div class="form-group">  
			    <label for="inputPassword" class="sr-only"> Password:</label>
			    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required autofocus>
			  </div>
	   		  <button type="submit" class="w3-button w3-round w3-text-white w3-block" style="background-color: #032331"> <i class="fa fa-sign-in fa-fw"></i>  Login</button>
			</form> 
	    </div>
	    <div class="col-lg-4">
	    	
	    </div>

  </div>	
</div>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>