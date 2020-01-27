<?php
 session_start(); 
 require "../db.php"; 

    if ( 0 < $_FILES['file']['error'] ) {
        echo json_encode(['error' => $_FILES['file']['error']]); 
        die();
    }
    else {
        $email = $_SESSION['email'];
        $temp = explode(".", $_FILES["file"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $move = move_uploaded_file($_FILES["file"]["tmp_name"], "../img/" . $newfilename);

        $path = "../img/" . $newfilename;

        if ($move) {  
            $query = "UPDATE users SET `image` = '$path', `status` = 1 WHERE email = '$email'";  
            $result = $conn->query($query);  
            if ($result) {
                echo json_encode(['success' => 'Capture Accepted, You Can Login.']);  
            }
        }  else  {  
            echo json_encode(['error' => 'Capture Failed']); 
        }  
    }

?>