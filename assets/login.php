<?php 
include('includes/config.php'); 
?> 
<?php 
include(INCLUDE_PATH . 'includes/add_user.php'); 
?> 
<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="utf-8"> 
	<title>Yashii - Login</title> 
	<!-- Bootstrap CSS --> 
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" /> 
	<link rel="stylesheet" type="text/css" href="assets/w3css/w3.css">
	<!-- Custome styles --> 
	<link rel="stylesheet" href="assets/css/style.css"> 
	<style type="text/css">
		.bg-img{
			background-image: url('assets/img/pic4.jpg');
			background-position: center;
			min-height: 900px;
			background-repeat: no-repeat;
			background-size: cover;
			background-opacity: 0.4;
		}
		#login{
			margin-top: 50px;
		}

	</style>

</head> 
<body >
	<div class="bg-img">

<div class="container"> 
		<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <span class="w3-bar-item w3-text-center">YASHII DRIVING SCHOOL</span><br><br>
</div><hr>
	<div class="row"> 
	</div>
	<div class="row"> 	
		<div class="col-md-4 col-md-offset-4 w3-center	"> 
			
        </div>
		<div class="col-md-4 col-md-offset-4 "> 
			<form class="w3-container w3-border w3-light-gray" action="getlogin.php" method="post"> 

				<h2 class="text-center" id="login">Login</h2> <hr> <!-- display form error messages --> 
				<?php include(INCLUDE_PATH . "includes/messages.php") 
				?> 
				<div class="form-group <?php echo isset($errors['username']) ? 'has-error' : '' ?>"> 
					<label class="control-label">Username or Email</label> 
					<input type="text" name="username" id="password" value="<?php echo $username; ?>" class="w3-input w3-border"> 
					<?php 
					if (isset($errors['username'])): 
						?> 
						<span class="help-block"><?php echo $errors['username'] ?></span> 
						<?php 
						endif; 
						?> 
					</div> 
					<div class="form-group <?php echo isset($errors['password']) ? 'has-error' : '' ?>"> 
						<label class="control-label">Password</label> 
						<input type="password" name="password" id="password" class="w3-input w3-border"> 
						<?php 
						if (isset($errors['password'])): 
							?> 
							<span class="help-block"><?php echo $errors['password'] ?></span> 
							<?php 
							endif; 
							?> 
						</div> 
						<div class="form-group"> 
							<button type="submit" name="login_btn" class="w3-btn w3-green w3-round w3-small " id="btn">Login</button>
							
							<button type="reset"  class="w3-btn w3-red w3-small w3-round w3-right"id="btn">Cancel</button> 
						</div> 
					</form>
</div> 
</div> 
</div> 
</div> 
</body>
</html>