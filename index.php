<?php
require 'vendor/autoload.php';

require 'Controller.php';

$response = new Controller();



$response = new \stdClass();
$response->speech = $response->getResponse();
$response->displayText = $response->getResponse();
$response->source = "webhook";
echo json_encode($response);
