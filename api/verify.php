<?php
session_start();  
require '../db.php';

if($_SERVER['REQUEST_METHOD'] == "POST")
{ 

$username = strtolower(trim($_POST['username']));
$authname = strtolower(trim($_POST['authname']));

    if($username == $authname)  { 
        $_SESSION['verified'] = true;
        echo json_encode(['success' => 'Face Verification Confirmed']);  
    }  
    else  {  
        echo json_encode(['error' => 'Verification Failed']); 
    }  

}
