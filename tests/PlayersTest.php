<?php

class PlayersTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAtPosition()
    {
        $players = new Players();
        $players->append(new Player("walter"));
        $players->append(new Player("wally"));

        $this->assertEquals("walter", $players->get(0));
        $this->assertEquals("wally", $players->get(1));
    }

    public function testGetCurrentPlayer()
    {
        $players = new Players();
        $players->append(new Player("walter"));
        $players->append(new Player("wally"));

        $this->assertEquals("walter", $players->get());
        $players->next();
        $this->assertEquals("wally", $players->get());
        $players->next();
        $this->assertEquals("walter", $players->get());
        $players->next();
        $this->assertEquals("wally", $players->get());
    }
}
