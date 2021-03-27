<?php
	if (isset($_POST['add'])) {
           $TRN = $_POST['TRN'];
           $firstname= $_POST['firstname'];
           $lastname = $_POST['lastname'];
           $first_installment =$_POST['first_installment'];
           $second_installment =$_POST['second_installment'];
           $conn = new mysqli("localhost", "root", "", "yashii");  
           
    if (!empty($first_installment)) {
           $balance = 80000 - $first_installment;  
           $second_installment = 0; 
           $stmt = $conn->prepare("INSERT INTO payment (TRN,firstname, lastname, first_installment, second_installment, balance) VALUES (?, ?, ?, ?, ?, ?)");
           $stmt->bind_param("sssiii", $TRN, $firstname, $lastname, $first_installment, $second_installment,$balance);
           $stmt->execute();
    }

    elseif (!empty($second_installment)) {
        $balance = 0;  
           // $stmt = $conn->prepare("UPDATE payment SET  second_installment= 4000 WHERE TRN = '".$_POST['TRN']."'");
           // $stmt->bind_param("ii", $second_installment,$balance);
           // $stmt->execute();

mysqli_query($conn,"UPDATE payment SET  second_installment= 4000 WHERE TRN = '".$_POST['TRN']."'");
    $_SESSION['msg'] = "New payment added successfuly";
    header('location:../home.php');


    //       if($stmt){
    //   $_SESSION['msg'] = "Payment added successfuly";
    //   header("location:../home.php");
      
    // }
    }
    else{
          echo "whts up?";
    }
             
            $stmt->close();
            $conn->close();
  }

?>