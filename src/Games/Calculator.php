<?php

namespace BrainGames\Games\Calc;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\generateRand;
use function BrainGames\Engine\evaluateAnswer;

function runBrainCalc(string $playerName): void
{
    $totalCorrectAnswers = 0;
    while ($totalCorrectAnswers < 3) {
        $numbers = [];
        generateRand(2, $numbers);
        [$num1, $num2] = $numbers;
        $operations = ['+', '-', '*'];
        $operation = $operations[array_rand($operations)];
        line("Question: {$num1} {$operation} {$num2}");
        $answer = prompt(ANSWER_PROMPT);
        $correctAnswer = match ($operation) {
            '+' => (string) ($num1 + $num2),
            '-' => (string) ($num1 - $num2),
            '*' => (string) ($num1 * $num2),
        };
        evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
    }
}
