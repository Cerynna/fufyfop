<?php



require "FirebaseConnect.php";

$test = new FirebaseConnect();



$test->getData('game/quizz/question',$list);

print_r($list);