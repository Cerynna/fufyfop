<?php
require 'vendor/autoload.php';

require 'Controller.php';

$controller = new Controller();

echo $controller->makeRes();

file_put_contents('outputJson.json',$controller->makeRes());
