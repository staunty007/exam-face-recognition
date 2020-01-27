<?php  
 session_start();  
 require "../db.php";

    $data = json_decode(file_get_contents("php://input"));

    $userId = $_SESSION['id'];

    $time = date("Y-m-d H:i:s");
    //var_dump($data); die();


    for($i = 0; $i < count($data); $i++) {
        $records = $data[$i];
       // var_dump($records->answer);
        $sql = "INSERT INTO answers (q_id,q_code,answer,`user_id`,created_at) VALUES 
        ('$records->id','$records->q_code','$records->answer', '$userId','$time');";
        $conn->query($sql); 
    }

    $query = "SELECT questions.correct_answer as q_answer, answers.answer as a_answer, questions.mark, questions.code as q_code FROM questions INNER JOIN answers ON answers.q_id = questions.id WHERE answers.user_id = '$userId' AND answers.created_at = '$time'";  
    $result = $conn->query($query);

    $scoreArray = [];
    $qCode = null;

    while ($answer = $result->fetch_assoc()) {
        if ($answer['q_answer'] == $answer['a_answer']) {
            array_push($scoreArray, $answer['mark']);
        }
        $qCode = $answer['q_code'];
    }

    $score = array_sum($scoreArray);

    $insertScoreQuery = "INSERT INTO scores (q_code, `user_id`, score, created_at) VALUES
     ('$qCode','$userId','$score','$time')";
    $saveScore = $conn->query($insertScoreQuery);

    if ($saveScore) {
        echo json_encode(['success' => 'Exam Submitted']);  
    } else {
        echo json_encode(['error' => 'Exam Submittion Failed']); 
    }    

 ?>  
