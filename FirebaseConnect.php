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

    public function getKeyUser($idUser)
    {

        $arrayUsers = $this->database->getReference("user")->getValue();
        foreach ($arrayUsers as $key => $userDB) {
            if ($userDB['id'] == $idUser) {
                return $key;
            }
            return false;
        }
        return false;
    }

    public function updateUser($key, $user)
    {
        $this->database->getReference("user/$key")
            ->set(
                get_object_vars($user)
            );
        return true;
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

    public function getRandomQuestion()
    {
        $this->database->getData("/quizz/question", $questions);
        return array_rand($questions);
    }

}