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
        $request = Request::createFromGlobals();

        $method = $request->server->get('REQUEST_METHOD');

        if ($method == "POST") {

            $requestBody = file_get_contents('php://input');
            $json = json_decode($requestBody);

            $allQuery = strtolower($json->result->resolvedQuery);
            $action = strtolower($json->result->parameters->action);

            if (!empty($action)) {
                switch ($action) {
                    case 'jouer':
                        $game = new GameController($json);

                        $this->setRes($game->getGameResponse());
                        break;
                    case 'commander':
                        $this->setRes("commander");
                        break;
                    case 'podcast':
                        $this->setRes("podcast");
                        break;
                }
            } else {
                $this->setRes($allQuery);
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
        $messages = [];
        array_push($messages, array(
                "textToSpeech" => "simple_response",
                "ssml" => "google",
                "displayText" => $this->getRes(),
            )
        );



        $response = new \stdClass();
        $response->source = "webhook";

        $response->fulfillmentText = "Salut les petits PD";
        $response->fulfillmentMessages->simpleResponses = $messages;
        return json_encode($response);
    }

}