<?php
session_start();  
require '../vendor/autoload.php';
require '../db.php';
require '../keys.php';

$args = [
    'credentials' => [
        'key' => API_KEY,
        'secret' => SECRET,
    ],
    'region' => REGION,
    'version' => VERSION
];

$client = new Aws\Rekognition\RekognitionClient($args);

$result = $client->compareFaces([
    'SimilarityThreshold' => 70,
    'SourceImage' => [ // REQUIRED
        //'Bytes' => file_get_contents($_SESSION['image']),
       'Bytes' => file_get_contents($_FILES['file']['tmp_name']),
    ],
    'TargetImage' => [ // REQUIRED
        //'Bytes' => file_get_contents("./img/002/1.jpg"),
        'Bytes' => file_get_contents($_SESSION['image']),
    ],
]);

$result = $result->toArray();

if (count($result['UnmatchedFaces']) > 0) {
    echo json_encode(['error' => 'Match Failed'], JSON_PRETTY_PRINT);
} elseif (count($result['FaceMatches']) > 0) {
    $_SESSION['verified'] = true;
    $newResult = $result['FaceMatches'][0];
    echo json_encode(['success' => $newResult], JSON_PRETTY_PRINT);
} else {
    echo json_encode(['error' => 'Recognition Technical Error. Retry..'], JSON_PRETTY_PRINT);
}

// print_r($result);
//echo json_encode(['success' => $result], JSON_PRETTY_PRINT);

