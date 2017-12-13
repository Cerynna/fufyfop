<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 12/12/17
 * Time: 22:16
 */

class User
{

    public $id;

    public $last_use;

    public $last_action;

    public $commands;

    public $geoloc;

    public $game;

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

    /**
     * @return mixed
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param mixed $game
     * @return User
     */
    public function setGame($game)
    {
        $this->game = $game;
        return $this;
    }

    public function getUser()
    {
        return $this;
    }

    public function __construct($user)
    {
        (!empty($user['id'])) ? $this->setId($user['id']) : $this->setId(null);
        (!empty($user['last_use'])) ? $this->setLastUse($user['last_use']) : $this->setLastUse(null);
        (!empty($user['last_action'])) ? $this->setLastAction($user['last_action']) : $this->setLastAction(null);
        (!empty($user['commands'])) ? $this->setCommands($user['commands']) : $this->setCommands(null);
        (!empty($user['geoloc'])) ? $this->setGeoloc($user['geoloc']) : $this->setGeoloc(null);
        (!empty($user['game'])) ? $this->setGame($user['game']) : $this->setGame(null);

        return $this;

    }


}