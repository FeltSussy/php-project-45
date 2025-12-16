<?php

namespace BrainGames\Games\Calc;

use Exception;
use function BrainGames\Engine\runGame;

const GAME_DESCRIPTION = 'What is the result of the expression?';
CONST OPERATORS = ['+', '-', '*'];
const ROUNDS = 3;

function run(): void
{
    $operations = [];
    $questions = [];
    $correctAnswers = [];
    $numbers = [];
    for ($a = 0, $b = 1, $c = 0; $c < ROUNDS; $a += 2, $b += 2, $c++) {
        array_push($numbers, ...generateRand(2));
        $operations[] = OPERATORS[array_rand(OPERATORS, 1)];
        $questions[] = match ($operations[$c]) {
            '+' => "{$numbers[$a]} + {$numbers[$b]}",
            '-' => "{$numbers[$a]} - {$numbers[$b]}",
            '*' => "{$numbers[$a]} * {$numbers[$b]}",
        };
        $correctAnswers[] = (string) calculate($numbers[$a], $numbers[$b], $operations[$c]);
    }
    runGame(GAME_DESCRIPTION, $correctAnswers, $questions);
}

function generateRand(int $count): array
{
    $array = [];
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
        default => throw new Exception("Allowed operators: '+', '-', '*'"),
    };
}
