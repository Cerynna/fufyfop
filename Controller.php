<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require 'GameController.php';

/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 12/12/17
 * Time: 17:51
 */
class Controller
{

    public $request;

    public $response;


    public function __construct()
    {
        $database = new FirebaseConnect();
        $request = Request::createFromGlobals();

        $method = $request->server->get('REQUEST_METHOD');

        if ($method == "POST") {


            $requestBody = file_get_contents('php://input');
            $json = json_decode($requestBody);
            file_put_contents('inJSON.json', $json);

            $userID = $json->originalRequest->data->user->userId;

            $allQuery = strtolower($json->queryResult->queryText);

            $context = strtolower($json->queryResult->outputContexts->name);
            $context = array_pop(explode('/', $context));

            $action = strtolower($json->queryResult->parameters->action);

            $number = json_decode($json->queryResult->parameters->number);


            if (!empty($action)) {
                //action_main-followup
                switch ($action) {
                    case 'jouer':
                        $game = new GameController($json);
                        $this->setRes($game->getGameResponse());
                        break;
                }

            } else {
                $key = $database->getKeyUser($userID);
                $database->getData("user/$key/game", $game);
                $idGame = array_pop($game);
                $database->getData("quizz/question/$idGame", $quizz);

                if ($number == 1) {
                    $newQuizz = $database->getRandomQuestion();
                    if ($newQuizz == 0) {
                        $newQuizz = 1;
                    }

                   /* array_push($game, $newQuizz);

                    $user = new User('');
                    $user->setId($userID);
                    $user->setGame($game);
                    $user->setLastUse(new DateTime('now'));
                    $user->setLastAction("quizz");

                    $database->addUser(get_object_vars($user));*/


                    $this->setRes([$quizz['goodResponse'], $newQuizz]);
                }
                else {
                    $this->setRes($quizz['badResponse']);
                }
            }

        } else {
            $this->setRes("Vous n'etes pas en POST");
        }
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     * @return Controller
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRes()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     * @return Controller
     */
    public function setRes($response)
    {
        $this->response = $response;
        return $this;
    }

    public function makeRes()
    {
        $myResponse = $this->getRes();

        if(is_array($myResponse)){
            foreach ($myResponse as $oneReponse){
                $response = new \stdClass();
                $response->source = "webhook";
                $response->fulfillmentText = $oneReponse;
                return json_encode($response);
            }

        }
        else {
            $response = new \stdClass();
            $response->source = "webhook";
            $response->fulfillmentText = $myResponse;
            return json_encode($response);
        }



    }

}