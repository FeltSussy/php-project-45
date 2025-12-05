<?php

namespace BrainGames\Games\Prime;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\evaluateAnswer;

function checkPrime(int $number): bool
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

function runBrainPrime(string $playerName): void
{
    $totalCorrectAnswers = 0;
    while ($totalCorrectAnswers < 3) {
        $number = random_int(1, 100);
        line("Question: {$number}");
        $answer = prompt(ANSWER_PROMPT);
        $correctAnswer = match (checkPrime($number)) {
            true => 'yes',
            false => 'no',
        };
        evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
    }
}
