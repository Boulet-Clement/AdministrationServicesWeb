<?php 
const ACCOUNTS_URL = 'https://accounts.google.com/o/oauth2/v2/auth';
const API_URL = 'https://www.googleapis.com/oauth2/v4/token';
const CALENDAR_URL = 'https://www.googleapis.com/calendar/v3/calendars/primary/events';

const SCOPE = 'https://www.googleapis.com/auth/calendar';
const CLIENT_ID = "948500310587-96hjng74irngfnubnkr9cgs3a6cggpjk.apps.googleusercontent.com";
const CLIENT_SECRET = "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";
const REDIRECT_URI = 'http://localhost:8080/script.php';

//var_dump($_GET);
$code = $_GET["code"];

$fields = [
    'code' => $code,
    'client_id' => CLIENT_ID,
    'client_secret' => CLIENT_SECRET,
    'redirect_uri' => REDIRECT_URI,
    'grant_type' => 'authorization_code',
];
$postdata = http_build_query($fields);

$response = curl_post(API_URL, $postdata);
//var_dump($response);

$json = json_decode($response);
//var_dump($json);
$token = $json->access_token;
//echo "ahhh";
//var_dump($token);

$calendarFields = [
    "access_token" => $token,
    //"start" => array ()
];
$calendarPostdata = http_build_query($calendarFields);
/*
$response = curl_post(CALENDAR_URL, $calendarPostdata);

var_dump($response);*/

function curl_get($url, array $headers = []) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (!empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

function curl_post($url, $data, array $headers = []) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (!empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

function redirectGoogleSignIn() {
    header('Location: ' . ACCOUNTS_URL . '?scope=' . SCOPE. '&redirect_uri=' . REDIRECT_URI .'&response_type=code&client_id=' . CLIENT_ID);
}

function refreshToken(){

}