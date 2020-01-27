<?php  
 session_start();  
 require "../db.php";

 if(isset($_POST["email"]))  
    {  
        $first = mysqli_real_escape_string($conn,$_POST['first']); 
        $last = mysqli_real_escape_string($conn,$_POST['last']); 
        $email = mysqli_real_escape_string($conn,$_POST['email']); 
        $password = mysqli_real_escape_string($conn,$_POST['password']); 

        $fullname = ucfirst($first) . " " . ucfirst($last);
        
        $query = "INSERT INTO users (fullname, email, `password`) VALUES ('$fullname','$email','$password')";  
        $result = $conn->query($query);  
        if($result)  
        {  
            $_SESSION['email'] = $email;
            $_SESSION['status'] = false;
            echo json_encode(['success' => 'Registration Successful. Proceed for Pre-Capturing']);  
        }  
        else  
        {  
            echo json_encode(['error' => 'Registration Failed']); 
        }  
    } 

 ?>  