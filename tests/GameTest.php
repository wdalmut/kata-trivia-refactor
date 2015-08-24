<?php
class GameTest extends \PHPUnit_Framework_TestCase
{
    public function testIsPlayable()
    {
        $game = new Game(new Writer(function(){}));
        $game->add(new Player("walter"));
        $game->add(new Player("wally"));

        $this->assertTrue($game->isPlayable());
    }

    public function testIsNotPlayable()
    {
        $game = new Game(new Writer(function(){}));
        $game->add(new Player("walter"));

        $this->assertFalse($game->isPlayable());
    }

    public function testIsNotPlayableWhenNoPlayers()
    {
        $game = new Game(new Writer(function(){}));
        $this->assertFalse($game->isPlayable());
    }
}
