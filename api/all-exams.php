<?php

require_once '../db.php';

$data = array();

$allExams = $conn->query("SELECT * from courses");

    function getQuestionLength($course) {
        global $conn;
        $query = "SELECT * from questions where course_id = '$course'";
        $allExams = $conn->query($query);
        $noOfRows = $allExams->num_rows;
        return $noOfRows;
    }

    while($exam = $allExams->fetch_assoc())
    {
        $data[] = array(
            'id'   => $exam['id'],
            'code'   => $exam['code'],
            'name'   => $exam['name'],
            'duration'   => $exam['time'],
            'questions' => getQuestionLength($exam['code'])
        );
    }

    header('Content-Type: application/json');
    echo json_encode($data);
?>
