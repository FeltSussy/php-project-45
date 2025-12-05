<?php

namespace BrainGames\Games\Gcd;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\generateRand;
use function BrainGames\Engine\evaluateAnswer;

function findNod(int $firstNumber, int $secondNumber): int
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

function runBrainGcd(string $playerName): void
{
    $totalCorrectAnswers = 0;
    while ($totalCorrectAnswers < 3) {
        $numbers = [];
        generateRand(2, $numbers);
        [$num1, $num2] = $numbers;
        line("Question: {$num1} {$num2}");
        $answer = prompt(ANSWER_PROMPT);
        $correctAnswer = (string) findNod($num1, $num2);
        evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
    }
}
