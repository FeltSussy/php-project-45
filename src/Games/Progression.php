<?php

namespace BrainGames\Games\Progression;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\evaluateAnswer;

function generateProgressionElement(int $start, int $index, int $step): int
{
    return $start + $index * $step;
}

function runBrainProgression(string $playerName): void
{
    $totalCorrectAnswers = 0;
    while ($totalCorrectAnswers < 3) {
        $progression = [];
        $start = random_int(1, 20);
        $step = random_int(1, 10);
        $count = random_int(5, 10);
        for ($i = 0; $i < $count; $i++) {
            $progression[] = generateProgressionElement($start, $i, $step);
        }
        $indexOfHiddenElement = random_int(0, $count - 1);
        $hiddenElement = $progression[$indexOfHiddenElement];
        $progression[$indexOfHiddenElement] = '..';
        $shownProgression = implode(' ', $progression);
        line("Question: {$shownProgression}");
        $answer = prompt(ANSWER_PROMPT);
        $correctAnswer = (string) $hiddenElement;
        evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
    }
}
