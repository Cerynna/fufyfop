<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 12/12/17
 * Time: 16:19
 */
require 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$response = new Response(
    'Content',
    Response::HTTP_OK,
    array('content-type' => 'text/html')
);

$request = Request::createFromGlobals();

$method = $request->server->get('REQUEST_METHOD');

$messages=[];
array_push($messages, array(
        "type"=> "simple_response",
        "platform"=> "google",
        "textToSpeech"=> "jhbqguvhseo"
    )
);

$response->source = "webhook";
$response->messages = $messages;
$response->contextOut = array();

json_encode($response);

var_dump($response);



/*
if ($method == 'POST') {

    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);

    print_r($json);

    $messages=[];
    array_push($messages, array(
            "type"=> "simple_response",
            "platform"=> "google",
            "textToSpeech"=> $speech
        )
    );
// Building Card
    array_push($messages, array(
            "type"=> "basic_card",
            "platform"=> "google",

            /**
             * Option de la card

            "title"=> "Card title",
            "subtitle"=> "card subtitle",
            "image"=> [
                "url"=>'http://lorempixel.com/600/200',
                "accessibility_text"=>'image-alt'
            ],
            "formattedText"=> 'Text for card',
            "buttons"=> [
                [
                    "title"=> "Button title",
                    "openUrlAction"=> [
                        "url"=> "http://lorempixel.com/200/200"
                    ]
                ]
            ]
        )
    );

/*    $response = new \stdClass();
    $response->source = "webhook";
    $response->messages = $messages;
    $response->contextOut = array();


    echo json_encode($response);
} else {
    echo "Method not allowed";
}
*/



