<?php

function echoln($string) {
  echo $string."\n";
}

class Game
{
    private $players;
    private $questions;

    public function __construct()
    {
        $this->players = new Players();

        $this->questions = new Questions();

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
        $player->setPenaltyBox(false);

        echoln($player . " was added");
        echoln("They are player number " . $this->players->count());
		return true;
	}

	public function  roll($roll) {
        $player = $this->players->get();

		echoln($player . " is the current player");
		echoln("They have rolled a " . $roll);

		if ($player->isInPenaltyBox()) {
			if ($this->rollIsOdd($roll)) {
                $player->setGettingOutPenaltyBox(true);

				echoln($player . " is getting out of the penalty box");
                $player->getPlace()->moveBy($roll);

				echoln($player . "'s new location is " . $player->getPlace());
				echoln("The category is " . $player->getCurrentCategory());

                $this->questions->askFor($player);
			} else {
				echoln($player . " is not getting out of the penalty box");
                $player->setGettingOutPenaltyBox(false);
            }
		} else {
            $player->getPlace()->moveBy($roll);

			echoln($player . "'s new location is " .$player->getPlace());
			echoln("The category is " . $player->getCurrentCategory());

            $this->questions->askFor($player);
		}
	}

    private function rollIsOdd($roll)
    {
        return ($roll % 2 != 0);
    }

    public function wasCorrectlyAnswered()
    {
        $player = $this->players->get();

        if ($player->isInPenaltyBox() && !$player->isGettingOutOfPenaltyBox()) {
            $this->players->next();
            return true;
        }

        echoln("Answer was correct!!!!");
        $player->addPurses(1);
        echoln($player . " now has " . $player->getPurses() . " Gold Coins.");

        $winner = $player->didWin();
        $this->players->next();

        return $winner;
	}

    public function wrongAnswer()
    {
        $player = $this->players->get();
		echoln("Question was incorrectly answered");
		echoln($player . " was sent to the penalty box");
        $player->setPenaltyBox(true);

        $this->players->next();
		return true;
	}
}
