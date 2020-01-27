<?php  
 session_start();  
 require "../db.php";

    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data); die();

    $courseId = $data['id'];

    $deleteQuery = "DELETE FROM courses WHERE id = '$courseId'";
    $delete = $conn->query($deleteQuery); 

    if ($delete) {
        echo json_encode(['success' => 'Course Deleted Succssfully']);  
    } else {
        echo json_encode(['error' => 'Course Delete Failed']); 
    }    

 ?>  
