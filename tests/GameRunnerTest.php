<?php
class GameRunnerTest extends \PHPUnit_Framework_TestCase
{
    private $goldenLimit = 1000;

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

        $this->assertEquals(file_get_contents(__DIR__ . "/_results/{$seed}.txt"), $output);
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
