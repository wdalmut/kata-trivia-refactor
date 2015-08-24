<?php

require_once __DIR__ . '/../vendor/autoload.php';

$aGame = new Game();

$aGame->add("Chet");
$aGame->add("Pat");
$aGame->add("Sue");

$notAWinner;
do {
    $aGame->roll(rand(0,5) + 1);

    if (rand(0,9) == 7) {
        $notAWinner = $aGame->wrongAnswer();
    } else {
        $notAWinner = $aGame->wasCorrectlyAnswered();
    }
} while ($notAWinner);

