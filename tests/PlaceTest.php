<?php

class PlaceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getMoves
     */
    public function testMoveBy($move, $offset, $result)
    {
        $place = new Place();
        $place->moveBy($offset);
        $place->moveBy($move);

        $this->assertEquals($result, $place->get());
    }

    public function getMoves()
    {
        return [
            [1, 0, 1],
            [2, 0, 2],
            [-1, 0, -1],
            [-2, 0, -2],
            [1, 1, 2],
            [2, 1, 3],
            [-1, -1, -2],
            [-1, 2, 1],
            [-2, -2, -4],
            [-2, 2, 0],
            [2, 12, 2],
            [0, 12, 0],
            [0, 11, 11],
            [1, 11, 0],
            [0, 11, 11],
        ];
    }
}
