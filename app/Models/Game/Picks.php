<?php

namespace Bingo\Models\Game;

class Picks
{
    protected array $picks = [];
    protected int $currentRoll = 0;
    protected array $rolls = [];

    public function __construct()
    {
        $this->picks = $this->setRangeOfArray(1,75)->getAll();
        $_SESSION['PicksClass'] = serialize($this);
    }

    public function getRolls(): array
    {
        sort($this->rolls);
        return $this->rolls;
    }

    public function shuffle(): object
    {
        shuffle($this->picks);
        return $this;
    }

    public function fetchAndRemove($roll): object
    {
        $this->rolls[] = $this->picks[$roll];
        $this->getSingle($roll)
            ->removeAt($roll);
        return $this;
    }

    public function removeAt($roll): object
    {
        unset($this->picks[$roll]);
        return $this;
    }

    public function getSingle($indexOfRoll): object
    {
        $this->currentRoll = $this->picks[$indexOfRoll];
        return $this;
    }

    public function getAll(): array
    {
        return $this->picks;
    }

    public function getCurrentRoll(): int
    {
        return $this->currentRoll;
    }

    private function setRangeOfArray($min, $max): object
    {
        $this->picks = range($min, $max);
        return $this;
    }

}