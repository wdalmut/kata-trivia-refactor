<?php
class Player
{
    private $place;
    private $purses;
    private $penaltyBox;
    private $isGettingOutOfPenaltyBox;

    public function __construct($name)
    {
        $this->name = $name;
        $this->place = new Place();
        $this->purses = 0;
        $this->penaltyBox = false;
        $this->isGettingOutOfPenaltyBox = false;
    }

    public function setGettingOutPenaltyBox($status)
    {
        $this->isGettingOutOfPenaltyBox = $status;
    }

    public function isGettingOutOfPenaltyBox()
    {
        return $this->isGettingOutOfPenaltyBox;
    }

    public function isInPenaltyBox()
    {
        return $this->penaltyBox;
    }

    public function setPenaltyBox($status)
    {
        $this->penaltyBox = $status;
    }

    public function addPurses($count)
    {
        $this->purses += $count;
    }

    public function getPurses()
    {
        return $this->purses;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function didWin()
    {
		return !($this->getPurses() == 6);
    }

    public function getCurrentCategory()
    {
        $category = Questions::ROCK;
        switch ($this->getPlace()->get()) {
            case 0:
            case 4:
            case 8:
                $category = Questions::POP;
                break;
            case 1:
            case 5:
            case 9:
                $category = Questions::SCIENCE;
                break;
            case 2:
            case 6:
            case 10:
                $category = Questions::SPORTS;
                break;
        }

        return $category;
    }
}

