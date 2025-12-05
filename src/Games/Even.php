<?php

namespace BrainGames\Games\Even;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\evaluateAnswer;

function runBrainEven(string $playerName): void
{
    $totalCorrectAnswers = 0;
    while ($totalCorrectAnswers < 3) {
        $randomNumber = random_int(1, 100);
        line("Question: {$randomNumber}");
        $answer = prompt(ANSWER_PROMPT);
        $correctAnswer = ($randomNumber % 2 === 0) ? 'yes' : 'no';
        evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
    }
}
