<?php
namespace Bingo\Models\Game\Traits\Generator;

trait Card
{
    private array $bingo;

    public function getCard(): array
    {
        return $this->bingo;
    }

    public function generateCard(): object
    {
        // this for loop will iterate 5 times to 
        // get each BINGO rows
        for ($letter = 1; $letter <= 5; $letter++) {
            $this->bingo[] = $this->generateRandomBingoRows($letter);
        }
        // This will change the value of the center in bingo
        $this->bingo[2][2] = 0;
        return $this;
    }

    private function generateRandomBingoRows(int $letterIndex): array
    {
        // range(max,min) will return  an array with the inserted params.
        // self::INCREMENT = 15
        // range( index * 15 , (index * 15 ) - 15  )
        //added a ternary operator to avoid getting 0 value
        $array = range ( 
            $letterIndex * 15, ((
            $letterIndex * 15) - 15 + 1)
        );        
       
        shuffle($array) ;
        array_splice($array,5);
        return $array;
    }

}