<?php

class Game
{
    private $players;
    private $questions;
    private $writer;

    public function __construct(Writer $writer)
    {
        $this->players = new Players();
        $this->questions = new Questions();
        $this->writer = $writer;

        for ($i = 0; $i < 50; $i++) {
            $this->questions->addQuestion(Questions::POP, "Pop Question " . $i);
            $this->questions->addQuestion(Questions::SCIENCE, "Science Question " . $i);
            $this->questions->addQuestion(Questions::SPORTS, "Sports Question " . $i);
            $this->questions->addQuestion(Questions::ROCK, "Rock Question " . $i);
        }
    }

    public function isPlayable()
    {
        return ($this->players->count() >= 2);
    }

    public function add($playerName)
    {
        $player = new Player($playerName);
        $this->players->append($player);

        $this->writer->write("%s was added", $player);
        $this->writer->write("They are player number %d", $this->players->count());

        return true;
    }

    public function  roll($roll) {
        $player = $this->players->get();

        $this->writer->write("%s is the current player", $player);
        $this->writer->write("They have rolled a %d", $roll);

        if ($player->isInPenaltyBox()) {
            if ($roll % 2 == 0) {
                $this->writer->write("%s is not getting out of the penalty box", $player);
                $player->setGettingOutPenaltyBox(false);
                return;
            }

            $player->setGettingOutPenaltyBox(true);
            $this->writer->write("%s is getting out of the penalty box", $player);
        }

        $player->getPlace()->moveBy($roll);

        $this->writer->write("%s's new location is %s", $player, $player->getPlace());
        $this->writer->write("The category is %s", $player->getCurrentCategory());
        $this->writer->write($this->questions->askFor($player));
    }

    public function wasCorrectlyAnswered()
    {
        $player = $this->players->get();
        $this->players->next();

        if ($player->isInPenaltyBox() && !$player->isGettingOutOfPenaltyBox()) {
            return false;
        }

        $player->addPurses(1);

        $this->writer->write("Answer was correct!!!!");
        $this->writer->write("%s now has %d Gold Coins.", $player, $player->getPurses());

        return $player->didWin();
    }

    public function wrongAnswer()
    {
        $player = $this->players->get();
        $this->players->next();

        $this->writer->write("Question was incorrectly answered");
        $this->writer->write("%s was sent to the penalty box", $player);

        $player->setPenaltyBox(true);

        return false;
    }
}
