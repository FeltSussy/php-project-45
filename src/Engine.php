<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

define('ANSWER_PROMPT', "Your answer");
function askQuestion(string $question): void
{
    line("{$question}");
}

function generateRand(int $count, array &$targetArray): void
{
    for ($i = 0; $i < $count; $i++) {
        $targetArray[] = random_int(1, 100);
    }
}

function evaluateAnswer(string $correctAnswer, string $answer, string $playerName, int &$totalCorrectAnswers): void
{
    if ($correctAnswer !== $answer) {
        line("Answer '{$answer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.");
        line("Let's try again, {$playerName}!");
        exit;
    } else {
        line("Correct!");
        $totalCorrectAnswers++;
    }

    if ($totalCorrectAnswers === 3) {
        line("Congratulations, {$playerName}!");
    }
}
