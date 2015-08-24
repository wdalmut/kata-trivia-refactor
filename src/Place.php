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

        if ($this->position > 11) {
            $this->moveBy(-12);
        }
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
