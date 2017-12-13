<?php
require 'vendor/autoload.php';

require 'Controller.php';

$response = new Controller();


$res = new \stdClass();
$res->source = "webhook";
$res->speech = $response->getResponse();
$res->messages = $response->getResponse();
$res->contextOut = array();
echo json_encode($res);