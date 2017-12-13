<?php
require 'vendor/autoload.php';

require 'Controller.php';

$controller = new Controller();

echo $controller->makeResponse();
