<?php
class Questions extends ArrayObject
{
    const POP     = "Pop";
    const ROCK    = "Rock";
    const SPORTS  = "Sports";
    const SCIENCE = "Science";

    private $popIterator;
    private $scienceIterator;
    private $sportsIterator;
    private $rockIterator;

    private $popQuestions;
    private $scienceQuestions;
    private $sportsQuestions;
    private $rockQuestions;

    public function __construct()
    {
        $this->popQuestions = new ArrayObject();
        $this->scienceQuestions = new ArrayObject();
        $this->sportsQuestions = new ArrayObject();
        $this->rockQuestions = new ArrayObject();
    }

    public function addQuestion($type, $question)
    {
        $type = lcfirst($type);
        $collection = "{$type}Questions";
        $this->$collection->append($question);
    }

    public function askFor(Player $player)
    {
        switch ($player->getCurrentCategory()) {
            case Questions::POP:
                echoln($this->next(Questions::POP));
                break;
            case Questions::SCIENCE:
                echoln($this->next(Questions::SCIENCE));
                break;
            case Questions::SPORTS:
                echoln($this->next(Questions::SPORTS));
                break;
            case Questions::ROCK:
                echoln($this->next(Questions::ROCK));
                break;
        }

    }

    public function next($type)
    {
        $type = lcfirst($type);
        $iterator = "{$type}Iterator";
        $collection = "{$type}Questions";

        if (!$this->$iterator) {
            $this->$iterator = $this->$collection->getIterator();
        }

        $question = $this->$iterator->current();
        $this->$iterator->next();

        return $question;
    }
}
