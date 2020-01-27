<?php
session_start();

if($_SESSION['role'] == 1) {
    header("location: admin/login.php");
    session_destroy();
} else {
    header("location: login.php");
    session_destroy();

}