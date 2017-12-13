<?php
require 'vendor/autoload.php';

require 'Controller.php';

$controller = new Controller();

//file_put_contents('outJSON.json',$controller->makeRes());

echo json_encode(file_get_contents('outJSON.json'));
