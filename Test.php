<?php


require "FirebaseConnect.php";
require "User.php";



$requestBody = file_get_contents('test.json');
$json = json_decode($requestBody);
$userID = $json->originalRequest->data->user->userId;
echo $userID;
