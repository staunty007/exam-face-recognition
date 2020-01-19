<?php  
 session_start();  
 require "../db.php";

 if(isset($_POST["email"]))  

     $email = mysqli_real_escape_string($conn,$_POST['email']); 
     $password = mysqli_real_escape_string($conn,$_POST['password']); 
 {  
     if (empty($email) || empty($password)) {
        echo json_encode(['error' => 'Insert Fields']); 
        die();
     }
      $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";  
      $result = $conn->query($query);  
      $row = $result->fetch_assoc();
      if($result->num_rows > 0)  
      {  
           $_SESSION['email'] = $email;
           $_SESSION['username'] = $row['username'];
           $_SESSION['fullname'] = $row['fullname'];
           $_SESSION['image'] = $row['image'];
           $_SESSION['verified'] = false;

           echo json_encode(['success' => 'Authentication Successful']);  
      }  
      else  
      {  
        echo json_encode(['error' => 'Invalid Login Details']); 
      }  
 } 

 ?>  