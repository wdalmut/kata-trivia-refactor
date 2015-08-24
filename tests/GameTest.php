<?php
class GameTest extends \PHPUnit_Framework_TestCase
{
    private $goldenLimit = 20000;

    /**
     * @dataProvider getSeeds
     */
    public function testGamePathsUsingGoldenMaster($seed)
    {
        ob_start();
        srand($seed);
        require(__DIR__ . '/../src/GameRunner.php');
        $output = ob_get_contents();
        ob_end_clean();

        file_put_contents(__DIR__ . "/_results/{$seed}.txt", $output);

        //$this->assertEquals(file_get_contents(__DIR__ . "/_results/{$seed}.txt"), $output);
    }

    public function getSeeds()
    {
        $data = [];
        for ($i=1; $i<=$this->goldenLimit; $i++) {
            $data[] = [$i];
        }
        return $data;
    }
}
