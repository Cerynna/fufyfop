<?php
require 'vendor/autoload.php';

require 'Controller.php';

$response = new Controller();

print_r ($response->getResponse());

