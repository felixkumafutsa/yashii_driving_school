<?php
	$conn = mysqli_connect("localhost","root","","yashii");
	//send message
if (isset($_POST['send_message'])) {
    $sender_email = $_POST['sender_email'];
    $reciever_email = $_POST['reciever_email'];
    $subject =$_POST['subject']; 
    $content =$_POST['content']; 
    $stmt = $conn->prepare("INSERT INTO enquiries (sender_email, reciever_email, subject, content) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $sender_email, $reciever_email, $subject, $content);
    $stmt->execute();
    if($stmt){
      $_SESSION['msg'] = "Message sent";
      header("location:../secretary/home.php");
    }
    $stmt->close();
    $conn->close();
}
?>