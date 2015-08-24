<?php
class Player
{
    private $place;
    private $purses;

    public function __construct($name)
    {
        $this->name = $name;
        $this->place = new Place();
        $this->purses = 0;
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
}

