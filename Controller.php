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
            file_put_contents('inJSON.json',$json);

            $allQuery = strtolower($json->queryResult->queryText);

            $context = strtolower($json->queryResult->outputContexts->name);
            $context = array_pop(explode('/',$context));

            $action = strtolower($json->queryResult->parameters->action);
            $responsequizz = strtolower($json->queryResult->parameters->response_quizz);


            if (!empty($action)) {
                switch ($action) {
                    case 'jouer':
                        $game = new GameController($json);
                        $this->setRes($game->getGameResponse());
                        break;
                }
            }
            elseif ($context == "action_main-followup")
            {
                $this->setRes("kqzrghpqetjh");
            }

            elseif(!empty($responsequizz))
            {
                $this->setRes("qremdjbhqeobhj");
            }
            else {

                    $this->setRes("iycfjuygujh");


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

        $response = new \stdClass();
        $response->source = "webhook";
        $response->fulfillmentText = $this->getRes();
        return json_encode($response);
    }

}