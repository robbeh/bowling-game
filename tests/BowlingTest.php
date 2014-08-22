<?php

require_once __DIR__ . '/../src/Game.php';
class BowlingTest extends PHPUnit_Framework_TestCase
{
    private $g;

    public function __construct()
    {
        $this->g = new Bowling\Game();
    }

    /**
     * @param $n
     * @param $pins
     */
    public function rollMany($n, $pins)
    {
        for ($i = 0; $i < $n; $i++) {
            $this->g->roll($pins);
        }
    }

    public function rollSpare()
    {
        $this->g->roll(5);
        $this->g->roll(5);
    }

    public function rollStrike()
    {
        $this->g->roll(10);
    }

    public function testGutterGame()
    {
        $this->rollMany(20, 0);
        $this->assertEquals(0, $this->g->score());
    }

    public function testAllOnes()
    {
        $this->rollMany(20, 1);
        $this->assertEquals(20, $this->g->score());
    }

    public function testOneSpare()
    {
       // $this->markTestIncomplete();
        $this->rollSpare();
        $this->g->roll(3);
        $this->rollMany(17, 0);
        $this->assertEquals(16, $this->g->score());
    }

    public function testOneStrike()
    {
        $this->rollStrike();
        $this->g->roll(3);
        $this->g->roll(4);
        $this->rollMany(16, 0);
        $this->assertEquals(24, $this->g->score());
    }

    public function perfectGame()
    {
        $this->rollMany(12, 10);
        $this->assertEquals(300, $this->g->score());
    }
}