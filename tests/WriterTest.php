<?php
class WriterTest extends \PHPUnit_Framework_TestCase
{
    public function testWriteMessage()
    {
        $writer = new Writer(function($message, $args) {
            return vsprintf($message, $args);
        });

        $this->assertEquals("Ciao Walter", $writer->write("Ciao %s", "Walter"));
    }

    public function testWriteComplexMessage()
    {
        $writer = new Writer(function($message, $args) {
            return vsprintf($message, $args);
        });

        $this->assertEquals("Ciao Walter, tutto bene? Io sono Marco", $writer->write("Ciao %s, tutto bene? Io sono %s", "Walter", "Marco"));
    }
}
