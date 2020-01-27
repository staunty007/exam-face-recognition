<?php
session_start();
require_once '../db.php';

$data = array();

    $userId = $_SESSION['id'];
    $allGrades = $conn->query("SELECT scores.score, courses.name, scores.created_at from scores INNER JOIN questions ON questions.code = scores.q_code INNER JOIN courses ON courses.code = questions.course_id WHERE scores.user_id = '$userId' GROUP BY scores.created_at");

    $i = 0;
    while($grade = $allGrades->fetch_assoc())
    {
        $data[] = array(
            'id'        => $i++,
            'course'    => $grade['name'],
            'score'    => $grade['score'],
            'date'    => date('d-m-Y H:i A' ,strtotime($grade['created_at']))
        );
    }


    header('Content-Type: application/json');
    echo json_encode($data);
?>
