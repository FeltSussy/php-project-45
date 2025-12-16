<?php

namespace BrainGames\Games\Even;

use function BrainGames\Engine\runGame;

const GAME_DESCRIPTION = 'Answer "yes" if the number is even, otherwise answer "no".';
const ROUNDS = 3;

function run(): void
{
    $questions = [];
    $correctAnswers = [];
    for ($i = 0; $i < ROUNDS; $i++) {
        $value = random_int(1, 100);
        $questions[] = $value;
        $correctAnswers[] = isEven($value) ? 'yes' : 'no';
    }
    runGame(GAME_DESCRIPTION, $correctAnswers, $questions);
}

function isEven(int $number): bool
{
    return $number % 2 === 0;
}