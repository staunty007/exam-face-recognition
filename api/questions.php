<?php

require_once '../db.php';

$data = array();
$code = $_GET['qcode'];

    $query = "SELECT * from questions where course_id = '$code'";
    $allQuestions = $conn->query($query);

    $examDuration = $conn->query("SELECT name,time from courses where code = '$code'");
    $dur = $examDuration->fetch_assoc();

    while($quest = $allQuestions->fetch_assoc())
    {
        $data[] = array(
            'id'        => $quest['id'],
            'q_code'    => $quest['code'],
            'question'  => $quest['question'],
            'choice1'   => $quest['choice1'],
            'choice2'   => $quest['choice2'],
            'choice3'   => $quest['choice3'],
            'choice4'   => $quest['choice4'],
            'mark'      => $quest['mark'],
        );
    }

    $newdata = [
        'course' => $dur['name'],
        'duration' => $dur['time'],
        'exam' => $data
    ];

    header('Content-Type: application/json');
    echo json_encode($newdata);
?>
