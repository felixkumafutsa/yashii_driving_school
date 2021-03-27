<?php 
session_start(); 
session_destroy(); 
unset($_SESSION['user_data']); 
header("location: ../index.php"); 
?>