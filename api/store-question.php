<?php  
 session_start();  
 require "../db.php";

    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data); die();

    $courseId = $data['course_id'];
    $qcode = $data['qcode'];
    $question = $data['question'];
    $choice1 = $data['choice1'];
    $choice2 = $data['choice2'];
    $choice3 = $data['choice3'];
    $choice4 = $data['choice4'];
    $correct = $data['correct'];
    $marks = $data['marks'];

    $insertQuery = "INSERT INTO questions 
    (course_id,code,question,choice1,choice2,choice3,choice4,correct_answer,mark,`status`)
    VALUES ('$courseId','$qcode','$question','$choice1','$choice2','$choice3','$choice4','$correct','$marks',1)";
    $insert = $conn->query($insertQuery); 

    if ($insert) {
        echo json_encode(['success' => 'Question Uploaded']);  
    } else {
        echo json_encode(['error' => 'Question Upload Failed']); 
    }    

 ?>  
