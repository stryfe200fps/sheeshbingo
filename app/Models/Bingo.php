<?php

namespace Bingo\Models;

use Bingo\Models\Game\Traits\LetterPrepend;
use Bingo\Models\Game\Traits\Generator\Card;

class Bingo
{
    use Card, LetterPrepend;
  
    protected bool $status = false;
    
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function __construct()
    {
       $this->generateCard();
       $_SESSION['BingoClass'] = serialize($this);
    }

}
