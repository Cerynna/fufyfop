<?php
require 'vendor/autoload.php';

require 'Controller.php';

$requestBody = file_get_contents('php://input');
$json = json_decode($requestBody);

file_put_contents('test.json',$requestBody);
$userName = $json->originalRequest->data->user->userId;

$messages = [];
array_push($messages, array(
        "type" => "simple_response",
        "platform" => "google",
        "textToSpeech" => "qdfbsroibh $userName"
    )
);


$response = new \stdClass();
$response->source = "webhook";
$response->speech = "qljgnlsbn";
$response->messages = $messages;
$response->contextOut = array();
echo json_encode($response);
