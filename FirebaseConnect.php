<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 12/12/17
 * Time: 20:30
 */


require __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseConnect
{

    const JSON_FIREBASE = __DIR__ . '/firebase.json';
    const API_KEY_FIREBASE = 'AIzaSyBnOBrlu5pMjM-we3iC6OHWAtMjMn4o4UQ';


    public $database;

    /**
     * @return mixed
     */
    public function getDatabase()
    {
        return $this->database;
    }


    /**
     * @param $database
     * @return $this
     */
    public function setDatabase($database)
    {
        $this->database = $database;
        return $this;
    }

    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(self::JSON_FIREBASE);

        $firebase = (new Factory)
            ->withServiceAccountAndApiKey($serviceAccount, self::API_KEY_FIREBASE)
            ->create();

        $this->setDatabase($firebase->getDatabase());

        return $this->database;

    }

    public function getData($path, &$list)
    {
        return $list = $this->database->getReference("$path")->getValue();
    }

    public function updateUser($idUser, $user)
    {
        $arrayUsers = $this->database->getReference("user")->getValue();

        foreach ($arrayUsers as $key => $userDB) {
            if ($userDB['id'] == $idUser) {
                $verif = $key;
            }
        }
        $arrayUser = $this->database->getReference("user/$verif")->getValue();

        $updateUser = new User($arrayUser);

        if (!empty($arrayUser['last_use'])){
            $updateUser->setLastUse($arrayUser['last_use']);
        }
        if (!empty($arrayUser['last_action'])){
            $updateUser->setLastAction($arrayUser['last_action']);
        }
        if (!empty($arrayUser['commands'])){
            $updateUser->setCommands($arrayUser['commands']);
        }
        if (!empty($arrayUser['geoloc'])){
            $updateUser->setGeoloc($arrayUser['geoloc']);
        }
        if (!empty($arrayUser['game'])){
            $updateUser->setGame($arrayUser['game']);
        }

        if (!empty($verif)) {
            $this->database->getReference("user/$verif")
                ->set(
                    get_object_vars($updateUser)
                );
            return $verif;
        } else {
            return $this->addUser($user);
        }

    }
    public function updateUserKey($key, $array)
    {
        return $this->database->getReference("user/$key")
            ->set(
                $array
            )
        ->getValue();
    }

    public function addUser($user)
    {
        $newPost = $this->database
            ->getReference("user")
            ->push(
                $user
            );
        $newPost->getValue();

        return $newPost->getKey();
    }

}