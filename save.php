<?php
$request = Request::createFromGlobals();
$response = new Response();

$method = $request->server->get('REQUEST_METHOD');


if ($method == "POST") {

$requestBody = file_get_contents('php://input');
$json = json_decode($requestBody);

file_put_contents('test.json',$requestBody);
$userName = $json->originalRequest->data->user->userId;

$messages = [];
array_push($messages, array(
"type" => "simple_response",
"platform" => "google",
"textToSpeech" => "qdfbsroibh $userName"
)
);


$response = new \stdClass();
$response->source = "webhook";
$response->speech = "qljgnlsbn";
$response->messages = $messages;
$response->contextOut = array();
echo json_encode($response);
} else {
echo "Method not allowed";
}








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

$questions = $user->getGame();

if (count($questions) <= self::MAX_GAME) {
    $question = $this->getRandomQuestion();
    if (count($questions) < 1) {
        $database->getData("quizz/question/$question", $quest);

        $this->setGameResponse($key . " - " . $quest['question']);

        array_push($questions, $question);
        $user->setGame($questions);
        $database->updateUserKey($key, get_object_vars($user));

    } else {
        $this->setGameResponse("Plus de 1");
    }


} else {
    $this->setGameResponse("Vous ne pouvez plus repondre a de question aujourd'hui");
}