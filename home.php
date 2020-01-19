<?php
require 'vendor/autoload.php';

$args = [
    'credentials' => [
        'key' => 'AKIAX5XHO6I6ADDLVVTV',
        'secret' => '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',  
    ],
    'region' => 'us-east-1',
    'version' => 'latest'
];

$client = new Aws\Rekognition\RekognitionClient($args);

$result = $client->compareFaces([
    'SimilarityThreshold' => 70,
    'SourceImage' => [ // REQUIRED
        //'Bytes' => file_get_contents("./img/002/1.jpg"),
       'Bytes' => file_get_contents($_FILES['file']['tmp_name']),
    ],
    'TargetImage' => [ // REQUIRED
        'Bytes' => file_get_contents("./img/002/1.jpg"),
    ],
]);

$result = $result->toArray();

if (count($result['UnmatchedFaces']) > 0) {
    echo json_encode(['error' => 'Match Failed'], JSON_PRETTY_PRINT);
} elseif (count($result['FaceMatches']) > 0) {
    $newResult = $result['FaceMatches'][0];
    echo json_encode(['success' => $newResult], JSON_PRETTY_PRINT);
}

// print_r($result);
//echo json_encode(['success' => $result], JSON_PRETTY_PRINT);

