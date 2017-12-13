<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 12/12/17
 * Time: 17:51
 */

class Controller
{

    private $request;

    private $response;



    public function __construct()
    {
        $request = Request::createFromGlobals();

        $method = $request->server->get('REQUEST_METHOD');

        if ($method == "POST") {

            $requestBody = file_get_contents('php://input');
            $json = json_decode($requestBody);

            $allQuery = strtolower($json->result->resolvedQuery);
            $action = strtolower($json->result->parameters->action);

            if (!empty($action))
            {
                switch ($action){
                    case 'jouer':
                        $this->setResponse("jouer");
                        break;
                    case 'commander':
                        $this->setResponse("commander");
                        break;
                    case 'recette':
                        $this->setResponse("recette");
                        break;
                }
            }
            else{
                $this->setResponse($allQuery);
            }
        }
        else {
            $this->setResponse("Vous n'etes pas en POST");
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
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     * @return Controller
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }



}