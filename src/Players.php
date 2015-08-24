<?php
class Players extends ArrayObject
{
    private $current;

    public function __construct()
    {
        $this->current = 0;
    }

    public function get($pos = false)
    {
        if ($pos === false) {
            $pos = $this->current;
        }

        return $this->offsetGet($pos);
    }

    public function next()
    {
        ++$this->current;

        if ($this->current >= $this->count()) {
            $this->current = 0;
        }
    }
}
