<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function questionLine($question)
{
    line("{$question}");
}

function generateRand($count, &$randArray)
{
    for ($i = 0; $i < $count; $i++) {
        $randArray[] = rand(1, 100);
    }
}

function run($gameName, $playerName)
{
    switch ($gameName) {
        case "brain-even":
            $totalCorrectAnswers = 0;
            while ($totalCorrectAnswers < 3) {
                $randomNumber = rand(1, 100);
                line("Question: {$randomNumber}");
                $answer = prompt("Your answer");
                $numberIsEven = $randomNumber % 2 === 0;

                if ($numberIsEven && $answer !== 'yes') {
                    line("Answer '{$answer}' is wrong answer ;(. Correct answer was 'yes'.");
                    line("Let's try again, {$playerName}!");
                    break;
                } elseif (!$numberIsEven && $answer !== 'no') {
                    line("Answer '{$answer}' is wrong answer ;(. Correct answer was 'no'.");
                    line("Let's try again, {$playerName}!");
                    break;
                } else {
                    line("Correct!");
                    $totalCorrectAnswers++;
                }
            }

            if ($totalCorrectAnswers === 3) {
                line("Congratulations, {$playerName}!");
            }
            break;
        case "brain-calc":
            $totalCorrectAnswers = 0;
            while ($totalCorrectAnswers < 3) {
                $randArray = [];
                generateRand(2, $randArray);
                $operations = ['+', '-', '*'];
                $operation = $operations[array_rand($operations)];
                line("Question: $randArray[0] $operation $randArray[1]");
                $answer = prompt("Your answer");
                $correctAnswer = match ($operation) {
                    '+' => $randArray[0] + $randArray[1],
                    '-' => $randArray[0] - $randArray[1],
                    '*' => $randArray[0] * $randArray[1],
                };

                if ($correctAnswer != $answer) {
                    line("Answer '{$answer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.");
                    line("Let's try again, {$playerName}!");
                    break;
                } else {
                    line("Correct!");
                    $totalCorrectAnswers++;
                }

                if ($totalCorrectAnswers === 3) {
                    line("Congratulations, {$playerName}!");
                }
            }
            break;
    }
}
