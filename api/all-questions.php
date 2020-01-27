<?php
session_start();
require_once '../db.php';

$data = array();

    $allCourses = $conn->query("SELECT * FROM courses");

    while($course = $allCourses->fetch_assoc())
    {
        $data[] = array(
            'id'        => (int) $course['id'],
            'name'    => $course['name'],
            'code'    => $course['code'],
            'dept'    => $course['dept'],
            'duration' => (int) $course['time'], 
            'status'    => $course['status'] == 1 ? "Active" : "Inactive",
        );
    }


    header('Content-Type: application/json');
    echo json_encode($data);
?>
