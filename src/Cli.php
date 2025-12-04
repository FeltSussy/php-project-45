<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

function welcome(): string
{
    line("Welcome to the Brain Games!");
    $playerName = prompt("May I have your name?");
    line("Hello, %s!", $playerName);
    return $playerName;
}
