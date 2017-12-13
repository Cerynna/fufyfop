<?php


require "FirebaseConnect.php";
require "User.php";

$database = new FirebaseConnect();

$database->getData("user/-L0DQcyQSm1oS80gdBZP/game", $game);

if(empty($game))
{
    echo "IL est vide";
}
else {
    echo "il est remplis";
}

