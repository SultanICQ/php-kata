<?php

include __DIR__.'/Questions.php';
include __DIR__.'/Game.php';

$notAWinner;



$aGame = new Game( new Questions());

$aGame->add("Chet");
$aGame->add("Pat");
$aGame->add("Sue");

srand(1000);

do {

    $aGame->roll(rand(0,5) + 1);

    if (rand(0,9) == 7) {
        $notAWinner = $aGame->wrongAnswer();
    } else {
        $notAWinner = $aGame->wasCorrectlyAnswered();
    }



} while ($notAWinner);

