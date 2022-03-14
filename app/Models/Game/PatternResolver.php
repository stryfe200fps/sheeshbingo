<?php

namespace Bingo\Models\Game;

class PatternResolver
{
    private array $winningCombination = [];
    private array $currentCard = [];
    protected array $rolls = [];

    public function __construct()
    {
        $_SESSION['PatternResolverClass'] = serialize($this);
    }

    public function setCurrentCard($card): array
    {
        return $this->currentCard = $card;
    }

    public function getCurrentCard(): array
    {
        return $this->currentCard;
    }

    public function getWinningCombination(): array
    {
        return $this->winningCombination;
    }

    public function setWinningCombination($winningCombination)
    {
        $this->winningCombination = $winningCombination;
    }

    public function getRolls(): array
    {
        return $this->rolls;
    }

    public function setRolls($rolls)
    {
        $this->rolls = $rolls;
    }

    public function checkForWinningPattern($roll): bool
    {
        #find coordinates of rolls e.g [0, 3]  then check if has matched pattern horizontally, diagonally or vertically
        if ($roll == null)
            return false;

        $letterIndex = ceil($roll / 15);     
        --$letterIndex;

        if (! in_array($roll, $this->getCurrentCard()[$letterIndex]))
            return false;

        return  $this->getHorizontal(  [$letterIndex , array_search($roll, $this->getCurrentCard()[$letterIndex])]);
    }

    public function getHorizontal($coordinates): bool
    {
        #check if has Horizontal Pattern
        $winningCombinationTemp = [];
        for ($letterIndex = 0;  $letterIndex < 5; $letterIndex++){
            if (! in_array($this->getCurrentCard()[$letterIndex] [$coordinates[1]], $this->rolls ))
                return $this->getVertical([$coordinates[0], $coordinates[1]]);
            $winningCombinationTemp[] = $this->getCurrentCard()[$letterIndex] [$coordinates[1]];
        }
        $this->setWinningCombination($winningCombinationTemp); 
        return true;
    }

    public function getVertical($coordinates): bool
    {
        #check if has vertical pattern
        $winningCombinationTemp = [];
        for ($letterIndex = 0;  $letterIndex < 5; $letterIndex++) {
            if (! in_array($this->getCurrentCard()[$coordinates[0]] [$letterIndex], $this->rolls ))
                return $this->getDiagonal();
            $winningCombinationTemp[] = $this->getCurrentCard()[$coordinates[0]] [$letterIndex];
        }
        $this->setWinningCombination($winningCombinationTemp); 
        return true;
    }

    public function getDiagonal(): bool
    {
        # Check if has diagonal pattern
        if (in_array( $this->getCurrentCard()[0] [0], $this->rolls ))
        {
            $winningCombinationTemp = [];
            for ($letterIndex = 0; $letterIndex < 5; $letterIndex++){
                if ($letterIndex == 2)
                    continue;
                if (! in_array($this->getCurrentCard()[$letterIndex][$letterIndex], $this->rolls ))
                     break;

                $winningCombinationTemp[] = $this->getCurrentCard()[$letterIndex][$letterIndex];
            }
            if (count($winningCombinationTemp) == 4) {
                $this->setWinningCombination($winningCombinationTemp);
                return true;
            }
        }
        if (in_array( $this->getCurrentCard()[4] [0], $this->rolls ))
        {
            $winningCombinationTemp = [];
            for ($letterIndex = 0; $letterIndex < 5; $letterIndex++) {
                if ($letterIndex == 2)
                    continue;

                if (!in_array($this->getCurrentCard()[4 - $letterIndex][$letterIndex], $this->rolls  )) 
                    return false;

                $winningCombinationTemp[] = $this->getCurrentCard()[4 - $letterIndex][$letterIndex];
            }
            $this->setWinningCombination($winningCombinationTemp);
            return true;
        }
        return false;
    }

}