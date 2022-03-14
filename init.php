<?php

use Bingo\Models\Bingo;
use Bingo\Models\Game\PatternResolver;
use Bingo\Models\Game\Picks;
use Bingo\Models\Game\Rolls;

session_start();
require 'vendor/autoload.php';

initialize();
function initialize()
{

    new Bingo;
    new PatternResolver;
    new Picks;
    //instantiate rolls class to store each of bingo rolls

    $_SESSION['init']  = unserialize($_SESSION['BingoClass']);
    $_SESSION['picks'] = unserialize($_SESSION['PicksClass']);
    $_SESSION['check'] = unserialize($_SESSION['PatternResolverClass']);
    $_SESSION['card'] = $_SESSION['init']->getCard();
    $_SESSION['check']->setCurrentCard($_SESSION['init']->getCard());

}

 header("Location: index.php");
// 
