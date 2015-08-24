<?php

require_once __DIR__ . '/../vendor/autoload.php';

$aGame = new Game(new Writer(function($message, $args) {
    echo vsprintf($message, $args) . "\n";
}));

$aGame->add("Chet");
$aGame->add("Pat");
$aGame->add("Sue");

$winner = false;
do {
    $aGame->roll(rand(0,5) + 1);

    if (rand(0,9) == 7) {
        $winner = $aGame->wrongAnswer();
    } else {
        $winner = $aGame->wasCorrectlyAnswered();
    }
} while (!$winner);

