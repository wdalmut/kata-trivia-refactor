<?php
class Place
{
    private $position;

    public function __construct()
    {
        $this->position = 0;
    }

    public function moveBy($steps)
    {
        $this->position += $steps;
    }

    public function get()
    {
        return $this->position;
    }

    public function __toString()
    {
        return (string)$this->get();
    }
}
