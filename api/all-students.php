<?php
session_start();
require_once '../db.php';

$data = array();

    $allUsers = $conn->query("SELECT * FROM users where role = 2");

    while($user = $allUsers->fetch_assoc())
    {
        $data[] = array(
            'id'        => (int) $user['id'],
            'fullname'    => $user['fullname'],
            'email'    => $user['email'],
            'role'    => $user['role'] == 1 ? "Admin" : "Student", 
            'status'    => $user['status'] == 1 ? "Active" : "Inactive",
        );
    }


    header('Content-Type: application/json');
    echo json_encode($data);
?>
