<?php
namespace Bowling;

class Game
{
    private $rolls = array();
    private $currentRoll = 0;
    /**
     * @param $pins
     */
    public function roll($pins)
    {
        $this->rolls[$this->currentRoll++] = $pins;
    }

    public function score()
    {
        $score = 0;
        $firstInFrame = 0;
        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isStrike($firstInFrame)) {
                $score += 10 + $this->nextTwoBallsForStrike($firstInFrame);
                $firstInFrame++;
            } else if ($this->isSpare($firstInFrame)) {
                $score += 10 + $this->nextBallForSpare($firstInFrame);
                $firstInFrame += 2;
            } else {
                $score += $this->twoBallsInFrame($firstInFrame);
                $firstInFrame += 2;
            }
        }
        return $score;
    }

    /**
     * @param $firstInFrame
     * @return bool
     */
    public function isSpare($firstInFrame)
    {
        return $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1] == 10;
    }

    /**
     * @param $firstInFrame
     * @return bool
     */
    public function isStrike($firstInFrame)
    {
        return $this->rolls[$firstInFrame] == 10;
    }

    /**
     * @param $firstInFrame
     * @return mixed
     */
    public function nextTwoBallsForStrike($firstInFrame)
    {
        return $this->rolls[$firstInFrame + 1] + $this->rolls[$firstInFrame + 2];
    }

    /**
     * @param $firstInFrame
     * @return mixed
     */
    public function nextBallForSpare($firstInFrame)
    {
        return $this->rolls[$firstInFrame + 2];
    }

    /**
     * @param $firstInFrame
     * @return mixed
     */
    public function twoBallsInFrame($firstInFrame)
    {
        return $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1];
    }
}