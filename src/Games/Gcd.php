<?php

namespace BrainGames\Games\Gcd;

use function BrainGames\Engine\runGame;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';
const ROUNDS = 3;

function run(): void
{
    $numbers = [];
    $questions = [];
    $correctAnswers = [];
    for ($i = 0, $a = 0, $b = 1; $i < ROUNDS; $i++, $a += 2, $b += 2) {
        array_push($numbers, ...generateRand(2));
        $questions[] = "{$numbers[$a]} {$numbers[$b]}";
        $correctAnswers[] = (string) findGcd($numbers[$a], $numbers[$b]);
    }
    runGame(GAME_DESCRIPTION, $correctAnswers, $questions);
}

function findGcd(int $firstNumber, int $secondNumber): int
{
    if ($firstNumber === 0) {
        return $secondNumber;
    } elseif ($secondNumber === 0) {
        return $firstNumber;
    }

    while ($secondNumber !== 0) {
        $tempVariable = $firstNumber % $secondNumber;
        $firstNumber = $secondNumber;
        $secondNumber = $tempVariable;
    }
    return $firstNumber;
}

function generateRand(int $count): array
{
    $array = [];
    for ($i = 0; $i < $count; $i++) {
        $array[] = random_int(1, 100);
    }
    return $array;
}
