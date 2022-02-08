<?php 
require('./.env');

// On récupère le code dans une variable
$code = $_GET["code"];

// On définit les différents arguments
$fields = [
    'code' => $code,
    'client_id' => CLIENT_ID,
    'client_secret' => CLIENT_SECRET,
    'redirect_uri' => REDIRECT_URI,
    'grant_type' => 'authorization_code',
];
// On post la requete
$postdata = http_build_query($fields);
// On récupère la réponse
$response = curl_post(API_URL, $postdata);
// On transforme en JSON
$json = json_decode($response);
// On récupère le access_token
$token = $json->access_token;
// On défini notre event
$calendarFields = json_encode(array(
    "start" => array("date" => "2022-04-01"),
    "end" => array("date" => "2022-04-02"),
    "description" => "Scrabble avec mamie"));
// On définit l'URL d'une différente façon
$lURL = CALENDAR_URL . '?scope=' . SCOPE . '&access_token=' . $token . '&grand_type=authorization_code'; 
// On post et on récupère la réponse
$response = curl_post($lURL, $calendarFields); 

// Partie récupération des events
$URLEvents = "https://www.googleapis.com/auth/calendar.events.readonly";
$URLEventsfields = [
    'scope' => $URLEvents,
    'code' => $code,
    'client_id' => CLIENT_ID,
    'client_secret' => CLIENT_SECRET,
    'redirect_uri' => REDIRECT_URI,
    'grant_type' => 'authorization_code',
];
/*
$EventPostdata = http_build_query($URLEventsfields);
$response = curl_post(API_URL, $EventPostdata);
var_dump($response);
*/
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