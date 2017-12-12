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



    public function __construct()
    {
        $request = Request::createFromGlobals();

        $method = $request->server->get('REQUEST_METHOD');

        if ($method == "POST") {

            $requestBody = file_get_contents('php://input');
            $json = json_decode($requestBody);

            $action = $json->result->resolvedQuery->action;
            if (!empty($action))
            {
                switch ($action){
                    case 'jouer':

                        break;
                    case 'commander':

                        break;
                    case 'recette':

                        break;
                }
            }
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



}