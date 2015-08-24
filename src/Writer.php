<?php
class Writer
{
    private $adapter;

    public function __construct(callable $adapter)
    {
        $this->adapter = $adapter;
    }

    public function write()
    {
        $args = func_get_args();
        $message = array_shift($args);

        $adapter = $this->adapter;
        return $adapter($message, $args);
    }
}
