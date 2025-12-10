<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

const ANSWER_PROMPT = "Your answer";
const ROUNDS = 3;

function runGame(string $task, array $correctAnswers, array $questions): void
{
    line('Welcome to the Brain Games!');
    $playerName = prompt('May I have your name?');
    line("Hello, %s!", $playerName);
    line("{$task}");
    $totalCorrectAnswers = 0;
    for ($i = 0; $i < ROUNDS; $i++) {
        line("Question: {$questions[$i]}");
        $answer = prompt(ANSWER_PROMPT);
        if ($correctAnswers[$i] !== $answer) {
            line("Answer '{$answer}' is wrong answer ;(. Correct answer was '{$correctAnswers[$i]}'.");
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
}
