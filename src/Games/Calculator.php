<?php

namespace BrainGames\Games\Calc;

use function BrainGames\Engine\runGame;

use const BrainGames\Engine\ROUNDS;

function runBrainCalc(): void
{
    $task = 'What is the result of the expression?';
    $numbers = generateRand(6);
    $operators = ['+', '-', '*'];
    $operations = [];
    while (\count($operations) != ROUNDS) {
         $operations[] = $operators[array_rand($operators, 1)];
    }
    $questions = [];
    $correctAnswers = [];

    for ($a = 0, $b = 1, $c = 0; $c < ROUNDS; $a += 2, $b += 2, $c++) {
        $questions[] = match ($operations[$c]) {
            '+' => "{$numbers[$a]} + {$numbers[$b]}",
            '-' => "{$numbers[$a]} - {$numbers[$b]}",
            '*' => "{$numbers[$a]} * {$numbers[$b]}",
        };
    };

    for ($a = 0, $b = 1, $c = 0; $c < ROUNDS; $a += 2, $b += 2, $c++) {
        $correctAnswers[] = (string) calculate($numbers[$a], $numbers[$b], $operations[$c]);
    };
    runGame($task, $correctAnswers, $questions);
}

function generateRand(int $count): array
{
    for ($i = 0; $i < $count; $i++) {
        $array[] = random_int(1, 100);
    }
    return $array;
}

function calculate(int $num1, int $num2, string $operator): int
{
    return match ($operator) {
        '+' => $num1 + $num2,
        '-' => $num1 - $num2,
        '*' => $num1 * $num2,
    };
}
