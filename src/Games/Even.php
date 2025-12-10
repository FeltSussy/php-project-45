<?php

namespace BrainGames\Games\Even;

use function BrainGames\Engine\runGame;

use const BrainGames\Engine\ROUNDS;

function runBrainEven(): void
{
    $task = 'Answer "yes" if the number is even, otherwise answer "no".';
    $questions = [
        random_int(1, 100),
        random_int(1, 100),
        random_int(1, 100)
    ];
    $correctAnswers = [
        ($questions[0] % 2 === 0) ? 'yes' : 'no',
        ($questions[1] % 2 === 0) ? 'yes' : 'no',
        ($questions[2] % 2 === 0) ? 'yes' : 'no'
    ];
    runGame($task, $correctAnswers, $questions);
}
