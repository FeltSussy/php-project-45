<?php

namespace BrainGames\Games\Gcd;

use function BrainGames\Engine\runGame;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';
const ROUNDS = 3;

function run(): void
{
    $questions = [];
    $correctAnswers = [];
    for ($i = 0; $i < ROUNDS; $i++) {
        $num1 = random_int(1, 100);
        $num2 = random_int(1, 100);
        $questions[] = "{$num1} {$num2}";
        $correctAnswers[] = (string) findGcd($num1, $num2);
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
