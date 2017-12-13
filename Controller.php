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
            $number = strtolower($json->queryResult->outputContexts->parameters->number);
            $context = array_pop(explode('/',$context));

            $action = strtolower($json->queryResult->parameters->action);
            $number = strtolower($json->queryResult->parameters->number);
            $responsequizz = strtolower($json->queryResult->parameters->response_quizz);


            if (!empty($action)) {
            //action_main-followup
                switch ($action) {
                    case 'jouer':
                        $game = new GameController($json);
                        $this->setRes($game->getGameResponse());
                        break;
                }
                if (!empty($context)){

                    $this->setRes("");
                }

            }

            else {
                $this->setRes("lachatemicantare " . implode('',$number));
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