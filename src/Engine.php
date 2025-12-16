<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function runGame(string $description, array $correctAnswers, array $questions)
{
    line('Welcome to the Brain Games!');
    $playerName = prompt('May I have your name?');
    line("Hello, %s!", $playerName);
    line("%s", $description);
    foreach ($correctAnswers as $key => $correctAnswer) {
        line("Question: %s", $questions[$key]);
        $answer = prompt("Your answer");
        if ($correctAnswer !== $answer) {
            return line("Answer '%s' is wrong answer ;(. Correct answer was '%s'.\nLet's try again, {$playerName}!", $answer, $correctAnswer);
        }
        line("Correct!");
    }
    line("Congratulations, %s!", $playerName);
}
