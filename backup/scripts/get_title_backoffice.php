<?php
include_once '../config/config.php';
function getTitle($movieDbId) {
    // Initialiser cURL
    $ch = curl_init();
    $apiUrl = 'https://api.themoviedb.org/3/movie/' . $movieDbId . '?language=en-US';
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . MOVIEDB_TOKEN,
        'Accept: application/json',
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        //echo 'Error:' . curl_error($ch);
        exit;
    } else {
        $data = json_decode($response, true);
    }
    return $data['title'];
}