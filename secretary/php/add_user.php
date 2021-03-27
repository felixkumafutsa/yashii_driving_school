<?php 
		$conn = new mysqli("localhost", "root", "", "yashii");
			//add user
		if (isset($_POST['submit_user'])) {
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $username = $_POST['username'];
      $password =md5($_POST['password']);
      $email= $_POST['email'];
      $role = $_POST['role'];
      $create_at =$_POST['create_at']; 
     mysqli_query($conn, "INSERT INTO users (firstname, lastname, username, password,email,role,create_at) VALUES ('$firstname', '$lastname', '$username', '$password', '$email', '$role', '$create_at')");
        $_SESSION['msg'] = "User added successfuly";
        header("location:../home.php");
    }

 ?>