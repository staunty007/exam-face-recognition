<?php
require 'config.php';

$db = [
    'HOST' =>   'localhost',
    'DB'   =>   'face-exams',
    'USER' =>   'root',
    'PASS' =>   ''
];

$conn = new mysqli($db['HOST'], $db['USER'], $db['PASS'], $db['DB']);

if (!$conn) {
    die('Cannot Connect to database, Please Check the Config File');
}

?>
