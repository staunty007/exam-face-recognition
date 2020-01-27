<?php
session_start();
require_once '../db.php';

$data = array();

    $allCourses = $conn->query("SELECT * FROM courses");

    function countQuestions($id) {
        global $conn;
        $getQuestions = $conn->query("SELECT id from questions WHERE course_id = '$id'");
        return $getQuestions->num_rows;
    }

    while($course = $allCourses->fetch_assoc())
    {
        $data[] = array(
            'id'        => (int) $course['id'],
            'name'    => $course['name'],
            'code'    => $course['code'],
            'dept'    => $course['dept'],
            'duration' => (int) $course['time'], 
            'no_of_questions' => (int) countQuestions($course['code']),
            'status'    => $course['status'] == 1 ? "Active" : "Inactive",
        );
    }


    header('Content-Type: application/json');
    echo json_encode($data);
?>
