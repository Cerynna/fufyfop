<?php
require 'vendor/autoload.php';

require 'Controller.php';

$response = new Controller();



$res = new \stdClass();
$res->speech = $response->getResponse();
$res->displayText = $response->getResponse();
$res->source = "webhook";
echo json_encode($response);
