
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

<div class="grid grid-cols-5 w-40">  
<div class="p-2    m-auto border-black font-bold">B</div>
<div class="p-2  font-2xl m-auto border-black font-bold">I</div>
<div class="p-2  font-2xl m-auto border-black font-bold">N</div>
<div class="p-2  font-2xl m-auto border-black font-bold">G</div>
<div class="p-2  font-2xl m-auto border-black font-bold">O</div>
<?php

require 'vendor/autoload.php';
session_start();
if(isset($_POST['roll'])){
    roll();

}

$array =  $_SESSION['init']->getCard();
$status = $_SESSION['init']->getStatus();
$rolls = $_SESSION['picks']->getRolls();

for($i = 0; $i<5;$i++){
   for($j = 0; $j<5; $j++) { 
    ?>
    <div class="font-2xl p-2 m-auto 
        <?php echo ( in_array($array[$j][$i], $_SESSION['check']->getWinningCombination()) &&  $status ) ? 'font-bold text-green-500' : '';  ?> 
        <?php echo (in_array($array[$j][$i] , $rolls)) ? 'text-red-500' : ''; ?> border-black"> <?php echo $array[$j][$i]  ?>
    </div>
<?php  } } ?>
</div>

<form action="index.php" method="post">
<?php if (isset($status) && !$status) { ?>
<button type="submit" name="roll" class="bg-green-600 py-2 px-4">Pick</button>
<?php } ?>
<a href="init.php" name="roll" class="font-xl bg-red-600 py-2 px-4">Reset Game</a>

</form>
<?php echo "Current Roll is : ". $_SESSION['picks']->getCurrentRoll(); ?>

<br>

<?php

//  get random roll number
function roll()
{
    //check if there's no number to roll 
    if (!count($_SESSION['picks']->getAll())) 
        return;
            //get/set roll number 
            $_SESSION['picks']
            ->shuffle()
            ->fetchAndRemove(0);
            
             $_SESSION['check']->setRolls($_SESSION['picks']->getRolls());

        if ($_SESSION['check']->checkForWinningPattern($_SESSION['picks']->getCurrentRoll()))
            $_SESSION['init']->setStatus(true);
    
}

?>

<h1>List of rolls</h1>

<?php
foreach($_SESSION['picks']->getRolls() as $roll){
    echo '<span class="font-md  mr-4">'. 
         $_SESSION['init']->prepend($roll)  .'<span> <span>,</span> ' ;
}
?>