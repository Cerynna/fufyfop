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

    }

    public function getData($path, &$list)
    {
        return $list = $this->database->getReference("$path")->getValue();
    }

    public function updateUser($idUser, $user)
    {
        $arrayUser = $this->database->getReference("user")->getValue();

        $verif = "";
        foreach ($arrayUser as $key => $userDB) {
            if ($userDB['id'] == $idUser) {
                $verif = $key;
            }
        }
        if (!empty($verif)) {
            $this->database->getReference("user/$verif")
                ->set($user);
            return "UPDATE";
        } else {
            $this->addUser($user);
        }

    }

    public function addUser($user)
    {
        $newPost = $this->database
            ->getReference("user")
            ->push(
                $user
            );
        $newPost->getValue();
    }

}