<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 12/12/17
 * Time: 22:16
 */

class User
{

    private $id;

    private $last_use;

    private $last_action;

    private $commands;

    private $geoloc;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastUse()
    {
        return $this->last_use;
    }

    /**
     * @param mixed $last_use
     * @return User
     */
    public function setLastUse($last_use)
    {
        $this->last_use = $last_use;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastAction()
    {
        return $this->last_action;
    }

    /**
     * @param mixed $last_action
     * @return User
     */
    public function setLastAction($last_action)
    {
        $this->last_action = $last_action;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @param mixed $commands
     * @return User
     */
    public function setCommands($commands)
    {
        $this->commands = $commands;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGeoloc()
    {
        return $this->geoloc;
    }

    /**
     * @param mixed $geoloc
     * @return User
     */
    public function setGeoloc($geoloc)
    {
        $this->geoloc = $geoloc;
        return $this;
    }

public function __construct($user)
{
    (!empty($user['id'])) ? $this->setId($user['id']) : $this->setId(null);
    (!empty($user['last_use'])) ? $this->setLastUse($user['last_use']) : $this->setLastUse(null);
    (!empty($user['last_action'])) ? $this->setLastAction($user['last_action']) : $this->setLastAction(null);
    (!empty($user['commands'])) ? $this->setCommands($user['commands']) : $this->setCommands(null);
    (!empty($user['geoloc'])) ? $this->setGeoloc($user['geoloc']) : $this->setGeoloc(null);

    return $this;

}


}