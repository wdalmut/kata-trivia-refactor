<?php

function echoln($string) {
  echo $string."\n";
}

class Game
{
    const POP     = "Pop";
    const ROCK    = "Rock";
    const SPORTS  = "Sports";
    const SCIENCE = "Science";

    private $players;
    private $inPenaltyBox ;

    private $popQuestions;
    private $scienceQuestions;
    private $sportsQuestions;
    private $rockQuestions;

    private $currentPlayer = 0;
    private $isGettingOutOfPenaltyBox;

    public function __construct()
    {
        $this->players = new Players();
        $this->inPenaltyBox  = array(0);

        $this->popQuestions = new Questions();
        $this->scienceQuestions = new Questions();
        $this->sportsQuestions = new Questions();
        $this->rockQuestions = new Questions();

        for ($i = 0; $i < 50; $i++) {
            $this->popQuestions->append("Pop Question " . $i);
            $this->scienceQuestions->append("Science Question " . $i);
            $this->sportsQuestions->append("Sports Question " . $i);
            $this->rockQuestions->append("Rock Question " . $i);
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
        $this->inPenaltyBox[$this->players->count()] = false;

        echoln($player . " was added");
        echoln("They are player number " . $this->players->count());
		return true;
	}

	public function  roll($roll) {
		echoln($this->players->get($this->currentPlayer) . " is the current player");
		echoln("They have rolled a " . $roll);

        $player = $this->players->get($this->currentPlayer);
		if ($this->inPenaltyBox[$this->currentPlayer]) {
			if ($roll % 2 != 0) {
				$this->isGettingOutOfPenaltyBox = true;

				echoln($player . " is getting out of the penalty box");
                $player->getPlace()->moveBy($roll);
                if ($player->getPlace()->get() > 11) {
                    $player->getPlace()->moveBy(-12);
                }

				echoln($player . "'s new location is " . $player->getPlace());
				echoln("The category is " . $this->currentCategory());

				$this->askQuestion();
			} else {
				echoln($player . " is not getting out of the penalty box");
				$this->isGettingOutOfPenaltyBox = false;
            }

		} else {

            $player->getPlace()->moveBy($roll);
            if ($player->getPlace()->get() > 11) {
                $player->getPlace()->moveBy(-12);
            }

			echoln($player . "'s new location is " .$player->getPlace());
			echoln("The category is " . $this->currentCategory());
			$this->askQuestion();
		}
	}

    public function askQuestion()
    {
        switch ($this->currentCategory()) {
            case self::POP:
                echoln($this->popQuestions->next());
                break;
            case self::SCIENCE:
                echoln($this->scienceQuestions->next());
                break;
            case self::SPORTS:
                echoln($this->sportsQuestions->next());
                break;
            case self::ROCK:
                echoln($this->rockQuestions->next());
                break;
        }
	}

    public function currentCategory()
    {
        $category = self::ROCK;
        $player = $this->players->get($this->currentPlayer);
        switch ($player->getPlace()->get()) {
            case 0:
            case 4:
            case 8:
                $category = self::POP;
                break;
            case 1:
            case 5:
            case 9:
                $category = self::SCIENCE;
                break;
            case 2:
            case 6:
            case 10:
                $category = self::SPORTS;
                break;
        }

        return $category;
	}

    public function wasCorrectlyAnswered()
    {
        $player = $this->players->get($this->currentPlayer);
		if ($this->inPenaltyBox[$this->currentPlayer]) {
			if ($this->isGettingOutOfPenaltyBox) {
				echoln("Answer was correct!!!!");
                $player->addPurses(1);
				echoln($this->players->get($this->currentPlayer) . " now has " . $player->getPurses() . " Gold Coins.");

				$winner = $player->didWin();
				$this->currentPlayer++;

                if ($this->currentPlayer == $this->players->count()) {
                    $this->currentPlayer = 0;
                }

				return $winner;
			} else {
				$this->currentPlayer++;
                if ($this->currentPlayer == $this->players->count()) {
                    $this->currentPlayer = 0;
                }
				return true;
			}
		} else {
			echoln("Answer was corrent!!!!");
            $player->addPurses(1);

			echoln($this->players->get($this->currentPlayer) . " now has " . $player->getPurses() . " Gold Coins.");

			$winner = $player->didWin();
			$this->currentPlayer++;
            if ($this->currentPlayer == $this->players->count()) {
                $this->currentPlayer = 0;
            }

			return $winner;
		}
	}

    public function wrongAnswer()
    {
		echoln("Question was incorrectly answered");
		echoln($this->players->get($this->currentPlayer) . " was sent to the penalty box");
        $this->inPenaltyBox[$this->currentPlayer] = true;

		$this->currentPlayer++;
        if ($this->currentPlayer == $this->players->count()) {
            $this->currentPlayer = 0;
        }
		return true;
	}
}
