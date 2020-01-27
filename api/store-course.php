<?php  
 session_start();  
 require "../db.php";

    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data); die();

    $name = $data['name'];
    $dept = $data['dept'];
    $time = $data['time'];
    $code = rand(0000, 9999);

    $insertQuery = "INSERT INTO courses 
    (code,`name`,dept,`time`,`status`)
    VALUES ('$code','$name','$dept','$time',0)";
    $insert = $conn->query($insertQuery); 

    if ($insert) {
        echo json_encode(['success' => 'Course Added']);  
    } else {
        echo json_encode(['error' => 'Course Adding Failed']); 
    }    

 ?>  
