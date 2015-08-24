<?php
class Player
{
    private $place;

    public function __construct($name)
    {
        $this->name = $name;
        $this->place = new Place();
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function __toString()
    {
        return $this->name;
    }
}

