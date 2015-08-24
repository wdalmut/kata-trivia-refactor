<?php
class Questions extends ArrayObject
{
    private $iterator;

    public function next()
    {
        if (!$this->iterator) {
            $this->iterator = $this->getIterator();
        }

        $question = $this->iterator->current();
        $this->iterator->next();

        return $question;
    }
}
