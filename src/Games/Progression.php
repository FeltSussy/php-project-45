<?php

namespace BrainGames\Games\Progression;

use function BrainGames\Engine\runGame;

use const BrainGames\Engine\ROUNDS;

function runBrainProgression(): void
{
    $task = 'What number is missing in the progression?';
    $progressions = [];
    $indexesOfHiddenElements = [];
    $questions = [];
    $correctAnswers = [];
    for ($a = 0, $length = random_int(5, 10); $a < ROUNDS; $a++) {
        $start = random_int(1, 20);
        $step = random_int(1, 10);
        for ($i = 0; $i < $length; $i++) {
            $progressions[$a][] = generateProgressionElement($start, $i, $step);
        };
        $indexesOfHiddenElements[] = random_int(0, $length - 1);
        $correctAnswers[] = (string) $progressions[$a][$indexesOfHiddenElements[$a]];
        $shownProgressions = $progressions;
        $shownProgressions[$a][$indexesOfHiddenElements[$a]] = '..';
        $questions[] = implode(' ', $shownProgressions[$a]);
    };
    runGame($task, $correctAnswers, $questions);
}

function generateProgressionElement(int $start, int $index, int $step): int
{
    return $start + $index * $step;
}
