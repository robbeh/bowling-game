<?php

require_once __DIR__ . '/../src/Game.php';
class BowlingTest extends PHPUnit_Framework_TestCase
{
    private $g;

    public function __construct()
    {
        $this->g = new Game();
    }

    public function testCanRoll()
    {
        $this->g->roll(0);
    }


}