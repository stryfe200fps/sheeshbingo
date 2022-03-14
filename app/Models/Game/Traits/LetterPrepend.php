<?php

namespace Bingo\Models\Game\Traits;

trait LetterPrepend 
{
    public function prepend($roll): string
    {
        //This will set the letter on the beginning of each rolled number
        $temp = "";
        switch($roll){ 
        case($roll >= 1 && $roll <= 15):
            $temp = 'B-'. $roll;
        break;
        case($roll >= 16 && $roll <= 30):
            $temp = 'I-'. $roll;
        break;
        case($roll >= 31 && $roll <= 45):
            $temp = 'N-'. $roll;
        break;
        case($roll >= 46 && $roll <= 60):
            $temp = 'G-'. $roll;
        break;
        case($roll >= 61 && $roll <= 75):
            $temp = 'O-'. $roll;
        break;
    }
        return $temp;
    }
}