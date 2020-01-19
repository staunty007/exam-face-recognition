<?php 

define('ROOT', $_SERVER['DOCUMENT_ROOT'] ."/facial-recognition");
define('NAVBAR', $_SERVER['DOCUMENT_ROOT'] ."/facial-recognition/includes/navbar.php");
define('SIDEBAR', $_SERVER['DOCUMENT_ROOT'] ."/facial-recognition/includes/sidebar.php");
define('FOOTER', $_SERVER['DOCUMENT_ROOT'] ."/facial-recognition/includes/footer.php");

define('LAYOUT_HEAD', $_SERVER['DOCUMENT_ROOT'] ."/facial-recognition/layouts/head.php");
define('LAYOUT_FOOTER', $_SERVER['DOCUMENT_ROOT'] ."/facial-recognition/layouts/footer.php");

$routes = [
    'login' => ROOT . "/login.php",
    'logout' => ROOT . "/logout.php",
    'dashboard' => ROOT . "/dashboard.php"
];