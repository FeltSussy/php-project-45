<?php

namespace BrainGames\Games\Calc;

use Exception;

use function BrainGames\Engine\runGame;

const GAME_DESCRIPTION = 'What is the result of the expression?';
const OPERATORS = ['+', '-', '*'];
const ROUNDS = 3;

function run(): void
{
    $questions = [];
    $correctAnswers = [];
    for ($i = 0; $i < ROUNDS; $i++) {
        $num1 = random_int(1, 100);
        $num2 = random_int(1, 100);
        $operator = OPERATORS[array_rand(OPERATORS, 1)];
        $questions[] = "{$num1} {$operator} {$num2}";
        $correctAnswers[] = (string) calculate($num1, $num2, $operator);
    }
    runGame(GAME_DESCRIPTION, $correctAnswers, $questions);
}

function calculate(int $num1, int $num2, string $operator): int
{
    return match ($operator) {
        '+' => $num1 + $num2,
        '-' => $num1 - $num2,
        '*' => $num1 * $num2,
        default => throw new Exception("Allowed operators: '+', '-', '*'"),
    };
}
