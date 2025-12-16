<?php

namespace BrainGames\Games\Prime;

use function BrainGames\Engine\runGame;

const GAME_DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';
const ROUNDS = 3;

function run(): void
{
    $questions = [];
    $correctAnswers = [];
    for ($i = 0; $i < ROUNDS; $i++) {
        $questions[] = random_int(1, 100);
        $correctAnswers[] = match (isPrime($questions[$i])) {
            true => 'yes',
            false => 'no',
        };
    };
    runGame(GAME_DESCRIPTION, $correctAnswers, $questions);
}

function isPrime(int $number): bool
{
    $result = true;
    if ($number < 2 || $number % 2 === 0 || $number % 3 === 0) {
        $result = false;
    }
    if ($number === 2 || $number === 3) {
        $result = true;
    }
    $numberSquareRoot = (int) sqrt($number);
    for ($i = 5; $i <= $numberSquareRoot; $i += 2) {
        if ($number % $i === 0) {
            $result = false;
        }
    }
    return $result;
}
