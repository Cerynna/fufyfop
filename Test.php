<?php


require "FirebaseConnect.php";
require "User.php";


//print_r($test->updateUser('ABwppHGUYsaqlBoMViA8-m6svBKOWHMhGJpwJqVE8irtS9OQO8nl8NV4IWACdrjFYFD6mbimMDBhJ3356Quh', ''));


$userFake = [
    /*    "id" => "ABwppHGUYsaqlBoMViA8-m6svBKOWHMhGJpwJqVE8irtS9OQO8nl8NV4IWACdrjFYFD6mbimMDBhJ3356Quh",*/
    /*    "last_use" => new DateTime("now"),//datetime*/
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

$pikachu = ["id" => "ABwppHGUYsaqlBoMViA8-m6svBKOWHMhGJpwJqVE8irtS9OQO8nl8NV4IWACdrjFYFD6mbimMDBhJ3356Quh"];

$database = new FirebaseConnect();
$key = $database->getKeyUser('ABwppHGUYsaqlBoMViA8-m6svBKOWHMhGJpwJqVE8irtS9OQO8nl8NV4IWACdrjFYFD6mbimMDBhJ3356Quh');
/*echo $key;*/
$database->getData("user/$key", $userDB);

print_r($userDB);


/*var_dump($user);*/
//$test->addUser($user);