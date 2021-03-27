<?php
 session_start();
 $con = mysqli_connect("localhost", "root", "", "yashii");
if (isset($_REQUEST['email']) && isset($_REQUEST['password'])) {

	$email = mysqli_real_escape_string($con, $_REQUEST['email']);
	$password = mysqli_real_escape_string($con, md5($_REQUEST['password']));

	$qr = mysqli_query($con, "select * from users where email = '".$email."' and password='".$password."'");

	if (mysqli_num_rows($qr)>0) {

		$data = mysqli_fetch_assoc($qr);

		$_SESSION['user_data']=$data;

		if($data['role']== 'secretary'){

			header("Location:../secretary/home.php");

		}
		elseif($data['role']== 'instructor'){
			header("Location:../instructor/php/select_course.php");
		
		}
		elseif($data['role']== 'manager'){
			header("Location:../manager/home.php");
			 
		}
		elseif($data['role']== 'student'){
			header("Location:../student/php/register.php");
			
		}
		else{
			header("Location:../index.php?error=no user found");
		}
	}
	 else{
		header("Location:../index.php?error=Invalid details");
	 }
}
else{
	header("location:../index.php?error=please enter valid login details");
}
?>