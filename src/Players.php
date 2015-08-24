<?php
class Players extends ArrayObject
{
    public function get($pos)
    {
        return $this->offsetGet($pos);
    }
}
