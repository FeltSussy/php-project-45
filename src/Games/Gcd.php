<?php

namespace BrainGames\Games\Gcd;

use function BrainGames\Engine\runGame;

use const BrainGames\Engine\ROUNDS;

function runBrainGcd(): void
{
    $task = 'Find the greatest common divisor of given numbers.';
    $numbers = generateRand(6);
    $questions = [];

    for ($i = 0, $a = 0, $b = 1; $i < ROUNDS; $i++, $a += 2, $b += 2) {
        $questions[] = "{$numbers[$a]} {$numbers[$b]}";
    }

    $correctAnswers = [];

    for ($i = 0, $a = 0, $b = 1; $i < ROUNDS; $i++, $a += 2, $b += 2) {
        $correctAnswers[] = (string) findGcd($numbers[$a], $numbers[$b]);
    };
    runGame($task, $correctAnswers, $questions);
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
    for ($i = 0; $i < $count; $i++) {
        $array[] = random_int(1, 100);
    }
    return $array;
}
