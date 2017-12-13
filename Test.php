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
$key = $database->updateUser("ABwppHGUYsaqlBoMViA8-m6svBKOWHMhGJpwJqVE8irtS9OQO8nl8NV4IWACdrjFYFD6mbimMDBhJ3356Quh", $pikachu);
/*echo $key;*/
$database->getData("user/$key", $userDB);
/*print_r($userDB);*/
$user = new User($userDB);

if (!isset($user->game) or empty($user->game)) {

    $user->setGame([
        0 => 1
    ]);

}

var_dump(get_object_vars($user));

$key = $database->updateUserKey($key, get_object_vars($user));

var_dump($key);

/*var_dump($user);*/
//$test->addUser($user);