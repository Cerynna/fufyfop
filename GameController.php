<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 12/12/17
 * Time: 17:52
 */
require 'FirebaseConnect.php';
require 'User.php';


class GameController
{
    const MAX_GAME = 5;

    /**
     * @var string
     */
    private $question;

    /**
     * @var string
     */
    private $bad;

    /**
     * @var string
     */
    private $good;

    /**
     * @var string
     */
    private $badResponse;

    /**
     * @var string
     */
    private $goodResponse;

    /**
     * @var string
     */
    private $gameResponse;


// method getResponse == return response

    public function __construct($json)
    {
        $userID = $json->originalRequest->data->user->userId;

        $allQuery = strtolower($json->result->resolvedQuery);


        $pikachu = ["id" => $userID];

        $database = new FirebaseConnect();
        $key = $database->updateUser($userID, $pikachu);
        /*echo $key;*/
        $database->getData("user/$key", $userDB);
        /*print_r($userDB);*/
        $user = new User($userDB);


        $game = $user->getGame();
        $questions = [];
        if (!isset($game['question'])) {
            $question = $this->getRandomQuestion();
            $questions = [
                $question,
            ];
            array_push($game, $questions);

            $user->setGame($game);
            $key = $database->updateUser($userID, get_object_vars($user));
        }
        $this->setGameResponse($key . " - " . implode('**', $questions));


        //verif firebase


    }

    private function getRandomQuestion()
    {
        $db = new FirebaseConnect();
        $db->getData("/quizz/question", $questions);
        return array_rand($questions);
    }

    private function createQuizz()
    {


    }

    /**
     * @return string
     */
    public function getGameResponse()
    {
        return $this->gameResponse;
    }

    /**
     * @param string $gameResponse
     * @return GameController
     */
    public function setGameResponse($gameResponse)
    {
        $this->gameResponse = $gameResponse;
        return $this;
    }


    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     * @return GameController
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return string
     */
    public function getBad()
    {
        return $this->bad;
    }

    /**
     * @param string $bad
     * @return GameController
     */
    public function setBad($bad)
    {
        $this->bad = $bad;
        return $this;
    }

    /**
     * @return string
     */
    public function getGood()
    {
        return $this->good;
    }

    /**
     * @param string $good
     * @return GameController
     */
    public function setGood($good)
    {
        $this->good = $good;
        return $this;
    }

    /**
     * @return string
     */
    public function getBadResponse()
    {
        return $this->badResponse;
    }

    /**
     * @param string $badResponse
     * @return GameController
     */
    public function setBadResponse($badResponse)
    {
        $this->badResponse = $badResponse;
        return $this;
    }

    /**
     * @return string
     */
    public function getGoodResponse()
    {
        return $this->goodResponse;
    }

    /**
     * @param string $goodResponse
     * @return GameController
     */
    public function setGoodResponse($goodResponse)
    {
        $this->goodResponse = $goodResponse;
        return $this;
    }

}