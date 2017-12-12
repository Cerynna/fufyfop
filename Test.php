<?php


require "FirebaseConnect.php";

$test = new FirebaseConnect();


print_r($test->updateUser('ABwppHGUYsaqlBoMViA8-m6svBKOWHMhGJpwJqVE8irtS9OQO8nl8NV4IWACdrjFYFD6mbimMDBhJ3356Quh', ''));


$user = [
    "id" => "ABwppHGUYsaqlBoMViA8-m6svBKOWHMhGJpwJqVE8irtS9OQO8nl8NV4IWACdrjFYFD6mbimMDBhJ3356Quh",
    "last_use" => new DateTime("now"),//datetime
    "last_action" => "",//action
    "commands" => [

        0 => [
            "Sushi1" => 10,
            "sushi2" => 20

        ],
        1 => [
            "Sushi1" => 5,
            "sushi2" => 5

        ]

    ],
    "geoloc" => [
        "lati" => 10,
        "long" => 10
    ]

];

//$test->addUser($user);